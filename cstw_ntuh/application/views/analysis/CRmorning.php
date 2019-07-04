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
                    <h2>CR morning meeting報表(Open Heart)</h2>
                    
                </div>
             
                <div class="content">
                      
                        <form action="<?php echo base_url(); ?>analysis/CRmorning" method="post">
                 
                      
                        <div class="linewithoutindention">
                            <label  class="withinLargedention">查詢期間：</label>
                      <input type="text" name="qDate1" id="qDate1" class="small" value="<?php echo $d1;?>" />~
                      <input type="text" name="qDate2" id="qDate2" class="small" value="<?php echo $d2;?>" />
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                      <?php if($d1!="" && $d2!="") { ?>
                
                 <button type="submit" class="greenmediumspecial" onclick=" window.open('<?php echo base_url(); ?>analysis/EXCELCRMeeting/<?php echo $d1;?>/<?php echo $d2;?>','_blank')"><span>EXCEL</span></button>
               
                  <?php } ?>
                     
                      </div>
                    <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>OP date</th>
                               <th nowrap>Name</th>
                                <th nowrap>Age</th>
                                <th nowrap>Gender</th>
                                <th nowrap>EuroScore II</th>
                                <th nowrap width="30%">Diagnosis</th>
                                <th nowrap width="30%">Treatement</th>
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
                                <td><?php echo $row->patientName;?></td>
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
                                <td><?php echo $row->euroScoreII;?></td>
                                <td><?php 
                                       if($row->AdultDiagnosis1!='')
                echo $row->AdultDiagnosis1."<br/>"; 
          if($row->AdultDiagnosis2!='')
                echo $row->AdultDiagnosis2."<br/>";
          if($row->AdultDiagnosis3!='')
                echo $row->AdultDiagnosis3."<br/>";
          if($row->AdultDiagnosis4!='')
               echo $row->AdultDiagnosis4."<br/>";
          if($row->AdultDiagnosis5!='')
                echo $row->AdultDiagnosis5."<br/>";
          if($row->AdultDiagnosisOthers!='')
               echo $row->AdultDiagnosisOthers."<br/>";
          
            if($row->CongenitalDiagnosis1!='')
                echo $row->CongenitalDiagnosis1."<br/>"; 
                if($row->CongenitalDiagnosis2!='')
                echo $row->CongenitalDiagnosis2."<br/>"; 
                if($row->CongenitalDiagnosis3!='')
                echo $row->CongenitalDiagnosis3."<br/>"; 
                if($row->CongenitalDiagnosis4!='')
                echo $row->CongenitalDiagnosis4."<br/>"; 
                if($row->CongenitalDiagnosis5!='')
                echo $row->CongenitalDiagnosis5."<br/>"; 
                if($row->CongenitalProcedureOthers!='')
                echo $row->CongenitalProcedureOthers."<br/>"; 
                                    
                                    ?></td>
                                 <td><?php 
                                 $html='';
                                  if($row->operationCABG=='Y'){
                $html.="CABG(";
       if($row->operationLIMA!='' && $row->operationLIMA!='0' )
                $html.="LIMA:".$row->operationLIMA.",";       
       if($row->operationRIMA!='' && $row->operationRIMA!='0' )
                $html.="RIMA:".$row->operationRIMA.",";  
       if($row->operationRIMA_RadialA!='' && $row->operationRIMA_RadialA!='0' )
                $html.="Radial artery:".$row->operationRIMA_RadialA.",";  
       if($row->operationRIMA_GEA!='' && $row->operationRIMA_GEA!='0' )
                $html.="Gastroepiploic artery :".$row->operationRIMA_GEA.",";  
       if($row->operationVeinGraft!='' && $row->operationVeinGraft!='0' )
                $html.="Vein graft:".$row->operationVeinGraft.",";  
       $html.=")<br/>";
        }
        if($row->operationAorticValve=='Y'){
           //     $html.="Aortic valve surgery<br/>";
          if($row->operationAorticValve_AVP=='Y')
                $html.="AVP";
         if($row->operationAVP!='')
                $html.="(".$row->operationAVP.")"; 
         $html.="<br/>";
          if($row->operationAorticValve_AVR=='Y')
                $html.="AVR";
         if($row->operationAVRSelect!='')
                $html.="(".$row->operationAVRSelect.")"; 
         $html.="<br/>";
         if($row->operationMitralValveBentall=='Y')
                $html.="Bentall’s Op<br/>";
          }
        if($row->operationAorticSurgery=='Y'){
                $html.="Aortic surgery(";
        if($row->operationDissection=='Y')
                $html.="Dissection,";
        if($row->operationAneurysm=='Y')
                $html.="Aneurysm";
            $html.=")<br/>";
        }
        if($row->operationMitralValve=='Y'){
          //      $html.="Mitral valve surgery<br/>";
       if($row->Operation_MitralValve_MVP=='Y')
               $html.="MVP(";
        if($row->operationMVPRing=='Y')
                $html.="Ring,";
        if($row->operationMVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationMVPAnnularPlication=='Y')
                $html.="Annular plication";
        if($row->operationMVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_MitralValve_MVP=='Y')
        $html.=")<br/>";
       
       // if($row->operationMVPOthers=='Y')
          //      $html.="Mitral valve surgery Ohers<br/>";
        if($row->Operation_MitralValve_MVR=='Y')
                $html.="MVR";
         if($row->operationMVR!='')
                $html.="(".$row->operationMVR.")";
         if($row->Operation_MitralValve_MVR=='Y')
         $html.="<br/>";
        }
      if($row->operationArrythmiaSurgery=='Y'){
            //    $html.="Arrhythmia surgery<br/>";
         if($row->operationMazebiatrialLesion=='Y')
                $html.="Maze (";
          if($row->operationMazeLA=='Y')
                $html.="LA Maze (no RA lesion) ,";
           if($row->operationMazePVIwithLAA=='Y')
                $html.="PVI with LAA closure,";
            if($row->operationMazePVIwithoutLAA=='Y')
                $html.="PVI without LAA closure ,";
             if($row->operationMazeOthers=='Y')
                $html.="Maze Others,";
            //  if($row->operationMazeEnergySource!='')
              //$html.="Energy source";
                //$html.="Energy source:".$row->operationMazeEnergySource."";
               if($row->operationMazebiatrialLesion=='Y')
              $html.=")<br/>";
         }
        if($row->operationTricuspidValve=='Y'){
           //     $html.="Tricuspid valve surgery<br/>";
      if($row->Operation_TricuspidValve_TVP=='Y')
              $html.="TVP(";
        if($row->operationTVPRing=='Y')
                $html.="Ring,";
        if($row->operationTVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationTVPAnnularPlication=='Y')
                $html.="Annular plication,";
        if($row->operationTVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_TricuspidValve_TVP=='Y')
        $html.=")<br/>";
      
       // if($row->operationTVPOthers=='Y')
          //      $html.="Tricuspid valve surgery Ohers<br/>";
        if($row->Operation_TricuspidValve_TVR=='Y')
                $html.="TVR";
         if($row->operationTVR!='')
                $html.="(".$row->operationTVR.")";
          if($row->Operation_TricuspidValve_TVR=='Y')
         $html.="<br/>";
        }
                
        if($row->operationPulmonaryValve=='Y'){
         //       $html.="Pulmonary valve surgery<br/>";
        if($row->Operation_PulmonaryValve_PVP=='Y')
                $html.="PVP";
         if($row->operationPulmonaryValvePVP!='')
                $html.="(".$row->operationPulmonaryValvePVP.")";
           if($row->Operation_PulmonaryValve_PVP=='Y')
         $html.="<br/>";
        
       if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="PVR";
         if($row->operationPulmonaryValvePVR!='')
                $html.="(".$row->operationPulmonaryValvePVR.")";
          if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="<br/>";
       }
         
      //  if($row->operationHeartTransplantation=='Y')
          //      $html.="Heart transplant , Mechanical support:<br/>";
         if($row->operationHeartTransplantationOP=='Y')
                $html.="Heart transplant <br/>";
          if($row->operationHeartTransplantationLVAD=='Y')
                $html.="LVAD<br/>";
           if($row->operationHeartTransplantationRVAD=='Y')
                $html.="RVAD<br/>";
                   
        if($row->operationOtherCardiacSurgery1=='Y')
                $html.="Repair of Post-MI free wall rupture<br/>";
        if($row->operationOtherCardiacSurgery2=='Y')
                $html.="Repair of Post-MI ventricular septal defect (VSR)<br/>";
           if($row->operationOtherCardiacSurgery3=='Y')
                $html.=" Repair of traumatic cardiac rupture<br/>";
       if($row->operationOtherCardiacSurgery4=='Y')
                $html.=" Intracardiac tumor excision<br/>";
      if($row->operationOtherCardiacSurgery5=='Y')
                $html.="Septal myectomy<br/>";
      if($row->operationOtherCardiacSurgery6=='Y')
                $html.="Pericardiectomy<br/>";
      if($row->operationOtherCardiacSurgery7=='Y')
                $html.="LV aneurysm surgery<br/>";
      if($row->operationOtherCardiacSurgery8=='Y')
                $html.="Pulmonary embolectomy<br/>";
      if($row->operationOtherCardiacSurgery9=='Y')
                $html.="Pulmonary endarterectomy<br/>";
      if($row->operationOtherCardiacSurgery11=='Y')
                $html.="Cardiac Implantable Electronic Device lead insertion, replacement, or extraction<br/>";
      if($row->operationOtherCardiacSurgery10=='Y')
                $html.="Others<br/>";
     if($row->CongenitalProcedure1!='')
                $html.=$row->CongenitalProcedure1."<br/>"; 
     if($row->CongenitalProcedure2!='')
                $html.=$row->CongenitalProcedure2."<br/>"; 
     if($row->CongenitalProcedure3!='')
                $html.=$row->CongenitalProcedure3."<br/>"; 
     if($row->CongenitalProcedure4!='')
                $html.=$row->CongenitalProcedure4."<br/>"; 
     if($row->CongenitalProcedure5!='')
                $html.=$row->CongenitalProcedure5."<br/>"; 
      
          if($row->operationCABGMemo!='')
       $html.="<font color='red'>".$row->operationCABGMemo."</font><br/>"; 
         if($row->operationAorticMemo!='')
       $html.="<font color='red'>".$row->operationAorticMemo."</font><br/>"; 
           if($row->operationAorticSurgeryMemo!='')
       $html.="<font color='red'>".$row->operationAorticSurgeryMemo."</font><br/>"; 
         if($row->operationMVRMemo!='')
       $html.="<font color='red'>".$row->operationMVRMemo."</font><br/>"; 
         if($row->operationMazeMemo!='')
       $html.="<font color='red'>".$row->operationMazeMemo."</font><br/>"; 
           if($row->operationTricuspidValveMemo!='')
       $html.="<font color='red'>".$row->operationTricuspidValveMemo."</font><br/>"; 
             if($row->operationPulmonaryValveMemo!='')
       $html.="<font color='red'>".$row->operationPulmonaryValveMemo."</font><br/>"; 
               if($row->operationHeartTransplantationMemo!='')
       $html.="<font color='red'>".$row->operationHeartTransplantationMemo."</font><br/>"; 
                 if($row->operationOtherCardiacSurgeryMemo!='')
       $html.="<font color='red'>".$row->operationOtherCardiacSurgeryMemo."</font><br/>"; 
                 
      
                           echo $html;      
                                 
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