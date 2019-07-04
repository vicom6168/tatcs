<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>病患資料匯入</h2>
                    
                </div>
             
                <div class="content">
                      <?php if($this->session->userdata('P3')=="Y" || 1==1) { ?>
                          <form action="<?php echo base_url(); ?>exportPatient/importVascularPatient" method="post"    enctype="multipart/form-data">
                          <input type="file" name="uploadPatient" class="small" value="" />
                           <button  class="blue medium"  style="vertical-align: bottom;"><span>開始上傳</span></button>  (檔案限制：格式XLSX檔)
                           </form>
                           <?php } ?>
                      
                     
               
          
                <br/> 
                <div>
                    <?php if($error_msg!="") echo $error_msg; ?>
                    <?php if($result_msg!="") echo $result_msg; ?>
                </div>
                
                </div> </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
 $(document).ready(function() {
  
    $( "#qDate1" ).datepicker({ dateFormat: 'yy-mm-dd'});
     $( "#qDate2" ).datepicker({ dateFormat: 'yy-mm-dd'});
 });    
 </script>
</html> 