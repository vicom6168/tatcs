<?php

class Api_model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function wrieDominance($patientID,$Dominance){
	    $sql= "update  patientinformation  set SyntaxScoreDominance=? where  patientID=?";
     
		return $this->db->query($sql,array($Dominance,$patientID));

	}


    
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */