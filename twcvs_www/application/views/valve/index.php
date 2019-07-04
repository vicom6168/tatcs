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
                           <button type="submit" class="green medium" id="userButton" onclick="javascript: window.location='<?php echo base_url(); ?>valve/newValve';"  style="vertical-align: bottom;"><span>新增瓣膜</span></button>
                         
             </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>特材代碼</th>
                                <th nowrap>類別</th>
                                <th nowrap>小名</th>
                                <th nowrap>中英文品名</th>
                                <th nowrap>廠牌</th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($valveList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->valvecode;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->valvecategory;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->valvesimplifiedname;?>  </td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->valveproductname;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->valvecompany;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;">
                                    <a href="#" onclick="javascript: window.location='<?php echo base_url(); ?>valve/viewRecord/<?php echo $row->valvecode;?>';"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                     <?php if($this->session->userdata('isAdmin')=="Y") { ?>
                                     <a href="#" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>valve/deleteRecord/<?php echo $row->valvecode;?>';}" ><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
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