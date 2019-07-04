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
                                
                                <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="userHospital" id="userHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>" <?php if($userDetail->userHospital==$HList[$i]['hospitalName']) echo "selected";?>><?php echo $HList[$i]['hospitalName'] ;?></option>
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
                          <div class="line"  id="frmvsPermission1">
                            <label>病患資料修改權限</label>
                             <input type="radio" name="vsPermission" id="vsPermission_1"  value="1" <?php if($userDetail->vsPermission=='1') echo "checked";?>><label for="vsPermission_1">任何人皆可修改&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                         <div class="line"  id="frmvsPermission2">
                            <label></label>
                             <input type="radio" name="vsPermission" id="vsPermission_2"  value="2" <?php if($userDetail->vsPermission=='2') echo "checked";?>><label for="vsPermission_2">僅允許本人授權人員可修改&nbsp;&nbsp;
                                 <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" id="HelpExtracardiacArteriopathy" onmouseout='$(this).notify("");'  onmouseover='$(this).notify("請設定此user所授權的人員,\n若無授權任何人, 則無人可以修改這user所擁有的病患資料",{className:"info",autoHide: false});'></img></label>  &nbsp; 
                            
                        </div>
        
                          <div class="line"  id="vsEmailNotify_1">
                            <label>接收Email通知週期&nbsp;</label>
                             <label for="vsEmailNotify1">接收日報表(每日淩晨接收前一日病患清單) </label>  &nbsp;
                             <input type="checkbox"  name="vsEmailNotify1" id="vsEmailNotify1"  value="Y" <?php if($userDetail->vsEmailNotify1=='Y') echo "checked";?>>
                         </div>
                         <div class="line"  id="vsEmailNotify_2">
                            <label>&nbsp;</label>
                            <label for="vsEmailNotify2">接收週報表(每週一接收上週病患清單)</label> &nbsp;
                             <input type="checkbox" name="vsEmailNotify2" id="vsEmailNotify2"  value="Y" <?php if($userDetail->vsEmailNotify2=='Y') echo "checked";?>>
                          </div>
                         <div class="line"  id="vsEmailNotify_3">
                            <label>&nbsp;</label>
                             <label for="vsEmailNotify3">接收月報表(每月一日寄送上個月病患清單)</label> &nbsp;
                             <input type="checkbox" name="vsEmailNotify3" id="vsEmailNotify3"  value="Y" <?php if($userDetail->vsEmailNotify3=='Y') echo "checked";?>>
                        </div>
                        
                           <div class="line"  id="vsEmailNotify_Other">
                            <label>以上報表同時發送給授權人員?</label>
                             <input type="checkbox" name="vsEmailNotifyOthers" id="vsEmailNotifyOthers"  value="Y" <?php if($userDetail->vsEmailNotifyOthers=='Y') echo "checked";?>>
                             <label for="vsEmailNotifyOthers">是&nbsp;&nbsp;</label>  &nbsp; 
                             
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
            $('#frmvsPermission1').show();
            $('#frmvsPermission2').show();
            $('#vsEmailNotify_1').show();
            $('#vsEmailNotify_2').show();
            $('#vsEmailNotify_3').show();
            $('#vsEmailNotify_Other').show();
            
        } else {
            $('#frmassociateID').val('');
            $('#frmchestheartID').val('');
            $('#frmvsEmail').val('');
            $('#frmassociateID').hide();
            $('#frmchestheartID').hide();
            
            $('#frmvsPermission1').hide();
            $('#frmvsPermission2').hide();
            $('#vsEmailNotify_1').hide();
            $('#vsEmailNotify_2').hide();
            $('#vsEmailNotify_3').hide();
            $('#vsEmailNotify_Other').hide();
        }
    }
</script>


</body>

</html> 