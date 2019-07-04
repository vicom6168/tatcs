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
                    <h2>5. Executive summary of Congenital surgery</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/executivesummarynonopenheart" method="post">
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
                                <td>Endovascular approach great vessel surgery</td>
                               <td><?php echo $a1;?></td>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>Central venous surgery</td>
                               <td><?php echo $a2;?></td>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>Supra-aortic artery surgery</th>
                               <td><?php echo $a3;?></td>
                            </tr>      
                           
                              <tr> 
                                <td>4</th>
                                <td>Surgery for visceral vessel disease</th>
                               <td><?php echo $a4;?></td>
                            </tr>      
                               <tr> 
                                <td>5</th>
                                <td>Surgery for peripheral artery disease</th>
                               <td><?php echo $a5;?></td>
                            </tr>      
                               <tr> 
                                <td>6</th>
                                <td>Surgery for peripheral venous disease</th>
                               <td><?php echo $a6;?></td>
                            </tr>      
                               <tr> 
                                <td>7</th>
                                <td>Surgery for vascular access</th>
                               <td><?php echo $a7;?></td>
                            </tr>      
                               <tr> 
                                <td>8</th>
                                <td>ECMO implantation</th>
                               <td><?php echo $a8;?></td>
                            </tr>      
                               <tr> 
                                <td>9</th>
                                <td>Other intrathoracic surgery</th>
                               <td><?php echo $a9;?></td>
                            </tr>        
                        </tbody> 
                    </table>
                    
                  
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFnonopenheart/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELnonopenheart/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
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
 });    
 </script>
</html> 