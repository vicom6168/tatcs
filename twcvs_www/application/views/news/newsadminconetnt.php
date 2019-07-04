<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<?php $news=$newsContent->row();?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="big">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>News  Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>news/saveNews" method="post"  enctype="multipart/form-data">
                     
                      <div class="line">
                            <label style="width:100px">Date</label>
                            <input type="text" name="publishdate" id="publishdate"  class="small" value="<?php echo $news->publishdate;?>" />
                        </div>
                      <div class="line">
                            <label style="width:100px">Subject</label>
                            <input type="text" name="subject" class="medium" value="<?php echo $news->subject;?>" />
                        </div>  
                        <div class="line">
                            <label style="width:100px">Content: </label>
                           <textarea name="content" class="textarea" cols="55" rows="10"><?php echo $news->content;?></textarea>
                        </div>
                         <div class="line">
                            <label style="width: 100px;">attachment</label>
                            <?php if($news->attachment=="") {?>
                            <input type="file" name="attachment" class="small" value="<?php echo $news->attachment;?>" />
                            <?php } else { ?>
                            <a href="/uploads/<?php echo $news->attachment;?>" target="_new">
                            <img src="/images/FileType100.png" width="30" height="30" /></a>
                            <a href="#" onclick="javascript:if(confirm('Press confirm to delete this attachment?')){ window.location='<?php echo base_url(); ?>news/deleteAttachment/<?php echo $news->nid;?>';}" ><img src="/images/cross-circle.png"></a>  
                             <input type="hidden" name="attachment" class="small" value="" />
                             <?php }  ?>
                        </div>
                        
                              <div class="line">
                                     <label style="width:100px">On line</label>
                             <label for="isOnline"> &nbsp;is online?</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="isOnline" id="isOnline"  value="Y" <?php if($news->isOnline=='Y') echo "checked";?>> 
                          </div>
                          
                             <div class="line">
                                     <label style="width:100px">內部訊息?</label>
                             <label for="isInner"> &nbsp;顯示在內部?</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="isInner" id="isInner"  value="Y" <?php if($news->isInner=='Y') echo "checked";?>> 
                          </div>
                              <div class="line">
                                     <label style="width:100px">外部訊息?</label>
                             <label for="isOuter"> &nbsp;顯示在外部?</label> &nbsp;
                            <input type="checkbox" class="checkbox" name="isOuter" id="isOuter"  value="Y" <?php if($news->isOuter=='Y') echo "checked";?>> 
                          </div>  
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                                <input type="hidden" name="nid" id="nid"  class="small" value="<?php echo $news->nid;?>"/>
                        </div>
                  
               
                </form>
            </div>
        </div></div>
          <?php $this->load->view("parameter/menu");?>
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>
$(document).ready(function() {
  $( "#publishdate" ).datepicker({ dateFormat: 'yy-mm-dd'});
  $( "#publishdate" ).val('<?php echo str_replace('0000-00-00', '', $news->publishdate);?>');
});
</script>
</body>

</html> 