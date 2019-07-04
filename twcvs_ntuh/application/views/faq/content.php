<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/login.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/style_text.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/form-buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/link-buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/messages.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/forms.css" media="screen" />
        <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/datatable.css" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />

  
                <div class="content">
                    <div class="content forms">
            <div class="title">
                <br>
                    <h1>
                【<?php echo $content->row()->faqcategory;?>】   <?php echo $content->row()->faqsubject;?>
                      
                   </h1>
                   <h3>
                   <?php echo $content->row()->createtime;?>
                   </h3>
                   </div>
                   <br>
                   <?php echo nl2br($content->row()->faqcontent);?>
                </div>
        
</div>


</body>

</html> 