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
                            <label>Surgeon 1</label>
                          
                               <select name="patientSurgeon" id="patientSurgeon">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
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
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
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
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
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
                                     <option value="<?php echo $row->vsName;?>"><?php echo $row->vsName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                            <div class="line">
                            <label><span style="color:red;">Operation date</span></label>
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="" onchange="calAge();qryPatient();" />
                            <img src="<?php echo base_url();?>images/loading.gif" width=16 height=16 id="gif2" style="display:none;"></img>
                        </div>
                           <div class="line">
                            <label>Discharge date</label>
                            <input type="text" name="patientDischargeDate" id="patientDischargeDate" class="small" value="" />
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
   <?php if($page=="index" || $page=="") { ?>
   callHideShow('divPatientProfiles');
   <?php  } else if($page=="euroScore") { ?>
       callHideShow('divPastHistory');
    <?php  } else if($page=="operation")  { ?>
     callHideShow('divOperation');
    <?php } else {  ?>
     callHideShow('divPatientProfiles');   
     <?php } ?>
     
    $( "#patientOpDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientOpDate" ).val('');
    
  
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
                        qryEvaluation();
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
</script>



</body>

</html> 