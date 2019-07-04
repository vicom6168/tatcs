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
                    <h2>Advertisement  Management</h2>
                    
                </div>
                   <div class="linewithoutindention">
                           <button type="submit" class="green medium" id="userButton" onclick="javascript: window.location='<?php echo base_url(); ?>advertisement/newAd';"  style="vertical-align: bottom;"><span>新增廣告</span></button>
                         
             </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                                <th nowrap>Company</th>
                              
                                
                                <th nowrap>Click</th>
                                <th nowrap>上線日</th>
                                <th nowrap>下線日</th>
                                <th nowrap>有效?</th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($advertisementList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->acompany;?></td>
                                 <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->aclick;?>  </td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo str_replace('0000-00-00', '', $row->astartdate);?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo str_replace('0000-00-00', '', $row->aenddate);?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo ($row->aonline=="Y"?"Y":"N");?></td>
                                <td style="padding : 2px 8px;line-height : 30px;">
                                    <a href="#" onclick="javascript: window.location='<?php echo base_url(); ?>advertisement/viewRecord/<?php echo $row->aid;?>';"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                     <?php if($this->session->userdata('isAdmin')=="Y") { ?>
                                     <a href="#" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>advertisement/deleteRecord/<?php echo $row->aid;?>';}" ><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                   <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                    <br/>
                 </div>  
            </div>
        </div>
         <?php $this->load->view("parameter/menu");?>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>

</html> 