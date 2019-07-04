<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 
       <div class="section">
        <div class="big">
            <div class="box">
                <div class="content forms">
                <div class="title">
                    <h2>修改密碼</h2>
                </div>
                 <?php if($error_msg!='') { ?>
                            <div class="messages red">
                            <span></span>
                            <?php echo $error_msg;?>
                            </div>
                  <?php  } ?>
                   <?php if($success_msg!='') { ?>
                            <div class="messages green">
                            <span></span>
                            <?php echo $success_msg;?>
                            </div>
                  <?php  } ?>
                    <form action="<?php echo base_url(); ?>home/passwordUpdate" method="post">
                      
                        <div class="line">
                            <label>請輸入舊密碼</label>
                            <input type="password" name="oldPassword"  class="small" value="" />
                        </div>
                        <div class="line">
                            <label>請輸入新密碼</label>
                            <input type="password" name="newPassword"  class="small" value="" />
                        </div>
                       <div class="line">
                            <label>請再確認密碼</label>
                            <input type="password" name="confirmedPassword"  class="small" value="" />
                        </div>
                     
                      <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                            
                        </div>
                </div>
                </div>
                </form>
            </div>
                  <?php $this->load->view("parameter/menu");?>
        </div>
        
     
  
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>

</html> 