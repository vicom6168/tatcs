 <div class="small">
          
             <div class="box">
                <div class="title">
                    <h2></h2>
                    <span class="hide"></span>
                </div>
                <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>Parameter Setting</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php if($this->session->userdata('isAdmin')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/news/" ><span class='<?php echo ($subpage=="news"?"currentPage":"");?>'>News Management</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/user/" ><span class='<?php echo ($subpage=="user"?"currentPage":"");?>'>User Management</span></a></td>
                            </tr>
                            <?php if($this->session->userdata('userID')=="1") { ?>
                                <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/setting/" ><span class='<?php echo ($subpage=="setting"?"currentPage":"");?>'>System Setting</span></a></td>
                            </tr>
                                <?php } ?>
                            <!--
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/surgeon/"><span class='<?php echo ($subpage=="vs"?"currentPage":"");?>'>Surgeon  Management</span></a></td>
                            </tr>
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/diagnosis/"><span class='<?php echo ($subpage=="diagnosis"?"currentPage":"");?>'>Diagnosis Management</span></a></td>
                            </tr>
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/bacteria/" ><span class='<?php echo ($subpage=="bacteria"?"currentPage":"");?>'>Bacteria Management</span></a></td>
                            </tr>
                            -->
                           <?php } ?>
                           <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/myProfile/" ><span class='<?php echo ($subpage=="profile"?"currentPage":"");?>'>My Profile</span></a></td>
                            </tr>
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/myauthority/" ><span class='<?php echo ($subpage=="authority"?"currentPage":"");?>'>Authority Management</span></a></td>
                            </tr>
                            
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>home/accessrecord/" ><span class='<?php echo ($subpage=="access"?"currentPage":"");?>'>Access Record</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>home/password/" ><span class='<?php echo ($subpage=="password"?"currentPage":"");?>'>Change Password</span></a></td>
                            </tr>
                                <?php if($this->session->userdata('isAdmin')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/special/" ><span class='<?php echo ($subpage=="special"?"currentPage":"");?>'>Special Sheet Management</span></a></td>
                            </tr>
                             <?php } ?>
                        </tbody> 
                    </table>
                </div>
            </div>
          
        </div>