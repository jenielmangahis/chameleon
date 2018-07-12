<?php 
$baseUrl = Configure::read('App.base_url'); 
$backUrl =$baseUrl.'setups/iframes';

echo $javascript->link('ZeroClipboard');
?>
<script type="text/javascript">

		var clip1 = null;
		var clip2 = null;
		var clip3 = null;
		var clip4 = null;
		var clip5 = null;
		var clip6 = null;
		var clip7 = null;
						
		$(function() {
			clip1 = new ZeroClipboard.Client();
			clip1.addEventListener('mousedown',function() {
  				clip1.setText(document.getElementById('codeval1').value);
				$("#codeval1").focus().select();
			});
			clip1.glue('d_clip_button1');

			clip2 = new ZeroClipboard.Client();
			clip2.addEventListener('mousedown',function() {
  				clip2.setText(document.getElementById('codeval2').value);
				$("#codeval2").focus().select();
			});
			clip2.glue('d_clip_button2');
			
			clip3 = new ZeroClipboard.Client();
			clip3.addEventListener('mousedown',function() {
  				clip3.setText(document.getElementById('codeval3').value);
				$("#codeval3").focus().select();
			});
			clip3.glue('d_clip_button3');

			clip4 = new ZeroClipboard.Client();
			clip4.addEventListener('mousedown',function() {
  				clip4.setText(document.getElementById('codeval4').value);
				$("#codeval4").focus().select();
			});
			clip4.glue('d_clip_button4');

			clip5 = new ZeroClipboard.Client();
			clip5.addEventListener('mousedown',function() {
  				clip5.setText(document.getElementById('codeval5').value);
				$("#codeval5").focus().select();
			});
			clip5.glue('d_clip_button5');

			clip6 = new ZeroClipboard.Client();
			clip6.addEventListener('mousedown',function() {
  				clip6.setText(document.getElementById('codeval6').value);
				$("#codeval6").focus().select();
			});
			clip6.glue('d_clip_button6');

			clip7 = new ZeroClipboard.Client();
			clip7.addEventListener('mousedown',function() {
  				clip7.setText(document.getElementById('codeval7').value);
				$("#codeval7").focus().select();
			});
			clip7.glue('d_clip_button7');
			
		});
		
		$("#ZeroClipboardMovie_1").live("click",function(){
			$("#codeval1").focus().select();
		});
		
	    $("#ZeroClipboardMovie_2").live("click",function(){
			$("#codeval2").focus().select();
		});
		
	    $("#ZeroClipboardMovie_3").live("click",function(){
			$("#codeval3").focus().select();
		});

	    $("#ZeroClipboardMovie_4").live("click",function(){
			$("#codeval4").focus().select();
		});

	    $("#ZeroClipboardMovie_5").live("click",function(){
			$("#codeval5").focus().select();
		});

	    $("#ZeroClipboardMovie_6").live("click",function(){
			$("#codeval6").focus().select();
		});

	    $("#ZeroClipboardMovie_7").live("click",function(){
			$("#codeval7").focus().select();
		});

</script>
<style type="text/css">
    .spnclass {display:inline-block; margin-right:10px;}
</style>


<div class="titlCont"><div class="myclass">
        <div align="center" class="slider" id="toppanel">
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>

        <?php echo $form->create("Setups", array("action" => "iframes",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent")); ?>
       
        <span class="titlTxt">iFrames
        </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
        </div>
         <?php    $this->loginarea="setups";    $this->subtabsel="iframes";
                    echo $this->renderElement('setup_submenus');  ?> 
    </div></div>
<!--inner-container starts here-->

<!--inner-container starts here-->

<div class="midCont1">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <!-- top curv image starts -->
    <!-- ADD Sub Admin  FORM EOF -->
    <table>
        <tr>
            <td width="180px" align="right"><span class="spnclass"> Register Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval1" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp; 
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource1" class="button" name="Getsource" onclick="getsource1();"><span>Get iFrame Source</span></button></li>
                        <li>&nbsp;&nbsp;<button type="button" id="d_clip_button1" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval1.focus();this.form.codeval1.select(); "><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>
        <tr>
            <td width="180px" align="right"><span class="spnclass"> Login Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval2" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp; 
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource2" class="button" name="Getsource" onclick="getsource2();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container2">&nbsp;&nbsp;<button type="button" id="d_clip_button2" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval2.focus();this.form.codeval2.select(); "><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>
      
        <tr>
            <td width="180px" align="right"><span class="spnclass">Event Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval3" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource3" class="button" name="Getsource" onclick="getsource3();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container3">&nbsp;&nbsp;<button id="d_clip_button3" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval3.focus();this.form.codeval3.select(); "><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>

              <tr>
            <td width="180px" align="right"><span class="spnclass">Single Event Component</span></td>
            <td width="600px">
            Select Event:
            <span class="txtArea_top">
                    <span class="txtArea_bot">
            <?php 
                        echo $form->select("Event.event_title",$event_titles,0, array('id' => 'event_title', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

            ?>
            </span>
            </span>
            <br />
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea name="codeval4"  id="codeval4" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource4" class="button" name="Getsource" onclick="getsource4();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container4">&nbsp;&nbsp;<button id="d_clip_button4" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval4.focus();this.form.codeval4.select(); "><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>
        
		 <tr>
            <td width="180px" align="right"><span class="spnclass">Event Calender Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval5" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource5" class="button" name="Getsource" onclick="getsource5();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container5">&nbsp;&nbsp;<button id="d_clip_button5" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval5.focus();this.form.codeval5.select(); "><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>
        
        
        <tr>
            <td width="180px" align="right"><span class="spnclass">Chat Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea name="codeval6"  id="codeval6" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource6" class="button" name="Getsource" onclick="getsource6();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container6">&nbsp;&nbsp;<button id="d_clip_button6" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval6.focus();this.form.codeval6.select(); "><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>
        
  
		 <tr>
            <td width="180px" align="right"><span class="spnclass">Coupon Calender Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval7" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource7" class="button" name="Getsource" onclick="getsource7();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container7">&nbsp;&nbsp;<button id="d_clip_button7" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval7.focus();this.form.codeval7.select();"><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>

    </table>        
</div>
<!--inner-container ends here-->
<div class="clear"></div><!--container ends here-->
<?php echo $form->end();?>
<div class="clear"></div><!--inner-container ends here-->
<script type="text/javascript">
    function getsource1()
    {
        var code="<iframe width='960px' style='height: 100%;' src='<?php echo $baseUrl;?>companies/iframeregister'></iframe>";
        document.getElementById("codeval1").value=code;
    }
    function getsource2()
    {
        var code="<iframe width='960px' style='height: 100%;' src='<?php echo $baseUrl;?>companies/iframelogin'></iframe>";
        document.getElementById("codeval2").value=code;
    }

    function getsource3()
    {
    	var code="<iframe width='960px' style='height: 100%;' src='<?php echo $baseUrl;?>companies/iframeevent'></iframe>";
        document.getElementById("codeval3").value=code;
    }

    function getsource4()
    {
        var event_id=$('#event_title').val();
        var code="<iframe width='960px' style='height: 500px;' src='<?php echo $baseUrl;?>companies/iframeevent/0/"+event_id+"'></iframe>";
        document.getElementById("codeval4").value=code;
    }
   
    function getsource5()
    {
        var code="<iframe width='960px' style='height: 100%;' src='<?php echo $baseUrl;?>companies/iframeeventcalendar'></iframe>";
        document.getElementById("codeval5").value=code;
    }

    function getsource6()
    {
        var code="<iframe width='960px' style='height: 100%;' src='<?php echo $baseUrl;?>companies/iframechat'></iframe>";
        document.getElementById("codeval6").value=code;
    }


    function getsource7()
    {
        var code="<iframe width='960px' style='height: 100%;' src='<?php echo $baseUrl;?>companies/iframecouponcalendar'></iframe>";
        document.getElementById("codeval7").value=code;
    }
   
	</script>
