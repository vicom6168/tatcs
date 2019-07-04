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
$s=$segment->row() ;
foreach($segment->result() as $row){
    if($c->SyntaxScoreDominance=="R")
   $Real_array[$row->syntaxScoreSegment]=$row->syntaxScoreFactorRight;
  else
   $Real_array[$row->syntaxScoreSegment]=$row->syntaxScoreFactorLeft;
}

//$score=$myScore->row();
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
                                         <td><img src="<?php echo $genderImage[$c->patientGender];?>"</td>
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
                    <h2>  Dominance: <?php echo ($c->SyntaxScoreDominance=="R"?"right":"left");?>   Current lesion: <?php echo $LesionsID;?>/<?php echo $TotalLesion;?></h2>
                </div>
                
              
          
   <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
 
    <tr>
        <td style="height:392px;width:300px;text-align:center;vertical-align: top">
            <div style="margin-top: 20px">
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
                                <td style="padding : 2px 8px;line-height : 20px;width:80px"  bgcolor="#81bbd5">
                                       
                                       <?php     if($scorerow->{'q'.$row->syntaxScoreSegment}=="1") echo "V"; else echo ""; ?>
                                  <?php      } ?>
                                    </td>
                                    
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                
</div>
            
        </td>
        <td style="height:392px;width:350px;text-align:left;vertical-align: top">
            <!-- Segment Content -->
                     <div class="darkred" id="title"><b>SYNTAX Score I</u></b></div>
                     
                  
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
                           <input type="hidden" name="LesionsID" id="LesionsID" class="small" value="<?php echo $LesionsID;?>" />
                           <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $c->SyntaxScoreDominance;?>" />
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
                                 <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $c->SyntaxScoreDominance;?>" />
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