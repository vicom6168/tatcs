<?php

class PatientInformation_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_patientlist($qHospital,$qOrder,$qstr,$from,$count){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' ";
      
               if($qHospital!="0"){
                   $sql.= " and ( patientHospital ='$qHospital') " ;
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
                     $sql.= " order by patientAgeUnit , patientAge desc";
                 }else if($qOrder=="6"){
                     $sql.= " order by patientOpDate asc";
                 } else if($qOrder=="7"){
                     $sql.= " order by patientAgeUnit desc,  patientAge";
                 } else if($qOrder=="8"){
                     $sql.= " order by patientOpDate desc";
                 } else {
                     $sql.= " order by patientID";
                     
                 }
             
             
        
           
            if($count!=0)
                 $sql .=" limit ".$from.",".$count."";
            return $this->db->query($sql); 

	}
	
    
    function query_uncompletelist($qField,$qOrder,$qCondition,$qstr,$from,$count){
             $sql= "SELECT *,";
             $sql.="if(patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00','Y','N') as uncomplete_1, ";
             $sql.="if( patientOpDate='' or patientOpDate='0000-00-00' ";
            $sql.= " or  (patientSurgeon=''  and  patientSurgeon2=''   and  patientSurgeon3=''   and  patientSurgeon4='') " ;
            $sql.= " or  (patientCongenitalSurgery!='Y' ";
            $sql.= " and ((operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y'" ;
            $sql.= " and  operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')" ;
                  $sql.= " or  ((AdultDiagnosis1 ='' or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null) and  (AdultDiagnosis3='' or AdultDiagnosis3 is null) and  (AdultDiagnosis4='' or AdultDiagnosis4 is null) and  (AdultDiagnosis5='' or AdultDiagnosis5 is null) and (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null))))";
            $sql.= " or  (patientCongenitalSurgery='Y' ";
            $sql.= " and ((CongenitalDiagnosis1 ='' and  CongenitalDiagnosis2 ='' and  CongenitalDiagnosis3 ='' and  CongenitalDiagnosis4 ='' and  CongenitalDiagnosis5 ='' and CongenitalDiagnosisOthers='')" ;
                  $sql.= " or (CongenitalProcedure1 ='' and  CongenitalProcedure2 ='' and  CongenitalProcedure3 ='' and  CongenitalProcedure4 ='' and  CongenitalProcedure5 ='' and CongenitalProcedureOthers='')))" ;
              $sql.=",'Y','N') as uncomplete_2, ";
             $sql.="if(patientDischargeDate='' or patientDischargeDate='0000-00-00' or  outcomeExtubationDate=''  or  outcomeExtubationDate='0000-00-00'  or outcomeStatus=''   or patientDischargeDate is null or outcomeExtubationDate is null or outcomeStatus is null,'Y','N') as uncomplete_3 ";
         $sql.=" FROM patientinformation t1 where isDeleted='N' ";
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
           
        
          $subsql= " and (1>2 ";
          
          if($qCondition=="0" || $qCondition=="1"){
                $subsql.= "  or  (patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00')";
             }   
              if($qCondition=="0" || $qCondition=="3"){
               $subsql.= "  or  (patientDischargeDate='' or patientDischargeDate='0000-00-00' or  outcomeExtubationDate=''  or  outcomeExtubationDate='0000-00-00'  or outcomeStatus=''  or patientDischargeDate is null or outcomeExtubationDate is null or outcomeStatus is null) " ;
           }
               if($qCondition=="0" || $qCondition=="2"){
                   $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00'";
            $subsql.= " or  (patientSurgeon=''  and  patientSurgeon2=''   and  patientSurgeon3=''   and  patientSurgeon4='') " ;
            $subsql.= " or  (patientCongenitalSurgery!='Y' ";
            $subsql.= " and ((operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y'" ;
            $subsql.= " and  operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')" ;
                  $subsql.= " or  ((AdultDiagnosis1 ='' or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null) and  (AdultDiagnosis3='' or AdultDiagnosis3 is null) and  (AdultDiagnosis4='' or AdultDiagnosis4 is null) and  (AdultDiagnosis5='' or AdultDiagnosis5 is null) and (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null))))";
            $subsql.= " or  (patientCongenitalSurgery='Y' ";
            $subsql.= " and ((CongenitalDiagnosis1 ='' and  CongenitalDiagnosis2 ='' and  CongenitalDiagnosis3 ='' and  CongenitalDiagnosis4 ='' and  CongenitalDiagnosis5 ='' and CongenitalDiagnosisOthers='')" ;
                  $subsql.= " or (CongenitalProcedure1 ='' and  CongenitalProcedure2 ='' and  CongenitalProcedure3 ='' and  CongenitalProcedure4 ='' and  CongenitalProcedure5 ='' and CongenitalProcedureOthers='')))" ;
                 }
            $sql.= $subsql." )";
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
            
          //echo $sql;
            return $this->db->query($sql); 

    }
    
function export_patientlist($d1,$d2,$h){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital=?";
        
           $sql.= " order by patientOpDate";
        return $this->db->query($sql,array($h)); 

    }
     function queryPatientByDays($vsid,$days="0"){
         $today=date("Y-m-d");
       $sql= "SELECT t1.*,t2.userRealname FROM patientinformation t1,user t2 where t1.createPerson=t2.userID and t1.isDeleted='N' ";
     $sql.= "  and  (patientSurgeon_id='$vsid' or  patientSurgeon_id2='$vsid' or  patientSurgeon_id3='$vsid' or  patientSurgeon_id4='$vsid')";
   //  $sql.= "  and  (createTime between subdate(current_date(), 1) and current_date()) and  (createTime between subdate(current_date(), ".$days.") and current_date()) ";
         if($days=="1") {  //日報表
             $sql.= " and patientOpDate<'$today' and patientOpDate>=DATE_SUB('$today',INTERVAL 1 DAY) ";
         }
         if($days=="2") {  //週報表
             $sql.= " and patientOpDate<'$today' and patientOpDate>=DATE_SUB('$today',INTERVAL 1 WEEK) ";
         }
         if($days=="3") {  //月報表
             $sql.= " and patientOpDate<'$today' and patientOpDate>=DATE_SUB('$today',INTERVAL 1 YEAR) ";
         }
         $sql.= "  order by patientOpDate";
         //echo $sql."<br/>";
     return $this->db->query($sql); 
    }
    function export_patientlistCVS($d1,$d2,$h){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
             $sql= "SELECT ";
        $sql.=" patientHospitalUUID,patientHospital,patientAge,IF(patientAgeUnit='1', 'Y', IF(patientAgeUnit='2', 'M', 'D')) AgeUnit,patientGender,patientSurgeon,patientSurgeon2,patientSurgeon3,patientSurgeon4,patientSurgeon_id,patientSurgeon_id2,patientSurgeon_id3,patientSurgeon_id4,patientSurgeon_associalid,patientSurgeon_associalid2,patientSurgeon_associalid3,patientSurgeon_associalid4,patientReoperation,patientOpDate,patientDischargeDate,patientOpenHeartSurgery,patientCongenitalSurgery,patientNonOpenHeart,patientDiagnosis,patientSyntaxScore,patientSyntaxScoreContent,patientSyntaxScoreTable,patientAssociatedDisease,patientBodyWeight,patientSerumCreatinine,pastHistoryRenalImpairment,CcrberforOperation,pastHistoryExtracardiacArteriopathy,pastHistoryPoorMobility,pastHistoryPreviousCardiacSurgery,pastHistoryChronicLungDisease,pastHistoryActiveEndocarditis,pastHistoryCriticalPreoperativeState,pastHistoryDiabetesOnInsulin,pastHistoryNYHA,pastHistoryCCSClass4Angina,pastHistoryLVFunction,pastHistoryRecentMI,pastHistoryPulmonaryHypertension,pastHistoryUrgency,pastHistoryWeightOfTheIntervention,pastHistorySurgeryThoracicAorta,euroScoreII,operationAssociateCategory,AdultDiagnosis1,AdultDiagnosis2,AdultDiagnosis3,AdultDiagnosis4,AdultDiagnosis5,AdultDiagnosis_id1,AdultDiagnosis_id2,AdultDiagnosis_id3,AdultDiagnosis_id4,AdultDiagnosis_id5,AdultDiagnosisOthers,operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationMitralValveBentall as operationAorticValveBentall,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo,outcomeDeath,outcomeDeathDate,outcomeDeathMemo,outcomeWoundInfection,outcomeWoundInfectionData,outcomeWoundInfectionMemo,outcomeBacteremia,outcomeBacteremiaData,outcomeBacteremiaMemo,outcomeReentry,outcomeReentryMemo,outcomeDialysis,outcomeDialysisDate,outcomeDialysisMemo,outcomeECMO,outcomeECMOData,outcomeECMOMemo,outcomeIABP,outcomeIABPMemo,outcomeStroke,outcomeStrokeMemo,outcomeArrthymia,outcomeArrthymiaData,outcomeArrthymiaMemo,isDeleted,outcomeCheck1,outcomeData1,outcomeCheck2,outcomeData2,outcomeCheck3,outcomeData3,outcomeCheck4,outcomeData4,outcomeCheck5,outcomeData5,outcomeCheck6,outcomeData6,outcomeCheck7,outcomeData7,outcomeCheck8,outcomeData8,outcomeCheck9,outcomeData9,outcomeCheck10,outcomeData10,outcomeChildComplication1,outcomeChildComplication2,outcomeChildComplication3,outcomeChildComplication4,outcomeChildComplication5,outcomeChildComplication6,outcomeChildComplication7,outcomeChildComplication8,outcomeChildComplication9,outcomeChildComplication10,outcomeChildComplication11,outcomeChildComplication12,outcomeChildComplication13,outcomeChildComplication14,outcomeChildComplication15,outcomeChildComplication16,outcomeChildComplication17,outcomeChildComplication18,outcomeChildComplication19,outcomeChildComplication20,outcomeChildComplication21,outcomeChildComplication22,outcomeChildComplication23,outcomeChildComplication24,outcomeChildComplication25,outcomeChildComplication26,outcomeChildComplication27,outcomeChildComplication28,outcomeChildComplication29,outcomeChildComplication30,outcomeChildComplication31,outcomeChildComplication32,outcomeChildComplication33,outcomeChildComplication34,outcomeChildComplication35,outcomeChildComplication36,outcomeChildCauseofDeath,outcomeExtubationDate,outcomeStatus,patientICUDischargeDate";
            $sql.=" FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         
         if($h!='')
             $sql.= "  and patientHospital=?";
        
           $sql.= " order by patientOpDate";
         return $this->db->query($sql,array(urldecode($h))); 
    }
	function Save_patient($patientinformationClass){
		 $this->db->insert('patientinformation', $patientinformationClass);
      $insert_id = $this->db->insert_id();

   return  $insert_id;

	}
function Save_patienthistory($patientinformationClass){
         $this->db->insert('patienthistory', $patientinformationClass);
      $insert_id = $this->db->insert_id();

   return  $insert_id;

    }
	function deleteRecord($id){
		$sql= "update  patientinformation  set isDeleted='Y' where  patientID=?";
		return $this->db->query($sql,array($id));
	}

	function viewRecord($ID){
        $sql= "SELECT * FROM patientinformation where  patientID=?";
        return $this->db->query($sql,array($ID));
    }
    
    function Update($bookingID,$bookingClass){
        $this->db->where('bookingID', $bookingID);
        $this->db->update('booking', $bookingClass);
    }
      function Update_patient($patientID,$patientinformationClass){
        $this->db->where('patientID', $patientID);
        $this->db->update('patientinformation', $patientinformationClass);
    }
       function query_agelist($from,$count){
            $sql= "SELECT *,  DATEDIFF(patientOpDate,patientBirthday) AS ageDate FROM patientinformation t1 where isDeleted='N' ";
           
        return $this->db->query($sql); 

    }
       
       function insert_age($age,$ageType, $pID){
            $sql= "update patientinformation set patientAge=? , patientAgeUnit=? where patientID=?";
           
        return $this->db->query($sql,array($age,$ageType, $pID)); 

    }
       
         function insert_euro($score, $pID){
            $sql= "update patientinformation set euroScoreII=?  where patientID=?";
           
        return $this->db->query($sql,array($score,$pID)); 

    }
    
       function insert_CCR($score,$pID){
            $sql= "update patientinformation set CcrberforOperation=?  where patientID=?";
           
        return $this->db->query($sql,array($score,$pID)); 

    }
       function selectEvaluation($patientChartNumber, $patientOPdate){
           $sql= "select * from  patientinformation where  patientChartNumber=?  and patientOpDate=? and isDeleted='N'";
           
        return $this->db->query($sql,array($patientChartNumber, $patientOPdate)); 
       }
       
        function selectDiagnosis(){
           $sql= " select * from congenitalsurgerydiagnosis order by  congenitalsurgerydiagnosis.category, congenitalsurgerydiagnosis.order ";
           
        return $this->db->query($sql); 
       }
        
        function selectProcedure(){
           $sql= " select * from congenitalsurgeryprocedure order by  congenitalsurgeryprocedure.category, congenitalsurgeryprocedure.order ";
           
        return $this->db->query($sql); 
       }
         function selectAdultDiagnosis(){
           $sql= " select * from adultDiagnosis order by  adultDiagnosis.order ";
           
        return $this->db->query($sql); 
       }
         function qryPatientHistory($pid){
           $sql= " select * from accesslog where accesskey=? and accesstable='PATIENT' order by accesstime desc ";
           
        return $this->db->query($sql,array($pid)); 
       }
          function qryPatientHistoryDetail($aid,$processStep){
           $sql= " select * from patienthistory where isSaved=?  and SyntaxScoreDominance=? order by SyntaxScoreDominance asc,modifyTime desc ";
           
        return $this->db->query($sql,array($aid,$processStep)); 
       }
          function qryPatientHistorybyUser($pid,$qdate,$from,$count){
                  $sql= " select * from accesslog where uid=? and accesstime>='$qdate' and accesstime< DATE_ADD('$qdate' ,INTERVAL 1 MONTH) order by accesstime desc ";
           if($count!=0)
                 $sql .=" limit ".$from.",".$count.""; 
        return $this->db->query($sql,array($pid)); 
          }
          
           function queryDataOwner($sid, $uid){
           $sql= "select * from  userauthority where  vsid=?  and uid=? and a_status='1'";
           
        return $this->db->query($sql,array($sid, $uid)); 
       }
           
           function checkUpload($uuid, $hname){
               
               $sql= "select * from  patientinformation where  patientHospitalUUID=?  and patientHospital=?";
           
        return $this->db->query($sql,array($uuid, $hname)); 
           }
           
                function export_uploadNonSurgery($y,$m,$yEnd,$mEnd,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
    
       $sql= "SELECT  * FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH) order by  qYear, qMonth";

        return $this->db->query($sql);
   }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */