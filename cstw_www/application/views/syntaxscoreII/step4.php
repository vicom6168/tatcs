<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
     <LINK rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/css.css">


<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 <?php $c=$myContent->row();
 $patientData['p']=$c;  
 //header顏色
if($c->patientCongenitalSurgery=='Y') 
$myColor="#E6F8E0";
else 
$myColor="#F8F7FA"; 

$genderImage=array(
""=>"",
"F"=>"/images/girl.png",
"M"=>"/images/boy.png"
);
$heartImage=array(
""=>"",
"R"=>"/images/righth.png",
"L"=>"/images/lefth.png"
);
$arrayScore=(array)$segment->result();
 ?>
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
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
                                         <td><?php echo $c->patientSurgeon;?></td>
                                     </tr>
                                 </table>   
                                    
                                </td>
                            </tr>
                            
                            
                        </tbody> 
                    </table>
                <div class="title">
                    <h2>  Score: <span id="myScore"></span>  Dominance: <?php echo ($dominance=="R"?"right":"left");?>   Current lesion: <?php echo $LesionsID;?>/<?php echo $TotalLesion;?></h2>
                </div>
                
              
    <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/step5">            
   <table style="height:433px;padding:0px;table-layout:fixed;" cellpadding="0" cellspacing="0">
 
    <tr>
        <td style="height:392px;width:350px;text-align:center;vertical-align: top;overflow: hidden;">
            <div style="margin-top: 20px" id="leftSection">
             <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap></th>
                                <th nowrap>Segments</th>
                               <th nowrap>Lesion</th>
                                 <?php foreach($myScore->result() as $row){ ?>
                                <th nowrap bgcolor="#81bbd5"><?php echo $row->LesionsID;?></th>
                               <?php } ?>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($segment->result() as $row){
                                $j++;
                            ?>
                            <tr id="row_<?php echo $row->syntaxScoreSegment;?>"> 
                             
                                <td id="row1_<?php echo $row->syntaxScoreSegment;?>" style="padding : 2px 8px;line-height : 20px;"><font color="#C50000"><b><?php echo $row->syntaxScoreSegmentCategoryLabel;?></b></font></td>
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $row->syntaxScoreLabel;?></td>
                            
                               <td style="padding : 2px 8px;line-height : 20px;"><?php echo $row->syntaxScoreSegment;?>  </td>
                                 <?php foreach($myScore->result() as $scorerow){ ?>
                                <td style="padding : 2px 8px;line-height : 20px;"  bgcolor="#81bbd5">
                                       
                                       <?php     if($scorerow->{'q'.$row->syntaxScoreSegment}=="1") echo "V"; else echo ""; ?>
                                  <?php      } ?>
                                    </td>
                                    
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                    <img src="<?php echo $heartImage[$dominance];?>">
</div>
              <div style="margin-top: 20px;display:none;" id="leftBlunt">
                  <img src="/images/blunt.gif">
                  </div>
                   <div style="margin-top: 20px;display:none;width:100%;" id="leftBridge">
                       <img src="/images/bridging.gif">
                  </div>
                  <div style="margin-top: 20px;display:none;width: 100%;" id="leftSidebranch">
                      <img src="/images/sidebranch.gif" width="400">
                  </div>
                   <div style="margin-top: 600px;display:none;width: 100%;" id="leftMidina">
                       <img src="/images/side_ref.png" >
                  </div>
                  <div style="margin-top: 600px;display:none;width:100%;" id="leftBifurcation">
                      <img src="/images/Bifurcationangulation.gif">
                  </div>
        </td>
        <td style="height:392px;width:450px;text-align:left;vertical-align: top"  id="rightSection">
            <!-- Segment Content -->
                     <div style="color: #004A80" id="title"><b>Please fill in the following variables :</b></div>
                    
                 <!--- Data -->
             </br>
                    <div id="question12" style="padding-left : 1em ;height:80px" >
                       <span class="darkred"><b>12. Diffusely diseased and narrowed segment (Yes/No)? </b></span><br/>
                        <div id="q12i">a.<input type="radio" name="q12" id="q12_N" value="N" onclick="chkProcess('12');"> No</div>
                        <div id="q12ii">b.<input type="radio" name="q12" id="q12_Y" value="Y" onclick="chkProcess('12');"> Yes</div>
                     </div>
                      <div id="question12i" style="padding-left : 4em;display: none;" >
                       
                         <table cellspacing="0" cellpadding="0" border="0" class="selecttable" width=100%> 
                      
                        <tbody> 
                             <tr>
                               <td></td>
                               <td> Segment numbers:</td>
                               <td> Diseased and narrowed segment</td>
                           </tr>
                             <?php 
                             $i=0;
                          foreach($segment->result() as $row){
                              if(($L1=="1" && $row->syntaxScoreSegmentCategory=="RCA")  || ($L2=="1" && $row->syntaxScoreSegmentCategory=="LM")
                              || ($L3=="1" && $row->syntaxScoreSegmentCategory=="LAD") || ($L4=="1" && $row->syntaxScoreSegmentCategory=="LCX")) {
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo $row->syntaxScoreLabel;?></td>
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo $row->syntaxScoreSegment;?></td>
                                <td style="padding : 2px 8px;line-height : 15px;">
                                    <input type="checkbox" name="q12i_<?php echo $row->syntaxScoreSegment;?>"  onclick="chkProcess('<?php echo $row->syntaxScoreSegment;?>');"
                                    id="q12i_<?php echo $i;?>" value="1"></td>
                           </tr>
                            <?php 
                              $i++;
                              }
                               } ?>
                        </tbody> 
                    </table>
                    <br/>
                     </div>
                     
                   
                    <div  style="float: right;">
                                 <button type="submit" class="blue medium" id="nextAction" style="float: right;display: none"><span>Calculate Score</span></button>
                                 <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $dominance;?>" />
                                 <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                                 <input type="hidden" name="step1Score" id="step1Score" class="small" value="<?php echo $mainPageScore;?>" />
                                 <input type="hidden" name="step2Score" id="step2Score" class="small" value="<?php echo $secondPageScore;?>" />
                                <input type="hidden" name="step3Score" id="step3Score" class="small" value="<?php echo $thirdPageScore;?>" />
                                  <input type="hidden" name="LesionsID" id="LesionsID" class="small" value="<?php echo $LesionsID;?>" />
                                 <input type="hidden" name="Q4SegmentCount" id="Q12SegmentCount" class="small" value="<?php echo $i;?>" />
                     </div>
            </form>  
            
        </td>
        </tr>
        <tr>
          <td colspan="2" style="height:40px;width:600px;text-align:center;" bgcolor="#F4F004">
              SYNTAX score 教學網頁：<br/>
              <a href="http://www.syntaxscore.com/index.php/tutorial/definitions" target="_blank">http://www.syntaxscore.com/index.php/tutorial/definitions</a>
             
              </td>
          </tr>
</table>
               
            
            </div>
        </div>

 
     
     
        </div>
      
       
  
  
 <?php $this->load->view("footer");?>  
    
</div>
<script>
var currentPageScore=0;
chkProcess('12');
refreshScore();



function refreshScore(){
    var finishFlag='0';
  $('#step3Score').val('0');
  for (i=0;i<$('#Q12SegmentCount').val();i++){
      if($('#q12i_'+i).is(':checked') ){
          $('#step3Score').val(parseFloat($('#step3Score').val())+1);
          finishFlag='1';
      }
  }
  if(finishFlag=='1'){
      $('#nextAction').show();  
  } else  if($('input[name=q12]:checked').length>0  && $('input[name=q12]:checked').val()=="Y" ) {
      $('#nextAction').hide();   
  }
  $("#myScore").text(parseFloat($('#step1Score').val())+parseFloat($('#step2Score').val())+parseFloat($('#step3Score').val()));
      
}
function chkProcess(obj){
   
   hideProcess(obj);
    refreshScore();
    }
   function hideProcess(obj){
  
    switch(obj){
        case "12":
         if($('input[name=q12]:checked').length>0 ){
         if( $('input[name=q12]:checked').val()=="Y" ){
                          $('#question12i').show();  
                  } else {
                      $('#question12i').hide();  
                      $('#nextAction').show();  
                      
                      for (i=0;i<$('#Q12SegmentCount').val();i++){
                          $('#q12i_'+i).prop("checked", false);
                          }
                  }
                 }       
                         
                            break;
      
    }
    
}

 
</script>

</body>

</html> 