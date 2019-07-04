<?php

class Hospital_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_hospitalList($type="0"){
		$sql= "SELECT *  FROM hospital   where isDeleted='N'  ";
		if($type!="0")
        {
            $sql.= " and hospitalLevel='$type'";
        } 
		$sql.= "  order by hospitalName asc ";
        
		return $this->db->query($sql);

	}
    function query_hospital($id){
        $sql= "SELECT * FROM hospital   where hospitalID=?";
        return $this->db->query($sql,array($id));

    }
	function save_hospital($hospitalClass){
		$this->db->insert('hospital', $hospitalClass);
        
      $insert_id = $this->db->insert_id();

   return  $insert_id;

	}
	function delete_hospital($nID){
		$sql= "update  hospital  set isDeleted='Y' where  hospitalID=?";
		return $this->db->query($sql,array($nID));
	}
    function update_hospital($nID,$hospitalClass){
        $this->db->where('hospitalID', $nID);
        $this->db->update('hospital', $hospitalClass);
    }
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */