
/******************************************************
 * Syntax Score Calculator Version 2.0                *
 *                                                    *
 * Orginal code (version 1.0): ISM (2005)             *
 * Adaptions    (version 2.0): Luc Strijbosch (2009)  *
 ******************************************************/

var DiffuseDiseaseScore = 0;
var answer = 'no';

function buildDiffuseSegmentTable()
//dynamic table
{
	alert('updateMeAllSegmentsMerged');
    DiffuseDiseaseScore = 0;
    resetMeAllSegmentsMerged();
    updateMeAllSegmentsMerged();

    if (showVesselForAll(1))
    {
	buildDiffuseSegmentTableRows(0,7);
    }
    if (showVesselForAll(2))
    {
	buildDiffuseSegmentTableRows(8,8);
    }
    if (showVesselForAll(3))
    {
	buildDiffuseSegmentTableRows(9,15);
    }
    if (showVesselForAll(4))
    {
	buildDiffuseSegmentTableRows(16,24);
    }
}

function buildDiffuseSegmentTableRows(iStart,iEnd)
{
    var label='';
    var number='';
    var showme='0';
    
    var retString="<table>";


    for (var i = iStart; i <=iEnd; i++)
    {
	label=meDiffuseTableArray[i][0];

	if (label=='') {
            label='&nbsp;'
        };

	number=meDiffuseTableArray[i][1];
	showme=meDiffuseTableArray[i][2];

	if (showme=='1') 
	{
	    blnQ12Enabled=true;
	    retString+='<tr><td style="width:180px;text-align:left;padding-left:5px;">';

	    retString+=label;
	    retString+='</td><td style="width:80px;text-align:center;">';

	    retString+=number;
	    retString+='</td><td style="width:200px;text-align:center;"><input type="checkbox" ID="dd'+i+'" VALUE="1" NAME="dd'+i+'" onClick="setDiffuseDisease('+i+',this); "></td></tr>';
	}
    }
    retString+="</table>";
    alert("retString:"+retString);
    return retString;
}

function Question12(number)
{
    //yes = 1
    //no  = 0
    alert(number);
    if (number=='1')
    {
	answer = 'yes';
    
	//getById('right', 'q12yes').style.display='block';
	$('#q12yes').show();

	//getById('right', 'calcbutton').style.display='block';
	$('#calcbutton').show();
    }
    // no
    else
    {
	answer = 'no';

	// resetQuestion(12,1);
	resetVesselScoresForAll();
	resetMeAllSegmentsMerged();

	// hide q12yes
	//getById('right', 'q12yes').style.display='none';
	$('#q12yes').hide();

	// show save button if question 12 has been answered.
	//getById('right', 'calcbutton').style.display='block';
	$('#calcbutton').show();
    }
}

function setDiffuseDisease(arraynumber,me)
{			
    setDiffuseDisease(arraynumber,me);
			
    var newValue=-1;
    if (me.checked) 
    {
	newValue=1;
    }
			
    DiffuseDiseaseScore = DiffuseDiseaseScore + newValue;
}

function checkAndCalc() {
	alert(DiffuseDiseaseScore);
    alert(answer);
    if( DiffuseDiseaseScore > 0 || answer == 'no' ) {
    
	navigateToScoreOverview();
    } else {
	alert('Please select at least one segment');
	}
}

function saveDiffuseSegment()
{
    if ( DiffuseDiseaseScore!=0 )
    {
	//getById('right', 'calcbutton').style.display='block';
		$('#calcbutton').show();
    }
    else
    {
	alert('Select at least one segment');
    }
}