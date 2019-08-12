<?php

class Analysis_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }



    	function query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$h){
	      $d1=$qYear."-".$qMonth."-01";
        $d2=$qYearEnd."-".$qMonthEnd."-01";
	    $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  ";
	    switch($i){
            case "1": 
                $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)=1 and operationCardiopulmonaryBypass='Y'";
                break;
        case "2": 
                 $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)>=2 and operationCardiopulmonaryBypass='Y'";
                break;
         case "3": 
                $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)=1 and operationCardiopulmonaryBypass<>'Y'";
                break;
         case "4": 
                 $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)>=2 and operationCardiopulmonaryBypass<>'Y'";
               break;
          case "5": 
                 $sql.= "and operationCABG<>'Y' and   ((operationAorticValve_AVR='Y' and operationAVRSelect='Mechanical valve') or (Operation_MitralValve_MVR='Y' and operationMVR='Mechanical valve') or (Operation_TricuspidValve_TVR='Y' and operationTVR='Mechanical valve') or (Operation_PulmonaryValve_PVR='Y' and operationPulmonaryValvePVR='Mechanical'))";
                   break;
          case "6": 
               $sql.= "and operationCABG<>'Y' and   ((operationAorticValve_AVR='Y' and operationAVRSelect='Bioprosthetic valve') or (Operation_MitralValve_MVR='Y' and operationMVR='Bioprosthetic valve') or (Operation_TricuspidValve_TVR='Y' and operationTVR='Bioprosthetic valve') or (Operation_PulmonaryValve_PVR='Y' and operationPulmonaryValvePVR='Bioprosthesis'))";
                  break;
          case "7": 
                 $sql.= "and operationCABG<>'Y' and   (operationAorticValve_AVP='Y'  or  Operation_MitralValve_MVP='Y' or Operation_TricuspidValve_TVP='Y' or Operation_PulmonaryValve_PVP='Y' )";
                     break;
          case "8": 
                $sql.= "and operationCongenitalBypass<>'Y' and (CongenitalDiagnosis_id1!='' or CongenitalDiagnosis_id2!=''  or CongenitalDiagnosis_id3!='' or   CongenitalDiagnosis_id4=''  or CongenitalDiagnosis_id5!='' )";
                break;
          case "9": 
                $sql.= "and operationCongenitalBypass='Y' and (CongenitalDiagnosis_id1!='' or CongenitalDiagnosis_id2!=''  or CongenitalDiagnosis_id3!='' or   CongenitalDiagnosis_id4=''  or CongenitalDiagnosis_id5!='' )";
                break;
           case "10": //難作
                $sql.= " and operationAssociateCategory='4'  and operationCardiopulmonaryBypass='Y'"; // and CongenitalCHD='non-cyanotic'";
                  $sql.=" and (CongenitalDiagnosis_id1='' or CongenitalProcedure_id1 like '17-%'  or CongenitalProcedure_id1 like '56-%'  or CongenitalProcedure_id1 like '34-%'  or CongenitalProcedure_id1 like '44-%'  or CongenitalProcedure_id1 like '55-%'  ) ";
                  $sql.=" and (CongenitalDiagnosis_id2='' or CongenitalProcedure_id2 like '17-%'  or CongenitalProcedure_id2 like '56-%'  or CongenitalProcedure_id2 like '34-%'  or CongenitalProcedure_id2 like '44-%'  or CongenitalProcedure_id2 like '55-%'  ) ";
                  $sql.=" and (CongenitalDiagnosis_id3='' or CongenitalProcedure_id3 like '17-%'  or CongenitalProcedure_id3 like '56-%'  or CongenitalProcedure_id3 like '34-%'  or CongenitalProcedure_id3 like '44-%'  or CongenitalProcedure_id3 like '55-%'  ) ";
                  $sql.=" and (CongenitalDiagnosis_id4='' or CongenitalProcedure_id4 like '17-%'  or CongenitalProcedure_id4 like '56-%'  or CongenitalProcedure_id4 like '34-%'  or CongenitalProcedure_id4 like '44-%'  or CongenitalProcedure_id4 like '55-%'  ) ";
                  $sql.=" and (CongenitalDiagnosis_id5='' or CongenitalProcedure_id5 like '17-%'  or CongenitalProcedure_id5 like '56-%'  or CongenitalProcedure_id5 like '34-%'  or CongenitalProcedure_id5 like '44-%'  or CongenitalProcedure_id5 like '55-%'  ) ";
                  
                break;
           case "11": 
                $sql.= "and operationDissection='Y' ";
                break;
           case "12": 
                $sql.= "and operationHeartTransplantationOP='Y' ";
                break;
          case "13": //有問題
                $sql.= "and (operationHeartTransplantationLVAD='Y' or operationHeartTransplantationRVAD='Y') ";
                break;
            case "14": //有問題
                $sql.= "and operationCABG<>'Y'  and operationDissection<>'Y' and  operationAneurysm='Y'";
                break;
           case "15":  //有問題
                $sql.= "and operationAssociateCategory='8'   and operationAneurysmAbdominalAorta='Y'";
                break;
           case "16": ////有問題
                $sql.= "and (operationAssociateCategory='9'  or operationAssociateCategory='10' )";
                break;
           case "17": ////有問題
                $sql.= "and (operationAssociateCategory='9'  or operationAssociateCategory='10' )";
                break;
	    }
	  if($h!="0"){
         $sql.= " and patientHospital='$h'";
      }
		return $this->db->query($sql,array($d1));

	}

   function query_executivesummary($y,$m,$yEnd,$mEnd,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
      if($t=="1"){
     $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="2"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         //    $sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
    } else {
          $sql= "SELECT  sum(item1+item2+item3+item4+item5+item6+item7+item8+item9+item10) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
     }
     
     if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
     
     //echo $sql;
        return $this->db->query($sql);
   }
    
    
    function query_executivesummarydetail($y,$m,$yEnd,$mEnd,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
    if($t=="1"){
     $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationCABG='Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve<>'Y'  and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="2"){
              $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationCABG<>'Y' and operationAorticValve='Y' and operationAorticSurgery<>'Y' and operationMitralValve<>'Y' and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
    } else if($t=="3"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationCABG<>'Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and Operation_MitralValve_MVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($t=="4"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationCABG='Y' and operationAorticValve='Y') and operationAorticSurgery<>'Y' and operationMitralValve<>'Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
    
     }  else if($t=="5"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationCABG='Y' and (operationMitralValve='Y'  and Operation_MitralValve_MVR='Y')) and operationAorticValve<>'Y' and operationAorticSurgery<>'Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($t=="6"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'    and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
   $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
     $sql.= " and operationCABG<>'Y' and operationAorticValve='Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and Operation_MitralValve_MVR='Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($t=="7"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationCABG<>'Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y' and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y'  and  Operation_TricuspidValve_TVR<>'Y' and Operation_MitralValve_MVP='Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($t=="8"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationCABG='Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y' and Operation_MitralValve_MVP='Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($t=="9"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and operationDissection='Y'  ";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($t=="10"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and operationDissection<>'Y'  ";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   }
     if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
     
        return $this->db->query($sql);
   }


function query_executivesummarydetail2($y,$m,$yEnd,$mEnd,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
      if($t=="1"){
     $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationCABG='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="2"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationAorticValve_AVP='Y' or operationMitralValveBentall='Y' or operationAorticValve_AVR='Y' )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="3"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationMitralValve='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="4"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (Operation_PulmonaryValve_PVP='Y' or Operation_PulmonaryValve_PVR='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="5"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (Operation_TricuspidValve_TVP='Y' or Operation_TricuspidValve_TVR='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="6"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'    and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationHeartTransplantationLVAD='Y' or operationHeartTransplantationRVAD='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="7"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'    and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationOtherCardiacSurgery7='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="8"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationOtherCardiacSurgery3='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationHeartTransplantationOP='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="10"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationArrythmiaSurgery='Y')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="11"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and ( operationDissection='Y'  or  operationAneurysm='Y'  or  operationEtiologyOthers='Y' )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="12"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and ( operationAorticSurgeryLocation='ascending')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and ( operationAorticSurgeryLocation='arch')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="14"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and ( operationAorticSurgeryLocation='thoracic aorta')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="15"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationAorticSurgery='Y' and ( operationAorticSurgeryLocation='thoracoabdominal aorta')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="16"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and operationOtherCardiacSurgery4='Y'";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="17"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'    and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationOtherCardiacSurgery8='Y' or operationOtherCardiacSurgery9='Y' )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="18"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
    $sql.= " and (operationOtherCardiacSurgery1='Y' or operationOtherCardiacSurgery2='Y' or operationOtherCardiacSurgery5='Y'  or operationOtherCardiacSurgery6='Y'  or operationOtherCardiacSurgery10='Y' or operationOtherCardiacSurgery11='Y' )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }
       if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
     
        return $this->db->query($sql);
   }
   
   function query_executivesummarychild($y,$m,$yEnd,$mEnd,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
       if($t=="0"){
     $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="1"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and patientAge>18";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="2"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (operationCongenitalBypassCPBTime<>'')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="3"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (operationCongenitalBypassCPBTime='' or operationCongenitalBypassCPBTime is null)";      
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="4"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%' or CongenitalProcedure_id2 like '56-%' or CongenitalProcedure_id3 like '56-%' or CongenitalProcedure_id4 like '56-%' or CongenitalProcedure_id5 like '56-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="5"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '42-%' or CongenitalProcedure_id2 like '42-%' or CongenitalProcedure_id3 like '42-%' or CongenitalProcedure_id4 like '42-%' or CongenitalProcedure_id5 like '42-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="6"){
      $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='53-01' or CongenitalProcedure_id2='53-01' or CongenitalProcedure_id3='53-01' or CongenitalProcedure_id4='53-01' or CongenitalProcedure_id5='53-01' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-03' or CongenitalProcedure_id2='53-03' or CongenitalProcedure_id3='53-03' or CongenitalProcedure_id4='53-03' or CongenitalProcedure_id5='53-03' ";   
       $sql.= " or CongenitalProcedure_id1 ='53-05' or CongenitalProcedure_id2='53-05' or CongenitalProcedure_id3='53-05' or CongenitalProcedure_id4='53-05' or CongenitalProcedure_id5='53-05' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="7"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="8"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id2='33-07' or CongenitalProcedure_id3='33-07' or CongenitalProcedure_id4='33-07' or CongenitalProcedure_id5='33-07' ";    
     $sql.= " or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id2='33-08' or CongenitalProcedure_id3='33-08' or CongenitalProcedure_id4='33-08' or CongenitalProcedure_id5='33-08' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-09' or CongenitalProcedure_id2='33-09' or CongenitalProcedure_id3='33-09' or CongenitalProcedure_id4='33-09' or CongenitalProcedure_id5='33-09' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-13' or CongenitalProcedure_id2='33-13' or CongenitalProcedure_id3='33-13' or CongenitalProcedure_id4='33-13' or CongenitalProcedure_id5='33-13' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="9"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 = '51-09' or CongenitalProcedure_id2 = '51-09' or CongenitalProcedure_id3  = '51-09' or CongenitalProcedure_id4  = '51-09' or CongenitalProcedure_id5 = '51-09')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="10"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="11"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="12"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="13"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="14"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%' or CongenitalProcedure_id2 like '56-%' or CongenitalProcedure_id3 like '56-%' or CongenitalProcedure_id4 like '56-%' or CongenitalProcedure_id5 like '56-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="15"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '44-%' or CongenitalProcedure_id2 like '44-%' or CongenitalProcedure_id3 like '44-%' or CongenitalProcedure_id4 like '44-%' or CongenitalProcedure_id5 like '44-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="16"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '27-%' or CongenitalProcedure_id2 like '27-%' or CongenitalProcedure_id3 like '27-%' or CongenitalProcedure_id4 like '27-%' or CongenitalProcedure_id5 like '27-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else {
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           $sql.= " and (CongenitalProcedure_id1 ='54-01' or CongenitalProcedure_id2='54-01' or CongenitalProcedure_id3='54-01' or CongenitalProcedure_id4='54-01' or CongenitalProcedure_id5='54-01' ";    
        $sql.= " or CongenitalProcedure_id1 ='54-04' or CongenitalProcedure_id2='54-04' or CongenitalProcedure_id3='54-04' or CongenitalProcedure_id4='54-04' or CongenitalProcedure_id5='54-04' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }
      if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
        return $this->db->query($sql);
   }
   function query_executivesummarychildPure($y,$m,$yEnd,$mEnd,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
         if($t=="0"){
     $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="1"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and patientAge>18";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="2"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (operationCongenitalBypassCPBTime<>'')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="3"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (operationCongenitalBypassCPBTime='' or operationCongenitalBypassCPBTime is null)";      
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="4"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="5"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
      $sql.= " and ((CongenitalProcedure_id1 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id2 like '42-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ( CongenitalProcedure_id3 like '42-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id4 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id5 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="6"){
      $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (((CongenitalProcedure_id1 ='53-01' or CongenitalProcedure_id1 ='53-03' or CongenitalProcedure_id1 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='53-01' or CongenitalProcedure_id2 ='53-03' or CongenitalProcedure_id2 ='53-05')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='53-01' or CongenitalProcedure_id3 ='53-03' or CongenitalProcedure_id3 ='53-05')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='53-01' or CongenitalProcedure_id4 ='53-03' or CongenitalProcedure_id4 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='53-01' or CongenitalProcedure_id5 ='53-03' or CongenitalProcedure_id5 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="7"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '18-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '18-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="8"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (((CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id1 ='33-09'  or CongenitalProcedure_id1 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='33-07' or CongenitalProcedure_id2 ='33-08' or CongenitalProcedure_id2 ='33-09'  or CongenitalProcedure_id2 ='33-13')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='33-07' or CongenitalProcedure_id3 ='33-08' or CongenitalProcedure_id3 ='33-09'  or CongenitalProcedure_id3='33-13')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='33-07' or CongenitalProcedure_id4 ='33-08' or CongenitalProcedure_id4 ='33-09'  or CongenitalProcedure_id4 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='33-07' or CongenitalProcedure_id5 ='33-08' or CongenitalProcedure_id5 ='33-09'  or CongenitalProcedure_id5 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="9"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 = '51-09' or CongenitalProcedure_id2 = '51-09' or CongenitalProcedure_id3  = '51-09' or CongenitalProcedure_id4  = '51-09' or CongenitalProcedure_id5 = '51-09')";    
     $sql.= " and ((CongenitalProcedure_id1 = '51-09' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 = '51-09'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 = '51-09'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 = '51-09' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 = '51-09' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="10"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '55-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '55-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="11"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '45-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '45-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="12"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '52-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '52-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="13"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '50-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '50-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="14"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%' or CongenitalProcedure_id2 like '56-%' or CongenitalProcedure_id3 like '56-%' or CongenitalProcedure_id4 like '56-%' or CongenitalProcedure_id5 like '56-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="15"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '44-%' or CongenitalProcedure_id2 like '44-%' or CongenitalProcedure_id3 like '44-%' or CongenitalProcedure_id4 like '44-%' or CongenitalProcedure_id5 like '44-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '44-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '44-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="16"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '27-%' or CongenitalProcedure_id2 like '27-%' or CongenitalProcedure_id3 like '27-%' or CongenitalProcedure_id4 like '27-%' or CongenitalProcedure_id5 like '27-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '27-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '27-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else {
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           $sql.= " and (((CongenitalProcedure_id1 ='54-01'' or CongenitalProcedure_id1 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='54-01'' or CongenitalProcedure_id2 ='54-04')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='54-01'' or CongenitalProcedure_id3 ='54-04')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='54-01'' or CongenitalProcedure_id4 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='54-01'' or CongenitalProcedure_id5='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }
     
       if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
     
        return $this->db->query($sql);
   }
   
   function query_executivesummarynonopenheart($y,$m,$yEnd,$mEnd,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
         if($t=="1"){
          $sql= "SELECT  sum(item1) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
     }  else if($t=="2"){
              $sql= "SELECT  sum(item2) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       } else if($t=="3"){
         $sql= "SELECT  sum(item3) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       } else if($t=="4"){
          $sql= "SELECT  sum(item4) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       }  else if($t=="5"){
         $sql= "SELECT  sum(item5) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       } else if($t=="6"){
        $sql= "SELECT  sum(item6) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       } else if($t=="7"){
         $sql= "SELECT  sum(item7) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       } else if($t=="8"){
          $sql= "SELECT  sum(item8) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       } else {
         $sql= "SELECT  sum(item9) as num FROM nonopenheart   where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
       }
       if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
     
        return $this->db->query($sql);
   }
   //2017-10-03
   function query_executivesummarydetail1($y,$m,$yEnd,$mEnd,$n,$t,$h){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
       if($t=="0"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck2='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck3='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck4='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck5='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and  outcomeCheck6='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck7='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and ((patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00') ";
       $sql.=" or ((patientSurgeon=''  or patientSurgeon is null) and  (patientSurgeon2='' or patientSurgeon2 is null)   and  (patientSurgeon3='' or patientSurgeon3 is null)    and  (patientSurgeon4='' or patientSurgeon4 is null) ) ";
           //$sql.=" or (operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y' ";
      // $sql.="  and operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')";
           $sql.=" or (patientDischargeDate='' or patientDischargeDate='0000-00-00' or  outcomeExtubationDate=''  or  outcomeExtubationDate='0000-00-00'  or outcomeStatus=''   or patientDischargeDate is null or outcomeExtubationDate is null or outcomeStatus is null)";
           $sql.=" )";
           
         } else if($t=="9"){
         $sql= "SELECT count(*) as num , avg(cast(euroScoreII AS DECIMAL(10,2))) as myavg FROM patientinformation   where isDeleted ='N' and euroScoreII<>''  and euroScoreII is not null and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }
         if($n=='0'){
             
         } else if($n=="1"){
            $sql.= " and operationCABG='Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve<>'Y'  and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y' ";    
     } else if($n=="2"){
                 $sql.= " and operationCABG<>'Y' and operationAorticValve='Y' and operationAorticSurgery<>'Y' and operationMitralValve<>'Y' and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
    } else if($n=="3"){
               $sql.= " and operationCABG<>'Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and Operation_MitralValve_MVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
       } else if($n=="4"){
                  $sql.= " and (operationCABG='Y' and operationAorticValve='Y') and operationAorticSurgery<>'Y' and operationMitralValve<>'Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
    } else if($n=="5"){
               $sql.= " and (operationCABG='Y' and (operationMitralValve='Y'  and Operation_MitralValve_MVR='Y')) and operationAorticValve<>'Y' and operationAorticSurgery<>'Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y'";    
   } else if($n=="6"){
              $sql.= " and operationCABG<>'Y' and operationAorticValve='Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and Operation_MitralValve_MVR='Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";    
     } else if($n=="7"){
                 $sql.= " and operationCABG<>'Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y' and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y'  and  Operation_TricuspidValve_TVR<>'Y' and Operation_MitralValve_MVP='Y'";    
     } else if($n=="8"){
          $sql.= " and operationCABG='Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y' and Operation_MitralValve_MVP='Y'";    
      } else if($n=="9"){
       $sql.= " and operationAorticSurgery='Y' and operationDissection='Y'  ";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($n=="10"){
        $sql.= " and operationAorticSurgery='Y' and operationDissection<>'Y'  ";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
   
     } else if($n=="11"){
       $sql.= " and  patientID not in";
       $sql.= "(SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and operationCABG='Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve<>'Y'  and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y' ";
          $sql.="  ";
          $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and operationCABG<>'Y' and operationAorticValve='Y' and operationAorticSurgery<>'Y' and operationMitralValve<>'Y' and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y'";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and operationCABG<>'Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and Operation_MitralValve_MVR='Y' and  Operation_TricuspidValve_TVR<>'Y' ";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and (operationCABG='Y' and operationAorticValve='Y') and operationAorticSurgery<>'Y' and operationMitralValve<>'Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y' ";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and (operationCABG='Y' and (operationMitralValve='Y'  and Operation_MitralValve_MVR='Y')) and operationAorticValve<>'Y' and operationAorticSurgery<>'Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y'";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "  and operationCABG<>'Y' and operationAorticValve='Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and Operation_MitralValve_MVR='Y' and operationAorticValve_AVR='Y' and  Operation_TricuspidValve_TVR<>'Y' ";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "  and operationCABG<>'Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y' and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y'  and  Operation_TricuspidValve_TVR<>'Y' and Operation_MitralValve_MVP='Y' ";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "  and operationCABG='Y' and operationAorticValve<>'Y' and operationAorticSurgery<>'Y' and operationMitralValve='Y'   and operationPulmonaryValve<>'Y' and operationHeartTransplantation<>'Y' and    operationOtherCardiacSurgery<>'Y' and  Operation_TricuspidValve_TVR<>'Y' and Operation_MitralValve_MVP='Y' ";
         $sql.=" ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and operationAorticSurgery='Y' and operationDissection='Y'  ";
         $sql.="  ";
            $sql.= " union SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "and operationAorticSurgery='Y' and operationDissection<>'Y' ";
         $sql.="  ";
       $sql.="  )";
             } 
       //  echo "n:".$n."--->"."t:".$t."--->".$sql."<br/><br/><br/>";
        if($h!="0"){
         $sql.= " and patientHospital='$h'";
     }
        return $this->db->query($sql);
   }
     function query_urgency($y,$m,$yEnd,$mEnd,$t,$h){
          $d1=$y."-".$m."-01";
         $d2=$yEnd."-".$mEnd."-01";
           if($t=='5'){
             $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and (pastHistoryUrgency=''   or  pastHistoryUrgency is null)";
        } else {
            $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and pastHistoryUrgency='$t' ";
       }
        $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
   
        if($h!='0'){
              $sql.= " and patientHospital='$h'";
            }
        return $this->db->query($sql); 

    }
    
     function query_euroscore($y,$m,$yEnd,$mEnd,$t,$h){
            $d1=$y."-".$m."-01";
         $d2=$yEnd."-".$mEnd."-01";
           if($t=='1'){
             $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) <=5 and euroScoreII<>''";
           } elseif($t=='2'){
                $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) <=10  and cast(euroScoreII AS DECIMAL(10,2)) >5 and euroScoreII<>''";
        } elseif($t=='3'){
              $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) <=20  and cast(euroScoreII AS DECIMAL(10,2)) >10 and euroScoreII<>''";  
        } elseif($t=='4'){
              $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) >20  and euroScoreII<>''";  
        } else {
            $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and (euroScoreII='' or  euroScoreII is null)";
       }
         $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
   
      if($h!='0'){
              $sql.= " and patientHospital='$h'";
            }
        return $this->db->query($sql); 

    }

 function query_uploadnumber($y,$m,$yEnd,$mEnd,$t,$h){
            $d1=$y."-".$m."-01";
         $d2=$yEnd."-".$mEnd."-01";
           $sql= "select patientHospital as hospital,count(*) as num from patientinformation where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
              if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
              $sql.= " group by hospital order by num desc ";
        if($h!='0'){
              $sql.= " and patientHospital='$h'";
            }
        return $this->db->query($sql); 

    }
 
  function query_registernumber($y,$m,$yEnd,$mEnd,$t,$h){
            $d1=$y."-".$m."-01";
         $d2=$yEnd."-".$mEnd."-01";
         $sql= " SELECT * from ( ";
          $sql.= "SELECT '台大醫院' as hospital,count(*)  as num FROM twcvs_ntuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
             if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '萬芳醫院' as hospital,count(*)  as num FROM twcvs_wanfang.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '台大新竹分院' as hospital,count(*)  as num FROM twcvs_ntuhhch.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '林口長庚醫院' as hospital,count(*)  as num FROM twcvs_lkcgmh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '三軍總醫院' as hospital,count(*)  as num FROM twcvs_tsgh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '高雄長庚醫院' as hospital,count(*)  as num FROM twcvs_cgmh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '成大醫院' as hospital,count(*)  as num FROM twcvs_nckuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '亞東紀念醫院' as hospital,count(*)  as num FROM twcvs_femh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '台北慈濟' as hospital,count(*)  as num FROM twcvs_tzuchitp.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '馬偕紀念醫院' as hospital,count(*)  as num FROM twcvs_mmh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '國軍桃園總醫院' as hospital,count(*)  as num FROM twcvs_aftygh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '私立中山醫學大學附屬醫院' as hospital,count(*)  as num FROM twcvs_csmuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '國軍高雄總醫院' as hospital,count(*)  as num FROM twcvs_kh802.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '天主教輔仁大學附屬醫院' as hospital,count(*)  as num FROM twcvs_fjuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '台北醫學大學附設醫院' as hospital,count(*)  as num FROM twcvs_tmuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '嘉義長庚紀念醫院' as hospital,count(*)  as num FROM twcvs_cycgmh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '花蓮慈濟醫院' as hospital,count(*)  as num FROM twcvs_tzuchicvs.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '高雄醫學大學附設醫院' as hospital,count(*)  as num FROM twcvs_kmuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '天主教耕莘醫療財團法人耕莘醫院' as hospital,count(*)  as num FROM twcvs_cth.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '義大醫院' as hospital,count(*)  as num FROM twcvs_edah.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '屏東基督教醫院' as hospital,count(*)  as num FROM twcvs_ptch.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '中國醫藥大學附設大學' as hospital,count(*)  as num FROM twcvs_cmuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '成大醫院' as hospital,count(*)  as num FROM twcvs_nckuh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= " UNION ";
$sql.= " SELECT '基隆長庚醫院' as hospital,count(*)  as num FROM twcvs_klcgmh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
                     
                     $sql.= " UNION ";
$sql.= " SELECT '振興醫療財團法人振興醫院' as hospital,count(*)  as num FROM twcvs_chgh.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
                     
                        $sql.= " UNION ";
$sql.= " SELECT '輔英科技大學附屬醫院' as hospital,count(*)  as num FROM twcvs_fy.patientinformation t1 where isDeleted='N' and patientOpDate>='$d1' and patientOpDate<='$d2' ";
   if($t=='2'){
                     $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
                     }
$sql.= "  ) ";

                 
            
              $sql.= " t order by num desc ";
       
        return $this->db->query($sql); 

    }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */