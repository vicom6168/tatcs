<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>8. Executive summary of Vascular surgery</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/analysisVascularPatient" method="post">
                <div class="content">
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢月份：</label>
                 <div class="linewithoutindention">
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=$this->config->item('vascularYear');$i<=$currenYear;$i++) {?>
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
                                   <?php for($i=$this->config->item('vascularYear');$i<=$currenYear;$i++) {?>
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
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                             
                          <tr> 
                                <td>1</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/1/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Endovascular approach great vessel surgery</a>
                                    </td>
                               <td><?php echo $a1;?></td>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/2/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Central venous surgery</a></td>
                               <td><?php echo $a2;?></td>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/3/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Supra-aortic artery surgery</a></th>
                               <td><?php echo $a3;?></td>
                            </tr>      
                           
                              <tr> 
                                <td>4</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/4/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Surgery for visceral vessel disease</a></th>
                               <td><?php echo $a4;?></td>
                            </tr>      
                               <tr> 
                                <td>5</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/5/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Surgery for peripheral artery disease</a></th>
                               <td><?php echo $a5;?></td>
                            </tr>      
                               <tr> 
                                <td>6</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/6/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Surgery for peripheral venous disease</a></th>
                               <td><?php echo $a6;?></td>
                            </tr>      
                               <tr> 
                                <td>7</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/7/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">Surgery for vascular access</a></th>
                               <td><?php echo $a7;?></td>
                            </tr>      
                               <tr> 
                                <td>8</th>
                                <td><a class="various" data-fancybox-type="iframe" href="/Analysis/VascularDetail/8/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>">ECMO implantation</a></th>
                               <td><?php echo $a8;?></td>
                            </tr>      
                              <tr> 
                                <td>9</th>
                                <td>Others</th>
                               <td><?php echo $a9;?></td>
                            </tr>      
                        </tbody> 
                    </table>
                    
                  
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFVascular/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELVascular/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
                  </div>
                  <?php } ?>
             
                <br/>
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
      $(".pdf").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : true,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        type   :'iframe',
        iframe: {
preload: false // fixes issue with iframe and IE
}

 });    
  });    
 </script>
</html> 