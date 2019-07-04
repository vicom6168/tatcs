/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: Manzi Olivier :: http://www.imanzi.com/ */

// calculate the ASCII code of the given character
function CalcKeyCode(aChar) {
  var character = aChar.substring(0,1);
  var code = aChar.charCodeAt(0);
  return code;
}

function checkDate(val) {
  var strPass = val.value;
  var strLength = strPass.length;
  var lchar = val.value.charAt((strLength) - 1);
  var cCode = CalcKeyCode(lchar);

  /* Check if the keyed in character is a number
     do you want alphabetic UPPERCASE only ?
     or lower case only just check their respective
     codes and replace the 48 and 57 */

  if (cCode < 48 || cCode > 57 ) {
    var myNumber = val.value.substring(0, (strLength) - 1);
    val.value = myNumber;
  }
  //alert(val.value.length);
  if(val.value.length==4 || val.value.length==7){
  	val.value= val.value + '-';
  }	
  return false;
}
function checkTime(val) {
  var strPass = val.value;
  var strLength = strPass.length;
  var lchar = val.value.charAt((strLength) - 1);
  var cCode = CalcKeyCode(lchar);

  /* Check if the keyed in character is a number
     do you want alphabetic UPPERCASE only ?
     or lower case only just check their respective
     codes and replace the 48 and 57 */

  if (cCode < 48 || cCode > 57 ) {
    var myNumber = val.value.substring(0, (strLength) - 1);
    val.value = myNumber;
  }
  //alert(val.value.length);
  if(val.value.length==2 ){
  	val.value= val.value + ':';
  }	
  return false;
}
function checkNumber(val) {
  var strPass = val.value;
  var strLength = strPass.length;
  var lchar = val.value.charAt((strLength) - 1);
  var cCode = CalcKeyCode(lchar);

  /* Check if the keyed in character is a number
     do you want alphabetic UPPERCASE only ?
     or lower case only just check their respective
     codes and replace the 48 and 57 */

  if ((cCode < 48 || cCode > 57 ) && cCode!=46 && cCode!=45) {
    var myNumber = val.value.substring(0, (strLength) - 1);
    val.value = myNumber;
  }
  

  return false;
}

function checkInteger(val) {
	  var strPass = val.value;
	  var strLength = strPass.length;
	  var lchar = val.value.charAt((strLength) - 1);
	  var cCode = CalcKeyCode(lchar);

	  /* Check if the keyed in character is a number
	     do you want alphabetic UPPERCASE only ?
	     or lower case only just check their respective
	     codes and replace the 48 and 57 */

	  if (cCode < 48 || cCode > 57  ) {
	    var myNumber = val.value.substring(0, (strLength) - 1);
	    val.value = myNumber;
	  }
   return false;
}

function checkTel(val) {
  var strPass = val.value;
  var strLength = strPass.length;
  var lchar = val.value.charAt((strLength) - 1);
  var cCode = CalcKeyCode(lchar);

  /* Check if the keyed in character is a number
     do you want alphabetic UPPERCASE only ?
     or lower case only just check their respective
     codes and replace the 48 and 57 */

  if ((cCode < 48 || cCode > 57) && cCode!=45) {
    var myNumber = val.value.substring(0, (strLength) - 1);
    val.value = myNumber;
  }
  

  return false;
}

function checkDate_Format(iDate){
 // adaptable for other layouts
 var Q=iDate.value;
 if(Q=='') return;
  if (Q.search(/^\d+-\d\d-\d\d$/)!=0) { 
  	alert('日期格式錯誤');
  	iDate.value='';
  	iDate.focus();
  	return false ;
  	} // bad format
  var T = Q.split('-')
  if (!ValidDate(T[0], T[1]-1, T[2])) { 
  	alert('日期格式錯誤');
  	iDate.value='';
  	iDate.focus();
  	return false ;
  	} // bad value
  return T 
}
function ValidDate(y, m, d) { // m = 0..11 ; y m d integers, y!=0
  with (new Date(y, m, d))
    return (getMonth()==m && getDate()==d) //was y, m 
 }
