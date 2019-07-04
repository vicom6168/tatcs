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
        redirect(base_url().'home', 'refresh');
         
        $this->load->model('Analysis_Model');
        $this->load->helper('form');
    }
    
	public function index()
	{
	      $ans[17]=0;
	    for($i=1;$i<=16;$i++){
	    $ans[$i]=0;
        }
        $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
	 $qryHospital=$this->input->post('qryHospital')==null?"":$this->input->post('qryHospital');
     if( $qYear!='' &&  $qMonth!=''){
         for($i=1;$i<=14;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$qryHospital)->row()->num;
               $ans[17]+=(int)$ans[$i];
        }
         $all_num=0;
      $noneopenheart_item1=0;  
      $noneopenheart_item5=0;
      $all_num=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
      $noneopenheart_item1=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
      $noneopenheart_item5=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;  
     $ans[14]=  (int)$ans[14]+((int)$noneopenheart_item1)/2;
      $ans[15]=  ((int)$noneopenheart_item1)/2;
      $ans[17]=  (int)$all_num+(int)$noneopenheart_item1+(int)$noneopenheart_item5;
      $ans[16]=(int)$ans[17]-(int)$ans[1]-(int)$ans[2]-(int)$ans[3]-(int)$ans[4]-(int)$ans[5]-(int)$ans[6]-(int)$ans[7]-(int)$ans[8]-(int)$ans[9]-(int)$ans[10]-(int)$ans[11]-(int)$ans[12]-(int)$ans[13]-floatval($ans[14])-floatval($ans[15]);
          $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 學會分類報表】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
	    $data['page']="analysis";  
     $data['subpage']="associate";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li><li>1. 學會分類報表</li>";
     $data['answer']=$ans;
      $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
	 $data['qHospital']=$qryHospital;
	  $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
		$this->load->view('analysis/index',$data);
	}
        public function PDF($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h)
    {
        $ans[17]=0;
        for($i=1;$i<=16;$i++){
        $ans[$i]=0;
        }
      $h=urldecode($h);
     if( $qYear!='' &&  $qMonth!=''){
         for($i=1;$i<=14;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$h)->row()->num;
              $ans[17]+=$ans[$i];
        }
		  $all_num=0;
      $noneopenheart_item1=0;  
      $noneopenheart_item5=0;
      $all_num=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
      $noneopenheart_item1=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
      $noneopenheart_item5=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;  
      $ans[14]=  (int)$ans[14]+((int)$noneopenheart_item1)/2;
      $ans[15]=  ((int)$noneopenheart_item1)/2;
      $ans[17]=  (int)$all_num+(int)$noneopenheart_item1+(int)$noneopenheart_item5;
      $ans[16]=(int)$ans[17]-(int)$ans[1]-(int)$ans[2]-(int)$ans[3]-(int)$ans[4]-(int)$ans[5]-(int)$ans[6]-(int)$ans[7]-(int)$ans[8]-(int)$ans[9]-(int)$ans[10]-(int)$ans[11]-(int)$ans[12]-(int)$ans[13]-floatval($ans[14])-floatval($ans[15]);
         
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
     public function EXCEL($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h)
    {
        $ans[17]=0;
        for($i=1;$i<=16;$i++){
        $ans[$i]=0;
        }
       $h=urldecode($h);
    if($qYear!='' &&  $qMonth!=''){
         for($i=1;$i<=14;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$h)->row()->num;
              $ans[17]+=$ans[$i];
        }
		  $all_num=0;
      $noneopenheart_item1=0;  
      $noneopenheart_item5=0;
      $all_num=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
      $noneopenheart_item1=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
      $noneopenheart_item5=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;  
     $ans[14]=  (int)$ans[14]+((int)$noneopenheart_item1)/2;
      $ans[15]=  ((int)$noneopenheart_item1)/2;
      $ans[17]=  (int)$all_num+(int)$noneopenheart_item1+(int)$noneopenheart_item5;
      $ans[16]=(int)$ans[17]-(int)$ans[1]-(int)$ans[2]-(int)$ans[3]-(int)$ans[4]-(int)$ans[5]-(int)$ans[6]-(int)$ans[7]-(int)$ans[8]-(int)$ans[9]-(int)$ans[10]-(int)$ans[11]-(int)$ans[12]-(int)$ans[13]-floatval($ans[14])-floatval($ans[15]);
         
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
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
      $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
     
     $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
        $data['adult']=$data['total']-$data['child'];
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive Summary】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');
        
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $data['hospital']=$qryHospital;
       $this->load->view('analysis/executivesummary',$data);
   }
public function PDFsummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
              $data['page']="analysis";  
     $h=urldecode($h);
      $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
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
public function EXCELsummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
              $data['page']="analysis";  
     $h=urldecode($h);
      $data['total']='0';
     $data['child']='0';
     $data['Noncardiac']='0';
     $data['adult']='0';
     if($qYear!="" && $qMonth!=""){
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
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
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
        $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
        
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
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$qryHospital)->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$qryHospital)->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$qryHospital)->row()->num;
     $data['ans9']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$qryHospital)->row()->num;
     $data['ans10']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$qryHospital)->row()->num;
     $data['ans11']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8']-$data['ans9']-$data['ans10'];
     
     $data['a1']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$qryHospital)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$qryHospital)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$qryHospital)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$qryHospital)->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$qryHospital)->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$qryHospital)->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$qryHospital)->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$qryHospital)->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$qryHospital)->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$qryHospital)->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$qryHospital)->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$qryHospital)->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'18',$qryHospital)->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Adult Cardiac Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');     

}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
      $data['hospital']=$qryHospital;
       $this->load->view('analysis/executivesummaryadult',$data);
   }
public function PDFadult($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
              $data['page']="analysis";  
     $h=urldecode($h);
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
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['ans9']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8'];
     
      $data['a1']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
        $data['a2']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$h)->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$h)->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$h)->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$h)->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$h)->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$h)->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$h)->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$h)->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'18',$h)->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Adult Cardiac Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');       
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/PDFadult',$data);
   }
public function EXCELadult($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
              $data['page']="analysis";  
     $h=urldecode($h);
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
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
     //
        $data['ans1']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['ans2']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['ans3']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['ans4']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['ans5']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['ans6']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['ans7']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['ans8']=$this->Analysis_Model->query_executivesummarydetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['ans9']=$data['adult']-$data['ans1']-$data['ans2']-$data['ans3']-$data['ans4']-$data['ans5']-$data['ans6']-$data['ans7']-$data['ans8'];
     
      $data['a1']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$h)->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$h)->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$h)->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$h)->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$h)->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$h)->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$h)->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$h)->row()->num;
     $data['a18']=$this->Analysis_Model->query_executivesummarydetail2($qYear,$qMonth,$qYearEnd,$qMonthEnd,'18',$h)->row()->num;
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
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
     
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
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
       $data['adult']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'0',$qryHospital)->row()->num; 
     $data['a1']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$qryHospital)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$qryHospital)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$qryHospital)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$qryHospital)->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$qryHospital)->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$qryHospital)->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$qryHospital)->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$qryHospital)->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$qryHospital)->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$qryHospital)->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$qryHospital)->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$qryHospital)->row()->num;
     $data['b4']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['b5']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
     $data['b6']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$qryHospital)->row()->num;
     $data['b7']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$qryHospital)->row()->num;
     $data['b8']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$qryHospital)->row()->num;
     $data['b9']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$qryHospital)->row()->num;
     $data['b10']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$qryHospital)->row()->num;
     $data['b11']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$qryHospital)->row()->num;
     $data['b12']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$qryHospital)->row()->num;
     $data['b13']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$qryHospital)->row()->num;
     $data['b14']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$qryHospital)->row()->num;
     $data['b15']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$qryHospital)->row()->num;
     $data['b16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$qryHospital)->row()->num;
     $data['b17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$qryHospital)->row()->num;
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Congenital Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
     }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $data['hospital']=$qryHospital;
     $this->load->view('analysis/executivesummarychild',$data);
   }

public function PDFchild($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
           $data['page']="analysis";  
     $h=urldecode($h);
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
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
       $data['adult']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'0',$h)->row()->num; 
     $data['a1']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$h)->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$h)->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$h)->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$h)->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$h)->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$h)->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$h)->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$h)->row()->num;
     $data['b4']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['b5']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['b6']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['b7']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['b8']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['b9']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
     $data['b10']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$h)->row()->num;
     $data['b11']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$h)->row()->num;
     $data['b12']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$h)->row()->num;
     $data['b13']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$h)->row()->num;
     $data['b14']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$h)->row()->num;
     $data['b15']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$h)->row()->num;
     $data['b16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$h)->row()->num;
     $data['b17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$h)->row()->num;
        $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Congenital Surgery】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');        
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/PDFchild',$data);
   }
public function EXCELchild($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
           $data['page']="analysis";  
     $h=urldecode($h);
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
       $data['total']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['child']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['Noncardiac']=$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->num_rows() ==0?"0":$this->Analysis_Model->query_executivesummary($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['adult']=$data['total']-$data['child'];
     
       $data['adult']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'0',$h)->row()->num; 
     $data['a1']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
     $data['a10']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$h)->row()->num;
     $data['a11']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$h)->row()->num;
     $data['a12']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$h)->row()->num;
     $data['a13']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$h)->row()->num;
     $data['a14']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$h)->row()->num;
     $data['a15']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$h)->row()->num;
     $data['a16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$h)->row()->num;
     $data['a17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$h)->row()->num;
     $data['b4']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['b5']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['b6']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['b7']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['b8']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['b9']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
     $data['b10']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'10',$h)->row()->num;
     $data['b11']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'11',$h)->row()->num;
     $data['b12']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'12',$h)->row()->num;
     $data['b13']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'13',$h)->row()->num;
     $data['b14']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'14',$h)->row()->num;
     $data['b15']=$this->Analysis_Model->query_executivesummarychildPure($qYear,$qMonth,$qYearEnd,$qMonthEnd,'15',$h)->row()->num;
     $data['b16']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'16',$h)->row()->num;
     $data['b17']=$this->Analysis_Model->query_executivesummarychild($qYear,$qMonth,$qYearEnd,$qMonthEnd,'17',$h)->row()->num;
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
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
    
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
       $data['a1']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$qryHospital)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$qryHospital)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$qryHospital)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$qryHospital)->row()->num;
      $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
    }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $data['hospital']=$qryHospital;
     $this->load->view('analysis/executivesummarynonopenheart',$data);
   }

public function PDFnonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
       $data['page']="analysis";  
     $h=urldecode($h);
   
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
       $data['a1']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
   $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'列印PDF報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
    }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/PDFnonopenheart',$data);
   }

public function EXCELnonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,$h){
       $data['page']="analysis";  
     $h=urldecode($h);
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
       $data['a1']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$h)->row()->num;
     $data['a2']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$h)->row()->num;
     $data['a3']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$h)->row()->num;
     $data['a4']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$h)->row()->num;
     $data['a5']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$h)->row()->num;
     $data['a6']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'6',$h)->row()->num;
     $data['a7']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'7',$h)->row()->num;
     $data['a8']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'8',$h)->row()->num;
     $data['a9']=$this->Analysis_Model->query_executivesummarynonopenheart($qYear,$qMonth,$qYearEnd,$qMonthEnd,'9',$h)->row()->num;
    $access_id=accessLog('R','ANALYSIS',$this->session->userdata('userID'),$this->session->userdata('userRealname').'輸出EXCEL報表【 Executive summary of Non Open Heart】(期間:'.$qYear.'/'.$qMonth.'~'.$qYearEnd.'/'.$qMonthEnd.')','S');   
}
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $this->load->view('analysis/EXCELnonopenheart',$data);
   }

public function adultoutcome(){
        $data['page']="analysis"; 
     $data['subpage']="adult";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
        $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
    
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
        $ans[$i][0]=$this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'0',$qryHospital)->row()->num;
      // $ans[9][0]= $ans[$i][0];
      $ans[$i][9]=$this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'9',$qryHospital)->row()->num;
    $ans[$i][10]=round($this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,'9',$qryHospital)->row()->myavg,2);
     for($j=0;$j<8;$j++){
         $ans[11][$j+1]=$ans[$i][0];
     if($ans[$i][0]==0){
         $this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1,$qryHospital)->row();
                $ans[$i][$j+1]=0;
       
     } else {
     //$ans[$i][$j+1]=round($this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1)->row()->num*100/$ans[$i][0],2);
     $ans[$i][$j+1]=$this->Analysis_Model->query_executivesummarydetail1($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$j+1,$qryHospital)->row()->num;
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
       
       
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $data['ans']=$ans;
      $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $data['hospital']=$qryHospital;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
       $this->load->view('analysis/adultoutcome',$data);
   }
    public function urgency(){
              $data['page']="analysis";  
              $data['subpage']="urgency";   
     $qYear=$this->input->post('qYear')==null?"":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"":$this->input->post('qMonthEnd');
     $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
     $data['a1']='0';
     $data['a2']='0';
     $data['a3']='0';
     $data['a4']='0';
     $data['a5']='0';
    
     $data['b1']='0';
     $data['b2']='0';
     $data['b3']='0';
     $data['b4']='0';
     $data['b5']='0';
     
     if($qYear!="" && $qMonth!=""){
      
        $data['a1']=$this->Analysis_Model->query_urgency($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['a2']=$this->Analysis_Model->query_urgency($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['a3']=$this->Analysis_Model->query_urgency($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['a4']=$this->Analysis_Model->query_urgency($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['a5']=$this->Analysis_Model->query_urgency($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
    
     $data['b1']=$this->Analysis_Model->query_euroscore($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital)->row()->num;
     $data['b2']=$this->Analysis_Model->query_euroscore($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital)->row()->num;
     $data['b3']=$this->Analysis_Model->query_euroscore($qYear,$qMonth,$qYearEnd,$qMonthEnd,'3',$qryHospital)->row()->num;
     $data['b4']=$this->Analysis_Model->query_euroscore($qYear,$qMonth,$qYearEnd,$qMonthEnd,'4',$qryHospital)->row()->num;
     $data['b5']=$this->Analysis_Model->query_euroscore($qYear,$qMonth,$qYearEnd,$qMonthEnd,'5',$qryHospital)->row()->num;
       }
        $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
       $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $data['hospital']=$qryHospital;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/urgency',$data);
   }

    public function casenumber(){
              $data['page']="casenumber";  
     $data['subpage']="urgency";   
     $currenYear=Date('Y');
     $qYear=$this->input->post('qYear')==null?"2010":$this->input->post('qYear');
     $qMonth=$this->input->post('qMonth')==null?"1":$this->input->post('qMonth');
     $qYearEnd=$this->input->post('qYearEnd')==null?"2019":$this->input->post('qYearEnd');
     $qMonthEnd=$this->input->post('qMonthEnd')==null?"1":$this->input->post('qMonthEnd');
     $qryHospital=$this->input->post('qryHospital')==null?"0":urldecode($this->input->post('qryHospital'));
     //暫時查詢全部資料
     /*
       $qYear='2010';
     $qMonth='1';
     $qYearEnd='2050';
     $qMonthEnd='12';
     
     */
     $qryHospital='0';
     if($qYear!="" && $qMonth!=""){
      
        $data['uploadnumber']=$this->Analysis_Model->query_uploadnumber($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital);
     $data['registernumber']=$this->Analysis_Model->query_registernumber($qYear,$qMonth,$qYearEnd,$qMonthEnd,'1',$qryHospital);
      $data['uploadnumberChild']=$this->Analysis_Model->query_uploadnumber($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital);
     $data['registernumberChild']=$this->Analysis_Model->query_registernumber($qYear,$qMonth,$qYearEnd,$qMonthEnd,'2',$qryHospital);
     
       }
     $data['qYear']=$qYear;
     $data['qMonth']=$qMonth;
     $data['qYearEnd']=$qYearEnd;
     $data['qMonthEnd']=$qMonthEnd;
     $this->load->model('Hospital_Model');
     $hospital = $this->Hospital_Model->query_hospitalList();  
     $data['hospitalList']=$hospital;
     $data['hospital']=$qryHospital;
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $this->load->view('analysis/casenumber',$data);
   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */