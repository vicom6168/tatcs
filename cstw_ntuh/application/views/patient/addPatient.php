<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Patient Profiles</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>patient/savePatient" method="post" id="addPatient">
                     
                      <!-- <div class="line">
                            <label>Patient ID</label>
                            <input type="text" name="patientSSN" class="small" value="" />
                        </div>
                    -->
                        <div class="line">
                            <label><span style="color:red;">Chart number(必填)</span></label>
                            <input type="text" name="patientChartNumber" id="patientChartNumber" class="small" value="" onblur="qryPatient();" />
                            <img src="<?php echo base_url();?>images/loading.gif" width=16 height=16 id="gif1" style="display:none;"></img>
                        </div>
                        <div class="line" id="w1" style="display:none;background-color: red">
                            <label></label>
                            <span style="color:blue;">您所輸入的病歷號碼與手術日已經存在，請重新輸入或修改該病患現存資料。 </span>
                          <div align="center">  <button type="button" id="sendPatient" class="green medium" onclick="$('#patientOpDate').val('');calAge();"><span>重新輸入</span></button>
                            <button type="button" id="sendPatient" class="blue medium" onclick="sentPatient()"><span>修改資料</span></button>
                            </div></div>
                        <div class="line" id="w2" style="display:none;background-color: yellow;">
                            <label></label>
                            <span style="color:blue;left: ">您所輸入的病歷號碼與手術日已經在術前評估中存在, 請重新輸入或匯入該病患術前評估資料</span>
                            <div align="center">  <button type="button" id="sendPatient" class="green medium" onclick="$('#patientOpDate').val('');calAge();"><span>重新輸入</span></button>
                            <button type="button" id="sendEvaluation" class="blue medium" onclick="evaluationTrans()"><span>匯入資料</span></button>
                            </div></div>
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="patientName" class="small" value="" />
                        </div>
                        
                         <div class="line">
                            <label><span style="color:red;">Birthday(必填)</span></label>
                             <input type="text" name="patientBirthday" id="patientBirthday"  class="small" value=""  placeholder="yyyy-mm-dd"  onchange="calAge();"  onKeyUp="javascript:checkDate(this);" onBlur="javascript:checkDate_Format(this);" maxlength="10"  />
                        </div>
                    
                        <div class="line">
                            <label>Age</label>
                            <input type="text" name="patientAge" id="patientAge" class="smallDisabled" readonly  value="" />
                            <span id="patientAgeLabel"></span>
                            <input type="hidden" name="patientAgeUnit" id="patientAgeUnit" class="smallDisabled" readonly  value="" />
                        </div>
                        
                        <div class="line">
                            <label>Gender</label>
                             <input type="radio" name="patientGender" id="patientGender_M"  value="M"><label for="patientGender_M">Male&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="patientGender" id="patientGender_F"  value="F"><label for="patientGender_F">Female&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                            <div class="line">
                            <label>Hospital</label>
                            
                                     <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="patientHospital" id="patientHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>"><?php echo $HList[$i]['hospitalName'] ;?></option>
                                   <?php } ?>
                                   </select>
                        </div>
                         <div class="line">
                            <label>主治醫師 1
                          
                              <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("Surgeon 1為此筆病患資料的擁有者, \n若非得到該Surgeon 1的授權即無法修改此筆病患資料",{className:"info",autoHide: false});'></img></label>
                          
                               <select name="patientSurgeon" id="patientSurgeon">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="1") {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>主治醫師 2</label>
                          
                           <select name="patientSurgeon2" id="patientSurgeon2">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="1") {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>住院醫師 1</label>
                          
                               <select name="patientSurgeon3" id="patientSurgeon3">
                                   <option value=""></option>
                                   <option value="N">無</option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="2") {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>住院醫師 2</label>
                          
                               <select name="patientSurgeon4" id="patientSurgeon4">
                                   <option value=""></option>
                                   <option value="N">無</option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="2") {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>住院醫師 3</label>
                          
                               <select name="patientSurgeon5" id="patientSurgeon5">
                                   <option value=""></option>
                                   <option value="N">無</option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                if($row->userRole=="2") {
                                     ?>
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
                                     <?php } } ?>
                                   </select>
                        </div>
                            <div class="line">
                            <label><span style="color:red;">Operation date</span></label>
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="" onchange="calAge();qryPatient();" />
                            <img src="<?php echo base_url();?>images/loading.gif" width=16 height=16 id="gif2" style="display:none;"></img>
                        </div>
                           <div class="line">
                           <label>Admission date  </label>
                            <input type="text" name="AdmissionDate" id="AdmissionDate" class="small" value="" onblur="chkLOS('AdmissionDate','DischargeDate','LOS');" onchange="chkLOS('AdmissionDate','DischargeDate','LOS');"/>
                        </div>
                           <div class="line">
                            <label>Discharge date
                           <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("登錄病人出院當天。如果病人是轉其他醫院、\n機構、甚至是其他醫院的ICU，都是登錄轉出當日。\n如果病人死亡，Discharge date欄位登錄死亡日期。",{className:"info",autoHide: false});'></img></label>
                         
                            <input type="text" name="DischargeDate" id="DischargeDate" class="small" value="" onblur="chkLOS('AdmissionDate','DischargeDate','LOS');" onchange="chkLOS('AdmissionDate','DischargeDate','LOS');"/>
                            ,LOS:
                            <input type="text" name="LOS" id="LOS" class="smallDisabled"  size=10 readonly  value="" /> Days
                        </div>
                           <div class="line">
                            <label>ICU Admission ?</label>
                             <input type="radio" name="patientIsICUAdmission" id="patientIsICUAdmission_Y"  value="Y"  onclick="ShowICUAdmissionDate();"><label for="patientIsICUAdmission_Y">Yes&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="patientIsICUAdmission" id="patientIsICUAdmission_N"  value="N" onclick="ShowICUAdmissionDate();"><label for="patientIsICUAdmission_N">No&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>     
                         <div id="ICUDiv">
                      <div class="line">
                            <label>ICU Admission date</label>
                                 <input type="text" name="ICUAdmissionDate" id="ICUAdmissionDate" class="small" value="" onblur="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" onchange="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" />
                        </div>
                          <div class="line">
                            <label>ICU Discharge date
                                 <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("第一次離開加護病房 的時間，如果是重入ICU則不計算。",{className:"info",autoHide: false});'></img></label>
                            <input type="text" name="ICUDischargeDate" id="ICUDischargeDate" class="small" value=");?>" onblur="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" onchange="chkLOS('ICUAdmissionDate','ICUDischargeDate','ICU_LOS');" />
                             ,ICU LOS:
                            <input type="text" name="ICU_LOS" id="ICU_LOS" class="smallDisabled"  size=10 readonly  value="" /> Days
                        </div>
                      </div>
                       <div class="line">
                            <label>Extubation date
                                <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18"  onmouseout='$(this).notify("");'  onmouseover='$(this).notify("指離開開刀房後，第一次拔管的日期，\n不管病人有沒有重插管、拔管失敗、或病人自拔管等。\n如果病人都沒有拔管後來做氣切，\nextubation date要登錄第一次脫離呼吸器的日期。\n如果病人死亡，登錄死亡當日。\n如果病人帶著著呼吸器回家或長照機構，則登錄出院當日。",{className:"info",autoHide: false});'></img>
                          </label>
                            <input type="text" name="ExtubationDate" id="ExtubationDate" class="small" value=""/>
                        </div>
                        
                          <div class="line">
                            <label>Other associated disease</label>
                           <textarea name="patientAssociatedDisease" class="textarea" cols="55" rows="20"></textarea>
                        </div>
                   
                     
                    <div class="line button">
                           
                            <button type="button" id="sendFrom" class="blue medium" onclick="sentForm()"><span>送出</span></button>
                             <input type="hidden" name="ExistpatientID" id="ExistpatientID" class="small" value="" />  
                        </div>
                  
               
                </form>
            </div>
        </div>
        
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>
 $(document).ready(function() {
  
     callHideShow('divPatientProfiles');   
    $("#patientOpDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientOpDate" ).val('');
    $("#AdmissionDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#AdmissionDate" ).val('');
    $("#DischargeDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#DischargeDate" ).val('');
    $("#ICUAdmissionDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#ICUAdmissionDate" ).val('');
    $("#ICUDischargeDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#ICUDischargeDate" ).val('');
    $("#ExtubationDate").datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#ExtubationDate" ).val('');
     ShowICUAdmissionDate();
    });            
  

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
 function callHideShow(t){
     $('#divPatientProfiles').hide();
     $('#divPastHistory').hide();
     $('#divOperation').hide();

   
     
     $('#'+t).show();
     
 }
  function parseDate(str) {
    var mdy = str.split('-');
    var myDate=new Date(mdy[0], mdy[1]-1, mdy[2]);;
   
    return myDate;
}

 function calAge(){
    
     if($( "#patientOpDate" ).val()!='' && $( "#patientBirthday" ).val()!=''){
        // var age=(Math.floor(parseDate($( "#patientOpDate" ).val())- parseDate($( "#patientBirthday" ).val()))/(1000*60*60*24*365.25)).toFixed(1);
         var age=(Math.floor(parseDate($( "#patientOpDate" ).val())- parseDate($( "#patientBirthday" ).val()))/(1000*60*60*24)).toFixed(1);
         //alert(age);
         if(parseInt(age)<31){ 
         $( "#patientAge" ).val((age/1).toFixed(0));
         $( "#CCCAge" ).html((age/1).toFixed(1)+'Days');
         $("#patientAgeUnit").val('3');
         $("#patientAgeLabel").html('Days');
    //     alert('Days');
         } else if (parseInt(age)<365) {
         $( "#patientAge" ).val((age/30.5).toFixed(1));
         $( "#CCCAge" ).html((age/30.5).toFixed(1)+'Months');
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
 
 function qryPatient(){
    if($('#patientChartNumber').val()!='' && $('#patientOpDate').val()!=''){
    $('#gif1').css('display','block');
    $('#gif2').css('display','block');
    $.ajax({
           type:"POST",
            url: "<?php echo base_url(); ?>Patient/queryExistPatient",
            cache: false,
            data:
                {   chart:$('#patientChartNumber').val(),
                    opdate:$('#patientOpDate').val()
                },
            datatype: "JSON",
            success: function(data){
                    if(JSON.parse(data).status=="success"){
                        var value = JSON.parse(data).result;
                        if(value.length>0){
                        $('#gif1').css('display','none');
                        $('#gif2').css('display','none');
                         $('#w1').css('display','block');
                         $('#sendFrom').attr('disabled','disabled');
                         $('#ExistpatientID').val(value[0].patientID);
                         $('#sendFrom').removeClass( "blue medium").addClass( "grey medium" );
                         } else {
                        $('#gif1').css('display','none');
                        $('#gif2').css('display','none');
                        $('#w1').css('display','none');
                        $('#sendFrom').attr('disabled','false');
                        $('#sendFrom').removeAttr('disabled');

                        $('#sendFrom').removeClass( "grey medium").addClass( "blue medium" );
                       // qryEvaluation();
                         }
                }
            }
    
        });
    }
}

 function qryEvaluation(){
    if($('#patientChartNumber').val()!='' && $('#patientOpDate').val()!=''){
    $('#gif1').css('display','block');
    $('#gif2').css('display','block');
    $.ajax({
           type:"POST",
            url: "<?php echo base_url(); ?>Patient/queryExistEvaluation",
            cache: false,
            data:
                {   chart:$('#patientChartNumber').val(),
                    opdate:$('#patientOpDate').val()
                },
            datatype: "JSON",
            success: function(data){
                    if(JSON.parse(data).status=="success"){
                        var value = JSON.parse(data).result;
                        if(value.length>0){
                        $('#gif1').css('display','none');
                        $('#gif2').css('display','none');
                         $('#w2').css('display','block');
                         $('#sendFrom').attr('disabled','disabled');
                         $('#sendFrom').removeClass( "blue medium").addClass( "grey medium" );
                         //alert(value[0].patientID);
                         $('#ExistpatientID').val(value[0].patientID);
                         } else {
                        $('#gif1').css('display','none');
                        $('#gif2').css('display','none');
                        $('#w2').css('display','none');
                        $('#sendFrom').attr('disabled','false');
                        $('#sendFrom').removeAttr('disabled');

                        $('#sendFrom').removeClass( "grey medium").addClass( "blue medium" );
                        
                         }
                }
            }
    
        });
    }
}
function sentPatient(){
   if($('#ExistpatientID').val()!=''){
       window.location='/patient/viewRecord/'+$('#ExistpatientID').val();
   }
}
function sentEvaluation(){
   if($('#ExistpatientID').val()!=''){
       window.location='/evaluation/viewRecord/'+$('#ExistpatientID').val();
   }
}
  function evaluationTrans(){
    
    if($('#patientChartNumber').val()!='' && $('#patientOpDate').val()!=''){
          $.ajax({
                        type:"POST",
                        url: "<?php echo base_url(); ?>evaluation/evaluationTrans/",
                        cache: false,
                        data:
                            {
                            patientID:$('#ExistpatientID').val(),
                            patientOPdate:$('#patientOpDate').val()
                            
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
        $.notify(m, "error");
    } else {
$.notify(m, "success");
}
}

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



</body>

</html> 