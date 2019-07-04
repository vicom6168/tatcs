<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("oldmedical_header");?>

<body>

<div class="container">   
  
<?php $this->load->view("oldmedical_menu");?>
    

       <div class="section">
        <div class="big">
            <div class="box"  id="divChecklist">
                <div class="content forms">
            <div class="messages blue">
           
                 基本資料
                </div>
                   <table>
                    <tr>
                          <td width="15%" >身高：</td> 
                        <td width="15%" ><input type="text" name="bh"  id="bh"  size="5"   value="<?php echo $viewDetail->bh;?>" /> </td>
                       <td width="15%" >體重：</td>
                         <td width="15%" ><input type="text" name="bw"  id="bw"  size="5"  value="<?php echo $viewDetail->bw;?>" /> </td>
                         <td width="15%" >身體質量指數：</td>
                         <td width="15%" ><input type="text" name="bmi"  id="bmi"  size="5"  value="<?php echo $viewDetail->bmi;?>" /> </td>
                    </tr>
                     <tr>
                          <td width="15%" >心跳：</td> 
                        <td width="15%" ><input type="text" name="hr"  id="hr"   size="5"  value="<?php echo $viewDetail->hr;?>" />  </td>
                       <td width="15%" >血壓：</td>
                         <td width="15%" ><input type="text" name="bp"  id="bp"  size="5" value="<?php echo $viewDetail->bp;?>" />  </td>
                         <td width="15%" >&nbsp;</td>
                         <td width="15%" >&nbsp;</td>
                    </tr>
                    </table>
                    
                    <div class="messages blue">
           
                身體檢查(運用頭部和頸部檢查表) 頭部和頸部檢查
                </div>
                   <table>
                         <tr>
                          <td width="100%"  colspan=2>
                                 <div class="messages blue">
           
                臉長臉症候群
                </div>
                              </td> 
                    
                    </tr>
                    <tr>
                          <td width="50%" >眼下黑暈</td> 
                        <td width="50%"> 
                              <input type="radio" name="body1" id="body1_1"  value="0" <?php if($viewDetail->body1=="0") echo "checked";?>/>  無
                            <input type="radio" name="body1" id="body1_2"  value="0" <?php if($viewDetail->body1=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                    <tr>
                          <td width="50%" >張口呼吸</td> 
                        <td width="50%"> 
                              <input type="radio" name="body2" id="body2_1"  value="0" <?php if($viewDetail->body2=="0") echo "checked";?>/>  無
                            <input type="radio" name="body2" id="body2_2"  value="0" <?php if($viewDetail->body2=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >中臉拉長</td> 
                        <td width="50%"> 
                              <input type="radio" name="body3" id="body3_1"  value="0" <?php if($viewDetail->body3=="0") echo "checked";?>/>  無
                            <input type="radio" name="body3" id="body3_2"  value="0" <?php if($viewDetail->body3=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >鼻粘膜萎縮</td> 
                        <td width="50%"> 
                              <input type="radio" name="body4" id="body4_1"  value="0" <?php if($viewDetail->body4=="0") echo "checked";?>/>  無
                            <input type="radio" name="body4" id="body4_2"  value="0" <?php if($viewDetail->body4=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                    
                       <tr>
                          <td width="100%"  colspan=2>口咽氣道</td> 
                    
                    </tr>
                     <tr>
                          <td width="50%" >下頷後縮</td> 
                        <td width="50%"> 
                              <input type="radio" name="body5" id="body5_1"  value="0" <?php if($viewDetail->body5=="0") echo "checked";?>/>  無
                            <input type="radio" name="body5" id="body5_2"  value="0" <?php if($viewDetail->body5=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >低軟顎（修定版的Mallampati分期）</td> 
                        <td width="50%"> 
                              <input type="radio" name="body6" id="body6_1"  value="0" <?php if($viewDetail->body6=="0") echo "checked";?>/>  無
                            <input type="radio" name="body6" id="body6_2"  value="0" <?php if($viewDetail->body6=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >濕軟懸雍垂</td> 
                        <td width="50%"> 
                              <input type="radio" name="body7" id="body7_1"  value="0" <?php if($viewDetail->body7=="0") echo "checked";?>/>  無
                            <input type="radio" name="body7" id="body7_2"  value="0" <?php if($viewDetail->body7=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >紅腫的支柱</td> 
                        <td width="50%"> 
                              <input type="radio" name="body8" id="body8_1"  value="0" <?php if($viewDetail->body8=="0") echo "checked";?>/>  無
                            <input type="radio" name="body8" id="body8_2"  value="0" <?php if($viewDetail->body8=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >扁桃體肥大</td> 
                        <td width="50%"> 
                              <input type="radio" name="body9" id="body9_1"  value="0" <?php if($viewDetail->body9=="0") echo "checked";?>/>  無
                            <input type="radio" name="body9" id="body9_2"  value="0" <?php if($viewDetail->body9=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                     <tr>
                          <td width="50%" >高窄硬腭</td> 
                        <td width="50%"> 
                              <input type="radio" name="body10" id="body10_1"  value="0" <?php if($viewDetail->body10=="0") echo "checked";?>/>  無
                            <input type="radio" name="body10" id="body10_2"  value="0" <?php if($viewDetail->body10=="1") echo "checked";?>/>  有
                            </td>
                    </tr>
                    
                    </table>
                    
                </form>
            </div>
        </div>
        </div>
        <div class="small">
            <div class="box">
                <div class="title">
                    <h2></h2>
                    <span class="hide"></span>
                </div>
                <div class="content">
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>完整系統性評估問卷</th>
                               
                                
                            </tr> 
                        </thead> 
                        <tbody> 
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>full/detail/<?php echo $viewDetail->pid;?>"> 基本資料</a></td>
                            </tr>
                                <tr> 
                                <td><a href="<?php echo base_url(); ?>full/detail1/<?php echo $viewDetail->pid;?>">生理因素</a></td>
                            </tr>
                           
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>full/detail2/<?php echo $viewDetail->pid;?>">第一部份 個人資料</a></td>
                            </tr>
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>full/detail3/<?php echo $viewDetail->pid;?>">第二部分 心理因素部份</a></td>
                            </tr>
                            
                            
                         <tr> 
                                <td><a href="<?php echo base_url(); ?>full/detail4/<?php echo $viewDetail->pid;?>">第三部分 社會因素部份</a></d>
                            </tr>
                            
                            
                            <tr> 
                                <td><a href="<?php echo base_url(); ?>full/detail5/<?php echo $viewDetail->pid;?>">第四部分 環境因素部份</a></td>
                            </tr>
                            
                            
                            
                            
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
  
    
    
 <?php $this->load->view("oldmedical_footer");?>  
    
</div>



</body>

</html> 