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
                
              
                    <form action="<?php echo base_url(); ?>parameter/addUser" method="post">
                     
                      <div class="line">
                            <label>Login ID</label>
                            <input type="text" name="userName" class="small" value="" />
                        </div>
                        
                        <div class="line">
                            <label>Name</label>
                            <input type="text" name="userRealname" class="small" value="" />
                        </div>
                      
                    
                        
                         <div class="line">
                            <label>Password</label>
                             <input type="text" name="userPassword" id="userPassword"  class="small" value=""/>
                        </div>
                    
                       
                            <div class="line">
                            <label>Hospital</label>
                             <select name="userHospital" id="userHospital" class="big">
                                   <option value="<?php echo $this->config->item('hospitalName');?>"><?php echo $this->config->item('hospitalName');?></option>
                                      <?php 
                            foreach($hospitalList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->hospitalName;?>"><?php echo $row->hospitalName;?></option>
                                     <?php } ?>
                                   </select>
                        </div>
                          <div class="line">
                            <label>Position<img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" id="HelpExtracardiacArteriopathy" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("VS及Senior R均為本系統之Surgeon/Operator",{className:"info",autoHide: false});'></img></label>
                                <select name="userRole" id="userRole" onchange="hidefromRole();">
                                   <option value="1">VS</option>
                                   <option value="2">Senior R</option>
                                   <option value="3">Junior R</option>
                                   <option value="4">NP</option>
                                   <option value="9">Other</option>
                                   </select>
                        </div>
                              <div class="line">
                             <label>Administrator</label>
                             <label for="isAdmin">is Admin?  &nbsp;</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="isAdmin" id="isAdmin"  value="Y"> 
                          </div>
                          <div class="line" id="frmassociateID">
                            <label>TATCS會員編號</label>
                            <input type="text" name="associateID" class="small" value="" />
                        </div>
                        
                          <div class="line" id="frmchestheartID">
                            <label>TATCS證書號</label>
                            <input type="text" name="chestheartID" class="small" value="" />
                        </div>
                        
                          <div class="line" id="frmvsEmail">
                            <label>Email</label>
                            <input type="text" name="vsEmail" class="small" value="" />
                        </div>    
                        
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                               
                        </div>
                  
               
                </form>
            </div>
        </div> </div>
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