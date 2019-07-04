    <div class="logo-labels">
        
        <ul>
            <li class="usermessage"><a href="#"><span>歡迎 &nbsp; <?php echo $this->session->userdata('bookingName')?>&nbsp; 使用本訂床系統</span></a></li>
            <li class="logout"><a href="<?php echo base_url(); ?>oldmedical/logout"><span>登出</span></a></li>
        </ul>
    </div>
    
    <div class="menu-search">
        <ul> 
             <li <?php if($page=='booking') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>/oldmedical">資料查詢</a></li> 
          
           
            <li <?php if($page=='password') echo "class='current'"; ?>><a href="<?php echo base_url(); ?>oldmedical/password">修改密碼</a></li>
           
        </ul>
       
    </div>
    
    <div class="breadcrumbs">
        <ul>
            <li class="home"><a href="#"></a></li>
            <li class="break">&#187;</li>
            <li>台大醫院  老年醫學部  Frax系統</li>
            <li class="break">&#187;</li>
            <?php echo $path;?>
        </ul>
    </div>