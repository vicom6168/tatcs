<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

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
       // if($this->session->userdata('bookingID')=="" || $this->session->userdata('isAdmin')=="")
      //  redirect(base_url().'homenew', 'refresh');
         
        $this->load->model('News_Model');
        $this->load->helper('form');
    }
    
    public function index()
    {
           $data['page']="parameter";    
        $data['subpage']="news"; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Diagnosis Management</li>";
        $this->load->view('parameter/diagnosis',$data);
    }
      
   public function queryContent($id){
           $query = $this->News_Model->query_news($id);
            $data['page']="parameter";    
        $data['subpage']="news"; 
        $data['content']= $query ; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Diagnosis Management</li>";
         if($this->session->userdata('bookingID')=="" && $query->num_rows()==1){
         $access_id=accessLog('R','News',$query->row()->nid,$this->session->userdata('userRealname').'讀取最新消息內容【'.$query->row()->subject.'】','S');
         }   
        $this->load->view('news/content',$data);
   }
   
    public function editNews($id){
          $data['page']="parameter";    
        $data['subpage']="news"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>News Management</li>";
       
         
       $newsContent=$this->News_Model->query_news($id);
       $data['newsContent']=$newsContent;
       $this->load->view('news/newsadminconetnt',$data);
    }
   public function saveNews(){
         $data['page']="parameter";    
      $data['subpage']="news"; 
      $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>News Management</li>";
      $data['msg']="";
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'doc|docx|ppt|pptx|xls|xlsx|pdf|txt|gif|jpg|png';
  
      $config['file_name']  = time(); 
    //echo $_FILES['abanner']['tmp_name'];
    
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name']!="" && !$this->upload->do_upload("attachment"))
        {
            $error = array('error' => $this->upload->display_errors());
         $data['msg']="attachment上傳失敗";
       echo $this->upload->display_errors();
          
          $id=$this->input->post('nid');
          $newsContent=$this->News_Model->query_news($id);
          $data['newsContent']=$newsContent;
           $this->load->view('news/newsadminconetnt',$data);
        }
        else
        {
            if(isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name']!="" ){
             $uploaddata = array('upload_data' => $this->upload->data());
            }
          $this->load->library('newsClass');
        $id=$this->input->post('nid');
     //   echo "XXXXXXXXXXXXXXXXXXXXXX".$id."<br/>";
     //   echo "<br/>FILE SET:".isset($_FILES['attachment']['tmp_name']);
    //    echo  "<br/>FILE NAME:".$_FILES['attachment']['tmp_name'];
                $newsClass= new newsClass;
                $newsClass=$this->News_Model->query_news($id)->row();
                
                $newsClass->publishdate=$this->input->post('publishdate');
                $newsClass->subject=$this->input->post('subject');
                $newsClass->content=$this->input->post('content');
                $newsClass->isOnline=$this->input->post('isOnline')==null?"N":"Y";
                if(isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name']!="" ){
                        $newsClass->attachment=$uploaddata['upload_data']['file_name'];
                    }
                $newsClass->isInner=$this->input->post('isInner')==null?"N":"Y";
                $newsClass->isOuter=$this->input->post('isOuter')==null?"N":"Y";
                $newsClass->isDeleted="N";   
                $this->News_Model->update_news($id,$newsClass);
                $access_id=accessLog('U','News',$id,$this->session->userdata('userRealname').'修改最新消息內容【'.$this->input->post('subject').'】','S');
        redirect(base_url().'parameter/news', 'refresh');
        }
    }

 public function deleteAttachment($id){
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
      $data['page']="parameter";    
      $data['subpage']="news"; 
      $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>News Management</li>";
   
        $this->load->library('newsClass');
      //  $id=$this->input->post('nid');
                $newsClass= new newsClass;
                $newsClass=$this->News_Model->query_news($id)->row();
                 $this->load->helper("file");
                            //echo $advertisementClass->abanner;
                        unlink('./uploads/'.$newsClass->attachment);
                        
                $newsClass->attachment='';
                
       
       $this->News_Model->update_news($id,$newsClass);
       $newsContent=$this->News_Model->query_news($id);
       $data['newsContent']=$newsContent;
       $access_id=accessLog('U','News',$id,$this->session->userdata('userRealname').'刪除最新消息附檔【'.$this->input->post('subject').'】','S');
       $this->load->view('news/newsadminconetnt',$data);
 }
    public function addNews(){
          $data['page']="parameter";    
        $data['subpage']="news"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>News Management</li>";
       
       $this->load->view('news/newsaddadminconetnt',$data);
    }
    public function newNews(){
          $data['page']="parameter";    
        $data['subpage']="news"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>News Management</li>";
      $data['msg']="";
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'doc|docx|ppt|pptx|xls|xlsx|pdf|txt|gif|jpg|png';
  
      $config['file_name']  = time(); 
    
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name']!="" && !$this->upload->do_upload("attachment"))
        {
            $error = array('error' => $this->upload->display_errors());
         $data['msg']="Attachment 上傳失敗";
           echo $this->upload->display_errors();
     //    $this->load->view('advertisement/newAd',$data);
        }
        else
        {
            if(isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name']!="" ){
            $uploaddata = array('upload_data' => $this->upload->data());
            }
          $this->load->library('newsClass');
                $newsClass= new newsClass;
                $newsClass->publishdate=$this->input->post('publishdate');
                $newsClass->subject=$this->input->post('subject');
                $newsClass->content=$this->input->post('content');
                $newsClass->isOnline=$this->input->post('isOnline')==null?"N":"Y";
                $newsClass->isInner=$this->input->post('isInner')==null?"N":"Y";
                $newsClass->isOuter=$this->input->post('isOuter')==null?"N":"Y";
                 if(isset($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['tmp_name']!="" ){
                           $newsClass->attachment=$uploaddata['upload_data']['file_name'];
                    } else {
                        $newsClass->attachment='';
                    }
                $newsClass->isDeleted="N";   
                $insert_id=$this->News_Model->save_news($newsClass);
                $access_id=accessLog('A','News',$insert_id,$this->session->userdata('userRealname').'新增最新消息內容【'.$this->input->post('subject').'】','S');
        redirect(base_url().'parameter/news', 'refresh');
        }
    }
  public function newslist(){
          $data['page']="news";    
        $data['subpage']="news"; 
        $data['path']="<li>News</li><li  class='break'>&#187;</li><li>News List</li>";
      
       
         $this->load->view('news/news',$data);
    }
    //Ajax
    //Diagnosis Beginning
      function loadNews(){
          $t=$this->input->post('type');
         $query = $this->News_Model->query_NewsList($t);
      $arr=array('status'=>'success','result'=>$query->result());
         echo json_encode($arr);
      }

     function loadAdminNews(){
          $t=$this->input->post('type');
         $query = $this->News_Model->query_newsListManage($t);
      $arr=array('status'=>'success','result'=>$query->result());
         echo json_encode($arr);
      }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */