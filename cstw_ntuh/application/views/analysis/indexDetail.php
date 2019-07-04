<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');

?>

<body>

<div class="container">   
  

    
    <div class="section">
        <div class="large">
            <div class="box">
                
                  <form action="<?php echo base_url(); ?>analysis/index" method="post">
                <div class="content">
                     <div class="linewithoutindention">
                           
                  
                         
             </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>Open</th>
                                <th nowrap>VATS/<br/>Laparoscopy</th>
                                <th nowrap>Hybrid VATS</th>
                                  <th nowrap>VATS(Single port)</th>
                                <th nowrap>VATS(Multiple port)</th>
                                <th nowrap>Robot Assisted</th>
                               <th nowrap>Total</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                              <?php 
                                         $i=0;
                            $j=0;
                            if($answer1!="") {
                            foreach($answer1->result() as $row){
                                          $j++;
                                          $pieces = explode(",", $row->sumList);
                            ?>
                          <tr> 
                              <td><?php echo $j;?></th>
                              <td><a class="various" data-fancybox-type="iframe" href="/Analysis/indexDetail/<?php echo $j;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $row->subject;?></a></th>
                              <td><?php echo $pieces[0];?></th>
                              <td><?php echo $pieces[1];?></th>
                              <td><?php echo $pieces[2];?></th>
                              <td><?php echo $pieces[4];?></th>
                              <td><?php echo $pieces[5];?></th>
                              <td><?php echo $pieces[3];?></th>
                              <td><?php echo $row->myTotal;?></th>
                           </tr> 
                        <?php  } } ?>
                        </tbody> 
                    </table>
                </div>
                </form>
                
            </div>
        </div>
        
           
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
 $(document).ready(function() {
  
    $( "#qDate1" ).datepicker({ dateFormat: 'yy-mm-dd'});
     $( "#qDate2" ).datepicker({ dateFormat: 'yy-mm-dd'});
 });    
 

 $(document).ready(function() {
  
    $( "#qDate1" ).datepicker({ dateFormat: 'yy-mm-dd'});
     $( "#qDate2" ).datepicker({ dateFormat: 'yy-mm-dd'});
     
      $(".various").fancybox({
        maxWidth    : 1000,
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
</html> 