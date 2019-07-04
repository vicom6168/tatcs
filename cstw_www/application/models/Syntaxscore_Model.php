<?php

class Syntaxscore_model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function wrieDominance($patientID,$Dominance){
	    $sql= "update  patientinformation  set SyntaxScoreDominance=? where  patientID=?";
     return $this->db->query($sql,array($Dominance,$patientID));
}
        function getSegment($Dominance){
            if($Dominance=="R"){
                 $sql= "select *  from syntaxscoreitem where syntaxScoreVisiableRight='1'";
            } else {
                 $sql= "select *  from syntaxscoreitem where syntaxScoreVisiableLeft='1'";      
            }
           return $this->db->query($sql);
}
        function getStep1Score($Dominance,$segment){
               if($Dominance=="R"){
                 $sql= "select 2*syntaxScoreFactorRight as score  from syntaxscoreitem where syntaxScoreSegment=?";
            } else {
                 $sql= "select 2*syntaxScoreFactorLeft as score  from syntaxscoreitem where syntaxScoreSegment=?";
            }
           return $this->db->query($sql,array($segment));
        }
        
        function Save_SyntaxScore($syntaxClass){
         $this->db->insert('syntaxscore', $syntaxClass);
      $insert_id = $this->db->insert_id();

         return  $insert_id;
        }

 function getScorebyPatient($patientID){
          
                 $sql= "select *  from syntaxscore where pid=? order by LesionsID";      
         //  echo $sql;
           return $this->db->query($sql,array($patientID));
}
 function getScorebyPatientID($sID){
          
                 $sql= "select *  from syntaxscore where sid=? order by LesionsID";      
         //  echo $sql;
           return $this->db->query($sql,array($sID));
}
  function getScorebyPatientLesionsID($patientID,$LesionsID){
          $sql= "select *  from syntaxscore where pid='$patientID' and LesionsID='$LesionsID' order by LesionsID";      
          // echo $sql;
           return $this->db->query($sql,array($patientID,$LesionsID));
 }
 function update_SyntaxScore($sid,$syntaxscoreClass){
             $this->db->where('sid', $sid);
        $this->db->update('syntaxscore', $syntaxscoreClass);
 }
 
 function deleteScore($sid,$pid){
     $this->db->delete('syntaxscore', array('sid' => $sid));
    $this->reAssignLesionID($pid); 
 }
 function changeLesionID($aid, $o){
     $sql=  "update  syntaxscore set LesionsID=? where sid=?  ";
        return $this->db->query($sql,array($o,$aid)); 
 }
 function reAssignLesionID($pid){
       $scoreList=$this->getScorebyPatient($pid);
     $myOrder=0;
     if($scoreList->num_rows()==0){
         $sql=  "update  patientinformation set SyntaxScoreDominance='', patientSyntaxScore='' where patientID=?  ";
         $this->db->query($sql,array($pid)); 
         
     } else {
      foreach($scoreList->result() as $row){
       $this->changeLesionID($row->sid, ++$myOrder);
       }
   }
 }
 
   function Update_SyntaxScoreBySID($sid,$syntaxscoreClass){
        $this->db->where('sid', $sid);
        $this->db->update('syntaxscore', $syntaxscoreClass);
    }
    
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */