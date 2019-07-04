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

<?php 
//======================== START OF FUNCTION ==========================//
// FUNCTION: bbcode_to_html                                            //
//=====================================================================//
function bbcode_to_html($bbtext){
  $bbtags = array(
    '[heading1]' => '<h1>','[/heading1]' => '</h1>',
    '[heading2]' => '<h2>','[/heading2]' => '</h2>',
    '[heading3]' => '<h3>','[/heading3]' => '</h3>',
    '[h1]' => '<h1>','[/h1]' => '</h1>',
    '[h2]' => '<h2>','[/h2]' => '</h2>',
    '[h3]' => '<h3>','[/h3]' => '</h3>',

    '[paragraph]' => '<p>','[/paragraph]' => '</p>',
    '[para]' => '<p>','[/para]' => '</p>',
    '[p]' => '<p>','[/p]' => '</p>',
    '[left]' => '<p style="text-align:left;">','[/left]' => '</p>',
    '[right]' => '<p style="text-align:right;">','[/right]' => '</p>',
    '[center]' => '<p style="text-align:center;">','[/center]' => '</p>',
    '[justify]' => '<p style="text-align:justify;">','[/justify]' => '</p>',

    '[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
    '[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
    '[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
    '[b]' => '<span style="font-weight:bold;">','[/b]' => '</span>',
    '[i]' => '<span style="font-weight:bold;">','[/i]' => '</span>',
    '[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
    '[break]' => '<br>',
    '[br]' => '<br>',
    '[newline]' => '<br>',
    '[nl]' => '<br>',
    
    '[unordered_list]' => '<ul>','[/unordered_list]' => '</ul>',
    '[list]' => '<ul>','[/list]' => '</ul>',
    '[ul]' => '<ul>','[/ul]' => '</ul>',
    
    '[ordered_list]' => '<ol>','[/ordered_list]' => '</ol>',
    '[ol]' => '<ol>','[/ol]' => '</ol>',
    '[list_item]' => '<li>','[/list_item]' => '</li>',
    '[li]' => '<li>','[/li]' => '</li>',
        
    '[*]' => '<li>','[/*]' => '</li>',
    '[code]' => '<code>','[/code]' => '</code>',
    '[preformatted]' => '<pre>','[/preformatted]' => '</pre>',
    '[pre]' => '<pre>','[/pre]' => '</pre>',            
  );
    
  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

  $bbextended = array(
    "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
    "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
    "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
    "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
    "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
    "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
    "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
    "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
  );

  foreach($bbextended as $match=>$replacement){
    $bbtext = preg_replace($match, $replacement, $bbtext);
  }
  return $bbtext;
}
//=====================================================================//
//  FUNCTION: bbcode_to_html                                           //
//========================= END OF FUNCTION ===========================//
?>