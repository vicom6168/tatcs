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
                    <h2>Hospital  Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>parameter/addHospital" method="post">
                     
                      <div class="line">
                            <label>Hospital Name</label>
                            <input type="text" name="hospitalName" id="hospitalName"  class="small" value="" />
                        </div>
                        
                        <div class="line">
                            <label>Contact </label>
                            <input type="text" name="hospitalContact" id="hospitalContact"  class="small" value="" />
                        </div>
                      
                    
                        
                         <div class="line">
                            <label>Email</label>
                             <input type="text" name="hospitalEmail" id="hospitalEmail"  class="small" value=""/>
                        </div>
                    
                       
                            <div class="line">
                            <label>Telephone</label>
                          <input type="text" name="hospitalPhone" id="hospitalPhone"  class="small" value=""/>
                        </div>
                         
                        
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                               
                        </div>
                  
               
                </form>
            </div>
        </div> </div>
          <?php $this->load->view("parameter/menu");?>
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>

</script>

</body>

</html> 