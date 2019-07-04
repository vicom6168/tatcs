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
             if($this->config->item("hospitalName")=="台大醫院" || $this->config->item("hospitalName")=="台大醫院新竹分院" ){
            //array_push($ccEmailArray,"lingyi.wei@gmail.com");
            }
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

                    $ci->email->from('twcvs2017@gmail.com', 'TWCVS');
                    $list = array($row->vsEmail);
                   
                             
                       $ci->email->to($list);
                       $ci->email->cc($ccEmailArray);
                        $this->email->reply_to('twcvs.tatcs@gmail.com', 'TWCVS');
                   
                   
                        $ci->email->subject('TWCVS: ['.$row->userRealname.' 醫師] 病患資料日報表');
                   
                  
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

                    $ci->email->from('twcvs2017@gmail.com', 'TWCVS');
                    $list = array($row->vsEmail);
                             
                       $ci->email->to($list);
                       $ci->email->cc($ccEmailArray);
                        $this->email->reply_to('twcvs.tatcs@gmail.com', 'TWCVS');
                   
                  
                                 $ci->email->subject('TWCVS: ['.$row->userRealname.' 醫師] 病患資料週報表');
                              
                  
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

                    $ci->email->from('twcvs2017@gmail.com', 'TWCVS');
                    $list = array($row->vsEmail);
                             
                    $ci->email->to($list);
                    $ci->email->cc($ccEmailArray);
                    $this->email->reply_to('twcvs.tatcs@gmail.com', 'TWCVS');
                    $ci->email->subject('TWCVS: ['.$row->userRealname.' 醫師] 病患資料月報表');
                    $ci->email->message($content);
                    
                      $ci->email->send();
                      echo "病患資料月報表 send mail to:".$row->vsEmail."<br/>";
              }
                }
            }
           //重算LVAD
           $LVADCount = $this->PatientInformation_Model->query_LVADCount()->row()->LVADCount;
        $LVADHospitalScore=0;
        $LVADScore=1;
        if($LVADCount>=15)
             $LVADHospitalScore=0;
        $LVAD_rows = $this->PatientInformation_Model->query_patientLVADlist('','','999999999',0,0);
           foreach($LVAD_rows->result() as $row){
               $LVADScore=1;
                 if($row->patientAge!="" && $row->patientSerumCreatinine!="" &&  $row->LVADAlbumin!="" &&  $row->LVADINR!="" && $row->patientAge!=NULL && $row->patientSerumCreatinine!=NULL &&  $row->LVADAlbumin!=NULL &&  $row->LVADINR!=NULL){
                       
                        if($row->patientAgeUnit=="3"){
                            $LVADScore+=0.0274*floatval($row->patientAge)/360;
                        } else if($row->patientAgeUnit=="2"){
                             $LVADScore+=0.0274*floatval($row->patientAge)/12;
                        } else {
                             $LVADScore+=0.0274*floatval($row->patientAge);
                        }
                        
                          if(floatval($row->patientSerumCreatinine)>3.5 || $row->LVADDialysis=="Y") {
                           $LVADScore+=0.74*3.5;
               
             } else {
                                $LVADScore+=0.74*floatval($row->patientSerumCreatinine);
                 }
             
               if($row->LVADAlbumin!="" && $row->LVADAlbumin!="NA"){
              $LVADScore-=0.723*floatval($row->LVADAlbumin);
          //    alert(HMRSScore);
         }
         
           if($row->LVADINR!="" && $row->LVADINR!="NA"){
               if(floatval($row->LVADINR)>2.5){
                   $LVADScore+=1.136*2.5;
               } else {
              $LVADScore+=1.136*floatval($row->LVADINR);
              } 
            //  alert(HMRSScore);
         }
         
         
             $LVADScore+=$LVADHospitalScore*0.807;
           $LVADScore=round ($LVADScore,5);
           
           $this->PatientInformation_Model->update_patientLVAD($row->patientID,$LVADScore);
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
        $html.="<td>EuroScore II</td>";
        $html.="<td>Op Date</td>";
        $html.="<td>Surgeon 1</td>";
      
        $html.="<td>Diagnosis</td>";
        $html.="<td>Procedure</td>";
        $html.="</tr>";
        foreach($pList->result() as $row){
                $html.="<tr>";
        $html.="<td>".$row->patientChartNumber."</td>";
        $html.="<td>".$row->patientName."</td>";
        $html.="<td>".$row->euroScoreII."%</td>";
        $html.="<td>".$row->patientOpDate."</td>";
        $html.="<td>".$row->patientSurgeon."</td>";
        $html.="<td>";
        
         if($row->AdultDiagnosis1!='')
                $html.=$row->AdultDiagnosis1."<br/>"; 
          if($row->AdultDiagnosis2!='')
                $html.=$row->AdultDiagnosis2."<br/>";
          if($row->AdultDiagnosis3!='')
                $html.=$row->AdultDiagnosis3."<br/>";
          if($row->AdultDiagnosis4!='')
                $html.=$row->AdultDiagnosis4."<br/>";
          if($row->AdultDiagnosis5!='')
                $html.=$row->AdultDiagnosis5."<br/>";
          if($row->AdultDiagnosisOthers!='')
                $html.=$row->AdultDiagnosisOthers."<br/>";
          
            if($row->CongenitalDiagnosis1!='')
                $html.=$row->CongenitalDiagnosis1."<br/>"; 
                if($row->CongenitalDiagnosis2!='')
                $html.=$row->CongenitalDiagnosis2."<br/>"; 
                if($row->CongenitalDiagnosis3!='')
                $html.=$row->CongenitalDiagnosis3."<br/>"; 
                if($row->CongenitalDiagnosis4!='')
                $html.=$row->CongenitalDiagnosis4."<br/>"; 
                if($row->CongenitalDiagnosis5!='')
                $html.=$row->CongenitalDiagnosis5."<br/>"; 
                if($row->CongenitalProcedureOthers!='')
                $html.=$row->CongenitalProcedureOthers."<br/>"; 
        $html.="</td>";          
        $html.="<td>";
        if($row->operationCABG=='Y'){
                $html.="CABG(";
       if($row->operationLIMA!='' && $row->operationLIMA!='0' )
                $html.="LIMA:".$row->operationLIMA.",";       
       if($row->operationRIMA!='' && $row->operationRIMA!='0' )
                $html.="RIMA:".$row->operationRIMA.",";  
       if($row->operationRIMA_RadialA!='' && $row->operationRIMA_RadialA!='0' )
                $html.="Radial artery:".$row->operationRIMA_RadialA.",";  
       if($row->operationRIMA_GEA!='' && $row->operationRIMA_GEA!='0' )
                $html.="Gastroepiploic artery: ".$row->operationRIMA_GEA.",";  
       if($row->operationVeinGraft!='' && $row->operationVeinGraft!='0' )
                $html.="Vein graft: ".$row->operationVeinGraft.",";  
       $html.=")<br/>";
        }
        if($row->operationAorticValve=='Y'){
           //     $html.="Aortic valve surgery<br/>";
          if($row->operationAorticValve_AVP=='Y')
                $html.="AVP";
         if($row->operationAVP!='')
                $html.="(".$row->operationAVP.")"; 
         $html.="<br/>";
          if($row->operationAorticValve_AVR=='Y')
                $html.="AVR";
         if($row->operationAVRSelect!='')
                $html.="(".$row->operationAVRSelect.")"; 
         $html.="<br/>";
         if($row->operationMitralValveBentall=='Y')
                $html.="Bentall’s Op<br/>";
          }
        if($row->operationAorticSurgery=='Y'){
                $html.="Aortic surgery(";
        if($row->operationDissection=='Y')
                $html.="Dissection,";
        if($row->operationAneurysm=='Y')
                $html.="Aneurysm";
            $html.=")<br/>";
        }
        if($row->operationMitralValve=='Y'){
          //      $html.="Mitral valve surgery<br/>";
       if($row->Operation_MitralValve_MVP=='Y')
               $html.="MVP(";
        if($row->operationMVPRing=='Y')
                $html.="Ring,";
        if($row->operationMVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationMVPAnnularPlication=='Y')
                $html.="Annular plication";
        if($row->operationMVPLeafletResection=='Y')
                $html.="Leaflet resection";
         if($row->Operation_MitralValve_MVP=='Y')
        $html.=")<br/>";
       
       // if($row->operationMVPOthers=='Y')
          //      $html.="Mitral valve surgery Ohers<br/>";
        if($row->Operation_MitralValve_MVR=='Y')
                $html.="MVR";
         if($row->operationMVR!='')
                $html.="(".$row->operationMVR.")";
         $html.="<br/>";
        }
      if($row->operationArrythmiaSurgery=='Y'){
            //    $html.="Arrhythmia surgery<br/>";
         if($row->operationMazebiatrialLesion=='Y')
                $html.="Maze (";
          if($row->operationMazeLA=='Y')
                $html.="LA Maze (no RA lesion) ,";
           if($row->operationMazePVIwithLAA=='Y')
                $html.="PVI with LAA closure,";
            if($row->operationMazePVIwithoutLAA=='Y')
                $html.="PVI without LAA closure ,";
             if($row->operationMazeOthers=='Y')
                $html.="Maze Others,";
             // if($row->operationMazeEnergySource!='')
            //  $html.="Energy source";
                //$html.="Energy source:".$row->operationMazeEnergySource."";
                if($row->operationMazebiatrialLesion=='Y')
              $html.=")<br/>";
         }
        if($row->operationTricuspidValve=='Y'){
           //     $html.="Tricuspid valve surgery<br/>";
      if($row->Operation_TricuspidValve_TVP=='Y')
              $html.="TVP(";
        if($row->operationTVPRing=='Y')
                $html.="Ring,";
        if($row->operationTVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationTVPAnnularPlication=='Y')
                $html.="Annular plication,";
        if($row->operationTVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_TricuspidValve_TVP=='Y')
        $html.=")<br/>";
      
       // if($row->operationTVPOthers=='Y')
          //      $html.="Tricuspid valve surgery Ohers<br/>";
        if($row->Operation_TricuspidValve_TVR=='Y')
                $html.="TVR";
         if($row->operationTVR!='')
                $html.="(".$row->operationTVR.")";
         if($row->Operation_TricuspidValve_TVR=='Y')
         $html.="<br/>";
        }
                
        if($row->operationPulmonaryValve=='Y'){
         //       $html.="Pulmonary valve surgery<br/>";
        if($row->Operation_PulmonaryValve_PVP=='Y')
                $html.="PVP";
         if($row->operationPulmonaryValvePVP!='')
                $html.="(".$row->operationPulmonaryValvePVP.")";
         if($row->Operation_PulmonaryValve_PVP=='Y')
         $html.="<br/>";
        
       if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="PVR";
         if($row->operationPulmonaryValvePVR!='')
                $html.="(".$row->operationPulmonaryValvePVR.")";
                if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="<br/>";
       }
         
      //  if($row->operationHeartTransplantation=='Y')
          //      $html.="Heart transplant , Mechanical support:<br/>";
         if($row->operationHeartTransplantationOP=='Y')
                $html.="Heart transplant <br/>";
          if($row->operationHeartTransplantationLVAD=='Y')
                $html.="LVAD<br/>";
           if($row->operationHeartTransplantationRVAD=='Y')
                $html.="RVAD<br/>";
                   
        if($row->operationOtherCardiacSurgery1=='Y')
                $html.="Repair of Post-MI free wall rupture<br/>";
        if($row->operationOtherCardiacSurgery2=='Y')
                $html.="Repair of Post-MI ventricular septal defect (VSR)<br/>";
           if($row->operationOtherCardiacSurgery3=='Y')
                $html.=" Repair of traumatic cardiac rupture<br/>";
       if($row->operationOtherCardiacSurgery4=='Y')
                $html.=" Intracardiac tumor excision<br/>";
      if($row->operationOtherCardiacSurgery5=='Y')
                $html.="Septal myectomy<br/>";
      if($row->operationOtherCardiacSurgery6=='Y')
                $html.="Pericardiectomy<br/>";
      if($row->operationOtherCardiacSurgery7=='Y')
                $html.="LV aneurysm surgery<br/>";
      if($row->operationOtherCardiacSurgery8=='Y')
                $html.="Pulmonary embolectomy<br/>";
      if($row->operationOtherCardiacSurgery9=='Y')
                $html.="Pulmonary endarterectomy<br/>";
      if($row->operationOtherCardiacSurgery11=='Y')
                $html.="Cardiac Implantable Electronic Device lead insertion, replacement, or extraction<br/>";
      if($row->operationOtherCardiacSurgery10=='Y')
                $html.="Others<br/>";
     if($row->CongenitalProcedure1!='')
                $html.=$row->CongenitalProcedure1."<br/>"; 
     if($row->CongenitalProcedure2!='')
                $html.=$row->CongenitalProcedure2."<br/>"; 
     if($row->CongenitalProcedure3!='')
                $html.=$row->CongenitalProcedure3."<br/>"; 
     if($row->CongenitalProcedure4!='')
                $html.=$row->CongenitalProcedure4."<br/>"; 
     if($row->CongenitalProcedure5!='')
                $html.=$row->CongenitalProcedure5."<br/>"; 
     
      if($row->operationCABGMemo!='')
       $html.="<font color='red'>".$row->operationCABGMemo."</font><br/>"; 
         if($row->operationAorticMemo!='')
       $html.="<font color='red'>".$row->operationAorticMemo."</font><br/>"; 
           if($row->operationAorticSurgeryMemo!='')
       $html.="<font color='red'>".$row->operationAorticSurgeryMemo."</font><br/>"; 
         if($row->operationMVRMemo!='')
       $html.="<font color='red'>".$row->operationMVRMemo."</font><br/>"; 
         if($row->operationMazeMemo!='')
       $html.="<font color='red'>".$row->operationMazeMemo."</font><br/>"; 
           if($row->operationTricuspidValveMemo!='')
       $html.="<font color='red'>".$row->operationTricuspidValveMemo."</font><br/>"; 
             if($row->operationPulmonaryValveMemo!='')
       $html.="<font color='red'>".$row->operationPulmonaryValveMemo."</font><br/>"; 
               if($row->operationHeartTransplantationMemo!='')
       $html.="<font color='red'>".$row->operationHeartTransplantationMemo."</font><br/>"; 
                 if($row->operationOtherCardiacSurgeryMemo!='')
       $html.="<font color='red'>".$row->operationOtherCardiacSurgeryMemo."</font><br/>"; 
                 //瓣膜名稱
              if($row->AorticValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->AorticValveProductName."</font><br/>";     
               if($row->AorticValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->AorticValveProductType."</font><br/>";     
               
                if($row->MitralValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->MitralValveProductName."</font><br/>";     
               if($row->MitralValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->MitralValveProductType."</font><br/>";     
             
              if($row->TricuspidValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->TricuspidValveProductName."</font><br/>";     
               if($row->TricuspidValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->TricuspidValveProductType."</font><br/>";     
               
                if($row->PulmonaryValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->PulmonaryValveProductName."</font><br/>";     
               if($row->PulmonaryValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->PulmonaryValveProductType."</font><br/>";     
       
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