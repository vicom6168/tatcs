<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>
 
<body>

<div class="container">   
  

    
    <div class="section">
        <div class="full">
            <div class="box">
                 
                <div class="content" style="width:500px;height:880px;overflow:auto;">
                    <table>
                        <tr>
                            <td style="padding : 2px 8px;line-height : 30px;background-color: #79BAEC"><b>凡病患資料有以下情況之一者皆為未完成</b></td>
                        </tr>
                         <tr>
                            <td style="padding : 2px 8px;line-height : 30px;background-color: #D0FA58">1.   Patient profile未完成</td>
                        </tr>
                        <tr>
                            <td>
                                  <ul>
                        <li>Patient Name 空白 </li>
                        <li>Patient Chart Number 空白 </li>
                        <li>Patient Gender 空白</li>
                        <li>Patient Birth Date 空白</li>
                        </ul>
                            </td>
                        </tr>
                         <tr>
                            <td style="padding : 2px 8px;line-height : 30px;background-color: #D0FA58">2.   Operation procedures未完成</td>
                        </tr>
                          <tr>
                            <td>
                             <ul>
                                    <li>1.  Operation Date 空白 </li>
                           <li>2.   Surgeon1, Surgeon2,Surgeon3, Surgeon4全部沒選</li>
                           <li>3. Congenital surgery (Any congenital cardiac diagnosis) 沒打勾, 以下項目全部沒選
                              <ul>
                                <li>Diagnosis 1,Diagnosis 2,Diagnosis 3,Diagnosis 4,Diagnosis 5,Diagnosis Others</li>
                                </ul>
                        </li>
                        
                        <li>4. Congenital surgery (Any congenital cardiac diagnosis) 沒打勾, 且以下項目皆未選
                            <ul>
                                <li>(1) CABG</li>
                                <li>(2) Aortic valve surgery</li>
                                <li>(3) Aortic surgery</li>
                                <li>(4) Mitral valve surgery</li>
                                <li>(5) Arrhythmia surgery</li>
                                <li>(6) Tricuspid valve surgery</li>
                                <li>(7) Pulmonary valve surgery</li>
                                <li>(8) Heart transplant & Mechanical support</li>
                                <li>(9) Other cardiac surgery</li>
                             </ul>
                         </li>
                         <li>5. Congenital surgery (Any congenital cardiac diagnosis) 有打勾, 且以下項目皆未選
                              <ul>
                                <li>Congenital Diagnosis 1,Diagnosis 2,Diagnosis 3,Diagnosis 4,Diagnosis 5,Diagnosis Others</li>
                                </ul>
                             </li>
                             
                              <li>6. Congenital surgery (Any congenital cardiac diagnosis) 有打勾, 且以下項目皆未選
                              <ul>
                                <li>Primary Procedure 1,Secondary Procedure 1,Secondary Procedure 2,Secondary Procedure 3,Secondary Procedure 4,Procedure Others</li>
                                </ul>
                             </li>
                               <li><font color='blue'>7. OP Date > 2019-01-01 的病患, Cardiopulmonary Bypass未選取</font>
                             
                             </li>
                             
                    </ul>
                            </td>
                        </tr>
                         <tr>
                            <td style="padding : 2px 8px;line-height : 30px;background-color: #D0FA58">3.   Outcome Result未完成</td>
                        </tr>
                          <tr>
                            <td>
                                 <ul>
                        <li>1.  Discharge Date 空白 </li>
                        <li><s>2.  Extubation date空白</s> </li>
                        <li>3.  出院狀況空白 </li>
                        </ul>
                            </td>
                        </tr>
                    </table>
                    
                   
                    <br/>
                   
                </div>
            </div>
        </div>
    </div>
    
   
</div>
</body>

</html> 