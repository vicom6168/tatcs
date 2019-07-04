<?php

class Advertisement_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_adList(){
		$sql= "SELECT *  FROM advertisement   where isDeleted='N'  order by aorder";
	
		return $this->db->query($sql);

	}
    function query_adListFront(){
        $today=date('Y-m-d');
        $sql= "SELECT *  FROM advertisement   where isDeleted='N' and aonline='Y'  and astartdate<='$today'  and aenddate>='$today' order by aorder";
    
        return $this->db->query($sql);

    }
    function query_ad($id){
        $sql= "SELECT * FROM advertisement   where aid=?";
        return $this->db->query($sql,array($id));

    }
    function go_ad($id){
         $sql= "update advertisement  set aclick=aclick+1  where aid=?";
         $this->db->query($sql,array($id));
        $sql= "SELECT * FROM advertisement   where aid=?";
        return $this->db->query($sql,array($id));

    }
	function save_ad($advertisementClass){
		$this->db->insert('advertisement', $advertisementClass);
        
      $insert_id = $this->db->insert_id();

   return  $insert_id;

	}
	function delete_ad($aid){
		$sql= "update  advertisement  set isDeleted='Y' where  aid=?";
		return $this->db->query($sql,array($aid));
	}
    function update_ad($aid,$advertisementClass){
        $this->db->where('aid', $aid);
        $this->db->update('advertisement', $advertisementClass);
    }
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */