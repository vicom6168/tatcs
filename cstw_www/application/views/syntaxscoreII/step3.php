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
                                <th nowrap bgcolor="#81bbd5"><?php echo $LesionsID;?></th>
                              
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
                                 
                                <td style="padding : 2px 8px;line-height : 20px;"  bgcolor="#81bbd5">
                                    <?php if($chooseSeg[$row->syntaxScoreSegment]=="1") echo "V"; else echo "";?>
                                    <input type="hidden" name="check_<?php echo $row->syntaxScoreSegment;?>" 
                                    id="check_<?php echo $row->syntaxScoreSegment;?>" value="<?php echo $chooseSeg[$row->syntaxScoreSegment];?>"></td>
                                
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
                
                 <!--- Data -->
             </br>
                    <div id="addLesion" style="padding-left : 1em ;height:80px;" >
                        <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/add">   
                        <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                            <tr><td>
                                <img src="/images/Add.jpg"> Add another lesion
                                <button type="submit" class="blue medium" id="nextAction" style="float: right;"><span>Add Lesion</span></button>
                            </td></tr>
                          </table>
                           <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                          </form>
                     </div>
                      <div id="Completed" style="padding-left : 1em ;height:80px" >
                              <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/step4">      
                           <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                            <tr><td>
                        <img src="/images/Next.jpg"> All lesions are completed
                         <button type="submit" class="blue medium" id="nextAction" style="float: right;"><span>Proceed</span></button>
                          </td></tr>
                          </table>
                           <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                           <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $dominance;?>" />
                           <input type="hidden" name="LesionsID" id="LesionsID" class="small" value="<?php echo $LesionsID;?>" />
                          </form>
                     </div>
                       <div id="editLesion" style="padding-left : 1em ;height:80px" >
                            
                               <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/modify" name="modifyForm" id="modifyForm">   
                        <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                            <tr><td>  <img src="/images/Modify.jpg"> Edit a lesion
                               <select name="modifyID" class="" onchange="calModify();">
                                   <option value=""></option>
                                   <?php foreach($myScore->result() as $scorerow){ ?>
                                   <option value="<?php echo $scorerow->sid;?>"><?php echo "Lesions ".$scorerow->LesionsID;?></option>
                                   <?php } ?>
                               </select>
                            </td></tr>
                          </table>
                           <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                           <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $c->SyntaxScoreDominance;?>" />
                          </form>
                     </div>
                       <div id="deletLesion" style="padding-left : 1em ;height:80px" >
                             <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/delete" name="delForm" id="delForm">   
                        <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                            <tr><td> <img src="/images/Delete.jpg"> Delete a lesion
                               <select name="deleteID" class="" onchange="calDelete();">
                                   <option value=""></option>
                                   <?php foreach($myScore->result() as $scorerow){ ?>
                                   <option value="<?php echo $scorerow->sid;?>"><?php echo "Lesions ".$scorerow->LesionsID;?></option>
                                   <?php } ?>
                               </select>
                            </td></tr>
                          </table>
                           <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                          </form>
                     </div>
                    <div  style="float: right;">
                                 <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $dominance;?>" />
                                 <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                                 
                                 
                     </div>
          
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
refreshScore();
var Q4iScore=[];
<?php   foreach($segment->result() as $row){ ?>
 <?php     if($dominance=="R"){?>
       Q4iScore['<?php echo $row->syntaxScoreSegment;?>']='<?php echo $row->syntaxScoreFactorRight;?>';
<?php      } else {?>
        Q4iScore['<?php echo $row->syntaxScoreSegment;?>']='<?php echo $row->syntaxScoreFactorLeft;?>';
<?php      }?>
    
    
<?php } ?>

function addScore(value){
    currentPageScore=currentPageScore+value;
}
function refreshScore(){
   // $('input[name=q4i]:checked').val()$('input[name=value]:checked').length
  //alert($('input[name=q4i]:checked').length);
   currentPageScore=0;
   if($('input[name=q4i]:checked').length>0 && $('input[name=q4i]:checked').val()!=""){
       currentPageScore+=parseFloat(Q4iScore[$('input[name=q4i]:checked').val()])*3;
   }
     if($('input[name=q4ii]:checked').length>0  && ($('input[name=q4ii]:checked').val()=="2" || $('input[name=q4ii]:checked').val()=="3" )){
        currentPageScore+=1;
    }
     if($('input[name=q4iii]:checked').length>0  && $('input[name=q4iii]:checked').val()=="Y" ){
        currentPageScore+=1;
    }
     if($('input[name=q4iv]:checked').length>0  && $('input[name=q4iv]:checked').val()=="Y" ){
        currentPageScore+=1;
    }
      if($('input[name=q4i]:checked').length>0  && $('input[name=q4v]:checked').length>0  ){
       currentPageScore+=q4vScore();
    }
    
      if($('input[name=q4vi]:checked').length>0  && ($('input[name=q4vi]:checked').val()=="2" || $('input[name=q4vi]:checked').val()=="3"  || $('input[name=q4vi]:checked').val()=="4" )){
        currentPageScore+=1;
    }
       if($('input[name=q5i]:checked').length>0 ){
            if($('input[name=q5i]:checked').val()=="1"){
              currentPageScore+=3;
            } else  if($('input[name=q5i]:checked').val()=="2"){
              currentPageScore+=4;
            } else  if($('input[name=q5i]:checked').val()=="3"){
              currentPageScore+=5;
           }  else  if($('input[name=q5i]:checked').val()=="4"){
              currentPageScore+=6;
              }
    } 
      if($('input[name=q6i]:checked').length>0 ){
            if($('input[name=q6i]:checked').val()=="1" || $('input[name=q6i]:checked').val()=="2" || $('input[name=q6i]:checked').val()=="3" ){
              currentPageScore+=1;
           }  else  if($('input[name=q6i]:checked').val()=="4" || $('input[name=q6i]:checked').val()=="5"  || $('input[name=q6i]:checked').val()=="6"  || $('input[name=q6i]:checked').val()=="7" ){
              currentPageScore+=2;
           }
    }
        if($('input[name=q6ii]:checked').length>0  && $('input[name=q6ii]:checked').val()=="Y" ){
        currentPageScore+=1;
    }
    if($('input[name=q7]:checked').length>0  && $('input[name=q7]:checked').val()=="Y" ){
        currentPageScore+=1;
    }
       if($('input[name=q8]:checked').length>0  && $('input[name=q8]:checked').val()=="Y" ){
        currentPageScore+=2;
    }
       if($('input[name=q10]:checked').length>0  && $('input[name=q10]:checked').val()=="Y" ){
        currentPageScore+=2;
    }
       if($('input[name=q11]:checked').length>0  && $('input[name=q11]:checked').val()=="Y" ){
        currentPageScore+=1;
    }
    $("#myScore").text(parseFloat($('#step1Score').val())+parseFloat(currentPageScore));
}
function chkProcess(obj){
   //alert($('input[name=q4i]:checked').val());
    hideProcess(obj);
    switch(obj){
        case "4": if($('input[name=q4]:checked').val()=="Y"){
                            $('#question4i').show();
                        } else {
                          $('#question5').show();     
                          }
                            break;
         case "4i": if($('input[name=q4i]:checked').val()!=""){
                            $('#question4ii').show();
                            buildQ4VTable($('input[name=q4i]:checked').val());
                        } 
                            break;
      case "4ii": if($('input[name=q4ii]:checked').val()!=""){
                            $('#question4iii').show();
                        } 
                            break;
       case "4iii": if($('input[name=q4iii]:checked').val()!=""){
                            $('#question4iv').show();
                        } 
                            break;
      case "4iv": if($('input[name=q4iv]:checked').val()!=""){
                          if(parseInt($('#Q4SegmentCount').val())>1){
                            $('#question4v').show();
                            } else {
                                $('#question4vi').show();
                            }
                        } 
                            break;
       case "4v": if($('input[name=q4v]:checked').val()!=""){
                            $('#question4vi').show();
                        } 
                            break;
        case "4vi": if($('input[name=q4vi]:checked').val()=="1" || $('input[name=q4vi]:checked').val()=="2"){
                          $('#question7').show();     
                      } else if($('input[name=q4vi]:checked').val()=="3" || $('input[name=q4vi]:checked').val()=="4"){
                          $('#question5').show();     
                          }
                            break;
         case "5": if($('input[name=q5]:checked').val()=="Y"){
                            $('#question5i').show();
                        } else {
                   $('#question6').show();     
                   }
                            break;
          case "5i":
                   $('#question7').show();     
                  
                            break;
         case "6": if($('input[name=q6]:checked').val()=="Y"){
                            $('#question6i').show();    
                        } else {
                   $('#question7').show();    
                   }
                            break;
        case "6i": 
                   $('#question6ii').show();    
                   
                            break;
         case "6ii":
                     $('#question7').show();    
                   
                            break;
        case "7":     
                   $('#question8').show();    
                            break;
        case "8": 
                   $('#question10').show();     
                            break;
       case "9": 
                   $('#question10').show();     
                            break;
         case "10": 
                   $('#question11').show();     
                            break;
         case "11": 
                            $('#qucomment').show();
                            $('#nextAction').show();
                            break;
    }
    refreshScore();
    }
   function hideProcess(obj){
  
    switch(obj){
        case "4":
                          $('#question4i').hide();  
                          $('input[name=q4i]').attr('checked',false);
                          $('#question4ii').hide(); 
                          $('input[name=q4ii]').attr('checked',false);
                          $('#question4iii').hide(); 
                          $('input[name=q4iiii]').attr('checked',false);
                          $('#question4iv').hide();
                          $('input[name=q4iv]').attr('checked',false); 
                          $('#question4v').hide(); 
                          $('input[name=q4v]').attr('checked',false);
                          $('#question4vi').hide(); 
                          $('input[name=q4vi]').attr('checked',false);
                          $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                         // $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                         
                         showhideLeft('leftSection');
                            break;
         case "4i": $('#question4ii').hide(); 
                          $('input[name=q4ii]').attr('checked',false);
                          $('#question4iii').hide(); 
                          $('input[name=q4iii]').attr('checked',false);
                          $('#question4iv').hide();
                          $('input[name=q4iv]').attr('checked',false); 
                          $('#question4v').hide(); 
                          $('input[name=q4v]').attr('checked',false);
                          $('#question4vi').hide(); 
                          $('input[name=q4vi]').attr('checked',false);
                           $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
         case "4ii": 
                          $('#question4iii').hide(); 
                          $('input[name=q4iii]').attr('checked',false);
                          $('#question4iv').hide();
                          $('input[name=q4iv]').attr('checked',false); 
                          $('#question4v').hide(); 
                          $('input[name=q4v]').attr('checked',false);
                          $('#question4vi').hide(); 
                          $('input[name=q4vi]').attr('checked',false);
                           $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                         //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftBlunt');
                            break;
        case "4iii": 
                          $('#question4iv').hide();
                          $('input[name=q4iv]').attr('checked',false); 
                          $('#question4v').hide(); 
                          $('input[name=q4v]').attr('checked',false);
                          $('#question4vi').hide(); 
                          $('input[name=q4vi]').attr('checked',false);
                           $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftBridge');
                            break;
        case "4iv": 
                          $('#question4v').hide(); 
                          $('input[name=q4v]').attr('checked',false);
                          $('#question4vi').hide(); 
                          $('input[name=q4vi]').attr('checked',false);
                           $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                           showhideLeft('leftSidebranch');
                            break;
        case "4v": 
                          $('#question4vi').hide(); 
                          $('input[name=q4vi]').attr('checked',false);
                           $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
        case "4vi": 
                           $('#question5').hide();  
                          $('input[name=q5]').attr('checked',false);
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                         // $('#question9').hide();  
                        //  $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
        case "5": 
                          $('#question5i').hide();  
                          $('input[name=q5i]').attr('checked',false);
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
        case "5i": 
                          
                          $('#question6').hide();  
                          $('input[name=q6]').attr('checked',false);
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                          //$('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
         case "6":
                          $('#question6i').hide();  
                          $('input[name=q6i]').attr('checked',false);
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                         // $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          if($('input[name=q6]:checked').val()=="Y"){
                              showhideLeft('leftMidina');
                          } else {
                              showhideLeft('leftSection');
                          }
                            break;
          case "6i":
                          
                          $('#question6ii').hide();  
                          $('input[name=q6ii]').attr('checked',false);
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                         // $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                           showhideLeft('leftBifurcation');
                            break;
         case "6ii":
                          
                          $('#question7').hide();  
                          $('input[name=q7]').attr('checked',false);
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                          //$('#question9').hide();  
                         // $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
        case "7": 
                          $('#question8').hide();  
                          $('input[name=q8]').attr('checked',false);
                         // $('#question9').hide();  
                         // $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                            break;
        case "8": 
                        //  $('#question9').hide();  
                       //   $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                    
                            break;
       case "9": 
                        //  $('#question9').hide();  
                       //   $('input[name=q9]').attr('checked',false);
                          $('#question10').hide();     
                          $('input[name=q10]').attr('checked',false);
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                      
                            break;
         case "10": 
                          $('#question11').hide();  
                          $('input[name=q11]').attr('checked',false);
                          $('#qucomment').hide();  
                          $('#qucomment').val('');
                          $('#nextAction').hide();  
                          
                          showhideLeft('leftSection');
                    
                            break;
         case "11": 
                           showhideLeft('leftSection');
                            break;
    }
    
}

 // label - segment - visible - scoreFactorRight - scoreFactorLeft
// used in the visualization of question 4v
var meDiffuseTableArray = [
               ['RCA proximal','1','1','1','1','0'],//0
               ['RCA mid','2','1','1','1','0'],
               ['RCA distal','3','1','1','1','0'],
               ['Posterior descending','4','1','1','1','0'], //3
               ['Posterolateral from RCA','16','1','0','0.5','0'],//4
               ['Posterolateral from RCA','16a','1','0','0.5','0'],//5
               ['Posterolateral from RCA','16b','1','0','0.5','0'],//6
               ['Posterolateral from RCA','16c','1','0','0.5','0'],//7
               ['Left main','5','1','1','5','6'],
               ['LAD proximal','6','1','1','3.5','3.5'],//9
               ['LAD mid','7','1','1','2.5','2.5'],
               ['LAD apical','8','1','0','1','1'],//11
               ['First diagonal','9','1','0','1','1'],//12
               ['Add. first diagonal','9a','1','0','1','1'],
               ['Second diagonal','10','1','0','0.5','0.5'],//14
               ['Add. second diagonal','10a','1','0','0.5','0.5'],
               ['Proximal circumflex','11','1','1','1.5','2.5'],//16
               ['Intermediate/anterolateral','12','1','0','1','1'],
               ['Obtuse marginal','12a','1','0','1','1'],
               ['Obtuse marginal','12b','1','0','1','1'],
               ['Distal circumflex','13','1','1','0.5','1.5'], //20
               ['Left posterolateral','14','1','1','0.5','1'],//21
               ['Left posterolateral','14a','1','0','0.5','1'],
               ['Left posterolateral','14b','1','0','0.5','1'],
               ['Posterior descending','15','1','0','0','1']]; //24

// Main segment , label, start in array 'meDiffuseTableArray' ,
//   end in array 'meDiffuseTableArray' //showme // denylist
// Note: used in the visualization of question 4v
//   'start in array'  and 'end in array' values refer to the above meDiffuseTableArray
//   and the denylist is there to skip some intermediate values
var meSegmentVisualizedTableHelp =[
                   ['1','If, T.O. in segment 1',0,4,'1',''],//0
                   ['2','If, T.O. in segment 2',1,4,'1',''],
                   ['3','If, T.O. in segment 3',2,4,'1',''],
                   ['4','If, T.O. in segment 4',3,4,'1','|4|16|'],//nl 3 aanpassing MVG 2016
                   ['16','If, T.O. in segment 16',4,4,'1',''], //nl 4
                   ['16a','If, T.O. in segment 16a',5,5,'1',''], //nl 5
                   ['16b','If, T.O. in segment 16b',6,6,'1',''], //nl 6
                   ['16c','If, T.O. in segment 16c',7,7,'1',''], //nl 7
                   ['5','If, T.O. in segment 5',8,24,'1','|9|9a|10|10a|12|12a|12b|14a|14b|'],
                   ['6','If, T.O. in segment 6',9,11,'1',''],
                   ['7','If, T.O. in segment 7',10,11,'1',''],
                   ['8','If, T.O. in segment 8',11,11,'1',''],//8
                   ['9','If, T.O. in segment 9',12,12,'1',''],
                   ['9a','If, T.O. in segment 9a',13,13,'1',''],
                   ['10','If, T.O. in segment 10',14,14,'1',''],
                   ['10a','If, T.O. in segment 10a',15,15,'1',''],
                   ['11','If, T.O. in segment 11',16,24,'1','|12|12a|12b|14a|14b|'],
                   ['12','If, T.O. in segment 12',17,17,'1',''],
                   ['12a','If, T.O. in segment 12a',18,18,'1',''],
                   ['12b','If, T.O. in segment 12b',19,19,'1',''],
                   ['13','If, T.O. in segment 13',20,21,'1',''],
                   ['14','If, T.O. in segment 14',21,21,'1',''],
                   ['14a','If, T.O. in segment 14a',22,22,'1',''],
                   ['14b','If, T.O. in segment 14b',23,23,'1',''],
                   ['15','If, T.O. in segment 15',24,24,'1','']];//nr 15

/* First column of segment table with top hierarchy info */
var meDiffuseTableArray1stColumn = [
                           '<div class="darkred"><b>RCA</b></div>',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '<div class="darkred"><b>LM</b></div>',
               '<div class="darkred"><b>LAD</b></div>',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '<div class="darkred"><b>LCX</b></div>',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;',
               '&nbsp;'];
               
               
function q4vScore()
{
     var proxSegment=-1;
   
    var newScore = -1;
    var arrayStart=0;
    var arrayEnd=0;
    var showme;
    var number;
    var showme2;
    var label;
    var segm='';
    var tmpteststring;
    var denylist='';
    var activeSegment;
    var MainSegment=[];
    MainSegment["1"]="1";
    MainSegment["2"]="1";
    MainSegment["3"]="1";
    MainSegment["4"]="1";
    MainSegment["16"]="1";
    MainSegment["16a"]="1";
    MainSegment["16b"]="1";
    MainSegment["16c"]="1";
    MainSegment["5"]="5";
    MainSegment["6"]="6";
    MainSegment["7"]="6";
    MainSegment["8"]="6";
    MainSegment["9"]="6";
    MainSegment["9a"]="6";
    MainSegment["10"]="6";
    MainSegment["10a"]="6";
    MainSegment["11"]="6";
    MainSegment["12"]="11";
    MainSegment["12a"]="11";
    MainSegment["12b"]="11";
    MainSegment["13"]="6";
    MainSegment["14"]="6";
    MainSegment["14a"]="11";
    MainSegment["14b"]="11";
    MainSegment["15"]="11";
     // alert('123');
    number=$('input[name=q4i]:checked').val();
    activeSegment=$('input[name=q4v]:checked').val();
    meDominance='<?php echo $dominance;?>';
   // alert('number:'+number);
   //  alert('activeSegment:'+activeSegment);
    //  alert('meDominance:'+meDominance);
    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
    showme=meSegmentVisualizedTableHelp[i][4];
    segm=meSegmentVisualizedTableHelp[i][0];
    denylist=parent.meSegmentVisualizedTableHelp[i][5];
   // alert('segm:'+segm);
   // alert('MainSegment[activeSegment]:'+MainSegment[activeSegment]);
    //if (segm==meVisualizedByMainSegment[meCurrentLesion])
    if (segm==number)
    {
        // FOUND CORRECT SEGMENT
        arrayStart=parseInt(meSegmentVisualizedTableHelp[i][2]);
        arrayEnd=parseInt(meSegmentVisualizedTableHelp[i][3]);
        break;
    }
    }

    if (showme=='1')
    {

    for (var j = arrayStart;j <= arrayEnd; j++)
    {
        number=meDiffuseTableArray[j][1];
        showme2=meDiffuseTableArray[j][2];

        if ((showme2=='1') && (denylist!=''))
        {
        //check if not in deny list
        tmpteststring='|' + number + '|';
        if (denylist.indexOf(tmpteststring)!=-1)
        {
            showme2='0';
        }
        }

        if (showme2=='1')
        {
        // adaption 2011-03-13. Special case for T.O. 5
        //if( proxSegment == '5' ) {
            if( number == '5' ) {
            newScore=calculateQ4V_TO5(activeSegment);
            break;
        }
                    if ( activeSegment == 16 && number == 1 ) {
                    newScore = 2;
                    break;
                }
                    if ( activeSegment == "none" && number == 1 && meDominance == 'R') {
                    newScore = 3;
                    break;
                }
                    if ( activeSegment == 4 && number == 1 ) {
                    newScore = 2;
                    break;
                }               
                    if ( activeSegment == "none" && number == 2 && meDominance == 'R') {
                    newScore = 2;
                    break;
                }
                    if ( activeSegment == 16 && number == 2 ) {
                    newScore = 1;
                    break;
                }
                    if ( activeSegment == 4 && number == 2 ) {
                    newScore = 1;
                    break;
                }                               
                    if ( activeSegment == 16 && number == 3 ) {
                    newScore = 0;
                    break;
                }
                    if ( activeSegment == "none" && number == 3 ) {
                    newScore = 1;
                    break;
                }               
                    if ( activeSegment == 16 && number == 4 ) {
                    newScore = 0;
                    break;
                }               
                    if ( activeSegment == 4 && number == 4 ) {
                    newScore = 0;
                    break;
                }
                    if ( activeSegment == "none" && number == 4 ) {
                    newScore = 0;
                    break;
                }   
        else {
            // adaption, start assigning points AFTER activeSegment + 1
            if ( number != activeSegment ){
             //   && (number=="5" && activeSegment!='9' && activeSegment!='9a' && activeSegment!='10' && activeSegment!='10a' && activeSegment!='12' && activeSegment!='12a' && activeSegment!='12b' && activeSegment!='14a' && activeSegment!='14b')) {
            newScore=newScore+1;
            }
            else {
            break;
            }
        }
        }
    }
    }

    // newScore has been initialized at -1 because we do not
    // want to assign point to the segment after 
    if( newScore == -1 )
    newScore = 0;
   // alert('GGGGGGGGGGGGGGGG');
 //  alert('newScore:'+newScore);
    return newScore;

   
}       
function calculateQ4V_TO5(activeSegment){
    var score = 0;
   
    var meDominance='<?php echo $dominance;?>';
    if( meDominance == 'L' ){
    switch( activeSegment ) {
      case "7"    : score=1; break;
      case "8"    : score=2; break;
      case "13"   : score=1; break;
      case "14"   : score=2; break;
      case "15"   : score=3; break;
          case "none" : score=4; break;
      default     : score=0;
    }
    }
    else {
    switch( activeSegment ) {
      case "7"    : score=1; break;
      case "8"    : score=2; break;
      case "13"   : score=1; break;
      case "14"   : score=2; break;
          case "none" : score=3; break;
      default     : score=0;
    }
    }
    
    return score;
}        

  function buildQ4VTable(s){
      var htmlStr="";
      var startIndex=0;
      var endIndex=0;
      var Q4Segment=[
      "1",
      "2",
      "3",
      "4",
      "16",
      "16a",
      "16b",
      "16c",
      "5",
      "6",
      "7",
      "8",
      "9",
      "9a",
      "10",
      "10a",
      "11",
      "12",
      "12a",
      "12b",
      "13",
      "14",
      "14a",
      "14b",
      "15"
      ];
      switch(s){
          case "1":
          startIndex=0;
          endIndex=4;
          break;
          case "2":
          startIndex=1;
          endIndex=4;
          break;
          case "3":
          startIndex=2;
          endIndex=4;
          break;
          case "4":
          startIndex=3;
          endIndex=4;
          break;
          case "16":
          startIndex=4;
          endIndex=4;
          break;
          case "16a":
          startIndex=5;
          endIndex=5;
          break;
          case "16b":
          startIndex=6;
          endIndex=6;
          break;
          case "16c":
          startIndex=7;
          endIndex=7;
          break;
          case "5":
          startIndex=8;
          endIndex=24;
          break;
          case "6":
          startIndex=9;
          endIndex=11;
          break;
          case "7":
          startIndex=10;
          endIndex=11;
          break;
          case "8":
          startIndex=11;
          endIndex=11;
          break;
          case "9":
          startIndex=12;
          endIndex=12;
          break;
          case "9a":
          startIndex=13;
          endIndex=13;
          break;
          case "10":
          startIndex=14;
          endIndex=14;
          break;
          case "10a":
          startIndex=15;
          endIndex=15;
          break;
          case "11":
          startIndex=16;
          endIndex=24;
          break;
          case "12":
          startIndex=17;
          endIndex=17;
          break;
          case "12a":
          startIndex=18;
          endIndex=18;
          break;
          case "12b":
          startIndex=19;
          endIndex=19;
          break;
          case "13":
          startIndex=20;
          endIndex=21;
          break;
          case "14":
          startIndex=21;
          endIndex=21;
          break;
           case "14a":
           startIndex=22;
          endIndex=22;
          break;
           case "14b":
           startIndex=23;
          endIndex=23;
          break;
           case "15":
           startIndex=24;
          endIndex=24;
          break;
      }
      
       var j=0;
                htmlStr+='<table cellspacing="0" cellpadding="0" border="0" class="selecttable">';
                htmlStr+='<tr>';
                htmlStr+='<td></td>';     
                htmlStr+='<td>Segment numbers:</td>';
                htmlStr+='<td>Segment visualized <br/>by contrast:</td>';
                htmlStr+='</tr>';
                htmlStr+='<tr style="padding : 2px 8px;line-height : 15px;">';
                htmlStr+='<td style="padding : 2px 8px;line-height : 15px;"></td>';     
                htmlStr+='<td style="padding : 2px 8px;line-height : 15px;">none</td>';
                htmlStr+='<td style="padding : 2px 8px;line-height : 15px;"><input type="radio" name="q4v" value="none"  onclick="chkProcess(\'4v\');"></td>';
                htmlStr+='</tr>';
          for(i=startIndex;i<=endIndex;i++){
              if((s=="5" && (Q4Segment[i]=="9" || Q4Segment[i]=="9a" || Q4Segment[i]=="10" || Q4Segment[i]=="10a" || Q4Segment[i]=="12" || Q4Segment[i]=="12a" || Q4Segment[i]=="12b" || Q4Segment[i]=="14a" || Q4Segment[i]=="14b"))
               || (s=="11" && (Q4Segment[i]=="12" || Q4Segment[i]=="12a" || Q4Segment[i]=="12b" || Q4Segment[i]=="14a" || Q4Segment[i]=="14b"))
               || (s=="4" && (Q4Segment[i]=="4" || Q4Segment[i]=="16")))
               {
                   
               } else {
                htmlStr+='<tr  style="padding : 2px 8px;line-height : 15px;">';
                if(j==0)
                htmlStr+='<td style="padding : 2px 8px;line-height : 15px;">If, T.O. in segment '+s+'</td>';
                else
           htmlStr+='<td style="padding : 2px 8px;line-height : 15px;"></td>';     
                htmlStr+='<td style="padding : 2px 8px;line-height : 15px;">'+Q4Segment[i]+'</td>';
                htmlStr+='<td style="padding : 2px 8px;line-height : 15px;"><input type="radio" name="q4v" value="'+Q4Segment[i]+'"  onclick="chkProcess(\'4v\');"></td>';
                htmlStr+='</tr>';
                j++;
                }
          }
           htmlStr+='</table>';
          $('#Q4SegmentCount').val(j);
          $('#Q4VTable').empty();
          $('#Q4VTable').html(htmlStr);
  }
     function showhideLeft(i){
         $('#leftSection').hide();
         $('#leftBlunt').hide();
         $('#leftBridge').hide();
         $('#leftSidebranch').hide();
         $('#leftMidina').hide();
         $('#leftBifurcation').hide();
         
          $('#'+i).show();
     }
     
  function calDelete(){
    if(confirm('Press confirm to delete this data?')){
           if($( "#deleteID" ).val()!=""){
        $( "#delForm" ).submit();
        preventDefault();
        }
    }
 }
   function calModify(){
       if($( "#modifyID" ).val()!=""){
         $( "#modifyForm" ).submit();
        preventDefault();
        }
   }
   

</script>

</body>

</html> 