<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
$dt=$value[0]['GetStart']['getdata'];
?>
 <div class="container">      
 <div class="titlCont"><div style="width:960px; margin:0 auto;">
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">	
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>editprojectdtl')"><?php e($html->image('cancle.png')); ?></button>
<?php  echo $this->renderElement('new_slider');  ?>			
			</div>    
             <?php  echo $this->renderElement('project_name');  ?> 
            <span class="titlTxt">   Get Started            </span>


  
                      
 <?php    $this->loginarea="admins";    $this->subtabsel="getstart";
                    echo $this->renderElement('setup_submenus');  ?> 
                    
        </div></div>

     
     <div class="midCont" id="newcoinsettab">
           <table width="100%" align="center" cellpadding="1" cellspacing="1">
              <tr>
                <td width="100%" colspan=2 style="vertical-align:top" >
                  <?php echo $dt;?>
                </td>
              </tr>
              <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>    
              </table>
     </div>   
    <div class="clear"></div>
</div>     
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {        
        document.getElementById("newcntlist").className = "newmidCont";
    }    
</script>




