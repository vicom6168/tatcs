<!DOCTYPE HTML>
<!-- Website Template by freewebsitetemplates.com -->
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->config->item('hospitalTitle');?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/homenew/style.css" type="text/css">    
     <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
     
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
      <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/datatable.css" media="screen" />
    <link rel="stylesheet" type="text/css"    href="<?php echo base_url(); ?>css/style_text.css" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/vicom.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/notify.min.js"></script>

</head>
<body>

    <div id="body">

      <div>

            
            <div class="section">
                <div class="article">
                    <h2>登入系統</h2> 
                  <img src="<?php echo base_url(); ?>css/images/logo.jpg"  alt="" width="200"/>
              
<form action="<?php echo base_url(); ?>homenew/checkUser" method="post">
                   
             <input type="text" class="input" name="username" value="請輸入帳號" onclick="this.value=''"/>
              <input type="password" class="input" name="password" value="請輸入密碼" onclick="this.value=''"/><br/>
            
             <input  style="width:25%" type="text" class="input" name="validatecode" value="請輸入驗證碼" onclick="this.value=''"/>
              <img id="article2" src=""/>   
              <a href="javascript:loadVerifyCode();"><img id="article3" src="<?php echo base_url(); ?>images/refresh.png" width=30 height=30/>  </a> 
              <br>
<button type="submit" id="LoginButton" >
          Login 
          </button>
                <button type="reset" >
               Reset
                </button>
                <br/>
                  <button><a href="https://www.twcvs.org.tw/uploads/108年廣告招商函.pdf"  target="_blank">TWCVS資料庫廣告招商</a></<button>
            </form> 
        
            </div>
                                      
          </div>
          
          <div class="featured">
                <h2>公告消息</h2>
             <div class="" id="myContent" style="width: 100%; height:210px;margin: auto;overflow:auto;">
                   
                      
                
                </div>

            </div>
                 

      </div>
        
        <ul>
             <?php foreach($advertisementList->result() as $row){  ?>
            <li>
                 <?php if(trim($row->alink)!=""){  ?>
                <a href="https://www.twcvs.org.tw/advertisement/goout/<?php echo $row->aid;?>" target="_blank"><img src="https://www.twcvs.org.tw/uploads/<?php echo $row->abanner;?>" width="240" height="100" border=0></a>
                  <?php }  else { ?>
                  <a> <img src="https://www.twcvs.org.tw/uploads/<?php echo $row->abanner;?>"  alt=""   width="240" height="100"></a>
                <?php } ?>
            </li>
           <?php } ?>
          <?php for($i=$advertisementList->num_rows() ;$i<12;$i++){  ?>
            <li>
                <a href="#"><img src="<?php echo base_url(); ?>css/images/hairstyle7.jpg" alt=""></a>
                
            </li>
<?php } ?>



        </ul>
    
    </div>


    <div id="Footer">

            <div class="copyright">
<ul>

  

    <li>版權宣告、隱私權宣告©2017 本網站內容為 <a href="http://www.tatcs.org.tw" target="_blank">台灣胸腔及心臟血管外科學會</a> 所有</li><p>
<li></li></p>




    <li>建議最佳解析度為1024*768或以上</li>
    <li>本站資料傳輸皆經SSL加密處理
       </li></ul>
 <a href="https://www.instantssl.com/wildcard-ssl.html" style="text-decoration:none; " target="_blank">
    <img alt="Wildcard SSL" src="https://www.instantssl.com/ssl-certificate-images/support/comodo_secure_100x85_transp.png"
    style="border: 0px;" /><br /> <span style="font-weight:bold;font-size:12px; padding-left:12px; color:#77BAE4;">Wildcard SSL</span>
</a>
            

     </div>   
    </div>



</body>
<script>
 $(document).ready(function() {
  
loadNews('2');
loadVerifyCode();
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
function loadVerifyCode(){
     $.ajax({
                    type:"POST",
                    url: "/captcha/securimage_jpg",
                    cache: false,
                    datatype: "JSON",
                    success: function(data){
                        d = new Date();
                     $("#article2").attr("src", "/captcha/securimage_jpg?"+d.getTime());
                    }
                     
           });
                        
}
<?php if($result_msg!="") { ?>
    showError('<?php echo $result_msg;?>');
<?php } ?>
 function showError(e){
        $.notify(e,"error");
 }
</script>
</html>