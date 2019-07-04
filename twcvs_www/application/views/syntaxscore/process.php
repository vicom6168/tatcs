   <script language="javascript" type="text/javascript">
      <!--
      function drawEditLesionList() {
          for( var i = 1; i <= parent.meNumberOfLesions; i++ ) {
             var index = i - 1;
             document.write('<option value="' + index + '">' + i + '</option>');
              }
      }

      function drawDeleteLesionList() {
          for( var i = 1; i <= parent.meNumberOfLesions; i++ ) {
             var index = i - 1;
             document.write('<option value="' + index + '">' + i + '</option>');
              }
      }

      function confirmAndRemove(lesionNumber) {
           index = parseInt(lesionNumber) + 1
           answer = confirm("Are you sure you want to delete lesion " + index + " ?" );
           if( answer ) {
               parent.removeLesion(parseInt(lesionNumber));
           }
          }

      /** Function checks if first entry of meCompletedLesions is true, to make
              sure we will not continue without any lesions
       **/
      function checkAndContinueToQ12(){
           if( ! meCompletedLesions[0] ) {
               alert('Please complete at least one lesion');
           return;
               }
           else {
           //   parent.setFrameUrl('right','question12.htm');
           var mybuildDiffuseSegmentTable;
           mybuildDiffuseSegmentTable=buildDiffuseSegmentTable();
        //   alert(mybuildDiffuseSegmentTable);
            $('#q12Content').html(mybuildDiffuseSegmentTable);
           callHideShow('divSyntaxScoreQ12');
               }
      }
      //-->
    </script>

  <div style="height: 100%; width: 100%; padding: 0px; margin: 0px; text-align: center;">
    <div style="height: 200px; width: 80%; text-align: center; ">   
      <form id="menu" onsubmit="javascript:return false;">
    
      
        <table style="text-align: left; border: 1px solid #dddddd;" cellpadding="5">    
      <tr>
        <td width="50"><img src="<?php echo base_url(); ?>images/Add.jpg"></td>
        <td width=100%>Add another lesion </td>
        <td><input  type="button" value="Add lesion" border="0" width="50" height="21" onClick="NextLesion();" style="height: 50px"></td>
      </tr>
    </table>        

    <br>
    <table style="text-align: left; border: 1px solid #dddddd;" cellpadding="5">    
      <tr>
        <td width="50"><img src="<?php echo base_url(); ?>images/Next.jpg"></td>
        <td width=100%>All lesions are completed </td>
        <td><input  type="button" value="Proceed" border="0" width="50" height="21" onClick="checkAndContinueToQ12();"   style="height: 50px"></td>
      </tr>
    </table>    
    <br>     

 
    
    
    
    </div>    
  </div>