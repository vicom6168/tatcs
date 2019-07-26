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
                    <h2>4. 住院醫師學會統計表</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/resident" method="post">
                <div class="content">
                      <div class="linewithoutindention">
                            <label  class="withinLargedention">手術醫師：</label>
                            <div class="linewithoutindention">
                               <?php echo $this->session->userdata('userRealname');?>
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
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo ($hospitalsystem=="Y"?$row->patientName: mb_substr_replace($row->patientName,'O',1,1));?></td>
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
                <?php if($qYear!="" && $qMonth!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick="window.open('<?php echo base_url(); ?>analysis/EXCELresident/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
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