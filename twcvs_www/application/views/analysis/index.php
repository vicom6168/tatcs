<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>1. 學會分類報表</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/index" method="post">
                <div class="content">
                    <div class="linewithoutindention"> 
                         <label  class="withinLargedention">查詢醫院：</label>
                         <select name="qryHospital" id="qryHospital" class="big">
                                   <option value="0">請選取醫院</option>
                                      <?php 
                            foreach($hospitalList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->hospitalName;?>" <?php if($row->hospitalName==$qHospital) echo "selected";?>><?php echo $row->hospitalName;?></option>
                                     <?php } ?>
                            </select>
                            </div>
                        <div class="linewithoutindention">
                            
                          <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
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
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
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
                                <th nowrap>Description</th>
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</th>
                                <td>CABG =1</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft<=1<br/>Cardiopulmonary bypass : null</th>
                               <td><?php echo $answer[1];?></th>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>CABG ≥2</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft>1<br/>Cardiopulmonary bypass : null</th>
                               <td><?php echo $answer[2];?></th>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>OPCAB =1</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft<=1<br/>Cardiopulmonary bypass : true</th>
                               <td><?php echo $answer[3];?></th>
                            </tr>      
                              <tr> 
                                <td>4</th>
                                <td>OPCAB ≥2</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft>1<br/>Cardiopulmonary bypass : true</th>
                               <td><?php echo $answer[4];?></th>
                            </tr>   
                                 <tr> 
                                <td>5</th>
                                <td>Valvular Replacement <br/>金屬</th>
                                <td>分類2.Valvular Replacement<br/>(AVR,MVR,TVR,PVR選1.Mechanical)</th>
                               <td><?php echo $answer[5];?></th>
                            </tr>     
                            <tr> 
                                <td>6</th>
                                <td>Valvular Replacement <br/>組織</th>
                                <td>分類2.Valvular Replacement<br/>(AVR,MVR,TVR,PVR選2.Bioprosthesis)</th>
                               <td><?php echo $answer[6];?></th>
                            </tr>   
                                <tr> 
                                <td>7</th>
                                <td>Valvular Repair</th>
                                <td>分類3.Vavlvular Repair</th>
                               <td><?php echo $answer[7];?></th>
                            </tr>       
                               <tr> 
                                <td>8</th>
                                <td>CHD-No CPB</th>
                                <td>分類4.CHD<br/>Cardiopulmonary bypass:null</th>
                               <td><?php echo $answer[8];?></th>
                            </tr>    
                              <tr> 
                                <td>9</th>
                                <td>CHD-Cyanotic</th>
                                <td>分類4.CHD<br/>Cardiopulmonary bypass:true<br/>CHD(open heart surgery): <br/>1.cyanotic</th>
                               <td><?php echo $answer[9];?></th>
                            </tr>    
                                 <tr> 
                                <td>10</th>
                                <td>CHD-Non cyanotic</th>
                                <td>分類4.CHD<br/>Cardiopulmonary bypass:true<br/>CHD(open heart surgery): <br/>2.non-cyanotic</th>
                               <td><?php echo $answer[10];?></th>
                            </tr>  
                               <tr> 
                                <td>11</th>
                                <td>DAA</th>
                                <td>分類5.Aortic Dissection</th>
                               <td><?php echo $answer[11];?></th>
                            </tr>        
                               <tr> 
                                <td>12</th>
                                <td>HTX </th>
                                <td>分類6.HTX</th>
                               <td><?php echo $answer[12];?></th>
                            </tr>   
                              <tr> 
                                <td>13</th>
                                <td>ECMO/VAD </th>
                                <td>分類7.Mechanical Support</th>
                               <td><?php echo $answer[13];?></th>
                            </tr>     
                                   <tr> 
                                <td>14</th>
                                <td>TAA </th>
                                <td>分類8.Aortic Aneurysm<br/>thoracic aorta:true</th>
                               <td><?php echo $answer[14];?></th>
                            </tr>     
                                <tr> 
                                <td>15</th>
                                <td>AAA </th>
                                <td>分類8.Aortic Aneurysm<br/>abdominal aorta :true</th>
                               <td><?php echo $answer[15];?></th>
                            </tr>       
                                <tr> 
                                <td>16</th>
                                <td>Others </th>
                                <td>分類9.PAOD<br/>+分類10. Others</th>
                               <td><?php echo $answer[16];?></th>
                            </tr>      
                              <tr> 
                                <td>17</th>
                                <td>Total </th>
                                <td></th>
                               <td><?php echo $answer[17];?></th>
                            </tr>           
                        </tbody> 
                    </table>
                </div>
                </form>
                 <?php if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDF/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/<?php echo $qHospital;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCEL/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>/<?php echo $qHospital;?>','_blank')"><span>EXCEL</span></button>
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
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>統計報表</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                             <tr> 
                                <td><a href="#">1. 學會分類報表</a></td>
                            </tr>
                              <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummary/"">2. Executive Summary</a></td>
                            </tr>
                               
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummaryadult/"">3. Executive summary of Adult Cardiac Surgery</a></td>
                            </tr>
                            
                               <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarychild/"">4. Executive summary of Congenital Surgery </a></td>
                            </tr>
                          
                                       <tr> 
                                <td><a href="<?php echo base_url(); ?>analysis/executivesummarynonopenheart/"">5. Executive summary of Non Open Heart </a></td>
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