<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>8. 登錄數與上傳病歷數</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/casenumber" method="post">
                <div class="content">
                        <div class="linewithoutindention">
                      
                        
                            <label  class="withinLargedention">查詢年月：</label>
                 <div class="linewithoutindention">
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2010;$i<=$currenYear;$i++) {?>
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
                                   <?php for($i=2010;$i<=$currenYear;$i++) {?>
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
                   
                  </div>  
                     <div class="lineheader">
                            <label>各醫院 登錄數</label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                       
                            <thead> 
                            <tr> 
                                <th nowrap>Hospital</th>
                                <th nowrap>Adult</th>
                                <th nowrap>Congenital</th>
                                <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                                <?php 
                          $i=0;
                            foreach($registernumber->result() as $row){
                             $registerArr[$row->hospital]=$row->num;
                    $registerHospitalArr[$i]=$row->hospital;
                    $i++;
                    //大人小孩變數相反了
                            }
                             foreach($registernumberChild->result() as $row){
                             $registerChildArr[$row->hospital]=$row->num;
                            }
                             for($i=0;$i<sizeof($registerArr);$i++){
                            ?>
                          <tr> 
                                <td><?php echo $registerHospitalArr[$i];?></th>
                                <td><?php echo number_format($registerChildArr[$registerHospitalArr[$i]]);?></th>
                               <td><?php echo number_format($registerArr[$registerHospitalArr[$i]]-$registerChildArr[$registerHospitalArr[$i]]);?></th>
                               
                              <td><?php echo number_format($registerArr[$registerHospitalArr[$i]]);?></th>
                            </tr> 
                     <?php } ?>
                       
                        </tbody> 
                    </table>
                    <br/><br/>
                     <div class="lineheader">
                            <label>各醫院上傳病歷數</label>
                             <label for=""></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>Hospital</th>
                                   <th nowrap>Adult</th>
                                <th nowrap>Congenital</th>
                                <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                                <?php 
                          
                       
                              $i=0;
                             $uploadArr=array();
                            foreach($uploadnumber->result() as $row){
                             $uploadArr[$row->hospital]=$row->num;
                             $uploadHospitalArr[$i]=$row->hospital;
                             $i++;
                    //大人小孩變數相反了
                            }
                             foreach($uploadnumberChild->result() as $row){
                             $uploadChildArr[$row->hospital]=$row->num;
                            }
                             for($i=0;$i<sizeof($uploadArr);$i++){
                            ?>
                          <tr> 
                                  <td><?php echo $uploadHospitalArr[$i];?></th>
                                <td><?php echo number_format($uploadChildArr[$uploadHospitalArr[$i]]);?></th>
                               <td><?php echo number_format($uploadArr[$uploadHospitalArr[$i]]-$uploadChildArr[$uploadHospitalArr[$i]]);?></th>
                               
                              <td><?php echo number_format($uploadArr[$uploadHospitalArr[$i]]);?></th>
                            </tr> 
                     <?php } ?>
                        
                              
                        </tbody> 
                    </table>
                
               
                <?php if($qYear!="" && $qMonth!="" && 1==2) { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFchild/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELchild/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
                  </div>
                  <?php } ?>
             
                <br/>
            </div>
        </div>
        </div>  
            <div class="small">
           
             <div class="box">
                <div class="title">
                    <h2></h2>
                    <span class="hide"></span>
                </div>
                <div class="content">
                <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>統計報表</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/index/"">1. 學會分類報表</a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummary/">2. Executive Summary</a></td>
                            </tr>
                               
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummaryadult/">3. Executive summary of Adult Cardiac Surgery</a></td>
                            </tr>
                            
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarychild/">4. Executive summary of Congenital Surgery </a></td>
                            </tr>
                          
                                       <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarynonopenheart/">5. Executive summary of Non Open Heart </a></td>
                            </tr>
                            
                                <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/adultoutcome/"><span class='<?php echo ($subpage=="adultoutcome"?"currentPage":"");?>'>6. Adult Outcome </span></a></td>
                            </tr>
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/urgency/"><span class='<?php echo ($subpage=="urgency"?"currentPage":"");?>'>7. Urgency and Euroscore II </span></a></td>
                            </tr>
                            
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/casenumber/"><span class='<?php echo ($subpage=="casenumber"?"currentPage":"");?>'>8. 登錄數與上傳病歷數 </span></a></td>
                            </tr>
                        </tbody> 
                    </table>
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
 </script>
</html> 