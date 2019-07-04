<?php

class Shinzhu_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_shinZhuList(){
		$sql= "SELECT *  FROM myheart ";
	
		return $this->db->query($sql);

	}
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */