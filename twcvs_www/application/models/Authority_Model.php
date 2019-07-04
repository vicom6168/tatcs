<?php

class Authority_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_authoritybyvs($vsid){
		$sql= "SELECT userauthority.*, user.userRealname as name FROM userauthority ,user  where vsid=?  and userauthority.uid=userID and a_status='1'";
		
		$sql.= "  order by  a_time desc ";
        
		return $this->db->query($sql,array($vsid));

	}
    function query_authoritybyuser($uid){
        $sql= "SELECT userauthority.*, user.userRealname as name FROM userauthority,user     where uid=? and userauthority.vsid=userID and a_status='1'";
        return $this->db->query($sql,array($uid));

    }
	 function query_authority($vsid,$uid){
        $sql= "SELECT * FROM userauthority   where vsid=? and uid=? and a_status='1'";
        return $this->db->query($sql,array($vsid,$uid));

    } 
     
     function add_authority($authorityClass){
       $this->db->insert('userauthority', $authorityClass);
     $insert_id = $this->db->insert_id();

          return  $insert_id;
    } 
	
      function delete_authority($aid,$authorityClass){
        $this->db->where('aid', $aid);
     $this->db->update('userauthority', $authorityClass);
    }
    
    function query_authorityhistory($vsid){
        $sql= "SELECT userauthority.*, user.userRealname as name FROM userauthority ,user  where vsid=?  and userauthority.uid=userID";
        
        $sql.= "  order by  a_status desc, a_time desc ";
        
        return $this->db->query($sql,array($vsid));

    }
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */