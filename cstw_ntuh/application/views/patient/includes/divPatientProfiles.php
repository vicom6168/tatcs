 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->DischargeDate!="" && $c->DischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->DischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }
 ?>
<div class="box"  id="divPatientProfiles">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divPatientProfiles')">基本資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">診斷及手術</a> </span>
            
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divCancer')">病史資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">併發症及結果</a> </span>
                  
                   
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">修改記錄</a> </span>
                </div>
                </div>
                <div class="title">
                    <h2>Patient Profiles</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/patientProfiles" method="post" id="addPatient"   enctype="multipart/form-data">
                     
                   
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
                             <input type="radio" name="patientGender" id="patientGender_M"  value="M" <?php if($c->patientGender=='M') echo "checked";?> ><label for="patientGender_M">Male&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="patientGender" id="patientGender_F"  value="F" <?php if($c->patientGender=='F') echo "checked";?> ><label for="patientGender_F">Female&nbsp;&nbsp;</label>  &nbsp; 
                            
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
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>"/>
                        </div>
                            
                        <div class="line">
                           <label>Admission date  </label>
                            <input type="text" name="AdmissionDate" id="AdmissionDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->AdmissionDate);?>" onblur="chkLOS('AdmissionDate','DischargeDate','LOS');" onchange="chkLOS('AdmissionDate','DischargeDate','LOS');"/>
                        </div>
                              <div class="line">
                           <label>Discharge date
                                <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("登錄病人出院當天。如果病人是轉其他醫院、\n機構、甚至是其他醫院的ICU，都是登錄轉出當日。\n如果病人死亡，Discharge date欄位登錄死亡日期。",{className:"info",autoHide: false});'></img></label>  </label>
                          </label>
                            <input type="text" name="DischargeDate" id="DischargeDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->DischargeDate);?>" onblur="chkLOS('AdmissionDate','DischargeDate','LOS');" onchange="chkLOS('AdmissionDate','DischargeDate','LOS');"/>
                            ,LOS:
                            <input type="text" name="LOS" id="LOS" class="smallDisabled"  size=10 readonly  value="<?php echo $c->LOS;?>" /> Days
                        </div>
                       
                          <div class="line">
                            <label>ICU Admission ?</label>
                             <input type="radio" name="patientIsICUAdmission" id="patientIsICUAdmission_Y"  value="Y" <?php if($c->patientIsICUAdmission=='Y') echo "checked";?> onclick="ShowICUAdmissionDate();"><label for="patientIsICUAdmission_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="patientIsICUAdmission" id="patientIsICUAdmission_N"  value="N" <?php if($c->patientIsICUAdmission=='N') echo "checked";?> onclick="ShowICUAdmissionDate();"><label for="patientIsICUAdmission_N">No&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>     
                        <div id="ICUDiv">
                        <div class="line">
                            <label>ICU Admission date</label>
                                 <input type="text" name="ICUAdmissionDate" id="ICUAdmissionDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->ICUAdmissionDate);?>" onblur="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" onchange="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" />
                        </div>
                          <div class="line">
                            <label>ICU Discharge date
                                 <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("第一次離開加護病房 的時間，如果是重入ICU則不計算。",{className:"info",autoHide: false});'></img></label>
                            <input type="text" name="ICUDischargeDate" id="ICUDischargeDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->ICUDischargeDate);?>" onblur="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" onchange="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" />
                             ,ICU LOS:
                            <input type="text" name="ICU_LOS" id="ICU_LOS" class="smallDisabled"  size=10 readonly  value="<?php echo $c->ICU_LOS;?>" /> Days
                        </div>
                      </div>
                       <div class="line">
                            <label>Extubation date
                                <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("指離開開刀房後，第一次拔管的日期，\n不管病人有沒有重插管、拔管失敗、或病人自拔管等。\n如果病人都沒有拔管後來做氣切，\nextubation date要登錄第一次脫離呼吸器的日期。\n如果病人死亡，登錄死亡當日。\n如果病人帶著著呼吸器回家或長照機構，則登錄出院當日。",{className:"info",autoHide: false});'></img>
                          </label>
                            <input type="text" name="ExtubationDate" id="ExtubationDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->ExtubationDate);?>"/>
                        </div>
                          
                          <div class="line">
                            <label>Other associated disease</label>
                           <textarea name="patientAssociatedDisease" class="textarea" cols="55" rows="20"><?php echo $c->patientAssociatedDisease;?></textarea>
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
        
 <script>
          $(document).ready(function() {
    $("#patientOpDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#patientOpDate").val('<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>');
    
    $("#AdmissionDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#AdmissionDate").val('<?php echo str_replace('0000-00-00', '', $c->AdmissionDate);?>');
    
    $("#DischargeDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#DischargeDate").val('<?php echo str_replace('0000-00-00', '', $c->DischargeDate);?>');
    
    $("#ICUAdmissionDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#ICUAdmissionDate").val('<?php echo str_replace('0000-00-00', '', $c->ICUAdmissionDate);?>');
    
    $("#ICUDischargeDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#ICUDischargeDate").val('<?php echo str_replace('0000-00-00', '', $c->ICUDischargeDate);?>');
    
    $("#ExtubationDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#ExtubationDate").val('<?php echo str_replace('0000-00-00', '', $c->ExtubationDate);?>');
     ShowICUAdmissionDate();
    });            
         function chkLOS(inDate, outDate, LOS){
             var I = $('#'+inDate).val().split('-');
             var O=  $('#'+outDate).val().split('-');
             
  if (ValidDate(I[0], I[1]-1, I[2]) && ValidDate(O[0], O[1]-1, O[2]) ) { 
    var firstDate = new Date(I[0],I[1]-1,I[2]);
    var secondDate = new Date(O[0], O[1]-1, O[2]);
    var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(24*60*60*1000)))+1;
  $('#'+LOS).val(diffDays);
    } 
         }
         
         function ShowICUAdmissionDate(){
             if($('input[name=patientIsICUAdmission]:checked').val()=="Y" ){
                 $('#ICUDiv').show();
             } else {
                 $('#ICUDiv').hide();
                 $('#ICUAdmissionDate').val('');
                 $('#ICUDischargeDate').val('');
                 $('#ICU_LOS').val('');
             }
         }
 </script>   