<?php
$base_url = Configure::read('App.base_url');
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
<div class="titlCont">
    <div class="slider-centerpage clearfix">
        <div class="center-Page col-sm-6">
            <h2>Coinset Setup</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
            <div class="icon-container">
                <?php echo $form->create("Setups", array("action" => "editcoinset/".$recid,'type' => 'file','name' => 'editcoinset_order', 'id' => "editcoinset_order"))?>
				<?php echo $form->hidden("Coinset.id", array('id' => 'id','value'=>$recid));  ?>
                <?php echo $form->hidden("Coinset.project_id", array('id' => 'project_id','value'=>$projectid));  ?>     
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url?>setups/coinsetlist')"><?php e($html->image('cancle.png')); ?></button>
				<?php  echo $this->renderElement('new_slider');  ?>
            </div>
        </div>
    </div>
</div>

</div><!--rightpanel ends here-->

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php $this->loginarea="setups";    $this->subtabsel="coinsetlist";
			echo $this->renderElement('setup_submenus');  ?>   
    </div>
</div>


<!--inner-container starts here-->


<div class="midCont clearfix">
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
    <div class="frmbox mgrt115">
        <table cellspacing="0" cellpadding="0" align="center" align="center" width="90%" class="left">
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
                <td width="70%" >
                    <span class="intp-Span"><?php echo $form->input("Coinset.coinset_name", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly'));?></span></td>

            </tr>

            <tr>
                <td align="right"><label class="boldlabel"># of Units <span style="color: red;">*</span></label></td>
                <td  >

                    <span class="intp-Span"><?php echo $form->input("Coinset.numunits", array('id' => 'units', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "7",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();','readonly'=>'readonly'));?></span></td>
            </tr>
        </table> 
    
         




        <!--        Pricing table     -->


        <table cellspacing="0" cellpadding="0" align="center" align="center" width="90%" class="left">   
            <tbody>        
                <tr>
                    <td width="30%" align="right"><label class="boldlabel">Serial # Prefix</label></td>
                    <td >
                        <span class="intp-Span"><?php echo $form->input("Coinset.serialprefix", array('id' => 'name', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'style'=>'width:100%;','readonly'=>'readonly'));?></span></td>

                </tr>

                <tr>
                    <td align="right"><label class="boldlabel">Serial # Start <span style="color: red;">*</span></label></td>
                    <?php if($totalreccount > 1){ ?>
                        <td  ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                            </span><span class="intp-Span"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly','style'=>'width:100%;'));?></span>

                        </td>

                        <?php }else{ ?>
                        <td  ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                            </span><span class="intp-Span"><?php echo $form->input("Coinset.startserialnum", array('id' => 'startser', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'onkeyup'=>'setcoinsetinfo();','onkeydown'=>'setcoinsetinfo();','onchange'=>'setcoinsetinfo();','blue'=>'setcoinsetinfo();','readonly'=>'readonly','style'=>'width:100%;'));?></span></td>
                        <?php } ?>

                </tr>

                <tr>
                    <td align="right"><label class="boldlabel">Serial # End <span style="color: red;">*</span></label></td>
                    <td  ><span style="display:block;float:left;padding-top:3px;padding-right:5px;">
                        </span><span class="intp-Span"><?php echo $form->input("Coinset.endserialnum", array('id' => 'ending', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly','style'=>'width:100%;'));?></span></td>
                </tr>

                <tr>


                <tr>
                    <td align="right"><label class="boldlabel">Verification Code <span style="color: red;"></span></label></td>
                    <td >

                        <span class="intp-Span"><?php echo $form->input("Coinset.verifycode", array('id' => 'verifycode', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "3",'style'=>'width:100%;','readonly'=>'readonly'));?></span></td>
                </tr>

                <!--<tr>
                <td width="15%"><label class="boldlabel">Project Type <span style="color: red;">*</span></label></td>
                <td width="85%">
                <?php //echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  ?>
                <span class="txtArea-top">
                <span class="txtArea-bot">
                <?php// echo $form->select("project_type_id",$projectypedropdown,$selectedprojecttype,array('id' => 'project_type_id','class'=>'multi-list form-control'/*,'disabled'=>'disabled'*/),"---Select---");//pr($selectedprojecttype);  ?>
                </span>
                </span></td>
                </tr>-->




            </tbody>
        </table>

    </div>
    <div class="frmbox2">
    

        <div>
            <table width="90%" class="left">
                <tbody>  
                  <?php if(!empty($this->data['Coinset']['sidea'])){?>  
                <tr class="upload_content">
                        <td width="30%" valign="top" align="right">&nbsp;</td>
                        <td width="70%">
                            <span id="divimagecoina" >
                                    <?php echo $html->image('cckiller/upload/'.$this->data['Coinset']['sidea'], array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?>
                          </span>
                     </td> 
                </tr>   
                 <tr class="upload_content"><td>&nbsp;</td></tr>
                <?php } ?>
                    
                  <tr class="upload_content">
                        <td width="30%" class="forName" valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Side A Image</label></td>
                        <td width="70%">
                                <span class="intp-Span">
                            <input type="file" value="" class="inpt-txt-fld form-control" id="sidea" name="data[Coinset][coinsidea]"></span>
                                                        <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>   
                              </td>            
                    </tr>  
                    
                     <?php if(!empty($this->data['Coinset']['sideb'])){?> 
                    <tr class="upload_content">
                        <td class="forName" valign="top" align="right">&nbsp;</td>
                        <td class="forName"> <span id="divimagecoina" >
                        <?php echo $html->image('cckiller/upload/'.$this->data['Coinset']['sideb'], array('class'=>'','width'=>'107','height'=>'109','align'=>'middle'));?> </span>
                       </td>
                    </tr>
                        <tr class="upload_content"><td>&nbsp;</td></tr>
                    <?php } ?>
                    
                    <tr class="upload_content">
                        <td valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Side B Image</label></td>
                        <td>  <span class="intp-Span"><input type="file" value="" class="inpt-txt-fld form-control" id="sideb" name="data[Coinset][coinsideb]"></span>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 250x250 pixels</span><br>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Format:Transparent PNG or GIF.</span><br>   
                            </td>
                    </tr>
                     <?php if(!empty($this->data['Coinset']['edge'])){?> 
                      <tr class="upload_content"><td>&nbsp;</td></tr>
                    <tr class="upload_content">
                        <td valign="top" align="right">&nbsp;</td>
                        <td valign="top">
							<?php echo $html->image('cckiller/upload/'.$this->data['Coinset']['edge'], array('class'=>'','align'=>'middle'));?>
                         </td> 
                    </tr>
                       <tr class="upload_content"><td>&nbsp;</td></tr>
                     <?php } ?>
                      
                      <tr class="upload_content">
                        <td valign="top" align="right" style="padding-top: 4px;"><label class="boldlabel">Edge Image</label></td>
                        <td valign="top">
                           <span class="intp-Span"><input type="file" value="" class="inpt-txt-fld form-control" id="coinedge" name="data[Coinset][coinedge]"></span>
                            <span style="color: LightSlateGray; font-size: 11px; font-style: italic;">Recommended file size 300x12.</span>
                            <br>&nbsp; 
                         </td> 
                    </tr>
                    
                    <tr>
                        <td valign="top" align="right"  style="padding-top: 7px;"><label class="boldlabel">Serial on side</label></td>
                        <td>
                                    <span class="txtArea-top"><span class="txtArea-bot">
                            <?php echo $form->select("Coinset.serialdisplayside",$sides,$serialdisplayside,array('id' => 'serialdisplayside',"class"=>"multi-list form-control" ),"---Select---"); ?>

                    </span>   </span>                                     
                   	  </td>
                    </tr>                    
                </tbody>
            </table>

        </div>    

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
                var path = baseUrlAdmin+"get_pricing_details";
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

