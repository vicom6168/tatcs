<?php

class Nonopenheart_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_nonopenheart($h="",$qyear,$qmonth){
            $sql= "SELECT * FROM nonopenheart where qYear=?  and qMonth=? ";
        if($h!="")
             $sql.= "  and patientHospital=? ";
        return $this->db->query($sql,array($qyear,$qmonth,$h)); 

	}
    function query_nonopenheartlist($h=""){
            $sql= "SELECT * FROM nonopenheart where patientHospital=? order by qYear,qMonth";
           
        return $this->db->query($sql,array($h)); 

    }

	function save_nonopenheart($nonopenheartClass){
		 $this->db->insert('nonopenheart', $nonopenheartClass);
      $insert_id = $this->db->insert_id();

   return  $insert_id;

	}

	
 
      function update_nonopenheart($nID,$nonopenheartClass){
        $this->db->where('nid', $nID);
        $this->db->update('nonopenheart', $nonopenheartClass);
    }
       
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */