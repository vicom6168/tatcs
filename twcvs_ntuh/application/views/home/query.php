<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<script>
function refreshBooking(qDate){
    window.location='<?php echo base_url(); ?>home/query/'+qDate;
}    
function showAdvanceResults(obj,r){
    //alert($('#bookingResult_'+r).val());
    if($('#bookingResult_'+r).val()=="給床"){
        $('#b_'+r).show();
        $('#u_'+r).hide();
     } else {
         $('#b_'+r).hide();
         $('#u_'+r).show();
     }
}

function saveResult(t,r){
    $.ajax({
                    type:"POST",
                    url: "<?php echo base_url(); ?>home/saveResult",
                    cache: false,
                    data:
                        {
                         bookingID:r,
                         bookingResult:$('#bookingResult_'+r).val(),
                         givenBed:$('#givenBed_'+r).val(),
                         bookingReason:$('#bookingReason_'+r).val(),
                         bookingResultType:t
                        },
                    datatype: "JSON",
                    success: function(data){
                            if(JSON.parse(data).status=="success"){
                                var result = JSON.parse(data).result;
                                var innerHtml= "";
                                 
                                 if(result[0].bookingResult=="給床")
                                 innerHtml=result[0].bookingResult  +":"+result[0].bedSubject;
                                 else
                                 innerHtml=result[0].bookingResult  +":"+result[0].bookingReason;
                                $("#finalResult_"+result[0].bookingID).empty();
                                $("#finalResult_"+result[0].bookingID).append(innerHtml);
                        }
                    }
                        
                        
                });
               
}
</script>
<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>各科別訂床列表</h2>
                    
                </div>
                <div class="content">
                    <span class="date">訂床日期</span>
                            <input type="text" class="datepicker" value="<?php echo $queryDate;?>"  onchange="javascript:refreshBooking(this.value);"/>
           
                <div class="messages orange">
                    <span></span>
                    重要提醒：序號為各科的訂位順序，不是入住順序，若床位不足，則以total quota床數少者優先。
                </div>
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>序號</th>
                                <th nowrap>科別</th>
                                <th nowrap>來源</th>
                                <th nowrap>病歷號碼</th>
                                <th nowrap>姓名</th>
                                <th nowrap>性別</th>
                                <th nowrap>主治醫師</th>
                                <th nowrap>診斷</th>
                                <th nowrap>床等需求</th>
                                <th nowrap>不要的床等</th>
                                <th nowrap>訂床者</th>
                                <th nowrap>手機</th>
                                <th nowrap>分配</th>
                                <th nowrap></th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            foreach($viewBooking->result() as $row){
                            ?>
                            <tr> 
                                <td><?php echo ++$i;?></td>
                                <td><?php echo $row->specialtySubject;?></td>
                                <td><?php echo $row->patientSource;?></td>
                                 <td><?php echo $row->patientChart;?></td>
                                <td><?php echo $row->patientName;?></td>
                                <td><?php  if($row->patientSex=="1") echo "男"; else echo "女";?></td>
                                <td><?php echo $row->vsName;?></td>
                                <td><?php echo $row->patientDignosis;?></td>
                                <td><?php echo $row->requestBed;?></td>
                                <td><?php echo $row->exclusiveBed;?></td>
                                <td><?php echo $row->bookingUsername;?></td>
                                <td><?php echo $row->bookingUserTel;?></td>
                                <td>
                                    <span id="finalResult_<?php echo $row->bookingID;?>">
                                    <?php if($this->session->userdata('isAdmin') =="1") { ?>
                                    
                                        <span id="r_<?php echo $row->bookingID;?>">
                                             <select name="bookingResult_<?php echo $row->bookingID;?>" id="bookingResult_<?php echo $row->bookingID;?>"  class="small" onchange="javascript:showAdvanceResults(this,'<?php echo $row->bookingID;?>');">
                                              <option value=""></option>
                                              <option value="給床"  <?php if($row->bookingResult=="給床")  echo "selected";?>>給床</option>
                                              <option value="不給床"  <?php if($row->bookingResult=="不給床")  echo "selected";?>>不給床</option>
                                            </select>
                                            <span id="b_<?php echo $row->bookingID;?>" <?php if($row->bookingResult!="給床")  echo "style='display:none;'";?> >
                                             <select name="givenBed_<?php echo $row->bookingID;?>" id="givenBed_<?php echo $row->bookingID;?>" class="small">
                                                 <option value=""></option>
                                               <?php 
                                                $i=0;
                                                foreach($viewBeds->result() as $rowBed){
                                                ?>
                                                 <?php if($row->givenBed==$rowBed->bedID){ ?>
                                                <option value="<?php echo $rowBed->bedID;?>" selected ><?php echo $rowBed->bedSubject;?></option>
                                                <?php } else {?>
                                                 <option value="<?php echo $rowBed->bedID;?>" ><?php echo $rowBed->bedSubject;?></option>   
                                                <?php } ?>
                                                <?php } ?>
                                               
                                            </select>
                                            <?php if(strtotime($row->bookingDate)>=strtotime(date("Y-m-d"))) { ?>
                                              <br/><button type="button" class="blue" onclick="javascript:saveResult(1,'<?php echo $row->bookingID;?>');"><span>存檔</span></button>
                                            <?php } ?>
                                            </span>
                                        </span>
                                        <span id="u_<?php echo $row->bookingID;?>"  <?php if($row->bookingResult!="不給床")  echo "style='display:none;'";?>>
                                             <select name="bookingReason_<?php echo $row->bookingID;?>" id="bookingReason_<?php echo $row->bookingID;?>"  class="small">
                                                 <option value=""></option>
                                                <option value="沒床位" <?php if($row->bookingReason=="沒床位")  echo "selected";?>>沒床位</option>
                                                <option value="不符規定" <?php if($row->bookingReason=="不符規定")  echo "selected";?>>不符規定</option>
                                               
                                            </select>
                                            <?php if(strtotime($row->bookingDate)>=strtotime(date("Y-m-d"))) { ?>
                                              <br/><button type="button" class="blue"  onclick="javascript:saveResult(2,'<?php echo $row->bookingID;?>');"><span>存檔</span></button>
                                            <?php } ?>
                                            </span>
                                        </span>
                                    
                                    <?php } else { 
                                    echo "".$row->bookingResult.":".$row->bookingReason.$row->bed; 
                                    } ?>
                                    
                                    </span>
                                    </td>
                                <td>
                                    <?php if($this->session->userdata('isAdmin') =="1" || $this->session->userdata('bookingID') ==$row->specialtyID) { ?>
                                    <a href="#" onclick="javascript: window.location='<?php echo base_url(); ?>home/viewBooking/<?php echo $row->bookingID;?>';"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <?php if($row->bookingResult<>"給床" && $row->bookingResult<>"不給床"  && strtotime($row->bookingDate)>=strtotime(date("Y-m-d"))){ ?>
                                    <a href="#" onclick="javascript:if(confirm('您確定要刪除嗎?')){ window.location='<?php echo base_url(); ?>home/deleteBooking/<?php echo $row->bookingID;?>';}" ><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                    <?php } ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                             
                        </tbody> 
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>

</html> 