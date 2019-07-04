<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SyntaxscoreII extends CI_Controller {

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
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'homenew', 'refresh');
         
        $this->load->model('Analysis_Model');
        $this->load->helper('form');
    }
    
	public function index($pid)
	{
	   
        
        $data['page']="divPatientProfiles";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
       
        if($pid!='') {
           $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
        if($column->row()->SyntaxScoreDominance!='' && $column->row()->patientSyntaxScore!='')
                redirect(base_url().'syntaxscoreII/result/'.$pid, 'refresh');
        }
        
        $this->load->view('syntaxscoreII/start',$data);
	}
   public function step1($pid,$dominance)
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       
        if($pid!=''){
            $this->Syntaxscore_Model->wrieDominance($pid,$dominance);
        $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
         $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows()+1;  
        $data['LesionsID']=$column->num_rows()+1;  
        }
         
            if($dominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($dominance);
           $data['segment']=$column; 
         }
         $data['dominance']=$dominance;          
      $this->load->view('syntaxscoreII/step1',$data);
    }
       public function step2()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
            $mainPageScore=0;
            $secondPageScore=0;
            
       $dominance=$this->input->post('dominance');
       $patientID=$this->input->post('patientID');
       
       
        if($patientID!=''){
            $this->Syntaxscore_Model->wrieDominance($patientID,$dominance);
        $column = $this->PatientInformation_Model->viewRecord($patientID);
        $data['myContent']=$column;    
        $column = $this->Syntaxscore_Model->getScorebyPatient($patientID);
        $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows()+1;  
        $data['LesionsID']=$column->num_rows()+1;  
        }
         
            if($dominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($dominance);
           $data['segment']=$column; 
         }
            foreach($column->result() as $row){
                $checkSeg[$row->syntaxScoreSegment]=$this->input->post('check_'.$row->syntaxScoreSegment);
           if($checkSeg[$row->syntaxScoreSegment]=="1"){
                     $mainPageScore += $this->Syntaxscore_Model->getStep1Score($dominance,$row->syntaxScoreSegment)->row()->score;
                     }
            }

         $data['dominance']=$dominance;        
         $data['mainPageScore']=$mainPageScore; 
         $data['secondPageScore']=$secondPageScore; 
         $data['patientID']=$patientID;  
         $data['chooseSeg']=$checkSeg;    
          $this->load->view('syntaxscoreII/step2',$data);
    }

public function step3()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
            $mainPageScore=0;
            
       $dominance=$this->input->post('dominance');
       $patientID=$this->input->post('patientID');
       $mainPageScore=   $this->input->post('step1_Score');
       $secondPageScore=   $this->input->post('step2_Score');
       $sid=   $this->input->post('sid');
       if($sid=="0"){
           //新增
          $this->load->library('syntaxscoreClass');
              $syntaxscoreClass= new syntaxscoreClass;
              $syntaxscoreClass->pid=$patientID;
             $syntaxscoreClass->LesionsID=$this->input->post('LesionsID');   
             $syntaxscoreClass->q1=$this->input->post('f1');   
             $syntaxscoreClass->q2=$this->input->post('f2'); 
             $syntaxscoreClass->q3=$this->input->post('f3'); 
             $syntaxscoreClass->q4=$this->input->post('f4'); 
             $syntaxscoreClass->q16=$this->input->post('f16'); 
             $syntaxscoreClass->q16a=$this->input->post('f16a'); 
             $syntaxscoreClass->q16b=$this->input->post('f16b'); 
             $syntaxscoreClass->q16c=$this->input->post('f16c'); 
             $syntaxscoreClass->q5=$this->input->post('f5'); 
             $syntaxscoreClass->q6=$this->input->post('f6'); 
             $syntaxscoreClass->q7=$this->input->post('f7'); 
             $syntaxscoreClass->q8=$this->input->post('f8'); 
             $syntaxscoreClass->q9=$this->input->post('f9'); 
             $syntaxscoreClass->q9a=$this->input->post('f9a'); 
             $syntaxscoreClass->q10=$this->input->post('f10'); 
             $syntaxscoreClass->q10a=$this->input->post('f10a'); 
             $syntaxscoreClass->q11=$this->input->post('f11'); 
             $syntaxscoreClass->q12=$this->input->post('f12'); 
             $syntaxscoreClass->q12a=$this->input->post('f12a'); 
             $syntaxscoreClass->q12b=$this->input->post('f12b'); 
             $syntaxscoreClass->q13=$this->input->post('f13'); 
             $syntaxscoreClass->q14=$this->input->post('f14'); 
             $syntaxscoreClass->q14a=$this->input->post('f14a'); 
             $syntaxscoreClass->q14b=$this->input->post('f14b'); 
             $syntaxscoreClass->q15=$this->input->post('f15');  
           
           $syntaxscoreClass->u4=$this->input->post('q4');
           $syntaxscoreClass->u4i=$this->input->post('q4i');
           $syntaxscoreClass->u4ii=$this->input->post('q4ii');
           $syntaxscoreClass->u4iii=$this->input->post('q4iii');
           $syntaxscoreClass->u4iv=$this->input->post('q4iv');
           $syntaxscoreClass->u4v=$this->input->post('q4v');
           $syntaxscoreClass->u4vi=$this->input->post('q4vi');
           $syntaxscoreClass->u5=$this->input->post('q5');
           $syntaxscoreClass->u5i=$this->input->post('q5i');
           $syntaxscoreClass->u6=$this->input->post('q6');
           $syntaxscoreClass->u6i=$this->input->post('q6i');
           $syntaxscoreClass->u6ii=$this->input->post('q6ii');
           $syntaxscoreClass->u7=$this->input->post('q7');
           $syntaxscoreClass->u8=$this->input->post('q8');
           $syntaxscoreClass->u9=$this->input->post('q9');
           $syntaxscoreClass->u10=$this->input->post('q10');
           $syntaxscoreClass->u11=$this->input->post('q11');
           $syntaxscoreClass->ucomment=$this->input->post('ucomment');
           
           $syntaxscoreClass->step1_Score=floatval($this->input->post('step1Score'));
           $syntaxscoreClass->step2_Score=floatval($this->input->post('step2Score'));
           $syntaxscoreClass->Q4Score=floatval($this->input->post('Q4Score'));
           
             $this->Syntaxscore_Model->Save_SyntaxScore($syntaxscoreClass);
             } else {
                 //修改
                 $this->load->library('syntaxscoreClass');
            $syntaxscoreClass= new syntaxscoreClass;
            $syntaxscoreClass=  $this->Syntaxscore_Model->getScorebyPatientID($sid)->row();
            $syntaxscoreClass->pid=$patientID;
             $syntaxscoreClass->LesionsID=$this->input->post('LesionsID');   
             $syntaxscoreClass->q1=$this->input->post('f1');   
             $syntaxscoreClass->q2=$this->input->post('f2'); 
             $syntaxscoreClass->q3=$this->input->post('f3'); 
             $syntaxscoreClass->q4=$this->input->post('f4'); 
             $syntaxscoreClass->q16=$this->input->post('f16'); 
             $syntaxscoreClass->q16a=$this->input->post('f16a'); 
             $syntaxscoreClass->q16b=$this->input->post('f16b'); 
             $syntaxscoreClass->q16c=$this->input->post('f16c'); 
             $syntaxscoreClass->q5=$this->input->post('f5'); 
             $syntaxscoreClass->q6=$this->input->post('f6'); 
             $syntaxscoreClass->q7=$this->input->post('f7'); 
             $syntaxscoreClass->q8=$this->input->post('f8'); 
             $syntaxscoreClass->q9=$this->input->post('f9'); 
             $syntaxscoreClass->q9a=$this->input->post('f9a'); 
             $syntaxscoreClass->q10=$this->input->post('f10'); 
             $syntaxscoreClass->q10a=$this->input->post('f10a'); 
             $syntaxscoreClass->q11=$this->input->post('f11'); 
             $syntaxscoreClass->q12=$this->input->post('f12'); 
             $syntaxscoreClass->q12a=$this->input->post('f12a'); 
             $syntaxscoreClass->q12b=$this->input->post('f12b'); 
             $syntaxscoreClass->q13=$this->input->post('f13'); 
             $syntaxscoreClass->q14=$this->input->post('f14'); 
             $syntaxscoreClass->q14a=$this->input->post('f14a'); 
             $syntaxscoreClass->q14b=$this->input->post('f14b'); 
             $syntaxscoreClass->q15=$this->input->post('f15');  
           
           $syntaxscoreClass->u4=$this->input->post('q4');
           $syntaxscoreClass->u4i=$this->input->post('q4i');
           $syntaxscoreClass->u4ii=$this->input->post('q4ii');
           $syntaxscoreClass->u4iii=$this->input->post('q4iii');
           $syntaxscoreClass->u4iv=$this->input->post('q4iv');
           $syntaxscoreClass->u4v=$this->input->post('q4v');
           $syntaxscoreClass->u4vi=$this->input->post('q4vi');
           $syntaxscoreClass->u5=$this->input->post('q5');
           $syntaxscoreClass->u5i=$this->input->post('q5i');
           $syntaxscoreClass->u6=$this->input->post('q6');
           $syntaxscoreClass->u6i=$this->input->post('q6i');
           $syntaxscoreClass->u6ii=$this->input->post('q6ii');
           $syntaxscoreClass->u7=$this->input->post('q7');
           $syntaxscoreClass->u8=$this->input->post('q8');
           $syntaxscoreClass->u9=$this->input->post('q9');
           $syntaxscoreClass->u10=$this->input->post('q10');
           $syntaxscoreClass->u11=$this->input->post('q11');
           $syntaxscoreClass->ucomment=$this->input->post('ucomment');
           
           $syntaxscoreClass->step1_Score=floatval($this->input->post('step1Score'));
           $syntaxscoreClass->step2_Score=floatval($this->input->post('step2Score'));
           $syntaxscoreClass->Q4Score=floatval($this->input->post('Q4Score'));
           
             $this->Syntaxscore_Model->Update_SyntaxScoreBySID($sid,$syntaxscoreClass);
             }
             
        if($patientID!=''){
            $this->Syntaxscore_Model->wrieDominance($patientID,$dominance);
        $column = $this->PatientInformation_Model->viewRecord($patientID);
        $data['myContent']=$column;    
          $column = $this->Syntaxscore_Model->getScorebyPatient($patientID);
        $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows();  
        $data['LesionsID']=$column->num_rows(); 
        }
         
            if($dominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($dominance);
           $data['segment']=$column; 
         }
            foreach($column->result() as $row){
                $checkSeg[$row->syntaxScoreSegment]=$this->input->post('check_'.$row->syntaxScoreSegment);
           if($checkSeg[$row->syntaxScoreSegment]=="1"){
                     $mainPageScore += $this->Syntaxscore_Model->getStep1Score($dominance,$row->syntaxScoreSegment)->row()->score;
                     }
            }

         $data['dominance']=$dominance;        
         $data['mainPageScore']=$mainPageScore; 
         $data['mainPageScore']=$mainPageScore; 
         $data['secondPageScore']=$secondPageScore; 
         $data['patientID']=$patientID;  
         $data['chooseSeg']=$checkSeg;    
          $this->load->view('syntaxscoreII/step3',$data);
    }

    public function step4()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
            $mainPageScore=0;
            $secondPageScore=0;
            $MaxLesionsID="1";
            
       $dominance=$this->input->post('dominance');
       $patientID=$this->input->post('patientID');
       $LesionsID=$this->input->post('LesionsID');
       
        if($patientID!=''){
            $this->Syntaxscore_Model->wrieDominance($patientID,$dominance);
        $column = $this->PatientInformation_Model->viewRecord($patientID);
        $data['myContent']=$column;    
          $column = $this->Syntaxscore_Model->getScorebyPatient($patientID);
        $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows();  
        
        foreach($column->result() as $row){
            $MaxLesionsID= $row->LesionsID;
        $checkSeg[$row->LesionsID]['1']=$row->q1;
        $checkSeg[$row->LesionsID]['2']=$row->q2;
        $checkSeg[$row->LesionsID]['3']=$row->q3;
        $checkSeg[$row->LesionsID]['4']=$row->q4;
        $checkSeg[$row->LesionsID]['16']=$row->q16;
        $checkSeg[$row->LesionsID]['16a']=$row->q16a;
        $checkSeg[$row->LesionsID]['16b']=$row->q16b;
        $checkSeg[$row->LesionsID]['16c']=$row->q16c;
        $checkSeg[$row->LesionsID]['5']=$row->q5;
        $checkSeg[$row->LesionsID]['6']=$row->q6;
        $checkSeg[$row->LesionsID]['7']=$row->q7;
        $checkSeg[$row->LesionsID]['8']=$row->q8;
        $checkSeg[$row->LesionsID]['9']=$row->q9;
        $checkSeg[$row->LesionsID]['9a']=$row->q9a;
        $checkSeg[$row->LesionsID]['10']=$row->q10;
        $checkSeg[$row->LesionsID]['10a']=$row->q10a;
        $checkSeg[$row->LesionsID]['11']=$row->q11;
        $checkSeg[$row->LesionsID]['12']=$row->q12;
        $checkSeg[$row->LesionsID]['12a']=$row->q12a;
        $checkSeg[$row->LesionsID]['12b']=$row->q12b;
        $checkSeg[$row->LesionsID]['13']=$row->q13;
        $checkSeg[$row->LesionsID]['14']=$row->q14;
        $checkSeg[$row->LesionsID]['14a']=$row->q14a;
        $checkSeg[$row->LesionsID]['14b']=$row->q14b;
        $checkSeg[$row->LesionsID]['15']=$row->q15;
        $secondScore[$row->LesionsID]=$row->step2_Score;
           }
        }
         
            if($dominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($dominance);
           $data['segment']=$column; 
         }
            $L1="0";
        $L2="0";
        $L3="0";
        $L4="0";    
            foreach($column->result() as $row){
                if($checkSeg[$MaxLesionsID][$row->syntaxScoreSegment]=="1"){
                if($row->syntaxScoreSegmentCategory=="RCA")
                $L1="1";
           if($row->syntaxScoreSegmentCategory=="LM"){
                $L2="1";
               $L3="1";
               $L4="1";
           }
                  if($row->syntaxScoreSegmentCategory=="LAD")
                $L3="1";
                   if($row->syntaxScoreSegmentCategory=="LCX")
                $L4="1";
                
           $mainPageScore += $this->Syntaxscore_Model->getStep1Score($dominance,$row->syntaxScoreSegment)->row()->score;
           $secondPageScore=$secondScore[$MaxLesionsID];
                     }
            }

         $data['dominance']=$dominance;        
         $data['mainPageScore']=$mainPageScore; 
         $data['secondPageScore']=$secondPageScore; 
         $data['thirdPageScore']=0;
         $data['patientID']=$patientID;  
         $data['LesionsID']=$MaxLesionsID;
         $data['chooseSeg']=$checkSeg;  
         $data['L1']=$L1;
         $data['L2']=$L2;
         $data['L3']=$L3;
         $data['L4']=$L4;
          $this->load->view('syntaxscoreII/step4',$data);
    }

public function step5()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
            $mainPageScore=0;
            
       $dominance=$this->input->post('dominance');
       $patientID=$this->input->post('patientID');
       $LesionsID=$this->input->post('LesionsID');
       $this->load->library('syntaxscoreClass');
             $syntaxscoreClass= new syntaxscoreClass;
             $syntaxscoreClass=$this->Syntaxscore_Model->getScorebyPatientLesionsID($patientID,$LesionsID)->row();
             $sid=$syntaxscoreClass->sid;
             $syntaxscoreClass->u12=$this->input->post('q12');   
             $syntaxscoreClass->s1=$this->input->post('q12i_1');   
             $syntaxscoreClass->s2=$this->input->post('q12i_2'); 
             $syntaxscoreClass->s3=$this->input->post('q12i_3'); 
             $syntaxscoreClass->s4=$this->input->post('q12i_4'); 
             $syntaxscoreClass->s16=$this->input->post('q12i_16'); 
             $syntaxscoreClass->s16a=$this->input->post('q12i_16a'); 
             $syntaxscoreClass->s16b=$this->input->post('q12i_16b'); 
             $syntaxscoreClass->s16c=$this->input->post('q12i_16c'); 
             $syntaxscoreClass->s5=$this->input->post('q12i_5'); 
             $syntaxscoreClass->s6=$this->input->post('q12i_6'); 
             $syntaxscoreClass->s7=$this->input->post('q12i_7'); 
             $syntaxscoreClass->s8=$this->input->post('q12i_8'); 
             $syntaxscoreClass->s9=$this->input->post('q12i_9'); 
             $syntaxscoreClass->s9a=$this->input->post('q12i_9a'); 
             $syntaxscoreClass->s10=$this->input->post('q12i_10'); 
             $syntaxscoreClass->s10a=$this->input->post('q12i_10a'); 
             $syntaxscoreClass->s11=$this->input->post('q12i_11'); 
             $syntaxscoreClass->s12=$this->input->post('q12i_12'); 
             $syntaxscoreClass->s12a=$this->input->post('q12i_12a'); 
             $syntaxscoreClass->s12b=$this->input->post('q12i_12b'); 
             $syntaxscoreClass->s13=$this->input->post('q12i_13'); 
             $syntaxscoreClass->s14=$this->input->post('q12i_14'); 
             $syntaxscoreClass->s14a=$this->input->post('q12i_14a'); 
             $syntaxscoreClass->s14b=$this->input->post('q12i_14b'); 
             $syntaxscoreClass->s15=$this->input->post('q12i_15');  
         
           
           $syntaxscoreClass->step3_Score=floatval($this->input->post('step3Score'));
           $this->Syntaxscore_Model->update_SyntaxScore($sid,$syntaxscoreClass);
                $this->PatientInformation_Model->update_SyntaxScore($patientID,floatval($this->input->post('step1Score'))+floatval($this->input->post('step2Score'))+floatval($this->input->post('step3Score')));
           
         //  $this->Syntaxscore_Model->update_SyntaxScore($sid,$syntaxscoreClass);
             
         
           redirect(base_url().'syntaxscoreII/result/'.$patientID, 'refresh');
    }

public function result($pid)
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       
         if($pid!=''){
             $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
        $data['TotalLesion']= $column->num_rows();  
        $data['LesionsID']=$column->num_rows(); 
          if($data['myContent']->row()->SyntaxScoreDominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($data['myContent']->row()->SyntaxScoreDominance);
           $data['segment']=$column; 
         }
         }
         
         $this->load->view('syntaxscoreII/result',$data);
    }
    
    public function edit($pid)
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       
         if($pid!=''){
            $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column; 
        if($column->num_rows()==0) 
        redirect(base_url().'syntaxscoreII/index/'.$pid, 'refresh');
         $data['TotalLesion']= $column->num_rows();  
        $data['LesionsID']=$column->num_rows();  
        
          if($data['myContent']->row()->SyntaxScoreDominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($data['myContent']->row()->SyntaxScoreDominance);
           $data['segment']=$column; 
         }
         }
         
         $this->load->view('syntaxscoreII/edit',$data);
    }
    
       public function add()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       $pid=$this->input->post('patientID');  
        if($pid!=''){
            
        $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
         $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows()+1;  
        $data['LesionsID']=$column->num_rows()+1;  
        }
         
            if($data['myContent']->row()->SyntaxScoreDominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($data['myContent']->row()->SyntaxScoreDominance);
           $data['segment']=$column; 
         }
         $data['dominance']=$data['myContent']->row()->SyntaxScoreDominance; 
                  
      $this->load->view('syntaxscoreII/step1',$data);
    }

 public function delete()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       $pid=$this->input->post('patientID');  
       $sid=$this->input->post('deleteID');  
        if($sid!=''){
            
            $this->Syntaxscore_Model->deleteScore($sid,$pid);
       
        }
         
           redirect(base_url().'syntaxscoreII/edit/'.$pid, 'refresh'); 
    }
    
    function modify(){
         $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
        
         $pid=$this->input->post('patientID');  
          $sid=$this->input->post('modifyID'); 
          $dominance=$this->input->post('dominance'); 
        if($pid!=''){
            $this->Syntaxscore_Model->wrieDominance($pid,$dominance);
        $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
         $column = $this->Syntaxscore_Model->getScorebyPatientID($sid);
         $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows();  
         $data['LesionsID']=$column->row()->LesionsID;  
        }
         
            if($dominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($dominance);
           $data['segment']=$column; 
         }
         $data['dominance']=$dominance;          
      $this->load->view('syntaxscoreII/Mstep1',$data);
    }

 public function Mstep2()
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
            $mainPageScore=0;
            $secondPageScore=0;
            
       $dominance=$this->input->post('dominance');
       $patientID=$this->input->post('patientID');
       $sid=$this->input->post('sid'); 
       
        if($patientID!=''){
            $this->Syntaxscore_Model->wrieDominance($patientID,$dominance);
        $column = $this->PatientInformation_Model->viewRecord($patientID);
        $data['myContent']=$column;    
         $column = $this->Syntaxscore_Model->getScorebyPatientID($sid);
        $data['myScore']=$column;  
         $data['TotalLesion']= $column->num_rows();  
        $data['LesionsID']=$column->row()->LesionsID;  
        }
         
            if($dominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($dominance);
           $data['segment']=$column; 
         }
            foreach($column->result() as $row){
                $checkSeg[$row->syntaxScoreSegment]=$this->input->post('check_'.$row->syntaxScoreSegment);
           if($checkSeg[$row->syntaxScoreSegment]=="1"){
                     $mainPageScore += $this->Syntaxscore_Model->getStep1Score($dominance,$row->syntaxScoreSegment)->row()->score;
                     }
            }

         $data['dominance']=$dominance;        
         $data['mainPageScore']=$mainPageScore; 
         $data['secondPageScore']=$secondPageScore; 
         $data['patientID']=$patientID;  
         $data['chooseSeg']=$checkSeg;    
          $this->load->view('syntaxscoreII/Mstep2',$data);
    }

public function pdf($pid)
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       
         if($pid!=''){
             $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
        $data['TotalLesion']= $column->num_rows();  
        $data['LesionsID']=$column->num_rows(); 
          if($data['myContent']->row()->SyntaxScoreDominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($data['myContent']->row()->SyntaxScoreDominance);
           $data['segment']=$column; 
         }
         }
         
         $this->load->view('syntaxscoreII/pdf',$data);
    }

public function copy($pid)
    {
            $data['page']="index";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
        $this->load->model('Syntaxscore_Model'); 
       
         if($pid!=''){
             $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
        $column = $this->Syntaxscore_Model->getScorebyPatient($pid);
        $data['myScore']=$column;  
        $data['TotalLesion']= $column->num_rows();  
        $data['LesionsID']=$column->num_rows(); 
          if($data['myContent']->row()->SyntaxScoreDominance!=""){
                 $column = $this->Syntaxscore_Model->getSegment($data['myContent']->row()->SyntaxScoreDominance);
           $data['segment']=$column; 
         }
         }
         
         $this->load->view('syntaxscoreII/copy',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */