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
                    <h2>9. CHD Operative Mortality</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/chdmortality" method="post">
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
                 
                     <div class="lineheader">
                            <label>Index procedure</label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>Operative Mortality<br/>by STS definition</th>
                                <th nowrap>Operative Mortality</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</th>
                                <td>Ventricular Septal Defect</td>
                               <td><?php if($a1=='0') echo "-"; else echo round($b1*100/$a1,2).'%';?>  (<?php echo $b1;?>/<?php echo $a1;?>)</td>
                                <td><?php if($e1=='0') echo "-"; else echo round($f1*100/$e1,2).'%';?>  (<?php echo $f1;?>/<?php echo $e1;?>)</td>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>Tetralogy of Fallot</td>
                               <td><?php if($a2=='0') echo "-"; else echo round($b2*100/$a2,2).'%';?>  (<?php echo $b2;?>/<?php echo $a2;?>)</td>
                               <td><?php if($e2=='0') echo "-"; else echo round($f2*100/$e2,2).'%';?>  (<?php echo $f2;?>/<?php echo $e2;?>)</td>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>Transposition of the Great Arteries with intact Ventricular Septum</th>
                               <td><?php if($a3=='0') echo "-"; else echo round($b3*100/$a3,2).'%';?>  (<?php echo $b3;?>/<?php echo $a3;?>)</td>
                               <td><?php if($e3=='0') echo "-"; else echo round($f3*100/$e3,2).'%';?>  (<?php echo $f3;?>/<?php echo $e3;?>)</td>
                            </tr>      
                               <tr> 
                                <td>4</th>
                                <td>Transposition of the Great Arteries with Ventricular Septum Defect</td>
                               <td><?php if($a4=='0') echo "-"; else echo round($b4*100/$a4,2).'%';?>  (<?php echo $b4;?>/<?php echo $a4;?>)</td>
                               <td><?php if($e4=='0') echo "-"; else echo round($f4*100/$e4,2).'%';?>  (<?php echo $f4;?>/<?php echo $e4;?>)</td>
                            </tr> 
                               <tr> 
                                <td>5</th>
                                <td>Coarctation of the Aorta</td>
                               <td><?php if($a5=='0') echo "-"; else echo round($b5*100/$a5,2).'%';?>  (<?php echo $b5;?>/<?php echo $a5;?>)</td>
                               <td><?php if($e5=='0') echo "-"; else echo round($f5*100/$e5,2).'%';?>  (<?php echo $f5;?>/<?php echo $e5;?>)</td>
                            </tr> 
                               <tr> 
                                <td>6</th>
                                <td>Superior Caval to Pulmonary Artery Anastomosis</td>
                               <td><?php if($a6=='0') echo "-"; else echo round($b6*100/$a6,2).'%';?>  (<?php echo $b6;?>/<?php echo $a6;?>)</td>
                                <td><?php if($e6=='0') echo "-"; else echo round($f6*100/$e6,2).'%';?>  (<?php echo $f6;?>/<?php echo $e6;?>)</td>
                            </tr> 
                               <tr> 
                                <td>7</th>
                                <td>Compete Caval to Pulmonary Artery Anastomosis</td>
                               <td><?php if($a7=='0') echo "-"; else echo round($b7*100/$a7,2).'%';?>  (<?php echo $b7;?>/<?php echo $a7;?>)</td>
                               <td><?php if($e7=='0') echo "-"; else echo round($f7*100/$e7,2).'%';?>  (<?php echo $f7;?>/<?php echo $e7;?>)</td>
                            </tr> 
                               <tr> 
                                <td>8</th>
                                <td>Truncus Arteriosus</td>
                               <td><?php if($a8=='0') echo "-"; else echo round($b8*100/$a8,2).'%';?>  (<?php echo $b8;?>/<?php echo $a8;?>)</td>
                               <td><?php if($e8=='0') echo "-"; else echo round($f8*100/$e8,2).'%';?>  (<?php echo $f8;?>/<?php echo $e8;?>)</td>
                            </tr> 
                               <tr> 
                                <td>9</th>
                                <td>Hypoplastic Left Heart Syndrome</td>
                               <td><?php if($a9=='0') echo "-"; else echo round($b9*100/$a9,2).'%';?>  (<?php echo $b9;?>/<?php echo $a9;?>)</td>
                               <td><?php if($e9=='0') echo "-"; else echo round($f9*100/$e9,2).'%';?>  (<?php echo $f9;?>/<?php echo $e9;?>)</td>
                            </tr> 
                            <tr> 
                                <td>10</th>
                                <td>Total Anomalous Pulmonary Venous Connection</td>
                               <td><?php if($a10=='0') echo "-"; else echo round($b10*100/$a10,2).'%';?>  (<?php echo $b10;?>/<?php echo $a10;?>)</td>
                               <td><?php if($e10=='0') echo "-"; else echo round($f10*100/$e10,2).'%';?>  (<?php echo $f10;?>/<?php echo $e10;?>)</td>
                            </tr> 
                            <tr> 
                                <td>11</th>
                                <td>Partial Anomalous Pulmonary Venous Connection</td>
                               <td><?php if($a11=='0') echo "-"; else echo round($b11*100/$a11,2).'%';?>  (<?php echo $b11;?>/<?php echo $a11;?>)</td>
                               <td><?php if($e11=='0') echo "-"; else echo round($f11*100/$e11,2).'%';?>  (<?php echo $f11;?>/<?php echo $e11;?>)</td>
                            </tr> 
                         <tr> 
                                <td>12</th>
                                <td>Atrioventricular Septal Defect</td>
                               <td><?php if($a12=='0') echo "-"; else echo round($b12*100/$a12,2).'%';?>  (<?php echo $b12;?>/<?php echo $a12;?>)</td>
                               <td><?php if($e12=='0') echo "-"; else echo round($f12*100/$e12,2).'%';?>  (<?php echo $f12;?>/<?php echo $e12;?>)</td>
                            </tr> 
                         <tr> 
                                <td>13</th>
                                <td>Interrupted Aortic Arch</th>
                               <td><?php if($a13=='0') echo "-"; else echo round($b13*100/$a13,2).'%';?>  (<?php echo $b13;?>/<?php echo $a13;?>)</td>
                               <td><?php if($e13=='0') echo "-"; else echo round($f13*100/$e13,2).'%';?>  (<?php echo $f13;?>/<?php echo $e13;?>)</td>
                            </tr>      
                               <tr> 
                                <td>14</th>
                                <td>Ebstein Malformation</td>
                               <td><?php if($a14=='0') echo "-"; else echo round($b14*100/$a14,2).'%';?>  (<?php echo $b14;?>/<?php echo $a14;?>)</td>
                               <td><?php if($e14=='0') echo "-"; else echo round($f14*100/$e14,2).'%';?>  (<?php echo $f14;?>/<?php echo $e14;?>)</td>
                            </tr> 
                         
                              
                        </tbody> 
                    </table>
                    <br/>
                    <br/>
                      <div class="lineheader">
                            <label>Benchmark  procedure</label>
                             <label for="operationCABG"></label> &nbsp;
                             </div>
                     <table cellspacing="0" cellpadding="0" border="0"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>No.</th>
                                <th nowrap>Item</th>
                                <th nowrap>Operative Mortality<br/>by STS definition</th>
                                <th nowrap>Operative Mortality</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</th>
                                <td>VSD</td>
                               <td><?php if($c1=='0') echo "-"; else echo round($d1*100/$c1,2).'%';?>  (<?php echo $d1;?>/<?php echo $c1;?>)</td>
                               <td><?php if($g1=='0') echo "-"; else echo round($h1*100/$g1,2).'%';?>  (<?php echo $h1;?>/<?php echo $g1;?>)</td>
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>TOF</td>
                               <td><?php if($c2=='0') echo "-"; else echo round($d2*100/$c2,2).'%';?>  (<?php echo $d2;?>/<?php echo $c2;?>)</td>
                               <td><?php if($g2=='0') echo "-"; else echo round($h2*100/$g2,2).'%';?>  (<?php echo $h2;?>/<?php echo $g2;?>)</td>
                            </tr> 
                         <tr> 
                                <td>3</th>
                                <td>ASO</th>
                               <td><?php if($c3=='0') echo "-"; else echo round($d3*100/$c3,2).'%';?>  (<?php echo $d3;?>/<?php echo $c3;?>)</td>
                               <td><?php if($g3=='0') echo "-"; else echo round($h3*100/$g3,2).'%';?>  (<?php echo $h3;?>/<?php echo $g3;?>)</td>
                            </tr>      
                               <tr> 
                                <td>4</th>
                                <td>ASO+VSD</td>
                               <td><?php if($c4=='0') echo "-"; else echo round($d4*100/$c4,2).'%';?>  (<?php echo $d4;?>/<?php echo $c4;?>)</td>
                               <td><?php if($g4=='0') echo "-"; else echo round($h4*100/$g4,2).'%';?>  (<?php echo $h4;?>/<?php echo $g4;?>)</td>
                            </tr> 
                               <tr> 
                                <td>5</th>
                                <td>ECD (AVSD)</td>
                               <td><?php if($c5=='0') echo "-"; else echo round($d5*100/$c5,2).'%';?>  (<?php echo $d5;?>/<?php echo $c5;?>)</td>
                               <td><?php if($g5=='0') echo "-"; else echo round($h5*100/$g5,2).'%';?>  (<?php echo $h5;?>/<?php echo $g5;?>)</td>
                            </tr> 
                               <tr> 
                                <td>6</th>
                                <td>Fontan</td>
                               <td><?php if($c6=='0') echo "-"; else echo round($d6*100/$c6,2).'%';?>  (<?php echo $d6;?>/<?php echo $c6;?>)</td>
                               <td><?php if($g6=='0') echo "-"; else echo round($h6*100/$g6,2).'%';?>  (<?php echo $h6;?>/<?php echo $g6;?>)</td>
                            </tr> 
                               <tr> 
                                <td>7</th>
                                <td>Truncus</td>
                               <td><?php if($c7=='0') echo "-"; else echo round($d7*100/$c7,2).'%';?>  (<?php echo $d7;?>/<?php echo $c7;?>)</td>
                               <td><?php if($g7=='0') echo "-"; else echo round($h7*100/$g7,2).'%';?>  (<?php echo $h7;?>/<?php echo $g7;?>)</td>
                            </tr> 
                               <tr> 
                                <td>8</th>
                                <td>Norwood</td>
                               <td><?php if($c8=='0') echo "-"; else echo round($d8*100/$c8,2).'%';?>  (<?php echo $d8;?>/<?php echo $c8;?>)</td>
                               <td><?php if($g8=='0') echo "-"; else echo round($h8*100/$g8,2).'%';?>  (<?php echo $h8;?>/<?php echo $g8;?>)</td>
                            </tr> 
                             
                              
                        </tbody> 
                    </table>
                </div>
                </form>
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