<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SPHelper extends CI_Controller {

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
        
        $this->load->model('Contact_Model');
        $this->load->helper('form');
    }
    
  
    public function VAD()
    {
        $data['path']="<li>特殊表單</li><li  class='break'>&#187;特殊表單列表</li>";
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
     $this->load->view('SPHelper/VAD',$data);
     }
    public function Vascular()
    {
        $data['path']="<li>特殊表單</li><li  class='break'>&#187;特殊表單列表</li>";
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
     $this->load->view('SPHelper/Vascular',$data);
     }
    public function Excel()
    {
        $data['path']="<li>特殊表單</li><li  class='break'>&#187;特殊表單列表</li>";
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
     $this->load->view('SPHelper/Excel',$data);
     }
    public function CROpenHeart()
    {
        $data['path']="<li>特殊表單</li><li  class='break'>&#187;特殊表單列表</li>";
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
     $this->load->view('SPHelper/CROpenHeart',$data);
     }
public function CRVascular()
    {
        $data['path']="<li>特殊表單</li><li  class='break'>&#187;特殊表單列表</li>";
        $data['result_msg']='';
     $data['page']="specialsheet";    
     $data['subpage']="index";  
     $this->load->view('SPHelper/CRVascular',$data);
     }
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */