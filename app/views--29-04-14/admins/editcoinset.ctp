<?php
$base_url_admin = Configure::read('App.base_url_admin');
 echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
    //echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
    echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
		echo $html->css('/css/jquery_ui_datepicker');
	echo $html->css('timepicker_plug/css/style');

?>
<script type="text/javascript">
    /* <![CDATA[ */
    $(function() {
     /*   $('#datesubmitchipcoBP').datetime({
            userLang : 'en',
            americanMode: false, 
        }); */
      

    });
    /* ]]> */



</script>

<?php
	$checkedpricing=explode(",",$checkedpricing); 
	for($i=0;$i<count($checkedpricing);$i++)
    {
        if(isset($check_qr)=="")
        {
             if($checkedpricing[$i]=="qr")
                $check_qr="checked";
             else
                $check_qr="";
        }$i++;
           
        if(isset($check_serial)=="")
        {
         if($checkedpricing[$i]=="serial")
            $check_serial="checked";
         else
            $check_serial="";
        }$i++;
        if(isset($check_barcode)=="")
        {   
         if($checkedpricing[$i]=="barcode")
            $check_barcode="checked";
         else
            $check_barcode="";
        }
        $i++;
        if(isset($check_uv)=="")
        {   
         if($checkedpricing[$i]=="uv")
            $check_uv="checked";
         else
            $check_uv="";
        }
        $i++;
        if(isset($check_photo)=="")
        {   
         if($checkedpricing[$i]=="photo")
            $check_photo="checked";
         else
            $check_photo="";
        }$i++;
        
        if(isset($check_rfid)=="")
        {   
         if($checkedpricing[$i]=="rfid")
            $check_rfid="checked";
         else
            $check_rfid="";
        }
    }
    
?>

<div class="titlCont1">
    <div style="width:960px; margin:0 auto;">
      
        <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>  
                <?php echo $form->create("Admin", array("action" => "editcoinset/".$recid,'type' => 'file','name' => 'editcoinset_order', 'id' => "editcoinset_order"))?>
        
        <?php echo $form->hidden("Coinset.id", array('id' => 'id','value'=>$recid));  ?>
        <?php echo $form->hidden("Coinset.project_id", array('id' => 'project_id','value'=>$projectid));  ?>
        
             <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span> 
        <span class="titlTxt">
            Edit Coinset
        </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>coinsetlist')"><span> Cancel</span></button></li>
            </ul>
        </div>

    </div>
</div>

</div><!--rightpanel ends here-->

<!--inner-container starts here-->


<div class="rightpanel" style="width:960px; margin:0 auto">
    <?php if($session->check('Message.flash')){ ?> 
        <div id="blck"> 
            <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
                            position: absolute;
                            z-index: 11;" /></a>
                    <?php if($session->check('Message.flash')){ $session->flash(); } 
                        /*echo $form->hidden("shippingvalue", array('id' => 'shippingvalue'));
                        echo $form->hidden("projecttypevalue", array('id' => 'projecttypevalue'));
                        */echo $form->error('Coinset.numunits', array('class' => 'msgTXt'));
                        echo $form->error('Coinset.ship_type_id', array('class' => 'msgTXt'));
                        echo $form->error('Coinset.coinset_name', array('class' => 'msgTXt'));
                        echo $form->error('Coinset.startserialnum', array('class' => 'msgTXt'));
                        echo $form->error('Coinset.endserialnum', array('class' => 'msgTXt'));

                        
                    ?> 
                </div>
                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
            </div>
        </div>
        <?php } ?>

    <!--<div class="">

    <div class="">-->

    <div class="top-bar" style="border-left:0px;">


    </div>

    <!-- ADD Sub Admin FORM BOF -->

    <!-- ADD FIELD BOF -->

    <!--<div class="">    -->
    <div style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);" class="top-bar"> </div>
    <br/>
    <div style="float: right;">
<?php /*
         <div style="margin-left: 100px;">
            <?php echo $form->input("Coinset.use_pre_artwork", array('id' => 'use_pre_artwork', 'div' => false, 'label' => '','type'=>'checkbox'));?> &nbsp;&nbsp;&nbsp;<b> Use Previous Artwork</b>
        </div>
*/?>
        <br /><br />

        <div id="pre_artwork_content" style="float: left; position: relative; text-align: center;">
            <?php if($sidea_image!="")
                {
                ?>
                SIDE A
                <?php echo $html->image('/img/'.$project_name.'/uploads/'.$sidea_image, array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?>
                <?php
                }
                if($sideb_image!="")
                {
                ?>
                SIDE B
                <?php echo $html->image('/img/'.$project_name.'/uploads/'.$sideb_image, array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?><br />
                <?php
                }
                if($edge_image!="")
                {
                ?>
                EDGE
                <?php echo $html->image('/img/'.$project_name.'/uploads/'.$edge_image, array('class'=>'','align'=>'middle'));?>
                <?php
                }
            ?>

        </div>

        <div>

        
            <table width="425px" class="left">
                <tbody>  
                  <?php if(!empty($this->data['Coinset']['sidea'])){?>  
                <tr class="upload_content">
                        <td width="30%" valign="top" align="right">&nbsp;</td>
                        <td width="70%">
                            <span id="divimagecoina" >
                                    <?php echo $html->image('/img/'.$project_name.'/uploads/'.$this->data['Coinset']['sidea'], array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?>
                          </span>
                     </td> 
                </tr>   
                 <tr class="upload_content"><td>&nbsp;</td></tr>
                <?php } ?>
                    
                  <tr class="upload_content">
                        <td width="30%" class="forName" valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Side A Image</label></td>
                        <td width="70%">
                                <span class="intpSpan">
                            <input type="file" value="" class="inpt_txt_fld" id="sidea" name="data[Coinset][coinsidea]"></span>
                                                        <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>   
                              </td>            
                    </tr>  
                    
                     <?php if(!empty($this->data['Coinset']['sideb'])){?> 
                    <tr class="upload_content">
                        <td class="forName" valign="top" align="right">&nbsp;</td>
                        <td class="forName"> <span id="divimagecoina" >
                        <?php echo $html->image('/img/'.$project_name.'/uploads/'.$this->data['Coinset']['sideb'], array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?> </span>
                       </td>
                    </tr>
                        <tr class="upload_content"><td>&nbsp;</td></tr>
                    <?php } ?>
                    
                    <tr class="upload_content">
                        <td valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Side B Image</label></td>
                        <td>  <span class="intpSpan"><input type="file" value="" class="inpt_txt_fld" id="sideb" name="data[Coinset][coinsideb]"></span>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>   
                            </td>
                    </tr>
                     <?php if(!empty($this->data['Coinset']['edge'])){?> 
                      <tr class="upload_content"><td>&nbsp;</td></tr>
                    <tr class="upload_content">
                        <td valign="top" align="right">&nbsp;</td>
                        <td valign="top"><?php echo $html->image('/img/'.$project_name.'/uploads/'.$this->data['Coinset']['edge'], array('class'=>'','align'=>'middle'));?>
                         </td> 
                    </tr>
                       <tr class="upload_content"><td>&nbsp;</td></tr>
                     <?php } ?>
                      
                      <tr class="upload_content">
                        <td valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Edge Image</label></td>
                        <td valign="top">
                           <span class="intpSpan"><input type="file" value="" class="inpt_txt_fld" id="coinedge" name="data[Coinset][coinedge]"></span>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 300x12.</span>
                            <br>&nbsp; 
                         </td> 
                    </tr>
                    
                    <tr>
                        <td valign="top" align="right"  style="padding-top: 7px;"><label class="boldlabel">Serial on side</label></td>
                        <td><!--<span style="width: 0px;" class="txtArea_top">
                                <span class="txtArea_bot"><select style="width: 200px; border: 1px solid rgb(190, 218, 229);" id="serialdisplayside" label="" name="data[Coinset][serialdisplayside]">
                                     <option value="A">Side A</option>
                                        <option value="B">Side B</option>
                                    </select></span></span>-->
                                    <span class="txtArea_top"><span class="txtArea_bot">
                            <?php echo $form->select("Coinset.serialdisplayside",$sides,$serialdisplayside,array('id' => 'serialdisplayside',"class"=>"multilist" ),"---Select---"); ?>

                    </span>   </span> 
                                    
                                    </td>

                    </tr>

                

                    <tr>
                        <td align="right" style="padding-top: 4px;"><label class="boldlabel">Order Date <span style="color: red;">*</span></label></td>
                        <td  style="padding-left: 0px; padding-top: 12px;">    
                        <span class="intpSpan middle"><?php echo $form->text("Coinset.datesubmitchipco_show", array('id' => 'datesubmitchipco', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly', 'value'=> date('m-d-Y', strtotime($this->data['Coinset']['datesubmitchipco'])) ));?></span>&nbsp;</td>
                    </tr>
                          

                    <tr>
                        <td align="right" style="padding-bottom: 16px;"><label class="boldlabel" >Shipping Type <span style="color: red;">*</span></label></td>
                        <td  style="padding-left: 0px; padding-top: 12px;">
                            <span class="txtArea_top">
                            <span class="txtArea_bot">
                                <?php echo $form->select("Coinset.ship_type_id",$shippingdropdown,$selectedshippingtype,array('id' => 'ship_type_id','class'=>'multilist',"onchange"=>"getshippingdays(this.value);", 'disabled'=>'disabled'),"---Select---"); ?>
                            </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>


                    </tr>

                    <tr>
                        <td align="right" style="padding-bottom: 10px;"><label class="boldlabel">Est Ship Date <span style="color: red;"></span></label></td>
                        <td style="padding-left: 0px; padding-top: 12px;">
                            <span class="intpSpan"><?php echo $form->text("Coinset.dateestship_show", array('id' => 'dateestship', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly', 'value'=> date('m-d-Y', strtotime($this->data['Coinset']['dateestship']))));?></span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Auto calculated</span></td>
                    </tr>


                    <tr>
                        <td  align="right" style="padding-bottom: 10px;"><label class="boldlabel">Est Deliver Date <span style="color: red;"></span></label></td>
                        <td  style="padding-left: 0px; padding-top: 12px;">
                            <span class="intpSpan"><?php echo $form->text("Coinset.dateestdelivery_show", array('id' => 'dateestdelivery', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly', 'value'=> date('m-d-Y', strtotime($this->data['Coinset']['dateestdelivery']))));?></span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Auto calculated</span></td>
                    </tr>


                </tbody>
            </table>

        </div>    

    </div>
    <div class="frmbox mgrt115">
        <table cellspacing="0" cellpadding="0" align="center" align="center" width="500px" class="left">
            <tbody>
            <tr>
                <td colspan="5"><?php echo $form->hidden("shippingvalue", array('id' => 'shippingvalue'));
                        echo $form->hidden("projecttypevalue", array('id' => 'projecttypevalue'));
                        if($selectedprojecttype){
                            echo "<script>getprojecttypedays('$selectedprojecttype'); </script>";
                        }   
                ?></td>
            </tr>

            <tr>
                <td width="30%" align="right"><label class="boldlabel">Name <span style="color: red;"></span></label></td>
                <td width="70%" style="padding-left: 31px; padding-top: 12px;">
                    <span class="intpSpan"><?php echo $form->input("Coinset.coinset_name", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>

            </tr>

            <tr>
                <td align="right"><label class="boldlabel"># of Units <span style="color: red;">*</span></label></td>
                <td  style="padding-left: 31px; padding-top: 12px;">

                    <span class="intpSpan"><?php echo $form->input("Coinset.numunits", array('id' => 'units', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "7",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();','readonly'=>'readonly'));?></span></td>
            </tr>


            <tr>
                <td align="right"><label class="boldlabel">Product Type <span style="color: red;">*</span></label></td>
                <td  style="padding-left: 31px; padding-top: 12px;">
                    <span class="txtArea_top"><span class="txtArea_bot">
                            <?php echo $form->select("Coinset.price_type_options_id",$product_pricing,$selectedpricetypeoptions,array('id' => 'price_type_options_id',"class"=>"multilist",'disabled'=>'disabled' ),"---Select---"); ?>

                    </span>   </span> 
                </td>
            </tr>

        </table>  

        <!--        Pricing table     -->

        <table cellspacing="5" cellpadding="0" align="center" align="center" width="500px" class="left" style="margin-top: 30px; margin-bottom: 30px; margin-left: 35px;">

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Setup</td>
                <td>&nbsp;</td>
                <td>Per Unit</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td valign="top" style="padding-top: 4px;">Price</td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.setup", array('id' => 'setup', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td>&nbsp;</td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.per_unit", array('id' => 'per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td colspan="5" valign="top" style="padding-top: 4px;">Additional Options</td>
            </tr>

            <tr>
                <td width="5" valign="top" style="padding-top: 4px;"> 
					<?php echo $form->input("Coinset.check_qr", array('id' => 'check_qr', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled','checked'=>$check_qr));?>
				</td>
                <td width="130" valign="top" style="padding-top: 4px;">
					QR Per Unit
				</td>
                <td width="30"><span class="intpSpan">
					<?php echo $form->input("Pricing.setup_qr", array('id' => 'setup_qr', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" =>"200",'style'=>'width: 50px;text-align:right;','readonly'=>'readonly')); ?> </span>
				</td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.quantity_qr", array('id' => 'quantity_qr', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.qr_per_unit", array('id' => 'qr_per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td width="5" valign="top" style="padding-top: 4px;"> <?php echo $form->input("Coinset.check_serial", array('id' => 'check_serial', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled','checked'=>$check_serial));?></td>
                <td valign="top" style="padding-top: 4px;">Serial Per Unit</td>
                <td width="20"><span class="intpSpan"><?php echo $form->input("Pricing.setup_serial", array('id' => 'setup_serial', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.quantity_serial", array('id' => 'quantity_serial', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.serial_per_unit", array('id' => 'serial_per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td width="5" valign="top" style="padding-top: 4px;" > <?php echo $form->input("Coinset.check_barcode", array('id' => 'check_barcode', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled','checked'=>$check_barcode));?></td>
                <td valign="top" style="padding-top: 4px;">Bar-Code Per Unit</td>
                <td width="20"><span class="intpSpan"><?php echo $form->input("Pricing.setup_barcode", array('id' => 'setup_barcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.quantity_barcode", array('id' => 'quantity_barcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.barcode_per_unit", array('id' => 'barcode_per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td width="5" valign="top" style="padding-top: 4px;"> <?php echo $form->input("Coinset.check_uv", array('id' => 'check_uv', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled','checked'=>$check_uv));?></td>
                <td valign="top" style="padding-top: 4px;">UV Per Unit</td>
                <td width="20"><span class="intpSpan"><?php echo $form->input("Pricing.setup_uv", array('id' => 'setup_uv', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.quantity_uv", array('id' => 'quantity_uv', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.uv_per_unit", array('id' => 'uv_per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td width="5" valign="top" style="padding-top: 4px;"> <?php echo $form->input("Coinset.check_photo", array('id' => 'check_photo', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled','checked'=>$check_photo));?></td>
                <td valign="top" style="padding-top: 4px;">Photo Per Unit</td>
                <td width="20"><span class="intpSpan"><?php echo $form->input("Pricing.setup_photo", array('id' => 'setup_photo', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.quantity_photo", array('id' => 'quantity_photo', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.photo_per_unit", array('id' => 'photo_per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td width="5" valign="top" style="padding-top: 4px;"> <?php echo $form->input("Coinset.check_rfid", array('id' => 'check_rfid', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled','checked'=>$check_rfid));?></td>
                <td valign="top" style="padding-top: 4px;">RFID Per Unit</td>
                <td width="20"><span class="intpSpan"><?php echo $form->input("Pricing.setup_rfid", array('id' => 'setup_rfid', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.quantity_rfid", array('id' => 'quantity_rfid', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
                <td><span class="intpSpan"><?php echo $form->input("Pricing.rfid_per_unit", array('id' => 'rfid_per_unit', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:50px;text-align:right;','readonly'=>'readonly'));?></span></td>
            </tr>

            <tr>
                <td colspan="5"> <hr style="background-color: black;"></td>
            </tr>
    <?php /* 
            <tr>
                <td colspan="3">Total Price Per Unit</td>
                <td colspan="2" align="left" style="padding-left: 141px;" ><span>$</span><span id="totalperunit">0</span></td>
                <?php echo $form->hidden("Coinset.total_per_unit", array('id' => 'total_perunit'));  ?>
            </tr>

            <tr>
                <td colspan="5"> <hr style="background-color: black;"></td>
            </tr>


            <tr>
                <td colspan="2">Total Setup and Units</td>
                <td colspan="2" align="left"><span>$</span><span id="setuptotal">0</span></td>
                <td  align="left" style="padding-left:0px;"><span>$</span><span id="total">0</span></td>
                <?php echo $form->hidden("Coinset.setup_total", array('id' => 'total_setup')); ?>

            </tr>

            <tr>
                <td colspan="5"> <hr style="background-color: black;"></td>
            </tr>


            <tr>
                <td colspan="3">Total Coinset All</td>
                <td colspan="2" align="left" style="padding-left: 141px;"><span>$</span><span id="grandtotal">0</span>
                <?php echo $form->hidden("Coinset.grand_total", array('id' => 'total_grand'));?></td>
            </tr>  
            
*/?>

        </table>
   
        <div class="table-footer" style="width: 530px;">
            
                <div class="left" style="width: 334px;margin-left: 52px;padding-bottom: 10px;">
                    Total Price Per Unit
                </div>
                <div class="right" style="width: 62px;float: left;padding-bottom: 10px;">
                    <div style="float:right"> <!--<span>$</span>--><span id="totalperunit">0</span></div>
                </div>
                <?php echo $form->hidden("Coinset.total_per_unit", array('id' => 'total_perunit'));  ?> 
            
           

            <div class="left" style="width: 334px;margin-left: 52px;">
                <div style="float:left;margin-right:5px;padding-bottom: 10px;">
                    Total Setup and Units
                </div>    
                <div style="float:left;width:auto;text-align:right;margin-right:5px;padding-bottom: 10px;">
                    <!--<span>$</span>-->
                    <span id="setuptotal">$ 0.00</span>
                </div>
            </div>
                 
            <div class="right" style="width: 62px;float: left;">
                <div style="float:right; width: 110px; text-align: right;">
                    
                     <!--<span>$</span>--><span id="total">$ 0.00</span>
                    <?php echo $form->hidden("Coinset.setup_total", array('id' => 'total_setup')); ?>           
                </div>
            </div>
            
            <div class="left" style="width: 334px;margin-left: 52px;padding-bottom: 10px;">
                Total Coinset All
            </div>     
            <div class="right" style="width: 62px;float: left;padding-bottom: 10px;">
                <div style="float:right; width: 110px; text-align: right;"> 
                     <!--<span>$</span>--><span id="grandtotal">$ 0.00</span>
                </div>
            </div>        
            <?php echo $form->hidden("Coinset.grand_total", array('id' => 'total_grand'));?>

        </div> 




        <!--        Pricing table     -->


        <table cellspacing="0" cellpadding="0" align="center" align="center" width="500px" class="left">   
            <tbody>
            
             <!--<tr>
                    <td width="30%" align="right"><label class="boldlabel">Pricing Status</label></td>
                    <td style="padding-left: 8px; padding-top: 12px;">
                        <span class="txtArea_top"><span class="txtArea_bot">
                            <?php echo $form->select("Coinset.pricing_status",$pricing_status,$selectedpricingstatus,array('id' => 'pricing_status',"class"=>"multilist")); ?>

                    </span>   </span> 
                    </td>

                </tr>-->
                <tr>
                    <td width="30%" align="right"><label class="boldlabel">Serial # Prefix</label></td>
                    <td style="padding-left: 8px; padding-top: 12px;">
                        <span class="intpSpan"><?php echo $form->input("Coinset.serialprefix", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:60px;','readonly'=>'readonly'));?></span></td>

                </tr>

                <tr>
                    <td align="right"><label class="boldlabel">Serial # Start <span style="color: red;">*</span></label></td>
                    <?php if($totalreccount > 1){ ?>
                        <td style="padding-top: 12px;" ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                            </span><span class="intpSpan"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly','style'=>'width:80px;'));?></span>

                        </td>

                        <?php }else{ ?>
                        <td style="padding-top: 12px;" ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                            </span><span class="intpSpan"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();','readonly'=>'readonly','style'=>'width:80px;'));?></span></td>
                        <?php } ?>

                </tr>

                <tr>
                    <td align="right"><label class="boldlabel">Serial # End <span style="color: red;">*</span></label></td>
                    <td style="padding-top: 12px;" ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                        </span><span class="intpSpan"><?php echo $form->input("Coinset.endserialnum", array('id' => 'ending', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly','style'=>'width:80px;'));?></span></td>
                </tr>

                <tr>


                <tr>
                    <td align="right"><label class="boldlabel">Verification Code <span style="color: red;"></span></label></td>
                    <td style="padding-left: 8px; padding-top: 12px;">

                        <span class="intpSpan"><?php echo $form->input("Coinset.verifycode", array('id' => 'verifycode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3",'style'=>'width:80px;','readonly'=>'readonly'));?></span></td>
                </tr>

                <!--<tr>
                <td width="15%"><label class="boldlabel">Project Type <span style="color: red;">*</span></label></td>
                <td width="85%">
                <?php //echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  ?>
                <span class="txtArea_top">
                <span class="txtArea_bot">
                <?php// echo $form->select("project_type_id",$projectypedropdown,$selectedprojecttype,array('id' => 'project_type_id','class'=>'multilist'/*,'disabled'=>'disabled'*/),"---Select---");//pr($selectedprojecttype);  ?>
                </span>
                </span></td>
                </tr>-->




            </tbody>
        </table>

    </div>
    <div class="clear"></div> 


    <div class="top-bar" style="margin-bottom: 10px; text-align: left; padding-top: 5px; color: black;">
        <b><span style="color: red;">*</span>Required item </b>
    </div>            
    <!-- ADD Sub Admin  FORM EOF -->

</div></div></div></div>


<!--inner-container ends here-->

<?php echo $form->end();?>


<div class="clear"></div>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
        
        
         var $this = $(this);
         var $units = $("#units");
         var units = $units.val();
         var $optionid = $("#price_type_options_id"); 
         var optionid = $optionid.val(); 
        
         get_all_information(units,optionid); 
         
         $("#price_type_options_id").change(function(){
            var $this = $(this);
            var $units = $("#units");
            var optionid = $this.val();
            var units = $units.val();
            get_all_information(units,optionid);
        });   

        $("#units").change(function(){
            var $this = $(this);
            var $optionid = $("#price_type_options_id");
            var units = $this.val();
            var optionid = $optionid.val();
            get_all_information(units,optionid);
        });
        
        
        function get_all_information(units,optionid){
            if ( units != "" && units != "undefined" && optionid != "" && optionid != "undefined" ){           
                var path = "http://<?php echo $current_url; ?>/admins/get_pricing_details";
                var postdata = {unit : units, option : optionid};
                $.ajax({
                    type:"POST",
                    url: path,
                    data:postdata,
                    dataType:'json',
                    success: function(output){
                        $("#setup").val(CommaFormatted(output.pricing_setup.price_per_unit, "$"));
                        $("#per_unit").val(CommaFormatted(output.pricing_per_unit.price_per_unit, "$"));

                        $("#quantity_qr").val(CommaFormatted(output.pricing_per_unit.qr_per_unit, "$"));
                        $("#setup_qr").val(CommaFormatted(output.pricing_setup.qr_per_unit, "$"));

                        $("#quantity_serial").val(CommaFormatted(output.pricing_per_unit.serial_per_unit, "$"));
                        $("#setup_serial").val(CommaFormatted(output.pricing_setup.serial_per_unit, "$"));

                        $("#quantity_barcode").val(CommaFormatted(output.pricing_per_unit.barcode_per_unit, "$"));
                        $("#setup_barcode").val(CommaFormatted(output.pricing_setup.barcode_per_unit, "$"));

                        $("#quantity_uv").val(CommaFormatted(output.pricing_per_unit.uv_per_unit, "$"));
                        $("#setup_uv").val(CommaFormatted(output.pricing_setup.uv_per_unit, "$"));

                        $("#quantity_photo").val(CommaFormatted(output.pricing_per_unit.photo_per_unit, "$"));
                        $("#setup_photo").val(CommaFormatted(output.pricing_setup.photo_per_unit, "$"));

                        $("#quantity_rfid").val(CommaFormatted(output.pricing_per_unit.rfid_per_unit, "$"));
                        $("#setup_rfid").val(CommaFormatted(output.pricing_setup.rfid_per_unit, "$"));

                        $("#setuptotal").html(CommaFormatted(output.pricing_setup.price_per_unit, "$"));
                        $("#totalperunit").html(CommaFormatted(output.pricing_per_unit.price_per_unit, "$"));

                        do_calculation(); 
                        do_all_check();

                    }
                });
            } 
        }


        function do_calculation(){
            var $units = $("#units");
            var units = $("#units").val();
            var totalperunit =roundNumber( parseFloat(($("#totalperunit").html()).replace("$ ","").replace(",","")), 2);

            var total = roundNumber(parseFloat(totalperunit) * parseFloat(units), 2);
            $("#total").html(CommaFormatted(total, "$"));

            var setuptotal = roundNumber(parseFloat(($("#setuptotal").html()).replace("$ ","").replace(",","")), 2);
            var grandtotal = roundNumber(parseFloat(total) + parseFloat(setuptotal), 2);
            $("#grandtotal").html(CommaFormatted(grandtotal, "$"));


            $("#total_grand").val(CommaFormatted(grandtotal, "$"));
            $("#total_perunit").val(CommaFormatted(totalperunit, "$"));
            $("#total_setup").val(CommaFormatted(setuptotal, "$")); 
            //$("#demototal").val(grandtotal);
        }

        function do_sub_calculation($caller,perunit,setup,$object){

            var totalperunit = parseFloat(($("#totalperunit").html()).replace("$ ","").replace(",",""));
            var setuptotal = parseFloat(($("#setuptotal").html()).replace("$ ","").replace(",",""));  

            if($caller.attr('checked') == true)
                {
                $object.val(CommaFormatted(perunit, "$"));
                totalperunit =roundNumber( totalperunit + parseFloat(perunit), 2);
                setuptotal = roundNumber(setuptotal + parseFloat(setup), 2);   
            }
            else
                {
                $object.val('');
                totalperunit = roundNumber(totalperunit - parseFloat(perunit), 2);
                setuptotal = roundNumber(setuptotal - parseFloat(setup), 2); 
            }
            
            $("#totalperunit").html(CommaFormatted(totalperunit, "$"));
            $("#setuptotal").html(CommaFormatted(setuptotal, "$"));



            do_calculation(); 
        }

        $("#check_qr").click(function(){
            var perunit = $("#quantity_qr").val().replace("$ ","").replace(",","");
            var setup = $("#setup_qr").val().replace("$ ","").replace(",","");
           
            var $object = $("#qr_per_unit");
            var $caller = $(this);
            do_sub_calculation($caller,perunit,setup,$object);
        });

        $("#check_serial").click(function(){
            var perunit = $("#quantity_serial").val().replace("$ ","").replace(",","");
            var setup = $("#setup_serial").val().replace("$ ","").replace(",","");
            var $object = $("#serial_per_unit");
            var $caller = $(this);
            do_sub_calculation($caller,perunit,setup,$object);
        });

        $("#check_barcode").click(function(){
            var perunit = $("#quantity_barcode").val().replace("$ ","").replace(",","");
            var setup = $("#setup_barcode").val().replace("$ ","").replace(",","");
            var $object = $("#barcode_per_unit");
            var $caller = $(this);
            do_sub_calculation($caller,perunit,setup,$object);
        });

        $("#check_uv").click(function(){
            var perunit = $("#quantity_uv").val().replace("$ ","").replace(",","");
            var setup = $("#setup_uv").val().replace("$ ","").replace(",","");
            var $object = $("#uv_per_unit");
            var $caller = $(this);
            do_sub_calculation($caller,perunit,setup,$object);
        });

        $("#check_photo").click(function(){
            var perunit = $("#quantity_photo").val().replace("$ ","").replace(",","");
            var setup = $("#setup_photo").val().replace("$ ","").replace(",","");
            var $object = $("#photo_per_unit");
            var $caller = $(this);
            do_sub_calculation($caller,perunit,setup,$object);
        });

        $("#check_rfid").click(function(){
            var perunit = $("#quantity_rfid").val().replace("$ ","").replace(",","");
            var setup = $("#setup_rfid").val().replace("$ ","").replace(",","");
            var $object = $("#rfid_per_unit");
            var $caller = $(this);
            do_sub_calculation($caller,perunit,setup,$object);
        });
        
        
        function roundNumber(num, dec) {
            var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
            return result;
        }


        function CommaFormatted(amount, is_currency)
        {
            amount=amount.toString();
            var delimiter = ","; // replace comma if desired
            var a = amount.split('.',2)
            var d = a[1];
            var i = parseInt(a[0]);
            if(isNaN(i)) { return ''; }
            var minus = '';
            if(i < 0) { minus = '-'; }
            i = Math.abs(i);
            var n = new String(i);
            var a = [];
            while(n.length > 3)
            {
                var nn = n.substr(n.length-3);
                a.unshift(nn);
                n = n.substr(0,n.length-3);
            }
            if(n.length > 0) { a.unshift(n); }
            n = a.join(delimiter);
            i
            if(d){
                
                if(d.length < 1) { 
                    amount = n; 
                }
                else{ 
                          if(d.length == 1){
                           amount = n + '.' + d+'0';  
                        }else{
                          amount = n + '.' + d;   
                        }
                } 
                
            }else{
                amount = n+".00";
            }
            if(is_currency){
                amount =  is_currency +" " + minus + amount; 
            }else{
                amount = minus + amount;
            }

            return amount;
        }

        function do_all_check(){
            
            var perunit = $("#quantity_qr").val().replace("$ ","").replace(",","");
            var setup = $("#setup_qr").val().replace("$ ","").replace(",","");
            var $object = $("#qr_per_unit");
            var $caller = $("#check_qr");
            if($caller.attr('checked'))
                do_sub_calculation($caller,perunit,setup,$object);
            
            perunit = $("#quantity_serial").val().replace("$ ","").replace(",","");
            setup = $("#setup_serial").val().replace("$ ","").replace(",","");
            $object = $("#serial_per_unit");
            $caller = $("#check_serial");
             if($caller.attr('checked'))
                do_sub_calculation($caller,perunit,setup,$object);
            
            perunit = $("#quantity_barcode").val().replace("$ ","").replace(",","");
            setup = $("#setup_barcode").val().replace("$ ","").replace(",","");
            $object = $("#barcode_per_unit");
            $caller = $("#check_barcode");
             if($caller.attr('checked'))
                do_sub_calculation($caller,perunit,setup,$object);
            
            perunit = $("#quantity_uv").val().replace("$ ","").replace(",","");
            setup = $("#setup_uv").val().replace("$ ","").replace(",","");
            $object = $("#uv_per_unit");
            $caller = $("#check_uv");
             if($caller.attr('checked'))
                do_sub_calculation($caller,perunit,setup,$object);
            
            perunit = $("#quantity_photo").val().replace("$ ","").replace(",","");
            setup = $("#setup_photo").val().replace("$ ","").replace(",","");
            $object = $("#photo_per_unit");
            $caller = $("#check_photo");
             if($caller.attr('checked'))
                do_sub_calculation($caller,perunit,setup,$object);
            
            perunit = $("#quantity_rfid").val().replace("$ ","").replace(",","");
            setup = $("#setup_rfid").val().replace("$ ","").replace(",","");
            $object = $("#rfid_per_unit");
            $caller = $("#check_rfid");
             if($caller.attr('checked'))
                do_sub_calculation($caller,perunit,setup,$object);
        }

        $("#pre_artwork_content").hide();
         $(".upload_content").show();

        $("#use_pre_artwork").click(function(){
            var setuptotal = parseFloat($("#setuptotal").html().replace("$ ","").replace(",",""));
            var setup = parseFloat($("#setup").val().replace("$ ","").replace(",",""));
            if(($("#use_pre_artwork").attr('checked') == true)){
                setuptotal = setuptotal - setup;
                $("#setuptotal").html(CommaFormatted(setuptotal, "$"));
                $("#pre_artwork_content").show();               
                $(".upload_content").hide();
               
                if($("#check_serial").attr('checked') == true){
                    setuptotal = setuptotal - parseFloat($("#setup_serial").val().replace("$ ","").replace(",","")); 
                    $("#setuptotal").html(CommaFormatted(setuptotal, "$"));
                }
                
                $("#setup_serial").val(CommaFormatted(0, "$"));
                $("#setup").val(CommaFormatted(0, "$"));
                
                do_calculation();
               
           }
            else
                {
                $("#pre_artwork_content").hide();
                 $(".upload_content").show();
                var units = $("#units").val();
                var optionid = $("#price_type_options_id").val();
                get_all_information(units,optionid);
            }

          

        });

    });
</script>

