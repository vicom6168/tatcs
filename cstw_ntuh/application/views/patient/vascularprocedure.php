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
   <script>

    var availableTags = []; 
    var availableIndex = [];
    var availableCat = [];
    var availableID = [];
    
    <?php foreach($Procedure->result() as $row){ ?>
        availableTags.push('<?php echo trim($row->subject);?>');
        availableIndex.push('<?php echo trim($row->code);?>');
        availableCat.push('<?php echo trim($row->category);?>');
        availableID.push('<?php echo trim($row->id);?>');
     <?php } ?>
        $( function() {
    $( "#qrySubject" ).autocomplete({
      source: availableTags,
      
    });
      } );
    function chkaa(){
   alert($( "#qrySubject" ).val());
     alert( availableIndex[availableTags.indexOf($( "#qrySubject" ).val())]);
  }

  
  </script>
<body>

<div class="container">   
  

    
    <div class="section">
        <div class="full">
            <div class="box">
                    <div class="number">
                
                   <input type="text" name="qrySubject"   id="qrySubject"   class="big"    value="" />
                   <button  class="blue medium" onclick="javascript: confirmProcedure();"><span>確認</span></button>  
                    </div>
                         
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
                            $currentCategory="";
                            foreach($Procedure->result() as $row){
                                   
                            ?>
                            <?php if($row->category!=$currentCategory){ ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 10px;background-color: #79BAEC"></td>
                                <td width="12%"  style="padding : 2px 8px;line-height : 10px;background-color: #79BAEC"></td>
                                <td colspan="1"  style="padding : 2px 8px;line-height : 10px;background-color: #79BAEC"><?php echo $row->category;?></td>
                                 
                            </tr>
                              <?php } ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 10px;"><input type="radio" class="checkbox" name="outcomeCheck1" id="outcomeCheck1"  value="Y" onclick="chkProcedure('<?php echo $row->code;?>','<?php echo $row->category;?>', '<?php echo $row->subject;?>');"></td>
                                 <td style="padding : 2px 8px;line-height : 10px;"><?php echo trim($row->code);?></td>
                                 <td style="padding : 2px 8px;line-height : 10px;"><?php echo trim($row->subject);?></td>
                            </tr>
                             
                           
                                
                            <?php 
                            $currentCategory=$row->category;
                            } ?>
                               
                        </tbody> 
                    </table>
                    <br/>
                   
                </div>
            </div>
        </div>
    </div>
    
     <input type="hidden" name="procedure_id" id="procedure_id" class="small" value="" />
     <input type="hidden" name="procedure_cat" id="procedure_cat" class="small" value="" />
     <input type="hidden" name="procedure_sub" id="procedure_sub" class="small" value="" />
    <input type="hidden" name="procedure_w" id="procedure_w" class="small" value="<?php echo $w;?>" />
    
</div>

<script>
    function chkProcedure(id,category,subject){
        $("#procedure_id").val(id);
        $("#procedure_cat").val(category);
        $("#procedure_sub").val(subject);
        $("#qrySubject").val(subject);
    }
     function confirmProcedure(){
       if( $("#qrySubject").val()!=""){
           $("#procedure_id").val(availableIndex[availableTags.indexOf($( "#qrySubject" ).val())]);
           $("#procedure_cat").val(availableCat[availableTags.indexOf($( "#qrySubject" ).val())]);
           $("#procedure_sub").val($( "#qrySubject" ).val());
       }
        if($("#procedure_id").val()!="" &&    $("#procedure_cat").val()!="" &&     $("#procedure_sub").val()!="" &&    $("#qrySubject").val()!="")
        {
         parent.showProcedure($("#procedure_w").val(),$("#procedure_id").val(),$("#procedure_cat").val(),$("#procedure_sub").val());
         parent.jQuery.fancybox.close();
         } else {
            $("#procedure_id").val('');
            $("#procedure_cat").val('');
            $("#procedure_sub").val('');
            $("#qrySubject").val('');
            $("#qrySubject").notify("請選取Procedure", "error");
        }
    }
</script>


</body>

</html> 