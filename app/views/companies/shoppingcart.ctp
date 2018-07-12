  <script language="javascript" type="text/javascript">
<!--
function popitup(url) {
    newwindow=window.open(url,'name','height=700,width=850');
    if (window.focus) {newwindow.focus()}
    return false;
}

// -->
</script>



<div class="boxBg1">



  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    <!--&nbsp;&nbsp;&nbsp;<font size="+2" color="black"><?php // echo ucfirst($project_name)."'s";?> Events</font><br />-->
           <table width="100%" align="center" cellpadding="1" cellspacing="1">
              <tr>
                <td width="100%" colspan=2 style="vertical-align:top" >
               <!--  <script type="text/javascript" src="http://localhost:9090/js/myiFrame.js"></script>-->
                 <?php 
                    if($shoppingCartData){   
                        if($username==""){
                             $projectshop="";
                        }else{
                              $projectshop=$usercartemail."_".$userecartpassword."_".$project_id;  
                        }
                        
                        if($pagealise=="checkout"){
                            $qpage="checkout";
                        }else if($pagealise=="shopping-cart"){
                            $qpage="cart";
                        }else{
                            $qpage="add";    
                        }
               // CART URL for local     -&q=".$qpage."&projectshop=".$shoppingCartData['ProjectShoppingCart']['shop_adminuser']."_".$shoppingCartData['ProjectShoppingCart']['shop_adminpassword']."_".$project_id
                $carturl=$shoppingCartData['ProjectShoppingCart']['shop_fronturl']."?route=common/home"; 

               ?>
               
               <iframe id="formiframe" scrolling="no" frameborder="0"   src="<?php echo $carturl; ?>" style="border: none; width : 890px; height: 1000px;"  ></iframe>
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
   
    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>




