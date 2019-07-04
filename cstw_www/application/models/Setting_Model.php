<?php

class Setting_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }

	function query_setting(){
		$sql= "SELECT * FROM setting   ";
		
		return $this->db->query($sql);

	}

    function update_setting($settingClass){
        $this->db->where('sid', 1);
        $this->db->update('setting', $settingClass);
    }
        function query_permission($hid){
            $otherdb = $this->load->database('ad', TRUE);
        $sql= "SELECT * FROM hospital where    hospitalID=?";
        
        return $otherdb->query($sql,array($hid));

    }
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */