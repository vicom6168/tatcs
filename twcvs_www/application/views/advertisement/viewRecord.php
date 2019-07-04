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
                
              
                    <form action="<?php echo base_url(); ?>advertisement/updateAd" method="post"  enctype="multipart/form-data">
                     
                   
                        <div class="line">
                            <label style="width: 100px;">公司名稱</label>
                            <input type="text" name="acompany" class="medium" value="<?php echo $advertisement->acompany;?>" />
                        </div>
                        
                        <div class="line">
                            <label style="width: 100px;">Banner</label>
                            <?php if($advertisement->abanner=="") {?>
                            <input type="file" name="abanner" class="small" value="<?php echo $advertisement->abanner;?>" />
                            <?php } else { ?>
                            <img src="/uploads/<?php echo $advertisement->abanner;?>" width="240" height="100" />
                            <a href="#" onclick="javascript:if(confirm('Press confirm to delete this picture?')){ window.location='<?php echo base_url(); ?>advertisement/deleteImage/<?php echo $advertisement->aid;?>';}" ><img src="/images/cross-circle.png"></a>  
                             <input type="hidden" name="abanner" class="small" value="" />
                             <?php }  ?>
                        </div>
                      
                    
                        
                         <div class="line">
                            <label style="width: 100px;">Link</label>
                             <input type="text" name="alink" id="alink"  class="medium" value="<?php echo $advertisement->alink;?>"/>
                        </div>
                    
                       
                         <div class="line">
                            <label style="width: 100px;">上線日期</label>
                             <input type="text" name="astartdate" id="astartdate"  class="small" value="<?php echo $advertisement->astartdate;?>"/>
                        </div>
                              <div class="line">
                            <label style="width: 100px;">下線日期</label>
                             <input type="text" name="aenddate" id="aenddate"  class="small" value="<?php echo $advertisement->aenddate;?>"/>
                        </div>
                         
                               <div class="line">
                            <label style="width: 100px;">掛序</label>
                             <input type="text" name="aorder" id="aorder"  class="small" value="<?php echo $advertisement->aorder;?>"/>
                        </div>
                           <div class="line">
                            <label style="width: 100px;">是否有效?</label>
                             <input type="checkbox" name="aonline" id="aonline"  value="Y" <?php if($advertisement->aonline=="Y") echo "checked";?>>
                             <label for="aonline">是&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                    <div class="line button">
                           
                            <button type="submit" id="sendButton" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                                <input type="hidden" name="advertisementID" id="advertisementID"  class="small" value="<?php echo $advertisement->aid;?>"/>
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
  $( "#astartdate" ).datepicker({ dateFormat: 'yy-mm-dd'});
  $( "#astartdate" ).val('<?php echo str_replace('0000-00-00', '', $advertisement->astartdate);?>');
   $( "#aenddate" ).datepicker({ dateFormat: 'yy-mm-dd'});
  $( "#aenddate" ).val('<?php echo str_replace('0000-00-00', '', $advertisement->aenddate);?>');
  
  <?php if($msg!="") { ?>
      $.notify("<?php echo $msg?>","info");
   <?php } ?>
});
</script>
</body>

</html> 