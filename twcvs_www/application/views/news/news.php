<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>News  List</h2>
                    
                </div>
                   <div class="linewithoutindention">
                           
                    
                         
             </div>
                <div class="" id="myContent" style="width: 96%; margin: auto;">
                    
                
                </div>
                <br/>
            </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>
 $(document).ready(function() {
  
   loadNews('1');
   
   
 });    
$(document).ready(function() {
    $(".various").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });
});
</script>

</body>

</html> 