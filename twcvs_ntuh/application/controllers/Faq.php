<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

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
         
        $this->load->model('Faq_Model');
        $this->load->helper('form');
    }
    
    public function index()
    {
      
      
       $data['faqList']=$this->Faq_Model->qry_faqlist();
        
     $data['page']="faq";   
     $data['path']="<li>常見問題</li><li  class='break'>&#187;</li>";
     $this->load->view('faq/index',$data);
     }
        public function viewRecord($id)
    {
          $query = $this->Faq_Model->query_faq($id);
       $data['page']="faq";    
       $data['content']= $query ; 
       $data['path']="<li>常見問題</li><li  class='break'>&#187;</li>";
       if($this->session->userdata('bookingID')=="" && $query->num_rows()==1){
         $access_id=accessLog('R','Faq',$query->row()->faqid,$this->session->userdata('userRealname').'讀取常見問題【'.$query->row()->faqsubject.'】','S');
         }   
        $this->load->view('faq/content',$data);
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */