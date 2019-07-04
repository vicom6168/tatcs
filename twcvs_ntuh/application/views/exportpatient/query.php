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
                    <h2>病患資料匯出</h2>
                    
                </div>
             
                <div class="content">
                      <?php if($this->session->userdata('P3')=="Y" ) { ?>
                          <div   style="text-align:right;">
                           <button  class="orange medium" onclick="javascript: window.location='<?php echo base_url(); ?>exportPatient/inFile';"><span>匯入病患資料</span></button>
                          </div>
                           <?php } ?>
                        <form action="<?php echo base_url(); ?>exportPatient/index" method="post">
                    <div class="linewithoutindention">
                            <label  class="withinLargedention">醫院：</label>
                   
                                <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="patientHospital" id="patientHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>" <?php if($h1==$HList[$i]['hospitalName']) echo "selected";?>><?php echo $HList[$i]['hospitalName'] ;?></option>
                                   <?php } ?>
                                   </select>
                      </div>
                
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢期間：</label>
                      <input type="text" name="qDate1" id="qDate1" class="small" value="<?php echo $d1;?>" />~
                      <input type="text" name="qDate2" id="qDate2" class="small" value="<?php echo $d2;?>" />
                      
                      
                     
                      </div>
                      <br/><br/>
                       <div class="linewithoutindention" style="vertical-align:bottom;">
                            <label  class="withinLargedention">版本選擇：
                                </label>
                           <?php if($p1=='Y' || $p2=='Y' || $p3=='Y' || $p4=='Y' || $p5=='Y' || $this->session->userdata('userRole')=="2" || $this->session->userdata('userRole')=="3") { ?>
                           <?php if($p1=='Y') { ?>
                            <label for="version1">完整版  &nbsp; &nbsp;</label> 
                            <input type="radio" class="checkbox" name="dataversion" id="version1"  <?php if($v=='1') echo "checked";?>  value="1">
                          <?php } ?>
                          <?php if($p2=='Y') { ?>
                            <label for="version2">精簡版  &nbsp; &nbsp;</label> 
                            <input type="radio" class="checkbox" name="dataversion" id="version2" <?php if($v=='2') echo "checked";?>  value="2">
                           <?php } ?>
                           <?php if($p3=='Y') { ?>
                           <label for="version3">手術內容版本  &nbsp; &nbsp;</label> 
                            <input type="radio" class="checkbox" name="dataversion" id="version3" <?php if($v=='3') echo "checked";?>  value="3">
                           <?php } ?>
                           <?php if($p4=='Y') { ?>
                           <label for="version4">手術風險版本  &nbsp; &nbsp;</label> 
                            <input type="radio" class="checkbox" name="dataversion" id="version4" <?php if($v=='4') echo "checked";?>  value="4">
                           <?php } ?>
                           <?php if($p5=='Y') { ?>
                               <label for="version5">匿名完整版  &nbsp; &nbsp;</label> 
                           <input type="radio" class="checkbox" name="dataversion" id="version5" <?php if($v=='5') echo "checked";?>  value="5">
                          <?php } ?>
                            <?php if($this->session->userdata('userRole')=="2" || $this->session->userdata('userRole')=="3") { ?>
                               <label for="version6">醫師手術版  &nbsp; &nbsp;</label> 
                           <input type="radio" class="checkbox" name="dataversion" id="version6" <?php if($v=='6') echo "checked";?>  value="6">
                          <?php } ?>
                                           
                          <?php } else { ?>
                            
                            <font color=red>  您未被授權匯出病患資料, 請洽系統管理者</font>
                           <?php } ?>
                          
                      </div>
                      <br/><br/>
                            <div class="linewithoutindention" style="vertical-align:bottom;">
                            <label  class="withinLargedention">資料型態：</label>
                       
                            <label for="datatype1">Adult  &nbsp; &nbsp;</label> 
                            <input type="checkbox" class="checkbox" name="datatype1" id="datatype1"  <?php if($t1=='Y') echo "checked";?>  value="Y">
                            <label for="datatype2">Congenital  &nbsp; &nbsp;</label> 
                            <input type="checkbox" class="checkbox" name="datatype2" id="datatype2" <?php if($t2=='Y') echo "checked";?>  value="Y">
                            <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                             <button  class="green medium" onclick="javascript: alert('功能開發中');"  style="vertical-align: bottom;"><span>自訂欄位查詢</span></button>
                             
                        
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
                             if($patientList!=null){
                            $i=0;
                            $j=0;
                            foreach($patientList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->patientHospital;?></td>
                                <td><?php echo $row->patientChartNumber;?></td>
                                <td><?php echo mb_substr_replace($row->patientName,'O',1,1);?></td>
                                <td><?php echo $row->patientBirthday;?></td>
                                 <td><?php echo $row->patientAge;?></td>
                                <td><?php echo $row->patientGender;?></td>
                                <td><?php echo $row->patientOpDate;?></td>
                            
                               
                            </tr>
                            <?php } } ?>
                              
                        </tbody> 
                    </table>
                     </form>
               
               
           <?php if( $d1!='' &&  $d2!=''){ ?>
             <div class="line">
                 <?php if( $v!='6'){ ?>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>exportPatient/EXCEL/<?php echo $d1;?>/<?php echo $d2;?>/<?php echo urlencode($h1);?>/<?php echo $t1;?>/<?php echo $t2;?>/<?php echo $t3;?>/<?php echo $v;?>','_blank')"><span>EXCEL</span></button>
                 <?php } else { ?>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>exportPatient/EXCELResident/<?php echo $d1;?>/<?php echo $d2;?>/<?php echo urlencode($h1);?>/<?php echo $t1;?>/<?php echo $t2;?>/<?php echo $t3;?>/<?php echo $v;?>','_blank')"><span>EXCEL</span></button>
                 <?php } ?>
                  </div>
             <?php } ?>
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