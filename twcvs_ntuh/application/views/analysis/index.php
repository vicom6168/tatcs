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
                    <h2>1. 學會分類報表</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/index" method="post">
                <div class="content">
                     <div class="linewithoutindention">
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
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
                                <th nowrap>Description</th>
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</th>
                                <td>CABG =1</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft<=1<br/>Cardiopulmonary bypass : null</th>
                               <td><?php echo $answer[8];?></th>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>CABG ≥2</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft>1<br/>Cardiopulmonary bypass : null</th>
                               <td><?php echo $answer[9];?></th>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>OPCAB =1</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft<=1<br/>Cardiopulmonary bypass : true</th>
                               <td><?php echo $answer[10];?></th>
                            </tr>      
                              <tr> 
                                <td>4</th>
                                <td>OPCAB ≥2</th>
                                <td>分類1.CABG:true<br/>LIMA+RIMA+GEA+Radial A.+Vein graft>1<br/>Cardiopulmonary bypass : true</th>
                               <td><?php echo $answer[11];?></th>
                            </tr>   
                                 <tr> 
                                <td>5</th>
                                <td>Valvular Replacement <br/>金屬</th>
                                <td>分類2.Valvular Replacement<br/>(AVR,MVR,TVR,PVR選1.Mechanical)</th>
                               <td><?php echo $answer[12];?></th>
                            </tr>     
                            <tr> 
                                <td>6</th>
                                <td>Valvular Replacement <br/>組織</th>
                                <td>分類2.Valvular Replacement<br/>(AVR,MVR,TVR,PVR選2.Bioprosthesis)</th>
                               <td><?php echo $answer[13];?></th>
                            </tr>   
                                <tr> 
                                <td>7</th>
                                <td>Valvular Repair</th>
                                <td>分類3.Vavlvular Repair</th>
                               <td><?php echo $answer[14];?></th>
                            </tr>       
                               <tr> 
                                <td>8</th>
                                <td>CHD-No CPB</th>
                                <td>分類4.CHD<br/>Cardiopulmonary bypass:null</th>
                               <td><?php echo $answer[1];?></th>
                            </tr>    
                              <tr> 
                                <td>9</th>
                                <td>CHD-Cyanotic</th>
                                <td>分類4.CHD<br/>Cardiopulmonary bypass:true<br/>CHD(open heart surgery): <br/>1.cyanotic</th>
                               <td><?php echo $answer[2];?></th>
                            </tr>    
                                 <tr> 
                                <td>10</th>
                                <td>CHD-Non cyanotic</th>
                                <td>分類4.CHD<br/>Cardiopulmonary bypass:true<br/>CHD(open heart surgery): <br/>2.non-cyanotic</th>
                               <td><?php echo $answer[3];?></th>
                            </tr>  
                               <tr> 
                                <td>11</th>
                                <td>DAA</th>
                                <td>分類5.Aortic Dissection</th>
                               <td><?php echo $answer[6];?></th>
                            </tr>        
                               <tr> 
                                <td>12</th>
                                <td>HTX </th>
                                <td>分類6.HTX</th>
                               <td><?php echo $answer[4];?></th>
                            </tr>   
                              <tr> 
                                <td>13</th>
                                <td>ECMO/VAD </th>
                                <td>分類7.Mechanical Support</th>
                               <td><?php echo $answer[5];?></th>
                            </tr>   
                            
                                  <tr> 
                                <td>14</th>
                                <td>TAA </th>
                                <td>分類8.Aortic Aneurysm<br/>thoracic aorta:true</th>
                               <td><?php echo $answer[7];?></th>
                            </tr>     
                                <tr> 
                                <td>15</th>
                                <td>AAA </th>
                                <td>分類8.Aortic Aneurysm<br/>abdominal aorta :true</th>
                               <td><?php echo $answer[16];?></th>
                            </tr>       
                                
                        
                                <tr> 
                                <td>16</th>
                                <td>PAOD </th>
                                <td>分類9.PAOD</th>
                               <td><?php echo $answer[17];?></th>
                            </tr>      
                              <tr> 
                                <td>17</th>
                                <td>Others </th>
                                <td></th>
                               <td><?php echo $answer[15];?></th>
                            </tr>           
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="") { ?>
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
 </script>
</html> 