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
                    <h2>1.查詢上傳學會資料</h2>
                    
                </div>
             
                <div class="content">
                     <div class="messages orange"> 本系統己經改為自動上傳, 上次上傳時間為：<?php echo $patientLastupdateTime;?></div>
                        <form action="<?php echo base_url(); ?>upload/index" method="post">
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
                                   <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("只會上傳已完成的資料","info")'>
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
                                <th nowrap>編碼</th>
                               
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
                                <td><?php echo $row->patientHospitalUUID;?></td>
                                
                                <td><?php echo $row->patientBirthday;?></td>
                                 <td><?php echo $row->patientAge;?></td>
                                <td><?php echo $row->patientGender;?></td>
                                <td><?php echo $row->patientOpDate;?></td>
                            
                               
                            </tr>
                            <?php } ?>
                              
                        </tbody> 
                    </table>
                     </form>
               
               
           
           <?php if($d1!="" && $d2!="" && $patientList->num_rows() >0) { ?>
             <div class="line">
                    <form action="<?php echo base_url(); ?>api/send" method="post">
                  <input type="hidden" name="u1" value="<?php echo $d1;?>">
                  <input type="hidden" name="u2" value="<?php echo $d2;?>">
                  </form>
               </div>
               <?php } ?>
             
                <br/> </div> </div>
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