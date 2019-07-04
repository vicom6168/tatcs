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
                    <h2>3. Executive summary of adult cardiac surgery</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/executivesummaryadult" method="post">
                <div class="content">
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢月份：</label>
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
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                            <tr> 
                                <td>0</td>
                                <td>Adult cardiac surgery count </td>
                               <td><?php echo $adult;?></td>
                            </tr> 
                        </tbody>
                    </table>
                    <br/>    <br/>
                      <div class="lineheader">
                            <label>Major Procedures1-2 </label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                             
                          <tr> 
                                <td>1</th>
                                <td>Isolated CAB</td>
                               <td><?php echo $ans1;?></td>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>Isolated Aortic Valve Replacement</td>
                               <td><?php echo $ans2;?></td>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>Isolated Mitral Valve Replacement</th>
                               <td><?php echo $ans3;?></td>
                            </tr>      
                               <tr> 
                                <td>4</th>
                                <td>Aortic Valve Replacement + CAB</td>
                               <td><?php echo $ans4;?></td>
                            </tr> 
                               <tr> 
                                <td>5</th>
                                <td>Mitral Valve Replacement + CAB</td>
                               <td><?php echo $ans5;?></td>
                            </tr> 
                               <tr> 
                                <td>6</th>
                                <td>Aortic + Mitral Valve Replacements</td>
                               <td><?php echo $ans6;?></td>
                            </tr> 
                               <tr> 
                                <td>7</th>
                                <td>Mitral Valve Repair</td>
                               <td><?php echo $ans7;?></td>
                            </tr> 
                               <tr> 
                                <td>8</th>
                                <td>Mitral Valve Repair + CAB</td>
                               <td><?php echo $ans8;?></td>
                            </tr> 
                             <tr> 
                                <td>9</th>
                                <td>Aortic surgery - Dissection</td>
                               <td><?php echo $ans9;?></td>
                            </tr> 
                             <tr> 
                                <td>10</th>
                                <td>Aortic surgery - Nondissection</td>
                               <td><?php echo $ans10;?></td>
                            </tr> 
                               <tr> 
                                <td>11</th>
                                <td>Not Classiﬁed Above</td>
                               <td><?php echo $ans11;?></td>
                            </tr> 
                        </tbody> 
                    </table>
                    
                    <br/>    <br/>
                     <div class="lineheader">
                            <label>Incidence of Other Procedures </label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                               <th nowrap>Total</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                             <tr> 
                                <td>1</td>
                                <td>CABG</td>
                               <td><?php echo $a1;?></td>
                            </tr> 
                         
                          <tr> 
                                <td>2</td>
                                <td>Aortic Valve</td>
                               <td><?php echo $a2;?></td>
                            </tr> 
                             <tr> 
                                <td>3</td>
                                <td>Mitral Valve</td>
                               <td><?php echo $a3;?></td>
                            </tr> 
                        
                         <tr> 
                                <td>4</td>
                                <td>Pulmonic Valve</td>
                               <td><?php echo $a4;?></td>
                            </tr> 
                         <tr> 
                                <td>5</td>
                                <td>Tricuspid Valve</th>
                               <td><?php echo $a5;?></td>
                            </tr>      
                               <tr> 
                                <td>6</td>
                                <td>Ventricular Assist Device</td>
                               <td><?php echo $a6;?></td>
                            </tr> 
                               <tr> 
                                <td>7</td>
                                <td>LV aneurysm surgery</td>
                               <td><?php echo $a7;?></td>
                            </tr> 
                               <tr> 
                                <td>8</td>
                                <td>Cardiac Trauma</td>
                               <td><?php echo $a8;?></td>
                            </tr> 
                               <tr> 
                                <td>9</td>
                                <td>Cardiac Transplant </td>
                               <td><?php echo $a9;?></td>
                            </tr> 
                               <tr> 
                                <td>10</td>
                                <td>Atrial Fibrillation Correction Surgery</td>
                               <td><?php echo $a10;?></td>
                            </tr> 
                               <tr> 
                                <td>11</td>
                                <td>Aortic Aneurysm</td>
                               <td><?php echo $a11;?></td>
                            </tr> 
                            <tr> 
                                <td>12</td>
                                <td>Ascending Aorta</td>
                               <td><?php echo $a12;?></td>
                            </tr> 
                            <tr> 
                                <td>13</td>
                                <td>Aortic Arch</td>
                               <td><?php echo $a13;?></td>
                            </tr> 
                         <tr> 
                                <td>14</td>
                                <td>Descending Aorta</td>
                               <td><?php echo $a14;?></td>
                            </tr> 
                         <tr> 
                                <td>15</td>
                                <td>Thoracoabdominal Aorta</th>
                               <td><?php echo $a15;?></td>
                            </tr>      
                               <tr> 
                                <td>16</td>
                                <td>Intracardiac Tumor</td>
                               <td><?php echo $a16;?></td>
                            </tr> 
                               <tr> 
                                <td>17</td>
                                <td>Pulmonary Thromboembolectomy</td>
                               <td><?php echo $a17;?></td>
                            </tr> 
                               <tr> 
                                <td>18</td>
                                <td>Other cardiac</td>
                               <td><?php echo $a18;?></td>
                            </tr> 
                             
                              
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="") { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDFadult/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELadult/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
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
                    <?php $this->load->view("analysis/menu");?>  
                </div>
            </div>
          
        
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
 $(document).ready(function() {

 });    
 </script>
</html> 