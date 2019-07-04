<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nonopenheart extends CI_Controller {

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
         
        $this->load->model('Nonopenheart_Model');
        $this->load->helper('form');
    }
    
	public function index($year="",$month="",$h="")
	{
	      $data['page']="nonopenheart";  
     $data['path']="<li>非開心手術</li><li  class='break'>&#187;</li>";
     if($year==""){
         $year=date('Y');
     }
     if($month==""){
         $month=date('m');
     }
       $data['qYear']=$year;
     $data['qMonth']=$month;
     $data['qHospital']=urldecode($h);
     $this->load->model('Hospital_Model');
      $hospital = $this->Hospital_Model->query_hospitalList();  
      $data['hospitalList']=$hospital;
    // $access_id=accessLog('R','NONEOPENHEART',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢【 Non-Open Heart】(月份:'.$year.'/'.$month.')','S');
		$this->load->view('nonopenheart/index',$data);
	}
   
    function savenonopenheart(){
         $year=$this->input->post('qyear');
      $month=$this->input->post('qmonth');
      $hospital=$this->input->post('qhospital');
        $query = $this->Nonopenheart_Model->query_nonopenheart($hospital,$year,$month);
        if($query->num_rows() ==1){
                $this->load->library('nonopenheartClass');
         $nonopenheartClass= new nonopenheartClass;
         $nonopenheartClass=$query->row();
         $nonopenheartClass->item1=$this->input->post('item1');
         $nonopenheartClass->item2=$this->input->post('item2');
         $nonopenheartClass->item3=$this->input->post('item3');
         $nonopenheartClass->item4=$this->input->post('item4');
         $nonopenheartClass->item5=$this->input->post('item5');
         $nonopenheartClass->item6=$this->input->post('item6');
         $nonopenheartClass->item7=$this->input->post('item7');
         $nonopenheartClass->item8=$this->input->post('item8');
         $nonopenheartClass->item9=$this->input->post('item9');
         $nonopenheartClass->item10='0';
         $nonopenheartClass->updateTime=date('Y-m-d h:i:s');
         $logStr="";
         $logStr.="<br/>Endovascular approach great vessel surgery:".$this->input->post('item1');
         $logStr.="<br/>Central venous surgery:".$this->input->post('item2');
         $logStr.="<br/>Supra-aortic artery surgery:".$this->input->post('item3');
         $logStr.="<br/>Surgery for visceral vessel disease:".$this->input->post('item4');
         $logStr.="<br/>Surgery for peripheral artery disease:".$this->input->post('item5');
         $logStr.="<br/>Surgery for peripheral venous disease:".$this->input->post('item6');
         $logStr.="<br/>Surgery for vascular access:".$this->input->post('item7');
         $logStr.="<br/>ECMO implantation:".$this->input->post('item8');
         $logStr.="<br/>Other intrathoracic surgery:".$this->input->post('item9');
         $this->Nonopenheart_Model->update_nonopenheart($nonopenheartClass->nid,$nonopenheartClass);
              $arr=array('status'=>'success','result'=>$query->result());
              $access_id=accessLog('U','NONEOPENHEART',$nonopenheartClass->nid,$this->session->userdata('userRealname').'輸入【 Non-Open Heart】(月份:'.$year.'/'.$month.')'.$logStr,'S');
        
        } else {
            $this->load->library('nonopenheartClass');
         $nonopenheartClass= new nonopenheartClass;
         $nonopenheartClass->qYear=$year;
         $nonopenheartClass->qMonth=$month;
         $nonopenheartClass->item1=$this->input->post('item1');
         $nonopenheartClass->item2=$this->input->post('item2');
         $nonopenheartClass->item3=$this->input->post('item3');
         $nonopenheartClass->item4=$this->input->post('item4');
         $nonopenheartClass->item5=$this->input->post('item5');
         $nonopenheartClass->item6=$this->input->post('item6');
         $nonopenheartClass->item7=$this->input->post('item7');
         $nonopenheartClass->item8=$this->input->post('item8');
         $nonopenheartClass->item9=$this->input->post('item9');
         $nonopenheartClass->item10='0';
         $nonopenheartClass->inertTime=date('Y-m-d h:i:s');
          $this->Nonopenheart_Model->save_nonopenheart($nonopenheartClass);
             $arr=array('status'=>'fail','result'=>'');
        }
         echo json_encode($arr);
     }
    
    function querynonopenheart(){
         $year=$this->input->post('qyear');
      $month=$this->input->post('qmonth');
      $hospital=$this->input->post('qhospital');
        $query = $this->Nonopenheart_Model->query_nonopenheart($hospital,$year,$month);
        if($query->num_rows() ==1){
              $arr=array('status'=>'success','result'=>$query->result());
         $access_id=accessLog('R','NONEOPENHEART',$query->row()->nid,$this->session->userdata('userRealname').'查詢【 Non-Open Heart】(月份:'.$year.'/'.$month.')','S');
        
        } else {
             $arr=array('status'=>'fail','result'=>'');
        }
         echo json_encode($arr);
    }
    
      function querynonopenheartlist(){
       $hospital=$this->input->post('qhospital');
            $query = $this->Nonopenheart_Model->query_nonopenheartlist($hospital);
        if($query->num_rows() >0){
              $arr=array('status'=>'success','result'=>$query->result());
        } else {
             $arr=array('status'=>'fail','result'=>'');
        }
         echo json_encode($arr);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */