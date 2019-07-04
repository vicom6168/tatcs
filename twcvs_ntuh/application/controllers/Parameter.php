<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parameter extends CI_Controller {

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
         
        $this->load->model('Parameter_Model');
        $this->load->model('News_Model');
        $this->load->helper('form');
    }
    
	public function index()
	{
	       $data['page']="parameter";    
        $data['subpage']="diagnosis"; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Diagnosis Management</li>";
		$this->load->view('parameter/diagnosis',$data);
	}
        public function diagnosis()
    {
           $data['page']="parameter";    
        $data['subpage']="diagnosis"; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Diagnosis Management</li>";
        $this->load->view('parameter/diagnosis',$data);
    }
 public function user()
    {
           $data['page']="parameter";    
        $data['subpage']="user"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>User Management</li>";
        $this->load->model('user_Model');
        $data['userList']=$this->user_Model->query_userList();
        $this->load->view('parameter/user',$data);
    }
 public function deleteUser($id)
    {
           $data['page']="parameter";    
        $data['subpage']="user"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>User Management</li>";
        $this->load->model('user_Model');
        $user=$this->user_Model->query_user($id)->row();
        $data['userList']=$this->user_Model->delete_user($id);
        $access_id=accessLog('D','USER',$user->userID,$this->session->userdata('userRealname').'刪除使用者【'.$user->userRealname.'】','S');
        
        redirect(base_url().'parameter/user', 'refresh');
    }
 public function viewUser($id)
    {
            $data['page']="parameter";    
        $data['subpage']="user"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>User Management</li>";
        $this->load->model('user_Model');
        $data['userDetail']=$this->user_Model->query_user($id)->row();
        $this->load->view('parameter/viewuser',$data);
    }
     public function newUser()
    {
            $data['page']="parameter";    
        $data['subpage']="user"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>User Management</li>";
        
        $this->load->view('parameter/newuser',$data);
    }
    public function addUser(){
          $data['page']="parameter";    
        $data['subpage']="user"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>User Management</li>";
        $this->load->model('user_Model');
          $this->load->library('userClass');
        
                $userClass= new userClass;
                $userClass->userName=$this->input->post('userName');
                $userClass->userRealname=$this->input->post('userRealname');
                $userClass->userPassword=$this->input->post('userPassword');
                $userClass->userHospital=$this->input->post('userHospital');
                $userClass->associateID=$this->input->post('associateID');
                $userClass->chestheartID=$this->input->post('chestheartID');
                $userClass->vsPermission=$this->input->post('vsPermission');
                $userClass->vsEmailNotify1=$this->input->post('vsEmailNotify1');
                $userClass->vsEmailNotify2=$this->input->post('vsEmailNotify2');
                $userClass->vsEmailNotify3=$this->input->post('vsEmailNotify3');
                $userClass->vsEmail=$this->input->post('vsEmail');
                $userClass->userRole=$this->input->post('userRole');
                $userClass->isAdmin=$this->input->post('isAdmin')==null?"N":"Y";
                if($this->input->post('userRole')=="1" && $this->input->post('isExport')!=null && $this->input->post('isExport')=='0'){
                $userClass->isExport="0";
                } else {
                     $userClass->isExport="1";
                }
                
                $userClass->isDeleted="N";   
                $this->user_Model->save_user($userClass);
                $access_id=accessLog('A','USER',$userClass->userID,$this->session->userdata('userRealname').',新增使用者【'.$this->input->post('userRealname').'】','S');
        
        redirect(base_url().'parameter/user', 'refresh');
    }
 public function updateUser(){
          $data['page']="parameter";    
        $data['subpage']="user"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>User Management</li>";
        $this->load->model('user_Model');
          $this->load->library('userClass');
        $id=$this->input->post('userID');
        
                $userClass= new userClass;
                $userClass= $this->user_Model->query_user($id)->row();
                $userClass->userName=$this->input->post('userName');
                $userClass->userRealname=$this->input->post('userRealname');
                $userClass->userPassword=$this->input->post('userPassword');
                $userClass->userHospital=$this->input->post('userHospital');
                $userClass->associateID=$this->input->post('associateID');
                $userClass->chestheartID=$this->input->post('chestheartID');
                $userClass->vsEmail=$this->input->post('vsEmail');
                $userClass->vsPermission=$this->input->post('vsPermission');
                $userClass->vsEmailNotify1=$this->input->post('vsEmailNotify1');
                $userClass->vsEmailNotify2=$this->input->post('vsEmailNotify2');
                $userClass->vsEmailNotify3=$this->input->post('vsEmailNotify3');
                
                $userClass->exportVersion1=$this->input->post('exportVersion1');
                $userClass->exportVersion2=$this->input->post('exportVersion2');
                $userClass->exportVersion3=$this->input->post('exportVersion3');
                $userClass->exportVersion4=$this->input->post('exportVersion4');
                $userClass->exportVersion5=$this->input->post('exportVersion5');
                
                        $userClass->vsEmailNotifyOthers=$this->input->post('vsEmailNotifyOthers')==null?"N":"Y";
                $userClass->userRole=$this->input->post('userRole');
                $userClass->isAdmin=$this->input->post('isAdmin')==null?"N":"Y";
                $userClass->isDeleted="N";   
                if($this->input->post('userRole')=="1" && $this->input->post('isExport')!=null && $this->input->post('isExport')=='0'){
                $userClass->isExport="0";
                } else {
                     $userClass->isExport="1";
                }
                $this->user_Model->update_user($id,$userClass);
                if($this->input->post('userRealname')==$this->session->userdata('userRealname'))
                        $accessS="自己";
                else 
                       $accessS=$this->input->post('userRealname');
                $access_id=accessLog('U','USER',$userClass->userID,$this->session->userdata('userRealname').'修改使用者【'.$accessS.'】','S');
        
        redirect(base_url().'parameter/user', 'refresh');
    }
    public function vs()
    {
           $data['page']="parameter";    
        $data['subpage']="vs"; 
         $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>VS Management</li>";
        $this->load->view('parameter/vs',$data);
    }
    public function bacteria()
    {
           $data['page']="parameter";    
        $data['subpage']="bacteria"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Bacteria Management</li>";
        $this->load->view('parameter/bacteria',$data);
    }
     public function news()
    {
           $data['page']="parameter";    
        $data['subpage']="news"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>News Management</li>";
        $this->load->view('parameter/news',$data);
    }
    //Ajax
    //Diagnosis Beginning
      function loadDiagnosis(){
         $query = $this->Parameter_Model->query_diagnosisList();
      $arr=array('status'=>'success','result'=>$query->result());
         echo json_encode($arr);
      }

     function saveDiagnosis(){
         $this->load->library('diagnosisClass');
         $diagnosisClass= new diagnosisClass;
         $diagnosisClass->DiagnosisName=$this->input->post('Diagnosis');
         $diagnosisClass->isDeleted='N';
                try {
                            $this->Parameter_Model->save_diagnosis($diagnosisClass);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     function editDiagnosis(){
         $this->load->library('diagnosisClass');
         $id=$this->input->post('DiagnosisID');
         $diagnosisClass= new diagnosisClass();
         $diagnosisClass=$this->Parameter_Model->query_diagnosis($id)->row();
         $diagnosisClass->DiagnosisName=$this->input->post('DiagnosisName');
                try {
                            $this->Parameter_Model->update_diagnosis($id,$diagnosisClass);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     
     function deleteDiagnosis(){
          $this->load->library('diagnosisClass');
         $id=$this->input->post('DiagnosisID');
       
                try {
                            $this->Parameter_Model->delete_diagnosis($id);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);
     }
     //Diagnosis Ending
      //Bacteria Beginning
      function loadBacteria(){
         $query = $this->Parameter_Model->query_bacteriaList();
      $arr=array('status'=>'success','result'=>$query->result());
         echo json_encode($arr);
      }

     function saveBacteria(){
         $this->load->library('bacteriaClass');
         $bacteriaClass= new bacteriaClass;
         $bacteriaClass->Bacteria_Name=$this->input->post('Bacteria');
         $bacteriaClass->isDeleted='N';
                try {
                            $this->Parameter_Model->save_bacteria($bacteriaClass);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     function editBacteria(){
         $this->load->library('bacteriaClass');
         $id=$this->input->post('BacteriaID');
         $bacteriaClass= new bacteriaClass();
         $bacteriaClass=$this->Parameter_Model->query_bacteria($id)->row();
         $bacteriaClass->Bacteria_Name=$this->input->post('BacteriaName');
                try {
                            $this->Parameter_Model->update_bacteria($id,$bacteriaClass);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     
     function deleteBacteria(){
          $this->load->library('bacteriaClass');
         $id=$this->input->post('BacteriaID');
       
                try {
                            $this->Parameter_Model->delete_bacteria($id);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);
     }
     //Bacteria Ending
       //VS Beginning
      function loadVS(){
         $query = $this->Parameter_Model->query_vsList();
      $arr=array('status'=>'success','result'=>$query->result());
         echo json_encode($arr);
      }

     function saveVS(){
         $this->load->library('vsClass');
         $vsClass= new vsClass;
         $vsClass->vsName=$this->input->post('vs');
         $vsClass->hospitalID=$this->input->post('hospitalID');
         $vsClass->associateID=$this->input->post('associateID');
         $vsClass->isDeleted='N';
                try {
                            $this->Parameter_Model->save_vs($vsClass);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     function editVS(){
         $this->load->library('vsClass');
         $id=$this->input->post('vsID');
         $vsClass= new vsClass();
         $vsClass=$this->Parameter_Model->query_vs($id)->row();
         $vsClass->vsName=$this->input->post('vsName');
         $vsClass->hospitalID=$this->input->post('hospitalID');
         $vsClass->associateID=$this->input->post('associateID');
                try {
                            $this->Parameter_Model->update_vs($id,$vsClass);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     
     function deleteVS(){
          $this->load->library('vsClass');
         $id=$this->input->post('vsID');
       
                try {
                            $this->Parameter_Model->delete_vs($id);
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);
     }
     //VS Ending
     
     //News Beginning
      function loadNews(){
         $query = $this->News_Model->query_diagnosisList();
      $arr=array('status'=>'success','result'=>$query->result());
         echo json_encode($arr);
      }

     function saveNews(){
         $this->load->library('newsClass');
         $newsClass= new newsClass;
         $newsClass->subject=$this->input->post('subject');
         $newsClass->content=$this->input->post('content');
         $newsClass->publishdate=$this->input->post('publishdate');
         $newsClass->isOnline=$this->input->post('isOnline');
         $newsClass->isDeleted='N';
                try {
                            $insert_id=$this->News_Model->save_news($newsClass);
                   $access_id=accessLog('U','NEWS',$insert_id,$this->session->userdata('userRealname').',新增最新消息【'.$this->input->post('subject').'】','S');
        
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     function editNews(){
         $this->load->library('newsClass');
         $id=$this->input->post('newsID');
         $newsClass= new newsClass();
         $newsClass=$this->News_Model->query_news($id)->row();
         $newsClass->subject=$this->input->post('subject');
         $newsClass->content=$this->input->post('content');
         $newsClass->publishdate=$this->input->post('publishdate');
         $newsClass->isOnline=$this->input->post('isOnline');
                try {
                            $this->News_Model->update_news($id,$newsClass);
                            $access_id=accessLog('U','NEWS',$id,$this->session->userdata('userRealname').',修改最新消息【'.$this->input->post('subject').'】','S');
        
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);

     }
     
     function deleteNews(){
          $this->load->library('newsClass');
         $id=$this->input->post('newsID');
       
                try {
                             $query=$this->News_Model->query_news($id)->row();
                            $this->News_Model->delete_news($id);
                            $access_id=accessLog('D','NEWS',$query->nid,$this->session->userdata('userRealname').',刪除最新消息【'.$query->subject.'】','S');
        
                     $arr=array('status'=>'success');
                   
                    } catch (Exception $e) {
                                 $arr=array('status'=>'fail','result'=>$e);
                    }
                     echo json_encode($arr);
     }
     //Diagnosis Ending
     
     //Surgeon Beginning
     public function surgeon()
    {
            $data['page']="parameter";    
        $data['subpage']="vs"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Surgeon Management</li>";
        $this->load->model('Parameter_Model');
        $data['vsList']=$this->Parameter_Model->query_vsList();
        $this->load->view('parameter/surgeon',$data);
    }
 public function deleteSurgeon($id)
    {
           $data['page']="parameter";    
        $data['subpage']="vs"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Surgeon Management</li>";
        $this->load->model('Parameter_Model');
        $query=$this->Parameter_Model->query_vs($id)->row();
        $data['vsList']=$this->Parameter_Model->delete_vs($id);
        $access_id=accessLog('D','SURGEON',$query->vsID,$this->session->userdata('userRealname').',刪除Surgeon【'.$query->vsName.'】','S');
        
       redirect(base_url().'parameter/surgeon', 'refresh');
    }
 public function viewSurgeon($id)
    {
           $data['page']="parameter";    
        $data['subpage']="vs"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Surgeon Management</li>";
        $this->load->model('Parameter_Model');
        $data['vsDetail']=$this->Parameter_Model->query_vs($id)->row();
        $this->load->view('parameter/viewsurgeon',$data);
    }
     public function newSurgeon()
    {
            $data['page']="parameter";    
        $data['subpage']="vs"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Surgeon Management</li>";
        
        $this->load->view('parameter/newsurgeon',$data);
    }
    public function addSurgeon(){
        if($this->session->userdata('userID')=="" || $this->session->userdata('isAdmin')!="Y")
            redirect(base_url().'homenew', 'refresh');
        
          $data['page']="parameter";    
        $data['subpage']="vs"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Surgeon Management</li>";
        $this->load->model('Parameter_Model');
          $this->load->library('vsClass');
        
                $vsClass= new vsClass;
                 $vsClass->vsName=$this->input->post('vsName');
                $vsClass->vsHospital=$this->input->post('vsHospital');
                $vsClass->hospitalID=$this->input->post('hospitalID');
                $vsClass->associateID=$this->input->post('associateID');
                $vsClass->chestheartID=$this->input->post('chestheartID');
                $vsClass->vsEmail=$this->input->post('vsEmail');
                $vsClass->isDeleted="N";   
                $this->Parameter_Model->save_vs($vsClass);
        redirect(base_url().'parameter/surgeon', 'refresh');
    }
 public function updateSurgeon(){
       if($this->session->userdata('userID')=="" || $this->session->userdata('isAdmin')!="Y")
            redirect(base_url().'homenew', 'refresh');
          $data['page']="parameter";    
        $data['subpage']="vs"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Surgeon Management</li>";
        $this->load->model('Parameter_Model');
          $this->load->library('vsClass');
        $id=$this->input->post('vsID');
        
                $vsClass= new vsClass;
                $vsClass= $this->Parameter_Model->query_vs($id)->row();
                $vsClass->vsName=$this->input->post('vsName');
                $vsClass->vsHospital=$this->input->post('vsHospital');
                $vsClass->hospitalID=$this->input->post('hospitalID');
                $vsClass->associateID=$this->input->post('associateID');
                $vsClass->chestheartID=$this->input->post('chestheartID');
                $vsClass->vsEmail=$this->input->post('vsEmail');
                $vsClass->isDeleted="N";   
                $this->Parameter_Model->update_vs($id,$vsClass);
        redirect(base_url().'parameter/surgeon', 'refresh');
    }
     //Surgeon Ending
     //Myprofile Beginning
     function myProfile(){
           if($this->session->userdata('userID')=="")
            redirect(base_url().'homenew', 'refresh');
            
        $data['page']="parameter";    
        $data['subpage']="profile"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>My Profile</li>";
        $this->load->model('user_Model');
        $data['Msg']="";
        $data['userDetail']=$this->user_Model->query_user($this->session->userdata('userID'))->row();
        $this->load->view('parameter/myprofile',$data);
     }
      public function updateMyProfile(){
            $data['page']="parameter";    
        $data['subpage']="profile"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>My Profile</li>";
        $this->load->model('user_Model');
        $this->load->library('userClass');
        $id=$this->input->post('userID');
        
                $userClass= new userClass;
                $userClass= $this->user_Model->query_user($this->session->userdata('userID'))->row();
                
                $userClass->associateID=$this->input->post('associateID');
                $userClass->chestheartID=$this->input->post('chestheartID');
                $userClass->vsEmail=$this->input->post('vsEmail');
                $userClass->vsPermission=$this->input->post('vsPermission');
                $userClass->vsEmailNotify1=$this->input->post('vsEmailNotify1');
                $userClass->vsEmailNotify2=$this->input->post('vsEmailNotify2');
                $userClass->vsEmailNotify3=$this->input->post('vsEmailNotify3');
                $userClass->vsEmailNotifyOthers=$this->input->post('vsEmailNotifyOthers')==null?"N":"Y";
                $this->user_Model->update_user($id,$userClass);
       
       $data['Msg']="Your Profile Modified Successful";
       $data['userDetail']=$this->user_Model->query_user($this->session->userdata('userID'))->row();
       $access_id=accessLog('U','PROFILE',$this->session->userdata('userID'),$this->session->userdata('userRealname').'修改個人資料成功','S');
       $this->load->view('parameter/myprofile',$data);
    }
     //My Profile Ending
      //MyAuthority Beginning
     function myauthority(){
           if($this->session->userdata('userID')=="")
            redirect(base_url().'homenew', 'refresh');
            
        $data['page']="parameter";    
        $data['subpage']="authority"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Authority</li>";
        $this->load->model('user_Model');
        $this->load->model('Authority_Model');
        $data['vsauthorityList']=$this->Authority_Model->query_authoritybyvs($this->session->userdata('userID'));
         $data['userauthorityList']=$this->Authority_Model->query_authoritybyuser($this->session->userdata('userID'));
        $data['Msg']="";
        $data['userList']=$this->user_Model->query_userNotMeList($this->session->userdata('userID'));
        $this->load->view('parameter/myauthority',$data);
     }
      public function updatemyauthority(){
            $userCount=$this->input->post('userCount');
        $data['page']="parameter";    
        $data['subpage']="authority"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>Authority</li>";
        $this->load->model('user_Model');
        $this->load->model('Authority_Model');
        $this->load->library('userClass');
        $this->load->library('authorityClass');
        $id=$this->input->post('userID');
         for($i=0;$i<$userCount;$i++){
          if($this->input->post('profilesending_'.$i)=="1" ){
              if( $this->Authority_Model->query_authority($this->session->userdata('userID'),$this->input->post('profilesendingUserID_'.$i))->num_rows() ==0){
                       $authorityClass= new authorityClass;
                $authorityClass->vsid=$this->session->userdata('userID');
                $authorityClass->uid=$this->input->post('profilesendingUserID_'.$i);
                $authorityClass->a_time= date('Y-m-d H:i:s');
                $authorityClass->a_status='1';
                $access_id=$this->Authority_Model->add_authority($authorityClass);
                 accessLog('A','AUTHORITY',$authorityClass->aid,$this->session->userdata('userRealname').'把病患資料授權【給'.$this->input->post('profilesendingUserName_'.$i).'】','S');
              } 
              } else  if($this->input->post('profilesending_'.$i)==NULL  ){
                  $query=$this->Authority_Model->query_authority($this->session->userdata('userID'),$this->input->post('profilesendingUserID_'.$i));
               if( $query->num_rows() ==1){
                     $authorityClass= new authorityClass;
               $authorityClass=$query->row();
                     
                
                $authorityClass->e_time= date('Y-m-d H:i:s');
                $authorityClass->a_status='0';
                $access_id=$this->Authority_Model->delete_authority($authorityClass->aid,$authorityClass);
                 accessLog('D','AUTHORITY',$authorityClass->aid,$this->session->userdata('userRealname').'取消【給'.$this->input->post('profilesendingUserName_'.$i).'】的病患授權','S');
              } 
              }
           
           
           }
                
          $data['vsauthorityList']=$this->Authority_Model->query_authoritybyvs($this->session->userdata('userID'));
       $data['userauthorityList']=$this->Authority_Model->query_authoritybyuser($this->session->userdata('userID'));
       $data['Msg']="Your Profile Modified Successful";
       $data['userList']=$this->user_Model->query_userNotMeList($this->session->userdata('userID'));
       $this->load->view('parameter/myauthority',$data);
    }

      function queryHistory($uid=""){
            $this->load->model('user_Model');
        $this->load->model('Authority_Model');
        $this->load->library('userClass');
        $this->load->library('authorityClass');
        $data['vsauthorityHistory']=$this->Authority_Model->query_authorityhistory($uid);
        $this->load->view('parameter/myauthorityHistory',$data);
      }
     //My Profile Ending
     
     function setting(){
           if($this->session->userdata('userID')!="1")
            redirect(base_url().'homenew', 'refresh');
        
         $data['page']="parameter";    
        $data['subpage']="setting"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>System Setting </li>";
        $data['Msg']="";
        
        $this->load->model('Setting_Model');
        $this->load->library('settingClass');
        $data['setting']=$this->Setting_Model->query_setting()->row();
        $this->load->view('parameter/setting',$data);    
           
     }

  function saveSetting(){
       if($this->session->userdata('userID')!="1")
            redirect(base_url().'homenew', 'refresh');
       
        $data['page']="parameter";    
        $data['subpage']="setting"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>System Setting </li>";
        $data['Msg']="System Setting Modified Successful, Please Sign in Again";
        
         $this->load->model('Setting_Model');
        $this->load->library('settingClass');
        $settingClass=new settingClass;
        $settingClass=$this->Setting_Model->query_setting()->row();
        $settingClass->c1=$this->input->post('c1')==null?"0":"1";
        $settingClass->c2=$this->input->post('c2')==null?"0":"1";
        $settingClass->c3=$this->input->post('c3')==null?"0":"1";
        $this->Setting_Model->update_setting($settingClass);
        $data['setting']=$this->Setting_Model->query_setting()->row();
        $this->load->view('parameter/setting',$data);    
       
  }
  
       function special(){
           if($this->session->userdata('isAdmin')!="Y")
            redirect(base_url().'homenew', 'refresh');
        
         $data['page']="parameter";    
        $data['subpage']="setting"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>System Setting </li>";
        $data['Msg']="";
        
        $this->load->model('Setting_Model');
        $this->load->library('settingClass');
        $data['setting']=$this->Setting_Model->query_setting()->row();
        $this->load->view('parameter/specialsetting',$data);    
           
     }

  function saveSpecial(){
       if($this->session->userdata('isAdmin')!="Y")
            redirect(base_url().'homenew', 'refresh');
       
        $data['page']="parameter";    
        $data['subpage']="setting"; 
        $data['path']="<li>Parameter Setting</li><li  class='break'>&#187;</li><li>System Setting </li>";
        $data['Msg']="System Setting Modified Successful, 請重新登入後執行";
        
        $this->load->model('Setting_Model');
        $this->load->library('settingClass');
        $settingClass=new settingClass;
        $settingClass=$this->Setting_Model->query_setting()->row();
        $settingClass->sp1=$this->input->post('sp1')==null?"0":"1";
        $settingClass->sp2=$this->input->post('sp2')==null?"0":"1";
        $settingClass->sp3=$this->input->post('sp3')==null?"0":"1";
        $settingClass->sp4=$this->input->post('sp4')==null?"0":"1";
        $settingClass->sp5=$this->input->post('sp5')==null?"0":"1";
        $this->Setting_Model->update_setting($settingClass);
        $data['setting']=$this->Setting_Model->query_setting()->row();
        $this->load->view('parameter/specialsetting',$data);    
       
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */