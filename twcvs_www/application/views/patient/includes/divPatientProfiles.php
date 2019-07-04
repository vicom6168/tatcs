 <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divPatientProfiles')">Patient Profiles</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">Operation Procedures</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">Outcome Results</a> </span>
                     <span class="mainmenu"><a href="#" onclick="callHideShow('divChildOutcome')">Outcome Results</a> </span>
                    <span class="mainmenu"><a href="<?php echo base_url(); ?>patient/printPatient/<?php echo $c->patientID;?>" target="newWindow">Print</a> </span>
                </div>
                </div>
                <div class="title">
                    <h2>Patient Profiles</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/patientProfiles" method="post">
                     
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
                          
                               <select name="patientHospital" id="patientHospital">
                                   <option value="">                 </option>
                                   <option value="台大醫院"  <?php if($c->patientHospital=='台大醫院') echo "selected";?>>台大醫院</option>
                                   <option value="台大醫院 新竹分院"  <?php if($c->patientHospital=='台大醫院 新竹分院') echo "selected";?>>台大醫院 新竹分院</option>
                                   <option value="台大醫院 雲林分院"  <?php if($c->patientHospital=='台大醫院 雲林分院') echo "selected";?>>台大醫院 雲林分院</option>
                                   </select>
                        </div>
                         
                            <div class="line">
                            <label>Operation date</label>
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>" onchange="calAge();" />
                        </div>
                              <div class="line">
                            <label>Discharge date</label>
                            <input type="text" name="patientDischargeDate" id="patientDischargeDate" class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientDischargeDate);?>"  onchange="javascript:calLOS('1',this);" />
                        </div>
                       
                            <div class="line">
                            <label> </label>
                            <label for="patientCongenitalSurgery">Congenital surgery (Any congenital cardiac diagnosis)  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="patientCongenitalSurgery" id="patientCongenitalSurgery"  value="Y" <?php if($c->patientCongenitalSurgery=='Y') echo "checked";?>> 
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
                            <button type="button" class="blue medium"  id="myelement" ><span>查看</span></button>
                          <button type="button" class="blue medium" onclick="if(confirm('如果未完成修改步驟, 將致資料不完整, 您確定要修改嗎?')){window.location='<?php echo base_url(); ?>patient/syntaxscore/<?php echo $c->patientID;?>';}"><span>修改</span></button>
                        </div>
                      <div class="line" id="syntaxScoreContent" style="display:none">
                          
                          <span style="width:100%"><?php echo str_replace('^','&nbsp;&nbsp;&nbsp;&nbsp;    ',nl2br($c->patientSyntaxScoreContent));?></span>
                        </div>
                        
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div>