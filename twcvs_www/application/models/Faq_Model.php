<?php

class Faq_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function qry_faqlist(){
	    $otherdb = $this->load->database('ad', TRUE);
		$sql= "SELECT * FROM faq    ";
		
		$sql.= "  order by  faqsubject,faqorder desc ";
        
		return $otherdb->query($sql);

	}
    function query_faq($id){
          $otherdb = $this->load->database('ad', TRUE);
        $sql= "SELECT * FROM faq   where faqid=?";
        return $otherdb->query($sql,array($id));

    }
	function save_faq($faqClass){
		    $this->db->insert('faq', $faqClass);
        $insert_id = $this->db->insert_id();

          return  $insert_id;
	}
 function update_faq($nID,$faqClass){
        $this->db->where('faqid', $nID);
        $this->db->update('faq', $faqClass);
    }   
  function delete_faq($nid){
    $this->db->where('faqid', $nid);
   $this->db->delete('faq');
    }
	
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */