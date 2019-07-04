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
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */