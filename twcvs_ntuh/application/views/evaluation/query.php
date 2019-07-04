<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="number">
                      <select name="qryField" id="qryField" class="medium">
                                   <option value="0" <?php if($qField=="0") echo "selected";?> >查詢欄位</option>
                                   <option value="1" <?php if($qField=="1") echo "selected";?>  >chart number</option>
                                   <option value="2" <?php if($qField=="2") echo "selected";?>  >Name</option>
                                   <option value="3" <?php if($qField=="3") echo "selected";?>   >Surgeon</option>
                                   </select>
                           <input type="text" name="qryText"   id="qryText"   class="small"    value="<?php echo $qStr;?>" style="vertical-align: bottom;" placeholder="Keyword"/>
                          <select name="qryOrder" id="qryOrder" class="medium">
                               <option value="0"   <?php if($qOrder=="0") echo "selected";?>>排序方式</option>
                                    <option value="5"   <?php if($qOrder=="5") echo "selected";?>  >Age(遞增)</option>
                                   <option value="7"   <?php if($qOrder=="7") echo "selected";?>  >Age(遞減)</option>
                                   <option value="6"   <?php if($qOrder=="6") echo "selected";?>  >Operation Date(遞增)</option>   
                                   <option value="8"   <?php if($qOrder=="8") echo "selected";?>  >Operation Date(遞減)</option>
                                  
                                   <option value="1"  <?php if($qOrder=="1") echo "selected";?>  >chart number</option>
                                   <option value="2"   <?php if($qOrder=="2") echo "selected";?> >Name</option>
                                   <option value="3"  <?php if($qOrder=="3") echo "selected";?>   >Surgeon</option>
                                   <option value="4"  <?php if($qOrder=="4") echo "selected";?>   >Birthday</option>
                                   </select>
                      <button  class="blue medium" onclick="javascript: qryPatient();"  style="vertical-align: bottom;"><span>查詢</span></button>  
                       <button  class="green medium" onclick="javascript: window.location='<?php echo base_url(); ?>evaluation/addPatient';"  style="vertical-align: bottom;"
                            onmouseover="$(this).notify('新增EUROSCORE II資料, \n\需輸入病患資料及生日','info');"
                            onmouseout="$(this).notify('');"
                           ><span>新增病患</span></button>
                     </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Chart Number</th>
                               <th nowrap>Name</th>
                                <th nowrap>Birthday</th>
                                <th nowrap>Age</th>
                                <th nowrap>Age Unit</th>
                                <th nowrap>Gender</th>
                                <th nowrap>Operation Date</th>
                                <th nowrap>Surgeon</th>
                                <th nowrap>Action</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($patientList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientChartNumber;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo mb_substr_replace($row->patientName,'O',1,1);?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo str_replace('0000-00-00', '', $row->patientBirthday);?></td>
                                 <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientAge;?>  </td>
                                 <td style="padding : 2px 8px;line-height : 10px;">
                                     <?php 
                            if($row->patientAgeUnit=="1") {
                                echo "歲";
                            }
elseif($row->patientAgeUnit=="2"){
    echo  "月";
} else {
    echo   "天";
} ?>
                                 </td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientGender;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo str_replace('0000-00-00', '', $row->patientOpDate);?></td>
                               <td style="padding : 2px 8px;line-height : 10px;"><?php 
                            echo $row->patientSurgeon.($row->patientSurgeon2==""?"":"<br/>".$row->patientSurgeon2).($row->patientSurgeon3==""?"":"<br/>".$row->patientSurgeon3).($row->patientSurgeon4==""?"":"<br/>".$row->patientSurgeon4);
                            ?></td>
                                <td style="padding : 2px 8px;line-height : 10px;">
                                    <button  class="blue medium" onclick="javascript: window.open('<?php echo base_url(); ?>evaluation/viewRecord/<?php echo $row->patientID;?>','new');"><span>查看</span></button>
                                    <?php if($row->patientOpDate=="" || $row->patientOpDate=="0000-00-00") { ?>
                                    <button  class="grey medium" id="transButton<?php echo $row->patientID;?>" 
                                    onmouseover="$(this).notify('請先填寫OP Date並存檔後, \n\n 才能匯入病患資料庫','error');"
                                    onmouseout="$(this).notify('');"
                                    onclick="javascript:return false;" ><span>匯入</span></button>
                                    <?php } else { ?>
                                    <button  class="orange medium" id="transButton<?php echo $row->patientID;?>" 
                                    onmouseover="$(this).notify('匯出到病患列表, \n\n匯出成功後此筆資料\n\n即會從術前評估中刪除','info');"
                                    onmouseout="$(this).notify('');"
                                    onclick="javascript:if(confirm('資料轉入後會再術前評估中資料刪除?')){ evaluationTrans('<?php echo $row->patientID;?>','<?php echo $row->patientOpDate;?>','<?php echo $row->patientChartNumber;?>');return false;}" ><span>匯入</span></button>
                                    <?php }  ?>
                                     <button  class="red medium" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>evaluation/deleteRecord/<?php echo $row->patientID;?>';}" ><span>刪除</span></button>
                                   
                                </td>
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                    <br/>
                     <?php echo $Pagination_str; ?>
                </div>
            </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>

<script>
    function evaluationTrans(pid,opdate,chartnumber){
    
    if(opdate!="" && chartnumber!="" && opdate!='0000-00-00' ){
          $.ajax({
                        type:"POST",
                        url: "<?php echo base_url(); ?>evaluation/evaluationTrans/",
                        cache: false,
                        data:
                            {
                            patientID:pid,
                            patientOPdate:opdate
                            
                            },
                        datatype: "JSON",
                        success: function(data){
                                if(JSON.parse(data).status=="success"){
                                 showNotify('0','轉入成功');
                                } else {
                                       if(JSON.parse(data).result=="1"){
                                            showNotify('1','該資料己存在病患資料庫, 轉入失敗');
                                       } else {
                                            showNotify('1','該資料不存在術前評估中, 轉入失敗');
                                       }
                                }
                                     
                        }
                            
                    });
    } else {
        alert('必須填寫Operation Date及chart number才能轉入病患資料庫');
        return false;
    }
}
function showNotify(t,m){
    if(t=="1"){
        $.notify(m, "error");
    } else {
$.notify(m, "success");
}
}

function qryPatient(){
        if($('#qryText').val()=="" && 1==2){
            $('#qryText').notify("請輸入關鍵字", "info");
        } else {
            window.location='<?php echo base_url(); ?>evaluation/index/'+$('#qryField').val()+'/'+$('#qryOrder').val()+'/'+$('#qryText').val();
        }
    }
</script>



</body>

</html> 