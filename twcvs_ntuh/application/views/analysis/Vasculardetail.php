<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
 <style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
  </style>
 
<body>

<div class="container">   
  

    
    <div class="section">
        <div class="full">
            <div class="box">
            
                <div class="content" style="width:750px;height:280px;overflow:auto;">

                    <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                               <th nowrap>No.</th>
                               <th nowrap>Code</th>
                               <th nowrap>Subject</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            foreach($ans->result() as $row){
                                   
                            ?>
                          
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 15px;"><?php echo trim($row->code);?></td>
                                 <td style="padding : 2px 8px;line-height : 15px;"><?php echo trim($row->subject);?></td>
                                 <td style="padding : 2px 8px;line-height : 15px;"><?php echo trim($row->totalSum);?></td>
                            </tr>
                             
                           
                                
                            <?php 
                            } ?>
                               
                        </tbody> 
                    </table>
                    <br/>
                   
                </div>
            </div>
        </div>
    </div>
    
    
</div>



</body>

</html> 