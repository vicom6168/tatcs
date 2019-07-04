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
                
              
    <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/edit/<?php echo $c->patientID;?>">            
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
                                       
                                       <?php     if($scorerow->{'q'.$row->syntaxScoreSegment}=="1") echo "Y"; else echo ""; ?>
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
                     
                  
             <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap></th>
                                <th nowrap>Score</th>
                             
                              
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            $subscore=0;
                            foreach($myScore->result() as $row){
                                $j++;
                                $subscore+= floatval($row->step1_Score)+floatval($row->step2_Score);
                            ?>
                            <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><font color="#C50000"><b>Lesion  <?php echo $row->LesionsID;?></b></font></td>
                              <td style="padding : 2px 8px;line-height : 20px;"></td>
                            </tr>
                            <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">segment number(s)</td>
                              <td style="padding : 2px 8px;line-height : 20px;"></td>
                            </tr>
                            <?php foreach ($Real_array as $key => $value) { ?>
                            <?php if($row->{'q'.$key}=='1'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">(segment  <?php echo $key;?>): <?php echo $value;?> X <?php echo ($row->u4i==$key?'5':'2');?> = </td>
                              <td style="padding : 2px 8px;line-height : 20px;"> <?php echo ($row->u4i==$key? (floatval($value)*5): (floatval($value)*2));?></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                              <?php if($row->u4ii=='2' || $row->u4ii=='3'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">is Age of T.O. > 3 months is  <?php echo ($row->u4ii=="1"?'No':($row->u4ii=="2"?'Yes':'Unknown'));?> </td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                            <?php } ?>
                             <?php if($row->u4iii=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">+ Blunt stump  <?php echo ($row->u4iii=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                            <?php } ?>
                            <?php if($row->u4iv=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">+ Bridging  <?php echo ($row->u4iv=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                            <?php } ?>    
                                 <?php if($row->u4v!=''){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">the first segment beyond the T.O. visualized by contrast:  <?php echo $row->u4v;?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"><?php echo $row->Q4Score;?></td>
                            </tr>
                            <?php } ?>    
                                <?php if($row->u4vi=='2' || $row->u4vi=='3' || $row->u4vi=='4'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">is Age of T.O. > 3 months is  <?php echo ($row->u4vi=="1"?'No':($row->u4vi=="2"?'Yes, all sidebranches <1.5mm':($row->u4vi=="3"?'Yes, all sidebranches >=1.5mm':'Yes, both sidebranches <1.5mm and >=1.5mm are involved')));?> </td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                            <?php } ?>
                              <?php if($row->u5=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Trifurcation  <?php echo ($row->u5i=="1"?'1 diseased segment involved':($row->u5i=="2"?'2 diseased segments involved':($row->u5i=="3"?'3 diseased segments involved':'4 diseased segments involved')));?> </td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                               <?php } ?>
                              <?php if($row->u5i=='1' || $row->u5i=='2' || $row->u5i=='3' || $row->u5i=='4'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><?php echo ($row->u5i=="1"?'1 diseased segment involved':($row->u5i=="2"?'2 diseased segments involved':($row->u5i=="3"?'3 diseased segments involved':'4 diseased segments involved')));?> </td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                            <?php } ?>
                            
                             <?php if($row->u6=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Bifurcation  <?php echo ($row->u6=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                              <?php if($row->u6i=='1' || $row->u6i=='2' || $row->u6i=='3' || $row->u6i=='4'  || $row->u6i=='5'  || $row->u6i=='6'  || $row->u6i=='7'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><?php 
                               if($row->u6i=='1')
                               echo "Medina 1,0,0";
                              else if ($row->u6i=='2')
                              echo "Medina 0,1,0";
                               else if ($row->u6i=='3')
                              echo "Medina 1,1,0";
                                else if ($row->u6i=='4')
                              echo "Medina 1,1,1";
                                 else if ($row->u6i=='5')
                              echo "Medina 0,0,1";
                                  else if ($row->u6i=='6')
                              echo "Medina 1,0,1";
                               else if ($row->u6i=='7')
                              echo "Medina 0,1,1";
                               else 
                              echo "";
                               
                              ;?> </td>
                              <td style="padding : 2px 8px;line-height : 20px;"><?php if($row->u6i=='1' || $row->u6i=='2' || $row->u6i=='3') echo  "1"; else echo "2";?></td>
                            </tr>
                            <?php } ?>
                               <?php } ?>
                                 <?php if($row->u6ii=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Bifurcation angulation (between distal main vessel and side branch) < 70º  <?php echo ($row->u6ii=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                               <?php } ?>
                                    <?php if($row->u7=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Aorto Ostial lesion  <?php echo ($row->u7=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                               <?php } ?>
                               <?php if($row->u8=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Severe Tortuosity  <?php echo ($row->u8=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 2</td>
                            </tr>
                               <?php } ?>
                                <?php if($row->u10=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Heavy calcification  <?php echo ($row->u10=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 2</td>
                            </tr>
                               <?php } ?>
                                 <?php if($row->u11=='Y'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">Thrombus  <?php echo ($row->u11=="Y"?'Yes':'No');?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                               <?php } ?>
                                  <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><i><b>Sub total lesion  <?php echo $row->LesionsID;?></b></i></td>
                              <td style="padding : 2px 8px;line-height : 20px;"><i><b><?php echo floatval($row->step1_Score)+floatval($row->step2_Score);?></b></i></td>
                            </tr>
                            <?php if($j==$myScore->num_rows() && $row->u12=="Y") { ?>
                                <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">&nbsp;</td>
                              <td style="padding : 2px 8px;line-height : 20px;">&nbsp; </td>
                            </tr>
                                  <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><font color="#C50000"><b>Diffuse disease/Small vessels</b></font></td>
                              <td style="padding : 2px 8px;line-height : 20px;"></td>
                            </tr>
                           
                                 <?php foreach ($Real_array as $key => $value) { ?>
                            <?php if($row->{'s'.$key}=='1'){ ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">segment  <?php echo $key;?></td>
                              <td style="padding : 2px 8px;line-height : 20px;"> 1</td>
                            </tr>
                            
                            <?php } ?>
                            <?php } ?>
                             <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><i><b>Sub total diffuse disease/small vessels</b></i></td>
                              <td style="padding : 2px 8px;line-height : 20px;"><i><b><?php echo floatval($row->step3_Score);?></b></i></td>
                            </tr>
                               <?php } ?>
                           <?php } ?>
                           
                                <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;">&nbsp;</td>
                              <td style="padding : 2px 8px;line-height : 20px;">&nbsp; </td>
                            </tr>
                                  <tr> 
                              <td style="padding : 2px 8px;line-height : 20px;"><font color="#C50000"><i><b>TOTAL:</b></i></font></td>
                              <td style="padding : 2px 8px;line-height : 20px;"><font color="#C50000"><i><b><?php echo floatval($row->step3_Score)+floatval($subscore);?></b></i></font></td>
                            </tr>
                           
                        </tbody> 
                    </table>
                    <div style="float: right">
                       <button type="button" class="blue medium" id="patientProfile" onclick="window.location='/patient/viewRecord/<?php echo $c->patientID;?>'"><span>Back Patient Profile</span></button>
                        <button type="button" class="blue medium" id="patientPDF" onclick="window.open('/syntaxscoreII/pdf/<?php echo $c->patientID;?>','pdf_win');"><span>Print to PDF</span></button>
                        <a class="various" data-fancybox-type="iframe" href="/syntaxscoreII/copy/<?php echo $c->patientID;?>"><button type="button" class="blue medium" id="patientCOPY"><span>Copy Text</span></button></a>
                      <button type="submit" class="orange medium" id="nextAction"><span>edit  >></span></button>
                                 <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $c->SyntaxScoreDominance;?>" />
                                 <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                                 <input type="hidden" name="segmentCount" id="segmentCount" class="small" value="0" />
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
    });
   
</script>

</body>

</html> 