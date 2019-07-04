<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <script type="text/javascript" src="<?php echo base_url(); ?>js/syntaxscore.js"></script>
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
                    <h2>Syntax Score: select Dominance</h2>
                </div>
                
              
                  
   <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="height:41px;width:300px;text-align:right;padding-left:0px;padding-right:5px;padding-top:20;"><img src="<?php echo base_url(); ?>images/titleselect.gif" border="0" alt="Select dominance"></td>
        <td style="height:41px;width:300px;text-align:left;padding-left:5px;padding-right:0px;padding-top:20;"><img src="<?php echo base_url(); ?>images/titleselect2.gif" border="0" alt="Select dominance"></td>
    </tr>
    <tr>
        <td style="height:392px;width:300px;text-align:center;"><a href="<?php echo base_url(); ?>syntaxscoreII/step1/<?php echo $c->patientID;?>/L"><img src="<?php echo base_url(); ?>images/lefts.png" border="0" alt="Left"></a></td>
        <td style="height:392px;width:300px;text-align:center;"><a href="<?php echo base_url(); ?>syntaxscoreII/step1/<?php echo $c->patientID;?>/R"><img src="<?php echo base_url(); ?>images/rights.png" border="0" alt="Right"></a></td>
        </tr>
        <tr>
          <td colspan="2" style="height:40px;width:600px;text-align:center;" bgcolor="#F4F004">
              SYNTAX score 教學網頁：<br/>
              <a href="http://www.syntaxscore.com/index.php/tutorial/definitions" target="_blank">http://www.syntaxscore.com/index.php/tutorial/definitions</a>
              <input type="hidden" id="PATIENTNUMBER" value="<?php echo $c->patientID;?>">
              </td>
          </tr>
</table>
               
            
            </div>
        </div>

 
     
     
        </div>
      
       
  
  
 <?php $this->load->view("footer");?>  
    
</div>


</body>

</html> 