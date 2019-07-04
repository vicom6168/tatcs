<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php $this->load->view("header");?>

<body>

<div class="container">   
  
<?php $this->load->view("menu");?>
    
    <div class="section">
        <div class="full">
            <div class="box">
                <div class="title">
                    <h2>各科別訂床列表</h2>
                    
                </div>
                <div class="content">
                    <span class="date">訂床日期</span>
                            <input type="text" class="datepicker" value="<?php echo $queryDate;?>" />
           
                <div class="messages orange">
                    <span></span>
                    重要提醒：序號為各科的訂位順序，不是入住順序，若床位不足，則以total quota床數少者優先。
                </div>
           
                    <table cellspacing="0" cellpadding="0" border="0" class="sorting" width=100%> 
                        <thead> 
                            <tr> 
                                <th nowrap>序號</th>
                                <th nowrap>科別</th>
                                <th nowrap>病患來源</th>
                                <th nowrap>病歷號碼</th>
                                <th nowrap>姓名</th>
                                <th nowrap>性別</th>
                                <th nowrap>主治醫師</th>
                                <th nowrap>診斷</th>
                                <th nowrap>床等需求</th>
                                <th nowrap>不要的床等</th>
                                <th nowrap>訂床者</th>
                                <th nowrap>手機</th>
                                <th nowrap>分配</th>
                                <th nowrap></th>
                            </tr> 
                        </thead> 
                        <tbody> 
                            <tr> 
                                <td>1</td>
                                <td><a href="#">一般外科</a></td>
                                <td> 門診</td>
                                <td>張豫蓉</td>
                                <td>2247665</td>
                                <td>周宗興</td>
                                <td>女</td>
                                <td>Pneumonia, s/p bipolar hemiarthroplasty</td>
                                <td>雙或健保</td>
                                <td>無特殊需求</td>
                                <td>陳淑敏</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                </td>
                            </tr>
                              <tr> 
                                <td>1</td>
                                <td><a href="#">Vestibulum ante ipsum primis</a></td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                </td>
                            </tr>
                           <tr> 
                                <td>1</td>
                                <td><a href="#">Vestibulum ante ipsum primis</a></td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>1</td>
                                <td><a href="#">Vestibulum ante ipsum primis</a></td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>1</td>
                                <td><a href="#">Vestibulum ante ipsum primis</a></td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>First, Lastname</td>
                                <td>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>1</td>
                                <td><a href="#">Vestibulum ante ipsum primis</a></td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>Published</td>
                                <td>26th August 2011</td>
                                <td>First, Lastname</td>
                                <td>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-edit.png" alt="edit" /></a>
                                    <a href="#"><img src="<?php echo base_url(); ?>gfx/icon-delete.png" alt="delete" /></a>
                                </td>
                            </tr>
                        </tbody> 
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    
    
 <?php $this->load->view("footer");?>  
    
</div>





</body>

</html> 