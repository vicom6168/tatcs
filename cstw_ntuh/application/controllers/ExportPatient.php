<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExportPatient extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
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
        
         //看是否顯示病人全名--開始
       $this->load->model('Parameter_Model');
        $hospitalsystem= $this->Parameter_Model->query_system()->row()->patientname;   
        $data['hospitalsystem']=$hospitalsystem;
        
       //看是否顯示病人全名--結束
       
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
"ReOperation",
"patientOpDate",
"AdmissionDate",
"DischargeDate",
"patientIsICUAdmission",
"LOS",
"ICUAdmissionDate",
"ICUDischargeDate",
"ICU_LOS",
"ExtubationDate",
"patientAssociatedDisease",
"diseaseType",
"Procedure1",
"Procedure2",
"Procedure3",
"Procedure4",
"Procedure5",
"Procedure_id1",
"Procedure_id2",
"Procedure_id3",
"Procedure_id4",
"Procedure_id5",
"Procedure_Others",
"Diagnosis1",
"Diagnosis2",
"Diagnosis3",
"Diagnosis4",
"Diagnosis5",
"Diagnosis_id1",
"Diagnosis_id2",
"Diagnosis_id3",
"Diagnosis_id4",
"Diagnosis_id5",
"DiagnosisOthers",
"operationOthersOperation",
"ProcedureType1",
"ProcedureType2",
"ProcedureType3",
"ProcedureType4",
"ProcedureType5",
"ProcedureTypeName1",
"ProcedureTypeName2",
"ProcedureTypeName3",
"ProcedureTypeName4",
"ProcedureTypeName5",
"CancerLSHeight",
"CancerLSWeight",
"CancerLSSmokingAmount",
"CancerLSSmokingYear",
"CancerLSSmokingQuitYear",
"CancerLSBetelNutsAmount",
"CancerLSBetelNutsYear",
"CancerLSBetelNutsQuitYear",
"CancerLSDrinking",
"Cancer_KPS",
"Cancer_ECOG",
"CancerClinical_T",
"CancerClinical_N",
"CancerClinical_M",
"CancerClinical_StageGroup",
"CancerPathological_T",
"CancerPathological_N",
"CancerPathological_M",
"CancerPathological_Stage",
"CancerStage_memo",
"CharlsonScore_MI",
"CharlsonScore_CHF",
"CharlsonScore_PVD",
"CharlsonScore_CVA",
"CharlsonScore_Dementia",
"CharlsonScore_COPD",
"CharlsonScore_ConnectiveTissueDisease",
"CharlsonScore_PepticUlcerDisease",
"CharlsonScore_LiverDisease",
"CharlsonScore_DiabetesMellitus",
"CharlsonScore_Hemiplegia",
"CharlsonScore_CKD",
"CharlsonScore_SolidTumor",
"CharlsonScore_Leukemia",
"CharlsonScore_Lymphoma",
"CharlsonScore_AIDS",
"CharlsonScore_Score",
"outcomeDeath",
"outcomeDeathDate",
"outcomeDeathMemo",
"outcomeMortalityCheck",
"outcomeMortalityNote",
"outcomeInfectionCheck",
"outcomeInfectionNote",
"outcomeReoperationCheck",
"outcomeReoperationNote",
"outcomePneumoniaCheck",
"outcomePneumoniaNote",
"outcomeIntubationCheck",
"outcomeIntubationNote",
"outcomeHemothoraxCheck",
"outcomeHemothoraxNote",
"outcomePneumothoraxCheck",
"outcomePneumothoraxNote",
"outcomeBPFistulaCheck",
"outcomeBPFistulaNote",
"outcomeChylothoraxCheck",
"outcomeChylothoraxNote",
"outcomeAnastomosisCheck",
"outcomeAnastomosisNote",
"outcomeIleusCheck",
"outcomeIleusNote",
"outcomeAspirationCheck",
"outcomeAspirationNote",
"outcomeDysphagiaCheck",
"outcomeDysphagiaNote",
"outcomeArrthymiaCheck",
"outcomeArrthymiaNote",
"outcomeOthersCheck",
"outcomeOthersNote",
"isDeleted",
"outcomeStatus",
"createPerson",
"createTime",
"modifyPerson",
"modifyTime",
"patientHospitalUUID",
"agreement",
"hospitalagreement",
"isSaved",
"isSaved"
);
foreach($sheetData as $key => $col){
        //讀取標題
        if($rowindex == 0){
            foreach ($col as $colkey => $colvalue){
                array_push($title,$colvalue);
               echo "T".$colvalue. "<br/>";
            }
        } else {
               unset($tdata); // $foo is gone
                 $tdata = array(); // $foo is here again
             foreach ($col as $colkey => $colvalue){
              
                array_push($tdata,$colvalue);
                }
                echo "O".$colkey. "<br/>";
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