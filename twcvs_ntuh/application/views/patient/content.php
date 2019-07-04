<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 <?php $c=$myContent->row();?>
 <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->patientDischargeDate!="" && $c->patientDischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->patientDischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }

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
$html .= 'Poor mobility:  '.$c->pastHistoryPoorMobility.'&#13;&#10;';
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
if($c->CongenitalDiagnosis1!='' || $c->CongenitalDiagnosis2!='' || $c->CongenitalDiagnosis3!='' || $c->CongenitalDiagnosis4!='' || $c->CongenitalDiagnosis5!='' || $c->CongenitalDiagnosisOthers!='') 
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
                                         <td><img src="<?php echo $genderImage[$c->patientGender];?>"></td>
                                         <td bgcolor="<?php echo $myColor;?>">Operation Date:</td>
                                         <td><?php echo  str_replace('0000-00-00', '', $c->patientOpDate);?></td>
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
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
            
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                   <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                   <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                </div>
                </div>
                <div class="title">
                    <h2>Patient Profiles</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/patientProfiles" method="post" id="addPatient"   enctype="multipart/form-data">
                     
                      <div class="line">
                            <label>Patient ID</label>
                            <input type="text" name="patientSSN" class="small" value="<?php echo $c->patientSSN;?>" />
                        </div>
                        
                        <div class="line">
                            <label><span style="color:red;">Chart number(必填)</span></label>
                            <input type="text" name="patientChartNumber" class="small" value="<?php echo $c->patientChartNumber;?>" />
                        </div>
                      
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="patientName" class="small" value="<?php echo $c->patientName;?>" />
                        </div>
                        
                         <div class="line">
                            <label><span style="color:red;">Birthday(必填)</span></label>
                             <input type="text" name="patientBirthday" id="patientBirthday"  class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientBirthday);?>"  onchange="calAge();"  onKeyUp="javascript:checkDate(this);" onBlur="javascript:checkDate_Format(this);CalcEuroII();" maxlength="10" />
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
                            <label><span style="color:red;">Operation date(必填)</span></label>
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>" onchange="calAge();calLOS('1',this);CalcEuroII();" />
                        </div>
                            
                        
                              <div class="line">
                            <label>Discharge date</label>
                            <input type="text" name="patientDischargeDate" id="patientDischargeDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>"  onchange="javascript:calLOS('1',this);" />
                        </div>
                       
                           
                         
                          
                          <div class="line">
                            <label>Other associated disease</label>
                           <textarea name="patientAssociatedDisease" class="textarea" cols="55" rows="20"><?php echo $c->patientAssociatedDisease;?></textarea>
                        </div>
                   
                   <div class="line">
                            <label>EUROSCORE II</label>
                            <input type="text" name="euroScoreII_1"   id="euroScoreII_1"   class="smallDisabled" readonly  value="<?php echo $c->euroScoreII;?>" />%
                            
                            <button type="button" class="blue medium" onclick="javascript:callHideShow('divPastHistory');"><span>查看/修改</span></button>
                             
                         
                        </div>
                         <div class="line">
                            <label></label>
                           <textarea id="EuroScoreCopyArea" class="textarea" cols="55" rows="20"><?php echo $html;?></textarea>
                           <button type="button" id="EuroCopyButton" class="blue medium" onclick="javascript:copyToClipboard();"><span>Copy</span></button>
                        </div>
                           <div class="line">
                            <label>SYNTAX Score</label>
                            <input type="text" name="patientSyntaxScore"   id="patientSyntaxScore"   class="smallDisabled" readonly   value="<?php echo $c->patientSyntaxScore;?>" /> 
                            <!-- <img src="<?php echo base_url(); ?>gfx/table-next.gif" id="myelement"></img>-->
                        
                          <button type="button" class="blue medium" onclick="if(confirm('如果未完成修改步驟, 將致資料不完整, 您確定要修改嗎?')){window.location='<?php echo base_url(); ?>syntaxscoreII/index/<?php echo $c->patientID;?>';}"><span>修改</span></button>
                        </div>
                  
                           <div class="line">
                            <label>學會同意書</label>
                            <?php if($c->agreement=="") {?>
                            <input type="file" name="agreement" class="small" value="<?php echo $c->agreement;?>" />(檔案限制：300K)
                            <?php } else { ?>
                            <a href="/uploads/<?php echo $c->agreement;?>" target="_new">
                            <img src="/images/FileType100.png" width="30" height="30" /></a>
                            <a href="#" onclick="javascript:if(confirm('Press confirm to delete this agreement?')){ window.location='<?php echo base_url(); ?>patient/deleteAttachment/<?php echo $c->patientID;?>';}" ><img src="/images/cross-circle.png"></a>  
                             <input type="hidden" name="agreement" class="small" value="" />
                             <?php }  ?>
                        </div>
                          <div class="line">
                            <label>醫院同意書</label>
                            <?php if($c->hospitalagreement=="") {?>
                            <input type="file" name="hospitalagreement" class="small" value="<?php echo $c->hospitalagreement;?>" />(檔案限制：300K)
                            <?php } else { ?>
                            <a href="/uploads/<?php echo $c->hospitalagreement;?>" target="_new">
                            <img src="/images/FileType100.png" width="30" height="30" /></a>
                            <a href="#" onclick="javascript:if(confirm('Press confirm to delete this agreement?')){ window.location='<?php echo base_url(); ?>patient/deleteHospitalAttachment/<?php echo $c->patientID;?>';}" ><img src="/images/cross-circle.png"></a>  
                             <input type="hidden" name="hospitalagreement" class="small" value="" />
                             <?php }  ?>
                        </div>
                    <div class="line button">
                                  <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div>
        <div class="box" id="divPastHistory">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                 <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                  <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                   </div>
                </div>
                <div class="title">
                    <h2>EUROSCORE II</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/patientEuroscore" method="post">
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
                             Kg
                           </div>
                              <div class="line">
                            <label>Serum Creatinine</label>
                             <input type="text" class="small" name="patientSerumCreatinine" id="patientSerumCreatinine"  value="<?php echo $c->patientSerumCreatinine;?>"     onblur="javascript:changeCre('1');">
                             mg/dL
                           </div>
                             <div class="line">
                            <label>Ccr before operation  </label>
                             <input type="text" class="smallDisabled" readonly  name="CcrberforOperation" id="CcrberforOperation"  value="<?php echo $c->CcrberforOperation;?>">
                             
                           </div>
                        <div class="line">
                            <label>Renal impairment <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("there are now 3 categories based on creatinine  \n clearance calculated using Cockcroft-Gault formula.  \n Unlike serum creatinine in the old EuroSCORE model,  \n some of the weighting for age is directly \n  incorporated into this factor, as age is a component of \n creatinine clearance. The 3 categories are:\n •   on dialysis (regardless of serum creatinine level) \n • moderately impaired renal function (50-85 ml/min)\n •   severely impaired renal function (<50 ml/min) off dialysis",{className:"info",autoHide: false});'></img>
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
                              <select name="pastHistoryNYHA" id="pastHistoryNYHA"   onchange="changeHYHA('1');">
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
                        
                     
                      <div class="line button">
                           
                               <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div>
        <div class="box" id="divOperation">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
               <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                    <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                   </div>
                </div>
                <div class="title">
                    <h2>Operation procedures</h2>
                    
                </div>
                  <form name="patientOperation" action="<?php echo base_url(); ?>patient/patientOperation" method="post">
                         <!--  <div class="lineheaderSpecial">
                            <label>學會分類:   </label>
                             <label for="operationAssociateCategory"></label> &nbsp;
                           <select name="operationAssociateCategory" id="operationAssociateCategory">
                                   <option value=""></option>
                                   <option value="1"  <?php if($c->operationAssociateCategory=='1') echo "selected";?>>CABG</option>
                                   <option value="2"  <?php if($c->operationAssociateCategory=='2') echo "selected";?>>Valvular Replacement</option>
                                   <option value="3"  <?php if($c->operationAssociateCategory=='3') echo "selected";?>>Valvular Repair</option>
                                   <option value="4"  <?php if($c->operationAssociateCategory=='4') echo "selected";?>>Congenital Heart Disease</option>
                                   <option value="5"  <?php if($c->operationAssociateCategory=='5') echo "selected";?>>Aortic Dissection</option>
                                   <option value="6"  <?php if($c->operationAssociateCategory=='6') echo "selected";?>>HTX</option>
                                   <option value="7"  <?php if($c->operationAssociateCategory=='7') echo "selected";?>>Mechanical Support</option>
                                   <option value="8"  <?php if($c->operationAssociateCategory=='8') echo "selected";?>>Aortic Aneurysm</option>
                                   <option value="9"  <?php if($c->operationAssociateCategory=='9') echo "selected";?>>PAOD</option>
                                   <option value="10"  <?php if($c->operationAssociateCategory=='10') echo "selected";?>>Others</option>
                                   </select>
                             </div>
                        -->
                        <div class="line">
                            <label>Surgeon 1
                               <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Surgeon 1為此筆病患資料的擁有者, \n若非得到該Surgeon 1的授權即無法修改此筆病患資料",{className:"info",autoHide: false});'></img></label>  </label>
                          
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
                            <label>Surgeon 2</label>
                          
                               <select name="patientSurgeon2" id="patientSurgeon2">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon2) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>Surgeon 3</label>
                          
                               <select name="patientSurgeon3" id="patientSurgeon3">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon3) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>Surgeon 4</label>
                          
                               <select name="patientSurgeon4" id="patientSurgeon4">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon4) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                          <div class="line"  style="background-color:#F5A9E1">
                            <label>Cardiopulmonary Bypass</label>
                          
                               <select name="patientCardiopulmonaryBypass" id="patientCardiopulmonaryBypassAdult" class="large" onchange="chkCABG();">
                                   <option value=""></option>
                                   <option value="1" <?php if($c->patientCardiopulmonaryBypass=='1') echo "selected";?>>CPB with cardiac arrest (or ventricular fibrillation) </option>
                                   <option value="2" <?php if($c->patientCardiopulmonaryBypass=='2') echo "selected";?>>CPB without cardiac arrest</option>
                                   <option value="3" <?php if($c->patientCardiopulmonaryBypass=='3') echo "selected";?>>only ECMO support</option>
                                   <option value="4" <?php if($c->patientCardiopulmonaryBypass=='4') echo "selected";?>>no CPB or ECMO support</option>
                                </select>
                        </div>      
                        
                         <div class="line" style="background-color:#F5A9E1">
                            <label>Previous Cardiac Operation
                                 <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Re-do operation 選 1；Tri-do operation 選 2；依此類推...",{className:"info",autoHide: false});'></img>
                          
                                </label>
                          
                               <select name="patientReoperation" id="patientReoperation">
                                   <option value=""></option>
                                      <?php 
                            for($i=1;$i<=6;$i++){
                                     ?>
                                     <option value="<?php echo $i;?>" <?php if($i== $c->patientReoperation) echo "selected";?>><?php echo $i;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                     <div class="line"  style="background-color:#F5A9E1">
                            <label>Operative approach</label>
                          
                               <select name="patientOperativeApproach" id="patientOperativeApproach">
                                   <option value="1" <?php if($c->patientOperativeApproach=='1') echo "selected";?>>Full conventional sternotomy</option>
                                   <option value="2" <?php if($c->patientOperativeApproach=='2') echo "selected";?>>Partial sternotomy</option>
                                   <option value="3" <?php if($c->patientOperativeApproach=='3') echo "selected";?>>Parasternal incision</option>
                                   <option value="4" <?php if($c->patientOperativeApproach=='4') echo "selected";?>>Thoracotomy</option>
                                   <option value="5" <?php if($c->patientOperativeApproach=='5') echo "selected";?>>Mini-thoracotomy</option>
                                   <option value="6" <?php if($c->patientOperativeApproach=='6') echo "selected";?>>Thoracoabdominal Incision</option>
                                   <option value="7" <?php if($c->patientOperativeApproach=='7') echo "selected";?>>Percutaneous</option>
                                   <option value="9" <?php if($c->patientOperativeApproach=='9') echo "selected";?>>Others</option>
                               </select>
                        </div>      
                         <div class="line"  style="background-color:#F5A9E1">
                            <label>Converted during procedure</label>
                                  <select name="patientConvertedDuringProcedure" id="patientConvertedDuringProcedure">
                                  <option value="0"  <?php if($c->patientConvertedDuringProcedure=='0') echo "selected";?>>No</option>
                                   <option value="1"  <?php if($c->patientConvertedDuringProcedure=='1') echo "selected";?>>Yes,planned</option>
                                   <option value="2" <?php if($c->patientConvertedDuringProcedure=='2') echo "selected";?>> Yes,unplanned</option>
                                   </select>
                        </div>     
                         <div class="line"  style="background-color:#F5A9E1">
                            <label>Robotic Used</label>
                                  <select name="patientRoboticUsed" id="patientRoboticUsed">
                                  <option value="0"  <?php if($c->patientRoboticUsed=='0') echo "selected";?>>No</option>
                                   <option value="1"  <?php if($c->patientRoboticUsed=='1') echo "selected";?>>Yes, used for entire operation</option>
                                   <option value="2" <?php if($c->patientRoboticUsed=='2') echo "selected";?>>Yes, used for part of the operation</option>
                                   </select>
                        </div>   
                <div class="title">
                    <h2></h2>
                    <span class="surgery">Open heart Surgery</span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShow('divCongenitalSurgery')">Congenital Surgery</a></span>
                   <!-- <span class="surgery"><a href="#" onclick="callHideShow('divNoneSurgery')">Non-open heart</a></span> -->
                </div>
                  
                            <div class="line">
                            <label>Diagnosis 1</label>
                          
                             <input type="text" name="AdultDiagnosis1" id="AdultDiagnosis1" class="big" value="<?php echo $c->AdultDiagnosis1;?>"  readonly />
                             <input type="hidden" name="AdultDiagnosis_id1" id="AdultDiagnosis_id1" class="small" value="<?php echo $c->AdultDiagnosis_id1;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryAdultDiagnosis/1"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('1')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 2</label>
                          
                             <input type="text" name="AdultDiagnosis2" id="AdultDiagnosis2" class="big" value="<?php echo $c->AdultDiagnosis2;?>" readonly />
                              <input type="hidden" name="AdultDiagnosis_id2" id="AdultDiagnosis_id2" class="small" value="<?php echo $c->AdultDiagnosis_id2;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryAdultDiagnosis/2"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('2')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 3</label>
                          
                             <input type="text" name="AdultDiagnosis3" id="AdultDiagnosis3" class="big" value="<?php echo $c->AdultDiagnosis3;?>" readonly />
                              <input type="hidden" name="AdultDiagnosis_id3" id="AdultDiagnosis_id3" class="small" value="<?php echo $c->AdultDiagnosis_id3;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryAdultDiagnosis/3"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('3')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 4</label>
                          
                             <input type="text" name="AdultDiagnosis4" id="AdultDiagnosis4" class="big" value="<?php echo $c->AdultDiagnosis4;?>" readonly/>
                              <input type="hidden" name="AdultDiagnosis_id4" id="AdultDiagnosis_id4" class="small" value="<?php echo $c->AdultDiagnosis_id4;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryAdultDiagnosis/4"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('4')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 5</label>
                          
                             <input type="text" name="AdultDiagnosis5" id="AdultDiagnosis5" class="big" value="<?php echo $c->AdultDiagnosis5;?>" readonly/>
                              <input type="hidden" name="AdultDiagnosis_id5" id="AdultDiagnosis_id5" class="small" value="<?php echo $c->AdultDiagnosis_id5;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryAdultDiagnosis/5"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('5')"><img src="/images/cross-circle.png"></a>
                             </div>
                             <div class="line">
                            <label>Diagnosis Others: </label>
                           <textarea name="AdultDiagnosisOthers" class="textarea" cols="55" rows="10"><?php echo $c->AdultDiagnosisOthers;?></textarea>
                        </div>
                          <div class="lineheader">
                            <label>CABG:   </label>
                             <label for="operationCABG"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationCABG" id="operationCABG"  value="Y" <?php if($c->operationCABG=='Y') echo "checked";?> onclick="confirmOperationDetail('operationCABG','Operation_CABG');chkCABG();""> 
                            </div>
                            <div id="Operation_CABG" style="display:none">
                               <div class="line">
                            <label>LIMA:  </label>
                            <select name="operationLIMA" id="operationLIMA">
                                   <option value=""  <?php if($c->operationLIMA=='') echo "selected";?>></option>
                                   <option value="0"  <?php if($c->operationLIMA=='0') echo "selected";?>>0</option>
                                   <option value="1"  <?php if($c->operationLIMA=='1') echo "selected";?>>1</option>
                                   <option value="2"  <?php if($c->operationLIMA=='2') echo "selected";?>>2</option>
                                   <option value="3"  <?php if($c->operationLIMA=='3') echo "selected";?>>3</option>
                                   <option value="4"  <?php if($c->operationLIMA=='4') echo "selected";?>>4</option>
                                   <option value="5"  <?php if($c->operationLIMA=='5') echo "selected";?>>5</option>
                               </select>
                            </div>
                         <div class="line">
                            <label>RIMA: </label>
                              <select name="operationRIMA" id="operationRIMA">
                                   <option value=""  <?php if($c->operationRIMA=='') echo "selected";?>></option>
                                   <option value="0"  <?php if($c->operationRIMA=='0') echo "selected";?>>0</option>
                                   <option value="1"  <?php if($c->operationRIMA=='1') echo "selected";?>>1</option>
                                   <option value="2"  <?php if($c->operationRIMA=='2') echo "selected";?>>2</option>
                                   <option value="3"  <?php if($c->operationRIMA=='3') echo "selected";?>>3</option>
                                   <option value="4"  <?php if($c->operationRIMA=='4') echo "selected";?>>4</option>
                                   <option value="5"  <?php if($c->operationRIMA=='5') echo "selected";?>>5</option>
                               </select>
                          </div>
                           <div class="line">
                            <label>Radial artery: </label>
                             <select name="operationRIMA_RadialA" id="operationRIMA_RadialA">
                                   <option value=""  <?php if($c->operationRIMA_RadialA=='') echo "selected";?>></option>
                                   <option value="0"  <?php if($c->operationRIMA_RadialA=='0') echo "selected";?>>0</option>
                                   <option value="1"  <?php if($c->operationRIMA_RadialA=='1') echo "selected";?>>1</option>
                                   <option value="2"  <?php if($c->operationRIMA_RadialA=='2') echo "selected";?>>2</option>
                                   <option value="3"  <?php if($c->operationRIMA_RadialA=='3') echo "selected";?>>3</option>
                                   <option value="4"  <?php if($c->operationRIMA_RadialA=='4') echo "selected";?>>4</option>
                                   <option value="5"  <?php if($c->operationRIMA_RadialA=='5') echo "selected";?>>5</option>
                               </select>
                          </div>
                           <div class="line">
                            <label>Gastroepiploic artery : </label>
                              <select name="operationRIMA_GEA" id="operationRIMA_GEA">
                                   <option value=""  <?php if($c->operationRIMA_GEA=='') echo "selected";?>></option>
                                   <option value="0"  <?php if($c->operationRIMA_GEA=='0') echo "selected";?>>0</option>
                                   <option value="1"  <?php if($c->operationRIMA_GEA=='1') echo "selected";?>>1</option>
                                   <option value="2"  <?php if($c->operationRIMA_GEA=='2') echo "selected";?>>2</option>
                                   <option value="3"  <?php if($c->operationRIMA_GEA=='3') echo "selected";?>>3</option>
                                   <option value="4"  <?php if($c->operationRIMA_GEA=='4') echo "selected";?>>4</option>
                                   <option value="5"  <?php if($c->operationRIMA_GEA=='5') echo "selected";?>>5</option>
                               </select>
                          </div>
                          
                          <div class="line">
                            <label> Vein graft:</label>
                             <select name="operationVeinGraft" id="operationVeinGraft">
                                   <option value=""  <?php if($c->operationVeinGraft=='') echo "selected";?>></option>
                                   <option value="0"  <?php if($c->operationVeinGraft=='0') echo "selected";?>>0</option>
                                   <option value="1"  <?php if($c->operationVeinGraft=='1') echo "selected";?>>1</option>
                                   <option value="2"  <?php if($c->operationVeinGraft=='2') echo "selected";?>>2</option>
                                   <option value="3"  <?php if($c->operationVeinGraft=='3') echo "selected";?>>3</option>
                                   <option value="4"  <?php if($c->operationVeinGraft=='4') echo "selected";?>>4</option>
                                   <option value="5"  <?php if($c->operationVeinGraft=='5') echo "selected";?>>5</option>
                                   <option value="6"  <?php if($c->operationVeinGraft=='6') echo "selected";?>>6</option>
                               </select>
                            </div>
                             <div class="line" style="display: none;">
                            <label> </label>
                            <label for="operationCardiopulmonaryBypass" id="operationCardiopulmonaryBypassLabel">Cardiopulmonary bypass or ECMO support &nbsp;</label> &nbsp;
                            <input type="checkbox"  name="operationCardiopulmonaryBypass" id="operationCardiopulmonaryBypass"  value="Y" <?php if($c->operationCardiopulmonaryBypass=='Y') echo "checked";?>> 
                          </div>
                          <div class="line" style="display: none;">
                            <label> </label>
                            <label for="operationCardiacArrest" id="operationCardiacArrestLabel">Cardiac arrest &nbsp;</label> &nbsp;
                            <input type="checkbox" name="operationCardiacArrest" id="operationCardiacArrest"  value="Y" <?php if($c->operationCardiacArrest=='Y') echo "checked";?>> 
                          </div>
                    <div class="line">
                            <label>備註: </label>
                           <textarea name="operationCABGMemo"  id="operationCABGMemo" class="textarea" cols="55" rows="10"><?php echo $c->operationCABGMemo;?></textarea>
                        </div>
                        </div>
                        
                          <div class="lineheader">
                            <label>Aortic valve surgery:   </label>
                             <label for="operationAorticValve"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationAorticValve" id="operationAorticValve"  value="Y" <?php if($c->operationAorticValve=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationAorticValve','Operation_AorticValve');"> 
                            </div>
                             <div id="Operation_AorticValve" style="display:none">
                               <div class="line">
                                    
                            <label>Aortic valve plasty (AVP):  
                              
                            </label>
                            <label for="operationAorticValve_AVP" id="operationAorticValve_AVP_Lalbel"></label>
                             <input type="checkbox" name="operationAorticValve_AVP" id="operationAorticValve_AVP"  value="Y" <?php if($c->operationAorticValve_AVP=='Y') echo "checked";?>  onclick="confirmVPVR('1','1');"> 
                           
                              <select name="operationAVP" id="operationAVP" class="large" onchange="chkAVP();confirmVPVR('1','1');">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="Aortic root preimplantation (David procedure)"  <?php if($c->operationAVP=='Aortic root preimplantation (David procedure)') echo "selected";?>>Aortic root preimplantation (David procedure) </option>
                                   <option  class="large" value="Aortic root remodeling (Yacoub procedure)"  <?php if($c->operationAVP=='Aortic root remodeling (Yacoub procedure)') echo "selected";?>>Aortic root remodeling (Yacoub procedure)</option>
                                   <option  class="large" value="valve reconstruction (AVRS)"  <?php if($c->operationAVP=='valve reconstruction (AVRS)') echo "selected";?>>valve reconstruction (AVRS)</option>
                                   <option  class="large" value="Others"  <?php if($c->operationAVP=='Others') echo "selected";?>>Others</option>
                                    </select>
                            </div>
                         <div class="line">
                            <label>Aortic valve replacement (AVR): </label>
                            <label for="operationAorticValve_AVR" id="operationAorticValve_AVR_Lalbel"></label>
                             <input type="checkbox" name="operationAorticValve_AVR" id="operationAorticValve_AVR"  value="Y" <?php if($c->operationAorticValve_AVR=='Y') echo "checked";?>  onclick="confirmVPVR('1','2');"> 
                           
                              <select name="operationAVRSelect" id="operationAVRSelect" onchange="chkAVR();confirmVPVR('1','2');">
                                   <option value=""></option>
                                   <option value="Mechanical valve"  <?php if($c->operationAVRSelect=='Mechanical valve') echo "selected";?>>Mechanical valve</option>
                                   <option value="Bioprosthetic valve"  <?php if($c->operationAVRSelect=='Bioprosthetic valve') echo "selected";?>>Bioprosthetic valve</option>
                                   <option value="Sutureless valve"  <?php if($c->operationAVRSelect=='Sutureless valve') echo "selected";?>>Sutureless valve</option>
                                     <option value="Others"  <?php if($c->operationAVRSelect=='Others') echo "selected";?>>Others</option>
                                   </select>
                                  </div>
                     <div class="line">
                           <label> </label>
                             <label for="operationMitralValveBentall" id="operationMitralValveBentallLabel"> Bentall’s Op  &nbsp;</label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationMitralValveBentall" id="operationMitralValveBentall"  value="Y" <?php if($c->operationMitralValveBentall=='Y') echo "checked";?>  onclick="confirmVPVR('1','3');"> 
                              <select name="operationBentallSelect" id="operationBentallSelect" onchange="chkBentallsSelect();confirmVPVR('1','3');">
                                   <option value=""></option>
                                   <option value="Mechanical valve"  <?php if($c->operationBentallSelect=='Mechanical valve') echo "selected";?>>Mechanical valve</option>
                                   <option value="Bioprosthetic valve"  <?php if($c->operationBentallSelect=='Bioprosthetic valve') echo "selected";?>>Bioprosthetic valve</option>
                                   <option value="Sutureless valve"  <?php if($c->operationBentallSelect=='Sutureless valve') echo "selected";?>>Sutureless valve</option>
                                   <option value="Valved graft"  <?php if($c->operationBentallSelect=='Valved graft') echo "selected";?>>Valved graft</option>
                                   <option value="Others"  <?php if($c->operationBentallSelect=='Others') echo "selected";?>>Others</option>
                                   </select>
                          </div>
                          
                            <div class="line">
                            <label>TAVI: </label>
                            <label for="operationAorticValve_TAVI" id="operationAorticValve_TAVI_Lalbel"></label>
                             <input type="checkbox" name="operationAorticValve_TAVI" id="operationAorticValve_TAVI"  value="Y" <?php if($c->operationAorticValve_TAVI=='Y') echo "checked";?>  onclick="confirmVPVR('1','4');"> 
                           
                              <select name="operationAorticValve_TAVI_S1" id="operationAorticValve_TAVI_S1" onchange="chkTAVI();confirmVPVR('1','4');">
                                   <option value=""></option>
                                   <option value="Transfemoral approach"  <?php if($c->operationAorticValve_TAVI_S1=='Transfemoral approach') echo "selected";?>>Transfemoral approach</option>
                                   <option value="Transapical approach"  <?php if($c->operationAorticValve_TAVI_S1=='Transapical approach') echo "selected";?>>Transapical approach</option>
                                   <option value="Transaortic approach"  <?php if($c->operationAorticValve_TAVI_S1=='Transaortic approach') echo "selected";?>>Transaortic approach</option>
                                   <option value="Transcarotid approach"  <?php if($c->operationAorticValve_TAVI_S1=='Transcarotid approach') echo "selected";?>>Transcarotid approach</option>
                                   <option value="Others"  <?php if($c->operationAorticValve_TAVI_S1=='Others') echo "selected";?>>Others</option>
                                   </select>
                                      <select name="operationAorticValve_TAVI_S2" id="operationAorticValve_TAVI_S2" onchange="chkTAVI();confirmVPVR('1','4');">
                                   <option value=""></option>
                                   <option value="NO cardiopulmonary bypass"  <?php if($c->operationAorticValve_TAVI_S2=='NO cardiopulmonary bypass') echo "selected";?>>NO cardiopulmonary bypass</option>
                                   <option value="WITH cardiopulmonary bypass"  <?php if($c->operationAorticValve_TAVI_S2=='WITH cardiopulmonary bypass') echo "selected";?>>WITH cardiopulmonary bypass</option>
                           
                                   </select>
                                  </div>
                             <div class="line" style="background-color: #ccff99;">
                            <label> </label>
                      
                             瓣膜名稱: <select name="AorticValveProductName" id="AorticValveProductName" onchange="">
                                 <option></option>
                                   <option value="<?php echo $c->AorticValveProductName;?>" selected><?php echo $c->AorticValveProductName;?></option>
                                   </select>
                                 
                          瓣膜尺寸: <input type="text" name="AorticValveProductType" id="AorticValveProductType"  class="small" value="<?php echo $c->AorticValveProductType;?>" onblur="chkPVP();" />
                                
                                  </div>   
                            <div class="line">
                            <label>備註: </label>
                           <textarea name="operationAorticMemo" id="operationAorticMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationAorticMemo;?></textarea>
                        </div>
                        </div>
                          <div class="lineheader">
                            <label>Aortic surgery:   </label>
                             <label for="operationAorticSurgery"  id="operationAorticSurgeryLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationAorticSurgery" id="operationAorticSurgery"  value="Y" <?php if($c->operationAorticSurgery=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationAorticSurgery','Operation_AorticSurgery');"> 
                            </div>
                            <div id="Operation_AorticSurgery" style="display:none">
                               <div class="line">
                                   <label>Etiology: </label>
                             <label for="operationDissection"  id="operationDissectionLabel">Dissection  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationDissection" id="operationDissection"  value="Y" <?php if($c->operationDissection=='Y') echo "checked";?>> 
                          </div>
                      <div class="line">
                           <label>     </label>
                             <label for="operationAneurysm"  id="operationAneurysmLabel">Aneurysm   &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationAneurysm" id="operationAneurysm"  value="Y" <?php if($c->operationAneurysm=='Y') echo "checked";?>> 
                          </div>
                            <div class="line">
                           <label>     </label>
                             <label for="operationEtiologyOthers"  id="operationEtiologyOthersLabel">Others   &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationEtiologyOthers" id="operationEtiologyOthers"  value="Y" <?php if($c->operationEtiologyOthers=='Y') echo "checked";?>> 
                          </div>
                             <div class="line"  style="display: none;">
                                   <label>Cardiopulmonary bypass  : </label>
                             <label for="operationEtiologyCardiopulmonarBypass"  id="operationEtiologyCardiopulmonarBypassLabel">  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationEtiologyCardiopulmonarBypass" id="operationEtiologyCardiopulmonarBypass"  value="Y" <?php if($c->operationEtiologyCardiopulmonarBypass=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                             <label> Cerebral protection: </label>
                              <select name="operationAorticSurgeryCerebralProtection" id="operationAorticSurgeryCerebralProtection">
                                   <option value=""></option>
                                   <option value="Hypothermic arrest"  <?php if($c->operationAorticSurgeryCerebralProtection=='Hypothermic arrest') echo "selected";?>>Hypothermic arrest  </option>
                                   <option value="Selective antegrade"  <?php if($c->operationAorticSurgeryCerebralProtection=='Selective antegrade') echo "selected";?>>Selective antegrade  </option>
                                   <option value="Selective retrograde"  <?php if($c->operationAorticSurgeryCerebralProtection=='Selective retrograde') echo "selected";?>>Selective retrograde  </option>
                                   <option value="Others"  <?php if($c->operationAorticSurgeryCerebralProtection=='Others') echo "selected";?>>Others</option>
                                   </select>
                             </div>
                             <div class="line">
                             <label>Location: </label>
                              <select name="operationAorticSurgeryLocation" id="operationAorticSurgeryLocation">
                                   <option value=""></option>
                                   <option value="ascending"  <?php if($c->operationAorticSurgeryLocation=='ascending') echo "selected";?>>ascending</option>
                                   <option value="arch"  <?php if($c->operationAorticSurgeryLocation=='arch') echo "selected";?>>arch</option>
                                   <option value="thoracic aorta"  <?php if($c->operationAorticSurgeryLocation=='thoracic aorta') echo "selected";?>>thoracic aorta </option>
                                   <option value="thoracoabdominal aorta"  <?php if($c->operationAorticSurgeryLocation=='thoracoabdominal aorta') echo "selected";?>>thoracoabdominal aorta</option>
                                   </select>
                             </div>  
                       
                     <div class="line">
                             <label> Method: </label>
                              <select name="operationAorticSurgeryMethod" id="operationAorticSurgeryMethod">
                                   <option value=""></option>
                                   <option value="Open grafting"  <?php if($c->operationAorticSurgeryMethod=='Open grafting') echo "selected";?>>Open grafting  </option>
                                   <option value="Stent grafting"  <?php if($c->operationAorticSurgeryMethod=='Stent grafting') echo "selected";?>>Stent grafting </option>
                                   <option value="Hybrid procedure"  <?php if($c->operationAorticSurgeryMethod=='Hybrid procedure') echo "selected";?>>Hybrid procedure </option>
                                   <option value="Ring grafting"  <?php if($c->operationAorticSurgeryMethod=='Ring grafting') echo "selected";?>>Ring grafting </option>
                                   <option value="Others"  <?php if($c->operationAorticSurgeryMethod=='Others') echo "selected";?>>Others </option>
                                   </select>
                             </div>
                          
                            <div class="line">
                            <label>備註: </label>
                           <textarea name="operationAorticSurgeryMemo" id="operationAorticSurgeryMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationAorticSurgeryMemo;?></textarea>
                        </div>
                        </div>
                            <div class="lineheader">
                            <label>Mitral valve surgery:   </label>
                             <label for="operationMitralValve" id="operationMitralValveLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationMitralValve" id="operationMitralValve"  value="Y" <?php if($c->operationMitralValve=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationMitralValve','Operation_MitralValve');"> 
                            </div>
                         <div id="Operation_MitralValve" style="display:none">    
                         <div class="line">
                            <label>MVP: </label>
                             <label for="Operation_MitralValve_MVP" id="Operation_MitralValve_MVP_Lalbel"></label>&nbsp;
                             <input type="checkbox" name="Operation_MitralValve_MVP" id="Operation_MitralValve_MVP"  value="Y" <?php if($c->Operation_MitralValve_MVP=='Y') echo "checked";?>  onclick="confirmVPVR('2','1');"> 
                             </div>
                           <div class="line">
                            <label></label>
                            
                            <label for="operationMVPRing"  id="operationMVPRingLabel"> &nbsp; &nbsp; &nbsp; &nbsp;Ring &nbsp;</label> &nbsp;
                           <input type="checkbox" class="checkbox-indent" name="operationMVPRing" id="operationMVPRing"  value="Y" <?php if($c->operationMVPRing=='Y') echo "checked";?> onclick="chkMVP();qryValve('#MitralValveProductName', 'Annuloplasty Ring');"> 
                          </div>
                          <div class="line">
                            <label> </label>
                            
                             <label for="operationMVPArtificialChord"   id="operationMVPArtificialChordLabel">&nbsp; &nbsp; &nbsp; &nbsp;Artificial chordae&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox-indent" name="operationMVPArtificialChord" id="operationMVPArtificialChord"  value="Y" <?php if($c->operationMVPArtificialChord=='Y') echo "checked";?> onclick="chkMVP();"> 
                          </div>
                             <div class="line">
                            <label> </label>
                            <label for="operationMVPAnnularPlication"  id="operationMVPAnnularPlicationLabel">&nbsp; &nbsp; &nbsp; &nbsp;Annular plication&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox-indent" name="operationMVPAnnularPlication" id="operationMVPAnnularPlication"  value="Y" <?php if($c->operationMVPAnnularPlication=='Y') echo "checked";?> onclick="chkMVP();"> 
                          </div>
                              <div class="line">
                            <label> </label>
                            <label for="operationMVPLeafletResection"   id="operationMVPLeafletResectionLabel">&nbsp; &nbsp; &nbsp; &nbsp;Leaflet resection &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox-indent" name="operationMVPLeafletResection" id="operationMVPLeafletResection"  value="Y" <?php if($c->operationMVPLeafletResection=='Y') echo "checked";?> onclick="chkMVP();"> 
                          </div>
                           <div class="line">
                            <label> </label>
                            <label for="operationMVPAlfieriStitch"   id="operationMVPAlfieriStitchLabel">&nbsp; &nbsp; &nbsp; &nbsp;Alfieri stitch &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox-indent" name="operationMVPAlfieriStitch" id="operationMVPAlfieriStitch"  value="Y" <?php if($c->operationMVPAlfieriStitch=='Y') echo "checked";?> onclick="chkMVP();"> 
                          </div>
                           <div class="line">
                            <label> </label>
                            <label for="operationMVPDeVegaAnnularPlasty"   id="operationMVPDeVegaAnnularPlastyLabel">&nbsp; &nbsp; &nbsp; &nbsp;De-Vega annular plasty &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox-indent" name="operationMVPDeVegaAnnularPlasty" id="operationMVPDeVegaAnnularPlasty"  value="Y" <?php if($c->operationMVPDeVegaAnnularPlasty=='Y') echo "checked";?> onclick="chkMVP();"> 
                          </div>
                             <div class="line">
                            <label> </label>
                            <label for="operationMVPOthers"   id="operationMVPOthersLabel">&nbsp; &nbsp; &nbsp; &nbsp;Others &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox-indent" name="operationMVPOthers" id="operationMVPOthers"  value="Y" <?php if($c->operationMVPOthers=='Y') echo "checked";?> onclick="chkMVP();"> 
                          </div>
                          <div class="line">
                            <label> MVR: </label>
                              <label for="Operation_MitralValve_MVR" id="Operation_MitralValve_MVR_Lalbel"></label>&nbsp;
                             <input type="checkbox" name="Operation_MitralValve_MVR" id="Operation_MitralValve_MVR"  value="Y" <?php if($c->Operation_MitralValve_MVR=='Y') echo "checked";?>  onclick="confirmVPVR('2','2');"> 
                             
                              <select name="operationMVR" id="operationMVR" onchange="chkMVR();">
                                   <option value=""></option>
                                   <option value="Mechanical valve"  <?php if($c->operationMVR=='Mechanical valve') echo "selected";?>>Mechanical valve</option>
                                   <option value="Bioprosthetic valve"  <?php if($c->operationMVR=='Bioprosthetic valve') echo "selected";?>>Bioprosthetic valve</option>
                                     <option value="Others"  <?php if($c->operationMVR=='Others') echo "selected";?>>Others</option>
                                   </select>
                             </div>
                            <div class="line" style="background-color: #ccff99;">
                            <label> </label>
                      
                             瓣膜名稱: <select name="MitralValveProductName" id="MitralValveProductName" onchange="">
                                 <option></option>
                                  <option value="<?php echo $c->MitralValveProductName;?>" selected><?php echo $c->MitralValveProductName;?></option>
                                  </select>
                                 
                          瓣膜尺寸: <input type="text" name="MitralValveProductType" id="MitralValveProductType"  class="small" value="<?php echo $c->MitralValveProductType;?>" onblur="chkPVP();" />
                                
                                  </div> 
                           <div class="line">
                            <label>備註: </label>
                           <textarea name="operationMVRMemo" id="operationMVRMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationMVRMemo;?></textarea>
                        </div>
                           </div>
                           
                              <div class="lineheader">
                            <label>Arrhythmia surgery:   </label>
                             <label for="operationArrythmiaSurgery"  id="operationArrythmiaSurgeryLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationArrythmiaSurgery" id="operationArrythmiaSurgery"  value="Y" <?php if($c->operationArrythmiaSurgery=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationArrythmiaSurgery','Operation_ArrythmiaSurgery');"> 
                            </div>
                            <div id="Operation_ArrythmiaSurgery" style="display:none"> 
                         <div class="line">
                            <label>Maze: </label>
                             <label for="operationMazebiatrialLesion"  id="operationMazebiatrialLesionLabel">Maze (biatrial lesion + PVI)&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationMazebiatrialLesion" id="operationMazebiatrialLesion"  value="Y" <?php if($c->operationMazebiatrialLesion=='Y') echo "checked";?>  onclick="chkMaze('1');"> 
                          </div>
                           <div class="line">
                            <label> </label>
                             <label for="operationMazeLA"  id="operationMazeLALabel">LA Maze (no RA lesion) &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationMazeLA" id="operationMazeLA"  value="Y" <?php if($c->operationMazeLA=='Y') echo "checked";?> onclick="chkMaze('2');"> 
                          </div>
                          <div class="line">
                            <label> </label>
                             <label for="operationMazePVIwithLAA" id="operationMazePVIwithLAALabel">PVI with LAA closure &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationMazePVIwithLAA" id="operationMazePVIwithLAA"  value="Y" <?php if($c->operationMazePVIwithLAA=='Y') echo "checked";?>  onclick="chkMaze('3');"> 
                          </div>
                           <div class="line">
                            <label> </label>
                             <label for="operationMazePVIwithoutLAA" id="operationMazePVIwithoutLAALabel">PVI without LAA closure &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationMazePVIwithoutLAA" id="operationMazePVIwithoutLAA"  value="Y" <?php if($c->operationMazePVIwithoutLAA=='Y') echo "checked";?>  onclick="chkMaze('4');"> 
                          </div>
                             <div class="line">
                            <label> </label>
                            <label for="operationMazeOthers"  id="operationMazeOthersLabel">Others&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationMazeOthers" id="operationMazeOthers"  value="Y" <?php if($c->operationMazeOthers=='Y') echo "checked";?>  onclick="chkMaze('5');"> 
                          </div>
                          
                             <div class="line">
                             <label> Energy source: </label>
                              <select name="operationMazeEnergySource" id="operationMazeEnergySource">
                                   <option value=""></option>
                                   <option value="RF monopolar"  <?php if($c->operationMazeEnergySource=='RF monopolar') echo "selected";?>>RF monopolar</option>
                                   <option value="NO cryo"  <?php if($c->operationMazeEnergySource=='NO cryo') echo "selected";?>>NO cryo</option>
                                   <option value="CO2 cryo"  <?php if($c->operationMazeEnergySource=='CO2 cryo') echo "selected";?>>CO2 cryo</option>
                                   <option value="RF bipolar"  <?php if($c->operationMazeEnergySource=='RF bipolar') echo "selected";?>>RF bipolar</option>
                                    <option value="Others"  <?php if($c->operationMazeEnergySource=='Others') echo "selected";?>>Others</option>
                                   </select>
                             </div>
                            
                            <div class="line">
                            <label>備註: </label>
                           <textarea name="operationMazeMemo" id="operationMazeMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationMazeMemo;?></textarea>
                        </div>
                        </div>
                        
                        
                            <div class="lineheader">
                            <label>Tricuspid valve surgery:   </label>
                             <label for="operationTricuspidValve" id="operationTricuspidValveLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationTricuspidValve" id="operationTricuspidValve"  value="Y" <?php if($c->operationTricuspidValve=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationTricuspidValve','Operation_TricuspidValve');"> 
                            </div>
                          <div id="Operation_TricuspidValve" style="display:none">   
                         <div class="line">
                            <label>TVP: </label>
                              <label for="Operation_TricuspidValve_TVP" id="Operation_TricuspidValve_TVP_Lalbel"></label>&nbsp;
                             <input type="checkbox" name="Operation_TricuspidValve_TVP" id="Operation_TricuspidValve_TVP"  value="Y" <?php if($c->Operation_TricuspidValve_TVP=='Y') echo "checked";?>  onclick="confirmVPVR('3','1');"> 
                             
                             </div>
                            <div class="line">
                            <label> </label>
                              <label for="operationTVPRing"  id="operationTVPRingLabel">&nbsp; &nbsp; &nbsp; &nbsp;Ring &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPRing" id="operationTVPRing"  value="Y" <?php if($c->operationTVPRing=='Y') echo "checked";?> onclick="chkTVP();qryValve('#TricuspidValveProductName', 'Annuloplasty Ring');"> 
                          </div>
                          <div class="line">
                            <label> </label>
                             <label for="operationTVPArtificialChord"  id="operationTVPArtificialChordLabel">&nbsp; &nbsp; &nbsp; &nbsp;Artificial chordae&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPArtificialChord" id="operationTVPArtificialChord"  value="Y" <?php if($c->operationTVPArtificialChord=='Y') echo "checked";?> onclick="chkTVP();" > 
                          </div>
                             <div class="line">
                            <label> </label>
                            <label for="operationTVPAnnularPlication" id="operationTVPAnnularPlicationLabel">&nbsp; &nbsp; &nbsp; &nbsp;Annular plication&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPAnnularPlication" id="operationTVPAnnularPlication"  value="Y" <?php if($c->operationTVPAnnularPlication=='Y') echo "checked";?> onclick="chkTVP();"> 
                          </div>
                              <div class="line">
                            <label> </label>
                            <label for="operationTVPLeafletResection"  id="operationTVPLeafletResectionLabel">&nbsp; &nbsp; &nbsp; &nbsp;Leaflet resection&nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPLeafletResection" id="operationTVPLeafletResection"  value="Y" <?php if($c->operationTVPLeafletResection=='Y') echo "checked";?> onclick="chkTVP();"> 
                          </div>
                          <div class="line">
                            <label> </label>
                            <label for="operationTVPAlfieriStitch"   id="operationTVPAlfieriStitchLabel">&nbsp; &nbsp; &nbsp; &nbsp;Alfieri stitch &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPAlfieriStitch" id="operationTVPAlfieriStitch"  value="Y" <?php if($c->operationTVPAlfieriStitch=='Y') echo "checked";?> onclick="chkTVP();"> 
                          </div>
                           <div class="line">
                            <label> </label>
                            <label for="operationTVPDeVegaAnnularPlasty"   id="operationTVPDeVegaAnnularPlastyLabel">&nbsp; &nbsp; &nbsp; &nbsp;De-Vega annular plasty &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPDeVegaAnnularPlasty" id="operationTVPDeVegaAnnularPlasty"  value="Y" <?php if($c->operationTVPDeVegaAnnularPlasty=='Y') echo "checked";?> onclick="chkTVP();"> 
                          </div>
                              <div class="line">
                            <label> </label>
                            <label for="operationTVPOthers"   id="operationTVPOthersLabel">&nbsp; &nbsp; &nbsp; &nbsp;Others &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationTVPOthers" id="operationTVPOthers"  value="Y" <?php if($c->operationTVPOthers=='Y') echo "checked";?> onclick="chkTVP();"> 
                          </div>
                          <div class="line">
                            <label> TVR </label>
                               <label for="Operation_TricuspidValve_TVR" id="Operation_TricuspidValve_TVR_Lalbel"></label>&nbsp;
                             <input type="checkbox" name="Operation_TricuspidValve_TVR" id="Operation_TricuspidValve_TVR"  value="Y" <?php if($c->Operation_TricuspidValve_TVR=='Y') echo "checked";?>  onclick="confirmVPVR('3','2');"> 
                            
                              <select name="operationTVR" id="operationTVR" onchange="chkTVR();">
                                   <option value=""></option>
                                   <option value="Mechanical valve"  <?php if($c->operationTVR=='Mechanical valve') echo "selected";?>>Mechanical valve</option>
                                   <option value="Bioprosthetic valve"  <?php if($c->operationTVR=='Bioprosthetic valve') echo "selected";?>>Bioprosthetic valve</option>
                                   </select>
                             </div>
                              <div class="line" style="background-color: #ccff99;">
                            <label> </label>
                      
                             瓣膜名稱: <select name="TricuspidValveProductName" id="TricuspidValveProductName" onchange="">
                                 <option></option>
                                  <option value="<?php echo $c->TricuspidValveProductName;?>" selected><?php echo $c->TricuspidValveProductName;?></option>
                                   </select>
                                 
                          瓣膜尺寸: <input type="text" name="TricuspidValveProductType" id="TricuspidValveProductType"  class="small" value="<?php echo $c->TricuspidValveProductType;?>" onblur="chkPVP();" />
                                
                                  </div> 
                           <div class="line">
                            <label>備註: </label>
                           <textarea name="operationTricuspidValveMemo" id="operationTricuspidValveMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationTricuspidValveMemo;?></textarea>
                        </div>
                        </div>
                           <div class="lineheader">
                            <label>Pulmonary valve surgery:   </label>
                             <label for="operationPulmonaryValve"  id="operationPulmonaryValveLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationPulmonaryValve" id="operationPulmonaryValve"  value="Y" <?php if($c->operationPulmonaryValve=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationPulmonaryValve','Operation_PulmonaryValve');"> 
                            </div>
                           <div id="Operation_PulmonaryValve" style="display:none"> 
                           <div class="line">
                            <label> PVP: </label>
                            <label for="Operation_PulmonaryValve_PVP" id="Operation_PulmonaryValve_PVP_Lalbel"></label>&nbsp;
                             <input type="checkbox" name="Operation_PulmonaryValve_PVP" id="Operation_PulmonaryValve_PVP"  value="Y" <?php if($c->Operation_PulmonaryValve_PVP=='Y') echo "checked";?>  onclick="confirmVPVR('4','1');"> 
                            
                           <input type="text" name="operationPulmonaryValvePVP" id="operationPulmonaryValvePVP"  class="small" value="<?php echo $c->operationPulmonaryValvePVP;?>" onblur="chkPVP();" />
                            </div>
                            <div class="line">
                             <label> PVR: </label>
                              <label for="Operation_PulmonaryValve_PVR" id="Operation_PulmonaryValve_PVR_Lalbel"></label>&nbsp;
                             <input type="checkbox" name="Operation_PulmonaryValve_PVR" id="Operation_PulmonaryValve_PVR"  value="Y" <?php if($c->Operation_PulmonaryValve_PVR=='Y') echo "checked";?>  onclick="confirmVPVR('4','2');"> 
                            
                              <select name="operationPulmonaryValvePVR" id="operationPulmonaryValvePVR" onchange="chkPVR();">
                                   <option value=""></option>
                                   <option value="Mechanical"  <?php if($c->operationPulmonaryValvePVR=='Mechanical') echo "selected";?>>Mechanical</option>
                                   <option value="Bioprosthesis"  <?php if($c->operationPulmonaryValvePVR=='Bioprosthesis') echo "selected";?>>Bioprosthesis</option>
                                   </select>
                             </div>
                         <div class="line" style="background-color: #ccff99;">
                            <label> </label>
                      
                             瓣膜名稱: <select name="PulmonaryValveProductName" id="PulmonaryValveProductName" onchange="">
                                 <option></option>
                                    <option value="<?php echo $c->PulmonaryValveProductName;?>" selected><?php echo $c->PulmonaryValveProductName;?></option>
                                  </select>
                                 
                          瓣膜尺寸: <input type="text" name="PulmonaryValveProductType" id="PulmonaryValveProductType"  class="small" value="<?php echo $c->PulmonaryValveProductType;?>" onblur="chkPVP();" />
                                
                                  </div> 
                              <div class="line">
                            <label>備註: </label>
                           <textarea name="operationPulmonaryValveMemo"  id="operationPulmonaryValveMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationPulmonaryValveMemo;?></textarea>
                        </div>
                        </div>
                        
                         
                         
                               <div class="lineheader">
                            <label>Heart transplant & Mechanical support:   </label>
                             <label for="operationHeartTransplantation"  id="operationHeartTransplantationLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationHeartTransplantation" id="operationHeartTransplantation"  value="Y" <?php if($c->operationHeartTransplantation=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationHeartTransplantation','Operation_HeartTransplantation');"> 
                            </div>
                            <div id="Operation_HeartTransplantation" style="display:none"> 
                                  <div class="line">
                                   <label>Heart transplant: </label>
                             <label for="operationHeartTransplantationOP"  id="operationHeartTransplantationOPLabel">  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationHeartTransplantationOP" id="operationHeartTransplantationOP"  value="Y" <?php if($c->operationHeartTransplantationOP=='Y') echo "checked";?>> 
                          </div>
                            <div class="line">
                                   <label>LVAD: </label>
                             <label for="operationHeartTransplantationLVAD"  id="operationHeartTransplantationLVADLabel">  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationHeartTransplantationLVAD" id="operationHeartTransplantationLVAD"  value="Y" <?php if($c->operationHeartTransplantationLVAD=='Y') echo "checked";?>> 
                          </div>
                            <div class="line">
                                   <label>RVAD: </label>
                             <label for="operationHeartTransplantationRVAD"  id="operationHeartTransplantationRVADLabel">  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationHeartTransplantationRVAD" id="operationHeartTransplantationRVAD"  value="Y" <?php if($c->operationHeartTransplantationRVAD=='Y') echo "checked";?>> 
                          </div>
                               <div class="line">
                            <label>備註: </label>
                           <textarea name="operationHeartTransplantationMemo" id="operationHeartTransplantationMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationHeartTransplantationMemo;?></textarea>
                        </div>
                        </div>
                        
                          <div class="lineheader">
                            <label>Other cardiac surgery:   </label>
                             <label for="operationOtherCardiacSurgery"  id="operationOtherCardiacSurgeryLabel"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery" id="operationOtherCardiacSurgery"  value="Y" <?php if($c->operationOtherCardiacSurgery=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationOtherCardiacSurgery','Operation_OtherCardiacSurgery');"> 
                            </div>
                            <div id="Operation_OtherCardiacSurgery" style="display:none"> 
                                  <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery1"  id="operationOtherCardiacSurgery1Label">  &nbsp;Repair of Post-MI free wall rupture </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery1" id="operationOtherCardiacSurgery1"  value="Y" <?php if($c->operationOtherCardiacSurgery1=='Y') echo "checked";?>> 
                          </div>
                              <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery2"  id="operationOtherCardiacSurgery2Label">  &nbsp;Repair of Post-MI ventricular septal defect (VSR)  </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery2" id="operationOtherCardiacSurgery2"  value="Y" <?php if($c->operationOtherCardiacSurgery2=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery3"  id="operationOtherCardiacSurgery3Label">  &nbsp;Repair of traumatic cardiac rupture </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery3" id="operationOtherCardiacSurgery3"  value="Y" <?php if($c->operationOtherCardiacSurgery3=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery4"  id="operationOtherCardiacSurgery4Label">  &nbsp;Intracardiac tumor excision </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery4" id="operationOtherCardiacSurgery4"  value="Y" <?php if($c->operationOtherCardiacSurgery4=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery5"  id="operationOtherCardiacSurgery5Label">  &nbsp;Septal myectomy </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery5" id="operationOtherCardiacSurgery5"  value="Y" <?php if($c->operationOtherCardiacSurgery5=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery6"  id="operationOtherCardiacSurgery6Label">  &nbsp;Pericardiectomy </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery6" id="operationOtherCardiacSurgery6"  value="Y" <?php if($c->operationOtherCardiacSurgery6=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery7"  id="operationOtherCardiacSurgery7Label">  &nbsp;LV aneurysm surgery </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery7" id="operationOtherCardiacSurgery7"  value="Y" <?php if($c->operationOtherCardiacSurgery7=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery8"  id="operationOtherCardiacSurgery8Label">  &nbsp;Pulmonary embolectomy </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery8" id="operationOtherCardiacSurgery8"  value="Y" <?php if($c->operationOtherCardiacSurgery8=='Y') echo "checked";?>> 
                          </div>
                             <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery9"  id="operationOtherCardiacSurgery9Label">  &nbsp;Pulmonary endarterectomy </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery9" id="operationOtherCardiacSurgery9"  value="Y" <?php if($c->operationOtherCardiacSurgery9=='Y') echo "checked";?>> 
                          </div>
                            <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery11"  id="operationOtherCardiacSurgery11Label">  &nbsp;Cardiac Implantable Electronic Device lead insertion, replacement, or extraction </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery11" id="operationOtherCardiacSurgery11"  value="Y" <?php if($c->operationOtherCardiacSurgery11=='Y') echo "checked";?>> 
                          </div>
                          <div class="line">
                                   <label></label>
                             <label for="operationOtherCardiacSurgery10"  id="operationOtherCardiacSurgery10Label">  &nbsp;Others </label> &nbsp;
                            <input type="checkbox" class="checkbox" name="operationOtherCardiacSurgery10" id="operationOtherCardiacSurgery10"  value="Y" <?php if($c->operationOtherCardiacSurgery10=='Y') echo "checked";?>> 
                          </div>
                          
                               <div class="line">
                            <label>備註: </label>
                           <textarea name="operationOtherCardiacSurgeryMemo" id="operationOtherCardiacSurgeryMemo"  class="textarea" cols="55" rows="10"><?php echo $c->operationOtherCardiacSurgeryMemo;?></textarea>
                        </div>
                        </div>
                        
                                 <div class="line button">
                           
                            <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                </form>
            </div>
        </div>
      
        <div class="box" id="divCongenitalSurgery">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                   <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                  <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                    </div>
                </div>
                <div class="title">
                    <h2>Operation procedures</h2>
                </div>
                 <form name="congenitalProcedureForm" id="congenitalProcedureForm" action="<?php echo base_url(); ?>patient/CongenitalSurgery" method="post">
                      
                            <div class="line">
                            <label>Surgeon 1
                                <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Surgeon 1為此筆病患資料的擁有者, \n若非得到該Surgeon 1的授權即無法修改此筆病患資料",{className:"info",autoHide: false});'></img></label>
                          
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
                            <label>Surgeon 2</label>
                          
                               <select name="patientSurgeon2" id="patientSurgeon2">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon2) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>Surgeon 3</label>
                          
                               <select name="patientSurgeon3" id="patientSurgeon3">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon3) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>Surgeon 4</label>
                          
                               <select name="patientSurgeon4" id="patientSurgeon4">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon4) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                         <div class="line"  style="background-color:#F5A9E1">
                            <label>Cardiopulmonary Bypass</label>
                          
                               <select name="patientCardiopulmonaryBypass" id="patientCardiopulmonaryBypassCongenital" onchange="chkCABG();">
                                   <option value=""></option>
                                   <option value="1" <?php if($c->patientCardiopulmonaryBypass=='1') echo "selected";?>>CPB with cardiac arrest(or ventricular fibrillation)</option>
                                   <option value="2" <?php if($c->patientCardiopulmonaryBypass=='2') echo "selected";?>>CPB without cardiac arrest</option>
                                   <option value="3" <?php if($c->patientCardiopulmonaryBypass=='3') echo "selected";?>>only ECMO support</option>
                                   <option value="4" <?php if($c->patientCardiopulmonaryBypass=='4') echo "selected";?>>no CPB or ECMO support</option>
                                </select>
                        </div>      
                        
                             <div class="line"  style="background-color:#F5A9E1">
                            <label>>Previous Cardiac Operation
                                 <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Re-do operation 選 1；Tri-do operation 選 2；依此類推...",{className:"info",autoHide: false});'></img></label>
                          
                                </label>
                          
                               <select name="patientReoperation" id="patientReoperation">
                                   <option value=""></option>
                                      <?php 
                            for($i=1;$i<=6;$i++){
                                     ?>
                                     <option value="<?php echo $i;?>" <?php if($i== $c->patientReoperation) echo "selected";?>><?php echo $i;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                    <div class="line"  style="background-color:#F5A9E1">
                            <label>Operative approach</label>
                          
                               <select name="patientOperativeApproach" id="patientOperativeApproach">
                                   <option value="1" <?php if($c->patientOperativeApproach=='1') echo "selected";?>>Full conventional sternotomy</option>
                                   <option value="2" <?php if($c->patientOperativeApproach=='2') echo "selected";?>>Partial sternotomy</option>
                                   <option value="3" <?php if($c->patientOperativeApproach=='3') echo "selected";?>>Parasternal incision</option>
                                   <option value="4" <?php if($c->patientOperativeApproach=='4') echo "selected";?>>Thoracotomy</option>
                                   <option value="5" <?php if($c->patientOperativeApproach=='5') echo "selected";?>>Mini-thoracotomy</option>
                                   <option value="6" <?php if($c->patientOperativeApproach=='6') echo "selected";?>>Thoracoabdominal Incision</option>
                                   <option value="7" <?php if($c->patientOperativeApproach=='7') echo "selected";?>>Percutaneous</option>
                                   <option value="9" <?php if($c->patientOperativeApproach=='9') echo "selected";?>>Others</option>
                               </select>
                        </div>        
                         <div class="line"  style="background-color:#F5A9E1">
                            <label>Robotic Used</label>
                                  <select name="patientRoboticUsed" id="patientRoboticUsed">
                                  <option value="0"  <?php if($c->patientRoboticUsed=='0') echo "selected";?>>No</option>
                                   <option value="1"  <?php if($c->patientRoboticUsed=='1') echo "selected";?>>Yes, used for entire operation</option>
                                   <option value="2" <?php if($c->patientRoboticUsed=='2') echo "selected";?>>Yes, used for part of the operation</option>
                                   </select>
                        </div>   
                <div class="title">
                    <h2></h2>
                    <span class="currentsurgery"><a href="#" onclick="callHideShow('divOperation')">Open heart Surgery</a></span>
                    <span class="surgery">Congenital Surgery</span>
                   
                </div>
                   
                          
                           
                               <div class="line">
                            <label>Diagnosis 1</label>
                          
                             <input type="text" name="CongenitalDiagnosis1" id="CongenitalDiagnosis1" class="big" value="<?php echo $c->CongenitalDiagnosis1;?>" readonly />
                              <input type="hidden" name="CongenitalDiagnosis_id1" id="CongenitalDiagnosis_id1" class="small" value="<?php echo $c->CongenitalDiagnosis_id1;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryDiagnosis/1"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildDiagnosis('1')"><img src="/images/cross-circle.png"></a>
                             </div>
                               <div class="line">
                            <label>Diagnosis 2</label>
                          
                             <input type="text" name="CongenitalDiagnosis2" id="CongenitalDiagnosis2" class="big" value="<?php echo $c->CongenitalDiagnosis2;?>" readonly />
                            <input type="hidden" name="CongenitalDiagnosis_id2" id="CongenitalDiagnosis_id2" class="small" value="<?php echo $c->CongenitalDiagnosis_id2;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryDiagnosis/2"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildDiagnosis('2')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 3</label>
                          
                             <input type="text" name="CongenitalDiagnosis3" id="CongenitalDiagnosis3" class="big" value="<?php echo $c->CongenitalDiagnosis3;?>" readonly/>
                             <input type="hidden" name="CongenitalDiagnosis_id3" id="CongenitalDiagnosis_id3" class="small" value="<?php echo $c->CongenitalDiagnosis_id3;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryDiagnosis/3"><img src="/images/plus-circle.png"></a>
                            <a  href="javascript:deleteChildDiagnosis('3')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 4</label>
                          
                             <input type="text" name="CongenitalDiagnosis4" id="CongenitalDiagnosis4" class="big" value="<?php echo $c->CongenitalDiagnosis4;?>" readonly />
                             <input type="hidden" name="CongenitalDiagnosis_id4" id="CongenitalDiagnosis_id4" class="small" value="<?php echo $c->CongenitalDiagnosis_id4;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryDiagnosis/4"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildDiagnosis('4')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 5</label>
                          
                             <input type="text" name="CongenitalDiagnosis5" id="CongenitalDiagnosis5" class="big" value="<?php echo $c->CongenitalDiagnosis5;?>" readonly />
                             <input type="hidden" name="CongenitalDiagnosis_id5" id="CongenitalDiagnosis_id5" class="small" value="<?php echo $c->CongenitalDiagnosis_id5;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryDiagnosis/5"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildDiagnosis('5')"><img src="/images/cross-circle.png"></a>
                             </div>
                         <div class="line">
                            <label>Diagnosis Others: </label>
                           <textarea name="CongenitalDiagnosisOthers" class="textarea" cols="55" rows="10"><?php echo $c->CongenitalDiagnosisOthers;?></textarea>
                        </div>
                           <div class="line">
                            <label>Primary Procedure </label>
                          
                             <input type="text" name="CongenitalProcedure1" id="CongenitalProcedure1" class="big" value="<?php echo $c->CongenitalProcedure1;?>" readonly />
                             <input type="hidden" name="CongenitalProcedure_id1" id="CongenitalProcedure_id1" class="small" value="<?php echo $c->CongenitalProcedure_id1;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryProcedure/1"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('1')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                              <div class="line">
                            <label>Secondary Procedure 1</label>
                          
                             <input type="text" name="CongenitalProcedure2" id="CongenitalProcedure2" class="big" value="<?php echo $c->CongenitalProcedure2;?>" readonly />
                             <input type="hidden" name="CongenitalProcedure_id2" id="CongenitalProcedure_id2" class="small" value="<?php echo $c->CongenitalProcedure_id2;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryProcedure/2"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('2')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                               <div class="line">
                            <label>Secondary Procedure 2</label>
                          
                             <input type="text" name="CongenitalProcedure3" id="CongenitalProcedure3" class="big" value="<?php echo $c->CongenitalProcedure3;?>" readonly />
                             <input type="hidden" name="CongenitalProcedure_id3" id="CongenitalProcedure_id3" class="small" value="<?php echo $c->CongenitalProcedure_id3;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryProcedure/3"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('3')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                               <div class="line">
                            <label>Secondary Procedure 3</label>
                          
                             <input type="text" name="CongenitalProcedure4" id="CongenitalProcedure4" class="big" value="<?php echo $c->CongenitalProcedure4;?>" readonly />
                             <input type="hidden" name="CongenitalProcedure_id4" id="CongenitalProcedure_id4" class="small" value="<?php echo $c->CongenitalProcedure_id4;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryProcedure/4"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('4')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                               <div class="line">
                            <label>Secondary Procedure 4</label>
                          
                             <input type="text" name="CongenitalProcedure5" id="CongenitalProcedure5" class="big" value="<?php echo $c->CongenitalProcedure5;?>" readonly/>
                             <input type="hidden" name="CongenitalProcedure_id5" id="CongenitalProcedure_id5" class="small" value="<?php echo $c->CongenitalProcedure_id5;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryProcedure/5"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('5')"><img src="/images/cross-circle.png"></a>
                             </div>
                              <div class="line">
                            <label>Procedure Others: </label>
                           <textarea name="CongenitalProcedureOthers" class="textarea" cols="55" rows="10"><?php echo $c->CongenitalProcedureOthers;?></textarea>
                        </div>
                             <div class="lineheader">
                            <label>Bypass:   </label>
                             <label for="operationCongenitalBypass"></label> &nbsp;
                             <input type="checkbox" class="checkbox" name="operationCongenitalBypass" id="operationCongenitalBypass"  value="Y" <?php if($c->operationCongenitalBypass=='Y') echo "checked";?>  onclick="confirmOperationDetail('operationCongenitalBypass','Operation_CongenitalBypass');"> 
                            </div>
                             <div id="Operation_CongenitalBypass" style="display:none">
                               <div class="line">
                                    
                            <label>Total CPB time:  
                              
                            </label>
                            <label for="operationCongenitalBypassCPBTime" id="operationCongenitalBypassCPBTime_Lalbel"></label>
                             <input type="text"  class="small" name="operationCongenitalBypassCPBTime" id="operationCongenitalBypassCPBTime"  value="<?php echo $c->operationCongenitalBypassCPBTime;?>" onblur="javascript:chkCPBTime();"> min 
                           </div>
                             <div class="line">
                             <label>Aortic cross clump time:   
                              
                            </label>
                            <label for="operationCongenitalBypassAorticTime" id="operationCongenitalBypassAorticTime_Lalbel"></label>
                             <input type="text"  class="small" name="operationCongenitalBypassAorticTime" id="operationCongenitalBypassAorticTime"  value="<?php echo $c->operationCongenitalBypassAorticTime;?>" onblur="javascript:chkCPBTime();"> min 
                           </div>
                             <div class="line">
                             <label>Circulatory arrest time:  
                              
                            </label>
                            <label for="operationCongenitalBypassCirculatoryTime" id="operationCongenitalBypassCirculatoryTime_Lalbel"></label>
                             <input type="text"  class="small" name="operationCongenitalBypassCirculatoryTime" id="operationCongenitalBypassCirculatoryTime"  value="<?php echo $c->operationCongenitalBypassCirculatoryTime;?>"> min 
                           </div>
                             <div class="line">
                                   <label>Cardioplegia:  
                              
                            </label>
                              <select name="operationCongenitalBypassCardioplegia" id="operationCongenitalBypassCardioplegia" class="large">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="HTK"  <?php if($c->operationCongenitalBypassCardioplegia=='HTK') echo "selected";?>>HTK</option>
                                   <option  class="large" value="Blood Plegisol"  <?php if($c->operationCongenitalBypassCardioplegia=='Blood Plegisol') echo "selected";?>>Blood Plegisol</option>
                                   <option  class="large" value="Non-blood Plegisol"  <?php if($c->operationCongenitalBypassCardioplegia=='Non-blood Plegisol') echo "selected";?>>Non-blood Plegisol</option>
                                   <option  class="large" value="Others"  <?php if($c->operationCongenitalBypassCardioplegia=='Others') echo "selected";?>>Others</option>
                                    </select>
                            </div>
                        
                        </div>
                          <div class="line">
                                   <label>RACHS Class:  
                              
                            </label>
                              <select name="operationCongenitalBypassRACHS" id="operationCongenitalBypassRACHS" class="large">
                                   <option value="" class="small"></option>
                                   <option  class="small" value="1"  <?php if($c->operationCongenitalBypassRACHS=='1') echo "selected";?>>1</option>
                                   <option  class="small" value="2"  <?php if($c->operationCongenitalBypassRACHS=='2') echo "selected";?>>2</option>
                                   <option  class="small" value="3"  <?php if($c->operationCongenitalBypassRACHS=='3') echo "selected";?>>3</option>
                                   <option  class="small" value="4"  <?php if($c->operationCongenitalBypassRACHS=='4') echo "selected";?>>4</option>
                                   <option  class="small" value="5"  <?php if($c->operationCongenitalBypassRACHS=='5') echo "selected";?>>5</option>
                                   <option  class="small" value="6"  <?php if($c->operationCongenitalBypassRACHS=='6') echo "selected";?>>6</option>
                                   </select>
                                    <a class="pdf" href="<?php echo base_url(); ?>patient/RACHS"> <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"></img></a>
                            </div>
                              <div class="line">
                                   <label>STS Mortality Category:  
                              
                            </label>
                              <select name="operationCongenitalBypassSTS" id="operationCongenitalBypassSTS" class="large">
                                   <option value="" class="small"></option>
                                   <option  class="small" value="1"  <?php if($c->operationCongenitalBypassSTS=='1') echo "selected";?>>1</option>
                                   <option  class="small" value="2"  <?php if($c->operationCongenitalBypassSTS=='2') echo "selected";?>>2</option>
                                   <option  class="small" value="3"  <?php if($c->operationCongenitalBypassSTS=='3') echo "selected";?>>3</option>
                                   <option  class="small" value="4"  <?php if($c->operationCongenitalBypassSTS=='4') echo "selected";?>>4</option>
                                   <option  class="small" value="5"  <?php if($c->operationCongenitalBypassSTS=='5') echo "selected";?>>5</option>
                                    </select>
                                    <a class="pdf" href="<?php echo base_url(); ?>patient/STSMortalitycategory"> <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"></img></a>
                            </div>
                            <div class="line">
                                   <label>Benchmark Procedure:  
                              
                            </label>
                              <select name="BenchmarkSurgery" id="BenchmarkSurgery" class="large">
                                   
                                   <option  class="small" value="0"  <?php if($c->BenchmarkSurgery=='0' || $c->BenchmarkSurgery=='') echo "selected";?>>NA</option>
                                   <option  class="small" value="1"  <?php if($c->BenchmarkSurgery=='1') echo "selected";?>>VSD</option>
                                   <option  class="small" value="2"  <?php if($c->BenchmarkSurgery=='2') echo "selected";?>>TOF</option>
                                   <option  class="small" value="3"  <?php if($c->BenchmarkSurgery=='3') echo "selected";?>>ASO</option>
                                   <option  class="small" value="4"  <?php if($c->BenchmarkSurgery=='4') echo "selected";?>>ASO+VSD</option>
                                   <option  class="small" value="5"  <?php if($c->BenchmarkSurgery=='5') echo "selected";?>>ECD (AVSD)</option>
                                   <option  class="small" value="6"  <?php if($c->BenchmarkSurgery=='6') echo "selected";?>>Fontan</option>
                                   <option  class="small" value="7"  <?php if($c->BenchmarkSurgery=='7') echo "selected";?>>Truncus</option>
                                   <option  class="small" value="8"  <?php if($c->BenchmarkSurgery=='8') echo "selected";?>>Norwood</option>
                                    </select>
                                   
                            </div>
                               <div class="line">
                            <label>備註: </label>
                           <textarea name="operationCongenitalBypassMemo" class="textarea" cols="55" rows="10"><?php echo $c->operationCongenitalBypassMemo;?></textarea>
                        </div>
                       
                        
                            <div class="line button">
                           
                         <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="button" class="blue medium" onclick="chkCongenitalBypass();"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                        
                             </form>
           
        </div>
     </div>
     <form action="<?php echo base_url(); ?>patient/patientOutcome" method="post">
       <div class="box" id="divOutcome">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                 
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                  <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                    <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                   </div>
                </div>
                
                <div class="title">
                    <h2>Outcome results </h2>
                </div>
                
              
                    
                          
                        <div class="line">
                            <label>Extubation date
                                <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("指離開開刀房後，第一次拔管的日期，\n不管病人有沒有重插管、拔管失敗、或病人自拔管等。\n如果病人都沒有拔管後來做氣切，\nextubation date要登錄第一次脫離呼吸器的日期。\n如果病人死亡，登錄死亡當日。\n如果病人帶著著呼吸器回家或長照機構，則登錄出院當日。",{className:"info",autoHide: false});'></img>
                          </label>
                            <input type="text" name="outcomeExtubationDate" id="outcomeExtubationDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->outcomeExtubationDate);?>"/>
                        </div>
                          <div class="line">
                            <label>ICU Discharge date
                                 <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("第一次離開加護病房 的時間，如果是重入ICU則不計算。",{className:"info",autoHide: false});'></img></label>
                            <input type="text" name="patientICUDischargeDate" id="patientICUDischargeDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientICUDischargeDate);?>" />
                        </div>
                        <div class="line">
                            <label>Discharge date
                                <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("登錄病人出院當天。如果病人是轉其他醫院、\n機構、甚至是其他醫院的ICU，都是登錄轉出當日。\n如果病人死亡，Discharge date欄位登錄死亡日期。",{className:"info",autoHide: false});'></img></label>  </label>
                          </label>
                            <input type="text" name="patientDischargeDate" id="patientDischargeDate1" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>"  onchange="javascript:calLOS('2',this);"/>
                        </div>
                              <div class="line">
                                   <label>出院狀況:  
                              
                            </label>
                              <select name="outcomeStatus" id="outcomeStatus" class="large" onchange="chkMortality();">
                                   <option value="" class="small"></option>
                                   <option  class="small" value="1: 治療出院 "  <?php if($c->outcomeStatus=='1: 治療出院 ') echo "selected";?>>1: 治療出院 </option>
                                   <option  class="small" value="2: 繼續住院"  <?php if($c->outcomeStatus=='2: 繼續住院') echo "selected";?>>2: 繼續住院</option>
                                   <option  class="small" value="3:改門診治療"  <?php if($c->outcomeStatus=='3:改門診治療') echo "selected";?>>3:改門診治療</option>
                                   <option  class="small" value="4: 死亡"  <?php if($c->outcomeStatus=='4: 死亡') echo "selected";?>>4: 死亡 </option>
                                   <option  class="small" value="5: 一般自動出院"  <?php if($c->outcomeStatus=='5: 一般自動出院') echo "selected";?>>5: 一般自動出院</option>
                                   <option  class="small" value="6: 轉院"  <?php if($c->outcomeStatus=='6: 轉院') echo "selected";?>>6: 轉院</option>
                                   <option  class="small" value="7: 身份變更"  <?php if($c->outcomeStatus=='7: 身份變更') echo "selected";?>>7: 身份變更</option>
                                   <option  class="small" value="8: 潛逃"  <?php if($c->outcomeStatus=='8: 潛逃') echo "selected";?>>8: 潛逃</option>
                                   <option  class="small" value="9: 自殺"  <?php if($c->outcomeStatus=='9: 自殺') echo "selected";?>>9: 自殺</option>
                                   <option  class="small" value="0: 其它"  <?php if($c->outcomeStatus=='0: 其它') echo "selected";?>>0: 其它</option>
                                   <option  class="small" value="A：病危自動出院"  <?php if($c->outcomeStatus=='A：病危自動出院') echo "selected";?>>A：病危自動出院</option>
                                    </select>
                                     </div>
                                           <div class="line">
                                   <label>  
                              
                            </label>
                                     <a href="#divChildOutcome">
                                         <button type="button" id="btnShowComplication" class="blue medium" onclick="showComplication();"><span>complications of CHD</span></button></a>
                                     <a class="chdMMemo" data-fancybox-type="iframe" href="/patient/CHDMemo">
                                         <button  class="orange medium"><span>顯示Endpoint與complications of CHD說明</span></button> </a>
                                     </div>
                        <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap></th>
                                <th nowrap>﻿Endpoint </th>
                                <th nowrap>definition </th>
                               <th nowrap>Free Note</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck1" id="outcomeCheck1"  value="Y" <?php if($c->outcomeCheck1=='Y') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Operative Mortality </th>
                                <td>Operative mortality includes both (1) all deaths occurring during the hospitalization in which the operation was performed, even if after 30 days; and (2) those deaths occurring after discharge from the hospital, but within 30 days of the procedure unless the cause of death is clearly unrelated to the operation. </td>
                               <td> <textarea name="outcomeData1" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData1;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck2" id="outcomeCheck2"  value="Y" <?php if($c->outcomeCheck2=='Y') echo "checked";?>  onclick="chkMorbidity();checkAdult('2');"> </td>
                                <td>Permanent Stroke 
                                     <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Stroke的症狀包含：\n • Sudden numbness or weakness, especially on one side of the body\n • Sudden confusion or trouble speaking or understanding speech\n • Sudden trouble seeing in one or both eyes\n • Sudden trouble with walking, dizziness, or loss of balance or coordination \n • Sudden severe headache with no known cause\n Confusion, delirium and/or encephalopathic (anoxic or metabolic) events, \npostoperative paralysis, paraparesis, or paraplegia related to spinal cord ischemia \n不算在stroke裡。只要有神經科醫師臨床診斷，不一定要有影像學診斷。",{className:"info",autoHide: false});'></img></label>  </label>
                          </th>
                                <td>Postoperative stroke (i.e., any confirmed neurological deficit of abrupt onset caused by a disturbance in cerebral blood supply) that did not resolve within 24 hours. </td>
                               <td> <textarea name="outcomeData2" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData2;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck3" id="outcomeCheck3"  value="Y" <?php if($c->outcomeCheck3=='Y') echo "checked";?>  onclick="chkMorbidity();checkAdult('3');"> </td>
                                <td>Renal Failure 
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("“most recent preoperative creatinine level”，\n是指開刀麻醉前最近的creatinine level。\n如果病人術前就已經在洗腎了，術後不管有沒有繼續洗腎，都不勾renal failure。",{className:"info",autoHide: false});'></img></label>  </label>
                           </th>
                                <td>Acute or worsening renal failure resulting in one or more of the 1. Increase in serum creatinine level x3  most recent preoperative creatinine level, or ≥ 4.0 mg/dL; acute rise must be ≥ 0.5 mg/dL 2. A new requirement for dialysis postoperatively.  </td>
                               <td> <textarea name="outcomeData3" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData3;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck4" id="outcomeCheck4"  value="Y" <?php if($c->outcomeCheck4=='Y') echo "checked";?>  onclick="chkMorbidity();"> </td>
                                <td>Prolonged Ventilation > 24 hours 
                                     <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Ventilation的時間要以出開刀房的時間算起，\n時間應精確到”分鐘“，並且除了算到”initial extubation time”(術後首次拔管時間)之外，\n還需加上reintubation ventilation time（重插管後呼吸器使用時間），\n如果總時間有超過1440分鐘（24小時），即要登錄prolonged ventilation。\n如果重插管是為了手術需求，則不需要把重插管後呼吸器使用時間加進去。",{className:"info",autoHide: false});'></img></label>  </label>
                          </th>
                                <td>Prolonged pulmonary ventilator > 24 hours. Include (but not limited to) causes such as ARDS, pulmonary edema, and/or any patient requiring mechanical ventilation > 24 hours postoperatively.  </td>
                               <td> <textarea name="outcomeData4" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData4;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck5" id="outcomeCheck5"  value="Y" <?php if($c->outcomeCheck5=='Y') echo "checked";?>  onclick="chkMorbidity();checkAdult('5');"> </td>
                                <td>Deep Sternal Wound Infection 
                                     <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("只要culture negative，\n就不能算是deep sternal wound infection",{className:"info",autoHide: false});'></img></label>  </label>
                          </th>
                                <td>Deep sternal infection, within 30 days of the procedure or any time during the hospitalization for surgery, involving muscle, bone, and/or mediastinum and patient has at least one of the following:
   <ul>
    <li> Purulent drainage from the deep incision.
    <li>A deep incision that spontaneously dehisces or is deliberately opened by a surgeon, attending physician or other designee and is culture‐positive or not cultured, and patient has at least one of the following signs or symptoms:
  
         <ul> 
              <li>    Fever (>38°C)
              <li>    Localized pain or tenderness
              <li>    An abscess or other evidence of infection involving the deep incision that is detected on direct examination, during invasive procedure, or by histopathologic examination or imaging test.
   </ul><li>A culture with negative findings does not meet this criterion.
    </ul> 
 </td>
                               <td> <textarea name="outcomeData5" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData5;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck6" id="outcomeCheck6"  value="Y" <?php if($c->outcomeCheck6=='Y') echo "checked";?>  onclick="checkOutcomeReopen();chkMorbidity();"> </td>
                                <td>Reoperation For any reason </th>
                                <td>Reoperation for bleeding/tamponade, valvular dysfunction, graft occlusion, other cardiac reason, or non-cardiac reason </td>
                               <td> <textarea name="outcomeData6" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData6;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeCheck7" id="outcomeCheck7"  value="Y" <?php if($c->outcomeCheck7=='Y') echo "checked";?> onclick="chkMorbidity();$(this).notify('此欄位為系統自己計算, 使用者無法選取/填寫');"> </td>
                                <td>Major Morbidity or Operative Mortality </th>
                                <td>A composite endpoint defined as any of the outcomes listed in the first six rows of this table.<br/><font color=red>*此欄位為系統自己計算, 使用者無法選取/填寫</font> </td>
                               <td> <textarea name="outcomeData7" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData7;?></textarea></td>
                            </tr> 
              <tr> 
                                <td></td>
                                <td>LOS <input type="text" name="outcomeCheck8" id="outcomeCheck8" class="smallDisabled" readonly  value="<?php echo $c->outcomeCheck8;?>" onclick="$(this).notify('此欄位為系統自己計算, 使用者無法選取/填寫');"/></th>
                                <td>days from operation to hospital discharge.<br/><font color=red>*此欄位為系統自己計算, 使用者無法選取/填寫</font></td>
                               <td> <textarea name="outcomeData8" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData8;?></textarea></td>
                            </tr> 
                               <tr> 
                                <td> <input type="checkbox" class="checkbox" onclick="this.checked=!this.checked;$(this).notify('此欄位為系統自己計算, 使用者無法選取/填寫');" name="outcomeCheck9" id="outcomeCheck9"  value="Y" <?php if($c->outcomeCheck9=='Y') echo "checked";?>> </td>
                                <td>Short Stay: PLOS < 6 days  </th>
                                <td>Discharged alive and within 5 days of surgery<br/><font color=red>*此欄位為系統自己計算, 使用者無法選取/填寫</font> </td>
                               <td> <textarea name="outcomeData9" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData9;?></textarea></td>
                            </tr> 
                              <tr> 
                                <td> <input type="checkbox" class="checkbox" onclick="this.checked=!this.checked;$(this).notify('此欄位為系統自己計算, 使用者無法選取/填寫');" name="outcomeCheck10" id="outcomeCheck10"  value="Y" <?php if($c->outcomeCheck10=='Y') echo "checked";?>> </td>
                                <td>Long Stay: PLOS >14 days </th>
                                <td>Failure to be discharged within 14 days of surgery<br/><font color=red>*此欄位為系統自己計算, 使用者無法選取/填寫</font> </td>
                               <td> <textarea name="outcomeData10" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeData10;?></textarea></td>
                            </tr>       
                            </tbody>
                            </table>
                          
                      <div class="line button">
                           
                            <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                             </td>
                                
                                
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
           
            </div>
            <div class="box" id="divChildOutcome">
                <div class="content forms">
                  
              
              
                         
                   
                                            <div class="lineheader">
                            <label>Specify complication(s)  </label>
                             <label for="Specifycomplication"></label> &nbsp;
                             </div>
                        <table cellspacing="0" cellpadding="0" border="0" width="100%" id="lessComplication"> 
                        <thead> 
                            <tr> 
                                <th nowrap></th>
                                <th nowrap>Specify complication </th>
                                <th nowrap></th>
                                <th nowrap>Specify complication </th>
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                               <td><input type="checkbox" class="checkbox" name="simpleChildComplication4" id="simpleChildComplication4"  value="Y" <?php if($c->outcomeChildComplication4=='Y') echo "checked";?> onclick="checkSimple('4');checkReopen();"> </td>
                               <td><b style="color:blue">Bleeding, requiring reoperation</b> </td>
                               <td><input type="checkbox" class="checkbox" name="simpleChildComplication10" id="simpleChildComplication10"  value="Y" <?php if($c->outcomeChildComplication10=='Y') echo "checked";?>  onclick="checkSimple('10');"> </td>
                               <td><b style="color:blue">Mechanical circulatory support (IABP, VAD, ECMO, or CPS)</b> </td>
                            </tr> 
                           
                              
                             
                              <tr> 
                               <td><input type="checkbox" class="checkbox" name="simpleChildComplication14" id="simpleChildComplication14"  value="Y" <?php if($c->outcomeChildComplication14=='Y') echo "checked";?>  onclick="checkSimple('14');"> </td>
                               <td><b style="color:blue">Neurological deficit that occurred after the operating room visit, persisting at discharge</b> </td>
                               <td><input type="checkbox" class="checkbox" name="simpleChildComplication20" id="simpleChildComplication20"  value="Y" <?php if($c->outcomeChildComplication20=='Y') echo "checked";?>  onclick="checkSimple('20');"> </td>
                               <td><b style="color:blue">Postoperative/Postprocedural respiratory insufficiency requiring mechanical ventilatory support > 7 days</b> </td>
                              
                            </tr> 
                          
                          
                              <tr> 
                               <td> <input type="checkbox" class="checkbox" name="simpleChildComplication23" id="simpleChildComplication23"  value="Y" <?php if($c->outcomeChildComplication23=='Y') echo "checked";?>  onclick="checkSimple('23');"> </td>
                               <td><b style="color:blue">Renal failure ­ acute renal failure, Acute renal failure requiring dialysis at the time of hospital discharge or 91 days if patient is still in hospital</b> </th>
                                <td><input type="checkbox" class="checkbox" name="simpleChildComplication28" id="simpleChildComplication28"  value="Y" <?php if($c->outcomeChildComplication28=='Y') echo "checked";?>  onclick="checkSimple('28');"> </td>
                               <td><b style="color:blue">Sepsis </b></td>
                            </tr> 
                          
                              <tr> 
                               
                               <td> <input type="checkbox" class="checkbox" name="simpleChildComplication35" id="simpleChildComplication35"  value="Y" <?php if($c->outcomeChildComplication35=='Y') echo "checked";?>  onclick="checkSimple('35');"> </td>
                                <td><b style="color:blue">Wound infection­Mediastinitis</b> </th>
                                <td colspan="2">     <button type="button" id="btnShowMore" class="blue medium" onclick="showMoreComplication();"><span>show more...</span></button></td>
                                
                                
                            </tr> 
                             
                           
                            </tbody>
                            </table>
                            <br/><br/>
                    
                               
                             <table cellspacing="0" cellpadding="0" border="0" width=100% id="moreComplication" style="display: none;"> 
                        <thead> 
                            <tr> 
                                <th nowrap colspan="4">1. Cardiac:</th>
                               
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication1" id="outcomeChildComplication1"  value="Y" <?php if($c->outcomeChildComplication1=='Y') echo "checked";?>> </td>
                                <td>Arrhythmia requiring drug therapy</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication5" id="outcomeChildComplication5"  value="Y" <?php if($c->outcomeChildComplication5=='Y') echo "checked";?>> </td>
                               <td>Cardiac dysfunction resulting in low cardiac output</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication2" id="outcomeChildComplication2"  value="Y" <?php if($c->outcomeChildComplication2=='Y') echo "checked";?>> </td>
                                <td>Arrhythmia requiring electrical cardioversion or defibrillation</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication6" id="outcomeChildComplication6"  value="Y" <?php if($c->outcomeChildComplication6=='Y') echo "checked";?>> </td>
                               <td>Cardiac failure (severe cardiac dysfunction)</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication37" id="outcomeChildComplication37"  value="Y" <?php if($c->outcomeChildComplication37=='Y') echo "checked";?>> </td>
                                <td>Arrhythmia requiring permanent pacemaker</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication10" id="outcomeChildComplication10"  value="Y" <?php if($c->outcomeChildComplication10=='Y') echo "checked";?>> </td>
                               <td><b style="color:blue">Mechanical circulatory support (IABP, VAD, ECMO, or CPS)</b> </td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication3" id="outcomeChildComplication3"  value="Y" <?php if($c->outcomeChildComplication3=='Y') echo "checked";?>> </td>
                                <td>Arrhythmia requiring Temporary pacemaker</th>
                                <td>&nbsp;</td>
                               <td>&nbsp;</td>
                            </tr> 
                              </tbody>
                                <thead> 
                            <tr> 
                                <th nowrap colspan="4">2. Pericardium and mediastinum:</th>
                               
                            </tr> 
                        </thead> 
                         <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication8" id="outcomeChildComplication8"  value="Y" <?php if($c->outcomeChildComplication8=='Y') echo "checked";?>> </td>
                                <td>Endocarditis post procedural infective endocarditis</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication4" id="outcomeChildComplication4"  value="Y" <?php if($c->outcomeChildComplication4=='Y') echo "checked";?>> </td>
                               <td>Bleeding, requiring reoperation</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication7" id="outcomeChildComplication7"  value="Y" <?php if($c->outcomeChildComplication7=='Y') echo "checked";?>> </td>
                                <td>Chylothorax, requiring drainage</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication33" id="outcomeChildComplication33"  value="Y" <?php if($c->outcomeChildComplication33=='Y') echo "checked";?>> </td>
                               <td>Unplanned cardiac reoperation during the postoperative or postprocedural time period, exclusive of reoperation for bleeding</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication17" id="outcomeChildComplication17"  value="Y" <?php if($c->outcomeChildComplication17=='Y') echo "checked";?>> </td>
                                <td>Pericardial Effusion, requiring drainage</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication29" id="outcomeChildComplication29"  value="Y" <?php if($c->outcomeChildComplication29=='Y') echo "checked";?>> </td>
                               <td>Sternum left open, unplanned</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication38" id="outcomeChildComplication38"  value="Y" <?php if($c->outcomeChildComplication38=='Y') echo "checked";?>> </td>
                                <td>Pleural effusion, requiring drainage</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication39" id="outcomeChildComplication39"  value="Y" <?php if($c->outcomeChildComplication39=='Y') echo "checked";?>> </td>
                               <td>Sternum left open, planned.</td>
                            </tr> 
                              </tbody>
                                   <thead> 
                            <tr> 
                                <th nowrap colspan="4">3. Neurologic</th>
                               
                            </tr> 
                        </thead> 
                         <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication9" id="outcomeChildComplication9"  value="Y" <?php if($c->outcomeChildComplication9=='Y') echo "checked";?>> </td>
                                <td>Intraventricular hemorrhage (IVH) > grade 2</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication27" id="outcomeChildComplication27"  value="Y" <?php if($c->outcomeChildComplication27=='Y') echo "checked";?>> </td>
                               <td>Seizure</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication12" id="outcomeChildComplication12"  value="Y" <?php if($c->outcomeChildComplication12=='Y') echo "checked";?>> </td>
                                <td>Neurological deficit diagnosed in the operating room, persisting at discharge or 91 days if patient is still in hospital.</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication30" id="outcomeChildComplication30"  value="Y" <?php if($c->outcomeChildComplication30=='Y') echo "checked";?>> </td>
                               <td>Stroke: Ischemic</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication13" id="outcomeChildComplication13"  value="Y" <?php if($c->outcomeChildComplication13=='Y') echo "checked";?>> </td>
                                <td>Neurological deficit diagnosed in the operating room, not present at discharge</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication31" id="outcomeChildComplication31"  value="Y" <?php if($c->outcomeChildComplication31=='Y') echo "checked";?>> </td>
                               <td>Subdural Bleed</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication14" id="outcomeChildComplication14"  value="Y" <?php if($c->outcomeChildComplication14=='Y') echo "checked";?>> </td>
                                <td><b style="color:blue">Neurological deficit that occurred after the operating room visit, persisting at discharge</b></th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication18" id="outcomeChildComplication18"  value="Y" <?php if($c->outcomeChildComplication18=='Y') echo "checked";?>> </td>
                               <td>Peripheral nerve injury persisting at discharge or 91 days if patient is still in hospital</td>
                            </tr> 
                              <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication15" id="outcomeChildComplication15"  value="Y" <?php if($c->outcomeChildComplication15=='Y') echo "checked";?>> </td>
                                <td>Neurological deficit that occurred after the operating room visit, not present at discharge</th>
                                <td>&nbsp;</td>
                               <td>&nbsp;</td>
                            </tr> 
                              </tbody>
                                    <thead> 
                            <tr> 
                                <th nowrap colspan="4">4. Respiratory:</th>
                               
                            </tr> 
                        </thead> 
                         <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication21" id="outcomeChildComplication21"  value="Y" <?php if($c->outcomeChildComplication21=='Y') echo "checked";?>> </td>
                                <td>Postoperative/Postprocedural respiratory insufficiency requiring reintubation</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication34" id="outcomeChildComplication34"  value="Y" <?php if($c->outcomeChildComplication34=='Y') echo "checked";?>> </td>
                               <td>Vocal cord dysfunction (possible recurrent laryngeal nerve injury)</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication26" id="outcomeChildComplication26"  value="Y" <?php if($c->outcomeChildComplication26=='Y') echo "checked";?>> </td>
                                <td>Respiratory failure, requiring tracheostomy</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication20" id="outcomeChildComplication20"  value="Y" <?php if($c->outcomeChildComplication20=='Y') echo "checked";?>> </td>
                               <td><b style="color:blue">Postoperative/Postprocedural respiratory insufficiency requiring mechanical ventilatory support > 7 days</b></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication16" id="outcomeChildComplication16"  value="Y" <?php if($c->outcomeChildComplication16=='Y') echo "checked";?>> </td>
                                <td>Paralyzed diaphragm (possible phrenic nerve injury), requiring surgical plication.</th>
                                <td>&nbsp;</td>
                               <td>&nbsp;</td>
                            </tr> 
                            
                              </tbody>
                                 <thead> 
                            <tr> 
                                <th nowrap colspan="4">5. Renal:</th>
                               
                            </tr> 
                        </thead> 
                         <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication23" id="outcomeChildComplication23"  value="Y" <?php if($c->outcomeChildComplication23=='Y') echo "checked";?>> </td>
                                <td><b style="color:blue">Renal failure ­ acute renal failure, Acute renal failure requiring dialysis at the time of hospital discharge or 91 days if patient is still in hospital</b></th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication25" id="outcomeChildComplication25"  value="Y" <?php if($c->outcomeChildComplication25=='Y') echo "checked";?>> </td>
                               <td>Renal failure ­ acute renal failure, Acute renal failure requiring temporary hemofiltration with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication24" id="outcomeChildComplication24"  value="Y" <?php if($c->outcomeChildComplication24=='Y') echo "checked";?>> </td>
                                <td>Renal failure ­ acute renal failure, Acute renal failure requiring temporary dialysis with the need for dialysis not present at hospital discharge or 91 days if patient is still in hospital</th>
                                <td>&nbsp;</td>
                               <td>&nbsp;</td>
                            </tr> 
                            
                            
                              </tbody>
                                <thead> 
                            <tr> 
                                <th nowrap colspan="4">6. Infection and others:</th>
                               
                            </tr> 
                        </thead> 
                         <tbody> 
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication22" id="outcomeChildComplication22"  value="Y" <?php if($c->outcomeChildComplication22=='Y') echo "checked";?>> </td>
                                <td>Pulmonary vein obstruction</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication11" id="outcomeChildComplication11"  value="Y" <?php if($c->outcomeChildComplication11=='Y') echo "checked";?>> </td>
                               <td>Multi System Organ Failure (MSOF) = Multi­Organ Dysfunction Syndrome (MODS)</td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication32" id="outcomeChildComplication32"  value="Y" <?php if($c->outcomeChildComplication32=='Y') echo "checked";?>> </td>
                                <td>Systemic vein obstruction</th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication35" id="outcomeChildComplication35"  value="Y" <?php if($c->outcomeChildComplication35=='Y') echo "checked";?>> </td>
                               <td><b style="color:blue">Wound infection Mediastinitis</b> 
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("診斷縱隔腔炎必須符合以下任一準則：\n 1.手術中採樣的縱隔腔內組織或抽取液體細菌培養陽性。\n 2.有病理切片證實縱隔腔炎或是手術當中看起來是縱隔腔炎。\n 3.需有至少一項以下症狀或徵兆，而且不是來自其他明確原因：\n1) 發燒, 2)胸痛, 3)胸骨不穩定。\n並且同時合併至少有一項以下狀況：\n 1) 有膿樣的縱隔腔引流液, 2)總隔腔引流液細菌培養陽性, 3)CXR中縱隔腔變寬。\n 4.一歲以下的病人需有至少一項以下症狀或徵兆，\n而且不是來自其他明確原因：\n1)發燒, 2) 低溫, 3)無呼吸(apnea), 4)心搏過慢(bradycardia), 5)胸骨不穩定。 \n並且同時合併至少有一項以下狀況： \n 1) 有膿樣的縱隔腔引流液, 2)總隔腔引流液細菌培養陽性, 3)CXR中縱隔腔變寬。\n 5.胸骨感染(sternal osteomyelitis)應視為縱隔腔炎。",{className:"info",autoHide: false});'></img>
                                   </td>
                            </tr> 
                            <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChildComplication28" id="outcomeChildComplication28"  value="Y" <?php if($c->outcomeChildComplication28=='Y') echo "checked";?>> </td>
                                <td><b style="color:blue">Sepsis </b></th>
                                <td><input type="checkbox" class="checkbox" name="outcomeChildComplication36" id="outcomeChildComplication36"  value="Y" <?php if($c->outcomeChildComplication36=='Y') echo "checked";?>> </td>
                               <td>Wound infection Superficial wound infection
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("診斷表淺傷口感染必須同時符合以下準則：\n 1.感染只侷限在手術傷口的皮膚或皮下組織 \n 2.病人至少有以下一項徵兆：\nA) 表淺手術傷口化膿, \nB) 表淺手術傷口的組織或引流液細菌培養陽性, \nC)至少一項以下症狀：\n[1]痛或壓痛, \n[2]局部的紅、腫或發熱,\n[3]外科醫師因考慮到感染或其他因素將表淺的手術傷口打開，\n除非後來傷口細菌培養為陰性, \n[4]外科醫師或其他醫師診斷為表淺傷口感染。",{className:"info",autoHide: false});'></img>
                                   </td>
                            </tr> 
                            
                              </tbody>
                            </table>
                            
                              
                            <br/><br/>
                           <div class="lineheader">
                            <label>Primary Cause of Death </label>
                             <label for="PrimaryCauseofDeath"></label> &nbsp;
                             </div>
                        <table cellspacing="0" cellpadding="0" border="0" width=100%> 
                        <thead> 
                            <tr> 
                             
                                <th colspan=4 height="30px" nowrap>
                                    <button  type="button" class="green medium" onclick="javascript: $('input[name=outcomeChildCauseofDeath]').attr('checked',false);"   style="vertical-align: bottom;"><span>清除選項</span></button>  
                                </th>
                               
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath1"  value="1" <?php if($c->outcomeChildCauseofDeath=='1') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Accident </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath2"  value="2" <?php if($c->outcomeChildCauseofDeath=='2') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Acute or chronic cardiac failure </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath3"  value="3" <?php if($c->outcomeChildCauseofDeath=='3') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Anoxic event </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath4"  value="4" <?php if($c->outcomeChildCauseofDeath=='4') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Bleeding </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath5"  value="5" <?php if($c->outcomeChildCauseofDeath=='5') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Non­cardiac bleeding </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath6"  value="6" <?php if($c->outcomeChildCauseofDeath=='6') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Surgical bleeding (intra op or post op) </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath7"  value="7" <?php if($c->outcomeChildCauseofDeath=='7') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Coronary artery event </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath8"  value="8" <?php if($c->outcomeChildCauseofDeath=='8') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Gastrointestinal complications </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath9"  value="9" <?php if($c->outcomeChildCauseofDeath=='9') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Liver failure </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath10"  value="10" <?php if($c->outcomeChildCauseofDeath=='10') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Malignancy </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath11"  value="11" <?php if($c->outcomeChildCauseofDeath=='11') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Mechanical circulatory support failure </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath12"  value="12" <?php if($c->outcomeChildCauseofDeath=='12') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Neurologic event </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath13"  value="13" <?php if($c->outcomeChildCauseofDeath=='13') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Pulmonary embolism</th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath14"  value="14" <?php if($c->outcomeChildCauseofDeath=='14') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Rejection </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath15"  value="15" <?php if($c->outcomeChildCauseofDeath=='15') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Renal failure </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath16"  value="16" <?php if($c->outcomeChildCauseofDeath=='16') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Respiratory failure </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath17"  value="17" <?php if($c->outcomeChildCauseofDeath=='17') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Rhythm disturbance </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath18"  value="18" <?php if($c->outcomeChildCauseofDeath=='18') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Suicide </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath19"  value="19" <?php if($c->outcomeChildCauseofDeath=='19') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Surgical site infection </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath20"  value="20" <?php if($c->outcomeChildCauseofDeath=='20') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Other major infection </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath21"  value="21" <?php if($c->outcomeChildCauseofDeath=='21') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Sepsis </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath22"  value="22" <?php if($c->outcomeChildCauseofDeath=='22') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Systemic embolism </td>
                            </tr> 
                              <tr> 
                                <td> <input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath23"  value="23" <?php if($c->outcomeChildCauseofDeath=='23') echo "checked";?> onclick="chkMorbidity();"> </td>
                                <td>Inoperable Defect </th>
                                <td><input type="radio" class="checkbox" name="outcomeChildCauseofDeath" id="outcomeChildCauseofDeath24"  value="24" <?php if($c->outcomeChildCauseofDeath=='24') echo "checked";?> onclick="chkMorbidity();"> </td>
                               <td>Other, specify</td>
                            </tr> 
                            </tbody>
                            </table>
                      <div class="line button">
                           
                            
                             <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                              
                        </div>
                  
               
         
            </div>
        </div>
        </div>
        
               </form>
         
        <div class="box" id="divLVAD">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                   <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                  <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                    </div>
                </div>
                <div class="title">
                    <h2>LVAD Special Sheet</h2>
                </div>
                 <form action="<?php echo base_url(); ?>patient/LVAD" method="post">
                      <div class="lineheader">
                            <label>Machine:   </label>
                             <label for="LVADMachine"></label> &nbsp;
                       </div>
                            
                              <div class="line">
                                   <label>LVAD:  
                              
                            </label>
                              <select name="LVADmachineLVAD" id="LVADmachineLVAD" class="large">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="HeartWare"  <?php if($c->LVADmachineLVAD=='HeartWare') echo "selected";?>>HeartWare</option>
                                   <option  class="large" value="HeartMate II"  <?php if($c->LVADmachineLVAD=='HeartMate II') echo "selected";?>>HeartMate II</option>
                                   <option  class="large" value="Medtronic Biomedicus Pump Console®-550"  <?php if($c->LVADmachineLVAD=='Medtronic Biomedicus Pump Console®-550') echo "selected";?>>Medtronic Biomedicus Pump Console®-550</option>
                                   <option  class="large" value="Medtronic Biomedicus Pump Console®-560"  <?php if($c->LVADmachineLVAD=='Medtronic Biomedicus Pump Console®-560') echo "selected";?>>Medtronic Biomedicus Pump Console®-560</option>
                                   <option  class="large" value="Maquet Centrifugal Pump Rotaﬂow RF32"  <?php if($c->LVADmachineLVAD=='Maquet Centrifugal Pump Rotaﬂow RF32') echo "selected";?>>Maquet Centrifugal Pump Rotaﬂow RF32</option>
                                   <option  class="large" value="Maquet Cardiohelp"  <?php if($c->LVADmachineLVAD=='Maquet Cardiohelp') echo "selected";?>>Maquet Cardiohelp</option>
                                   <option  class="large" value="Thoratec CentriMag (Levitronix)"  <?php if($c->LVADmachineLVAD=='Thoratec CentriMag (Levitronix)') echo "selected";?>>Thoratec CentriMag (Levitronix)</option>
                                   <option  class="large" value="Others"  <?php if($c->LVADmachineLVAD=='Others') echo "selected";?>>Others</option>
                                  </select>
                            </div>     
                        <div class="line">
                                   <label>RVAD:  
                              
                            </label>
                              <select name="LVADmachineRVAD" id="LVADmachineRVAD" class="large">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="HeartWare"  <?php if($c->LVADmachineRVAD=='HeartWare') echo "selected";?>>HeartWare</option>
                                   <option  class="large" value="HeartMate II"  <?php if($c->LVADmachineRVAD=='HeartMate II') echo "selected";?>>HeartMate II</option>
                                   <option  class="large" value="Medtronic Biomedicus Pump Console®-550"  <?php if($c->LVADmachineRVAD=='Medtronic Biomedicus Pump Console®-550') echo "selected";?>>Medtronic Biomedicus Pump Console®-550</option>
                                   <option  class="large" value="Medtronic Biomedicus Pump Console®-560"  <?php if($c->LVADmachineRVAD=='Medtronic Biomedicus Pump Console®-560') echo "selected";?>>Medtronic Biomedicus Pump Console®-560</option>
                                   <option  class="large" value="Maquet Centrifugal Pump Rotaﬂow RF32"  <?php if($c->LVADmachineRVAD=='Maquet Centrifugal Pump Rotaﬂow RF32') echo "selected";?>>Maquet Centrifugal Pump Rotaﬂow RF32</option>
                                   <option  class="large" value="Maquet Cardiohelp"  <?php if($c->LVADmachineRVAD=='Maquet Cardiohelp') echo "selected";?>>Maquet Cardiohelp</option>
                                   <option  class="large" value="Thoratec CentriMag (Levitronix)"  <?php if($c->LVADmachineRVAD=='Thoratec CentriMag (Levitronix)') echo "selected";?>>Thoratec CentriMag (Levitronix)</option>
                                   <option  class="large" value="Others"  <?php if($c->LVADmachineRVAD=='Others') echo "selected";?>>Others</option>
                                  </select>
                            </div>     
                        
                          <div class="lineheader">
                            <label>Clinic condition:   </label>
                             <label for="LVADClinicCondition"></label> &nbsp;
                       </div>
                         <div class="line">
                                      <label>INTERMACS level:  <a class="pdf" href="<?php echo base_url(); ?>patient/LVADHelp1"> <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" valign="middle"></img></a>
                              
                            </label>
                         <select name="LVADIntermacsLevel" id="LVADIntermacsLevel" class="large">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="Level 1"  <?php if($c->LVADIntermacsLevel=='Level 1') echo "selected";?>>Level 1</option>
                                   <option  class="large" value="Level 2"  <?php if($c->LVADIntermacsLevel=='Level 2') echo "selected";?>>Level 2</option>
                                   <option  class="large" value="Level 3"  <?php if($c->LVADIntermacsLevel=='Level 3') echo "selected";?>>Level 3</option>
                                   <option  class="large" value="Level 4"  <?php if($c->LVADIntermacsLevel=='Level 4') echo "selected";?>>Level 4</option>
                                   <option  class="large" value="Level 5"  <?php if($c->LVADIntermacsLevel=='Level 5') echo "selected";?>>Level 5</option>
                                   <option  class="large" value="Level 6"  <?php if($c->LVADIntermacsLevel=='Level 6') echo "selected";?>>Level 6</option>
                                   <option  class="large" value="Level 7"  <?php if($c->LVADIntermacsLevel=='Level 7') echo "selected";?>>Level 7</option>
                                   </select>
                            </div>     
                         <div class="line">
                                      <label>NYHA functional class:  
                              
                            </label>
                         <select name="LVADNYHAClass" id="LVADNYHAClass" class="large" onchange="changeHYHA('2');">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="1"  <?php if($c->pastHistoryNYHA=='1') echo "selected";?>>I</option>
                                   <option  class="large" value="2"  <?php if($c->pastHistoryNYHA=='2') echo "selected";?>>II</option>
                                   <option  class="large" value="3"  <?php if($c->pastHistoryNYHA=='3') echo "selected";?>>III</option>
                                   <option  class="large" value="4"  <?php if($c->pastHistoryNYHA=='4') echo "selected";?>>IV</option>
                                  </select>
                            </div>     
                            
                             <div class="line">
                             <label>Peak VO2 (mL/kg/min):  
                              
                            </label>
                            
                             <input type="text"  class="<?php echo ($c->LVADPeakVO2=="NA"?"smallDisabled":"small");?>"  <?php echo ($c->LVADPeakVO2=="NA"?"readonly":"");?> name="LVADPeakVO2" id="LVADPeakVO2"  value="<?php echo $c->LVADPeakVO2;?>" onKeyUp="checkNumber(this);"> 
                             <label style="position: absolute;left: 30px;width:100px" for="LVADPeakVO2_check" id="LVADPeakVO2_check_Lalbel">not available</label><input type="checkbox" id="LVADPeakVO2_check"  onclick="chkLVADVal('LVADPeakVO2_check','LVADPeakVO2');" value="Y" <?php if($c->LVADPeakVO2=="NA") echo "checked";?>>
                           </div>
                           <div class="line">
                            <label> IV inotropic medication ≥ 14 days </label>
                             <input type="radio" name="LVADIVinotropicLarge14days" id="LVADIVinotropicLarge14days_Y"  value="Y" <?php if($c->LVADIVinotropicLarge14days=='Y') echo "checked";?>><label id="LVADIVinotropicLarge14days_Y_Label" for="LVADIVinotropicLarge14days_Y">Y&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADIVinotropicLarge14days" id="LVADIVinotropicLarge14days_N"  value="N" <?php if($c->LVADIVinotropicLarge14days=='N') echo "checked";?>><label id="LVADIVinotropicLarge14days_N_Label" for="LVADIVinotropicLarge14days_N">N&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADIVinotropicLarge14days" id="LVADIVinotropicLarge14days_notavailable"  value="not available" <?php if($c->LVADIVinotropicLarge14days=='not available') echo "checked";?>><label id="LVADIVinotropicLarge14days_NA_Label" for="LVADIVinotropicLarge14days_notavailable">not available&nbsp;&nbsp;</label>  &nbsp; 
                             <img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" valign="middle" onclick="javascript:clearLVADOption('1');" title="清除"></img>
                        </div>
                         <div class="line">
                            <label> IABP support ≥ 7 days  </label>
                             <input type="radio" name="LVADIIABPSupportLarge7days" id="LVADIIABPSupportLarge7days_Y"  value="Y" <?php if($c->LVADIIABPSupportLarge7days=='Y') echo "checked";?>><label id="LVADIIABPSupportLarge7days_Y_Label" for="LVADIIABPSupportLarge7days_Y">Y&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADIIABPSupportLarge7days" id="LVADIIABPSupportLarge7days_N"  value="N" <?php if($c->LVADIIABPSupportLarge7days=='N') echo "checked";?>><label id="LVADIIABPSupportLarge7days_N_Label" for="LVADIIABPSupportLarge7days_N">N&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADIIABPSupportLarge7days" id="LVADIIABPSupportLarge7days_notavailable"  value="not available" <?php if($c->LVADIIABPSupportLarge7days=='not available') echo "checked";?>><label id="LVADIIABPSupportLarge7days_NA_Label" for="LVADIIABPSupportLarge7days_notavailable">not available&nbsp;&nbsp;</label>  &nbsp; 
                             <img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" valign="middle" onclick="javascript: clearLVADOption('2');"  title="清除"></img>
                        </div>
                         <div class="line">
                            <label> Pre-operative ventilator support</label>
                             <input type="radio" name="LVADPreOperativeVentlator" id="LVADPreOperativeVentlator_Y"  value="Y" <?php if($c->LVADPreOperativeVentlator=='Y') echo "checked";?> onclick="calCRITT();"><label id="LVADPreOperativeVentlator_Y_Label" for="LVADPreOperativeVentlator_Y">Y&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADPreOperativeVentlator" id="LVADPreOperativeVentlator_N"  value="N" <?php if($c->LVADPreOperativeVentlator=='N') echo "checked";?>  onclick="calCRITT();"><label id="LVADPreOperativeVentlator_N_Label" for="LVADPreOperativeVentlator_N">N&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADPreOperativeVentlator" id="LVADPreOperativeVentlator_notavailable"  value="not available" <?php if($c->LVADPreOperativeVentlator=='not available') echo "checked";?>  onclick="calCRITT();"><label id="LVADPreOperativeVentlator_NA_Label" for="LVADPreOperativeVentlator_notavailable">not available&nbsp;&nbsp;</label>  &nbsp; 
                             <img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" valign="middle" onclick="javascript: clearLVADOption('3');;calCRITT();"  title="清除"></img>
                       
                        </div>
                          <div class="line">
                            <label> ECMO support</label>
                             <input type="radio" name="LVADECMOSupport" id="LVADECMOSupport_Y"  value="Y" <?php if($c->LVADECMOSupport=='Y') echo "checked";?>><label id="LVADECMOSupport_Y_Label" for="LVADECMOSupport_Y">Y&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADECMOSupport" id="LVADECMOSupport_N"  value="N" <?php if($c->LVADECMOSupport=='N') echo "checked";?>><label id="LVADECMOSupport_N_Label" for="LVADECMOSupport_N">N&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADECMOSupport" id="LVADECMOSupport_notavailable"  value="not available" <?php if($c->LVADECMOSupport=='not available') echo "checked";?>><label id="LVADECMOSupport_NA_Label" for="LVADECMOSupport_notavailable">not available&nbsp;&nbsp;</label>  &nbsp; 
                             <img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" valign="middle" onclick="javascript: clearLVADOption('6');"  title="清除"></img>
                       
                        </div>
                             <div class="lineheader">
                            <label>Lab Data:   </label>
                             <label for="LVADLabData"></label> &nbsp;
                       </div>
                          <div class="line">
                             <label>Creatinine (mg/dL):  
                              
                            </label>
                             <input type="text"  class="small" name="LVADCreatinine" id="LVADCreatinine"  value="<?php echo $c->patientSerumCreatinine;?>"   onblur="javascript:changeCre('2');"  onKeyUp="checkNumber(this);"> 
                             <label style="position: absolute;left: 30px;width:100px" for="LVADDialysis" id="LVADDialysis_Lalbel">Dialysis</label><input type="checkbox" id="LVADDialysis" name="LVADDialysis"   value="Y" <?php if($c->LVADDialysis=="Y") echo "checked";?> onclick="calHMRS();" >
                           </div>
                              <div class="line">
                             <label>BUN (mg/dL) :  
                              
                            </label>
                             <input type="text"  class="small" name="LVADBUN" id="LVADBUN"  value="<?php echo $c->LVADBUN;?>"  onKeyUp="checkNumber(this);"> 
                           </div>
                              <div class="line">
                             <label>Albumin (g/dL):  
                              
                            </label>
                             <input type="text"  class="<?php echo ($c->LVADAlbumin=="NA"?"smallDisabled":"small");?>"  <?php echo ($c->LVADAlbumin=="NA"?"readonly":"");?> name="LVADAlbumin" id="LVADAlbumin"  value="<?php echo $c->LVADAlbumin;?>" onblur="calHMRS();"  onKeyUp="checkNumber(this);"> 
                              <label style="position: absolute;left: 30px;width:100px" for="LVADAlbumin_check" id="LVADAlbumin_check_Lalbel">not available</label><input type="checkbox" id="LVADAlbumin_check"  onclick="chkLVADVal('LVADAlbumin_check','LVADAlbumin');" value="Y"  <?php if($c->LVADAlbumin=="NA") echo "checked";?>>
                           </div>
                              <div class="line">
                             <label>INR :  
                              
                            </label>
                             <input type="text"  class="<?php echo ($c->LVADINR=="NA"?"smallDisabled":"small");?>"  <?php echo ($c->LVADINR=="NA"?"readonly":"");?> name="LVADINR" id="LVADINR"  value="<?php echo $c->LVADINR;?>" onblur="calHMRS();"  onKeyUp="checkNumber(this);"> 
                              <label style="position: absolute;left: 30px;width:100px" for="LVADINR_check" id="LVADINR_check_Lalbel">not available</label><input type="checkbox" id="LVADINR_check"  onclick="chkLVADVal('LVADINR_check','LVADINR');" value="Y"  <?php if($c->LVADINR=="NA") echo "checked";?> >
                           </div>
                              <div class="line">
                             <label>Bilirubin (mg/dL) :  
                              
                            </label>
                             <input type="text"  class="<?php echo ($c->LVADBilirubin=="NA"?"smallDisabled":"small");?>"  <?php echo ($c->LVADBilirubin=="NA"?"readonly":"");?> name="LVADBilirubin" id="LVADBilirubin"  value="<?php echo $c->LVADBilirubin;?>"  onKeyUp="checkNumber(this);"> 
                              <label style="position: absolute;left: 30px;width:100px" for="LVADBilirubin_check" id="LVADBilirubin_check_Lalbel">not available</label><input type="checkbox" id="LVADBilirubin_check"  onclick="chkLVADVal('LVADBilirubin_check','LVADBilirubin');" value="Y" <?php if($c->LVADBilirubin=="NA") echo "checked";?>>
                           </div>
                           
                              <div class="lineheader">
                            <label>Hemodynamic condition:   </label>
                             <label for="LVADHemodynamicCondition"></label> &nbsp;
                       </div>
                          <div class="line">
                             <label>Heart Rate (/min) :  
                              
                            </label>
                             <input type="text"  class="small" name="LVADHeartRate" id="LVADHeartRate"  value="<?php echo $c->LVADHeartRate;?>"  onblur="calCRITT();"  onKeyUp="checkNumber(this);">  
                           </div>
                              <div class="line">
                             <label>CVP level (mmHg) :  
                              
                            </label>
                             <input type="text"  class="small" name="LVADCVPLevel" id="LVADCVPLevel"  value="<?php echo $c->LVADCVPLevel;?>"  onblur="calCRITT();"  onKeyUp="checkNumber(this);">  
                           </div>
                              <div class="line">
                             <label>Pulmonary capillary wedge pressure (mmHg) :  
                              
                            </label>
                             <input type="text"  class="<?php echo ($c->LVADPulmonary=="NA"?"smallDisabled":"small");?>"  <?php echo ($c->LVADPulmonary=="NA"?"readonly":"");?> name="LVADPulmonary" id="LVADPulmonary"  value="<?php echo $c->LVADPulmonary;?>"  onKeyUp="checkNumber(this);"> 
                             <label style="position: absolute;left: 30px;width:100px" for="LVADPulmonary_check" id="LVADPulmonary_check_Lalbel">not available</label><input type="checkbox" id="LVADPulmonary_check"  onclick="chkLVADVal('LVADPulmonary_check','LVADPulmonary');" value="Y" <?php if($c->LVADPulmonary=="NA") echo "checked";?>>
                           </div>
                              <div class="line">
                             <label>LVEF (%)  :  
                              
                            </label>
                             <input type="text"  class="<?php echo ($c->LVADLVEF=="NA"?"smallDisabled":"small");?>"  <?php echo ($c->LVADLVEF=="NA"?"readonly":"");?> name="LVADLVEF" id="LVADLVEF"  value="<?php echo $c->LVADLVEF;?>"  onKeyUp="checkNumber(this);">  
                             <label style="position: absolute;left: 30px;width:100px" for="LVADLVEF_check" id="LVADLVEF_check_Lalbel">not available</label><input type="checkbox" id="LVADLVEF_check"  onclick="chkLVADVal('LVADLVEF_check','LVADLVEF');" value="Y" <?php if($c->LVADLVEF=="NA") echo "checked";?>>
                     
                           </div>
                            <div class="line">
                            <label> Severe RV dysfunction </label>
                             <input type="radio" name="LVADSevereRV" id="LVADSevereRV_Y"  value="Y" <?php if($c->LVADSevereRV=='Y') echo "checked";?>  onclick="calCRITT();"><label  id="LVADSevereRV_Y_Label"  for="LVADSevereRV_Y">Y&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADSevereRV" id="LVADSevereRV_N"  value="N" <?php if($c->LVADSevereRV=='N') echo "checked";?>  onclick="calCRITT();"><label  id="LVADSevereRV_N_Label" for="LVADSevereRV_N">N&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADSevereRV" id="LVADSevereRV_notavailable"  value="not available" <?php if($c->LVADSevereRV=='not available') echo "checked";?>  onclick="calCRITT();"><label  id="LVADSevereRV_NA_Label" for="LVADSevereRV_notavailable">not available&nbsp;&nbsp;</label>  &nbsp; 
                             <img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" valign="middle" onclick="javascript:clearLVADOption('4');;calCRITT();"  title="清除"></img>
                        </div>
                         <div class="line">
                            <label> Severe TR </label>
                             <input type="radio" name="LVADSevereTR" id="LVADSevereTR_Y"  value="Y" <?php if($c->LVADSevereTR=='Y') echo "checked";?>  onclick="calCRITT();"><label  id="LVADSevereTR_Y_Label" for="LVADSevereTR_Y">Y&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADSevereTR" id="LVADSevereTR_N"  value="N" <?php if($c->LVADSevereTR=='N') echo "checked";?>  onclick="calCRITT();"><label id="LVADSevereTR_N_Label" for="LVADSevereTR_N">N&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="LVADSevereTR" id="LVADSevereTR_notavailable"  value="not available" <?php if($c->LVADSevereTR=='not available') echo "checked";?>  onclick="calCRITT();"><label id="LVADSevereTR_NA_Label" for="LVADSevereTR_notavailable">not available&nbsp;&nbsp;</label>  &nbsp; 
                             <img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" valign="middle" onclick="javascript: clearLVADOption('5');calCRITT();"  title="清除"></img>
                        </div>
                        
                         <div class="lineheader">
                            <label>The HeartMate II Risk Score (HMRS)  <a class="pdf" href="<?php echo base_url(); ?>patient/LVADHelp2"> <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  valign="middle"></img></a>   </label>
                             <label for="LVADHeartMateIIRiskScore"></label> &nbsp;
                       </div>
                             <div class="line">
                             <label>HMRS :  
                            </label>
                             <input type="text"  class="smallDisabled"  readonly name="LVADHMRS" id="LVADHMRS"  value="<?php echo $c->LVADHMRS;?>">  
                             <span id="LVADHMRSNote" style="color: red;display:none;">“Note:實際風險可能高於計算數值</span>
                           </div>
                            <div class="line">
                             <label>Risk :  
                            </label>
                             <input type="text"  class="smallDisabled" readonly name="LVADHMRSRisk" id="LVADHMRSRisk"  value="<?php echo $c->LVADHMRSRisk;?>">  
                           </div>
                           <div class="line">
                             <label>Predict 90-day mortality :  
                            </label>
                             <input type="text"  class="smallDisabled" readonly name="LVADHMRS90DaysMortality" id="LVADHMRS90DaysMortality"  value="<?php echo $c->LVADHMRS90DaysMortality;?>">  
                           </div>
                           
                              <div class="lineheader">
                            <label>CRITT score    <a class="pdf" href="<?php echo base_url(); ?>patient/LVADHelp3"> <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" valign="middle"></img></a> </label>
                             <label for="LVADCRITTDcoreTitle"></label> &nbsp;
                       </div>
                             <div class="line">
                             <label> CRITT score :  
                            </label>
                             <input type="text"  class="smallDisabled"  readonly name="LVADCRITTScore" id="LVADCRITTScore"  value="<?php echo $c->LVADCRITT;?>">  
                           </div>
                           <div class="line">
                             <label> Note:  
                            </label>
                            <textarea name="LVADCRITTNote" id="LVADCRITTNote" class="textarea" cols="55" rows="5"><?php echo $c->LVADCRITTNote;?></textarea> 
                           </div>
                            <div class="line button">
                           
                         <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                        
                             </form>
           
        </div>
     </div>
           <div class="box"  id="divPrintSending">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
               
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                  <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                   <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                </div>
                </div>
                <div class="title">
                    <h2>Print & Send</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/profilesending" method="post">
                        <div class="lineheader">
                            <label>Sending Patient Profile to following Surgeon   </label>
                             <label></label> &nbsp;
                             
                            </div>
                     
                          <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap width="5%"></th>
                                <th nowrap width="15%">Surgeon</th>
                                <th nowrap width="30%">Email</th>
                                <th nowrap width="5%"></th>
                                <th nowrap width="15%">Surgeon</th>
                                <th nowrap width="30%">Email</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php 
                            $i=0;
                            foreach($vsList->result() as $row){
                                     ?>
                                     <?php if($i%2==0){ ?>
                                         <tr> 
                                     <?php } ?>    
                                         <td> <input type="checkbox" class="checkbox" name="profilesending_<?php echo $i;?>" id="profilesending_<?php echo $i;?>"  value="1" <?php if($row->vsName== $c->patientSurgeon || $row->vsName== $c->patientSurgeon2 || $row->vsName== $c->patientSurgeon3 || $row->vsName== $c->patientSurgeon4 ) echo "checked";?>> 
                                             <input type="hidden" name="profilesendingVS_<?php echo $i;?>" id="profilesendingVS_<?php echo $i;?>" class="small" value="<?php echo $row->vsName;?>" />
                                             <input type="hidden" name="profilesendingEmail_<?php echo $i;?>" id="profilesendingEmail_<?php echo $i;?>" class="small" value="<?php echo $row->vsEmail;?>" />
                                             </td>
                                         <td><?php echo $row->vsName;?> </td>
                                         <td><?php echo $row->vsEmail;?> </td>
                                  
                                     <?php if($i%2==1){?>
                                         </tr> 
                                     <?php   } ?> 
                                     
<?php   $i++; } ?> 
                            </tbody>
                            </table>
                             
                    <div class="line button">
                           
                           
                                    <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                                
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else { ?>
                                   <button type="button" class="orange medium" onclick="window.open('<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>','_blank ');"><span>列印病患資料</span></button>
                           
                                 <?php        echo  $outOfDateFlag;
                     } ?>
                            <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                            <input type="hidden" name="surgeonCount" id="surgeonCount" class="small" value="<?php echo $i;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div>
        
           <div class="box"  id="divDataHistory">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                 <?php if($c->operationHeartTransplantationLVAD=='Y' || $c->operationHeartTransplantationRVAD=='Y') { ?>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divLVAD')">LVAD</a> </span>
                   <?php } ?>
                   <!-- <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span> -->
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPrintSending')">Print & Send</a> </span>
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divDataHistory')">Data History</a> </span>
                </div>
                </div>
                <div class="title">
                    <h2>Data History</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/patientProfiles" method="post">
                     
                      <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                                <th nowrap>Date</th>
                                <th nowrap>User</th>
                             
                                <th nowrap>IP</th>
                                <th nowrap>Description</th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                          
                            $j=0;
                            foreach($dataHistory->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->accesstime;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->uname;?></td>
                                 
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->accessip;?></td>
                                 <td style="padding : 2px 8px;line-height : 30px;"><?php echo str_replace($row->uname,'',$row->accessstr);?></td>
                       
                                <td style="padding : 2px 8px;line-height : 30px;">
                                    <?php if($row->accesstype=="U" || $row->accesstype=="T" ){?>
                                    <a class="various" data-fancybox-type="iframe" href="/patient/compareHistory/<?php echo $row->aid;?>/<?php echo $row->accesstype;?>"><button  class="blue medium"><span>查看</span></button></a>
                                   <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                      
                  
                        
                   
                  
               
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

$(document).ready(function() {
    $(".various").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        titleShow: false,               
autoscale: false,               
autoDimensions: false ,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });
      $(".pdf").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : true,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        type   :'iframe',
        iframe: {
preload: false // fixes issue with iframe and IE
}

    });
   
    $(".chdMMemo").fancybox({
        maxWidth    : 600,
        maxHeight   : 900,
        fitToView   : true,
        titleShow: true,               
autoscale: false,               
autoDimensions: false ,
        width       : '60%',
        height      : '100%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    })

});
function cccOpen(){
 
  $("#divdeps").show('slow');
}
 $(document).ready(function() {
  
     afterUpdate('<?php echo $patientpage;?>','<?php echo $msg;?>');
    $( "#patientOpDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientOpDate" ).val('<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>');
    $( "#patientDischargeDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientDischargeDate" ).val('<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>');
    $( "#patientDischargeDate1" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientDischargeDate1" ).val('<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>');
     $( "#outcomeExtubationDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#outcomeExtubationDate" ).val('<?php echo str_replace('0000-00-00', '', $c->outcomeExtubationDate);?>');
    $( "#patientICUDischargeDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientICUDischargeDate" ).val('<?php echo str_replace('0000-00-00', '', $c->patientICUDischargeDate);?>');
    
    //operation
    showOperationDetail('operationCABG','Operation_CABG');
    showOperationDetail('operationAorticValve','Operation_AorticValve');
    showOperationDetail('operationMitralValve','Operation_MitralValve');
    showOperationDetail('operationTricuspidValve','Operation_TricuspidValve');
    showOperationDetail('operationPulmonaryValve','Operation_PulmonaryValve');
    showOperationDetail('operationArrythmiaSurgery','Operation_ArrythmiaSurgery');
    showOperationDetail('operationAorticSurgery','Operation_AorticSurgery');
    showOperationDetail('operationHeartTransplantation','Operation_HeartTransplantation');
       showOperationDetail('operationOtherCardiacSurgery','Operation_OtherCardiacSurgery');
    
    showOperationDetail('operationCongenitalBypass','Operation_CongenitalBypass');
    
    
    
    chkMorbidity();
    
 });    
   
 function afterUpdate(p,m){
     callHideShow(p);
     if(m!='')    $.notify(m, "info");
 }
 function callHideShow(t){
     $('#divPatientProfiles').hide();
     $('#divPastHistory').hide();
     $('#divOperation').hide();
      $('#divOutcome').hide();
      $('#divCongenitalSurgery').hide();
      $('#divChildOutcome').hide();
     $('#divDataHistory').hide();
     $('#divPrintSending').hide();
     $('#divLVAD').hide();
     
     $('#'+t).show();
     
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
$("#euroScoreII_1").val(result);

return result;
} else {
    $("#euroScoreII").val('');
    $("#euroScoreII_1").val('');
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
function confirmOperationDetail(a,b){
     if(!$('#'+a).is(':checked')){
       if(confirm("當您取消本欄位, 區塊內資料將同時被清除!!")){
        showOperationDetail(a,b);
    } else {
        $('#'+a).prop("checked", true);
        $('#'+a).addClass("checked");
        return false;
    }
    } else {
         showOperationDetail(a,b);
    }
}
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
            $("#operationLIMA-button .ui-selectmenu-status").html('');
            $("#operationRIMA").val('');
            $("#operationRIMA-button .ui-selectmenu-status").html('');
            $("#operationRIMA_RadialA").val('');
            $("#operationRIMA_RadialA-button .ui-selectmenu-status").html('');
            $("#operationRIMA_GEA").val('');
            $("#operationRIMA_GEA-button .ui-selectmenu-status").html('');
            $("#operationVeinGraft").val('');
            $("#operationVeinGraft-button .ui-selectmenu-status").html('');
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
            $("#operationAVP-button .ui-selectmenu-status").html('');
            $('#operationAorticValve_AVP').prop("checked", false);
          $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
          $('#operationAorticValve_AVR').prop("checked", false);
          $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
          $('#operationMitralValveBentall').prop("checked", false);
           $('#operationMitralValveBentallLabel').removeClass("checked");
          
            $("#operationAVRSelect").val('');
            $("#operationAorticMemo").val('');
            $("#operationAVRSelect-button .ui-selectmenu-status").html('');
            
           $('#operationAorticValve_TAVI').prop("checked", false);
            $('#operationAorticValve_TAVI_Lalbel').removeClass("checked");
             $("#operationAorticValve_TAVI_S1").val('');
             $("#operationAorticValve_TAVI_S1-button .ui-selectmenu-status").html('');
             $("#operationAorticValve_TAVI_S2").val('');
             $("#operationAorticValve_TAVI_S2-button .ui-selectmenu-status").html('');
             
             $("#operationBentallSelect").val('');
             $("#operationBentallSelect-button .ui-selectmenu-status").html('');
             $("#AorticValveProductName").val('');
             $("#AorticValveProductName-button .ui-selectmenu-status").html('');
             $("#AorticValveProductType").val('');
             $("#AorticValveProductType-button .ui-selectmenu-status").html('');
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
                 $('#operationMVPAlfieriStitch').prop("checked", false);
                 $('#operationMVPAlfieriStitchLabel').removeClass("checked");
                 $('#operationMVPDeVegaAnnularPlasty').prop("checked", false);
                 $('#operationMVPDeVegaAnnularPlastyLabel').removeClass("checked");
                 $("#operationMVR").val('');
                 $("#operationMVR-button .ui-selectmenu-status").html('');
                 $("#operationMVRMemo").val('');
                 
                   $('#Operation_MitralValve_MVP').prop("checked", false);
                 $('#Operation_MitralValve_MVP_Lalbel').removeClass("checked");
                   $('#operationMVPOthers').prop("checked", false);
                 $('#operationMVPOthersLabel').removeClass("checked");
                   $('#Operation_MitralValve_MVR').prop("checked", false);
                 $('#Operation_MitralValve_MVR_Lalbel').removeClass("checked");
                 
             $("#MitralValveProductName").val('');
             $("#MitralValveProductName-button .ui-selectmenu-status").html('');
             $("#MitralValveProductType").val('');
             $("#MitralValveProductType-button .ui-selectmenu-status").html('');
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
               $('#operationTVPAlfieriStitch').prop("checked", false);
               $('#operationTVPAlfieriStitchLabel').removeClass("checked");
               $('#operationTVPDeVegaAnnularPlasty').prop("checked", false);
               $('#operationTVPDeVegaAnnularPlastyLabel').removeClass("checked");
               $("#operationTVR").val('');
               $("#operationTVR-button .ui-selectmenu-status").html('');
               $("#operationTricuspidValveMemo").val('');
               
                 $('#Operation_TricuspidValve_TVP').prop("checked", false);
               $('#Operation_TricuspidValve_TVP_Lalbel').removeClass("checked");
                 $('#operationTVPOthers').prop("checked", false);
               $('#operationTVPOthersLabel').removeClass("checked");
                 $('#Operation_TricuspidValve_TVR').prop("checked", false);
               $('#Operation_TricuspidValve_TVR_Lalbel').removeClass("checked");
               
               $("#TricuspidValveProductName").val('');
             $("#TricuspidValveProductName-button .ui-selectmenu-status").html('');
             $("#TricuspidValveProductType").val('');
             $("#TricuspidValveProductType-button .ui-selectmenu-status").html('');
            break;
              case "operationPulmonaryValve": 
              $("#operationPulmonaryValvePVP").val('');
               $("#operationPulmonaryValvePVR").val('');
               $("#operationPulmonaryValvePVR-button .ui-selectmenu-status").html('');
               $("#operationPulmonaryValveMemo").val('');
               
               $('#Operation_PulmonaryValve_PVP').prop("checked", false);
               $('#Operation_PulmonaryValve_PVP_Lalbel').removeClass("checked");
               $('#Operation_PulmonaryValve_PVR').prop("checked", false);
               $('#Operation_PulmonaryValve_PVR_Lalbel').removeClass("checked");
               
             $("#PulmonaryValveProductName").val('');
             $("#PulmonaryValveProductName-button .ui-selectmenu-status").html('');
             $("#PulmonaryValveProductType").val('');
             $("#PulmonaryValveProductType-button .ui-selectmenu-status").html('');
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
                
              $('#operationMazebiatrialLesion').prop("checked", false);
               $('#operationMazebiatrialLesionLabel').removeClass("checked");
               $('#operationMazePVIwithLAA').prop("checked", false);
               $('#operationMazePVIwithLAALabel').removeClass("checked");
                $('#operationMazePVIwithoutLAA').prop("checked", false);
               $('#operationMazePVIwithoutLAALabel').removeClass("checked");
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
                
                $('#operationEtiologyOthers').prop("checked", false);
               $('#operationEtiologyOthersLabel').removeClass("checked");
               $('#operationEtiologyCardiopulmonarBypass').prop("checked", false);
               $('#operationEtiologyCardiopulmonarBypassLabel').removeClass("checked");
               $("#operationAorticSurgeryCerebralProtection").val('');
               $("#operationAorticSurgeryCerebralProtection-button .ui-selectmenu-status").html('');
               $("#operationAorticSurgeryLocation").val('');
               $("#operationAorticSurgeryLocation-button .ui-selectmenu-status").html('');
               
            break;
              case "operationHeartTransplantation": 
              $("#operationHeartTransplantationMemo").val('');
              
               $('#operationHeartTransplantationOP').prop("checked", false);
               $('#operationHeartTransplantationOPLabel').removeClass("checked");
                $('#operationHeartTransplantationLVAD').prop("checked", false);
               $('#operationHeartTransplantationLVADLabel').removeClass("checked");
                $('#operationHeartTransplantationRVAD').prop("checked", false);
               $('#operationHeartTransplantationRVADLabel').removeClass("checked");
              
            break;
            case "operationOtherCardiacSurgery":
            
               $('#operationOtherCardiacSurgery1').prop("checked", false);
               $('#operationOtherCardiacSurgery1Label').removeClass("checked");
                $('#operationOtherCardiacSurgery2').prop("checked", false);
               $('#operationOtherCardiacSurgery2Label').removeClass("checked");
                $('#operationOtherCardiacSurgery3').prop("checked", false);
               $('#operationOtherCardiacSurgery3Label').removeClass("checked");
                $('#operationOtherCardiacSurgery4').prop("checked", false);
               $('#operationOtherCardiacSurgery4Label').removeClass("checked");
                $('#operationOtherCardiacSurgery5').prop("checked", false);
               $('#operationOtherCardiacSurgery5Label').removeClass("checked");
                $('#operationOtherCardiacSurgery6').prop("checked", false);
               $('#operationOtherCardiacSurgery6Label').removeClass("checked");
                $('#operationOtherCardiacSurgery7').prop("checked", false);
               $('#operationOtherCardiacSurgery7Label').removeClass("checked");
                $('#operationOtherCardiacSurgery8').prop("checked", false);
               $('#operationOtherCardiacSurgery8Label').removeClass("checked");
                $('#operationOtherCardiacSurgery9').prop("checked", false);
               $('#operationOtherCardiacSurgery9Label').removeClass("checked");
                $('#operationOtherCardiacSurgery10').prop("checked", false);
               $('#operationOtherCardiacSurgery10Label').removeClass("checked");
                $('#operationOtherCardiacSurgery11').prop("checked", false);
               $('#operationOtherCardiacSurgery11Label').removeClass("checked");
               $("#operationOtherCardiacSurgeryMemo").val('');
            break;
              case "operationCongenitalBypass": 
            $("#operationCongenitalBypassCPBTime").val('');
            $("#operationCongenitalBypassAorticTime").val('');
            $("#operationCongenitalBypassCirculatoryTime").val('');
              $("#operationCongenitalBypassCardioplegia").val('');
            $("#operationCongenitalBypassCardioplegia-button .ui-selectmenu-status").html('');
            break;
            
        }
    }
    
 }
 
function  chkMorbidity(){
      if($('#outcomeChildCauseofDeath1').is(':checked') || $('#outcomeChildCauseofDeath2').is(':checked')|| $('#outcomeChildCauseofDeath3').is(':checked')|| $('#outcomeChildCauseofDeath4').is(':checked')
    || $('#outcomeChildCauseofDeath5').is(':checked')|| $('#outcomeChildCauseofDeath6').is(':checked')|| $('#outcomeChildCauseofDeath7').is(':checked')|| $('#outcomeChildCauseofDeath8').is(':checked')
    || $('#outcomeChildCauseofDeath9').is(':checked')|| $('#outcomeChildCauseofDeath10').is(':checked')|| $('#outcomeChildCauseofDeath11').is(':checked')|| $('#outcomeChildCauseofDeath12').is(':checked')
    || $('#outcomeChildCauseofDeath13').is(':checked')|| $('#outcomeChildCauseofDeath14').is(':checked')|| $('#outcomeChildCauseofDeath15').is(':checked')|| $('#outcomeChildCauseofDeath16').is(':checked')
    || $('#outcomeChildCauseofDeath17').is(':checked')|| $('#outcomeChildCauseofDeath18').is(':checked')|| $('#outcomeChildCauseofDeath19').is(':checked')|| $('#outcomeChildCauseofDeath20').is(':checked')
    || $('#outcomeChildCauseofDeath21').is(':checked')|| $('#outcomeChildCauseofDeath22').is(':checked')|| $('#outcomeChildCauseofDeath23').is(':checked')|| $('#outcomeChildCauseofDeath24').is(':checked'))
    {
         $('#outcomeCheck1').prop("checked", true);
        $('#outcomeCheck1').addClass("checked");
    } 
    
    if($('#outcomeCheck1').is(':checked') || $('#outcomeCheck2').is(':checked') || $('#outcomeCheck3').is(':checked') || $('#outcomeCheck4').is(':checked') || $('#outcomeCheck5').is(':checked') || $('#outcomeCheck6').is(':checked')
    || $('#outcomeChildCauseofDeath1').is(':checked') || $('#outcomeChildCauseofDeath2').is(':checked')|| $('#outcomeChildCauseofDeath3').is(':checked')|| $('#outcomeChildCauseofDeath4').is(':checked')
    || $('#outcomeChildCauseofDeath5').is(':checked')|| $('#outcomeChildCauseofDeath6').is(':checked')|| $('#outcomeChildCauseofDeath7').is(':checked')|| $('#outcomeChildCauseofDeath8').is(':checked')
    || $('#outcomeChildCauseofDeath9').is(':checked')|| $('#outcomeChildCauseofDeath10').is(':checked')|| $('#outcomeChildCauseofDeath11').is(':checked')|| $('#outcomeChildCauseofDeath12').is(':checked')
    || $('#outcomeChildCauseofDeath13').is(':checked')|| $('#outcomeChildCauseofDeath14').is(':checked')|| $('#outcomeChildCauseofDeath15').is(':checked')|| $('#outcomeChildCauseofDeath16').is(':checked')
    || $('#outcomeChildCauseofDeath17').is(':checked')|| $('#outcomeChildCauseofDeath18').is(':checked')|| $('#outcomeChildCauseofDeath19').is(':checked')|| $('#outcomeChildCauseofDeath20').is(':checked')
    || $('#outcomeChildCauseofDeath21').is(':checked')|| $('#outcomeChildCauseofDeath22').is(':checked')|| $('#outcomeChildCauseofDeath23').is(':checked')|| $('#outcomeChildCauseofDeath24').is(':checked')){
        $('#outcomeCheck7').prop("checked", true);
        $('#outcomeCheck7').addClass("checked");
    
    } else {
        $('#outcomeCheck7').prop("checked", false);
        $('#outcomeCheck7').removeClass("checked");
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
function confirmVPVR(a,b){
    switch(a){
        case '1': 
        if(b=='1'){
            if($('#operationAorticValve_AVP').is(':checked')){
               
              $('#operationMitralValveBentall').prop("checked", false);
              $('#operationMitralValveBentallLabel').removeClass("checked");
              $("#operationBentallSelect").val('');
             $("#operationBentallSelect-button .ui-selectmenu-status").html('');
          
             $("#operationAVRSelect").val('');
             $("#operationAVRSelect-button .ui-selectmenu-status").html('');
            
              $('#operationAorticValve_AVR').prop("checked", false);
              $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
              
              $('#operationAorticValve_TAVI').prop("checked", false);
              $('#operationAorticValve_TAVI_Lalbel').removeClass("checked");
              
              
              $("#operationAorticValve_TAVI_S1").val('');
             $("#operationAorticValve_TAVI_S1-button .ui-selectmenu-status").html('');
             $("#operationAorticValve_TAVI_S2").val('');
             $("#operationAorticValve_TAVI_S2-button .ui-selectmenu-status").html('');
             
             qryValve('#AorticValveProductName', '');
             
              
            }
        } else if(b=='2'){
            
              if($('#operationAorticValve_AVR').is(':checked')){
                
            $("#operationAVP").val('');
            $("#operationAVP-button .ui-selectmenu-status").html('');
            
              $('#operationAorticValve_AVP').prop("checked", false);
              $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
                $('#operationMitralValveBentall').prop("checked", false);
              $('#operationMitralValveBentallLabel').removeClass("checked");
              $("#operationBentallSelect").val('');
             $("#operationBentallSelect-button .ui-selectmenu-status").html('');
              
               $('#operationAorticValve_TAVI').prop("checked", false);
              $('#operationAorticValve_TAVI_Lalbel').removeClass("checked");
              
              $("#operationAorticValve_TAVI_S1").val('');
             $("#operationAorticValve_TAVI_S1-button .ui-selectmenu-status").html('');
             $("#operationAorticValve_TAVI_S2").val('');
             $("#operationAorticValve_TAVI_S2-button .ui-selectmenu-status").html('');
             
             qryValve('#AorticValveProductName', $("#operationAVRSelect").val());
            }
        } else if(b=='3'){
              if($('#operationMitralValveBentall').is(':checked')){
                
           $("#operationAVP").val('');
           $("#operationAVP-button .ui-selectmenu-status").html('');
            
            $('#operationAorticValve_AVP').prop("checked", false);
            $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
             $("#operationAVRSelect").val('');
            $("#operationAVRSelect-button .ui-selectmenu-status").html('');
            
              $('#operationAorticValve_AVR').prop("checked", false);
              $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
              
               $('#operationAorticValve_TAVI').prop("checked", false);
              $('#operationAorticValve_TAVI_Lalbel').removeClass("checked");
              
              $("#operationAorticValve_TAVI_S1").val('');
             $("#operationAorticValve_TAVI_S1-button .ui-selectmenu-status").html('');
             $("#operationAorticValve_TAVI_S2").val('');
             $("#operationAorticValve_TAVI_S2-button .ui-selectmenu-status").html('');
             
             qryValve('#AorticValveProductName', $("#operationBentallSelect").val());
            } } else {
              
                  if($('#operationAorticValve_TAVI').is(':checked')){
             
            $('#operationAorticValve_AVP').prop("checked", false);
            $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
              $("#operationAVP").val('');
            $("#operationAVP-button .ui-selectmenu-status").html('');
             $("#operationAVRSelect").val('');
            $("#operationAVRSelect-button .ui-selectmenu-status").html('');
            
              $('#operationAorticValve_AVR').prop("checked", false);
              $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
              
              
              
                $('#operationMitralValveBentall').prop("checked", false);
              $('#operationMitralValveBentallLabel').removeClass("checked");
              $("#operationBentallSelect").val('');
             $("#operationBentallSelect-button .ui-selectmenu-status").html('');
              
                  qryValve('#AorticValveProductName','TAVI');
            }
        }
        break;
           case '2': 
            if(b=='1'){
            if($('#Operation_MitralValve_MVP').is(':checked')){
               
            $('#operationMVPRing').prop("checked", false);
              
                 $("#operationMVR-button .ui-selectmenu-status").html('');
                 $("#operationMVRMemo").val('');
                 
                   $('#Operation_MitralValve_MVR').prop("checked", false);
                 $('#Operation_MitralValve_MVR_Lalbel').removeClass("checked");
                 
            } else {
                $('#operationMVPRing').prop("checked", false);
                $('#operationMVPRingLabel').removeClass("checked");
                $('#operationMVPArtificialChord').prop("checked", false);
                $('#operationMVPArtificialChordLabel').removeClass("checked");
                $('#operationMVPAnnularPlication').prop("checked", false);
                $('#operationMVPAnnularPlicationLabel').removeClass("checked");
                $('#operationMVPLeafletResection').prop("checked", false);
                $('#operationMVPLeafletResectionLabel').removeClass("checked");
                $('#operationMVPAlfieriStitch').prop("checked", false);
                $('#operationMVPAlfieriStitchLabel').removeClass("checked");
                $('#operationMVPDeVegaAnnularPlasty').prop("checked", false);
                $('#operationMVPDeVegaAnnularPlastyLabel').removeClass("checked");
                $('#operationMVPOthers').prop("checked", false);
                $('#operationMVPOthersLabel').removeClass("checked");
            }
        } else {
            
              if($('#Operation_MitralValve_MVR').is(':checked')){
                
           $('#operationMVPRing').prop("checked", false);
                 $('#operationMVPRingLabel').removeClass("checked");
                 $('#operationMVPArtificialChord').prop("checked", false);
                 $('#operationMVPArtificialChordLabel').removeClass("checked");
                 $('#operationMVPAnnularPlication').prop("checked", false);
                 $('#operationMVPAnnularPlicationLabel').removeClass("checked");
                 $('#operationMVPLeafletResection').prop("checked", false);
                 $('#operationMVPLeafletResectionLabel').removeClass("checked");
                 $('#operationMVPAlfieriStitch').prop("checked", false);
                 $('#operationMVPAlfieriStitchLabel').removeClass("checked");
                 $('#operationMVPDeVegaAnnularPlasty').prop("checked", false);
                 $('#operationMVPDeVegaAnnularPlastyLabel').removeClass("checked");
                 
                   $('#Operation_MitralValve_MVP').prop("checked", false);
                 $('#Operation_MitralValve_MVP_Lalbel').removeClass("checked");
                   $('#operationMVPOthers').prop("checked", false);
                 $('#operationMVPOthersLabel').removeClass("checked");
               
            } else {
                $('#Operation_MitralValve_MVR').prop("checked", false);
                $('#Operation_MitralValve_MVR_Lalbel').removeClass("checked");
            }
        }
        break;
           case '3': 
            if(b=='1'){
            if($('#Operation_TricuspidValve_TVP').is(':checked')){
               
            $('#operationMVPRing').prop("checked", false);
              
              
               $("#operationTVR").val('');
               $("#operationTVR-button .ui-selectmenu-status").html('');
              
                 $('#Operation_TricuspidValve_TVR').prop("checked", false);
               $('#Operation_TricuspidValve_TVR_Lalbel').removeClass("checked");
                 
            } else {
                  $('#operationTVPRing').prop("checked", false);
                  $('#operationTVPRingLabel').removeClass("checked");
                  $('#operationTVPArtificialChord').prop("checked", false);
                  $('#operationTVPArtificialChordLabel').removeClass("checked");
                  $('#operationTVPAnnularPlication').prop("checked", false);
                  $('#operationTVPAnnularPlicationLabel').removeClass("checked");
                  $('#operationTVPLeafletResection').prop("checked", false);
                  $('#operationTVPLeafletResectionLabel').removeClass("checked");
                  $('#operationTVPAlfieriStitch').prop("checked", false);
                  $('#operationTVPAlfieriStitchLabel').removeClass("checked");
                  $('#operationTVPDeVegaAnnularPlasty').prop("checked", false);
                  $('#operationTVPDeVegaAnnularPlastyLabel').removeClass("checked");
                  $('#operationTVPOthers').prop("checked", false);
                  $('#operationTVPOthersLabel').removeClass("checked");
            }
        } else {
            
              if($('#Operation_TricuspidValve_TVR').is(':checked')){
                
            $('#operationTVPRing').prop("checked", false);
               $('#operationTVPRingLabel').removeClass("checked");
               $('#operationTVPArtificialChord').prop("checked", false);
               $('#operationTVPArtificialChordLabel').removeClass("checked");
               $('#operationTVPAnnularPlication').prop("checked", false);
               $('#operationTVPAnnularPlicationLabel').removeClass("checked");
               $('#operationTVPLeafletResection').prop("checked", false);
               $('#operationTVPLeafletResectionLabel').removeClass("checked");
                $('#operationTVPAlfieriStitch').prop("checked", false);
               $('#operationTVPAlfieriStitchLabel').removeClass("checked");
                $('#operationTVPDeVegaAnnularPlasty').prop("checked", false);
               $('#operationTVPDeVegaAnnularPlastyLabel').removeClass("checked");
               
                 $('#Operation_TricuspidValve_TVP').prop("checked", false);
               $('#Operation_TricuspidValve_TVP_Lalbel').removeClass("checked");
                 $('#operationTVPOthers').prop("checked", false);
               $('#operationTVPOthersLabel').removeClass("checked");
               
               
            } else {
                    $('#operationTVR').val('');
                    $("#operationTVR-button .ui-selectmenu-status").html('');
            }
        }
        break;
        case "4":
            if(b=='1'){
            if($('#Operation_PulmonaryValve_PVP').is(':checked')){
               
               $("#operationPulmonaryValvePVR").val('');
               $("#operationPulmonaryValvePVR-button .ui-selectmenu-status").html('');
               
               
               $('#Operation_PulmonaryValve_PVR').prop("checked", false);
               $('#Operation_PulmonaryValve_PVR_Lalbel').removeClass("checked");
                 
            } else {
                 $('#operationPulmonaryValvePVP').val('');
            }
            qryValve('#PulmonaryValveProductName', $("#operationPulmonaryValvePVR").val());
        } else {
            
              if($('#Operation_PulmonaryValve_PVR').is(':checked')){
                
               $("#operationPulmonaryValvePVP").val('');
           
               
               $('#Operation_PulmonaryValve_PVP').prop("checked", false);
               $('#Operation_PulmonaryValve_PVP_Lalbel').removeClass("checked");
               
               
            } else {
                  $('#operationPulmonaryValvePVR').val('');
                  $("#operationPulmonaryValvePVR-button .ui-selectmenu-status").html('');
            }
           // qryValve('#PulmonaryValveProductName', $("#operationPulmonaryValvePVR").val());
        }
        break;
    }
}
function calLOS(d,a){
    var datediff=0;
    if($('#patientOpDate').val()!="" && ($('#patientDischargeDate').val()!="" || $('#patientDischargeDate1').val()!="")){
    if(d=="1"){
        datediff=daydiff(parseDate($('#patientOpDate').val()), parseDate($('#patientDischargeDate').val()));
        if(datediff<0){
            $("#patientDischargeDate").notify("出院日必須大於開刀日期 ", "error");
             $('#patientDischargeDate').val($('#patientDischargeDate1').val());
             return false;
        } else{
             $("#patientDischargeDate").notify("", "info");
        $('#patientDischargeDate1').val($('#patientDischargeDate').val());
        }
        
    }else {
        datediff=daydiff(parseDate($('#patientOpDate').val()), parseDate($('#patientDischargeDate1').val()));
         if(datediff<0){
            $("#patientDischargeDate1").notify("出院日必須大於開刀日期 ", "error");
                $('#patientDischargeDate1').val($('#patientDischargeDate').val());
             return false;
        } else{
            $("#patientDischargeDate1").notify("", "info");
        $('#patientDischargeDate').val($('#patientDischargeDate1').val());
        }
        }
    }
    if(datediff>0){
    $('#outcomeCheck8').val(datediff);
    if(datediff<6){
        $('#outcomeCheck9').prop("checked", true);
        //$('#Operation_PulmonaryValve_PVR_Lalbel').removeClass("checked");
    } else {
        $('#outcomeCheck9').prop("checked", false);
    }
     if(datediff>14){
        $('#outcomeCheck10').prop("checked", true);
        //$('#Operation_PulmonaryValve_PVR_Lalbel').removeClass("checked");
    } else {
        $('#outcomeCheck10').prop("checked", false);
    }
    } else{
           $('#outcomeCheck8').val('');
           $('#outcomeCheck10').prop("checked", false);
            $('#outcomeCheck9').prop("checked", false);
    }
}

function parseDate(str) {
    var mdy = str.split('-');
    return new Date(mdy[0], mdy[1]-1, mdy[2]);
}

function daydiff(first, second) {
    return Math.round((second-first)/(1000*60*60*24));
}

function showDiagnosis(w,did,dcat,dsub){
    $("#CongenitalDiagnosis"+w).val(dsub);
    $("#CongenitalDiagnosis_id"+w).val(did);   
}
function showProcedure(w,did,dcat,dsub){
    $("#CongenitalProcedure"+w).val(dsub);
    $("#CongenitalProcedure_id"+w).val(did);   
}
function showAdultDiagnosis(w,did,dcat,dsub){
    $("#AdultDiagnosis"+w).val(dsub);
    $("#AdultDiagnosis_id"+w).val(did);   
}

function chkCPBTime(){
    if($("#operationCongenitalBypassCPBTime").val()!="" && $("#operationCongenitalBypassAorticTime").val()!=""){
    if(parseInt($("#operationCongenitalBypassCPBTime").val())<parseInt($("#operationCongenitalBypassAorticTime").val())){
        $("#operationCongenitalBypassCPBTime").notify("CPB time必須大於 cross clamp time","error");
    } else {
        $("#operationCongenitalBypassCPBTime").notify("");
    }
    }
} 

function chkTVP(){
    if($('#operationTVPRing').is(':checked') || $('#operationTVPArtificialChord').is(':checked') || $('#operationTVPAnnularPlication').is(':checked') || $('#operationTVPLeafletResection').is(':checked') || $('#operationTVPAlfieriStitch').is(':checked') || $('#operationTVPDeVegaAnnularPlasty').is(':checked') || $('#operationTVPOthers').is(':checked')){
     $('#Operation_TricuspidValve_TVP').prop("checked", true);
     $('#Operation_TricuspidValve_TVP_Lalbel').addClass("checked");
      $('#Operation_TricuspidValve_TVR').prop("checked", false);
      $('#Operation_TricuspidValve_TVR_Lalbel').removeClass("checked");
      $('#operationTVR').val('');
      $("#operationTVR-button .ui-selectmenu-status").html('');
    } 
    }
   function chkTVR(){
   if($('#operationTVR').val()!=""){
      $('#Operation_TricuspidValve_TVP').prop("checked", false);
      $('#Operation_TricuspidValve_TVR').prop("checked", true);
      $('#Operation_TricuspidValve_TVP_Lalbel').removeClass("checked");
       $('#Operation_TricuspidValve_TVR_Lalbel').addClass("checked");
       $('#operationTVPRing').prop("checked", false);
       $('#operationTVPRingLabel').removeClass("checked");
       $('#operationTVPArtificialChord').prop("checked", false);
       $('#operationTVPArtificialChordLabel').removeClass("checked");
       $('#operationTVPAnnularPlication').prop("checked", false);
       $('#operationTVPAnnularPlicationLabel').removeClass("checked");
       $('#operationTVPLeafletResection').prop("checked", false);
       $('#operationTVPLeafletResectionLabel').removeClass("checked");
       $('#operationTVPAlfieriStitch').prop("checked", false);
       $('#operationTVPAlfieriStitchLabel').removeClass("checked");
       $('#operationTVPDeVegaAnnularPlasty').prop("checked", false);
       $('#operationTVPDeVegaAnnularPlastyLabel').removeClass("checked");
       $('#operationTVPOthers').prop("checked", false);
       $('#operationTVPOthersLabel').removeClass("checked");
    } else {
           $('#Operation_TricuspidValve_TVR').prop("checked", false);
           $('#Operation_TricuspidValve_TVR_Lalbel').removeClass("checked");
    }
    qryValve('#TricuspidValveProductName', $('#operationTVR').val());
}

function chkMVP(){
    if($('#operationMVPRing').is(':checked') || $('#operationMVPArtificialChord').is(':checked') || $('#operationMVPAnnularPlication').is(':checked') || $('#operationMVPLeafletResection').is(':checked') || $('#operationMVPAlfieriStitch').is(':checked') || $('#operationMVPDeVegaAnnularPlasty').is(':checked') || $('#operationMVPOthers').is(':checked') ){
     $('#Operation_MitralValve_MVP').prop("checked", true);
     $('#Operation_MitralValve_MVP_Lalbel').addClass("checked");
      $('#Operation_MitralValve_MVR').prop("checked", false);
      $('#Operation_MitralValve_MVR_Lalbel').removeClass("checked");
      $('#operationMVR').val('');
      $("#operationMVR-button .ui-selectmenu-status").html('');
    } 
    }
   function chkMVR(){
   if($('#operationMVR').val()!=""){
      $('#Operation_MitralValve_MVP').prop("checked", false);
      $('#Operation_MitralValve_MVR').prop("checked", true);
      $('#Operation_MitralValve_MVP_Lalbel').removeClass("checked");
       $('#Operation_MitralValve_MVR_Lalbel').addClass("checked");
       $('#operationMVPRing').prop("checked", false);
       $('#operationMVPRingLabel').removeClass("checked");
       $('#operationMVPArtificialChord').prop("checked", false);
       $('#operationMVPArtificialChordLabel').removeClass("checked");
       $('#operationMVPAnnularPlication').prop("checked", false);
       $('#operationMVPAnnularPlicationLabel').removeClass("checked");
       $('#operationMVPLeafletResection').prop("checked", false);
       $('#operationMVPLeafletResectionLabel').removeClass("checked");
       $('#operationMVPAlfieriStitch').prop("checked", false);
       $('#operationMVPAlfieriStitchLabel').removeClass("checked");
       $('#operationMVPDeVegaAnnularPlasty').prop("checked", false);
       $('#operationMVPDeVegaAnnularPlastyLabel').removeClass("checked");
       $('#operationMVPOthers').prop("checked", false);
       $('#operationMVPOthersLabel').removeClass("checked");
       
       
    } else {
           $('#Operation_MitralValve_MVR').prop("checked", false);
           $('#Operation_MitralValve_MVR_Lalbel').removeClass("checked");
    }
    qryValve('#MitralValveProductName', $('#operationMVR').val());
    }
    function chkPVP(){
    if($('#operationPulmonaryValvePVP').val()!=""  ){
     $('#Operation_PulmonaryValve_PVP').prop("checked", true);
     $('#Operation_PulmonaryValve_PVP_Lalbel').addClass("checked");
      $('#Operation_PulmonaryValve_PVR').prop("checked", false);
      $('#Operation_PulmonaryValve_PVR_Lalbel').removeClass("checked");
      $('#operationPulmonaryValvePVR').val('');
      $("#operationPulmonaryValvePVR-button .ui-selectmenu-status").html('');
    } 
    }
   function chkPVR(){
   if($('#operationPulmonaryValvePVR').val()!=""){
      $('#Operation_PulmonaryValve_PVP').prop("checked", false);
      $('#Operation_PulmonaryValve_PVR').prop("checked", true);
      $('#Operation_PulmonaryValve_PVP_Lalbel').removeClass("checked");
       $('#Operation_PulmonaryValve_PVR_Lalbel').addClass("checked");
       $('#operationPulmonaryValvePVP').val('');
    } else {
           $('#Operation_PulmonaryValve_PVR').prop("checked", false);
           $('#Operation_PulmonaryValve_PVR_Lalbel').removeClass("checked");
    }
    if($('#operationPulmonaryValvePVR').val()=='Bioprosthesis')
    qryValve('#PulmonaryValveProductName', 'Bioprosthetic Valve');
    else
    qryValve('#PulmonaryValveProductName', $('#operationPulmonaryValvePVR').val()+ ' Valve');
}

 function chkAVP(){
    if($('#operationAVP').val()!=""  ){
     $('#operationAorticValve_AVP').prop("checked", true);
     $('#operationAorticValve_AVP_Lalbel').addClass("checked");
      $('#operationAorticValve_AVR').prop("checked", false);
      $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
      $('#operationAVRSelect').val('');
      $("#operationAVRSelect-button .ui-selectmenu-status").html('');
       $('#operationMitralValveBentall').prop("checked", false);
      $('#operationMitralValveBentallLabel').removeClass("checked");
    } else {
      $('#operationAorticValve_AVP').prop("checked", false);
      $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
     
    }
    }
   function chkAVR(){
   if($('#operationAVRSelect').val()!=""){
      $('#operationAorticValve_AVP').prop("checked", false);
      $('#operationAorticValve_AVR').prop("checked", true);
      $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
      $('#operationAorticValve_AVR_Lalbel').addClass("checked");
      $('#operationAVP').val('');
      $("#operationAVP-button .ui-selectmenu-status").html('');
      $('#operationMitralValveBentall').prop("checked", false);
      $('#operationMitralValveBentallLabel').removeClass("checked");
    } else {
           $('#operationAorticValve_AVR').prop("checked", false);
           $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
    }
}

   function chkTAVI(){
   if($('#operationAorticValve_TAVI_S1').val()!="" || $('#operationAorticValve_TAVI_S2').val()!=""){
      $('#operationAorticValve_TAVI').prop("checked", true);
      $('#operationAorticValve_TAVI_Lalbel').removeClass("checked");
      $('#operationAorticValve_TAVI_Lalbel').addClass("checked");
     
    } else {
           $('#operationAorticValve_TAVI').prop("checked", false);
           $('#operationAorticValve_TAVI_Lalbel').removeClass("checked");
    }
}

function chkBentall(){
     if($('#operationMitralValveBentall').is(':checked') || $('#operationBentallSelect').val()!=""){
      $('#operationAorticValve_AVP').prop("checked", false);
      $('#operationAorticValve_AVR').prop("checked", false);
      $('#operationAorticValve_AVP_Lalbel').removeClass("checked");
      $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
      $('#operationAVP').val('');
      $("#operationAVP-button .ui-selectmenu-status").html('');
      $('#operationAVRSelect').val('');
      $("#operationAVRSelect-button .ui-selectmenu-status").html('');
     
    } else {
           $('#operationAorticValve_AVR').prop("checked", false);
           $('#operationAorticValve_AVR_Lalbel').removeClass("checked");
           $('#operationAVP').val('');
           $("#operationAVP-button .ui-selectmenu-status").html('');
    }
}
function chkBentallsSelect(){
     if($('#operationBentallSelect').val()!=""){
          $('#operationMitralValveBentall').prop("checked", true);
           $('#operationMitralValveBentallLabel').addClass("checked");
     }
}
function checkcomplex(d){
    if($('#outcomeChildComplication'+d).is(":checked")){
        $('#simpleChildComplication'+d).prop('checked', true);
    } else {
        $('#simpleChildComplication'+d).prop('checked', false);
    }
        switch(d){
        case "14":
              if($("#simpleChildComplication"+d).is(":checked")){
                  $('#outcomeCheck2').prop('checked', true);
              } else {
                  $('#outcomeCheck2').prop('checked', false);
              }
              break;
         case "23":
              if($("#simpleChildComplication"+d).is(":checked")){
                  $('#outcomeCheck3').prop('checked', true);
              } else {
                  $('#outcomeCheck3').prop('checked', false);
              }
              break;
         case "35":
              if($("#simpleChildComplication"+d).is(":checked")){
                  $('#outcomeCheck5').prop('checked', true);
              } else {
                  $('#outcomeCheck5').prop('checked', false);
              }
              break;
    }
}
function checkSimple(d){
    if($('#simpleChildComplication'+d).is(":checked")){
        $('#outcomeChildComplication'+d).prop('checked', true);
    } else {
        $('#outcomeChildComplication'+d).prop('checked', false);
    }
    switch(d){
        case "14":
              if($("#simpleChildComplication"+d).is(":checked")){
                  $('#outcomeCheck2').prop('checked', true);
              } else {
                  $('#outcomeCheck2').prop('checked', false);
              }
              break;
         case "23":
              if($("#simpleChildComplication"+d).is(":checked")){
                  $('#outcomeCheck3').prop('checked', true);
              } else {
                  $('#outcomeCheck3').prop('checked', false);
              }
              break;
         case "35":
              if($("#simpleChildComplication"+d).is(":checked")){
                  $('#outcomeCheck5').prop('checked', true);
              } else {
                  $('#outcomeCheck5').prop('checked', false);
              }
              break;
    }
}
function checkAdult(d){
    switch(d){
        case "2":
              if($("#outcomeCheck"+d).is(":checked")){
                  $('#simpleChildComplication14').prop('checked', true);
                  $('#outcomeChildComplication14').prop('checked', true);
              } else {
                  $('#simpleChildComplication14').prop('checked', false);
                  $('#outcomeChildComplication14').prop('checked', false);
              }
              break;
         case "3":
              if($("#outcomeCheck"+d).is(":checked")){
                  $('#simpleChildComplication23').prop('checked', true);
                  $('#outcomeChildComplication23').prop('checked', true);
              } else {
                  $('#simpleChildComplication23').prop('checked', false);
                  $('#outcomeChildComplication23').prop('checked', false);
              }
              break;
         case "5":
              if($("#outcomeCheck"+d).is(":checked")){
                  $('#simpleChildComplication35').prop('checked', true);
                  $('#outcomeChildComplication35').prop('checked', true);
              } else {
                  $('#simpleChildComplication35').prop('checked', false);
                  $('#outcomeChildComplication35').prop('checked', false);
              }
              break;
    }
}
function checkReopen(){
        if($("#simpleChildComplication4").is(":checked") || $("#simpleChildComplication33").is(":checked")) {
                  $('#outcomeCheck6').prop('checked', true);
                  chkMorbidity();
              }
}
function checkOutcomeReopen(){
        if(!$("#outcomeCheck6").is(":checked") && ($("#simpleChildComplication4").is(":checked") || $("#simpleChildComplication33").is(":checked"))) {
                  if(confirm('complications of CHD 中 \n Bleeding, requiring reoperation 或 \n  Unplanned cardiac reoperation during the postoperative or postprocedural time period, exclusive of reoperation for bleeding \n 己有項目打勾 \n\n 請問您確定要取消Reoperation For any reason嗎?')){
                  chkMorbidity();
                  } else{
                      $('#outcomeCheck6').prop('checked', true);
                  }
              }
}
function showMoreComplication(){
    if($('#moreComplication').is(":visible")){
       $('#moreComplication').hide('slow');
     
      $("#btnShowMore").removeClass("orange medium");
      $("#btnShowMore").addClass("blue medium");
      } else {
           $('#moreComplication').show('slow');
     
      $("#btnShowMore").removeClass("blue medium");
      $("#btnShowMore").addClass("orange medium");
      }
}

function showComplication(){
      $('#divChildOutcome').show();
      $("#btnShowComplication").removeClass("blue medium");
      $("#btnShowComplication").addClass("orange medium");
}
 function sentForm(){
     var errorMsg="";
     if( $( "#patientChartNumber" ).val()==""){
         errorMsg+="Chart Number 不能為空白\n";
     }
     if( $( "#patientBirthday" ).val()==""){
         errorMsg+="Birth Date 不能為空白\n";
     }
     if( $( "#patientOpDate" ).val()==""){
         errorMsg+="OP Date 不能為空白\n";
     }
     if(errorMsg!=""){
         $("#sendFrom").notify(errorMsg,"error");
         event.preventDefault();
     } else{
         $("#addPatient").submit();
     }
 }
 
 function chkMaze(d){
     switch(d){
         case "1": if($("#operationMazebiatrialLesion").is(":checked")){
                             $('#operationMazeLA').prop("checked", false);
                             $('#operationMazeLALabel').removeClass("checked");
                             $('#operationMazePVIwithLAA').prop("checked", false);
                             $('#operationMazePVIwithLAALabel').removeClass("checked");
                             $('#operationMazePVIwithoutLAA').prop("checked", false);
                             $('#operationMazePVIwithoutLAALabel').removeClass("checked");
                             $('#operationMazeOthers').prop("checked", false);
                             $('#operationMazeOthersLabel').removeClass("checked");
                             }
                             break;
           case "2": if($("#operationMazeLA").is(":checked")){
                             $('#operationMazebiatrialLesion').prop("checked", false);
                             $('#operationMazebiatrialLesionLabel').removeClass("checked");
                             $('#operationMazePVIwithLAA').prop("checked", false);
                             $('#operationMazePVIwithLAALabel').removeClass("checked");
                             $('#operationMazePVIwithoutLAA').prop("checked", false);
                             $('#operationMazePVIwithoutLAALabel').removeClass("checked");
                             $('#operationMazeOthers').prop("checked", false);
                             $('#operationMazeOthersLabel').removeClass("checked");
                             }
                             break;
           case "3": if($("#operationMazePVIwithLAA").is(":checked")){
                             $('#operationMazeLA').prop("checked", false);
                             $('#operationMazeLALabel').removeClass("checked");
                             $('#operationMazebiatrialLesion').prop("checked", false);
                             $('#operationMazebiatrialLesionLabel').removeClass("checked");
                             $('#operationMazePVIwithoutLAA').prop("checked", false);
                             $('#operationMazePVIwithoutLAALabel').removeClass("checked");
                             $('#operationMazeOthers').prop("checked", false);
                             $('#operationMazeOthersLabel').removeClass("checked");
                             }
                             break;
             case "4": if($("#operationMazePVIwithoutLAA").is(":checked")){
                             $('#operationMazeLA').prop("checked", false);
                             $('#operationMazeLALabel').removeClass("checked");
                             $('#operationMazePVIwithLAA').prop("checked", false);
                             $('#operationMazePVIwithLAALabel').removeClass("checked");
                             $('#operationMazebiatrialLesion').prop("checked", false);
                             $('#operationMazebiatrialLesionLabel').removeClass("checked");
                             $('#operationMazeOthers').prop("checked", false);
                             $('#operationMazeOthersLabel').removeClass("checked");
                             }
                             break;
              case "5": if($("#operationMazeOthers").is(":checked")){
                             $('#operationMazeLA').prop("checked", false);
                             $('#operationMazeLALabel').removeClass("checked");
                             $('#operationMazePVIwithLAA').prop("checked", false);
                             $('#operationMazePVIwithLAALabel').removeClass("checked");
                             $('#operationMazePVIwithoutLAA').prop("checked", false);
                             $('#operationMazePVIwithoutLAALabel').removeClass("checked");
                             $('#operationMazebiatrialLesion').prop("checked", false);
                             $('#operationMazebiatrialLesionLabel').removeClass("checked");
                             }
                             break;
     }
 }
 
 function deletePatientDiagnosis(d){
     $('#AdultDiagnosis'+d).val('');
     $('#AdultDiagnosis_id'+d).val('');
 }
  function deleteChildDiagnosis(d){
     $('#CongenitalDiagnosis'+d).val('');
     $('#CongenitalDiagnosis_id'+d).val('');
 }
 function deleteChildProcedure(d){
     $('#CongenitalProcedure'+d).val('');
     $('#CongenitalProcedure_id'+d).val('');
 }
 function chkMortality(){
     if($('#outcomeStatus').val()=="4: 死亡" || $('#outcomeStatus').val()=="A：病危自動出院" ){
         
         $('#outcomeCheck1').prop('checked', true);
     } else {
         $('#outcomeCheck1').prop('checked', false);
     }
 }
 
 function chkLVADVal(s,t){
     
     if($('#'+s).prop("checked")){
         $('#'+t).val('NA');
         $('#'+t).prop('readonly', true);
         $('#'+t).removeClass( "small").addClass( "smallDisabled");
     } else{
         $('#'+t).val('');
         $('#'+t).prop('readonly', false);
         $('#'+t).removeClass( "smallDisabled").addClass( "small" );
      
     }
     calHMRS();
 }
 
 function calHMRS(){
     var HMRSScore=0;
     var HMRSFlag=0;
     //HMRS = (0.0274 * [age in years]) - (0.723 *[albumin g/dl]) + (0.74 *[creatinine mg/dl])＋
     //(1.136 * [INR]) + (0.807 * [center LVAD volume<15*]).
     //其中最後⼀一項[center LVAD volume<15*]台⼤大總院帶[0], ”age”去抓前⾯面的資料。
     if($('#patientAge').val()!="" && $('#LVADCreatinine').val()!="" &&  $('#LVADAlbumin').val()!="" &&  $('#LVADINR').val()!=""){
         if($('#patientAgeUnit').val()=="3"){
             HMRSScore+=0.0274*parseFloat($('#patientAge').val())/360;
         } else if($('#patientAgeUnit').val()=="2"){
             HMRSScore+=0.0274*parseFloat($('#patientAge').val())/12;
         } else {
         HMRSScore+=0.0274*parseFloat($('#patientAge').val());
      //   alert($('#patientAge').val());
         }
         
         if($('#LVADCreatinine').val()!="" && $('#LVADCreatinine').val()!="NA"){
             if(parseFloat($('#LVADCreatinine').val())>3.5 || $('#LVADDialysis').is(':checked')) {
                 HMRSScore+=0.74*3.5;
                 HMRSFlag=1;
             } else {
              HMRSScore+=0.74*parseFloat($('#LVADCreatinine').val());
              }
          //    alert(HMRSScore);
         }
         
         if($('#LVADAlbumin').val()!="" && $('#LVADAlbumin').val()!="NA"){
              HMRSScore-=0.723*parseFloat($('#LVADAlbumin').val());
          //    alert(HMRSScore);
         }
         
           if($('#LVADINR').val()!="" && $('#LVADINR').val()!="NA"){
               if(parseFloat($('#LVADINR').val())>2.5){
                   HMRSScore+=1.136*2.5;
                   HMRSFlag=1;
               } else {
              HMRSScore+=1.136*parseFloat($('#LVADINR').val());
              } 
            //  alert(HMRSScore);
         }
         
         if(parseFloat(<?php echo $LVADCount;?>) <15){
             HMRSScore+=0.807;
         }
         $('#LVADHMRS').val(HMRSScore.toFixed(5));
         
         //Risk: [Low Risk (if HMRS< 1.58), Medium Risk (if HMRS: 1.58~2.48), High Risk (ifHMRS > 2.48)]
          if(HMRSScore<1.58){
              $('#LVADHMRSRisk').val('Low Risk');
              $('#LVADHMRS90DaysMortality').val('4%');
          } else  if(HMRSScore>=1.58 && HMRSScore<2.48){
              $('#LVADHMRSRisk').val('Medium Risk');
              $('#LVADHMRS90DaysMortality').val('16%');
          } else if(HMRSScore>=2.48){
              $('#LVADHMRSRisk').val('High Risk ');
              $('#LVADHMRS90DaysMortality').val('29%');
          }
         // Predict 90-day mortality
     } else {
         $('#LVADHMRS').val('');
         $('#LVADHMRSRisk').val(' ');
              $('#LVADHMRS90DaysMortality').val('');
     }
     
     if(HMRSFlag==1){
         $('#LVADHMRSNote').show();
     } else {
         $('#LVADHMRSNote').hide();
     }
 }
 
  function calCRITT(){
     var CRITT=0;
      if(($('input[name=LVADPreOperativeVentlator]:checked').val()=="Y" || $('input[name=LVADPreOperativeVentlator]:checked').val()=="N" ||  $('input[name=LVADPreOperativeVentlator]:checked').val()=="not available") 
      && ($('input[name=LVADSevereRV]:checked').val()=="Y" || $('input[name=LVADSevereRV]:checked').val()=="N" ||  $('input[name=LVADSevereRV]:checked').val()=="not available") 
      && ($('input[name=LVADSevereTR]:checked').val()=="Y" || $('input[name=LVADSevereTR]:checked').val()=="N" ||  $('input[name=LVADSevereTR]:checked').val()=="not available") 
      && $('#LVADCVPLevel').val()!="" &&  $('#LVADHeartRate').val()!=""
  ) {
    if($('#LVADCVPLevel').val()!="" && $('#LVADCVPLevel').val()!="NA" && parseFloat($('#LVADCVPLevel').val())>15){
        CRITT++;
  } 
    if($('#LVADHeartRate').val()!="" && $('#LVADHeartRate').val()!="NA" && parseFloat($('#LVADHeartRate').val())>100){
        CRITT++;
  } 
  if($('input[name=LVADSevereRV]:checked').val()=="Y" ){
        CRITT++;
  } 
  if($('input[name=LVADSevereTR]:checked').val()=="Y" ){
        CRITT++;
  } 
   if($('input[name=LVADPreOperativeVentlator]:checked').val()=="Y" ){
        CRITT++;
  } 
  $('#LVADCRITTScore').val(CRITT);
  if(CRITT==0 || CRITT==1){
      $('#LVADCRITTNote').val("93% of patients underwent successful isolated LVAD therapy");
  } else if(CRITT==2 || CRITT==3){
        $('#LVADCRITTNote').val("may be able to tolerate an isolated LVAD with appropriate pharmacologic or temporary RVAD support.");
  } else if(CRITT==4 || CRITT==5){
        $('#LVADCRITTNote').val("80% of patients required biventricular assistance.");
  }
  } else {
       $('#LVADCRITTScore').val("");
       $('#LVADCRITTNote').val("");
  }
  }
  function changeHYHA(d){
     if(d=='1'){
          $('#LVADNYHAClass').val($('#pastHistoryNYHA').val());
          if($('#pastHistoryNYHA').val()=="1"){
          $("#LVADNYHAClass-button .ui-selectmenu-status").html('I');
          } else  if($('#pastHistoryNYHA').val()=="2"){
          $("#LVADNYHAClass-button .ui-selectmenu-status").html('II');
          }  else  if($('#pastHistoryNYHA').val()=="3"){
          $("#LVADNYHAClass-button .ui-selectmenu-status").html('III');
          }   else  if($('#pastHistoryNYHA').val()=="4"){
          $("#LVADNYHAClass-button .ui-selectmenu-status").html('IV');
          }  else {
              $("#LVADNYHAClass-button .ui-selectmenu-status").html('');
          }
      } else {
          $('#pastHistoryNYHA').val($('#LVADNYHAClass').val());
          if($('#LVADNYHAClass').val()=="1"){
          $("#pastHistoryNYHA-button .ui-selectmenu-status").html('I');
          } else  if($('#LVADNYHAClass').val()=="2"){
          $("#pastHistoryNYHA-button .ui-selectmenu-status").html('II');
          }  else  if($('#LVADNYHAClass').val()=="3"){
          $("#pastHistoryNYHA-button .ui-selectmenu-status").html('III');
          }   else  if($('#LVADNYHAClass').val()=="4"){
          $("#pastHistoryNYHA-button .ui-selectmenu-status").html('IV');
          }  else {
              $("#pastHistoryNYHA-button .ui-selectmenu-status").html('');
          }
      }
        CalcEuroII();
  }
  function changeCre(d){
        if(d=='1'){
          $('#LVADCreatinine').val($('#patientSerumCreatinine').val());
          } else {
              $('#patientSerumCreatinine').val($('#LVADCreatinine').val());
          }
          calCCC();
        calHMRS();
  }
  function clearLVADOption(d){
   
      switch (d) {
          
          case "1": 
          $('#LVADIVinotropicLarge14days_Y').prop("checked", false);
          $('#LVADIVinotropicLarge14days_Y_Label').removeClass("checked");
          $('#LVADIVinotropicLarge14days_N').prop("checked", false);
          $('#LVADIVinotropicLarge14days_N_Label').removeClass("checked");
          $('#LVADIVinotropicLarge14days_notavailable').prop("checked", false);
          $('#LVADIVinotropicLarge14days_NA_Label').removeClass("checked");
          break;
           case "2": 
          $('#LVADIIABPSupportLarge7days_Y').prop("checked", false);
          $('#LVADIIABPSupportLarge7days_Y_Label').removeClass("checked");
          $('#LVADIIABPSupportLarge7days_N').prop("checked", false);
          $('#LVADIIABPSupportLarge7days_N_Label').removeClass("checked");
          $('#LVADIIABPSupportLarge7days_notavailable').prop("checked", false);
          $('#LVADIIABPSupportLarge7days_NA_Label').removeClass("checked");
          break;
           case "3": 
          $('#LVADPreOperativeVentlator_Y').prop("checked", false);
          $('#LVADPreOperativeVentlator_Y_Label').removeClass("checked");
          $('#LVADPreOperativeVentlator_N').prop("checked", false);
          $('#LVADPreOperativeVentlator_N_Label').removeClass("checked");
          $('#LVADPreOperativeVentlator_notavailable').prop("checked", false);
          $('#LVADPreOperativeVentlator_NA_Label').removeClass("checked");
          break;
           case "4": 
          $('#LVADSevereRV_Y').prop("checked", false);
          $('#LVADSevereRV_Y_Label').removeClass("checked");
          $('#LVADSevereRV_N').prop("checked", false);
          $('#LVADSevereRV_N_Label').removeClass("checked");
          $('#LVADSevereRV_notavailable').prop("checked", false);
          $('#LVADSevereRV_NA_Label').removeClass("checked");
          break;
           case "5": 
          $('#LVADSevereTR_Y').prop("checked", false);
          $('#LVADSevereTR_Y_Label').removeClass("checked");
          $('#LVADSevereTR_N').prop("checked", false);
          $('#LVADSevereTR_N_Label').removeClass("checked");
          $('#LVADSevereTR_notavailable').prop("checked", false);
          $('#LVADSevereTR_NA_Label').removeClass("checked");
          break;
           case "6": 
          $('#LVADECMOSupport_Y').prop("checked", false);
          $('#LVADECMOSupport_Y_Label').removeClass("checked");
          $('#LVADECMOSupport_N').prop("checked", false);
          $('#LVADECMOSupport_N_Label').removeClass("checked");
          $('#LVADECMOSupport_notavailable').prop("checked", false);
          $('#LVADECMOSupport_NA_Label').removeClass("checked");
          break;
      }
  }
  
  function chkCABG(){
       if($('input[name=operationCABG]:checked').val()=="Y"){
           if($('#patientCardiopulmonaryBypassAdult').val()=="1"){
               $('#operationCardiopulmonaryBypass').prop("checked", true);
               $('#operationCardiopulmonaryBypassLabel').addClass("checked");
               $('#operationCardiacArrest').prop("checked", true);
               $('#operationCardiacArrestLabel').addClass("checked");
          
           } else  if($('#patientCardiopulmonaryBypassAdult').val()=="2"){
               $('#operationCardiopulmonaryBypass').prop("checked", true);
               $('#operationCardiopulmonaryBypassLabel').addClass("checked");
               $('#operationCardiacArrest').prop("checked", false);
               $('#operationCardiacArrestLabel').removeClass("checked");
           } else  if($('#patientCardiopulmonaryBypassAdult').val()=="3"){
               $('#operationCardiopulmonaryBypass').prop("checked", true);
               $('#operationCardiopulmonaryBypassLabel').addClass("checked");
               $('#operationCardiacArrest').prop("checked", false);
               $('#operationCardiacArrestLabel').removeClass("checked");
           } else  if($('#patientCardiopulmonaryBypassAdult').val()=="4"){
               $('#operationCardiopulmonaryBypass').prop("checked", false);
               $('#operationCardiopulmonaryBypassLabel').removeClass("checked");
               $('#operationCardiacArrest').prop("checked", false);
               $('#operationCardiacArrestLabel').removeClass("checked");
           }
       }
  }
  
  function chkCongenitalBypass(){
      var errorflag=0;
      if($('#patientCardiopulmonaryBypassCongenital').val()==""){
          alert('請完成Cardiopulmonary Bypass欄位選項');
          errorflag=1;
          
      } 
       if($('input[name=operationCongenitalBypass]:checked').val()=="Y"){
            if($('#patientCardiopulmonaryBypassCongenital').val()=="3" || $('#patientCardiopulmonaryBypassCongenital').val()=="4"){
            alert('Cardiopulmonary Bypass選項與congenital surgery / Bypass選項衝突，請再次確認資料正確性。');
             errorflag=1;
             } 
          
      } 
      
      if(errorflag==1 && 1==2){
          return false;
      } else {
          $('#congenitalProcedureForm').submit();
      }
  }
  
  function qryValve(o,t){
      //o==>object
      //t==>type
      var appendStr='<option></option>';
       $(o).find('option').remove().end();
      $(o).selectmenu( "destroy" );
                  
      var obj ;
      $.ajax({
                type:"POST",
                url: "<?php echo base_url(); ?>valve/qryValvebyCategory",
                cache: false,
                data:
                    {
                    qryCategory:t
                    },
                datatype: "JSON",
                success: function(data){
                        if(JSON.parse(data).status=="success"){
                            var user = JSON.parse(data).result;
                            
                            
                            if(user!=null){
                            
                             
                             
                                for(i=0;i<user.length;i++){
                                     
                                       //obj = new Option(user[i].valvesimplifiedname, user[i].valvecode);
                                        /// jquerify the DOM object 'o' so we can use the html method
                                       //$(o).html(user[i].valvesimplifiedname);
                                       
                                      // $(o).append(obj).selectmenu();
                                       //$(o+" .ui-selectmenu-status").html(user[i].valvesimplifiedname);
                                     //$(o+" .ui-selectmenu-status").append(new Option(user[i].valvesimplifiedname,user[i].valvecode));
                                      appendStr+="<option value='" +user[i].valvesimplifiedname+ "'>" +user[i].valvesimplifiedname+ "</option>";
                                       // alert(user[i].valvesimplifiedname);
                                       }
                                  
                                    //   $(o).selectmenu('refresh'); 
                               //   $(o).empty().selectmenu();
                               //$(o).selectmenu( "destroy" );
                                // $(o).append(appendStr).selectmenu();
                               //   $(o).append(appendStr).selectmenu();   
                                       
                                      
                               
                               
                        }
                           
                       
                            
                }
                   
                 $(o).append(appendStr).selectmenu();
                    }
            });
            
  }
</script>



</body>

</html> 