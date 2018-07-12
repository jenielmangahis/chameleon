<!-- Body Panel starts -->
<?php
    echo $javascript->link('coin_serial.js');
?>

<div class="navigation">
    <div class="boxBg">

        <!--<div class="boxBor">
        <div class="boxPad">
        <?php //echo $this->element("leftmenubar");?>  


        <p>&nbsp;</p>
        </div>
        </div>
        <p class="boxBot1">
        <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>-->

    </div>
</div>
<div class="bdyCont">
    <div class="boxBg1">

        <div class="boxBor1">
            <div class="boxPad">
                <h2 style="float:left;">Register Coin</h2>

                <div style="float: left; position: relative;width: 650px;margin-left:198px; margin-top:-30px;">     
                    <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow">

                        <?php echo $this->element("leftmenubar");?>  
                    </div>

                </div>

                <div style="float: left; position: relative;width: auto;margin-left:855px; margin-top:-30px;">  
                    <div style="float:right;height: 30px;position:relative;background-color:#209f20; width: auto;" class="border_shadow">
                        <ul class="dash_menu_opp" style="margin-left: 5px; margin-right: 3px;"> 
                            <li><a href="javascript:document.coin_frm.submit();"><span>Save</span></a></li>
                        </ul>   
                    </div>
                </div>

                <div class="coinBoxCenter">
                    <br />
                    <br /><br /><br />

                    <!--<p class="coinBoxTop"><?php //echo $html->image('/img/'.$project_name.'/coinBox_RhtTop.gif', array('class'=>'right'));?></p>-->
                    <div class="boxBor">
                        <div class="boxPad">

                            <br /> 
                            <table><tr>
                                    <td align="center" width="200px">
                                        <?php 
                                       
                                            if($coinsdetail['Coinset']['serialdisplayside']=="A") {
                                                if($coinsdetail['Coinset']['sidea']=="")
                                                    echo $html->image('/img/'.$project_name.'/sideA.png', array('class'=>'','width'=>'107','height'=>'109'));
                                                else
                                                    echo $html->image('/img/'.$project_name.'/uploads/'.$coinsdetail['Coinset']['sidea'], array('class'=>'','width'=>'107','height'=>'109'));
                                            }
                                            else
                                            {
                                            ?><?php //echo $html->image('/img/'.$project_name.'/spacer.gif', array('width'=>'20','height'=>'1'));?><?php 
                                                if($coinsdetail['Coinset']['sideb']=="")
                                                    echo $html->image('/img/'.$project_name.'/sideB.png', array('class'=>'','width'=>'107','height'=>'109'));
                                                else
                                                    echo $html->image('/img/'.$project_name.'/uploads/'.$coinsdetail['Coinset']['sideb'], array('class'=>'','width'=>'107','height'=>'109'));
                                            }

                                    ?></td>
                                    <td style="color:red;font-size:20px;valign:center">
                                        <?php //echo $html->image('/img/'.$project_name.'/uploads/'.'/registerarrow.png', array('class'=>'','width'=>'','height'=>'')); ?>
                                    </td>

                                    <td><!--<p style="color:red;font-size:20px;font-weight: bolder;">Coin Serial #<?php if($project['Project']['coins_verificationshow']==1) { ?> & Verification Code <?php }?> </p>-->
                                    </td>
                            </tr> </table></div>
                    </div>
                    <!--<p class="coinBoxBot"><?php //echo $html->image('/img/'.$project_name.'/coinBox_RhtBot.gif', array('class'=>'right'));?></p>-->
                </div>
                <br />
                <div style="margin: 0pt auto; width: 360px;">

                    <?php echo  $form->create('Coinset',array('action'=>'/companies/register_coin','name'=>'coin_frm','id'=>'','url'=>$this->here,'onsubmit' => 'return validatecoinserial("add");'));?>

                    <p>&nbsp;</p>  
                    <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
                    <div><label class='lbl' style=" width: 89px;">Coin Serial <span class="red">*</span></label>
                        <span class="intpSpan">
                            <?php echo $form->input('coinserial',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"coinserial",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox','onblur'=>'hidemessage()' )) ?>
                        </span>
                    </div>


                    <?php if($project['Project']['coins_verificationshow']==1){?>
                        <div><label class='lbl' style=" width: 115px; margin-left: -24px;">Verification Code<span class="red">*</span></label>
                            <span class="intpSpan">
                                <?php echo $form->input('code',array('label'=>'','div'=>false,'type'=>"text", 'id'=>"code",'size'=>'40','maxlength'=>'3', 'class'=>'inptBox' )) ?>
                            </span>
                        </div>
                        <?php }?>
                    <p class="clear"><img src="/img/<?php echo $project_name?>/spacer.gif" alt="" height="15" width="1" /></p>

                    <div><label style="width:90px; margin-right:5px;display:inline-block;">&nbsp;</label>
                        <?php // echo $form->submit('Submit', array('div'=>false,"class"=>"btn",'style'=>"width:91px"));?> 
                    </div>
                    <?php echo $form->end();?>
                </div>
            </div>
            <br/><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">*</span><b>Required Field</b>    
        </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
        </p>

    </div>
</div>

<div class="clear"></div>
<!-- Body Panel ends --> 

<script language='javascript'>
    function hidemessage(){
        if(document.getElementById("flashMessage")!=null)
            document.getElementById("flashMessage").style.display="none";

    }
</script>

