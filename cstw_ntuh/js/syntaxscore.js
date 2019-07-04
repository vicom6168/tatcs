var myDefaultArrayLength=12;
var blnPrintRequested = false;
var blnSaveRequested = false;
var nrofLesion=1;
var URL="http://cvs.vicom.com.tw";

// this variable toggles frame(less) layout
var FRAME_LAYOUT = false;

// array that is set to true if lesion form is completed
var meCompletedLesions = new Array(25);

// temporary array used for question 12 that will contain
// all segments selected in all filled out lesions to
// correctly show the diffuse segment table
var meAllSegmentsMerged = new Array(25);


/** The following variables were previously initialized on
    the loading of form.js. However since we are RELOAD
    a form (using form.js) we need these values to be kept
    in memory.

    The array are the memory, the values afterwards are
    set on form load, so the form retrieves the correct values

    This is needed because form.js does not 'know' what
    lesion it is. (essentially stateless).
**/
var formVarBlnQ12Enabled = new Array(myDefaultArrayLength);
var formVarBlnSegmentVisualizedVisual = new Array(myDefaultArrayLength);
var formVarBlnSkip5 = new Array(myDefaultArrayLength);
var formVarBlnSkip6 = new Array(myDefaultArrayLength);
var formVarBlnSkip6by5 = new Array(myDefaultArrayLength);
var formVarBlnSkip7 = new Array(myDefaultArrayLength);
var formVarIDSegmentTableFirstVisible = new Array(myDefaultArrayLength);
var formVarIDSegmentTableLastVisible = new Array(myDefaultArrayLength);
var formVarIDProxSegmentFirstVisible = new Array(myDefaultArrayLength);
var formVarIDProxSegmentLastVisible = new Array(myDefaultArrayLength);
var formVarBlnSaved = new Array(myDefaultArrayLength);
var formVarBlnSegmentTableContainsElements = new Array(myDefaultArrayLength);
var formVarDiffuseDiseaseScore = new Array(myDefaultArrayLength);


var blnInitCalled=false;
var meDominance;
var ApplicationEnded=false;
var meDiffuseDiseaseArray = new Array(25);

var meCurrentLesion=0;

/** Added array to keep scores per lesion */
var meScore=0;
var meScorePerLesion = new Array(myDefaultArrayLength);

var meNumberOfLesions=1;

var meSideBranchAnswers= [['No'],
			  ['Yes, all sidebranches &lt;1.5mm'],
			  ['Yes, all sidebranches &gt;=1.5mm'],
			  ['Yes, both sidebranches &lt;1.5mm and &gt;=1.5mm are involved']];

//lesion
var meSegmentsInvolved = [
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0],
			  [0,0,0,0,0,0,0,0,0,0,0,0]];//24

// label - segment - visible - scoreFactorRight - scoreFactorLeft
// used in the visualization of question 4v
var meDiffuseTableArray = [
			   ['RCA proximal','1','1','1','1','0'],//0
			   ['RCA mid','2','1','1','1','0'],
			   ['RCA distal','3','1','1','1','0'],
			   ['Posterior descending','4','1','1','1','0'], //3
			   ['Posterolateral from RCA','16','1','0','0.5','0'],//4
			   ['Posterolateral from RCA','16a','1','0','0.5','0'],//5
			   ['Posterolateral from RCA','16b','1','0','0.5','0'],//6
			   ['Posterolateral from RCA','16c','1','0','0.5','0'],//7
			   ['Left main','5','1','1','5','6'],
			   ['LAD proximal','6','1','1','3.5','3.5'],//9
			   ['LAD mid','7','1','1','2.5','2.5'],
			   ['LAD apical','8','1','0','1','1'],//11
			   ['First diagonal','9','1','0','1','1'],//12
			   ['Add. first diagonal','9a','1','0','1','1'],
			   ['Second diagonal','10','1','0','0.5','0.5'],//14
			   ['Add. second diagonal','10a','1','0','0.5','0.5'],
			   ['Proximal circumflex','11','1','1','1.5','2.5'],//16
			   ['Intermediate/anterolateral','12','1','0','1','1'],
			   ['Obtuse marginal','12a','1','0','1','1'],
			   ['Obtuse marginal','12b','1','0','1','1'],
			   ['Distal circumflex','13','1','1','0.5','1.5'], //20
			   ['Left posterolateral','14','1','1','0.5','1'],//21
			   ['Left posterolateral','14a','1','0','0.5','1'],
			   ['Left posterolateral','14b','1','0','0.5','1'],
			   ['Posterior descending','15','1','0','0','1']]; //24

// Main segment , label, start in array 'meDiffuseTableArray' ,
//   end in array 'meDiffuseTableArray' //showme // denylist
// Note: used in the visualization of question 4v
//   'start in array'  and 'end in array' values refer to the above meDiffuseTableArray
//   and the denylist is there to skip some intermediate values
var meSegmentVisualizedTableHelp =[
				   ['1','If, T.O. in segment 1',0,4,'1',''],//0
				   ['2','If, T.O. in segment 2',1,4,'1',''],
				   ['3','If, T.O. in segment 3',2,4,'1',''],
				   ['4','If, T.O. in segment 4',3,4,'1','|4|16|'],//nl 3 aanpassing MVG 2016
				   ['16','If, T.O. in segment 16',4,4,'1',''], //nl 4
				   ['16a','If, T.O. in segment 16a',5,5,'1',''], //nl 5
				   ['16b','If, T.O. in segment 16b',6,6,'1',''], //nl 6
				   ['16c','If, T.O. in segment 16c',7,7,'1',''], //nl 7
				   ['5','If, T.O. in segment 5',8,24,'1','|9|9a|10|10a|12|12a|12b|14a|14b|'],
				   ['6','If, T.O. in segment 6',9,11,'1',''],
				   ['7','If, T.O. in segment 7',10,11,'1',''],
				   ['8','If, T.O. in segment 8',11,11,'1',''],//8
				   ['9','If, T.O. in segment 9',12,12,'1',''],
				   ['9a','If, T.O. in segment 9a',13,13,'1',''],
				   ['10','If, T.O. in segment 10',14,14,'1',''],
				   ['10a','If, T.O. in segment 10a',15,15,'1',''],
				   ['11','If, T.O. in segment 11',16,24,'1','|12|12a|12b|14a|14b|'],
				   ['12','If, T.O. in segment 12',17,17,'1',''],
				   ['12a','If, T.O. in segment 12a',18,18,'1',''],
				   ['12b','If, T.O. in segment 12b',19,19,'1',''],
				   ['13','If, T.O. in segment 13',20,21,'1',''],
				   ['14','If, T.O. in segment 14',21,21,'1',''],
				   ['14a','If, T.O. in segment 14a',22,22,'1',''],
				   ['14b','If, T.O. in segment 14b',23,23,'1',''],
				   ['15','If, T.O. in segment 15',24,24,'1','']];//nr 15

/* First column of segment table with top hierarchy info */
var meDiffuseTableArray1stColumn = [
                           '<div class="darkred"><b>RCA</b></div>',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '<div class="darkred"><b>LM</b></div>',
			   '<div class="darkred"><b>LAD</b></div>',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '<div class="darkred"><b>LCX</b></div>',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;',
			   '&nbsp;'];

var meBifurcationMapping = new Array(7);
meBifurcationMapping['A'] = 'Medina 1,0,0';
meBifurcationMapping['B'] = 'Medina 0,1,0';
meBifurcationMapping['C'] = 'Medina 1,1,0';
meBifurcationMapping['D'] = 'Medina 1,1,1';
meBifurcationMapping['E'] = 'Medina 0,0,1';
meBifurcationMapping['F'] = 'Medina 1,0,1';
meBifurcationMapping['G'] = 'Medina 0,1,1';


var meTotalOcclusion = new Array(myDefaultArrayLength);
var meProximalSegmentNumber = new Array(myDefaultArrayLength);

//new Q4i instead of meProximalSegmentNumber
var meIndicateSegmentNumber = [
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0],
			       [0,0,0,0,0,0,0,0,0,0,0,0]];//23

/**
 Answers to questions are saved in these arrays
 In which array element 1 contains the answer for lesion 1
   array elem 2 for lesion 2 etc.
**/
var meAgeofTO = new Array(myDefaultArrayLength);
var meAgeofTOScore = new Array(myDefaultArrayLength);
var meBluntStump = new Array(myDefaultArrayLength);
var meBluntStumpScore = new Array(myDefaultArrayLength);
var meBridging = new Array(myDefaultArrayLength);
var meBridgingScore = new Array(myDefaultArrayLength);
var meSideBranch = new Array(myDefaultArrayLength);
var meSideBranchScore = new Array(myDefaultArrayLength);
var meSegments = new Array(myDefaultArrayLength);
var meVisualizedByMainSegment = new Array(myDefaultArrayLength);

var meTrifurcation = new Array(myDefaultArrayLength);
var meTrifurcationScore = new Array(myDefaultArrayLength);
var meBifurcation = new Array(myDefaultArrayLength);
var meBifurcationScore = new Array(myDefaultArrayLength);
var meBifurcationAngulation = new Array(myDefaultArrayLength);
var meBifurcationAngulationScore = new Array(myDefaultArrayLength);
var meAortoOstialLesion = new Array(myDefaultArrayLength);
var meAortoOstialLesionScore = new Array(myDefaultArrayLength);
var meSevereTortuosity = new Array(myDefaultArrayLength);
var meSevereTortuosityScore = new Array(myDefaultArrayLength);
var meLength = new Array(myDefaultArrayLength);
var meLengthScore = new Array(myDefaultArrayLength);
var meHeavyCalcification = new Array(myDefaultArrayLength);
var meHeavyCalcificationScore = new Array(myDefaultArrayLength);
var meThrombus = new Array(myDefaultArrayLength);
var meThrombusScore = new Array(myDefaultArrayLength);
var meQ6Skipped = new Array(myDefaultArrayLength);
var meQ7Skipped = new Array(myDefaultArrayLength);
var meComment = new Array(myDefaultArrayLength);
var meTotalOcclusionScore = new Array(myDefaultArrayLength);
var meVisualizedByContrastScore = new Array(myDefaultArrayLength);

var blnPageEnabled=false;
var SkpText='Skipped';
var subtotal=0;
var blnDiffDes=false;

if ((blnInitCalled) && (ApplicationEnded))
{
    blnPageEnabled=true;
}

if (blnPageEnabled || 1==1)
{
    //read params from parent frame
     nrofLesion=meNumberOfLesions;
}
	
var blnCalculationDone = false;


//meNumberOfLesions  =1;
//meCurrentLesion =1;
formVarBlnSaved = new Array(myDefaultArrayLength);
//frameset.js
/******************************************************
 * Syntax Score Calculator Version 2.0                *
 *                                                    *
 * Orginal code (version 1.0): ISM (2005)             *
 * Adaptions    (version 2.0): Luc Strijbosch (2009)  *
 ******************************************************/

/*
 * Version 2.0: Changes to this file.
 *
 * - Reloading a lesion is performed by filling out the
 *   complete form based on the saved values.
 *
 * - Deletion involves a shift back of all lesions that
 *   are present 'after' the lesion marked for deletion
 *
 * - Logic for separate question 12 has been added.
 *
 * - Variables that were global in the form.js context
 *   are moved to this file and saved per lesion to
 *   ensure correct reload of form.js
 *
 * - Some minor score changes
 *
 */
init();


/** This function fethces frame frameId in case of a frame
    layout. In case a div layout is used it returns the
    handle to the requested DIV 'frame'.
 **/
function getFrame( frameId ) {
    if( FRAME_LAYOUT ) {
	return window.frames[frameId];
    }
    else {
	alert("Div layout not yet implemented!");
	return;
    }
}

/** Abbreviated syntax for document.getElementById(forId)
 **/
function getById(frameId, forId) {
    if( FRAME_LAYOUT ) {
	return document.getElementById(forId);
    }
    else {
	alert("Div layout not yet implemented");
	return;
    }
}

/** Abbreviated syntax for document.getElementByName(name)
 **/
function getRadioInForm(frameId, formId, id) {
    if( FRAME_LAYOUT ) {
	return getFrame(frameId).document.forms[formId][id];
    }
    else {
	alert("Div layout not yet implemented");
	return;
    }
}

/* New functionality works with one lesion at a time */
function setNrOfLesionsToOne() {
    meNumberOfLesions = 1;
}

/** Helper function for filling in question 4v, the segment and number
    which are saved in the arrays: meVisualizedByMainSegment and meSegments
    are translated back to the IDs in the form (which are dynamic).

    Note: Function is based upon buildSegmentVisualizTableNew() in form.js
 **/
function translateNumberAndSegmentQuestion4v(){
    segment = meVisualizedByMainSegment[meCurrentLesion];
    number =  meSegments[meCurrentLesion];

    if( number == "none" )
	return "ddsgmsnone" + segment;

    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)  {

	arrayStart=parseInt(meSegmentVisualizedTableHelp[i][2]);
	arrayEnd=parseInt(meSegmentVisualizedTableHelp[i][3]);
	denylist=meSegmentVisualizedTableHelp[i][5];

	if( meSegmentVisualizedTableHelp[i][0] == segment && meSegmentVisualizedTableHelp[i][4] == '1' ) {

	    // loop through diffusetablearray, and ignore items of the deny list
	    for (var j = arrayStart; j <= arrayEnd; j++)
	    {
		showme2=meDiffuseTableArray[j][2];

		if ((showme2=='1') && (denylist!=''))
		{
		    //check if not in deny list
		    tmpteststring='|' + number + '|';
		    if (denylist.indexOf(tmpteststring)!=-1)
		    {
			showme2='0';
		    }
		}

		if (showme2=='1')
		{
		    // j+1 is returned because 'none' takes place 0...
		    if( meDiffuseTableArray[j][1] == number ) {
			return "ddsgms" + i + "d" + j;
		    }
		}
	    }
	}
    }
}

/** Some segments cannot be proximal
 */
function checkIfProximalSegmentGetsQuestion4v(){
   var mostProx=getMostProximalSegmentNumber();
   var showme='0';

   for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++) {

       if (meSegmentVisualizedTableHelp[i][0]==mostProx)  {

          showme = meSegmentVisualizedTableHelp[i][4];
       }
   }

   if (showme == '1') {
       return true;
   }

   return false;
}

/** Function sets the lesion number and loads the correct
 *  left side according to the selected dominance
 *
 *  Invoked in the menu
 */
function loadExistingLesion(lesionNumber) {
    meCurrentLesion = lesionNumber;
    //setFrameUrl('right','lesion_segments.htm');

    if( meDominance == 'left' ) {
	//setFrameUrl('left','selectedleft.htm');
    }
    else {
	//setFrameUrl('left','selectedright.htm');
    }
}

/* Fill out question 3
   If no values have been set for lesionNumber nothing will
   be done (length of array = 0)
 */
function loadExistingSegmentValues() {

  // header update
  UpdateCurrentLesion();

  if ( meCompletedLesions[meCurrentLesion] ) {
    for (var i = 0; i < meIndicateSegmentNumber.length; i++) {
      if( meSegmentsInvolved[i][meCurrentLesion] == 1 ) {
	getById('right', 'dd' + i + 'd' + meCurrentLesion).checked = true;
	getFrame('right').lightUpRow('row_' + i + meCurrentLesion);
      }
    }
  }
  else {
    resetExistingFormGlobalVars();
    resetAnswersForLesion(meCurrentLesion);
  }
}

/** Function reads answers to question 4 and sub questions
    and fills out the form accordingly.
 */
function loadExistingQuestion4() {

    // no value present, do nothing
    if( meTotalOcclusion[meCurrentLesion] == '-1' ) {
        return;
    }

     // Question 4, id: formq4, only if total occlustion was set to true, not -1 or false
    if( meTotalOcclusion[meCurrentLesion] && meTotalOcclusion[meCurrentLesion] > 0 ) {
        // Total occlustion is present
        getRadioInForm('right', 'formq4', 'totaloc')[meTotalOcclusion[meCurrentLesion]].checked = true;

        // sub question 4i, id: formq4i
       // getById('right', 'q4i').style.display='block';
       $("#q4i").show();
        for (var i = 0; i < meIndicateSegmentNumber.length; i++) {
            if( meIndicateSegmentNumber[i][meCurrentLesion] ) {
                getById('right', 'dd' + i).checked = true;

		// since question 4i changed to radiobuttons we can have a max of 1 selected
		break;
            }
        }

        // sub question 4ii, id: formq4ii
        getById('right', 'q4ii').style.display='block';
        getRadioInForm('right', 'formq4ii', '3months')[meAgeofTO[meCurrentLesion]].checked = true;

        // sub question 4iii, blunt stump
        getById('right', 'q4iii').style.display='block';
        getRadioInForm('right', 'formq4iii', 'bluntstump')[meBluntStump[meCurrentLesion]].checked = true;
        //setFrameUrl('left','diagramblunt.htm');

        // sub question 4iv, bridging
        getById('right', 'q4iv').style.display='block';
        getRadioInForm('right', 'formq4iv', 'bridging')[meBridging[meCurrentLesion]].checked = true;
        //setFrameUrl('left','diagrambridging.htm');

        // sub question 4v
        // first show table and label, of highest segment (most proximal)
        if( checkIfProximalSegmentGetsQuestion4v() ) {
            // some set to visible for question 4vii
            getById('right', 'q4vitable' + meProximalSegmentNumber[meCurrentLesion]).style.display = 'block';
            getById('right', 'q4vitable').style.display='block';

            getById('right', 'q4v').style.display = 'block';
	    getById('right', translateNumberAndSegmentQuestion4v()).checked = true;
            //setFrameUrl('left','diagramviz.htm');
        }

        // sub question 4vi
        getById('right', 'q4vi').style.display='block';
        getRadioInForm('right', 'formq4vi', 'sidebranch')[meSideBranch[meCurrentLesion]].checked = true;
    }
    else if( meTotalOcclusion[meCurrentLesion] == 0 ) {
        getRadioInForm('right', 'formq4', 'totaloc')[meTotalOcclusion[meCurrentLesion]].checked = true;
    }
}


function loadExistingQuestion5() {
    /** ONLY
        if question 4 VI has been answered:
          - Yes, all sidebranches >=1.5mm
	  - Yes, both sidebranches <1.5mm and >=1.5mm are involved
	OR
          - Question 4 was answered NO (T.O.)

	Than show question 5.
     **/
    if( meSideBranch[meCurrentLesion] > 2 || meTotalOcclusion[meCurrentLesion] == 0 ) {

        getById('right', 'q5').style.display = 'block';

	if( meTrifurcation[meCurrentLesion] != -1 ) {

	    if( meTrifurcation[meCurrentLesion] > 0 ) { // answer = yes
		getRadioInForm('right', 'formq5', 'Trifurcation')[1].checked = true;

		// we need to subtract 1 from the the trifurcation value to activate the
                // correct radiobutton in the form (trifurcation 1 is on place 0 etc.)
		getById('right', 'q5yes').style.display = 'block';
		getRadioInForm('right', 'formq5yes', 'q5yes')[meTrifurcation[meCurrentLesion] - 1].checked = true;
	    }
	    else {
		getRadioInForm('right', 'formq5', 'Trifurcation')[0].checked = true;
	    }
	}
    }
}

function loadExistingQuestion6() {
    // only if answer to question 5 is null
    if( meTrifurcation[meCurrentLesion] == 0 ) {
	getById('right', 'q6').style.display = 'block';
	if( meBifurcation[meCurrentLesion] != '' ) {
	    getById('right', 'q6yes1').style.display = 'block';
            getRadioInForm('right', 'formq6', 'Bifurcation')[1].checked = true;

	    // first sub question (formqyes1)
	    switch(meBifurcation[meCurrentLesion])
	    {
	        case 'A': getRadioInForm('right', 'formq6yes1', 'ABC')[0].checked = true;  break;
	        case 'B': getRadioInForm('right', 'formq6yes1', 'ABC')[1].checked = true;  break;
	        case 'C': getRadioInForm('right', 'formq6yes1', 'ABC')[2].checked = true;  break;
	        case 'D': getRadioInForm('right', 'formq6yes1', 'ABC')[3].checked = true;  break;
	        case 'E': getRadioInForm('right', 'formq6yes1', 'ABC')[4].checked = true;  break;
	        case 'F': getRadioInForm('right', 'formq6yes1', 'ABC')[5].checked = true;  break;
	        case 'G': getRadioInForm('right', 'formq6yes1', 'ABC')[6].checked = true;  break;
	        default: break; // no default action
	    }

	    getById('right', 'q6yes2').style.display = 'block';
	    // second sub question (formqyes2)
	    if( meBifurcationAngulation[meCurrentLesion] != -1 )
		getRadioInForm('right', 'formq6yes2', 'angle')[meBifurcationAngulation[meCurrentLesion]].checked = true;

        }
	else {
	    getRadioInForm('right', 'formq6', 'Bifurcation')[0].checked = true;
	}
    }
}

/** Question 7 is only applicable in case certain segments
    are involved.
    If Question7 was NOT applicable it has been set to 0.
**/
function loadExistingQuestion7(){
    if( Question7Enabled() ){
	getById('right', 'q7').style.display = 'block';
	getRadioInForm('right', 'formq7', 'question7')[meAortoOstialLesion[meCurrentLesion]].checked = true;
    }
}

function loadExistingQuestion8(){
    if( meSevereTortuosity[meCurrentLesion] != -1 ) {
	getById('right', 'q8').style.display = 'block';
	getRadioInForm('right', 'formq8', 'question8')[meSevereTortuosity[meCurrentLesion]].checked = true;
    }
}

/**
 * Question 9 is only shown in case question 4 was answered negatively
 */
function loadExistingQuestion9(){
    if( !(meTotalOcclusion[meCurrentLesion] && meTotalOcclusion[meCurrentLesion] > 0) ) {
        if( meLength[meCurrentLesion] != -1 ) {
            getById('right', 'q9').style.display = 'block';
	    getRadioInForm('right', 'formq9', 'question9')[meLength[meCurrentLesion]].checked = true;
	}
    }
}

function loadExistingQuestion10(){
    if( meHeavyCalcification[meCurrentLesion] != -1 ) {
	getById('right', 'q10').style.display = 'block';
	getRadioInForm('right', 'formq10', 'question10')[meHeavyCalcification[meCurrentLesion]].checked = true;
    }
}

function loadExistingQuestion11(){
    if( meThrombus[meCurrentLesion] != -1 ) {
	getById('right', 'q11').style.display = 'block';
	getRadioInForm('right', 'formq11', 'question11')[meThrombus[meCurrentLesion]].checked = true;
    }
}

function loadExistingComment(){
    if( meThrombus[meCurrentLesion] != -1 ) {
        getById('right', 'comment').style.display = 'block';
        getById('right', 'thecomment').value = meComment[meCurrentLesion];
    }
}

function showSaveButton() {
    getById('right', 'savebutton').style.display = 'block';
}

function resetExistingFormGlobalVars(){
    formVarBlnQ12Enabled[meCurrentLesion] = false;
    formVarBlnSegmentVisualizedVisual[meCurrentLesion] = false;
    formVarBlnSkip5[meCurrentLesion] = false;
    formVarBlnSkip6[meCurrentLesion] = false;
    formVarBlnSkip6by5[meCurrentLesion] = false;
    formVarBlnSkip7[meCurrentLesion] = false;
    formVarIDSegmentTableFirstVisible[meCurrentLesion] = '';
    formVarIDSegmentTableLastVisible[meCurrentLesion] = '';
    formVarIDProxSegmentFirstVisible[meCurrentLesion] = '';
    formVarIDProxSegmentLastVisible[meCurrentLesion] = '';
    formVarBlnSaved[meCurrentLesion] = false;
    formVarBlnSegmentTableContainsElements[meCurrentLesion] = false;
    formVarDiffuseDiseaseScore[meCurrentLesion] = 0;
}

/** Function loads all questions in case a completed lesion
 *  has been selected for edit.
 */
function loadExistingFormValues() {

    // lesion has been found, load data and fill out form
    if( meCompletedLesions[meCurrentLesion] ) {
	loadExistingQuestion4();
	loadExistingQuestion5();
	loadExistingQuestion6();
	loadExistingQuestion7();
	loadExistingQuestion8();
	loadExistingQuestion9();
	loadExistingQuestion10();
        loadExistingQuestion11();
        loadExistingComment();
        showSaveButton();
    }
}

/** Function returns the lesion number of the last lesion
    (order of filling-out) that was completed.
 **/
function lookupLastCompletedLesion() {

    if( meCompletedLesions[0] == 0 )
	return 0;

    for( var i = 1; i < myDefaultArrayLength; i++ ) {
	if( meCompletedLesions[i] == 0 ) {
	    return i-1;
	}
    }

    return myDefaultArrayLength;
}

/** This function is based on the reset() function, and performs
    the same actions just for 1 lesion.
 **/
function resetAnswersForLesion(selectedLesion) {
    // diffuse disease is used by question 12 does not
    // need a reset.
    // resetDiffuseDiseaseArray();

    for( var i = 0; i < 25; i++ ){
	meSegmentsInvolved[i][selectedLesion] = 0;
     }

    for( var i = 0; i < 25; i++ ){
	meIndicateSegmentNumber[i][selectedLesion] = 0;
     }

    meCompletedLesions[selectedLesion] = 0;
    meScorePerLesion[selectedLesion] = 0;

    meTotalOcclusion[selectedLesion]=-1;
    meProximalSegmentNumber[selectedLesion]=-1;
    meAgeofTO[selectedLesion]=-1;
    meAgeofTOScore[selectedLesion]=0;
    meBluntStump[selectedLesion]=-1;
    meBluntStumpScore[selectedLesion]=0;
    meBridging[selectedLesion]=-1;
    meBridgingScore[selectedLesion]=0;
    meSideBranch[selectedLesion]=-1;
    meSideBranchScore[selectedLesion]=0;

    // question 5
    meSegments[selectedLesion]='Skipped';
    meVisualizedByMainSegment[selectedLesion]=-1;

    // question 6
    meTrifurcation[selectedLesion]=-1;
    meTrifurcationScore[selectedLesion]=0;
    meBifurcation[selectedLesion]='';
    meBifurcationScore[selectedLesion]=0;
    meBifurcationAngulation[selectedLesion]=-1;
    meBifurcationAngulationScore[selectedLesion]=0;

    // question 7
    meAortoOstialLesion[selectedLesion]==-1;
    meAortoOstialLesionScore[selectedLesion]=0;

    // question 8
    meSevereTortuosity[selectedLesion]=-1;
    meSevereTortuosityScore[selectedLesion]=0;

    // question 9
    meLength[selectedLesion]=-1;
    meLengthScore[selectedLesion]=0;

    // question 10
    meHeavyCalcification[selectedLesion]=-1;
    meHeavyCalcificationScore[selectedLesion]=0;

    // question 11
    meThrombus[selectedLesion]=-1;
    meThrombusScore[selectedLesion]=0;

    // comment
    meComment[selectedLesion]='';
    meTotalOcclusionScore[selectedLesion]=0;

    meVisualizedByContrastScore[selectedLesion]=0;
    meQ6Skipped[selectedLesion]=false;
    meQ7Skipped[selectedLesion]=false;

    // global form values (have been moved from form.js to here)
    formVarBlnQ12Enabled[selectedLesion] = false;
    formVarBlnSegmentVisualizedVisual[selectedLesion] = false;
    formVarBlnSkip5[selectedLesion] = false;
    formVarBlnSkip6[selectedLesion] = false;
    formVarBlnSkip6by5[selectedLesion] = false;
    formVarBlnSkip7[selectedLesion] = false;
    formVarIDSegmentTableFirstVisible[selectedLesion] = '';
    formVarIDSegmentTableLastVisible[selectedLesion] = '';
    formVarIDProxSegmentFirstVisible[selectedLesion] = '';
    formVarIDProxSegmentLastVisible[selectedLesion] = '';
    formVarBlnSaved[selectedLesion] = false;
    formVarBlnSegmentTableContainsElements[selectedLesion] = false;
    formVarDiffuseDiseaseScore[selectedLesion] = 0;
}


/** This function overwrites the values of the previous
    lesion (selectedLesion-1) with the answers of 'selectedLesion'.
 **/
function shiftAnswersBackForLesion(selectedLesion) {

    // first clear the lesion that will be overwritten
    resetAnswersForLesion(selectedLesion-1);

    // shift completed value back
    meCompletedLesions[selectedLesion-1] = meCompletedLesions[selectedLesion];
    meScorePerLesion[selectedLesion-1] = meScorePerLesion[selectedLesion];

    // copy segment selection
    for( var i = 0; i < 25; i++ ){
	meSegmentsInvolved[i][selectedLesion-1] = meSegmentsInvolved[i][selectedLesion];
     }

    for( var i = 0; i < 24; i++ ){
	meIndicateSegmentNumber[i][selectedLesion-1] = meIndicateSegmentNumber[i][selectedLesion];
     }

    // question 4
    meTotalOcclusion[selectedLesion-1] = meTotalOcclusion[selectedLesion];
    meProximalSegmentNumber[selectedLesion-1] = meProximalSegmentNumber[selectedLesion];
    meAgeofTO[selectedLesion-1] = meAgeofTO[selectedLesion];
    meAgeofTOScore[selectedLesion-1] = meAgeofTOScore[selectedLesion];
    meBluntStump[selectedLesion-1] = meBluntStump[selectedLesion];
    meBluntStumpScore[selectedLesion-1] = meBluntStumpScore[selectedLesion];
    meBridging[selectedLesion-1] = meBridging[selectedLesion];
    meBridgingScore[selectedLesion-1] = meBridgingScore[selectedLesion];
    meSideBranch[selectedLesion-1] = meSideBranch[selectedLesion];
    meSideBranchScore[selectedLesion-1] = meSideBranchScore[selectedLesion];

    // question 5
    meSegments[selectedLesion-1] = meSegments[selectedLesion];
    meVisualizedByMainSegment[selectedLesion-1] = meVisualizedByMainSegment[selectedLesion];

    // question 6
    meTrifurcation[selectedLesion-1] = meTrifurcation[selectedLesion];
    meTrifurcationScore[selectedLesion-1] = meTrifurcationScore[selectedLesion];
    meBifurcation[selectedLesion-1] = meBifurcation[selectedLesion];
    meBifurcationScore[selectedLesion-1] = meBifurcationScore[selectedLesion];
    meBifurcationAngulation[selectedLesion-1] = meBifurcationAngulation[selectedLesion];
    meBifurcationAngulationScore[selectedLesion-1]= meBifurcationAngulationScore[selectedLesion];

    // question 7
    meAortoOstialLesion[selectedLesion-1] = meAortoOstialLesion[selectedLesion];
    meAortoOstialLesionScore[selectedLesion-1] = meAortoOstialLesionScore[selectedLesion];

    // question 8
    meSevereTortuosity[selectedLesion-1] = meSevereTortuosity[selectedLesion];
    meSevereTortuosityScore[selectedLesion-1] = meSevereTortuosityScore[selectedLesion];

    // question 9
    meLength[selectedLesion-1] = meLength[selectedLesion];
    meLengthScore[selectedLesion-1] = meLengthScore[selectedLesion];

    // question 10
    meHeavyCalcification[selectedLesion-1] = meHeavyCalcification[selectedLesion];
    meHeavyCalcificationScore[selectedLesion-1] = meHeavyCalcificationScore[selectedLesion];

    // question 11
    meThrombus[selectedLesion-1] = meThrombus[selectedLesion];
    meThrombusScore[selectedLesion-1] = meThrombusScore[selectedLesion];

    // comment
    meComment[selectedLesion-1] = meComment[selectedLesion];
    meTotalOcclusionScore[selectedLesion-1] = meTotalOcclusionScore[selectedLesion];

    meVisualizedByContrastScore[selectedLesion-1] = meVisualizedByContrastScore[selectedLesion];
    meQ6Skipped[selectedLesion-1] = meQ6Skipped[selectedLesion];
    meQ7Skipped[selectedLesion-1] = meQ7Skipped[selectedLesion];

    // global form values (have been moved from form.js to here)
    formVarBlnQ12Enabled[selectedLesion - 1] = formVarBlnQ12Enabled[selectedLesion];
    formVarBlnSegmentVisualizedVisual[selectedLesion - 1] = formVarBlnSegmentVisualizedVisual[selectedLesion];
    formVarBlnSkip5[selectedLesion - 1] = formVarBlnSkip5[selectedLesion];
    formVarBlnSkip6[selectedLesion - 1] = formVarBlnSkip6[selectedLesion];
    formVarBlnSkip6by5[selectedLesion - 1] = formVarBlnSkip6by5[selectedLesion];
    formVarBlnSkip7[selectedLesion - 1] = formVarBlnSkip7[selectedLesion];
    formVarIDSegmentTableFirstVisible[selectedLesion - 1] = formVarIDSegmentTableFirstVisible[selectedLesion];
    formVarIDSegmentTableLastVisible[selectedLesion - 1] = formVarIDSegmentTableLastVisible[selectedLesion];
    formVarIDProxSegmentFirstVisible[selectedLesion - 1] = formVarIDProxSegmentFirstVisible[selectedLesion];
    formVarIDProxSegmentLastVisible[selectedLesion - 1] = formVarIDProxSegmentLastVisible[selectedLesion];
    formVarBlnSaved[selectedLesion - 1] = formVarBlnSaved[selectedLesion];
    formVarBlnSegmentTableContainsElements[selectedLesion - 1] = formVarBlnSegmentTableContainsElements[selectedLesion];
    formVarDiffuseDiseaseScore[selectedLesion - 1] = formVarDiffuseDiseaseScore[selectedLesion];

}

/**
   Function removes the selected lesion.

   The consequence is that all answers of the following lesions
   (in the sense of order of filling-out) are shifted one place
   back in the answer-arrays.
 **/
function removeLesion(toBeRemovedLesion) {

    lastCompletedLesion = lookupLastCompletedLesion();
    
    // Decrease lesion counts and scores

    // set meCurrentLesion temporary to the toBeRemoved lesion
    // to ensure that UpdateScore updates meScorePerLesion correctly
    meCurrentLesion = toBeRemovedLesion;
    meNumberOfLesions = meNumberOfLesions - 1;
    requireUpdateScore(0, meScorePerLesion[toBeRemovedLesion]);
    meScorePerLesion[toBeRemovedLesion] = 0;

    // reset all values of the deleted lesion
    resetAnswersForLesion(toBeRemovedLesion);

    // we only have to shift back if not last completed lesion
    if( toBeRemovedLesion != lastCompletedLesion ) {
	for( var i = toBeRemovedLesion+1; i <= lastCompletedLesion; i++ ) {
	    shiftAnswersBackForLesion(i);

	    // reset the values of the just shifted-back lesion
	    resetAnswersForLesion(i);
	}
    }

    //setFrameUrl('left','overview.htm');
    //setFrameUrl('right','menu.htm');
    meCurrentLesion = lookupLastCompletedLesion();
    UpdateCurrentLesion();
}

//Vessels shown in lesion (-1 means not shown yet! else it is the lesion number)
var vessel1=-1; //0-7
var vessel2=-1; //8
var vessel3=-1; //9-15
var vessel4=-1; //16-24

function resetVesselScores() {

    if (vessel1==meCurrentLesion)
    {
	subResetCheckVessel(0,7);
    }

    if (vessel2==meCurrentLesion)
    {
	subResetCheckVessel(8,8);
    }

    if (vessel3==meCurrentLesion)
    {
	subResetCheckVessel(9,15);
    }

    if (vessel4==meCurrentLesion)
    {
	subResetCheckVessel(16,24);
    }
}

/** Resets all vessels because we are not in 1
    lesion but do it after all lesions have been
    filled out.
 **/
function resetVesselScoresForAll() {
	subResetCheckVessel(0,7);
	subResetCheckVessel(8,8);
	subResetCheckVessel(9,15);
	subResetCheckVessel(16,24);
}

function showVessel(vesselnumber)
{

    if (vesselnumber==1)
    {
	//already shown
	if ((vessel1!=-1) && (vessel1!=meCurrentLesion))
	{
	    return false;
	}
	//check if selected in Q3
	if (subCheckVessel(0,7))
	{
	    vessel1=meCurrentLesion;

	    return true;
	}

    }

    if (vesselnumber==2)
    {
	//already shown
	if ((vessel2!=-1) && (vessel2!=meCurrentLesion))

	    return false
		if (subCheckVessel(8,8))
		{
		    vessel2=meCurrentLesion;

		    return true;
		}

    }

    if (vesselnumber==3)
    {
	//already shown
	if ((vessel3!=-1) && (vessel3!=meCurrentLesion))
	    return false
		if ((subCheckVessel(9,15))  || (subCheckVessel(8,8)))
		{
		    vessel3=meCurrentLesion;

		    return true;
		}
    }

    if (vesselnumber==4)
    {
	//already shown
	if ((vessel4!=-1) && (vessel4!=meCurrentLesion))
	    return false
		if ((subCheckVessel(16,24))  || (subCheckVessel(8,8)))
		{
		    vessel4=meCurrentLesion;

		    return true;
		}
    }


    return false;
}

/** New function that is based on showVessel, but in stead of
    working on the currentLesion it first creates an artificial lesion
    involving all segments of all other lesions to calculate the
    same functionality
**/
function showVesselForAll(vesselnumber)
{
    if (vesselnumber==1)
    {
	//check if selected in Q3
	if (subCheckVesselForAll(0,7))
	{
	    vessel1=meCurrentLesion;

	    return true;
	}
    }

    if (vesselnumber==2)
    {
	if (subCheckVesselForAll(8,8))
	{
	    vessel2=meCurrentLesion;

	    return true;
	}

    }

    if (vesselnumber==3)
    {
	if ((subCheckVesselForAll(9,15))  || (subCheckVesselForAll(8,8)))
	{
	    vessel3=meCurrentLesion;

	    return true;
	}
    }

    if (vesselnumber==4)
    {

	if ((subCheckVesselForAll(16,24))  || (subCheckVesselForAll(8,8)))
	{
	    vessel4=meCurrentLesion;

	    return true;
	}
    }


    return false;
}

function resetMeAllSegmentsMerged() {

    for (var i = 0; i < 25; i++)
    {
	meAllSegmentsMerged[i] = 0;
    }
}

function updateMeAllSegmentsMerged() {
    // loop over
    
    for (var i = 0; i < 25; i++)
    {
	for (var j = 0; j < myDefaultArrayLength; j++)
	{
	//	alert(meSegmentsInvolved[i][j] );
	    if( meSegmentsInvolved[i][j] == 1 )
		meAllSegmentsMerged[i] = 1;
	}
    }
}

function subCheckVesselForAll(iStart,IEnd) {

    for (var  i = iStart; i <= IEnd; i++)
    {
	if (meAllSegmentsMerged[i] == 1 )
	    return true;
    }

    return false;
}


function subCheckVessel(iStart,IEnd)
{	// return true if one is set
    for (var i = iStart; i <= IEnd; i++)
    {
	if (meSegmentsInvolved[i][meCurrentLesion]==1)
	    return true
	}

    return false
}

function CheckDiffuseDisease(iStart,IEnd)
{	// return true if one is set
    for (var i = iStart; i <= IEnd; i++)
    {
	if (meDiffuseDiseaseArray[i]==1)
	    return true
    }

    return false
}


function subResetCheckVessel(iStart,IEnd)
{
    var oldValue;
    for (var i = iStart; i <= IEnd; i++)
    {
	oldValue=meDiffuseDiseaseArray[i];
	UpdateScore(-(oldValue));
	meDiffuseDiseaseArray[i]=0;
    }
    showScore();
}


/**
   Reset score Per Lesion
 */
function resetMeScorePerLesion()
{
    meScorePerLesion = [0,0,0,0,0,0,0,0,0,0,0,0];
}

function FillSegmentVisualizedArray()
{
    // segment,label,segmentnubmer,visible



    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
	meSegmentVisualizedTableHelp[i][4]='1';
    }

    var number='';
    var showme='0';
    var arrayStart=0;
    var arrayEnd=0;
    var showme2='0';
    var denylist='';
    var tmpteststring='';

    //header



    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
	showme=meSegmentVisualizedTableHelp[i][4];
	arrayStart=parseInt(meSegmentVisualizedTableHelp[i][2]);
	arrayEnd=parseInt(meSegmentVisualizedTableHelp[i][3]);
	denylist=meSegmentVisualizedTableHelp[i][5];

	if (showme=='1')
	{
	    nrOfItems=0;

	    for (var j = arrayStart;j <= arrayEnd; j++)
	    {
		number=meDiffuseTableArray[j][1];
		showme2=meDiffuseTableArray[j][2];

		if ((showme2=='1') && (denylist!=''))
		{
		    //check if not in deny list
		    tmpteststring='|' + number + '|'
		    if (denylist.indexOf(tmpteststring)!=-1)
		    {
			showme2='0';
		    }
		}

		if (showme2=='1')
		{

		    nrOfItems=nrOfItems+1;
		}
	    }

	    if (nrOfItems<=1)
	    {
		meSegmentVisualizedTableHelp[i][4]='0';

	    }
	}
    }
}

function setHeaderText(id,text)
{
    if(document.getElementById(id) != null)
    {
	document.getElementById(id).innerHTML=text;
    }
}

/** SetNumberOfLesions, this function sets the complete
    meSegmentsInvolved and meIndicateSegmentNumber arrays (to 0)
 */
function SetNumberOfLesions(NumberOfLesions)
{
    meNumberOfLesions=NumberOfLesions;
    for (var i = 0; i < meDiffuseDiseaseArray.length; i++)
    {
	for (var j = 0; j < meNumberOfLesions; j++)
	{
	    meSegmentsInvolved[i][j]=0;
	    meIndicateSegmentNumber[i][j]=0;
	}
    }
    //setFrameUrl('right','lesion_segments.htm');
}

function resetIndicateSegmentNumber()
{
    for (var j = 0; j < meIndicateSegmentNumber.length; j++)
    {
	meIndicateSegmentNumber[j][meCurrentLesion]=0;
    }

}

function fillDiffuseTableArray()
{
    //set all visible
    for (var i = 0; i < meDiffuseTableArray.length; i++)
    {
	meDiffuseTableArray[i][2]='1';
    }

    if (meDominance=='left')
    {
	meDiffuseTableArray[3][2]='0';
	meDiffuseTableArray[4][2]='0';
	meDiffuseTableArray[5][2]='0';
	meDiffuseTableArray[6][2]='0';
	meDiffuseTableArray[7][2]='0';
	//meDiffuseTableArray[13][2]='0';
	//meDiffuseTableArray[2][3]='0';
	//meDiffuseTableArray[3][3]='0';
    }

    if (meDominance=='right')
    {
	meDiffuseTableArray[24][2]='0';

	//meDiffuseTableArray[21][2]='0';
    }

}

function actionDiffuseDeseaseNo(blnYes)
{
    if (blnYes)
    {
	showScore();
    }
    else
    {
	resetDiffuseDiseaseArray();
	meScore=0;
	showScore();
	//setFrameUrl('right','nroflesions.htm')
    }
}

/** navigates to next page **/
function SegmentsInvolvedSave()
{
    //setFrameUrl('left','overview.htm');
    //setFrameUrl('right','disback.htm');

    // only header is updated here
    olCheckMouseCapture = false;
       over=false;
    callHideShow('divSyntaxScoreSecond');
    UpdateCurrentLesion();
}


function showScore()
{
    setHeaderText('scorelabel','Score: ');
    setHeaderText("score",GetScore());
}


function reset()
{
    //set default values
    //meDominance='';
    meNumberOfLesions=0;
    meScore=0;
    resetMeScorePerLesion();
    resetMeCompletedLesions();
    resetMeAllSegmentsMerged();
    SegmentsInvolved=0;
    resetDiffuseDiseaseArray();

    meCurrentLesion=0;
    for (var i = 0; i < myDefaultArrayLength; i++)
    {
	meTotalOcclusion[i]=-1;
	meProximalSegmentNumber[i]=-1;
	meAgeofTO[i]=-1;
	meAgeofTOScore[i]=0;
	meBluntStump[i]=-1;
	meBluntStumpScore[i]=0;
	meBridging[i]=-1;
	meBridgingScore[i]=0;
	meSideBranch[i]=-1;
	meSideBranchScore[i]=0;
	meSegments[i]='Skipped';
	meVisualizedByMainSegment[i]=-1;
	meTrifurcation[i]=-1;
	meTrifurcationScore[i]=0;
	meBifurcation[i]='';
	meBifurcationScore[i]=0;
	meBifurcationAngulation[i]=-1;
	meBifurcationAngulationScore[i]=0;
	meAortoOstialLesion[i]==-1;
	meAortoOstialLesionScore[i]=0;
	meSevereTortuosity[i]=-1;
	meSevereTortuosityScore[i]=0;
	meLength[i]=-1;
	meLengthScore[i]=0;
	meHeavyCalcification[i]=-1;
	meHeavyCalcificationScore[i]=0;
	meThrombus[i]=-1;
	meThrombusScore[i]=0;
	meComment[i]='';
	meTotalOcclusionScore[i]=0;
	meVisualizedByContrastScore[i]=0;
	meQ6Skipped[i]=false;
	meQ7Skipped[i]=false;
    }
}

function setQ6Skipped(Value)
{
    meQ6Skipped[meCurrentLesion]=Value;
}

function setQ7Skipped(Value)
{

    meQ7Skipped[meCurrentLesion]=Value;
}

function resetDiffuseDiseaseArray()
{
	
    for (var i = 0; i < meDiffuseDiseaseArray.length; i++)
    {
	meDiffuseDiseaseArray[i]=0;
    }
}


function setFrameUrl(framename,NewLocation)
{
    //set new URL for frame
    window.location.href=NewLocation;
}


/** Function adapted to directly go to the lesion_segments.htm
    page, because the number of lesions will not be fixed
    anymore. Therefore nrOfLesions is set to 1 as well
 **/
function setDominance(Dominance)
{
    //reset all new dominance is set incase of back!!
    reset();
    var vicom_Dominance;
    meDominance=Dominance;
    fillDiffuseTableArray();
    FillSegmentVisualizedArray();

    if (meDominance=='left')
    {
	//setFrameUrl('left','selectedleft.htm');
	vicom_Dominance="L";
	setHeaderText('dominance','Dominance: left');
    }
    if (meDominance=='right')
    {
    	vicom_Dominance="R";
	//setFrameUrl('left','selectedright.htm');
	setHeaderText('dominance','Dominance: right');
    }
    //write to database Vicom
   
          	  $.ajax({
          	        type:"POST",
          			url: "/api/wrieDominance",
          			cache: false,
          			data:
          				{
          		        patientID : $("#PATIENTNUMBER").val(),
          				Dominance:vicom_Dominance
          				},
          			datatype: "JSON",
          			success: function(data){
          					if(JSON.parse(data).status=="success"){
          					
          					
          			}
          				}
          				
          		});
          
    // //setFrameUrl('right','nroflesions.htm');
    setNrOfLesionsToOne();
    //setFrameUrl('right','lesion_segments.htm');
}

function setDiffuseDisease(arraynumber,me)
{
    var oldValue=0;
    var newValue=0;
    if (me.checked)
    {
	newValue=1;
    }

    oldValue = meDiffuseDiseaseArray[arraynumber];

    if (oldValue!=newValue)
    {
	UpdateScore(-(oldValue));
	UpdateScore(newValue);
	showScore();
    }

    meDiffuseDiseaseArray[arraynumber]=newValue;
    
        for (var i = 0; i < meDiffuseDiseaseArray.length; i++)
    {
    	if(meDiffuseDiseaseArray[i]==1)
    	DiffuseDiseaseScore++;
	
    }
}

function Question7Enabled()
{
    // 1
    if (meSegmentsInvolved[0][meCurrentLesion]==1)
    {

	return true
	    }
    // 5
    if (meSegmentsInvolved[8][meCurrentLesion]==1)
    {

	return true
	    }
    // 6
    if (meSegmentsInvolved[9][meCurrentLesion]==1)
    {

	return true
	    }
    // 11
    if (meSegmentsInvolved[16][meCurrentLesion]==1)
    {
	return true
    }

    return false;
}

/** toggle function of segment **/
function SetSegmentsInvolved(Segment,Lesion,me)
{
    if (me.checked)
    {
	if (meSegmentsInvolved[Segment][Lesion]==0)
	{
	    meSegmentsInvolved[Segment][Lesion]=1;
	    $("#vv"+Segment+"d"+Lesion).text('V');
	}
    }
    else
    {
	if (meSegmentsInvolved[Segment][Lesion]==1)
	{
	    meSegmentsInvolved[Segment][Lesion]=0;
	     $("#vv"+Segment+"d"+Lesion).text('');
	}
    }
}

function resetTotalOcclusionScore()
{
    resetIndicateSegmentNumber();
    UpdateScore(-(meTotalOcclusionScore[meCurrentLesion]));
    meTotalOcclusionScore[meCurrentLesion]=0;
    showScore();
}

function CheckIndicateSegmentNumber()
{

    for (var i = 0; i < meIndicateSegmentNumber.length; i++)
    {
	if (meIndicateSegmentNumber[i][meCurrentLesion]==1)
	    return true;
    }

    return false;
}


function CalculateTotalOcclusion()
{
    var CalculationFactor=2;
    var arrayDepth=4; //right

    var newScore=0;
    var oldScore=meTotalOcclusionScore[meCurrentLesion];



    if (meTotalOcclusion[meCurrentLesion]==1)
    {
        CalculationFactor=5;
    }

    if (meDominance=='left')
    {
	arrayDepth=5;
    }
    //now calculate


    for (var i = 0; i < meDiffuseTableArray.length; i++)
    {
	if (meSegmentsInvolved[i][meCurrentLesion]==1)
	{
	    CalculationFactor=2;

	    if ((meIndicateSegmentNumber[i][meCurrentLesion]==1))
	    {
		CalculationFactor=5;
	    }

	    newScore = newScore + ((meDiffuseTableArray[i][arrayDepth])*CalculationFactor);
	}
    }

    meTotalOcclusionScore[meCurrentLesion]=newScore;
    requireUpdateScore(newScore,oldScore);
}

function SetTotalOcclusion(Value)
{
    // set value for currentLession
    meTotalOcclusion[meCurrentLesion]=Value;

    CalculateTotalOcclusion();
    // calculation to be made
}

function SetProximalSegmentNumber(Value)
{
    meProximalSegmentNumber[meCurrentLesion]=Value;
}

/** Used by question 4V, it returns the first segment
    ordered by segment number.
    note: as a side effect the meProximalSegmentNumber variable
          is set.
 */
function getMostProximalSegmentNumber()
{
    //new this one is not set anymore
    for (var i = 0; i < meIndicateSegmentNumber.length; i++)
    {
	if (meIndicateSegmentNumber[i][meCurrentLesion]==1)
	{
	    SetProximalSegmentNumber(meDiffuseTableArray[i][1]);

	    return meDiffuseTableArray[i][1];
	}
    }

    return 0;
}

function SetIndicateSegmentNumber(segment,me)
{


    if (me.checked)
    {
	meIndicateSegmentNumber[segment][meCurrentLesion]=1;
    }
    else
    {
	meIndicateSegmentNumber[segment][meCurrentLesion]=0;
    }
    //calculate score
    CalculateTotalOcclusion();

}


function GetProximalSegmentNumber()
{

    return meProximalSegmentNumber[meCurrentLesion];
}


function SetAgeOfTO(Value)
{
    //1 or 2 scores 1
    //0 scores nothing
    //-1 nothing answered
    meAgeofTO[meCurrentLesion]=Value;
    var oldScore=meAgeofTOScore[meCurrentLesion];
    var newScore=0;

    if ((Value==2) || (Value==1))
    {
	newScore=1;
    }
    requireUpdateScore(newScore,oldScore);
    meAgeofTOScore[meCurrentLesion]=newScore;
}


function SetBluntStump(Value)
{
    meBluntStump[meCurrentLesion]=Value;
    var oldScore=meBluntStumpScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=1;
    }

    requireUpdateScore(newScore,oldScore);
    meBluntStumpScore[meCurrentLesion]=newScore;
}

function setBridging(Value)
{
    meBridging[meCurrentLesion]=Value;
    var oldScore=meBridgingScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=1;
    }

    requireUpdateScore(newScore,oldScore);

    meBridgingScore[meCurrentLesion]=newScore;
}

function resetVisualizedByContrastScore()
{
    var oldScore=meVisualizedByContrastScore[meCurrentLesion];
    meVisualizedByContrastScore[meCurrentLesion]=0;
    requireUpdateScore(0,oldScore);
}

function setVisualizedByMainSegment(Value)
{
//	alert('setVisualizedByMainSegment:'+Value);
    meVisualizedByMainSegment[meCurrentLesion]=Value;
}


function setVisualizedByContrast(Value)
{
    var OldScore=meVisualizedByContrastScore[meCurrentLesion];
    var proxSegment=GetProximalSegmentNumber();
    var blnFirstSet=false;
    var blnFirstOption=false;
    var blnSecondOption=false;
    var newScore = -1;
    var arrayStart=0;
    var	arrayEnd=0;
    var showme;
    var number;
    var showme2;
    var label;
    var segm='';
    var tmpteststring;
    var denylist='';
    meSegments[meCurrentLesion]=Value;
    var activeSegment=meSegments[meCurrentLesion];

    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
	showme=meSegmentVisualizedTableHelp[i][4];
	segm=meSegmentVisualizedTableHelp[i][0];
	denylist=meSegmentVisualizedTableHelp[i][5];
alert('segm:'+segm);
alert('meVisualizedByMainSegment[meCurrentLesion]:'+meVisualizedByMainSegment[meCurrentLesion]);

	if (segm==meVisualizedByMainSegment[meCurrentLesion])
	{
	    // FOUND CORRECT SEGMENT
	    arrayStart=parseInt(meSegmentVisualizedTableHelp[i][2]);
	    arrayEnd=parseInt(meSegmentVisualizedTableHelp[i][3]);
	  //  alert('arrayStart:'+arrayStart);
	  //  alert('arrayEnd:'+arrayEnd);
	    break;
	}
    }

    if (showme=='1')
    {

	for (var j = arrayStart;j <= arrayEnd; j++)
	{
	    number=meDiffuseTableArray[j][1];
	    showme2=meDiffuseTableArray[j][2];
     //   alert('number:'+number);
      //  alert('activeSegment:'+activeSegment);
        
	    if ((showme2=='1') && (denylist!=''))
	    {
		//check if not in deny list
		tmpteststring='|' + number + '|';
		if (denylist.indexOf(tmpteststring)!=-1)
		{
		    showme2='0';
		}
	    }

	    if (showme2=='1')
	    {
		// adaption, start assigning points AFTER activeSegment + 1
		//alert('Before newScore:'+newScore);
		if( proxSegment == '5' ) {
		    newScore=calculateQ4V_TO5(activeSegment);
		    break;
		}
					if ( activeSegment == 16 && number == 1 ) {
					newScore = 2;
					break;
				}
					if ( activeSegment == "none" && number == 1 && meDominance == 'right') {
					newScore = 3;
					break;
				}
					if ( activeSegment == 4 && number == 1 ) {
					newScore = 2;
					break;
				}				
					if ( activeSegment == "none" && number == 2 && meDominance == 'right') {
					newScore = 2;
					break;
				}
					if ( activeSegment == 16 && number == 2 ) {
					newScore = 1;
					break;
				}
					if ( activeSegment == 4 && number == 2 ) {
					newScore = 1;
					break;
				}								
					if ( activeSegment == 16 && number == 3 ) {
					newScore = 0;
					break;
				}
					if ( activeSegment == "none" && number == 3 ) {
					newScore = 1;
					break;
				}				
					if ( activeSegment == 16 && number == 4 ) {
					newScore = 0;
					break;
				}				
					if ( activeSegment == 4 && number == 4 ) {
					newScore = 0;
					break;
				}
					if ( activeSegment == "none" && number == 4 ) {
					newScore = 0;
					break;
				}	
		else {
		    // adaption, start assigning points AFTER activeSegment + 1
		    if ( number != activeSegment ) {
			newScore=newScore+1;
		    }
		    else {
			break;
		    }
}
	    }
	}
    }

    // newScore has been initialized at -1 because we do not
    // want to assign point to the segment after 
    if( newScore == -1 )
	newScore = 0;

    meVisualizedByContrastScore[meCurrentLesion]=newScore;

    UpdateScore(newScore);
    
    UpdateScore(-(OldScore));
    showScore();
}

function setSideBranch(Value)
{
    // 2 = 0
    meSideBranch[meCurrentLesion]=Value;
    var oldScore=meSideBranchScore[meCurrentLesion];
    var newScore=0;

    if ((Value==1) || (Value==3) || (Value==2))
    {
	newScore=1;
    }
    requireUpdateScore(newScore,oldScore);
    meSideBranchScore[meCurrentLesion]=newScore;
}

function SetTrifurcation(Value)
{

    meTrifurcation[meCurrentLesion]=Value;
    var oldScore=meTrifurcationScore[meCurrentLesion];
    var newScore=0;

    if ((Value!=0) && (Value!=-1))
    {
	newScore=(Value)+2;
    }
    requireUpdateScore(newScore,oldScore);
    meTrifurcationScore[meCurrentLesion]=newScore;

}

function SetBifurcation(Value)
{
    var oldValue=meBifurcation[meCurrentLesion];
    var newValue=Value;
    meBifurcation[meCurrentLesion]=Value;
    var str1score='-ABC';
    var str2score='-DEFG';


    var oldScore=meBifurcationScore[meCurrentLesion];
    var newScore=0;


    if (oldValue!=newValue)
    {
	//A B C
	//D E F G
	if (str1score.indexOf(newValue)>0)
	{
	    newScore=1;
	}

	if (str2score.indexOf(newValue)>0)
	{
	    newScore=2;
	}
    }
    requireUpdateScore(newScore,oldScore);
    meBifurcationScore[meCurrentLesion]=newScore;

}

function SetBifurcationAngulation(Value)
{
    meBifurcationAngulation[meCurrentLesion]=Value;
    var oldScore=meBifurcationAngulationScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=1;
    }
    requireUpdateScore(newScore,oldScore);
    meBifurcationAngulationScore[meCurrentLesion]=newScore;
}

function SetAortaOstialLesion(Value)
{
    meAortoOstialLesion[meCurrentLesion]=Value;
    var oldScore=meAortoOstialLesionScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=1;
    }
    requireUpdateScore(newScore,oldScore);
    meAortoOstialLesionScore[meCurrentLesion]=newScore;
}

function SetSevereTorTuosity(Value)
{
    meSevereTortuosity[meCurrentLesion]=Value;
    var oldScore=meSevereTortuosityScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=2;
    }
    requireUpdateScore(newScore,oldScore);
    meSevereTortuosityScore[meCurrentLesion]=newScore;
}

function SetLength(Value)
{
    meLength[meCurrentLesion]=Value;
    var oldScore=meLengthScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=1;
    }
    requireUpdateScore(newScore,oldScore);
    meLengthScore[meCurrentLesion]=newScore;
}

function SetHeavycalcification(Value)
{
    meHeavyCalcification[meCurrentLesion]=Value;
    var oldScore=meHeavyCalcificationScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=2;
    }
    requireUpdateScore(newScore,oldScore);
    meHeavyCalcificationScore[meCurrentLesion]=newScore;
}

function SetThrombus(Value)
{
    meThrombus[meCurrentLesion]=Value;
    var oldScore=meThrombusScore[meCurrentLesion];
    var newScore=0;

    if (Value==1)
    {
	newScore=1;
    }
    requireUpdateScore(newScore,oldScore);
    meThrombusScore[meCurrentLesion]=newScore;
}

function SetComment(Comment)
{
    meComment[meCurrentLesion]=Comment;
}

function getForcedTrifurcationAnswer()
{
    //adjusted always show Q5Yes options

    return false;
    //find out if for this lession a certain combination is true
    //if so the answer is forced!!
    if (parseInt(meSegmentsInvolved[2][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[3][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[4][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[5][meCurrentLesion])==1)
    {
	return true;
    }
    if (parseInt(meSegmentsInvolved[8][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[9][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[16][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[17][meCurrentLesion])==1)
    {
	return true;
    }
    if (parseInt(meSegmentsInvolved[9][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[10][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[12][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[13][meCurrentLesion])==1)
    {
	return true;
    }
    if (parseInt(meSegmentsInvolved[10][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[11][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[14][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[15][meCurrentLesion])==1)
    {
	return true;
    }
    if (parseInt(meSegmentsInvolved[16][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[18][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[19][meCurrentLesion])==1 && parseInt(meSegmentsInvolved[20][meCurrentLesion])==1)
    {
	return true;
    }

    return false;
}


function UpdateScore(ScoreToAdd)
{
    meScore=meScore+parseFloat(ScoreToAdd);

    meScorePerLesion[meCurrentLesion] = meScorePerLesion[meCurrentLesion] + parseFloat(ScoreToAdd);
}

function GetScore()
{
    return meScore;
}

/**
   Function increments the meCurrentLesion variable and
   prepares everything for the next lesion.

   Because this function will no longer handle the navigation
   to the ScoreOverview (when the user is finished) this
   functionality has been taken out.
 */
function NextLesion()
{
    if( meNumberOfLesions + 1 <= 12 ) {
	meNumberOfLesions++;
	meCurrentLesion = meNumberOfLesions-1;

	//setFrameUrl('left','empty.htm');
	//setFrameUrl('right','empty.htm');

	if( meDominance == 'left' ){
	    //setFrameUrl('left','selectedleft.htm');
	} else {
		
	}
	    //setFrameUrl('left','selectedright.htm');

	//setFrameUrl('right','lesion_segments.htm');
//callHideShow('divSyntaxScorecontent');
	// header update
	UpdateCurrentLesion();
    }
    else {
	alert("Maximum number of lesions is 12");
	return;
    }
}

/** Function is invoked when the user decided to
    stop entering the lesions and the score will be
    calculated. ( code taken from NextLesion() )
 */
function navigateToScoreOverview(){
    ApplicationEnded=true;
    gotoScoreOverview();
}

/** Header text change */
function UpdateCurrentLesion()
{
    setHeaderText('current','Current lesion: ' + (meCurrentLesion+1) + '/' + meNumberOfLesions);
}

/** Function is only invoked in case of a 'new patient', so at the load of frameset.htm
    and the dominance is to be selected (left of right)
 **/
function init()
{
    //initalize the application
    meDominance='';
    reset();
    //setFrameUrl('header','header.htm');
    //setFrameUrl('left','selectdomleft.htm');
    //setFrameUrl('right','selectdomright.htm');

    blnInitCalled=true;
}

function gotoScoreOverview()
{
  
     callHideShow('divSyntaxScoreOverView');
     buildScoreOverviewTable();

     buildScoreOverviewTablePrint()
}

function requireUpdateScore(newScore,oldScore)
{
    if (newScore!=oldScore)
    {
	UpdateScore(-(oldScore));
	UpdateScore(newScore);
	showScore();
    }
}


function PrintScoreIfNeeded() {
  if( blnPrintRequested ){
    window.frames['right'].PrintScore();
  }
  blnPrintRequested = false;
}



function DetectBrowser()
{
    var val = navigator.userAgent.toLowerCase();       

    if(val.indexOf("firefox") > -1)
    {
	return "firefox"
    } 

    else if(val.indexOf("opera") > -1)
    {
        return "opera";
    }

    else if(val.indexOf("msie") > -1)
    {
        return "ie"
    }
    else if(val.indexOf("safari") > -1)
    {
        return "safari";
    }
}

function genHead() {

    var printOverViewHead = '';

    printOverViewHead = '<table class="sotable" id="allanswertable" width=100%><tr><td width=30%></td><td width=70%></td></tr>';
    if( getById('left', 'patientId').value != "" ) {
	printOverViewHead += '<tr><td> Patient ID: </td><td>' +  getById('left', 'patientId').value + '</td></tr>';
    }
    else {
	printOverViewHead += '<tr><td> Patient ID: </td><td>...................................</td></tr>';
    }

    if( getById('left', 'patientName').value != "" ) {
	printOverViewHead += '<tr><td> Name : </td><td>' +  getById('left', 'patientName').value + '</td></tr>';
    }
    else {
	printOverViewHead += '<tr><td> Name : </td><td>...................................</td></tr>';
    }

    if( getById('left', 'patientDob').value != "" ) {
	printOverViewHead += '<tr><td> Date of birth: </td><td>' +  getById('left', 'patientDob').value + '</td></tr>';
    }
    else {
	printOverViewHead += '<tr><td> Date of birth: </td><td>...................................</td></tr>';
    }		
    printOverViewHead += '</table>';

    return printOverViewHead;
}

function GeneratePdfIfNeeded() {
    if( blnSaveRequested ) {
	blnSaveRequested = false;

	var saveText = genHead() + getFrame('left').document.genPdfForm.printsource.value;
	alert(genHead());
	getFrame('left').document.genPdfForm.printsource.value = saveText;

	getFrame('left').document.genPdfForm.submit();
    }
    else {
	blnSaveRequested = false;
	return false;
    }
}

/** Function sets the currentLesion to completed. This function
    is invoked after the form is completed and the next
    button (in form.htm) is clicked.
 **/
function setLesionAsCompleted() {
    meCompletedLesions[meCurrentLesion] = 1;
}

function resetMeCompletedLesions() {
    for( var i = 0; i < myDefaultArrayLength; i++ ) {
	meCompletedLesions[i] = 0;
    }
}

function setFormVarBlnSegmentTableContainsElements(lesionNumber) {
  formVarBlnSegmentTableContainsElements[lesionNumber] = 1;
}

//q12.js

/******************************************************
 * Syntax Score Calculator Version 2.0                *
 *                                                    *
 * Orginal code (version 1.0): ISM (2005)             *
 * Adaptions    (version 2.0): Luc Strijbosch (2009)  *
 ******************************************************/

var DiffuseDiseaseScore = 0;
var answer = 'no';



function Question12(number)
{
    //yes = 1
    //no  = 0
  
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


function checkAndCalc() {
	
    if( DiffuseDiseaseScore > 0 || answer == 'no' ) {
    
	navigateToScoreOverview();
    } else {
	alert('Please select at least one segment');
	}
}


//scoreoverview.js

<!--


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
	    strImg  = '<div id="'+ idName +'" class="kmpicture"><b>MACCE by SYNTAX Score 0-22</b><br><img style="margin-bottom:5px;" src="'+URL+'/images/KM1.png" align=center><br>';
	    strImg += '<i> ' + strComment + '</i> </div><br><br>';
	}
	else if(meScore >= 23 && meScore <= 32 ){
	    strImg  = '<div id="'+ idName +'" class="kmpicture" ><b>MACCE by SYNTAX Score 23-32</b><br><img style="margin-bottom:5px;" src="'+URL+'/images/KM2.png" align=center><br>';
	    strImg += '<i> ' + strComment + '</i> </div><br><br>';
	}
	else if(meScore > 32 ) {
	    strImg  = '<div id="'+ idName +'" class="kmpicture"><b>MACCE by SYNTAX Score 33+</b><br><img style="margin-bottom:5px;" src="'+URL+'/images/KM3.png" align=center><br>';
	    strImg += '<i> ' + strComment + '</i> </div><br><br>';
	}
	else
	
	    strImg = '';    
    }
$('#resultImage').html(strImg);

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
    var retString='';
    var saveString='';
    var dbOverView = '';
    var dbOverViewHead = '';
    var dbTemp='';
    var printForPaper='';
			
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
	dbOverView+=	'1. Dominance: '+Dominance+"\n";
    printOverView += SumarLinePrint('','','2. Number of lesions',nrofLesion);
	dbOverView+=	'2. Number of lesions: '+nrofLesion+"\n";		
			
    //per lession
    for (var i = 0; i < nrofLesion; i++)
    {	
	printOverView += SumarLinePrint('sumarspacer','sumarspacer','<br>','&nbsp;');
	dbOverView+="\n";		
	printOverView += SumarLinePrint('lesionheader','sumarspacer','lesion ' + (i+1),'&nbsp;');
	dbOverView+=	'lesion: '+(i+1)+"\n";		
	//dbOverView+="\n";	
	//segmenten
	strTemp='';
	dbTemp='';
	for (var j = 0; j < meDiffuseTableArray.length; j++)
	{
	    if (meSegmentsInvolved[j][i]==1)
	    {						
					
		if (strTemp!='') 
		{
		    strTemp=strTemp+'<br>';		
		     dbTemp=dbTemp+'\n';
		}
							
		strTemp=strTemp + meDiffuseTableArray[j][1];
		dbTemp+= '^^ '+meDiffuseTableArray[j][1]+":"+meDiffuseTableArray[j][0];
	    }
	}
	if (strTemp=='') {
	    strTemp='Skipped';
	    dbTemp='Skipped';
	}
	printOverView += SumarLinePrint('','','3. segment numbers involved',strTemp);
	dbOverView+=	'3. segment numbers involved: \n'+dbTemp+"\n";		
			
	if (meTotalOcclusion[i]==1)
	{
	    strTemp='Yes';
	    dbTemp='Yes';
	}
	else
	{
	    strTemp='No';
	    dbTemp='No';
	}
						
	printOverView += SumarLinePrint('','','4. Total occlusion',strTemp);
	dbOverView+=	'4. Total occlusion: '+dbTemp+"\n";	
			
	strTemp='';
	dbTemp='';
	if (meTotalOcclusion[i] == 1 )
	{
	    for (var j = 0; j < meDiffuseTableArray.length; j++)
	    {
		if (meIndicateSegmentNumber[j][i]==1)
		{
		    if (strTemp!='') 
		    {
			strTemp=strTemp+'<br>';		
			dbTemp='^^ '+dbTemp+'\n';
		    }
		    strTemp=strTemp + meDiffuseTableArray[j][1];
		    dbTemp=dbTemp+ meDiffuseTableArray[j][1]+","+meDiffuseTableArray[j][0];
		}			    
	    }
			    
	    printOverView += SumarLinePrint('','','&nbsp;&nbsp;I. segment numbers',strTemp);
	    dbOverView+=	'^^I. segment numbers: '+dbTemp+"\n";	
	}
	//prox number
	strTemp=meProximalSegmentNumber[i];
	dbTemp=meProximalSegmentNumber[i];
	if (strTemp=='')
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;I. Most proximal segment number',strTemp);
	dbOverView+=	'^^ I. segment numbers: '+dbTemp+"\n";			
			
			
	//age
	strTemp=SkpText;
	dbTemp=SkpText;
	if (meAgeofTO[i]!=-1)
	{
	    strTemp='no';
	    dbTemp='no';
	    if (meAgeofTO[i]==1)
	    {
		strTemp='yes';
		dbTemp='yes';
	    }
	    if (meAgeofTO[i]==2)
	    {
		strTemp='unknown';
		dbTemp='unknown';
	    }
	}
								
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;II. More than 3 months',strTemp);
	dbOverView+=	'^^ II. More than 3 months: '+dbTemp+"\n";		
	//blunt
	strTemp=SkpText;
	dbTemp=SkpText;
	if (meBluntStump[i]!=-1)
	{
	    strTemp='yes';
	    dbTemp='yes';
	    if (meAgeofTOScore[i]==0)
	    {
		strTemp='no';
		dbTemp='no';
	    }
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;III. Blunt stump',strTemp);
	dbOverView+=	'^^ III. Blunt stump: '+dbTemp+"\n";
			
	//briding
	strTemp=SkpText;
	dbTemp=SkpText;
	if (meBridging[i]!=-1)
	{
	    strTemp='yes';
	    dbTemp='yes';
	    if (meBridgingScore[i]==0)
	    {
		strTemp='no';
		dbTemp='no';
	    }
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;IV. Bridging',strTemp);
	dbOverView+=	'^^ IV. Bridging: '+dbTemp+"\n";
			
			
	//the first segment number beyond the total occlusion that is visualized by antegrade or retrograde contrast. 
	strTemp=meSegments[i];
	dbTemp=meSegments[i];		
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;V. the first segment beyond the T.O. visualized by contrast: ',strTemp);
	dbOverView+=	'^^ V. the first segment beyond the T.O. visualized by contrast:'+dbTemp+"\n";		
	//side branch
	strTemp=SkpText;
	dbTemp=SkpText;
	if (meSideBranch[i]!=-1)
	{
	    strTemp=meSideBranchAnswers[meSideBranch[i]];
		dbTemp=meSideBranchAnswers[meSideBranch[i]];		
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;VI. Sidebranch',strTemp);
	dbOverView+=	'^^ VI. Sidebranch:'+dbTemp+"\n";			
	//trifurcation
	strTemp=SkpText;
	dbTemp=SkpText;
	if (meTrifurcation[i]!=-1)
	{
	    strTemp='No';	
	     dbTemp='No';	
	    if (meTrifurcationScore[i]!=0)
	    {
		strTemp='Yes ' + meTrifurcation[i]  + ' diseased segment(s) involved';
		dbTemp='Yes ' + meTrifurcation[i]  + ' diseased segment(s) involved';
		    }
				
	}
	printOverView += SumarLinePrint('','','5. Trifurcation',strTemp);
	dbOverView+=	'5. Trifurcation:'+dbTemp+"\n";			
	//Bifurcation
	if (meQ6Skipped[i])
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{
	    if (meBifurcationScore[i]==0)
	    {
		strTemp='No';
		dbTemp='No';
	    }
	    else
	    {
		strTemp='Yes: ' + meBifurcationMapping[meBifurcation[i]];
		dbTemp='Yes: ' + meBifurcationMapping[meBifurcation[i]];
	    }
	}
	printOverView += SumarLinePrint('','','6. Bifurcation',strTemp);
	dbOverView+=	'6. Bifurcation:'+dbTemp+"\n";
				
	//Bifurcation angulation
	if ((meQ6Skipped[i]) || (meBifurcationScore[i]==0))
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{
	    strTemp='yes';
	    dbTemp='yes';
	    if (meBifurcationAngulationScore[i]==0)
	    {
		strTemp='No';
		dbTemp='No';
	    }
	}
	printOverView += SumarLinePrint('','','&nbsp;&nbsp;&nbsp;&nbsp;Bifurcation angulation',strTemp);
	dbOverView+=	'^^ Bifurcation angulation:'+dbTemp+"\n";
			
			
	//Aorto Ostial lesion
	if (meQ7Skipped[i])
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
	    dbTemp='yes';
		if (meAortoOstialLesionScore[i]==0)
		{
		    strTemp='No'
		    dbTemp='No';
		}
	}
	printOverView += SumarLinePrint('','','7. Aorto Ostial lesion',strTemp);
	dbOverView+=	'7. Aorto Ostial lesion:'+dbTemp+"\n";
			
	//Severe Tortuosity
	if (meSevereTortuosity[i]==-1)
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
	    dbTemp='yes';
		if (meSevereTortuosityScore[i]==0)
		{
		    strTemp='No'
		    dbTemp='No';
		}
	}
	printOverView += SumarLinePrint('','','8. Severe Tortuosity',strTemp);
	dbOverView+=	'8. Severe Tortuosity:'+dbTemp+"\n";		
	//Length &gt;20 mm
	if (meLength[i]==-1)
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
	    dbTemp='yes';
		if (meLengthScore[i]==0)
		{
		    strTemp='No'
		    dbTemp='No';
		}
	}
	printOverView += SumarLinePrint('','','9. Length &gt;20 mm',strTemp);
	dbOverView+=	'9. Length >20 mm:'+dbTemp+"\n";	
			
			
	//Heavy calcification
	if (meHeavyCalcification[i]==-1)
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
	    dbTemp='yes';
		if (meHeavyCalcificationScore[i]==0)
		{
		    strTemp='No'
		    dbTemp='No';
		}
	}
	printOverView += SumarLinePrint('','','10. Heavy calcification',strTemp);
	dbOverView+=	'10. Heavy calcification:'+dbTemp+"\n";			
	//Thrombus
	if (meThrombus[i]==-1)
	{
	    strTemp=SkpText;
	    dbTemp=SkpText;
	}
	else
	{	
	    strTemp='Yes'
	    dbTemp='yes';
		if (meThrombusScore[i]==0)
		{
		    strTemp='No'
		    dbTemp='No';
		}
	}

	printOverView += SumarLinePrint('','','11. Thrombus',strTemp);
	dbOverView+=	'11. Thrombus:'+dbTemp+"\n";	
	printOverView += SumarLinePrint('sumarspacer','sumarspacer','Comment','&nbsp;');
    dbOverView+=	'Comment:'+"\n";	
	if (meComment[i]!='')
	{
				
	    printOverView += SumarLinePrint('','',meComment[i],'&nbsp;');
	    dbOverView+=	''+meComment[i]+"\n";	
	}
    }


    /** Diffuse disease small/vessels **/
    var diffDisease = "";
    var dbdiffDisease = "";
    diffDisease += subDifusseDeseasePrintable(0,7);
    diffDisease += subDifusseDeseasePrintable(8,8);
    diffDisease += subDifusseDeseasePrintable(9,15);
    diffDisease += subDifusseDeseasePrintable(16,24);
   
   
   dbdiffDisease += dbsubDifusseDeseasePrintable(0,7);
    dbdiffDisease += dbsubDifusseDeseasePrintable(8,8);
    dbdiffDisease += dbsubDifusseDeseasePrintable(9,15);
    dbdiffDisease += dbsubDifusseDeseasePrintable(16,24);
    
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','<br>','&nbsp;');
    dbOverView+=	"\n";	
    printOverView += SumarLinePrint('lesionheader','sumarspacer', 'Diffuse disease/Small vessels', '&nbsp;');
    dbOverView+=	'Diffuse disease/Small vessels \n';	
    if ( diffDisease != "" ) {  
	printOverView += SumarLinePrint('','','Segments selected', diffDisease);
	dbOverView+=	'Segments selected:\n'+dbdiffDisease+"\n";	
	printOverView += '<tr><td colspan="2">&nbsp;</td></tr>';
	dbOverView+=	"\n";	
    }
    else {
	printOverView += SumarLinePrint('','','Segments selected','No');
	dbOverView+=	'Segments selected: No'+"\n";	
	printOverView += '<tr><td colspan="2">&nbsp;</td></tr>';
	dbOverView+=	"\n";	
    }
    


    //Total Score
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');
    dbOverView+=	"\n";	
    printOverView += SumarLinePrint('sumarspacer','sumarspacer','&nbsp;','&nbsp;');
    //dbOverView+=	"\n";	
    printOverView += SumarLinePrint('','','TOTAL SYNTAX SCORE:',GetScore());
    dbOverView+=	'TOTAL SYNTAX SCORE: '+GetScore()+"\n";	
	

    
    // pictures are at the end of the print out
    printOverView += '<tr><td colspan="2" align=center><br><br>';
    printOverView +=  returnApplicablePictureLink('') ;
    printOverView += '</td></tr>';    

    printOverView += '</table>';

  //  document.write(printOverViewHead);
  //  document.write(printOverView);
//  alert(printOverViewHead+printOverView);
  $('#resultPrintBlock').html(printOverViewHead+printOverView);
  $('#syntaxscore_reultPrint').val(dbOverViewHead+dbOverView);
  $('#syntaxscore_reultTable').val( $('#syntaxscore_reultTable').val()+printOverViewHead+printOverView);
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
    var retString='';
    var retScore=0;
		
    // picture first
    //document.write( returnApplicablePictureLink('kmpicturetop') );

    //sumary
    retString+='<table class="sotable" id="sumanswertable" cellpadding="0" cellspacing="0" border="1">';
		
   retString+='<tr><td class="genheader">Summary';
   retString+='</td><td>&nbsp;</td></tr>';
   retString+='<tr><td colspan="2">&nbsp;</td></tr>';
   retString+='<tr><td colspan="2">&nbsp;</td></tr>';	

    if (Dominance=='left')
    {
	arrayDepth=5;
    }
  //  nrofLesion=1;
	
    for (var i = 0; i < nrofLesion; i++)
    {	
	subtotal=0;
	//lesion
	retString+='<tr><td class="lesionheader">Lesion ';
	retString+=i+1;
	retString+='</td><td>&nbsp;</td></tr>';
	//segments involved for this lesion
	CalculationFactor=2;
			
	if (meTotalOcclusion[i]==1)
	{
	    retString+='<tr><td class="sodata">segment number(s)';
	    retString+='</td><td class="soscore">&nbsp;</td></tr>';
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
					
		retString+='<tr><td class="sodata">(segment ';
		//segment number
		retString+=meDiffuseTableArray[j][1];
		retString+='): ';
		//calculationfactor
		retString+=meDiffuseTableArray[j][arrayDepth];
		retString+='x';
		retString+=CalculationFactor;
		retString+='=</td><td class="soscore">';
		retString+=meDiffuseTableArray[j][arrayDepth]*CalculationFactor;
		retString+='</td></tr>';
		subtotal=subtotal + (meDiffuseTableArray[j][arrayDepth]*CalculationFactor);
	    }
	}

	// age to
	if (meAgeofTOScore[i]!=0)
	{
	    subtotal=subtotal + meAgeofTOScore[i];
				
	    retString+='<tr><td class="sodata">Age T.O. is ';
	    if (meAgeofTO[i]==1)
	    {
		retString+='yes';
	    }
	    else
	    {
		retString+='unknown';
	    }
				
	    retString+='</td><td class="soscore">'+meAgeofTOScore[i]+'</td></tr>';
	}
			
	//blunt stump  meBluntStumpScore
	if (meBluntStumpScore[i]!=0)
	{
	    subtotal=subtotal + meBluntStumpScore[i];
	    retString+='<tr><td class="sodata">+ Blunt stump';
	    retString+='</td><td class="soscore">'+meBluntStumpScore[i]+'</td></tr>';
	}
			
	// Bridging  
	if (meBridgingScore[i]!=0)
	{
	    subtotal=subtotal + meBridgingScore[i];
	    retString+='<tr><td class="sodata">+ Bridging';
	    retString+='</td><td class="soscore">'+meBridgingScore[i]+'</td></tr>';
	}
			
	// contrast
	if ((meVisualizedByContrastScore[i]!=0) || (meSegments[i]!='Skipped'))
	{
	    subtotal=subtotal + meVisualizedByContrastScore[i];
			
	    retString+='<tr><td class="sodata">the first segment beyond the T.O. visualized by contrast: ';
	    //			if (meSegments[i]!=0)
	    //			{
	   retString+=meSegments[i];
	    //			}
	    retString+='</td><td class="soscore">'+meVisualizedByContrastScore[i]+'</td></tr>';
	}
			
	// Sidebranch meSideBranchScore[meCurrentLesion]
	if (meSideBranchScore[i]!=0)
	{
	    subtotal=subtotal + meSideBranchScore[i];
	    retString+='<tr><td class="sodata">+ sidebranch: ';
	    retString+=meSideBranchAnswers[meSideBranch[i]];
	    retString+='</td><td class="soscore">'+meSideBranchScore[i]+'</td></tr>';
	
	}
			
	//trifurcation
	if (meTrifurcationScore[i]!=0)
	{
	    subtotal=subtotal + meTrifurcationScore[i];
	    retString+='<tr><td class="sodata">Trifurcation ';
	    retString+=meTrifurcation[i];
	    retString+=' diseased segment(s) involved';
	    retString+='</td><td class="soscore">'+meTrifurcationScore[i]+'</td></tr>';
	}
			
	//bifurcation
	if (meBifurcationScore[i]!=0)
	{
	    subtotal=subtotal + meBifurcationScore[i];
	    retString+='<tr><td class="sodata">Bifurcation Type: ';
	    retString+=meBifurcationMapping[meBifurcation[i]];
	    retString+=': ';
	    retString+='</td><td class="soscore">'+ meBifurcationScore[i] +'</td></tr>';
	}
			
				
	//Bifurcation angulation
	if (meBifurcationAngulationScore[i]!=0)
	{
	    subtotal=subtotal + meBifurcationAngulationScore[i];
	    retString+='<tr><td class="sodata">Angulation &lt;70�';
	    retString+='</td><td class="soscore">'+meBifurcationAngulationScore[i]+'</td></tr>';
	}
				
	//Aorto Ostial lesion
	if (meAortoOstialLesionScore[i]!=0)
	{
		
	    subtotal=subtotal + meAortoOstialLesionScore[i];
	    retString+='<tr><td class="sodata">Aorto Ostial lesion';
	    retString+='</td><td class="soscore">'+meAortoOstialLesionScore[i]+'</td></tr>';
	}
				
				
	//Severe Tortuosity
	if (meSevereTortuosityScore[i]!=0)
	{
		
	    subtotal=subtotal + meSevereTortuosityScore[i];
	    retString+='<tr><td class="sodata">Severe Tortuosity';
	    retString+='</td><td class="soscore">'+meSevereTortuosityScore[i]+'</td></tr>';
	}
			
	// Length >20 mm
	if (meLengthScore[i]!=0)
	{
	
	    subtotal=subtotal + meLengthScore[i];
	    retString+='<tr><td class="sodata">Length &gt;20 mm';
	    retString+='</td><td class="soscore">'+meLengthScore[i]+'</td></tr>';
	}
			
	// Heavy calcification
	if (meHeavyCalcificationScore[i]!=0)
	{
		
	    subtotal=subtotal + meHeavyCalcificationScore[i];
	    retString+='<tr><td class="sodata">Heavy calcification';
	    retString+='</td><td class="soscore">'+meHeavyCalcificationScore[i]+'</td></tr>';
	}
			
	// Thrombus
	if (meThrombusScore[i]!=0)
	{
		
	    subtotal=subtotal + meThrombusScore[i];
	    retString+='<tr><td class="sodata">Thrombus';
	    retString+='</td><td class="soscore">'+meThrombusScore[i]+'</td></tr>';
	}
	
	//total
	retString+='<tr><td class="sosubtotal">Sub total lesion ' + (i+1);
	retString+='</td><td class="sosubtotalscore">' + subtotal + '</td></tr>';
			
	//comment
	if (meComment[i]!='')
	{
	    retString+='<tr><td colspan="2" class="sodata">Comment:<br><div class="socomment">';
	    retString+=meComment[i]+'</div></td></tr>';
	}		
	
	//spacers
	retString+='<tr><td colspan="2">&nbsp;</td></tr>';
	retString+='<tr><td colspan="2">&nbsp;</td></tr>';
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
	retString+='<tr><td class="lesionheader">Diffuse disease/Small vessels';    
	retString+=diffDisease;

	retString+='<tr><td class="sosubtotal">Sub total diffuse disease/small vessels</td><td class="sosubtotalscore">' + (subtotal - subTotalBeforeDiffDesease) + '</td></tr>';
	retString+='<tr><td colspan="2">&nbsp;</td></tr>';
    }
    
    retString+='<tr><td class="sototal">TOTAL:';
    retString+='</td><td class="sototalscore">' + GetScore() + '</td></tr></table>';
    //end sumary
    retScore=	GetScore() ;
    // now continue with the extended one
		
    //dominance first			
   // alert(retString);
    $('#resultBlock').html(retString);
    $('#syntaxscore_reult').val(retScore);
    $('#syntaxscore_reultTable').val($('#syntaxscore_reultTable').val()+retString);
    
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

function dbsubDifusseDeseasePrintable(iS,iE,strTemp)
{
    var txt = "";
    for (var i = iS; i <= iE; i++)
    {
	if (meDiffuseDiseaseArray[i]==1)
	{
	    //segment number
	    txt += '^^'+meDiffuseTableArray[i][1] + ':'+meDiffuseTableArray[i][0] +'\n';
	}
    }

    return txt;
}
//-->



/******************************************************
 * Syntax Score Calculator Version 2.0                *
 *                                                    *
 * Orginal code (version 1.0): ISM (2005)             *
 * Adaptions    (version 2.0): Luc Strijbosch (2009)  *
 ******************************************************/

/*
 * Version 2.0: Changes to this file.
 *
 * - Reloading a lesion is performed by filling out the
 *   complete form based on the saved values.
 *
 * - Deletion involves a shift back of all lesions that
 *   are present 'after' the lesion marked for deletion
 *
 * - Logic for separate question 12 has been added.
 *
 * - Variables that were global in the form.js context
 *   are moved to this file and saved per lesion to
 *   ensure correct reload of form.js
 *
 * - Some minor score changes
 *
 */

var myDefaultArrayLength=12;

// this variable toggles frame(less) layout
var FRAME_LAYOUT = true;

// array that is set to true if lesion form is completed
var meCompletedLesions = new Array(myDefaultArrayLength);

// temporary array used for question 12 that will contain
// all segments selected in all filled out lesions to
// correctly show the diffuse segment table
// var meAllSegmentsMerged = new Array(25);


/** The following variables were previously initialized on
    the loading of form.js. However since we are RELOAD
    a form (using form.js) we need these values to be kept
    in memory.

    The array are the memory, the values afterwards are
    set on form load, so the form retrieves the correct values

    This is needed because form.js does not 'know' what
    lesion it is. (essentially stateless).
**/



/** This function fethces frame frameId in case of a frame
    layout. In case a div layout is used it returns the
    handle to the requested DIV 'frame'.
 **/

/** Abbreviated syntax for document.getElementById(forId)
 **/

/** Abbreviated syntax for document.getElementByName(name)
 **/


/** Helper function for filling in question 4v, the segment and number
    which are saved in the arrays: meVisualizedByMainSegment and meSegments
    are translated back to the IDs in the form (which are dynamic).

    Note: Function is based upon buildSegmentVisualizTableNew() in form.js
 **/
function translateNumberAndSegmentQuestion4v(){
    segment = meVisualizedByMainSegment[meCurrentLesion];
    number =  meSegments[meCurrentLesion];

    if( number == "none" )
	return "ddsgmsnone" + segment;

    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)  {

	arrayStart=parseInt(meSegmentVisualizedTableHelp[i][2]);
	arrayEnd=parseInt(meSegmentVisualizedTableHelp[i][3]);
	denylist=meSegmentVisualizedTableHelp[i][5];

	if( meSegmentVisualizedTableHelp[i][0] == segment && meSegmentVisualizedTableHelp[i][4] == '1' ) {

	    // loop through diffusetablearray, and ignore items of the deny list
	    for (var j = arrayStart; j <= arrayEnd; j++)
	    {
		showme2=meDiffuseTableArray[j][2];

		if ((showme2=='1') && (denylist!=''))
		{
		    //check if not in deny list
		    tmpteststring='|' + number + '|';
		    if (denylist.indexOf(tmpteststring)!=-1)
		    {
			showme2='0';
		    }
		}

		if (showme2=='1')
		{
		    // j+1 is returned because 'none' takes place 0...
		    if( meDiffuseTableArray[j][1] == number ) {
			return "ddsgms" + i + "d" + j;
		    }
		}
	    }
	}
    }
}

/** Some segments cannot be proximal
 */
function checkIfProximalSegmentGetsQuestion4v(){
   var mostProx=getMostProximalSegmentNumber();
   var showme='0';

   for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++) {

       if (meSegmentVisualizedTableHelp[i][0]==mostProx)  {

          showme = meSegmentVisualizedTableHelp[i][4];
       }
   }

   if (showme == '1') {
       return true;
   }

   return false;
}

/** Function sets the lesion number and loads the correct
 *  left side according to the selected dominance
 *
 *  Invoked in the menu
 */
function loadExistingLesion(lesionNumber) {
    meCurrentLesion = lesionNumber;
    setFrameUrl('right','lesion_segments.htm');

    if( meDominance == 'left' ) {
	setFrameUrl('left','selectedleft.htm');
    }
    else {
	setFrameUrl('left','selectedright.htm');
    }
}

/* Fill out question 3
   If no values have been set for lesionNumber nothing will
   be done (length of array = 0)
 */
function loadExistingSegmentValues() {

  // header update
  UpdateCurrentLesion();

  if ( meCompletedLesions[meCurrentLesion] ) {
    for (var i = 0; i < meIndicateSegmentNumber.length; i++) {
      if( meSegmentsInvolved[i][meCurrentLesion] == 1 ) {
	getById('right', 'dd' + i + 'd' + meCurrentLesion).checked = true;
	getFrame('right').lightUpRow('row_' + i + meCurrentLesion);
      }
    }
  }
  else {
    resetExistingFormGlobalVars();
    resetAnswersForLesion(meCurrentLesion);
  }
}

/** Function reads answers to question 4 and sub questions
    and fills out the form accordingly.
 */
function loadExistingQuestion4() {

    // no value present, do nothing
    if( meTotalOcclusion[meCurrentLesion] == '-1' ) {
        return;
    }

     // Question 4, id: formq4, only if total occlustion was set to true, not -1 or false
    if( meTotalOcclusion[meCurrentLesion] && meTotalOcclusion[meCurrentLesion] > 0 ) {
        // Total occlustion is present
        getRadioInForm('right', 'formq4', 'totaloc')[meTotalOcclusion[meCurrentLesion]].checked = true;

        // sub question 4i, id: formq4i
        getById('right', 'q4i').style.display='block';
        for (var i = 0; i < meIndicateSegmentNumber.length; i++) {
            if( meIndicateSegmentNumber[i][meCurrentLesion] ) {
                getById('right', 'dd' + i).checked = true;

		// since question 4i changed to radiobuttons we can have a max of 1 selected
		break;
            }
        }

        // sub question 4ii, id: formq4ii
        getById('right', 'q4ii').style.display='block';
        getRadioInForm('right', 'formq4ii', '3months')[meAgeofTO[meCurrentLesion]].checked = true;

        // sub question 4iii, blunt stump
        getById('right', 'q4iii').style.display='block';
        getRadioInForm('right', 'formq4iii', 'bluntstump')[meBluntStump[meCurrentLesion]].checked = true;
        setFrameUrl('left','diagramblunt.htm');

        // sub question 4iv, bridging
        getById('right', 'q4iv').style.display='block';
        getRadioInForm('right', 'formq4iv', 'bridging')[meBridging[meCurrentLesion]].checked = true;
        setFrameUrl('left','diagrambridging.htm');

        // sub question 4v
        // first show table and label, of highest segment (most proximal)
        if( checkIfProximalSegmentGetsQuestion4v() ) {
            // some set to visible for question 4vii
            getById('right', 'q4vitable' + meProximalSegmentNumber[meCurrentLesion]).style.display = 'block';
            getById('right', 'q4vitable').style.display='block';

            getById('right', 'q4v').style.display = 'block';
	    getById('right', translateNumberAndSegmentQuestion4v()).checked = true;
            setFrameUrl('left','diagramviz.htm');
        }

        // sub question 4vi
        getById('right', 'q4vi').style.display='block';
        getRadioInForm('right', 'formq4vi', 'sidebranch')[meSideBranch[meCurrentLesion]].checked = true;
    }
    else if( meTotalOcclusion[meCurrentLesion] == 0 ) {
        getRadioInForm('right', 'formq4', 'totaloc')[meTotalOcclusion[meCurrentLesion]].checked = true;
    }
}


function loadExistingQuestion5() {
    /** ONLY
        if question 4 VI has been answered:
          - Yes, all sidebranches >=1.5mm
	  - Yes, both sidebranches <1.5mm and >=1.5mm are involved
	OR
          - Question 4 was answered NO (T.O.)

	Than show question 5.
     **/
    if( meSideBranch[meCurrentLesion] > 2 || meTotalOcclusion[meCurrentLesion] == 0 ) {

        getById('right', 'q5').style.display = 'block';

	if( meTrifurcation[meCurrentLesion] != -1 ) {

	    if( meTrifurcation[meCurrentLesion] > 0 ) { // answer = yes
		getRadioInForm('right', 'formq5', 'Trifurcation')[1].checked = true;

		// we need to subtract 1 from the the trifurcation value to activate the
                // correct radiobutton in the form (trifurcation 1 is on place 0 etc.)
		getById('right', 'q5yes').style.display = 'block';
		getRadioInForm('right', 'formq5yes', 'q5yes')[meTrifurcation[meCurrentLesion] - 1].checked = true;
	    }
	    else {
		getRadioInForm('right', 'formq5', 'Trifurcation')[0].checked = true;
	    }
	}
    }
}

function loadExistingQuestion6() {
    // only if answer to question 5 is null
    if( meTrifurcation[meCurrentLesion] == 0 ) {
	getById('right', 'q6').style.display = 'block';
	if( meBifurcation[meCurrentLesion] != '' ) {
	    getById('right', 'q6yes1').style.display = 'block';
            getRadioInForm('right', 'formq6', 'Bifurcation')[1].checked = true;

	    // first sub question (formqyes1)
	    switch(meBifurcation[meCurrentLesion])
	    {
	        case 'A': getRadioInForm('right', 'formq6yes1', 'ABC')[0].checked = true;  break;
	        case 'B': getRadioInForm('right', 'formq6yes1', 'ABC')[1].checked = true;  break;
	        case 'C': getRadioInForm('right', 'formq6yes1', 'ABC')[2].checked = true;  break;
	        case 'D': getRadioInForm('right', 'formq6yes1', 'ABC')[3].checked = true;  break;
	        case 'E': getRadioInForm('right', 'formq6yes1', 'ABC')[4].checked = true;  break;
	        case 'F': getRadioInForm('right', 'formq6yes1', 'ABC')[5].checked = true;  break;
	        case 'G': getRadioInForm('right', 'formq6yes1', 'ABC')[6].checked = true;  break;
	        default: break; // no default action
	    }

	    getById('right', 'q6yes2').style.display = 'block';
	    // second sub question (formqyes2)
	    if( meBifurcationAngulation[meCurrentLesion] != -1 )
		getRadioInForm('right', 'formq6yes2', 'angle')[meBifurcationAngulation[meCurrentLesion]].checked = true;

        }
	else {
	    getRadioInForm('right', 'formq6', 'Bifurcation')[0].checked = true;
	}
    }
}

/** Question 7 is only applicable in case certain segments
    are involved.
    If Question7 was NOT applicable it has been set to 0.
**/
function loadExistingQuestion7(){
    if( Question7Enabled() ){
	getById('right', 'q7').style.display = 'block';
	getRadioInForm('right', 'formq7', 'question7')[meAortoOstialLesion[meCurrentLesion]].checked = true;
    }
}

function loadExistingQuestion8(){
    if( meSevereTortuosity[meCurrentLesion] != -1 ) {
	getById('right', 'q8').style.display = 'block';
	getRadioInForm('right', 'formq8', 'question8')[meSevereTortuosity[meCurrentLesion]].checked = true;
    }
}

/**
 * Question 9 is only shown in case question 4 was answered negatively
 */
function loadExistingQuestion9(){
    if( !(meTotalOcclusion[meCurrentLesion] && meTotalOcclusion[meCurrentLesion] > 0) ) {
        if( meLength[meCurrentLesion] != -1 ) {
            getById('right', 'q9').style.display = 'block';
	    getRadioInForm('right', 'formq9', 'question9')[meLength[meCurrentLesion]].checked = true;
	}
    }
}

function loadExistingQuestion10(){
    if( meHeavyCalcification[meCurrentLesion] != -1 ) {
	getById('right', 'q10').style.display = 'block';
	getRadioInForm('right', 'formq10', 'question10')[meHeavyCalcification[meCurrentLesion]].checked = true;
    }
}

function loadExistingQuestion11(){
    if( meThrombus[meCurrentLesion] != -1 ) {
	getById('right', 'q11').style.display = 'block';
	getRadioInForm('right', 'formq11', 'question11')[meThrombus[meCurrentLesion]].checked = true;
    }
}

function loadExistingComment(){
    if( meThrombus[meCurrentLesion] != -1 ) {
        getById('right', 'comment').style.display = 'block';
        getById('right', 'thecomment').value = meComment[meCurrentLesion];
    }
}

function showSaveButton() {
    getById('right', 'savebutton').style.display = 'block';
}

function resetExistingFormGlobalVars(){
    formVarBlnQ12Enabled[meCurrentLesion] = false;
    formVarBlnSegmentVisualizedVisual[meCurrentLesion] = false;
    formVarBlnSkip5[meCurrentLesion] = false;
    formVarBlnSkip6[meCurrentLesion] = false;
    formVarBlnSkip6by5[meCurrentLesion] = false;
    formVarBlnSkip7[meCurrentLesion] = false;
    formVarIDSegmentTableFirstVisible[meCurrentLesion] = '';
    formVarIDSegmentTableLastVisible[meCurrentLesion] = '';
    formVarIDProxSegmentFirstVisible[meCurrentLesion] = '';
    formVarIDProxSegmentLastVisible[meCurrentLesion] = '';
    formVarBlnSaved[meCurrentLesion] = false;
    formVarBlnSegmentTableContainsElements[meCurrentLesion] = false;
    formVarDiffuseDiseaseScore[meCurrentLesion] = 0;
}

/** Function loads all questions in case a completed lesion
 *  has been selected for edit.
 */
function loadExistingFormValues() {

    // lesion has been found, load data and fill out form
    if( meCompletedLesions[meCurrentLesion] ) {
	loadExistingQuestion4();
	loadExistingQuestion5();
	loadExistingQuestion6();
	loadExistingQuestion7();
	loadExistingQuestion8();
	loadExistingQuestion9();
	loadExistingQuestion10();
        loadExistingQuestion11();
        loadExistingComment();
        showSaveButton();
    }
}

/** Function returns the lesion number of the last lesion
    (order of filling-out) that was completed.
 **/
function lookupLastCompletedLesion() {

    if( meCompletedLesions[0] == 0 )
	return 0;

    for( var i = 1; i < myDefaultArrayLength; i++ ) {
	if( meCompletedLesions[i] == 0 ) {
	    return i-1;
	}
    }

    return myDefaultArrayLength;
}

/** This function is based on the reset() function, and performs
    the same actions just for 1 lesion.
 **/
function resetAnswersForLesion(selectedLesion) {
    // diffuse disease is used by question 12 does not
    // need a reset.
    // resetDiffuseDiseaseArray();

    for( var i = 0; i < 25; i++ ){
	meSegmentsInvolved[i][selectedLesion] = 0;
     }

    for( var i = 0; i < 25; i++ ){
	meIndicateSegmentNumber[i][selectedLesion] = 0;
     }

    meCompletedLesions[selectedLesion] = 0;
    meScorePerLesion[selectedLesion] = 0;

    meTotalOcclusion[selectedLesion]=-1;
    meProximalSegmentNumber[selectedLesion]=-1;
    meAgeofTO[selectedLesion]=-1;
    meAgeofTOScore[selectedLesion]=0;
    meBluntStump[selectedLesion]=-1;
    meBluntStumpScore[selectedLesion]=0;
    meBridging[selectedLesion]=-1;
    meBridgingScore[selectedLesion]=0;
    meSideBranch[selectedLesion]=-1;
    meSideBranchScore[selectedLesion]=0;

    // question 5
    meSegments[selectedLesion]='Skipped';
    meVisualizedByMainSegment[selectedLesion]=-1;

    // question 6
    meTrifurcation[selectedLesion]=-1;
    meTrifurcationScore[selectedLesion]=0;
    meBifurcation[selectedLesion]='';
    meBifurcationScore[selectedLesion]=0;
    meBifurcationAngulation[selectedLesion]=-1;
    meBifurcationAngulationScore[selectedLesion]=0;

    // question 7
    meAortoOstialLesion[selectedLesion]==-1;
    meAortoOstialLesionScore[selectedLesion]=0;

    // question 8
    meSevereTortuosity[selectedLesion]=-1;
    meSevereTortuosityScore[selectedLesion]=0;

    // question 9
    meLength[selectedLesion]=-1;
    meLengthScore[selectedLesion]=0;

    // question 10
    meHeavyCalcification[selectedLesion]=-1;
    meHeavyCalcificationScore[selectedLesion]=0;

    // question 11
    meThrombus[selectedLesion]=-1;
    meThrombusScore[selectedLesion]=0;

    // comment
    meComment[selectedLesion]='';
    meTotalOcclusionScore[selectedLesion]=0;

    meVisualizedByContrastScore[selectedLesion]=0;
    meQ6Skipped[selectedLesion]=false;
    meQ7Skipped[selectedLesion]=false;

    // global form values (have been moved from form.js to here)
    formVarBlnQ12Enabled[selectedLesion] = false;
    formVarBlnSegmentVisualizedVisual[selectedLesion] = false;
    formVarBlnSkip5[selectedLesion] = false;
    formVarBlnSkip6[selectedLesion] = false;
    formVarBlnSkip6by5[selectedLesion] = false;
    formVarBlnSkip7[selectedLesion] = false;
    formVarIDSegmentTableFirstVisible[selectedLesion] = '';
    formVarIDSegmentTableLastVisible[selectedLesion] = '';
    formVarIDProxSegmentFirstVisible[selectedLesion] = '';
    formVarIDProxSegmentLastVisible[selectedLesion] = '';
    formVarBlnSaved[selectedLesion] = false;
    formVarBlnSegmentTableContainsElements[selectedLesion] = false;
    formVarDiffuseDiseaseScore[selectedLesion] = 0;
}







function PrintScore()
{

  // this function update blnCalculationDone when it is finished
  //setFrameUrl('right', 'scoreoverview.htm');
callHideShow('divSyntaxScoreOverView');
  // check if calculation finished
  while( !blnCalculationDone ) {
    // if not wait
    setTimeout(';', 1000);
  }

  // calculation finished we can print
  window.frames['right'].PrintScore();
}



//form.js
<!--

/******************************************************
 * Syntax Score Calculator Version 2.0                *
 *                                                    *
 * Orginal code (version 1.0): ISM (2005)             *
 * Adaptions    (version 2.0): Luc Strijbosch (2009)  *
 ******************************************************/

/*
 * Version 2.0: Changes to this file.
 *
 * - Some minor changes in the logic, for example to
 *   skip question 9 in case of a positive answer in
 *   question 4.
 *
 * - All global variables have been moved to the
 *   'parent' frameset.js and are saved per lesion, to
 *   not loose this information on reload/edit of a
 *   lesion.
 *
 * - Question 12 is taken out and moved to its own
 *   question12.js, because it is presented once after
 *   all lesions have been completed.
 */

//if (ApplicationEnded)
//{
    //no back allowed when application has ended
 //   gotoScoreOverview();
//}

if (meCurrentLesion<meNumberOfLesions)
{}
else
{
    //force score overview
    //gotoScoreOverview();
}

// the saved boolean has to be set to false on (re)load
formVarBlnSaved[meCurrentLesion] = false;

function resetQuestion(QNR,QSUB)
{
    if (QNR==4)
    {
	//0 alle 4x formulieren uit
	//1 alle 4x formulieren uit behalve 1
	if (QSUB==0)
	{
	    //page refresh!!
	    resetTotalOcclusionScore();

	}

	if (QSUB<1)
	{
	    if (isVisible('q4i'))
	    {
		resetForm('formq4i');
		ShowItem('q4i',false);
	    }

	    SetProximalSegmentNumber('');
	    formVarBlnSegmentVisualizedVisual[meCurrentLesion]=false;

	}

	if (QSUB<2)
	{
	    SetAgeOfTO(-1);

	    if (isVisible('q4ii'))
	    {
		resetForm('formq4ii');
		ShowItem('q4ii',false);
	    }
	}

	if (QSUB<3)
	{
	    SetBluntStump(-1);
	    if (isVisible('q4iii'))
	    {
		resetForm('formq4iii');
		ShowItem('q4iii',false);
	    }
	}

	if (QSUB<4)
	{
	    setBridging(-1);
	    if (isVisible('q4iv'))
	    {
		resetForm('formq4iv');
		ShowItem('q4iv',false);
	    }
	}

	if (QSUB<5)
	{
	    HideAllSegmentTables();
	    setVisualizedByContrast('Skipped');
	    resetVisualizedByContrastScore();
	    if (isVisible('q4v'))
	    {
		resetForm('formq4v');
		ShowItem('q4v',false);
	    }
	}

	if (QSUB<6)
	{
	    formVarBlnSkip5[meCurrentLesion] = false;
	    formVarBlnSkip6 [meCurrentLesion] = false;
	    formVarBlnSkip7[meCurrentLesion] = false;
	    setSideBranch(-1);
	    if (isVisible('q4vi'))
	    {
		resetForm('formq4vi');
		ShowItem('q4vi',false);
	    }
	}
    }

    if (QNR<5)
    {
	formVarBlnSkip6by5[meCurrentLesion] = false;
	SetTrifurcation(-1);
	if (isVisible('q5'))
	{
	    resetForm('formq5');
	    ShowItem('q5',false);
	}
	if (isVisible('q5yes'))
	{
	    resetForm('formq5yes');
	    ShowItem('q5yes',false);
	}
    }
    /* Ray */
    if (QNR==6)
    {

	if (QSUB<1)
	{
	    SetBifurcationAngulation(-1);
	    if (isVisible('q6yes1'))
	    {
		resetForm('formq6yes2');
	    }
	}
	if (QSUB<2)
	{
	    SetBifurcationAngulation(-1);
	    if (isVisible('q6yes2'))
	    {
		resetForm('formq6yes2');
		ShowItem('q6yes2',false);
	    }
	}
    }
    /* End - Ray */
    if (QNR<6)
    {
	SetBifurcation('');
	SetBifurcationAngulation(-1);
	if (isVisible('q6'))
	{
	    resetForm('formq6');
	    ShowItem('q6',false)
		}
	if (isVisible('q6yes1'))
	{
	    resetForm('formq6yes1');
	    ShowItem('q6yes1',false);
	}
	if (isVisible('q6yes2'))
	{
	    resetForm('formq6yes2');
	    ShowItem('q6yes2',false);
	}
    }

    if (QNR<7)
    {
	SetAortaOstialLesion(-1);
	if (isVisible('q7'))
	{
	    resetForm('formq7');
	    ShowItem('q7',false);
	}
    }

    if (QNR<8)
    {
	SetSevereTorTuosity(-1);
	if (isVisible('q8'))
	{
	    resetForm('formq8');
	    ShowItem('q8',false);
	}
    }

    if (QNR<9)
    {
	SetLength(-1);
	if (isVisible('q9'))
	{
	    resetForm('formq9');
	    ShowItem('q9',false);
	}
    }

    if (QNR<10)
    {
	SetHeavycalcification(-1);
	if (isVisible('q10'))
	{
	    resetForm('formq10');
	    ShowItem('q10',false);
	}
    }

    if (QNR<11)
    {
	SetThrombus(-1);
	if (isVisible('q11'))
	{
	    resetForm('formq11');
	    ShowItem('q11',false);
	}
    }

    if (QNR<12)
    {
	resetVesselScores();
	formVarDiffuseDiseaseScore[meCurrentLesion]=0;

	if (isVisible('q12'))
	{
	    resetForm('formq12');
	    ShowItem('q12',false);
	}

	if (isVisible('q12yes'))
	{
	    resetForm('formq12yes');
	    ShowItem('q12yes',false);
	}



	if (isVisible('comment'))
	{
	    resetForm('formcomment');
	    ShowItem('comment',false);
	    ShowItem('savebutton',false);
	}
    }

    //reset Q12 yes
    if ((QNR==12) && (QSUB==1) && (isVisible('q12yes')))
    {
	resetForm('formq12yes');
	ShowItem('q12yes',false);
	resetVesselScores();
	formVarDiffuseDiseaseScore[meCurrentLesion]=0;
    }

    //reset hide of this frame
    ShowItem('formmaintable',false);
    ShowItem('formmaintable',true);
}

function buildSegmentTable()
//dynamic table
{
    var debug = '';
    var label='';
    var number='';
    var showme='0';
    var currentLession=meCurrentLesion;
    var retStr='';

    for (var i = 0; i < meDiffuseTableArray.length; i++)
    {
      label=meDiffuseTableArray[i][0];
      if (label=='') {
	label='&nbsp;';
      };

      number=meDiffuseTableArray[i][1];
      showme=meDiffuseTableArray[i][2];

      if ((showme=='1') && (meSegmentsInvolved[i][currentLession]==1))
      {
	//formVarBlnSegmentTableContainsElements[meCurrentLesion]=true;
         setFormVarBlnSegmentTableContainsElements(meCurrentLesion);

	if (formVarIDSegmentTableFirstVisible[meCurrentLesion] == '' )
	{
	  formVarIDSegmentTableFirstVisible[meCurrentLesion]= 'dd' + i;
	}

	formVarIDSegmentTableLastVisible[meCurrentLesion]='dd'+i;
	
	retStr+='<tr><td style="width:50px; padding-left: 5px;">' + meDiffuseTableArray1stColumn[i] + '</td><td style="width:100px;text-align:center;">';
	retStr+=label;
	retStr+='</td><td style="width:100px;text-align:center;">';
	retStr+=number;
	retStr+='</td><td style="width:200px;text-align:center;">'
		       + '<input type="radio" ID="dd'+i+'" VALUE="' + i
		       + '" NAME="mostproxseg" onClick="Question4I(' + i + ',this);"></td></tr>';

	/** DEBUG
	 debug += '<tr><td style="width:100px;text-align:center;">' + label;
	 debug += '</td><td style="width:100px;text-align:center;">' + number;
	 debug += '</td><td style="width:200px;text-align:center;"><input type="checkbox" ID="dd'+i+'" VALUE="'+i+'" NAME="mostproxseg" onClick="Question4I('+i+',this)"></td></tr>';
	 **/
      }
    }

    //    alert( debug);
    /*
    if  (formVarBlnSegmentTableContainsElements[meCurrentLesion])
    {
      document.write('<tr><td colspan="3" class="buttontd"><input  type="submit" value="next" border="0" width="50" height="21" onClick="javascript:CheckQuestion4I();"></td></tr>');
    }
    */
   
   $('#divbuildSegmentTable').html(retStr);
}


function HideAllSegmentTables()
{
    var showme='0';
    var idLabel='';
    //header
    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
	showme=meSegmentVisualizedTableHelp[i][4];

	if (showme=='1')
	{

	    idLabel='q4vitable'+meSegmentVisualizedTableHelp[i][0];
	    ShowItem(idLabel,false);
	}
    }
}

function buildSegmentVisualizTableNew()
{
    var label='';
    var number='';
    var showme='0';
    var segment='0';
    var arrayStart;
    var arrayEnd;
    var showme2='0';
    var denylist='';
    var tmpteststring='';
    var retString='';

    //header

    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
	segment=meSegmentVisualizedTableHelp[i][0];
	showme=meSegmentVisualizedTableHelp[i][4];
	label=meSegmentVisualizedTableHelp[i][1];
	arrayStart=parseInt(meSegmentVisualizedTableHelp[i][2]);
	arrayEnd=parseInt(meSegmentVisualizedTableHelp[i][3]);
	denylist=meSegmentVisualizedTableHelp[i][5];

	if (showme=='1')
	{
	    nrOfItems=0;

	    retString+='<TABLE border="0" cellpadding="0" cellspacing="0" class="selecttable" ID="q4vitable'+meSegmentVisualizedTableHelp[i][0]+'" style="display:none; margin-top:5px;">';
	    retString+='<tr id="psnheader" ><td style="width:140px;text-align:center;">&nbsp;</td><td style="width:100px;text-align:center;">Segment<br>numbers:</td><td style="width:160px;text-align:center;">Segment<br>visualized by contrast:</td></tr>';

	    retString+='<tr id="psnnone"><td style="width:140px;text-align:center;">';
	    retString+='&nbsp;';
	    retString+='</td><td style="width:100px;text-align:center;">';
	    retString+='none';
	    retString+='</td><td style="width:160px;text-align:center;"><input type="radio" ID="ddsgmsnone'+segment+'" VALUE="none" NAME="firstseg" onClick="javascript:Question4SelectNone('+segment+');"></td></tr>';



	    for (var j = arrayStart;j <= arrayEnd; j++)
	    {
		number=meDiffuseTableArray[j][1];
		showme2=meDiffuseTableArray[j][2];

		if ((showme2=='1') && (denylist!=''))
		{
		    //check if not in deny list
  		    tmpteststring='|' + number + '|';
		    if (denylist.indexOf(tmpteststring)!=-1)
		    {
		        showme2='0';
		    }
		}

		if (showme2=='1')
		{
		    retString+='<tr id="psn'+i+'d'+j+'"><td style="width:140px;text-align:center;">';
		    retString+=label;
		    retString+='</td><td style="width:100px;text-align:center;">';
		    retString+=number;
		    retString+='</td><td style="width:160px;text-align:center;"><input type="radio" ID="ddsgms'+i+'d'+j+'" VALUE="'+i+j+'" NAME="firstseg" onClick="javascript:Question4V(' + String.fromCharCode(39) + number + String.fromCharCode(39) +','+segment+')"></td></tr>';
		    label='&nbsp;';
		}
	    }

	    retString+='</TABLE>';
	       
	}
    }
    
   $('#q4vitable').html(retString);
}

function CorrectProxSegmentTable()
{
    formVarBlnSegmentVisualizedVisual[meCurrentLesion]=true;
    var mostProx=getMostProximalSegmentNumber();
    var showme='0';

    for (var i = 0; i < meSegmentVisualizedTableHelp.length; i++)
    {
	if (meSegmentVisualizedTableHelp[i][0]==mostProx)
	{
	    showme=meSegmentVisualizedTableHelp[i][4];
	}
    }


    if (showme=='1')
    {
	var labelTable='q4vitable'+mostProx;
	ShowItem(labelTable,true);
	ShowItem('q4vitable',false);
	ShowItem('q4vitable',true);
	return true;
    }
    else
    {
	return false;
    }
}

function setFocus(id1,id2)
{
    window.scroll(0,1200);
}

function resetForm(id)
{
    document.getElementById(id).reset();

}

function ShowItem(id,show)
{
    if (show)
    {
//	document.getElementById(id).style.display='block';
	$("#"+id).show();
    }
    else
    {
//	document.getElementById(id).style.display='none';
	$("#"+id).hide();
    }

}


function isVisible(id)
{
    if (document.getElementById(id).style.display=='block')
    {
	return true
	    }
    return false
	}

function Question4SelectNone(segment)
{
    setVisualizedByMainSegment(segment);
    setVisualizedByContrast('none');
    ShowQuestion4VI();
    $('#L').html($("#q4branch").html());
    
}


function Question4(show,me)
{
    //set totalOccliion and reset form
    resetQuestion(4,0);
    SetTotalOcclusion(me.value);

    if (show)
    {
	//YES
	if (formVarBlnSegmentTableContainsElements[meCurrentLesion])
	{
	    ShowItem('q4i',true);
	    setFocus(formVarIDSegmentTableFirstVisible[meCurrentLesion],formVarIDSegmentTableLastVisible[meCurrentLesion]);
	}
	else
	{
	    ShowQuestion4II();
	}
	//ShowItem('afterfour',false);
	//reset score for q5 and on!!!!
    }
    else
    {
    	ShowItem('q4i',false);
    	ShowItem('q4ii',false);
    	ShowItem('q4iii',false);
    	ShowItem('q4iv',false);
    	ShowItem('q4v',false);
    	ShowItem('q4vi',false);
	ShowQ5();
    }
}

function Question4I(number,me)
{
    resetQuestion(4,1);
    resetTotalOcclusionScore();
    SetIndicateSegmentNumber(number,me);
    ShowQuestion4II();
}

function ShowQuestion4II()
{
    ShowItem('q4ii',true);
    setFocus('q4iir1','q4iir3');
}

function Question4II(number)
{
    resetQuestion(4,2);

    SetAgeOfTO(number);
    ShowItem('q4iii',true);
    setFocus('q4iiir1','q4iiir2');
    //reload left frame
  //  setFrameUrl('left','diagramblunt.htm');
 // alert($("#q4iiPage").html());
   $('#L').html($("#q4iiPage").html());
}

function Question4III(number)
{
    resetQuestion(4,3);
    SetBluntStump(number);
    ShowItem('q4iv',true);
    setFocus('q4ivr1','q4ivr2');
   // setFrameUrl('left','diagrambridging.htm');
   $('#L').html($("#q4iiiPage").html());
}

/* number = segment with contrast, segment = most proximal segment
 * of total occlusion
 */
function Question4V(number,segment)
{
    resetQuestion(4,5);
    setVisualizedByMainSegment(segment);
    setVisualizedByContrast(number);

    ShowQuestion4VI();
    $('#L').html($("#q4branch").html());
}

function Question4IV(number)
{
    resetQuestion(4,4);
    setBridging(number);

    if ((formVarBlnSegmentTableContainsElements[meCurrentLesion]) && (CorrectProxSegmentTable()))
    {
	ShowItem('q4v',true);
	//CorrectProxSegmentTable();
	//setFrameUrl('left','overview.htm');
	setFocus('','');
    }
    else
    {
	Question4V('Skipped','-1');
    }

   $('#L').html($("#leftleisionpage").html());
    //setFrameUrl('left','overview.htm');
      ShowDominance();
      buildTable();
}

function Question4VI(number)
{
    resetQuestion(4,6);
    setSideBranch(number);

    //skip questoon 6 and 7 if 2 is the answer on this question
    if ((number==0) || (number==1))
    {
	formVarBlnSkip5[meCurrentLesion] = true;
	formVarBlnSkip6 [meCurrentLesion] = true;
	//formVarBlnSkip7[meCurrentLesion] = true;
    }
    else
    {
	formVarBlnSkip5[meCurrentLesion] = false;
	formVarBlnSkip6 [meCurrentLesion] = false;
	//formVarBlnSkip7[meCurrentLesion] = false;
    }
    ShowQ5();
    $('#L').html($("#leftleisionpage").html());
      ShowDominance();
      buildTable();
}

function ShowQuestion4VI()
{
  //  setFrameUrl('left','diagramsidebranch.htm');
    ShowItem('q4vi',true);
    setFocus('q4vir1','q4vir3');
}


function Question5(number)
{
    resetQuestion(5,0);
    SetTrifurcation(number);
    ShowQ6();
$('#L').html($("#leftleisionpage").html());
    //setFrameUrl('left','overview.htm');
      ShowDominance();
      buildTable();
    //0 is nothing
    //1 i
    //2 ii
    //3 iii
    //4 iV
}

function ShowQ5Yes()
{
    resetQuestion(5,1);

    formVarBlnSkip6by5[meCurrentLesion] = true;

    //reset values!!!!! recalculate!!!
    resetForm('formq6');
    ShowItem('q6',false);
    resetForm('formq6yes1');
    ShowItem('q6yes1',false);
    resetForm('formq6yes2');
    ShowItem('q6yes2',false);

    var forcedanswer=getForcedTrifurcationAnswer();

    if (forcedanswer)
    {
	//answer is 1
	Question5(1);
	//goto 6
	ShowQ6();

    }
    else
    {
	//setFrameUrl('left','overview.htm');

	ShowItem('q5yes',true);
	setFocus('q5r2y1','q5r2y4');
    }
}

function ShowQ5No()
{
    resetQuestion(5,1);
    formVarBlnSkip6by5[meCurrentLesion] = false;
  //  setFrameUrl('left','overview.htm');
    resetForm('formq5yes');
    ShowItem('q5yes',false);
    Question5(0);


}


function ShowQ5()
{

    if (formVarBlnSkip5[meCurrentLesion])
    {
	ShowQ6();
    }
    else
    {
	resetQuestion(5,0);
//	setFrameUrl('left','overview.htm')
	    ShowItem('q5',true);
	//setFocus('q5r1','q5r2');
    }

}

function ShowQ6()
{
    resetQuestion(6,0);
    if ((formVarBlnSkip6 [meCurrentLesion]) || (formVarBlnSkip6by5[meCurrentLesion]))
    {
	ShowQ7();
    }
    else
    {
	ShowItem('q6',true);
	setFocus('q6r1','q6r2');
    }
}

function Question6No()
{
    //hide
    resetQuestion(6,0);
    SetBifurcation('');

    resetForm('formq6yes1');

    ShowItem('q6yes1',false);

    resetForm('formq6yes2');
    ShowItem('q6yes2',false);
   // setFrameUrl('left','overview.htm');

    ShowQ7();
}

function Question6Yes(part)
{
    resetQuestion(6,0);
    if (part=='1')
    {
	ShowItem('q6yes1',true);
	setFocus('q6r2yp1x1','q6r2yp1x7');
 //       setFrameUrl('left','diagramabcdefg.htm');
    }

    if (part=='2')
    {
//	setFrameUrl('left','diagramangu.htm')
	ShowItem('q6yes2',true);
	setFocus('q6r2yp2x1','q6r2yp2x2');
    }
}

function Question6P1(Answerchar)
{
    resetQuestion(6,1);
    SetBifurcation(Answerchar);
    Question6Yes('2');
}

function Question6P2(number)
{
    resetQuestion(6,2);
    SetBifurcationAngulation(number);
    ShowQ7();
}

function ShowQ7()
{
    resetQuestion(7,0);
   // setFrameUrl('left','overview.htm');
    var blnEnabled=Question7Enabled();

    if (formVarBlnSkip7[meCurrentLesion])
    {
	blnEnabled=false;
    }
    if (blnEnabled)
    {
	ShowItem('q7',true);
	setFocus('q7r1','q7r2');
    }
    else
    {
	Question7(0);
	resetForm('formq7');
	ShowItem('q7',false);
	//reset score //reset form //
	ShowQ8();
    }
}

function Question7(number)
{
    resetQuestion(7,0);
    SetAortaOstialLesion(number);
    ShowQ8();
}

function ShowQ8()
{
    resetQuestion(8,0);
    ShowItem('q8',true);
    setFocus('q8r1','q8r2');
}

function Question8(number)
{
    resetQuestion(8,0);
    SetSevereTorTuosity(number);
    ShowQ9();
}

function ShowQ9()
{
  if( meTotalOcclusion[meCurrentLesion] &&
      meTotalOcclusion[meCurrentLesion] > 0 ) {
      // skip q9 in case q4 was true, reset, do not assign anything
      // and go to 10
      resetQuestion(9,0);
      ShowQ10();
  }
  else {
      resetQuestion(9,0);
      ShowItem('q9',true);
      setFocus('q9r1','q9r2');
  }
}

function Question9(number)
{
    resetQuestion(9,0);
    SetLength(number);
    ShowQ10();
}

function ShowQ10()
{
    resetQuestion(10,0);
    ShowItem('q10',true);
    setFocus('q10r1','q10r2');
}


function Question10(number)
{
    resetQuestion(10,0);
    SetHeavycalcification(number);
    ShowQ11();
}

function ShowQ11()
{
    resetQuestion(11,0);
    ShowItem('q11',true);
    setFocus('q11r1','q11r2');
}

function Question11(number)
{
    resetQuestion(11,0);
    SetThrombus(number);
    checkQ12();
}

function checkQ12()
{
    // disable question 12 here, because it will be
    // presented once all lesions have been filled
    // out.
    formVarBlnQ12Enabled[meCurrentLesion] = false;
    //FIND OUT IF Q12 to be shown or not and correct the table
    if (formVarBlnQ12Enabled[meCurrentLesion])
    {
	ShowItem('q12',true);
	setFocus('','');
    }
    else
    {
	ShowItem('comment',true);
	ShowItem('savebutton',true);
    }
    setFocus('','');
}



function Save()
{
    //enabled save once (dblclick!!)

    if (formVarBlnSaved[meCurrentLesion])
    {
    	callHideShow('divSyntaxScoreProcess');
    }
    else
    {
	formVarBlnSaved[meCurrentLesion]=true;

	if ((formVarBlnSkip6 [meCurrentLesion]) || (formVarBlnSkip6by5[meCurrentLesion]))
	{
	    setQ6Skipped(true);
	}
	else
	{
	    setQ6Skipped(false);
	}


	var blnEnabled=Question7Enabled();

	if (formVarBlnSkip7[meCurrentLesion])
	{
	    blnEnabled=false;
	}

	if (blnEnabled)
	{
	    setQ7Skipped(false);
	}
	else
	{
	    setQ7Skipped(true);
	}

	//read comment
	SetComment(document.getElementById('thecomment').value);

	// set current lesion as completed
	meCompletedLesions[meCurrentLesion] = 1;

	// and navigate to menu
	//setFrameUrl('left', 'overview.htm');
	//setFrameUrl('right','menu.htm');
	callHideShow('divSyntaxScoreProcess');
    }
}



function buildDiffuseSegmentTable()
//dynamic table
{
    formVarBlnQ12Enabled[meCurrentLesion]=false;
  //  alert('0:'+blnInitCalled);
    var retStr="";
    retStr+='<tr>';
     retStr+='<td style="width:190px;text-align:center;">&nbsp;</td>';
     retStr+='<td style="width:80px;text-align:center;">Segment<br>numbers:</td>';
     retStr+='<td style="width:200px;text-align:center;">"Diffuse disease"/small vessels.<br><div style="font-size:10px;">(Present when at least 75% of the length of any segment(s) proximal to the lesion, at the site of the lesion or distal to the lesion has a vessel diameter of less than 2mm)</div></td>';
     retStr+='</tr>';
                                                                                                
    if (blnInitCalled || 1==1)
    {
	var iStart;
	var iEnd;
	

	if (showVessel(1))
	{
	    retStr+= buildDiffuseSegmentTableRows(0,7);
	}
	if (showVessel(2))
	{
	  retStr+=  buildDiffuseSegmentTableRows(8,8);
	}
	if (showVessel(3))
	{
	 retStr+=    buildDiffuseSegmentTableRows(9,15);
	}
	if (showVessel(4))
	{
	   retStr+=  buildDiffuseSegmentTableRows(16,24);
	}
	return retStr;
    }
    //	return '2:'+blnInitCalled;
}



function saveDiffuseSegment()
{
    if (formVarDiffuseDiseaseScore[meCurrentLesion]!=0)
    {
	//show comment
	ShowItem('comment',true);
	ShowItem('savebutton',true);
	setFocus('','');

    }
    else
    {
	alert('Select at least one segment');
    }
}

function buildDiffuseSegmentTableRows(iStart,iEnd)
{
    var label='';
    var number='';
    var showme='0';
    
    var retStr="";


    for (var i = iStart; i <=iEnd; i++)
    {
	label=meDiffuseTableArray[i][0];
	if (label=='') {label='&nbsp;'};
	number=meDiffuseTableArray[i][1];
	showme=meDiffuseTableArray[i][2];
	if (showme=='1')
	{
	    formVarBlnQ12Enabled[meCurrentLesion]=true;
	    retStr+='<tr><td style="width:100px;text-align:center;">';
	    retStr+=label;
	    retStr+='</td><td style="width:100px;text-align:center;">';
	    retStr+=number;
	    retStr+='</td><td style="width:200px;text-align:center;"><input type="checkbox" ID="ww'+i+'" VALUE="1" NAME="dd'+i+'" onClick="setDiffuseDisease('+i+',this)"></td></tr>';
	}
    }
    
    return retStr;
}

//-->

//overlib.js
//\/////
//\  overLIB 4.21 - You may not remove or change this notice.
//\  Copyright Erik Bosrup 1998-2004. All rights reserved.
//\
//\  Contributors are listed on the homepage.
//\  This file might be old, always check for the latest version at:
//\  http://www.bosrup.com/web/overlib/
//\
//\  Please read the license agreement (available through the link above)
//\  before using overLIB. Direct any licensing questions to erik@bosrup.com.
//\
//\  Do not sell this as your own work or remove this copyright notice. 
//\  For full details on copying or changing this script please read the
//\  license agreement at the link above. Please give credit on sites that
//\  use overLIB and submit changes of the script so other people can use
//\  them as well.
//   $Revision: 1.119 $                $Date: 2005/07/02 23:41:44 $
//\/////
//\mini

////////
// PRE-INIT
// Ignore these lines, configuration is below.
////////
var olLoaded = 0;var pmStart = 10000000; var pmUpper = 10001000; var pmCount = pmStart+1; var pmt=''; var pms = new Array(); var olInfo = new Info('4.21', 1);
var FREPLACE = 0; var FBEFORE = 1; var FAFTER = 2; var FALTERNATE = 3; var FCHAIN=4;
var olHideForm=0;  // parameter for hiding SELECT and ActiveX elements in IE5.5+ 
var olHautoFlag = 0;  // flags for over-riding VAUTO and HAUTO if corresponding
var olVautoFlag = 0;  // positioning commands are used on the command line
var hookPts = new Array(), postParse = new Array(), cmdLine = new Array(), runTime = new Array();
// for plugins
registerCommands('donothing,inarray,caparray,sticky,background,noclose,caption,left,right,center,offsetx,offsety,fgcolor,bgcolor,textcolor,capcolor,closecolor,width,border,cellpad,status,autostatus,autostatuscap,height,closetext,snapx,snapy,fixx,fixy,relx,rely,fgbackground,bgbackground,padx,pady,fullhtml,above,below,capicon,textfont,captionfont,closefont,textsize,captionsize,closesize,timeout,function,delay,hauto,vauto,closeclick,wrap,followmouse,mouseoff,closetitle,cssoff,compatmode,cssclass,fgclass,bgclass,textfontclass,captionfontclass,closefontclass');

////////
// DEFAULT CONFIGURATION
// Settings you want everywhere are set here. All of this can also be
// changed on your html page or through an overLIB call.
////////
if (typeof ol_fgcolor=='undefined') var ol_fgcolor="#F1F1FF";
if (typeof ol_bgcolor=='undefined') var ol_bgcolor="#333366";
if (typeof ol_textcolor=='undefined') var ol_textcolor="#000000";
if (typeof ol_capcolor=='undefined') var ol_capcolor="#FFFFFF";
if (typeof ol_closecolor=='undefined') var ol_closecolor="#9999FF";
if (typeof ol_textfont=='undefined') var ol_textfont="Verdana,Arial,Helvetica";
if (typeof ol_captionfont=='undefined') var ol_captionfont="Verdana,Arial,Helvetica";
if (typeof ol_closefont=='undefined') var ol_closefont="Verdana,Arial,Helvetica";
if (typeof ol_textsize=='undefined') var ol_textsize="1";
if (typeof ol_captionsize=='undefined') var ol_captionsize="1";
if (typeof ol_closesize=='undefined') var ol_closesize="1";
if (typeof ol_width=='undefined') var ol_width="200";
if (typeof ol_border=='undefined') var ol_border="1";
if (typeof ol_cellpad=='undefined') var ol_cellpad=2;
if (typeof ol_offsetx=='undefined') var ol_offsetx=10;
if (typeof ol_offsety=='undefined') var ol_offsety=10;
if (typeof ol_text=='undefined') var ol_text="Default Text";
if (typeof ol_cap=='undefined') var ol_cap="";
if (typeof ol_sticky=='undefined') var ol_sticky=0;
if (typeof ol_background=='undefined') var ol_background="";
if (typeof ol_close=='undefined') var ol_close="Close";
if (typeof ol_hpos=='undefined') var ol_hpos=RIGHT;
if (typeof ol_status=='undefined') var ol_status="";
if (typeof ol_autostatus=='undefined') var ol_autostatus=0;
if (typeof ol_height=='undefined') var ol_height=-1;
if (typeof ol_snapx=='undefined') var ol_snapx=0;
if (typeof ol_snapy=='undefined') var ol_snapy=0;
if (typeof ol_fixx=='undefined') var ol_fixx=-1;
if (typeof ol_fixy=='undefined') var ol_fixy=-1;
if (typeof ol_relx=='undefined') var ol_relx=null;
if (typeof ol_rely=='undefined') var ol_rely=null;
if (typeof ol_fgbackground=='undefined') var ol_fgbackground="";
if (typeof ol_bgbackground=='undefined') var ol_bgbackground="";
if (typeof ol_padxl=='undefined') var ol_padxl=1;
if (typeof ol_padxr=='undefined') var ol_padxr=1;
if (typeof ol_padyt=='undefined') var ol_padyt=1;
if (typeof ol_padyb=='undefined') var ol_padyb=1;
if (typeof ol_fullhtml=='undefined') var ol_fullhtml=0;
if (typeof ol_vpos=='undefined') var ol_vpos=BELOW;
if (typeof ol_aboveheight=='undefined') var ol_aboveheight=0;
if (typeof ol_capicon=='undefined') var ol_capicon="";
if (typeof ol_frame=='undefined') var ol_frame=self;
if (typeof ol_timeout=='undefined') var ol_timeout=0;
if (typeof ol_function=='undefined') var ol_function=null;
if (typeof ol_delay=='undefined') var ol_delay=0;
if (typeof ol_hauto=='undefined') var ol_hauto=0;
if (typeof ol_vauto=='undefined') var ol_vauto=0;
if (typeof ol_closeclick=='undefined') var ol_closeclick=0;
if (typeof ol_wrap=='undefined') var ol_wrap=0;
if (typeof ol_followmouse=='undefined') var ol_followmouse=1;
if (typeof ol_mouseoff=='undefined') var ol_mouseoff=0;
if (typeof ol_closetitle=='undefined') var ol_closetitle='Close';
if (typeof ol_compatmode=='undefined') var ol_compatmode=0;
if (typeof ol_css=='undefined') var ol_css=CSSOFF;
if (typeof ol_fgclass=='undefined') var ol_fgclass="";
if (typeof ol_bgclass=='undefined') var ol_bgclass="";
if (typeof ol_textfontclass=='undefined') var ol_textfontclass="";
if (typeof ol_captionfontclass=='undefined') var ol_captionfontclass="";
if (typeof ol_closefontclass=='undefined') var ol_closefontclass="";

////////
// ARRAY CONFIGURATION
////////

// You can use these arrays to store popup text here instead of in the html.
if (typeof ol_texts=='undefined') var ol_texts = new Array("Text 0", "Text 1");
if (typeof ol_caps=='undefined') var ol_caps = new Array("Caption 0", "Caption 1");

////////
// END OF CONFIGURATION
// Don't change anything below this line, all configuration is above.
////////





////////
// INIT
////////
// Runtime variables init. Don't change for config!
var o3_text="";
var o3_cap="";
var o3_sticky=0;
var o3_background="";
var o3_close="Close";
var o3_hpos=RIGHT;
var o3_offsetx=2;
var o3_offsety=2;
var o3_fgcolor="";
var o3_bgcolor="";
var o3_textcolor="";
var o3_capcolor="";
var o3_closecolor="";
var o3_width=100;
var o3_border=1;
var o3_cellpad=2;
var o3_status="";
var o3_autostatus=0;
var o3_height=-1;
var o3_snapx=0;
var o3_snapy=0;
var o3_fixx=-1;
var o3_fixy=-1;
var o3_relx=null;
var o3_rely=null;
var o3_fgbackground="";
var o3_bgbackground="";
var o3_padxl=0;
var o3_padxr=0;
var o3_padyt=0;
var o3_padyb=0;
var o3_fullhtml=0;
var o3_vpos=BELOW;
var o3_aboveheight=0;
var o3_capicon="";
var o3_textfont="Verdana,Arial,Helvetica";
var o3_captionfont="Verdana,Arial,Helvetica";
var o3_closefont="Verdana,Arial,Helvetica";
var o3_textsize="1";
var o3_captionsize="1";
var o3_closesize="1";
var o3_frame=self;
var o3_timeout=0;
var o3_timerid=0;
var o3_allowmove=0;
var o3_function=null; 
var o3_delay=0;
var o3_delayid=0;
var o3_hauto=0;
var o3_vauto=0;
var o3_closeclick=0;
var o3_wrap=0;
var o3_followmouse=1;
var o3_mouseoff=0;
var o3_closetitle='';
var o3_compatmode=0;
var o3_css=CSSOFF;
var o3_fgclass="";
var o3_bgclass="";
var o3_textfontclass="";
var o3_captionfontclass="";
var o3_closefontclass="";

// Display state variables
var o3_x = 0;
var o3_y = 0;
var o3_showingsticky = 0;
var o3_removecounter = 0;

// Our layer
var over = null;
var fnRef, hoveringSwitch = false;
var olHideDelay;

// Decide browser version
var isMac = (navigator.userAgent.indexOf("Mac") != -1);
var olOp = (navigator.userAgent.toLowerCase().indexOf('opera') > -1 && document.createTextNode);  // Opera 7
var olNs4 = (navigator.appName=='Netscape' && parseInt(navigator.appVersion) == 4);
var olNs6 = (document.getElementById) ? true : false;
var olKq = (olNs6 && /konqueror/i.test(navigator.userAgent));
var olIe4 = (document.all) ? true : false;
var olIe5 = false; 
var olIe55 = false; // Added additional variable to identify IE5.5+
var docRoot = 'document.body';

// Resize fix for NS4.x to keep track of layer
if (olNs4) {
	var oW = window.innerWidth;
	var oH = window.innerHeight;
	window.onresize = function() { if (oW != window.innerWidth || oH != window.innerHeight) location.reload(); }
}

// Microsoft Stupidity Check(tm).
if (olIe4) {
	var agent = navigator.userAgent;
	if (/MSIE/.test(agent)) {
		var versNum = parseFloat(agent.match(/MSIE[ ](\d\.\d+)\.*/i)[1]);
		if (versNum >= 5){
			olIe5=true;
			olIe55=(versNum>=5.5&&!olOp) ? true : false;
			if (olNs6) olNs6=false;
		}
	}
	if (olNs6) olIe4 = false;
}

// Check for compatability mode.
if (document.compatMode && document.compatMode == 'CSS1Compat') {
	docRoot= ((olIe4 && !olOp) ? 'document.documentElement' : docRoot);
}

// Add window onload handlers to indicate when all modules have been loaded
// For Netscape 6+ and Mozilla, uses addEventListener method on the window object
// For IE it uses the attachEvent method of the window object and for Netscape 4.x
// it sets the window.onload handler to the OLonload_handler function for Bubbling
if(window.addEventListener) window.addEventListener("load",OLonLoad_handler,false);
else if (window.attachEvent) window.attachEvent("onload",OLonLoad_handler);

var capExtent;

////////
// PUBLIC FUNCTIONS
////////

// overlib(arg0,...,argN)
// Loads parameters into global runtime variables.
function overlib() {
	if (!olLoaded || isExclusive(overlib.arguments)) {
		
		return true;
	}
	if (olCheckMouseCapture) {
		olMouseCapture();
	}
	if (over) {
		over = (typeof over.id != 'string') ? o3_frame.document.all['overDiv'] : over;
		cClick();
	}

	// Load defaults to runtime.
  olHideDelay=0;
	o3_text=ol_text;
	o3_cap=ol_cap;
	o3_sticky=ol_sticky;
	o3_background=ol_background;
	o3_close=ol_close;
	o3_hpos=ol_hpos;
	o3_offsetx=ol_offsetx;
	o3_offsety=ol_offsety;
	o3_fgcolor=ol_fgcolor;
	o3_bgcolor=ol_bgcolor;
	o3_textcolor=ol_textcolor;
	o3_capcolor=ol_capcolor;
	o3_closecolor=ol_closecolor;
	o3_width=ol_width;
	o3_border=ol_border;
	o3_cellpad=ol_cellpad;
	o3_status=ol_status;
	o3_autostatus=ol_autostatus;
	o3_height=ol_height;
	o3_snapx=ol_snapx;
	o3_snapy=ol_snapy;
	o3_fixx=ol_fixx;
	o3_fixy=ol_fixy;
	o3_relx=ol_relx;
	o3_rely=ol_rely;
	o3_fgbackground=ol_fgbackground;
	o3_bgbackground=ol_bgbackground;
	o3_padxl=ol_padxl;
	o3_padxr=ol_padxr;
	o3_padyt=ol_padyt;
	o3_padyb=ol_padyb;
	o3_fullhtml=ol_fullhtml;
	o3_vpos=ol_vpos;
	o3_aboveheight=ol_aboveheight;
	o3_capicon=ol_capicon;
	o3_textfont=ol_textfont;
	o3_captionfont=ol_captionfont;
	o3_closefont=ol_closefont;
	o3_textsize=ol_textsize;
	o3_captionsize=ol_captionsize;
	o3_closesize=ol_closesize;
	o3_timeout=ol_timeout;
	o3_function=ol_function;
	o3_delay=ol_delay;
	o3_hauto=ol_hauto;
	o3_vauto=ol_vauto;
	o3_closeclick=ol_closeclick;
	o3_wrap=ol_wrap;	
	o3_followmouse=ol_followmouse;
	o3_mouseoff=ol_mouseoff;
	o3_closetitle=ol_closetitle;
	o3_css=ol_css;
	o3_compatmode=ol_compatmode;
	o3_fgclass=ol_fgclass;
	o3_bgclass=ol_bgclass;
	o3_textfontclass=ol_textfontclass;
	o3_captionfontclass=ol_captionfontclass;
	o3_closefontclass=ol_closefontclass;
	//	alert('4');
	setRunTimeVariables();
	
	fnRef = '';
	
	// Special for frame support, over must be reset...
	o3_frame = ol_frame;
	
	if(!(over=createDivContainer())) return false;

	parseTokens('o3_', overlib.arguments);
	if (!postParseChecks()) return false;

	if (o3_delay == 0) {
		return runHook("olMain", FREPLACE);
 	} else {
		o3_delayid = setTimeout("runHook('olMain', FREPLACE)", o3_delay);
		return false;
	}
}

// Clears popups if appropriate
function nd(time) {
	if (olLoaded && !isExclusive()) {
		hideDelay(time);  // delay popup close if time specified

		if (o3_removecounter >= 1) { o3_showingsticky = 0 };
		
		if (o3_showingsticky == 0) {
			o3_allowmove = 0;
			if (over != null && o3_timerid == 0) runHook("hideObject", FREPLACE, over);
		} else {
			o3_removecounter++;
		}
	}
	
	return true;
}

// The Close onMouseOver function for stickies
function cClick() {
	if (olLoaded) {
		runHook("hideObject", FREPLACE, over);
		o3_showingsticky = 0;	
	}	
	return false;
}

// Method for setting page specific defaults.
function overlib_pagedefaults() {
	parseTokens('ol_', overlib_pagedefaults.arguments);
}


////////
// OVERLIB MAIN FUNCTION
////////

// This function decides what it is we want to display and how we want it done.
function olMain() {
	var layerhtml, styleType;
 	runHook("olMain", FBEFORE);
 	
	if (o3_background!="" || o3_fullhtml) {
		// Use background instead of box.
		layerhtml = runHook('ol_content_background', FALTERNATE, o3_css, o3_text, o3_background, o3_fullhtml);
	} else {
		// They want a popup box.
		styleType = (pms[o3_css-1-pmStart] == "cssoff" || pms[o3_css-1-pmStart] == "cssclass");

		// Prepare popup background
		if (o3_fgbackground != "") o3_fgbackground = "background=\""+o3_fgbackground+"\"";
		if (o3_bgbackground != "") o3_bgbackground = (styleType ? "background=\""+o3_bgbackground+"\"" : o3_bgbackground);

		// Prepare popup colors
		if (o3_fgcolor != "") o3_fgcolor = (styleType ? "bgcolor=\""+o3_fgcolor+"\"" : o3_fgcolor);
		if (o3_bgcolor != "") o3_bgcolor = (styleType ? "bgcolor=\""+o3_bgcolor+"\"" : o3_bgcolor);

		// Prepare popup height
		if (o3_height > 0) o3_height = (styleType ? "height=\""+o3_height+"\"" : o3_height);
		else o3_height = "";

		// Decide which kinda box.
		if (o3_cap=="") {
			// Plain
			layerhtml = runHook('ol_content_simple', FALTERNATE, o3_css, o3_text);
		} else {
			// With caption
			if (o3_sticky) {
				// Show close text
				layerhtml = runHook('ol_content_caption', FALTERNATE, o3_css, o3_text, o3_cap, o3_close);
			} else {
				// No close text
				layerhtml = runHook('ol_content_caption', FALTERNATE, o3_css, o3_text, o3_cap, "");
			}
		}
	}	

	// We want it to stick!
	if (o3_sticky) {
		if (o3_timerid > 0) {
			clearTimeout(o3_timerid);
			o3_timerid = 0;
		}
		o3_showingsticky = 1;
		o3_removecounter = 0;
	}

	// Created a separate routine to generate the popup to make it easier
	// to implement a plugin capability
	if (!runHook("createPopup", FREPLACE, layerhtml)) return false;

	// Prepare status bar
	if (o3_autostatus > 0) {
		o3_status = o3_text;
		if (o3_autostatus > 1) o3_status = o3_cap;
	}

	// When placing the layer the first time, even stickies may be moved.
	o3_allowmove = 0;

	// Initiate a timer for timeout
	if (o3_timeout > 0) {          
		if (o3_timerid > 0) clearTimeout(o3_timerid);
		o3_timerid = setTimeout("cClick()", o3_timeout);
	}

	// Show layer
	runHook("disp", FREPLACE, o3_status);
	runHook("olMain", FAFTER);

	return (olOp && event && event.type == 'mouseover' && !o3_status) ? '' : (o3_status != '');
}

////////
// LAYER GENERATION FUNCTIONS
////////
// These functions just handle popup content with tags that should adhere to the W3C standards specification.

// Makes simple table without caption
function ol_content_simple(text) {
	var cpIsMultiple = /,/.test(o3_cellpad);
	var txt = '<table width="'+o3_width+ '" border="0" cellpadding="'+o3_border+'" cellspacing="0" '+(o3_bgclass ? 'class="'+o3_bgclass+'"' : o3_bgcolor+' '+o3_height)+'><tr><td><table width="100%" border="0" '+((olNs4||!cpIsMultiple) ? 'cellpadding="'+o3_cellpad+'" ' : '')+'cellspacing="0" '+(o3_fgclass ? 'class="'+o3_fgclass+'"' : o3_fgcolor+' '+o3_fgbackground+' '+o3_height)+'><tr><td valign="TOP"'+(o3_textfontclass ? ' class="'+o3_textfontclass+'">' : ((!olNs4&&cpIsMultiple) ? ' style="'+setCellPadStr(o3_cellpad)+'">' : '>'))+(o3_textfontclass ? '' : wrapStr(0,o3_textsize,'text'))+text+(o3_textfontclass ? '' : wrapStr(1,o3_textsize))+'</td></tr></table></td></tr></table>';

	set_background("");
	return txt;
}

// Makes table with caption and optional close link
function ol_content_caption(text,title,close) {
	var nameId, txt, cpIsMultiple = /,/.test(o3_cellpad);
	var closing, closeevent;

	closing = "";
	closeevent = "onmouseover";
	if (o3_closeclick == 1) closeevent = (o3_closetitle ? "title='" + o3_closetitle +"'" : "") + " onclick";
	if (o3_capicon != "") {
	  nameId = ' hspace = \"5\"'+' align = \"middle\" alt = \"\"';
	  if (typeof o3_dragimg != 'undefined' && o3_dragimg) nameId =' hspace=\"5\"'+' name=\"'+o3_dragimg+'\" id=\"'+o3_dragimg+'\" align=\"middle\" alt=\"Drag Enabled\" title=\"Drag Enabled\"';
	  o3_capicon = '<img src=\"'+o3_capicon+'\"'+nameId+' />';
	}

	if (close != "")
		closing = '<td '+(!o3_compatmode && o3_closefontclass ? 'class="'+o3_closefontclass : 'align="RIGHT')+'"><a href="javascript:return '+fnRef+'cClick();"'+((o3_compatmode && o3_closefontclass) ? ' class="' + o3_closefontclass + '" ' : ' ')+closeevent+'="return '+fnRef+'cClick();">'+(o3_closefontclass ? '' : wrapStr(0,o3_closesize,'close'))+close+(o3_closefontclass ? '' : wrapStr(1,o3_closesize,'close'))+'</a></td>';
	txt = '<table width="'+o3_width+ '" border="0" cellpadding="'+o3_border+'" cellspacing="0" '+(o3_bgclass ? 'class="'+o3_bgclass+'"' : o3_bgcolor+' '+o3_bgbackground+' '+o3_height)+'><tr><td><table width="100%" border="0" cellpadding="2" cellspacing="0"><tr><td'+(o3_captionfontclass ? ' class="'+o3_captionfontclass+'">' : '>')+(o3_captionfontclass ? '' : '<b>'+wrapStr(0,o3_captionsize,'caption'))+o3_capicon+title+(o3_captionfontclass ? '' : wrapStr(1,o3_captionsize)+'</b>')+'</td>'+closing+'</tr></table><table width="100%" border="0" '+((olNs4||!cpIsMultiple) ? 'cellpadding="'+o3_cellpad+'" ' : '')+'cellspacing="0" '+(o3_fgclass ? 'class="'+o3_fgclass+'"' : o3_fgcolor+' '+o3_fgbackground+' '+o3_height)+'><tr><td valign="TOP"'+(o3_textfontclass ? ' class="'+o3_textfontclass+'">' :((!olNs4&&cpIsMultiple) ? ' style="'+setCellPadStr(o3_cellpad)+'">' : '>'))+(o3_textfontclass ? '' : wrapStr(0,o3_textsize,'text'))+text+(o3_textfontclass ? '' : wrapStr(1,o3_textsize)) + '</td></tr></table></td></tr></table>';

	set_background("");
	return txt;
}

// Sets the background picture,padding and lots more. :)
function ol_content_background(text,picture,hasfullhtml) {
	if (hasfullhtml) {
		txt=text;
	} else {
		txt='<table width="'+o3_width+'" border="0" cellpadding="0" cellspacing="0" height="'+o3_height+'"><tr><td colspan="3" height="'+o3_padyt+'"></td></tr><tr><td width="'+o3_padxl+'"></td><td valign="TOP" width="'+(o3_width-o3_padxl-o3_padxr)+(o3_textfontclass ? '" class="'+o3_textfontclass : '')+'">'+(o3_textfontclass ? '' : wrapStr(0,o3_textsize,'text'))+text+(o3_textfontclass ? '' : wrapStr(1,o3_textsize))+'</td><td width="'+o3_padxr+'"></td></tr><tr><td colspan="3" height="'+o3_padyb+'"></td></tr></table>';
	}

	set_background(picture);
	return txt;
}

// Loads a picture into the div.
function set_background(pic) {
	if (pic == "") {
		if (olNs4) {
			over.background.src = null; 
		} else if (over.style) {
			over.style.backgroundImage = "none";
		}
	} else {
		if (olNs4) {
			over.background.src = pic;
		} else if (over.style) {
			over.style.width=o3_width + 'px';
			over.style.backgroundImage = "url("+pic+")";
		}
	}
}

////////
// HANDLING FUNCTIONS
////////
var olShowId=-1;

// Displays the popup
function disp(statustext) {
	runHook("disp", FBEFORE);
	
	if (o3_allowmove == 0) {
		runHook("placeLayer", FREPLACE);
		(olNs6&&olShowId<0) ? olShowId=setTimeout("runHook('showObject', FREPLACE, over)", 1) : runHook("showObject", FREPLACE, over);
		o3_allowmove = (o3_sticky || o3_followmouse==0) ? 0 : 1;
	}
	
	runHook("disp", FAFTER);

	if (statustext != "") self.status = statustext;
}

// Creates the actual popup structure
function createPopup(lyrContent){
	runHook("createPopup", FBEFORE);
	
	if (o3_wrap) {
		var wd,ww,theObj = (olNs4 ? over : over.style);
		theObj.top = theObj.left = ((olIe4&&!olOp) ? 0 : -10000) + (!olNs4 ? 'px' : 0);
		layerWrite(lyrContent);
		wd = (olNs4 ? over.clip.width : over.offsetWidth);
		if (wd > (ww=windowWidth())) {
			lyrContent=lyrContent.replace(/\&nbsp;/g, ' ');
			o3_width=ww;
			o3_wrap=0;
		} 
	}

	layerWrite(lyrContent);
	
	// Have to set o3_width for placeLayer() routine if o3_wrap is turned on
	if (o3_wrap) o3_width=(olNs4 ? over.clip.width : over.offsetWidth);
	
	runHook("createPopup", FAFTER, lyrContent);

	return true;
}

// Decides where we want the popup.
function placeLayer() {
	var placeX, placeY, widthFix = 0;
	
	// HORIZONTAL PLACEMENT, re-arranged to work in Safari
	if (o3_frame.innerWidth) widthFix=18; 
	iwidth = windowWidth();

	// Horizontal scroll offset
	winoffset=(olIe4) ? eval('o3_frame.'+docRoot+'.scrollLeft') : o3_frame.pageXOffset;

	placeX = runHook('horizontalPlacement',FCHAIN,iwidth,winoffset,widthFix);

	// VERTICAL PLACEMENT, re-arranged to work in Safari
	if (o3_frame.innerHeight) {
		iheight=o3_frame.innerHeight;
	} else if (eval('o3_frame.'+docRoot)&&eval("typeof o3_frame."+docRoot+".clientHeight=='number'")&&eval('o3_frame.'+docRoot+'.clientHeight')) { 
		iheight=eval('o3_frame.'+docRoot+'.clientHeight');
	}			

	// Vertical scroll offset
	scrolloffset=(olIe4) ? eval('o3_frame.'+docRoot+'.scrollTop') : o3_frame.pageYOffset;
	placeY = runHook('verticalPlacement',FCHAIN,iheight,scrolloffset);

	// Actually move the object.
	repositionTo(over, placeX, placeY);
}

// Moves the layer
function olMouseMove(e) {
	 e = (e) ? e : event;

	if (e.pageX) {
		o3_x = e.pageX;
		o3_y = e.pageY;
	} else if (e.clientX) {
		o3_x = eval('e.clientX+o3_frame.'+docRoot+'.scrollLeft');
		o3_y = eval('e.clientY+o3_frame.'+docRoot+'.scrollTop');
	}
	
	if (o3_allowmove == 1) runHook("placeLayer", FREPLACE);

	// MouseOut handler
	if (hoveringSwitch && !olNs4 && runHook("cursorOff", FREPLACE)) {
		(olHideDelay ? hideDelay(olHideDelay) : cClick());
		hoveringSwitch = !hoveringSwitch;
	}
}

// Fake function for 3.0 users.
function no_overlib() { return ver3fix; }

// Capture the mouse and chain other scripts.
function olMouseCapture() {
	capExtent = document;
	var fN, str = '', l, k, f, wMv, sS, mseHandler = olMouseMove;
	var re = /function[ ]*(\w*)\(/;
	
	wMv = (!olIe4 && window.onmousemove);
	if (document.onmousemove || wMv) {
		if (wMv) capExtent = window;
		f = capExtent.onmousemove.toString();
		fN = f.match(re);
		if (fN == null) {
			str = f+'(e); ';
		} else if (fN[1] == 'anonymous' || fN[1] == 'olMouseMove' || (wMv && fN[1] == 'onmousemove')) {
			if (!olOp && wMv) {
				l = f.indexOf('{')+1;
				k = f.lastIndexOf('}');
				sS = f.substring(l,k);
				if ((l = sS.indexOf('(')) != -1) {
					sS = sS.substring(0,l).replace(/^\s+/,'').replace(/\s+$/,'');
					if (eval("typeof " + sS + " == 'undefined'")) window.onmousemove = null;
					else str = sS + '(e);';
				}
			}
			if (!str) {
				olCheckMouseCapture = false;
				return;
			}
		} else {
			if (fN[1]) str = fN[1]+'(e); ';
			else {
				l = f.indexOf('{')+1;
				k = f.lastIndexOf('}');
				str = f.substring(l,k) + '\n';
			}
		}
		str += 'olMouseMove(e); ';
		mseHandler = new Function('e', str);
	}

	capExtent.onmousemove = mseHandler;
	if (olNs4) capExtent.captureEvents(Event.MOUSEMOVE);
}

////////
// PARSING FUNCTIONS
////////

// Does the actual command parsing.
function parseTokens(pf, ar) {
	// What the next argument is expected to be.
	var v, i, mode=-1, par = (pf != 'ol_');	
	var fnMark = (par && !ar.length ? 1 : 0);

	for (i = 0; i < ar.length; i++) {
		if (mode < 0) {
			// Arg is maintext,unless its a number between pmStart and pmUpper
			// then its a command.
			if (typeof ar[i] == 'number' && ar[i] > pmStart && ar[i] < pmUpper) {
				fnMark = (par ? 1 : 0);
				i--;   // backup one so that the next block can parse it
			} else {
				switch(pf) {
					case 'ol_':
						ol_text = ar[i].toString();
						break;
					default:
						o3_text=ar[i].toString();  
				}
			}
			mode = 0;
		} else {
			// Note: NS4 doesn't like switch cases with vars.
			if (ar[i] >= pmCount || ar[i]==DONOTHING) { continue; }
			if (ar[i]==INARRAY) { fnMark = 0; eval(pf+'text=ol_texts['+ar[++i]+'].toString()'); continue; }
			if (ar[i]==CAPARRAY) { eval(pf+'cap=ol_caps['+ar[++i]+'].toString()'); continue; }
			if (ar[i]==STICKY) { if (pf!='ol_') eval(pf+'sticky=1'); continue; }
			if (ar[i]==BACKGROUND) { eval(pf+'background="'+ar[++i]+'"'); continue; }
			if (ar[i]==NOCLOSE) { if (pf!='ol_') opt_NOCLOSE(); continue; }
			if (ar[i]==CAPTION) { eval(pf+"cap='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==CENTER || ar[i]==LEFT || ar[i]==RIGHT) { eval(pf+'hpos='+ar[i]); if(pf!='ol_') olHautoFlag=1; continue; }
			if (ar[i]==OFFSETX) { eval(pf+'offsetx='+ar[++i]); continue; }
			if (ar[i]==OFFSETY) { eval(pf+'offsety='+ar[++i]); continue; }
			if (ar[i]==FGCOLOR) { eval(pf+'fgcolor="'+ar[++i]+'"'); continue; }
			if (ar[i]==BGCOLOR) { eval(pf+'bgcolor="'+ar[++i]+'"'); continue; }
			if (ar[i]==TEXTCOLOR) { eval(pf+'textcolor="'+ar[++i]+'"'); continue; }
			if (ar[i]==CAPCOLOR) { eval(pf+'capcolor="'+ar[++i]+'"'); continue; }
			if (ar[i]==CLOSECOLOR) { eval(pf+'closecolor="'+ar[++i]+'"'); continue; }
			if (ar[i]==WIDTH) { eval(pf+'width='+ar[++i]); continue; }
			if (ar[i]==BORDER) { eval(pf+'border='+ar[++i]); continue; }
			if (ar[i]==CELLPAD) { i=opt_MULTIPLEARGS(++i,ar,(pf+'cellpad')); continue; }
			if (ar[i]==STATUS) { eval(pf+"status='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==AUTOSTATUS) { eval(pf +'autostatus=('+pf+'autostatus == 1) ? 0 : 1'); continue; }
			if (ar[i]==AUTOSTATUSCAP) { eval(pf +'autostatus=('+pf+'autostatus == 2) ? 0 : 2'); continue; }
			if (ar[i]==HEIGHT) { eval(pf+'height='+pf+'aboveheight='+ar[++i]); continue; } // Same param again.
			if (ar[i]==CLOSETEXT) { eval(pf+"close='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==SNAPX) { eval(pf+'snapx='+ar[++i]); continue; }
			if (ar[i]==SNAPY) { eval(pf+'snapy='+ar[++i]); continue; }
			if (ar[i]==FIXX) { eval(pf+'fixx='+ar[++i]); continue; }
			if (ar[i]==FIXY) { eval(pf+'fixy='+ar[++i]); continue; }
			if (ar[i]==RELX) { eval(pf+'relx='+ar[++i]); continue; }
			if (ar[i]==RELY) { eval(pf+'rely='+ar[++i]); continue; }
			if (ar[i]==FGBACKGROUND) { eval(pf+'fgbackground="'+ar[++i]+'"'); continue; }
			if (ar[i]==BGBACKGROUND) { eval(pf+'bgbackground="'+ar[++i]+'"'); continue; }
			if (ar[i]==PADX) { eval(pf+'padxl='+ar[++i]); eval(pf+'padxr='+ar[++i]); continue; }
			if (ar[i]==PADY) { eval(pf+'padyt='+ar[++i]); eval(pf+'padyb='+ar[++i]); continue; }
			if (ar[i]==FULLHTML) { if (pf!='ol_') eval(pf+'fullhtml=1'); continue; }
			if (ar[i]==BELOW || ar[i]==ABOVE) { eval(pf+'vpos='+ar[i]); if (pf!='ol_') olVautoFlag=1; continue; }
			if (ar[i]==CAPICON) { eval(pf+'capicon="'+ar[++i]+'"'); continue; }
			if (ar[i]==TEXTFONT) { eval(pf+"textfont='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==CAPTIONFONT) { eval(pf+"captionfont='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==CLOSEFONT) { eval(pf+"closefont='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==TEXTSIZE) { eval(pf+'textsize="'+ar[++i]+'"'); continue; }
			if (ar[i]==CAPTIONSIZE) { eval(pf+'captionsize="'+ar[++i]+'"'); continue; }
			if (ar[i]==CLOSESIZE) { eval(pf+'closesize="'+ar[++i]+'"'); continue; }
			if (ar[i]==TIMEOUT) { eval(pf+'timeout='+ar[++i]); continue; }
			if (ar[i]==FUNCTION) { if (pf=='ol_') { if (typeof ar[i+1]!='number') { v=ar[++i]; ol_function=(typeof v=='function' ? v : null); }} else {fnMark = 0; v = null; if (typeof ar[i+1]!='number') v = ar[++i];  opt_FUNCTION(v); } continue; }
			if (ar[i]==DELAY) { eval(pf+'delay='+ar[++i]); continue; }
			if (ar[i]==HAUTO) { eval(pf+'hauto=('+pf+'hauto == 0) ? 1 : 0'); continue; }
			if (ar[i]==VAUTO) { eval(pf+'vauto=('+pf+'vauto == 0) ? 1 : 0'); continue; }
			if (ar[i]==CLOSECLICK) { eval(pf +'closeclick=('+pf+'closeclick == 0) ? 1 : 0'); continue; }
			if (ar[i]==WRAP) { eval(pf +'wrap=('+pf+'wrap == 0) ? 1 : 0'); continue; }
			if (ar[i]==FOLLOWMOUSE) { eval(pf +'followmouse=('+pf+'followmouse == 1) ? 0 : 1'); continue; }
			if (ar[i]==MOUSEOFF) { eval(pf +'mouseoff=('+pf+'mouseoff==0) ? 1 : 0'); v=ar[i+1]; if (pf != 'ol_' && eval(pf+'mouseoff') && typeof v == 'number' && (v < pmStart || v > pmUpper)) olHideDelay=ar[++i]; continue; }
			if (ar[i]==CLOSETITLE) { eval(pf+"closetitle='"+escSglQuote(ar[++i])+"'"); continue; }
			if (ar[i]==CSSOFF||ar[i]==CSSCLASS) { eval(pf+'css='+ar[i]); continue; }
			if (ar[i]==COMPATMODE) { eval(pf+'compatmode=('+pf+'compatmode==0) ? 1 : 0'); continue; }
			if (ar[i]==FGCLASS) { eval(pf+'fgclass="'+ar[++i]+'"'); continue; }
			if (ar[i]==BGCLASS) { eval(pf+'bgclass="'+ar[++i]+'"'); continue; }
			if (ar[i]==TEXTFONTCLASS) { eval(pf+'textfontclass="'+ar[++i]+'"'); continue; }
			if (ar[i]==CAPTIONFONTCLASS) { eval(pf+'captionfontclass="'+ar[++i]+'"'); continue; }
			if (ar[i]==CLOSEFONTCLASS) { eval(pf+'closefontclass="'+ar[++i]+'"'); continue; }
			i = parseCmdLine(pf, i, ar);
		}
	}

	if (fnMark && o3_function) o3_text = o3_function();
	
	if ((pf == 'o3_') && o3_wrap) {
		o3_width = 0;
		
		var tReg=/<.*\n*>/ig;
		if (!tReg.test(o3_text)) o3_text = o3_text.replace(/[ ]+/g, '&nbsp;');
		if (!tReg.test(o3_cap))o3_cap = o3_cap.replace(/[ ]+/g, '&nbsp;');
	}
	if ((pf == 'o3_') && o3_sticky) {
		if (!o3_close && (o3_frame != ol_frame)) o3_close = ol_close;
		if (o3_mouseoff && (o3_frame == ol_frame)) opt_NOCLOSE(' ');
	}
}


////////
// LAYER FUNCTIONS
////////

// Writes to a layer
function layerWrite(txt) {
	txt += "\n";
	if (olNs4) {
		var lyr = o3_frame.document.layers['overDiv'].document
		lyr.write(txt)
		lyr.close()
	} else if (typeof over.innerHTML != 'undefined') {
		if (olIe5 && isMac) over.innerHTML = '';
		over.innerHTML = txt;
	} else {
		range = o3_frame.document.createRange();
		range.setStartAfter(over);
		domfrag = range.createContextualFragment(txt);
		
		while (over.hasChildNodes()) {
			over.removeChild(over.lastChild);
		}
		
		over.appendChild(domfrag);
	}
}

// Make an object visible
function showObject(obj) {
	runHook("showObject", FBEFORE);

	var theObj=(olNs4 ? obj : obj.style);
	theObj.visibility = 'visible';

	runHook("showObject", FAFTER);
}

// Hides an object
function hideObject(obj) {
	runHook("hideObject", FBEFORE);

	var theObj=(olNs4 ? obj : obj.style);
	if (olNs6 && olShowId>0) { clearTimeout(olShowId); olShowId=0; }
	theObj.visibility = 'hidden';
	theObj.top = theObj.left = ((olIe4&&!olOp) ? 0 : -10000) + (!olNs4 ? 'px' : 0);

	if (o3_timerid > 0) clearTimeout(o3_timerid);
	if (o3_delayid > 0) clearTimeout(o3_delayid);

	o3_timerid = 0;
	o3_delayid = 0;
	self.status = "";

	if (obj.onmouseout||obj.onmouseover) {
		if (olNs4) obj.releaseEvents(Event.MOUSEOUT || Event.MOUSEOVER);
		obj.onmouseout = obj.onmouseover = null;
	}

	runHook("hideObject", FAFTER);
}

// Move a layer
function repositionTo(obj, xL, yL) {
	var theObj=(olNs4 ? obj : obj.style);
	theObj.left = xL + (!olNs4 ? 'px' : 0);
	theObj.top = yL + (!olNs4 ? 'px' : 0);
}

// Check position of cursor relative to overDiv DIVision; mouseOut function
function cursorOff() {
	var left = parseInt(over.style.left);
	var top = parseInt(over.style.top);
	var right = left + (over.offsetWidth >= parseInt(o3_width) ? over.offsetWidth : parseInt(o3_width));
	var bottom = top + (over.offsetHeight >= o3_aboveheight ? over.offsetHeight : o3_aboveheight);

	if (o3_x < left || o3_x > right || o3_y < top || o3_y > bottom) return true;

	return false;
}


////////
// COMMAND FUNCTIONS
////////

// Calls callme or the default function.
function opt_FUNCTION(callme) {
	o3_text = (callme ? (typeof callme=='string' ? (/.+\(.*\)/.test(callme) ? eval(callme) : callme) : callme()) : (o3_function ? o3_function() : 'No Function'));

	return 0;
}

// Handle hovering
function opt_NOCLOSE(unused) {
	if (!unused) o3_close = "";

	if (olNs4) {
		over.captureEvents(Event.MOUSEOUT || Event.MOUSEOVER);
		over.onmouseover = function () { if (o3_timerid > 0) { clearTimeout(o3_timerid); o3_timerid = 0; } }
		over.onmouseout = function (e) { if (olHideDelay) hideDelay(olHideDelay); else cClick(e); }
	} else {
		over.onmouseover = function () {hoveringSwitch = true; if (o3_timerid > 0) { clearTimeout(o3_timerid); o3_timerid =0; } }
	}

	return 0;
}

// Function to scan command line arguments for multiples
function opt_MULTIPLEARGS(i, args, parameter) {
  var k=i, re, pV, str='';

  for(k=i; k<args.length; k++) {
		if(typeof args[k] == 'number' && args[k]>pmStart) break;
		str += args[k] + ',';
	}
	if (str) str = str.substring(0,--str.length);

	k--;  // reduce by one so the for loop this is in works correctly
	pV=(olNs4 && /cellpad/i.test(parameter)) ? str.split(',')[0] : str;
	eval(parameter + '="' + pV + '"');

	return k;
}

// Remove &nbsp; in texts when done.
function nbspCleanup() {
	if (o3_wrap) {
		o3_text = o3_text.replace(/\&nbsp;/g, ' ');
		o3_cap = o3_cap.replace(/\&nbsp;/g, ' ');
	}
}

// Escape embedded single quotes in text strings
function escSglQuote(str) {
  return str.toString().replace(/'/g,"\\'");
}

// Onload handler for window onload event
function OLonLoad_handler(e) {
	var re = /\w+\(.*\)[;\s]+/g, olre = /overlib\(|nd\(|cClick\(/, fn, l, i;

	if(!olLoaded) olLoaded=1;

  // Remove it for Gecko based browsers
	if(window.removeEventListener && e.eventPhase == 3) window.removeEventListener("load",OLonLoad_handler,false);
	else if(window.detachEvent) { // and for IE and Opera 4.x but execute calls to overlib, nd, or cClick()
		window.detachEvent("onload",OLonLoad_handler);
		var fN = document.body.getAttribute('onload');
		if (fN) {
			fN=fN.toString().match(re);
			if (fN && fN.length) {
				for (i=0; i<fN.length; i++) {
					if (/anonymous/.test(fN[i])) continue;
					while((l=fN[i].search(/\)[;\s]+/)) != -1) {
						fn=fN[i].substring(0,l+1);
						fN[i] = fN[i].substring(l+2);
						if (olre.test(fn)) eval(fn);
					}
				}
			}
		}
	}
}

// Wraps strings in Layer Generation Functions with the correct tags
//    endWrap true(if end tag) or false if start tag
//    fontSizeStr - font size string such as '1' or '10px'
//    whichString is being wrapped -- 'text', 'caption', or 'close'
function wrapStr(endWrap,fontSizeStr,whichString) {
	var fontStr, fontColor, isClose=((whichString=='close') ? 1 : 0), hasDims=/[%\-a-z]+$/.test(fontSizeStr);
	fontSizeStr = (olNs4) ? (!hasDims ? fontSizeStr : '1') : fontSizeStr;
	if (endWrap) return (hasDims&&!olNs4) ? (isClose ? '</span>' : '</div>') : '</font>';
	else {
		fontStr='o3_'+whichString+'font';
		fontColor='o3_'+((whichString=='caption')? 'cap' : whichString)+'color';
		return (hasDims&&!olNs4) ? (isClose ? '<span style="font-family: '+quoteMultiNameFonts(eval(fontStr))+'; color: '+eval(fontColor)+'; font-size: '+fontSizeStr+';">' : '<div style="font-family: '+quoteMultiNameFonts(eval(fontStr))+'; color: '+eval(fontColor)+'; font-size: '+fontSizeStr+';">') : '<font face="'+eval(fontStr)+'" color="'+eval(fontColor)+'" size="'+(parseInt(fontSizeStr)>7 ? '7' : fontSizeStr)+'">';
	}
}

// Quotes Multi word font names; needed for CSS Standards adherence in font-family
function quoteMultiNameFonts(theFont) {
	var v, pM=theFont.split(',');
	for (var i=0; i<pM.length; i++) {
		v=pM[i];
		v=v.replace(/^\s+/,'').replace(/\s+$/,'');
		if(/\s/.test(v) && !/['"]/.test(v)) {
			v="\'"+v+"\'";
			pM[i]=v;
		}
	}
	return pM.join();
}

// dummy function which will be overridden 
function isExclusive(args) {
	return false;
}

// Sets cellpadding style string value
function setCellPadStr(parameter) {
	var Str='', j=0, ary = new Array(), top, bottom, left, right;

	Str+='padding: ';
	ary=parameter.replace(/\s+/g,'').split(',');

	switch(ary.length) {
		case 2:
			top=bottom=ary[j];
			left=right=ary[++j];
			break;
		case 3:
			top=ary[j];
			left=right=ary[++j];
			bottom=ary[++j];
			break;
		case 4:
			top=ary[j];
			right=ary[++j];
			bottom=ary[++j];
			left=ary[++j];
			break;
	}

	Str+= ((ary.length==1) ? ary[0] + 'px;' : top + 'px ' + right + 'px ' + bottom + 'px ' + left + 'px;');

	return Str;
}

// function will delay close by time milliseconds
function hideDelay(time) {
	if (time&&!o3_delay) {
		if (o3_timerid > 0) clearTimeout(o3_timerid);

		o3_timerid=setTimeout("cClick()",(o3_timeout=time));
	}
}

// Was originally in the placeLayer() routine; separated out for future ease
function horizontalPlacement(browserWidth, horizontalScrollAmount, widthFix) {
	var placeX, iwidth=browserWidth, winoffset=horizontalScrollAmount;
	var parsedWidth = parseInt(o3_width);

	if (o3_fixx > -1 || o3_relx != null) {
		// Fixed position
		placeX=(o3_relx != null ? ( o3_relx < 0 ? winoffset +o3_relx+ iwidth - parsedWidth - widthFix : winoffset+o3_relx) : o3_fixx);
	} else {  
		// If HAUTO, decide what to use.
		if (o3_hauto == 1) {
			if ((o3_x - winoffset) > (iwidth / 2)) {
				o3_hpos = LEFT;
			} else {
				o3_hpos = RIGHT;
			}
		}  		

		// From mouse
		if (o3_hpos == CENTER) { // Center
			placeX = o3_x+o3_offsetx-(parsedWidth/2);

			if (placeX < winoffset) placeX = winoffset;
		}

		if (o3_hpos == RIGHT) { // Right
			placeX = o3_x+o3_offsetx;

			if ((placeX+parsedWidth) > (winoffset+iwidth - widthFix)) {
				placeX = iwidth+winoffset - parsedWidth - widthFix;
				if (placeX < 0) placeX = 0;
			}
		}
		if (o3_hpos == LEFT) { // Left
			placeX = o3_x-o3_offsetx-parsedWidth;
			if (placeX < winoffset) placeX = winoffset;
		}  	

		// Snapping!
		if (o3_snapx > 1) {
			var snapping = placeX % o3_snapx;

			if (o3_hpos == LEFT) {
				placeX = placeX - (o3_snapx+snapping);
			} else {
				// CENTER and RIGHT
				placeX = placeX+(o3_snapx - snapping);
			}

			if (placeX < winoffset) placeX = winoffset;
		}
	}	

	return placeX;
}

// was originally in the placeLayer() routine; separated out for future ease
function verticalPlacement(browserHeight,verticalScrollAmount) {
	var placeY, iheight=browserHeight, scrolloffset=verticalScrollAmount;
	var parsedHeight=(o3_aboveheight ? parseInt(o3_aboveheight) : (olNs4 ? over.clip.height : over.offsetHeight));

	if (o3_fixy > -1 || o3_rely != null) {
		// Fixed position
		placeY=(o3_rely != null ? (o3_rely < 0 ? scrolloffset+o3_rely+iheight - parsedHeight : scrolloffset+o3_rely) : o3_fixy);
	} else {
		// If VAUTO, decide what to use.
		if (o3_vauto == 1) {
			if ((o3_y - scrolloffset) > (iheight / 2) && o3_vpos == BELOW && (o3_y + parsedHeight + o3_offsety - (scrolloffset + iheight) > 0)) {
				o3_vpos = ABOVE;
			} else if (o3_vpos == ABOVE && (o3_y - (parsedHeight + o3_offsety) - scrolloffset < 0)) {
				o3_vpos = BELOW;
			}
		}

		// From mouse
		if (o3_vpos == ABOVE) {
			if (o3_aboveheight == 0) o3_aboveheight = parsedHeight; 

			placeY = o3_y - (o3_aboveheight+o3_offsety);
			if (placeY < scrolloffset) placeY = scrolloffset;
		} else {
			// BELOW
			placeY = o3_y+o3_offsety;
		} 

		// Snapping!
		if (o3_snapy > 1) {
			var snapping = placeY % o3_snapy;  			

			if (o3_aboveheight > 0 && o3_vpos == ABOVE) {
				placeY = placeY - (o3_snapy+snapping);
			} else {
				placeY = placeY+(o3_snapy - snapping);
			} 			

			if (placeY < scrolloffset) placeY = scrolloffset;
		}
	}

	return placeY;
}

// checks positioning flags
function checkPositionFlags() {
	if (olHautoFlag) olHautoFlag = o3_hauto=0;
	if (olVautoFlag) olVautoFlag = o3_vauto=0;
	return true;
}

// get Browser window width
function windowWidth() {
	var w;
	if (o3_frame.innerWidth) w=o3_frame.innerWidth;
	else if (eval('o3_frame.'+docRoot)&&eval("typeof o3_frame."+docRoot+".clientWidth=='number'")&&eval('o3_frame.'+docRoot+'.clientWidth')) 
		w=eval('o3_frame.'+docRoot+'.clientWidth');
	return w;			
}

// create the div container for popup content if it doesn't exist
function createDivContainer(id,frm,zValue) {
	id = (id || 'overDiv'), frm = (frm || o3_frame), zValue = (zValue || 1000);
	var objRef, divContainer = layerReference(id);

	if (divContainer == null) {
		if (olNs4) {
			divContainer = frm.document.layers[id] = new Layer(window.innerWidth, frm);
			objRef = divContainer;
		} else {
			var body = (olIe4 ? frm.document.all.tags('BODY')[0] : frm.document.getElementsByTagName("BODY")[0]);
			if (olIe4&&!document.getElementById) {
				body.insertAdjacentHTML("beforeEnd",'<div id="'+id+'"></div>');
				divContainer=layerReference(id);
			} else {
				divContainer = frm.document.createElement("DIV");
				divContainer.id = id;
				body.appendChild(divContainer);
			}
			objRef = divContainer.style;
		}

		objRef.position = 'absolute';
		objRef.visibility = 'hidden';
		objRef.zIndex = zValue;
		if (olIe4&&!olOp) objRef.left = objRef.top = '0px';
		else objRef.left = objRef.top =  -10000 + (!olNs4 ? 'px' : 0);
	}

	return divContainer;
}

// get reference to a layer with ID=id
function layerReference(id) {
	return (olNs4 ? o3_frame.document.layers[id] : (document.all ? o3_frame.document.all[id] : o3_frame.document.getElementById(id)));
}
////////
//  UTILITY FUNCTIONS
////////

// Checks if something is a function.
function isFunction(fnRef) {
	var rtn = true;

	if (typeof fnRef == 'object') {
		for (var i = 0; i < fnRef.length; i++) {
			if (typeof fnRef[i]=='function') continue;
			rtn = false;
			break;
		}
	} else if (typeof fnRef != 'function') {
		rtn = false;
	}
	
	return rtn;
}

// Converts an array into an argument string for use in eval.
function argToString(array, strtInd, argName) {
	var jS = strtInd, aS = '', ar = array;
	argName=(argName ? argName : 'ar');
	
	if (ar.length > jS) {
		for (var k = jS; k < ar.length; k++) aS += argName+'['+k+'], ';
		aS = aS.substring(0, aS.length-2);
	}
	
	return aS;
}

// Places a hook in the correct position in a hook point.
function reOrder(hookPt, fnRef, order) {
	var newPt = new Array(), match, i, j;

	if (!order || typeof order == 'undefined' || typeof order == 'number') return hookPt;
	
	if (typeof order=='function') {
		if (typeof fnRef=='object') {
			newPt = newPt.concat(fnRef);
		} else {
			newPt[newPt.length++]=fnRef;
		}
		
		for (i = 0; i < hookPt.length; i++) {
			match = false;
			if (typeof fnRef == 'function' && hookPt[i] == fnRef) {
				continue;
			} else {
				for(j = 0; j < fnRef.length; j++) if (hookPt[i] == fnRef[j]) {
					match = true;
					break;
				}
			}
			if (!match) newPt[newPt.length++] = hookPt[i];
		}

		newPt[newPt.length++] = order;

	} else if (typeof order == 'object') {
		if (typeof fnRef == 'object') {
			newPt = newPt.concat(fnRef);
		} else {
			newPt[newPt.length++] = fnRef;
		}
		
		for (j = 0; j < hookPt.length; j++) {
			match = false;
			if (typeof fnRef == 'function' && hookPt[j] == fnRef) {
				continue;
			} else {
				for (i = 0; i < fnRef.length; i++) if (hookPt[j] == fnRef[i]) {
					match = true;
					break;
				}
			}
			if (!match) newPt[newPt.length++]=hookPt[j];
		}

		for (i = 0; i < newPt.length; i++) hookPt[i] = newPt[i];
		newPt.length = 0;
		
		for (j = 0; j < hookPt.length; j++) {
			match = false;
			for (i = 0; i < order.length; i++) {
				if (hookPt[j] == order[i]) {
					match = true;
					break;
				}
			}
			if (!match) newPt[newPt.length++] = hookPt[j];
		}
		newPt = newPt.concat(order);
	}

	hookPt = newPt;

	return hookPt;
}

////////
//  PLUGIN ACTIVATION FUNCTIONS
////////

// Runs plugin functions to set runtime variables.
function setRunTimeVariables(){
	if (typeof runTime != 'undefined' && runTime.length) {
		for (var k = 0; k < runTime.length; k++) {
			runTime[k]();
		}
	}
}

// Runs plugin functions to parse commands.
function parseCmdLine(pf, i, args) {
	if (typeof cmdLine != 'undefined' && cmdLine.length) { 
		for (var k = 0; k < cmdLine.length; k++) { 
			var j = cmdLine[k](pf, i, args);
			if (j >- 1) {
				i = j;
				break;
			}
		}
	}

	return i;
}

// Runs plugin functions to do things after parse.
function postParseChecks(pf,args){
	if (typeof postParse != 'undefined' && postParse.length) {
		for (var k = 0; k < postParse.length; k++) {
			if (postParse[k](pf,args)) continue;
			return false;  // end now since have an error
		}
	}
	return true;
}


////////
//  PLUGIN REGISTRATION FUNCTIONS
////////

// Registers commands and creates constants.
function registerCommands(cmdStr) {
	if (typeof cmdStr!='string') return;

	var pM = cmdStr.split(',');
	pms = pms.concat(pM);

	for (var i = 0; i< pM.length; i++) {
		eval(pM[i].toUpperCase()+'='+pmCount++);
	}
}

// Registers no-parameter commands
function registerNoParameterCommands(cmdStr) {
	if (!cmdStr && typeof cmdStr != 'string') return;
	pmt=(!pmt) ? cmdStr : pmt + ',' + cmdStr;
}

// Register a function to hook at a certain point.
function registerHook(fnHookTo, fnRef, hookType, optPm) {
	var hookPt, last = typeof optPm;
	
	if (fnHookTo == 'plgIn'||fnHookTo == 'postParse') return;
	if (typeof hookPts[fnHookTo] == 'undefined') hookPts[fnHookTo] = new FunctionReference();

	hookPt = hookPts[fnHookTo];

	if (hookType != null) {
		if (hookType == FREPLACE) {
			hookPt.ovload = fnRef;  // replace normal overlib routine
			if (fnHookTo.indexOf('ol_content_') > -1) hookPt.alt[pms[CSSOFF-1-pmStart]]=fnRef; 

		} else if (hookType == FBEFORE || hookType == FAFTER) {
			var hookPt=(hookType == 1 ? hookPt.before : hookPt.after);

			if (typeof fnRef == 'object') {
				hookPt = hookPt.concat(fnRef);
			} else {
				hookPt[hookPt.length++] = fnRef;
			}

			if (optPm) hookPt = reOrder(hookPt, fnRef, optPm);

		} else if (hookType == FALTERNATE) {
			if (last=='number') hookPt.alt[pms[optPm-1-pmStart]] = fnRef;
		} else if (hookType == FCHAIN) {
			hookPt = hookPt.chain; 
			if (typeof fnRef=='object') hookPt=hookPt.concat(fnRef); // add other functions 
			else hookPt[hookPt.length++]=fnRef;
		}

		return;
	}
}

// Register a function that will set runtime variables.
function registerRunTimeFunction(fn) {
	if (isFunction(fn)) {
		if (typeof fn == 'object') {
			runTime = runTime.concat(fn);
		} else {
			runTime[runTime.length++] = fn;
		}
	}
}

// Register a function that will handle command parsing.
function registerCmdLineFunction(fn){
	if (isFunction(fn)) {
		if (typeof fn == 'object') {
			cmdLine = cmdLine.concat(fn);
		} else {
			cmdLine[cmdLine.length++] = fn;
		}
	}
}

// Register a function that does things after command parsing. 
function registerPostParseFunction(fn){
	if (isFunction(fn)) {
		if (typeof fn == 'object') {
			postParse = postParse.concat(fn);
		} else {
			postParse[postParse.length++] = fn;
		}
	}
}

////////
//  PLUGIN REGISTRATION FUNCTIONS
////////

// Runs any hooks registered.
function runHook(fnHookTo, hookType) {
	var l = hookPts[fnHookTo], k, rtnVal = null, optPm, arS, ar = runHook.arguments;

	if (hookType == FREPLACE) {
		arS = argToString(ar, 2);

		if (typeof l == 'undefined' || !(l = l.ovload)) rtnVal = eval(fnHookTo+'('+arS+')');
		else rtnVal = eval('l('+arS+')');

	} else if (hookType == FBEFORE || hookType == FAFTER) {
		if (typeof l != 'undefined') {
			l=(hookType == 1 ? l.before : l.after);
	
			if (l.length) {
				arS = argToString(ar, 2);
				for (var k = 0; k < l.length; k++) eval('l[k]('+arS+')');
			}
		}
	} else if (hookType == FALTERNATE) {
		optPm = ar[2];
		arS = argToString(ar, 3);

		if (typeof l == 'undefined' || (l = l.alt[pms[optPm-1-pmStart]]) == 'undefined') {
			rtnVal = eval(fnHookTo+'('+arS+')');
		} else {
			rtnVal = eval('l('+arS+')');
		}
	} else if (hookType == FCHAIN) {
		arS=argToString(ar,2);
		l=l.chain;

		for (k=l.length; k > 0; k--) if((rtnVal=eval('l[k-1]('+arS+')'))!=void(0)) break;
	}

	return rtnVal;
}

////////
// OBJECT CONSTRUCTORS
////////

// Object for handling hooks.
function FunctionReference() {
	this.ovload = null;
	this.before = new Array();
	this.after = new Array();
	this.alt = new Array();
	this.chain = new Array();
}

// Object for simple access to the overLIB version used.
// Examples: simpleversion:351 major:3 minor:5 revision:1
function Info(version, prerelease) {
	this.version = version;
	this.prerelease = prerelease;

	this.simpleversion = Math.round(this.version*100);
	this.major = parseInt(this.simpleversion / 100);
	this.minor = parseInt(this.simpleversion / 10) - this.major * 10;
	this.revision = parseInt(this.simpleversion) - this.major * 100 - this.minor * 10;
	this.meets = meets;
}

// checks for Core Version required
function meets(reqdVersion) {
	return (!reqdVersion) ? false : this.simpleversion >= Math.round(100*parseFloat(reqdVersion));
}


////////
// STANDARD REGISTRATIONS
////////
registerHook("ol_content_simple", ol_content_simple, FALTERNATE, CSSOFF);
registerHook("ol_content_caption", ol_content_caption, FALTERNATE, CSSOFF);
registerHook("ol_content_background", ol_content_background, FALTERNATE, CSSOFF);
registerHook("ol_content_simple", ol_content_simple, FALTERNATE, CSSCLASS);
registerHook("ol_content_caption", ol_content_caption, FALTERNATE, CSSCLASS);
registerHook("ol_content_background", ol_content_background, FALTERNATE, CSSCLASS);
registerPostParseFunction(checkPositionFlags);
registerHook("hideObject", nbspCleanup, FAFTER);
registerHook("horizontalPlacement", horizontalPlacement, FCHAIN);
registerHook("verticalPlacement", verticalPlacement, FCHAIN);
if (olNs4||(olIe5&&isMac)||olKq) olLoaded=1;
registerNoParameterCommands('sticky,autostatus,autostatuscap,fullhtml,hauto,vauto,closeclick,wrap,followmouse,mouseoff,compatmode');
///////
// ESTABLISH MOUSECAPTURING
///////

// Capture events, alt. diffuses the overlib function.
var olCheckMouseCapture=true;
if ((olNs4 || olNs6 || olIe4)) {
	olMouseCapture();
} else {
	overlib = no_overlib;
	nd = no_overlib;
	ver3fix = true;
}
//redirect.js

var mParentLength=window.frames.length;

if (mParentLength==0)
{
	//page not loaded in a frameset!!
//	window.location.href='../start.htm'
}

//imgmap.js
/******************************************************
 * Syntax Score Calculator Version 2.0                *
 *                                                    *
 * Orginal code (version 1.0): ISM (2005)             *
 * Adaptions    (version 2.0): Luc Strijbosch (2009)  *
 ******************************************************/

// Image map control functions

function lightUpRow(rowId) {
	//alert( $("#"+rowId).css("background-color"));
    getById('right', rowId).style.backgroundColor = "81bbd5";
   // $("#"+rowId).hide(150).show(150);
     $("#"+rowId).css("background-color", "#81bbd5").show(150);
    document.body.style.cursor = "pointer";
    
}

// Only 'unLight' row when not selected
function unLightUpRow(rowId, chkId) {
    if( ! getById('right', chkId).checked ) {
        getById('right', rowId).style.backgroundColor = "#FFFFFF";
          
          
    }
    document.body.style.cursor = "default";
}

/** In additon to the selection of the checkbox the segment is also
    set, code taken from SetSegmentsInvolved (frameset.js)
 **/
function selectRow(segment, lesion) {
    chkId = 'dd' + segment + 'd' + lesion;
    chkId2 = 'vv' + segment + 'd' + lesion;
   // alert(chkId2);
    if( getById('right', chkId).checked ) {
        getById('right', chkId).checked = false;	

	if (meSegmentsInvolved[segment][lesion]==1)
	{
	    meSegmentsInvolved[segment][lesion]=0;
	   $("#"+chkId2).html("");   
	}
    }
    else {
        getById('right', chkId).checked = true;

	if (meSegmentsInvolved[segment][lesion]==0)
	{
	    meSegmentsInvolved[segment][lesion]=1;
	   
	    $("#"+chkId2).html("V");   
	}

    }
}

function toggleLightUpRow(rowId, chkId ) {
    if( getById('right', chkId).checked ) {
        lightUpRow(rowId);
        
   
    }
    else {
         unLightUpRow(rowId, chkId);
         
    }
}


