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
                                <td><a href="<?php echo base_url(); ?>parameter/hospital/" ><span class='<?php echo ($subpage=="hospital"?"currentPage":"");?>'>Hospital Management</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/user/" ><span class='<?php echo ($subpage=="user"?"currentPage":"");?>'>User Management</span></a></td>
                            </tr>
                        
                           <?php } ?>
                           <tr> 
                                <td><a href="<?php echo base_url(); ?>parameter/myProfile/" ><span class='<?php echo ($subpage=="profile"?"currentPage":"");?>'>My Profile</span></a></td>
                            </tr>
                           
                            
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>home/accessrecord/" ><span class='<?php echo ($subpage=="access"?"currentPage":"");?>'>Access Record</span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>home/password/" ><span class='<?php echo ($subpage=="password"?"currentPage":"");?>'>Change Password</span></a></td>
                            </tr>
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>advertisement/index/" ><span class='<?php echo ($subpage=="advertisement"?"currentPage":"");?>'>Advertisement Management</span></a></td>
                            </tr>
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>valve/index/" ><span class='<?php echo ($subpage=="valve"?"currentPage":"");?>'>Valve Management</span></a></td>
                            </tr>
                        </tbody> 
                    </table>
                </div>
            </div>
          
        </div>