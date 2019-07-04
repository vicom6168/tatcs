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
                    <h2>特殊表單</h2>
                    
                </div>
                  
                <div class="" id="myContent" style="width: 96%; margin: auto;">
            <?php $this->load->view("specialsheet/menu");?>
                </div>
                <br/>
            </div>
        </div>
        
        
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>


</body>
<script>
$(document).ready(function() {
    $(".various").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        titleShow: false,               
autoscale: false,               
autoDimensions: false ,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });
      $(".pdf").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : true,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        type   :'iframe',
        iframe: {
preload: false // fixes issue with iframe and IE
}

    });
        });
   </script>
</html> 