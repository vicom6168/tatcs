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
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('homenew',$data);
         $this->load->model('PatientInformation_Model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->PatientInformation_Model->export_patientlist($d1,$d2,$h1);
        $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料匯出 (期間:'.$d1.'~'.$d2.')','S');
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
        $data['page']="export";    
        $data['path']="<li>病患資料匯出</li><li  class='break'>&#187;</li><li>病患資料列表</li>";
        $this->load->view('exportpatient/query',$data);
    }
   
     
     public function EXCEL($d1,$d2,$h1)
    {
         $this->load->model('PatientInformation_Model');
        $data['patientList']=$this->PatientInformation_Model->export_patientlistCVS($d1,$d2,$h1);
     $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     
     $data['d1']=$d1;
     $data['d2']=$d2;
     $data['h1']=$h1;
     $access_id=accessLog('R','EXPORT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'病患資料EXCEL匯出 (期間:'.$d1.'~'.$d2.')','S');
     
        $this->load->view('exportpatient/EXCEL',$data);
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
"isDeleted",
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
              //  echo $colvalue. "<br/>";
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
                         }   
                   $patientinformationClass->isDeleted=$this->input->post('isDeleted');
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */