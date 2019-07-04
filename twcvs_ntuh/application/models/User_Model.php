<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function checkUser($username,$password){
		 $sql= "SELECT *  ";
      $sql.= " FROM user   where userName =? and userPassword=? and isDeleted!='Y'";
   
      return $this->db->query($sql,array($username,$password));

	}
    function checkUserbyname($username){
         $sql= "SELECT *  ";
      $sql.= " FROM user   where userName =? and isDeleted!='Y'";
   
      return $this->db->query($sql,array($username));

    }
       function queryUserbyRealname($userrealname){
         $sql= "SELECT *  ";
      $sql.= " FROM user   where userRealname =? and isDeleted!='Y'";
     //   echo $sql;
      return $this->db->query($sql,array($userrealname));

    }
	function modifyPassword($username,$password){
        $sql= "update user set userPassword='$password' where userName='$username'";
        return $this->db->query($sql);

    }
    
      function query_userList(){
        $sql= "SELECT * FROM user where userID>1 and isDeleted !='Y'  order by  userRole,userName ";
        return $this->db->query($sql);
    }
       function query_userNotMeList($uid){
        $sql= "SELECT * FROM user where userID>1 and isDeleted !='Y' and userID!=? order by  userName ";
        return $this->db->query($sql,array($uid));
    }
      function query_useradminList(){
           $sql= "SELECT * FROM user where  isDeleted !='Y'  order by  userName ";
        return $this->db->query($sql);
      }
     function query_user($id){
        $sql= "SELECT * FROM user  where userID=?";
        return $this->db->query($sql,array($id));
    }
     function save_user($userClass){
        $this->db->insert('user', $userClass);

    }
    function delete_user($userID){
        $sql= "update  user  set isDeleted='Y' where  userID=?";
        return $this->db->query($sql,array($userID));
    }
    function update_user($userID,$userClass){
        $this->db->where('userID', $userID);
        $this->db->update('user', $userClass);
    }
    
    function querySendNotifyVS(){
         $sql= "SELECT * FROM user   where (userRole ='1' or userRole='2') and (vsEmailNotify1='Y' or vsEmailNotify2='Y'  or vsEmailNotify3='Y' ) and vsEmail!='' and isDeleted!='Y'";
   
      return $this->db->query($sql);
    }
    
    function queryProcedurebyName($name){
          $sql= "SELECT * FROM vascularprocedure   where subject='$name'";
     //   echo  $sql."<br/>";
      return $this->db->query($sql);
    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */