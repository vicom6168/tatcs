<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>Non-Open Heart</h2>
                    
                </div>
                   <div class="linewithoutindention">
                       
                         <select name="qryHospital" id="qryHospital" class="big">
                                   <option value="0">請選取醫院</option>
                                      <?php 
                            foreach($hospitalList->result() as $row){
                                     ?>
                                     <option value="<?php echo $row->hospitalName;?>" <?php if($qHospital==$row->hospitalName) echo "selected";?>><?php echo $row->hospitalName;?></option>
                                     <?php } ?>
                                   </select>
                           年：
                        <select name="qYear" id="qYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2010;$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qYear) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>
                                   月：
                                     <select name="qMonth" id="qMonth" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$qMonth) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>
                      <button type="submit" class="greenmediumspecial" id="queryButton" onclick="queryNonOpenHeart();"><span>查詢</span></button>
                         
             </div>
                <div class="" id="myContent" style="width: 96%; margin: auto;">
                      <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap></th>
                                <th nowrap>Item </th>
                                <th nowrap>definition </th>
                               <th nowrap>No.</th>
                            
                            </tr> 
                        </thead> 
                        <tbody> 
                          <tr> 
                                <td>1</td>
                                <td>Endovascular approach great vessel surgery</th>
                                <td><ul>
                                    <li>Endovascular aortic aneurysm repair (EVAR)</li>
                                    <li>Thoracic endovascular aortic aneurysm repair (TEVAR)</li>
                                    <li>Catheter-assisted thrombolysis for pulmonary embolism (EKOS)</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item1"   id="item1"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                              <tr> 
                                <td>2</td>
                                <td> Central venous surgery</th>
                                <td><ul>
                                    <li>Central venous bypass grafting</li>
                                    <li>Central venous stenting / stent grafting</li>
                                    <li>Central veinous percutaneous transluminal angioplasty</li>
                                    <li>IVC filter implantation</li>
                                    <li>IVC filter retrieval </li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item2"   id="item2"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>3</td>
                                <td> Supra-aortic artery surgery</th>
                                <td><ul>
                                    <li>Carotid artery endarterectomy</li>
                                    <li>Carotid artery PTA ± stenting</li>
                                    <li>Vertebral artery reimplantation</li>
                                    <li>Vertebral artery PTA ± stenting</li>
                                    <li>Supra-aortic artery bypass surgery</li>
                                    <li>Other supra-aortic artery PTA ± stenting</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item3"   id="item3"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>4</td>
                                <td>Surgery for visceral vessel disease</th>
                                <td><ul>
                                    <li>SMA PTA ± stenting</li>
                                    <li>Renal artery PTA ± stenting</li>
                                    <li>Visceral artery bypass surgery</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item4"   id="item4"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>5</td>
                                <td> Surgery for peripheral artery disease </th>
                                <td><ul>
                                    <li>Percutaneous transluminal angioplasty ± stenting (PTA ± stenting) for peripheral artery disease</li>
                                    <li>Catheter-assisted thrombolysis for peripheral artery disease (EKOS)</li>
                                    <li>Peripheral artery open bypass procedure</li>
                                    <li>Embolectomy</li>
                                    <li>Coil embolization</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item5"   id="item5"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>6</td>
                                <td> Surgery for peripheral venous disease</th>
                                <td><ul>
                                    <li>Endovenous Radio Frequency/ Endovenous laser treatment (EVRF/EVLT)</li>
                                    <li>Phlebectomy</li>
                                    <li>Surgical stripping for varicose vein</li>
                                    <li>High ligation/ division for varicose vein</li>
                                    <li>Open thrombectomy for deep vein thrombosis (DVT)</li>
                                    <li>Catheter-assisted thrombolysis for deep vein thrombosis (EKOS)</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item6"   id="item6"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>7</td>
                                <td> Surgery for vascular access</th>
                                <td><ul>
                                    <li>Port-A implantation</li>
                                    <li>Permcath catheter implantation</li>
                                    <li>Native arteriovenous fistula (AVF)</li>
                                     <li>Arteriovenous graft (AVG)</li>
                                    <li>Percutaneous transluminal angioplasty ± stenting (PTA ± stenting) for malfunction of AVF/AVG</li>
                                    <li>AVF/AVG revision/ thrombectomy</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item7"   id="item7"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>8</td>
                                <td> ECMO implantation</th>
                                <td><ul>
                                    <li>VA-ECMO implantation</li>
                                    <li>VV-ECMO implantation</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item8"   id="item8"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                             <tr> 
                                <td>9</td>
                                <td> Other intrathoracic surgery</th>
                                <td><ul>
                                    <li>Mediastinal tumor excision</li>
                                    <li>Pericardial window </li>
                                    <li>Diaphragm plication</li>
                                    <li>Ligation of thoracic duct</li>
                                </ul>     
                                </td>
                               <td>  <input type="text" name="item9"   id="item9"  size=5  class="verysmall"    value="" /></td>
                            </tr> 
                              </tbody>
                            </table>
                            <table>
                             
                                 </tbody>
                            </table>
                
                </div>
                <br/>
            </div>
        </div>
        
        <?php $this->load->view("nonopenheart/list");?>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>
 $(document).ready(function() {
  
queryNonOpenHeart();
querynonopenheartlist();
 });    

</script>

</body>

</html> 