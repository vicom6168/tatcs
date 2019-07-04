     
            
                <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                    
                        <tbody> 
                            <?php if($this->session->userdata('P1')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>specialSheet/LVAD/" ><span class='<?php echo ($subpage=="LVAD"?"currentPage":"");?>'>VAD</span></a></td>
                            </tr>
                             <?php } ?>
                              <?php if($this->session->userdata('P2')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>specialSheet/Vascular/" ><span class='<?php echo ($subpage=="Vascular"?"currentPage":"");?>'>Vascular</span></a></td>
                            </tr>
                             <?php } ?>
                            
                        </tbody> 
                    </table>
                </div>
            
          
   