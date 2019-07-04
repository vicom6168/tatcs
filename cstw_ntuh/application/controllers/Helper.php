<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helper extends CI_Controller {

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
       // if($this->session->userdata('bookingID')=="" || $this->session->userdata('isAdmin')=="")
      //  redirect(base_url().'homenew', 'refresh');
         
        $this->load->model('News_Model');
        $this->load->helper('form');
    }
    
	public function STS_DT()
	{
	     		$this->load->view('Helper/STS_DT');
	}
      public function RTB_DT()
    {
                $this->load->view('Helper/RTB_DT');
    }
public function RTE_DT()
    {
                $this->load->view('Helper/RTE_DT');
    }
  public function CH()
    {
                $this->load->view('Helper/CH');
    }
  public function CH_DT()
    {
                $this->load->view('Helper/CH_DT');
    }
     public function Target()
    {
                $this->load->view('Helper/Target');
    }
     public function Target_DT()
    {
                $this->load->view('Helper/Target_DT');
    }
      public function HORM()
    {
                $this->load->view('Helper/HORM');
    }
      public function HORM_DT()
    {
                $this->load->view('Helper/HORM_DT');
    }
      public function IMMU()
    {
                $this->load->view('Helper/IMMU');
    }
      public function IMMU_DT()
    {
                $this->load->view('Helper/IMMU_DT');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */