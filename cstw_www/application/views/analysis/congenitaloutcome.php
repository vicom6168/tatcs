<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
$title[0]='total congenital  <br/>open heart  <br/>surgery';
$title[1]='Ventricular  <br/>Septal Defect';
$title[2]='Tetralogy of  <br/>Fallot';
$title[3]='Transposition of  <br/>the Great Arteries <br/> with intact  <br/>Ventricular  <br/>Septum';
$title[4]='Transposition of  <br/>the Great Arteries <br/> with Ventricular  <br/>Septum Defect';
$title[5]='Coarctation  <br/>of the Aorta';
$title[6]='Superior Caval  <br/>to Pulmonary  <br/>Artery  <br/>Anastomosis';
$title[7]='Compete Caval  <br/>to Pulmonary Artery <br/> Anastomosis';
$title[8]='Truncus  <br/>Arteriosus';
$title[9]='Hypoplastic  <br/>Left Heart <br/>Syndrome';
$title[10]='Total Anomalous  <br/>Pulmonary Venous  <br/>Connection';
$title[11]='Partial Anomalous  <br/>Pulmonary Venous <br/> Connection';
$title[12]='Atrioventricular  <br/>Septal Defect';
$title[13]='Interrupted  <br/>Aortic Arch';
$title[14]='Ebstein <br/>Malformation';
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>7. Congenital Outcome</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/congenitaloutcome" method="post">
                <div class="content">
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
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>Operative <br/>Mortality</th>
                               <th nowrap>Bleeding,  <br/>requiring  <br/>reoperation </th>
                               <th nowrap>Neurological  <br/>deficit </th>
                               <th nowrap>Renal  <br/>failure  </th>
                               <th nowrap>Wound infection <br/> Mediastinitis </th>
                              <th nowrap>Mechanical  <br/>circulatory  <br/>support</th>
                               <th nowrap>mechanical  <br/>ventilatory  <br/>support > 7 days</th>
                               <th nowrap>Sepsis</th>
                               <th nowrap>完成率</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                               <?php for($j=0;$j<15;$j++) { ?>
                                <td><?php echo $j+1;?></th>
                                <td><?php echo $title[$j];?></th>
                                   <?php for($i=0;$i<9;$i++) { ?>
                                      <td> <label><?php echo ($ans[$j][0]==0?"-":round($ans[$j][$i+1]*100/$ans[$j][0],2));?>%</label> <br/>
                             (<a class="various" data-fancybox-type="iframe" href="/Analysis/childList/<?php echo $j;?>/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[$j][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/childList/<?php echo $j;?>/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[$j][0];?></a>)</th>
                                
                                  <?php } ?>
                               
                            </tr> 
                        <?php } ?>
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="" && 1==2) { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDF/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCEL/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
                  </div>
                  <?php } ?>
             
                <br/>
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