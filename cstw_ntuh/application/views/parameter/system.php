<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$role[1]="VS";
$role[2]="Senior R";
$role[3]="Junior R";
$role[4]="NP";
$role[9]="Other";
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="big">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>System Setting</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>home/Savesystem" method="post">
                     
                      
                         <div class="line">
                            <label>病患列表是否顯示全名?</label>
                             <input type="checkbox" class="checkbox"  name="hospitalsystem" id="hospitalsystem"  value="Y" <?php if($hospitalsystem=='Y') echo "checked";?> ><label for="hospitalsystem">是&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                       
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                        </div>
                  
               
                </form>
            </div>
        </div></div>
          <?php $this->load->view("parameter/menu");?>
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>

$.notify("<?php echo $Msg;?>", "info");

</script>


</body>

</html> 