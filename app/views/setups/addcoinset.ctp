<?php
	$base_url = Configure::read('App.base_url');
	$backUrl = $base_url.'setups/coinsetlist';
    echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
    echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
	echo $html->css('/css/jquery_ui_datepicker');
	echo $html->css('timepicker_plug/css/style');
?>
<script type="text/javascript">
    /* <![CDATA[ */
    $(function() {
           $('#datesubmitchipco').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    americanMode: true, 
                    changeYear:true
                });   

    });
    /* ]]> */
</script>
<div class="container">     
<div class="titlCont">
<div class="myclass">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">  
<?php echo $form->create("Setups", array("action" => "addcoinset",'type' => 'file','name' => 'addcoinset', 'id' => "addcoinset",'onsubmit'=>'return validatecoinset("add")'))?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
</div>
<div class="topTabs" style="height:25px;"></div>
        <span class="titlTxt">
            Coinset Setup
        </span>


<?php    $this->loginarea="setups";    $this->subtabsel="coinsetlist";
                    echo $this->renderElement('setup_submenus');  ?> 
  </div>			
	
 

    
</div>
<!--inner-container starts here-->


<div class="centerPage" id="newsetttab">
    <?php if($session->check('Message.flash')){ ?> 
        <div id="blck"> 
            <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="<?php echo $backurl ?>img/close.png" alt="" style="margin-left: 945px;
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
    
    <?php
        if(isset($sidea_image)!="" || isset($sideb_image)!="" || isset($edge_image)!="")
        {
            ?>
        <div style="margin-left: 100px;">
            <?php echo $form->input("Coinset.use_pre_artwork", array('id' => 'use_pre_artwork', 'div' => false, 'label' => '','type'=>'checkbox'));?> &nbsp;&nbsp;&nbsp;<b> Use Previous Artwork</b>
        </div>
    <?php }?>
        <br /><br />

        <div id="pre_artwork_content" style="position: relative; text-align: center; min-height: 150px; min-width: 360px; display: none;">
            <?php if($sidea_image!="")
                {
                ?>
                SIDE A
                <?php echo $html->image('/img/cckiller/upload/'.$sidea_image, array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?><br />
                <?php
                }
                if($sideb_image!="")
                {
                ?>
                SIDE B
                <?php echo $html->image('/img/cckiller/upload/'.$sideb_image, array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?><br />
                <?php
                }
                if($edge_image!="")
                {
                ?>
                EDGE
              <?php echo $html->image('/img/'.$project_name.'/upload/'.$edge_image, array('class'=>'','align'=>'middle'));?><br />
                <?php
                }
            ?>
            <br /><br />
        </div>
        <div>
            <table width="425px" class="left">
                <tbody>   
                <tr class="upload_content">
                        <td width="30%" valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Side A Image <span style="color: red;">*</span></label></td>
                        <td width="70%"> <span class="intpSpan">
                            <input type="file" value="" class="inpt_txt_fld" id="sidea" name="data[Coinset][coinsidea]"></span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Click over the image for Original view.</span>
                            <?php if(!empty($this->data['Coinset']['sidea'])){ echo $project_name;die("hi");?> 
                                <span id="divimagecoina" >
                                    <div align="left"><img src="<?php echo "/img/".$project_name."/uploads/". $this->data['Coinset']['sidea'] ;?>"></div> 
                                </span>
                                <?php }else{ ?></td><?php } ?>
                    </tr>    
                    <tr class="upload_content">
                        <td valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Side B Image <span style="color: red;">*</span></label></td>
                        <td> <span class="intpSpan"><input type="file" value="" class="inpt_txt_fld" id="sideb" name="data[Coinset][coinsideb]"></span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>    
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Click over the image for Original view.</span>
                            <?php if(!empty($this->data['Coinset']['sideb'])){?> 
                                <span id="divimagecoina" >

                                    <div align="left"><img src="<?php echo "/img/".$project['Project']['project_name']."/uploads/". $this->data['Coinset']['sideb'] ;?>"></div> 
                                </span>

                                <?php }else{ ?></td><?php } ?>
                    </tr>
                    <tr class="upload_content">
                        <td valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Edge Image <span style="color: red;">*</span></label></td>
                        <td valign="top"> <span class="intpSpan"><input type="file" value="" class="inpt_txt_fld" id="coinedge" name="data[Coinset][coinedge]"></span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 300x12.</span>
                            <br>&nbsp; </td> 
                    </tr>
                    <tr>
                        <td valign="top" align="right" style="padding-top: 7px;"><label class="boldlabel">Serial on side</label></td>
                        <td>    <span class="txtArea_top">
                            <span class="txtArea_bot">
                            <select class="multilist" id="serialdisplayside" label="" name="data[Coinset][serialdisplayside]">
                                        <option value="A">Side A</option>
                                        <option value="B">Side B</option>
                                    </select></span></span></td>

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
                        echo $form->hidden("producttypedeliverydays", array('id' => 'producttypedeliverydays'));
                        if($selectedprojecttype){
                         //   echo "<script>getprojecttypedays('$selectedprojecttype'); </script>";
                        }   
                ?></td>
            </tr>

            <tr>
                <td width="30%" align="right"><label class="boldlabel">Name <span style="color: red;"></span></label></td>
                <td width="70%" style="padding-left: 31px; padding-top: 12px;">
                    <span class="intpSpan"><?php echo $form->input("Coinset.coinset_name", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>isset($coinsetname)?$coinsetname:'01','readonly'=>'readonly'));?></span></td>

            </tr>

            <tr>
                <td align="right"><label class="boldlabel"># of Units <span style="color: red;">*</span></label></td>
                <td  style="padding-left: 31px; padding-top: 12px;">

                    <span class="intpSpan"><?php echo $form->input("Coinset.numunits", array('id' => 'units', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "7",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();'));?></span></td>
            </tr>
        </table>  

        <table cellspacing="0" cellpadding="0" align="center" align="center" width="500px" class="left">   
            <tbody>
                <tr>
                    <td width="30%" align="right"><label class="boldlabel">Serial # Prefix </label></td>
                    <td style="padding-left: 31px; padding-top: 12px;">
                        <span class="intpSpan"><?php echo $form->input("Coinset.serialprefix", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'style'=>'width:60px;'));?></span></td>

                </tr>

                <tr>
                    <td align="right"><label class="boldlabel">Serial # Start <span style="color: red;">*</span></label></td>
                    <?php if(isset($totalreccount) > 1){ ?>
                        <td style="padding-top:12px;padding-left:31px;" ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                            </span><span class="intpSpan"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>"$lastserno",'readonly'=>'readonly','style'=>'width:80px;'));?></span>

                        </td>

                        <?php }else{ ?>
                        <td style="padding-top: 12px;padding-left:31px;" ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                            </span><span class="intpSpan"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>"$lastserno",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();','style'=>'width:80px;'));?></span></td>
                        <?php } ?>

                </tr>

                <tr>
                    <td align="right"><label class="boldlabel">Serial # End <span style="color: red;">*</span></label></td>
                    <td style="padding-top: 12px;padding-left:31px;" ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                        </span><span class="intpSpan"><?php echo $form->input("Coinset.endserialnum", array('id' => 'ending', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>"$lastserno",'readonly'=>'readonly','style'=>'width:80px;'));?></span></td>
                </tr>

                <tr>


                <tr>
                    <td align="right"><label class="boldlabel">Verification Code <span style="color: red;"></span></label></td>
                    <td style="padding-left: 31px; padding-top: 12px;">

                        <span class="intpSpan"><?php echo $form->input("Coinset.verifycode", array('id' => 'verifycode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3",'style'=>'width:80px;'));?></span></td>
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
        <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
    </div>            
    <!-- ADD Sub Admin  FORM EOF -->

</div></div></div></div>


<!--inner-container ends here-->

<?php echo $form->end();?>


<div class="clear"></div>    
<script language="javascript" type="text/javascript">
        function get_all_information(units,optionid){
            if ( units != "" && units != "undefined" && optionid != "" && optionid != "undefined" ){           
                var path = baseUrlAdmin+"get_pricing_details";
                var postdata = {unit : units, option : optionid};
                $.ajax({
                    type:"POST",
                    url: path,
                    cache:false,
                    data:postdata,
                    dataType:'json',
                    success: function(output){
                        if(output==0){
                            alert("No pricing for this entered units.Pelase adjust units.");
                            return false;
                        }else{
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
                            $("#totalperunit").html(CommaFormatted(roundNumber(output.pricing_per_unit.price_per_unit, 2), "$"));

                            if(($("#use_pre_artwork").attr('checked') == true)){
                                // if user previous arrtwork is checked on then setup values 0
                                $("#setup_serial").val(CommaFormatted(0, "$"));
                                $("#setup").val(CommaFormatted(0, "$"));
                            }

                            do_calculation(); 
                            
                        }


                    }
                });
            } 
        }
        $("#pre_artwork_content").hide();
        $(".upload_content").show();

        $("#use_pre_artwork").click(function(){
            if(($("#use_pre_artwork").attr('checked') == true)){
               // setuptotal = setuptotal - setup;
               // $("#setuptotal").html(CommaFormatted(setuptotal, "$"));
                $("#pre_artwork_content").show();               
                $(".upload_content").hide();
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
    function roundNumber(num, dec) {
        var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
        return result;
    }
    
    
    
    // Fuction to make given number to US number faormat - i.e. 1,000.00 
    function CommaFormatted(amount, is_currency)
   {//alert("amount : "+amount);
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
            if(d){ //alert("D "+d);
                if(d.length < 1) { amount = n; }
                else {  
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
</script>

