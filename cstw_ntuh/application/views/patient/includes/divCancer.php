 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->DischargeDate!="" && $c->DischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->DischargeDate))/86400>90){
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
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerBody')">Charlson Score</a></span>
                   <!-- <span class="surgery"><a href="#" onclick="callHideShow('divNoneSurgery')">Non-open heart</a></span> -->
                </div>
                   
                     <div class="line">
                            <label> Height: </label>
                            <input type="text" name="CancerLSHeight" id="CancerLSHeight"  class="small" value="<?php echo $c->CancerLSHeight;?>"/> cm
                      </div>
                       <div class="line">
                            <label> Weight: </label>
                            <input type="text" name="CancerLSWeight" id="CancerLSWeight"  class="small" value="<?php echo $c->CancerLSWeight;?>"/> kgw
                      </div>
                           <div class="line">
                            <label> Smoking: </label>
                           <select name="CancerLSSmokingAmount" id="CancerLSSmokingAmount" class="smallmeduim">
                                   <option value="">每日吸菸量</option>
                                   <option value="00"  <?php if($c->CancerLSSmokingAmount=='00') echo "selected";?>>無吸菸</option>
                                   <option value="10"  <?php if($c->CancerLSSmokingAmount=='10') echo "selected";?>>每日10支(半包)以內</option>
                                   <option value="20"  <?php if($c->CancerLSSmokingAmount=='20') echo "selected";?>>每日10-20支(1包)</option>
                                   <option value="21"  <?php if($c->CancerLSSmokingAmount=='21') echo "selected";?>>每日20支(1包)以上</option>
                                   <option value="91"  <?php if($c->CancerLSSmokingAmount=='91') echo "selected";?>>偶爾吸(無規律或無定量)</option>
                                   <option value="99"  <?php if($c->CancerLSSmokingAmount=='99') echo "selected";?>>病歷未記載或吸菸狀態完全不詳者</option>
                                </select>
                                   <select name="CancerLSSmokingYear" id="CancerLSSmokingYear" class="smallmeduim">
                                   <option value="">吸菸年</option>
                                   <option value="00"  <?php if($c->CancerLSSmokingYear=='00') echo "selected";?>>無吸菸</option>
                                   <option value="05"  <?php if($c->CancerLSSmokingYear=='05') echo "selected";?>>吸菸5年以下</option>
                                   <option value="15"  <?php if($c->CancerLSSmokingYear=='15') echo "selected";?>>吸菸5-15年</option>
                                   <option value="16"  <?php if($c->CancerLSSmokingYear=='16') echo "selected";?>>吸菸15年以上</option>
                                   <option value="98"  <?php if($c->CancerLSSmokingYear=='98') echo "selected";?>>吸菸，但年不詳</option>
                                   <option value="99"  <?php if($c->CancerLSSmokingYear=='99') echo "selected";?>>病歷未記載或吸菸狀態完全不詳者</option>
                                   </select>
                                   <select name="CancerLSSmokingQuitYear" id="CancerLSSmokingQuitYear" class="smallmeduim">
                                   <option value="">戒菸年 </option>
                                   <option value="00"  <?php if($c->CancerLSSmokingQuitYear=='00') echo "selected";?>>無戒菸</option>
                                   <option value="05"  <?php if($c->CancerLSSmokingQuitYear=='05') echo "selected";?>>已戒5年以內</option>
                                   <option value="15"  <?php if($c->CancerLSSmokingQuitYear=='15') echo "selected";?>>已戒5-15年</option>
                                   <option value="16"  <?php if($c->CancerLSSmokingQuitYear=='16') echo "selected";?>>已戒15年以上</option>
                                   <option value="88"  <?php if($c->CancerLSSmokingQuitYear=='88') echo "selected";?>>無吸菸</option>
                                    <option value="99"  <?php if($c->CancerLSSmokingQuitYear=='99') echo "selected";?>>病歷未記載或戒菸狀態完全不詳者</option>
                                   </select>
                      </div>
                          
                           <div class="line">
                            <label> Betel Nuts: </label>
                           <select name="CancerLSBetelNutsAmount" id="CancerLSBetelNutsAmount" class="smallmeduim">
                                   <option value="">每日嚼檳榔量</option>
                                   <option value="00"  <?php if($c->CancerLSBetelNutsAmount=='00') echo "selected";?>>無嚼檳榔</option>
                                   <option value="10"  <?php if($c->CancerLSBetelNutsAmount=='10') echo "selected";?>>每日10顆以下</option>
                                   <option value="20"  <?php if($c->CancerLSBetelNutsAmount=='20') echo "selected";?>>每日10-20顆</option>
                                    <option value="21"  <?php if($c->CancerLSBetelNutsAmount=='21') echo "selected";?>>每日20顆以上</option>
                                   <option value="90"  <?php if($c->CancerLSBetelNutsAmount=='90') echo "selected";?>>每日≧90顆</option>
                                    <option value="99"  <?php if($c->CancerLSBetelNutsAmount=='99') echo "selected";?>>病歷未記載或嚼檳榔狀態完全不詳者</option>
                                </select>
                                   <select name="CancerLSBetelNutsYear" id="CancerLSBetelNutsYear" class="smallmeduim">
                                   <option value="">嚼檳榔年</option>
                                   <option value="00"  <?php if($c->CancerLSBetelNutsYear=='00') echo "selected";?>>無嚼檳榔</option>
                                   <option value="05"  <?php if($c->CancerLSBetelNutsYear=='05') echo "selected";?>>嚼5年以下</option>
                                   <option value="15"  <?php if($c->CancerLSBetelNutsYear=='15') echo "selected";?>>嚼5-15年</option>
                                   <option value="16"  <?php if($c->CancerLSBetelNutsYear=='16') echo "selected";?>>嚼15年以上</option>
                                   <option value="98"  <?php if($c->CancerLSBetelNutsYear=='98') echo "selected";?>>嚼檳榔，但年不詳</option>
                                   <option value="99"  <?php if($c->CancerLSBetelNutsYear=='99') echo "selected";?>>病歷未記載或嚼檳榔狀態完全不詳者</option>
                                   </select>
                                   <select name="CancerLSBetelNutsQuitYear" id="CancerLSBetelNutsQuitYear" class="smallmeduim">
                                   <option value="">戒嚼檳榔年 </option>
                                   <option value="00"  <?php if($c->CancerLSBetelNutsQuitYear=='00') echo "selected";?>>無戒嚼檳榔</option>
                                   <option value="05"  <?php if($c->CancerLSBetelNutsQuitYear=='05') echo "selected";?>>已戒5年以內</option>
                                   <option value="15"  <?php if($c->CancerLSBetelNutsQuitYear=='15') echo "selected";?>>已戒5-15年</option>
                                   <option value="16"  <?php if($c->CancerLSBetelNutsQuitYear=='16') echo "selected";?>>已戒15年以上</option>
                                   <option value="88"  <?php if($c->CancerLSBetelNutsQuitYear=='88') echo "selected";?>>無嚼檳榔</option>
                                    <option value="99"  <?php if($c->CancerLSBetelNutsQuitYear=='99') echo "selected";?>>病歷未記載或嚼檳榔狀態完全不詳者</option>
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
                            <label> KPS: </label>
                          <input type="text" name="Cancer_KPS" id="Cancer_KPS"  class="small" value="<?php echo $c->Cancer_KPS;?>" />
                            </div>
                      <div class="line">
                            <label> ECOG: </label>
                          <input type="text" name="Cancer_ECOG" id="Cancer_ECOG"  class="small" value="<?php echo $c->Cancer_ECOG;?>" />
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
                  
               
           
            </div> 
            </form>          
             <form name="patientOperation" action="<?php echo base_url(); ?>patient/cancerStatus" method="post">
           <div id="divCancerClinic" style="display:none">
                <div class="title">
                    <h2></h2>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerLifestyle')">生活型態</a></span>
                    <span class="surgery">癌症分期</span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerBody')">Charlson Score</a></span>
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
                          <a  onclick="importNote('1')"  style="cursor:pointer;"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("帶入Note",{className:"info",autoHide: false});'></img></a>
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
                           <a  onclick="importNote('2')"  style="cursor:pointer;"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("帶入Note",{className:"info",autoHide: false});'></img></a>
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
                            <a  onclick="importNote('3')"  style="cursor:pointer;"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("帶入Note",{className:"info",autoHide: false});'></img></a>
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
                            <a  onclick="importNote('4')"  style="cursor:pointer;"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("帶入Note",{className:"info",autoHide: false});'></img></a>
                            </div>
                            </div>
                            <div class="line">
                            <label> Note: </label>
                           <textarea name="CancerStage_memo" id="CancerStage_memo"  class="textarea" cols="55" rows="10"><?php echo $c->CancerStage_memo;?></textarea>
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
                  
               
           
            </div>
            </form>
             
              
            
            <form name="cancerTherapy" action="<?php echo base_url(); ?>patient/cancerTherapy" method="post">
            <div id="divCancerBody" style="display:none">
                <div class="title">
                    <h2></h2>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerLifestyle')">生活型態</a></span>
                    <span class="currentsurgery"><a href="#" onclick="callHideShowCancer('divCancerClinic')">癌症分期</a></span>
                    <span class="surgery">Charlson Score</span>
                   <!-- <span class="surgery"><a href="#" onclick="callHideShow('divNoneSurgery')">Non-open heart</a></span> -->
                </div>
                  
                           
                           <div class="line">
                            <label>Myocardial infarction</label>
                             <input type="radio" name="CharlsonScore_MI" id="CharlsonScore_MI_N"  value="N" <?php if($c->CharlsonScore_MI=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_MI_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_MI" id="CharlsonScore_MI_Y"  value="Y" <?php if($c->CharlsonScore_MI=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_MI_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                           <div class="line">
                            <label>CHF</label>
                             <input type="radio" name="CharlsonScore_CHF" id="CharlsonScore_CHF_N"  value="N" <?php if($c->CharlsonScore_CHF=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_CHF_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_CHF" id="CharlsonScore_CHF_Y"  value="Y" <?php if($c->CharlsonScore_CHF=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_CHF_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Peripheral vascular disease</label>
                             <input type="radio" name="CharlsonScore_PVD" id="CharlsonScore_PVD_N"  value="N" <?php if($c->CharlsonScore_PVD=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_PVD_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_PVD" id="CharlsonScore_PVD_Y"  value="Y" <?php if($c->CharlsonScore_PVD=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_PVD_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>CVA or TIA</label>
                             <input type="radio" name="CharlsonScore_CVA" id="CharlsonScore_CVA_N"  value="N" <?php if($c->CharlsonScore_CVA=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_CVA_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_CVA" id="CharlsonScore_CVA_Y"  value="Y" <?php if($c->CharlsonScore_CVA=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_CVA_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Dementia</label>
                             <input type="radio" name="CharlsonScore_Dementia" id="CharlsonScore_Dementia_N"  value="N" <?php if($c->CharlsonScore_Dementia=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_Dementia_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_Dementia" id="CharlsonScore_Dementia_Y"  value="Y" <?php if($c->CharlsonScore_Dementia=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_Dementia_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>COPD</label>
                             <input type="radio" name="CharlsonScore_COPD" id="CharlsonScore_COPD_N"  value="N" <?php if($c->CharlsonScore_COPD=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_COPD_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_COPD" id="CharlsonScore_COPD_Y"  value="Y" <?php if($c->CharlsonScore_COPD=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_COPD_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Connective tissue disease</label>
                              <input type="radio" name="CharlsonScore_ConnectiveTissueDisease" id="CharlsonScore_ConnectiveTissueDisease_N"  value="N" <?php if($c->CharlsonScore_ConnectiveTissueDisease=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_ConnectiveTissueDisease_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_ConnectiveTissueDisease" id="CharlsonScore_ConnectiveTissueDisease_Y"  value="Y" <?php if($c->CharlsonScore_ConnectiveTissueDisease=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_ConnectiveTissueDisease_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Peptic ulcer disease</label>
                             <input type="radio" name="CharlsonScore_PepticUlcerDisease" id="CharlsonScore_PepticUlcerDisease_N"  value="N" <?php if($c->CharlsonScore_PepticUlcerDisease=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_PepticUlcerDisease_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_PepticUlcerDisease" id="CharlsonScore_PepticUlcerDisease_Y"  value="Y" <?php if($c->CharlsonScore_PepticUlcerDisease=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_PepticUlcerDisease_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Liver disease</label>
                             <input type="radio" name="CharlsonScore_LiverDisease" id="CharlsonScore_LiverDisease_None"  value="1" <?php if($c->CharlsonScore_LiverDisease=='1') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_LiverDisease_None">None&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_LiverDisease" id="CharlsonScore_LiverDisease_Mild"  value="2" <?php if($c->CharlsonScore_LiverDisease=='2') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_LiverDisease_Mild">Mild&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_LiverDisease" id="CharlsonScore_LiverDisease_Moderate"  value="3" <?php if($c->CharlsonScore_LiverDisease=='3') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_LiverDisease_Moderate">Moderate to severe&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Diabetes mellitus</label>
                             <input type="radio" name="CharlsonScore_DiabetesMellitus" id="CharlsonScore_DiabetesMellitus_None"  value="1" <?php if($c->CharlsonScore_DiabetesMellitus=='1') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_DiabetesMellitus_None">None or diet-controlled&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_DiabetesMellitus" id="CharlsonScore_DiabetesMellitus_Mild"  value="2" <?php if($c->CharlsonScore_DiabetesMellitus=='2') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_DiabetesMellitus_Mild">Uncomplicated&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_DiabetesMellitus" id="CharlsonScore_DiabetesMellitus_Moderate"  value="3" <?php if($c->CharlsonScore_DiabetesMellitus=='3') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_DiabetesMellitus_Moderate">End-organ damage&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Hemiplegia</label>
                             <input type="radio" name="CharlsonScore_Hemiplegia" id="CharlsonScore_Hemiplegia_N"  value="N" <?php if($c->CharlsonScore_Hemiplegia=='N') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_Hemiplegia_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_Hemiplegia" id="CharlsonScore_Hemiplegia_Y"  value="Y" <?php if($c->CharlsonScore_Hemiplegia=='Y') echo "checked";?>  onclick="calCharlsonScore();"><label for="CharlsonScore_Hemiplegia_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Moderate to severe CKD</label>
                             <input type="radio" name="CharlsonScore_CKD" id="CharlsonScore_CKD_N"  value="N" <?php if($c->CharlsonScore_CKD=='N') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_CKD_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_CKD" id="CharlsonScore_CKD_Y"  value="Y" <?php if($c->CharlsonScore_CKD=='Y') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_CKD_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Solid tumor</label>
                            <input type="radio" name="CharlsonScore_SolidTumor" id="CharlsonScore_SolidTumor_None"  value="1" <?php if($c->CharlsonScore_SolidTumor=='1') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_SolidTumor_None">None&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_SolidTumor" id="CharlsonScore_SolidTumor_Mild"  value="2" <?php if($c->CharlsonScore_SolidTumor=='2') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_SolidTumor_Mild">Localized&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_SolidTumor" id="CharlsonScore_SolidTumor_Moderate"  value="3" <?php if($c->CharlsonScore_SolidTumor=='3') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_SolidTumor_Moderate">Metastatic&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Leukemia</label>
                             <input type="radio" name="CharlsonScore_Leukemia" id="CharlsonScore_Leukemia_N"  value="N" <?php if($c->CharlsonScore_Leukemia=='N') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_Leukemia_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_Leukemia" id="CharlsonScore_Leukemia_Y"  value="Y" <?php if($c->CharlsonScore_Leukemia=='Y') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_Leukemia_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>Lymphoma</label>
                             <input type="radio" name="CharlsonScore_Lymphoma" id="CharlsonScore_Lymphoma_N"  value="N" <?php if($c->CharlsonScore_Lymphoma=='N') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_Lymphoma_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_Lymphoma" id="CharlsonScore_Lymphoma_Y"  value="Y" <?php if($c->CharlsonScore_Lymphoma=='Y') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_Lymphoma_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                         <div class="line">
                            <label>AIDS</label>
                             <input type="radio" name="CharlsonScore_AIDS" id="CharlsonScore_AIDS_N"  value="N" <?php if($c->CharlsonScore_AIDS=='N') echo "checked";?> onclick="calCharlsonScore();"><label for="CharlsonScore_AIDS_N">No&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="CharlsonScore_AIDS" id="CharlsonScore_AIDS_Y"  value="Y" <?php if($c->CharlsonScore_AIDS=='Y') echo "checked";?> onclick="calCharlsonScore();" ><label for="CharlsonScore_AIDS_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                           <div class="line">
                           <label>Charlson Score:</label>
                            <input type="text" name="CharlsonScore_Score" id="CharlsonScore_Score" class="smallDisabled"  size=10 readonly  value="<?php echo $c->CharlsonScore_Score;?>" /> 
                        </div>
                      <div class="line button">
                           
                            <?php if($dataPermission=="Y" && $outOfDateFlag=="") { ?>
                                <button type="submit" class="blue medium"><span>送出</span></button>
                            <?php }  else if($dataPermission=="N"){ ?>
                                     <div class="messages orange"> 您尚未得到 <?php echo $c->patientSurgeon;?> 醫師授權, 故無法修改或執行列印</div>
                              <?php } else {
                                        echo  $outOfDateFlag;
                     } ?>
                          
                         <div class="lineheader">
                            本計算公式參考: <a href="https://www.mdcalc.com/charlson-comorbidity-index-cci" target="_blank">https://www.mdcalc.com/charlson-comorbidity-index-cci</a>
                     <br/>
                     *必須所有選項都有選取(包括Age), 才會計算Charlson Score
                   </div>    
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
     $(".fancyHelper").fancybox({
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

function importNote(d){
    
var str='';
if(d==1){
str='c'+$('#Clinical_TNM_T').val()+$('#Clinical_TNM_N').val()+$('#Clinical_TNM_M').val()+'-->'+$('#Clinical_TNM_Stage').val()+'\n';
} else if(d==2){
    str='c'+$('#Clinical_TNM_T_esophageal').val()+$('#Clinical_TNM_N_esophageal').val()+$('#Clinical_TNM_M_esophageal').val()+'-->'+$('#Clinical_TNM_Stage_esophageal').val()+'\n';
} else if(d==3){
    str='p'+$('#Pathological_TNM_T').val()+$('#Pathological_TNM_N').val()+$('#Pathological_TNM_M').val()+'-->'+$('#Pathological_TNM_Stage').val()+'\n';
} else if(d==4){
    str='p'+$('#Pathological_TNM_T_esophageal').val()+$('#Pathological_TNM_N_esophageal').val()+$('#Pathological_TNM_M_esophageal').val()+'-->'+$('#Pathological_TNM_Stage_esophageal').val()+'\n';
} else {
}
$('#CancerStage_memo').val($('#CancerStage_memo').val()+str);
}

function calCharlsonScore(){
    var score="";
    if($("#patientAge").val()!=""
    && $('input:radio[name="CharlsonScore_MI"]').is(":checked")
    && $('input:radio[name="CharlsonScore_CHF"]').is(":checked")
    && $('input:radio[name="CharlsonScore_PVD"]').is(":checked")
    && $('input:radio[name="CharlsonScore_CVA"]').is(":checked")
    && $('input:radio[name="CharlsonScore_Dementia"]').is(":checked")
    && $('input:radio[name="CharlsonScore_COPD"]').is(":checked")
    && $('input:radio[name="CharlsonScore_ConnectiveTissueDisease"]').is(":checked")
    && $('input:radio[name="CharlsonScore_PepticUlcerDisease"]').is(":checked")
    && $('input:radio[name="CharlsonScore_LiverDisease"]').is(":checked")
    && $('input:radio[name="CharlsonScore_DiabetesMellitus"]').is(":checked")
    && $('input:radio[name="CharlsonScore_Hemiplegia"]').is(":checked")
    && $('input:radio[name="CharlsonScore_CKD"]').is(":checked")
    && $('input:radio[name="CharlsonScore_SolidTumor"]').is(":checked")
    && $('input:radio[name="CharlsonScore_Leukemia"]').is(":checked")
    && $('input:radio[name="CharlsonScore_Lymphoma"]').is(":checked")
    && $('input:radio[name="CharlsonScore_AIDS"]').is(":checked")){
      score=0;  
      //Age
      if(parseFloat($("#patientAge").val()) >=50 && parseFloat($("#patientAge").val())<60)
        score=score+1;
      else if(parseFloat($("#patientAge").val()) >=60 && parseFloat($("#patientAge").val())<70)
       score=score+2;
      else if(parseFloat($("#patientAge").val()) >=70 && parseFloat($("#patientAge").val())<80)
       score=score+3;
       else if(parseFloat($("#patientAge").val()) >=80)
       score=score+4;
       
       //Myocardial infarction
       if( $('input[name=CharlsonScore_MI]:checked').val()=="Y")
       score=score+1;
       //CHF
         if( $('input[name=CharlsonScore_CHF]:checked').val()=="Y")
       score=score+1;
        //Peripheral vascular disease
         if( $('input[name=CharlsonScore_PVD]:checked').val()=="Y")
       score=score+1;
        //CVA or TIA
         if( $('input[name=CharlsonScore_CVA]:checked').val()=="Y")
       score=score+1;
        //Dementia
         if( $('input[name=CharlsonScore_Dementia]:checked').val()=="Y")
       score=score+1;
        //COPD
         if( $('input[name=CharlsonScore_COPD]:checked').val()=="Y")
       score=score+1;
        //Connective tissue disease
         if( $('input[name=CharlsonScore_ConnectiveTissueDisease]:checked').val()=="Y")
       score=score+1;
          //Peptic ulcer disease
         if( $('input[name=CharlsonScore_PepticUlcerDisease]:checked').val()=="Y")
       score=score+1;
        //Liver diseasee
         if( $('input[name=CharlsonScore_LiverDisease]:checked').val()=="2")
       score=score+1;
       else if( $('input[name=CharlsonScore_LiverDisease]:checked').val()=="3")
       score=score+3;
       //Diabetes mellitus
         if( $('input[name=CharlsonScore_DiabetesMellitus]:checked').val()=="2")
       score=score+1;
       else if( $('input[name=CharlsonScore_DiabetesMellitus]:checked').val()=="3")
       score=score+2;
       
        //Hemiplegia
         if( $('input[name=CharlsonScore_Hemiplegia]:checked').val()=="Y")
       score=score+2;
        //Moderate to severe CKD
         if( $('input[name=CharlsonScore_CKD]:checked').val()=="Y")
       score=score+2;
       //Solid tumor
         if( $('input[name=CharlsonScore_SolidTumor]:checked').val()=="2")
       score=score+2;
       else if( $('input[name=CharlsonScore_SolidTumor]:checked').val()=="3")
       score=score+6;
       //Leukemia
         if( $('input[name=CharlsonScore_Leukemia]:checked').val()=="Y")
       score=score+2;
       //Lymphoma
         if( $('input[name=CharlsonScore_Lymphoma]:checked').val()=="Y")
       score=score+2;
       //AIDS
         if( $('input[name=CharlsonScore_AIDS]:checked').val()=="Y")
       score=score+6;
    }
    $("#CharlsonScore_Score").val(score);
   // alert($('input[name=CharlsonScore_AIDS]:checked').val());
}
 </script>     
