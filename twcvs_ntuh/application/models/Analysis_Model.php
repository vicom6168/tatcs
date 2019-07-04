<?php

class Analysis_model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function query_associateReport($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i,$t='0'){
	      $d1=$qYear."-".$qMonth."-01";
        $d2=$qYearEnd."-".$qMonthEnd."-01";
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  ";
      
        if($t=='1'){
	  $sql= "SELECT count(*) as num FROM twcvs_www.patientinformation   where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and patientHospital='".$this->session->userdata('hospital')."' ";
       //  $sql= "SELECT count(*) as num FROM tatcs.patientinformation   where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and patientHospital='".$this->session->userdata('hospital')."' ";
        } else {
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  ";
          
        } 
	    switch($i){
            case "1": 
                $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)=1 and operationCardiopulmonaryBypass<>'Y'";
                break;
        case "2": 
                 $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)>=2 and operationCardiopulmonaryBypass<>'Y'";
                break;
         case "3": 
                $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)=1 and operationCardiopulmonaryBypass='Y'";
                break;
         case "4": 
                 $sql.= "and operationCABG='Y' and  CAST(operationLIMA AS UNSIGNED)+CAST(operationRIMA AS UNSIGNED)+CAST(operationRIMA_RadialA AS UNSIGNED)+CAST(operationRIMA_GEA AS UNSIGNED)+CAST(operationVeinGraft AS UNSIGNED)>=2 and operationCardiopulmonaryBypass='Y'";
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
                $sql.= "and (operationCongenitalBypassCPBTime='' or operationCongenitalBypassCPBTime is null)  and (CongenitalDiagnosis_id1<>'' or CongenitalDiagnosis_id2<>''  or CongenitalDiagnosis_id3<>'' or   CongenitalDiagnosis_id4<>''  or CongenitalDiagnosis_id5<>''  or CongenitalDiagnosisOthers<>'')";
                break;
          case "9": 
                $sql.= "and operationCongenitalBypassCPBTime<>'' and (CongenitalDiagnosis_id1!='' or CongenitalDiagnosis_id2!=''  or CongenitalDiagnosis_id3!='' or   CongenitalDiagnosis_id4=''  or CongenitalDiagnosis_id5!=''  or CongenitalDiagnosisOthers<>'')";
                break;
           case "10": //難作
                $sql.= " and operationCardiopulmonaryBypass='Y'"; // and CongenitalCHD='non-cyanotic'";
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
            case "14": //2018-03-14修改
           if($this->session->userdata('SP1')=="1"){
                $sql= "SELECT if(count(*) =0,'',count(*) )  as num  FROM vascular  t1  where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and  (t1.`patientProcedure_id1`='1-02' or t1.`patientProcedure_id2`='1-02' or  t1.`patientProcedure_id3`='1-02' or  t1.`patientProcedure_id4`='1-02' or  t1.`patientProcedure_id5`='1-02')";
           } else {
                  $sql.= " and operationCABG<>'Y'  and operationDissection<>'Y' and  operationAneurysm='Y'";
           }
                break;
           case "15":  //2018-03-14修改
           if($this->session->userdata('SP1')=="1"){
                $sql= "SELECT if(count(*) =0,'',count(*) )  as num FROM vascular  t1  where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and  (t1.`patientProcedure_id1`='1-01' or t1.`patientProcedure_id2`='1-01' or  t1.`patientProcedure_id3`='1-01' or  t1.`patientProcedure_id4`='1-01' or  t1.`patientProcedure_id5`='1-01')";
                } else {
                  $sql.= "   and operationAneurysmAbdominalAorta='Y'";
           }
            break;
           case "16": ////有問題
                $sql.= "and (operationAssociateCategory='9'  or operationAssociateCategory='10' )";
                break;
           case "17": ////有問題
                $sql.= "and (operationAssociateCategory='9'  or operationAssociateCategory='10' )";
                break;
	    }
	
		return $this->db->query($sql,array($d1));

	}

   function query_executivesummary($y,$m,$yEnd,$mEnd,$t,$h='0'){
       //$h=1, 是從學會資料庫找出該醫院的統計報表
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     $db='patientinformation';
     $db2="nonopenheart";
     if($h=='1'){
       //  $db='tatcs.patientinformation';
      //   $db2="tatcs.nonopenheart";
       $db='twcvs_www.patientinformation';
       $db2="twcvs_www.nonopenheart";
     }
       if($t=="1"){
     $sql= "SELECT count(*) as num FROM ".$db."   where isDeleted ='N' and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="2"){
           $sql= "SELECT count(*) as num FROM ".$db."    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         //    $sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
    } else {
          $sql= "SELECT  sum(item1+item2+item3+item4+item5+item6+item7+item8+item9+item10) as num FROM ".$db2."     where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
     }
     if($h=='1'){
       $sql.= " and patientHospital='".$this->session->userdata('hospital')."' ";
     }
     
  
        return $this->db->query($sql);
   }
    
    
    function query_executivesummarydetail($y,$m,$yEnd,$mEnd,$t){
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
     
     
        return $this->db->query($sql);
   }


function query_executivesummarydetail2($y,$m,$yEnd,$mEnd,$t){
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
     
        return $this->db->query($sql);
   }
   
   function query_executivesummarychild($y,$m,$yEnd,$mEnd,$t){
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
     $sql.= " and (CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id2='53-02' or CongenitalProcedure_id3='53-02' or CongenitalProcedure_id4='53-02' or CongenitalProcedure_id5='53-02' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id2='53-04' or CongenitalProcedure_id3='53-04' or CongenitalProcedure_id4='53-04' or CongenitalProcedure_id5='53-04' ";   
     $sql.= " or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id2='53-09' or CongenitalProcedure_id3='53-09' or CongenitalProcedure_id4='53-09' or CongenitalProcedure_id5='53-09' ";  
     $sql.= " or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id2='53-10' or CongenitalProcedure_id3='53-10' or CongenitalProcedure_id4='53-10' or CongenitalProcedure_id5='53-10' ";  
     $sql.= " or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id2='53-11' or CongenitalProcedure_id3='53-11' or CongenitalProcedure_id4='53-11' or CongenitalProcedure_id5='53-11' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-12' or CongenitalProcedure_id2='53-12' or CongenitalProcedure_id3='53-12' or CongenitalProcedure_id4='53-12' or CongenitalProcedure_id5='53-12' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="8"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id2='33-07' or CongenitalProcedure_id3='33-07' or CongenitalProcedure_id4='33-07' or CongenitalProcedure_id5='33-07' ";    
     $sql.= " or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id2='33-08' or CongenitalProcedure_id3='33-08' or CongenitalProcedure_id4='33-08' or CongenitalProcedure_id5='33-08' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-09' or CongenitalProcedure_id2='33-09' or CongenitalProcedure_id3='33-09' or CongenitalProcedure_id4='33-09' or CongenitalProcedure_id5='33-09' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-13' or CongenitalProcedure_id2='33-13' or CongenitalProcedure_id3='33-13' or CongenitalProcedure_id4='33-13' or CongenitalProcedure_id5='33-13' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="10"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id2='51-01' or CongenitalProcedure_id3='51-01' or CongenitalProcedure_id4='51-01' or CongenitalProcedure_id5='51-01' ";    
     $sql.= " or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id2='51-02' or CongenitalProcedure_id3='51-02' or CongenitalProcedure_id4='51-02' or CongenitalProcedure_id5='51-02' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id2='51-03' or CongenitalProcedure_id3='51-03' or CongenitalProcedure_id4='51-03' or CongenitalProcedure_id5='51-03' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id2='51-04' or CongenitalProcedure_id3='51-04' or CongenitalProcedure_id4='51-04' or CongenitalProcedure_id5='51-04' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id2='51-05' or CongenitalProcedure_id3='51-05' or CongenitalProcedure_id4='51-05' or CongenitalProcedure_id5='51-05' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id2='51-06' or CongenitalProcedure_id3='51-06' or CongenitalProcedure_id4='51-06' or CongenitalProcedure_id5='51-06' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-07' or CongenitalProcedure_id2='51-07' or CongenitalProcedure_id3='51-07' or CongenitalProcedure_id4='51-07' or CongenitalProcedure_id5='51-07' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-08' or CongenitalProcedure_id2='51-08' or CongenitalProcedure_id3='51-08' or CongenitalProcedure_id4='51-08' or CongenitalProcedure_id5='51-08' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-10' or CongenitalProcedure_id2='51-10' or CongenitalProcedure_id3='51-10' or CongenitalProcedure_id4='51-10' or CongenitalProcedure_id5='51-10' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="11"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="12"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="14"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="101"){
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
     
        return $this->db->query($sql);
   }
   function query_executivesummarychildPure($y,$m,$yEnd,$mEnd,$t){
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
    $sql.= " and (((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id1 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='53-02' or CongenitalProcedure_id2 ='53-04' or CongenitalProcedure_id2 ='53-09' or CongenitalProcedure_id2 ='53-10' or CongenitalProcedure_id2 ='53-11' or CongenitalProcedure_id2 ='53-12')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='53-02' or CongenitalProcedure_id3 ='53-04' or CongenitalProcedure_id3 ='53-09' or CongenitalProcedure_id3 ='53-10' or CongenitalProcedure_id3 ='53-11' or CongenitalProcedure_id3 ='53-12')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='53-02' or CongenitalProcedure_id4 ='53-04' or CongenitalProcedure_id4 ='53-09' or CongenitalProcedure_id4 ='53-10' or CongenitalProcedure_id4 ='53-11' or CongenitalProcedure_id4 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='53-02' or CongenitalProcedure_id5 ='53-04' or CongenitalProcedure_id5 ='53-09' or CongenitalProcedure_id5 ='53-10' or CongenitalProcedure_id5 ='53-11' or CongenitalProcedure_id5 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="8"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '18-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '18-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (((CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id1 ='33-09'  or CongenitalProcedure_id1 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='33-07' or CongenitalProcedure_id2 ='33-08' or CongenitalProcedure_id2 ='33-09'  or CongenitalProcedure_id2 ='33-13')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='33-07' or CongenitalProcedure_id3 ='33-08' or CongenitalProcedure_id3 ='33-09'  or CongenitalProcedure_id3='33-13')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='33-07' or CongenitalProcedure_id4 ='33-08' or CongenitalProcedure_id4 ='33-09'  or CongenitalProcedure_id4 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='33-07' or CongenitalProcedure_id5 ='33-08' or CongenitalProcedure_id5 ='33-09'  or CongenitalProcedure_id5 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="10"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
       $sql.= " and (((CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id1 ='51-07' or CongenitalProcedure_id1 ='51-08' or CongenitalProcedure_id1 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='51-01' or CongenitalProcedure_id2 ='51-02' or CongenitalProcedure_id2 ='51-03' or CongenitalProcedure_id2 ='51-04' or CongenitalProcedure_id2 ='51-05' or CongenitalProcedure_id2 ='51-06' or CongenitalProcedure_id2 ='51-07' or CongenitalProcedure_id2 ='51-08' or CongenitalProcedure_id2 ='51-10')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='51-01' or CongenitalProcedure_id3 ='51-02' or CongenitalProcedure_id3 ='51-03' or CongenitalProcedure_id3 ='51-04' or CongenitalProcedure_id3 ='51-05' or CongenitalProcedure_id3 ='51-06' or CongenitalProcedure_id3 ='51-07' or CongenitalProcedure_id3 ='51-08' or CongenitalProcedure_id3 ='51-10')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='51-01' or CongenitalProcedure_id4 ='51-02' or CongenitalProcedure_id4 ='51-03' or CongenitalProcedure_id4 ='51-04' or CongenitalProcedure_id4 ='51-05' or CongenitalProcedure_id4 ='51-06' or CongenitalProcedure_id4 ='51-07' or CongenitalProcedure_id4 ='51-08' or CongenitalProcedure_id4 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='51-01' or CongenitalProcedure_id5 ='51-02' or CongenitalProcedure_id5 ='51-03' or CongenitalProcedure_id5 ='51-04' or CongenitalProcedure_id5 ='51-05' or CongenitalProcedure_id5 ='51-06' or CongenitalProcedure_id5 ='51-07' or CongenitalProcedure_id5 ='51-08' or CongenitalProcedure_id5 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="11"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '55-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '55-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="12"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '45-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '45-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '52-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '52-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="14"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '50-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '50-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="101"){
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
     
        return $this->db->query($sql);
   }
   
   function query_executivesummarynonopenheart($y,$m,$yEnd,$mEnd,$t){
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
     
        return $this->db->query($sql);
   }
   
   
   
      function query_executivesummaryVascular($y,$m,$yEnd,$mEnd,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=='9'){
          $sql= " SELECT count(*) as num FROM vascular   where isDeleted ='N' and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)";  
      $sql.= "    and (patientProcedure_id1 ='' or patientProcedure_id1 is null) ";
      $sql.= "    and (patientProcedure_id2='' or patientProcedure_id2 is null)";
      $sql.= "    and (patientProcedure_id3='' or patientProcedure_id3 is null)";
      $sql.= "    and (patientProcedure_id4='' or patientProcedure_id4 is null)";
      $sql.= "    and (patientProcedure_id5='' or patientProcedure_id5 is null)";
      $sql.="  and patientProcedureOthers<>'' and patientProcedureOthers is not null ";
     
     } else {
     $sql= " SELECT count(*) as num FROM vascular   where isDeleted ='N' and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)";  
      $sql.= "    and (patientProcedure_id1 like '$t-%' or patientProcedure_id2 like '$t-%'  or patientProcedure_id3 like '$t-%'  or patientProcedure_id4 like '$t-%'  or patientProcedure_id5 like '$t-%' ) ";
      }
     
        return $this->db->query($sql);
   }
   
   //2017-10-03
   function query_executivesummarydetail1($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
       if($t=="0"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT count(distinct patientChartNumber) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
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
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and CompletedStatus='Y'  and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
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
        return $this->db->query($sql);
   }
  
   
   function query_executivesummarydetail3($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=="0"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT count(distinct patientChartNumber) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication4='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication14='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication23='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication35='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and  outcomeChildComplication10='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication20='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication28='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="9"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' ";
         $sql.= " and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         $sql.= " and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "  and CompletedStatus='Y'  ";
          //$sql.= " and  (CongenitalProcedure1<>'' or CongenitalProcedure2<>'' or CongenitalProcedure3<>'' or CongenitalProcedure4<>'' or CongenitalProcedure5<>'' or CongenitalProcedureOthers<>'') ";
          //and (( $sql.= " and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') "; ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
                  
         }
        if($n=='0'){
             
         } else if($n=="1"){
            $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="2"){
                 $sql.= " and ((CongenitalProcedure_id1 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id2 like '42-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ( CongenitalProcedure_id3 like '42-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id4 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id5 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="3"){
           $sql.= " and (((CongenitalProcedure_id1 ='53-01' or CongenitalProcedure_id1 ='53-03' or CongenitalProcedure_id1 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='53-01' or CongenitalProcedure_id2 ='53-03' or CongenitalProcedure_id2 ='53-05')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='53-01' or CongenitalProcedure_id3 ='53-03' or CongenitalProcedure_id3 ='53-05')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='53-01' or CongenitalProcedure_id4 ='53-03' or CongenitalProcedure_id4 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='53-01' or CongenitalProcedure_id5 ='53-03' or CongenitalProcedure_id5 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="4"){
           $sql.= " and (((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id1 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id2 ='53-09' or CongenitalProcedure_id2 ='53-10' or CongenitalProcedure_id2 ='53-11' or CongenitalProcedure_id2 ='53-12')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id3 ='53-09' or CongenitalProcedure_id3 ='53-10' or CongenitalProcedure_id3 ='53-11' or CongenitalProcedure_id3 ='53-12')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id4 ='53-09' or CongenitalProcedure_id4 ='53-10' or CongenitalProcedure_id4 ='53-11' or CongenitalProcedure_id4 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id5 ='53-09' or CongenitalProcedure_id5 ='53-10' or CongenitalProcedure_id5 ='53-11' or CongenitalProcedure_id5 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="5"){
             $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '18-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '18-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="6"){
             $sql.= " and (((CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id1 ='33-09'  or CongenitalProcedure_id1 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='33-07' or CongenitalProcedure_id2 ='33-08' or CongenitalProcedure_id2 ='33-09'  or CongenitalProcedure_id2 ='33-13')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='33-07' or CongenitalProcedure_id3 ='33-08' or CongenitalProcedure_id3 ='33-09'  or CongenitalProcedure_id3='33-13')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='33-07' or CongenitalProcedure_id4 ='33-08' or CongenitalProcedure_id4 ='33-09'  or CongenitalProcedure_id4 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='33-07' or CongenitalProcedure_id5 ='33-08' or CongenitalProcedure_id5 ='33-09'  or CongenitalProcedure_id5 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="7"){
          $sql.= " and (((CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id1 ='51-07'  or CongenitalProcedure_id1 ='51-08'  or CongenitalProcedure_id1 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='51-01' or CongenitalProcedure_id2 ='51-02' or CongenitalProcedure_id2 ='51-03' or CongenitalProcedure_id2 ='51-04' or CongenitalProcedure_id2 ='51-05' or CongenitalProcedure_id2 ='51-06' or CongenitalProcedure_id2 ='51-07'  or CongenitalProcedure_id2 ='51-08'  or CongenitalProcedure_id2 ='51-10')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='51-01' or CongenitalProcedure_id3='51-02' or CongenitalProcedure_id3 ='51-03' or CongenitalProcedure_id3 ='51-04' or CongenitalProcedure_id3 ='51-05' or CongenitalProcedure_id3 ='51-06' or CongenitalProcedure_id3 ='51-07'  or CongenitalProcedure_id3 ='51-08'  or CongenitalProcedure_id3 ='51-10')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='51-01' or CongenitalProcedure_id4 ='51-02' or CongenitalProcedure_id4 ='51-03' or CongenitalProcedure_id4 ='51-04' or CongenitalProcedure_id4 ='51-05' or CongenitalProcedure_id4 ='51-06' or CongenitalProcedure_id4 ='51-07'  or CongenitalProcedure_id4 ='51-08'  or CongenitalProcedure_id4 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='51-01' or CongenitalProcedure_id5 ='51-02' or CongenitalProcedure_id5 ='51-03' or CongenitalProcedure_id5 ='51-04' or CongenitalProcedure_id5 ='51-05' or CongenitalProcedure_id5 ='51-06' or CongenitalProcedure_id5='51-07'  or CongenitalProcedure_id5 ='51-08'  or CongenitalProcedure_id5 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
       } else if($n=="8"){
              $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '55-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '55-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
       } else if($n=="9"){
           $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '45-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '45-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
   } else if($n=="10"){
          $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '52-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '52-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
    } else if($n=="11"){
         $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '50-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '50-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
    } else if($n=="101"){
          $sql.= " and (CongenitalProcedure_id1 like '56-%' or CongenitalProcedure_id2 like '56-%' or CongenitalProcedure_id3 like '56-%' or CongenitalProcedure_id4 like '56-%' or CongenitalProcedure_id5 like '56-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="12"){
       $sql.= " and (CongenitalProcedure_id1 like '44-%' or CongenitalProcedure_id2 like '44-%' or CongenitalProcedure_id3 like '44-%' or CongenitalProcedure_id4 like '44-%' or CongenitalProcedure_id5 like '44-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '44-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '44-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="13"){
        $sql.= " and (CongenitalProcedure_id1 like '27-%' or CongenitalProcedure_id2 like '27-%' or CongenitalProcedure_id3 like '27-%' or CongenitalProcedure_id4 like '27-%' or CongenitalProcedure_id5 like '27-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '27-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '27-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
   } else if($n=="14"){
          $sql.= " and (((CongenitalProcedure_id1 ='54-01' or CongenitalProcedure_id1 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='54-01' or CongenitalProcedure_id2 ='54-04')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='54-01' or CongenitalProcedure_id3 ='54-04')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='54-01' or CongenitalProcedure_id4 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='54-01' or CongenitalProcedure_id5='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="15"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' ";
         $sql.= " and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         $sql.= " and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
       //    echo $sql."<br/><br/>"; 
             } 
        return $this->db->query($sql);
   }
   
 function query_executivesummarydetaillist1($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
       if($t=="0"){
        $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck2='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck3='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck4='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck5='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and  outcomeCheck6='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT *FROM patientinformation   where isDeleted ='N' and outcomeCheck7='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
          $sql= "SELECT * FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and  patientID not in";
       $sql.= "(SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and ((patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00') ";
       $sql.=" or ((patientSurgeon=''  or patientSurgeon is null) and  (patientSurgeon2='' or patientSurgeon2 is null)   and  (patientSurgeon3='' or patientSurgeon3 is null)    and  (patientSurgeon4='' or patientSurgeon4 is null) ) ";
           //$sql.=" or (operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y' ";
      // $sql.="  and operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')";
           $sql.=" or (patientDischargeDate='' or patientDischargeDate='0000-00-00' or  outcomeExtubationDate=''  or  outcomeExtubationDate='0000-00-00'  or outcomeStatus=''   or patientDischargeDate is null or outcomeExtubationDate is null or outcomeStatus is null)";
           $sql.=" ))";
          $sql= "SELECT * FROM patientinformation   where isDeleted ='N'  and CompletedStatus='Y'  and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          
         } else if($t=="9"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and euroScoreII<>'' and euroScoreII is not null  and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
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
           
        //   echo $sql."<br/><br/><br/>";
             } 
       //  echo "n:".$n."--->"."t:".$t."--->".$sql."<br/><br/><br/>";
        return $this->db->query($sql);
   }
   
   function query_executivesummarydetaillist3($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=="0"){
        $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication4='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication14='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication23='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication35='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and  outcomeChildComplication10='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication20='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication28='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="9"){
        // $sql= "SELECT *FROM patientinformation   where isDeleted ='N'  and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
       //   $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' ";
         $sql.= " and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         $sql.= " and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "  and CompletedStatus='Y'  ";         
         }
        if($n=='0'){
             
         } else if($n=="1"){
            $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="2"){
                 $sql.= " and ((CongenitalProcedure_id1 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id2 like '42-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ( CongenitalProcedure_id3 like '42-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id4 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id5 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="3"){
           $sql.= " and (((CongenitalProcedure_id1 ='53-01' or CongenitalProcedure_id1 ='53-03' or CongenitalProcedure_id1 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='53-01' or CongenitalProcedure_id2 ='53-03' or CongenitalProcedure_id2 ='53-05')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='53-01' or CongenitalProcedure_id3 ='53-03' or CongenitalProcedure_id3 ='53-05')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='53-01' or CongenitalProcedure_id4 ='53-03' or CongenitalProcedure_id4 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='53-01' or CongenitalProcedure_id5 ='53-03' or CongenitalProcedure_id5 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="4"){
           $sql.= " and (((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id1 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id2 ='53-09' or CongenitalProcedure_id2 ='53-10' or CongenitalProcedure_id2 ='53-11' or CongenitalProcedure_id2 ='53-12')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id3 ='53-09' or CongenitalProcedure_id3 ='53-10' or CongenitalProcedure_id3 ='53-11' or CongenitalProcedure_id3 ='53-12')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id4 ='53-09' or CongenitalProcedure_id4 ='53-10' or CongenitalProcedure_id4 ='53-11' or CongenitalProcedure_id4 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id5 ='53-09' or CongenitalProcedure_id5 ='53-10' or CongenitalProcedure_id5 ='53-11' or CongenitalProcedure_id5 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="5"){
             $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '18-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '18-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="6"){
             $sql.= " and (((CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id1 ='33-09'  or CongenitalProcedure_id1 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='33-07' or CongenitalProcedure_id2 ='33-08' or CongenitalProcedure_id2 ='33-09'  or CongenitalProcedure_id2 ='33-13')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='33-07' or CongenitalProcedure_id3 ='33-08' or CongenitalProcedure_id3 ='33-09'  or CongenitalProcedure_id3='33-13')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='33-07' or CongenitalProcedure_id4 ='33-08' or CongenitalProcedure_id4 ='33-09'  or CongenitalProcedure_id4 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='33-07' or CongenitalProcedure_id5 ='33-08' or CongenitalProcedure_id5 ='33-09'  or CongenitalProcedure_id5 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="7"){
          $sql.= " and (((CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id1 ='51-07'  or CongenitalProcedure_id1 ='51-08'  or CongenitalProcedure_id1 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='51-01' or CongenitalProcedure_id2 ='51-02' or CongenitalProcedure_id2 ='51-03' or CongenitalProcedure_id2 ='51-04' or CongenitalProcedure_id2 ='51-05' or CongenitalProcedure_id2 ='51-06' or CongenitalProcedure_id2 ='51-07'  or CongenitalProcedure_id2 ='51-08'  or CongenitalProcedure_id2 ='51-10')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='51-01' or CongenitalProcedure_id3='51-02' or CongenitalProcedure_id3 ='51-03' or CongenitalProcedure_id3 ='51-04' or CongenitalProcedure_id3 ='51-05' or CongenitalProcedure_id3 ='51-06' or CongenitalProcedure_id3 ='51-07'  or CongenitalProcedure_id3 ='51-08'  or CongenitalProcedure_id3 ='51-10')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='51-01' or CongenitalProcedure_id4 ='51-02' or CongenitalProcedure_id4 ='51-03' or CongenitalProcedure_id4 ='51-04' or CongenitalProcedure_id4 ='51-05' or CongenitalProcedure_id4 ='51-06' or CongenitalProcedure_id4 ='51-07'  or CongenitalProcedure_id4 ='51-08'  or CongenitalProcedure_id4 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='51-01' or CongenitalProcedure_id5 ='51-02' or CongenitalProcedure_id5 ='51-03' or CongenitalProcedure_id5 ='51-04' or CongenitalProcedure_id5 ='51-05' or CongenitalProcedure_id5 ='51-06' or CongenitalProcedure_id5='51-07'  or CongenitalProcedure_id5 ='51-08'  or CongenitalProcedure_id5 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
       } else if($n=="8"){
              $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '55-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '55-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
       } else if($n=="9"){
           $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '45-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '45-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
   } else if($n=="10"){
          $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '52-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '52-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
    } else if($n=="11"){
         $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '50-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '50-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
    } else if($n=="101"){
          $sql.= " and (CongenitalProcedure_id1 like '56-%' or CongenitalProcedure_id2 like '56-%' or CongenitalProcedure_id3 like '56-%' or CongenitalProcedure_id4 like '56-%' or CongenitalProcedure_id5 like '56-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="12"){
       $sql.= " and (CongenitalProcedure_id1 like '44-%' or CongenitalProcedure_id2 like '44-%' or CongenitalProcedure_id3 like '44-%' or CongenitalProcedure_id4 like '44-%' or CongenitalProcedure_id5 like '44-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '44-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '44-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="13"){
        $sql.= " and (CongenitalProcedure_id1 like '27-%' or CongenitalProcedure_id2 like '27-%' or CongenitalProcedure_id3 like '27-%' or CongenitalProcedure_id4 like '27-%' or CongenitalProcedure_id5 like '27-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '27-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '27-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
   } else if($n=="14"){
          $sql.= " and (((CongenitalProcedure_id1 ='54-01' or CongenitalProcedure_id1 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='54-01' or CongenitalProcedure_id2 ='54-04')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='54-01' or CongenitalProcedure_id3 ='54-04')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='54-01' or CongenitalProcedure_id4 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='54-01' or CongenitalProcedure_id5='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="15"){
         
           $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
             
       //    echo $sql."<br/><br/>"; 
             } 
        return $this->db->query($sql);
   }
   function query_executivesummarydetaillistEXCEL1($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
       if($t=="0"){
        $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck2='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck3='Y' and  (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck4='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck5='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and  outcomeCheck6='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null)  and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck7='Y' and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
          $sql= "SELECT  patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and  patientID not in";
       $sql.= "(SELECT patientID FROM patientinformation   where isDeleted ='N'   and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= " and ((patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00') ";
       $sql.=" or ((patientSurgeon=''  or patientSurgeon is null) and  (patientSurgeon2='' or patientSurgeon2 is null)   and  (patientSurgeon3='' or patientSurgeon3 is null)    and  (patientSurgeon4='' or patientSurgeon4 is null) ) ";
           //$sql.=" or (operationCABG !='Y' and  operationAorticValve !='Y' and  operationAorticSurgery !='Y' and  operationMitralValve !='Y' ";
      // $sql.="  and operationArrythmiaSurgery !='Y' and  operationTricuspidValve !='Y' and  operationPulmonaryValve !='Y' and  operationHeartTransplantation !='Y'  and  operationOtherCardiacSurgery !='Y')";
           $sql.=" or (patientDischargeDate='' or patientDischargeDate='0000-00-00' or  outcomeExtubationDate=''  or  outcomeExtubationDate='0000-00-00'  or outcomeStatus=''   or patientDischargeDate is null or outcomeExtubationDate is null or outcomeStatus is null)";
           $sql.=" ))";
           $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N'  and CompletedStatus='Y'  and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          
         } else if($t=="9"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon   FROM patientinformation   where isDeleted ='N' and euroScoreII<>'' and euroScoreII is not null  and   (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
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
           
        //   echo $sql."<br/><br/><br/>";
             } 
       //  echo "n:".$n."--->"."t:".$t."--->".$sql."<br/><br/><br/>";
        return $this->db->query($sql);
   }
   
      function query_executivesummarydetaillistEXCEL3($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=="0"){
        $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication4='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication14='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication23='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication35='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and  outcomeChildComplication10='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication20='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication28='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="9"){
        // $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N'  and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
      //    $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
          $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' ";
         $sql.= " and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') ";
         $sql.= " and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         $sql.= "  and CompletedStatus='Y'  ";        
         }
        if($n=='0'){
             
         } else if($n=="1"){
            $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="2"){
                 $sql.= " and ((CongenitalProcedure_id1 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id2 like '42-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ( CongenitalProcedure_id3 like '42-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id4 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or (CongenitalProcedure_id5 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="3"){
           $sql.= " and (((CongenitalProcedure_id1 ='53-01' or CongenitalProcedure_id1 ='53-03' or CongenitalProcedure_id1 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='53-01' or CongenitalProcedure_id2 ='53-03' or CongenitalProcedure_id2 ='53-05')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='53-01' or CongenitalProcedure_id3 ='53-03' or CongenitalProcedure_id3 ='53-05')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='53-01' or CongenitalProcedure_id4 ='53-03' or CongenitalProcedure_id4 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='53-01' or CongenitalProcedure_id5 ='53-03' or CongenitalProcedure_id5 ='53-05') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="4"){
           $sql.= " and (((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id1 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id2 ='53-09' or CongenitalProcedure_id2 ='53-10' or CongenitalProcedure_id2 ='53-11' or CongenitalProcedure_id2 ='53-12')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id3 ='53-09' or CongenitalProcedure_id3 ='53-10' or CongenitalProcedure_id3 ='53-11' or CongenitalProcedure_id3 ='53-12')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id4 ='53-09' or CongenitalProcedure_id4 ='53-10' or CongenitalProcedure_id4 ='53-11' or CongenitalProcedure_id4 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id5 ='53-09' or CongenitalProcedure_id5 ='53-10' or CongenitalProcedure_id5 ='53-11' or CongenitalProcedure_id5 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="5"){
             $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '18-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '18-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="6"){
             $sql.= " and (((CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id1 ='33-09'  or CongenitalProcedure_id1 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='33-07' or CongenitalProcedure_id2 ='33-08' or CongenitalProcedure_id2 ='33-09'  or CongenitalProcedure_id2 ='33-13')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='33-07' or CongenitalProcedure_id3 ='33-08' or CongenitalProcedure_id3 ='33-09'  or CongenitalProcedure_id3='33-13')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='33-07' or CongenitalProcedure_id4 ='33-08' or CongenitalProcedure_id4 ='33-09'  or CongenitalProcedure_id4 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='33-07' or CongenitalProcedure_id5 ='33-08' or CongenitalProcedure_id5 ='33-09'  or CongenitalProcedure_id5 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="7"){
          $sql.= " and (((CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id1 ='51-07'  or CongenitalProcedure_id1 ='51-08'  or CongenitalProcedure_id1 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='51-01' or CongenitalProcedure_id2 ='51-02' or CongenitalProcedure_id2 ='51-03' or CongenitalProcedure_id2 ='51-04' or CongenitalProcedure_id2 ='51-05' or CongenitalProcedure_id2 ='51-06' or CongenitalProcedure_id2 ='51-07'  or CongenitalProcedure_id2 ='51-08'  or CongenitalProcedure_id2 ='51-10')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='51-01' or CongenitalProcedure_id3='51-02' or CongenitalProcedure_id3 ='51-03' or CongenitalProcedure_id3 ='51-04' or CongenitalProcedure_id3 ='51-05' or CongenitalProcedure_id3 ='51-06' or CongenitalProcedure_id3 ='51-07'  or CongenitalProcedure_id3 ='51-08'  or CongenitalProcedure_id3 ='51-10')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='51-01' or CongenitalProcedure_id4 ='51-02' or CongenitalProcedure_id4 ='51-03' or CongenitalProcedure_id4 ='51-04' or CongenitalProcedure_id4 ='51-05' or CongenitalProcedure_id4 ='51-06' or CongenitalProcedure_id4 ='51-07'  or CongenitalProcedure_id4 ='51-08'  or CongenitalProcedure_id4 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='51-01' or CongenitalProcedure_id5 ='51-02' or CongenitalProcedure_id5 ='51-03' or CongenitalProcedure_id5 ='51-04' or CongenitalProcedure_id5 ='51-05' or CongenitalProcedure_id5 ='51-06' or CongenitalProcedure_id5='51-07'  or CongenitalProcedure_id5 ='51-08'  or CongenitalProcedure_id5 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
       } else if($n=="8"){
              $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '55-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '55-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
       } else if($n=="9"){
           $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '45-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '45-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
   } else if($n=="10"){
          $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '52-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '52-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
    } else if($n=="11"){
         $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '50-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '50-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
    } else if($n=="101"){
          $sql.= " and (CongenitalProcedure_id1 like '56-%' or CongenitalProcedure_id2 like '56-%' or CongenitalProcedure_id3 like '56-%' or CongenitalProcedure_id4 like '56-%' or CongenitalProcedure_id5 like '56-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '56-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '56-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="12"){
       $sql.= " and (CongenitalProcedure_id1 like '44-%' or CongenitalProcedure_id2 like '44-%' or CongenitalProcedure_id3 like '44-%' or CongenitalProcedure_id4 like '44-%' or CongenitalProcedure_id5 like '44-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '44-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '44-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '44-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      } else if($n=="13"){
        $sql.= " and (CongenitalProcedure_id1 like '27-%' or CongenitalProcedure_id2 like '27-%' or CongenitalProcedure_id3 like '27-%' or CongenitalProcedure_id4 like '27-%' or CongenitalProcedure_id5 like '27-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '27-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '27-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '27-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
   } else if($n=="14"){
          $sql.= " and (((CongenitalProcedure_id1 ='54-01' or CongenitalProcedure_id1 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='54-01' or CongenitalProcedure_id2 ='54-04')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='54-01' or CongenitalProcedure_id3 ='54-04')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='54-01' or CongenitalProcedure_id4 ='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='54-01' or CongenitalProcedure_id5='54-04') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     } else if($n=="15"){
         
           $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
             
       //    echo $sql."<br/><br/>"; 
             } 
        return $this->db->query($sql);
   }
   
   function query_chdbenchmark($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=="0"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication4='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication14='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication23='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication35='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and  outcomeChildComplication10='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication20='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and outcomeChildComplication28='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="9"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N'  and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
                  
         }
        if($n=='0'){
             
         } else {
            $sql.= " and BenchmarkSurgery='$n' ";
 } 
        return $this->db->query($sql);
   }
   function query_chdbenchmarklist($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=="0"){
        $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication4='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication14='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication23='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication35='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and  outcomeChildComplication10='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT * FROM patientinformation   where isDeleted ='N' and outcomeChildComplication20='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT *  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication28='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="9"){
         $sql= "SELECT *  FROM patientinformation   where isDeleted ='N'  and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
                  
         }
        if($n=='0'){
             
         } else {
            $sql.= " and BenchmarkSurgery='$n' ";
 } 
        return $this->db->query($sql);
   }
   
   
   
      function query_chdbenchmarklistEXCEL($y,$m,$yEnd,$mEnd,$n,$t){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
     if($t=="0"){
        $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         
         }  else if($t=="1"){
               $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and outcomeCheck1='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           } else if($t=="2"){
           $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and outcomeChildComplication4='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="3"){
             $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and outcomeChildComplication14='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         }  else if($t=="4"){
        $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and outcomeChildComplication23='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="5"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and outcomeChildComplication35='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          } else if($t=="6"){
          $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and  outcomeChildComplication10='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="7"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon FROM patientinformation   where isDeleted ='N' and outcomeChildComplication20='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="8"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N' and outcomeChildComplication28='Y' and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         } else if($t=="9"){
         $sql= "SELECT patientChartNumber,patientName, patientBirthday,patientGender,patientSurgeon  FROM patientinformation   where isDeleted ='N'  and  (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
          $sql.= "  and ((CongenitalProcedure1 ='' or  CongenitalProcedure1 is null)  and  (CongenitalProcedure2 ='' or  CongenitalProcedure2 is null)  and  (CongenitalProcedure3 ='' or  CongenitalProcedure3 is null)  and  (CongenitalProcedure4 ='' or  CongenitalProcedure4 is null)  and  (CongenitalProcedure5 ='' or  CongenitalProcedure5 is null)  and (CongenitalProcedureOthers='' or  CongenitalProcedure1 is null) )" ;
                  
         }
        if($n=='0'){
             
         } else {
            $sql.= " and BenchmarkSurgery='$n' ";
 } 
        return $this->db->query($sql);
   }
   
   function query_VascularDetail($qYear,$qMonth,$qYearEnd,$qMonthEnd,$id){
       $d=$qYear."-".$qMonth."-01";
     $dEnd=$qYearEnd."-".$qMonthEnd."-01";
     
       $sql= "select t1.code,t1.`subject`,t1.order, count(t2.patientID) as totalSum from vascularprocedure t1  LEFT  JOIN  ";
       $sql.=" ( select * from vascular  where  isDeleted ='N' and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH) ) t2 on ";
       $sql.= " (t1.`code`=t2.patientProcedure_id1 or t1.`code`=t2.patientProcedure_id2 or t1.`code`=t2.patientProcedure_id3 or t1.`code`=t2.patientProcedure_id4 or t1.`code`=t2.patientProcedure_id5) ";

       $sql.="  where  t1.`code` like '$id-%' ";
  $sql.= " group by t1.code,t1.`subject`,t1.order order by t1.order";
  
   return $this->db->query($sql);
   }
     function query_chdmortalitySTD($y,$m,$yEnd,$mEnd,$t,$v){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
    
     //    $sql= "SELECT count(DISTINCT patientChartNumber,patientDischargeDate) as num ";
     
     $sql= "select count(DISTINCT t.patientChartNumber,t.patientDischargeDate) as num from ";
$sql.= " (select patientChartNumber, max(patientOpDate) as myOP, patientDischargeDate ";
$sql.= "  from patientinformation where isDeleted ='N' ";
$sql.= " group by patientChartNumber,patientDischargeDate) t1 ";
$sql.= "  join patientinformation t  ";
$sql.= "  on t1.patientChartNumber=t.patientChartNumber and t1.patientDischargeDate=t.patientDischargeDate ";
$sql.= "  and t1.myOP=t.patientOpDate ";
   
               if($t=="1"){
     $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="2"){
    $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="3"){
     $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='53-01' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-03'";   
       $sql.= " or CongenitalProcedure_id1 ='53-05' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="4"){
     $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='53-02' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-04'";  
       $sql.= " or CongenitalProcedure_id1 ='53-09'";  
       $sql.= " or CongenitalProcedure_id1 ='53-10'";   
       $sql.= " or CongenitalProcedure_id1 ='53-11'";   
       $sql.= " or CongenitalProcedure_id1 ='53-12' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="5"){
    $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="6"){
     $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='33-07' ";    
     $sql.= " or CongenitalProcedure_id1 ='33-08'";   
     $sql.= " or CongenitalProcedure_id1 ='33-09' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-13' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="7"){
     $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 = '51-01'";
    $sql.= " or CongenitalProcedure_id1 ='51-02'";   
    $sql.= " or CongenitalProcedure_id1 ='51-03'";   
    $sql.= " or CongenitalProcedure_id1 ='51-04'";   
    $sql.= " or CongenitalProcedure_id1 ='51-05'";   
    $sql.= " or CongenitalProcedure_id1 ='51-06'";   
    $sql.= " or CongenitalProcedure_id1 ='51-07'";   
    $sql.= " or CongenitalProcedure_id1 ='51-08'";   
    $sql.= " or CongenitalProcedure_id1 ='51-10'";   
    $sql.= " ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="8"){
     $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="10"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="11"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="101"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="12"){
     $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '44-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '27-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else {
           $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           $sql.= " and (CongenitalProcedure_id1 ='54-01'";    
        $sql.= " or CongenitalProcedure_id1 ='54-04' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }
     
     if($v=="1"){
       $sql.= " and outcomeCheck1='Y'";  
     }
        return $this->db->query($sql);
   }
   
   
     function query_chdmortalityBenchmarkSTD($y,$m,$yEnd,$mEnd,$t,$v){
          $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
    
     //    $sql= "SELECT count(DISTINCT patientChartNumber,patientOpDate) as num ";
        $sql= "select count(DISTINCT t.patientChartNumber,t.patientDischargeDate) as num from ";
$sql.= " (select  patientChartNumber, max(patientOpDate) as myOP, patientDischargeDate ";
$sql.= "  from patientinformation where isDeleted ='N'";
$sql.= " group by patientChartNumber,patientDischargeDate) t1 ";
$sql.= "  join patientinformation t  ";
$sql.= "  on t1.patientChartNumber=t.patientChartNumber and t1.patientDischargeDate=t.patientDischargeDate ";
$sql.= "  and t1.myOP=t.patientOpDate ";

            $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
               $sql.= " and BenchmarkSurgery='$t'  ";
               
               if($v=="1"){
       $sql.= " and outcomeCheck1='Y'";  
     }
        return $this->db->query($sql);
     }
     
       function query_chdmortality($y,$m,$yEnd,$mEnd,$t,$v){
       $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
    
     //    $sql= "SELECT count(DISTINCT patientChartNumber,patientDischargeDate) as num ";
     
     $sql= "select count(DISTINCT t.patientChartNumber,t.patientDischargeDate) as num from ";
$sql.= " (select patientChartNumber, max(patientOpDate) as myOP, patientDischargeDate ";
$sql.= "  from patientinformation where isDeleted ='N' ";
if($v=="1"){
       $sql.= " and outcomeCheck1='Y' ";  
     }
$sql.= " group by patientChartNumber,patientDischargeDate ) t1 ";
$sql.= "  join patientinformation t ";
$sql.= "  on t1.patientChartNumber=t.patientChartNumber and t1.patientDischargeDate=t.patientDischargeDate ";
$sql.= "  and t1.myOP=t.patientOpDate ";
   
           if($t=="1"){
     $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="2"){
    $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '42-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="3"){
     $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='53-01' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-03'";   
       $sql.= " or CongenitalProcedure_id1 ='53-05' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="4"){
     $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='53-02' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-04'";  
       $sql.= " or CongenitalProcedure_id1 ='53-09'";  
       $sql.= " or CongenitalProcedure_id1 ='53-10'";   
       $sql.= " or CongenitalProcedure_id1 ='53-11'";   
       $sql.= " or CongenitalProcedure_id1 ='53-12' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="5"){
    $sql.= "  where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="6"){
     $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='33-07' ";    
     $sql.= " or CongenitalProcedure_id1 ='33-08'";   
     $sql.= " or CongenitalProcedure_id1 ='33-09' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-13' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="7"){
     $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 = '51-01'";
    $sql.= " or CongenitalProcedure_id1 ='51-02'";   
    $sql.= " or CongenitalProcedure_id1 ='51-03'";   
    $sql.= " or CongenitalProcedure_id1 ='51-04'";   
    $sql.= " or CongenitalProcedure_id1 ='51-05'";   
    $sql.= " or CongenitalProcedure_id1 ='51-06'";   
    $sql.= " or CongenitalProcedure_id1 ='51-07'";   
    $sql.= " or CongenitalProcedure_id1 ='51-08'";   
    $sql.= " or CongenitalProcedure_id1 ='51-10'";   
    $sql.= " ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="8"){
     $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="10"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="11"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="101"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '56-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="12"){
     $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '44-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
    $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '27-%'and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else {
           $sql.= "    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
           $sql.= " and (CongenitalProcedure_id1 ='54-01'";    
        $sql.= " or CongenitalProcedure_id1 ='54-04' ) and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5=''";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }
  
        return $this->db->query($sql);
   }
   
   
     function query_chdmortalityBenchmark($y,$m,$yEnd,$mEnd,$t,$v){
          $d=$y."-".$m."-01";
     $dEnd=$yEnd."-".$mEnd."-01";
     $exception_1="30-09";
     $exception_2="30-10";
    
     //    $sql= "SELECT count(DISTINCT patientChartNumber,patientOpDate) as num ";
        $sql= "select count(DISTINCT t.patientChartNumber,t.patientDischargeDate) as num from ";
$sql.= " (select patientChartNumber, max(patientOpDate) as myOP, patientDischargeDate ";
$sql.= "  from patientinformation where isDeleted ='N' ";
if($v=="1"){
       $sql.= " and outcomeCheck1='Y' ";  
     }
$sql.= " group by patientChartNumber,patientDischargeDate) t1 ";
$sql.= "  join patientinformation t ";
$sql.= "  on t1.patientChartNumber=t.patientChartNumber and t1.patientDischargeDate=t.patientDischargeDate ";
$sql.= "  and t1.myOP=t.patientOpDate ";

            $sql.= "   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
               $sql.= " and BenchmarkSurgery='$t'  ";
               
           //    echo $sql."<br/>";
        return $this->db->query($sql);
     }
     
     function query_CRmeeting($d1,$d2){
            $sql= "SELECT * FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  order by patientOpDate ";
       
        return $this->db->query($sql); 

    }
    
      function query_CRmeetingVascular($d1,$d2){
            $sql= "SELECT * FROM vascular t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  order by patientOpDate ";
       
        return $this->db->query($sql); 

    }
    
    function query_urgency($y,$m,$yEnd,$mEnd,$t,$h){
          $d1=$y."-".$m."-01";
         $d2=$yEnd."-".$mEnd."-01";
           if($t=='5'){
             $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and (pastHistoryUrgency=''   or  pastHistoryUrgency is null)";
        } else {
            $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and pastHistoryUrgency='$t' ";
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
             $sql= "SELECT count(*) as num  FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and cast(euroScoreII AS DECIMAL(10,2)) <=5 and euroScoreII<>''";
           } elseif($t=='2'){
                $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and cast(euroScoreII AS DECIMAL(10,2)) <=10  and cast(euroScoreII AS DECIMAL(10,2)) >5 and euroScoreII<>''";
        } elseif($t=='3'){
              $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and cast(euroScoreII AS DECIMAL(10,2)) <=20  and cast(euroScoreII AS DECIMAL(10,2)) >10 and euroScoreII<>''";  
        } elseif($t=='4'){
              $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and cast(euroScoreII AS DECIMAL(10,2)) >20  and euroScoreII<>''";  
        } else {
            $sql= "SELECT count(*) as num FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)   and (euroScoreII='' or  euroScoreII is null)";
       }
         $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
   
        if($h!='0'){
              $sql.= " and patientHospital='$h'";
            }
        return $this->db->query($sql); 

    }

  function query_euroscore20($y,$m,$yEnd,$mEnd,$t,$h){
            $d1=$y."-".$m."-01";
         $d2=$yEnd."-".$mEnd."-01";
           if($t=='1'){
             $sql= "SELECT * FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) <=5 and euroScoreII<>''";
           } elseif($t=='2'){
                $sql= "SELECT *  FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) <=10  and cast(euroScoreII AS DECIMAL(10,2)) >5 and euroScoreII<>''";
        } elseif($t=='3'){
              $sql= "SELECT * FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) <=20  and cast(euroScoreII AS DECIMAL(10,2)) >10 and euroScoreII<>''";  
        } elseif($t=='4'){
              $sql= "SELECT * FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and cast(euroScoreII AS DECIMAL(10,2)) >20  and euroScoreII<>''";  
        } else {
            $sql= "SELECT *  FROM patientinformation t1 where  isDeleted ='N'  and patientOpDate>='$d1' and patientOpDate<='$d2'  and (euroScoreII='' or  euroScoreII is null)";
       }
         $sql.= " and (CongenitalDiagnosisOthers=''  or CongenitalDiagnosisOthers is null)   and (CongenitalDiagnosis1=''  or CongenitalDiagnosis1 is null)  and (CongenitalDiagnosis2=''  or CongenitalDiagnosis2 is null)  and (CongenitalDiagnosis3=''  or CongenitalDiagnosis3 is null)  and (CongenitalDiagnosis4=''  or CongenitalDiagnosis4 is null)  and (CongenitalDiagnosis5=''  or CongenitalDiagnosis5 is null) ";
   
        if($h!='0'){
              $sql.= " and patientHospital='$h'";
            }
        return $this->db->query($sql); 

    }
  
  function query_associateReport2006($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i){
          $d1=$qYear."-".$qMonth."-01";
        $d2=$qYearEnd."-".$qMonthEnd."-01";
        $sql= "SELECT  count(patientID) as num from   patientinformation where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and  associationCategory2006=? ";
        return $this->db->query($sql, array( $d1,$i));
            }
  function query_associateReport2006server($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i){
          $d1=$qYear."-".$qMonth."-01";
        $d2=$qYearEnd."-".$qMonthEnd."-01";
        $sql= "SELECT  count(patientID) as num from   twcvs_www.patientinformation where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and  associationCategory2006=? ";
        $sql.=" and patientHospital='".$this->session->userdata('hospital')."' ";
        return $this->db->query($sql, array( $d1,$i));
            }
   function query_associateReport2019($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i){
          $d1=$qYear."-".$qMonth."-01";
        $d2=$qYearEnd."-".$qMonthEnd."-01";
        $sql= "SELECT  count(patientID) as num from   patientinformation where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and  associationCategory2019=? ";
        return $this->db->query($sql, array( $d1,$i));
            }
  function query_associateReport2019server($qYear,$qMonth,$qYearEnd,$qMonthEnd,$i){
          $d1=$qYear."-".$qMonth."-01";
        $d2=$qYearEnd."-".$qMonthEnd."-01";
        $sql= "SELECT  count(patientID) as num from   twcvs_www.patientinformation where isDeleted ='N' and patientOpDate>=? and patientOpDate<=DATE_ADD('$d2', INTERVAL 1 MONTH)  and  associationCategory2019=? ";
        $sql.=" and patientHospital='".$this->session->userdata('hospital')."' ";
        return $this->db->query($sql, array( $d1,$i));
            }
  
  //2019-06-24新功能, 為了住醫師的輸出
      function query_executivesummary_Resident($d1,$d2,$t,$h='0'){
       //$h=1, 是從學會資料庫找出該醫院的統計報表
     $d=$d1;
     $dEnd=$d2;
     $exception_1="30-09";
     $exception_2="30-10";
     $db='patientinformation';
     $db2="nonopenheart";
     if($h=='1'){
       //  $db='tatcs.patientinformation';
      //   $db2="tatcs.nonopenheart";
       $db='twcvs_www.patientinformation';
       $db2="twcvs_www.nonopenheart";
     }
       if($t=="1"){
     $sql= "SELECT count(*) as num FROM ".$db."   where isDeleted ='N' and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     }  else if($t=="2"){
           $sql= "SELECT count(*) as num FROM ".$db."    where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'') and patientOpDate>='$d' and patientOpDate < DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
         //    $sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
    } else {
          $sql= "SELECT  sum(item1+item2+item3+item4+item5+item6+item7+item8+item9+item10) as num FROM ".$db2."     where  STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') >= '".$d."'";
       $sql.= "    and STR_TO_DATE(CONCAT(qYear,'-',qMonth,'-01'), '%Y-%m-%d') < DATE_ADD('".$dEnd."', INTERVAL 1 MONTH)  ";
     }
     if($h=='1'){
       $sql.= " and patientHospital='".$this->session->userdata('hospital')."' ";
     }
     $sql.= "   and (patientSurgeon='".$this->session->userdata('userRealname')."' or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."')  ";
             
  
        return $this->db->query($sql);
   }

function query_executivesummarydetail_Resident($d1,$d2,$t){
     $d=$d1;
     $dEnd=$d2;
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
     
      $sql.= "   and (patientSurgeon='".$this->session->userdata('userRealname')."' or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."')  ";
      
        return $this->db->query($sql);
   }
function query_executivesummarydetail2_Resident($d1,$d2,$t){
       $d=$d1;
     $dEnd=$d2;
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
      $sql.= "   and (patientSurgeon='".$this->session->userdata('userRealname')."' or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."')  ";
      
        return $this->db->query($sql);
   }
   function query_executivesummarychild_Resident($d1,$d2,$t){
       $d=$d1;
     $dEnd=$d2;
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
     $sql.= " and (CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id2='53-02' or CongenitalProcedure_id3='53-02' or CongenitalProcedure_id4='53-02' or CongenitalProcedure_id5='53-02' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id2='53-04' or CongenitalProcedure_id3='53-04' or CongenitalProcedure_id4='53-04' or CongenitalProcedure_id5='53-04' ";   
     $sql.= " or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id2='53-09' or CongenitalProcedure_id3='53-09' or CongenitalProcedure_id4='53-09' or CongenitalProcedure_id5='53-09' ";  
     $sql.= " or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id2='53-10' or CongenitalProcedure_id3='53-10' or CongenitalProcedure_id4='53-10' or CongenitalProcedure_id5='53-10' ";  
     $sql.= " or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id2='53-11' or CongenitalProcedure_id3='53-11' or CongenitalProcedure_id4='53-11' or CongenitalProcedure_id5='53-11' ";    
       $sql.= " or CongenitalProcedure_id1 ='53-12' or CongenitalProcedure_id2='53-12' or CongenitalProcedure_id3='53-12' or CongenitalProcedure_id4='53-12' or CongenitalProcedure_id5='53-12' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="8"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id2='33-07' or CongenitalProcedure_id3='33-07' or CongenitalProcedure_id4='33-07' or CongenitalProcedure_id5='33-07' ";    
     $sql.= " or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id2='33-08' or CongenitalProcedure_id3='33-08' or CongenitalProcedure_id4='33-08' or CongenitalProcedure_id5='33-08' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-09' or CongenitalProcedure_id2='33-09' or CongenitalProcedure_id3='33-09' or CongenitalProcedure_id4='33-09' or CongenitalProcedure_id5='33-09' ";   
     $sql.= " or CongenitalProcedure_id1 ='33-13' or CongenitalProcedure_id2='33-13' or CongenitalProcedure_id3='33-13' or CongenitalProcedure_id4='33-13' or CongenitalProcedure_id5='33-13' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="10"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id2='51-01' or CongenitalProcedure_id3='51-01' or CongenitalProcedure_id4='51-01' or CongenitalProcedure_id5='51-01' ";    
     $sql.= " or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id2='51-02' or CongenitalProcedure_id3='51-02' or CongenitalProcedure_id4='51-02' or CongenitalProcedure_id5='51-02' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id2='51-03' or CongenitalProcedure_id3='51-03' or CongenitalProcedure_id4='51-03' or CongenitalProcedure_id5='51-03' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id2='51-04' or CongenitalProcedure_id3='51-04' or CongenitalProcedure_id4='51-04' or CongenitalProcedure_id5='51-04' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id2='51-05' or CongenitalProcedure_id3='51-05' or CongenitalProcedure_id4='51-05' or CongenitalProcedure_id5='51-05' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id2='51-06' or CongenitalProcedure_id3='51-06' or CongenitalProcedure_id4='51-06' or CongenitalProcedure_id5='51-06' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-07' or CongenitalProcedure_id2='51-07' or CongenitalProcedure_id3='51-07' or CongenitalProcedure_id4='51-07' or CongenitalProcedure_id5='51-07' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-08' or CongenitalProcedure_id2='51-08' or CongenitalProcedure_id3='51-08' or CongenitalProcedure_id4='51-08' or CongenitalProcedure_id5='51-08' ";   
     $sql.= " or CongenitalProcedure_id1 ='51-10' or CongenitalProcedure_id2='51-10' or CongenitalProcedure_id3='51-10' or CongenitalProcedure_id4='51-10' or CongenitalProcedure_id5='51-10' )";   
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="11"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="12"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="14"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="101"){
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
       $sql.= "   and (patientSurgeon='".$this->session->userdata('userRealname')."' or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."')  ";
      
        return $this->db->query($sql);
   }
   
    function query_executivesummarychildPure_Resident($d1,$d2,$t){
       $d=$d1;
     $dEnd=$d2;
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
    $sql.= " and (((CongenitalProcedure_id1 ='53-02' or CongenitalProcedure_id1 ='53-04' or CongenitalProcedure_id1 ='53-09' or CongenitalProcedure_id1 ='53-10' or CongenitalProcedure_id1 ='53-11' or CongenitalProcedure_id1 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='53-02' or CongenitalProcedure_id2 ='53-04' or CongenitalProcedure_id2 ='53-09' or CongenitalProcedure_id2 ='53-10' or CongenitalProcedure_id2 ='53-11' or CongenitalProcedure_id2 ='53-12')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='53-02' or CongenitalProcedure_id3 ='53-04' or CongenitalProcedure_id3 ='53-09' or CongenitalProcedure_id3 ='53-10' or CongenitalProcedure_id3 ='53-11' or CongenitalProcedure_id3 ='53-12')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='53-02' or CongenitalProcedure_id4 ='53-04' or CongenitalProcedure_id4 ='53-09' or CongenitalProcedure_id4 ='53-10' or CongenitalProcedure_id4 ='53-11' or CongenitalProcedure_id4 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='53-02' or CongenitalProcedure_id5 ='53-04' or CongenitalProcedure_id5 ='53-09' or CongenitalProcedure_id5 ='53-10' or CongenitalProcedure_id5 ='53-11' or CongenitalProcedure_id5 ='53-12') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="8"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '18-%' or CongenitalProcedure_id2 like '18-%' or CongenitalProcedure_id3 like '18-%' or CongenitalProcedure_id4 like '18-%' or CongenitalProcedure_id5 like '18-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '18-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '18-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '18-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="9"){
        $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
     $sql.= " and (((CongenitalProcedure_id1 ='33-07' or CongenitalProcedure_id1 ='33-08' or CongenitalProcedure_id1 ='33-09'  or CongenitalProcedure_id1 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='33-07' or CongenitalProcedure_id2 ='33-08' or CongenitalProcedure_id2 ='33-09'  or CongenitalProcedure_id2 ='33-13')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='33-07' or CongenitalProcedure_id3 ='33-08' or CongenitalProcedure_id3 ='33-09'  or CongenitalProcedure_id3='33-13')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='33-07' or CongenitalProcedure_id4 ='33-08' or CongenitalProcedure_id4 ='33-09'  or CongenitalProcedure_id4 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='33-07' or CongenitalProcedure_id5 ='33-08' or CongenitalProcedure_id5 ='33-09'  or CongenitalProcedure_id5 ='33-13') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="10"){
         $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
       $sql.= " and (((CongenitalProcedure_id1 ='51-01' or CongenitalProcedure_id1 ='51-02' or CongenitalProcedure_id1 ='51-03' or CongenitalProcedure_id1 ='51-04' or CongenitalProcedure_id1 ='51-05' or CongenitalProcedure_id1 ='51-06' or CongenitalProcedure_id1 ='51-07' or CongenitalProcedure_id1 ='51-08' or CongenitalProcedure_id1 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id2 ='51-01' or CongenitalProcedure_id2 ='51-02' or CongenitalProcedure_id2 ='51-03' or CongenitalProcedure_id2 ='51-04' or CongenitalProcedure_id2 ='51-05' or CongenitalProcedure_id2 ='51-06' or CongenitalProcedure_id2 ='51-07' or CongenitalProcedure_id2 ='51-08' or CongenitalProcedure_id2 ='51-10')  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id3 ='51-01' or CongenitalProcedure_id3 ='51-02' or CongenitalProcedure_id3 ='51-03' or CongenitalProcedure_id3 ='51-04' or CongenitalProcedure_id3 ='51-05' or CongenitalProcedure_id3 ='51-06' or CongenitalProcedure_id3 ='51-07' or CongenitalProcedure_id3 ='51-08' or CongenitalProcedure_id3 ='51-10')  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id4 ='51-01' or CongenitalProcedure_id4 ='51-02' or CongenitalProcedure_id4 ='51-03' or CongenitalProcedure_id4 ='51-04' or CongenitalProcedure_id4 ='51-05' or CongenitalProcedure_id4 ='51-06' or CongenitalProcedure_id4 ='51-07' or CongenitalProcedure_id4 ='51-08' or CongenitalProcedure_id4 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
       $sql.= " or ((CongenitalProcedure_id5 ='51-01' or CongenitalProcedure_id5 ='51-02' or CongenitalProcedure_id5 ='51-03' or CongenitalProcedure_id5 ='51-04' or CongenitalProcedure_id5 ='51-05' or CongenitalProcedure_id5 ='51-06' or CongenitalProcedure_id5 ='51-07' or CongenitalProcedure_id5 ='51-08' or CongenitalProcedure_id5 ='51-10') and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      }  else if($t=="11"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')  and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '55-%' or CongenitalProcedure_id2 like '55-%' or CongenitalProcedure_id3 like '55-%' or CongenitalProcedure_id4 like '55-%' or CongenitalProcedure_id5 like '55-%')";    
    $sql.= " and ((CongenitalProcedure_id1 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '55-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '55-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '55-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
      //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="12"){
           $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '45-%' or CongenitalProcedure_id2 like '45-%' or CongenitalProcedure_id3 like '45-%' or CongenitalProcedure_id4 like '45-%' or CongenitalProcedure_id5 like '45-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '45-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '45-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '45-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
      } else if($t=="13"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '52-%' or CongenitalProcedure_id2 like '52-%' or CongenitalProcedure_id3 like '52-%' or CongenitalProcedure_id4 like '52-%' or CongenitalProcedure_id5 like '52-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '52-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '52-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '52-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="14"){
            $sql= "SELECT count(*) as num FROM patientinformation   where isDeleted ='N' and (CongenitalDiagnosis1<>'' or CongenitalDiagnosis2<>'' or CongenitalDiagnosis3<>'' or CongenitalDiagnosis4<>'' or CongenitalDiagnosis5<>'' or CongenitalDiagnosisOthers<>'')   and patientOpDate>='$d' and patientOpDate< DATE_ADD('$dEnd', INTERVAL 1 MONTH)  ";
    $sql.= " and (CongenitalProcedure_id1 like '50-%' or CongenitalProcedure_id2 like '50-%' or CongenitalProcedure_id3 like '50-%' or CongenitalProcedure_id4 like '50-%' or CongenitalProcedure_id5 like '50-%')";    
     $sql.= " and ((CongenitalProcedure_id1 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id2 like '50-%'  and CongenitalProcedure_id1='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or ( CongenitalProcedure_id3 like '50-%'  and CongenitalProcedure_id2='' and CongenitalProcedure_id1='' and CongenitalProcedure_id4='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id4 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id1='' and CongenitalProcedure_id5='') ";
   $sql.= " or (CongenitalProcedure_id5 like '50-%' and CongenitalProcedure_id2='' and CongenitalProcedure_id3='' and CongenitalProcedure_id4='' and CongenitalProcedure_id1='') )";    
     //$sql.= " and ((CongenitalProcedure_id1<>'$exception_1' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) ";
   //  $sql.= " or (CongenitalProcedure_id1<>'$exception_2' and CongenitalProcedure_id2<>'' and CongenitalProcedure_id3<>'' and CongenitalProcedure_id4<>'' and CongenitalProcedure_id5<>'' ) )";
     } else if($t=="101"){
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
     $sql.= "   and (patientSurgeon='".$this->session->userdata('userRealname')."' or patientSurgeon2='".$this->session->userdata('userRealname')."' or patientSurgeon3='".$this->session->userdata('userRealname')."' or patientSurgeon4='".$this->session->userdata('userRealname')."')  ";
      
        return $this->db->query($sql);
   }
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */