<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="long">
            <div class="box">
                <div class="title">
                    <h2>2. 醫師手術報表</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/doctoroperation" method="post">
                <div class="content">
                      <div class="linewithoutindention">
                            <label  class="withinLargedention">手術醫師：</label>
                            <div class="linewithoutindention">
                            
                             <input type="radio" name="vsType" id="vsType_v"  value="V"  <?php if($vsType=="V") echo "checked";?>><label for="vsType_v">主治醫師&nbsp;&nbsp;</label>  &nbsp; 
                             <input type="radio" name="vsType" id="vsType_r"  value="R"  <?php if($vsType=="R") echo "checked";?>><label for="vsType_r">住院醫師&nbsp;&nbsp;</label>  &nbsp; 
                              <select name="patientSurgeon" id="patientSurgeon"  class="small">
                                   <option value=""></option>
                                      <?php 
                            foreach($vsList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->vsID;?>" <?php if($row->vsID==$vsID) echo "selected";?>><?php echo $row->vsName;?></option>
                                     <?php } ?>
                               </select><br/>
                        </div>
                        </div>
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
                    
                      <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                                <th nowrap>Chart Number</th>
                               <th nowrap>Name</th>
                                <th nowrap>Birthday</th>
                               
                                <th nowrap>Gender</th>
                                <th nowrap>Operation Date</th>
                                <th nowrap>Diagnosis</th>
                                <th nowrap>Procedure</th>
                                <th nowrap>Surgeon</th>
                             
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            if($patientList!=""){
                            foreach($patientList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo $row->patientChartNumber;?></td>
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo $row->patientName;?></td>
                              <td style="padding : 2px 8px;line-height : 15px;"><?php echo str_replace('0000-00-00', '', $row->patientBirthday);?></td>
                                
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo $row->patientGender;?></td>
                                 <td style="padding : 2px 8px;line-height : 15px;"><?php echo str_replace('0000-00-00', '', $row->patientOpDate);?></td>
                               
                            <td style="padding : 2px 8px;line-height : 15px;"><?php 
                            echo $row->Procedure1.($row->Procedure2==""?"":"<br/>".$row->Procedure2).($row->Procedure3==""?"":"<br/>".$row->Procedure3).($row->Procedure4==""?"":"<br/>".$row->Procedure4).($row->Procedure5==""?"":"<br/>".$row->Procedure5);
                           //echo $row->patientSurgeon;
                            ?></td>
                            <td style="padding : 2px 8px;line-height : 15px;"><?php 
                            echo $row->Diagnosis1.($row->Diagnosis2==""?"":"<br/>".$row->Diagnosis2).($row->Diagnosis3==""?"":"<br/>".$row->Diagnosis3).($row->Diagnosis4==""?"":"<br/>".$row->Diagnosis4).($row->Diagnosis5==""?"":"<br/>".$row->Diagnosis5);
                           //echo $row->patientSurgeon;
                            ?></td>
                                  <td style="padding : 2px 8px;line-height : 15px;"><?php 
                            echo $row->patientSurgeon.($row->patientSurgeon2==""?"":"<br/>".$row->patientSurgeon2).($row->patientSurgeon3==""?"":"<br/>".$row->patientSurgeon3).($row->patientSurgeon4==""?"":"<br/>".$row->patientSurgeon4).($row->patientSurgeon5==""?"":"<br/>".$row->patientSurgeon5);
                           //echo $row->patientSurgeon;
                            ?></td>
                            </tr>
                            <?php } } ?>
                               
                        </tbody> 
                    </table>
                    
                  
                </div>
                </form>
                <?php if(1==2 && $qYear!="" && $qMonth!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFnonopenheart/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELnonopenheart/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
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
 });    
 </script>
</html> 