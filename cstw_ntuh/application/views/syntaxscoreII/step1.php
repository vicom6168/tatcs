<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
     <LINK rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/css.css">


<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
 <?php $c=$myContent->row();
 $patientData['p']=$c;  
 //header顏色
if($c->patientCongenitalSurgery=='Y') 
$myColor="#E6F8E0";
else 
$myColor="#F8F7FA"; 

$genderImage=array(
""=>"",
"F"=>"/images/girl.png",
"M"=>"/images/boy.png"
);
 ?>
       <div class="section">
        <div class="full">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                     <table cellspacing="0" cellpadding="0" border="0" class="" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>Patient Information</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                          
                             <tr>
                                <td>
                                 <table>
                                     <tr>
                                         <td bgcolor="<?php echo $myColor;?>">Chart number</td>
                                         <td><?php echo $c->patientChartNumber;?></td>
                                          <td bgcolor="<?php echo $myColor;?>">Name</td>
                                         <td><?php echo $c->patientName;?></td>
                                         <td bgcolor="<?php echo $myColor;?>">Gender</td>
                                         <td><img src="<?php echo $genderImage[$c->patientGender];?>"</td>
                                         <td bgcolor="<?php echo $myColor;?>">Operation Date:</td>
                                         <td><?php echo  str_replace('0000-00-00', '', $c->patientOpDate);?></td>
                                         <td bgcolor="<?php echo $myColor;?>">Surgeon</td>
                                         <td><?php echo $c->patientSurgeon;?></td>
                                     </tr>
                                 </table>   
                                    
                                </td>
                            </tr>
                            
                            
                        </tbody> 
                    </table>
                <div class="title">
                    <h2>  Dominance: <?php echo ($dominance=="R"?"right":"left");?>   Current lesion: <?php echo $LesionsID;?>/<?php echo $TotalLesion;?></h2>
                </div>
                
              
    <form method="post" action="<?php echo base_url(); ?>syntaxscoreII/step2">            
   <table style="height:433px;padding:0px;" cellpadding="0" cellspacing="0">
 
    <tr>
        <td style="height:392px;width:300px;text-align:center;vertical-align: top">
            <div style="margin-top: 20px">
                <?php if($dominance=="R") { ?>
                <img src="<?php echo base_url(); ?>images/right.png" width="400" height="560" border="0" usemap="#mapright" />

<map name="mapright">
<!-- #$-:Image map file created by GIMP Image Map plug-in -->
<!-- #$-:GIMP Image Map plug-in by Maurits Rijk -->
<!-- #$-:Please do not edit lines starting with "#$" -->
<!-- #$VERSION:2.3 -->
<!-- #$AUTHOR:Luc Strijbosch -->
<area shape="poly" coords="90,95,101,93,101,70,108,52,111,51,117,55,130,51,135,43,150,43,161,49,167,42,154,34,132,32,125,28,118,27,110,32,108,39,107,42,94,55,91,68,90,81,68,103,58,120,80,98,91,89" title="RCA proximal"
onClick="selectRow('1');"  onMouseOver="lightUpRow('1');" onMouseOut="unLightUpRow('1');" />

<area shape="poly" coords="90,97,100,95,103,139,114,145,115,157,108,165,116,190,125,206,119,213,117,211,109,217,100,235,94,241,99,222,107,211,113,207,104,189,97,166,89,158,90,149,94,142,91,119" title="RCA mid"
onClick="selectRow('2');"  onMouseOver="lightUpRow('2');" onMouseOut="unLightUpRow('2');" /> 

<area shape="poly" coords="119,215,125,207,140,219,149,215,158,216,166,223,188,218,198,212,209,216,192,226,182,231,165,233,160,239,154,243,145,241,140,236,138,230,127,223" title="RCA distal"
onClick="selectRow('3');"  onMouseOver="lightUpRow('3');" onMouseOut="unLightUpRow('3');" /> 

<area shape="poly" coords="194,227,203,223,215,234,223,236,229,240,230,252,229,255,233,268,232,272,226,260,217,262,209,261,204,256,203,245,207,238,205,236" title="Posterior descending artery"
onClick="selectRow('4');"  onMouseOver="lightUpRow('4');" onMouseOut="unLightUpRow('4');" /> 

<area shape="poly" coords="201,211,210,217,232,194,259,174,260,164,235,179,231,166,221,162,210,167,208,177,209,185,221,190,217,195" title="Posterolateral branch from RCA"
onClick="selectRow('16');"  onMouseOver="lightUpRow('16');" onMouseOut="unLightUpRow('16');" /> 

<area shape="poly" coords="213,217,220,210,245,235,256,236,263,245,259,260,248,262,240,260,235,251,238,240,218,219" title="Posterolateral branch from RCA"
onClick="selectRow('16a');"  onMouseOver="lightUpRow('16a');" onMouseOut="unLightUpRow('16a');" /> 

<area shape="poly" coords="235,195,242,190,257,211,267,208,275,212,279,222,275,233,272,235,274,239,262,235,254,232,251,224,252,218" title="Posterolateral branch from RCA"
onClick="selectRow('16b');"  onMouseOver="lightUpRow('16b');" onMouseOut="unLightUpRow('16b');" /> 

<area shape="poly" coords="261,175,263,165,275,185,283,183,292,186,298,198,291,209,287,210,289,220,283,211,276,209,271,203,269,194,271,190" title="Posterolateral branch from RCA"
onClick="selectRow('16c');"  onMouseOver="lightUpRow('16c');" onMouseOut="unLightUpRow('16c');" /> 

<area shape="poly" coords="84,315,95,317,101,298,84,292,77,282,66,281,59,285,55,297,59,305,68,309,79,307,85,309" title="Left main"
onClick="selectRow('5');"  onMouseOver="lightUpRow('5');" onMouseOut="unLightUpRow('5');" /> 

<area shape="poly" coords="101,300,98,311,141,324,146,330,155,333,161,332,179,338,180,361,182,387,186,362,183,350,183,339,191,342,194,331,168,321,165,310,157,306,147,307,142,311" title="LAD proximal"
onClick="selectRow('6');"  onMouseOver="lightUpRow('6');" onMouseOut="unLightUpRow('6');" /> 

<area shape="poly" coords="194,344,198,333,248,358,258,360,265,368,268,379,274,389,264,391,259,386,249,387,242,383,238,375,239,367,238,365" title="LAD mid"
onClick="selectRow('7');"  onMouseOver="lightUpRow('7');" onMouseOut="unLightUpRow('7');" /> 

<area shape="poly" coords="265,393,278,389,288,408,300,447,299,471,296,478,298,488,295,496,281,501,274,499,253,501,241,498,272,492,271,484,275,476,286,474,289,455,284,427" title="LAD apical"
onClick="selectRow('8');"  onMouseOver="lightUpRow('8');" onMouseOut="unLightUpRow('8');" /> 

<area shape="poly" coords="178,320,187,325,222,313,234,308,240,315,247,317,259,312,261,302,283,305,304,304,326,309,293,298,278,297,259,294,245,289,238,292,234,297,214,305,190,314" title="First diagonal"
onClick="selectRow('9');"  onMouseOver="lightUpRow('9');" onMouseOut="unLightUpRow('9');" /> 

<area shape="poly" coords="210,338,224,343,248,339,278,339,282,346,292,350,304,345,340,356,355,362,356,360,305,335,300,325,293,323,282,326,280,329,236,331,224,334" title="Additional first diagonal"
onClick="selectRow('9a');"  onMouseOver="lightUpRow('9a');" onMouseOut="unLightUpRow('9a');" /> 

<area shape="poly" coords="267,368,269,378,299,378,301,385,310,389,319,388,323,384,348,393,358,400,360,398,338,382,325,377,322,367,316,362,306,363,303,364,300,368,278,367" title="Second diagonal"
onClick="selectRow('10');"  onMouseOver="lightUpRow('10');" onMouseOut="unLightUpRow('10');" /> 

<area shape="poly" coords="281,391,285,401,307,409,307,416,313,423,326,426,331,423,353,432,334,415,333,404,324,398,314,400,292,393" title="Additional second diagonal"
onClick="selectRow('10a');"  onMouseOver="lightUpRow('10a');" onMouseOut="unLightUpRow('10a');" /> 

<area shape="poly" coords="82,316,94,319,99,328,96,339,87,345,82,363,78,386,65,384,71,356,75,341,71,331,73,323,79,318,82,317" title="Proximal circumflex"
onClick="selectRow('11');"  onMouseOver="lightUpRow('11');" onMouseOut="unLightUpRow('11');" /> 

<area shape="poly" coords="97,317,103,312,125,333,133,331,139,337,142,347,162,362,161,364,138,352,130,353,121,350,119,342,120,337" title="Intermediate/anterolateral artery"
onClick="selectRow('12');"  onMouseOver="lightUpRow('12');" onMouseOut="unLightUpRow('12');" /> 

<area shape="poly" coords="87,351,84,357,109,366,123,369,123,378,131,387,141,388,146,386,164,403,166,403,150,380,150,369,146,363,135,360,127,363,119,361,112,359" title="Obtuse marginal"
onClick="selectRow('12a');"  onMouseOver="lightUpRow('12a');" onMouseOut="unLightUpRow('12a');" /> 

<area shape="poly" coords="81,379,80,384,97,393,105,392,128,403,128,411,131,419,140,423,151,420,159,423,153,415,154,405,149,397,141,395,131,398,116,388,107,385,98,384" title="Obtuse marginal"
onClick="selectRow('12b');"  onMouseOver="lightUpRow('12b');" onMouseOut="unLightUpRow('12b');" /> 

<area shape="poly" coords="65,385,78,388,82,400,78,417,88,453,102,475,95,483,85,473,73,445,67,417,58,412,54,400,59,392,66,388" title="Distal circumflex"
onClick="selectRow('13');"  onMouseOver="lightUpRow('13');" onMouseOut="unLightUpRow('13');" /> 

<area shape="poly" coords="80,412,84,406,94,410,99,405,108,404,119,412,119,420,138,427,162,442,161,445,139,434,116,427,109,431,99,430,93,424,91,415" title="Left posterolateral"
onClick="selectRow('14');"  onMouseOver="lightUpRow('14');" onMouseOut="unLightUpRow('14');" /> 

<area shape="poly" coords="88,446,90,451,109,455,114,463,121,465,128,464,135,459,157,464,180,472,178,469,151,456,137,451,132,443,125,438,114,440,110,445,109,447,97,446" title="Left posterolateral"
onClick="selectRow('14a');"  onMouseOver="lightUpRow('14a');" onMouseOut="unLightUpRow('14a');" /> 

<area shape="poly" coords="99,486,106,474,131,475,141,467,149,467,158,475,222,479,181,486,158,487,151,494,140,493,133,488" title="Left posterolateral"
onClick="selectRow('14b');"  onMouseOver="lightUpRow('14b');" onMouseOut="unLightUpRow('14b');" /> 

</map>
<?php } else  { ?>
    <img src="<?php echo base_url(); ?>images/left.png" width="400" height="560" border="0" usemap="#mapleft" />

<map name="mapleft">
<!-- #$-:Image map file created by GIMP Image Map plug-in -->
<!-- #$-:GIMP Image Map plug-in by Maurits Rijk -->
<!-- #$-:Please do not edit lines starting with "#$" -->
<!-- #$VERSION:2.3 -->
<!-- #$AUTHOR:Luc Strijbosch -->
<area shape="poly" coords="161,48,167,38,148,30,133,29,122,25,113,26,106,40,91,59,90,79,75,93,60,117,63,118,73,105,90,87,90,92,102,89,101,66,110,50,119,53,128,51,132,46,135,42,147,42" title="RCA proximal"
onClick="selectRow('1');"  onMouseOver="lightUpRow('1');" onMouseOut="unLightUpRow('1');" />

<area shape="poly" coords="90,94,104,93,100,114,102,136,113,142,117,152,111,163,109,164,113,179,130,202,123,213,120,208,109,230,92,238,103,224,114,201,103,184,96,164,89,157,87,152,88,145,91,141,89,120,91,106,90,101" title="RCA mid"
onClick="selectRow('2');"  onMouseOver="lightUpRow('2');" onMouseOut="unLightUpRow('2');" /> 

<area shape="poly" coords="123,216,132,204,137,216,141,219,149,212,157,213,165,218,166,225,178,224,192,216,215,213,213,217,192,223,182,232,165,236,163,236,152,241,143,237,138,231,130,227" title="RCA distal"
onClick="selectRow('3');"  onMouseOver="lightUpRow('3');" onMouseOut="unLightUpRow('3');" /> 

<area shape="poly" coords="85,314,95,317,101,297,88,292,83,283,73,279,61,286,59,298,66,307,73,308,79,308,87,310,85,314,96,317" title="Left main"
onClick="selectRow('5');"  onMouseOver="lightUpRow('5');" onMouseOut="unLightUpRow('5');" /> 

<area shape="poly" coords="102,310,143,323,147,330,156,333,165,332,179,337,178,354,181,372,186,378,182,358,186,339,191,341,194,329,170,320,166,307,154,304,148,307,144,310,104,298" title="segment LAD proximal"
onClick="selectRow('6');"  onMouseOver="lightUpRow('6');" onMouseOut="unLightUpRow('6');" /> 

<area shape="poly" coords="264,390,278,387,267,375,264,364,255,358,250,358,227,345,197,331,195,342,217,353,240,366,239,376,244,384,256,386,260,385,265,391" title="LAD mid"
onClick="selectRow('7');"  onMouseOver="lightUpRow('7');" onMouseOut="unLightUpRow('7');" /> 

<area shape="poly" coords="267,393,281,390,294,415,302,449,299,475,298,479,299,491,293,498,283,500,277,498,259,499,241,498,258,495,273,490,273,481,277,475,288,472,291,451,286,430,277,407" title="LAD apical"
onClick="selectRow('8');"  onMouseOver="lightUpRow('8');" onMouseOut="unLightUpRow('8');" /> 

<area shape="poly" coords="177,322,190,326,207,319,217,317,235,309,240,315,250,318,257,314,261,309,261,303,272,304,282,305,299,304,324,307,301,300,281,298,263,293,257,293,245,289,240,292,236,296,223,302,211,307,188,314" title="First diagonal"
onClick="selectRow('9');"  onMouseOver="lightUpRow('9');" onMouseOut="unLightUpRow('9');" /> 

<area shape="poly" coords="213,336,226,343,252,339,279,339,285,347,294,349,305,344,328,350,354,361,341,352,307,335,301,325,293,322,283,324,281,329,259,328,227,332" title="Additional first diagonal"
onClick="selectRow('9a');"  onMouseOver="lightUpRow('9a');" onMouseOut="unLightUpRow('9a');" /> 

<area shape="poly" coords="266,368,270,377,300,379,308,387,319,389,325,384,346,389,359,396,342,383,327,377,323,365,314,361,308,362,302,365,300,369,282,369" title="Second diagonal"
onClick="selectRow('10');"  onMouseOver="lightUpRow('10');" onMouseOut="unLightUpRow('10');" /> 

<area shape="poly" coords="283,392,288,402,308,408,310,417,315,424,327,425,334,419,352,431,342,418,336,414,333,403,325,398,318,399,313,401,297,395" title="Additional second diagonal"
onClick="selectRow('10a');"  onMouseOver="lightUpRow('10a');" onMouseOut="unLightUpRow('10a');" /> 

<area shape="poly" coords="84,316,95,319,100,328,99,336,95,341,87,344,79,386,66,383,72,357,76,340,72,333,73,323,79,318" title="Proximal circumflex"
onClick="selectRow('11');"  onMouseOver="lightUpRow('11');" onMouseOut="unLightUpRow('11');" /> 

<area shape="poly" coords="97,316,103,311,126,332,133,331,141,335,143,342,142,344,164,363,140,351,132,352,124,351,122,346,122,338" title="Intermediate/anterolateral artery"
onClick="selectRow('12');"  onMouseOver="lightUpRow('12');" onMouseOut="unLightUpRow('12');" /> 

<area shape="poly" coords="84,357,87,350,105,357,111,359,129,362,139,360,148,363,152,372,151,380,166,401,147,384,140,387,130,385,125,378,125,369,112,366,97,359" title="Obtuse marginal"
onClick="selectRow('12a');"  onMouseOver="lightUpRow('12a');" onMouseOut="unLightUpRow('12a');" /> 

<area shape="poly" coords="81,378,78,383,101,392,109,393,130,402,129,410,133,417,139,421,145,421,152,416,160,422,155,415,156,406,151,396,142,394,134,397,107,385,100,384" title="Obtuse marginal"
onClick="selectRow('12b');"  onMouseOver="lightUpRow('12b');" onMouseOut="unLightUpRow('12b');" /> 

<area shape="poly" coords="67,385,79,387,79,394,84,400,86,410,81,418,88,450,106,479,111,483,101,487,82,465,72,442,68,419,61,413,59,407,61,399,65,394,66,394" title="Distal circumflex"
onClick="selectRow('13');"  onMouseOver="lightUpRow('13');" onMouseOut="unLightUpRow('13');" /> 

<area shape="poly" coords="85,413,98,416,96,425,102,434,112,436,120,433,122,425,163,443,151,432,123,418,119,412,110,408,103,410,88,405" title="Left posterolateral"
onClick="selectRow('14');"  onMouseOver="lightUpRow('14');" onMouseOut="unLightUpRow('14');" /> 

<area shape="poly" coords="88,443,91,451,109,451,113,462,127,466,137,458,161,463,182,470,160,457,137,450,132,440,121,437,115,440,110,444,91,443" title="Left posterolateral"
onClick="selectRow('14a');"  onMouseOver="lightUpRow('14a');" onMouseOut="unLightUpRow('14a');" /> 

<area shape="poly" coords="107,477,112,483,132,483,138,491,146,494,155,490,160,483,174,484,190,482,210,476,214,470,199,475,174,478,164,476,160,476,156,469,147,466,141,467,137,470,133,473,133,477,120,476" title="Left posterolateral"
onClick="selectRow('14b');"  onMouseOver="lightUpRow('14b');" onMouseOut="unLightUpRow('14b');" /> 

<area shape="poly" coords="103,490,114,486,130,496,157,502,167,503,172,495,177,491,186,491,193,496,196,502,231,494,231,496,195,506,190,514,185,518,175,516,169,509,145,508,123,503" title="Posterior descending"
onClick="selectRow('15');"  onMouseOver="lightUpRow('15');" onMouseOut="unLightUpRow('15');" /> 

</map>

 <?php } ?>
</div>
            
        </td>
        <td style="height:392px;width:350px;text-align:left;vertical-align: top">
            <!-- Segment Content -->
                     <div class="darkred" id="title"><b>3. Specify which segments are diseased for <u>lesion </u></b></div>
                      <span id="meCurrentLesionString"></span>

                    </b></div>  <a onmouseout='$("#title").notify("");'  onmouseover='$("#title").notify("Definition: Each coronary lesion with a Diameter Stenosis of \n at least 50% in a vessel larger than 1.5 mm must be scored. \n Each lesion can involve one or more diseased segments. \n If serial stenoses are less than 3 vessel reference diameters apart,\n  they should be scored as one lesion. However,\n  stenoses at a greater distance from each other\n  (more than 3 vessel reference diameters), \n are considered as separate lesions.","info");'><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a>              

                    <br>
                    <i>Click on the coronary tree image to select or unselect segments.</i>
             <table cellspacing="0" cellpadding="0" border="0" class="selecttable"  width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap></th>
                                <th nowrap>Segments</th>
                               <th nowrap>Lesion</th>
                                <th nowrap><?php echo $LesionsID;?></th>
                              
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($segment->result() as $row){
                                $j++;
                            ?>
                            <tr id="row_<?php echo $row->syntaxScoreSegment;?>"> 
                             
                                <td id="row1_<?php echo $row->syntaxScoreSegment;?>" style="padding : 2px 8px;line-height : 20px;"><font color="#C50000"><b><?php echo $row->syntaxScoreSegmentCategoryLabel;?></b></font></td>
                                <td style="padding : 2px 8px;line-height : 20px;"><?php echo $row->syntaxScoreLabel;?></td>
                            
                               <td style="padding : 2px 8px;line-height : 20px;"><?php echo $row->syntaxScoreSegment;?>  </td>
                                 
                                <td style="padding : 2px 8px;line-height : 20px;">
                                    <input type="checkbox" name="check_<?php echo $row->syntaxScoreSegment;?>" 
                                    id="check_<?php echo $row->syntaxScoreSegment;?>" value="1" onclick="clickrow('<?php echo $row->syntaxScoreSegment;?>');"></td>
                                
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                    <div style="float: right">
                      <button type="submit" class="grey medium" id="nextAction"><span>Next  >></span></button>
                                 <input type="hidden" name="dominance" id="dominance" class="small" value="<?php echo $dominance;?>" />
                                 <input type="hidden" name="patientID" id="patientID" class="small" value="<?php echo $c->patientID;?>" />
                                 <input type="hidden" name="segmentCount" id="segmentCount" class="small" value="0" />
                     </div>
            </form>  
            
        </td>
        </tr>
        <tr>
          <td colspan="2" style="height:40px;width:600px;text-align:center;" bgcolor="#F4F004">
              SYNTAX score 教學網頁：<br/>
              <a href="http://www.syntaxscore.com/index.php/tutorial/definitions" target="_blank">http://www.syntaxscore.com/index.php/tutorial/definitions</a>
             
              </td>
          </tr>
</table>
               
            
            </div>
        </div>

 
     
     
        </div>
      
       
  
  
 <?php $this->load->view("footer");?>  
    
</div>
<script>
 chkButton();
    function selectRow(rowId) {
       $("#row_"+rowId).css("background-color", "#81bbd5");
          if(!$("#check_"+rowId).is(':checked') ) {
               $("#check_"+rowId).prop("checked", true);
               $('#segmentCount').val(parseInt($('#segmentCount').val())+1);
    }
      chkButton();

    }

function lightUpRow(rowId) {
       $("#row_"+rowId).css("background-color", "#ffcccc");
}

// Only 'unLight' row when not selected
function unLightUpRow(rowId) {
    if( !$("#check_"+rowId).is(':checked') ) {
        $("#row_"+rowId).css("background-color", "#ffffff");
    }  else {
         $("#row_"+rowId).css("background-color", "#81bbd5");
    }
}

function clickrow(rowId) {
    if($("#check_"+rowId).is(':checked') ) {
        $("#row_"+rowId).css("background-color", "#81bbd5");
        $('#segmentCount').val(parseInt($('#segmentCount').val())+1);
    }  else {
        $("#row_"+rowId).css("background-color", "#ffffff");
        if($('#segmentCount').val()>0)
        $('#segmentCount').val(parseInt($('#segmentCount').val())-1);
    }
    chkButton();
}

function chkButton(){
    //alert($('#segmentCount').val());
    if($('#segmentCount').val()=="0"){
          $("#nextAction").removeClass("blue medium");
          $("#nextAction").addClass("grey medium");
          $("#nextAction").attr("disabled", true);;
    } else {
        $("#nextAction").removeClass("grey medium");
        $("#nextAction").addClass("blue medium");
        $("#nextAction").attr("disabled", false);
    }
}
</script>

</body>

</html> 