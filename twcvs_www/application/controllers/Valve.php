<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Valve extends CI_Controller {

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
      
         
        $this->load->model('Valve_Model');
        $this->load->helper('form');
    }
    
	public function index($year="",$month="",$h="")
	{
	      if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
	    $data['page']="parameter"; 
	   $data['subpage']="valve";  
       $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Valve Management</li>";
   
    
      $valve = $this->Valve_Model->query_valveList();  
      $data['valveList']=$valve;
    // $access_id=accessLog('R','NONEOPENHEART',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢【 Non-Open Heart】(月份:'.$year.'/'.$month.')','S');
		$this->load->view('valve/index',$data);
	}
   function newValve(){
         if($this->session->userdata('userID')=="")
         redirect(base_url().'home', 'refresh');
        $data['page']="parameter";    
        $data['subpage']="valve"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Valve Management</li>";
        $data['msg']="";  
        $this->load->view('valve/newValve',$data);
   }
    function saveValve(){
          if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
       $data['page']="parameter";    
       $data['subpage']="valve"; 
       $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Valve Management</li>";
       $data['msg']="";
      $valveExist=0;
        $this->load->library('valveClass');
        $valveClass= new valveClass;
        $id=  $this->input->post('valvecode');
        $valveExist= $this->Valve_Model->query_valve($id)->num_rows();
         
        if($valveExist==0){
       $valveClass->valvecode=$this->input->post('valvecode');
       $valveClass->valvesimplifiedname=$this->input->post('valvesimplifiedname');
       $valveClass->valveproductname=$this->input->post('valveproductname');
       
       $valveClass->valvecategory=$this->input->post('valvecategory');
       $valveClass->valvecompany=$this->input->post('valvecompany');
       $valveClass->isDeleted='N';
       
         $insert_id=$this->Valve_Model->save_valve($valveClass);
         $access_id=accessLog('A','Valve',$this->session->userdata('userID'),$this->session->userdata('userRealname').'新增瓣膜【id:'.$insert_id.'】','S');
        }
        redirect(base_url().'valve/index', 'refresh');
  
        
             
            
       
     }
    
    function viewRecord($id){
          if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
     $data['page']="parameter";    
     $data['subpage']="valve"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Valve Management</li>";
     
      $query = $this->Valve_Model->query_valve($id);
      $data['valve']=$query->row();
      $data['msg']="";
      $this->load->view('valve/viewRecord',$data);
       
    }
    
      function updatevalve(){
            if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
      $data['page']="parameter";    
     $data['subpage']="valve"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Valve Management</li>";
    $data['msg']="";
      
        $id=$this->input->post('valveID');
        $this->load->library('valveClass');
        $valveClass= new valveClass;
        $valveClass= $this->Valve_Model->query_valve($id)->row();
         
       $valveClass->valvecode=$this->input->post('valvecode');
       $valveClass->valvesimplifiedname=$this->input->post('valvesimplifiedname');
       $valveClass->valveproductname=$this->input->post('valveproductname');
       
       $valveClass->valvecategory=$this->input->post('valvecategory');
       $valveClass->valvecompany=$this->input->post('valvecompany');
       
         $this->Valve_Model->update_valve($id,$valveClass);
        $query = $this->Valve_Model->query_valve($id);
         $data['valve']=$query->row();
        $data['msg']="Update Valve Successlly"; 
        $access_id=accessLog('U','VALVE',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改瓣膜【id:'.$id.'】','S');
        
        $this->load->view('valve/viewRecord',$data);
        
   
    }
    
    
    public function deleteRecord($id)
    {
          if($this->session->userdata('userID')=="")
          redirect(base_url().'home', 'refresh');
         $data['page']="parameter";    
         $data['subpage']="valve"; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Valve Management</li>";
         $query = $this->Valve_Model->delete_valve($id);
         $access_id=accessLog('D','Valve',$this->session->userdata('userID'),$this->session->userdata('userRealname').'刪除瓣膜【id:'.$id.'】','S');
        
        redirect(base_url().'valve/index', 'refresh');
    }
    
    function deleteImage($id){
          if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
         $data['page']="parameter";    
     $data['subpage']="advertisement"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
   
      
        $this->load->library('advertisementClass');
        $advertisementClass= new advertisementClass;
        $advertisementClass= $this->Advertisement_Model->query_ad($id)->row();
        $this->load->helper("file");
        //echo $advertisementClass->abanner;
      unlink('./uploads/'.$advertisementClass->abanner);
    
         $advertisementClass->abanner='';
       
        $this->Advertisement_Model->update_ad($id,$advertisementClass);
        $query = $this->Advertisement_Model->query_ad($id);
        $data['advertisement']=$query->row();
        $data['msg']="Delete Advertisement Image Successlly"; 
        $access_id=accessLog('U','ADVERTISEMENT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'刪除廣告圖檔【id:'.$id.'】','S');
        
        $this->load->view('advertisement/viewRecord',$data);
    
    }

  function goout($id){
    $data['page']="parameter";    
     $data['subpage']="advertisement"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
     
      $query = $this->Advertisement_Model->go_ad($id)->row();
      if($query->alink!=""){
          redirect($query->alink, 'refresh');
      } else {
         redirect(base_url().'', 'refresh');
      }
       
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */