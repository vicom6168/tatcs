<script language="javascript" type="text/javascript">
<!--
var nrOfLesions=parseInt(meNumberOfLesions);
meCurrentLesion=0;
function buildTableSingleLesion() {
    var label='';
    var number='';
    var showme='0';
    var retString="";

    // header
    retString+='<tr><td style="width:30px; padding-left: 2px;">&nbsp;</td><td style="width:190px;text-align:center;">&nbsp;</td><td style="width:80px;text-align:center;"><b>Lesion:</b></td>';
    retString+='<td style="width:50px;text-align:center;"><b>'+(meCurrentLesion+1)+'</b></td>';
    retString+='</tr>';

    retString+='<tr><tr><td style="width:30px; padding-left: 2px;">&nbsp;<td style="width:180px;text-align:left;padding-left:5;" colspan="2"><i>Segments:</i></td><td style="width:50px;text-align:center;">&nbsp;</td>';

    //body
    for (var i = 0; i < meDiffuseTableArray.length; i++) {
        label=meDiffuseTableArray[i][0];
        if (label=='') {
            label='&nbsp;';
        }
    
        number=meDiffuseTableArray[i][1];
        showme=meDiffuseTableArray[i][2];

        if (showme=='1') {
        j = meCurrentLesion;
       
        retString+='<tr id="row_' + i + j + '">' + 
        '<td style="width:30px; padding-left: 2px;">' + meDiffuseTableArray1stColumn[i] + '</td>' +
            '<td style="width:170px;text-align:left;padding-left:5px;padding-right:5px;">';

        retString+=label;
        retString+='</td><td style="width:80px;text-align:center;">';
        retString+=number;
        retString+='</td>';

        retString+='<td style="width:50px;text-align:center;"><input type="checkbox" ID="dd'+i+'d'+j+'" VALUE="1" NAME="dd'+i+'d'+j+'" onchange="setValue('+i+','+j+',this); toggleLightUpRow(\'row_' + i + j + '\',\'' + 'dd'+i+'d'+j+'\');"></td>';      
        retString+='</tr>';
        }
    }
    retString+='<tr><TD colspan="'+(nrOfLesions+3)+'" class="buttontd"><input  type="button" value="next" border="0" width="50" height="21" onClick="javascript:Continue();" style="height:30px"></TD></TR>';  
    //alert(retString);
    $('#divLeftmainContent').html(retString);
    $('#meCurrentLesionString').html((meCurrentLesion + 1).toString());
}
function buildTableSingleLesionOLD() {
    var label='';
    var number='';
    var showme='0';

    // header
    document.write('<tr><td style="width:30px; padding-left: 2px;">&nbsp;</td><td style="width:190px;text-align:center;">&nbsp;</td><td style="width:80px;text-align:center;"><b>Lesion:</b></td>');
    document.write('<td style="width:50px;text-align:center;"><b>'+(meCurrentLesion+1)+'</b></td>');
    document.write('</tr>');

    document.write('<tr><tr><td style="width:30px; padding-left: 2px;">&nbsp;<td style="width:180px;text-align:left;padding-left:5;" colspan="2"><i>Segments:</i></td><td style="width:50px;text-align:center;">&nbsp;</td>');

    //body
    for (var i = 0; i < meDiffuseTableArray.length; i++) {
        label=meDiffuseTableArray[i][0];
        if (label=='') {
            label='&nbsp;';
        }
    
        number=meDiffuseTableArray[i][1];
        showme=meDiffuseTableArray[i][2];

        if (showme=='1') {
        j = meCurrentLesion;
       
        document.write('<tr id="row_' + i + j + '">' + 
        '<td style="width:30px; padding-left: 2px;">' + meDiffuseTableArray1stColumn[i] + '</td>' +
            '<td style="width:170px;text-align:left;padding-left:5px;padding-right:5px;">');

            document.write(label);
        document.write('</td><td style="width:80px;text-align:center;">');
        document.write(number);
        document.write('</td>');

        document.write('<td style="width:50px;text-align:center;"><input type="checkbox" ID="dd'+i+'d'+j+'" VALUE="1" NAME="dd'+i+'d'+j+'" onchange="setValue('+i+','+j+',this); toggleLightUpRow(\'row_' + i + j + '\',\'' + 'dd'+i+'d'+j+'\');"></td>');      
        document.write('</tr>');
        }
    }
    document.write('<tr><TD colspan="'+(nrOfLesions+3)+'" class="buttontd"><input  type="button" value="next" border="0" width="50" height="21" onClick="javascript:Continue();" style="height:30px"></TD></TR>');  
}




function setValue(Segment,Lesion,me)
{
    SetSegmentsInvolved(Segment,Lesion,me);
}

function CheckForm()
{
    var tScore=0;
    
    for (var i = 0; i < nrOfLesions; i++)
    {
        tScore=0;

        for (var j = 0; j < meSegmentsInvolved.length; j++)
        {
                tScore=tScore + meSegmentsInvolved[j][i];
        }
        if (tScore==0)
        {
            return false;
        }
    }
    return true;
}

function CheckFormSingleLesion(){
    var tScore=0;
    tScore=0;

    for (var j = 0; j < meSegmentsInvolved.length; j++)
    {
        tScore=tScore + meSegmentsInvolved[j][meCurrentLesion];
    }
    
    if (tScore==0)
    {
    return false;
    }

    return true;    
}

function Continue()
{
   //only allowed
   if (CheckFormSingleLesion())
   {
       SegmentsInvolvedSave();

       CalculateTotalOcclusion();
       
       
   }
   else
   {
       alert('Select at least one segment per lesion.');
   }
}


//-->
</script>

    <DIV id='overDiv' style='position:absolute; visibility:hidden; z-index:1000;'></div>



<TABLE cellSpacing=0 cellPadding=0 class="maintable" ID="Table3">
  <TBODY>
    
            
        <TR bgColor=#FFFFFF>
            <TD class=body vAlign=top >


                    <div class="darkred"><b>3. Specify which segments are diseased for <u>lesion 

                  <span id="meCurrentLesionString"></span>

                    </b></div> &nbsp;

                                        <a href='#' onMouseOver="javascript:return overlib('Definition: Each coronary lesion with a Diameter Stenosis of at least 50% in a vessel larger than 1.5 mm must be scored. <br>Each lesion can involve one or more diseased segments. If serial stenoses are less than 3 vessel reference diameters apart, they should be scored as one lesion. However, stenoses at a greater distance from each other (more than 3 vessel reference diameters), are considered as separate lesions.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a>              

                    <br>
                    <i>Click on the coronary tree image to select or unselect segments.</i>                 

            </TD>
        </tr>       
        
        <tr>
          <TD class="body">
            <div id="more" style="padding-top:20px;">                                   
                <table border="0" cellpadding="0" cellspacing="0" class="selecttable">
                   <div id="divLeftmainContent"></div>
                </table>
            </div>
          </TD>
        </TR>           
    
</TBODY>
</TABLE>

</table>
