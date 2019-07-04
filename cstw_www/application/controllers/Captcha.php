<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller {

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
  $this->load->helper('captcha');
    }
    
    function captcha_img2() 
    {
        $pool = '0123456789';
        $word = '';
        for ($i = 0; $i < 4; $i++){
            $word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        $this->session->set_userdata('captcha', $word);
        $vals = array(
            'word'  => $word,
            'img_path'  => './captcha/',
            'img_url'  =>'/captcha/',
             'img_width'    => '80',
             'img_height' => 35,
            'expiration' => 1200
            );
        $cap = create_captcha($vals);
        print_r ($cap);
    }
    
    private function captcha_img() 
    {
         // return '<img src="captcha/securimage_jpg" />';
         $arr=array('status'=>'<img src="captcha/securimage_jpg" />');
         echo json_encode($arr);
    }

    public function securimage_jpg() 
    {
        $this->load->library('securimage/securimage');

        $img = new Securimage();
           
        //Change some settings
            $img->image_width = 80;
        $img->image_height = 30;
        $img->perturbation = 0.25;
        $img->image_bg_color = new Securimage_Color("#f6f6f6");
        $img->use_transparent_text = true;
        $img->text_transparency_percentage = 30; // 100 為全透明
             $img->num_lines = 0;
        $img->use_wordlist = false; 
        $img->noise_level=1;
        $img->code_length='4';
        $img->text_color = new Securimage_Color('#3388FF');
        $img->charset='0123456789';
            $img->font_ratio=0.5;

        $img->show('backgrounds/bg5.jpg'); // 套背景圖並顯示
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */