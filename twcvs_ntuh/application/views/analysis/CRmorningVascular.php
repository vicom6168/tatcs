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
                    <h2>CR morning meeting報表(Vascular)</h2>
                    
                </div>
             
                <div class="content">
                      
                        <form action="<?php echo base_url(); ?>analysis/CRmorningVascular" method="post">
                 
                      
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢期間：</label>
                      <input type="text" name="qDate1" id="qDate1" class="small" value="<?php echo $d1;?>" />~
                      <input type="text" name="qDate2" id="qDate2" class="small" value="<?php echo $d2;?>" />
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                           <?php if($d1!="" && $d2!="") { ?>
                
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELVascularCRMeeting/<?php echo $d1;?>/<?php echo $d2;?>','_blank')"><span>EXCEL</span></button>
               
                  <?php } ?>
                     
                      </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="" style="table-layout:fixed; overflow: hidden;" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>OP date</th>
                               <th nowrap>Name</th>
                                <th nowrap>Age</th>
                                <th nowrap>Gender</th>
                                <th nowrap  width="200px">Diagnosis</th>
                                <th nowrap width="200px">Treatement</th>
                                <th nowrap>Operator</th>
                               
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
                                <td><?php echo $row->patientOpDate;?></td>
                                <td><?php echo mb_substr_replace($row->patientName,'O',1,1);?></td>
                                <td><?php echo $row->patientAge;
                                     if($row->patientAgeUnit=="1") {
                                                        echo " 歲";
                                     }
                                                        elseif($row->patientAgeUnit=="2"){
                                                        echo  " 月";
                                      } else {
                                                        echo   " 天";
                                     } 
                                    ?></td>
                                <td><?php echo $row->patientGender;?></td>
                                <td><?php 
                                       if($row->patientDiagnosis!='')
                echo $row->patientDiagnosis."<br/>"; 
         
                                    ?></td>
                                 <td><?php 
                         if($row->patientProcedure1!='')
                echo $row->patientProcedure1."<br/>"; 
                if($row->patientProcedure2!='')
                echo $row->patientProcedure2."<br/>"; 
                if($row->patientProcedure3!='')
                echo $row->patientProcedure3."<br/>"; 
                if($row->patientProcedure4!='')
                echo $row->patientProcedure4."<br/>"; 
                if($row->patientProcedure5!='')
                echo $row->patientProcedure5."<br/>"; 
                if($row->patientProcedureOthers!='')
                echo $row->patientProcedureOthers."<br/>"; 
                                 
                                 ;?></td>
                                <td><?php echo $row->patientSurgeon."<br/>";
                                    echo $row->patientSurgeon2."<br/>";
                                    echo $row->patientSurgeon3."<br/>";
                                    echo $row->patientSurgeon4."<br/>";
                                    
                                    ?></td>
                                
                            </tr>
                            <?php } ?>
                              
                        </tbody> 
                    </table>
                     </form>
               
               
         
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