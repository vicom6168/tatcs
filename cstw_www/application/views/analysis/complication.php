<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox.css?v=2.1.6" type="text/css" media="screen" />
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
for($i=0;$i<15;$i++){
    if($answer[$i]!=""){
foreach($answer[$i]->result() as $row){$ans[$i] = explode(",", $row->sumList);}
    }
}
$title[0]="Lung, malignant";
$title[1]="Lung, benign";
$title[2]="Mediastinum, malignant";
$title[3]="Mediastinum, benign";
$title[4]="Esophagus/Cardia/<br/>Hypopharyngeal, malignant";
$title[5]="Esophagus/Cardia, benign";
$title[6]="Trachea";
$title[7]="Pleura";
$title[8]="Diaphragm";
$title[9]="End stage lung disease";
$title[10]="Chest wall";
$title[11]="Miscellaneous";
$title[12]="Chemoport";
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>3. 併發症統計報表</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/complication" method="post">
                <div class="content">
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
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value=""></option>
                                   <?php for($i=$this->config->item('openheartYear');$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qYear) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="qMonth" id="qMonth" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qMonth) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月~
                                   <select name="qYearEnd" id="qYearEnd" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=$this->config->item('openheartYear');$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qYearEnd) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="qMonthEnd" id="qMonthEnd" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qMonthEnd) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                         
             </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>Operative <br/>Mortality</th>
                                <th nowrap>Wound <br/>Infection</th>
                                <th nowrap>Re-OP</th>
                                <th nowrap>pneumonia</th>
                               <th nowrap>prolong <br/>intubation</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                              <?php 
                                         $i=0;
                            $j=0;
                        
                       for($i=0;$i<sizeof($title);$i++){
                                          $j++;
                                        
                            ?>
                          <tr> 
                              <td><?php echo $j;?></th>
                              <td><?php echo $title[$i];?></th>
                              <td><?php echo $ans[0][$i];?></th>
                              <td><?php echo $ans[1][$i];?></th>
                              <td><?php echo $ans[2][$i];?></th>
                              <td><?php echo $ans[3][$i];?></th>
                              <td><?php echo $ans[4][$i];?></th>
                           </tr> 
                        <?php  } ?>
                        </tbody> 
                    </table>
                    <br>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>hemothorax</th>
                                <th nowrap>pneumothorax</th>
                                <th nowrap>B-P fistula</th>
                                <th nowrap>chylothorax</th>
                               <th nowrap>anastomosis  <br/>leakage</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                              <?php 
                                         $i=0;
                            $j=0;
                        
                       for($i=0;$i<sizeof($title);$i++){
                                          $j++;
                                        
                            ?>
                          <tr> 
                              <td><?php echo $j;?></th>
                              <td><?php echo $title[$i];?></th>
                              <td><?php echo $ans[5][$i];?></th>
                              <td><?php echo $ans[6][$i];?></th>
                              <td><?php echo $ans[7][$i];?></th>
                              <td><?php echo $ans[8][$i];?></th>
                              <td><?php echo $ans[9][$i];?></th>
                           </tr> 
                        <?php  } ?>
                        </tbody> 
                    </table>
                    <br/>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>ileus</th>
                                <th nowrap>aspiration</th>
                                <th nowrap>dysphagia</th>
                                <th nowrap>Arrthymia</th>
                               <th nowrap>Others</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                              <?php 
                                         $i=0;
                            $j=0;
                        
                       for($i=0;$i<sizeof($title);$i++){
                                          $j++;
                                        
                            ?>
                          <tr> 
                              <td><?php echo $j;?></th>
                              <td><?php echo $title[$i];?></th>
                              <td><?php echo $ans[10][$i];?></th>
                              <td><?php echo $ans[11][$i];?></th>
                              <td><?php echo $ans[12][$i];?></th>
                              <td><?php echo $ans[13][$i];?></th>
                              <td><?php echo $ans[14][$i];?></th>
                           </tr> 
                        <?php  } ?>
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if(1==2 && $qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDF/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCEL/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
                  </div>
                <?php } ?>
             
                <br/>
            </div>
        </div>
        
            <div class="small">
           
             <div class="box">
                <div class="title">
                    <h2></h2>
                    <span class="hide"></span>
                </div>
                <div class="content">
                     <?php $this->load->view("analysis/menu");?>  
                </div>
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
 

 $(document).ready(function() {
  
    $( "#qDate1" ).datepicker({ dateFormat: 'yy-mm-dd'});
     $( "#qDate2" ).datepicker({ dateFormat: 'yy-mm-dd'});
     
      $(".various").fancybox({
        maxWidth    : 1000,
        maxHeight   : 600,
        fitToView   : false,
        titleShow: false,               
autoscale: false,               
autoDimensions: false ,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
    });
 });    
 </script>

</html> 