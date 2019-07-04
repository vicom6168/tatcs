<?php

class Calreport_Model extends CI_Model {


	function __construct()
    {
        parent::__construct();
    }



	function update_category($d){
	    switch($d){
	          case "0":
                  $sql= "update patientinformation set associationCategory2006=''";
                break;
                  
            case "1":
                $sql= "update patientinformation set associationCategory2006='1'";
                $sql.= "  where CongenitalProcedure_id1!='' and CongenitalProcedure_id1 is not null and operationCongenitalBypass<>'Y'";
                
                break;
                
           case "2":
               $sql= "update patientinformation set associationCategory2006='2'";
               $sql.= "  where CongenitalProcedure_id1!='' and CongenitalProcedure_id1 is not null ";
               $sql.= "  and (CongenitalDiagnosis_id1 like '14-%' or CongenitalDiagnosis_id2 like '14-%'  or CongenitalDiagnosis_id3 like '14-%'  or CongenitalDiagnosis_id4 like '14-%'  or CongenitalDiagnosis_id5 like '14-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '16-%' or CongenitalDiagnosis_id2 like '16-%'  or CongenitalDiagnosis_id3 like '16-%'  or CongenitalDiagnosis_id4 like '16-%'  or CongenitalDiagnosis_id5 like '16-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '18-%' or CongenitalDiagnosis_id2 like '18-%'  or CongenitalDiagnosis_id3 like '18-%'  or CongenitalDiagnosis_id4 like '18-%'  or CongenitalDiagnosis_id5 like '18-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '23-%' or CongenitalDiagnosis_id2 like '23-%'  or CongenitalDiagnosis_id3 like '23-%'  or CongenitalDiagnosis_id4 like '23-%'  or CongenitalDiagnosis_id5 like '23-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '24-%' or CongenitalDiagnosis_id2 like '24-%'  or CongenitalDiagnosis_id3 like '24-%'  or CongenitalDiagnosis_id4 like '24-%'  or CongenitalDiagnosis_id5 like '24-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '26-%' or CongenitalDiagnosis_id2 like '26-%'  or CongenitalDiagnosis_id3 like '26-%'  or CongenitalDiagnosis_id4 like '26-%'  or CongenitalDiagnosis_id5 like '26-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '27-%' or CongenitalDiagnosis_id2 like '27-%'  or CongenitalDiagnosis_id3 like '27-%'  or CongenitalDiagnosis_id4 like '27-%'  or CongenitalDiagnosis_id5 like '27-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '31-%' or CongenitalDiagnosis_id2 like '31-%'  or CongenitalDiagnosis_id3 like '31-%'  or CongenitalDiagnosis_id4 like '31-%'  or CongenitalDiagnosis_id5 like '31-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '33-%' or CongenitalDiagnosis_id2 like '33-%'  or CongenitalDiagnosis_id3 like '33-%'  or CongenitalDiagnosis_id4 like '33-%'  or CongenitalDiagnosis_id5 like '33-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '36-%' or CongenitalDiagnosis_id2 like '36-%'  or CongenitalDiagnosis_id3 like '36-%'  or CongenitalDiagnosis_id4 like '36-%'  or CongenitalDiagnosis_id5 like '36-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '39-%' or CongenitalDiagnosis_id2 like '39-%'  or CongenitalDiagnosis_id3 like '39-%'  or CongenitalDiagnosis_id4 like '39-%'  or CongenitalDiagnosis_id5 like '39-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '42-%' or CongenitalDiagnosis_id2 like '42-%'  or CongenitalDiagnosis_id3 like '42-%'  or CongenitalDiagnosis_id4 like '42-%'  or CongenitalDiagnosis_id5 like '42-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '43-%' or CongenitalDiagnosis_id2 like '43-%'  or CongenitalDiagnosis_id3 like '43-%'  or CongenitalDiagnosis_id4 like '43-%'  or CongenitalDiagnosis_id5 like '43-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '44-%' or CongenitalDiagnosis_id2 like '44-%'  or CongenitalDiagnosis_id3 like '44-%'  or CongenitalDiagnosis_id4 like '44-%'  or CongenitalDiagnosis_id5 like '44-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '46-%' or CongenitalDiagnosis_id2 like '46-%'  or CongenitalDiagnosis_id3 like '46-%'  or CongenitalDiagnosis_id4 like '46-%'  or CongenitalDiagnosis_id5 like '46-%') ";
               
                break;
               
          case "3":
             $sql= "update patientinformation set associationCategory2006='3'";
             $sql.= "  where CongenitalProcedure_id1!='' and CongenitalProcedure_id1 is not null";
              
                break;
          case "4":
              $sql= "update patientinformation set associationCategory2006='4'";
              $sql.= "  where operationHeartTransplantationOP='Y'";
              
                break;
          case "5":
              $sql= "update patientinformation set associationCategory2006='5'";
              $sql.= " where operationHeartTransplantationLVAD='Y' or operationHeartTransplantationRVAD='Y'";
              
                break;
          case "6":
              $sql= "update patientinformation set associationCategory2006='6' ";
              $sql.= " where operationDissection='Y' ";
              
                break;
          case "7":
              $sql= "update patientinformation set associationCategory2006='7' ";
              $sql.= " where operationAneurysm='Y' ";
              
                break;
          case "8":
              $sql= "update patientinformation set associationCategory2006='8' ";
              $sql.= " where operationCABG='Y' and operationCardiopulmonaryBypass='Y' ";
              $sql.= " AND CAST(IF(operationLIMA='', '0', operationLIMA) AS UNSIGNED)+ ";
              $sql.= " CAST(IF(operationRIMA='', '0', operationRIMA) AS UNSIGNED) + ";
              $sql.= " CAST(IF(operationRIMA_RadialA='', '0', operationRIMA_RadialA)  AS UNSIGNED)+ ";
              $sql.= " CAST(IF(operationRIMA_GEA='', '0', operationRIMA_GEA)  AS UNSIGNED)+ ";
              $sql.= " CAST(IF(operationVeinGraft='', '0', operationVeinGraft)  AS UNSIGNED)=1 ";
              
                break;
          case "9":
                 $sql= "update patientinformation set associationCategory2006='9' ";
                 $sql.= " where operationCABG='Y' and operationCardiopulmonaryBypass='Y' ";
              
                break;
          case "10":
                $sql= "update patientinformation set associationCategory2006='10' ";
                $sql.= " where operationCABG='Y'  ";
                $sql.= " AND CAST(IF(operationLIMA='', '0', operationLIMA) AS UNSIGNED)+ ";
                $sql.= " CAST(IF(operationRIMA='', '0', operationRIMA) AS UNSIGNED) + ";
                $sql.= " CAST(IF(operationRIMA_RadialA='', '0', operationRIMA_RadialA)  AS UNSIGNED)+ ";
                $sql.= " CAST(IF(operationRIMA_GEA='', '0', operationRIMA_GEA)  AS UNSIGNED)+ ";
                $sql.= " CAST(IF(operationVeinGraft='', '0', operationVeinGraft)  AS UNSIGNED)=1 ";
              
                break;
          case "11":
              $sql= "update patientinformation set associationCategory2006='11' ";
              $sql.= " where operationCABG='Y' ";
              
                break;
          case "12":
              $sql= "update patientinformation set associationCategory2006='12' ";
              $sql.= " where (operationAorticValve_AVR='Y' and operationAVRSelect='Mechanical valve') or  ";
              $sql.= " (operationMitralValveBentall='Y'  and operationBentallSelect='Mechanical valve') or  ";
              $sql.= " (Operation_MitralValve_MVR='Y'  and operationMVR='Mechanical valve') or  ";
              $sql.= " (Operation_TricuspidValve_TVR='Y'  and operationTVR='Mechanical valve') or  ";
              $sql.= " (Operation_PulmonaryValve_PVR='Y'  and operationPulmonaryValvePVR='Mechanical') ";
              
                break;
          case "13":
              $sql= "update patientinformation set associationCategory2006='13' ";
              $sql.= " where operationAorticValve_AVR='Y' or operationMitralValveBentall='Y' or Operation_MitralValve_MVR='Y' or Operation_TricuspidValve_TVR='Y' or Operation_PulmonaryValve_PVR='Y' ";
              
                break;
          case "14":
              $sql= "update patientinformation set associationCategory2006='14' ";
              $sql.= " where operationAorticValve_AVP='Y' or Operation_MitralValve_MVP='Y' or Operation_TricuspidValve_TVP='Y' or Operation_PulmonaryValve_PVP='Y' ";
              
                break;
          case "15":
                $sql= "update patientinformation set associationCategory2006='15' ";
                $sql.= " where associationCategory2006=''";
                
                break;
          case "16":
              $sql= "update patientinformation set associationCategory2006='16' ";
              $sql.= " where patientID in (select * from (select patientID from patientinformation t1 ";
              $sql.= " join  ";
              $sql.= " (select patientChartNumber,patientOpDate from vascular where patientProcedure_id1='1-08-3' or patientProcedure_id2='1-08-3' or patientProcedure_id3='1-08-3' or patientProcedure_id4='1-08-3' or patientProcedure_id5='1-08-3') t2 on  ";
              $sql.= " t1.patientChartNumber=t2.patientChartNumber AND ";
              $sql.= " t1.patientOpDate=t2.patientOpDate) t3) ";
              
                break;
          case "17":
              $sql= "update patientinformation set associationCategory2006='17' ";
              $sql.= " where patientID in (select * from (select patientID from patientinformation t1 ";
              $sql.= " join ";
              $sql.= " (select patientChartNumber,patientOpDate from vascular where patientProcedure_id1 like '5-%' or patientProcedure_id2 like '5-%' or patientProcedure_id3 like '5-%' or patientProcedure_id4 like '5-%' or patientProcedure_id5 like '5-%') t2 on "; 
              $sql.= " t1.patientChartNumber=t2.patientChartNumber AND ";
              $sql.= " t1.patientOpDate=t2.patientOpDate) t3) ";
              
                break;
        
                
	    }
		// $sql= "SELECT *  FROM valve   where isDeleted='N'  order by valvecategory,valvecode";
	
		return $this->db->query($sql);

	}
    
        function update_category2019($d){
        switch($d){
              case "0":
                  $sql= "update patientinformation set associationCategory2019=''";
                break;
                  
            case "1":
                $sql= "update patientinformation set associationCategory2019='1'";
                $sql.= "  where operationHeartTransplantationOP='Y'";
                
                break;
                
           case "2":
               $sql= "update patientinformation set associationCategory2019='2'";
               $sql.= "  where CongenitalProcedure_id1!='' and CongenitalProcedure_id1 is not null and  operationCongenitalBypass<>'Y'";
               
                break;
               
          case "3":
             $sql= "update patientinformation set associationCategory2019='3'";
            $sql.= "  where CongenitalProcedure_id1!='' and CongenitalProcedure_id1 is not null ";
               $sql.= "  and (CongenitalDiagnosis_id1 like '14-%' or CongenitalDiagnosis_id2 like '14-%'  or CongenitalDiagnosis_id3 like '14-%'  or CongenitalDiagnosis_id4 like '14-%'  or CongenitalDiagnosis_id5 like '14-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '16-%' or CongenitalDiagnosis_id2 like '16-%'  or CongenitalDiagnosis_id3 like '16-%'  or CongenitalDiagnosis_id4 like '16-%'  or CongenitalDiagnosis_id5 like '16-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '18-%' or CongenitalDiagnosis_id2 like '18-%'  or CongenitalDiagnosis_id3 like '18-%'  or CongenitalDiagnosis_id4 like '18-%'  or CongenitalDiagnosis_id5 like '18-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '23-%' or CongenitalDiagnosis_id2 like '23-%'  or CongenitalDiagnosis_id3 like '23-%'  or CongenitalDiagnosis_id4 like '23-%'  or CongenitalDiagnosis_id5 like '23-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '24-%' or CongenitalDiagnosis_id2 like '24-%'  or CongenitalDiagnosis_id3 like '24-%'  or CongenitalDiagnosis_id4 like '24-%'  or CongenitalDiagnosis_id5 like '24-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '26-%' or CongenitalDiagnosis_id2 like '26-%'  or CongenitalDiagnosis_id3 like '26-%'  or CongenitalDiagnosis_id4 like '26-%'  or CongenitalDiagnosis_id5 like '26-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '27-%' or CongenitalDiagnosis_id2 like '27-%'  or CongenitalDiagnosis_id3 like '27-%'  or CongenitalDiagnosis_id4 like '27-%'  or CongenitalDiagnosis_id5 like '27-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '31-%' or CongenitalDiagnosis_id2 like '31-%'  or CongenitalDiagnosis_id3 like '31-%'  or CongenitalDiagnosis_id4 like '31-%'  or CongenitalDiagnosis_id5 like '31-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '33-%' or CongenitalDiagnosis_id2 like '33-%'  or CongenitalDiagnosis_id3 like '33-%'  or CongenitalDiagnosis_id4 like '33-%'  or CongenitalDiagnosis_id5 like '33-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '36-%' or CongenitalDiagnosis_id2 like '36-%'  or CongenitalDiagnosis_id3 like '36-%'  or CongenitalDiagnosis_id4 like '36-%'  or CongenitalDiagnosis_id5 like '36-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '39-%' or CongenitalDiagnosis_id2 like '39-%'  or CongenitalDiagnosis_id3 like '39-%'  or CongenitalDiagnosis_id4 like '39-%'  or CongenitalDiagnosis_id5 like '39-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '42-%' or CongenitalDiagnosis_id2 like '42-%'  or CongenitalDiagnosis_id3 like '42-%'  or CongenitalDiagnosis_id4 like '42-%'  or CongenitalDiagnosis_id5 like '42-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '43-%' or CongenitalDiagnosis_id2 like '43-%'  or CongenitalDiagnosis_id3 like '43-%'  or CongenitalDiagnosis_id4 like '43-%'  or CongenitalDiagnosis_id5 like '43-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '44-%' or CongenitalDiagnosis_id2 like '44-%'  or CongenitalDiagnosis_id3 like '44-%'  or CongenitalDiagnosis_id4 like '44-%'  or CongenitalDiagnosis_id5 like '44-%' ";
               $sql.= "  or CongenitalDiagnosis_id1 like '46-%' or CongenitalDiagnosis_id2 like '46-%'  or CongenitalDiagnosis_id3 like '46-%'  or CongenitalDiagnosis_id4 like '46-%'  or CongenitalDiagnosis_id5 like '46-%') ";
               
                break;
          case "4":
              $sql= "update patientinformation set associationCategory2019='4'";
              $sql.= "  where CongenitalProcedure1<>'' and CongenitalProcedure1 is not null";
              
                break;
          case "5":
              $sql= "update patientinformation set associationCategory2019='5'";
              $sql.= " where operationHeartTransplantationLVAD='Y' or operationHeartTransplantationRVAD='Y'";
              
                break;
          case "6":
             $sql= "update patientinformation set associationCategory2019='6' ";
             $sql.= " where operationAorticSurgery='Y' and operationDissection='Y'  and operationEtiologyCardiopulmonarBypass='Y'";
              
                break;
          case "7":
              $sql= "update patientinformation set associationCategory2019='7' ";
             $sql.= " where operationAorticSurgery='Y' and operationAneurysm='Y'  and operationEtiologyCardiopulmonarBypass='Y'";
              
                break;
          case "8":
              $sql= "update patientinformation set associationCategory2019='8' ";
              $sql.= " where operationCABG='Y' and operationCardiopulmonaryBypass='Y' ";
              $sql.= " AND CAST(IF(operationLIMA='', '0', operationLIMA) AS UNSIGNED)+ ";
              $sql.= " CAST(IF(operationRIMA='', '0', operationRIMA) AS UNSIGNED) + ";
              $sql.= " CAST(IF(operationRIMA_RadialA='', '0', operationRIMA_RadialA)  AS UNSIGNED)+ ";
              $sql.= " CAST(IF(operationRIMA_GEA='', '0', operationRIMA_GEA)  AS UNSIGNED)+ ";
              $sql.= " CAST(IF(operationVeinGraft='', '0', operationVeinGraft)  AS UNSIGNED)=1 ";
              
                break;
          case "9":
                 $sql= "update patientinformation set associationCategory2019='9' ";
                 $sql.= " where operationCABG='Y' and operationCardiopulmonaryBypass='Y' ";
              
                break;
          case "10":
                $sql= "update patientinformation set associationCategory2019='10' ";
                $sql.= " where operationCABG='Y'  ";
                $sql.= " AND CAST(IF(operationLIMA='', '0', operationLIMA) AS UNSIGNED)+ ";
                $sql.= " CAST(IF(operationRIMA='', '0', operationRIMA) AS UNSIGNED) + ";
                $sql.= " CAST(IF(operationRIMA_RadialA='', '0', operationRIMA_RadialA)  AS UNSIGNED)+ ";
                $sql.= " CAST(IF(operationRIMA_GEA='', '0', operationRIMA_GEA)  AS UNSIGNED)+ ";
                $sql.= " CAST(IF(operationVeinGraft='', '0', operationVeinGraft)  AS UNSIGNED)=1 ";
              
                break;
          case "11":
              $sql= "update patientinformation set associationCategory2019='11' ";
              $sql.= " where operationCABG='Y' ";
              
                break;
          case "12":
              $sql= "update patientinformation set associationCategory2019='12' ";
              $sql.= " where (operationAorticValve_AVR='Y' and operationAVRSelect='Mechanical valve') or  ";
              $sql.= " (operationMitralValveBentall='Y'  and operationBentallSelect='Mechanical valve') or  ";
              $sql.= " (Operation_MitralValve_MVR='Y'  and operationMVR='Mechanical valve') or  ";
              $sql.= " (Operation_TricuspidValve_TVR='Y'  and operationTVR='Mechanical valve') or  ";
              $sql.= " (Operation_PulmonaryValve_PVR='Y'  and operationPulmonaryValvePVR='Mechanical') ";
              
                break;
          case "13":
              $sql= "update patientinformation set associationCategory2019='13' ";
              $sql.= " where operationAorticValve_AVR='Y' or operationMitralValveBentall='Y' or Operation_MitralValve_MVR='Y' or Operation_TricuspidValve_TVR='Y' or Operation_PulmonaryValve_PVR='Y' ";
              
                break;
          case "14":
              $sql= "update patientinformation set associationCategory2019='14' ";
              $sql.= " where operationAorticValve_AVP='Y' or Operation_MitralValve_MVP='Y' or Operation_TricuspidValve_TVP='Y' or Operation_PulmonaryValve_PVP='Y' ";
              
                break;
          case "15":
             $sql= "update patientinformation set associationCategory2019='15' ";
             $sql.= " where operationOtherCardiacSurgery='Y' and (patientCardiopulmonaryBypass='1' or patientCardiopulmonaryBypass='2' or patientCardiopulmonaryBypass='3')";
                
                break;
          case "16":
             $sql= "update patientinformation set associationCategory2019='16' ";
             $sql.= " where operationAorticSurgery='Y' and operationDissection='Y'  and operationEtiologyCardiopulmonarBypass='N'";
              
                break;
          case "17":
             $sql= "update patientinformation set associationCategory2019='17' ";
             $sql.= " where operationAorticSurgery='Y' and operationAneurysm='Y'  and operationEtiologyCardiopulmonarBypass='N'";
              
                break;
           case "18":
              $sql= "update patientinformation set associationCategory2019='18' ";
             $sql.= " where operationOtherCardiacSurgery='Y' and patientCardiopulmonaryBypass='4'";
              
                break;
                
                   case "19":
              $sql= "update patientinformation set associationCategory2019='19' ";
              $sql.= " where patientID in (select * from (select patientID from patientinformation t1 ";
              $sql.= " join ";
              $sql.= " (select patientChartNumber,patientOpDate from vascular where patientProcedure_id1 = '8-01' or patientProcedure_id2  = '8-01'  or patientProcedure_id3 = '8-01'  or patientProcedure_id4 = '8-01'  or patientProcedure_id5 = '8-01' or  patientProcedure_id1 = '8-02' or patientProcedure_id2  = '8-02'  or patientProcedure_id3 = '8-02'  or patientProcedure_id4 = '8-02'  or patientProcedure_id5 = '8-02' ) t2 on "; 
              $sql.= " t1.patientChartNumber=t2.patientChartNumber AND ";
              $sql.= " t1.patientOpDate=t2.patientOpDate) t3) ";
              
                break;
                
           case "20":
           //跟2006報表的17相同
              $sql= "update patientinformation set associationCategory2019='20' ";
              $sql.= " where patientID in (select * from (select patientID from patientinformation t1 ";
              $sql.= " join ";
              $sql.= " (select patientChartNumber,patientOpDate from vascular where patientProcedure_id1 like '5-%' or patientProcedure_id2 like '5-%' or patientProcedure_id3 like '5-%' or patientProcedure_id4 like '5-%' or patientProcedure_id5 like '5-%') t2 on "; 
              $sql.= " t1.patientChartNumber=t2.patientChartNumber AND ";
              $sql.= " t1.patientOpDate=t2.patientOpDate) t3) ";
              
            break;
                
        }
        // $sql= "SELECT *  FROM valve   where isDeleted='N'  order by valvecategory,valvecode";
    
        return $this->db->query($sql);

    }
    
	function query_category($d){
	    $sql= "SELECT  count(patientID) as total from   patientinformation where  associationCategory2006=?";
	    return $this->db->query($sql, array($d));
	        }
	    
}

/* End of file News_Model.php */
/* Location: ./system/application/model/News_Model.php */