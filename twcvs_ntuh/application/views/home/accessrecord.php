<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");
$currenYear=Date('Y');
$role[1]="VS";
$role[2]="Senior R";
$role[3]="Junior R";
$role[4]="NP";
$role[9]="Other";
$background[1]="e6ccff";
$background[2]="#ddff99";
$background[3]="#66ff99";
$background[4]="#ffcce6";
$background[9]="#ccccb3";
?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="big">
            <div class="box">
                <div class="title">
                    <h2>Access Record</h2>
                    
                </div>
                    <form action="<?php echo base_url(); ?>home/accessrecord" method="post">
                   <div class="linewithoutindention">
                    <div class="linewithoutindention">
                       <select name="qryUser" id="qryUser" class="long">
                                   <option value="">請選取使用者 </option>
                                  <?php  foreach($userList->result() as $row){ ?>
                                      <option style="background-color:<?php echo $background[$row->userRole];?>;" value="<?php echo $row->userID;?>"  <?php if($row->userID==$qryUser) echo "selected";?>> <?php echo $role[$row->userRole]."：".$row->userRealname;?></option>
                                   <?php } ?>
                                   </select>,    
                                  <select name="sYear" id="sYear" class="small">
                                   <option value="">                 </option>
                                   <?php for($i=2017;$i<=$currenYear;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$sYear) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>年,
                            
                                     <select name="sMonth" id="sMonth" class="small">
                                   <option value="">                 </option>
                                      <?php for($i=1;$i<=12;$i++) {?>
                                   <option value="<?php echo $i;?>"  <?php if($i==$sMonth) echo "selected";?>><?php echo $i;?></option>
                                   <?php } ?>
                                   </select>       月
                      <button type="submit" class="greenmediumspecial"><span>送出</span></button>
                         
             </div>
                         
             </div>
             </form>
                <div class="Content" id="myContent" >
                     <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                 <th nowrap>No.</th>
                                
                                <th nowrap>Date</th>
                                <th nowrap>User</th>
                             
                                <th nowrap>IP</th>
                                <th nowrap>Description</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                             <?php 
                            $i=0;
                            $j=0;
                            foreach($accessList->result() as $row){
                                $j++;
                            ?>
                            <tr> 
                                <td><?php echo $j;?></td>
                                <td><?php echo $row->accesstime;?></td>
                                <td><?php echo $row->uname;?></td>
                                <td><?php echo $row->accessip;?></td>
                                <td><?php 
                                if($row->accesstype=="D" || $row->accessresult=="F"){
                                 echo '<font color=red>'.str_replace($row->uname,'',$row->accessstr).'</font>';
                                } else {
                                echo str_replace($row->uname,'',$row->accessstr);
                                }
                                ?></td>
                                
                              
                            </tr>
                            <?php } ?>
                               
                        </tbody> 
                    </table>
                     <br/>
                <?php echo $Pagination_str; ?>
                 <br/>
                </div>
                
               
                                
            </div>
        </div>
        
        <?php $this->load->view("parameter/menu");?>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>


</body>

</html> 