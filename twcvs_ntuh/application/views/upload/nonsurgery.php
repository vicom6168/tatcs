<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");
$currenYear=Date('Y');
?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>上傳學會</h2>
                    
                </div>
             
                <div class="content">
                        <form action="<?php echo base_url(); ?>upload/nonsurgery" method="post">
                    <div class="linewithoutindention">
                            <label  class="withinLargedention">醫院：</label>
                        <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="patientHospital" id="patientHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>" <?php if("1"==$HList[$i]['hospitalName']) echo "selected";?>><?php echo $HList[$i]['hospitalName'] ;?></option>
                                   <?php } ?>
                                   </select>
                      </div>
                      
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢期間：</label>
                         <select name="y1" id="y1" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$y1) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="m1" id="m1" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$m1) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月~
                                   <select name="y2" id="y2" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$y2) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="m2" id="m2" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$m2) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                      </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Year</th>
                                <th nowrap>Month</th>
                               
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
                                <td><?php echo $row->qYear;?></td>
                                <td><?php echo $row->qMonth;?></td>
                            
                               
                            </tr>
                            <?php } ?>
                              
                        </tbody> 
                    </table>
                     </form>
               
               
           
           <?php if($y1!="" && $m1!="" && $y2!=""  && $m2!="" && $patientList->num_rows() >0) { ?>
             <div class="line">
                    <form action="<?php echo base_url(); ?>api/sendnosurgery" method="post">
                 <button type="submit" class="green medium" onclick="$(this).notify('資料上傳中, 請稍候, 謝謝','info'); "><span>開始上傳</span></button>
                 <input type="hidden" name="u1" value="<?php echo $y1;?>">
                  <input type="hidden" name="u2" value="<?php echo $m1;?>">
                  <input type="hidden" name="u3" value="<?php echo $y2;?>">
                  <input type="hidden" name="u4" value="<?php echo $m2;?>">
                  </form>
               </div>
               <?php } ?>
             
                <br/> </div> </div>
       </div>
        <div class="small">
          
             <div class="box">
        <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>2. Upload Non Open Heart Data</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/index/"><span class='<?php echo ($subpage=="patient"?"currentPage":"");?>'>1. 查看上傳資料</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/nonsurgery/"><span class='<?php echo ($subpage=="nonsurgery"?"currentPage":"");?>'>2. Upload Non Open Heart Data</span></a></td>
                            </tr>
                            <!--
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/uploadeddata/"><span class='<?php echo ($subpage=="uploadeddata"?"currentPage":"");?>'>3. 查看上傳資料</span></a></td>
                            </tr>     
                       -->
                            
                            
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