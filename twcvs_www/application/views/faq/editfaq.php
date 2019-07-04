<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>minified/themes/default.min.css" />
<script src="<?php echo base_url(); ?>minified/jquery.sceditor.bbcode.min.js"></script>
<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>FAQ Management</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>faq/updatefaq" method="post">
                     
                    
                      <div class="line">
                            <label style="width:100px">Category</label>
                           <select name="faqcategory">
                               <option value="系統使用問題">系統使用問題</option>
                               <option value="病患資料填寫問題">病患資料填寫問題</option>
                               <option value="資料上傳問題">資料上傳問題</option>
                               <option value="其他問題">其他問題</option>
                           </select>
                        </div>  
                          
                           <div class="line">
                            <label style="width:100px">Subject</label>
                            <input type="text" name="faqsubject" class="medium" value="<?php echo $content->row()->faqsubject;?>" />
                        </div>  
                        <div class="line">
                            <label style="width:100px;height:500px">Content: </label>
                           <textarea name="faqcontent"  cols="100" rows="100"><?php echo $content->row()->faqcontent;?></textarea>
                        </div>
                          <div class="line">
                            <label style="width:100px">掛序</label>
                            <input type="text" name="faqorder" class="medium" value="<?php echo $content->row()->faqorder;?>" />(請填整數)
                        </div>  
                           
                    <div class="line button">
                           
                            <button type="submit" class="blue medium" id="sendFrom"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                              <input type="hidden" name="nid" class="medium" value="<?php echo $content->row()->faqid;?>" />
                        </div>
                  
               
                </form>
            </div>
        </div></div>
       
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>


$(function() {
    // Replace all textarea tags with SCEditor
    
    $('textarea').sceditor({
        plugins: 'xhtml',
        style: '<?php echo base_url(); ?>minified/jquery.sceditor.default.min.css',
        height:'500%',
        emoticonsRoot: '/css/wysiwyg/'
    });
    
      
});

 
</script>
</body>

</html> 