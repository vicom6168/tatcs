<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>上傳學會</h2>
                    
                </div>
             
                <div class="content">
                        <form action="<?php echo base_url(); ?>upload/index" method="post">
                    <div class="linewithoutindention">
                            <label  class="withinLargedention">醫院：</label>
                     <select name="patientHospital" id="patientHospital">
                                   <option value=""></option>
                                   <option value="台大醫院"  <?php if($h1=='台大醫院') echo "selected";?>>台大醫院</option>
                                   <option value="台大醫院 新竹分院"  <?php if($h1=='台大醫院 新竹分院') echo "selected";?>>台大醫院 新竹分院</option>
                                   <option value="台大醫院 雲林分院"  <?php if($h1=='台大醫院 雲林分院') echo "selected";?>>台大醫院 雲林分院</option>
                                   </select>
                      </div>
                      
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢期間：</label>
                      <input type="text" name="qDate1" id="qDate1" class="small" value="<?php echo $d1;?>" />~
                      <input type="text" name="qDate2" id="qDate2" class="small" value="<?php echo $d2;?>" />
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                      </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Hospital</th>
                                <th nowrap>Chart Number</th>
                               <th nowrap>Name</th>
                                <th nowrap>Birthday</th>
                                
                                <th nowrap>Age</th>
                                <th nowrap>Gender</th>
                                <th nowrap>Operation Date</th>
                               
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($patientList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->patientHospital;?></td>
                                <td><?php echo $row->patientChartNumber;?></td>
                                <td><?php echo $row->patientName;?></td>
                                <td><?php echo $row->patientBirthday;?></td>
                                 <td><?php echo $row->patientAge;?></td>
                                <td><?php echo $row->patientGender;?></td>
                                <td><?php echo $row->patientOpDate;?></td>
                            
                               
                            </tr>
                            <?php } ?>
                              
                        </tbody> 
                    </table>
                     </form>
               
               
           
             <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>exportPatient/EXCEL/<?php echo $d1;?>/<?php echo $d2;?>/<?php echo urlencode($h1);?>','_blank')"><span>開始上傳</span></button>
                  </div>
             
                <br/> </div> </div>
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