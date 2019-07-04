<?php

class Version_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }




    function query_Version($id){
        $sql= "SELECT * FROM versioncontrol   where versionno=$id";
       
        return $this->db->query($sql,array($id));

    }
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */