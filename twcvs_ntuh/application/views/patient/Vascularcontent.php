<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>
 <?php $c=$myContent->row();?>
<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Patient Profiles</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>specialSheet/updateVascularRecord" method="post" id="addPatient">
                     
                   
                        
                        <div class="line">
                            <label><span style="color:red;">Chart number(必填)</span></label>
                            <input type="text" name="patientChartNumber" id="patientChartNumber" class="small" value="<?php echo $c->patientChartNumber;?>" />
                        </div>
                      
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="patientName" class="small" value="<?php echo $c->patientName;?>" />
                        </div>
                        
                         <div class="line">
                            <label>Birthday</label>
                             <input type="text" name="patientBirthday" id="patientBirthday"  class="small" value="<?php echo str_replace('0000-00-00', '', $c->patientBirthday);?>"    onchange="calAge();"  onKeyUp="javascript:checkDate(this);" onBlur="javascript:checkDate_Format(this);" maxlength="10"  />
                        </div>
                    
                        <div class="line">
                            <label>Age</label>
                            <input type="text" name="patientAge" id="patientAge" class="smallDisabled" readonly  value="<?php echo $c->patientAge;?>" />
                            <span id="patientAgeLabel"></span>
                            <input type="hidden" name="patientAgeUnit" id="patientAgeUnit" class="smallDisabled" readonly  value="<?php echo $c->patientAgeUnit;?>" />
                             <input type="text" name="patientAgeDescription" id="patientAgeDescription" class="small"   value="<?php echo $c->patientAgeDescription;?>" />
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
                            <label>Surgeon 1</label>
                          
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
                            <div class="line">
                            <label><span style="color:red;">Operation date</span></label>
                            <input type="text" name="patientOpDate" id="patientOpDate" class="small" value="<?php echo $c->patientOpDate;?>" onchange="calAge();" />
                        </div>
                            <div class="line">
                            <label>Primary Procedure </label>
                          
                             <input type="text" name="patientProcedure1" id="patientProcedure1" class="big" value="<?php echo $c->patientProcedure1;?>" readonly />
                             <input type="hidden" name="patientProcedure_id1" id="patientProcedure_id1" class="small" value="<?php echo $c->patientProcedure_id1;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/specialSheet/queryVascularProcedure/1"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('1')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                              <div class="line">
                            <label>Secondary Procedure 1</label>
                          
                             <input type="text" name="patientProcedure2" id="patientProcedure2" class="big" value="<?php echo $c->patientProcedure2;?>" readonly />
                             <input type="hidden" name="patientProcedure_id2" id="patientProcedure_id2" class="small" value="<?php echo $c->patientProcedure_id2;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/specialSheet/queryVascularProcedure/2"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('2')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                               <div class="line">
                            <label>Secondary Procedure 2</label>
                          
                             <input type="text" name="patientProcedure3" id="patientProcedure3" class="big" value="<?php echo $c->patientProcedure3;?>" readonly />
                             <input type="hidden" name="patientProcedure_id3" id="patientProcedure_id3" class="small" value="<?php echo $c->patientProcedure_id3;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/specialSheet/queryVascularProcedure/3"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('3')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                               <div class="line">
                            <label>Secondary Procedure 3</label>
                          
                             <input type="text" name="patientProcedure4" id="patientProcedure4" class="big" value="<?php echo $c->patientProcedure4;?>" readonly />
                             <input type="hidden" name="patientProcedure_id4" id="patientProcedure_id4" class="small" value="<?php echo $c->patientProcedure_id4;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/specialSheet/queryVascularProcedure/4"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('4')"><img src="/images/cross-circle.png"></a>
                             </div>
                             
                               <div class="line">
                            <label>Secondary Procedure 4</label>
                          
                             <input type="text" name="patientProcedure5" id="patientProcedure5" class="big" value="<?php echo $c->patientProcedure5;?>" readonly/>
                             <input type="hidden" name="patientProcedure_id5" id="patientProcedure_id5" class="small" value="<?php echo $c->patientProcedure_id5;?>" />
                             <a class="various" data-fancybox-type="iframe" href="/specialSheet/queryVascularProcedure/5"><img src="/images/plus-circle.png"></a>
                             <a  href="javascript:deleteChildProcedure('5')"><img src="/images/cross-circle.png"></a>
                             </div>
                              <div class="line">
                            <label>Procedure Others: </label>
                           <textarea name="patientProcedureOthers" class="textarea" cols="55" rows="10"><?php echo $c->patientProcedureOthers;?></textarea>
                        </div>
                      <div class="line">
                            <label>Diagnosis: </label>
                           <textarea name="patientDiagnosis" class="textarea" cols="55" rows="10"><?php echo $c->patientDiagnosis;?></textarea>
                        </div>
                         <div class="line">
                            <label>備註: </label>
                           <textarea name="vascularMemo" class="textarea" cols="55" rows="10"><?php echo $c->vascularMemo;?></textarea>
                        </div>
                    <div class="line button">
                           
                            <button type="button" id="sendFrom" class="blue medium" onclick="sentForm()"><span>送出</span></button>
                               <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />    
                        </div>
                  
               
                </form>
            </div>
        </div>
        
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>
 $(document).ready(function() {
  afterUpdate('<?php echo $msg;?>');
     
  $( "#patientOpDate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    $( "#patientOpDate" ).val('<?php echo str_replace('0000-00-00', '', $c->patientOpDate);?>');
    
  
 });    
 
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
 function sentForm(){
     var errorMsg="";
     if( $( "#patientChartNumber" ).val()==""){
         errorMsg+="Chart Number 不能為空白\n";
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
 
 function showProcedure(w,did,dcat,dsub){
    $("#patientProcedure"+w).val(dsub);
    $("#patientProcedure_id"+w).val(did);   
}

 function afterUpdate(m){
     if(m!='')    $.notify(m, "info");
 }
 
  function deleteChildProcedure(d){
     $('#patientProcedure'+d).val('');
     $('#patientProcedure_id'+d).val('');
 }
</script>



</body>

</html> 