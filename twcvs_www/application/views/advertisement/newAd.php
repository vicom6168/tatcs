<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="big">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>Advertisement  Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>advertisement/saveAd" method="post" enctype="multipart/form-data">
                     
                      <div class="line">
                            <label style="width: 100px;">公司名稱</label>
                            <input type="text" name="acompany" class="medium" value="" />
                        </div>
                        
                        <div class="line">
                            <label style="width: 100px;">Banner</label>
                            <input type="file" name="abanner" class="medium" value="" />
                        </div>
                      
                    
                        
                         <div class="line">
                            <label style="width: 100px;">Link</label>
                             <input type="text" name="alink" id="alink"  class="medium" value=""/>
                        </div>
                    
                       
                         <div class="line">
                            <label style="width: 100px;">上線日期</label>
                             <input type="text" name="astartdate" id="astartdate"  class="small" value=""/>
                        </div>
                              <div class="line">
                            <label style="width: 100px;">下線日期</label>
                             <input type="text" name="aenddate" id="aenddate"  class="small" value=""/>
                        </div>
                         
                               <div class="line">
                            <label style="width: 100px;">掛序</label>
                             <input type="text" name="aorder" id="aorder"  class="small" value="99"/>
                        </div>
                           <div class="line">
                            <label style="width: 100px;">是否有效?</label>
                             <input type="radio" name="aonline" id="aonline"  value="Y">
                             <label for="aonline">是&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                    <div class="line button">
                           
                            <button type="submit" id="sendButton" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                               
                        </div>
                  
               
                </form>
            </div>
        </div> </div>
          <?php $this->load->view("parameter/menu");?>
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>



</body>
<script>
       $( "#astartdate" ).datepicker({ dateFormat: 'yy-mm-dd'});
       $( "#aenddate" ).datepicker({ dateFormat: 'yy-mm-dd'});
       
        <?php if($msg!="") { ?>
      $("#sendButton").notify("<?php echo $msg?>","error");
   <?php } ?>
</script>
</html> 