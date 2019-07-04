<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>Bacteria Management</h2>
                    
                </div>
                   <div class="linewithoutindention">
                            <label  class="withinLargedention">Bacteria：</label>
                      <input type="text" name="Bacteria" id="Bacteria" class="medium" value="" />
                      <button type="submit" class="greenmediumspecial" id="BacteriaButton" onclick="addBacteria()"><span>Add</span></button>
                         
             </div>
                <div class="" id="myContent" style="width: 96%; margin: auto;">
                    
                
                </div>
                <br/>
            </div>
        </div>
        
        <?php $this->load->view("parameter/menu");?>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>
 $(document).ready(function() {
  
   loadBacteria();
 });    

</script>

</body>

</html> 