 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->DischargeDate!="" && $c->DischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->DischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }
 ?>
 <div class="box" id="divOperation">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">基本資料</a> </span>
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divOperation')">診斷及手術</a> </span>
                
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divCancer')">病史資料</a> </span>
              <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">併發症及結果</a> </span>
                   
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divDataHistory')">修改記錄</a> </span>
                   </div>
                </div>
                <div class="title">
                    <h2>診斷及手術</h2>
                    
                </div>
                <form name="patientOperation" action="<?php echo base_url(); ?>patient/patientOperation" method="post">
                    <div class="lineheader">
                            <label>疾病類型  </label>
                                <select name="diseaseType" id="diseaseType" class="large" onchange="checkSpecialFactor();">
                                   <option value=""></option>
                                      <?php 
                            foreach($procedureCatList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->cancertype;?>" <?php if($row->cancertype== $c->diseaseType) echo "selected";?>><?php echo $row->category;?></option>
                                     <?php } ?>
                                   </select>
                                   
                                   </div>
                     
                  
                       
                        <div class="line">
                            <label>主治醫師 1
                               <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Surgeon 1為此筆病患資料的擁有者, \n若非得到該Surgeon 1的授權即無法修改此筆病患資料",{className:"info",autoHide: false});'></img></label>  </label>
                          
                               <select name="patientSurgeon" id="patientSurgeon">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="1" || $row->vsName== $c->patientSurgeon) {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                        
                          <div class="line">
                            <label>主治醫師 2</label>
                          
                               <select name="patientSurgeon2" id="patientSurgeon2">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="1" || $row->vsName== $c->patientSurgeon2) {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon2) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>住院醫師 1</label>
                          
                               <select name="patientSurgeon3" id="patientSurgeon3">
                                   <option value=""></option>
                                   <option value="N"  <?php if($c->patientSurgeon3== "N") echo "selected";?>>無</option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="2" || $row->vsName== $c->patientSurgeon3) {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon3) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>住院醫師 2</label>
                          
                               <select name="patientSurgeon4" id="patientSurgeon4">
                                   <option value=""></option>
                                   <option value="N"  <?php if($c->patientSurgeon4== "N") echo "selected";?>>無</option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="2" || $row->vsName== $c->patientSurgeon4) {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon4) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>住院醫師 3</label>
                          
                               <select name="patientSurgeon5" id="patientSurgeon5">
                                   <option value=""></option>
                                   <option value="N"  <?php if($c->patientSurgeon5== "N") echo "selected";?>>無</option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="2" || $row->vsName== $c->patientSurgeon5) {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>" <?php if($row->vsName== $c->patientSurgeon5) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                         <div class="line" style="background-color:#F5A9E1">
                            <label>Re-Operation</label>
                          
                               <select name="patientReoperation" id="patientReoperation">
                                   <option value=""></option>
                                      <?php 
                            for($i=0;$i<=6;$i++){
                                     ?>
                                     <option value="<?php echo $i;?>" <?php if($i== $c->ReOperation) echo "selected";?>><?php echo $i;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                    
             
                  
                            <div class="line">
                            <label>Diagnosis 1</label>
                          
                             <input type="text" name="Diagnosis1" id="Diagnosis1" class="big" value="<?php echo $c->Diagnosis1;?>"  readonly />
                             <input type="hidden" name="Diagnosis_id1" id="Diagnosis_id1" class="small" value="<?php echo $c->Diagnosis_id1;?>" />
                               <a class="fancyDiagnosis" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('1');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('1')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 2</label>
                          
                             <input type="text" name="Diagnosis2" id="Diagnosis2" class="big" value="<?php echo $c->Diagnosis2;?>" readonly />
                              <input type="hidden" name="Diagnosis_id2" id="Diagnosis_id2" class="small" value="<?php echo $c->Diagnosis_id2;?>" />
                              <a class="fancyDiagnosis" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('2');"><img src="/images/plus-circle.png"></a>
                              <a  href="javascript:deletePatientDiagnosis('2')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 3</label>
                          
                             <input type="text" name="Diagnosis3" id="Diagnosis3" class="big" value="<?php echo $c->Diagnosis3;?>" readonly />
                              <input type="hidden" name="Diagnosis_id3" id="Diagnosis_id3" class="small" value="<?php echo $c->Diagnosis_id3;?>" />
                               <a class="fancyDiagnosis" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('3');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('3')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 4</label>
                              <input type="text" name="Diagnosis4" id="Diagnosis4" class="big" value="<?php echo $c->Diagnosis4;?>" readonly/>
                              <input type="hidden" name="Diagnosis_id4" id="Diagnosis_id4" class="small" value="<?php echo $c->Diagnosis_id4;?>" />
                              <a class="fancyDiagnosis" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('4');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('4')"><img src="/images/cross-circle.png"></a>
                             </div>
                                <div class="line">
                            <label>Diagnosis 5</label>
                          
                             <input type="text" name="Diagnosis5" id="Diagnosis5" class="big" value="<?php echo $c->Diagnosis5;?>" readonly/>
                              <input type="hidden" name="Diagnosis_id5" id="Diagnosis_id5" class="small" value="<?php echo $c->Diagnosis_id5;?>" />
                               <a class="fancyDiagnosis" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('5');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deletePatientDiagnosis('5')"><img src="/images/cross-circle.png"></a>
                             </div>
                             <div class="line">
                            <label>Diagnosis Others: </label>
                           <textarea name="DiagnosisOthers" class="textarea" cols="55" rows="10"><?php echo $c->DiagnosisOthers;?></textarea>
                        </div>
                            <div class="line">
                            <label>Primary Procedure </label>
                             <input type="text" name="Procedure1" id="Procedure1" class="big" value="<?php echo $c->Procedure1;?>" readonly />
                             <input type="hidden" name="Procedure_id1" id="Procedure_id1" class="small" value="<?php echo $c->Procedure_id1;?>" />
                             <a class="fancyProcedure" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('1');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('1')"><img src="/images/cross-circle.png"></a>
                             </div>
                              <div class="line">
                            <label></label>
                             <input type="hidden" name="ProcedureType1" id="ProcedureType1" class="small" value="<?php echo $c->ProcedureType1;?>" readonly />
                             <input type="text" name="ProcedureTypeName1" id="ProcedureTypeName1" class="small" value="<?php echo $c->ProcedureTypeName1;?>" readonly />
                             </div>
                              <div class="line">
                            <label>Secondary Procedure 1</label>
                             <input type="text" name="Procedure2" id="Procedure2" class="big" value="<?php echo $c->Procedure2;?>" readonly />
                             <input type="hidden" name="Procedure_id2" id="Procedure_id2" class="small" value="<?php echo $c->Procedure_id2;?>" />
                             <a class="fancyProcedure" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('2');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('2')"><img src="/images/cross-circle.png"></a>
                             </div>
                             <div class="line">
                            <label></label>
                             <input type="hidden" name="ProcedureType2" id="ProcedureType2" class="small" value="<?php echo $c->ProcedureType2;?>" readonly />
                             <input type="text" name="ProcedureTypeName2" id="ProcedureTypeName2" class="small" value="<?php echo $c->ProcedureTypeName2;?>" readonly />
                             </div>
                               <div class="line">
                            <label>Secondary Procedure 2</label>
                             <input type="text" name="Procedure3" id="Procedure3" class="big" value="<?php echo $c->Procedure3;?>" readonly />
                             <input type="hidden" name="Procedure_id3" id="Procedure_id3" class="small" value="<?php echo $c->Procedure_id3;?>" />
                             <a class="fancyProcedure" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('3');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('3')"><img src="/images/cross-circle.png"></a>
                             </div>
                             <div class="line">
                            <label></label>
                             <input type="hidden" name="ProcedureType3" id="ProcedureType3" class="small" value="<?php echo $c->ProcedureType3;?>" readonly />
                             <input type="text" name="ProcedureTypeName3" id="ProcedureTypeName3" class="small" value="<?php echo $c->ProcedureTypeName3;?>" readonly />
                             </div>
                               <div class="line">
                            <label>Secondary Procedure 3</label>
                             <input type="text" name="Procedure4" id="Procedure4" class="big" value="<?php echo $c->Procedure4;?>" readonly />
                             <input type="hidden" name="Procedure_id4" id="Procedure_id4" class="small" value="<?php echo $c->Procedure_id4;?>" />
                             <a class="fancyProcedure" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('4');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('4')"><img src="/images/cross-circle.png"></a>
                             </div>
                             <div class="line">
                            <label></label>
                             <input type="hidden" name="ProcedureType4" id="ProcedureType4" class="small" value="<?php echo $c->ProcedureType4;?>" readonly />
                             <input type="text" name="ProcedureTypeName4" id="ProcedureTypeName4" class="small" value="<?php echo $c->ProcedureTypeName4;?>" readonly />
                             </div>
                               <div class="line">
                            <label>Secondary Procedure 4</label>
                             <input type="text" name="Procedure5" id="Procedure5" class="big" value="<?php echo $c->Procedure5;?>" readonly/>
                             <input type="hidden" name="Procedure_id5" id="Procedure_id5" class="small" value="<?php echo $c->Procedure_id5;?>" />
                             <a class="fancyProcedure" data-fancybox-type="iframe" onclick="javascript:$('#procedureID').val('5');"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('5')"><img src="/images/cross-circle.png"></a>
                             </div>
                             <div class="line">
                            <label></label>
                             <input type="hidden" name="ProcedureType5" id="ProcedureType5" class="small" value="<?php echo $c->ProcedureType5;?>" readonly />
                             <input type="text" name="ProcedureTypeName5" id="ProcedureTypeName5" class="small" value="<?php echo $c->ProcedureTypeName5;?>" readonly />
                             </div>
                              <div class="line">
                            <label>Procedure Others: </label>
                           <textarea name="ProcedureOthers" class="textarea" cols="55" rows="10"><?php echo $c->Procedure_Others;?></textarea>
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
                                <input type="hidden" name="procedureID" id="procedureID" class="small" value="" />
                        </div>
                        
                </form>
            </div>
        </div>
        <script>
          
    $(document).ready(function() {
    $(".fancyProcedure").fancybox({
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
        closeEffect : 'none',
         beforeLoad: function () {
         //  alert($('#diseaseType').val());
         if($('#diseaseType').val()!=""){
           
        this.href = '/patient/queryProcedure/'+$('#procedureID').val()+'/'+$('#diseaseType').val();
        } else {
            this.href = '/patient/queryProcedure/'+$('#procedureID').val()+'/99';
        }
        }
    });
        $(".fancyDiagnosis").fancybox({
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
        closeEffect : 'none',
         beforeLoad: function () {
         //  alert($('#diseaseType').val());
         if($('#diseaseType').val()!=""){
           
        this.href = '/patient/queryDiagnosis/'+$('#procedureID').val()+'/'+$('#diseaseType').val();
        } else {
            this.href = '/patient/queryDiagnosis/'+$('#procedureID').val()+'/99';
        }
        }
    });
    });
        </script>