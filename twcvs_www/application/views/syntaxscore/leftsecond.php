<script language="javascript" type="text/javascript">
<!--
function buildTable()
//dynamic table
{
    meNumberOfLesions=1;
var nrOfSegments = parseInt(meDiffuseTableArray.length);
var nrOfLesions=parseInt(meNumberOfLesions);
var CurrentLesion = parseInt(meCurrentLesion);
var label='';
var number='';
var showme='0';
var theColor='a2dbf2';
//var theColorHandeled='#EBEBEB';
var theColorHandeled='#EBEBEB';
var theCorrectColor='';
var theDefaultColor='#FFFFFF';
var retString="";
//show header
retString+='<table class="sotable" id="sumanswertable" cellpadding="0" cellspacing="0" border="1">';
retString+='<tr><td style="width:20px; padding-left: 2px;">&nbsp;</td><td style="width:150px;text-align:center;">&nbsp;</td><td style="width:50px;text-align:center;">Lesions:</td>';

for (var j = 0; j < nrOfLesions; j++)
{
    theCorrectColor=theDefaultColor;
    retString+='<td id="les&'+j+'" style="width:50px;text-align:center;background-color:';
    
    if (CurrentLesion==j)
        {
        theCorrectColor=theColor;
        
        }
    if (j<CurrentLesion)
        {
        theCorrectColor=theColorHandeled;
        }   
    
    retString+=theCorrectColor;
        
   retString+='">'+(j+1)+'</td>';
}
retString+='</tr>';
//header line 2
retString+='<tr><td style="width:20px; padding-left: 2px;">&nbsp;</td><td style="width:200px;text-align:left;padding-left:5px;" colspan="2"><i>Segments:</i></td>';
for (var j = 0; j < nrOfLesions; j++)
{
    retString+='<td style="width:50px;text-align:center;">&nbsp;</td>';
}
retString+='</tr>';

for (var i = 0; i < nrOfSegments; i++)
    {
        label=meDiffuseTableArray[i][0];
        if (label=='') {label='&nbsp;'};
        number=meDiffuseTableArray[i][1];
        showme=meDiffuseTableArray[i][2];
        
        if (showme=='1') 
            {
            retString+='<tr><td style="width:30px; padding-left: 2px;">' + meDiffuseTableArray1stColumn[i] + '</td>' +
                        '</td><td style="width:150px;text-align:left;padding-left:5px">';
            retString+=label;
            retString+='</td><td style="width:50px;text-align:center;">';
            retString+=number;
            retString+='</td>';
                for (var j = 0; j < nrOfLesions; j++)
                {   
                
                    retString+='<td ID="vv'+i+'d'+j+'" style="width:50px;text-align:center;background-color:';

                    theCorrectColor=theDefaultColor;
                
                    if (CurrentLesion==j)
                    {
                        theCorrectColor=theColor;
                    }
                
                    if (j<CurrentLesion)
                    {   
                        theCorrectColor=theColorHandeled;
                    }   
    
                     retString+=theCorrectColor;
    
                    retString+='">';


                    if (meSegmentsInvolved[i][j]==1)
                    {
                    retString+='X';
                    }
                    else
                    {
                    retString+='&nbsp;';
                    }
                    retString+='</td>';
                }
            retString+='</tr>';
            }
    }
   // alert(retString);
    retString+='</table>';
    $('#divLeftSecond').html(retString);
    $('#syntaxscore_reultTable').val(retString);
}
    
function buildTableOLD()
//dynamic table
{
    meNumberOfLesions=1;
var nrOfSegments = parseInt(meDiffuseTableArray.length);
var nrOfLesions=parseInt(meNumberOfLesions);
var CurrentLesion = parseInt(meCurrentLesion);
var label='';
var number='';
var showme='0';
var theColor='a2dbf2';
//var theColorHandeled='#EBEBEB';
var theColorHandeled='#EBEBEB';
var theCorrectColor='';
var theDefaultColor='#FFFFFF';
//show header
document.write('<tr><td style="width:20px; padding-left: 2px;">&nbsp;</td><td style="width:150px;text-align:center;">&nbsp;</td><td style="width:50px;text-align:center;">Lesions:</td>');

for (var j = 0; j < nrOfLesions; j++)
{
    theCorrectColor=theDefaultColor;
    document.write('<td id="les&'+j+'" style="width:50px;text-align:center;background-color:');
    
    if (CurrentLesion==j)
        {
        theCorrectColor=theColor;
        
        }
    if (j<CurrentLesion)
        {
        theCorrectColor=theColorHandeled;
        }   
    
    document.write(theCorrectColor);
        
    document.write('">'+(j+1)+'</td>');
}
document.write('</tr>');
//header line 2
document.write('<tr><td style="width:20px; padding-left: 2px;">&nbsp;</td><td style="width:200px;text-align:left;padding-left:5px;" colspan="2"><i>Segments:</i></td>');
for (var j = 0; j < nrOfLesions; j++)
{
    document.write('<td style="width:50px;text-align:center;">&nbsp;</td>');
}
document.write('</tr>');

for (var i = 0; i < nrOfSegments; i++)
    {
        label=meDiffuseTableArray[i][0];
        if (label=='') {label='&nbsp;'};
        number=meDiffuseTableArray[i][1];
        showme=meDiffuseTableArray[i][2];
        
        if (showme=='1') 
            {
            document.write('<tr><td style="width:30px; padding-left: 2px;">' + meDiffuseTableArray1stColumn[i] + '</td>' +
                        '</td><td style="width:150px;text-align:left;padding-left:5px">');
            document.write(label);
            document.write('</td><td style="width:50px;text-align:center;">');
            document.write(number);
            document.write('</td>');
                for (var j = 0; j < nrOfLesions; j++)
                {   
                
                    document.write('<td ID="vv'+i+'d'+j+'" style="width:50px;text-align:center;background-color:');

                    theCorrectColor=theDefaultColor;
                
                    if (CurrentLesion==j)
                    {
                        theCorrectColor=theColor;
                    }
                
                    if (j<CurrentLesion)
                    {   
                        theCorrectColor=theColorHandeled;
                    }   
    
                    document.write(theCorrectColor);
    
                    document.write('">');


                    if (meSegmentsInvolved[i][j]==1)
                    {
                    document.write('v');
                    }
                    else
                    {
                    document.write('&nbsp;');
                    }
                    document.write('</td>');
                }
            document.write('</tr>');
            }
    }
    
    
}

function ShowDominance()
{
var Dominance = meDominance;
var retString='';
    switch(Dominance)
    {
        case "left": 
                    retString+='<img height="200" src="<?php echo base_url(); ?>images/lefth.png">';
                    break;
        case "right": 
                    retString+='<img height="200" src="<?php echo base_url(); ?>images/righth.png">';
                    break;
    }               
    
    $('#divShowDominance').html(retString);
}

//-->
</script>



    <table cellSpacing="0" cellPadding="0" border="0" class="statusmaintablepadding">
        <tr>
            <td>
              <div class="statusdiv" id="more">
                <table border="0" cellpadding="0" cellspacing="0" class="statusmaintable">
                    <div id="divLeftSecond"></div>
                  
                </table>
              </div>
            </TD>
        </TR>           
        <TR bgColor="#FFFFFF">
            <TD vAlign="top" style="padding-top:5px;">
        
                 <div id="divShowDominance"></div>
            </TD>
        </TR>
    </TABLE>
