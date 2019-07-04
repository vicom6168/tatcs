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
                    <h2>2. Executive summary</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/executivesummary" method="post">
                <div class="content">
                        <div class="linewithoutindention">
                             <select name="qryHospital" id="qryHospital" class="big">
                                   <option value="0">請選取醫院</option>
                                      <?php 
                            foreach($hospitalList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->hospitalName;?>" <?php if($hospital==$row->hospitalName) echo "selected";?>><?php echo $row->hospitalName;?></option>
                                     <?php } ?>
                            </select>
                            <label  class="withinLargedention">查詢月份：</label>
                    <div class="linewithoutindention">
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
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
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
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
                                <td> Overall Cardiac Surgery</td>
                               <td><?php echo $total;?></td>
                            </tr> 
                          <tr> 
                                <td>2</th>
                                <td>Adult cardiac surgery</td>
                               <td><?php echo $adult;?></td>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>Congenital cardiac surgery</td>
                               <td><?php echo $child;?></td>
                            </tr> 
                         <tr> 
                                <td>4</th>
                                <td>Non-cardiac surgery</th>
                               <td><?php echo $Noncardiac;?></td>
                            </tr>      
                            
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFsummary/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/<?php echo $hospital;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELsummary/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/<?php echo $hospital;?>','_blank')"><span>EXCEL</span></button>
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
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>統計報表</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/index/"">1. 學會分類報表</a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummary/">2. Executive Summary</a></td>
                            </tr>
                               
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummaryadult/">3. Executive summary of Adult Cardiac Surgery</a></td>
                            </tr>
                            
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarychild/">4. Executive summary of Congenital Surgery </a></td>
                            </tr>
                          
                                       <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarynonopenheart/">5. Executive summary of Non Open Heart </a></td>
                            </tr>
                            
                                <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/adultoutcome/"><span class='<?php echo ($subpage=="adultoutcome"?"currentPage":"");?>'>6. Adult Outcome </span></a></td>
                            </tr>
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/urgency/"><span class='<?php echo ($subpage=="urgency"?"currentPage":"");?>'>7. Urgency and Euroscore II </span></a></td>
                            </tr>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/casenumber/"><span class='<?php echo ($subpage=="casenumber"?"currentPage":"");?>'>8. 登錄數與上傳病歷數 </span></a></td>
                            </tr>
                        </tbody> 
                    </table>
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