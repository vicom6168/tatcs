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
                           <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="userHospital" id="userHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>"><?php echo $HList[$i]['hospitalName'] ;?></option>
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
                           <div class="line"  id="frmvsPermission1">
                            <label>病患資料修改權限</label>
                             <input type="radio" name="vsPermission" id="vsPermission_1"  value="1"><label for="vsPermission_1">任何人皆可修改&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                         <div class="line"  id="frmvsPermission2">
                            <label></label>
                             <input type="radio" name="vsPermission" id="vsPermission_2"  value="2"><label for="vsPermission_2">僅允許本人授權人員可修改&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                      <div class="line"  id="vsEmailNotify_1">
                            <label>接收Email通知週期&nbsp;</label>
                             <label for="vsEmailNotify1">接收日報表(每日淩晨接收前一日病患清單) </label>  &nbsp;
                             <input type="checkbox"  name="vsEmailNotify1" id="vsEmailNotify1"  value="Y">
                         </div>
                         <div class="line"  id="vsEmailNotify_2">
                            <label>&nbsp;</label>
                            <label for="vsEmailNotify2">接收週報表(每週一接收上週病患清單)</label> &nbsp;
                             <input type="checkbox" name="vsEmailNotify2" id="vsEmailNotify2"  value="Y">
                          </div>
                         <div class="line"  id="vsEmailNotify_3">
                            <label>&nbsp;</label>
                             <label for="vsEmailNotify3">接收月報表(每月一日寄送上個月病患清單)</label> &nbsp;
                             <input type="checkbox" name="vsEmailNotify3" id="vsEmailNotify3"  value="Y">
                        </div>
                         <div class="line"  id="VS_isExport">
                            <label>院內資料surgeon去名化??</label>
                             <input type="checkbox" name="isExport" id="isExport"  value="0">
                             <label for="isExport">是&nbsp;&nbsp;</label>  &nbsp; 
                             
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
            $('#frmvsPermission1').show();
            $('#frmvsPermission2').show();
            $('#vsEmailNotify_1').show();
            $('#vsEmailNotify_2').show();
            $('#vsEmailNotify_3').show();
              if($('#userRole').val()=="1" )
             $('#VS_isExport').show();
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
            
             $('#VS_isExport').hide();
            
        }
    }
</script>

</body>

</html> 