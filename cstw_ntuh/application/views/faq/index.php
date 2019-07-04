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
                    
                       <button   class="green medium" onclick="javascript: window.location='<?php echo base_url(); ?>contact/addcontact';"  style="vertical-align: bottom;"><span>我要提問</span></button>
                     
               </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                               <th nowrap>Category</th>
                               <th nowrap>Subject</th>
                               <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($faqList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->faqcategory;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->faqsubject;?>  </td>
                                  
                                <td style="padding : 2px 8px;line-height : 10px;">
                                    <a class="various" data-fancybox-type="iframe" href="/faq/viewRecord/<?php echo $row->faqid;?>"> <button  class="blue medium"><span>查看</span></button></a>
                                     <?php if(1==2) { ?>
                                     <button  class="red medium" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>faq/deleteRecord/<?php echo $row->faqid;?>';}" ><span>刪除</span></button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                  
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