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
    
     public function addfaq()
    {
        
        $data['result_msg']='';
      $data['page']="faq";  
     $data['path']="<li>常見問題</li><li  class='break'>&#187;</li>";
     $this->load->view('faq/addfaq',$data);
     }
    
    
    public function savefaq(){
         $data['page']="faq";   
      $data['path']="<li>常見問題</li><li  class='break'>&#187;</li>";
      $data['msg']="已把資料傳送給學會管理者, 謝謝您";
  
    
        $this->load->library('faqClass');
                $faqClass= new faqClass;
                $faqClass->faqcategory=$this->input->post('faqcategory');
                $faqClass->faqsubject=$this->input->post('faqsubject');;
                $faqClass->faqcontent=$this->input->post('faqcontent');
                $faqClass->faqorder=$this->input->post('faqorder');
               
                $faqClass->createtime= date('Y-m-d H:i:s'); 
                
                $id=$this->Faq_Model->save_faq($faqClass);
          $access_id=accessLog('A','Faq',$id,$this->session->userdata('userRealname').'新增連絡我們【'.$this->input->post('subject').'】','S');
        redirect(base_url().'faq/index', 'refresh');
        }


public function editRecord($id){
        $query = $this->Faq_Model->query_faq($id);
       $data['page']="faq";    
       $data['content']= $query ; 
       $data['path']="<li>常見問題</li><li  class='break'>&#187;</li>";
       
        $this->load->view('faq/editfaq',$data);
        }

   public function updatefaq(){
         $data['page']="faq";     
      $data['path']="<li>常見問題</li><li  class='break'>&#187;</li>";
      $data['msg']="常見問題修改完成";
      
        $this->load->library('faqClass');
        $faqClass= new faqClass;
        $id=$this->input->post('nid');
   
              
        $faqClass=$this->Faq_Model->query_faq($id)->row();
                
                $faqClass->faqcategory=$this->input->post('faqcategory');
                $faqClass->faqsubject=$this->input->post('faqsubject');;
                $faqClass->faqcontent=$this->input->post('faqcontent');
                $faqClass->faqorder=$this->input->post('faqorder');
                $this->Faq_Model->update_faq($id,$faqClass);
                $access_id=accessLog('U','Faq',$id,$this->session->userdata('userRealname').'修改常見問題內容【'.$this->input->post('faqsubject').'】','S');
        redirect(base_url().'faq/index', 'refresh');
        
    }
    public function deleteRecord($pid){
       // $this->load->library('session');
       // if($this->session->userdata('userID')=="" )
       // redirect(base_url().'home', 'refresh');
         
        if($pid!='')
        $column = $this->Faq_Model->delete_faq($pid);
        redirect(base_url().'faq/index', 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */