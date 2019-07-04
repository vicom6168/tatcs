<?php

class Vascular_Model extends CI_Model {


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
    function viewVascularRecord($id){
      
        $sql= "SELECT * FROM vascular   where patientID=?";
        return  $this->db->query($sql,array($id));

    }
	function Save_patient($VascularClass){
	        
          $this->db->insert('vascular', $VascularClass);
          $insert_id = $this->db->insert_id();

          return  $insert_id;

	}
	  
    function update_patient($pid,$VascularClass){
         $this->db->where('patientID', $pid);
        $this->db->update('vascular', $VascularClass);
    }
   function deleteVascularRecord($id){
        $sql= "update  vascular  set isDeleted='Y' where  patientID=?";
        return $this->db->query($sql,array($id));
    }
   function export_patientVascularlist($d1,$d2,$h){
            $sql= "SELECT * FROM vascular t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital='$h'";
        
           $sql.= " order by patientOpDate";
        return $this->db->query($sql,array($h)); 

    }
    
	function export_patientVascularlistCVS($d1,$d2,$h){
            $sql= "SELECT * FROM vascular t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital=?";
        
           $sql.= " order by patientOpDate";
         return $this->db->query($sql,array(urldecode($h))); 
    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */