<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
<script>

function showAdvanceResults(obj){
    //alert($('#bookingResult_'+r).val());
    if($('#bookingResult').val()=="給床"){
        $('#Bed').show();
        $('#Reason').hide();
        $('#bookingReason').val('');
     } else {
         $('#Bed').hide();
         $('#Reason').show();
         $('#givenBed').val('');
     }
}


</script>
<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 
       <div class="section">
        <div class="big">
            <div class="box">
                <div class="content forms">
                <div class="title">
                    <h2>修改訂床資料</h2>
                </div>
                
                 <?php if($error_msg!='') { ?>
                            <div class="messages red">
                            <span></span>
                            <?php echo $error_msg;?>
                            </div>
                  <?php  } ?>
                   <?php if($success_msg!='') { ?>
                            <div class="messages green">
                            <span></span>
                            <?php echo $success_msg;?>
                            </div>
                  <?php  } ?>
                    <form action="<?php echo base_url(); ?>home/bookingUpdate" method="post">
                        <div class="line">
                            <label>訂床科別</label>
                            <?php echo $viewSpecialty->specialtySubject;?>
                            <input type="hidden" name="bookingSpecialty" class="small" value="<?php echo $viewBooking->bookingSpecialty;?>" />
                            <input type="hidden" name="bookingID" class="small" value="<?php echo $viewBooking->bookingID;?>" />
                            <input type="hidden" name="bookingDateTime" class="small" value="<?php echo $viewBooking->bookingDateTime;?>" />
                            
                        </div>
                        <div class="line">
                            <label>訂床日期</label>
                            <?php echo $viewBooking->bookingDate;?>
                            <input type="hidden" name="bookingDate" class="small" value="<?php echo $viewBooking->bookingDate;?>" />
                        </div>
                         <div class="line">
                            <label>病患來源</label>
                            <select name="patientSource" >
                              <option value=""></option>
                              <option value="急診"  <?php if($viewBooking->patientSource=="急診") echo "selected";?>>急診</option>
                              <option value="病房" <?php if($viewBooking->patientSource=="病房") echo "selected";?>>病房</option>
                              <option value="ICU" <?php if($viewBooking->patientSource=="ICU") echo "selected";?>>ICU</option>
                              <option value="其它醫院" <?php if($viewBooking->patientSource=="其它醫院") echo "selected";?>>其它醫院</option>
                              <option value="門診"  <?php if($viewBooking->patientSource=="門診") echo "selected";?>>門診</option>
                              <option value="其它" <?php if($viewBooking->patientSource=="其它") echo "selected";?>>其它</option>
                            </select>
                        </div>
                        <div class="line">
                            <label>病歷號碼</label>
                            <input type="text" name="patientChart"  class="small" value="<?php echo $viewBooking->patientChart;?>" />
                        </div>
                        <div class="line">
                            <label>姓名</label>
                            <input type="text" name="patientName"  class="small" value="<?php echo $viewBooking->patientName;?>" />
                        </div>
                        <div class="line">
                            <label>性別</label>
                            <input type="radio" name="patientSex" id="sex1"  value="1" <?php if($viewBooking->patientSex=="1") echo "checked";?>/> 
                            <label for="sex1">男</label>
                            
                            <input type="radio" name="patientSex" id="sex2" value="2" <?php if($viewBooking->patientSex=="2") echo "checked";?>/> 
                            <label for="sex2">女</label>
                        </div>
                          <div class="line">
                            <label>診斷</label>
                            <input type="text" name="patientDignosis"  class="medium" value="<?php echo $viewBooking->patientDignosis;?>" />
                        </div>
                        <div class="line">
                            <label>床等需求</label>
                            <select name="requestBed" >
                                <option value=""></option>
                               <option value="單人"   <?php if($viewBooking->requestBed=="單人") echo "selected";?> >單人</option>
                               <option value="雙人"  <?php if($viewBooking->requestBed=="雙人") echo "selected";?>>雙人</option>
                               <option value="健保"  <?php if($viewBooking->requestBed=="健保") echo "selected";?>>健保</option>
                               <option value="單或雙"   <?php if($viewBooking->requestBed=="單或雙") echo "selected";?>>單或雙</option>
                               <option value="雙或健保"   <?php if($viewBooking->requestBed=="雙或健保") echo "selected";?>>雙或健保</option>
                               <option value="皆可"   <?php if($viewBooking->requestBed=="皆可") echo "selected";?>>皆可</option>

                            </select>
                        </div>
                        <div class="line">
                            <label>一定不要的床等</label>
                            <select name="exclusiveBed" >
                              <option value=""></option>
                              <option value="無特殊需求" <?php if($viewBooking->exclusiveBed=="無特殊需求") echo "selected";?>>無特殊需求</option>
                              <option value="單人"   <?php if($viewBooking->exclusiveBed=="單人") echo "selected";?>>單人</option>
                              <option value="雙人"  <?php if($viewBooking->exclusiveBed=="雙人") echo "selected";?>>雙人</option>
                              <option value="健保"  <?php if($viewBooking->exclusiveBed=="健保") echo "selected";?>>健保</option>
                              <option value="單或雙"  <?php if($viewBooking->exclusiveBed=="單或雙") echo "selected";?>>單或雙</option>
                              <option value="雙或健保"  <?php if($viewBooking->exclusiveBed=="雙或健保") echo "selected";?>>雙或健保</option>

                            </select>
                        </div>
                        
                    <div class="title">
                    <h2>訂床者聯絡資訊</h2>
                </div>
                
                   
                      <div class="line">
                            <label>主治醫師</label>
                            <select name="bookingVS" >
                                <option value=""></option>
                                <?php   foreach($viewVS->result() as $row) {          ?>
                                <?php if($row->vsID==$viewBooking->bookingVS) {?>
                                <option value="<?php echo $row->vsID;?>" selected><?php echo $row->vsName;?></option>
                                <?php } else { ?>
                                 <option value="<?php echo $row->vsID;?>"><?php echo $row->vsName;?></option>   
                               <?php } ?>     
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="line">
                            <label>訂床者</label>
                           員       編: <input type="text" name="bookingUserEmpID"  class="small" value="<?php echo $viewBooking->bookingUserEmpID;?>" /><br/>
                           姓       名: <input type="text" name="bookingUsername"  class="small" value="<?php echo $viewBooking->bookingUsername;?>" /><br/>
                           手       機: <input type="text" name="bookingUserTel"  class="small" value="<?php echo $viewBooking->bookingUserTel;?>" />
                        </div>
                        <div class="line">
                            <label>特殊事項</label>
                            <input type="text" name="bookingNotes"  class="medium" value="<?php echo $viewBooking->bookingNotes;?>" />
                        </div>
                        
                        <div class="title">
                        <h2>分配床位核定資料</h2>
                        </div>
                        <?php if($this->session->userdata('isAdmin') =="1") { ?>
                                                <div class="line">
                                                    <label>是否給床</label>
                                                    <select name="bookingResult" id="bookingResult"  class="small" onchange="javascript:showAdvanceResults(this);">
                                                                      <option value=""></option>
                                                                      <option value="給床" <?php if($viewBooking->bookingResult=="給床")  echo "selected";?>>給床</option>
                                                                      <option value="不給床" <?php if($viewBooking->bookingResult=="不給床")  echo "selected";?>>不給床</option>
                                                                    </select>
                                                </div>
                                                <div class="line" id="Bed">
                                                    <label>床位</label>
                                                    <select name="givenBed" id="givenBed" class="small">
                                                                         <option value=""></option>
                                                                       <?php 
                                                                        $i=0;
                                                                        foreach($viewBeds->result() as $rowBed){
                                                                        ?>
                                                                             <?php if($rowBed->bedID==$viewBooking->givenBed) {?>
                                                                            <option value="<?php echo $rowBed->bedID;?>" selected><?php echo $rowBed->bedSubject;?></option>
                                                                            <?php } else { ?>
                                                                            <option value="<?php echo $rowBed->bedID;?>" ><?php echo $rowBed->bedSubject;?></option>
                                                                            <?php } ?>
                                                                       <?php } ?>
                                                                    </select>
                                                 </div>
                                                 
                                                 <div class="line" id="Reason">
                                                    <label>沒給床原因</label>
                                                    <select name="bookingReason" id="bookingReason"  class="small">
                                                                         <option value=""></option>
                                                                        <option value="沒床位"  <?php if($viewBooking->bookingReason=="沒床位")  echo "selected";?>>沒床位</option>
                                                                        <option value="不符規定"  <?php if($viewBooking->bookingReason=="不符規定")  echo "selected";?>>不符規定</option>
                                                                       
                                                                    </select>
                                                 </div>
                                                 <?php if(strtotime($viewBooking->bookingDate)>=strtotime(date("Y-m-d"))) { ?>
                                                <div class="line button">
                                                    <button type="submit" class="blue medium"><span>送出</span></button>
                                                    <button type="reset" class="blue medium"><span>重填</span></button>
                                                </div>
                                                <?php  } else {?>
                                                    <div class="messages green">
                                                    <span></span>
                                                    訂床日期已過, 無法再進行分配床位或資料修改
                                                    </div>
                                                 <?php  }?>
                                <?php  } else {?>
                                                <div class="line">
                                                    <label>是否給床</label>
                                                    <?php echo $viewBooking->bookingResult;?>&nbsp;
                                                    <input type="hidden" name="bookingResult" class="small" value="<?php echo $viewBooking->bookingResult;?>" />
                                                </div>
                                                <div class="line">
                                                    <label>床位</label>
                                                   <?php echo $viewBedsubject;?>&nbsp;
                                                   <input type="hidden" name="givenBed" class="small" value="<?php echo $viewBooking->givenBed;?>" />
                                                 </div>
                                                 
                                                 <div class="line">
                                                    <label>沒給床原因</label>
                                                    <?php echo $viewBooking->bookingReason;?>&nbsp;
                                                    <input type="hidden" name="bookingReason" class="small" value="<?php echo $viewBooking->bookingReason;?>" />
                                                 </div>
                                                 <?php if(strtotime($viewBooking->bookingDate)>=strtotime(date("Y-m-d"))) { ?>
                                                     <?php if($viewBooking->bookingResult<>"給床" && $viewBooking->bookingResult<>"不給床" ){ ?>
                                                          <div class="line button">
                                                            <button type="submit" class="blue medium"><span>送出</span></button>
                                                            <button type="reset" class="blue medium"><span>重填</span></button>
                                                        </div>
                                                    <?php  } else {?>
                                                         <div class="messages orange">
                                                            <span></span>
                                                            管理者已分配床位, 無法再進行資料修改
                                                            </div>
                                                    <?php  }?>    
                                                <?php  } else {?>
                                                    <div class="messages green">
                                                    <span></span>
                                                    訂床日期已過, 無法再進行分配床位或資料修改
                                                    </div>
                                               <?php  }?>
                                    
                                    
                                <?php  }?>
                </div>
                </form>
            </div>
        </div>
        
        <div class="small">
            <div class="box">
                <div class="title">
                    <h2><?php echo  $viewBooking->bookingDate;?>&nbsp<?php echo $viewSpecialty->specialtySubject;?> 已訂之名單</h2>
                    <span class="hide"></span>
                </div>
                <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>序號</th>
                                <th nowrap>病歷號碼</th>
                                <th nowrap>姓名</th>
                                <th nowrap>性別</th>
                                <th nowrap>主治醫師</th>
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                              <?php 
                            $i=0;
                            foreach($viewBookingSpecialty->result() as $row){
                            ?>
                            <tr> 
                                <td><?php echo ++$i;?></td>
                                <td><a href="#"><?php echo $row->patientChart;?></a></td>
                                <td> <?php echo $row->patientName;?></td>
                                <td><?php  if($row->patientSex=="1") echo "男"; else echo "女";?></td>
                                <td><?php echo $row->vsName;?></td>
                            </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
  
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
<?php  if($viewBooking->bookingResult=="給床" && $this->session->userdata('isAdmin') =="1") {?>
     $('#Bed').show();
     $('#Reason').hide();
<?php  } else { ?>
    $('#Bed').hide();
    $('#Reason').show();
<?php } ?>
</script>
</html> 