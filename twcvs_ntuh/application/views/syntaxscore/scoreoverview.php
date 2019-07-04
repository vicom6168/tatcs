<div id="resultImage"></div>
<div id="resultBlock"></div>
<div id="resultPrintBlock"></div>
     <form action="<?php echo base_url(); ?>patient/saveSyntaxscore" method="post">
           <div class="line button">
                           <input type="hidden" name="syntaxscore_reult"  id="syntaxscore_reult" value="">
                           <input type="hidden" name="syntaxscore_reultPrint"  id="syntaxscore_reultPrint" value="">
                           <input type="hidden" name="syntaxscore_reultTable"  id="syntaxscore_reultTable" value="">
                            <button type="submit" class="blue medium"><span>Save</span></button>
                            <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $p->patientID;?>" />
                        </div>
      </form>
<br>


