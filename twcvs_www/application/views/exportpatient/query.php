<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>病患資料匯出</h2>
                    
                </div>
             
                <div class="content">
                        <form action="<?php echo base_url(); ?>exportPatient/index" method="post">
                    <div class="linewithoutindention">
                            <label  class="withinLargedention">醫院：</label>
                   
                                    <?php $HList=$this->session->userdata('hospitalList');?>
                                <select name="patientHospital" id="patientHospital">
                                    <?php  if (count ($HList)>1) {?>
                                   <option value=""></option>
                                   <?php } ?>
                                   <?php  for($i=0;$i<count($HList);$i++){?>
                                   <option value="<?php echo $HList[$i]['hospitalName'] ;?>" <?php if($h1==$HList[$i]['hospitalName']) echo "selected";?>><?php echo $HList[$i]['hospitalName'] ;?></option>
                                   <?php } ?>
                                   </select>
                      </div>
                      
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢期間：</label>
                      <input type="text" name="qDate1" id="qDate1" class="small" value="<?php echo $d1;?>" />~
                      <input type="text" name="qDate2" id="qDate2" class="small" value="<?php echo $d2;?>" />
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                      </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                 <th nowrap>Identify ID</th>
                               <th nowrap>Hospital</th>
                                <th nowrap>Age</th>
                                 <th nowrap>Age Unit</th>
                                <th nowrap>Gender</th>
                                <th nowrap>Operation Date</th>
                                <th nowrap>Surgeon</th>
                               
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
                                <td style="padding : 2px 8px;"><?php echo $row->patientHospitalUUID;?></td>
                                <td style="padding : 2px 8px;"><?php echo $row->patientHospital;?></td>
                                  <td style="padding : 2px 8px;"><?php echo $row->patientAge;?>  </td>
                                   <td style="padding : 2px 8px;">
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
                                <td style="padding : 2px 8px;"><?php echo $row->patientGender;?></td>
                                 <td style="padding : 2px 8px;"><?php echo str_replace('0000-00-00', '', $row->patientOpDate);?></td>
                            <td style="padding : 2px 8px;"><?php 
                            //echo $row->patientSurgeon.($row->patientSurgeon2==""?"":"<br/>".$row->patientSurgeon2).($row->patientSurgeon3==""?"":"<br/>".$row->patientSurgeon3).($row->patientSurgeon4==""?"":"<br/>".$row->patientSurgeon4);
                           echo $row->patientSurgeon;
                            ?></td>
                               
                            </tr>
                            <?php } ?>
                               
                              
                        </tbody> 
                    </table>
                     </form>
               
               
           <?php if( $d1!='' &&  $d2!=''){ ?>
             <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>exportPatient/EXCEL/<?php echo $d1;?>/<?php echo $d2;?>/<?php echo urlencode($h1);?>','_blank')"><span>EXCEL</span></button>
                  </div>
             <?php } ?>
                <br/> </div> </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
 $(document).ready(function() {
  
    $( "#qDate1" ).datepicker({ dateFormat: 'yy-mm-dd'});
     $( "#qDate2" ).datepicker({ dateFormat: 'yy-mm-dd'});
 });    
 </script>
</html> 