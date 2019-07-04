    <div class="logo-labels">
        
        <ul>
            <li class="usermessage"><a href="#"><span>歡迎&nbsp;&nbsp;<?php echo $this->session->userdata('userRealname')?>使用本系統</span></a></li>
            <li class="logout"><a href="<?php echo base_url(); ?>homenew/logout"><span>登出</span></a></li>
        </ul>
    </div>
    
    <div class="menu-search">
        <ul> 
           <li <?php if($page=='news') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>news/newslist/">最新消息 </a></li> 
             
            <li <?php if($page=='index') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>patient/index/">病患列表 </a></li> 
            <li <?php if($page=='uncomplete') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>patient/uncomplete/">未完成資料 </a></li> 
           
          
            
       
            <li <?php if($page=='analysis') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>analysis/complication/">統計報表</a></li>
            <?php if($this->session->userdata('isAdmin')=="Y") { ?>
            <li <?php if($page=='export') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>exportPatient">資料匯出</a></li>
             <?php } ?>    
             <li <?php if($page=='parameter') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>home/accessrecord">參數設定</a></li>
             <?php if($this->session->userdata('isAdmin')=="Y") { ?>
            <li <?php if($page=='upload') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>upload/index">上傳學會</a></li>
            <?php } ?>
               <li <?php if($page=='faq') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>faq">常見問題</a></li>
               <li <?php if($page=='contact') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>contact/addcontact">我要提問</a></li>
        </ul>
       
    </div>
    
    <div class="breadcrumbs">
        <ul>
            <li class="home"><a href="#"></a></li>
            <li class="break">&#187;</li>
            <li><?php echo $this->config->item('hospitalTitle');?></li>
            <li class="break">&#187;</li>
            <?php echo $path;?>
        </ul>
    </div>