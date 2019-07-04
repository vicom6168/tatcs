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
                    <h2>上傳學會 結果</h2>
                    
                </div>
             
                <div class="content">
                      <?php echo $html;?>
                      </div>
                   
                   
               
               
           
         
             
                <br/> </div> </div>
                 <div class="small">
          
             <div class="box">
                 <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>上傳學會</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                        <tr> 
                                <td><a href="<?php echo base_url(); ?>upload/index/"><span class='<?php echo ($subpage=="patient"?"currentPage":"");?>'>1. 上傳病患資料至學會</span></a></td>
                            </tr>
                        
                               
                       
                            
                            
                        </tbody> 
                    </table>
                </div>
                
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