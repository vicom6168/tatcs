<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>1. 查看上傳資料</h2>
                    
                </div>
             
                <div class="content">
                        <form action="<?php echo base_url(); ?>upload/index" method="post">
                    
                        <div class="linewithoutindention">
                         <div class="messages orange"> 本系統己經改為自動上傳, 上次上傳時間為：<?php echo $patientLastupdateTime;?></div>
                    
        
                    <label  class="withinLargedention">查詢期間：</label>
                      <input type="text" name="qDate1" id="qDate1" class="small" value="<?php echo $d1;?>" />~
                      <input type="text" name="qDate2" id="qDate2" class="small" value="<?php echo $d2;?>" />
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                      </div>
                 <input type="hidden" name="u1" value="<?php echo $d1;?>">
                  <input type="hidden" name="u2" value="<?php echo $d2;?>">
                  </form>
                   
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                               
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
                               
                                <td><?php echo $row->patientHospitalUUID;?></td>
                                <td><?php echo $row->patientBirthday;?></td>
                                 <td><?php echo $row->patientAge;?></td>
                                <td><?php echo $row->patientGender;?></td>
                                <td><?php echo $row->patientOpDate;?></td>
                               
                            </tr>
                            <?php } ?>
                              
                        </tbody> 
                    </table>
               
               
               
      
             
                <br/> </div> </div>
       </div>
        <div class="small">
          
             <div class="box">
        <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>上傳學會</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/index/"><span class='<?php echo ($subpage=="patient"?"currentPage":"");?>'>1. 查看上傳資料</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/nonsurgery/"><span class='<?php echo ($subpage=="nonsurgery"?"currentPage":"");?>'>2. Upload Non Open Heart Data</span></a></td>
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