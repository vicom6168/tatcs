<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Syntaxscore extends CI_Controller {

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
        if($this->session->userdata('bookingID')=="")
        redirect(base_url().'homenew', 'refresh');
        
        $data['page']="divPatientProfiles";   
        $data['msg']="";  
        $data['path']="<li>病患資料</li><li  class='break'>&#187;</li>";
        $this->load->model('PatientInformation_Model'); 
       
        if($pid!='')
        $column = $this->PatientInformation_Model->viewRecord($pid);
        $data['myContent']=$column;    
        $this->load->model('Parameter_Model'); 
        $Bacteria= $this->Parameter_Model->query_BacteriaList();
        $data['BacteriaList']=$Bacteria;    
        $this->load->view('syntaxscoreview/index',$data);
	}
        public function PDF($d1,$d2)
    {
        $ans[17]=0;
        for($i=1;$i<=16;$i++){
        $ans[$i]=0;
        }
      
     if( $d1!='' &&  $d2!=''){
         for($i=1;$i<=16;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($d1,$d2,$i)->row()->num;
              $ans[17]+=$ans[$i];
        }
     }
        $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $data['answer']=$ans;
     $data['d1']=$d1;
     $data['d2']=$d2;
        $this->load->view('analysis/PDF',$data);
    }
     public function EXCEL($d1,$d2)
    {
        $ans[17]=0;
        for($i=1;$i<=16;$i++){
        $ans[$i]=0;
        }
      
     if( $d1!='' &&  $d2!=''){
         for($i=1;$i<=16;$i++){
        $ans[$i]=$this->Analysis_Model->query_associateReport($d1,$d2,$i)->row()->num;
              $ans[17]+=$ans[$i];
        }
     }
        $data['page']="analysis";  
     $data['path']="<li>統計報表</li><li  class='break'>&#187;</li>";
     $data['answer']=$ans;
     $data['d1']=$d1;
     $data['d2']=$d2;
        $this->load->view('analysis/EXCEL',$data);
    }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */