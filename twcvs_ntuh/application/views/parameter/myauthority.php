<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php $this->load->view("header");
$role[1]="VS";
$role[2]="Senior R";
$role[3]="Junior R";
$role[4]="NP";
$role[9]="Other";
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>Authority</h2>
                    
                </div>
                    <form action="<?php echo base_url(); ?>parameter/updatemyauthority" method="post">
              
        
                <div class="Content" id="myContent2" >
                     <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                             <tr> 
                                <th nowrap colspan=3 >誰授權給我?</th>
                               
                                
                            </tr> 
                            <tr> 
                                 <th nowrap>No.</th>
                                
                                <th nowrap>授權的Surgeon</th>
                                <th nowrap>授權時間</th>
                             
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($userauthorityList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->name;?></td>
                                <td><?php echo $row->a_time;?></td>
                               
                              
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                    <?php if( $this->session->userdata('userRole')=="1" || $this->session->userdata('userRole')=="2" ){?>
                     <br/><br/>
                     <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                             <tr> 
                                <th nowrap colspan=3 >我授權給誰?</th>
                               
                                
                            </tr> 
                            <tr> 
                                 <th nowrap>No.</th>
                                
                                <th nowrap>我授權的人</th>
                                <th nowrap>授權時間</th>
                             
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($vsauthorityList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->name;?></td>
                                <td><?php echo $row->a_time;?></td>
                               
                              
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                    <?php } ?>
                </div>
                   <?php if( $this->session->userdata('userRole')=="1" || $this->session->userdata('userRole')=="2" ){?>
                <br/><br/>
                <button type="button" id="btnshowAuthority" class="blue medium" onclick="showAuthority();"><span>管理授權</span></button>
                <a class="various" data-fancybox-type="iframe" href="/parameter/queryHistory/<?php echo $this->session->userdata('userID');?>"><button type="button" id="btnshowAuthorityHistory" class="green medium"><span>查看歷史授權記錄</span></button></a>
                <div id="divAuthority" style="display:none;">
                <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap width="5%"></th>
                                <th nowrap width="15%">Name</th>
                                <th nowrap width="30%">Position</th>
                                <th nowrap width="5%"></th>
                                <th nowrap width="15%">Name</th>
                                <th nowrap width="30%">Position</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php 
                            $i=0;
                            foreach($userList->result() as $row){
                                $checkedStr="";
                                 foreach($vsauthorityList->result() as $row1){
                                                         if($row->userID==$row1->uid)
                                                         $checkedStr="checked";
                                 }
                                
                                     ?>
                                     <?php if($i%2==0){ ?>
                                         <tr> 
                                     <?php } ?>    
                                         <td> <input type="checkbox" class="checkbox" name="profilesending_<?php echo $i;?>" id="profilesending_<?php echo $i;?>"  value="1" <?php  echo $checkedStr;?>> 
                                             <input type="hidden" name="profilesendingUserID_<?php echo $i;?>" id="profilesendingUserID_<?php echo $i;?>" class="small" value="<?php echo $row->userID;?>" />
                                             <input type="hidden" name="profilesendingUserName_<?php echo $i;?>" id="profilesendingUserName_<?php echo $i;?>" class="small" value="<?php echo $row->userRealname;?>" />
                                             </td>
                                         <td><?php echo $row->userRealname;?> </td>
                                         <td><?php echo $role[$row->userRole];?> </td>
                                  
                                     <?php if($i%2==1){?>
                                         </tr> 
                                     <?php   } ?> 
                                     
<?php   $i++; } ?> 
                            </tbody>
                            </table>
                            <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <input type="hidden" name="userCount" id="userCount" class="small" value="<?php echo $i;?>" />
                        </div>
                            </div>
                               <?php } ?>
                             </form>
                            </div>
                         
                    </div>
       
        
        <?php $this->load->view("parameter/menu");?>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>
$(document).ready(function() {
    $(".various").fancybox({
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
      $(".pdf").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : true,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'elastic',
        closeEffect : 'elastic',
        type   :'iframe',
        iframe: {
preload: false // fixes issue with iframe and IE
}

    });
});

    function showAuthority(){
        $('#divAuthority').show('slow');
   
         $("#btnshowAuthority").removeClass("blue medium");
         $("#btnshowAuthority").addClass("orange medium");
        
    }
</script>
</body>

</html> 