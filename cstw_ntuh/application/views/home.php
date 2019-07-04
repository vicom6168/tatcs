<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
    <title>台灣大學 科技部跨領域計畫</title>
    

    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/login.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/style_text.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/form-buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/link-buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/messages.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/forms.css" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    
    <!--[if lte IE 8]>
        <script type="text/javascript" src="js/excanvas.min.js"></script>
    <![endif]-->
    
</head>

<body>

<div class="wrapper">
        
    <div class="box">
        <div class="container hide-input">
            
            <h1><a href="http://www.ntu.edu.tw" target="_blank">台灣大學 科技部跨領域計畫</a></h1>
            
            <h2>Login:</h2>
            <form action="<?php echo base_url(); ?>home/checkUser" method="post">
                <input type="text" class="small" name="username" value="請輸入帳號" onclick="this.value=''"/>
                <input type="password" class="small" name="password" value="請輸入密碼" onclick="this.value=''"/>
                <button type="submit" class="blue medium"><span>Login</span></button>
                <button type="reset" class="red medium"><span>Reset</span></button>
            </form>
            
            
        
            <div class="bottom">
                <?php if($result_msg!='') { ?>
                            <div class="messages red">
                            <span></span>
                            <?php echo $result_msg;?>
                            </div>
                        <?php  } ?>
                 
                <div class="messages blue">
                    
                    <span></span>
                    臺大醫院 外科部 製作
                </div>
            </div>
            
            
        </div>
        
    </div>
    
    
</div>

<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/supersubs.js"></script>
<script type="text/javascript" src="js/hoverIntent.js"></script>
<script type="text/javascript" src="js/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
<!--
<script type="text/javascript" src="js/jquery.graphtable-0.2.js"></script>
<script type="text/javascript" src="js/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui-select.js"></script>
<script type="text/javascript" src="js/customInput.jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="js/jquery.filestyle.mini.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery.treeview.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg.rmFormat.js"></script>
<script type="text/javascript" src="js/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="js/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="js/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="js/inline.js"></script>
-->
</body>

</html> 