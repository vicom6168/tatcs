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
                         <div class="line"  id="frmvsPermission1">
                            <label>病患資料修改權限</label>
                             <input type="radio" name="vsPermission" id="vsPermission_1"  value="1" <?php if($userDetail->vsPermission=='1') echo "checked";?>><label for="vsPermission_1">任何人皆可修改&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                         <div class="line"  id="frmvsPermission2">
                            <label></label>
                             <input type="radio" name="vsPermission" id="vsPermission_2"  value="2" <?php if($userDetail->vsPermission=='2') echo "checked";?>><label for="vsPermission_2">僅允許本人授權人員可修改&nbsp;&nbsp;</label>  &nbsp; 
                            
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
                        <div class="line"  id="VS_isExport">
                            <label>院內資料surgeon去名化?</label>
                             <input type="checkbox" name="isExport" id="isExport"  value="0" <?php if($userDetail->isExport=='0') echo "checked";?>>
                             <label for="isExport">是&nbsp;&nbsp;</label>  &nbsp; 
                             
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
            $('#frmvsPermission1').show();
            $('#frmvsPermission2').show();
             $('#vsEmailNotify_1').show();
            $('#vsEmailNotify_2').show();
            $('#vsEmailNotify_3').show();
                  $('#vsEmailNotify_Other').show();
        } else {
            $('#frmassociateID').hide();
            $('#frmchestheartID').hide();
            $('#frmassociateID').val('');
            $('#frmchestheartID').val('');
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