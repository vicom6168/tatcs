<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<?php

    $availableTags = array(
        "0"=>"個案於申報醫院接受在首次療程的放射治療",
        "1"=>"放射治療不是既定之首次療程計畫中的一部分<br>個案選擇積極監測或予以密切觀察 ",
        "2"=>"因禁忌症或個案其他危險因素(併發症、年邁)或疾病進展而未建議或給予放射 治療",
        "5"=>"放射治療是既定之首次療程計畫中的一部分，但因個案未接受前即死",
        "6"=>"放射治療是既定之首次療程計畫中的一部分，轉介他院，或未執行且病歷也未 記載未執行的原因 ",
        "7"=>"放射治療是既定之首次療程計畫中的一部分，但病歷記載個案或其家屬拒絕放 射治療",
        "8"=>"放射治療雖是既定之首次療程計畫中的一部分，但摘錄時尚未執",
        "9"=>"由於病歷未記載，所以不知道放射治療是否有被建議或是已經執行<br>個案是在死後解剖後才診斷癌症 <br>僅由死亡證明書得知個案有癌症"
    ); 
    ?>
    
<body>

<div class="container">   
  

    
    <div class="section">
        <div class="full">
            <div class="box">
                    <div class="number">
                
                   <input type="text" name="qrySubject"   id="qrySubject"   class="big"    value="" />
                   <button  class="blue medium" onclick="javascript: confirmAdultDiagnosis();"><span>確認</span></button>  
                    </div>
                <div class="content" style="width:750px;height:280px;overflow:auto;">
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                 <tr> 
                               <th nowrap>No.</th>
                               <th nowrap>Code</th>
                               <th nowrap>Subject</th>
                            </tr> 
                               
                            </tr> 
                        </thead> 
                        <tbody> 
                            <?php 
                           foreach($availableTags as $x=>$x_value){
                                   
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;"><input type="radio" class="checkbox" name="outcomeCheck1" id="outcomeCheck1"  value="Y" onclick="chkAdultDiagnosis('<?php echo $x;?>','', '<?php echo  $x_value;?>');"></td>
                                 <td style="padding : 2px 8px;"><?php echo $x;?></td>
                                 <td style="padding : 2px 8px;"><?php echo  $x_value;?></td>
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
    
     <input type="hidden" name="diagnosis_id" id="diagnosis_id" class="small" value="" />
     <input type="hidden" name="diagnosis_cat" id="diagnosis_cat" class="small" value="" />
     <input type="hidden" name="diagnosis_sub" id="diagnosis_sub" class="small" value="" />
    <input type="hidden" name="diagnosis_w" id="diagnosis_w" class="small" value="" />
    
</div>

<script>
    function chkAdultDiagnosis(id,code,subject){
        $("#diagnosis_id").val(id);
        $("#diagnosis_sub").val(subject);
        $("#qrySubject").val(subject);
    }
     function confirmAdultDiagnosis(){
        
        if($("#diagnosis_id").val()!="" &&       $("#diagnosis_sub").val()!="" &&    $("#qrySubject").val()!="")
        {
         parent.showNonRTReason($("#diagnosis_id").val(),$("#diagnosis_cat").val(),$("#diagnosis_sub").val());
         parent.jQuery.fancybox.close();
         } else {
            $("#diagnosis_id").val('');
            $("#diagnosis_cat").val('');
            $("#diagnosis_sub").val('');
            $("#qrySubject").val('');
            $("#qrySubject").notify("請選取診斷", "error");
        }
    }
</script>


</body>

</html> 