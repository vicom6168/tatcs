<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<?php 
$beforeModifyarray =  (array) $beforeModify->row();
$afterModifyarray =  (array) $afterModify->row();
$standardModifyarray=array(
"patientHospital"=>"Hospital",
"patientSSN"=>"Patient ID",
"patientChartNumber"=>"Chart number",
"patientName"=>"Name",
"patientBirthday"=>"Birthday",
"patientAge"=>"Age",
"patientAgeUnit"=>"Age Unit",
"patientGender"=>"Gender",
"patientSurgeon"=>"Surgeon 1",
"patientSurgeon2"=>"Surgeon 2",
"patientSurgeon3"=>"Surgeon 3",
"patientSurgeon4"=>"Surgeon 4",
"patientReoperation"=>"Re-operation",
"patientOpDate"=>"Operation date",
"AdmissionDate"=>"Discharge date",
"DischargeDate"=>"Congenital surgery (Any congenital cardiac diagnosis)",
"LOS"=>"SYNTAX Score",
"ICUAdmissionDate"=>"Other associated disease",
"ICUDischargeDate"=>"Body Weight",
"ICU_LOS"=>"Serum Creatinine",
"ExtubationDate"=>"Renal impairment",
"patientDiagnosis"=>"Ccr before operation",
"patientAssociatedDisease"=>"Extracardiac arteriopathy",
"diseaseType"=>"Poor mobility",
"Procedure1"=>"Previous cardiac surgery",
"Procedure2"=>"Chronic lung disease",
"Procedure3"=>"Active endocarditis ",
"Procedure4"=>"Critical preoperative state ",
"Procedure5"=>"Diabetes on insulin",
"ProcedureOthers"=>"NYHA",
"Diagnosis1"=>"CCS class 4 angina",
"Diagnosis2"=>"LV function",
"Diagnosis3"=>"Recent MI",
"Diagnosis4"=>"Pulmonary hypertension",
"Diagnosis5"=>"Urgency",
"DiagnosisOthers"=>"Weight of the intervention ",
"ProcedureTypeName1"=>"Surgery on thoracic aorta",
"ProcedureTypeName2"=>"EUROSCORE II",
"ProcedureTypeName3"=>"Adult Diagnosis 1",
"ProcedureTypeName4"=>"Adult Diagnosis 2",
"ProcedureTypeName5"=>"Adult Diagnosis 3",
"CancerLSHeight"=>"Adult Diagnosis 4",
"CancerLSWeight"=>"Adult Diagnosis 5",
"CancerLSSmokingAmount"=>"Adult Diagnosis Others",
"CancerLSSmokingYear"=>"CABG",
"CancerLSSmokingQuitYear"=>"LIMA",
"CancerLSBetelNutsAmount"=>"RIMA",
"CancerLSBetelNutsYear"=>"Radial artery",
"CancerLSBetelNutsQuitYear"=>"Gastroepiploic artery",
"CancerLSDrinking"=>"Vein graft",
"CancerLSKPS_ECOG"=>"Cardiopulmonary bypass",
"CancerClinical_T"=>"Cardiac arrest",
"CancerClinical_N"=>"CABG 備註",
"CancerClinical_M"=>"Aortic valve surgery",
"CancerClinical_StageGroup"=>"Aortic valve plasty (AVP)",
"CancerPathological_T"=>"Aortic Valve AVP Value",
"CancerPathological_N"=>"Aortic valve replacement (AVR)",
"CancerPathological_M"=>"Aortic Valve AVR Value",
"CancerPathological_Stage"=>"Aortic valve surgery 備註",
"CancerStage_memo"=>"CancerStage_memo",
"CancerSysDxDate"=>"CancerSysDxDate",
"CancerRadiotherapy_initialDate"=>"CancerRadiotherapy_initialDate",
"CancerRadiotherapy_endDate"=>"CancerRadiotherapy_endDate",
"CancerChemotherapy_PreCT"=>"CancerChemotherapy_PreCT",
"CancerChemotherapy_CT"=>"CancerChemotherapy_CT",
"CancerChemotherapy_initialDate"=>"CancerChemotherapy_initialDate",
"CancerTargetTherapy_PreTx"=>"CancerTargetTherapy_PreTx",
"CancerTargetTherapy_Tx"=>"CancerTargetTherapy_Tx",
"CancerTargetTherapy_initialDate"=>"CancerTargetTherapy_initialDate",
"CancerHormoneTherapy_PreTx"=>"MVP",
"CancerHormoneTherapy_Tx"=>"MVP",
"CancerHormoneTherapy_initialDate"=>"MVP",
"CancerImmunotherapy_PreImm"=>"MVP",
"CancerImmunotherapy_Imm"=>"MVP",
"CancerImmunotherapy_initialDate"=>"MVP",
"outcomeDeath"=>"Mitral valve surgery",
"outcomeDeathDate"=>"MVP",
"outcomeDeathMemo"=>"MVR",
"outcomeMortalityCheck"=>"Bentall’s Op",
"outcomeMortalityNote"=>"Ring",
"outcomeInfectionCheck"=>"Artificial chordae",
"outcomeInfectionNote"=>";Annular plication",
"outcomeReoperationCheck"=>"Leaflet resection",
"outcomeReoperationNote"=>"Mitral valve surgery Others",
"outcomePneumoniaCheck"=>"MVR",
"outcomePneumoniaNote"=>"MVR 備註",
"outcomeIntubationCheck"=>"",
"outcomeIntubationNote"=>"",
"outcomeHemothoraxCheck"=>"",
"outcomeHemothoraxNote"=>"",
"outcomePneumothoraxCheck"=>"",
"outcomePneumothoraxNote"=>"",
"outcomeBPFistulaCheck"=>"",
"outcomeBPFistulaNote"=>"",
"outcomeChylothoraxCheck"=>"",
"outcomeChylothoraxNote"=>"",
"outcomeAnastomosisCheck"=>"",
"outcomeAnastomosisNote"=>"",
"outcomeIleusCheck"=>"",
"outcomeIleusNote"=>"",
"outcomeAspirationCheck"=>"",
"outcomeAspirationNote"=>"",
"outcomeDysphagiaCheck"=>"Arrhythmia surgery:",
"outcomeDysphagiaNote"=>"Maze (biatrial lesion + PVI)",
"outcomeArrthymiaCheck"=>"LA Maze (no RA lesion)",
"outcomeArrthymiaNote"=>"PVI with LAA closure",
"outcomeOthersNote"=>"PVI without LAA closure",
"outcomeStatus"=>""
);
$PrimaryCauseDeath=array(
"0"=>"",
"1"=>"Accident",
"2"=>"Acute or chronic cardiac failure",
"3"=>"Anoxic event",
"4"=>"Bleeding",
"5"=>"Non­cardiac bleeding",
"6"=>"Surgical bleeding (intra op or post op)",
"7"=>"Coronary artery event",
"8"=>"Gastrointestinal complications",
"9"=>"Liver failure",
"10"=>"Malignancy",
"11"=>"Mechanical circulatory support failure",
"12"=>"Neurologic event",
"13"=>"Pulmonary embolism",
"14"=>"Rejection",
"15"=>"Renal failure",
"16"=>"Respiratory failure",
"17"=>"Rhythm disturbance",
"18"=>"Suicide",
"19"=>"Surgical site infection",
"20"=>"Other major infection",
"21"=>"Sepsis",
"22"=>"Systemic embolism",
"23"=>"Inoperable Defect",
"24"=>"Other, specify"

); 
?>
<body>

<div class="container">   
  

    
    <div class="section">
        <div class="full">
            <div class="box">
                    
                <div class="content" style="width:750px;height:280px;overflow:auto;">
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                 <tr> 
                               <th nowrap>No.</th>
                               <th nowrap>Changed Data Field</th>
                               <th nowrap>before Modified</th>
                               <th nowrap>after Modified</th>
                            </tr> 
                               
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php if($t=="U") { ?>
                             <?php 
                             $i=1;
                               foreach($standardModifyarray  as $key => $value){
                                   
                            ?>
                                <?php if($beforeModifyarray[$key]!=$afterModifyarray[$key]) { ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $i++;?></td>
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $value;?></td>
                                 <td style="padding : 2px 8px;line-height : 20px;"><?php  
                                 if($key=="outcomeChildCauseofDeath"){
                                  if($beforeModifyarray[$key]!="")   echo   trim($PrimaryCauseDeath[$beforeModifyarray[$key]]);
                                 } else {
                                  echo trim($beforeModifyarray[$key]);
                                 }?></td>
                                 <td style="padding : 2px 8px;line-height : 20px;"><?php 
                                     if($key=="outcomeChildCauseofDeath"){
                                   if($afterModifyarray[$key]!="")  echo   trim($PrimaryCauseDeath[$afterModifyarray[$key]]);
                                 } else {
                                 echo trim($afterModifyarray[$key]);
                                 }
                             ?></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                               <?php } else { ?>
                                       <?php 
                             $i=1;
                               foreach($standardModifyarray  as $key => $value){
                                   
                            ?>
                                
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $i++;?></td>
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $value;?></td>
                                 <td style="padding : 2px 8px;line-height : 20px;">&nbsp;</td>
                                 <td style="padding : 2px 8px;line-height : 20px;"><?php 
                                           if($key=="outcomeChildCauseofDeath"){
                                   if($afterModifyarray[$key]!="") echo   trim($PrimaryCauseDeath[$afterModifyarray[$key]]);
                                 } else {
                                 echo trim($afterModifyarray[$key]);
                                 }
                                 ?></td>
                            </tr>
                               <?php }  ?>
                                  <?php }  ?>
                        </tbody> 
                    </table>
                    <br/>
                   
                </div>
            </div>
        </div>
    </div>
    
   
</div>

   


</body>

</html> 