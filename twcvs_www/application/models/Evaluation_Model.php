<?php

class Evaluation_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_patientlist11($from,$count){
            $sql= "SELECT * FROM evaluation t1 where isDeleted='N'  and isSaved='0'";
           
            $sql .=" order by t1.patientID ";
            if($count!=0)
                 $sql .=" limit ".$from.",".$count."";
            return $this->db->query($sql); 

	}
    function query_patientlist($qField,$qOrder,$qstr,$from,$count){
            $sql= "SELECT * FROM evaluation t1 where isDeleted='N'  and isSaved='0'";
        if($qstr!="" && $qstr!="999999999"){
               if($qField=="1"){
                   $sql.= " and ( patientChartNumber like '%".$qstr."' or patientChartNumber like '".$qstr."%'  or patientChartNumber like '%".$qstr."%'" ;
                $sql.= ")";
               } else if($qField=="2"){
                    $sql.= " and ( patientName like '%".$qstr."' or patientName like '".$qstr."%'  or patientName like '%".$qstr."%'" ;
                   $sql.= ")";
               } else if ($qField=="3"){
                     $sql.= " and ( patientSurgeon like '%".$qstr."' or patientSurgeon like '".$qstr."%'  or patientSurgeon like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon2 like '%".$qstr."' or patientSurgeon2 like '".$qstr."%'  or patientSurgeon2 like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon3 like '%".$qstr."' or patientSurgeon3 like '".$qstr."%'  or patientSurgeon3 like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon4 like '%".$qstr."' or patientSurgeon4 like '".$qstr."%'  or patientSurgeon4 like '%".$qstr."%'" ;
          $sql.= ")";
               } else {
               $sql.= " and ( patientChartNumber like '%".$qstr."' or patientChartNumber like '".$qstr."%'  or patientChartNumber like '%".$qstr."%'" ;
          $sql.= " or  patientName like '%".$qstr."' or patientName like '".$qstr."%'  or patientName like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon like '%".$qstr."' or patientSurgeon like '".$qstr."%'  or patientSurgeon like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon2 like '%".$qstr."' or patientSurgeon2 like '".$qstr."%'  or patientSurgeon2 like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon3 like '%".$qstr."' or patientSurgeon3 like '".$qstr."%'  or patientSurgeon3 like '%".$qstr."%'" ;
          $sql.= " or  patientSurgeon4 like '%".$qstr."' or patientSurgeon4 like '".$qstr."%'  or patientSurgeon4 like '%".$qstr."%'" ;
          $sql.= ")";
               } 
               }
                 if($qOrder=="1"){
                     $sql.= " order by patientChartNumber";
                 } else if($qOrder=="2"){
                     $sql.= " order by patientName";
                 }else if($qOrder=="3"){
                     $sql.= " order by patientSurgeon,patientSurgeon2,patientSurgeon3,patientSurgeon4";
                 }else if($qOrder=="4"){
                     $sql.= " order by patientBirthday";
                 }else if($qOrder=="5"){
                     $sql.= " order by patientAgeUnit, patientAge asc";
                 }else if($qOrder=="6"){
                     $sql.= " order by patientOpDate asc";
                 } else if($qOrder=="7"){
                     $sql.= " order by patientAgeUnit desc,  patientAge  desc";
                 } else if($qOrder=="8"){
                     $sql.= " order by patientOpDate desc";
                 } else {
                     $sql.= " order by patientID";
                     
                 }
             
             
       
           
            if($count!=0)
                 $sql .=" limit ".$from.",".$count."";
            return $this->db->query($sql); 

    }
    
	function Save_patient($evaluationClass){
		 $this->db->insert('evaluation', $evaluationClass);
      $insert_id = $this->db->insert_id();

   return  $insert_id;

	}

	function deleteRecord($id){
		$sql= "update  evaluation  set isDeleted='Y' where  patientID=?";
		return $this->db->query($sql,array($id));
	}

	function viewRecord($ID){
        $sql= "SELECT * FROM evaluation where  patientID=?";
        return $this->db->query($sql,array($ID));
    }
    
  function transferCompleted($ID){
        $sql= "update  evaluation set isSaved='1' where  patientID=?";
        return $this->db->query($sql,array($ID));
  }
      function Update_patient($patientID,$evaluationClass){
        $this->db->where('patientID', $patientID);
        $this->db->update('evaluation', $evaluationClass);
    }
        function insert_euro($score, $pID){
            $sql= "update evaluation set euroScoreII=?  where patientID=?";
           
        return $this->db->query($sql,array($score,$pID)); 

    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */