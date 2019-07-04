<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$role[1]="VS";
$role[2]="Senior R";
$role[3]="Junior R";
$role[4]="NP";
$role[9]="Other";
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="big">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>My Profile</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>parameter/updateMyProfile" method="post">
                     
                      <div class="line">
                            <label>Login ID(員工編號)</label>
                            <input type="text" name="userName" class="smallDisabled" readonly value="<?php echo $userDetail->userName;?>" />
                        </div>
                        
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="userRealname" class="smallDisabled" readonly value="<?php echo $userDetail->userRealname;?>" />
                        </div>
                      
                      
                        
                       
                            <div class="line">
                            <label>Hospital</label>
                             &nbsp; <?php echo $userDetail->userHospital;?>
                        </div>
                         <div class="line">
                            <label>Position</label>
                             &nbsp; <?php echo $role[$userDetail->userRole];?>
                                
                        </div>
                              <div class="line">
                                     <label>Administrator</label>
                             &nbsp;<?php echo $userDetail->isAdmin;?>
                          </div>
                           
                             <div class="line" id="frmassociateID">
                            <label>TATCS會員編號</label>
                            <input type="text" name="associateID" class="small" value="<?php echo $userDetail->associateID;?>" />
                        </div>
                        
                          <div class="line" id="frmchestheartID">
                            <label>TATCS證書號</label>
                            <input type="text" name="chestheartID" class="small" value="<?php echo $userDetail->chestheartID;?>" />
                        </div>
                        
                          <div class="line" id="frmvsEmail">
                            <label>Email</label>
                            <input type="text" name="vsEmail" class="small" value="<?php echo $userDetail->vsEmail;?>" />
                        </div>
                        
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                            <input type="hidden" name="userID" id="userID"  class="small" value="<?php echo $userDetail->userID;?>"/>
                             <input type="hidden" name="userRole" id="userRole"  class="small" value="<?php echo $userDetail->userRole;?>"/>
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
$.notify("<?php echo $Msg;?>", "info");
    function hidefromRole(){
        if($('#userRole').val()=="1" || $('#userRole').val()=="2"){
            $('#frmassociateID').show();
            $('#frmchestheartID').show();
       
        } else {
            $('#frmassociateID').hide();
            $('#frmchestheartID').hide();
            $('#frmassociateID').val('');
            $('#frmchestheartID').val('');
    
            
        }
        
    }
</script>


</body>

</html> 