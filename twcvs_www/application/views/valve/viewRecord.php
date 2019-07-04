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
                
              
                    <form action="<?php echo base_url(); ?>valve/updatevalve" method="post">
                     
                   
                        <div class="line">
                            <label style="width: 100px;">特材代碼</label>
                            <input type="text" name="valvecode" class="medium" value="<?php echo $valve->valvecode;?>" />
                        </div>
                        
                       <div class="line">
                                   <label>類別:  
                              
                            </label>
                              <select name="valvecategory" id="valvecategory" class="large">
                                   <option value="" class="large"></option>
                                   <option  class="large" value="Bioprosthetic Valve"  <?php if($valve->valvecategory=='Bioprosthetic Valve') echo "selected";?>>Bioprosthetic Valve</option>
                                   <option  class="large" value="Mechanical Valve"  <?php if($valve->valvecategory=='Mechanical Valve') echo "selected";?>>Mechanical Valve</option>
                                   <option  class="large" value="Sutureless Valve"  <?php if($valve->valvecategory=='Sutureless Valve') echo "selected";?>>Sutureless Valve</option>
                                   <option  class="large" value="Annuloplasty Ring"  <?php if($valve->valvecategory=='Annuloplasty Ring') echo "selected";?>>Annuloplasty Ring</option>
                                   <option  class="large" value="Valved Graft"  <?php if($valve->valvecategory=='Valved Graft') echo "selected";?>>Valved Graft</option>
                                   <option  class="large" value="TAVI"  <?php if($valve->valvecategory=='TAVI') echo "selected";?>>TAVI</option>
                                    </select>
                            </div>
                        
                         <div class="line">
                            <label style="width: 100px;">小名</label>
                             <input type="text" name="valvesimplifiedname" id="valvesimplifiedname"  class="large" value="<?php echo $valve->valvesimplifiedname;?>"/>
                        </div>
                    
                       
                         <div class="line">
                            <label style="width: 100px;">中英文品名</label>
                               <textarea name="valveproductname" class="textarea" cols="55" rows="10"><?php echo $valve->valveproductname;?></textarea>
                        </div>
                        <div class="line">
                            <label style="width: 100px;">廠牌</label>
                             <input type="text" name="valvecompany" id="valvecompany"  class="small" value="<?php echo $valve->valvecompany;?>"/>
                        </div>
                         
                             
                    <div class="line button">
                           
                            <button type="submit" id="sendButton" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                                <input type="hidden" name="valveID" id="valveID"  class="small" value="<?php echo $valve->valvecode;?>"/>
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

  
  <?php if($msg!="") { ?>
      $.notify("<?php echo $msg?>","info");
   <?php } ?>
});
</script>
</body>

</html> 