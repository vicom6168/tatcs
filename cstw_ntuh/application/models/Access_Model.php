<?php

class Access_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_accessList($uid){
		$sql= "SELECT * FROM accesslog   where uid=? ";
		if($uid!="0")
        {
            $sql.= " where uid=? ";
       }
		$sql.= "  order by  accesstime desc ";
        
		return $this->db->query($sql,array($uid));

	}
    function query_access($id){
        $sql= "SELECT * FROM accesslog   where aid=?";
        return $this->db->query($sql,array($id));

    }
	function save_access($accessClass){
		    $this->db->insert('accesslog', $accessClass);
        $insert_id = $this->db->insert_id();

          return  $insert_id;

	}
	
   
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */