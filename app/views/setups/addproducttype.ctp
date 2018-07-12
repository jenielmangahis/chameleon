<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script> 
<?php 
$baseUrl= Configure::read('App.base_url');
$backUrl = $baseUrl.'setups/producttype';
?>
<div class="container">

<div class="titlCont1"><div style="width:960px;margin:0 auto">
    
          <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
    <?php echo $form->create("setups", array("action" => "addproducttype",'name' => 'addproducttype', 'id' => "addproducttype",'onsubmit' => 'return validateproducttype("add");'))?>
         <span class="titlTxt">Add Product Types </span>
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

           <div style="width: 960px; min-height:230px; margin: 0pt auto; align:left;">     

                <?php if($session->check('Message.flash')){ ?> 
                    <div id="blck"> 
                        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
                        <div class="msgBoxBg">
    <div class=""><a href="javascript:void(0);" onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;position: absolute;z-index: 11;" /></a>
                                <?php  $session->flash();    ?> 
                            </div>
                            <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
                        </div>
                    </div>
                    <?php } ?>


                <br /><br />


                <table width="395px" cellpadding="1" cellspacing="1">
                    <tr>
                        <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('ProductType.product_type_name', array('class' => 'errormsg'));
                        ?></td>
                    </tr>

                    <tr>
                        <td align="right">
                        <div class="updat">
                        <label class="boldlabel">Product Type <span class="red">*</span></label></div></td>
                        <td width="auto">
                            <span class="intpSpan">
                                <label for="title"></label> 
                                <?php echo $form->input("ProductType.product_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><div class="updat"><label class="boldlabel">Shape <span class="red">*</span></label></div></td>
                        <td>
                            <?php  echo $form->radio("ProductType.shape", array('Round'=>'Round','Octagon'=>'Octagon'), array('default'=>'Round','id'=>'shape', 'legend'=>false,'style'=>'margin-right:5px;margin-left:5px;')); ?>      
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><div class="updat"><label class="boldlabel">Size(inches) <span class="red">*</span></label></div></td>
                        <td>
                            <span class="intpSpan">
                                <label for="title"></label> 
                                <?php echo $form->input("ProductType.size_inch", array('id' => 'size_inch', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><div class="updat"><label class="boldlabel">Size(mm) <span class="red">*</span></label></div></td>
                        <td>
                            <span class="intpSpan">
                                <label for="title"></label> 
                                <?php echo $form->input("ProductType.size_mm", array('id' => 'size_mm', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><div class="updat" style="width: 280px;"><label class="boldlabel">Default Delivery Days After Order Date<span class="red">*</span></label></div></td>
                        <td>
                            <span class="intpSpan"><label for="title"></label>
                                <?php echo $form->input("ProductType.delivery_days", array('id' => 'delivery_days', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?>
                            </span>
                        </td>
                    </tr>



                    <tr><td>&nbsp;</td></tr>

                    <!-- ADD FIELD EOF -->      
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2"><b>Any item with a</b>  "<span class="red">*</span>"  <b>requires an entry.</b> 
                        </td></tr>
                    <tr><td>&nbsp;</td></tr>

                </table>
                <table  style="margin-top: -220px; margin-left: 500px;" >
                    <tr>
                        <td valign='top' width="100" align="right">
                        <div class="updat">
                            <label class="boldlabel">Note </label></div></td>
                        <td>
                            <span class="txtArea_top">
                                <span class="txtArea_bot"><?php echo $form->textarea("ProductType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>
                                </span>
                            </span>
                        </td>
                    </tr>
                </table>

                <?php echo $form->end();?>
                <!-- ADD Sub Admin  FORM EOF -->

            </div></div></div>

<script type="text/javascript" language="JavaScript">
    function hidetextboxes(){
        var i;
        var j=parseInt(document.getElementById("maxnumbercomment").options[document.getElementById("maxnumbercomment").selectedIndex].value)+1;

        for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
        {
            document.getElementById("commenttype"+i).style.display="block";
            document.getElementById("commenttypevalue"+i).style.display="block";
        }


        if(j==2){
            for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
            {
                document.getElementById("commenttype"+i).style.display="none";
                document.getElementById("commenttypevalue"+i).style.display="none";
            }
        }else{
            for(i=j;i<=<?php echo $maxnumbercomment?>;i++)
            {
                document.getElementById("commenttype"+i).style.display="none";
                document.getElementById("commenttypevalue"+i).style.display="none";
            }
        }
    }
    hidetextboxes();

    function checkboxfun(){
        if(document.getElementById("ProjectTypeIstransferable").checked==false)
            {document.getElementById("ProjectTypeSimpleCointransfer").checked=false;        }
    }
</script>            
            <!--inner-container ends here-->

  




<div class="clear"></div>


<!--container ends here-->

