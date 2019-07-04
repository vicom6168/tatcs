<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="number">
               </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                               <th nowrap>時間</th>
                               <th nowrap>Hospital</th>
                               <th nowrap>Name</th>
                               <th nowrap>Subject</th>
                               <th nowrap>回覆狀態</th>
                               <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($contactList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $j;?></td>
                                
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->submittime;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->hospital;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->username;?>  </td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->subject;?>  </td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo ($row->status=="1"?"未處理":"己處理");?>  </td>  
                                <td style="padding : 2px 8px;line-height : 10px;">
                                    <a class="various" data-fancybox-type="iframe" href="/contact/viewRecord/<?php echo $row->contactid;?>"> <button  class="blue medium"><span>查看</span></button></a>
                                     <?php if(1==1) { ?>
                                     <button  class="red medium" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>contact/deleteRecord/<?php echo $row->contactid;?>';}" ><span>刪除</span></button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                  <?php echo $Pagination_str; ?>
                </div>
            </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>
    function qryPatient(){
        if($('#qryText').val()=="" && 1==2){
            $('#qryText').notify("請輸入關鍵字", "info");
        } else {
            window.location='<?php echo base_url(); ?>patient/index/'+$('#qryField').val()+'/'+$('#qryOrder').val()+'/'+$('#qryText').val();
        }
    }
  
$(document).ready(function() {
    $(".various").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });
});
</script>


</body>

</html> 