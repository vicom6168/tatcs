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
"patientSurgeon"=>"主治醫師 1",
"patientSurgeon2"=>"主治醫師 2",
"patientSurgeon3"=>"住院醫師 1",
"patientSurgeon4"=>"住院醫師 2",
"ReOperation"=>"Re-operation",
"patientOpDate"=>"Operation date",
"AdmissionDate"=>"Admission date",
"DischargeDate"=>"Discharge date",
"LOS"=>"Length Of Stay",
"ICUAdmissionDate"=>"ICU Admission Date",
"ICUDischargeDate"=>"ICU Discharge Date",
"ICU_LOS"=>"ICU Length Of Stay",
"ExtubationDate"=>"Extubation Date",
"patientAssociatedDisease"=>"Associated Disease",
"diseaseType"=>"Disease Type",
"Procedure1"=>"Primary Procedure",
"Procedure2"=>"Secondary Procedure 1",
"Procedure3"=>"Secondary Procedure 2 ",
"Procedure4"=>"Secondary Procedure 3",
"Procedure5"=>"Secondary Procedure 4",
"Procedure_Others"=>"Procedure  Others",
"Diagnosis1"=>"Diagnosis 1",
"Diagnosis2"=>"Diagnosis 2",
"Diagnosis3"=>"Diagnosis 3",
"Diagnosis4"=>"Diagnosis 4",
"Diagnosis5"=>"Diagnosis 5",
"DiagnosisOthers"=>"Diagnosis Others",
"ProcedureTypeName1"=>"Primary Procedure TypeName",
"ProcedureTypeName2"=>"Secondary Procedure TypeName 1",
"ProcedureTypeName3"=>"Secondary Procedure TypeName 2",
"ProcedureTypeName4"=>"Secondary Procedure TypeName 3",
"ProcedureTypeName5"=>"Secondary Procedure TypeName 4",
"CancerLSHeight"=>"病史資料, 生活型態,Height (cm)",
"CancerLSWeight"=>"病史資料, 生活型態,Weight (kgw)",
"CancerLSSmokingAmount"=>"病史資料, 生活型態, 吸煙量",
"CancerLSSmokingYear"=>"病史資料, 生活型態, 吸煙年",
"CancerLSSmokingQuitYear"=>"病史資料, 生活型態, 戒煙年",
"CancerLSBetelNutsAmount"=>"病史資料, 生活型態, 檳榔量",
"CancerLSBetelNutsYear"=>"病史資料, 生活型態, 檳榔年",
"CancerLSBetelNutsQuitYear"=>"病史資料, 生活型態, 戒檳榔年",
"CancerLSDrinking"=>"病史資料, 生活型態, 飲酒狀況",
"Cancer_KPS"=>"病史資料, 生活型態, KPS",
"Cancer_ECOG"=>"病史資料, 生活型態, ECOG",
"CancerClinical_T"=>"病史資料,癌症分期, Clinical-T",
"CancerClinical_N"=>"病史資料,癌症分期, Clinical-N",
"CancerClinical_M"=>"病史資料,癌症分期, Clinical-M",
"CancerClinical_StageGroup"=>"病史資料,癌症分期, Clinical-Stage Group",
"CancerPathological_T"=>"病史資料,癌症分期, Pathological-T",
"CancerPathological_N"=>"病史資料,癌症分期, Pathological-N",
"CancerPathological_M"=>"病史資料,癌症分期, Pathological-M",
"CancerPathological_Stage"=>"病史資料,癌症分期, Pathological-Stage Group",
"CancerStage_memo"=>"病史資料,癌症分期, Note",
"CharlsonScore_MI"=>"病史資料, Charlson Score, Myocardial infarction",
"CharlsonScore_CHF"=>"病史資料, Charlson Score, CHF",
"CharlsonScore_PVD"=>"病史資料, Charlson Score,Peripheral vascular disease",
"CharlsonScore_CVA"=>"病史資料, Charlson Score,CVA",
"CharlsonScore_Dementia"=>"病史資料, Charlson Score,Dementia",
"CharlsonScore_COPD"=>"病史資料, Charlson Score,COPD",
"CharlsonScore_ConnectiveTissueDisease"=>"病史資料, Charlson Score,Connective tissue disease",
"CharlsonScore_PepticUlcerDisease"=>"病史資料, Charlson Score,Peptic ulcer disease",
"CharlsonScore_LiverDisease"=>"病史資料, Charlson Score,Liver disease",
"CharlsonScore_DiabetesMellitus"=>"病史資料, Charlson Score,Hormone Diabetes Mellitus",
"CharlsonScore_Hemiplegia"=>"病史資料, Charlson Score,Hemiplegia",
"CharlsonScore_CKD"=>"病史資料, Charlson Score,CKD",
"CharlsonScore_SolidTumor"=>"病史資料, Charlson Score,Solid Tumor",
"CharlsonScore_Leukemia"=>"病史資料, Charlson Score,Leukemia",
"CharlsonScore_Lymphoma"=>"病史資料, Charlson Score,Lymphoma",
"CharlsonScore_AIDS"=>"病史資料, Charlson Score,AIDS",
"CharlsonScore_Score"=>"病史資料, Charlson Score,CharlsonScore",
"outcomeDeath"=>"併發症及結果-是否死亡",
"outcomeDeathDate"=>"併發症及結果-死亡日期",
"outcomeDeathMemo"=>"併發症及結果-死亡說明",
"outcomeMortalityCheck"=>"併發症及結果-Operative Mortality",
"outcomeMortalityNote"=>"併發症及結果-Operative Mortality Note",
"outcomeInfectionCheck"=>"併發症及結果-Wound Infection",
"outcomeInfectionNote"=>"併發症及結果-Wound Infection Note",
"outcomeReoperationCheck"=>"併發症及結果-Reoperation For any reason",
"outcomeReoperationNote"=>"併發症及結果-Reoperation For any reason Note",
"outcomePneumoniaCheck"=>"併發症及結果-pneumonia",
"outcomePneumoniaNote"=>"併發症及結果-pneumonia Note",
"outcomeIntubationCheck"=>"併發症及結果-prolong intubation",
"outcomeIntubationNote"=>"併發症及結果-prolong intubation Note",
"outcomeHemothoraxCheck"=>"併發症及結果-hemothorax",
"outcomeHemothoraxNote"=>"併發症及結果-hemothorax Note",
"outcomePneumothoraxCheck"=>"併發症及結果-pneumothorax",
"outcomePneumothoraxNote"=>"併發症及結果-pneumothorax Note",
"outcomeBPFistulaCheck"=>"併發症及結果-B-P fistula",
"outcomeBPFistulaNote"=>"併發症及結果-B-P fistula Note",
"outcomeChylothoraxCheck"=>"併發症及結果-chylothorax",
"outcomeChylothoraxNote"=>"併發症及結果-chylothorax Note",
"outcomeAnastomosisCheck"=>"併發症及結果-anastomosis leakage",
"outcomeAnastomosisNote"=>"併發症及結果-anastomosis leakage Note",
"outcomeIleusCheck"=>"併發症及結果-ileus",
"outcomeIleusNote"=>"併發症及結果-ileus Note",
"outcomeAspirationCheck"=>"併發症及結果-aspiration",
"outcomeAspirationNote"=>"併發症及結果-aspiration Note",
"outcomeDysphagiaCheck"=>"併發症及結果-dysphagia",
"outcomeDysphagiaNote"=>"併發症及結果-dysphagia Note",
"outcomeArrthymiaCheck"=>"併發症及結果-Arrthymia",
"outcomeArrthymiaNote"=>"併發症及結果-Arrthymia Note",
"outcomeOthersCheck"=>"併發症及結果-Others",
"outcomeOthersNote"=>"併發症及結果-Others Note",
"outcomeStatus"=>"併發症及結果 出院結果"
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