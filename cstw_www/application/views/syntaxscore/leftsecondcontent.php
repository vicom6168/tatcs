      <div style="margin-top: 20px;">
    <DIV id='overDiv' style='position:absolute; visibility:hidden; z-index:1000;'></div>
      <TABLE cellSpacing="0" cellPadding="0" class="maintable" id="formmaintable">
        <TR>
          <TD class="body" vAlign="top">
        <SPAN class="title">Please fill in the following variables :</SPAN><br><br>
          </TD>
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable">
          <TR>
            <TD class="body" vAlign="top" width="300">
              <div class="darkred"><b>4. Total occlusion (T.O.)</b></div>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: No intra-luminal antegrade flow (TIMI 0) beyond the point of occlusion. However, antegrade flow beyond the total occlusion might be maintained by bridging collaterals and/or ipsi collaterals.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a>
            </TD>
          </TR>
          <TR>
            <TD class="body" vAlign="top" height="41">
              <FORM action="form.htm" method="post" id="formq4" onsubmit="javascript:return false;">
            <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="0" name="totaloc" id="totaloc1" onclick="javascript:Question4(false,this);"> No<br>
            <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="1" name="totaloc" id="totaloc2" onclick="javascript:Question4(true,this);"> Yes:<br><br>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>     
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable"  id="q4i" style="display:none;">
          <TR>
            <TD style="padding-left:35px;" vAlign="top">
              <FORM action="form.htm" method="post" id="formq4i" onsubmit="javascript:return false;">
            I. Indicate the first segment number of the T.O.&nbsp;<a href='#' onMouseOver="javascript:return overlib('Select the segment where the occlusion starts.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
            <TABLE border="1" cellpadding="0" cellspacing="0" class="selecttable">
             <div id='divbuildSegmentTable'></div>
            </TABLE>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>     
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable"  id="q4ii" style="display:none;">
          <TR>
            <TD style="padding-top:10px;padding-left:35px;" vAlign="top">
              <FORM action="form.htm" method="post" id="formq4ii" onsubmit="javascript:return false;">
            II. is Age of T.O. > 3 months?<br>
            <span class="radiobuttontext2">&nbsp;</span>1. <INPUT type="radio" value="1" name="3months" onclick="javascript:Question4II(0);" id="q4iir1"> No<br>
            <span class="radiobuttontext2">&nbsp;</span>2. <INPUT type="radio" value="2" name="3months" onclick="javascript:Question4II(1);" id="q4iir2"> Yes<br>
            <span class="radiobuttontext2">&nbsp;</span>3. <INPUT type="radio" value="3" name="3months" onclick="javascript:Question4II(2);" id="q4iir3"> Unknown<br>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>     
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable"  id="q4iii" style="display:none;">
          <TR>
            <TD style="padding-top:10px;padding-left:35px;" vAlign="top">
              <FORM action="form.htm" method="post" id="formq4iii" onsubmit="javascript:return false;">
            III. Blunt stump?<br>
            <span class="radiobuttontext2">&nbsp;</span>1. <INPUT type="radio" value="1" name="bluntstump" onclick="javascript:Question4III(0);" id="q4iiir1">  No<br>
            <span class="radiobuttontext2">&nbsp;</span>2. <INPUT type="radio" value="2" name="bluntstump" onclick="javascript:Question4III(1);" id="q4iiir2"> Yes<br><br>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>     
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable"  id="q4iv" style="display:none;">
          <TR>
            <TD style="padding-top:10px;padding-left:35px;" vAlign="top">
              <FORM action="form.htm" method="post" id="formq4iv" onsubmit="javascript:return false;">
            IV. Bridging?&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: small channel running in parallel to the vessel and connecting proximal vessel to distal vessel and being responsible for the ipsi collateralization.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
            <span class="radiobuttontext2">&nbsp;</span>1. <INPUT type="radio" value="1" name="bridging" onclick="javascript:Question4IV(0);" id="q4ivr1"> No<br>
            <span class="radiobuttontext2">&nbsp;</span>2. <INPUT type="radio" value="2" name="bridging" onclick="javascript:Question4IV(1);" id="q4ivr2"> Yes<br><br>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>     
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable"  id="q4v" style="display:none;">
          <TR>
            <TD style="padding-top:10px;padding-left:35px;" vAlign="top">
              <FORM action="form.htm" method="post" id="formq4v" onsubmit="javascript:return false;">
            V. Specify the first segment number beyond the total occlusion that is<br>visualized by <b>antegrade or retrograde</b> contrast.<br>
            <div ID="q4vitable">
            
            </div>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>     
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable"  id="q4vi" style="display:none;">
          <TR>
            <TD style="padding-top:10px;padding-left:35px;" vAlign="top">
              <FORM action="form.htm" method="post" id="formq4vi" onsubmit="javascript:return false;">
            VI. Is there a sidebranch at the origin of the occlusion?<br>
            <span class="radiobuttontext2">&nbsp;</span>1. <INPUT type="radio" value="0" name="sidebranch" onclick="javascript:Question4VI(0);" id="q4vir1"> No<br>
            <span class="radiobuttontext2">&nbsp;</span>2. <INPUT type="radio" value="1" name="sidebranch" onclick="javascript:Question4VI(1);" id="q4vir2"> Yes, all sidebranches <1.5mm<br>
            <span class="radiobuttontext2">&nbsp;</span>3. <INPUT type="radio" value="2" name="sidebranch" onclick="javascript:Question4VI(2);" id="q4vir3"> Yes, all sidebranches >=1.5mm<br>
            <span class="radiobuttontext2">&nbsp;</span>4. <INPUT type="radio" value="3" name="sidebranch" onclick="javascript:Question4VI(3);" id="q4vir4"> Yes, both sidebranches <1.5mm and >=1.5mm are involved<br>
              </FORM>
            </TD>
          </TR>
        </TABLE>
          </TD>
        </TR>
        <TR>
          <TD>
        <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q5" style="display:none;">
          <TR>
            <TD class="body" vAlign="top">
              <FORM action="form.htm" method="post" id="formq5" onsubmit="javascript:return false;">
            <b><div class="darkred">5. Trifurcation</div></b>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: A trifurcation is a division of a mainbranch into three branches of at least 1.5mm. Only those segment numbers of the trifurcation that have a Diameter Stenosis at least 50% in direct contact with the trifurcation should be scored.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
            <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="0" name="Trifurcation" onclick="javascript:ShowQ5No();" id="q5r1"> No<br>
            <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="Trifurcation" onclick="javascript:ShowQ5Yes();" id="q5r2"> Yes</span>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Question 5 can only once be ticked ��yes� for the following combinations: 3/4/16/16a,  5/6/11/12, 6/7/9/9a, 7/8/10/10a, 11/13/12a/12b.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q5yes" style="display:none;">
      <TR>
    <TD style="padding-left:35px;" vAlign="top">
      <FORM action="form.htm" method="post" id="formq5yes" onsubmit="javascript:return false;">
        <table cellpadding="0" cellspacing="0">
          <tr>
        <td class="bullet2">i.
        </td>
        <td><INPUT type="radio" value="1" name="q5yes" onclick="javascript:Question5(1);" id="q5r2y1">
        </td>
        <td class="tdtext">1 diseased segment involved
        </td>
          </tr>
          <tr>
        <td class="bullet2">ii.
        </td>
        <td><INPUT type="radio" value="2" name="q5yes" onclick="javascript:Question5(2);" id="q5r2y2">
        </td>
        <td class="tdtext">2 diseased segments involved
        </td>
          </tr>
          <tr>
        <td class="bullet2">iii.
        </td>
        <td><INPUT type="radio" value="3" name="q5yes" onclick="javascript:Question5(3);" id="q5r2y3">
        </td>
        <td class="tdtext">3 diseased segments involved
        </td>
          </tr>
          <tr>
        <td class="bullet2">iv.
        </td>
        <td><INPUT type="radio" value="4" name="q5yes" onclick="javascript:Question5(4);" id="q5r2y4">
        </td>
        <td class="tdtext">4 diseased segments involved
        </td>
          </tr>
        </table>
      </FORM>
    </TD>
      </TR>
    </TABLE>
  </TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q6" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq6" onsubmit="javascript:return false;">
        <div class="darkred"><b>6. Bifurcation</b></div>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: A bifurcation is a division of a main, parent, branch into two daughter branches of at least 1.5mm. Bifurcation lesions may involve the proximal main vessel, the distal main vessel and the side branch according to the Medina classification. The smaller of the two daughter branches should be designated as the side branch.<br>Only those segment numbers of the bifurcation that have a Diameter Stenosis of at least 50% in direct contact with the bifurcation should be scored.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="Bifurcation" onclick="Question6No();" id="q6r1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="Bifurcation" onclick="javascript:Question6Yes('1');" id="q6r2"> Yes</span>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Question 6 can only once be ticked ��yes� for the following combinations: 3/4/16, 5/6/11, 6/7/9, 7/8/10, 11/12a/13, 13/14/14a<br><br>2 contiguous ostium lesions (e,g, segments 6+11, 9+7, 8+10 or 4+16 should also be considered as a Bifurcation lesion according to Medina 0,1,1).', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q6yes1" style="display:none;">
      <TR>
    <TD style="padding-left:35px;" vAlign="top">
      <FORM action="form.htm" method="post" id="formq6yes1" onsubmit="javascript:return false;">
        <table cellpadding="0" cellspacing="0" ID="Table1">
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="1" name="ABC" onclick="javascript:Question6P1('A');" id="q6r2yp1x1">                                                 </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_a.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 1,0,0
        </td>
          </tr>
          
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="2" name="ABC" onclick="javascript:Question6P1('B');" id="q6r2yp1x2">
        </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_b.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 0,1,0
        </td>
          </tr>
          
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="2" name="ABC" onclick="javascript:Question6P1('C');" id="q6r2yp1x3">
        </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_c.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 1,1,0
        </td>
          </tr>
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="2" name="ABC" onclick="javascript:Question6P1('D');" id="q6r2yp1x4">
        </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_d.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 1,1,1
        </td>
          </tr>
          
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="2" name="ABC" onclick="javascript:Question6P1('E');" id="q6r2yp1x5">
        </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_e.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 0,0,1
        </td>
          </tr>
          
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="2" name="ABC" onclick="javascript:Question6P1('F');" id="q6r2yp1x6">
        </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_f.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 1,0,1
        </td>
          </tr>
          
          <tr>
        <td class="bullet2">&nbsp;
        </td>
        <td><INPUT type="radio" value="2" name="ABC" onclick="javascript:Question6P1('G');" id="q6r2yp1x7">
        </td>
        <td class="tdtext"><IMG SRC="<?php echo base_url(); ?>images/side_g.png" BORDER="0" width="42" height="60"></td><td>&nbsp;Medina 0,1,1
        </td>
          </tr>
        </table>
      </FORM>
    </TD>
      </TR>
    </TABLE>
  </TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q6yes2" style="display:none;">
      <TR>
    <TD class="body" style="padding-left:35px;">
      <FORM action="form.htm" method="post" id="formq6yes2" onsubmit="javascript:return false;">
        <b>Bifurcation angulation&nbsp;(between distal<br>main vessel and side branch) &lt; 70�</b>&nbsp;<a href='#' onMouseOver="javascript:return overlib('The Bifurcation angulation should be assessed in the projection with the highest angulation.', CAPTION, 'Information');"   onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="angle" onclick="javascript:Question6P2(0);" id="q6r2yp2x1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="angle" onclick="javascript:Question6P2(1);" id="q6r2yp2x2"> Yes</span><br><br>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q7" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq7" onsubmit="javascript:return false;">
        <div class="darkred"><b>7. Aorto Ostial lesion</b></div><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="question7" onclick="javascript:Question7(0);" id="q7r1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="question7" onclick="javascript:Question7('1');" id="q7r2"> Yes</span>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: a lesion is classified as ostial when it is located immediately at the origin of the vessel from the aorta (applies only to segments 1 and 5, or to segment 6 and 11 in case of double ostium of the LCA). ', CAPTION, 'Information');"    onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q8" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq8" onsubmit="javascript:return false;">
        <div class="darkred"><b>8. Severe Tortuosity</b></div>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: defined as one or more bends of 90� or more, or three or more bends of 45� to 90� proximal of the diseased segment.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="question8" onclick="javascript:Question8(0);" id="q8r1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="question8" onclick="javascript:Question8(1);" id="q8r2">  Yes</span>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q9" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq9" onsubmit="javascript:return false;">
        <div class="darkred"><b>9. Length >20 mm</b></div>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: estimation of the length of that portion of the stenosis that has >= 50% reduction in luminal diameter in the projection where the lesion appears to be the longest (In case of a bifurcation lesion at least one of the branches has a lesion length >20mm).', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="question9" onclick="javascript:Question9(0);" id="q9r1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="question9" onclick="javascript:Question9(1);" id="q9r2"> Yes</span>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q10" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq10" onsubmit="javascript:return false;">
        <div class="darkred"><b>10. Heavy calcification</b></div>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: multiple persisting opacifications of the coronary wall are visible in more than one projection, surrounding the complete lumen of the coronary artery at the site of the lesion.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="question10" onclick="javascript:Question10(0);" id="q10r1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="question10" onclick="javascript:Question10(1);" id="q10r2"> Yes</span>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>
<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q11" style="display:none;">
      
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq11" onsubmit="javascript:return false;">
        <div class="darkred"><b>11. Thrombus</b></div>&nbsp;<a href='#' onMouseOver="javascript:return overlib('Definition: Intra coronary thrombus is defined as spheric ovoid or irregular intraluminal filling defect or lucency surrounded on three sides by contrast medium seen just distal or within a coronary stenosis in multiple projections, or a visible embolization of intraluminal material downstream.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border="0" src='<?php echo base_url(); ?>images/moreinfo.gif' width="16" height="16" align="top"></a><br>
        <span class="radiobuttontext">&nbsp;</span>a. <INPUT type="radio" value="1" name="question11" onclick="javascript:Question11(0);" id="q11r1"> No<br>
        <span class="radiobuttontext">&nbsp;</span>b. <INPUT type="radio" value="2" name="question11" onclick="javascript:Question11(1);" id="q11r2"> Yes</span>
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>

<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q12second" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq12" onsubmit="javascript:return false;">
        <TABLE cellSpacing="0" cellPadding="0" class="maintable" ID="Table2">
          <TR bgColor="#FFFFFF">
        <TD class="body" vAlign="top">
          <b>12. "Diffuse disease"/small vessels.</b>&nbsp;
          <a href="#" onMouseOver="javascript:return overlib('Definition: >75% of the length of the segment has a vessel diameter of <=2mm, irrespective of the presence or absence of a lesion.', CAPTION, 'Information');" onMouseOut="javascript:return nd();"><img border=0 src='<?php echo base_url(); ?>images/moreinfo.gif' width=16 height=16  align=top ></a>
        </TD>
          </tr>

          <tr>
        <TD class="body">
          <span class="radiobuttontext">&nbsp;</span><INPUT type="radio" value="1" name="Lesion"  onClick="javascript:Question12('0');"> No<br>
          <span class="radiobuttontext">&nbsp;</span><INPUT type="radio" value="2" name="Lesion"  onClick="javascript:Question12('1');"> Yes<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If Yes, specify <b><u>all</u></b> segment numbers irrespective<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;of the presence or absence of a lesion.</span>
</TD>
</TR>
</TABLE>    
</FORM>
</TD>
</TR>
</TABLE>
</TD>
</TR>


<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="q12yessecond" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formq12yessecond" onsubmit="javascript:return false;">
        <table border="0" cellpadding="0" cellspacing="0"  class="selecttable">
          <tr>
        <td style="width:100px;text-align:center;">&nbsp;</td>
        <td style="width:100px;text-align:center;">Segment<br>numbers:</td>
        <td style="width:200px;text-align:center;">"Diffuse disease"/small vessels.<br><div style="font-size:10px;">(> 75% of the length of the <br>segment has a vessel<br> diameter of <= 2mm, irrespective<br>of the presence or absence of a lesion.)</div></td>
                                                                                                    </tr>
          
        
          
          <tr>
        <td colspan="3" class="buttontd" height="21" nowrap><input type="submit" value="next" border="0" width="50" height="21" onClick="javascript:saveDiffuseSegment();"></td>
          </tr>                     
        </table>    
      </FORM>
    </TD>
      </TR>
    </TABLE>
  </TD>
</TR>



<TR>
  <TD>
    <TABLE cellpadding="0" cellspacing="0" class="maintable" ID="comment" style="display:none;">
      <TR>
    <TD class="body" vAlign="top">
      <FORM action="form.htm" method="post" id="formcomment" onsubmit="javascript:return false;">
        <b>Comment</b><br><textarea class="comment" id="thecomment"></textarea>
      </FORM>
    </TD>
      </TR>
    </TABLE>
  </TD>
</TR>
</TABLE>
<TABLE cellpadding="o" cellspacing="0"  id="savebutton" style="display:none;">
  <TR>
    <TD class="body" style="text-align:right;width:434px;">
      <a name="z" onclick="javascript:Save();"><input type="button" value="continue" border="0" width="50" height="21" style="height:30px"></a>
    </TD>
  </TR>
</TABLE>
</div>
