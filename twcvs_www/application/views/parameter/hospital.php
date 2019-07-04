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
                    <h2>Hospital  Management</h2>
                    
                </div>
                   <div class="linewithoutindention">
                     <button type="submit" class="green medium" id="userButton" onclick="javascript: window.location='<?php echo base_url(); ?>parameter/newHospital';"  style="vertical-align: bottom;"><span>新增醫院</span></button>
                         
             </div>
                <div class="Content" id="myContent" >
                     <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Hospital Name</th>
                               <th nowrap> Contact</th>
                                <th nowrap>Email </th>
                                <th nowrap>Telephone </th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($hospitalList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->hospitalName;?></td>
                                <td><?php echo $row->hospitalContact;?></td>
                                <td><?php echo $row->hospitalEmail;?></td>
                                <td><?php echo $row->hospitalPhone;?></td>
                            
                            
                                <td>
                                    <a href="#" onclick="javascript: window.location='<?php echo base_url(); ?>parameter/viewHospital/<?php echo $row->hospitalID;?>';"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>parameter/deleteHospital/<?php echo $row->hospitalID;?>';}" ><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                   
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


</body>

</html> 