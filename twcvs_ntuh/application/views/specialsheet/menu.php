     
            
                <div class="content">
                    本會心外資料庫 (TWCVS)登錄系統，目前有以下特殊表單、報表或功能，歡迎各醫院申請使用。<br/>
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                    
                        <tbody> 
                          
                               <tr> 
                                <td><a  class="various" data-fancybox-type="iframe" href="https://www.twcvs.org.tw/SPHelper/VAD">VAD 特殊表單
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" ></img>
                                    
                                </a></td>
                            </tr>
                            
                              
                            <tr> 
                                <td><a  class="various" data-fancybox-type="iframe" href="https://www.twcvs.org.tw/SPHelper/Vascular">Vascular 特殊表單(血管 Lite)
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" ></img>
                                </a></td>
                            </tr>
                            
                             <tr> 
                                <td><a  class="various" data-fancybox-type="iframe" href="https://www.twcvs.org.tw/SPHelper/Excel">以EXCEL檔案匯入貴院病患資料
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" ></img>
                                </a></td>
                            </tr>
                            
                             <tr> 
                                <td><a  class="various" data-fancybox-type="iframe" href="https://www.twcvs.org.tw/SPHelper/CROpenHeart">使用 CR Morning Meeting 報表 /for Open Heart
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" ></img>
                                </a></td>
                            </tr>
                            
                             <tr> 
                                <td><a  class="various" data-fancybox-type="iframe" href="https://www.twcvs.org.tw/SPHelper/CRVascular">使用 CR Morning Meeting 報表 /for Vascular
                                    <img src="<?php echo base_url(); ?>images/help.png" width="18" height="18" ></img>
                                </a></td>
                            </tr>
                            
                        </tbody> 
                    </table>
                    <br/>
                    <b>若您要開通上述功能，請下載申請表，傳真或Email到本會，本會會有專人為您開通，謝謝。
                        <a  href="https://www.twcvs.org.tw/uploads/specialsheet.doc">下載申請表<img src="<?php echo base_url(); ?>images/blue-document.png" width="18" height="18" ></img></a>
                        </b><br/>
                </div>
             
                <br/>
                <?php if($this->session->userdata('P1')=="Y" || 1==1 || $this->session->userdata('P2')=="Y" || $this->session->userdata('P3')=="Y"  || $this->session->userdata('P4')=="Y"  || $this->session->userdata('P5')=="Y" ) { ?>
            
                    <div class="content">
                   <b> 您已經申請使用的特殊表單、報表或功能如下:</b><br/>
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                    
                        <tbody> 
                            <?php if($this->session->userdata('P1')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>specialSheet/LVAD/" >VAD 特殊表單</a></td>
                            </tr>
                             <?php } ?>
                              <?php if($this->session->userdata('P2')=="Y"  || 1==1) { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>specialSheet/Vascular/" >Vascular 特殊表單(血管 Lite)</a></td>
                            </tr>
                             <?php } ?>
                            <?php if($this->session->userdata('P3')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>exportPatient/inFile/" >以EXCEL檔案匯入貴院病患資料</a></td>
                            </tr>
                             <?php } ?>
                             <?php if($this->session->userdata('P4')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/CRmorning/" >使用 CR Morning Meeting 報表 /for Open Heart</a></td>
                            </tr>
                             <?php } ?>
                             <?php if($this->session->userdata('P5')=="Y") { ?>
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/CRmorningVascular/" >使用 CR Morning Meeting 報表 /for Vascular</a></td>
                            </tr>
                             <?php } ?>
                        </tbody> 
                    </table>
                </div>
                   <?php } ?>
          
   