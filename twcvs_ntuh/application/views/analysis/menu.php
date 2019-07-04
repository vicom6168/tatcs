<table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>統計報表</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                         <tr> 
                               <td><a href="<?php echo base_url(); ?>analysis/association2019/""><span class='<?php echo ($subpage=="association2019"?"currentPage":"");?>'>1. 醫院分類報表(2019年版) </span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummary/"><span class='<?php echo ($subpage=="summary"?"currentPage":"");?>'>2. Executive Summary </span></a></td>
                            </tr>
                               
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummaryadult/"><span class='<?php echo ($subpage=="adult"?"currentPage":"");?>'>3. Executive summary of Adult Cardiac Surgery </span></a></td>
                            </tr>
                            
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarychild/"><span class='<?php echo ($subpage=="congenital"?"currentPage":"");?>'>4. Executive summary of Congenital Surgery  </span></a></td>
                            </tr>
                          
                                       <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarynonopenheart/"><span class='<?php echo ($subpage=="nonsurgery"?"currentPage":"");?>'>5. Executive summary of Non Open Heart </span></a></td>
                            </tr>
                            
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/adultoutcome/"><span class='<?php echo ($subpage=="adultoutcome"?"currentPage":"");?>'>6. Adult Outcome </span></a></td>
                            </tr>
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/congenitaloutcome/"><span class='<?php echo ($subpage=="congenitaloutcome"?"currentPage":"");?>'>7. Congenital Outcome </span></a></td>
                            </tr>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/chdbenchmarkoutcome/"><span class='<?php echo ($subpage=="chdbenchmarkoutcome"?"currentPage":"");?>'>8. CHD Benchmark surgery outcome </span></a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/chdmortality/"><span class='<?php echo ($subpage=="chdmortality"?"currentPage":"");?>'>9. CHD Operative Mortality </span></a></td>
                            </tr>
                                 <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/urgency/"><span class='<?php echo ($subpage=="urgency"?"currentPage":"");?>'>10. Urgency and Euroscore II </span></a></td>
                            </tr>
                             
                             <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/association2019Server/""><span class='<?php echo ($subpage=="association2019Server"?"currentPage":"");?>'>11. 上傳學會後分類報表(2019年版) </span></a></td>
                            </tr>
                        </tbody> 
                    </table>
 <?php if($this->session->userdata('P4')=="Y" || $this->session->userdata('P5')=="Y") { ?>   
     <br/>                
<table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>專用統計報表</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php if($this->session->userdata('P4')=="Y") { ?>   
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/CRmorning/""><span class='<?php echo ($subpage=="CRmorning"?"currentPage":"");?>'>CR morning meeting報表 (Open Heart) </span></a></td>
                            </tr>
                             <?php } ?>    
                               <?php if($this->session->userdata('P5')=="Y") { ?>   
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/CRmorningVascular/""><span class='<?php echo ($subpage=="CRmorningVascular"?"currentPage":"");?>'>CR morning meeting報表 (Vascular)</span></a></td>
                            </tr>
                             <?php } ?>    
                        </tbody> 
                    </table>
 <?php } ?>    