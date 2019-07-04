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
 ?>
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score: select Dominance</h2>
                </div>
                
              
                  
                         <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="height:41px;width:300px;text-align:right;padding-left:0px;padding-right:5px;padding-top:20;"><img src="<?php echo base_url(); ?>images/titleselect.gif" border="0" alt="Select dominance"></td>
        <td style="height:41px;width:300px;text-align:left;padding-left:5px;padding-right:0px;padding-top:20;"><img src="<?php echo base_url(); ?>images/titleselect2.gif" border="0" alt="Select dominance"></td>
    </tr>
    <tr>
        <td style="height:392px;width:300px;text-align:center;"><a href="javascript:setDominance('left');callHideShow('divSyntaxScorecontent');"><img src="<?php echo base_url(); ?>images/lefts.png" border="0" alt="Left"></a></td>
        <td style="height:392px;width:300px;text-align:center;"><a href="javascript:setDominance('right');callHideShow('divSyntaxScorecontent');"><img src="<?php echo base_url(); ?>images/rights.png" border="0" alt="Right"></a></td>
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

     
       <div class="box" id="divSyntaxScorecontent">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score</h2>
                </div>
                
              
                
                      
                    
                 <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="height:41px;width:200px;text-align:right;padding-left:0px;padding-right:10px;">
            <div id="L" ></div>
            
        </td>
        <td style="height:41px;width:400px;text-align:left;padding-left:10px;padding-right:0px;">
            <div id="R" ></div>
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
  
   callHideShow('divPatientProfiles');
   
   NextLesion();
   
 
 });    

 function callHideShow(t){
  

   $('#divPatientProfiles').hide();
    $('#divSyntaxScorecontent').hide();
    
     if(t=='divPatientProfiles' || t=='divSyntaxScorecontent')
      $('#'+t).show();
     
     if(t=="divSyntaxScorecontent"){
         //alert(meDominance);
          if (meDominance=='left')
         {
            $('#L').html($("#leftimagepage").html());
          }  else if (meDominance=='right')
          {
            $('#L').html($("#rightimagepage").html());
          }
        // $('#L').html($("#leftimagepage").html());
         $('#R').html($("#leftleisionselectpage").html());
         buildTableSingleLesion();
        
          $('#divSyntaxScorecontent').show();
     } else if(t=="divSyntaxScoreSecond"){
        $('#L').html($("#leftleisionpage").html());
         $('#R').html($("#leftsecond").html());
       buildDiffuseSegmentTable();
      ShowDominance();
      buildTable();
       buildSegmentTable();
       buildSegmentVisualizTableNew();
       $('#divSyntaxScorecontent').show();
     } else if(t=='divSyntaxScoreProcess'){
         $('#R').html($("#processpage").html());
         $('#divSyntaxScorecontent').show();
     } else if(t=='divSyntaxScoreQ12'){
         $('#R').html($("#question12page").html());
         $('#divSyntaxScorecontent').show();
     } else if(t=='divSyntaxScoreOverView'){
         $('#R').html($("#scoreviewpage").html());
         $('#divSyntaxScorecontent').show();
     }
     
 }
</script>

<div id="leftimagepage" style="display:none;"><?php $this->load->view("syntaxscore/leftmain",$patientData);?></div>
<div id="rightimagepage" style="display:none;"><?php $this->load->view("syntaxscore/rightmain",$patientData);?></div>
<div id="leftleisionselectpage" style="display:none;"><?php $this->load->view("syntaxscore/leftmaincontent",$patientData);?></div>
<div id="leftleisionpage" style="display:none;"><?php $this->load->view("syntaxscore/leftsecond",$patientData);?></div>
<div id="leftsecond"  style="display:none;"><?php $this->load->view("syntaxscore/leftsecondcontent",$patientData);?></div>
<div id="processpage" style="display:none;"><?php $this->load->view("syntaxscore/process",$patientData);?></div>
<div id="question12page" style="display:none;"> <?php $this->load->view("syntaxscore/question12",$patientData);?></div>
<div id="scoreviewpage" style="display:none;"> <?php $this->load->view("syntaxscore/scoreoverview",$patientData);?></div>
<div id="q4iiPage" style="display:none;"> <?php $this->load->view("syntaxscore/q4ii",$patientData);?></div>
<div id="q4iiiPage" style="display:none;"> <?php $this->load->view("syntaxscore/q4iii",$patientData);?></div>
<div id="q4branch" style="display:none;"> <?php $this->load->view("syntaxscore/q4branch",$patientData);?></div>

</body>

</html> 