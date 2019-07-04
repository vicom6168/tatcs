<?php

class Valve_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_valveList(){
		$sql= "SELECT *  FROM valve   where isDeleted='N'  order by valvecategory,valvecode";
	
		return $this->db->query($sql);

	}
    function query_adListFront(){
        $today=date('Y-m-d');
        $sql= "SELECT *  FROM advertisement   where isDeleted='N' and aonline='Y'  and astartdate<='$today'  and aenddate>='$today' order by aorder";
    
        return $this->db->query($sql);

    }
    function query_valve($id){
        $sql= "SELECT * FROM valve   where valvecode=?";
        return $this->db->query($sql,array($id));

    }

	function save_valve($valveClass){
		$this->db->insert('valve', $valveClass);
        
        $insert_id = $this->db->insert_id();
        return  $insert_id;

	}
	function delete_valve($aid){
		$sql= "update  valve  set isDeleted='Y' where  valvecode=?";
		return $this->db->query($sql,array($aid));
	}
    function update_valve($aid,$valveClass){
        $this->db->where('valvecode', $aid);
        $this->db->update('valve', $valveClass);
    }
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */