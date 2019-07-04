<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 <?php $c=$myContent->row();?>
  <?php
 $NYHA[0]='';
$NYHA[1]='I';
$NYHA[2]='II';
$NYHA[3]='III';
$NYHA[4]='IV';
$LV[0]='';
$LV[1]='good (LVEF &gt; 50%)';
$LV[2]='moderate (LVEF 31%-50%)';
$LV[3]='poor (LVEF 21%-30%) ';
$LV[4]='very poor (LVEF 20% or less)';
$Hypertension[0]='';
$Hypertension[1]='no';
$Hypertension[2]='moderate (PA systolic 31-55 mmHg) ';
$Hypertension[3]='severe (PA systolic &gt;55 mmHg) ';
$Urgency[0]='';
$Urgency[1]='elective';
$Urgency[2]='urgent';
$Urgency[3]='emergency';
$Urgency[4]='salvage';
$intervention[0]='';
$intervention[1]='isolated CABG';
$intervention[2]='single non CABG';
$intervention[3]='2 procedures';
$intervention[4]='3 procedures';
$Renalimpairment[0]='';
$Renalimpairment[1]='normal (CC &gt;85ml/min) ';
$Renalimpairment[2]='moderate (CC &gt;50 &amp; &lt;85)';
$Renalimpairment[3]='severe (CC &lt;50)';
$Renalimpairment[4]='dialysis (regardless of CC)';

 $html = 'EuroScore II  : '.$c->euroScoreII.'% &#13;&#10;&#13;&#10;';
$html .= 'Patient Related Factors &#13;&#10;';
$html .= 'Renal impairment:  '.(empty($c->pastHistoryRenalImpairment)?"":$Renalimpairment[$c->pastHistoryRenalImpairment] ).'&#13;&#10;';
$html .= 'Extracardiac arteriopathy:  '.$c->pastHistoryExtracardiacArteriopathy.'&#13;&#10;';
$html .= 'Poor mobility:  '.$c->pastHistoryExtracardiacArteriopathy.'&#13;&#10;';
$html .= 'Previous cardiac surgery:  '.$c->pastHistoryPreviousCardiacSurgery.'&#13;&#10;';
$html .= 'ExtracardiacChronic lung diseasearteriopathy:  '.$c->pastHistoryChronicLungDisease.'&#13;&#10;';
$html .= 'Active endocarditis :  '.$c->pastHistoryActiveEndocarditis.'&#13;&#10;';
$html .= 'Critical preoperative state :  '.$c->pastHistoryCriticalPreoperativeState.'&#13;&#10;';
$html .= 'Diabetes on insulin:  '.$c->pastHistoryDiabetesOnInsulin.'&#13;&#10;&#13;&#10;';

$html .= 'Cardiac Related Factors&#13;&#10;';
$html .= 'NYHA:  '.(empty($c->pastHistoryNYHA)?"":$NYHA[$c->pastHistoryNYHA]).'&#13;&#10;';
$html .= 'CCS class 4 angina:  '.$c->pastHistoryCCSClass4Angina.'&#13;&#10;';
$html .= 'LV function:  '.(empty($c->pastHistoryLVFunction)?"":$LV[$c->pastHistoryLVFunction]).'&#13;&#10;';
$html .= 'Recent MI:  '.$c->pastHistoryRecentMI.'&#13;&#10;';
$html .= 'Pulmonary hypertension:  '.(empty($c->pastHistoryPulmonaryHypertension)?"":$Hypertension[$c->pastHistoryPulmonaryHypertension]).'&#13;&#10;&#13;&#10;';

$html .= 'Operation Related Factors&#13;&#10;';
$html .= 'Urgency:  '.(empty($c->pastHistoryUrgency)?"":$Urgency[$c->pastHistoryUrgency]).'&#13;&#10;';
$html .= 'Weight of the intervention:  '.(empty($c->pastHistoryWeightOfTheIntervention)?"":$intervention[$c->pastHistoryWeightOfTheIntervention]).'&#13;&#10;';
$html .= 'Surgery on thoracic aorta:  '.$c->pastHistorySurgeryThoracicAorta.'&#13;&#10;&#13;&#10;';

//header顏色
if($c->patientCongenitalSurgery=='Y') 
$myColor="#E6F8E0";
else 
$myColor="#F8F7FA"; 

$genderImage=array(
""=>"",
"F"=>"/images/girl.png",
"M"=>"/images/boy.png"
);
 ?>
       <div class="section">
        <div class="full">
            <div class="box">
             
                <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>Patient Information</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                          
                             <tr>
                                <td>
                                     <table>
                                     <tr>
                                         <td bgcolor="<?php echo $myColor;?>">Chart number</td>
                                         <td><?php echo $c->patientChartNumber;?></td>
                                          <td bgcolor="<?php echo $myColor;?>">Name</td>
                                         <td><?php echo $c->patientName;?></td>
                                         <td bgcolor="<?php echo $myColor;?>">Gender</td>
                                         <td><img src="<?php echo $genderImage[$c->patientGender];?>"</td>
                                         <td bgcolor="<?php echo $myColor;?>">Operation Date:</td>
                                         <td><?php echo $c->patientOpDate;?></td>
                                         <td bgcolor="<?php echo $myColor;?>">Surgeon</td>
                                         <td><?php echo $c->patientSurgeon;?></td>
                                     </tr>
                                 </table>   
                                </td>
                            </tr>
                            
                            
                        </tbody> 
                    </table>
                </div>
            </div>
            
            
                
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
               
                </div>
                </div>
                <div class="title">
                    <h2>Patient Profiles</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>evaluation/patientProfiles" method="post" id="addPatient">
                     
                      <div class="line">
                            <label>Patient ID</label>
                            <input type="text" name="patientSSN" class="small" value="<?php echo $c->patientSSN;?>" />
                        </div>
                        
                        <div class="line">
                            <label><span style="color:red;">Chart number(必填)</span></label>
                            <input type="text" name="patientChartNumber" id="patientChartNumber" class="small" value="<?php echo $c->patientChartNumber;?>" />
                        </div>
                      
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="patientName" class="small" value="<?php echo $c->patientName;?>" />
                        </div>
                        
                         <div class="line">
                            <label><span style="color:red;">Birthday(必填)</span></label>
                             <input type="text" name="patientBirthday" id="patientBirthday"  class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientBirthday);?>"  onchange="calAge();"  onKeyUp="javascript:checkDate(this);" onBlur="javascript:checkDate_Format(this);" maxlength="10" />
                        </div>
                    
                        <div class="line">
                            <label>Age</label>
                            <input type="text" name="patientAge" id="patientAge" class="smallDisabled"  size=10 readonly  value="<?php echo $c->patientAge;?>" />
                            <span id="patientAgeLabel"><?php 
                            if($c->patientAgeUnit=="1") {
                                echo "Years";
                            }
elseif($c->patientAgeUnit=="2"){
    echo  "Months";
} else {
    echo   "Days";
} ?>
</span>
                            <input type="hidden" name="patientAgeUnit" id="patientAgeUnit" class="smallDisabled" readonly  value="<?php echo $c->patientAgeUnit;?>" />
                        </div>
                        
                        <div class="line">
                            <label>Gender</label>
                             <input type="radio" name="patientGender" id="patientGender_M"  value="M" <?php if($c->patientGender=='M') echo "checked";?> onclick="ShowCCCGender();CalcEuroII();"><label for="patientGender_M">Male&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="patientGender" id="patientGender_F"  value="F" <?php if($c->patientGender=='F') echo "checked";?> onclick="ShowCCCGender();CalcEuroII();"><label for="patientGender_F">Female&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                            <div class="line">
                            <label>Hospital</label>
                          
                            
                                    <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="patientHospital" id="patientHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>" <?php if($c->patientHospital==$HList[$i]['hospitalName']) echo "selected";?>><?php echo $HList[$i]['hospitalName'] ;?></option>
                                   <?php } ?>
                                   </select>
                        </div>
                         
                            <div class="line">
                            <label>Operation date</label>
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>" onchange="calAge();" />
                        </div>
                          <div class="line">
                            <label>Surgeon 1</label>
                          
                               <select name="patientSurgeon" id="patientSurgeon">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                              <div class="line">
                            <label>Discharge date</label>
                            <input type="text" name="patientDischargeDate" id="patientDischargeDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>" />
                        </div>
                         
                          <div class="line">
                            <label>Other associated disease</label>
                           <textarea name="patientAssociatedDisease" class="textarea" cols="55" rows="20"><?php echo $c->patientAssociatedDisease;?></textarea>
                        </div>
              
                               <div class="lineheaderbig">
                            <label>Patient Related Factors</label>
                            </div>
                                 <div class="line">
                            <label>Age  <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("in completed years. Some of the weighting \n for age is now incorporated into the renal impairment risk  \n  factor, so it is important that all risk factors  \n  are entered to give reliable risk estimations -  \n  see note [2]. Of over 20,000 patients in the  \n  EuroSCORE database, only 21 patients were aged  \n  over 90 - therefore the risk model may not be  \n  accurate in these patients. Please exercise clinical  \n discretion in interpreting the score.  \n The oldest patient in the EuroSCORE database was 95  \n - EuroSCORE II is not validated in patients  \n over this age.",{className:"info",autoHide: false});'></img>
                       </label>
                            <input type="text" name="myAGE"   id="myAGE"   class="smallDisabled" readonly   value="<?php echo $c->patientAge;?>" /> <?php 
                            if($c->patientAgeUnit=="1") {
                                echo "Years";
                            }
elseif($c->patientAgeUnit=="2"){
    echo  "Months";
} else {
    echo   "Days";
} ?>

                            </div>     

                             <div class="line">
                            <label>Weight</label>
                             <input type="text" class="small" name="patientBodyWeight" id="patientBodyWeight"  value="<?php echo $c->patientBodyWeight;?>"     onblur='javascript:calCCC();'>
                             
                           </div>
                              <div class="line">
                            <label>Serum Creatinine</label>
                             <input type="text" class="small" name="patientSerumCreatinine" id="patientSerumCreatinine"  value="<?php echo $c->patientSerumCreatinine;?>"     onblur='javascript:calCCC();'>
                             
                           </div>
                             <div class="line">
                            <label>Ccr before operation  </label>
                             <input type="text" class="smallDisabled" readonly  name="CcrberforOperation" id="CcrberforOperation"  value="<?php echo $c->CcrberforOperation;?>">
                             
                           </div>
                                                   <div class="line">
                            <label>Renal impairment <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("there are now 3 categories based on creatinine  \n clearance calculated using Cockcroft-Gault formula.  \n Unlike serum creatinine in the old EuroSCORE model,  \n some of the weighting for age is directly \n  incorporated into this factor, as age is a component of \n creatinine clearance. The 3 categories are:",{className:"info",autoHide: false});'></img>
                           </label>
                           <div class="bigline">
                               <select name="pastHistoryRenalImpairment" id="pastHistoryRenalImpairment"  onchange="CalcEuroII();">
                                   <option value=""></option>
                                   <option value="1"  <?php if($c->pastHistoryRenalImpairment=='1') echo "selected";?>>normal (CC &gt;85ml/min) </option>
                                   <option value="2"  <?php if($c->pastHistoryRenalImpairment=='2') echo "selected";?>>moderate (CC &gt;50 &amp; &lt;85)</option>
                                   <option value="3"  <?php if($c->pastHistoryRenalImpairment=='3') echo "selected";?>>severe (CC &lt;50)</option>
                                   <option value="4"  <?php if($c->pastHistoryRenalImpairment=='4') echo "selected";?>>dialysis (regardless of CC)</option>
                               </select>
                           </div>
                          </div>
                        <div class="line">
                            <label>Extracardiac arteriopathy<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" id="HelpExtracardiacArteriopathy" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("one or more of the following claudication carotid occlusion  or >50% \n stenosis amputation for arterial disease previous or planned intervention \n on the abdominal aorta, limb arteries or carotids ",{className:"info",autoHide: false});'></img></label>
                            <input type="radio" name="pastHistoryExtracardiacArteriopathy" id="pastHistoryExtracardiacArteriopathy_N"  value="N" <?php if($c->pastHistoryExtracardiacArteriopathy=='N') echo "checked";?>  onclick="CalcEuroII();"><label for="pastHistoryExtracardiacArteriopathy_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryExtracardiacArteriopathy" id="pastHistoryExtracardiacArteriopathy_Y"  value="Y" <?php if($c->pastHistoryExtracardiacArteriopathy=='Y') echo "checked";?>  onclick="CalcEuroII();"><label for="pastHistoryExtracardiacArteriopathy_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                            </div>
                      
                        <div class="line">
                            <label>Poor mobility<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("severe impairment of mobility secondary to musculoskeletal \n or neurological dysfunction",{className:"info",autoHide: false});'></img></label>
                             <input type="radio" name="pastHistoryPoorMobility" id="pastHistoryPoorMobility_N"  value="N" <?php if($c->pastHistoryPoorMobility=='N') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryPoorMobility_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryPoorMobility" id="pastHistoryPoorMobility_Y"  value="Y" <?php if($c->pastHistoryPoorMobility=='Y') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryPoorMobility_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                        </div>
                        
                       <div class="line">
                            <label>Previous cardiac surgery</label>
                           <input type="radio" name="pastHistoryPreviousCardiacSurgery" id="pastHistoryPreviousCardiacSurgery_N"  value="N" <?php if($c->pastHistoryPreviousCardiacSurgery=='N') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryPreviousCardiacSurgery_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryPreviousCardiacSurgery" id="pastHistoryPreviousCardiacSurgery_Y"  value="Y" <?php if($c->pastHistoryPreviousCardiacSurgery=='Y') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryPreviousCardiacSurgery_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                      </div>
                    
                      <div class="line">
                            <label>Chronic lung disease<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("long term use of bronchodilators or \n steroids for lung disease",{className:"info",autoHide: false});'></img></label>
                           <input type="radio" name="pastHistoryChronicLungDisease" id="pastHistoryChronicLungDisease_N"  value="N" <?php if($c->pastHistoryChronicLungDisease=='N') echo "checked";?>  onclick="CalcEuroII();"><label for="pastHistoryChronicLungDisease_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryChronicLungDisease" id="pastHistoryChronicLungDisease_Y"  value="Y" <?php if($c->pastHistoryChronicLungDisease=='Y') echo "checked";?>  onclick="CalcEuroII();"><label for="pastHistoryChronicLungDisease_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                           </div>
                    
                          <div class="line">
                            <label>Active endocarditis <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("patient still on antibiotic treatment \n for endocarditis at time of surgery ",{className:"info",autoHide: false});'></img></label>
                             <input type="radio" name="pastHistoryActiveEndocarditis" id="pastHistoryActiveEndocarditis_N"  value="N" <?php if($c->pastHistoryActiveEndocarditis=='N') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryActiveEndocarditis_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryActiveEndocarditis" id="pastHistoryActiveEndocarditis_Y"  value="Y" <?php if($c->pastHistoryActiveEndocarditis=='Y') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryActiveEndocarditis_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                          </div>
                        
                               <div class="line">
                            <label>Critical preoperative state <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("ventricular tachycardia or ventricular fibrillation or \n aborted sudden death, preoperative cardiac massage,  \n preoperative ventilation before anaesthetic room,  \n preoperative inotropes or IABP, preoperative  \n acute renal failure (anuria or oliguria <10ml/hr)",{className:"info",autoHide: false});'></img></label>
                             <input type="radio" name="pastHistoryCriticalPreoperativeState" id="pastHistoryCriticalPreoperativeState_N"  value="N" <?php if($c->pastHistoryCriticalPreoperativeState=='N') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryCriticalPreoperativeState_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryCriticalPreoperativeState" id="pastHistoryCriticalPreoperativeState_Y"  value="Y" <?php if($c->pastHistoryCriticalPreoperativeState=='Y') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryCriticalPreoperativeState_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                            </div>
                        
                               <div class="line">
                            <label>Diabetes on insulin</label>
                             <input type="radio" name="pastHistoryDiabetesOnInsulin" id="pastHistoryDiabetesOnInsulin_N"  value="N" <?php if($c->pastHistoryDiabetesOnInsulin=='N') echo "checked";?>     onclick="CalcEuroII();"><label for="pastHistoryDiabetesOnInsulin_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryDiabetesOnInsulin" id="pastHistoryDiabetesOnInsulin_Y"  value="Y" <?php if($c->pastHistoryDiabetesOnInsulin=='Y') echo "checked";?>     onclick="CalcEuroII();"><label for="pastHistoryDiabetesOnInsulin_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                            </div>
                              <div class="lineheaderbig">
                            <label>Cardiac Related Factors </label>
                            </div>
                               <div class="line">
                            <label>NYHA</label>
                              <select name="pastHistoryNYHA" id="pastHistoryNYHA"   onchange="CalcEuroII();">
                                  <option value=""></option>
                                   <option value="1"  <?php if($c->pastHistoryNYHA=='1') echo "selected";?>>I</option>
                                   <option value="2"  <?php if($c->pastHistoryNYHA=='2') echo "selected";?>>II</option>
                                   <option value="3"  <?php if($c->pastHistoryNYHA=='3') echo "selected";?>>III</option>
                                   <option value="4"  <?php if($c->pastHistoryNYHA=='4') echo "selected";?>>IV</option>
                               </select>
                            
                            </div>
                               <div class="line">
                            <label>CCS class 4 angina<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("angina at rest ",{className:"info",autoHide: false});'></img></label>
                             <input type="radio" name="pastHistoryCCSClass4Angina" id="pastHistoryCCSClass4Angina_N"  value="N" <?php if($c->pastHistoryCCSClass4Angina=='N') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryCCSClass4Angina_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryCCSClass4Angina" id="pastHistoryCCSClass4Angina_Y"  value="Y" <?php if($c->pastHistoryCCSClass4Angina=='Y') echo "checked";?>    onclick="CalcEuroII();"><label for="pastHistoryCCSClass4Angina_Y">yes&nbsp;&nbsp;</label>  &nbsp; 
                            </div>
                               <div class="line">
                            <label>LV function</label>
                            <select name="pastHistoryLVFunction" id="pastHistoryLVFunction"   onchange="CalcEuroII();">
                                   <option value=""></option>
                                   <option value="1"  <?php if($c->pastHistoryLVFunction=='1') echo "selected";?>>good (LVEF &gt; 50%)</option>
                                   <option value="2"  <?php if($c->pastHistoryLVFunction=='2') echo "selected";?>>moderate (LVEF 31%-50%)</option>
                                   <option value="3"  <?php if($c->pastHistoryLVFunction=='3') echo "selected";?>>poor (LVEF 21%-30%) </option>
                                   <option value="4"  <?php if($c->pastHistoryLVFunction=='4') echo "selected";?>>very poor (LVEF 20% or less)</option>
                               </select>
                            
                           </div>
                               <div class="line">
                            <label>Recent MI<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'   onmouseover='$(this).notify("myocardial infarction within 90 days",{className:"info",autoHide: false});'></img></label>
                             <input type="radio" name="pastHistoryRecentMI" id="pastHistoryRecentMI_N"  value="N" <?php if($c->pastHistoryRecentMI=='N') echo "checked";?>   onclick="CalcEuroII();"><label for="pastHistoryRecentMI_N">no&nbsp;&nbsp;</label>   &nbsp; 
                            <input type="radio" name="pastHistoryRecentMI" id="pastHistoryRecentMI_Y"  value="Y" <?php if($c->pastHistoryRecentMI=='Y') echo "checked";?>   onclick="CalcEuroII();"><label for="pastHistoryRecentMI_Y">yes&nbsp;&nbsp; </label> &nbsp; 
                            </div>
                               <div class="line">
                            <label>Pulmonary hypertension<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("systolic pulmonary artery pressure, now in 2 classes \n •moderate: PA systolic pressure (31-55 mm Hg) \n •severe: PA systolic pressure (>55mm Hg)",{className:"info",autoHide: false});'></img>
                            </label>
                              <select name="pastHistoryPulmonaryHypertension" id="pastHistoryPulmonaryHypertension"   onchange="CalcEuroII();">
                                  <option value=""></option>
                                   <option value="1"  <?php if($c->pastHistoryPulmonaryHypertension=='1') echo "selected";?>>no</option>
                                   <option value="2"  <?php if($c->pastHistoryPulmonaryHypertension=='2') echo "selected";?>>moderate (PA systolic 31-55 mmHg) </option>
                                   <option value="3"  <?php if($c->pastHistoryPulmonaryHypertension=='3') echo "selected";?>>severe (PA systolic &gt;55 mmHg) </option>
                                    </select>
                                    </div>
                              <div class="lineheaderbig">
                            <label>Operation Related Factors </label>
                            </div>
                               <div class="line">
                            <label>Urgency   <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("now four classes:\n •elective : routine admission for operation. \n •urgent: patients who have not been electively admitted \n for operation but who require intervention or \n surgery on the current admission for medical reasons. \n These patients cannot be sent home without a definitive procedure. \n •emergency: operation before the beginning of \n the next working day after decision to operate.\n •salvage: patients requiring cardiopulmonary resuscitation \n (external cardiac massage) en route to the operating theatre or \n  prior to induction of anaesthesia. \n This does not include cardiopulmonary resuscitation following \n induction of anaesthesia",{className:"info",autoHide: false});'></img>
                        </label>
                              <select name="pastHistoryUrgency" id="pastHistoryUrgency"  onchange="CalcEuroII();">
                                  <option value=""></option>
                                   <option value="1"  <?php if($c->pastHistoryUrgency=='1') echo "selected";?>>elective</option>
                                   <option value="2"  <?php if($c->pastHistoryUrgency=='2') echo "selected";?>>urgent</option>
                                   <option value="3"  <?php if($c->pastHistoryUrgency=='3') echo "selected";?>>emergency</option>
                                   <option value="4"  <?php if($c->pastHistoryUrgency=='4') echo "selected";?>>salvage</option>
                               </select>
                              </div>
                               <div class="line">
                            <label>Weight of the intervention  <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");' onmouseover='$(this).notify(" include major interventions on the heart such as\n •CABG \n •valve repair or replacement \n •replacement of part of the aorta \n •repair of a structural defect \n •maze procedure \n •resection of  a cardiac tumour",{className:"info",autoHide: false});'></img>
                             </label>
                               <select name="pastHistoryWeightOfTheIntervention" id="pastHistoryWeightOfTheIntervention"   onchange="CalcEuroII();">
                                   <option value=""></option>
                                   <option value="1"  <?php if($c->pastHistoryWeightOfTheIntervention=='1') echo "selected";?>>isolated CABG</option>
                                   <option value="2"  <?php if($c->pastHistoryWeightOfTheIntervention=='2') echo "selected";?>>single non CABG</option>
                                   <option value="3"  <?php if($c->pastHistoryWeightOfTheIntervention=='3') echo "selected";?>>2 procedures</option>
                                   <option value="4"  <?php if($c->pastHistoryWeightOfTheIntervention=='4') echo "selected";?>>3 procedures</option>
                               </select>
                              </div>
                               <div class="line">
                            <label>Surgery on thoracic aorta</label>
                             <input type="radio"  class="radio"  name="pastHistorySurgeryThoracicAorta" id="pastHistorySurgeryThoracicAorta_N"  value="N" <?php if($c->pastHistorySurgeryThoracicAorta=='N') echo "checked";?>  onclick="CalcEuroII();"><label for="pastHistorySurgeryThoracicAorta_N">no&nbsp;&nbsp; </label> &nbsp; 
                            <input type="radio" class="radio" name="pastHistorySurgeryThoracicAorta" id="pastHistorySurgeryThoracicAorta_Y"  value="Y" <?php if($c->pastHistorySurgeryThoracicAorta=='Y') echo "checked";?>  onclick="CalcEuroII();"><label for="pastHistorySurgeryThoracicAorta_Y">yes&nbsp;&nbsp;</label> &nbsp; 
                             </div>
                               <div class="line">
                            <label>EUROSCORE II</label>
                            <input type="text" name="euroScoreII"   id="euroScoreII"   class="smallDisabled" readonly   value="<?php echo $c->euroScoreII;?>" />%
                           </div>
                         <div class="line">
                            <label></label>
                           <textarea id="EuroScoreCopyArea" class="textarea" cols="55" rows="20"><?php echo $html;?></textarea>
                           <button type="button" id="EuroCopyButton" class="blue medium" onclick="javascript:copyToClipboard();"><span>Copy</span></button>
                        </div>
                            
                         
                    <div class="line button">
                           
                              <button type="button" id="sendFrom" class="blue medium" onclick="sentForm()"><span>送出</span></button>
                            <button  class="orange medium" id="transButton" onclick="javascript:if(confirm('資料轉入後會再術前評估中資料刪除?')){ evaluationTrans('<?php echo $c->patientID;?>');return false;}" ><span>轉入病患資料</span></button>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div>
     
        
      
                
        </div>
      
        
  
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>

$("#divdeps1").dialog({
    autoOpen: false,
    show: 'slide',
    resizable: false,
    position: 'top',
    stack: true,
    height: '100',
    width: '500',
    modal: false
});


function cccOpen(){
 
  $("#divdeps").show('slow');
}
 $(document).ready(function() {
  
     afterUpdate('<?php echo $page;?>','<?php echo $msg;?>');
    $( "#patientOpDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientOpDate" ).val('<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>');
    $( "#patientDischargeDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientDischargeDate" ).val('<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>');
    
    
    
 });    
   
 function afterUpdate(p,m){
     callHideShow(p);
     if(m!='')    $.notify(m, "info");
 }
 function callHideShow(t){
     $('#divPatientProfiles').show();
  
     
 }
 function parseDate(str) {
    var mdy = str.split('-');
    var myDate=new Date(mdy[0], mdy[1]-1, mdy[2]);;
   
    return myDate;
}

 function calAge200(){
    
     if($( "#patientOpDate" ).val()!='' && $( "#patientBirthday" ).val()!=''){
         var age=(Math.floor(parseDate($( "#patientOpDate" ).val())- parseDate($( "#patientBirthday" ).val()))/(1000*60*60*24*365.25)).toFixed(1);
         $( "#patientAge" ).val(age);
         $( "#CCCAge" ).html(age);
     }
 }
  function calAge(){
    
     if($( "#patientOpDate" ).val()!='' && $( "#patientBirthday" ).val()!=''){
        // var age=(Math.floor(parseDate($( "#patientOpDate" ).val())- parseDate($( "#patientBirthday" ).val()))/(1000*60*60*24*365.25)).toFixed(1);
         var age=(Math.floor(parseDate($( "#patientOpDate" ).val())- parseDate($( "#patientBirthday" ).val()))/(1000*60*60*24)).toFixed(1);
    //     alert(age);
         if(parseInt(age)<31){ 
         $( "#patientAge" ).val((age/1).toFixed(0));
         $( "#CCCAge" ).html((age/1).toFixed(1)+'Days');
         $("#patientAgeUnit").val('3');
         $("#patientAgeLabel").html('Days');
    //     alert('Days');
         } else if (parseInt(age)<365) {
         $( "#patientAge" ).val((age/30.5).toFixed(1));
         $( "#CCCAge" ).html(age+'Months');
         $("#patientAgeUnit").val('2');
         $("#patientAgeLabel").html('Months');
      //   alert('Months');
         } else {
             $( "#patientAge" ).val(Math.floor(age/365.25).toFixed(1));
         $( "#CCCAge" ).html(age+'Years');
         $("#patientAgeUnit").val('1');
         $("#patientAgeLabel").html('Years');
      //   alert('Years');
         }
     }
 }
 function calCCC(){
   var age=parseFloat($( "#patientAge" ).val());
   var patientSerumCreatinine=parseFloat($( "#patientSerumCreatinine" ).val());
   var patientWeight=parseFloat($( "#patientBodyWeight" ).val());
   var value="0";
   var error="0";
   var errorString="";
   if($( "#patientAge" ).val()=='' ){
       error="1";
       errorString+="病人沒有年齡\n";
   }
     if($( "#patientBodyWeight" ).val()=='' ){
       error="1";
       errorString+="病人未填Body Weight\n";
   }
    if($( "#patientSerumCreatinine" ).val()=='' ){
       error="1";
       errorString+="病人未填Serum Creatinine\n";
   }
    if($('input[name=patientGender]:checked').val()!="M" && $('input[name=patientGender]:checked').val()!="F" ){
       error="1";
       errorString+="病人未選取性別\n";
   }
   if(error=="1"){
   $("#CcrberforOperation").notify(errorString, "error");
   } else {
     if($( "#patientAge" ).val()!='' && $( "#patientBodyWeight" ).val()!='' && $( "#patientSerumCreatinine" ).val()!=''  && ($('input[name=patientGender]:checked').val()=="M" || $('input[name=patientGender]:checked').val()=="F")){
         if($('input[name=patientGender]:checked').val()=="M"){
             value=((140 - age)*patientWeight)/(72*patientSerumCreatinine);
         } else {
               value=(((140 - age)*patientWeight)/(72*patientSerumCreatinine))*0.85;
         }
       }
       }
       value=Math.round(value * 10) / 10;
      $("#CcrberforOperation").val(value);
 }
 
 function CalcEuroII(){
     var GenderScore=0;
     var RenalImpairmentScore=0;
     var ExtracardiacArteriopathyScore=0;
     var PoorMobilityScore=0;
     var PreviousCardiacSurgeryScore=0;
     var ChronicLungDiseaseScore=0;
     var ActiveEndocarditisScore=0;
     var CriticalPreoperativeStateScore=0;
     var DiabetesOnInsulinScore=0;
     var NYHAScore=0;
     var CCSClass4AnginaScore=0;
     var LVFunctionScore=0;
     var RecentMIScore=0;
     var PulmonaryHypertensionScore=0;
     var UrgencyScore=0;
     var WeightOfTheInterventionScore=0;
     var SurgeryThoracicAortaScore=0;
     var AgeScore=0;
     var patientAge='';
     var result=0;
     if(1==1 || ($('input[name=patientGender]:checked').val()=="M" || $('input[name=patientGender]:checked').val()=="F") 
     && ($('#pastHistoryRenalImpairment').val()!="")
     && ($('input[name=pastHistoryExtracardiacArteriopathy]:checked').val()=="N" || $('input[name=pastHistoryExtracardiacArteriopathy]:checked').val()=="Y")
      && ($('input[name=pastHistoryPoorMobility]:checked').val()=="N" || $('input[name=pastHistoryPoorMobility]:checked').val()=="Y")
      && ($('input[name=pastHistoryPreviousCardiacSurgery]:checked').val()=="N" || $('input[name=pastHistoryPreviousCardiacSurgery]:checked').val()=="Y")
      && ($('input[name=pastHistoryChronicLungDisease]:checked').val()=="N" || $('input[name=pastHistoryChronicLungDisease]:checked').val()=="Y")
      && ($('input[name=pastHistoryActiveEndocarditis]:checked').val()=="N" || $('input[name=pastHistoryActiveEndocarditis]:checked').val()=="Y")
      && ($('input[name=pastHistoryCriticalPreoperativeState]:checked').val()=="N" || $('input[name=pastHistoryCriticalPreoperativeState]:checked').val()=="Y")
      && ($('input[name=pastHistoryDiabetesOnInsulin]:checked').val()=="N" || $('input[name=pastHistoryDiabetesOnInsulin]:checked').val()=="Y")
     && ($('#pastHistoryNYHA').val()!="")
      && ($('input[name=pastHistoryCCSClass4Angina]:checked').val()=="N" || $('input[name=pastHistoryCCSClass4Angina]:checked').val()=="Y")
     && ($('#pastHistoryLVFunction').val()!="")
      && ($('input[name=pastHistoryRecentMI]:checked').val()=="N" || $('input[name=pastHistoryRecentMI]:checked').val()=="Y")
     && ($('#pastHistoryPulmonaryHypertension').val()!="")
     && ($('#pastHistoryUrgency').val()!="")
     && ($('#pastHistoryWeightOfTheIntervention').val()!="")
      && ($('input[name=pastHistorySurgeryThoracicAorta]:checked').val()=="N" || $('input[name=pastHistorySurgeryThoracicAorta]:checked').val()=="Y"))
     {
     if($('input[name=patientGender]:checked').val()=="M"){
         result+=0;
     } else if($('input[name=patientGender]:checked').val()=="F"){
         result+=0.2196434;
     }
     //alert(result);
     if($('#pastHistoryRenalImpairment').val()=="1"){
         result+=0;
     } else if($('#pastHistoryRenalImpairment').val()=="2"){
         result+=0.303553;
     } else if($('#pastHistoryRenalImpairment').val()=="3"){
         result+=0.8592256;
     }else if($('#pastHistoryRenalImpairment').val()=="4"){
         result+=0.6421508;
     }
     //alert(result);
      if($('input[name=pastHistoryExtracardiacArteriopathy]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryExtracardiacArteriopathy]:checked').val()=="Y"){
         result+=0.5360268;
     }
      if($('input[name=pastHistoryPoorMobility]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryPoorMobility]:checked').val()=="Y"){
         result+=0.2407181;
     }
      if($('input[name=pastHistoryPreviousCardiacSurgery]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryPreviousCardiacSurgery]:checked').val()=="Y"){
         result+=1.118599;
     }
      if($('input[name=pastHistoryChronicLungDisease]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryChronicLungDisease]:checked').val()=="Y"){
         result+=0.1886564;
     }
      if($('input[name=pastHistoryActiveEndocarditis]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryActiveEndocarditis]:checked').val()=="Y"){
         result+=0.6194522;
     }
      if($('input[name=pastHistoryCriticalPreoperativeState]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryCriticalPreoperativeState]:checked').val()=="Y"){
         result+=1.086517;
     }
       if($('input[name=pastHistoryDiabetesOnInsulin]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryDiabetesOnInsulin]:checked').val()=="Y"){
         result+=0.3542749;
     }
     
       if($('#pastHistoryNYHA').val()=="1"){
         result+=0;
     } else if($('#pastHistoryNYHA').val()=="2"){
         result+=0.1070545;
     } else if($('#pastHistoryNYHA').val()=="3"){
         result+=0.2958358;
     }else if($('#pastHistoryNYHA').val()=="4"){
         result+=0.5597929;
     }
       if($('input[name=pastHistoryCCSClass4Angina]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryCCSClass4Angina]:checked').val()=="Y"){
         result+=0.2226147;
     }
     
      if($('#pastHistoryLVFunction').val()=="1"){
         result+=0;
     } else if($('#pastHistoryLVFunction').val()=="2"){
         result+=0.3150652;
     } else if($('#pastHistoryLVFunction').val()=="3"){
         result+=0.8084096;
     }else if($('#pastHistoryLVFunction').val()=="4"){
         result+=0.9346919;
     }
      if($('input[name=pastHistoryRecentMI]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistoryRecentMI]:checked').val()=="Y"){
         result+=0.1528943;
     }
     
       if($('#pastHistoryPulmonaryHypertension').val()=="1"){
         result+=0;
     } else if($('#pastHistoryPulmonaryHypertension').val()=="2"){
         result+=0.1788899;
     } else if($('#pastHistoryPulmonaryHypertension').val()=="3"){
         result+=0.3491475;
     }
       if($('#pastHistoryUrgency').val()=="1"){
         result+=0;
     } else if($('#pastHistoryUrgency').val()=="2"){
         result+=0.3174673;
     } else if($('#pastHistoryUrgency').val()=="3"){
         result+=0.7039121;
     }else if($('#pastHistoryUrgency').val()=="4"){
         result+=1.362947;
     }
       if($('#pastHistoryWeightOfTheIntervention').val()=="1"){
         result+=0;
     } else if($('#pastHistoryWeightOfTheIntervention').val()=="2"){
         result+=0.0062118;
     } else if($('#pastHistoryWeightOfTheIntervention').val()=="3"){
         result+=0.5521478;
     } else if($('#pastHistoryWeightOfTheIntervention').val()=="4"){
         result+=0.9724533;
     }
       if($('input[name=pastHistorySurgeryThoracicAorta]:checked').val()=="N"){
         result+=0;
     } else if($('input[name=pastHistorySurgeryThoracicAorta]:checked').val()=="Y"){
         result+=0.6527205;
     }
 //alert(result);
     patientAge=$('#patientAge').val();
     if (patientAge=='') {
         alert("Age is missing");
         }
     //if (patientAge>90) {
      //  alert("Of over 20,000 patients in the EuroSCORE database, only 21 patients were aged over 90 - therefore the risk model may not be accurate in these patients. Please exercise clinical discretion in interpreting the score. The oldest patient in the EuroSCORE database was 95 - EuroSCORE II is not validated in patients over this age.");
     //   }
    //    alert('patientAge'+patientAge);
    patientAge=(parseInt(patientAge)+1)*0.0285181;
//alert('patientAge'+patientAge);
    if (patientAge<=1.711086) {
        patientAge=0.0285181;
        }  else {
            patientAge = patientAge-(60*0.0285181);
        }
//form.zage.value= Fmt(t)
//alert('patientAge'+patientAge);
result+= patientAge ;
//alert(result);
result = result-5.324537;
//alert(result);
result= Math.exp(result) / (1 + Math.exp(result));
//alert(result);
result = Fmt(100 * result) ;
$("#euroScoreII").val(result);
return result;
} else {
    $("#euroScoreII").val('');
    return;
}
 }
 
 function Fmt(x) {
var v
if(x>=0) { v=''+(x+0.005)} else { v=''+(x-0.005) }
return v.substring(0,v.indexOf('.')+3)
}

function ShowCCCGender(){
     if($('input[name=patientGender]:checked').val()=="M"){
         $("#CCCGendar").html("Male");
     } else if($('input[name=patientGender]:checked').val()=="F"){
         $("#CCCGendar").html("Female");
     }
}

$( "#myelement" ).click(function() {     
   $('#syntaxScoreContent').toggle("slide", { direction: "right" }, 1000);
});

 function showOperationDetail(a,b){
    if($('#'+a).is(':checked')){
        $('#'+b).show();
    } else {
        $('#'+b).hide();
        //清空內容
       //alert(a);
        switch(a){
            case "operationCABG": 
            $("#operationLIMA").val('');
            $("#operationRIMA").val('');
            $("#operationRIMA_RadialA").val('');
            $("#operationRIMA_GEA").val('');
            $("#operationVeinGraft").val('');
            document.getElementById("operationCardiopulmonaryBypass").checked = false;
            document.getElementById("operationCardiacArrest").checked = false;
          $("#operationCardiopulmonaryBypass").attr('checked','');
          $("#operationCardiacArrest").attr('checked','');
          $('#operationCardiopulmonaryBypass').prop("checked", false);
          $('#operationCardiacArrest').prop("checked", false);
            $("#operationCABGMemo").val('');
            $('#operationCardiopulmonaryBypassLabel').removeClass("checked");
            $('#operationCardiacArrestLabel').removeClass("checked");
            break;
           
              case "operationAorticValve": 
            $("#operationAVP").val('');
            $("#operationAVRSelect").val('');
            $("#operationAorticMemo").val('');
            $("#operationAVRSelect-button .ui-selectmenu-status").html('');
            
            break;
              case "operationMitralValve": 
                 $('#operationMVPRing').prop("checked", false);
                 $('#operationMVPRingLabel').removeClass("checked");
                 $('#operationMVPArtificialChord').prop("checked", false);
                 $('#operationMVPArtificialChordLabel').removeClass("checked");
                 $('#operationMVPAnnularPlication').prop("checked", false);
                 $('#operationMVPAnnularPlicationLabel').removeClass("checked");
                 $('#operationMVPLeafletResection').prop("checked", false);
                 $('#operationMVPLeafletResectionLabel').removeClass("checked");
                 $("#operationMVR").val('');
                 $("#operationMVR-button .ui-selectmenu-status").html('');
                 $("#operationMVRMemo").val('');
            break;
              case "operationTricuspidValve": 
               $('#operationTVPRing').prop("checked", false);
               $('#operationTVPRingLabel').removeClass("checked");
               $('#operationTVPArtificialChord').prop("checked", false);
               $('#operationTVPArtificialChordLabel').removeClass("checked");
               $('#operationTVPAnnularPlication').prop("checked", false);
               $('#operationTVPAnnularPlicationLabel').removeClass("checked");
               $('#operationTVPLeafletResection').prop("checked", false);
               $('#operationTVPLeafletResectionLabel').removeClass("checked");
               $("#operationTVR").val('');
               $("#operationTVR-button .ui-selectmenu-status").html('');
               $("#operationTricuspidValveMemo").val('');
            break;
              case "operationPulmonaryValve": 
              $("#operationPulmonaryValvePVP").val('');
               $("#operationPulmonaryValvePVR").val('');
               $("#operationPulmonaryValvePVR-button .ui-selectmenu-status").html('');
               $("#operationPulmonaryValveMemo").val('');
            break;
              case "operationArrythmiaSurgery": 
               $('#operationMazeLA').prop("checked", false);
               $('#operationMazeLALabel').removeClass("checked");
               $('#operationMazeRA').prop("checked", false);
              $('#operationMazeRALabel').removeClass("checked");
              $('#operationMazeOthers').prop("checked", false);
               $('#operationMazeOthersLabel').removeClass("checked");
               $("#operationMazeEnergySource").val('');
               $("#operationMazeEnergySource-button .ui-selectmenu-status").html('');
                $("#operationMazeMemo").val('');
            break;
              case "operationAorticSurgery": 
                 $('#operationDissection').prop("checked", false);
               $('#operationDissectionLabel').removeClass("checked");
                  $('#operationAneurysm').prop("checked", false);
               $('#operationAneurysmLabel').removeClass("checked");
                  $('#operationAneurysmAscending').prop("checked", false);
               $('#operationAneurysmAscendingLabel').removeClass("checked");
                  $('#operationAneurysmArch').prop("checked", false);
               $('#operationAneurysmArchLabel').removeClass("checked");
                  $('#operationAneurysmThoracicAorta').prop("checked", false);
               $('#operationAneurysmThoracicAortaLabel').removeClass("checked");
                  $('#operationAneurysmAbdominalAorta').prop("checked", false);
               $('#operationAneurysmAbdominalAortaLabel').removeClass("checked");
                $("#operationAorticSurgeryMethod").val('');
               $("#operationAorticSurgeryMethod-button .ui-selectmenu-status").html('');
                $("#operationAorticSurgeryMemo").val('');
               
            break;
              case "operationHeartTransplantation": 
              $("#operationHeartTransplantationMemo").val('');
              
            break;
              case "CongenitalOpenHeartPediatric": 
            break;
              case "CongenitalClosedHeart": 
            break;
                case "CongenitalOpenHeartAdultCHD": 
            break;
               case "NonOpenHeartPeripheralArtery": 
            break;
               case "NonOpenHeartVaricoseVeinSurgery": 
            break;
               case "NonOpenHeartCentralVeinAccess": 
            break;
               case "NonOpenHeartMechanicalSupport": 
            break;
            
        }
    }
    
 }
 
function  chkMorbidity(){
    if($('#outcomeCheck1').is(':checked') || $('#outcomeCheck2').is(':checked') || $('#outcomeCheck3').is(':checked') || $('#outcomeCheck4').is(':checked') || $('#outcomeCheck5').is(':checked') || $('#outcomeCheck6').is(':checked') ){
        $('#outcomeCheck7').prop("checked", true);
        $('#outcomeCheck7').addClass("checked");
    } else {
        $('#outcomeCheck7').prop("checked", false);
        $('#outcomeCheck7').removeClass("checked");
    }
}

function evaluationTrans(pid){
    
    if($("#patientOpDate").val()!="" && $("#patientChartNumber").val()!="" ){
          $.ajax({
                        type:"POST",
                        url: "<?php echo base_url(); ?>evaluation/evaluationTrans/",
                        cache: false,
                        data:
                            {
                            patientID:pid,
                            patientOPdate:$("#patientOpDate").val()
                            
                            },
                        datatype: "JSON",
                        success: function(data){
                                if(JSON.parse(data).status=="success"){
                                 showNotify('0','轉入成功');
                                } else {
                                       if(JSON.parse(data).result=="1"){
                                            showNotify('1','該資料己存在病患資料庫, 轉入失敗');
                                       } else {
                                            showNotify('1','該資料不存在術前評估中, 轉入失敗');
                                       }
                                }
                                     
                        }
                            
                    });
    } else {
        alert('必須填寫Operation Date及chart number才能轉入病患資料庫');
        return false;
    }
}

function showNotify(t,m){
    if(t=="1"){
        $("#transButton").notify(m, "error");
    } else {
$("#transButton").notify(m, "success");
}
}
function copyToClipboard() {
  var copyTextarea = document.querySelector('#EuroScoreCopyArea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'Successful' : 'Unsuccessful';
    console.log('Copying text command was ' + msg);
        $("#EuroCopyButton").notify("Copy to clipboard "+msg, "info");
  } catch (err) {
    console.log('Oops, unable to copy');
  }
}

 function sentForm(){
     var errorMsg="";
     if( $( "#patientChartNumber" ).val()==""){
         errorMsg+="Chart Number 不能為空白\n";
     }
     if( $( "#patientBirthday" ).val()==""){
         errorMsg+="Birth Date 不能為空白\n";
     }
  
     if(errorMsg!=""){
         $("#sendFrom").notify(errorMsg,"error");
         event.preventDefault();
     } else{
         $("#addPatient").submit();
     }
 }
</script>



</body>

</html> 