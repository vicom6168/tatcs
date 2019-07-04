<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExportPatient extends CI_Controller {

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
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
         
        $this->load->model('Analysis_Model');
        $this->load->helper('form');
    }
    
public function index()
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
        
     $d1=$this->input->post('qDate1')==null?"1900-01-01":$this->input->post('qDate1');
     $d2=$this->input->post('qDate2')==null?"1900-01-01":$this->input->post('qDate2');
     $h1=$this->input->post('patientHospital')==null?"":$this->input->post('patientHospital');
     $t1=$this->input->post('datatype1')==null?"N":$this->input->post('datatype1');
     $t2=$this->input->post('datatype2')==null?"N":$this->input->post('datatype2');
     $t3=$this->input->post('datatype3')==null?"N":$this->input->post('datatype3');
     $v=$this->input->post('dataversion')==null?"0":$this->input->post('dataversion');
   
     
        $data['result_msg']='';
        $data['patientList']='';
        $data['patientList']=null;
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
      if( $d1!='' &&  $d2!='' && $v!='0'){
        $data['patientList']=$this->PatientInformation_Model->export_patientlist($d1,$d2,$h1,$t1,$t2,$t3,$v);
      $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料匯出 (期間:'.$d1.'~'.$d2.')','S');
      }
         $this->load->model('user_Model');
        $userDetail=$this->user_Model->query_user($this->session->userdata('userID'))->row();
        
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
    
    if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
    
    $data['h1']=$h1;
    
    $data['t1']=$t1;
    $data['t2']=$t2;
    $data['t3']=$t3;
    
    $data['v']=$v;
  
    
    $data['p1']=$userDetail->exportVersion1;
    $data['p2']=$userDetail->exportVersion2;
    $data['p3']=$userDetail->exportVersion3;
    $data['p4']=$userDetail->exportVersion4;
    $data['p5']=$userDetail->exportVersion5;
    
        $data['page']="export";    
        $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;</li><li>病患資料列表</li>";
        $this->load->view('exportpatient/query',$data);
    }
   
     
     public function EXCEL($d1,$d2,$h1, $t1, $t2, $t3,$v)
    {
         $this->load->model('PatientInformation_Model');
         $permit=0;
         //檢查權限
         $this->load->model('user_Model');
         $userDetail=$this->user_Model->query_user($this->session->userdata('userID'))->row();
         $data['p1']=$userDetail->exportVersion1;
    $data['p2']=$userDetail->exportVersion2;
    $data['p3']=$userDetail->exportVersion3;
    $data['p4']=$userDetail->exportVersion4;
    $data['p5']=$userDetail->exportVersion5;
      if($v!='0'){
              
          
          if(($v=='1' && $userDetail->exportVersion1=='Y') || ($v=='2' && $userDetail->exportVersion2=='Y') || ($v=='3' && $userDetail->exportVersion3=='Y') || ($v=='4' && $userDetail->exportVersion4=='Y') || ($v=='5' && $userDetail->exportVersion5=='Y')  ) {
              $permit=1;
             }
         }
     
     $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     
     $data['d1']=$d1;
     $data['d2']=$d2;
     $data['h1']=$h1;
     $data['t1']=$t1;
     $data['t2']=$t2;
     $data['t3']=$t3;
     $data['v']=$v;
      if($permit==1){
     $data['patientList']=$this->PatientInformation_Model->export_patientlistCVS($d1,$d2,$h1, $t1, $t2, $t3,$v);
          $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料EXCEL匯出 (期間:'.$d1.'~'.$d2.')','S');
     
        $this->load->view('exportpatient/EXCEL',$data);
      } else {
          $this->load->view('exportpatient/nopermit',$data);
      }
      
     
    }
  public function EXCELResident($d1,$d2,$h1, $t1, $t2, $t3,$v)
    {
         $this->load->model('PatientInformation_Model');
          $this->load->model('Analysis_Model');
         $permit=0;
         //檢查權限
         $this->load->model('user_Model');
         $userDetail=$this->user_Model->query_user($this->session->userdata('userID'))->row();
         $data['p1']=$userDetail->exportVersion1;
    $data['p2']=$userDetail->exportVersion2;
    $data['p3']=$userDetail->exportVersion3;
    $data['p4']=$userDetail->exportVersion4;
    $data['p5']=$userDetail->exportVersion5;
      if($v!='0'){
              
          
          if($v=='6' && ($this->session->userdata('userRole')=="2" || $this->session->userdata('userRole')=="3")) {
              $permit=1;
             }
         }
     
     $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     
     $data['d1']=$d1;
     $data['d2']=$d2;
     $data['h1']=$h1;
     $data['t1']=$t1;
     $data['t2']=$t2;
     $data['t3']=$t3;
     $data['v']=$v;
      if($permit==1){
     $data['patientList']=$this->PatientInformation_Model->export_patientlistCVS($d1,$d2,$h1, $t1, $t2, $t3,$v);
          
         //第三個sheet
         $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     $data['ans1']='0';
     $data['ans2']='0';
     $data['ans3']='0';
     $data['ans4']='0';
     $data['ans5']='0';
     $data['ans6']='0';
     $data['ans7']='0';
     $data['ans8']='0';
     $data['ans9']='0';
     $data['ans10']='0';
     $data['ans11']='0';
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     $data['a10']='0';
     $data['a11']='0';
     $data['a12']='0';
     $data['a13']='0';
     $data['a14']='0';
     $data['a15']='0';
     $data['a16']='0';
     $data['a17']='0';
     $data['a18']='0';
     
     $data['a_a1']='0';
     $data['a_a2']='0';
     $data['a_a3']='0';
     $data['a_a4']='0';
     $data['a_a5']='0';
     $data['a_a6']='0';
     $data['a_a7']='0';
     $data['a_a8']='0';
     $data['a_a9']='0';
     $data['a_a10']='0';
     $data['a_a11']='0';
     $data['a_a12']='0';
     $data['a_a13']='0';
     $data['a_a14']='0';
     $data['a_a15']='0';
     $data['a_a16']='0';
     $data['a_a17']='0';
     $data['a_a18']='0';
     $data['a_a19']='0';
     $data['a_b4']='0';
     $data['a_b5']='0';
     $data['a_b6']='0';
     $data['a_b7']='0';
     $data['a_b8']='0';
     $data['a_b9']='0';
     $data['a_b10']='0';
     $data['a_b11']='0';
     $data['a_b12']='0';
     $data['a_b13']='0';
     $data['a_b14']='0';
     $data['a_b15']='0';
     $data['a_b16']='0';
     $data['a_b17']='0';
     $data['a_b18']='0';
     $data['a_b19']='0';
    
       $data['total']=$this->Analysis_Model->query_executivesummary_Resident($d1,$d2,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary_Resident($d1,$d2,'2')->row()->num;
     $data['Noncardiac']='0';
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'1')->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'2')->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'3')->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'4')->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'5')->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'6')->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'7')->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'8')->row()->num;
     $data['ans9']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'9')->row()->num;
     $data['ans10']=$this->Analysis_Model->query_executivesummarydetail_Resident($d1,$d2,'10')->row()->num;
     $data['ans11']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8']-$data['ans9']-$data['ans10'];
     
     $data['a1']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'17')->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2_Resident($d1,$d2,'18')->row()->num;
     
      $data['a_adult']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'0')->row()->num; 
     $data['a_a1']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'1')->row()->num;
     $data['a_a2']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'2')->row()->num;
     $data['a_a3']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'3')->row()->num;
     $data['a_a4']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'4')->row()->num;
     $data['a_a5']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'5')->row()->num;
     $data['a_a6']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'6')->row()->num;
     $data['a_a7']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'7')->row()->num;
     $data['a_a8']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'8')->row()->num;
     $data['a_a9']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'9')->row()->num;
     $data['a_a10']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'10')->row()->num;
     $data['a_a11']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'11')->row()->num;
     $data['a_a12']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'12')->row()->num;
     $data['a_a13']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'13')->row()->num;
     $data['a_a14']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'14')->row()->num;
     $data['a_a15']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'15')->row()->num;
     $data['a_a16']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'16')->row()->num;
     $data['a_a17']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'17')->row()->num;
     $data['a_b4']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'4')->row()->num;
     $data['a_b5']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'5')->row()->num;
     $data['a_b6']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'6')->row()->num;
     $data['a_b7']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'7')->row()->num;
     $data['a_b8']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'8')->row()->num;
     $data['a_b9']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'9')->row()->num;
     $data['a_b10']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'10')->row()->num;
     $data['a_b11']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'11')->row()->num;
     $data['a_b12']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'12')->row()->num;
     $data['a_b13']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'13')->row()->num;
     $data['a_b14']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'14')->row()->num;
     $data['a_b15']=$this->Analysis_Model->query_executivesummarychildPure_Resident($d1,$d2,'15')->row()->num;
     $data['a_b16']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'16')->row()->num;
     $data['a_b17']=$this->Analysis_Model->query_executivesummarychild_Resident($d1,$d2,'17')->row()->num;
           
          $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料EXCEL匯出 (期間:'.$d1.'~'.$d2.')','S');
     
        $this->load->view('exportpatient/EXCELResident',$data);
      } else {
          $this->load->view('exportpatient/nopermit',$data);
      }
      
     
    }
    public function exportVascularPatient()
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
        
     $d1=$this->input->post('qDate1')==null?"1900-01-01":$this->input->post('qDate1');
     $d2=$this->input->post('qDate2')==null?"1900-01-01":$this->input->post('qDate2');
     $h1=$this->input->post('patientHospital')==null?"":$this->input->post('patientHospital');
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('homenew',$data);
         $this->load->model('Vascular_Model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->Vascular_Model->export_patientVascularlist($d1,$d2,$h1);
        $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患Vascular資料匯出 (期間:'.$d1.'~'.$d2.')','S');
      }
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
     if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
     $data['h1']=$h1;
      $data['page']="specialsheet";    
        $data['subpage']="Vascular";   
        $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;Vascular</li><li  class='break'>&#187;</li><li>病患資料列表</li>";
        $this->load->view('exportpatient/queryVascular',$data);
    }
   
     
     public function VascularEXCEL($d1,$d2,$h1)
    {
         $this->load->model('Vascular_Model');
        $data['patientList']=$this->Vascular_Model->export_patientVascularlistCVS($d1,$d2,$h1);
      $data['page']="specialsheet";    
        $data['subpage']="Vascular"; 
     $data['path']="<li>統計報表</li><li  class='break'>&#187;Vascular</li><li  class='break'>&#187;</li>";
     
     $data['d1']=$d1;
     $data['d2']=$d2;
     $data['h1']=$h1;
     $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'Vascular 病患資料EXCEL匯出 (期間:'.$d1.'~'.$d2.')','S');
     
        $this->load->view('exportpatient/EXCELVascular',$data);
    }  
   
    public function inFile()
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
         $data['result_msg']='';
         $data['error_msg']='';
        $data['patientList']='';
     
        $data['page']="export";    
        $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;</li><li>病患資料匯入</li>";
        $this->load->view('exportpatient/inFile',$data);
    }
   public function uploadFile(){
       require_once './application/libraries/Classes/PHPExcel.php';
       $objPHPExcel = new PHPExcel();
        $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
         $data['result_msg']='';
         $data['error_msg']='';
        $data['patientList']='';
         $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'xlsx';
      $config['max_size']   = '30000';
      $config['file_name']  = "A".time(); 
    //echo $_FILES['abanner']['tmp_name'];
  //  echo "1<br/>";
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
      //  echo $_FILES['uploadPatient']['tmp_name']."<br/>";
        //echo $_FILES['uploadPatient']['name']."<br/>";
        if (isset($_FILES['uploadPatient']['tmp_name']) && $_FILES['uploadPatient']['tmp_name']!="" && $this->upload->do_upload("uploadPatient"))
        {
            $error = array('error' => $this->upload->display_errors());
            if($this->upload->display_errors()==""){
             //   echo "2.1<br/>";
                     if ( !$fp = fopen('./uploads/'.$config['file_name'].'.xlsx' ,"r") ) {
                       $data['error_msg'].= "<font color='red'>無法打開檔案</font><br/>";
                 
                }else{
                    
                                $size = filesize('./uploads/'.$config['file_name'].'.xlsx')+1;
                      $row=0;
                      $error="0";
                   //   echo "打開檔案:".$size;
                      
                      $file='./uploads/'.$config['file_name'].'.xlsx';
                      
                      try {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
                 $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $worksheetNames = $objPHPExcel->getSheetNames($file);
$return = array();
$i=0;
foreach($worksheetNames as $key => $sheetName){
//set the current active worksheet by name
$objPHPExcel->setActiveSheetIndexByName($sheetName);
//create an assoc array with the sheet name as key and the sheet contents array as value
$return[$sheetName] = $objPHPExcel->getActiveSheet()->toArray(null, true,true,true);
//echo $sheetName."<br/>";
$rowindex =0;
$title = array();
$tdata = array();
$arrayKey=array(
"patientHospital",
"patientSSN",
"patientChartNumber",
"patientName",
"patientBirthday",
"patientAge",
"patientAgeUnit",
"patientGender",
"patientSurgeon",
"patientSurgeon2",
"patientSurgeon3",
"patientSurgeon4",
"patientSurgeon_id",
"patientSurgeon_id2",
"patientSurgeon_id3",
"patientSurgeon_id4",
"patientSurgeon_associalid",
"patientSurgeon_associalid2",
"patientSurgeon_associalid3",
"patientSurgeon_associalid4",
"patientReoperation",
"patientOpDate",
"isDeleted",
"patientDischargeDate",
"patientOpenHeartSurgery",
"patientCongenitalSurgery",
"patientNonOpenHeart",
"patientDiagnosis",
"patientSyntaxScore",
"patientSyntaxScoreContent",
"patientSyntaxScoreTable",
"patientAssociatedDisease",
"patientBodyWeight",
"patientSerumCreatinine",
"pastHistoryRenalImpairment",
"CcrberforOperation",
"pastHistoryExtracardiacArteriopathy",
"pastHistoryPoorMobility",
"pastHistoryPreviousCardiacSurgery",
"pastHistoryChronicLungDisease",
"pastHistoryActiveEndocarditis",
"pastHistoryCriticalPreoperativeState",
"pastHistoryDiabetesOnInsulin",
"pastHistoryNYHA",
"pastHistoryCCSClass4Angina",
"pastHistoryLVFunction",
"pastHistoryRecentMI",
"pastHistoryPulmonaryHypertension",
"pastHistoryUrgency",
"pastHistoryWeightOfTheIntervention",
"pastHistorySurgeryThoracicAorta",
"euroScoreII",
"operationAssociateCategory",
"AdultDiagnosis1",
"AdultDiagnosis2",
"AdultDiagnosis3",
"AdultDiagnosis4",
"AdultDiagnosis5",
"AdultDiagnosis_id1",
"AdultDiagnosis_id2",
"AdultDiagnosis_id3",
"AdultDiagnosis_id4",
"AdultDiagnosis_id5",
"AdultDiagnosisOthers",
"operationCABG",
"operationLIMA",
"operationRIMA",
"operationRIMA_RadialA",
"operationRIMA_GEA",
"operationVeinGraft",
"operationCardiopulmonaryBypass",
"operationCardiacArrest",
"operationCABGMemo",
"operationAorticValve",
"operationAVP",
"operationAorticValve_AVP",
"operationAorticValve_AVR",
"operationAVRSelect",
"operationAorticMemo",
"operationMitralValve",
"Operation_MitralValve_MVP",
"Operation_MitralValve_MVR",
"operationMitralValveBentall",
"operationMVPRing",
"operationMVPArtificialChord",
"operationMVPAnnularPlication",
"operationMVPLeafletResection",
"operationMVPOthers",
"operationMVR",
"operationMVRMemo",
"operationTricuspidValve",
"Operation_TricuspidValve_TVP",
"Operation_TricuspidValve_TVR",
"operationTVPRing",
"operationTVPArtificialChord",
"operationTVPAnnularPlication",
"operationTVPLeafletResection",
"operationTVPOthers",
"operationTVR",
"operationTricuspidValveMemo",
"operationPulmonaryValve",
"Operation_PulmonaryValve_PVP",
"Operation_PulmonaryValve_PVR",
"operationPulmonaryValvePVP",
"operationPulmonaryValvePVR",
"operationPulmonaryValveMemo",
"operationArrythmiaSurgery",
"operationMazebiatrialLesion",
"operationMazeLA",
"operationMazePVIwithLAA",
"operationMazePVIwithoutLAA",
"operationMazeRA",
"operationMazeOthers",
"operationMazeEnergySource",
"operationMazeMemo",
"operationAorticSurgery",
"operationDissection",
"operationAneurysm",
"operationEtiologyOthers",
"operationAneurysmAscending",
"operationAneurysmArch",
"operationAneurysmThoracicAorta",
"operationAneurysmAbdominalAorta",
"operationEtiologyCardiopulmonarBypass",
"operationAorticSurgeryCerebralProtection",
"operationAorticSurgeryLocation",
"operationAorticSurgeryMethod",
"operationAorticSurgeryMemo",
"operationHeartTransplantation",
"operationHeartTransplantationOP",
"operationHeartTransplantationLVAD",
"operationHeartTransplantationRVAD",
"operationHeartTransplantationMemo",
"operationOtherCardiacSurgery",
"operationOtherCardiacSurgery1",
"operationOtherCardiacSurgery2",
"operationOtherCardiacSurgery3",
"operationOtherCardiacSurgery4",
"operationOtherCardiacSurgery5",
"operationOtherCardiacSurgery6",
"operationOtherCardiacSurgery7",
"operationOtherCardiacSurgery8",
"operationOtherCardiacSurgery9",
"operationOtherCardiacSurgery10",
"operationOtherCardiacSurgery11",
"operationOtherCardiacSurgeryMemo",
"operationECMO",
"operationECMOType",
"operationECMOMemo",
"operationLVAD",
"operationCardiacTumor",
"operationOthersOperation",
"CongenitalDiagnosis1",
"CongenitalDiagnosis2",
"CongenitalDiagnosis3",
"CongenitalDiagnosis4",
"CongenitalDiagnosis5",
"CongenitalDiagnosis_id1",
"CongenitalDiagnosis_id2",
"CongenitalDiagnosis_id3",
"CongenitalDiagnosis_id4",
"CongenitalDiagnosis_id5",
"CongenitalDiagnosisOthers",
"CongenitalProcedure1",
"CongenitalProcedure2",
"CongenitalProcedure3",
"CongenitalProcedure4",
"CongenitalProcedure5",
"CongenitalProcedure_id1",
"CongenitalProcedure_id2",
"CongenitalProcedure_id3",
"CongenitalProcedure_id4",
"CongenitalProcedure_id5",
"CongenitalProcedureOthers",
"operationCongenitalBypass",
"operationCongenitalBypassCPBTime",
"operationCongenitalBypassAorticTime",
"operationCongenitalBypassCirculatoryTime",
"operationCongenitalBypassCardioplegia",
"operationCongenitalBypassRACHS",
"operationCongenitalBypassSTS",
"operationCongenitalBypassMemo",
"outcomeDeath",
"outcomeDeathDate",
"outcomeDeathMemo",
"outcomeWoundInfection",
"outcomeWoundInfectionData",
"outcomeWoundInfectionMemo",
"outcomeBacteremia",
"outcomeBacteremiaData",
"outcomeBacteremiaMemo",
"outcomeReentry",
"outcomeReentryMemo",
"outcomeDialysis",
"outcomeDialysisDate",
"outcomeDialysisMemo",
"outcomeECMO",
"outcomeECMOData",
"outcomeECMOMemo",
"outcomeIABP",
"outcomeIABPMemo",
"outcomeStroke",
"outcomeStrokeMemo",
"outcomeArrthymia",
"outcomeArrthymiaData",
"outcomeArrthymiaMemo",
"outcomeCheck1",
"outcomeData1",
"outcomeCheck2",
"outcomeData2",
"outcomeCheck3",
"outcomeData3",
"outcomeCheck4",
"outcomeData4",
"outcomeCheck5",
"outcomeData5",
"outcomeCheck6",
"outcomeData6",
"outcomeCheck7",
"outcomeData7",
"outcomeCheck8",
"outcomeData8",
"outcomeCheck9",
"outcomeData9",
"outcomeCheck10",
"outcomeData10",
"outcomeChildComplication1",
"outcomeChildComplication2",
"outcomeChildComplication3",
"outcomeChildComplication4",
"outcomeChildComplication5",
"outcomeChildComplication6",
"outcomeChildComplication7",
"outcomeChildComplication8",
"outcomeChildComplication9",
"outcomeChildComplication10",
"outcomeChildComplication11",
"outcomeChildComplication12",
"outcomeChildComplication13",
"outcomeChildComplication14",
"outcomeChildComplication15",
"outcomeChildComplication16",
"outcomeChildComplication17",
"outcomeChildComplication18",
"outcomeChildComplication19",
"outcomeChildComplication20",
"outcomeChildComplication21",
"outcomeChildComplication22",
"outcomeChildComplication23",
"outcomeChildComplication24",
"outcomeChildComplication25",
"outcomeChildComplication26",
"outcomeChildComplication27",
"outcomeChildComplication28",
"outcomeChildComplication29",
"outcomeChildComplication30",
"outcomeChildComplication31",
"outcomeChildComplication32",
"outcomeChildComplication33",
"outcomeChildComplication34",
"outcomeChildComplication35",
"outcomeChildComplication36",
"outcomeChildCauseofDeath",
"outcomeExtubationDate",
"outcomeStatus",
"patientICUDischargeDate"
);
foreach($sheetData as $key => $col){
        //讀取標題
        if($rowindex == 0){
            foreach ($col as $colkey => $colvalue){
                array_push($title,$colvalue);
         //     echo $colvalue. "<br/>";
            }
        } else {
               unset($tdata); // $foo is gone
                 $tdata = array(); // $foo is here again
             foreach ($col as $colkey => $colvalue){
              
                array_push($tdata,$colvalue);
                }
              //  echo $colkey. "<br/>";
              //處理資料開始
                $this->load->model('PatientInformation_Model');
        
     $this->load->library('patientinformationClass');
         $query = $this->PatientInformation_Model->viewRecordByChart($tdata[2],$tdata[21]); 
                 if ($query->num_rows() ==1)
                    {
                        //變更
                     // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                      $patientinformationClass= new patientinformationClass;
               $patientinformationClass=$query->row();
             
               $pid=$patientinformationClass->patientID;
               $myindex=0;
                  foreach ($arrayKey as $pkey => $pvalue){
                      $patientinformationClass->$pvalue=$tdata[$myindex++];
                         }   
                      $this->PatientInformation_Model->Update_patient($pid, $patientinformationClass);
                   $data['result_msg'].= "<font color='blue'>修改病人資料:".$tdata[3]."</font><br/>";
            
 //                      $patientinformationClass->patientHospital=$tdata[$rowindex][$myindex++];
//$patientinformationClass->patientSSN=$tdata[$rowindex][$myindex++];

               
                    } else {
                         $patientinformationClass= new patientinformationClass;
                          $myindex=0;
                  foreach ($arrayKey as $pkey => $pvalue){
                      $patientinformationClass->$pvalue=$tdata[$myindex++];
            //  echo       $pvalue."-->".$tdata[$myindex]."<br/>";
                         }   
               //    $patientinformationClass->isDeleted=$this->input->post('isDeleted');
               $data['result_msg'].=  "新增病人資料:".$tdata[3]."<br/>";
                $insert_id=$this->PatientInformation_Model->Save_patient($patientinformationClass);
                    }
                    //處理資料結束
        }
             
            
            //處理資料開始
            
            
            //處理資料結束
      
        $rowindex++;
        
}
//echo $rowindex++. "<br/>";
}
//    echo "<h2>列印每一行的資料</h2>";
    
    } } }
         else {
         $data['error_msg']='<font color="red">資料格式錯誤, 請重新選擇檔案</font><br>';
     //    echo "2.2<br/>";
            }
     
           
     
         // echo "3";
        $data['page']="export";    
     $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;</li><li>病患資料匯入</li>";
       $this->load->view('exportpatient/inFile',$data);
   }

function importVascularPatient(){
          require_once './application/libraries/Classes/PHPExcel.php';
       $objPHPExcel = new PHPExcel();
        $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
         $data['result_msg']='';
         $data['error_msg']='';
        $data['patientList']='';
         $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'xlsx';
      $config['max_size']   = '30000';
      $config['file_name']  = "A".time(); 
    //echo $_FILES['abanner']['tmp_name'];
  //  echo "1<br/>";
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->load->model('user_Model');
      //  echo $_FILES['uploadPatient']['tmp_name']."<br/>";
        //echo $_FILES['uploadPatient']['name']."<br/>";
        if (isset($_FILES['uploadPatient']['tmp_name']) && $_FILES['uploadPatient']['tmp_name']!="" && $this->upload->do_upload("uploadPatient"))
        {
            $error = array('error' => $this->upload->display_errors());
            if($this->upload->display_errors()==""){
             //   echo "2.1<br/>";
                     if ( !$fp = fopen('./uploads/'.$config['file_name'].'.xlsx' ,"r") ) {
                       $data['error_msg'].= "<font color='red'>無法打開檔案</font><br/>";
                 
                }else{
                    
                                $size = filesize('./uploads/'.$config['file_name'].'.xlsx')+1;
                      $row=0;
                      $error="0";
                   //   echo "打開檔案:".$size;
                      
                      $file='./uploads/'.$config['file_name'].'.xlsx';
                      
                      try {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
                 $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $worksheetNames = $objPHPExcel->getSheetNames($file);
$return = array();
$i=0;
foreach($worksheetNames as $key => $sheetName){
//set the current active worksheet by name
$objPHPExcel->setActiveSheetIndexByName($sheetName);
//create an assoc array with the sheet name as key and the sheet contents array as value
$return[$sheetName] = $objPHPExcel->getActiveSheet()->toArray(null, true,true,true);
//echo $sheetName."<br/>";
$rowindex =0;
$title = array();
$tdata = array();
$arrayKey=array(
"Primary",
"I",
"II",
"III",
"IV",
"AVF note",
"日期",
"姓名",
"年齡",
"出生年月日",
"性別",
"病歷號",
"診斷",
"術式",
"主治醫師",
"助手一",
"助手二",
"助手三",
"Primary procedure",
"Secondary Procedure 1",
"Secondary Procedure 2",
"Secondary Procedure 3",
"Secondary Procedure 4",
"Aortic disease",
"Peripheral artery disease",
"AVF note"
);
foreach($sheetData as $key => $col){
        //讀取標題
        if($rowindex == 0){
            foreach ($col as $colkey => $colvalue){
                array_push($title,$colvalue);
                //echo $colvalue. "<br/>";
            }
        } else {
               unset($tdata); // $foo is gone
                 $tdata = array(); // $foo is here again
                 $i=0;
             foreach ($col as $colkey => $colvalue){
              if($i==6 || $i==9)
                   $colvalue = DateTime::createFromFormat('Y/m/d', $colvalue)->format('Y-m-d');
                //echo $colvalue. "<br/>";
                array_push($tdata,trim($colvalue));
                 $i++;
                }
              //  echo $colkey. "<br/>";
              //處理資料開始
                $this->load->model('PatientInformation_Model');
        
     $this->load->library('patientinformationClass');
     
     
   //  echo  date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($tdata[6]))."<br/>";
         $query = $this->PatientInformation_Model->viewVascularRecordByChart(trim($tdata[6]), trim($tdata[11])); 
         
                 if ($query->num_rows() ==1)
                    {
                        //變更
                   $pid=$query->row()->patientID;
                  $this->load->model('Vascular_Model');
        
        
        $this->load->library('VascularClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                       $VascularClass= new VascularClass;
                       $VascularClass->patientID=$pid;
                $VascularClass->patientChartNumber=$tdata[11];
                $VascularClass->patientHospital=$this->config->item('hospitalName');
                $VascularClass->patientName=$tdata[7];
                $VascularClass->patientBirthday=$tdata[9];
               // $VascularClass->patientAge=$this->input->post('patientAge');
                $VascularClass->patientAgeDescription=$tdata[8];
             //   $VascularClass->patientAgeUnit=$this->input->post('patientAgeUnit');
                $VascularClass->patientGender=$tdata[10];
                $VascularClass->patientSurgeon=$tdata[14];
                $VascularClass->patientSurgeon2=$tdata[15];
                 $VascularClass->patientSurgeon3=$tdata[16];
                $VascularClass->patientSurgeon4=$tdata[17];
                
                $VascularClass->patientProcedure1=$tdata[18];
                $VascularClass->patientProcedure2=$tdata[19];
                $VascularClass->patientProcedure3=$tdata[20];
                $VascularClass->patientProcedure4=$tdata[21];
                $VascularClass->patientProcedure5=$tdata[22];
                
                $VascularClass->patientOpDate=$tdata[6];
                $VascularClass->patientProcedureOthers=$tdata[13];
                $VascularClass->patientDiagnosis=$tdata[12];
                //Age
                $age=0;
                $age=$this->dateDiff($tdata[9],$tdata[6]);
                if($age>=366){
                    $VascularClass->patientAge=round($age/365,1);
                    $VascularClass->patientAgeUnit='1';
                } else if($age>=30) {
                    $VascularClass->patientAge=round($age/30,1);
                    $VascularClass->patientAgeUnit='2';
                } else {
                    $VascularClass->patientAge=$age;
                    $VascularClass->patientAgeUnit='3';
                }
              //procedure代碼
                    if($tdata[18]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[18]);
                if($surgeon->num_rows() ==1) {
                    //echo "code id:".$surgeon->row()->code;
                               $VascularClass->patientProcedure_id1=$surgeon->row()->code;
               }
                         }
                           if($tdata[19]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[19]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id2=$surgeon->row()->code;
               }
                         }
                             if($tdata[20]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[20]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id3=$surgeon->row()->code;
               }
                         }
                               if($tdata[21]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[21]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id4=$surgeon->row()->code;
               }
                         }
                                 if($tdata[22]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[22]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id5=$surgeon->row()->code;
               }
                         }
                //醫師代碼
                         if($tdata[14]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[14]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id=$surgeon->row()->userID;
               }
                         }
                 if($tdata[15]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[15]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id2=$surgeon->row()->userID;
               }
                 }
                 if($tdata[16]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[16]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id3=$surgeon->row()->userID;
               }
                 }
                 if($tdata[17]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[17]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id4=$surgeon->row()->userID;
               }
                 }
                $VascularClass->isDeleted='N';
                $VascularClass->patientHospital=$this->config->item('hospitalName');
                $VascularClass->modifyPerson=$this->session->userdata('userID');
                $VascularClass->modifyTime=date('Y-m-d H:i:s');
                    
                          $insert_id=$this->Vascular_Model->update_patient($pid,$VascularClass);
               $data['result_msg'].=  "<font color='blue'>變更病人資料:".$tdata[7]."</font><br/>";
               
                    } else {
                        $this->load->model('Vascular_Model');
        
        
        $this->load->library('VascularClass');
        
               // $patientinformationClass = $this->PatientInformation_Model->viewRecord($patientID)->row();
                       $VascularClass= new VascularClass;
                         $VascularClass->patientChartNumber=$tdata[11];
                $VascularClass->patientHospital=$this->config->item('hospitalName');
                $VascularClass->patientName=$tdata[7];
                $VascularClass->patientBirthday=$tdata[9];
               // $VascularClass->patientAge=$this->input->post('patientAge');
                $VascularClass->patientAgeDescription=$tdata[8];
               $VascularClass->patientGender=$tdata[10];
                $VascularClass->patientSurgeon=$tdata[14];
                $VascularClass->patientSurgeon2=$tdata[15];
                 $VascularClass->patientSurgeon3=$tdata[16];
                $VascularClass->patientSurgeon4=$tdata[17];
                
                $VascularClass->patientProcedure1=$tdata[18];
                $VascularClass->patientProcedure2=$tdata[19];
                $VascularClass->patientProcedure3=$tdata[20];
                $VascularClass->patientProcedure4=$tdata[21];
                $VascularClass->patientProcedure5=$tdata[22];
                
                $VascularClass->patientOpDate=$tdata[6];
                $VascularClass->patientProcedureOthers=$tdata[13];
                $VascularClass->patientDiagnosis=$tdata[12];
                //Age
                $age=0;
                $age=$this->dateDiff($tdata[9],$tdata[6]);
                if($age>=366){
                    $VascularClass->patientAge=round($age/365,1);
                    $VascularClass->patientAgeUnit='1';
                } else if($age>=30) {
                    $VascularClass->patientAge=round($age/30,1);
                    $VascularClass->patientAgeUnit='2';
                } else {
                    $VascularClass->patientAge=$age;
                    $VascularClass->patientAgeUnit='3';
                }
              //procedure代碼
                         if($tdata[18]!=""){
                             
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[18]);
                if($surgeon->num_rows() ==1) {
                    //echo "code id:".$surgeon->row()->code;
                               $VascularClass->patientProcedure_id1=$surgeon->row()->code;
               }
                         }
                           if($tdata[19]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[19]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id2=$surgeon->row()->code;
               }
                         }
                             if($tdata[20]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[20]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id3=$surgeon->row()->code;
               }
                         }
                               if($tdata[21]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[21]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id4=$surgeon->row()->code;
               }
                         }
                                 if($tdata[22]!=""){
                        $surgeon=$this->user_Model->queryProcedurebyName($tdata[22]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientProcedure_id5=$surgeon->row()->code;
               }
                         }
                        //醫師代碼
                         if($tdata[14]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[14]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id=$surgeon->row()->userID;
               }
                         }
                 if($tdata[15]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[15]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id2=$surgeon->row()->userID;
               }
                 }
                 if($tdata[16]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[16]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id3=$surgeon->row()->userID;
               }
                 }
                 if($tdata[17]!=""){
                        $surgeon=$this->user_Model->queryUserbyRealname($tdata[17]);
                if($surgeon->num_rows() ==1) {
                               $VascularClass->patientSurgeon_id4=$surgeon->row()->userID;
               }
                 }
                $VascularClass->isDeleted='N';
                $VascularClass->createPerson=$this->session->userdata('userID');
                $VascularClass->createTime=date('Y-m-d H:i:s');
                $VascularClass->patientHospital=$this->config->item('hospitalName');
                $insert_id=$this->Vascular_Model->Save_patient($VascularClass);
               $data['result_msg'].=  "新增病人資料:".$tdata[7]."<br/>";
              
                    }
                    //處理資料結束
        }
             
            
            //處理資料開始
            
            
            //處理資料結束
      
        $rowindex++;
        
}
//echo $rowindex++. "<br/>";
}
//    echo "<h2>列印每一行的資料</h2>";
    
    } } }
         else {
         $data['error_msg']='<font color="red">資料格式錯誤, 請重新選擇檔案</font><br>';
     //    echo "2.2<br/>";
            }
     
           
     
         // echo "3";
       $data['page']="specialsheet";    
        $data['subpage']="Vascular";
     $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;</li><li>病患資料匯入</li>";
       $this->load->view('exportpatient/inVascularFile',$data);
}
function dateDiff($date1, $date2){
            $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
      //  echo $ts1."<br/>";
       // echo $ts2."<br/>";
        //echo round(($ts2 - $ts1)/86400)+1;
        //    echo "<br/><br/><br/>";
            if(($ts2 - $ts1)<0)
            return "";
            else
         return  round(($ts2 - $ts1)/86400)+1;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */