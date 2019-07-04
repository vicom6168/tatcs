<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>6. Adult Outcome</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/adultoutcome" method="post">
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
                                <th nowrap>Mean of <br/>EuroScore II</th>
                                <th nowrap>Operative <br/>Mortality</th>
                               <th nowrap>Permanent <br/>Stroke  </th>
                               <th nowrap>Renal <br/>Failure </th>
                               <th nowrap>Prolonged <br/>Ventilation <br/>> 24 hours  </th>
                               <th nowrap>Deep Sternal <br/>Wound <br/>Infection </th>
                              <th nowrap>Reoperation <br/>For any <br/>reason</th>
                               <th nowrap>Major Morbidity<br/> or <br/>Operative Mortality</th>
                               <th nowrap>完成率</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</th>
                                <td>Total adult <br/>open heart <br/>surgery</th>
                                      <td><label><?php echo ($ans[0][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/0/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[0][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/0/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[0][0];?></a>)</td>
                                  
                                  <?php for($i=0;$i<8;$i++) { ?>
                                <td><label><?php echo ($ans[0][0]==0?"-":round($ans[0][$i+1]*100/$ans[0][0],2));?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/0/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[0][$i+1];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/0/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[0][0];?></a>)</td>
                                  <?php } ?>
                              
                            </tr> 
                         <tr> 
                                <td>2</th>
                                <td>Isolated <br/>CAB</th>
                                       <td><label><?php echo ($ans[1][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/1/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[1][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/1/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[1][0];?></a>)</td>
                                  
                                 <?php for($i=0;$i<8;$i++) { ?>
                                <td><label><?php echo ($ans[1][0]==0?"-":round($ans[1][$i+1]*100/$ans[1][0],2));?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/1/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[1][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/1/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[1][0];?></a>)</th>
                                  <?php } ?>
                            </tr> 
                          <tr> 
                                <td>3</th>
                                <td>Isolated <br/>Aortic Valve <br/>Replacement</th>
                                       <td><label><?php echo ($ans[2][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/2/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[2][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/2/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[2][0];?></a>)</td>
                                  
                                   <?php for($i=0;$i<8;$i++) { ?>
                               <td><label><?php echo ($ans[2][0]==0?"-":round($ans[2][$i+1]*100/$ans[2][0],2));?>%</label> <br/>
                                   (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/2/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[2][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/2/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[2][0];?></a>)</th>
                                  <?php } ?>
                            </tr> 
                             <tr> 
                                <td>4</th>
                                <td>Isolated Mitral <br/>Valve <br/>Replacement</th>
                                       <td><label><?php echo ($ans[3][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/3/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[3][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/3/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[3][0];?></a>)</td>
                                  
                                  <?php for($i=0;$i<8;$i++) { ?>
                               <td><label><?php echo ($ans[3][0]==0?"-":round($ans[3][$i+1]*100/$ans[3][0],2));?>%</label> <br/>
                                   (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/3/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[3][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/3/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[3][0];?></a>)</th>
                                   <?php } ?>
                            </tr> 
                             <tr> 
                                <td>5</th>
                                <td>Aortic Valve <br/>Replacement + CAB</th>
                                       <td><label><?php echo ($ans[4][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/4/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[4][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/4/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[4][0];?></a>)</td>
                                  
                                <?php for($i=0;$i<8;$i++) { ?>
                               <td><label><?php echo ($ans[4][0]==0?"-":round($ans[4][$i+1]*100/$ans[4][0],2));?>%</label> <br/>
                                   (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/4/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[4][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/4/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[4][0];?></a>)</th>
                                  <?php } ?>
                            </tr> 
                             <tr> 
                                <td>6</th>
                                <td>Mitral Valve <br/>Replacement + CAB</th>
                                       <td><label><?php echo ($ans[5][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/5/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[5][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/5/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[5][0];?></a>)</td>
                                  
                                   <?php for($i=0;$i<8;$i++) { ?>
                              <td><label><?php echo ($ans[5][0]==0?"-":round($ans[5][$i+1]*100/$ans[5][0],2));?>%</label> <br/>
                                  (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/5/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[5][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/5/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[5][0];?></a>)</th>
                                   <?php } ?>
                            </tr> 
                             <tr> 
                                <td>7</th>
                                <td>Aortic + Mitral <br/>Valve Replacements</th>
                                       <td><label><?php echo ($ans[6][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/6/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[6][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/6/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[6][0];?></a>)</td>
                                  
                                   <?php for($i=0;$i<8;$i++) { ?>
                              <td><label><?php echo ($ans[6][0]==0?"-":round($ans[6][$i+1]*100/$ans[6][0],2));?>%</label> <br/>
                                  (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/6/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[6][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/6/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[6][0];?></a>)</th>
                                   <?php } ?>
                            </tr> 
                             <tr> 
                                <td>8</th>
                                <td>Mitral Valve <br/>Repair</th>
                                       <td><label><?php echo ($ans[7][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/7/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[7][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/7/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[7][0];?></a>)</td>
                                  
                                 <?php for($i=0;$i<8;$i++) { ?>
                               <td><label><?php echo ($ans[7][0]==0?"-":round($ans[7][$i+1]*100/$ans[7][0],2));?>%</label> <br/>
                                   (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/7/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[7][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/7/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[7][0];?></a>)</th>
                                  <?php } ?>
                            </tr> 
                             <tr> 
                                <td>9</th>
                                <td>Mitral Valve <br/>Repair + CAB</th>
                                       <td><label><?php echo ($ans[8][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/8/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[8][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/8/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[8][0];?></a>)</td>
                                  
                                <?php for($i=0;$i<8;$i++) { ?>
                              <td><label><?php echo ($ans[8][0]==0?"-":round($ans[8][$i+1]*100/$ans[8][0],2));?>%</label> <br/>
                                  (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/8/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[8][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/8/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[8][0];?></a>)</th>
                                   <?php } ?>
                            </tr> 
                             <tr> 
                                <td>10</th>
                                <td>Aortic surgery<br/>Dissection</th>
                                       <td><label><?php echo ($ans[9][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/9/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[9][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/9/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[9][0];?></a>)</td>
                                  
                                <?php for($i=0;$i<8;$i++) { ?>
                              <td><label><?php echo ($ans[9][0]==0?"-":round($ans[9][$i+1]*100/$ans[9][0],2));?>%</label> <br/>
                                  (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/9/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[9][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/9/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[9][0];?></a>)</th>
                                   <?php } ?>
                            </tr> 
                             <tr> 
                                <td>11</th>
                                <td>Aortic surgery<br/>Non-dissection</th>
                                       <td><label><?php echo ($ans[10][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/10/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[10][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/10/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[10][0];?></a>)</td>
                                  
                                <?php for($i=0;$i<8;$i++) { ?>
                              <td><label><?php echo ($ans[10][0]==0?"-":round($ans[10][$i+1]*100/$ans[10][0],2));?>%</label> <br/>
                                  (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/10/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[10][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/10/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[10][0];?></a>)</th>
                                   <?php } ?>
                            </tr> 
                             <tr> 
                                <td>12</th>
                                <td>Not Classiﬁed <br/>Above</th>
                                       <td><label><?php echo ($ans[11][10]);?>%</label> <br/>
                                    (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/11/9/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[11][9];;?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/11/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[11][0];?></a>)</td>
                                  
                               <?php for($i=0;$i<8;$i++) { ?>
                         <td><label><?php echo ($ans[11][0]==0?"-":round($ans[11][$i+1]*100/$ans[11][0],2));?>%</label> <br/>
                             (<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/11/<?php echo $i+1;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[11][$i+1];?></a>/<a class="various" data-fancybox-type="iframe" href="/Analysis/adultList/11/0/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $ans[11][0];?></a>)</th>
                                
                                  <?php } ?>
                            </tr> 
                        </tbody> 
                    </table>
                </div>
                </form>
                <?php if($qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="" && 1==2) { ?>
                  <div class="line">
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/PDF/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>PDF</span></button>
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCEL/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>','_blank')"><span>EXCEL</span></button>
                  </div>
                  <?php } ?>
             
                <br/>
            </div>
        </div>
        
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>
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