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
                    <h2>User  Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>parameter/updateUser" method="post">
                     
                      <div class="line">
                            <label>Login ID(員工編號)</label>
                            <input type="text" name="userName" class="small" value="<?php echo $userDetail->userName;?>" />
                        </div>
                        
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="userRealname" class="small" value="<?php echo $userDetail->userRealname;?>" />
                        </div>
                      
                      
                        
                         <div class="line">
                            <label>Password</label>
                             <input type="text" name="userPassword" id="userPassword"  class="small" value="<?php echo $userDetail->userPassword;?>"/>
                        </div>
                    
                       
                            <div class="line">
                            <label>Hospital</label>
                                
                            
                                      <select name="userHospital" id="userHospital" class="big">
                                   <option value="<?php echo $this->config->item('hospitalName');?>"><?php echo $this->config->item('hospitalName');?></option>
                                      <?php 
                            foreach($hospitalList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->hospitalName;?>" <?php if($userDetail->userHospital==$row->hospitalName) echo "selected";?>><?php echo $row->hospitalName;?></option>
                                     <?php } ?>
                            </select>
                        </div>
                         <div class="line">
                            <label>Position<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" id="HelpExtracardiacArteriopathy" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("VS及Senior R均為本系統之Surgeon/Operator",{className:"info",autoHide: false});'></img></label>
                                <select name="userRole" id="userRole" onchange="hidefromRole();">
                                   <option value="1" <?php if($userDetail->userRole=='1') echo "selected";?>>VS</option>
                                   <option value="2" <?php if($userDetail->userRole=='2') echo "selected";?>>Senior R</option>
                                   <option value="3" <?php if($userDetail->userRole=='3') echo "selected";?>>Junior R</option>
                                   <option value="4" <?php if($userDetail->userRole=='4') echo "selected";?>>NP</option>
                                   <option value="9" <?php if($userDetail->userRole=='9') echo "selected";?>>Other</option>
                                   </select>
                        </div>
                              <div class="line">
                                     <label>Administrator</label>
                             <label for="isAdmin">is Admin?  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="isAdmin" id="isAdmin"  value="Y" <?php if($userDetail->isAdmin=='Y') echo "checked";?>> 
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