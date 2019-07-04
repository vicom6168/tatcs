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
"patientDischargeDate"=>"Discharge date",
"patientCongenitalSurgery"=>"Congenital surgery (Any congenital cardiac diagnosis)",
"patientSyntaxScore"=>"SYNTAX Score",
"patientAssociatedDisease"=>"Other associated disease",
"patientBodyWeight"=>"Body Weight",
"patientSerumCreatinine"=>"Serum Creatinine",
"pastHistoryRenalImpairment"=>"Renal impairment",
"CcrberforOperation"=>"Ccr before operation",
"pastHistoryExtracardiacArteriopathy"=>"Extracardiac arteriopathy",
"pastHistoryPoorMobility"=>"Poor mobility",
"pastHistoryPreviousCardiacSurgery"=>"Previous cardiac surgery",
"pastHistoryChronicLungDisease"=>"Chronic lung disease",
"pastHistoryActiveEndocarditis"=>"Active endocarditis ",
"pastHistoryCriticalPreoperativeState"=>"Critical preoperative state ",
"pastHistoryDiabetesOnInsulin"=>"Diabetes on insulin",
"pastHistoryNYHA"=>"NYHA",
"pastHistoryCCSClass4Angina"=>"CCS class 4 angina",
"pastHistoryLVFunction"=>"LV function",
"pastHistoryRecentMI"=>"Recent MI",
"pastHistoryPulmonaryHypertension"=>"Pulmonary hypertension",
"pastHistoryUrgency"=>"Urgency",
"pastHistoryWeightOfTheIntervention"=>"Weight of the intervention ",
"pastHistorySurgeryThoracicAorta"=>"Surgery on thoracic aorta",
"euroScoreII"=>"EUROSCORE II",
"AdultDiagnosis1"=>"Adult Diagnosis 1",
"AdultDiagnosis2"=>"Adult Diagnosis 2",
"AdultDiagnosis3"=>"Adult Diagnosis 3",
"AdultDiagnosis4"=>"Adult Diagnosis 4",
"AdultDiagnosis5"=>"Adult Diagnosis 5",
"AdultDiagnosisOthers"=>"Adult Diagnosis Others",
"operationCABG"=>"CABG",
"operationLIMA"=>"LIMA",
"operationRIMA"=>"RIMA",
"operationRIMA_RadialA"=>"Radial artery",
"operationRIMA_GEA"=>"Gastroepiploic artery",
"operationVeinGraft"=>"Vein graft",
"operationCardiopulmonaryBypass"=>"Cardiopulmonary bypass",
"operationCardiacArrest"=>"Cardiac arrest",
"operationCABGMemo"=>"CABG 備註",
"operationAorticValve"=>"Aortic valve surgery",
"operationAVP"=>"Aortic valve plasty (AVP)",
"operationAorticValve_AVP"=>"Aortic Valve AVP Value",
"operationAorticValve_AVR"=>"Aortic valve replacement (AVR)",
"operationAVRSelect"=>"Aortic Valve AVR Value",
"operationAorticMemo"=>"Aortic valve surgery 備註",
"operationMitralValve"=>"Mitral valve surgery",
"Operation_MitralValve_MVP"=>"MVP",
"Operation_MitralValve_MVR"=>"MVR",
"operationMitralValveBentall"=>"Bentall’s Op",
"operationMVPRing"=>"Ring",
"operationMVPArtificialChord"=>"Artificial chordae",
"operationMVPAnnularPlication"=>";Annular plication",
"operationMVPLeafletResection"=>"Leaflet resection",
"operationMVPOthers"=>"Mitral valve surgery Others",
"operationMVR"=>"MVR",
"operationMVRMemo"=>"MVR 備註",
"operationTricuspidValve"=>"",
"Operation_TricuspidValve_TVP"=>"",
"Operation_TricuspidValve_TVR"=>"",
"operationTVPRing"=>"",
"operationTVPArtificialChord"=>"",
"operationTVPAnnularPlication"=>"",
"operationTVPLeafletResection"=>"",
"operationTVPOthers"=>"",
"operationTVR"=>"",
"operationTricuspidValveMemo"=>"",
"operationPulmonaryValve"=>"",
"Operation_PulmonaryValve_PVP"=>"",
"Operation_PulmonaryValve_PVR"=>"",
"operationPulmonaryValvePVP"=>"",
"operationPulmonaryValvePVR"=>"",
"operationPulmonaryValveMemo"=>"",
"operationArrythmiaSurgery"=>"Arrhythmia surgery:",
"operationMazebiatrialLesion"=>"Maze (biatrial lesion + PVI)",
"operationMazeLA"=>"LA Maze (no RA lesion)",
"operationMazePVIwithLAA"=>"PVI with LAA closure",
"operationMazePVIwithoutLAA"=>"PVI without LAA closure",
"operationMazeRA"=>"",
"operationMazeOthers"=>"Others",
"operationMazeEnergySource"=>"Energy source",
"operationMazeMemo"=>"Energy source 備註",
"operationAorticSurgery"=>"Aortic surgery",
"operationDissection"=>"Etiology:Dissection",
"operationAneurysm"=>"Etiology:Aneurysm",
"operationEtiologyOthers"=>"Etiology:Others",

"operationEtiologyCardiopulmonarBypass"=>"Cardiopulmonary bypass",
"operationAorticSurgeryCerebralProtection"=>"Cerebral protection",
"operationAorticSurgeryLocation"=>"Location",
"operationAorticSurgeryMethod"=>"Method",
"operationAorticSurgeryMemo"=>"Aortic surgery 備註",
"operationHeartTransplantation"=>"Heart transplant & Mechanical support",
"operationHeartTransplantationOP"=>"Operation_HeartTransplantation",
"operationHeartTransplantationLVAD"=>"Operation Hear:LVAD",
"operationHeartTransplantationRVAD"=>"Operation Hear:RVAD",
"operationHeartTransplantationMemo"=>"Heart transplant & Mechanical support 備註",
"operationOtherCardiacSurgery"=>"Other cardiac surgery",
"operationOtherCardiacSurgery1"=>"Repair of Post-MI free wall rupture",
"operationOtherCardiacSurgery2"=>"Repair of Post-MI ventricular septal defect (VSR)",
"operationOtherCardiacSurgery3"=>"Repair of traumatic cardiac rupture",
"operationOtherCardiacSurgery4"=>"Intracardiac tumor excision",
"operationOtherCardiacSurgery5"=>"Septal myectomy",
"operationOtherCardiacSurgery6"=>"Pericardiectomy",
"operationOtherCardiacSurgery7"=>"LV aneurysm surgery",
"operationOtherCardiacSurgery8"=>"Pulmonary embolectomy",
"operationOtherCardiacSurgery9"=>"Pulmonary endarterectomy",
"operationOtherCardiacSurgery10"=>"Cardiac Implantable Electronic Device lead insertion, replacement, or extraction",
"operationOtherCardiacSurgery11"=>"Others",
"operationOtherCardiacSurgeryMemo"=>"Other cardiac surgery 備註",
//"operationECMO"=>"",
//"operationECMOType"=>"",
//"operationECMOMemo"=>"",
//"operationLVAD"=>"",
//"operationCardiacTumor"=>"",
//"operationOthersOperation"=>"",
"CongenitalDiagnosis1"=>"Congenita lDiagnosis 1",
"CongenitalDiagnosis2"=>"Congenita lDiagnosis 2",
"CongenitalDiagnosis3"=>"Congenita lDiagnosis 3",
"CongenitalDiagnosis4"=>"Congenita lDiagnosis 4",
"CongenitalDiagnosis5"=>"Congenita lDiagnosis 5",
"CongenitalDiagnosisOthers"=>"Congenita lDiagnosis Others",
"CongenitalProcedure1"=>"Congenital Primary Procedure",
"CongenitalProcedure2"=>"Congenital Secondary Procedure 1",
"CongenitalProcedure3"=>"Congenital Secondary Procedure 2",
"CongenitalProcedure4"=>"Congenital Secondary Procedure 3",
"CongenitalProcedure5"=>"Congenital Secondary Procedure 4",
"CongenitalProcedureOthers"=>"Congenital Secondary Procedure Others",
"operationCongenitalBypass"=>"Bypass",
"operationCongenitalBypassCPBTime"=>"Total CPB time",
"operationCongenitalBypassAorticTime"=>"Aortic cross clump time",
"operationCongenitalBypassCirculatoryTime"=>"Circulatory arrest time",
"operationCongenitalBypassCardioplegia"=>"Cardioplegia",
"operationCongenitalBypassRACHS"=>"RACHS Class",
"operationCongenitalBypassSTS"=>"STS Mortality Category",
"operationCongenitalBypassMemo"=>"Bypass 備註",
//"outcomeDeath"=>"",
//"outcomeDeathDate"=>"",
//"outcomeDeathMemo"=>"",
//"outcomeWoundInfection"=>"",
//"outcomeWoundInfectionData"=>"",
//"outcomeWoundInfectionMemo"=>"",
//"outcomeBacteremia"=>"",
//"outcomeBacteremiaData"=>"",
//"outcomeBacteremiaMemo"=>"",
//"outcomeReentry"=>"",
//"outcomeReentryMemo"=>"",
//"outcomeDialysis"=>"",
//"outcomeDialysisDate"=>"",
//"outcomeDialysisMemo"=>"",
//"outcomeECMO"=>"",
//"outcomeECMOData"=>"",
//"outcomeECMOMemo"=>"",
//"outcomeIABP"=>"",
//"outcomeIABPMemo"=>"",
//"outcomeStroke"=>"",
//"outcomeStrokeMemo"=>"",
//"outcomeArrthymia"=>"",
//"outcomeArrthymiaData"=>"",
//"outcomeArrthymiaMemo"=>"",
"outcomeCheck1"=>"Operative Mortality",
"outcomeData1"=>"Operative Mortality Memo",
"outcomeCheck2"=>"Permanent Stroke",
"outcomeData2"=>"Permanent Stroke Memo",
"outcomeCheck3"=>"Renal Failure",
"outcomeData3"=>"Renal Failure Memo",
"outcomeCheck4"=>"Prolonged Ventilation > 24 hours",
"outcomeData4"=>"Prolonged Ventilation > 24 hours Memo",
"outcomeCheck5"=>"Deep Sternal Wound Infection",
"outcomeData5"=>"Deep Sternal Wound Infection Memo",
"outcomeCheck6"=>"Reoperation For any reason ",
"outcomeData6"=>"Reoperation For any reason  Memo",
"outcomeCheck7"=>"Major Morbidity or Operative Mortality",
"outcomeData7"=>"Major Morbidity or Operative Mortality Memo",
"outcomeCheck8"=>"LOS  from operation to hospital discharge",
"outcomeData8"=>"LOS  from operation to hospital discharge Memo",
"outcomeCheck9"=>"Short Stay: PLOS < 6 days",
"outcomeData9"=>"Short Stay: PLOS < 6 days Memo",
"outcomeCheck10"=>"Long Stay: PLOS >14 days",
"outcomeData10"=>"Long Stay: PLOS >14 days Memo",
"outcomeChildComplication1"=>"Arrhythmia requiring drug therapy",
"outcomeChildComplication2"=>"Arrhythmia requiring electrical cardioversion or defibrillation",
"outcomeChildComplication3"=>"Arrhythmia requiring Temporary pacemaker",
"outcomeChildComplication4"=>"Bleeding, requiring reoperation",
"outcomeChildComplication5"=>"Cardiac dysfunction resulting in low cardiac output",
"outcomeChildComplication6"=>"Cardiac failure (severe cardiac dysfunction)",
"outcomeChildComplication7"=>"Chylothorax",
"outcomeChildComplication8"=>"Endocarditis­postprocedural infective endocarditis",
"outcomeChildComplication9"=>"Intraventricular hemorrhage (IVH) > grade 2",
"outcomeChildComplication10"=>"Mechanical circulatory support (IABP, VAD, ECMO, or CPS)",
"outcomeChildComplication11"=>"Multi­System Organ Failure (MSOF) = Multi­Organ Dysfunction Syndrome (MODS",
"outcomeChildComplication12"=>"Neurological deficit diagnosed in the operating room, persisting at discharge or 91 days if patient is still in hospital.",
"outcomeChildComplication13"=>"Neurological deficit diagnosed in the operating room, not present at discharge",
"outcomeChildComplication14"=>"Neurological deficit that occurred after the operating room visit, persisting at discharge",
"outcomeChildComplication15"=>"Neurological deficit that occurred after the operating room visit, not present at discharge",
"outcomeChildComplication16"=>"Paralyzed diaphragm (possible phrenic nerve injury)",
"outcomeChildComplication17"=>"Pericardial Effusion, requiring drainage",
"outcomeChildComplication18"=>"Peripheral nerve injury persisting at discharge or 91 days if patient is still in hospital",
"outcomeChildComplication19"=>"Peripheral nerve injury not present at discharge or 91 days if patient is still in hospital",
"outcomeChildComplication20"=>"Postoperative/Postprocedural respiratory insufficiency requiring mechanical ventilatory support > 7 days",
"outcomeChildComplication21"=>"Postoperative/Postprocedural respiratory insufficiency requiring reintubation",
"outcomeChildComplication22"=>"Pulmonary vein obstruction",
"outcomeChildComplication23"=>"Renal failure ­ acute renal failure, Acute renal failure requiring dialysis at the time of hospital discharge or 91 days if patient is still in hospital",
"outcomeChildComplication24"=>"Renal failure ­ acute renal failure, Acute renal failure requiring temporary dialysis with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital",
"outcomeChildComplication25"=>"Renal failure ­ acute renal failure, Acute renal failure requiring temporary hemofiltration with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital",
"outcomeChildComplication26"=>"Respiratory failure, requiring tracheostomy",
"outcomeChildComplication27"=>"Seizure",
"outcomeChildComplication28"=>"Sepsis",
"outcomeChildComplication29"=>"Sternum left open, unplanned ",
"outcomeChildComplication30"=>"Stroke: Ischemic",
"outcomeChildComplication31"=>"Subdural Bleed",
"outcomeChildComplication32"=>"Systemic vein obstruction",
"outcomeChildComplication33"=>"Unplanned cardiac reoperation during the postoperative or postprocedural time period, exclusive of reoperation for bleeding",
"outcomeChildComplication34"=>"Vocal cord dysfunction (possible recurrent laryngeal nerve injury)",
"outcomeChildComplication35"=>"Wound infection­Mediastinitis",
"outcomeChildComplication36"=>"Wound infection­Superficial wound infection",
"outcomeChildCauseofDeath"=>"Primary Cause of Death",
"outcomeExtubationDate"=>"Extubation Date",
"outcomeStatus"=>" outcome Status(出院狀況)",
"LVADmachineLVAD"=>"Machine LVAD",
"LVADmachineRVAD"=>"Machine  RVAD",
"LVADIntermacsLevel"=>"NTERMACS level",
"LVADPeakVO2"=>"Peak VO2 ",
"LVADIVinotropicLarge14days"=>"IV inotropic medication ≥ 14 days",
"LVADIIABPSupportLarge7days"=>"IABP support ≥ 7 days",
"LVADPreOperativeVentlator"=>"Pre-operative ventilator support",

"LVADBUN"=>"BUN ",
"LVADAlbumin"=>"Albumin ",
"LVADINR"=>"INR ",
"LVADBilirubin"=>"Bilirubin ",
"LVADHeartRate"=>"Heart Rate",
"LVADCVPLevel"=>"CVP level ",
"LVADPulmonary"=>"Pulmonary capillary wedge pressure ",
"LVADLVEF"=>"LVEF ",
"LVADSevereRV"=>"Severe RV dysfunction",
"LVADSevereTR"=>"Severe TR"
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