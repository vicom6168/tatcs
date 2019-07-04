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
                    <h2>11. 上傳學會後分類報表(2019年版)</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/association2019Server" method="post">
                <div class="content">
                     <div class="linewithoutindention">
                           
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2019;$i<=$currenYear;$i++) {?>
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
                                   <?php for($i=2019;$i<=$currenYear;$i++) {?>
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
                    <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap colspan="3">Item</th>
                                <th nowrap>Description</th>
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</th>
                                <td rowspan=4>冠狀動脈繞道手術CABG</td>
                               <td  rowspan=2>On pump</td>
                                <td>CABG =1</td>
                                <td>分類1.CABG:true<br/>CABG = Y 且 Cardiopulmonary bypass or ECMO support = Y 且所有吻合處總合 =1</td>
                               <td><?php echo $answer[8];?></td>
                            </tr> 
                         <tr> 
                                <td>2</td>
                                <td>CABG ≥2</td>
                                <td>CABG = Y 且 Cardiopulmonary bypass or ECMO support = Y </td>
                               <td><?php echo $answer[9];?></td>
                            </tr> 
                         <tr> 
                                <td>3</td>
                               <td  rowspan=2>Off pump</td>
                                <td>CABG =1</td>
                                <td>CABG = Y 且所有吻合處總合 =1</td>
                               <td><?php echo $answer[10];?></td>
                            </tr>      
                              <tr> 
                                <td>4</td>
                                <td>CABG ≥2</td>
                                <td>CABG = Y</td>
                               <td><?php echo $answer[11];?></td>
                            </tr>   
                                 <tr> 
                                <td>5</td>
                                <td rowspan="2">瓣膜置換術Valvular replacement</td>
                                <td colspan="2">Valvular Replacement <br/>金屬</td>
                                <td>AVR/Mechanical valve = Y或Bentall Op/Mechanical valve =Y或MVR/Mechanical valve =Y或TVR/Mechanical valve =Y或PVR/Mechanilcal valve =Y</td>
                               <td><?php echo $answer[12];?></td>
                            </tr>     
                            <tr> 
                                <td>6</td>
                                <td colspan="2">Valvular Replacement <br/>組織</td>
                                <td>AVR = Y或Bentall Op =Y或MVR = Y或TVR=Y或PVR=Y</td>
                               <td><?php echo $answer[13];?></td>
                            </tr>   
                                <tr> 
                                <td>7</td>
                                <td colspan="3">瓣膜修補術 Valvular Repair</td>
                                <td>AVP=Y或MVP=Y或TVP=Y或PVP=Y</td>
                               <td><?php echo $answer[14];?></td>
                            </tr>       
                           
                              <tr> 
                                <td>8</td>
                                <td rowspan=3>先天性心臟病</td>
                               <td  colspan=2>No CPB</td>
                                <td>Congenital surgery/Primary procedure = Y 且 Congenital surgery/Bypass = N</td>
                               <td><?php echo $answer[2];?></td>
                            </tr> 
                     
                         <tr> 
                                <td>9</td>
                               <td  rowspan=2>On CPB</td>
                                <td>Cyanotic </td>
                                <td>Congenital surgery/Primary procedure = Y 且 Congenital surgery/Diagnosis 裡面任何診斷碼開頭有包含: 14,16,18,23,24,26,27,31,33,36,39,42,43,44,46中的其中一個 </td>
                               <td><?php echo $answer[3];?></td>
                            </tr>      
                              <tr> 
                                <td>10</td>
                                <td>Non-cyanotic</td>
                                <td>Congenital surgery/Primary procedure = Y</td>
                               <td><?php echo $answer[4];?></td>
                            </tr>   
                            
                              <tr> 
                                <td>11</td>
                                <td rowspan=2>主動脈夾層 Aortic Dissection</td>
                               <td  colspan=2>On pump</td>
                                <td>Aortic surger/Etiolog/Dissection = Y 且 Aoritc surgery/Cardiopulmonary bypass = Y</td>
                               <td><?php echo $answer[6];?></td>
                            </tr> 
                     
                         <tr> 
                                <td>12</td>
                               <td  colspan=2>Off pump</td>
                                <td>Aortic surger/Etiolog/Dissection = Y 且 Aoritc surgery/Cardiopulmonary bypass = N</td>
                               <td><?php echo $answer[16];?></td>
                            </tr>    
                               <tr> 
                                <td>13</td>
                               <td  colspan=3>心臟移植 HTX</td>
                                <td>Heart transplant & Mechanical support/Heart transplant = Y</td>
                               <td><?php echo $answer[1];?></td>
                            </tr>    
                            
                               <tr> 
                                <td>14</td>
                                <td rowspan=2>Mechanical Support</td>
                               <td  colspan=2>ECMO</td>
                                <td>特殊表單Vascular/Procedure 中只要有8-01或8-02就算</td>
                               <td><?php echo $answer[19];?></td>
                            </tr> 
                     
                         <tr> 
                                <td>15</td>
                               <td  colspan=2>LVAD</td>
                                <td>Heart transplant & Mechanical support/LVAD = Y 或 RVAD =Y</td>
                               <td><?php echo $answer[5];?></td>
                            </tr>     
                             <tr> 
                                <td>16</td>
                                <td rowspan=2>大動脈瘤</td>
                               <td  colspan=2>On Pump</td>
                                <td>Aortid surgery/Etiology/Aneurysm = Y 且 Aoritc surgery/Cardiopulmonary bypass = Y</td>
                               <td><?php echo $answer[7];?></td>
                            </tr> 
                     
                         <tr> 
                                <td>17</td>
                               <td  colspan=2>Off Pump</td>
                                <td>Aortid surgery/Etiology/Aneurysm = Y 且 Aoritc surgery/Cardiopulmonary bypass = N</td>
                               <td><?php echo $answer[17];?></td>
                            </tr>       
                             <tr> 
                                <td>18</td>
                               <td  colspan=3>PAOD</td>
                                <td>特殊表單Vascular/Procedure 中只要有5. Surgery for peripheral artery disease(5-01~5-07)就算</td>
                               <td><?php echo $answer[20];?></td>
                            </tr>    
                            <tr> 
                                <td>19</td>
                                <td rowspan=2>其他 Others</td>
                               <td  colspan=2>On Pump</td>
                                <td>Other cardiac surgery = Y 且Cardiopulmonary Bypass = CPB with cardiac arrest (or ventricular fibrillation) / CPB without cardiac arrest / only ECMO support </td>
                               <td><?php echo $answer[15];?></td>
                            </tr> 
                     
                         <tr> 
                                <td>20</td>
                               <td  colspan=2>Off Pump</td>
                                <td>Other cardiac surgery = Y 且 Cardiopulmonary Bypass = no CPB or ECMO support </td>
                               <td><?php echo $answer[18];?></td>
                            </tr>  
                               <tr> 
                                <td>21</td>
                               <td  colspan=3>學會認定Open Heart Surgery總例數</td>
                                <td>1+3+4+...+15 (注意：沒有包含2)</td>
                               <td><?php echo $answer[1]+$answer[3]+$answer[4]+$answer[5]+$answer[6]+$answer[7]+$answer[8]+$answer[9]+$answer[10]+$answer[11]+$answer[12]+$answer[13]+$answer[14]+$answer[15];?></td>
                            </tr>     
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="" && 1==1) { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/association2019PDF/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
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