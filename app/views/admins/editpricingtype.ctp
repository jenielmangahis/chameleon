<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'pricingtype';
$id=$this->params['pass']['0'];
?>

<div class="container">
<div class="titlCont1"><div style="width:960px;margin:0 auto">
       <?php echo $form->create("Admins", array("action" => "editpricingtype/$id",'name' => 'editpricingtype', 'id' => "editpricingtype",'onsubmit' => 'return validatepricingtype("add");'))?>
        <div align="center" id="toppanel" >
        <div id="panel">
                <div class="content clearfix">
                        <H1> Help</h1>
                        <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
                </div>
        </div> <!-- /login -->  
        <!-- The tab on top --> 
        <div class="tab">
                <ul class="login">
                        <li id="toggle"><a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a><a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>               
                        </li>
                </ul> 
        </div>
</div>
<span class="titlTxt">Add Pricing Types </span>
<div class="topTabs">
     
          <ul>
                

        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                </ul>
        </ul>
        </div>
</div></div>
      <div class="boxBor1">
<br>
  <div class="boxPad">
  <div class="">




<div style="width: 960px; margin: 0pt auto; align:left;">     
 
<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
                    <?php  $session->flash();    ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php } ?>


<br /><br />

        
        <table width="100%" align="center" cellpadding="1" cellspacing="12">
        <tr>
            <td colspan='5'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('ProductType.product_type_name', array('class' => 'errormsg'));
                        ?></td>
        </tr>
        
         <?php echo $form->hidden("PricingType.id", array('id' => 'typeid')); ?>
         <?php echo $form->hidden("PricingType.set_product_id", array('id' => 'product_id','value'=>$product_id)); ?>
        
        <tr>
        <td width="120" align="right"><label class="boldlabel">Relation Type <span class="red">*</span></label></td>
        <td>
        <?php  echo $form->radio("PricingType.relation_type", array('Direct'=>'Direct','3rd Party'=>'3rd Party'), array('default'=>'Direct','id'=>'relation_type', 'legend'=>false,'style'=>'margin-right:10px;margin-left:20px;')); ?>      
        </td>
        <td width="100">&nbsp;</td>
        <td align="right">
        Waive Setup Fees Add'l Orders
        </td>
        <td>
        <?php echo $form->input("PricingType.waive_setup", array('id' => 'waive_setup', 'div' => false, 'label' => '','type'=>'checkbox'));?>
        </td>
        </tr>
        
        
        <tr>
        <td width="120" align="right"><label class="boldlabel">Product Type <span class="red">*</span></label></td>
        <td>
        <?php echo $form->select("PricingType.product_id",$product_types,$product_id,array('default'=>'$product_id','id' => 'product_id','class'=>'inpt_sel_fld','style'=>"margin-left: 20px;",'disabled'=>"disabled")); ?>
        </td>
        <td width="100">&nbsp;</td>
        <td align="right">
        Count Prior Orders in Quantity Order
        </td>
        <td>
        <?php echo $form->input("PricingType.count_quantity", array('id' => 'count_quantity', 'div' => false, 'label' => '','type'=>'checkbox'));?>
        </td>
        </tr>
        
        <tr>
        <td width="120" align="right"><label class="boldlabel">PricingTypeName<span class="red">*</span></label></td>
        <td style="padding-left: 20px;">
         <span class="intpSpan">
        <?php echo $form->input("PricingType.pricing_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'disabled'=>"disabled"));?>
        </span>
        </td>
        <td width="100">&nbsp;</td>
       <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        
       </table>
       
        <table width="100%" align="center" cellpadding="0" cellspacing="5">
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">Coin Quantity </td>
       
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.coin_quantity.$i", array('id' => 'coin_quantity_'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['coin_quantity']));?>
        </span>
         <?php echo $form->hidden("PricingType.coin_quantity_id.$i", array('id' => 'coin_quantity_id'.$i,'value'=>$coin_units[$i]['pricing_coin_quantities']['id'])); ?>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td align="center"><b>Setups</b></td>
        </tr>
        
        <tr>
        <td colspan="11"><hr style=" background-color: black;"></td>
        </tr>
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">Price Per Unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.price_per_unit.$i", array('id' => 'price_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['price_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.price_per_unit.setup", array('id' => 'price_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups['0']['pricing_setups']['price_per_unit']));?>
        </span></td>
        </tr>
        
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">Additional Options</td>
        
        <?php
        /*
    for($i=0;$i<8;$i++)
    {
?>
        <td>
        <span class="intpSpan">
        <?php echo $form->input("PricingType.add_opts.$i", array('id' => 'add_opts'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i][pricing_coin_quantities][additional_options]));?>
        </span>
        </td>
        
<?php
    }     */
?>
        <td width="50">&nbsp;</td>
        <td><!--<span class="intpSpan">
        <?php //echo $form->input("PricingType.add_opts.setup", array('id' => 'add_opts_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups[0][pricing_setups][additional_options]));?>
        </span>--></td>
        </tr>
        
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">QR Per unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right"> 
        <span class="intpSpan">
        <?php echo $form->input("PricingType.qr_per_unit.$i", array('id' => 'qr_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['qr_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.qr_per_unit.setup", array('id' => 'qr_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups['0']['pricing_setups']['qr_per_unit']));?>
        </span></td>
        </tr>
        
        
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">Serial # Per Unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.serial_per_unit.$i", array('id' => 'serial_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['serial_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.serial_per_unit.setup", array('id' => 'serial_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups[0]['pricing_setups']['serial_per_unit']));?>
        </span></td>
        </tr>
        
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">Bar Code Per Unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.barcode_per_unit.$i", array('id' => 'barcode_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['barcode_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.barcode_per_unit.setup", array('id' => 'barcode_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups['0']['pricing_setups']['barcode_per_unit']));?>
        </span></td>
        </tr>
        
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">UV Code Per Unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.uv_per_unit.$i", array('id' => 'uv_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['uv_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.uv_per_unit.setup", array('id' => 'uv_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups['0']['pricing_setups']['uv_per_unit']));?>
        </span></td>
        </tr>
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">Photo Code Per Unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.photo_per_unit.$i", array('id' => 'photo_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['photo_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.photo_per_unit.setup", array('id' => 'photo_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups['0']['pricing_setups']['photo_per_unit']));?>
        </span></td>
        </tr>
        
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 45px;">RFID Code Per Unit</td>
        
        <?php
    for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("PricingType.rfid_per_unit.$i", array('id' => 'rfid_per_unit'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$coin_units[$i]['pricing_coin_quantities']['rfid_per_unit']));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td><span class="intpSpan">
        <?php echo $form->input("PricingType.rfid_per_unit.setup", array('id' => 'rfid_per_unit_setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;",'value'=>$setups['0']['pricing_setups']['rfid_per_unit']));?>
        </span></td>
        </tr>
        
        </table>

        <br /><br />
        
        <table width="100%" align="center" cellpadding="1" cellspacing="5">
        <tr>
       <td valign='top' width="120" align="right" style="padding-right: 45px;">
       <label class="boldlabel">Notes </td>
       <td>
       <span class="txtArea_top">
       <span class="txtArea_bot"><?php echo $form->textarea("PricingType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>
        </span>
        </span>
        </td>
        </tr>
         <!--<tr><td colspan="4"><b>Any item with a</b>  "<span class="red">*</span>"  <b>requires an entry.</b> </td></tr>-->
        </table>
        
<?php echo $form->end();?>
<!-- ADD Sub Admin  FORM EOF -->

</div></div></div></div>



<div class="clear"></div>


<!--container ends here-->

