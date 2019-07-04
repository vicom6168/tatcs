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
                         
                   
                
               </div>
                <div class="content">
                    
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                
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
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $j;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientHospitalUUID;?></td>
                                <td style="padding : 2px 8px;line-height : 10px;"><?php echo $row->patientHospital;?></td>
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
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $row->patientGender;?></td>
                                 <td style="padding : 2px 8px;line-height : 20px;"><?php echo str_replace('0000-00-00', '', $row->patientOpDate);?></td>
                            <td style="padding : 2px 8px;line-height : 20px;"><?php 
                            //echo $row->patientSurgeon.($row->patientSurgeon2==""?"":"<br/>".$row->patientSurgeon2).($row->patientSurgeon3==""?"":"<br/>".$row->patientSurgeon3).($row->patientSurgeon4==""?"":"<br/>".$row->patientSurgeon4);
                           echo $row->patientSurgeon;
                            ?></td>
                               
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
       
            window.location='<?php echo base_url(); ?>patient/index/'+$('#qryHospital').val()+'/'+$('#qryOrder').val();
      
    }
</script>



</body>

</html> 