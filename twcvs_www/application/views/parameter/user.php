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
            <div class="box">
                <div class="title">
                    <h2>User  Management</h2>
                    
                </div>
                   <div class="linewithoutindention">
                           <select name="userHospital" id="userHospital" class="big">
                                   <option value="<?php echo $this->config->item('hospitalName');?>"><?php echo $this->config->item('hospitalName');?></option>
                                      <?php 
                            foreach($hospitalList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->hospitalName;?>" <?php if($row->hospitalName==$hospital) echo "selected";?>><?php echo $row->hospitalName;?></option>
                                     <?php } ?>
                            </select>
                      <button  class="blue medium" onclick="javascript: qryUsers();"  style="vertical-align: bottom;"><span>查詢</span></button>  
                      <button type="submit" class="green medium" id="userButton" onclick="javascript: window.location='<?php echo base_url(); ?>parameter/newUser';"  style="vertical-align: bottom;"><span>新增使用者</span></button>
                         
             </div>
                <div class="Content" id="myContent" >
                     <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>user ID</th>
                                <th nowrap>user Name</th>
                                <th nowrap>Hospital</th>
                               <th nowrap>Position</th>
                                <th nowrap>is Admin</th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($userList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->userName;?></td>
                                <td><?php echo $row->userRealname;?></td>
                                <td><?php echo $row->userHospital;?></td>
                                <td><?php echo $role[$row->userRole];?></td>
                                <td><?php echo ($row->isAdmin=="Y"?"Y":"N");?></td>
                            
                            
                                <td>
                                    <a href="#" onclick="javascript: window.location='<?php echo base_url(); ?>parameter/viewUser/<?php echo $row->userID;?>';"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>parameter/deleteUser/<?php echo $row->userID;?>';}" ><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                   
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                
                </div>
                <br/>
            </div>
        </div>
        
        <?php $this->load->view("parameter/menu");?>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>
    function qryUsers(){
       
            window.location='<?php echo base_url(); ?>parameter/user/'+$('#userHospital').val();
      
    }
</script>

</body>

</html> 