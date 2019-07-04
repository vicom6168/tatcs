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
                    <h2>Surgeon  Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>parameter/addSurgeon" method="post">
                     
                      <div class="line">
                            <label>Surgeon Name</label>
                            <input type="text" name="vsName" class="small" value="" />
                        </div>
                        
                        <div class="line">
                            <label>員工編號</label>
                            <input type="text" name="hospitalID" class="small" value="" />
                        </div>
                      
                    
                        
                         <div class="line">
                            <label>TATCS會員編號</label>
                             <input type="text" name="associateID" id="associateID"  class="small" value=""/>
                        </div>
                    
                       
                             <div class="line">
                            <label>TATCS證書號</label>
                             <input type="text" name="chestheartID" id="chestheartID"  class="small" value=""/>
                        </div>
                         
                         
                             <div class="line">
                            <label>Email</label>
                             <input type="text" name="vsEmail" id="vsEmail"  class="small" value=""/>
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



</body>

</html> 