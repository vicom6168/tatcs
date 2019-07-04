<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <script type="text/javascript" src="<?php echo base_url(); ?>js/Chart.js"></script>
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
                    <h2>1. 學會手術統計申報表</h2>
                    
                </div>
                  <form action="<?php echo base_url(); ?>analysis/index" method="post">
                <div class="content">
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
                      <button type="submit" class="blue medium"><span>送出</span></button>
                        <?php if( $qYear!="" && $qMonth!="" && $qYearEnd!="" && $qMonthEnd!="") { ?> 
                      <button type="button" class="green medium" onclick="$('#myChart').show();"><span>查看統計圖</span></button>
                     <?php } ?>   
             </div>
                  <canvas id="myChart" width="400" height="600" style="display:none"></canvas>
                    <table cellspacing="0" cellpadding="0" border="0" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>Item</th>
                                <th nowrap>Open</th>
                                <th nowrap>VATS/<br/>Laparoscopy</th>
                                <th nowrap>Hybrid <br/>VATS</th>
                                <th nowrap>VATS<br/>(Single port)</th>
                                <th nowrap>VATS<br/>(Multiple port)</th>
                                <th nowrap>Robot <br/>Assisted</th>
                               <th nowrap>Total</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                              <?php 
                                         $i=0;
                            $j=0;
                            if($answer1!="") {
                            foreach($answer1->result() as $row){
                                          $j++;
                                          $pieces = explode(",", $row->sumList);
                                          $DrawGraph[$i]=$pieces;
                                          $labelStr[$i]=$row->category;
                            ?>
                          <tr> 
                              <td style="width:100px;display: inline-block;word-wrap: break-word;"><a class="various" data-fancybox-type="iframe" href="/Analysis/indexDetail/<?php echo $j;?>/<?php echo $qYear;?>/<?php echo $qMonth;?>/<?php echo $qYearEnd;?>/<?php echo $qMonthEnd;?>"><?php echo $row->category;?></a></th>
                              <td><?php echo $pieces[0];?></th>
                              <td><?php echo $pieces[1];?></th>
                              <td><?php echo $pieces[2];?></th>
                              <td><?php echo $pieces[4];?></th>
                              <td><?php echo $pieces[5];?></th>
                              <td><?php echo $pieces[3];?></th>
                              <td><?php echo $row->myTotal;?></th>
                           </tr> 
                        <?php  $i++;
                         } } ?>
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
        
  
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>
<script>

 $(document).ready(function() {
     
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
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: [
        ['Lung, malignant'], 
        ['Lung, benign'], 
        ['Mediastinum', 'malignant'], 
        ['Mediastinum', 'benign'], 
        ['Esophagus/','Cardia/','Hypopharyngeal', 'malignant'], 
        ['Esophagus/','Cardia', 'benign'], 
        ['Trachea'], 
        ['Pleura'], 
        ['Diaphragm'], 
        ['End stage', 'lung disease'], 
        ['Chest wall'], 
        ['Miscellaneous'], 
        ['Chemoport']
        ],
        datasets: [{
            label: 'Open',
            data: [<?php echo $DrawGraph[0][0];?>, <?php echo $DrawGraph[1][0];?> ,<?php echo $DrawGraph[2][0];?>, <?php echo $DrawGraph[3][0];?>, <?php echo $DrawGraph[4][0];?>,<?php echo $DrawGraph[5][0];?>,<?php echo $DrawGraph[6][0];?>,<?php echo $DrawGraph[7][0];?>,<?php echo $DrawGraph[8][0];?>,<?php echo $DrawGraph[9][0];?>,<?php echo $DrawGraph[10][0];?>,<?php echo $DrawGraph[11][0];?>,<?php echo $DrawGraph[12][0];?>],
            backgroundColor: 
                'rgba(255, 99, 132, 0.2)',
            borderColor: 
                'rgba(255, 99, 132, 1)',
            borderWidth: 1
        },{
            label: ['VATS','Laparoscopy'],
            data: [<?php echo $DrawGraph[0][1];?>, <?php echo $DrawGraph[1][1];?> ,<?php echo $DrawGraph[2][1];?>, <?php echo $DrawGraph[3][1];?>, <?php echo $DrawGraph[4][1];?>,<?php echo $DrawGraph[5][1];?>,<?php echo $DrawGraph[6][1];?>,<?php echo $DrawGraph[7][1];?>,<?php echo $DrawGraph[8][1];?>,<?php echo $DrawGraph[9][1];?>,<?php echo $DrawGraph[10][1];?>,<?php echo $DrawGraph[11][1];?>,<?php echo $DrawGraph[12][1];?>],
             backgroundColor:
                'rgba(54, 162, 235, 0.2)',
                
            borderColor: 
                'rgba(54, 162, 235, 1)',
                
            borderWidth: 1
        },{
            label: ['Hybrid','VATS'],
            data: [<?php echo $DrawGraph[0][2];?>, <?php echo $DrawGraph[1][2];?> ,<?php echo $DrawGraph[2][2];?>, <?php echo $DrawGraph[3][2];?>, <?php echo $DrawGraph[4][2];?>,<?php echo $DrawGraph[5][2];?>,<?php echo $DrawGraph[6][2];?>,<?php echo $DrawGraph[7][2];?>,<?php echo $DrawGraph[8][2];?>,<?php echo $DrawGraph[9][2];?>,<?php echo $DrawGraph[10][2];?>,<?php echo $DrawGraph[11][2];?>,<?php echo $DrawGraph[12][2];?>],
            backgroundColor:
                'rgba(255, 206, 86, 0.2)',
                
            borderColor: 
                'rgba(255, 206, 86, 1)',
                
            borderWidth: 1
        },{
            label: ['VATS','(Single port)'],
            data: [<?php echo $DrawGraph[0][4];?>, <?php echo $DrawGraph[1][4];?> ,<?php echo $DrawGraph[2][4];?>, <?php echo $DrawGraph[3][4];?>, <?php echo $DrawGraph[4][4];?>,<?php echo $DrawGraph[5][4];?>,<?php echo $DrawGraph[6][4];?>,<?php echo $DrawGraph[7][4];?>,<?php echo $DrawGraph[8][4];?>,<?php echo $DrawGraph[9][4];?>,<?php echo $DrawGraph[10][4];?>,<?php echo $DrawGraph[11][4];?>,<?php echo $DrawGraph[12][4];?>],
            backgroundColor:
                'rgba(75, 192, 192, 0.2)',
                
            borderColor: 
                'rgba(75, 192, 192, 1)',
                
            borderWidth: 1
        },{
            label: ['VATS','(Multiple port)'],
            data: [<?php echo $DrawGraph[0][5];?>, <?php echo $DrawGraph[1][5];?> ,<?php echo $DrawGraph[2][5];?>, <?php echo $DrawGraph[3][5];?>, <?php echo $DrawGraph[4][5];?>,<?php echo $DrawGraph[5][5];?>,<?php echo $DrawGraph[6][5];?>,<?php echo $DrawGraph[7][5];?>,<?php echo $DrawGraph[8][5];?>,<?php echo $DrawGraph[9][5];?>,<?php echo $DrawGraph[10][5];?>,<?php echo $DrawGraph[11][5];?>,<?php echo $DrawGraph[12][5];?>],
            backgroundColor:
                'rgba(153, 102, 255, 0.2)',
                
            borderColor: 
                'rgba(153, 102, 255, 1)',
                
            borderWidth: 1
        },{
            label: ['Robot','Assisted'],
            data: [<?php echo $DrawGraph[0][3];?>, <?php echo $DrawGraph[1][3];?> ,<?php echo $DrawGraph[2][3];?>, <?php echo $DrawGraph[3][3];?>, <?php echo $DrawGraph[4][3];?>,<?php echo $DrawGraph[5][3];?>,<?php echo $DrawGraph[6][3];?>,<?php echo $DrawGraph[7][3];?>,<?php echo $DrawGraph[8][3];?>,<?php echo $DrawGraph[9][3];?>,<?php echo $DrawGraph[10][3];?>,<?php echo $DrawGraph[11][3];?>,<?php echo $DrawGraph[12][3];?>],
             backgroundColor:
                'rgba(255, 159, 64, 0.2)',
                
            borderColor: 
                'rgba(255, 159, 64, 1)',
                
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true
            }],
               yAxes: [{
                stacked: true
            }]
        }
    }
});
</script>
</html> 