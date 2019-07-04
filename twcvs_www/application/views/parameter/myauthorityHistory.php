<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  

    
    <div class="section">
        <div class="full">
            <div class="box">
                    
                <div class="content" style="width:750px;height:280px;overflow:auto;">

                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                               <th nowrap>No.</th>
                               <th nowrap>授權給</th>
                               <th nowrap>開始時間</th>
                               <th nowrap>結束時間</th>
                               <th nowrap>狀態</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                                          $i=1;
                            foreach($vsauthorityHistory->result() as $row){
                                   
                            ?>
                            
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 30px;background-color: #ffffff"><?php echo $i++;?></td>
                                <td width="12%"  style="padding : 2px 8px;line-height : 30px;background-color: #ffffff"><?php echo $row->name;?> </td>
                                <td style="padding : 2px 8px;line-height : 30px;background-color: #ffffff"><?php echo $row->a_time;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;background-color: #ffffff"><?php echo $row->e_time;?></td>
                                 <td style="padding : 2px 8px;line-height : 30px;background-color: #ffffff"><?php echo ($row->a_status=="1"?"授權中":"己結束授權");?></td>
                            </tr>
                           
                            <?php                } ?>
                               
                        </tbody> 
                    </table>
                    <br/>
                   
                </div>
            </div>
        </div>
    </div>
    

    
</div>




</body>

</html> 