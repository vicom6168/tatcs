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
                    <h2>我要提問</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>contact/savecontact" method="post">
                     
                    
                      <div class="line">
                            <label style="width:100px">Name</label>
                            <input type="text" name="username" class="medium" value="<?php echo $this->session->userdata('userRealname')?>" />
                        </div>  
                           <div class="line">
                            <label style="width:100px">Email</label>
                            <input type="text" name="email" class="medium" value="<?php echo $this->session->userdata('userEmail')?>" />
                        </div>  
                         <div class="line">
                            <label style="width:100px">Telephone</label>
                            <input type="text" name="phone" class="medium" value="" />
                        </div>  
                           <div class="line">
                            <label style="width:100px">Subject</label>
                            <input type="text" name="subject" class="medium" value="" />
                        </div>  
                        <div class="line">
                            <label style="width:100px">Content: </label>
                           <textarea name="content" id="editor" class="textarea" cols="55" rows="10" ></textarea>
                        </div>
                        
                           
                    <div class="line button">
                           
                            <button type="submit" class="blue medium" id="sendFrom"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                         
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