<?php

class Contact_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_contactList($from,$count){
	      $otherdb = $this->load->database('ad', TRUE);
		$sql= "SELECT * FROM contact t1  ";
       $sql.= " order by status,submittime";
            if($count!=0)
                 $sql .=" limit ".$from.",".$count."";
            return $otherdb->query($sql); 

	}
    function query_contact($id){
          $otherdb = $this->load->database('ad', TRUE);
        $sql= "SELECT * FROM contact   where contactid=?";
        return $otherdb->query($sql,array($id));

    }
	function save_contact($cantactClass){
	      $otherdb = $this->load->database('ad', TRUE);
		  $otherdb->insert('contact', $cantactClass);
        $insert_id = $this->db->insert_id();

          return  $insert_id;

	}
	  
    function update_contact($contactid,$cantactClass){
          $otherdb = $this->load->database('ad', TRUE);
        $this->db->where('contactid', $contactid);
        $otherdb->update('contact', $cantactClass);
    }
   
    
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */