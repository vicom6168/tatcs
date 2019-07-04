 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->DischargeDate!="" && $c->DischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->DischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }
 ?>

       <div class="box" id="divOutcome">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">基本資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">診斷及手術</a> </span>
                 
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divCancer')">病史資料</a> </span>
                 <span class="mainmenuActive"><a href="#" onclick="callHideShow('divOutcome')">併發症及結果</a> </span>
                   
                   
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">修改記錄</a> </span>
                   </div>
                </div>
                
                <div class="title">
                    <h2>併發症及結果 </h2>
                </div>
                 <form action="<?php echo base_url(); ?>patient/patientOutcome" method="post" id="addPatient">
                      
              
                    
                              <div class="lineheader">
                                   <label>出院狀況:  
                              
                            </label>
                              <select name="outcomeStatus" id="outcomeStatus" class="large" onchange="chkMortality();">
                                   <option value="" class="small"></option>
                                   <option  class="small" value="1: 治療出院"  <?php if($c->outcomeStatus=='1: 治療出院') echo "selected";?>>1: 治療出院 </option>
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
                 <br/>
                 
                          <div id="esophagusComplicationDiv">
                           <div class="lineheader">
                            <label>併發症  </label>
                             <label for="operationAorticValve"></label> &nbsp;
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
                                <td> <input type="checkbox" class="checkbox" name="outcomeMortalityCheck" id="outcomeMortalityCheck"  value="Y" <?php if($c->outcomeMortalityCheck=='Y') echo "checked";?>> </td>
                                <td>Operative Mortality</td>
                                <td>Operative mortality includes both (1) all deaths occurring during the hospitalization in which the operation was performed, even if after 30 days; and (2) those deaths occurring after discharge from the hospital, but within 30 days of the procedure unless the cause of death is clearly unrelated to the operation. </td>
                               <td> <textarea name="outcomeMortalityNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeMortalityNote;?></textarea></td>
                            </tr> 
                              <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeInfectionCheck" id="outcomeInfectionCheck"  value="Y" <?php if($c->outcomeInfectionCheck=='Y') echo "checked";?>> </td>
                                <td>Wound Infection
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("只要culture negative，\n就不能算是deep sternal wound infection",{className:"info",autoHide: false});'></img></label>  </label>
                          </td>
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
 <td> <textarea name="outcomeInfectionNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeInfectionNote;?></textarea></td>
                            </tr> 
                            
                                <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeReoperationCheck" id="outcomeReoperationCheck"  value="Y" <?php if($c->outcomeReoperationCheck=='Y') echo "checked";?>> </td>
                                <td>Reoperation For any reason </td>
                                <td>Reoperation for bleeding/tamponade, valvular dysfunction, graft occlusion, other cardiac reason, or non-cardiac reason. </td>
                               <td> <textarea name="outcomeReoperationNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeReoperationNote;?></textarea></td>
                            </tr> 
                              
                          <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomePneumoniaCheck" id="outcomePneumoniaCheck"  value="Y" <?php if($c->outcomePneumoniaCheck=='Y') echo "checked";?>> </td>
                                <td>pneumonia </td>
                                <td></td>
                               <td> <textarea name="outcomePneumoniaNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomePneumoniaNote;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeIntubationCheck" id="outcomeIntubationCheck"  value="Y" <?php if($c->outcomeIntubationCheck=='Y') echo "checked";?>> </td>
                                <td>prolong intubation 
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Ventilation的時間要以出開刀房的時間算起，\n時間應精確到”分鐘“，並且除了算到”initial extubation time”(術後首次拔管時間)之外，\n還需加上reintubation ventilation time（重插管後呼吸器使用時間），\n如果總時間有超過1440分鐘（24小時），即要登錄prolonged ventilation。\n如果重插管是為了手術需求，則不需要把重插管後呼吸器使用時間加進去。",{className:"info",autoHide: false});'></img></label>  </label>
                         
                                </td>
                                <td>Prolonged pulmonary ventilator > 24 hours. Include (but not limited to) causes such as ARDS, pulmonary edema, and/or any patient requiring mechanical ventilation > 24 hours postoperatively.</td>
                               <td> <textarea name="outcomeIntubationNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeIntubationNote;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeHemothoraxCheck" id="outcomeHemothoraxCheck"  value="Y" <?php if($c->outcomeHemothoraxCheck=='Y') echo "checked";?>> </td>
                                <td>Post-OP Bleeding 
                                  </td>
                                <td></td>
                               <td> <textarea name="outcomeHemothoraxNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeHemothoraxNote;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomePneumothoraxCheck" id="outcomePneumothoraxCheck"  value="Y" <?php if($c->outcomePneumothoraxCheck=='Y') echo "checked";?> > </td>
                                <td>Prolong Air-leak 
                                     </td>
                                <td> </td>
                               <td> <textarea name="outcomePneumothoraxNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomePneumothoraxNote;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeBPFistulaCheck" id="outcomeBPFistulaCheck"  value="Y" <?php if($c->outcomeBPFistulaCheck=='Y') echo "checked";?>> </td>
                                <td>B-P fistula 
                                   </td>
                                <td></td>
                               <td> <textarea name="outcomeBPFistulaNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeBPFistulaNote;?></textarea></td>
                            </tr> 
                             <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeChylothoraxCheck" id="outcomeChylothoraxCheck"  value="Y" <?php if($c->outcomeChylothoraxCheck=='Y') echo "checked";?>> </td>
                                <td>chylothorax</th>
                                <td> </td>
                               <td> <textarea name="outcomeChylothoraxNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeChylothoraxNote;?></textarea></td>
                            </tr> 
                                <tr id="Anastomosis_div"> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeAnastomosisCheck" id="outcomeAnastomosisCheck"  value="Y" <?php if($c->outcomeAnastomosisCheck=='Y') echo "checked";?>> </td>
                                <td>anastomosis leakage</th>
                                <td> </td>
                               <td> <textarea name="outcomeAnastomosisNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeAnastomosisNote;?></textarea></td>
                            </tr> 
                               
                                <tr id="Ileus_div"> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeIleusCheck" id="outcomeIleusCheck"  value="Y" <?php if($c->outcomeIleusCheck=='Y') echo "checked";?>> </td>
                                <td>ileus</th>
                                <td> </td>
                               <td> <textarea name="outcomeIleusNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeIleusNote;?></textarea></td>
                            </tr> 
                                <tr id="Aspiration_div"> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeAspirationCheck" id="outcomeAspirationCheck"  value="Y" <?php if($c->outcomeAspirationCheck=='Y') echo "checked";?>> </td>
                                <td>aspiration</th>
                                <td> </td>
                               <td> <textarea name="outcomeAspirationNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeAspirationNote;?></textarea></td>
                            </tr>  
                             <tr id="Dysphagia_div"> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeDysphagiaCheck" id="outcomeDysphagiaCheck"  value="Y" <?php if($c->outcomeDysphagiaCheck=='Y') echo "checked";?>> </td>
                                <td>dysphagia</th>
                                <td> </td>
                               <td> <textarea name="outcomeDysphagiaNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeDysphagiaNote;?></textarea></td>
                            </tr> 
                             <tr id="Arrthymia_div"> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeArrthymiaCheck" id="outcomeArrthymiaCheck"  value="Y" <?php if($c->outcomeArrthymiaCheck=='Y') echo "checked";?>> </td>
                                <td>Arrthymia</th>
                                <td> </td>
                               <td> <textarea name="outcomeArrthymiaNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeArrthymiaNote;?></textarea></td>
                            </tr> 
                              <tr> 
                                <td> <input type="checkbox" class="checkbox" name="outcomeOthersCheck" id="outcomeOthersCheck"  value="Y" <?php if($c->outcomeOthersCheck=='Y') echo "checked";?>> </td>
                                <td>Others</th>
                                <td> </td>
                               <td> <textarea name="outcomeOthersNote" class="textarea small" cols="55" rows="10"><?php echo $c->outcomeOthersNote;?></textarea></td>
                            </tr> 
                            </tbody>
                          </table>
                        
                          </div>
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
                  
               </form>
           
            </div>
          
        </div>
    <script>
          $(document).ready(function() {
     //checkSpecialFactor(); 
     $("#Anastomosis_div").hide();
     $("#Ileus_div").hide();
     $("#Aspiration_div").hide();
     $("#Dysphagia_div").hide();
     $("#Arrthymia_div").hide();
     
     if($('#diseaseType').val()=="5"){   
     $("#Anastomosis_div").show();
     $("#Ileus_div").show();
     $("#Aspiration_div").show();
     $("#Dysphagia_div").show();
     $("#Arrthymia_div").show();
     }
    });            
         function chkMortality(){
     if($('#outcomeStatus').val()=="4: 死亡" || $('#outcomeStatus').val()=="A：病危自動出院" ){
         
         $('#outcomeMortalityCheck').prop('checked', true);
     }
 }
 </script>   
    