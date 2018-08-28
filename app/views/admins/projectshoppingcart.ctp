<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
?>

<div class="container clearfix">      
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">            	
                <h2>Shopping Cart</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>editprojectdtl')"><?php e($html->image('cancle.png')); ?></button>	
                    <?php  echo $this->renderElement('new_slider');  ?>
                </div>				
            </div>
            <!--<?php  //echo $this->renderElement('project_name');  ?> 
            <span class="titlTxt">   Shopping Cart</span>-->
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                         <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>editprojectdtl')"><span> Cancel</span></button></li>    
                </ul><?php */?>
            </div>
        </div>
 
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php    $this->loginarea="admins";    $this->subtabsel="projectshoppingcart";
		                    
			if($_GET['url'] === 'admins/projectshoppingcart/0'){
			echo $this->renderElement('setting_submenus');
			}else{
			echo $this->renderElement('setup_submenus');
			
			}					
			echo $javascript->link('/js/myiFrame.js');               
 		?>    
    </div>
</div>
     
<div class="midCont" id="newcoinsettab">
        <div class="table-responsive">
             <table class="table table-bordered table-striped" width="100%" align="center" cellpadding="1" cellspacing="1">
                  <tr>
                    <td width="100%" colspan=2 style="vertical-align:top" >
                   <!--  <script type="text/javascript" src="http://localhost:9090/js/myiFrame.js"></script>-->
                   <?php 
                   if($shoppingCartData){
                   // CART URL for local
                   $carturl=$shoppingCartData['ProjectShoppingCart']['shop_adminurl']."?route=common/login&projectshop=".$shoppingCartData['ProjectShoppingCart']['shop_adminuser']."_".$shoppingCartData['ProjectShoppingCart']['shop_adminpassword']."_".$project_id; 
                   
                  // $carturl="http://localhost/oc_imagecoin/upload/admin/index.php?route=common/login&projectauto=".$project_id;
                   // CART URL for Live  Server   
                  // $carturl="http://imagecoins.com/ocart/admin/index.php?route=common/login&projectauto=".$project_id;
                   ?>
                    <iframe id="formiframe" scrolling="no" frameborder="0"   src="<?php echo $carturl; ?>" style="border: none; width : 990px; height: 1000px;"  ></iframe>
                                      <!--     <iframe width='990px' style='height: 1000px;' src='http://imagecoins.com/ocart/admin/index.php?route=common/login&projectauto=74'></iframe> 
    <object data="http://imagecoins.com/ocart/admin/index.php?route=common/login&projectauto=74" type="text/html" width="990" height="1000">
                            <a href="http://imagecoins.com/ocart/admin/index.php?route=common/login&projectauto=74">Cart</a>
                        </object>     -->
                        <?php }else{
                            echo "Shopping is not enabled for this project!";
                        }?>
                    </td>
                  </tr>
                  <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  </tr>    
                  </table>
        </div>
     </div>   
    <div class="clear"></div>
</div>     
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {        
        document.getElementById("newcntlist").className = "newmidCont";
    }    
</script>




