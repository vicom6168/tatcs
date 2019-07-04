<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$role[1]="VS";
$role[2]="Senior R";
$role[3]="Junior R";
$role[4]="NP";
$role[9]="Other";
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
       <div class="section">
        <div class="big">
            <div class="box"  id="divPatientProfiles">
                <div class="content forms">
                <div class="title">
                    <h2>System Setting</h2>
                </div>
                
              
                    <form action="<?php echo base_url(); ?>parameter/saveSetting" method="post">
                     
                      
                         <div class="line">
                            <label>啓用術前評估</label>
                             <input type="checkbox" class="checkbox"  name="c1" id="c1"  value="1" <?php if($setting->c1=='1') echo "checked";?> onclick="chkEvaluation();"><label for="c1">啓用&nbsp;&nbsp;</label>  &nbsp; 
                             
                        </div>
                         <div class="line">
                            <label>由病患資料列表中新增病患資料</label>
                             <input type="checkbox" class="checkbox"  name="c2" id="c2"  value="1" <?php if($setting->c2=='1') echo "checked";?> onclick="chkEvaluation();"><label for="c2" id="c2Label">可新增&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                           <div class="line">
                            <label>專科醫師手術資料上傳學會</label>
                             <input type="checkbox"  class="checkbox"  name="c3" id="c3"  value="1" <?php if($setting->c3=='1') echo "checked";?>><label for="c3">上傳&nbsp;&nbsp;</label>  &nbsp; 
                            
                        </div>
                    <div class="line button">
                           
                            <button type="submit" class="blue medium"><span>送出</span></button>
                            <button type="reset" class="blue medium"><span>重填</span></button>
                        </div>
                  
               
                </form>
            </div>
        </div></div>
          <?php $this->load->view("parameter/menu");?>
        </div>
  
    
 <?php $this->load->view("footer");?>  
    
</div>
<script>

$.notify("<?php echo $Msg;?>", "info");
    function chkEvaluation(){
        if(!$('#c1').is(':checked') && !$('#c2').is(':checked') ){
             $('#c2').prop("checked", true);
             $('#c2Label').addClass("checked");
             $('#c2').notify("未使用術前評估, 則必定要由病患資料列表中新增病患資料", "info");
        }
        
    }
</script>


</body>

</html> 