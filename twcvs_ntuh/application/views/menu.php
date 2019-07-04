    <div class="logo-labels">
        
        <ul>
            <li class="usermessage"><a href="#"><span>歡迎&nbsp;&nbsp;<?php echo $this->session->userdata('userRealname')?>使用本系統</span></a></li>
            <li class="logout"><a href="<?php echo base_url(); ?>homenew/logout"><span>登出</span></a></li>
        </ul>
    </div>
    
    <div class="menu-search">
        <ul> 
           <li <?php if($page=='news') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>news/newslist/">最新消息 </a></li> 
           <?php if($this->session->userdata('C1')=="1") { ?>
           <li <?php if($page=='evaluation') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>evaluation/index/">術前評估 </a></li> 
            <?php } ?>    
            <li <?php if($page=='index') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>patient/index/">病患列表 </a></li> 
            <li <?php if($page=='uncomplete') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>patient/uncomplete/">未完成資料 </a></li> 
            <li <?php if($page=='nonopenheart') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>nonopenheart">非開心手術</a></li>
            <?php if($this->session->userdata('P1')=="Y" || $this->session->userdata('P2')=="Y" || $this->session->userdata('P3')=="Y"  || $this->session->userdata('P4')=="Y"  || $this->session->userdata('P5')=="Y" || 1==1) { ?>
            <li <?php if($page=='specialsheet') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>specialSheet/SPList/">特殊表單</a>
            <?php if($this->session->userdata('P1')=="Y" || $this->session->userdata('P2')=="Y") { ?>
                <ul id="ffff"> 
            <?php if($this->session->userdata('P1')=="Y") { ?>
           <li <?php if($page=='LVAD') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>specialSheet/LVAD/">VAD </a></li> 
         <?php } ?>
          <?php if($this->session->userdata('P2')=="Y") { ?>
           <li <?php if($page=='Vascular') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>specialSheet/Vascular/">Vascular </a></li> 
           <?php } ?>
           </ul>
           <?php } ?>
            
           </li>
             <?php } ?>    
            <li <?php if($page=='analysis') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>analysis/association2019">統計報表</a></li>
            <?php if($this->session->userdata('isAdmin')=="Y" || 1==1) { ?>
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