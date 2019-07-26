<?php

class PatientInformation_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_patientlist($qField,$qOrder,$qstr,$from,$count){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' ";
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
	
    function query_LVADCount(){
        $sql= "SELECT  count(*)  as LVADCount from patientinformation t1 where isDeleted='N' and (operationHeartTransplantationLVAD='Y' or operationHeartTransplantationRVAD='Y')";
           return $this->db->query($sql); 
    }
    function update_patientLVAD($pid, $lvadScore){
        $LVADHMRSRisk="";
      $LVADHMRS90DaysMortality=""; 
             if($lvadScore<1.58){
              $LVADHMRSRisk='Low Risk';
          $LVADHMRS90DaysMortality='4%';
          } else  if($lvadScore>=1.58 && $lvadScore<2.48){
              $LVADHMRSRisk='Medium Risk';
         $LVADHMRS90DaysMortality='16%';
          } else if($lvadScore>=2.48){
              $LVADHMRSRisk='High Risk ';
          $LVADHMRS90DaysMortality='29%';
          }
          
        $sql= "update   patientinformation set LVADHMRS=$lvadScore,LVADHMRSRisk='$LVADHMRSRisk', LVADHMRS90DaysMortality='$LVADHMRS90DaysMortality' where patientID=$pid";
         return $this->db->query($sql);
        
    }
    
    
    function query_uncompletelist($qField,$qOrder,$qCondition,$qstr,$from,$count){
             $sql= "SELECT *,";
             $sql.="if(patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00'  or patientBirthday is null";
             $sql.=" or patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null ,'Y','N') as uncomplete_1, ";
             $sql.=" if(patientSurgeon=''  or patientSurgeon is null or patientSurgeon3=''  or patientSurgeon3 is null or diseaseType='' or diseaseType is null or  " ;
             $sql.= " ((Procedure_id1=''  or Procedure_id1 is null) and (Procedure_Others=''  or Procedure_Others is null) )  or " ;
             $sql.= " ((Diagnosis_id1=''  or Diagnosis_id1 is null) and (DiagnosisOthers=''  or DiagnosisOthers is null) ) , 'Y','N') as uncomplete_2," ;
             $sql.="if(outcomeStatus='' or outcomeStatus is null,'Y','N') as uncomplete_3 ";
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
                $subsql.= "  or  (patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00' or patientOpDate='' or patientOpDate='0000-00-00' or AdmissionDate='' or AdmissionDate='0000-00-00'  or DischargeDate='' or DischargeDate='0000-00-00' )";
             }   
              if($qCondition=="0" || $qCondition=="3"){
               $subsql.= "  or  (outcomeStatus='' or outcomeStatus is null) " ;
           }
               if($qCondition=="0" || $qCondition=="2"){
                   $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null";
            $subsql.= " or  (patientSurgeon='' or  patientSurgeon is null) " ;
            $subsql.= " or  (diseaseType='' or diseaseType is null ) ";
            $subsql.= " or  ((Procedure_id1=''  or Procedure_id1 is null) and (Procedure_Others=''  or Procedure_Others is null)  ) ";
            $subsql.= " or  ((Diagnosis_id1=''  or Diagnosis_id1 is null) and (DiagnosisOthers=''  or DiagnosisOthers is null) ) ";
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
            
         // echo $sql;
            return $this->db->query($sql); 

    }
    
function export_patientlist($d1,$d2,$h){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital='$h'";
        
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
             $sql.= " and patientOpDate<'$today' and patientOpDate>=DATE_SUB('$today',INTERVAL 1 MONTH) ";
         }
         $sql.= "  order by patientOpDate";
         //echo $sql."<br/>";
     return $this->db->query($sql); 
    }
    function export_patientlistCVS($d1,$d2,$h){
            $sql= "SELECT ";
            $sql.="patientID,patientHospital,patientSSN,patientChartNumber,patientName,patientBirthday,patientAge,patientAgeUnit,patientGender";
            $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon),t1.patientSurgeon,if(t1.patientSurgeon<>'','******',''))  as 'patientSurgeon 1'";
            $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon2),t1.patientSurgeon2,if(t1.patientSurgeon2<>'','******',''))    as 'patientSurgeon 2'";
           $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon3),t1.patientSurgeon3,if(t1.patientSurgeon3<>'','******',''))  as 'patientSurgeon 3'";
           $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon4),t1.patientSurgeon4,if(t1.patientSurgeon4<>'','******',''))  as 'patientSurgeon 4'";
           $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon5),t1.patientSurgeon5,if(t1.patientSurgeon5<>'','******',''))  as 'patientSurgeon 5'";
            $sql.=",ReOperation,patientOpDate,AdmissionDate,DischargeDate,patientIsICUAdmission,LOS,ICUAdmissionDate,ICUDischargeDate,ICU_LOS,ExtubationDate,patientAssociatedDisease,diseaseType,Procedure1,Procedure2,Procedure3,Procedure4,Procedure5,Procedure_id1,Procedure_id2,Procedure_id3,Procedure_id4,Procedure_id5,Procedure_Others,Diagnosis1,Diagnosis2,Diagnosis3,Diagnosis4,Diagnosis5,Diagnosis_id1,Diagnosis_id2,Diagnosis_id3,Diagnosis_id4,Diagnosis_id5,DiagnosisOthers,operationOthersOperation,ProcedureType1,ProcedureType2,ProcedureType3,ProcedureType4,ProcedureType5,ProcedureTypeName1,ProcedureTypeName2,ProcedureTypeName3,ProcedureTypeName4,ProcedureTypeName5,CancerLSHeight,CancerLSWeight,CancerLSSmokingAmount,CancerLSSmokingYear,CancerLSSmokingQuitYear,CancerLSBetelNutsAmount,CancerLSBetelNutsYear,CancerLSBetelNutsQuitYear,CancerLSDrinking,Cancer_KPS,Cancer_ECOG,CancerClinical_T,CancerClinical_N,CancerClinical_M,CancerClinical_StageGroup,CancerPathological_T,CancerPathological_N,CancerPathological_M,CancerPathological_Stage,CancerStage_memo,CharlsonScore_MI,CharlsonScore_CHF,CharlsonScore_PVD,CharlsonScore_CVA,CharlsonScore_Dementia,CharlsonScore_COPD,CharlsonScore_ConnectiveTissueDisease,CharlsonScore_PepticUlcerDisease,CharlsonScore_LiverDisease,CharlsonScore_DiabetesMellitus,CharlsonScore_Hemiplegia,CharlsonScore_CKD,CharlsonScore_SolidTumor,CharlsonScore_Leukemia,CharlsonScore_Lymphoma,CharlsonScore_AIDS,CharlsonScore_Score,outcomeDeath,outcomeDeathDate,outcomeDeathMemo,outcomeMortalityCheck,outcomeMortalityNote,outcomeInfectionCheck,outcomeInfectionNote,outcomeReoperationCheck,outcomeReoperationNote,outcomePneumoniaCheck,outcomePneumoniaNote,outcomeIntubationCheck,outcomeIntubationNote,outcomeHemothoraxCheck,outcomeHemothoraxNote,outcomePneumothoraxCheck,outcomePneumothoraxNote,outcomeBPFistulaCheck,outcomeBPFistulaNote,outcomeChylothoraxCheck,outcomeChylothoraxNote,outcomeAnastomosisCheck,outcomeAnastomosisNote,outcomeIleusCheck,outcomeIleusNote,outcomeAspirationCheck,outcomeAspirationNote,outcomeDysphagiaCheck,outcomeDysphagiaNote,outcomeArrthymiaCheck,outcomeArrthymiaNote,outcomeOthersCheck,outcomeOthersNote,isDeleted,outcomeStatus";
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
    function viewRecordByChart($ID,$opdate){
        $sql= "SELECT * FROM patientinformation where  patientChartNumber=? and patientOpDate=?";
        return $this->db->query($sql,array($ID,$opdate));
    }
     function viewEvaluationByChart($ID,$opdate){
        $sql= "SELECT * FROM evaluation where  patientChartNumber=? and patientOpDate=?";
        return $this->db->query($sql,array($ID,$opdate));
    }
    function Update($bookingID,$bookingClass){
        $this->db->where('bookingID', $bookingID);
        $this->db->update('booking', $bookingClass);
    }
      function Update_patient($patientID,$patientinformationClass){
        $this->db->where('patientID', $patientID);
        $this->db->update('patientinformation', $patientinformationClass);
    }
     function Update_patientfromUpload($UUID,$patientinformationClass){
        $this->db->where('patientHospitalUUID', $UUID);
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
       
      
      
       
        function selectDiagnosis($t){
              if($t!="" && $t!="99"){
           $sql= " select * from surgerydiagnosis where category='$t' or category2='$t'  order by  surgerydiagnosis.code , surgerydiagnosis.order";
           } else {
           $sql= " select * from surgerydiagnosis order by   surgerydiagnosis.code , surgerydiagnosis.order";
           }
        return $this->db->query($sql); 
       }
        
        function selectProcedure($t){
            if($t!="" && $t!="99"){
                $sql= " select * from  surgeryprocedure where cancertype='$t' order by   surgeryprocedure.cancertype,surgeryprocedure.code ,surgeryprocedure.order";
            }  else {
           $sql= " select * from surgeryprocedure order by   surgeryprocedure.cancertype,surgeryprocedure.code , surgeryprocedure.order";
           }
        return $this->db->query($sql); 
       }
        
         
         
         
         
         function qryPatientHistory($pid){
           $sql= " select * from accesslog where accesskey=? and accesstable='PATIENT' order by accesstime desc ";
           
        return $this->db->query($sql,array($pid)); 
       }
          function qryPatientHistoryDetail($aid,$processStep){
           $sql= " select * from patienthistory where isSaved=?  and modifiedFlag=? order by modifiedFlag asc,modifyTime desc ";
           
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
    function export_uploadNonSurgery($y,$m,$yEnd,$mEnd,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
    
       $sql= "SELECT  * FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH) order by  qYear, qMonth";

        return $this->db->query($sql);
   }
     function export_uploadpatientlist($d1,$d2,$h){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital=?";
         
            $subsql= "SELECT patientID ";
            $subsql.=" FROM patientinformation t1 where isDeleted='N' ";
           
             $subsql.= " and (1>2 ";
          
         
                $subsql.= "  or  (patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00' or patientOpDate='' or patientOpDate='0000-00-00' or AdmissionDate='' or AdmissionDate='0000-00-00'  or DischargeDate='' or DischargeDate='0000-00-00' )";
            
             
               $subsql.= "  or  (outcomeStatus='' or outcomeStatus is null) " ;
          
               
                   $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null";
            $subsql.= " or  (patientSurgeon='' or  patientSurgeon is null) " ;
            $subsql.= " or  (diseaseType='' or diseaseType is null ) ";
            $subsql.= " or  ((Procedure_id1=''  or Procedure_id1 is null) and (Procedure_Others=''  or Procedure_Others is null)  ) ";
            $subsql.= " or  ((Diagnosis_id1=''  or Diagnosis_id1 is null) and (DiagnosisOthers=''  or DiagnosisOthers is null) ) ";
                 
            $subsql.= " )";
               $sql.= " and ( patientID not in(".$subsql.") )";
             //  echo $sql;
        return $this->db->query($sql,array($h)); 

    }
   function export_uploadpatientdo($d1,$d2,$h){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital=?";
         
            $subsql= "SELECT patientID ";
            $subsql.=" FROM patientinformation t1 where isDeleted='N' ";
           
             $subsql.= " and (1>2 ";
          
         
                $subsql.= "  or  (patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00' or patientOpDate='' or patientOpDate='0000-00-00' or AdmissionDate='' or AdmissionDate='0000-00-00'  or DischargeDate='' or DischargeDate='0000-00-00' )";
            
             
               $subsql.= "  or  (outcomeStatus='' or outcomeStatus is null) " ;
          
               
                   $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null";
            $subsql.= " or  (patientSurgeon='' or  patientSurgeon is null) " ;
            $subsql.= " or  (diseaseType='' or diseaseType is null ) ";
            $subsql.= " or  ((Procedure_id1=''  or Procedure_id1 is null) and (Procedure_Others=''  or Procedure_Others is null)  ) ";
            $subsql.= " or  ((Diagnosis_id1=''  or Diagnosis_id1 is null) and (DiagnosisOthers=''  or DiagnosisOthers is null) ) ";
                 
            $subsql.= " )";
               $sql.= " and ( patientID not in(".$subsql.") )";
              
        return $this->db->query($sql,array($h)); 

    }
    
    function update_SyntaxScore($pid,$score){
        $sql="select sum(step1_Score)+SUM(step2_Score)+IFNULL(AVG(step3_Score),0)  as s,pid from syntaxscore where pid=? group by pid";
        $c=$this->db->query($sql,array($pid));
        if($c->num_rows()>0){
            $myScore=$c->row()->s;
          $sql= "update  patientinformation  set patientSyntaxScore=? where  patientID=?";
         return $this->db->query($sql,array($myScore,$pid));
        }
    }
    
    function checkUpload($uuid, $hname){
               
               $sql= "select * from  patientinformation where  patientHospitalUUID=?  and patientHospital=?";
           
        return $this->db->query($sql,array($uuid, $hname)); 
           }
           
    function queryPatientCompleted($vsid){
        $sql= "SELECT t1.*,t2.userRealname FROM patientinformation t1,user t2 where t1.createPerson=t2.userID and t1.isDeleted='N' ";
     $sql.= "  and CompletedStatus='Y' and InfoStatus='N' and  (patientSurgeon_id='$vsid' or  patientSurgeon_id2='$vsid' or  patientSurgeon_id3='$vsid' or  patientSurgeon_id4='$vsid')";
   return $this->db->query($sql); 
    }      
    
    function query_patientAlllist(){
        $sql= "SELECT * FROM patientinformation where isDeleted='N' ";
     return $this->db->query($sql); 
    }        
    
    function changeStatus($patientID,$completeStatus){
       $sql= "UPDATE  patientinformation set CompletedStatus=?, InfoStatus='N' where patientID=? ";
     return $this->db->query($sql,array($completeStatus, $patientID)); 
    }
    
    function mailStatus($patientID){
       $sql= "UPDATE  patientinformation set  InfoStatus='Y' where patientID=? ";
     return $this->db->query($sql,array($patientID)); 
    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */