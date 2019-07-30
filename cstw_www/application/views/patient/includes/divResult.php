 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->patientDischargeDate!="" && $c->patientDischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->patientDischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }
 ?>

       <div class="box" id="divResult">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">基本資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">診斷及手術</a> </span>
                 
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divCancer')">病史資料</a> </span>
                 <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">併發症及結果</a> </span>
                   
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">修改記錄</a> </span>
                   </div>
                </div>
                
                <div class="title">
                    <h2>出院追蹤 </h2>
                </div>
                
              
                   <div class="lineheader">
                            <label>追蹤  </label>
                             <label for="operationAorticValve"></label> &nbsp;
                   </div>
                     <div class="line">
                            <label>Cancer Status: </label>
                            <select name="patientGender" id="patientGender"  class="large">
                                   <option value=""></option>
                                   <option value="1"  <?php if($c->patientGender=='1') echo "selected";?>>沒有此一原發癌症存在的證據 </option>
                                   <option value="2"  <?php if($c->patientGender=='2') echo "selected";?>>臨床上有此一原發癌症的存在 </option>
                                     <option value="9"  <?php if($c->patientGender=='9') echo "selected";?>>未知，不確定此一原發癌症是否存 在，病歷未記</option>
                                   </select>
                                  </div>
                      <div class="line">
                            <label>Date of 1st recurr.: </label>
                           <input type="text" name="outcomeExtubationDate" id="DateofFirstRecurr" class="small" value="<?php echo str_replace('0000-00-00', '', $c->outcomeExtubationDate);?>"/>
                      </div>            
                        <div class="line">
                            <label>Recurr. Type:</label>
                          
                             <input type="text" name="operationAssociateCategory" id="RecurrType" class="small" value="<?php echo $c->operationAssociateCategory;?>"  readonly />
                             <a class="various" data-fancybox-type="iframe" href="/patient/queryAdultDiagnosis/1"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteRecurrType('1')"><img src="/images/cross-circle.png"></a>
                        </div>   
                          <div class="line">
                            <label>Recurr. Type:</label>
                          
                             <textarea name="AdultDiagnosisOthers" class="textarea" cols="55" rows="3"><?php echo $c->AdultDiagnosisOthers;?></textarea>
                          
                        </div>    
                         <div class="line">
                            <label>Date of last contact: </label>
                           <input type="text" name="outcomeExtubationDate" id="DateofLastContact" class="small" value="<?php echo str_replace('0000-00-00', '', $c->outcomeExtubationDate);?>"/>
                      </div>  
                      <div class="line">
                            <label>Vital Status: </label>
                             <input type="radio" name="patientGender" id="VSTATUS_0"  value="0" <?php if($c->patientGender=='0') echo "checked";?>><label for="VSTATUS_0">0：死亡&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="patientGender" id="VSTATUS_1"  value="1" <?php if($c->patientGender=='1') echo "checked";?>><label for="VSTATUS_1">1：存活&nbsp;&nbsp;</label>  &nbsp; 
                            
                      </div>   
                       <div class="line">
                            <label>Cause of Death: </label>
                            <select name="patientGender" id="patientGender"  class="large">
                                   <option value=""></option>
                                   <option value="0000"  <?php if($c->patientGender=='0000') echo "selected";?>>在最後一次聯絡時，個案仍存活 </option>
                                   <option value="7777"  <?php if($c->patientGender=='7777') echo "selected";?>>無死亡證明書，不確定個案的死因  </option>
                                   <option value="7797"  <?php if($c->patientGender=='7797') echo "selected";?>>有死亡證明書，但未註明死亡病因</option>
                                   <option value="7798"  <?php if($c->patientGender=='7798') echo "selected";?>>個案非因癌症死亡</option>
                                   <option value="C000-C809"  <?php if($c->patientGender=='C000-C809') echo "selected";?>>死於癌症，並依 ICD-O-3 登錄</option>
                                   </select>
                                  </div>
                       <div class="line">
                            <label>Follow up Notes:</label>
                          
                             <textarea name="AdultDiagnosisOthers" class="textarea" cols="55" rows="3"></textarea>
                          
                        </div>           
                       <div class="line">
                            <label> </label>
                            <label for="operationCardiopulmonaryBypass" id="operationCardiopulmonaryBypassLabel">P't reject any Tx&nbsp;</label> &nbsp;
                            <input type="checkbox"  name="operationCardiopulmonaryBypass" id="operationCardiopulmonaryBypass"  value="Y"> 
                          </div>
                          <div class="line">
                            <label> </label>
                            <label for="operationCardiacArrest" id="operationCardiacArrestLabel">Watch Waiting &nbsp;</label> &nbsp;
                            <input type="checkbox" name="operationCardiacArrest" id="operationCardiacArrest"  value="Y" > 
                          </div>
                           
                
                          
                      <div class="line button">
                           
                       
                             </td>
                                
                                
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
           
            </div>
          
        </div>
        <script>
         $(document).ready(function() {
  
    $("#DateofFirstRecurr").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#DateofFirstRecurr").val('<?php echo str_replace('0000-00-00', '', $c->patientICUDischargeDate);?>');
    $("#DateofLastContact").datepicker({ dateFormat: 'yy-mm-dd'});
    $("#DateofLastContact").val('<?php echo str_replace('0000-00-00', '', $c->patientICUDischargeDate);?>');
    
    });
    function showDiagnosis(w,did,dcat,dsub){
    $("#CongenitalDiagnosis"+w).val(dsub);
    $("#CongenitalDiagnosis_id"+w).val(did);   
}
        </script> 
 
    