<table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>統計報表</th>
                             </tr> 
                        </thead> 
                        <tbody> 
                           <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/index/""><span class='<?php echo ($subpage=="associate"?"currentPage":"");?>'>1. 學會手術統計申報表 </span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/doctoroperation/"><span class='<?php echo ($subpage=="doctor"?"currentPage":"");?>'>2. 醫師手術報表 </span></a></td>
                            </tr>
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/complication/"><span class='<?php echo ($subpage=="complication"?"currentPage":"");?>'>3. 併發症統計報表 </span></a></td>
                             </tr>   
                              <?php if($this->session->userdata('userRole')=="2" || $this->session->userdata('userRole')=="3") { ?>   
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/resident/"><span class='<?php echo ($subpage=="resident"?"currentPage":"");?>'>4. 住院醫師學會統計表 </span></a></td>
                             </tr>   
                             <?php } ?>
                        </tbody> 
                    </table>
 