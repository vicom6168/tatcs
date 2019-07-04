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
	    alert(chkId);
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