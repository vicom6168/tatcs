<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
     */
    public function index()
    {
        $data['result_msg']='';
         $this->load->model('Advertisement_Model');
      $ad = $this->Advertisement_Model->query_adListFront();  
      $data['advertisementList']=$ad;
 
        $this->load->view('homenew/home',$data);
    }
    
    public function login()
    {
        $data['page']="";    
        $data['path']="";
        $data['result_msg']='';
        $this->load->view('home/dashboard',$data);
    }
    
    public function booking(){
        $this->load->library('session');
        if($this->session->userdata('userID')=="" )
        redirect(base_url().'home', 'refresh');
        
        date_default_timezone_set("Asia/Taipei");
        $this->load->model('Parameter_Model');
        $this->load->model('Booking_Model'); 
        
        $data['page']="booking";    
        $data['path']="<li>我要訂床</li>";
        if(date('H')>=16)
        $booking_Date= date("Y-m-d", time()+86400);
        else 
        $booking_Date= date("Y-m-d");
        $vs_column = $this->Parameter_Model->query_vs($this->session->userdata('bookingID'));   
        $data['viewVS']=$vs_column;
        $column = $this->Booking_Model->query_booking($booking_Date,$this->session->userdata('bookingID'));
        $data['viewBookingSpecialty']=$column;
        $data['booking_Date']=$booking_Date;  
        $this->load->view('home/booking',$data);
    }
    
   
    
   
    function checkUser(){
        $this->load->library('form_validation');  
        $this->load->model('User_Model'); 
        $this->load->library('securimage/securimage'); 
         $securimage = new Securimage();
        $this->form_validation->set_rules('username', '使用者帳號', 'required');
        $this->form_validation->set_rules('password', '使用者密碼', 'required');
        $data['result_msg']='';
        $this->load->model('Advertisement_Model');
      $ad = $this->Advertisement_Model->query_adListFront();  
      $data['advertisementList']=$ad;
        if ($this->form_validation->run() == FALSE)
        {
            $data['result_msg']='請填寫必填的欄位,使用者登入失敗！';
            $data['page']="";    
            $data['path']="";
            $this->load->view('home/home',$data);
        } else if($securimage->check($this->input->post('validatecode'))) {
                $query = $this->User_Model->checkUser($this->input->post('username'),$this->input->post('password')); 
                 if ($query->num_rows() ==1)
                    {
                        $row = $query->row();
                            
                        $userRealname= $row->userRealname;
                        $userID= $row->userID;
                        $isAdmin=$row->isAdmin;
                        $userName=$row->userName;
                        $userRole=$row->userRole;
                        $userEmail=$row->vsEmail;
                        
                      //  $this->session->set_userdata('adminID', $adminID);
                                    $this->session->set_userdata('userRealname', $userRealname);
                        $this->session->set_userdata('userID', $userID);
                        $this->session->set_userdata('isAdmin', $isAdmin);
                        $this->session->set_userdata('userName', $userName);
                        $this->session->set_userdata('userRole', $userRole);
                        $this->session->set_userdata('userEmail', $userEmail);
                        $this->load->model('Hospital_Model');
                        $hospital = $this->Hospital_Model->query_hospitalList();  
                        $this->session->set_userdata('hospitalList', $hospital->result_array());
                        
                        $this->load->model('Setting_Model');
       
                        $setting=$this->Setting_Model->query_setting()->row();
                        $this->session->set_userdata('C1', $setting->c1);
                        $this->session->set_userdata('C2', $setting->c2);
                         $this->session->set_userdata('C3', $setting->c3);
                        accessLog('L','USER',$userID,$userRealname.'登入系統成功','S');
                         redirect(base_url().'patient', 'refresh');
                    } else {
                                    $userRealname= "";
                        $userID= "";
                        $isAdmin= "";
                        $userName="";
                        $userRole="";
                        $query = $this->User_Model->checkUserbyname($this->input->post('username'));
                        if ($query->num_rows() ==1)
                                        {
                                        $row = $query->row();
                                        $userRealname= $row->userRealname;
                           $userID= $row->userID;
                           $isAdmin=$row->isAdmin;
                           $userName=$row->userName;
                            $userRole=$row->userRole;
                            $userEmail=$row->vsEmail;
                        
                          }
                                    $this->session->set_userdata('userRealname', $userRealname);
                        $this->session->set_userdata('userID', $userID);
                        $this->session->set_userdata('isAdmin', $isAdmin);
                        $this->session->set_userdata('userName', $userName);
                        $this->session->set_userdata('userRole', $userRole);
                        $this->session->set_userdata('userEmail', $userEmail);
                        $data['result_msg']="使用者帳號或密碼錯誤";
                    
                        $data['page']="";    
                        $data['path']="";
                        accessLog('L','USER',$userID,$userRealname.'登入系統失敗','F');
                        $this->load->view('homenew/home',$data);
        
                    }
        } else {
            $userRealname= "";
                        $userID= "";
                        $isAdmin= "";
                        $userName="";
                        $userRole="";
                        $userEmail="";
                        $query = $this->User_Model->checkUserbyname($this->input->post('username'));
                        if ($query->num_rows() ==1)
                                        {
                                        $row = $query->row();
                                        $userRealname= $row->userRealname;
                           $userID= $row->userID;
                           $isAdmin=$row->isAdmin;
                           $userName=$row->userName;
                            $userRole=$row->userRole;
                        
                          }
                                    $this->session->set_userdata('userRealname', $userRealname);
                        $this->session->set_userdata('userID', $userID);
                        $this->session->set_userdata('isAdmin', $isAdmin);
                        $this->session->set_userdata('userName', $userName);
                        $this->session->set_userdata('userRole', $userRole);
                        $this->session->set_userdata('userEmail', $userEmail);
                        $data['result_msg']="驗證碼錯誤";
                    
                        $data['page']="";    
                        $data['path']="";
                        accessLog('L','USER',$userID,$userRealname.'登入系統失敗(驗證碼錯誤)','F');
                        $this->load->view('homenew/home',$data);
        }
    }

    function logout()
    {
                                   accessLog('O','USER',$this->session->userdata('$userID'),$this->session->userdata('userRealname').'登出本系統','S');
                        $userRealname= "";
                        $userID= "";
                        $isAdmin= "";
                        $userName="";
                        $userRole="";
                        $this->session->set_userdata('userRealname', $userRealname);
                        $this->session->set_userdata('userID', $userID);
                        $this->session->set_userdata('isAdmin', $isAdmin);
                        $this->session->set_userdata('userName', $userName);
                        $this->session->set_userdata('userRole', $userRole);
                        $data['result_msg']="";
                    
                        $data['page']="";    
                        $data['path']="";
                        $this->load->model('Advertisement_Model');
                         $ad = $this->Advertisement_Model->query_adListFront();  
      $data['advertisementList']=$ad;
                        $this->load->view('homenew/home',$data);
    }
    
    
   function password(){
       $this->load->library('session');
        if($this->session->userdata('userID')=="")
        redirect(base_url().'home', 'refresh');
        
        $data['page']="parameter";    
        $data['subpage']="password";    
        $data['path']="<li>修改密碼</li>";
        $this->load->model('User_Model'); 
        $data['error_msg']='';
        $data['success_msg']='';
        
        $this->load->view('home/password',$data);
   }
   function passwordUpdate(){
            $data['page']="parameter";  
        $data['subpage']="password";    
        $data['path']="<li>修改密碼</li>";
        
        $this->load->library('session');
        if($this->session->userdata('userID')=="")
            redirect(base_url().'home', 'refresh');
        
         $this->load->library('form_validation');   
         $this->load->model('User_Model'); 
         $this->form_validation->set_rules('oldPassword', '舊密碼', 'required');
         $this->form_validation->set_rules('newPassword', '新密碼', 'required');
         $this->form_validation->set_rules('confirmedPassword', '確認密碼', 'required');
      
        
         $data['error_msg']='';
         $data['success_msg']='';
            
        if ($this->form_validation->run() == FALSE)
        {
            $data['error_msg']='請填寫必填的欄位,密碼修改失敗！';
            $access_id=accessLog('U','PASSWORD',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改密碼失敗','F');
            
        } elseif($this->input->post('newPassword')!=$this->input->post('confirmedPassword')) {
                $data['error_msg']='您輸入的二次新密碼不相同,密碼修改失敗！';
                $access_id=accessLog('U','PASSWORD',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改密碼失敗','F');
        } else {
                
                $query = $this->User_Model->checkUser($this->session->userdata('userName'),$this->input->post('oldPassword')); 
                 if ($query->num_rows() ==1)
                    {
                        $this->User_Model->modifyPassword($this->session->userdata('userName'),$this->input->post('newPassword')); 
                        $data['success_msg']='密碼修改成功';
                        $access_id=accessLog('U','PASSWORD',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改密碼成功','S');
                    } else {
                     $data['error_msg']='您輸入的舊密碼不正確,密碼修改失敗！';
                       $access_id=accessLog('U','PASSWORD',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改密碼失敗','F');
                    }
                
         }
        $this->load->view('home/password',$data);
       
        
   }
   
      function accessrecord($qu="",$qy="",$qm="",$page="0"){
       $this->load->library('session');
        if($this->session->userdata('userID')=="")
            redirect(base_url().'home', 'refresh');
       
            
            
        $this->load->model('User_Model');
        $this->load->model('PatientInformation_Model');
        if($this->session->userdata('isAdmin')=="Y"){
             $data['userList']=$this->User_Model->query_useradminList();
        } else{
            $data['userList']=$this->User_Model->query_user($this->session->userdata('userID'));
             }
           
       
        if($this->input->post('qryUser')==""){
            if($qu=="")
            $qryUser=$this->session->userdata('userID');
            else 
              $qryUser=$qu;   
        }  else {
             $qryUser=$this->input->post('qryUser');
        }
        
            if($this->input->post('sYear')==""){
                if($qy=="")
                 $y=Date('Y');
                else  
                    $y=$qy;
                } else{
                $y=$this->input->post('sYear');
            }
                
              if($this->input->post('sMonth')==""){
                  if($qm=="")
                 $m=Date('n');
                    else 
                   $m=$qm;
            } else {
                $m=$this->input->post('sMonth');
            }
                    $sDate=$y."-".$m."-01";
                     //權限判斷
            if($this->session->userdata('isAdmin')!="Y" && $this->session->userdata('userID')!=$qryUser)
            redirect(base_url().'home', 'refresh');
            //  $query=$this->PatientInformation_Model->qryPatientHistorybyUser($qryUser,$sDate);
         //Paging
            $config['per_page'] = 100; 
        $data['accessList']=$this->PatientInformation_Model->qryPatientHistorybyUser($qryUser,$sDate,$page,$config['per_page']);
        $config['total_rows'] = $this->PatientInformation_Model->qryPatientHistorybyUser($qryUser,$sDate,0,0)->num_rows() ;
        $config['base_url'] = base_url().'home/accessrecord/'.$qryUser.'/'.$y.'/'.$m;
        $config['num_links'] = 2;
        $config['uri_segment'] =6;
        $config['first_link'] = 'Fisrt';
        $config['first_tag_open'] = '';
        $config['first_tag_close'] = '';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = ' ';
        $config['last_tag_close'] = '';
        $config['full_tag_open'] = '<div class="dataTables_paginate">';
        $config['full_tag_close'] = '</div>';
    
        $this->load->library('pagination');
        $this->pagination->initialize($config); 
        //foreach ($result as $key => $value)
        //      $result->$key=str_replace("00:00:00","",str_replace("0000-00-00","",$value));

        $data['Pagination_str']=$this->pagination->create_links();
         //paging end     
              
              
           //   $data['accessList']=$query;
        $data['page']="parameter";    
        $data['subpage']="access";  
        $data['qryUser']=$qryUser;
        $data['sYear']=$y;
        $data['sMonth']=$m;
        
        $data['path']="<li>系統存取記錄</li>";
        $data['error_msg']='';
        $data['success_msg']='';
       
        $this->load->view('home/accessrecord',$data);
   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */