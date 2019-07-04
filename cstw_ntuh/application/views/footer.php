<div class="footer">
        <div class="split">&#169; Copyright 2017 版權所有&nbsp;&nbsp;     
            <?php if($this->config->item("hospitalName")=="台大醫院"){   ?>
            <a href="https://www.ntuh.gov.tw/information/%E9%9A%B1%E7%A7%81%E6%AC%8A%E4%BF%9D%E8%AD%B7%E5%8F%8A%E8%B3%87%E8%A8%8A%E5%AE%89%E5%85%A8%E6%94%BF%E7%AD%96.aspx" target="_blank">
            資訊安全與隱私權政策</a>
            <?php } ?>
            &nbsp;&nbsp; 
            版本資訊: <a class="footerVersion" data-fancybox-type="iframe"  href="https://www.cstw.org.tw/version/index/<?php echo $this->session->userdata('VersionNo');?>" target="_blank"><?php echo $this->session->userdata('VersionNo');?></a>
           
            </div> 
        <div class="split right"><a href="http://www.vicom.com.tw" target="_blank"><img src="/images/vicom_logo.gif"  width="91" height="40"> 緯懇資訊服務有限公司</a>  製作維護</div> 
    </div>
    
<script>
    $(document).ready(function() {
    $(".footerVersion").fancybox({
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
     
    });
</script>