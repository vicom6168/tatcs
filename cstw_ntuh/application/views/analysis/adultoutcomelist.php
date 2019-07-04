<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
    
    <div class="section">
        <div class="full">
            <div class="box">
               
                            
             
                <div class="content">
                     <a href="/Analysis/adultListEXCEL/<?php echo $i;?>/<?php echo $j;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><button  class="blue medium"   style="vertical-align: bottom;"><span>EXCEL</span></button> </a> 
                   
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
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
                                 <th nowrap>EuroScore II</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($ans->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientChartNumber;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientName;?></td>
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
                                <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->patientGender;?></td>
                                 <td style="padding : 2px 8px;line-height : 10px;"><?php echo str_replace('0000-00-00', '', $row->patientOpDate);?></td>
                            <td style="padding : 2px 8px;line-height : 10px;"><?php 
                            //echo $row->patientSurgeon.($row->patientSurgeon2==""?"":"<br/>".$row->patientSurgeon2).($row->patientSurgeon3==""?"":"<br/>".$row->patientSurgeon3).($row->patientSurgeon4==""?"":"<br/>".$row->patientSurgeon4);
                           echo $row->patientSurgeon;
                            ?></td>
                              <td style="padding : 2px 8px;line-height : 30px;"><?php echo $row->euroScoreII;?></td>
                                
                            </tr>
                            <?php } ?>
                               
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