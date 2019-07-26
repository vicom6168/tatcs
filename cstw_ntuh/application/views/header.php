<head>
    
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
    <title><?php echo $this->config->item('hospitalTitle');?></title>
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/style_text.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/form-buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/link-buttons.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/messages.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/forms.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/menu.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/datatable.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/datepicker.css" media="screen" />
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
 
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/superfish.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/supersubs.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/hoverIntent.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.graphtable-0.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/customInput.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.filestyle.mini.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.treeview.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/inline.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/notify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/vicom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/vicom_util.js"></script>
    <!--[if lte IE 8]>
        <script type="text/javascript" src="js/excanvas.min.js"></script>
    <![endif]-->
    
</head>
<?php 
function mb_substr_replace($original, $replacement, $position, $length)
{
 $startString = mb_substr($original, 0, $position, "UTF-8");
 $endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");

 $out = $startString . $replacement . $endString;

 return $out;
}
?>