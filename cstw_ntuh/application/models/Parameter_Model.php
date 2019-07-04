<?php

class Parameter_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_diagnosisList(){
		$sql= "SELECT * FROM diagnosis   where isDeleted !='Y' order by DiagnosisName ";
		return $this->db->query($sql);

	}
   
    function query_diagnosis($id){
        $sql= "SELECT * FROM diagnosis   where DiagnosisID=?";
        return $this->db->query($sql,array($id));

    }
	function save_diagnosis($diagnosisClass){
		$this->db->insert('diagnosis', $diagnosisClass);

	}
	function delete_diagnosis($diagnosisID){
		$sql= "update  diagnosis  set isDeleted='Y' where  DiagnosisID=?";
		return $this->db->query($sql,array($diagnosisID));
	}
    function update_diagnosis($diagnosisID,$diagnosisClass){
        $this->db->where('DiagnosisID', $diagnosisID);
      $this->db->update('diagnosis', $diagnosisClass);
    }
    
	function query_vsList(){
       // $sql= "SELECT * FROM vs   where isDeleted !='Y' order by hospitalID ";
       $sql= "  SELECT userID as vsID,userRealname as vsName,vsEmail,userRole FROM user ";
     $sql.= "  where isDeleted !='Y' and (userRole='1' or  userRole='2') order by userRole, userID,userRealname";
        return $this->db->query($sql);

    }
        function query_vs($vsID){
        $sql= "SELECT * FROM vs   where vsID =? order by hospitalID ";
      return $this->db->query($sql,array($vsID));

    }
    function save_vs($vsClass){
        $this->db->insert('vs', $vsClass);

    }
    function delete_vs($vsID){
        $sql= "update  vs  set isDeleted='Y' where  vsID=?";
        return $this->db->query($sql,array($vsID));
    }
    function update_vs($vsID,$vsClass){
        $this->db->where('vsID', $vsID);
     $this->db->update('vs', $vsClass);
    }
    
    function query_bacteriaList(){
        $sql= "SELECT * FROM bacteria where isDeleted !='Y'  order by  Bacteria_Name ";
        return $this->db->query($sql);
    }
     function query_bacteria($id){
        $sql= "SELECT * FROM bacteria  where Bacteria_No=?";
     return $this->db->query($sql,array($id));
    }
     function save_bacteria($bacteriaClass){
        $this->db->insert('bacteria', $bacteriaClass);

    }
    function delete_bacteria($bacteriaID){
        $sql= "update  bacteria  set isDeleted='Y' where  Bacteria_No=?";
      return $this->db->query($sql,array($bacteriaID));
    }
    function update_bacteria($bacteriaID,$bacteriaClass){
        $this->db->where('Bacteria_No', $bacteriaID);
      $this->db->update('bacteria', $bacteriaClass);
    }
    
    function query_procedureCategoryList(){
        $sql= "SELECT * FROM surgeryprocedure  group by cancertype order by CAST(cancertype AS DECIMAL(10))";
     return $this->db->query($sql);
    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */