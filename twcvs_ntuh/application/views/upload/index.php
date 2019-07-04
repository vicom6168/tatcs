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
                    <h2>上傳學會</h2>
                    
                </div>
             
                <div class="content">
                        <form action="<?php echo base_url(); ?>upload/index" method="post">
                    
                        <div class="linewithoutindention">
                         上次上傳時間:<?php echo $patientLastupdateTime;?>
                     <form action="<?php echo base_url(); ?>api/send" method="post">
                 <button type="submit" class="green medium" onclick="$(this).notify('資料上傳中, 請稍候, 謝謝','info'); "><span>開始上傳</span></button>
                 <input type="hidden" name="u1" value="<?php echo $d1;?>">
                  <input type="hidden" name="u2" value="<?php echo $d2;?>">
                  </form>
                      </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                               
                                <th nowrap>Chart Number</th>
                               <th nowrap>Name</th>
                                <th nowrap>Birthday</th>
                                
                                <th nowrap>Age</th>
                                <th nowrap>Gender</th>
                                <th nowrap>Operation Date</th>
                                 <th nowrap>Last Updated</th>
                               
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
                               
                                <td><?php echo $row->patientChartNumber;?></td>
                                <td><?php echo $row->patientName;?></td>
                                <td><?php echo $row->patientBirthday;?></td>
                                 <td><?php echo $row->patientAge;?></td>
                                <td><?php echo $row->patientGender;?></td>
                                <td><?php echo $row->patientOpDate;?></td>
                                <td><?php echo $row->modifyTime;?></td>
                               
                            </tr>
                            <?php } ?>
                              
                        </tbody> 
                    </table>
                     </form>
               
               
           
           <?php if($patientLastupdateTime!="" && $patientList->num_rows() >0) { ?>
             <div class="line">
                    <form action="<?php echo base_url(); ?>api/send" method="post">
                 <button type="submit" class="green medium" onclick="$(this).notify('資料上傳中, 請稍候, 謝謝','info'); "><span>開始上傳</span></button>
                 <input type="hidden" name="u1" value="<?php echo $d1;?>">
                  <input type="hidden" name="u2" value="<?php echo $d2;?>">
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
                                <th nowrap>上傳學會</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/index/"><span class='<?php echo ($subpage=="patient"?"currentPage":"");?>'>1. Upload Patient Data</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/nonsurgery/"><span class='<?php echo ($subpage=="nonsurgery"?"currentPage":"");?>'>2. Upload Non Open Heart Data</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/uploadeddata/"><span class='<?php echo ($subpage=="uploadeddata"?"currentPage":"");?>'>3. 查看上傳資料</span></a></td>
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