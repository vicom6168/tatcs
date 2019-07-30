<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 <?php $c=$myContent->row();?>
 <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->patientDischargeDate!="" && $c->patientDischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->patientDischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }

//header顏色
if($c->diseaseType=='1') 
$myColor="#E6F8E0";
else if($c->diseaseType=='5')
$myColor="#F8F7FA";	
else {
$myColor="#ffff99"; 	
}

$genderImage=array(
""=>"",
"F"=>"/images/girl.png",
"M"=>"/images/boy.png"
);
 ?>
       <div class="section">
        <div class="full">
            <div class="box">
             
                <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>Patient Information</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                          
                             <tr>
                                <td>
                                 <table>
                                     <tr>
                                         <td bgcolor="<?php echo $myColor;?>">Chart number</td>
                                         <td><?php echo $c->patientChartNumber;?></td>
                                          <td bgcolor="<?php echo $myColor;?>">Name</td>
                                         <td><?php echo $c->patientName;?></td>
                                         <td bgcolor="<?php echo $myColor;?>">Gender</td>
                                         <td><img src="<?php echo $genderImage[$c->patientGender];?>"></td>
                                         <td bgcolor="<?php echo $myColor;?>">Operation Date:</td>
                                         <td><?php echo  str_replace('0000-00-00', '', $c->patientOpDate);?></td>
                                         <td bgcolor="<?php echo $myColor;?>">Surgeon</td>
                                         <td>******</td>
                                     </tr>
                                 </table>   
                                    
                                </td>
                            </tr>
                            
                            
                        </tbody> 
                    </table>
                </div>
            </div>
            
            
                
      <?php $this->load->view("patient/includes/divPatientProfiles");?>  
      <?php $this->load->view("patient/includes/divOutcome");?>  
      <?php $this->load->view("patient/includes/divOperation");?>  
      <?php $this->load->view("patient/includes/divDataHistory");?>  
     <?php $this->load->view("patient/includes/divCancer");?>  
    
         
        
        
        
  </div>
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>

$("#divdeps1").dialog({
    autoOpen: false,
    show: 'slide',
    resizable: false,
    position: 'top',
    stack: true,
    height: '100',
    width: '500',
    modal: false
});

$(document).ready(function() {
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
   
    $(".chdMMemo").fancybox({
        maxWidth    : 600,
        maxHeight   : 900,
        fitToView   : true,
        titleShow: true,               
autoscale: false,               
autoDimensions: false ,
        width       : '60%',
        height      : '100%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    })

});

 $(document).ready(function() {
   // alert('<?php echo $cancerpage;?>');
     afterUpdate('<?php echo $patientpage;?>','<?php echo $msg;?>','<?php echo $cancerpage;?>');
   
   
    
   
    
 });    
   
 function afterUpdate(p,m,c){
     callHideShow(p);
    // alert(c);
     if(c!='')
      callHideShowCancer(c);
     if(m!='')    $.notify(m, "info");
 }
 function callHideShow(t){
     $('#divPatientProfiles').hide();
     $('#divOperation').hide();
      $('#divCancer').hide();
     $('#divDataHistory').hide();
     $('#divOutcome').hide();
     
     $('#'+t).show();
     
 }
  function callHideShowCancer(t){
     $('#divCancerLifestyle').hide();
     $('#divCancerClinic').hide();
     $('#divCancerBody').hide();
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
    //     alert(age);
         if(parseInt(age)<31){ 
         $( "#patientAge" ).val((age/1).toFixed(0));
         $( "#CCCAge" ).html((age/1).toFixed(1)+'Days');
         $("#patientAgeUnit").val('3');
         $("#patientAgeLabel").html('Days');
    //     alert('Days');
         } else if (parseInt(age)<365) {
         $( "#patientAge" ).val((age/30.5).toFixed(1));
         $( "#CCCAge" ).html(age+'Months');
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

 function Fmt(x) {
var v
if(x>=0) { v=''+(x+0.005)} else { v=''+(x-0.005) }
return v.substring(0,v.indexOf('.')+3)
}


function parseDate(str) {
    var mdy = str.split('-');
    return new Date(mdy[0], mdy[1]-1, mdy[2]);
}

function showDiagnosis(w,did,dcat,dsub){
    $("#Diagnosis"+w).val(dsub);
    $("#Diagnosis_id"+w).val(did);   
}

function showProcedure(w,did,dcat,dsub,dtype){
   var TypeNameArray = ["", "Open", "VATS/Laparoscopy","Hybrid VATS","Robot Assisted"];
    $("#Procedure"+w).val(dsub);
    $("#Procedure_id"+w).val(did);   
    $("#ProcedureType"+w).val(dtype);   
    $("#ProcedureTypeName"+w).val(TypeNameArray[dtype]);  
}

function showAdultDiagnosis(w,did,dcat,dsub){
    $("#Diagnosis"+w).val(dsub);
    $("#Diagnosis_id"+w).val(did);   
}

function chkCPBTime(){
    if($("#operationCongenitalBypassCPBTime").val()!="" && $("#operationCongenitalBypassAorticTime").val()!=""){
    if(parseInt($("#operationCongenitalBypassCPBTime").val())<parseInt($("#operationCongenitalBypassAorticTime").val())){
        $("#operationCongenitalBypassCPBTime").notify("CPB time必須大於 cross clamp time","error");
    } else {
        $("#operationCongenitalBypassCPBTime").notify("");
    }
    }
} 

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
 
 f
 function deletePatientDiagnosis(d){
     $('#Diagnosis'+d).val('');
     $('#Diagnosis_id'+d).val('');
 }
  function deleteChildDiagnosis(d){
     $('#Diagnosis'+d).val('');
     $('#Diagnosis_id'+d).val('');
 }
 function deleteChildProcedure(d){
     $('#Procedure'+d).val('');
     $('#Procedure_id'+d).val('');
     $('#ProcedureType'+d).val('');
     
 }
 
</script>



</body>

</html> 