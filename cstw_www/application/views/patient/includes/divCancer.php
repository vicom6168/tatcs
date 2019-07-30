 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->patientDischargeDate!="" && $c->patientDischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->patientDischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }
 ?>
       <div class="box" id="divCancer">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">基本資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">診斷及手術</a> </span>
                 
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divCancer')">病史資料</a> </span>
                 <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">併發症及結果</a> </span>
                   
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">修改記錄</a> </span>
                   </div>
                </div>
                
                <div class="title">
                    <h2>病史資料 </h2>
                </div>
                 <form name="patientOperation" action="<?php echo base_url(); ?>patient/cancerLifestyle" method="post">
                <div id="divCancerLifestyle">
                <div class="title">
                    <h2></h2>
                    <span class="surgery">生活型態</span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerClinic')">癌症分期</a></span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerBody')">其他治療</a></span>
                   <!-- <span class="surgery"><a href="#" onclick="callHideShow('divNoneSurgery')">Non-open heart</a></span> -->
                </div>
                   
                     <div class="line">
                            <label> Height: </label>
                            <input type="text" name="CancerLSHeight" id="CancerLSHeight"  class="small" value="<?php echo $c->CancerLSHeight;?>"/>
                      </div>
                       <div class="line">
                            <label> Weight: </label>
                            <input type="text" name="CancerLSWeight" id="CancerLSWeight"  class="small" value="<?php echo $c->CancerLSWeight;?>"/>
                      </div>
                           <div class="line">
                            <label> Smoking: </label>
                           <select name="CancerLSSmokingAmount" id="CancerLSSmokingAmount" class="smallmeduim">
                                   <option value="">每日吸菸量</option>
                                   <option value="00"  <?php if($c->CancerLSSmokingAmount=='00') echo "selected";?>>無吸菸</option>
                                   <option value="10"  <?php if($c->CancerLSSmokingAmount=='10') echo "selected";?>>每日10支(半包)</option>
                                   <option value="20"  <?php if($c->CancerLSSmokingAmount=='20') echo "selected";?>>每日20支(1包)</option>
                                   <option value="91"  <?php if($c->CancerLSSmokingAmount=='91') echo "selected";?>>偶爾吸(無規律或無定量)</option>
                                   <option value="99"  <?php if($c->CancerLSSmokingAmount=='99') echo "selected";?>>病歷未記載或吸菸狀態完全不詳者</option>
                                </select>
                                   <select name="CancerLSSmokingYear" id="CancerLSSmokingYear" class="smallmeduim">
                                   <option value="">吸菸年</option>
                                   <option value="00"  <?php if($c->CancerLSSmokingYear=='00') echo "selected";?>>無吸菸</option>
                                   <option value="05"  <?php if($c->CancerLSSmokingYear=='05') echo "selected";?>>吸菸5年</option>
                                   <option value="15"  <?php if($c->CancerLSSmokingYear=='15') echo "selected";?>>吸菸15年</option>
                                   <option value="98"  <?php if($c->CancerLSSmokingYear=='98') echo "selected";?>>吸菸，但年不詳</option>
                                   <option value="99"  <?php if($c->CancerLSSmokingYear=='99') echo "selected";?>>病歷未記載或吸菸狀態完全不詳者</option>
                                   </select>
                                   <select name="CancerLSSmokingQuitYear" id="CancerLSSmokingQuitYear" class="smallmeduim">
                                   <option value="">戒菸年 </option>
                                   <option value="00"  <?php if($c->CancerLSSmokingQuitYear=='00') echo "selected";?>>無戒菸</option>
                                   <option value="05"  <?php if($c->CancerLSSmokingQuitYear=='05') echo "selected";?>>已戒5年</option>
                                   <option value="15"  <?php if($c->CancerLSSmokingQuitYear=='15') echo "selected";?>>已戒15年</option>
                                   <option value="88"  <?php if($c->CancerLSSmokingQuitYear=='88') echo "selected";?>>無吸菸</option>
                                    <option value="99"  <?php if($c->CancerLSSmokingQuitYear=='98') echo "selected";?>>病歷未記載或戒菸狀態完全不詳者</option>
                                   </select>
                      </div>
                          
                           <div class="line">
                            <label> Betel Nuts: </label>
                           <select name="CancerLSBetelNutsAmount" id="CancerLSBetelNutsAmount" class="smallmeduim">
                                   <option value="">每日嚼檳榔量</option>
                                   <option value="00"  <?php if($c->CancerLSBetelNutsAmount=='00') echo "selected";?>>無吸菸</option>
                                   <option value="10"  <?php if($c->CancerLSBetelNutsAmount=='10') echo "selected";?>>每日10顆</option>
                                   <option value="20"  <?php if($c->CancerLSBetelNutsAmount=='20') echo "selected";?>>每日20顆</option>
                                   <option value="90"  <?php if($c->CancerLSBetelNutsAmount=='90') echo "selected";?>>每日≧90顆</option>
                                    <option value="99"  <?php if($c->CancerLSBetelNutsAmount=='99') echo "selected";?>>病歷未記載或嚼檳榔狀態完全不詳者</option>
                                </select>
                                   <select name="CancerLSBetelNutsYear" id="CancerLSBetelNutsYear" class="smallmeduim">
                                   <option value="">嚼檳榔年</option>
                                   <option value="00"  <?php if($c->CancerLSBetelNutsYear=='00') echo "selected";?>>無嚼檳榔</option>
                                   <option value="05"  <?php if($c->CancerLSBetelNutsYear=='05') echo "selected";?>>嚼5年</option>
                                   <option value="15"  <?php if($c->CancerLSBetelNutsYear=='15') echo "selected";?>>嚼15年</option>
                                   <option value="98"  <?php if($c->CancerLSBetelNutsYear=='98') echo "selected";?>>嚼檳榔，但年不詳</option>
                                   <option value="99"  <?php if($c->CancerLSBetelNutsYear=='99') echo "selected";?>>病歷未記載或嚼檳榔狀態完全不詳者</option>
                                   </select>
                                   <select name="CancerLSBetelNutsQuitYear" id="CancerLSBetelNutsQuitYear" class="smallmeduim">
                                   <option value="">戒嚼檳榔年 </option>
                                   <option value="00"  <?php if($c->CancerLSBetelNutsQuitYear=='00') echo "selected";?>>無戒嚼檳榔</option>
                                   <option value="05"  <?php if($c->CancerLSBetelNutsQuitYear=='05') echo "selected";?>>已戒5年</option>
                                   <option value="15"  <?php if($c->CancerLSBetelNutsQuitYear=='15') echo "selected";?>>已戒15年</option>
                                   <option value="88"  <?php if($c->CancerLSBetelNutsQuitYear=='88') echo "selected";?>>無嚼檳榔</option>
                                    <option value="99"  <?php if($c->CancerLSBetelNutsQuitYear=='98') echo "selected";?>>病歷未記載或嚼檳榔狀態完全不詳者</option>
                                   </select>
                      </div>
                      <div class="line">
                            <label> Drinking: </label>
                           <select name="CancerLSDrinking" id="CancerLSDrinking" class="smallmeduim">
                                   <option value=""></option>
                                   <option value="000"  <?php if($c->CancerLSDrinking=='000') echo "selected";?>>從未喝酒</option>
                                   <option value="001"  <?php if($c->CancerLSDrinking=='001') echo "selected";?>>已戒</option>
                                   <option value="003"  <?php if($c->CancerLSDrinking=='003') echo "selected";?>>習慣性喝酒＜10年 </option>
                                    <option value="004"  <?php if($c->CancerLSDrinking=='004') echo "selected";?>>習慣性喝酒≧10年 </option>
                                    <option value="999"  <?php if($c->CancerLSDrinking=='999') echo "selected";?>>病歷未記載或不詳 </option>
                                </select>
                                   
                      </div>
                       <div class="line">
                            <label> KPS/ECOG: </label>
                          <input type="text" name="CancerLSKPS_ECOG" id="CancerLSKPS_ECOG"  class="small" value="<?php echo $c->CancerLSKPS_ECOG;?>" />
                            </div>
          
                      <div class="line button">
                        
                             </td>
                                
                                
                              <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
           
            </div> 
            </form>          
             <form name="patientOperation" action="<?php echo base_url(); ?>patient/cancerStatus" method="post">
           <div id="divCancerClinic" style="display:none">
                <div class="title">
                    <h2></h2>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerLifestyle')">生活型態</a></span>
                    <span class="surgery">癌症分期</span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerBody')">其他治療</a></span>
                   <!-- <span class="surgery"><a href="#" onclick="callHideShow('divNoneSurgery')">Non-open heart</a></span> -->
                </div>
                 <div class="lineheader">
                            <label>臨床癌症分期   </label>
                             <label for="operationAorticValve"></label> &nbsp;
                   </div>   
                   <div  id="divClinicTNM_lung">
                               <div class="line">
                            <label> Clinical: </label>
                          cT: 
                          <select name="CancerClinical_T_lung" id="Clinical_TNM_T" class="small" onchange="calStageGroup('Clinical_TNM_T','Clinical_TNM_N','Clinical_TNM_M','Clinical_TNM_Stage');">
                                   <option value=""></option>
                                   <option value="Tx"  <?php if($c->CancerClinical_T=='Tx') echo "selected";?>>Tx</option>
                                   <option value="T0"  <?php if($c->CancerClinical_T=='T0') echo "selected";?>>T0</option>
                                   <option value="Tis"  <?php if($c->CancerClinical_T=='Tis') echo "selected";?>>Tis</option>
                                   <option value="T1a"  <?php if($c->CancerClinical_T=='T1a') echo "selected";?>>T1a</option>
                                   <option value="T1b"  <?php if($c->CancerClinical_T=='T1b') echo "selected";?>>T1b</option>
                                   <option value="T1c"  <?php if($c->CancerClinical_T=='T1c') echo "selected";?>>T1c</option>
                                    <option value="T2a"  <?php if($c->CancerClinical_T=='T2a') echo "selected";?>>T2a</option>
                                    <option value="T2b"  <?php if($c->CancerClinical_T=='T2b') echo "selected";?>>T2b</option>
                                    <option value="T3"  <?php if($c->CancerClinical_T=='T3') echo "selected";?>>T3</option>
                                    <option value="T4"  <?php if($c->CancerClinical_T=='T4') echo "selected";?>>T4 </option>
                                </select>
                           N:  
                           <select name="CancerClinical_N_lung" id="Clinical_TNM_N" class="small"  onchange="calStageGroup('Clinical_TNM_T','Clinical_TNM_N','Clinical_TNM_M','Clinical_TNM_Stage');">
                                   <option value=""></option>
                                   <option value="Nx"  <?php if($c->CancerClinical_N=='Nx') echo "selected";?>>Nx</option>
                                   <option value="N0"  <?php if($c->CancerClinical_N=='N0') echo "selected";?>>N0</option>
                                   <option value="N1"  <?php if($c->CancerClinical_N=='N1') echo "selected";?>>N1 </option>
                                   <option value="N2"  <?php if($c->CancerClinical_N=='N2') echo "selected";?>>N2 </option>
                                    <option value="N3"  <?php if($c->CancerClinical_N=='N3') echo "selected";?>>N3</option>
                                    </select>
                            M:  
                            <select name="CancerClinical_M_lung" id="Clinical_TNM_M" class="small"  onchange="calStageGroup('Clinical_TNM_T','Clinical_TNM_N','Clinical_TNM_M','Clinical_TNM_Stage');">
                                   <option value=""></option>
                                   <option value="Mx"  <?php if($c->CancerClinical_M=='Mx') echo "selected";?>>Mx</option>
                                   <option value="M0"  <?php if($c->CancerClinical_M=='M0') echo "selected";?>>M0</option>
                                   <option value="M1a"  <?php if($c->CancerClinical_M=='M1a') echo "selected";?>>M1a</option>
                                   <option value="M1b"  <?php if($c->CancerClinical_M=='M1b') echo "selected";?>>M1b</option>
                                    <option value="M1c"  <?php if($c->CancerClinical_M=='M1c') echo "selected";?>>M1c</option>
                                  </select>
                            </div>
                            
                            <div class="line">
                            <label> Stage Group: </label>
                          <input type="text" name="CancerClinical_StageGroup_lung" id="Clinical_TNM_Stage"  class="smallDisabled" readonly  value="<?php echo $c->CancerClinical_StageGroup;?>" />
                           </div>
                            </div>
                            <div id="divClinicTNM_esophageal">
                              <div class="line">
                            <label> Clinical: </label>
                          cT: 
                          <select name="CancerClinical_T_e" id="Clinical_TNM_T_esophageal" class="small" onchange="calStageGroup('Clinical_TNM_T_esophageal','Clinical_TNM_N_esophageal','Clinical_TNM_M_esophageal','Clinical_TNM_Stage_esophageal');">
                                   <option value=""></option>
                                   <option value="Tx"  <?php if($c->CancerClinical_T=='Tx') echo "selected";?>>Tx</option>
                                   <option value="T0"  <?php if($c->CancerClinical_T=='T0') echo "selected";?>>T0</option>
                                   <option value="Tis"  <?php if($c->CancerClinical_T=='Tis') echo "selected";?>>Tis</option>
                                   <option value="T1"  <?php if($c->CancerClinical_T=='T1') echo "selected";?>>T1</option>
                                   <option value="T2"  <?php if($c->CancerClinical_T=='T2') echo "selected";?>>T2</option>
                                    <option value="T3"  <?php if($c->CancerClinical_T=='T3') echo "selected";?>>T3</option>
                                    <option value="T4"  <?php if($c->CancerClinical_T=='T4') echo "selected";?>>T4 </option>
                                </select>
                           N:  
                           <select name="CancerClinical_N_e" id="Clinical_TNM_N_esophageal" class="small"  onchange="calStageGroup('Clinical_TNM_T_esophageal','Clinical_TNM_N_esophageal','Clinical_TNM_M_esophageal','Clinical_TNM_Stage_esophageal');">
                                   <option value=""></option>
                                   <option value="Nx"  <?php if($c->CancerClinical_N=='Nx') echo "selected";?>>Nx</option>
                                   <option value="N0"  <?php if($c->CancerClinical_N=='N0') echo "selected";?>>N0</option>
                                   <option value="N1"  <?php if($c->CancerClinical_N=='N1') echo "selected";?>>N1 </option>
                                   <option value="N2"  <?php if($c->CancerClinical_N=='N2') echo "selected";?>>N2 </option>
                                    <option value="N3"  <?php if($c->CancerClinical_N=='N3') echo "selected";?>>N3</option>
                                    </select>
                            M:  
                            <select name="CancerClinical_M_e" id="Clinical_TNM_M_esophageal" class="small"  onchange="calStageGroup('Clinical_TNM_T_esophageal','Clinical_TNM_N_esophageal','Clinical_TNM_M_esophageal','Clinical_TNM_Stage_esophageal');">
                                   <option value=""></option>
                                   <option value="Mx"  <?php if($c->CancerClinical_M=='Mx') echo "selected";?>>Mx</option>
                                   <option value="M0"  <?php if($c->CancerClinical_M=='M0') echo "selected";?>>M0</option>
                                   <option value="M1"  <?php if($c->CancerClinical_M=='M1') echo "selected";?>>M1</option>
                           </select>
                            </div>
                            
                           <div class="line">
                            <label> Stage Group: </label>
                          <input type="text" name="CancerClinical_StageGroup_e" id="Clinical_TNM_Stage_esophageal"  class="smallDisabled" readonly  value="<?php echo $c->CancerClinical_StageGroup;?>" />
                           </div>
                          </div>
                         <div class="lineheader">
                            <label>病理癌症分期  </label>
                             <label for="operationAorticValve"></label> &nbsp;
                   </div>    
                   <div id="divPathologicalTNM_lung">
                         <div class="line">
                            <label> Pathological: </label>
                          pT: 
                          <select name="CancerPathological_T_lung" id="Pathological_TNM_T" class="small" onchange="calStageGroup('Pathological_TNM_T','Pathological_TNM_N','Pathological_TNM_M','Pathological_TNM_Stage');">
                                   <option value=""></option>
                                   <option value="Tx"  <?php if($c->CancerPathological_T=='Tx') echo "selected";?>>Tx</option>
                                   <option value="T0"  <?php if($c->CancerPathological_T=='T0') echo "selected";?>>T0</option>
                                   <option value="Tis"  <?php if($c->CancerPathological_T=='Tis') echo "selected";?>>Tis</option>
                                   <option value="T1a"  <?php if($c->CancerPathological_T=='T1a') echo "selected";?>>T1a</option>
                                   <option value="T1b"  <?php if($c->CancerPathological_T=='T1b') echo "selected";?>>T1b</option>
                                   <option value="T1c"  <?php if($c->CancerPathological_T=='T1c') echo "selected";?>>T1c</option>
                                    <option value="T2a"  <?php if($c->CancerPathological_T=='T2a') echo "selected";?>>T2a</option>
                                    <option value="T2b"  <?php if($c->CancerPathological_T=='T2b') echo "selected";?>>T2b</option>
                                    <option value="T3"  <?php if($c->CancerPathological_T=='T3') echo "selected";?>>T3</option>
                                    <option value="T4"  <?php if($c->CancerPathological_T=='T4') echo "selected";?>>T4 </option>
                                </select>
                           N:  
                           <select name="CancerPathological_N_lung" id="Pathological_TNM_N" class="small"  onchange="calStageGroup('Pathological_TNM_T','Pathological_TNM_N','Pathological_TNM_M','Pathological_TNM_Stage');">
                                   <option value=""></option>
                                   <option value="Nx"  <?php if($c->CancerPathological_N=='Nx') echo "selected";?>>Nx</option>
                                   <option value="N0"  <?php if($c->CancerPathological_N=='N0') echo "selected";?>>N0</option>
                                   <option value="N1"  <?php if($c->CancerPathological_N=='N1') echo "selected";?>>N1 </option>
                                   <option value="N2"  <?php if($c->CancerPathological_N=='N2') echo "selected";?>>N2 </option>
                                    <option value="N3"  <?php if($c->CancerPathological_N=='N3') echo "selected";?>>N3</option>
                                    </select>
                            M:  
                            <select name="CancerPathological_M_lung" id="Pathological_TNM_M" class="small"  onchange="calStageGroup('Pathological_TNM_T','Pathological_TNM_N','Pathological_TNM_M','Pathological_TNM_Stage');">
                                   <option value=""></option>
                                    <option value="Mx"  <?php if($c->CancerPathological_M=='Mx') echo "selected";?>>Mx</option>
                                   <option value="M0"  <?php if($c->CancerPathological_M=='M0') echo "selected";?>>M0</option>
                                   <option value="M1a"  <?php if($c->CancerPathological_M=='M1a') echo "selected";?>>M1a</option>
                                   <option value="M1b"  <?php if($c->CancerPathological_M=='M1b') echo "selected";?>>M1b</option>
                                    <option value="M1c"  <?php if($c->CancerPathological_M=='M1c') echo "selected";?>>M1c</option>
                                  </select>
                            </div>
                              <div class="line">
                            <label> Stage Group: </label>
                          <input type="text" name="CancerPathological_Stage_lung" id="Pathological_TNM_Stage" class="smallDisabled" readonly value="<?php echo $c->CancerPathological_Stage;?>" />
                           </div>
                           </div>
                           <div id="divPathologicalTNM_esophageal">
                                 <div class="line">
                            <label> Pathological: </label>
                          pT: 
                          <select name="CancerPathological_T_e" id="Pathological_TNM_T_esophageal" class="small" onchange="calStageGroup('Pathological_TNM_T_esophageal','Pathological_TNM_N_esophageal','Pathological_TNM_M_esophageal','Pathological_TNM_Stage_esophageal');">
                                   <option value=""></option>
                                   <option value="Tx"  <?php if($c->CancerPathological_T=='Tx') echo "selected";?>>Tx</option>
                                   <option value="T0"  <?php if($c->CancerPathological_T=='T0') echo "selected";?>>T0</option>
                                   <option value="Tis"  <?php if($c->CancerPathological_T=='Tis') echo "selected";?>>Tis</option>
                                   <option value="T1"  <?php if($c->CancerPathological_T=='T1') echo "selected";?>>T1</option>
                                   <option value="T2"  <?php if($c->CancerPathological_T=='T2') echo "selected";?>>T2</option>
                                    <option value="T3"  <?php if($c->CancerPathological_T=='T3') echo "selected";?>>T3</option>
                                    <option value="T4"  <?php if($c->CancerPathological_T=='T4') echo "selected";?>>T4 </option>
                                </select>
                           N:  
                           <select name="CancerPathological_N_e" id="Pathological_TNM_N_esophageal" class="small"  onchange="calStageGroup('Pathological_TNM_T_esophageal','Pathological_TNM_N_esophageal','Pathological_TNM_M_esophageal','Pathological_TNM_Stage_esophageal');">
                                   <option value=""></option>
                                   <option value="Nx"  <?php if($c->CancerPathological_N=='Nx') echo "selected";?>>Nx</option>
                                   <option value="N0"  <?php if($c->CancerPathological_N=='N0') echo "selected";?>>N0</option>
                                   <option value="N1"  <?php if($c->CancerPathological_N=='N1') echo "selected";?>>N1 </option>
                                   <option value="N2"  <?php if($c->CancerPathological_N=='N2') echo "selected";?>>N2 </option>
                                    <option value="N3"  <?php if($c->CancerPathological_N=='N3') echo "selected";?>>N3</option>
                                    </select>
                            M:  
                            <select name="CancerPathological_M_e" id="Pathological_TNM_M_esophageal" class="small"  onchange="calStageGroup('Pathological_TNM_T_esophageal','Pathological_TNM_N_esophageal','Pathological_TNM_M_esophageal','Pathological_TNM_Stage_esophageal');">
                                   <option value=""></option>
                                   <option value="Mx"  <?php if($c->CancerPathological_M=='Mx') echo "selected";?>>Mx</option>
                                   <option value="M0"  <?php if($c->CancerPathological_M=='M0') echo "selected";?>>M0</option>
                                   <option value="M1"  <?php if($c->CancerPathological_M=='M1') echo "selected";?>>M1</option>
                           </select>
                            </div>
                            
                           <div class="line">
                            <label> Stage Group: </label>
                          <input type="text" name="CancerPathological_Stage_e" id="Pathological_TNM_Stage_esophageal"  class="smallDisabled" readonly  value="<?php echo $c->CancerPathological_Stage;?>" />
                           </div>
                            </div>
                            <div class="line">
                            <label> Note: </label>
                           <textarea name="CancerStage_memo" id="CancerStage_memo"  class="textarea" cols="55" rows="10"><?php echo $c->CancerStage_memo;?></textarea>
                        </div>
                      <div class="line button">
                           
                         
                             </td>
                                
                                
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
           
            </div>
            </form>
             
              
            
            <form name="cancerTherapy" action="<?php echo base_url(); ?>patient/cancerTherapy" method="post">
            <div id="divCancerBody" style="display:none">
                <div class="title">
                    <h2></h2>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerLifestyle')">生活型態</a></span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerClinic')">癌症分期</a></span>
                    <span class="surgery">其他治療</span>
                   <!-- <span class="surgery"><a href="#" onclick="callHideShow('divNoneSurgery')">Non-open heart</a></span> -->
                </div>
                
                      
                      <div class="line button">
                           
                         
                             </td>
                                
                                
                                <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                        </div>
                  
               
           
            </div>
            </form>
        </div>
        </div>
   <script>
   $(document).ready(function() {
     checkSpecialFactor();
    
    
    });            
    function showNonRTReason(did,dcat,dsub){
    $("#Radiotherapy_NonRTReason").val(dsub.replace(/<br>/g, "\n"));
    $("#Radiotherapy_NonRTReasonID").val(did);   
}

function calStageGroup(t,n,m,s){
   // alert($('#'+m).val());
   if($('#diseaseType').val()=="5"){
   $('#'+s).val('');
    if($('#'+m).val()=="M1"){
       $('#'+s).val('IVB');
   } else if(($('#'+t).val()=="T4" && ($('#'+n).val()=="N0" || $('#'+n).val()=="N1" || $('#'+n).val()=="N2")) || ($('#'+n).val()=="N3" && ($('#'+t).val()=="T1" || $('#'+t).val()=="T2" || $('#'+t).val()=="T3" || $('#'+t).val()=="T4" ))){
       $('#'+s).val('IVA');
   } else if(($('#'+t).val()=="T3" && $('#'+n).val()=="N1") || ($('#'+n).val()=="N2" && ($('#'+t).val()=="T1" || $('#'+t).val()=="T2" || $('#'+t).val()=="T3"))){
       $('#'+s).val('III');
   }  else if(($('#'+t).val()=="T2" && ($('#'+n).val()=="N0" || $('#'+n).val()=="N1")) || ($('#'+n).val()=="N0" && $('#'+t).val()=="T3")){
       $('#'+s).val('II');
   } else if($('#'+t).val()=="T1" && ($('#'+n).val()=="N0" || $('#'+n).val()=="N1") ){
       $('#'+s).val('I');
   } else {
       $('#'+s).val('0');
   }
   
   } else {
   
   
    if($('#'+m).val()=="M1c"){
       $('#'+s).val('IVB');
   } else  if($('#'+m).val()=="M1a" || $('#'+m).val()=="M1b"){
       $('#'+s).val('IVA');
   } else if(($('#'+n).val()=="N3" && $('#'+t).val()!="T3" && $('#'+t).val()!="T4" && $('#'+t).val()!="Tx" && $('#'+t).val()!="T0" && $('#'+t).val()!="Tis") || ($('#'+n).val()=="N2"  && ($('#'+t).val()=="T3" || $('#'+t).val()=="T4" ))){
       $('#'+s).val('IIIB');
   } else if($('#'+n).val()=="N3" && ($('#'+t).val()=="T3" || $('#'+t).val()=="T4") ){
       $('#'+s).val('IIIC');
   } else if(($('#'+n).val()=="N2"  && $('#'+t).val()!="T3" && $('#'+t).val()!="T4" && $('#'+t).val()!="Tx" && $('#'+t).val()!="T0" && $('#'+t).val()!="Tis") || ($('#'+t).val()=="T4"  && ($('#'+n).val()=="N0" || $('#'+n).val()=="N1" ) ) ||  ($('#'+t).val()=="T3"  && $('#'+n).val()=="N1"  )){
       $('#'+s).val('IIIA');
   } else if(($('#'+n).val()=="N0"  && $('#'+t).val()=="T3") ||  ($('#'+n).val()=="N1"  && $('#'+t).val()!="T3" && $('#'+t).val()!="T4" && $('#'+t).val()!="Tx" && $('#'+t).val()!="T0" && $('#'+t).val()!="Tis") ){
       $('#'+s).val('IIB');
   } else if($('#'+t).val()=="T3"  && $('#'+n).val()=="N0"  ){
       $('#'+s).val('IIB');
   } else if($('#'+t).val()=="T2b"  && $('#'+n).val()=="N0"){
       $('#'+s).val('IIA');
   } else if($('#'+t).val()=="T2a"  && $('#'+n).val()=="N0"){
       $('#'+s).val('IB');
   } else if($('#'+t).val()=="T1c"  && $('#'+n).val()=="N0"){
       $('#'+s).val('IA3');
   } else if($('#'+t).val()=="T1b"  && $('#'+n).val()=="N0"){
       $('#'+s).val('IA2');
   }  else if($('#'+t).val()=="T1a"  && $('#'+n).val()=="N0"){
       $('#'+s).val('IA1');
   }  else {
       $('#'+s).val('0');
   }
   }
}

function checkSpecialFactor(){
   // alert($('#diseaseType').val());
    
    
    $("#divClinicTNM_lung").hide();
    $("#divClinicTNM_esophageal").hide();
    $("#divPathologicalTNM_lung").hide();
    $("#divPathologicalTNM_esophageal").hide();
    
    $("#Anastomosis_div").hide();
     $("#Ileus_div").hide();
     $("#Aspiration_div").hide();
     $("#Dysphagia_div").hide();
     $("#Arrthymia_div").hide();
     
    
    if($('#diseaseType').val()=="1"){
        
        $("#divClinicTNM_lung").show();
        $("#divPathologicalTNM_lung").show();
    } else if($('#diseaseType').val()=="5"){
        
        $("#divClinicTNM_esophageal").show();
        $("#divPathologicalTNM_esophageal").show();
        
     $("#Anastomosis_div").show();
     $("#Ileus_div").show();
     $("#Aspiration_div").show();
     $("#Dysphagia_div").show();
     $("#Arrthymia_div").show();
    } 
}
 </script>     
