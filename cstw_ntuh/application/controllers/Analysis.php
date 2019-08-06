<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysis extends CI_Controller {

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
         $ans1="";
       
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     if( $qYear!='' &&  $qMonth!=''){
         
        $ans1=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,'');
               
      
       $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 學會手術統計申報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['page']="analysis";  
     $data['subpage']="associate";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會手術統計申報表</li>";
     $data['answer1']=$ans1;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
        $this->load->view('analysis/index',$data);
    }
    public function indexChart()
    {
         $ans1="";
       
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     if( $qYear!='' &&  $qMonth!=''){
         
        $ans1=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,'');
               
      
       $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 學會手術統計申報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['page']="analysis";  
     $data['subpage']="associate";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會手術統計申報表</li>";
     $data['answer1']=$ans1;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
        $this->load->view('analysis/indexChart',$data);
    }

       public function indexDetail($i,$qYear,$qMonth,$qYearEnd,$qMonthEnd){
            $ans1="";
      $i= str_pad($i,2,'0',STR_PAD_LEFT);
     //$qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     //$qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     //$qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     //$qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     if( $qYear!='' &&  $qMonth!=''){
         
        $ans1=$this->Analysis_Model->query_associateReportDetail($i,$qYear,$qMonth,$qYearEnd,$qMonthEnd,'');
               
      
       $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 學會手術統計申報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['page']="analysis";  
     $data['subpage']="associate";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會手術統計申報表</li>";
     $data['answer1']=$ans1;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $this->load->view('analysis/indexDetail',$data);
       }

public function doctoroperation(){
    $ans1="";
    $vsID="";
    $vsType="";
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $patientSurgeon=$this->input->post('patientSurgeon')==null?"":$this->input->post('patientSurgeon');
     $vsType=$this->input->post('vsType')==null?"":$this->input->post('vsType');
     
     if( $qYear!='' &&  $qMonth!=''){
         
        $ans1=$this->Analysis_Model->query_vsoperationList($qYear,$qMonth,$qYearEnd,$qMonthEnd,$patientSurgeon,$vsType);
               
      
       $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 學會手術統計申報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
     
    $this->load->model('Parameter_Model');  
        
     $vsList = $this->Parameter_Model->query_vsList();
     $data['vsList']=$vsList;  
     $data['page']="analysis";  
     $data['subpage']="doctor";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會手術統計申報表</li>";
     $data['patientList']=$ans1;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['vsID']=$patientSurgeon;
     $data['vsType']=$vsType;
     
     //看是否顯示病人全名--開始
       $this->load->model('Parameter_Model');
        $hospitalsystem= $this->Parameter_Model->query_system()->row()->patientname;   
        $data['hospitalsystem']=$hospitalsystem;
        
       //看是否顯示病人全名--結束
     
       $this->load->view('analysis/doctoroperation',$data); 
}

public function complication(){
          for($i=0;$i<15;$i++){
        $ans[$i]="";
         }
  
     $qYear=$this->input->post('qYear')==null?"2000":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"13":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"1999":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"13":$this->input->post('qMonthEnd');
     
     if( $qYear!='' &&  $qMonth!=''){
         for($i=0;$i<15;$i++){
        $ans[$i]=$this->Analysis_Model->query_complication($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i);
         }
     $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 併發症統計報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
     }
     
       $this->load->model('Parameter_Model');  
        
     $vsList = $this->Parameter_Model->query_vsList();
     $data['vsList']=$vsList;  
     $data['page']="analysis";  
     $data['subpage']="complication";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>3. 併發症統計報表</li>";
     $data['answer']=$ans;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     
     $this->load->view('analysis/complication',$data); 
}

        public function PDF($qYear,$qMonth,$qYearEnd,$qMonthEnd)
    {
        $ans[17]=0;
        for($i=1;$i<=16;$i++){
        $ans[$i]=0;
        }
    
     if( $qYear!='' &&  $qMonth!=''){
         for($i=1;$i<=16;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i)->row()->num;
              $ans[17]+=$ans[$i];
        }
         $all_num=0;
      $noneopenheart_item1=0;  
      $noneopenheart_item5=0;
      $all_num=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
      $noneopenheart_item1=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
      $noneopenheart_item5=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;  
       //2018-03-14修改 刪除以下4行  
    if($this->session->userdata('SP1')!="1"){
         $ans['14']=  (int)$ans['14']+((int)$noneopenheart_item1)/2;
      $ans['15']=  ((int)$noneopenheart_item1)/2;
    }
     // 2018-03-14修改結束
     
     
      $ans['17']=  (int)$all_num+(int)$noneopenheart_item1+(int)$noneopenheart_item5;
      $ans['16']=(int)$ans['17']-(int)$ans['1']-(int)$ans['2']-(int)$ans['3']-(int)$ans['4']-(int)$ans['5']-(int)$ans['6']-(int)$ans['7']-(int)$ans['8']-(int)$ans['9']-(int)$ans['10']-(int)$ans['11']-(int)$ans['12']-(int)$ans['13']-floatval($ans['14'])-floatval($ans['15']);
         
         $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 學會分類報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $data['answer']=$ans;
      $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $this->load->view('analysis/PDF',$data);
    }
     public function EXCEL($qYear,$qMonth,$qYearEnd,$qMonthEnd)
    {
        $ans[17]=0;
        for($i=1;$i<=16;$i++){
        $ans[$i]=0;
        }
      
     if( $qYear!='' &&  $qMonth!=''){
         for($i=1;$i<=16;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i)->row()->num;
              $ans[17]+=$ans[$i];
        }
         $all_num=0;
      $noneopenheart_item1=0;  
      $noneopenheart_item5=0;
      $all_num=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
      $noneopenheart_item1=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
      $noneopenheart_item5=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;  
      //2018-03-14修改 刪除以下4行  
    if($this->session->userdata('SP1')!="1"){
         $ans['14']=  (int)$ans['14']+((int)$noneopenheart_item1)/2;
      $ans['15']=  ((int)$noneopenheart_item1)/2;
    }
     // 2018-03-14修改結束
      $ans['17']=  (int)$all_num+(int)$noneopenheart_item1+(int)$noneopenheart_item5;
      $ans['16']=(int)$ans['17']-(int)$ans['1']-(int)$ans['2']-(int)$ans['3']-(int)$ans['4']-(int)$ans['5']-(int)$ans['6']-(int)$ans['7']-(int)$ans['8']-(int)$ans['9']-(int)$ans['10']-(int)$ans['11']-(int)$ans['12']-(int)$ans['13']-floatval($ans['14'])-floatval($ans['15']);
         
         $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL【 學會分類報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $data['answer']=$ans;
      $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
        $this->load->view('analysis/EXCEL',$data);
    }
  
  
   public function executivesummary(){
        $data['page']="analysis";  
        $data['subpage']="summary";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
     $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
        $data['adult']=$data['total']-$data['child'];
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive Summary】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/executivesummary',$data);
   }
public function PDFsummary($qYear,$qMonth,$qYearEnd,$qMonthEnd){
              $data['page']="analysis";  
     
      $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive Summary】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/PDFsummary',$data);
   }
public function EXCELsummary($qYear,$qMonth,$qYearEnd,$qMonthEnd){
              $data['page']="analysis";  
     
      $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL報表【 Executive Summary】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/EXCELsummary',$data);
   }
    public function executivesummaryadult(){
              $data['page']="analysis"; 
              $data['subpage']="adult";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
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
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['ans9']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['ans10']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['ans11']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8']-$data['ans9']-$data['ans10'];
     
     $data['a1']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'18')->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Adult Cardiac Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/executivesummaryadult',$data);
   }
public function PDFadult($qYear,$qMonth,$qYearEnd,$qMonthEnd){
              $data['page']="analysis";  
     
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
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['ans9']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8'];
     
      $data['a1']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
        $data['a2']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'18')->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Adult Cardiac Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');       
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/PDFadult',$data);
   }
public function EXCELadult($qYear,$qMonth,$qYearEnd,$qMonthEnd){
              $data['page']="analysis";  
     
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
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['ans9']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8'];
     
      $data['a1']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'18')->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL報表【 Executive summary of Adult Cardiac Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');       
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/EXCELadult',$data);
   }
public function executivesummarychild(){
              $data['page']="analysis";  
              $data['subpage']="congenital";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
     $data['total']='0';
     $data['child']='0';
     $data['adult']='0';
     $data['Noncardiac']='0';
   
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
     $data['a19']='0';
     $data['b4']='0';
     $data['b5']='0';
     $data['b6']='0';
     $data['b7']='0';
     $data['b8']='0';
     $data['b9']='0';
     $data['b10']='0';
     $data['b11']='0';
     $data['b12']='0';
     $data['b13']='0';
     $data['b14']='0';
     $data['b15']='0';
     $data['b16']='0';
     $data['b17']='0';
     $data['b18']='0';
     $data['b19']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
       $data['adult']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'0')->row()->num; 
     $data['a1']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
     $data['b4']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['b5']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['b6']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['b7']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['b8']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['b9']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['b10']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['b11']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['b12']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['b13']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['b14']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['b15']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['b16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['b17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Congenital Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/executivesummarychild',$data);
   }

public function PDFchild($qYear,$qMonth,$qYearEnd,$qMonthEnd){
           $data['page']="analysis";  
     
     $data['total']='0';
     $data['child']='0';
     $data['adult']='0';
     $data['Noncardiac']='0';
   
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
     $data['a19']='0';
      $data['b4']='0';
     $data['b5']='0';
     $data['b6']='0';
     $data['b7']='0';
     $data['b8']='0';
     $data['b9']='0';
     $data['b10']='0';
     $data['b11']='0';
     $data['b12']='0';
     $data['b13']='0';
     $data['b14']='0';
     $data['b15']='0';
     $data['b16']='0';
     $data['b17']='0';
     $data['b18']='0';
     $data['b19']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
       $data['adult']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'0')->row()->num; 
     $data['a1']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
     $data['b4']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['b5']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['b6']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['b7']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['b8']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['b9']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['b10']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['b11']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['b12']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['b13']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['b14']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['b15']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['b16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['b17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Congenital Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');        
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/PDFchild',$data);
   }
public function EXCELchild($qYear,$qMonth,$qYearEnd,$qMonthEnd){
           $data['page']="analysis";  
     
     $data['total']='0';
     $data['child']='0';
     $data['adult']='0';
     $data['Noncardiac']='0';
   
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
     $data['a19']='0';
      $data['b4']='0';
     $data['b5']='0';
     $data['b6']='0';
     $data['b7']='0';
     $data['b8']='0';
     $data['b9']='0';
     $data['b10']='0';
     $data['b11']='0';
     $data['b12']='0';
     $data['b13']='0';
     $data['b14']='0';
     $data['b15']='0';
     $data['b16']='0';
     $data['b17']='0';
     $data['b18']='0';
     $data['b19']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
       $data['adult']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'0')->row()->num; 
     $data['a1']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['b4']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['b5']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['b6']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['b7']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['b8']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['b9']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $data['b10']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10')->row()->num;
     $data['b11']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11')->row()->num;
     $data['b12']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12')->row()->num;
     $data['b13']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13')->row()->num;
     $data['b14']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14')->row()->num;
     $data['b15']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15')->row()->num;
     $data['b16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16')->row()->num;
     $data['b17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17')->row()->num;
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL報表【 Executive summary of Congenital Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');    
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/EXCELchild',$data);
   }

public function executivesummarynonopenheart(){
        $data['page']="analysis";  
        $data['subpage']="nonsurgery";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
    
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     
     if($qYear!="" && $qMonth!=""){
       $data['a1']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
    }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/executivesummarynonopenheart',$data);
   }

public function analysisVascularPatient(){
        $data['page']="specialsheet";  
        $data['subpage']="Vascular";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
    
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     
     if($qYear!="" && $qMonth!=""){
       $data['a1']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
    }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/analysisVascularPatient',$data);
   }

public function PDFVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd){
       $data['page']="specialsheet";  
     $data['subpage']="Vascular"; 
   
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     if($qYear!="" && $qMonth!=""){
       $data['a1']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
      $data['a9']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Vascular】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
    }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/PDFVascular',$data);
   }
public function EXCELVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd){
       $data['page']="specialsheet";  
     $data['subpage']="Vascular";   
     
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     if($qYear!="" && $qMonth!=""){
       $data['a1']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
    $data['a9']=$this->Analysis_Model->query_executivesummaryVascular($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
     $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/EXCELVascular',$data);
   }
public function PDFnonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd){
       $data['page']="analysis";  
     
   
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     
     if($qYear!="" && $qMonth!=""){
       $data['a1']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
   $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
    }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/PDFnonopenheart',$data);
   }


public function EXCELnonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd){
       $data['page']="analysis";  
     
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
     $data['a6']='0';
     $data['a7']='0';
     $data['a8']='0';
     $data['a9']='0';
     
     if($qYear!="" && $qMonth!=""){
       $data['a1']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9')->row()->num;
    $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/EXCELnonopenheart',$data);
   }


//2017-10-02
  public function adultoutcome(){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
    $ans=array(
       array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0),
      array(0,0,0,0,0,0,0,0,0,0,0)
    );
     
     if($qYear!="" && $qMonth!=""){
         for($i=0;$i<12;$i++){
        $ans[$i][0]=$this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'0')->row()->num;
      // $ans[9][0]= $ans[$i][0];
      $ans[$i][9]=$this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'9')->row()->num;
    $ans[$i][10]=round($this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'9')->row()->myavg,2);
     for($j=0;$j<8;$j++){
         $ans[11][$j+1]=$ans[$i][0];
     if($ans[$i][0]==0){
         $this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1)->row();
                $ans[$i][$j+1]=0;
       
     } else {
     //$ans[$i][$j+1]=round($this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1)->row()->num*100/$ans[$i][0],2);
     $ans[$i][$j+1]=$this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1)->row()->num;
     $ans[11][$j+1]-= $ans[$i][$j+1];
     if($j==7)
     {
        $ans[$i][$j+1]=$ans[$i][0]-$ans[$i][$j+1];
     //   echo "AAAAAAAAAAAAAA<br/>";
     }
     }
     }
     //
         }
         /*
          * 
          *  $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1')->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2')->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3')->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4')->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5')->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6')->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7')->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8')->row()->num;
     $data['ans9']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8'];
     */
         for($i=0;$i<9;$i++){
         $ans[11][$i]=$ans[0][$i]-$ans[1][$i]-$ans[2][$i]-$ans[3][$i]-$ans[4][$i]-$ans[5][$i]-$ans[6][$i]-$ans[7][$i]-$ans[8][$i]-$ans[9][$i]-$ans[10][$i];
         }
     }
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Adult Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/adultoutcome',$data);
   }

 public function congenitaloutcome(){
              $data['page']="analysis"; 
              $data['subpage']="adult";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
      $ans=array(
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0)
    );
     if($qYear!="" && $qMonth!=""){
        for($i=0;$i<15;$i++){
        $ans[$i][0]=$this->Analysis_Model->query_executivesummarydetail3($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'0')->row()->num;
        
     for($j=0;$j<9;$j++){
       //  $ans[14][$j+1]=$ans[$i][0]; 
     if($ans[$i][0]==0){
         $this->Analysis_Model->query_executivesummarydetail3($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1)->row();
                $ans[$i][$j+1]=0;
       
     } else {
     $ans[$i][$j+1]=$this->Analysis_Model->query_executivesummarydetail3($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1)->row()->num;
   // $ans[14][$j+1]-= $ans[$i][$j+1];
     if($j==8)
     {
         $ans[$i][$j+1]=$ans[$i][0]-$ans[$i][$j+1];
     }
      
     }
     }
     //
         }
        for($i=0;$i<9;$i++){
      //   $ans[14][$i]=$ans[0][$i]-$ans[1][$i]-$ans[2][$i]-$ans[3][$i]-$ans[4][$i]-$ans[5][$i]-$ans[6][$i]-$ans[7][$i]-$ans[8][$i]-$ans[9][$i]-$ans[10][$i]-$ans[11][$i]-$ans[12][$i]-$ans[13][$i];
         }
     }
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Congenital Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/congenitaloutcome',$data);
   }

public function adultList($i,$j,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
    $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_executivesummarydetaillist1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Adult Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['i']=$i;
     $data['j']=$j;
     $data['ans']=$ans;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/adultoutcomelist',$data);
   }

public function childList($i,$j,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_executivesummarydetaillist3($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Adult Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['i']=$i;
     $data['j']=$j;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/congenitaloutcomelist',$data);
   }

public function adultListEXCEL($i,$j,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_executivesummarydetaillistEXCEL1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Adult Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['i']=$i;
     $data['j']=$j;
     $data['ans']=$ans;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/adultoutcomelistEXCEL',$data);
   }

public function childListEXCEL($i,$j,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_executivesummarydetaillistEXCEL3($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Adult Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['i']=$i;
     $data['j']=$j;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/congenitaloutcomelistEXCEL',$data);
   }

 
 public function chdbenchmarkoutcome(){
        $data['page']="analysis"; 
              $data['subpage']="adult";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
      $ans=array(
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0),
     array(0,0,0,0,0,0,0,0,0,0)
    );
     if($qYear!="" && $qMonth!=""){
        for($i=0;$i<8;$i++){
        $ans[$i][0]=$this->Analysis_Model->query_chdbenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i+1,'0')->row()->num;
        
     for($j=0;$j<9;$j++){
       //  $ans[14][$j+1]=$ans[$i][0]; 
     if($ans[$i][0]==0){
         $this->Analysis_Model->query_chdbenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i+1,$j+1)->row();
                $ans[$i][$j+1]=0;
       
     } else {
     $ans[$i][$j+1]=$this->Analysis_Model->query_chdbenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i+1,$j+1)->row()->num;
   // $ans[14][$j+1]-= $ans[$i][$j+1];
     if($j==8)
     {
         $ans[$i][$j+1]=$ans[$i][0]-$ans[$i][$j+1];
     }
      
     }
     }
     //
         }
        for($i=0;$i<9;$i++){
      //   $ans[14][$i]=$ans[0][$i]-$ans[1][$i]-$ans[2][$i]-$ans[3][$i]-$ans[4][$i]-$ans[5][$i]-$ans[6][$i]-$ans[7][$i]-$ans[8][$i]-$ans[9][$i]-$ans[10][$i]-$ans[11][$i]-$ans[12][$i]-$ans[13][$i];
         }
     }
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 CHD Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/chdbenchmarkoutcome',$data);
       }

public function chdList($i,$j,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_chdbenchmarklist($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i+1,$j);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 CHD Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['i']=$i;
     $data['j']=$j;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/chdlist',$data);
   }

public function chdListEXCEL($i,$j,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_chdbenchmarklistEXCEL($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i+1,$j);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 CHD Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
     $data['i']=$i;
     $data['j']=$j;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/chdlistEXCEL',$data);
   }
public function VascularDetail($id,$qYear='3000',$qMonth='1',$qYearEnd='3000',$qMonthEnd='1'){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $ans=null;
     
     if($qYear!="" && $qMonth!=""){
       
        $ans=$this->Analysis_Model->query_VascularDetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,$id);
      // $ans[9][0]= $ans[$i][0];
 
     //
         }
     
     
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 CHD Outcome】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
    
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/Vasculardetail',$data);
   }


public function chdmortality(){
              $data['page']="analysis";  
              $data['subpage']="chdmortality";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     
     $data['total']='0';
     $data['child']='0';
     $data['adult']='0';
     $data['Noncardiac']='0';
   
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
     $data['b1']='0';
     $data['b2']='0';
     $data['b3']='0';
     $data['b4']='0';
     $data['b5']='0';
     $data['b6']='0';
     $data['b7']='0';
     $data['b8']='0';
     $data['b9']='0';
     $data['b10']='0';
     $data['b11']='0';
     $data['b12']='0';
     $data['b13']='0';
     $data['b14']='0';
     
      $data['c1']='0';
     $data['c2']='0';
     $data['c3']='0';
     $data['c4']='0';
     $data['c5']='0';
     $data['c6']='0';
     $data['c7']='0';
     $data['c8']='0';
      $data['d1']='0';
     $data['d2']='0';
     $data['d3']='0';
     $data['d4']='0';
     $data['d5']='0';
     $data['d6']='0';
     $data['d7']='0';
     $data['d8']='0';
     
     $data['e1']='0';
     $data['e2']='0';
     $data['e3']='0';
     $data['e4']='0';
     $data['e5']='0';
     $data['e6']='0';
     $data['e7']='0';
     $data['e8']='0';
     $data['e9']='0';
     $data['e10']='0';
     $data['e11']='0';
     $data['e12']='0';
     $data['e13']='0';
     $data['e14']='0';
     $data['f1']='0';
     $data['f2']='0';
     $data['f3']='0';
     $data['f4']='0';
     $data['f5']='0';
     $data['f6']='0';
     $data['f7']='0';
     $data['f8']='0';
     $data['f9']='0';
     $data['f10']='0';
     $data['f11']='0';
     $data['f12']='0';
     $data['f13']='0';
     $data['f14']='0';
     
      $data['g1']='0';
     $data['g2']='0';
     $data['g3']='0';
     $data['g4']='0';
     $data['g5']='0';
     $data['g6']='0';
     $data['g7']='0';
     $data['g8']='0';
     $data['h1']='0';
     $data['h2']='0';
     $data['h3']='0';
     $data['h4']='0';
     $data['h5']='0';
     $data['h6']='0';
     $data['h7']='0';
     $data['h8']='0';
     if($qYear!="" && $qMonth!=""){
      
        $data['a1']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','0')->row()->num;
     $data['a2']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','0')->row()->num;
     $data['a3']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','0')->row()->num;
     $data['a4']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','0')->row()->num;
     $data['a5']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','0')->row()->num;
     $data['a6']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','0')->row()->num;
     $data['a7']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','0')->row()->num;
     $data['a8']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','0')->row()->num;
     $data['a9']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9','0')->row()->num;
     $data['a10']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10','0')->row()->num;
     $data['a11']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11','0')->row()->num;
     $data['a12']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12','0')->row()->num;
     $data['a13']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13','0')->row()->num;
     $data['a14']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14','0')->row()->num;
     
     $data['b1']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','1')->row()->num;
     $data['b2']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','1')->row()->num;
     $data['b3']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','1')->row()->num;
     $data['b4']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','1')->row()->num;
     $data['b5']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','1')->row()->num;
     $data['b6']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','1')->row()->num;
     $data['b7']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','1')->row()->num;
     $data['b8']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','1')->row()->num;
     $data['b9']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9','1')->row()->num;
     $data['b10']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10','1')->row()->num;
     $data['b11']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11','1')->row()->num;
     $data['b12']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12','1')->row()->num;
     $data['b13']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13','1')->row()->num;
     $data['b14']=$this->Analysis_Model->query_chdmortalitySTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14','1')->row()->num;
     
      $data['c1']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','0')->row()->num;
     $data['c2']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','0')->row()->num;
     $data['c3']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','0')->row()->num;
     $data['c4']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','0')->row()->num;
     $data['c5']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','0')->row()->num;
     $data['c6']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','0')->row()->num;
     $data['c7']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','0')->row()->num;
     $data['c8']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','0')->row()->num;
     
     $data['d1']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','1')->row()->num;
     $data['d2']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','1')->row()->num;
     $data['d3']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','1')->row()->num;
     $data['d4']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','1')->row()->num;
     $data['d5']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','1')->row()->num;
     $data['d6']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','1')->row()->num;
     $data['d7']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','1')->row()->num;
     $data['d8']=$this->Analysis_Model->query_chdmortalityBenchmarkSTD($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','1')->row()->num;
     
     
      $data['e1']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','0')->row()->num;
     $data['e2']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','0')->row()->num;
     $data['e3']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','0')->row()->num;
     $data['e4']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','0')->row()->num;
     $data['e5']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','0')->row()->num;
     $data['e6']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','0')->row()->num;
     $data['e7']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','0')->row()->num;
     $data['e8']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','0')->row()->num;
     $data['e9']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9','0')->row()->num;
     $data['e10']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10','0')->row()->num;
     $data['e11']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11','0')->row()->num;
     $data['e12']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12','0')->row()->num;
     $data['e13']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13','0')->row()->num;
     $data['e14']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14','0')->row()->num;
     
     $data['f1']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','1')->row()->num;
     $data['f2']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','1')->row()->num;
     $data['f3']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','1')->row()->num;
     $data['f4']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','1')->row()->num;
     $data['f5']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','1')->row()->num;
     $data['f6']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','1')->row()->num;
     $data['f7']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','1')->row()->num;
     $data['f8']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','1')->row()->num;
     $data['f9']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9','1')->row()->num;
     $data['f10']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10','1')->row()->num;
     $data['f11']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11','1')->row()->num;
     $data['f12']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12','1')->row()->num;
     $data['f13']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13','1')->row()->num;
     $data['f14']=$this->Analysis_Model->query_chdmortality($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14','1')->row()->num;
     
      $data['g1']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','0')->row()->num;
     $data['g2']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','0')->row()->num;
     $data['g3']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','0')->row()->num;
     $data['g4']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','0')->row()->num;
     $data['g5']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','0')->row()->num;
     $data['g6']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','0')->row()->num;
     $data['g7']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','0')->row()->num;
     $data['g8']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','0')->row()->num;
     
     $data['h1']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1','1')->row()->num;
     $data['h2']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2','1')->row()->num;
     $data['h3']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3','1')->row()->num;
     $data['h4']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4','1')->row()->num;
     $data['h5']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5','1')->row()->num;
     $data['h6']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6','1')->row()->num;
     $data['h7']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7','1')->row()->num;
     $data['h8']=$this->Analysis_Model->query_chdmortalityBenchmark($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8','1')->row()->num;
     
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Congenital Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/chdmortality',$data);
   }
public function CRmorning()
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
        
      $d1=$this->input->post('qDate1')==null?"1900-01-01":$this->input->post('qDate1');
     $d2=$this->input->post('qDate2')==null?"1900-01-01":$this->input->post('qDate2');
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('homenew',$data);
         $this->load->model('Analysis_model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->Analysis_model->query_CRmeeting($d1,$d2);
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'CR morning meeting報表Open Heart (期間:'.$d1.'~'.$d2.')','S');
      }
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
     if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
       $data['page']="analysis";  
       $data['subpage']="CRmorning";    
        $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
        $this->load->view('analysis/CRmorning',$data);
    }
   public function CRmorningVascular()
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
        
      $d1=$this->input->post('qDate1')==null?"1900-01-01":$this->input->post('qDate1');
     $d2=$this->input->post('qDate2')==null?"1900-01-01":$this->input->post('qDate2');
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('homenew',$data);
         $this->load->model('Analysis_model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->Analysis_model->query_CRmeetingVascular($d1,$d2);
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'CR morning meeting報表Vascular (期間:'.$d1.'~'.$d2.')','S');
      }
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
     if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
       $data['page']="analysis";  
       $data['subpage']="CRmorning";    
        $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
        $this->load->view('analysis/CRmorningVascular',$data);
    }

public function EXCELCRMeeting($qDate1,$qDate2)
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
        
      $d1=$qDate1==null?"1900-01-01":$qDate1;
     $d2=$qDate2==null?"1900-01-01":$qDate2;
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('homenew',$data);
         $this->load->model('Analysis_model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->Analysis_model->query_CRmeeting($d1,$d2);
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'CR morning meeting報表Vascular (期間:'.$d1.'~'.$d2.')','S');
      }
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
     if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
       $data['page']="analysis";  
       $data['subpage']="CRmorning";    
        $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
        $this->load->view('analysis/EXCELCRMeeting.php',$data);
    }
   public function EXCELVascularCRMeeting($qDate1,$qDate2)
    {
         $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'homenew', 'refresh');
        
      $d1=$qDate1==null?"1900-01-01":$qDate1;
     $d2=$qDate2==null?"1900-01-01":$qDate2;
        $data['result_msg']='';
        $data['patientList']='';
        //$this->load->view('homenew',$data);
         $this->load->model('Analysis_model');
      if( $d1!='' &&  $d2!=''){
        $data['patientList']=$this->Analysis_model->query_CRmeetingVascular($d1,$d2);
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'CR morning meeting報表Vascular (期間:'.$d1.'~'.$d2.')','S');
      }
      if($d1=='1900-01-01') 
      $data['d1']='';
    else
      $data['d1']=$d1;
     if($d2=='1900-01-01') 
      $data['d2']='';
    else
      $data['d2']=$d2;
       $data['page']="analysis";  
       $data['subpage']="CRmorning";    
        $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
        $this->load->view('analysis/EXCELVascularCRMeeting.php',$data);
    }

public function resident(){
    $ans1="";
    $vsID="";
    $vsType="";
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $patientSurgeon=$this->session->userdata('userID');
     $vsType="R";
     
     if( $qYear!='' &&  $qMonth!=''){
         
        $ans1=$this->Analysis_Model->query_vsoperationList($qYear,$qMonth,$qYearEnd,$qMonthEnd,$patientSurgeon,$vsType);
               
      
       $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 住院醫師學會統計表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
     
    $this->load->model('Parameter_Model');  
        
     $vsList = $this->Parameter_Model->query_vsList();
     $data['vsList']=$vsList;  
     $data['page']="analysis";  
     $data['subpage']="doctor";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會手術統計申報表</li>";
     $data['patientList']=$ans1;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['vsID']=$patientSurgeon;
     $data['vsType']=$vsType;
     
     //看是否顯示病人全名--開始
       $this->load->model('Parameter_Model');
        $hospitalsystem= $this->Parameter_Model->query_system()->row()->patientname;   
        $data['hospitalsystem']=$hospitalsystem;
        
       //看是否顯示病人全名--結束
     
       $this->load->view('analysis/resident',$data); 
}


public function EXCELresident($qYear,$qMonth,$qYearEnd,$qMonthEnd){
    $ans1="";
    $vsID="";
    $vsType="";
    // $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
    // $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
    // $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
   //  $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $patientSurgeon=$this->session->userdata('userID');
     $vsType="R";
     
     if( $qYear!='' &&  $qMonth!=''){
         
        $ans1=$this->Analysis_Model->query_vsoperationList($qYear,$qMonth,$qYearEnd,$qMonthEnd,$patientSurgeon,$vsType);
         $ans2=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$this->session->userdata('userID'));      
        for($i=0;$i<15;$i++){
        $myans[$i]=$this->Analysis_Model->query_complication($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$this->session->userdata('userID'));
         }
       $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 住院醫師學會統計表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
     
    $this->load->model('Parameter_Model');  
        
     $vsList = $this->Parameter_Model->query_vsList();
     $data['vsList']=$vsList;  
     $data['page']="analysis";  
     $data['subpage']="doctor";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會手術統計申報表</li>";
     $data['patientList']=$ans1;
     $data['associateList']=$ans2;
     $data['answer']=$myans;
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['vsID']=$patientSurgeon;
     $data['vsType']=$vsType;
     
     //看是否顯示病人全名--開始
       $this->load->model('Parameter_Model');
        $hospitalsystem= $this->Parameter_Model->query_system()->row()->patientname;   
        $data['hospitalsystem']=$hospitalsystem;
        
       //看是否顯示病人全名--結束
     
       $this->load->view('analysis/EXCELResident',$data); 
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */