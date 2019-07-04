<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>10. Urgency and Euroscore II </h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/urgency" method="post">
                <div class="content">
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢月份：</label>
                 <div class="linewithoutindention">
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=$this->config->item('openheartYear');$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qYear) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="qMonth" id="qMonth" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qMonth) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月~
                                   <select name="qYearEnd" id="qYearEnd" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=$this->config->item('openheartYear');$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qYearEnd) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="qMonthEnd" id="qMonthEnd" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qMonthEnd) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                         
             </div>
                   
                    
                    <br/>   
                     <div class="lineheader">
                            <label>Urgency</label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>elective</th>
                                <th nowrap>urgent</th>
                                <th nowrap>emergency</th>
                                <th nowrap>salvage</th>
                                <th nowrap>unknown</th>
                                <th nowrap>total</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td><?php echo $a1;?></th>
                                <td><?php echo $a2;?></td>
                               <td><?php echo $a3;?></td>
                               <td><?php echo $a4;?></td>
                               <td><?php echo $a5;?></td>
                               <td><?php echo $a1+$a2+$a3+$a4+$a5;?></td>
                            </tr> 
                          <tr> 
                                <td><?php echo ($a1=='0'?'0':round($a1*100/($a1+$a2+$a3+$a4+$a5),2));?>%</th>
                                <td><?php echo ($a2=='0'?'0':round($a2*100/($a1+$a2+$a3+$a4+$a5),2));?>%</td>
                               <td><?php echo ($a3=='0'?'0':round($a3*100/($a1+$a2+$a3+$a4+$a5),2));?>%</td>
                               <td><?php echo ($a4=='0'?'0':round($a4*100/($a1+$a2+$a3+$a4+$a5),2));?>%</td>
                               <td><?php echo ($a5=='0'?'0':round($a5*100/($a1+$a2+$a3+$a4+$a5),2));?>%</td>
                               <td><?php echo ($a1+$a2+$a3+$a4+$a5=='0'?'0':round(($a1+$a2+$a3+$a4+$a5)*100/($a1+$a2+$a3+$a4+$a5),2));?>%</td>
                            </tr> 
                        
                              
                        </tbody> 
                    </table>
                    <br/><br/>
                     <div class="lineheader">
                            <label>Euroscore II</label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>小於等於5</th>
                                <th nowrap>大於5,且小於等於10</th>
                                <th nowrap>大於10,且小於等於20</th>
                                <th nowrap>大於20</th>
                                <th nowrap>unknown</th>
                                <th nowrap>total</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qYearEnd!="") { ?>
                              <tr> 
                                <td><a class="various" data-fancybox-type="iframe" href="<?php echo base_url(); ?>analysis/euroscore20/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/1"><?php echo $b1;?></a></th>
                                <td><a class="various" data-fancybox-type="iframe" href="<?php echo base_url(); ?>analysis/euroscore20/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/2"><?php echo $b2;?></a></td>
                               <td><a class="various" data-fancybox-type="iframe" href="<?php echo base_url(); ?>analysis/euroscore20/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/3"><?php echo $b3;?></a></td>
                               <td><a class="various" data-fancybox-type="iframe" href="<?php echo base_url(); ?>analysis/euroscore20/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/4"><?php echo $b4;?></a></td>
                               <td><a class="various" data-fancybox-type="iframe" href="<?php echo base_url(); ?>analysis/euroscore20/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/5"><?php echo $b5;?></a></td>
                               
                               <td><?php echo $b1+$b2+$b3+$b4+$b5;?></td>
                            </tr> 
                            <?php } else { ?>
                          <tr> 
                                <td><?php echo $b1;?></th>
                                <td><?php echo $b2;?></td>
                               <td><?php echo $b3;?></td>
                               <td><?php echo $b4;?></td>
                               <td><?php echo $b5;?></td>
                               <td><?php echo $b1+$b2+$b3+$b4+$b5;?></td>
                            </tr> 
                             <?php } ?>
                          <tr> 
                                <td><?php echo ($b1=='0'?'0':round($b1*100/($b1+$b2+$b3+$b4+$b5),2));?>%</th>
                                <td><?php echo ($b2=='0'?'0':round($b2*100/($b1+$b2+$b3+$b4+$b5),2));?>%</td>
                               <td><?php echo ($b3=='0'?'0':round($b3*100/($b1+$b2+$b3+$b4+$b5),2));?>%</td>
                               <td><?php echo ($b4=='0'?'0':round($b4*100/($b1+$b2+$b3+$b4+$b5),2));?>%</td>
                               <td><?php echo ($b4=='0'?'0':round($b5*100/($b1+$b2+$b3+$b4+$b5),2));?>%</td>
                               <td><?php echo ($b1+$b2+$b3+$b4+$b5=='0'?'0':round(($b1+$b2+$b3+$b4+$b5)*100/($b1+$b2+$b3+$b4+$b5),2));?>%</td>
                            </tr> 
                        
                              
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="" && 1==2) { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFchild/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELchild/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
                  </div>
                  <?php } ?>
             
                <br/>
            </div>
        </div>
        </div>
            <div class="small">
           
             <div class="box">
                <div class="title">
                    <h2></h2>
                    <span class="hide"></span>
                </div>
                <div class="content">
                   <?php $this->load->view("analysis/menu");?>  
                </div>
            </div>
          
        
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
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