<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Contact  Us</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>contact/updatecontact" method="post">
                     
                    
                      <div class="line">
                            <label style="width:100px">Name</label>
                            <input type="text" name="username" readonly class="mediumDisabled" value="<?php echo $content->row()->username;?>" />
                        </div>  
                           <div class="line">
                            <label style="width:100px">Email</label>
                            <input type="text" name="email" readonly class="mediumDisabled" value="<?php echo $content->row()->email;?>" />
                        </div>  
                         <div class="line">
                            <label style="width:100px">Telephone</label>
                            <input type="text" name="phone" readonly class="mediumDisabled" value="<?php echo $content->row()->phone;?>" />
                        </div>  
                           <div class="line">
                            <label style="width:100px">Subject</label>
                            <input type="text" name="subject" readonly class="mediumDisabled" value="<?php echo $content->row()->subject;?>" />
                        </div>  
                        <div class="line">
                            <label style="width:100px">Content: </label>
                           <textarea name="content" readonly class="textareaDisabled" cols="55" rows="10" ><?php echo $content->row()->content;?></textarea>
                        </div>
                          <div class="line">
                            <label style="width:100px">回覆內容: </label>
                           <textarea name="replycontent" id="editorreply" class="textarea" cols="55" rows="10" ><?php echo $content->row()->replycontent;?></textarea>
                        </div>
                         <div class="line">
                            <label style="width:100px">回覆時間: </label>
                          <input type="text" readonly name="replytime" class="medium" value="<?php echo $content->row()->replytime;?>" />
                        </div>
                           
                    <div class="line button">
                           
                            <button type="submit" class="blue medium" id="sendFrom"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                           <input type="hidden" name="nid" class="medium" value="<?php echo $content->row()->contactid;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div></div>
       
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>

 $(document).ready(function() {
 
    $( "#publishdate" ).datepicker({ dateFormat: 'yy-mm-dd'});
    <?php if($msg!=""){?>
            $("#sendFrom").notify('<?php echo $msg;?>',"info");
     <?php } ?>
        
    
    });
    
</script>
</body>

</html> 