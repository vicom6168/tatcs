<!--
var blnPageEnabled=false;
var SkpText='Skipped';
var subtotal=0;
var blnDiffDes=false;

if ((blnInitCalled) && (ApplicationEnded))
{
    blnPageEnabled=true;
}

if (blnPageEnabled)
{
    //read params from parent frame
    var nrofLesion=meNumberOfLesions;
}
	
var blnCalculationDone = false;


function isVesselInfected(iStart, IEnd) {

    for (var  i = iStart; i <= IEnd; i++)
    {
	if (meAllSegmentsMerged[i] == 1 )
	    return true;
    }

    return false; 
}


/**
   This function uses the same functionality as question 12, all segmemts
   involved are merged in one 'temporary artificial lesion' to easily
   look up which segments were involved overall.	   
**/
function showPicture() {

    // recalculate all segments merged
    resetMeAllSegmentsMerged();
    updateMeAllSegmentsMerged();

    if( ( isVesselInfected(8,8) ) || 
	( isVesselInfected(0,7) && isVesselInfected(9,15) && isVesselInfected(16,24) )
	)
    {
	return true;
    }
	    

    return false;
}

function returnApplicablePictureLink(idName) {
	    
    strImg = '';

    if( showPicture()  ) {
	    
	strComment = 'The cumulative MACCE rate is displayed for the SYNTAX Trial group this score corresponds to.';    

	if( meScore >= 0 && meScore <= 22 ) {
	    strImg  = '<div id="'+ idName +'" class="kmpicture"><b>MACCE by SYNTAX Score 0-22</b><br><img style="margin-bottom:5px;" src="images/KM1.png" align=center><br>';
	    strImg += '<i> ' + strComment + '</i> </div><br><br>';
	}
	else if(meScore >= 23 && meScore <= 32 ){
	    strImg  = '<div id="'+ idName +'" class="kmpicture" ><b>MACCE by SYNTAX Score 23-32</b><br><img style="margin-bottom:5px;" src="images/KM2.png" align=center><br>';
	    strImg += '<i> ' + strComment + '</i> </div><br><br>';
	}
	else if(meScore > 32 ) {
	    strImg  = '<div id="'+ idName +'" class="kmpicture"><b>MACCE by SYNTAX Score 33+</b><br><img style="margin-bottom:5px;" src="images/KM3.png" align=center><br>';
	    strImg += '<i> ' + strComment + '</i> </div><br><br>';
	}
	else
	    strImg = '';    
    }

    return strImg;
}

function buildScoreOverviewTablePrint() 
{
    var CalculationFactor=2;
    var arrayDepth=4;
    var Dominance=meDominance;
    subtotal=0;
    var strTemp='';
    var printOverView = '';
    var printOverViewHead = '';

			
    /*******************  Table for printing *****************************************************************/
		
    printOverViewHead = '<table class="sotable" id="allanswertable" width=100%><tr><td width=30%></td><td width=70%></td></tr>';
  //  if( getById('left', 'patientId').value != "" ) {
  	if(1==1){
//	printOverViewHead += '<tr><td> Patient ID: </td><td>' +  getById('left', 'patientId').value + '</td></tr>';
    }
    else {
	printOverViewHead += '<tr><td> Patient ID: </td><td>...................................</td></tr>';
    }

   //if( getById('left', 'patientName').value != "" ) {
   	if(1==1){
//	printOverViewHead += '<tr><td> Name : </td><td>' +  getById('left', 'patientName').value + '</td></tr>';
    }
    else {
	printOverViewHead += '<tr><td> Name : </td><td>...................................</td></tr>';
    }

   // if( getById('left', 'patientDob').value != "" ) {
   	if(1==1) {
	//printOverViewHead += '<tr><td> Date of birth: </td><td>' +  getById('left', 'patientDob').value + '</td></tr>';
    }
    else {
	printOverViewHead += '<tr><td> Date of birth: </td><td>...................................</td></tr>';
    }		
    printOverViewHead += '</table>';

    printOverView += '<table class="sotable" id="allanswertable" cellpadding="0" cellspacing="0" border="0">';

    printOverView += '<tr><td colspan="2">';

    printOverView += '</td></tr>';

    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');

    printOverView += SumarLinePrint('genheader','genheader','All answers','&nbsp;');
		    
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');

		
    printOverView += SumarLinePrint('','','1. Dominance',Dominance);	
		
    printOverView += SumarLinePrint('','','2. Number of lesions',nrofLesion);
			
			
    //per lession
    for (var i = 0; i < nrofLesion; i++)
    {	
	printOverView += SumarLinePrint('sumarspacer','sumarspacer','<br>','&nbsp;');
	printOverView += SumarLinePrint('lesionheader','sumarspacer','lesion ' + (i+1),'&nbsp;');
	//segmenten
	strTemp='';
	for (var j = 0; j < meDiffuseTableArray.length; j++)
	{
	    if (meSegmentsInvolved[j][i]==1)
	    {						
					
		if (strTemp!='') 
		{
		    strTemp=strTemp+'<br>';		
		}
							
		strTemp=strTemp + meDiffuseTableArray[j][1];
	    }
	}
	if (strTemp=='') {
	    strTemp='Skipped';
	}
	printOverView += SumarLinePrint('','','3. segment numbers involved',strTemp);
			
	if (meTotalOcclusion[i]==1)
	{
	    strTemp='Yes';
	}
	else
	{
	    strTemp='No';
	}
						
	printOverView += SumarLinePrint('','','4. Total occlusion',strTemp);
			
	strTemp='';
	if (meTotalOcclusion[i] == 1 )
	{
	    for (var j = 0; j < meDiffuseTableArray.length; j++)
	    {
		if (meIndicateSegmentNumber[j][i]==1)
		{
		    if (strTemp!='') 
		    {
			strTemp=strTemp+'<br>';		
		    }
		    strTemp=strTemp + meDiffuseTableArray[j][1];
		}			    
	    }
			    
	    printOverView += SumarLinePrint('','','&nbsp;&nbsp;I. segment numbers',strTemp);
	}
	//prox number
	strTemp=meProximalSegmentNumber[i];
	if (strTemp=='')
	{
	    strTemp=SkpText;
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;I. Most proximal segment number',strTemp);
			
			
			
	//age
	strTemp=SkpText;
	if (meAgeofTO[i]!=-1)
	{
	    strTemp='no';
	    if (meAgeofTO[i]==1)
	    {
		strTemp='yes';
	    }
	    if (meAgeofTO[i]==2)
	    {
		strTemp='unknown';
	    }
	}
								
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;II. More than 3 months',strTemp);
	//blunt
	strTemp=SkpText;
	if (meBluntStump[i]!=-1)
	{
	    strTemp='yes';
	    if (meAgeofTOScore[i]==0)
	    {
		strTemp='no';
	    }
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;III. Blunt stump',strTemp);
			
	//briding
	strTemp=SkpText;
	if (meBridging[i]!=-1)
	{
	    strTemp='yes';
	    if (meBridgingScore[i]==0)
	    {
		strTemp='no';
	    }
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;IV. Bridging',strTemp);
			
			
	//the first segment number beyond the total occlusion that is visualized by antegrade or retrograde contrast. 
	strTemp=meSegments[i];
			
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;V. the first segment beyond the T.O. visualized by contrast: ',strTemp);
			
	//side branch
	strTemp=SkpText;
	if (meSideBranch[i]!=-1)
	{
	    strTemp=meSideBranchAnswers[meSideBranch[i]];
				
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;VI. Sidebranch',strTemp);
			
	//trifurcation
	strTemp=SkpText;
	if (meTrifurcation[i]!=-1)
	{
	    strTemp='No';	
	    if (meTrifurcationScore[i]!=0)
	    {
		strTemp='Yes ' + meTrifurcation[i]  + ' diseased segment(s) involved'
		    }
				
	}
	printOverView += SumarLinePrint('','','5. Trifurcation',strTemp);
			
	//Bifurcation
	if (meQ6Skipped[i])
	{
	    strTemp=SkpText;
	}
	else
	{
	    if (meBifurcationScore[i]==0)
	    {
		strTemp='No';
	    }
	    else
	    {
		strTemp='Yes: ' + meBifurcationMapping[meBifurcation[i]];
	    }
	}
	printOverView += SumarLinePrint('','','6. Bifurcation',strTemp);
				
	//Bifurcation angulation
	if ((meQ6Skipped[i]) || (meBifurcationScore[i]==0))
	{
	    strTemp=SkpText;
	}
	else
	{
	    strTemp='yes';
	    if (meBifurcationAngulationScore[i]==0)
	    {
		strTemp='No';
	    }
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;&nbsp;&nbsp;Bifurcation angulation',strTemp);
			
			
	//Aorto Ostial lesion
	if (meQ7Skipped[i])
	{
	    strTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
		if (meAortoOstialLesionScore[i]==0)
		{
		    strTemp='No'
		}
	}
	printOverView += SumarLinePrint('','','7. Aorto Ostial lesion',strTemp);
			
	//Severe Tortuosity
	if (meSevereTortuosity[i]==-1)
	{
	    strTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
		if (meSevereTortuosityScore[i]==0)
		{
		    strTemp='No'
		}
	}
	printOverView += SumarLinePrint('','','8. Severe Tortuosity',strTemp);
			
	//Length &gt;20 mm
	if (meLength[i]==-1)
	{
	    strTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
		if (meLengthScore[i]==0)
		{
		    strTemp='No'
		}
	}
	printOverView += SumarLinePrint('','','9. Length &gt;20 mm',strTemp);
			
			
	//Heavy calcification
	if (meHeavyCalcification[i]==-1)
	{
	    strTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
		if (meHeavyCalcificationScore[i]==0)
		{
		    strTemp='No'
		}
	}
	printOverView += SumarLinePrint('','','10. Heavy calcification',strTemp);
			
	//Thrombus
	if (meThrombus[i]==-1)
	{
	    strTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
		if (meThrombusScore[i]==0)
		{
		    strTemp='No'
		}
	}

	printOverView += SumarLinePrint('','','11. Thrombus',strTemp);
	
	printOverView += SumarLinePrint('sumarspacer','sumarspacer','Comment','&nbsp;');

	if (meComment[i]!='')
	{
				
	    printOverView += SumarLinePrint('','',meComment[i],'&nbsp;');
	}
    }


    /** Diffuse disease small/vessels **/
    var diffDisease = "";
    diffDisease += subDifusseDeseasePrintable(0,7);
    diffDisease += subDifusseDeseasePrintable(8,8);
    diffDisease += subDifusseDeseasePrintable(9,15);
    diffDisease += subDifusseDeseasePrintable(16,24);
   
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','<br>','&nbsp;');
    printOverView += SumarLinePrint('lesionheader','sumarspacer', 'Diffuse disease/Small vessels', '&nbsp;');
    if ( diffDisease != "" ) {  
	printOverView += SumarLinePrint('','','Segments selected', diffDisease);
	printOverView += '<tr><td colspan="2">&nbsp;</td></tr>';
    }
    else {
	printOverView += SumarLinePrint('','','Segments selected','No');
	printOverView += '<tr><td colspan="2">&nbsp;</td></tr>';
    }
    


    //Total Score
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');
    printOverView += SumarLinePrint('','','TOTAL SYNTAX SCORE:',GetScore());
	

    
    // pictures are at the end of the print out
    printOverView += '<tr><td colspan="2" align=center><br><br>';
    printOverView +=  returnApplicablePictureLink('') ;
    printOverView += '</td></tr>';    

    printOverView += '</table>';

    document.write(printOverViewHead);
    document.write(printOverView);

 //   getFrame('left').document.genPdfForm.printsource.value = printOverView;

    blnCalculationDone = true;

}

function buildScoreOverviewTable()
{	
    var CalculationFactor=2;
    var arrayDepth=4;
    var Dominance=meDominance;
    subtotal=0;
    var strTemp='';
		
    // picture first
    //document.write( returnApplicablePictureLink('kmpicturetop') );

    //sumary
    document.write('<table class="sotable" id="sumanswertable" cellpadding="0" cellspacing="0" border="0">');
		
    document.write('<tr><td class="genheader">Summary');
    document.write('</td><td>&nbsp;</td></tr>');
    document.write('<tr><td colspan="2">&nbsp;</td></tr>');
    document.write('<tr><td colspan="2">&nbsp;</td></tr>');	
		
    if (Dominance=='left')
    {
	arrayDepth=5;
    }
	
    for (var i = 0; i < nrofLesion; i++)
    {	
	subtotal=0;
	//lesion
	document.write('<tr><td class="lesionheader">Lesion ');
	document.write(i+1);
	document.write('</td><td>&nbsp;</td></tr>');
	//segments involved for this lesion
	CalculationFactor=2;
			
	if (meTotalOcclusion[i]==1)
	{
	    document.write('<tr><td class="sodata">segment number(s)');
	    document.write('</td><td class="soscore">&nbsp;</td></tr>');
	}
			
						
	for (var j = 0; j < meDiffuseTableArray.length; j++)
	{	
			
			
	    if (meSegmentsInvolved[j][i]==1)
	    {						
		CalculationFactor=2;
					
		if ((meIndicateSegmentNumber[j][i]==1))
		{
		    CalculationFactor=5;
		}	
					
		document.write('<tr><td class="sodata">(segment ');
		//segment number
		document.write(meDiffuseTableArray[j][1]);
		document.write('): ');
		//calculationfactor
		document.write(meDiffuseTableArray[j][arrayDepth]);
		document.write('x');
		document.write(CalculationFactor);
		document.write('=</td><td class="soscore">');
		document.write(meDiffuseTableArray[j][arrayDepth]*CalculationFactor);
		document.write('</td></tr>');
		subtotal=subtotal + (meDiffuseTableArray[j][arrayDepth]*CalculationFactor);
	    }
	}

	// age to
	if (meAgeofTOScore[i]!=0)
	{
	    subtotal=subtotal + meAgeofTOScore[i];
				
	    document.write('<tr><td class="sodata">Age T.O. is ');
	    if (meAgeofTO[i]==1)
	    {
		document.write ('yes');
	    }
	    else
	    {
		document.write ('unknown');
	    }
				
	    document.write('</td><td class="soscore">'+meAgeofTOScore[i]+'</td></tr>');
	}
			
	//blunt stump  meBluntStumpScore
	if (meBluntStumpScore[i]!=0)
	{
	    subtotal=subtotal + meBluntStumpScore[i];
	    document.write('<tr><td class="sodata">+ Blunt stump');
	    document.write('</td><td class="soscore">'+meBluntStumpScore[i]+'</td></tr>');
	}
			
	// Bridging  
	if (meBridgingScore[i]!=0)
	{
	    subtotal=subtotal + meBridgingScore[i];
	    document.write('<tr><td class="sodata">+ Bridging');
	    document.write('</td><td class="soscore">'+meBridgingScore[i]+'</td></tr>');
	}
			
	// contrast
	if ((meVisualizedByContrastScore[i]!=0) || (meSegments[i]!='Skipped'))
	{
	    subtotal=subtotal + meVisualizedByContrastScore[i];
			
	    document.write('<tr><td class="sodata">the first segment beyond the T.O. visualized by contrast: ');
	    //			if (meSegments[i]!=0)
	    //			{
	    document.write(meSegments[i]);
	    //			}
	    document.write('</td><td class="soscore">'+meVisualizedByContrastScore[i]+'</td></tr>');
	}
			
	// Sidebranch meSideBranchScore[meCurrentLesion]
	if (meSideBranchScore[i]!=0)
	{
	    subtotal=subtotal + meSideBranchScore[i];
	    document.write('<tr><td class="sodata">+ sidebranch: ');
	    document.write(meSideBranchAnswers[meSideBranch[i]]);
	    document.write('</td><td class="soscore">'+meSideBranchScore[i]+'</td></tr>');
	
	}
			
	//trifurcation
	if (meTrifurcationScore[i]!=0)
	{
	    subtotal=subtotal + meTrifurcationScore[i];
	    document.write('<tr><td class="sodata">Trifurcation ');
	    document.write(meTrifurcation[i]);
	    document.write(' diseased segment(s) involved');
	    document.write('</td><td class="soscore">'+meTrifurcationScore[i]+'</td></tr>');
	}
			
	//bifurcation
	if (meBifurcationScore[i]!=0)
	{
	    subtotal=subtotal + meBifurcationScore[i];
	    document.write('<tr><td class="sodata">Bifurcation Type: ');
	    document.write(meBifurcationMapping[meBifurcation[i]]);
	    document.write(': ');
	    document.write('</td><td class="soscore">'+ meBifurcationScore[i] +'</td></tr>');
	}
			
				
	//Bifurcation angulation
	if (meBifurcationAngulationScore[i]!=0)
	{
	    subtotal=subtotal + meBifurcationAngulationScore[i];
	    document.write('<tr><td class="sodata">Angulation &lt;70�');
	    document.write('</td><td class="soscore">'+meBifurcationAngulationScore[i]+'</td></tr>');
	}
				
	//Aorto Ostial lesion
	if (meAortoOstialLesionScore[i]!=0)
	{
	    subtotal=subtotal + meAortoOstialLesionScore[i];
	    document.write('<tr><td class="sodata">Aorto Ostial lesion');
	    document.write('</td><td class="soscore">'+meAortoOstialLesionScore[i]+'</td></tr>');
	}
				
				
	//Severe Tortuosity
	if (meSevereTortuosityScore[i]!=0)
	{
	    subtotal=subtotal + meSevereTortuosityScore[i];
	    document.write('<tr><td class="sodata">Severe Tortuosity');
	    document.write('</td><td class="soscore">'+meSevereTortuosityScore[i]+'</td></tr>');
	}
			
	// Length >20 mm
	if (meLengthScore[i]!=0)
	{
	    subtotal=subtotal + meLengthScore[i];
	    document.write('<tr><td class="sodata">Length &gt;20 mm');
	    document.write('</td><td class="soscore">'+meLengthScore[i]+'</td></tr>');
	}
			
	// Heavy calcification
	if (meHeavyCalcificationScore[i]!=0)
	{
	    subtotal=subtotal + meHeavyCalcificationScore[i];
	    document.write('<tr><td class="sodata">Heavy calcification');
	    document.write('</td><td class="soscore">'+meHeavyCalcificationScore[i]+'</td></tr>');
	}
			
	// Thrombus
	if (meThrombusScore[i]!=0)
	{
	    subtotal=subtotal + meThrombusScore[i];
	    document.write('<tr><td class="sodata">Thrombus');
	    document.write('</td><td class="soscore">'+meThrombusScore[i]+'</td></tr>');
	}
	
	//total
	document.write('<tr><td class="sosubtotal">Sub total lesion ' + (i+1));
	document.write('</td><td class="sosubtotalscore">' + subtotal + '</td></tr>');
			
	//comment
	if (meComment[i]!='')
	{
	    document.write('<tr><td colspan="2" class="sodata">Comment:<br><div class="socomment">');
	    document.write(meComment[i]+'</div></td></tr>');
	}		
	
	//spacers
	document.write('<tr><td colspan="2">&nbsp;</td></tr>');
	document.write('<tr><td colspan="2">&nbsp;</td></tr>');
   }

    /** Diffuse disease / Small vessels as a separate entry **/
    var diffDisease = "";
    var subTotalBeforeDiffDesease = subtotal;
    diffDisease += subDifusseDeseaseSummary(0,7);
    diffDisease += subDifusseDeseaseSummary(8,8);
    diffDisease += subDifusseDeseaseSummary(9,15);
    diffDisease += subDifusseDeseaseSummary(16,24);         

    if ( diffDisease != "" )
    {   
	document.write('<tr><td class="lesionheader">Diffuse disease/Small vessels');    
	document.write(diffDisease);

	document.write('<tr><td class="sosubtotal">Sub total diffuse disease/small vessels</td><td class="sosubtotalscore">' + (subtotal - subTotalBeforeDiffDesease) + '</td></tr>');
	document.write('<tr><td colspan="2">&nbsp;</td></tr>');
    }
    
    document.write('<tr><td class="sototal">TOTAL:');
    document.write('</td><td class="sototalscore">' + GetScore() + '</td></tr></table>');
    //end sumary
				
    // now continue with the extended one
		
    //dominance first			
}
	
	
function SumarLine(labelclass,valueclass,label,value)
{
    if (labelclass=='')
    {
	labelclass='sumarlabeldefault';
    }
    if (valueclass=='')
    {
	valueclass='sumarvaluedefault';
    }
		
    document.write ('<tr><td class="');
    document.write (labelclass);
    document.write ('">');
    document.write (label);
    document.write ('</td><td class="');
    document.write (valueclass);
    document.write ('">');
    document.write (value);
    document.write ('</td></tr>');
}

function SumarLinePrint(labelclass,valueclass,label,value)
{
    var txt = "";

    if (labelclass=='')
    {
	labelclass='sumarlabeldefault';
    }
    if (valueclass=='')
    {
	valueclass='sumarvaluedefault';
    }
		
    txt = '<tr><td class="';
    txt += labelclass;
    txt += '">';
    txt += label;
    txt += '</td><td class="';
    txt += valueclass;
    txt += '">';
    txt += value;
    txt += '</td></tr>';

    return txt;
}

	
function delayedPrintScore()
{
    window.focus();

    var date = new Date();
    var curDate = null;

    do { curDate = new Date(); }
    while(curDate-date < 1250);

    window.print();
}

function PrintScore()
{
    if (window.print)
    {
	window.focus();
	window.print();
    }
    else
    {
	alert('your browser does not support this functionality');
    }
}
	
function subDifusseDeseaseSummary(iS,iE)
{
    var txt = "";
    for (var i = iS; i <= iE; i++)
    {
	if (meDiffuseDiseaseArray[i]==1)
	{
	    subtotal=subtotal+1;
	    txt += '<tr><td class="sodata">Segment ';
	    //segment number
	    txt += meDiffuseTableArray[i][1];
	    txt += '</td><td class="soscore">1</td></tr>';
	}
    }

    return txt;
}
	
	
function subDifusseDeseasePrintable(iS,iE,strTemp)
{
    var txt = "";
    for (var i = iS; i <= iE; i++)
    {
	if (meDiffuseDiseaseArray[i]==1)
	{
	    //segment number
	    txt += meDiffuseTableArray[i][1] + '<br>';
	}
    }

    return txt;
}
//-->
