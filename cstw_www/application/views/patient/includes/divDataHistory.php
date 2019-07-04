 <?php $c=$myContent->row();?>
  <?php
 $outOfDateFlag="";
 if($this->session->userdata('isAdmin')=="N" && $c->patientDischargeDate!="" && $c->patientDischargeDate!="0000-00-00" && (strtotime(date("Y-m-d"))-strtotime($c->patientDischargeDate))/86400>90){
 $outOfDateFlag=" <div class='messages red'> 此筆病患資料已經出院超過90天, 故無法修改或執行列印, 若您需要修改, 請逕洽系統管理者</div>";
 }
 ?>

       <div class="box" id="divDataHistory">
                <div class="content forms">
                    <div class="box"  id="">
                <div class="title">
                    
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divPatientProfiles')">基本資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOperation')">診斷及手術</a> </span>
                 
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divCancer')">病史資料</a> </span>
                   <span class="mainmenu"><a href="#" onclick="callHideShow('divOutcome')">併發症及結果</a> </span>
                   
                   <span class="mainmenuActive"><a href="#" onclick="callHideShow('divDataHistory')">修改記錄</a> </span>
                   </div>
                </div>
                
                <div class="title">
                    <h2>修改記錄 </h2>
                </div>
                
              
                 
                          
                        
                          
                           <form action="<?php echo base_url(); ?>patient/patientProfiles" method="post">
                     
                      <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                                <th nowrap>Date</th>
                                <th nowrap>User</th>
                             
                                <th nowrap>IP</th>
                                <th nowrap>Description</th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                          
                            $j=0;
                            foreach($dataHistory->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->accesstime;?></td>
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->uname;?></td>
                                 
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->accessip;?></td>
                                 <td style="padding : 2px 8px;line-height : 30px;"><?php echo str_replace($row->uname,'',$row->accessstr);?></td>
                       
                                <td style="padding : 2px 8px;line-height : 30px;">
                                    <?php if($row->accesstype=="U" || $row->accesstype=="T" ){?>
                                    <a class="various" data-fancybox-type="iframe" href="/patient/compareHistory/<?php echo $row->aid;?>/<?php echo $row->accesstype;?>"><button  class="blue medium"><span>查看</span></button></a>
                                   <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                      
                  
                        
                   
                  
               
                </form>
                  
               
           
            </div>
          
        </div>
        
         
         
 
    