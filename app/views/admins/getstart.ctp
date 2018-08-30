<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
$dt=$value[0]['GetStart']['getdata'];
?>
<div class="container">      
 	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
			   <?php  //echo $this->renderElement('project_name');  ?>
                <h2>Get Started</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>editprojectdtl')"><?php e($html->image('cancle.png')); ?></button>
                    <?php  echo $this->renderElement('new_slider');  ?>
                </div>
                
            </div>
        </div>
    
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="admins";    $this->subtabsel="getstart";
		echo $this->renderElement('setup_submenus');  ?> 
    </div>
</div> 

     
<div class="midCont table-responsive" id="newcoinsettab">
           <table class="table table-borderless" width="100%" align="center" cellpadding="1" cellspacing="1">
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




