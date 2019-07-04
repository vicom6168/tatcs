<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends CI_Controller {

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
      
         
        $this->load->model('Advertisement_Model');
        $this->load->helper('form');
    }
    
	public function index($year="",$month="",$h="")
	{
	      if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
	    $data['page']="parameter"; 
	   $data['subpage']="advertisement";  
       $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
   
    
      $ad = $this->Advertisement_Model->query_adList();  
      $data['advertisementList']=$ad;
    // $access_id=accessLog('R','NONEOPENHEART',$this->session->userdata('userID'),$this->session->userdata('userRealname').'查詢【 Non-Open Heart】(月份:'.$year.'/'.$month.')','S');
		$this->load->view('advertisement/index',$data);
	}
   function newAd(){
         if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
       $data['page']="parameter";    
     $data['subpage']="advertisement"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
       $data['msg']="";  
        $this->load->view('advertisement/newAd',$data);
   }
    function saveAd(){
          if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
       $data['page']="parameter";    
     $data['subpage']="advertisement"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
      $data['msg']="";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
    
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("abanner"))
        {
            $error = array('error' => $this->upload->display_errors());
         $data['msg']="Banner上傳失敗";
           echo $this->upload->display_errors();
     //    $this->load->view('advertisement/newAd',$data);
        }
        else
        {
            $uploaddata = array('upload_data' => $this->upload->data());
      //   echo $data['upload_data']['file_size'];
             $this->load->library('advertisementClass');
         $advertisementClass= new advertisementClass;
         $advertisementClass->acompany=$this->input->post('acompany');
         $advertisementClass->alink=$this->input->post('alink');
         $advertisementClass->abanner=$uploaddata['upload_data']['file_name'];
         $advertisementClass->astartdate=$this->input->post('astartdate');
         $advertisementClass->aenddate=$this->input->post('aenddate');
         $advertisementClass->aonline=$this->input->post('aonline')==null?"N":$this->input->post('aonline');
         $advertisementClass->aorder=$this->input->post('aorder');
         $advertisementClass->aview=0;
         $advertisementClass->aclick=0;
         $advertisementClass->isDeleted='N';
       
         $insert_id=$this->Advertisement_Model->save_ad($advertisementClass);
         $access_id=accessLog('A','ADVERTISEMENT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改廣告【id:'.$insert_id.'】','S');
        
        redirect(base_url().'advertisement/index', 'refresh');
        }
        
             
            
       
     }
    
    function viewRecord($id){
          if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
    $data['page']="parameter";    
     $data['subpage']="advertisement"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
     
      $query = $this->Advertisement_Model->query_ad($id);
         $data['advertisement']=$query->row();
      $data['msg']="";
      $this->load->view('advertisement/viewRecord',$data);
       
    }
    
      function updateAd(){
            if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
      $data['page']="parameter";    
     $data['subpage']="advertisement"; 
     $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
    $data['msg']="";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
    //echo $_FILES['abanner']['tmp_name'];
    
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (isset($_FILES['abanner']['tmp_name']) && $_FILES['abanner']['tmp_name']!="" && !$this->upload->do_upload("abanner"))
        {
            $error = array('error' => $this->upload->display_errors());
         $data['msg']="Banner上傳失敗";
    //     echo $this->upload->display_errors();
          
           $id=$this->input->post('advertisementID');
         $query = $this->Advertisement_Model->query_ad($id);
         $data['advertisement']=$query->row();
         $this->load->view('advertisement/viewRecord',$data);
        }
        else
        {
            if(isset($_FILES['abanner']['tmp_name']) && $_FILES['abanner']['tmp_name']!="" ){
             $uploaddata = array('upload_data' => $this->upload->data());
            }
        $id=$this->input->post('advertisementID');
        $this->load->library('advertisementClass');
        $advertisementClass= new advertisementClass;
        $advertisementClass= $this->Advertisement_Model->query_ad($id)->row();
         
       $advertisementClass->acompany=$this->input->post('acompany');
       $advertisementClass->alink=$this->input->post('alink');
       $advertisementClass->astartdate=$this->input->post('astartdate');
       if(isset($_FILES['abanner']['tmp_name']) && $_FILES['abanner']['tmp_name']!="" ){
                $advertisementClass->abanner=$uploaddata['upload_data']['file_name'];
        }
       $advertisementClass->aenddate=$this->input->post('aenddate');
       $advertisementClass->aonline=$this->input->post('aonline');
       $advertisementClass->aorder=$this->input->post('aorder');
       
         $this->Advertisement_Model->update_ad($id,$advertisementClass);
        $query = $this->Advertisement_Model->query_ad($id);
         $data['advertisement']=$query->row();
        $data['msg']="Update Advertisement Successlly"; 
        $access_id=accessLog('U','ADVERTISEMENT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改廣告【id:'.$id.'】','S');
        
        $this->load->view('advertisement/viewRecord',$data);
        }
   
    }
    
    
    public function deleteRecord($id)
    {
          if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
           $data['page']="parameter";    
         $data['subpage']="advertisement"; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Advertisement Management</li>";
        $query = $this->Advertisement_Model->delete_ad($id);
        $access_id=accessLog('D','ADVERTISEMENT',$this->session->userdata('userID'),$this->session->userdata('userRealname').'刪除廣告【id:'.$id.'】','S');
        
        redirect(base_url().'advertisement/index', 'refresh');
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