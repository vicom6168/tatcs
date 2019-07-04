<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <script type="text/javascript" src="<?php echo base_url(); ?>js/syntaxscore.js"></script>
     <LINK rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/css.css">


<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 <?php $c=$myContent->row();?>
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score: select Dominance</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                     
                         <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="height:41px;width:300px;text-align:right;padding-left:0px;padding-right:5px;padding-top:20;"><img src="<?php echo base_url(); ?>images/titleselect.gif" border="0" alt="Select dominance"></td>
        <td style="height:41px;width:300px;text-align:left;padding-left:5px;padding-right:0px;padding-top:20;"><img src="<?php echo base_url(); ?>images/titleselect2.gif" border="0" alt="Select dominance"></td>
    </tr>
    <tr>
        <td style="height:392px;width:300px;text-align:center;"><a href="javascript:callHideShow('divSyntaxScoreLeft');"><img src="<?php echo base_url(); ?>images/lefts.png" border="0" alt="Left"></a></td>
        <td style="height:392px;width:300px;text-align:center;"><a href="javascript:callHideShow('right');"><img src="<?php echo base_url(); ?>images/rights.png" border="0" alt="Right"></a></td>
</table>
               
                </form>
            </div>
        </div>

     
       <div class="box" id="divSyntaxScoreLeft">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                      
                    
                 <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="height:41px;width:200px;text-align:right;padding-left:0px;padding-right:10px;">
            <?php $this->load->view("syntaxscore/leftmain");?>
            
            
        </td>
        <td style="height:41px;width:400px;text-align:left;padding-left:10px;padding-right:0px;">
            
            <?php $this->load->view("syntaxscore/leftmaincontent");?>
        </td>
    </tr>
   
</table>
                
               
                </form>
            </div>
        </div>
     
     
      <div class="box" id="divSyntaxScoreSecond">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                      
                    
                 <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:200px;text-align:right;padding-left:0px;padding-right:10px;">
            <?php $this->load->view("syntaxscore/leftsecond");?>
            
            
        </td>
        <td style="width:400px;text-align:left;padding-left:10px;padding-right:0px;">
            
            <?php $this->load->view("syntaxscore/leftsecondcontent");?>
        </td>
    </tr>
   
</table>
                
               
                </form>
            </div>
        </div>
     
        <div class="box" id="divSyntaxScoreProcess">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                      
                    
                 <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:200px;text-align:right;padding-left:0px;padding-right:10px;">
            <?php $this->load->view("syntaxscore/leftsecond");?>
            
            
        </td>
        <td style="width:400px;text-align:left;padding-left:10px;padding-right:0px;">
            <?php $this->load->view("syntaxscore/process");?>
        </td>
    </tr>
   
</table>
                
               
                </form>
            </div>
        </div>
        
           <div class="box" id="divSyntaxScoreQ12">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                      
                    
                 <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:200px;text-align:right;padding-left:0px;padding-right:10px;">
            <?php //$this->load->view("syntaxscore/leftsecond");?>
            
            
        </td>
        <td style="width:400px;text-align:left;padding-left:10px;padding-right:0px;">
            <?php $this->load->view("syntaxscore/question12");?>
        </td>
    </tr>
   
</table>
                
               
                </form>
            </div>
        </div>
        
        
                   <div class="box" id="divSyntaxScoreOverView">
                <div class="content forms">
                <div class="title">
                    <h2>Syntax Score Overview</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                      
                    
                 <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:200px;text-align:right;padding-left:0px;padding-right:10px;">
            <?php //$this->load->view("syntaxscore/leftsecond");?>
            
            
        </td>
        <td style="width:400px;text-align:left;padding-left:10px;padding-right:0px;">
            <?php $this->load->view("syntaxscore/scoreoverview");?>
        </td>
    </tr>
   
</table>
                
               
                </form>
            </div>
        </div>
        </div>
      
       
  
  
 <?php $this->load->view("footer");?>  
    
</div>

<script>
 $(document).ready(function() {
   callHideShow('divPatientProfiles');
 });    
   
 function callHideShow(t){
     $('#divPatientProfiles').hide();
     $('#divSyntaxScoreQ12').hide();
     $('#divSyntaxScoreProcess').hide();
     $('#divSyntaxScoreSecond').hide();
     $('#divSyntaxScoreLeft').hide();
      $('#divSyntaxScoreOverView').hide();
   
     
     $('#'+t).show();
     
 }
</script>



</body>

</html> 