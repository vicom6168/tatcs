<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<?php 
$completeImage=array(
""=>"",
"Y"=>"/images/cross.png",
"N"=>"/images/tick.png"
);


?>
<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="number">
                    <select name="qryField" id="qryField" class="small">
                                   <option value="0" <?php if($qField=="0") echo "selected";?> >欄位</option>
                                   <option value="1" <?php if($qField=="1") echo "selected";?>  >病歷號</option>
                                   <option value="2" <?php if($qField=="2") echo "selected";?>  >姓名</option>
                                   <option value="3" <?php if($qField=="3") echo "selected";?>  >醫師</option>
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
                                   <select name="qryCondition" id="qryCondition" class="medium">
                                   <option value="0" <?php if($qCondition=="0") echo "selected";?> >查看所有未完成資料</option>
                                   <option value="1" <?php if($qCondition=="1") echo "selected";?>  >只看 Patient profile未完成資料</option>
                                   <option value="2" <?php if($qCondition=="2") echo "selected";?>  >只看 Operation procedures未完成資料</option>
                                   <option value="3" <?php if($qCondition=="3") echo "selected";?>  >只看 Outcome Resulte未完成資料</option>
                                   </select>
                      <button  class="blue medium" onclick="javascript: qryPatient();"  style="vertical-align: bottom;"><span>查詢</span></button>  
                      <a class="various" data-fancybox-type="iframe" href="/patient/uncompleteMemo"><button  class="orange medium" style="vertical-align: bottom;"><span>未完成資料說明</span></button> </a>
                      </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
                                <th nowrap>Chart Number</th>
                               <th nowrap>Name</th>
                                <th nowrap>Operation Date</th>
                                <th nowrap>Surgeon</th>
                                <th nowrap>Profile</th>
                                <th nowrap>Procedures</th>
                                <th nowrap>Outcome</th>
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
                                 <td style="padding : 2px 8px;line-height : 10px;"><?php echo str_replace('0000-00-00', '', $row->patientOpDate);?></td>
                            <td style="padding : 2px 8px;line-height : 10px;"><?php 
                            echo $row->patientSurgeon;
                            ?></td>
                            <td style="padding : 2px 8px;line-height : 10px;"><img src="<?php echo $completeImage[$row->uncomplete_1];?>" width="16" height="16"></td>
                            <td style="padding : 2px 8px;line-height : 10px;"><img src="<?php echo $completeImage[$row->uncomplete_2];?>" width="16" height="16"></td>
                            <td style="padding : 2px 8px;line-height : 10px;"><img src="<?php echo $completeImage[$row->uncomplete_3];?>" width="16" height="16"></td>
                                <td style="padding : 2px 8px;line-height : 10px;">
                                     <button  class="blue medium" onclick="javascript: window.open('<?php echo base_url(); ?>patient/viewRecord/<?php echo $row->patientID;?>','new');"><span>查看</span></button>
                                    <?php if($this->session->userdata('isAdmin')=="Y") { ?>
                                          <button  class="red medium" onclick="javascript:if(confirm('Press confirm to delete this data?')){ window.location='<?php echo base_url(); ?>patient/deleteRecord/<?php echo $row->patientID;?>';}" ><span>刪除</span></button>
                                   <?php } ?>
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
    function qryPatient(){
        if($('#qryText').val()=="" && 1==2){
            $('#qryText').notify("請輸入關鍵字", "info");
        } else {
            window.location='<?php echo base_url(); ?>patient/uncomplete/'+$('#qryField').val()+'/'+$('#qryOrder').val()+'/'+$('#qryCondition').val()+'/'+$('#qryText').val();
        }
    }
    $(document).ready(function() {
    $(".various").fancybox({
        maxWidth    : 500,
        maxHeight   : 900,
        fitToView   : true,
        titleShow: true,               
autoscale: false,               
autoDimensions: false ,
        width       : '50%',
        height      : '100%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    })
    });
</script>


</body>

</html> 