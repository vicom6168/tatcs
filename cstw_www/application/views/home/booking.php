<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 
       <div class="section">
        <div class="big">
            <div class="box">
                <div class="content forms">
                <div class="title">
                    <h2>病患基本資料</h2>
                </div>
                
                    <form action="<?php echo base_url(); ?>home/bookingSave" method="post">
                        <div class="line">
                            <label>訂床科別</label>
                            <?php echo $this->session->userdata('bookingName')?>
                        </div>
                        <div class="line">
                            <label>訂床日期</label>
                            <?php echo $booking_Date;?>
                            <input type="hidden" name="bookingDate" class="small" value="<?php echo $booking_Date;?>" />
                        </div>
                         <div class="line">
                            <label>病患來源</label>
                            <select name="patientSource" >
                              <option value=""></option>
                              <option value="急診"  >急診</option>
                              <option value="病房" selected>病房</option>
                              <option value="ICU" >ICU</option>
                              <option value="其它醫院" >其它醫院</option>
                              <option value="門診" >門診</option>
                              <option value="其它" >其它</option>
                            </select>

                            </select>
                        </div>
                        <div class="line">
                            <label>病歷號碼</label>
                            <input type="text" name="patientChart"  class="small" value="" />
                        </div>
                        <div class="line">
                            <label>姓名</label>
                            <input type="text" name="patientName"  class="small" value="" />
                        </div>
                        <div class="line">
                            <label>性別</label>
                            <input type="radio" name="patientSex" id="sex1"  value="1"/> 
                            <label for="sex1">男</label>
                            
                            <input type="radio" name="patientSex" id="sex2" value="2" /> 
                            <label for="sex2">女</label>
                        </div>
                          <div class="line">
                            <label>診斷</label>
                            <input type="text" name="patientDignosis"  class="medium" value="" />
                        </div>
                        <div class="line">
                            <label>床等需求</label>
                            <select name="requestBed" >
                                <option value=""></option>
                               <option value="單人"  selected >單人</option>
                               <option value="雙人" >雙人</option>
                               <option value="健保" >健保</option>
                               <option value="單或雙" >單或雙</option>
                               <option value="雙或健保" >雙或健保</option>
                               <option value="皆可" >皆可</option>

                            </select>
                        </div>
                        <div class="line">
                            <label>一定不要的床等</label>
                            <select name="exclusiveBed" >
                              <option value=""></option>
                              <option value="無特殊需求" >無特殊需求</option>
                              <option value="單人"   >單人</option>
                              <option value="雙人"  >雙人</option>
                              <option value="健保"  >健保</option>
                              <option value="單或雙"  >單或雙</option>
                              <option value="雙或健保"  >雙或健保</option>

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
                                <option value="<?php echo $row->vsID;?>"><?php echo $row->vsName;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="line">
                            <label>訂床者</label>
                           員       編: <input type="text" name="bookingUserEmpID"  class="small" value="" /><br/>
                           姓       名: <input type="text" name="bookingUsername"  class="small" value="" /><br/>
                           手       機: <input type="text" name="bookingUserTel"  class="small" value="" />
                        </div>
                        <div class="line">
                            <label>特殊事項</label>
                            <input type="text" name="bookingNotes"  class="medium" value="" />
                        </div>
                        <div class="line">
                        
                        <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                            
                        </div>
                    
                </div>
                </div>
                </form>
            </div>
        </div>
        
        <div class="small">
            <div class="box">
                <div class="title">
                    <h2><?php echo $booking_Date;?>&nbsp;<?php echo $this->session->userdata('bookingName')?> 已訂之名單</h2>
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

</html> 