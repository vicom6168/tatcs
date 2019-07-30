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
	   function query_uploadpatientlist($qField,$qOrder,$qstr,$from,$count){
	        $otherdb = $this->load->database('ad', TRUE);
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientHospital= '$qstr'";
       
           
            if($count!=0)
                 $sql .=" limit ".$from.",".$count."";
           // echo $sql;
            return $otherdb->query($sql); 

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
    function query_patientLVADlist($qField,$qOrder,$qstr,$from,$count){
              $sql= "SELECT *,";
         $sql.="if(LVADmachineLVAD =''  or  LVADmachineRVAD=''  or  LVADIntermacsLevel=''  or pastHistoryNYHA='' or LVADPeakVO2=''  or LVADIVinotropicLarge14days=''  or LVADIIABPSupportLarge7days=''  or LVADPreOperativeVentlator=''  or patientSerumCreatinine=''  or LVADBUN=''  or LVADAlbumin=''  or LVADINR=''  or LVADBilirubin=''  or LVADHeartRate=''  or LVADCVPLevel=''  or LVADPulmonary=''  or LVADLVEF=''  or LVADSevereRV=''  or LVADSevereTR='' or LVADmachineLVAD is Null  or  LVADmachineRVAD is Null   or  LVADIntermacsLevel is Null   or pastHistoryNYHA is Null  or LVADPeakVO2 is Null   or LVADIVinotropicLarge14days is Null  or LVADIIABPSupportLarge7days is Null  or LVADPreOperativeVentlator is Null   or patientSerumCreatinine is Null   or LVADBUN is Null   or LVADAlbumin is Null   or LVADINR is Null   or LVADBilirubin is Null   or LVADHeartRate is Null   or LVADCVPLevel is Null   or LVADPulmonary is Null   or LVADLVEF is Null   or LVADSevereRV is Null   or LVADSevereTR is Null ,'Y','N') as uncomplete  ";
              $sql.= "FROM patientinformation t1 where isDeleted='N' and (operationHeartTransplantationLVAD='Y' or operationHeartTransplantationRVAD='Y')";
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
     function query_patientVascularlist($qField,$qOrder,$qstr,$from,$count){
              $sql= "SELECT *,";
         $sql.="if(patientChartNumber ='' or patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null  or  (patientProcedure1='' and (patientProcedureOthers is null or patientProcedureOthers='')) or patientChartNumber is null or (patientProcedure1 is null and (patientProcedureOthers is null or patientProcedureOthers='')),'Y','N') as uncomplete  ";
              $sql.= "FROM vascular t1 where isDeleted='N'";
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
    
    
    function query_uncompletelist($qField,$qOrder,$qCondition,$qstr,$from,$count){
        $sql= "SELECT * from (";
             $sql.= "SELECT *,";
             $sql.="if(patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00','Y','N') as uncomplete_1, ";
             $sql.="if( patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null or (patientCardiopulmonaryBypass='' and patientOpDate>='2019-01-01') ";
            $sql.= " or  ((patientSurgeon=''  or patientSurgeon is null) and  (patientSurgeon2='' or patientSurgeon2 is null)   and  (patientSurgeon3='' or patientSurgeon3 is null)    and  (patientSurgeon4='' or patientSurgeon4 is null) ) " ;
             $sql.= " or  ((AdultDiagnosis1=''  or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null)   and  (AdultDiagnosis3='' or AdultDiagnosis3 is null)    and  (AdultDiagnosis4='' or AdultDiagnosis4 is null)  and  (AdultDiagnosis5='' or AdultDiagnosis5 is null)  and  (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null) and  (CongenitalDiagnosis1='' or CongenitalDiagnosis1 is null)  and  (CongenitalDiagnosis2='' or CongenitalDiagnosis2 is null)  and  (CongenitalDiagnosis3='' or CongenitalDiagnosis3 is null)  and  (CongenitalDiagnosis4='' or CongenitalDiagnosis4 is null)  and  (CongenitalDiagnosis5='' or CongenitalDiagnosis5 is null)  and  (CongenitalDiagnosisOthers='' or CongenitalDiagnosisOthers is null)  )  " ;
            $sql.= " or  (((AdultDiagnosis1 !='' and  AdultDiagnosis1 is not null) or  (AdultDiagnosis2 !=''  and  AdultDiagnosis2 is not null)  or  (AdultDiagnosis3!='' and  AdultDiagnosis3 is not null)  or  (AdultDiagnosis4 !='' and  AdultDiagnosis4 is not null)  or  (AdultDiagnosis5 !='' and  AdultDiagnosis5 is not null)  or (AdultDiagnosisOthers!='' and  AdultDiagnosisOthers is not null) )   ";
            $sql.= " and ((operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y'" ;
            $sql.= " and  operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')" ;
                  $sql.= " ))";
            $sql.= " or  ( ((CongenitalDiagnosis1 !='' and  CongenitalDiagnosis1 is not null) or  (CongenitalDiagnosis2 !=''  and  CongenitalDiagnosis2 is not null)  or  (CongenitalDiagnosis3 !='' and  CongenitalDiagnosis3 is not null)  or  (CongenitalDiagnosis4 !='' and  CongenitalDiagnosis4 is not null)  or  (CongenitalDiagnosis5 !='' and  CongenitalDiagnosis5 is not null)  or (CongenitalDiagnosisOthers!='' and  CongenitalDiagnosisOthers is not null) )  ";
            $sql.= " and (" ;
                  $sql.= "  ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedureOthers is null) )))" ;
              $sql.=",'Y','N') as uncomplete_2, ";
             $sql.="if(patientDischargeDate='' or patientDischargeDate='0000-00-00'  or outcomeStatus=''   or patientDischargeDate is null  or outcomeStatus is null,'Y','N') as uncomplete_3 ";
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
               $subsql.= "  or  (patientDischargeDate='' or patientDischargeDate='0000-00-00'   or outcomeStatus=''  or patientDischargeDate is null or  outcomeStatus is null) " ;
           }
               if($qCondition=="0" || $qCondition=="2"){
                   $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null or (patientCardiopulmonaryBypass='' and patientOpDate>='2019-01-01') ";
            $subsql.= " or  (patientSurgeon=''  and  patientSurgeon2=''   and  patientSurgeon3=''   and  patientSurgeon4='') " ;
            $subsql.= " or  (";
            $subsql.= " ((operationCABG !='Y' or operationCABG is null ) and  (operationAorticValve !='Y' or operationAorticValve is null)  and  (operationAorticSurgery !='Y' or operationAorticSurgery is null)  and  (operationMitralValve !='Y' or operationMitralValve is null)" ;
                   $subsql.= " and  (operationArrythmiaSurgery !='Y' or operationArrythmiaSurgery is null)  and  (operationTricuspidValve !='Y' or operationTricuspidValve is null)  and  (operationPulmonaryValve !='Y' or operationPulmonaryValve is null)  and  (operationHeartTransplantation !='Y' or operationHeartTransplantation is null)  and  (operationOtherCardiacSurgery !='Y' or operationOtherCardiacSurgery is null)  and CongenitalDiagnosis1 !='' and  CongenitalDiagnosis2 !='' and  CongenitalDiagnosis3 !='' and  CongenitalDiagnosis4 !='' and  CongenitalDiagnosis5 !='' and CongenitalDiagnosisOthers!='')" ;
                  $subsql.= " and (((CongenitalDiagnosis1 ='' or CongenitalDiagnosis1 is null)  and  (CongenitalDiagnosis2 ='' or CongenitalDiagnosis2 is null) and  (CongenitalDiagnosis3 ='' or CongenitalDiagnosis3 is null) and  (CongenitalDiagnosis4 ='' or CongenitalDiagnosis4 is null)  and  (CongenitalDiagnosis5 ='' or CongenitalDiagnosis5 is null ) and (CongenitalDiagnosisOthers='' or CongenitalDiagnosisOthers is null))" ;
                  $subsql.= " or ((CongenitalProcedure1 =''  or CongenitalProcedure1 is null) and  (CongenitalProcedure2 =''  or CongenitalProcedure2 is null) and  (CongenitalProcedure3 =''  or CongenitalProcedure3 is null) and  (CongenitalProcedure4 =''  or CongenitalProcedure4 is null)  and  (CongenitalProcedure5 =''  or CongenitalProcedure5 is null)  and (CongenitalProcedureOthers=''  or CongenitalProcedureOthers is null))))" ;
                  $subsql.= " or  ((AdultDiagnosis1 ='' or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null) and  (AdultDiagnosis3='' or AdultDiagnosis3 is null) and  (AdultDiagnosis4='' or AdultDiagnosis4 is null) and  (AdultDiagnosis5='' or AdultDiagnosis5 is null) and (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null)  and CongenitalDiagnosis1 !='' and  CongenitalDiagnosis2 !='' and  CongenitalDiagnosis3 !='' and  CongenitalDiagnosis4 !='' and  CongenitalDiagnosis5 !='' and CongenitalDiagnosisOthers!='')";
                  $subsql.= " or  ((CongenitalDiagnosis1='' or CongenitalDiagnosis1 is null)  and  (CongenitalDiagnosis2='' or CongenitalDiagnosis2 is null)   and  (CongenitalDiagnosis3='' or CongenitalDiagnosis3 is null )   and  (CongenitalDiagnosis4='' or CongenitalDiagnosis4 is null)  and  (CongenitalDiagnosis5='' or CongenitalDiagnosis5 is null)  and  (CongenitalProcedureOthers='' or CongenitalProcedureOthers is null)  and  (AdultDiagnosis1='' or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null) and  (AdultDiagnosis3='' or AdultDiagnosis3 is null) and  (AdultDiagnosis4='' or AdultDiagnosis4 is null) and  (AdultDiagnosis5='' or AdultDiagnosis5 is null) and  (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null) ) " ;
            
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
            $sql.= " ) t ";  
            $sql.= " where (uncomplete_1!='N' or uncomplete_2!='N' or uncomplete_3!='N')";  
            if($count!=0)
                 $sql .=" limit ".$from.",".$count."";
            
         // echo $sql;
          
            return $this->db->query($sql); 

    }
    
function export_patientlist($d1,$d2,$h,$t1,$t2,$t3,$v){
            $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital='$h'";
          if($t2=="Y" && $t1!='Y'){    
             $sql.= " and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         } 
          if($t1=="Y" && $t2!='Y'){    
             $sql.= " and ((CongenitalDiagnosis1='' or CongenitalDiagnosis1 is null) and (CongenitalDiagnosis2='' or CongenitalDiagnosis2 is null) and (CongenitalDiagnosis3='' or CongenitalDiagnosis3 is null) and (CongenitalDiagnosis4='' or CongenitalDiagnosis4 is null) and (CongenitalDiagnosis5='' or CongenitalDiagnosis5 is null) and (CongenitalDiagnosisOthers='' or CongenitalDiagnosisOthers is null)) ";
         } 
          if($v=="6"){
                $sql= "SELECT * FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
                $sql.= " and (patientSurgeon='".$this->session->userdata('userRealname')."'  or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."') ";
          }
           $sql.= " order by patientOpDate";
        //   echo $sql;
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
    function export_patientlistCVS($d1,$d2,$h,$t1,$t2,$t3,$v){
        if($v=='1' || $v=='6'){
            $sql= "SELECT  ";
        $sql.="     patientID,patientHospital,patientSSN,patientChartNumber,patientName,patientBirthday,patientAge,patientAgeUnit,patientGender";
        //$sql.=", patientSurgeon,patientSurgeon2,patientSurgeon3,patientSurgeon4 ";
         $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon),t1.patientSurgeon,if(t1.patientSurgeon<>'','******',''))  as 'patientSurgeon 1'";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon2),t1.patientSurgeon2,if(t1.patientSurgeon2<>'','******',''))    as 'patientSurgeon 2'";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon3),t1.patientSurgeon3,if(t1.patientSurgeon3<>'','******',''))  as 'patientSurgeon 3'";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon4),t1.patientSurgeon4,if(t1.patientSurgeon4<>'','******',''))  as 'patientSurgeon 4'";
         $sql.=" ,patientReoperation,patientOperativeApproach,patientConvertedDuringProcedure,patientRoboticUsed,patientOpDate,patientDischargeDate";
        $sql.=" ,   patientDiagnosis,patientSyntaxScore,patientSyntaxScoreContent,patientSyntaxScoreTable,patientAssociatedDisease";
        $sql.=" ,patientBodyWeight,patientSerumCreatinine,pastHistoryRenalImpairment,CcrberforOperation,pastHistoryExtracardiacArteriopathy,pastHistoryPoorMobility,pastHistoryPreviousCardiacSurgery,pastHistoryChronicLungDisease,pastHistoryActiveEndocarditis,pastHistoryCriticalPreoperativeState,pastHistoryDiabetesOnInsulin,pastHistoryNYHA,pastHistoryCCSClass4Angina,pastHistoryLVFunction,pastHistoryRecentMI,pastHistoryPulmonaryHypertension,pastHistoryUrgency,pastHistoryWeightOfTheIntervention,pastHistorySurgeryThoracicAorta,euroScoreII,operationAssociateCategory, SyntaxScoreDominance";
            
            if($t1=="Y"){
              $sql.=" ,AdultDiagnosis1,AdultDiagnosis2,AdultDiagnosis3,AdultDiagnosis4,AdultDiagnosis5,AdultDiagnosis_id1,AdultDiagnosis_id2,AdultDiagnosis_id3,AdultDiagnosis_id4,AdultDiagnosis_id5,AdultDiagnosisOthers "; 
              $sql.=",operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMitralValveBentall,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPAlfieriStitch,operationMVPDeVegaAnnularPlasty,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPAlfieriStitch,operationTVPDeVegaAnnularPlasty,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,operationAorticValve_TAVI,operationAorticValve_TAVI_S1,operationAorticValve_TAVI_S2"; 
            }
             if($t2=="Y"){
                 $sql.=" ,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo";
                 }
             $sql.=" ,outcomeDeath,outcomeDeathDate,outcomeDeathMemo,outcomeExtubationDate,outcomeStatus";    
             
             if($t1=="Y"){
                 //  $sql.=" ,outcomeWoundInfection,outcomeWoundInfectionData,outcomeWoundInfectionMemo,outcomeBacteremia,outcomeBacteremiaData,outcomeBacteremiaMemo,outcomeReentry,outcomeReentryMemo,outcomeDialysis,outcomeDialysisDate,outcomeDialysisMemo,outcomeECMO,outcomeECMOData,outcomeECMOMemo,outcomeIABP,outcomeIABPMemo,outcomeStroke,outcomeStrokeMemo,outcomeArrthymia,outcomeArrthymiaData,outcomeArrthymiaMemo";
                   $sql.=",outcomeCheck1 as 'Operative Mortality',outcomeData1 as 'Operative Mortality Note',outcomeCheck2 as 'Permanent Stroke',outcomeData2 as 'Permanent Stroke Note',outcomeCheck3 as 'Renal Failure',outcomeData3 as 'Renal Failure Note',outcomeCheck4 as 'Prolonged Ventilation > 24 hours ',outcomeData4 as 'Prolonged Ventilation > 24 hours  Note',outcomeCheck5 as 'Deep Sternal Wound Infection ',outcomeData5 as 'Deep Sternal Wound Infection  Note',outcomeCheck6 as 'Reoperation For any reason ',outcomeData6 as 'Reoperation For any reason  Note',outcomeCheck7 as 'Major Morbidity or Operative Mortality ',outcomeData7 as 'Major Morbidity or Operative Mortality  Note',outcomeCheck8 as 'LOS',outcomeData8 as 'LOS Note',outcomeCheck9 as 'Short Stay: PLOS < 6 days',outcomeData9 as 'Short Stay: PLOS < 6 days Note',outcomeCheck10 as 'Long Stay: PLOS >14 days',outcomeData10 as 'Long Stay: PLOS >14 days Note'";
                 }
             if($t2=="Y"){
                 $sql.=",outcomeChildComplication1,outcomeChildComplication2,outcomeChildComplication3,outcomeChildComplication4,outcomeChildComplication5,outcomeChildComplication6,outcomeChildComplication7,outcomeChildComplication8,outcomeChildComplication9,outcomeChildComplication10,outcomeChildComplication11,outcomeChildComplication12,outcomeChildComplication13,outcomeChildComplication14,outcomeChildComplication15,outcomeChildComplication16,outcomeChildComplication17,outcomeChildComplication18,outcomeChildComplication19,outcomeChildComplication20,outcomeChildComplication21,outcomeChildComplication22,outcomeChildComplication23,outcomeChildComplication24,outcomeChildComplication25,outcomeChildComplication26,outcomeChildComplication27,outcomeChildComplication28,outcomeChildComplication29,outcomeChildComplication30,outcomeChildComplication31,outcomeChildComplication32,outcomeChildComplication33,outcomeChildComplication34,outcomeChildComplication35,outcomeChildComplication36,outcomeChildCauseofDeath"; 
                 }
                 if($t3=="Y"){
                 $sql.=",LVADmachineLVAD,LVADmachineRVAD,LVADIntermacsLevel,LVADPeakVO2,LVADIVinotropicLarge14days,LVADIIABPSupportLarge7days,LVADPreOperativeVentlator,LVADECMOSupport,LVADDialysis,LVADBUN,LVADAlbumin,LVADINR,LVADBilirubin,LVADHeartRate,LVADCVPLevel,LVADPulmonary,LVADLVEF,LVADSevereRV,LVADSevereTR,LVADHMRS,LVADHMRSRisk,LVADHMRS90DaysMortality,LVADCRITT,LVADCRITTNote,patientICUDischargeDate,BenchmarkSurgery";
                 }    
                 } else if($v=='2') {
                      $sql= "SELECT  ";
        $sql.="     patientID";
       
            if($t1=="Y"){
              $sql.=",operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMitralValveBentall,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPAlfieriStitch,operationMVPDeVegaAnnularPlasty,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPAlfieriStitch,operationTVPDeVegaAnnularPlasty,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,operationAorticValve_TAVI,operationAorticValve_TAVI_S1,operationAorticValve_TAVI_S2"; 
            }
             if($t2=="Y"){
                 $sql.=" ,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo";
                 }
            
             
                 } else if($v=='3') {
                      $sql= "SELECT  ";
        $sql.="     patientID,patientAge,patientAgeUnit,patientGender";
        $sql.=" ,patientReoperation,patientOperativeApproach,patientConvertedDuringProcedure,patientRoboticUsed,patientOpDate,patientDischargeDate";
        $sql.=" ,   patientDiagnosis,patientAssociatedDisease";
        
            if($t1=="Y"){
              $sql.=" ,AdultDiagnosis1,AdultDiagnosis2,AdultDiagnosis3,AdultDiagnosis4,AdultDiagnosis5,AdultDiagnosis_id1,AdultDiagnosis_id2,AdultDiagnosis_id3,AdultDiagnosis_id4,AdultDiagnosis_id5,AdultDiagnosisOthers "; 
              $sql.=",operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMitralValveBentall,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPAlfieriStitch,operationMVPDeVegaAnnularPlasty,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPAlfieriStitch,operationTVPDeVegaAnnularPlasty,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,operationAorticValve_TAVI,operationAorticValve_TAVI_S1,operationAorticValve_TAVI_S2"; 
            }
             if($t2=="Y"){
                 $sql.=" ,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo";
                 }
            
                     } else if($v=='4') {
                          $sql= "SELECT  ";
        $sql.="     patientID,patientAge,patientAgeUnit,patientGender";
       // $sql.=", patientSurgeon,patientSurgeon2,patientSurgeon3,patientSurgeon4";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon),t1.patientSurgeon,if(t1.patientSurgeon<>'','******',''))  as 'patientSurgeon 1'";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon2),t1.patientSurgeon2,if(t1.patientSurgeon2<>'','******',''))    as 'patientSurgeon 2'";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon3),t1.patientSurgeon3,if(t1.patientSurgeon3<>'','******',''))  as 'patientSurgeon 3'";
       $sql.=", if((select case when isExport='1' then true else false end from user t2 where t2.userRealname=t1.patientSurgeon4),t1.patientSurgeon4,if(t1.patientSurgeon4<>'','******',''))  as 'patientSurgeon 4'";
          $sql.=" ,patientReoperation,patientOperativeApproach,patientConvertedDuringProcedure,patientRoboticUsed,patientOpDate,patientDischargeDate";
        $sql.=" ,   patientDiagnosis,patientSyntaxScore,patientSyntaxScoreContent,patientSyntaxScoreTable,patientAssociatedDisease";
        $sql.=" ,patientBodyWeight,patientSerumCreatinine,pastHistoryRenalImpairment,CcrberforOperation,pastHistoryExtracardiacArteriopathy,pastHistoryPoorMobility,pastHistoryPreviousCardiacSurgery,pastHistoryChronicLungDisease,pastHistoryActiveEndocarditis,pastHistoryCriticalPreoperativeState,pastHistoryDiabetesOnInsulin,pastHistoryNYHA,pastHistoryCCSClass4Angina,pastHistoryLVFunction,pastHistoryRecentMI,pastHistoryPulmonaryHypertension,pastHistoryUrgency,pastHistoryWeightOfTheIntervention,pastHistorySurgeryThoracicAorta,euroScoreII,operationAssociateCategory, SyntaxScoreDominance";
            
            if($t1=="Y"){
              $sql.=" ,AdultDiagnosis1,AdultDiagnosis2,AdultDiagnosis3,AdultDiagnosis4,AdultDiagnosis5,AdultDiagnosis_id1,AdultDiagnosis_id2,AdultDiagnosis_id3,AdultDiagnosis_id4,AdultDiagnosis_id5,AdultDiagnosisOthers "; 
              $sql.=",operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMitralValveBentall,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPAlfieriStitch,operationMVPDeVegaAnnularPlasty,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPAlfieriStitch,operationTVPDeVegaAnnularPlasty,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,operationAorticValve_TAVI,operationAorticValve_TAVI_S1,operationAorticValve_TAVI_S2"; 
            }
             if($t2=="Y"){
                 $sql.=" ,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo";
                 }
           
                       }  else if($v=='5') {
                            $sql= "SELECT  ";
        $sql.="     patientID,patientAge,patientAgeUnit,patientGender";
        $sql.=" ,patientReoperation,patientOperativeApproach,patientConvertedDuringProcedure,patientRoboticUsed,patientOpDate,patientDischargeDate";
        $sql.=" ,   patientDiagnosis,patientSyntaxScore,patientSyntaxScoreContent,patientSyntaxScoreTable,patientAssociatedDisease";
        $sql.=" ,patientBodyWeight,patientSerumCreatinine,pastHistoryRenalImpairment,CcrberforOperation,pastHistoryExtracardiacArteriopathy,pastHistoryPoorMobility,pastHistoryPreviousCardiacSurgery,pastHistoryChronicLungDisease,pastHistoryActiveEndocarditis,pastHistoryCriticalPreoperativeState,pastHistoryDiabetesOnInsulin,pastHistoryNYHA,pastHistoryCCSClass4Angina,pastHistoryLVFunction,pastHistoryRecentMI,pastHistoryPulmonaryHypertension,pastHistoryUrgency,pastHistoryWeightOfTheIntervention,pastHistorySurgeryThoracicAorta,euroScoreII,operationAssociateCategory, SyntaxScoreDominance";
            
            if($t1=="Y"){
              $sql.=" ,AdultDiagnosis1,AdultDiagnosis2,AdultDiagnosis3,AdultDiagnosis4,AdultDiagnosis5,AdultDiagnosis_id1,AdultDiagnosis_id2,AdultDiagnosis_id3,AdultDiagnosis_id4,AdultDiagnosis_id5,AdultDiagnosisOthers "; 
              $sql.=",operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMitralValveBentall,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPAlfieriStitch,operationMVPDeVegaAnnularPlasty,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPAlfieriStitch,operationTVPDeVegaAnnularPlasty,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,operationAorticValve_TAVI,operationAorticValve_TAVI_S1,operationAorticValve_TAVI_S2"; 
            }
             if($t2=="Y"){
                 $sql.=" ,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo";
                 }
             $sql.=" ,outcomeDeath,outcomeDeathDate,outcomeDeathMemo,outcomeExtubationDate,outcomeStatus";    
             
             if($t1=="Y"){
                   $sql.=" ,outcomeWoundInfection,outcomeWoundInfectionData,outcomeWoundInfectionMemo,outcomeBacteremia,outcomeBacteremiaData,outcomeBacteremiaMemo,outcomeReentry,outcomeReentryMemo,outcomeDialysis,outcomeDialysisDate,outcomeDialysisMemo,outcomeECMO,outcomeECMOData,outcomeECMOMemo,outcomeIABP,outcomeIABPMemo,outcomeStroke,outcomeStrokeMemo,outcomeArrthymia,outcomeArrthymiaData,outcomeArrthymiaMemo";
                 }
             if($t2=="Y"){
                 $sql.=",outcomeCheck1,outcomeData1,outcomeCheck2,outcomeData2,outcomeCheck3,outcomeData3,outcomeCheck4,outcomeData4,outcomeCheck5,outcomeData5,outcomeCheck6,outcomeData6,outcomeCheck7,outcomeData7,outcomeCheck8,outcomeData8,outcomeCheck9,outcomeData9,outcomeCheck10,outcomeData10,outcomeChildComplication1,outcomeChildComplication2,outcomeChildComplication3,outcomeChildComplication4,outcomeChildComplication5,outcomeChildComplication6,outcomeChildComplication7,outcomeChildComplication8,outcomeChildComplication9,outcomeChildComplication10,outcomeChildComplication11,outcomeChildComplication12,outcomeChildComplication13,outcomeChildComplication14,outcomeChildComplication15,outcomeChildComplication16,outcomeChildComplication17,outcomeChildComplication18,outcomeChildComplication19,outcomeChildComplication20,outcomeChildComplication21,outcomeChildComplication22,outcomeChildComplication23,outcomeChildComplication24,outcomeChildComplication25,outcomeChildComplication26,outcomeChildComplication27,outcomeChildComplication28,outcomeChildComplication29,outcomeChildComplication30,outcomeChildComplication31,outcomeChildComplication32,outcomeChildComplication33,outcomeChildComplication34,outcomeChildComplication35,outcomeChildComplication36,outcomeChildCauseofDeath"; 
                 }
                 if($t3=="Y"){
                 $sql.=",LVADmachineLVAD,LVADmachineRVAD,LVADIntermacsLevel,LVADPeakVO2,LVADIVinotropicLarge14days,LVADIIABPSupportLarge7days,LVADPreOperativeVentlator,LVADECMOSupport,LVADDialysis,LVADBUN,LVADAlbumin,LVADINR,LVADBilirubin,LVADHeartRate,LVADCVPLevel,LVADPulmonary,LVADLVEF,LVADSevereRV,LVADSevereTR,LVADHMRS,LVADHMRSRisk,LVADHMRS90DaysMortality,LVADCRITT,LVADCRITTNote,patientICUDischargeDate,BenchmarkSurgery";
                 }    
                             }
            //$sql.=" patientHospital,patientSSN,patientChartNumber,patientName,patientBirthday,patientAge,patientAgeUnit,patientGender,patientSurgeon,patientSurgeon2,patientSurgeon3,patientSurgeon4,patientSurgeon_id,patientSurgeon_id2,patientSurgeon_id3,patientSurgeon_id4,patientSurgeon_associalid,patientSurgeon_associalid2,patientSurgeon_associalid3,patientSurgeon_associalid4,patientReoperation,patientOpDate,patientDischargeDate,patientOpenHeartSurgery,patientCongenitalSurgery,patientNonOpenHeart,patientDiagnosis,patientSyntaxScore,patientSyntaxScoreContent,patientSyntaxScoreTable,patientAssociatedDisease,patientBodyWeight,patientSerumCreatinine,pastHistoryRenalImpairment,CcrberforOperation,pastHistoryExtracardiacArteriopathy,pastHistoryPoorMobility,pastHistoryPreviousCardiacSurgery,pastHistoryChronicLungDisease,pastHistoryActiveEndocarditis,pastHistoryCriticalPreoperativeState,pastHistoryDiabetesOnInsulin,pastHistoryNYHA,pastHistoryCCSClass4Angina,pastHistoryLVFunction,pastHistoryRecentMI,pastHistoryPulmonaryHypertension,pastHistoryUrgency,pastHistoryWeightOfTheIntervention,pastHistorySurgeryThoracicAorta,euroScoreII,operationAssociateCategory,AdultDiagnosis1,AdultDiagnosis2,AdultDiagnosis3,AdultDiagnosis4,AdultDiagnosis5,AdultDiagnosis_id1,AdultDiagnosis_id2,AdultDiagnosis_id3,AdultDiagnosis_id4,AdultDiagnosis_id5,AdultDiagnosisOthers,operationCABG,operationLIMA,operationRIMA,operationRIMA_RadialA,operationRIMA_GEA,operationVeinGraft,operationCardiopulmonaryBypass,operationCardiacArrest,operationCABGMemo,operationAorticValve,operationAVP,operationAorticValve_AVP,operationAorticValve_AVR,operationAVRSelect,operationMitralValveBentall as operationAorticValveBentall,operationAorticMemo,operationMitralValve,Operation_MitralValve_MVP,Operation_MitralValve_MVR,operationMVPRing,operationMVPArtificialChord,operationMVPAnnularPlication,operationMVPLeafletResection,operationMVPOthers,operationMVR,operationMVRMemo,operationTricuspidValve,Operation_TricuspidValve_TVP,Operation_TricuspidValve_TVR,operationTVPRing,operationTVPArtificialChord,operationTVPAnnularPlication,operationTVPLeafletResection,operationTVPOthers,operationTVR,operationTricuspidValveMemo,operationPulmonaryValve,Operation_PulmonaryValve_PVP,Operation_PulmonaryValve_PVR,operationPulmonaryValvePVP,operationPulmonaryValvePVR,operationPulmonaryValveMemo,operationArrythmiaSurgery,operationMazebiatrialLesion,operationMazeLA,operationMazePVIwithLAA,operationMazePVIwithoutLAA,operationMazeRA,operationMazeOthers,operationMazeEnergySource,operationMazeMemo,operationAorticSurgery,operationDissection,operationAneurysm,operationEtiologyOthers,operationAneurysmAscending,operationAneurysmArch,operationAneurysmThoracicAorta,operationAneurysmAbdominalAorta,operationEtiologyCardiopulmonarBypass,operationAorticSurgeryCerebralProtection,operationAorticSurgeryLocation,operationAorticSurgeryMethod,operationAorticSurgeryMemo,operationHeartTransplantation,operationHeartTransplantationOP,operationHeartTransplantationLVAD,operationHeartTransplantationRVAD,operationHeartTransplantationMemo,operationOtherCardiacSurgery,operationOtherCardiacSurgery1,operationOtherCardiacSurgery2,operationOtherCardiacSurgery3,operationOtherCardiacSurgery4,operationOtherCardiacSurgery5,operationOtherCardiacSurgery6,operationOtherCardiacSurgery7,operationOtherCardiacSurgery8,operationOtherCardiacSurgery9,operationOtherCardiacSurgery10,operationOtherCardiacSurgery11,operationOtherCardiacSurgeryMemo,operationECMO,operationECMOType,operationECMOMemo,operationLVAD,operationCardiacTumor,operationOthersOperation,CongenitalDiagnosis1,CongenitalDiagnosis2,CongenitalDiagnosis3,CongenitalDiagnosis4,CongenitalDiagnosis5,CongenitalDiagnosis_id1,CongenitalDiagnosis_id2,CongenitalDiagnosis_id3,CongenitalDiagnosis_id4,CongenitalDiagnosis_id5,CongenitalDiagnosisOthers,CongenitalProcedure1,CongenitalProcedure2,CongenitalProcedure3,CongenitalProcedure4,CongenitalProcedure5,CongenitalProcedure_id1,CongenitalProcedure_id2,CongenitalProcedure_id3,CongenitalProcedure_id4,CongenitalProcedure_id5,CongenitalProcedureOthers,operationCongenitalBypass,operationCongenitalBypassCPBTime,operationCongenitalBypassAorticTime,operationCongenitalBypassCirculatoryTime,operationCongenitalBypassCardioplegia,operationCongenitalBypassRACHS,operationCongenitalBypassSTS,operationCongenitalBypassMemo,outcomeDeath,outcomeDeathDate,outcomeDeathMemo,outcomeWoundInfection,outcomeWoundInfectionData,outcomeWoundInfectionMemo,outcomeBacteremia,outcomeBacteremiaData,outcomeBacteremiaMemo,outcomeReentry,outcomeReentryMemo,outcomeDialysis,outcomeDialysisDate,outcomeDialysisMemo,outcomeECMO,outcomeECMOData,outcomeECMOMemo,outcomeIABP,outcomeIABPMemo,outcomeStroke,outcomeStrokeMemo,outcomeArrthymia,outcomeArrthymiaData,outcomeArrthymiaMemo,isDeleted,outcomeCheck1,outcomeData1,outcomeCheck2,outcomeData2,outcomeCheck3,outcomeData3,outcomeCheck4,outcomeData4,outcomeCheck5,outcomeData5,outcomeCheck6,outcomeData6,outcomeCheck7,outcomeData7,outcomeCheck8,outcomeData8,outcomeCheck9,outcomeData9,outcomeCheck10,outcomeData10,outcomeChildComplication1,outcomeChildComplication2,outcomeChildComplication3,outcomeChildComplication4,outcomeChildComplication5,outcomeChildComplication6,outcomeChildComplication7,outcomeChildComplication8,outcomeChildComplication9,outcomeChildComplication10,outcomeChildComplication11,outcomeChildComplication12,outcomeChildComplication13,outcomeChildComplication14,outcomeChildComplication15,outcomeChildComplication16,outcomeChildComplication17,outcomeChildComplication18,outcomeChildComplication19,outcomeChildComplication20,outcomeChildComplication21,outcomeChildComplication22,outcomeChildComplication23,outcomeChildComplication24,outcomeChildComplication25,outcomeChildComplication26,outcomeChildComplication27,outcomeChildComplication28,outcomeChildComplication29,outcomeChildComplication30,outcomeChildComplication31,outcomeChildComplication32,outcomeChildComplication33,outcomeChildComplication34,outcomeChildComplication35,outcomeChildComplication36,outcomeChildCauseofDeath,outcomeExtubationDate,outcomeStatus,patientICUDischargeDate";
            $sql.=" FROM patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
         if($h!='')
             $sql.= "  and patientHospital=?";
             
          if($v=='6') {
             $sql.= "   and (patientSurgeon='".$this->session->userdata('userRealname')."' or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."')  ";
              }
             /*
         if($t2=="Y" && $t1!='Y'){    
             $sql.= " and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         } 
          if($t1=="Y" && $t2!='Y'){    
             $sql.= " and (CongenitalDiagnosis1='' and CongenitalDiagnosis2='' and CongenitalDiagnosis3='' and CongenitalDiagnosis4='' and CongenitalDiagnosis5='' and CongenitalDiagnosisOthers='') ";
         } 
              * */
         if($t2=="Y" && $t1!='Y'){    
             $sql.= " and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         } 
          if($t1=="Y" && $t2!='Y'){    
             $sql.= " and ((CongenitalDiagnosis1='' or CongenitalDiagnosis1 is null) and (CongenitalDiagnosis2='' or CongenitalDiagnosis2 is null) and (CongenitalDiagnosis3='' or CongenitalDiagnosis3 is null) and (CongenitalDiagnosis4='' or CongenitalDiagnosis4 is null) and (CongenitalDiagnosis5='' or CongenitalDiagnosis5 is null) and (CongenitalDiagnosisOthers='' or CongenitalDiagnosisOthers is null)) ";
         } 
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
        $sql= "SELECT * FROM patientinformation where  patientChartNumber=? and patientOpDate=? and isDeleted='N'";
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
         
         
          function selectVascularProcedure(){
           $sql= " select * from vascularprocedure order by  vascularprocedure.order ,vascularprocedure.code";
           
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
    function export_uploadNonSurgery($y,$m,$yEnd,$mEnd,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
    
       $sql= "SELECT  * FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH) order by  qYear, qMonth";

        return $this->db->query($sql);
   }
     function export_uploadpatientlist($d1,$d2,$h,$lastupdate){
            $sql= "SELECT * FROM twcvs_www.patientinformation t1 where  patientOpDate>='$d1' and patientOpDate<='$d2' and  isDeleted='N' ";
         if($h!='')
             $sql.= "  and patientHospital='$h'";
         /*
            $subsql= "SELECT patientID ";
            $subsql.=" FROM patientinformation t1 where isDeleted='N' ";
           
            $subsql.= " and (1>2 ";
             $subsql.= "  or  (patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00')";
            $subsql.= "  or  (patientDischargeDate='' or patientDischargeDate='0000-00-00'   or outcomeStatus=''  or patientDischargeDate is null or outcomeStatus is null) " ;
                  $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00'";
            $subsql.= " or  (patientSurgeon=''  and  patientSurgeon2=''   and  patientSurgeon3=''   and  patientSurgeon4='') " ;
            $subsql.= " or  (patientCongenitalSurgery!='Y' ";
            $subsql.= " and ((operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y'" ;
            $subsql.= " and  operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')" ;
                  $subsql.= " or  ((AdultDiagnosis1 ='' or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null) and  (AdultDiagnosis3='' or AdultDiagnosis3 is null) and  (AdultDiagnosis4='' or AdultDiagnosis4 is null) and  (AdultDiagnosis5='' or AdultDiagnosis5 is null) and (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null))))";
                  $subsql.= " or  (patientCongenitalSurgery='Y' ";
            $subsql.= " and ((CongenitalDiagnosis1 ='' and  CongenitalDiagnosis2 ='' and  CongenitalDiagnosis3 ='' and  CongenitalDiagnosis4 ='' and  CongenitalDiagnosis5 ='' and CongenitalDiagnosisOthers='')" ;
                  $subsql.= " or (CongenitalProcedure1 ='' and  CongenitalProcedure2 ='' and  CongenitalProcedure3 ='' and  CongenitalProcedure4 ='' and  CongenitalProcedure5 ='' and CongenitalProcedureOthers='')))" ;
               
               $sql.= " and ( patientID not in(".$subsql.") )  )";
             //  echo $sql;
          * */
         // echo $sql;
        return $this->db->query($sql,array($h)); 

    }
   function export_uploadpatientdo($d1,$d2,$h,$lastupdate){
            $sql= "SELECT * FROM patientinformation t1 where   modifyTime>='$lastupdate' and CompletedStatus='Y' and  isDeleted!='Y'";
         if($h!='')
             $sql.= "  and patientHospital=? ";
         
         /*
          *   $subsql= "SELECT patientID ";
          $subsql.=" FROM patientinformation t1 where isDeleted='N'  and CompletedStatus='Y'";
           
            $subsql.= " and (1>2 ";
            $subsql.= "  or  (patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00')";
            $subsql.= "  or  (patientDischargeDate='' or patientDischargeDate='0000-00-00'   or outcomeStatus=''  or patientDischargeDate is null  or outcomeStatus is null) " ;
                  $subsql.= " or  patientOpDate='' or patientOpDate='0000-00-00'";
            $subsql.= " or  (patientSurgeon=''  and  patientSurgeon2=''   and  patientSurgeon3=''   and  patientSurgeon4='') " ;
            $subsql.= " or  (patientCongenitalSurgery!='Y' ";
            $subsql.= " and ((operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y'" ;
            $subsql.= " and  operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')" ;
                  $subsql.= " or  ((AdultDiagnosis1 ='' or AdultDiagnosis1 is null) and  (AdultDiagnosis2='' or AdultDiagnosis2 is null) and  (AdultDiagnosis3='' or AdultDiagnosis3 is null) and  (AdultDiagnosis4='' or AdultDiagnosis4 is null) and  (AdultDiagnosis5='' or AdultDiagnosis5 is null) and (AdultDiagnosisOthers='' or AdultDiagnosisOthers is null))))";
                  $subsql.= " or  (patientCongenitalSurgery='Y' ";
            $subsql.= " and ((CongenitalDiagnosis1 ='' and  CongenitalDiagnosis2 ='' and  CongenitalDiagnosis3 ='' and  CongenitalDiagnosis4 ='' and  CongenitalDiagnosis5 ='' and CongenitalDiagnosisOthers='')" ;
                  $subsql.= " or (CongenitalProcedure1 ='' and  CongenitalProcedure2 ='' and  CongenitalProcedure3 ='' and  CongenitalProcedure4 ='' and  CongenitalProcedure5 ='' and CongenitalProcedureOthers='')))" ;
               
               $sql.= " and ( patientID not in(".$subsql.") ) or  isDeleted='Y' )";
              */
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
        $sql= "SELECT * FROM patientinformation where isDeleted='N'";
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
    
    function viewVascularRecordByChart($opDate, $chart){
        $sql= "SELECT * FROM vascular where  patientChartNumber=? and patientOpDate=?";
        return $this->db->query($sql,array($chart,$opDate));
    }
    
    function query_uploadpatienttime(){
         $sql= "SELECT * FROM patientlastupdatetime order by patientLastupdateTime desc limit 0,1";
        return $this->db->query($sql,array());
    }
    
    function reset_uploadpatienttime(){
        $sql= "update  patientlastupdatetime set patientLastupdateTime=now()";
        return $this->db->query($sql,array());
    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */