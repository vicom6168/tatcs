<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="big">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Hospital  Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>parameter/updateHospital" method="post">
                     
                      <div class="line">
                            <label>Hospital Name</label>
                            <input type="text" name="hospitalName" id="hospitalName"  class="small" value="<?php echo $hospital->hospitalName;?>" />
                        </div>
                        
                        <div class="line">
                            <label>Contact </label>
                            <input type="text" name="hospitalContact" id="hospitalContact"  class="small" value="<?php echo $hospital->hospitalContact;?>" />
                        </div>
                      
                    
                        
                         <div class="line">
                            <label>Email</label>
                             <input type="text" name="hospitalEmail" id="hospitalEmail"  class="small" value="<?php echo $hospital->hospitalEmail;?>"/>
                        </div>
                    
                       
                            <div class="line">
                            <label>Telephone</label>
                          <input type="text" name="hospitalPhone" id="hospitalPhone"  class="small" value="<?php echo $hospital->hospitalPhone;?>"/>
                        </div>
                          <div class="lineheader">
                            <label>Special Sheet:   </label>
                             <label for="operationAorticSurgery"  id="operationAorticSurgeryLabel"></label> &nbsp;
                             </div>
                           <div class="line"  id="frmvsPermission1">
                            <label>VAD special sheet</label>
                             <input type="checkbox" name="p1" id="p1"  value="Y" <?php if($hospital->p1=='Y') echo "checked";?>><label for="p1">啓用&nbsp;</label>  &nbsp; 
                             
                        </div>
                          <div class="line"  id="frmvsPermission2">
                            <label>Vascular special sheet</label>
                             <input type="checkbox" name="p2" id="p2"  value="Y" <?php if($hospital->p2=='Y') echo "checked";?>><label for="p2">啓用&nbsp;</label>  &nbsp; 
                             
                        </div>
                        
                          <div class="line"  id="frmvsPermission3">
                            <label>允許檔案方式匯入病患資料</label>
                             <input type="checkbox" name="p3" id="p3"  value="Y" <?php if($hospital->p3=='Y') echo "checked";?>><label for="p3">啓用&nbsp;</label>  &nbsp; 
                             
                        </div>
                         <div class="line"  id="frmvsPermission4">
                            <label>CR morning meeting報告報表(Open heart)</label>
                             <input type="checkbox" name="p4" id="p4"  value="Y" <?php if($hospital->p4=='Y') echo "checked";?>><label for="p4">啓用&nbsp;</label>  &nbsp; 
                             
                        </div>
                          <div class="line"  id="frmvsPermission4">
                            <label>CR morning meeting報告報表(Vascular)</label>
                             <input type="checkbox" name="p5" id="p5"  value="Y" <?php if($hospital->p5=='Y') echo "checked";?>><label for="p5">啓用&nbsp;</label>  &nbsp; 
                             
                        </div>
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                                <input type="hidden" name="hospitalID" id="hospitalID"  class="small" value="<?php echo $hospital->hospitalID;?>"/>
                        </div>
                  
               
                </form>
            </div>
        </div></div>
          <?php $this->load->view("parameter/menu");?>
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>
hidefromRole();
    function hidefromRole(){
        if($('#userRole').val()=="1" || $('#userRole').val()=="2"){
            $('#frmassociateID').show();
            $('#frmchestheartID').show();
            $('#frmvsEmail').show();
         
        } else {
            $('#frmassociateID').val('');
            $('#frmchestheartID').val('');
            $('#frmvsEmail').val('');
            $('#frmassociateID').hide();
            $('#frmchestheartID').hide();
            
       
        }
    }
</script>


</body>

</html> 