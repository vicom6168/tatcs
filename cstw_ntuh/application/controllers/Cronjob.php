<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
     * 
	 */
	
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
       // if($this->session->userdata('bookingID')=="" || $this->session->userdata('isAdmin')=="")
      //  redirect(base_url().'home/home', 'refresh');
         
        $this->load->model('user_Model');
        $this->load->model('PatientInformation_Model');
        $this->load->model('Authority_Model');
        $this->load->helper('form');
    }
    
	public function index()
	{
	   
	       $SurgeonList=$this->user_Model->querySendNotifyVS();
         
        foreach($SurgeonList->result() as $row){
            $ccEmailArray=array();
            
            array_push($ccEmailArray,"vicwang2007@gmail.com");
           
                   if($row->vsEmailNotifyOthers=="Y"){
                             $ccEmail= $this->Authority_Model->query_authorityEmailbyvs($row->userID);
                       foreach($ccEmail->result() as $ccrow){
                                   if($ccrow->email!="")
                                   array_push($ccEmailArray,$ccrow->email);
                       }
                       }
            
                 //日報表
                if($row->vsEmailNotify1=="Y"){
                    $content=$this->mailBody($row,'1');
                    if($content!=""){
                              $ci = get_instance();
                    $ci->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.gmail.com';
                    $config['smtp_port'] = '465';
                    $config['smtp_user'] = 'twcvs2017@gmail.com'; 
                    $config['smtp_pass'] = 'vicwang2018';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";

                    $ci->email->initialize($config);

                    $ci->email->from('twcvs2017@gmail.com', 'CSTW');
                    $list = array($row->vsEmail);
                   
                             
                       $ci->email->to($list);
                       $ci->email->cc($ccEmailArray);
                        $this->email->reply_to('twcvs.tatcs@gmail.com', 'CSTW');
                   
                   
                        $ci->email->subject('CSTW: ['.$row->userRealname.' 醫師] 病患資料日報表');
                   
                  
                        $ci->email->message($content);
                    
                      $ci->email->send();
                      echo "病患資料日報表 send mail to:".$row->vsEmail."<br/>";
                      print_r($ccEmailArray);
              }
                }

              //週報表
               if($row->vsEmailNotify2=="Y" && date("w")==1){
                    $content=$this->mailBody($row,'2');
                    if($content!=""){
                              $ci = get_instance();
                    $ci->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.gmail.com';
                    $config['smtp_port'] = '465';
                    $config['smtp_user'] = 'twcvs2017@gmail.com'; 
                    $config['smtp_pass'] = 'vicwang2018';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";

                    $ci->email->initialize($config);

                    $ci->email->from('twcvs2017@gmail.com', 'CSTW');
                    $list = array($row->vsEmail);
                             
                       $ci->email->to($list);
                       $ci->email->cc($ccEmailArray);
                        $this->email->reply_to('twcvs.tatcs@gmail.com', 'CSTW');
                   
                  
                                 $ci->email->subject('CSTW: ['.$row->userRealname.' 醫師] 病患資料週報表');
                              
                  
                                $ci->email->message($content);
                    
                      $ci->email->send();
                      echo "病患資料週報表 send mail to:".$row->vsEmail."<br/>";
              }
                }

               //月報表
                if($row->vsEmailNotify3=="Y" && date("j")==1 ){
                    $content=$this->mailBody($row,'3');
                    if($content!=""){
                              $ci = get_instance();
                    $ci->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.gmail.com';
                    $config['smtp_port'] = '465';
                    $config['smtp_user'] = 'twcvs2017@gmail.com'; 
                    $config['smtp_pass'] = 'vicwang2018';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";

                    $ci->email->initialize($config);

                    $ci->email->from('twcvs2017@gmail.com', 'CSTW');
                    $list = array($row->vsEmail);
                             
                    $ci->email->to($list);
                    $ci->email->cc($ccEmailArray);
                    $this->email->reply_to('twcvs.tatcs@gmail.com', 'TWCVS');
                    $ci->email->subject('CSTW: ['.$row->userRealname.' 醫師] 病患資料月報表');
                    $ci->email->message($content);
                    
                      $ci->email->send();
                      echo "病患資料月報表 send mail to:".$row->vsEmail."<br/>";
              }
                }
            }
         
	}
      
   function mailBody($vs,$frequency)
    {
         $html="";
        if($vs->vsEmailNotify1=="Y" && $frequency=="1"){
            $pList=$this->PatientInformation_Model->queryPatientByDays($vs->userID,"1");
        } else if($vs->vsEmailNotify2=="Y" && $frequency=="2"){
            $pList=$this->PatientInformation_Model->queryPatientByDays($vs->userID,"2");
        } else if($vs->vsEmailNotify3=="Y" && $frequency=="3"){
            $pList=$this->PatientInformation_Model->queryPatientByDays($vs->userID,"3");
        }
        if($pList->num_rows()>0){
            $html="";
        $html.="<table cellspacing='0' cellpadding='0' border='1' width='100%' style='border: 1px solid black'> ";
        $html.="<tr bgcolor='#CED8F6'>";
        $html.="<td>Chart Numbet</td>";
        $html.="<td>Patient Name</td>";
        $html.="<td>Op Date</td>";
        $html.="<td>Surgeon</td>";
        $html.="<td>Diagnosis</td>";
        $html.="<td>Procedure</td>";
        $html.="</tr>";
        foreach($pList->result() as $row){
                $html.="<tr>";
        $html.="<td>".$row->patientChartNumber."</td>";
        $html.="<td>".$row->patientName."</td>";
        $html.="<td>".$row->patientOpDate."</td>";
        $html.="<td>";
        $html.=$row->patientSurgeon.($row->patientSurgeon2==""?"":"<br/>".$row->patientSurgeon2).($row->patientSurgeon3==""?"":"<br/>".$row->patientSurgeon3).($row->patientSurgeon4==""?"":"<br/>".$row->patientSurgeon4).($row->patientSurgeon5==""?"":"<br/>".$row->patientSurgeon5);                
         $html.="</td>";
        $html.="<td>";
        $html.=$row->Diagnosis1.($row->Diagnosis2==""?"":"<br/>".$row->Diagnosis2).($row->Diagnosis3==""?"":"<br/>".$row->Diagnosis3).($row->Diagnosis4==""?"":"<br/>".$row->Diagnosis4).($row->Diagnosis5==""?"":"<br/>".$row->Diagnosis5);
        $html.="</td>";          
        $html.="<td>";
        $html.=$row->Procedure1.($row->Procedure2==""?"":"<br/>".$row->Procedure2).($row->Procedure3==""?"":"<br/>".$row->Procedure3).($row->Procedure4==""?"":"<br/>".$row->Procedure4).($row->Procedure5==""?"":"<br/>".$row->Procedure5);
        $html.="</td>";
        $html.="</tr>";
        }
         $html.="</table>";
        }

   return $html;
    }

   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */