<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
?>

<style type="text/css">
    .spnclass {display:inline-block; margin-right:10px;}
	.txtArea_bot1 textarea{ border:1px solid #ddd; background:#EBEBEB!important;}
</style>


<div class="titlCont"><div class="myclass">
        <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
		<?php echo $form->create("Admins", array("action" => "iframes",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent")); ?>
		<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
        <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
         <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>contentlist')"><?php e($html->image('cancle.png')); ?></button>
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>
        <?php  echo $this->renderElement('project_name');  ?>
        <span class="titlTxt">iFrames
        </span>
        <div class="topTabs">
           
        </div>

      <!--   <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        <div style="height: 30px; clear:both;">
            <div id="tab-container-1">
                <ul id="tab-container-1-nav" class="topTabs2">
                    <li><a href="/admins/settingthemes" ><span>Themes</span></a></li>
                    <li><a href="/admins/settings" ><span>Settings</span></a></li>
                    <li><a href="/admins/loginterms"><span>Terms &amp; Privacy</span></a></li>
                    <li><a href="/admins/iframes"  class="tabSelt"><span>iFrames</span></a></li> 
                    <li><a href="/admins/projectcontrols" ><span>Controls</span></a></li>       
                    <li><a href="/admins/change_password"><span>Change Password</span></a></li>
                </ul>
        </div> </div>
        <div class="clear"></div>     --> 
         <?php    $this->loginarea="admins";    $this->subtabsel="iframes";
                    echo $this->renderElement('setting_submenus');  ?> 
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
                        <li>&nbsp;&nbsp;<button type="button" id="d_clip_button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval1.focus();this.form.codeval1.select(); copy(document.editcontent.codeval1.value);"><span>Copy</span></button></li>
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
                        <li id="d_clip_container1">&nbsp;&nbsp;<button type="button" id="d_clip_button1" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval2.focus();this.form.codeval2.select(); copy(document.editcontent.codeval2.value);"><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>
        <tr>
            <td width="180px" align="right"><span class="spnclass">Coin & Comments Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval3" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource3" class="button" name="Getsource" onclick="getsource3();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container2">&nbsp;&nbsp;<button id="d_clip_button2" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval3.focus();this.form.codeval3.select(); copy(document.editcontent.codeval3.value);"><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>

        <tr>
            <td width="180px" align="right"><span class="spnclass">Event Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval4" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource4" class="button" name="Getsource" onclick="getsource4();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container3">&nbsp;&nbsp;<button id="d_clip_button3" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval4.focus();this.form.codeval4.select(); copy(document.editcontent.codeval4.value);"><span>Copy</span></button></li>
                    </ol>
                </div>
            </td>
        </tr>

        <tr>
            <td width="180px" align="right"><span class="spnclass">Blog Component</span></td>
            <td width="600px">
                <div style="padding-left:0px;"><span class="txtArea_top1">
                        <span class="txtArea_bot1"><textarea  id="codeval5" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource5" class="button" name="Getsource" onclick="getsource5();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container4">&nbsp;&nbsp;<button id="d_clip_button4" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval5.focus();this.form.codeval5.select(); copy(document.editcontent.codeval5.value);"><span>Copy</span></button></li>
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
                        <li id="d_clip_container5">&nbsp;&nbsp;<button id="d_clip_button5" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval6.focus();this.form.codeval6.select(); copy(document.editcontent.codeval6.value);"><span>Copy</span></button></li>
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
                        <span class="txtArea_bot1"><textarea name="codeval7"  id="codeval7" class="multilist1" cols="2000" rows="5"></textarea></span></span></div>
                &nbsp;&nbsp;&nbsp;
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource7" class="button" name="Getsource" onclick="getsource7();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container6">&nbsp;&nbsp;<button id="d_clip_button6" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval7.focus();this.form.codeval7.select(); copy(document.editcontent.codeval7.value);"><span>Copy</span></button></li>
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
        var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframeregister/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval1").value=code;
    }
    function getsource2()
    {
        var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframelogin/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval2").value=code;
    }
    function getsource3()
    {
        var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframecomment/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval3").value=code;
    }

    function getsource4()
    {
        var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframeevent/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval4").value=code;
    }

    function getsource5()
    {
        var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframeblog/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval5").value=code;
    }

    function getsource6()
    {
        var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframechat/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval6").value=code;
    }
    function getsource7()
    {
        var event_id=$('#event_title').val();
        var code="<iframe width='960px' style='height: 500px;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframeevent/<?php echo $projectid;?>/<?php echo $projectname;?>/0/"+event_id+"'></iframe>";
        document.getElementById("codeval7").value=code;
    }


    function copy(text) {

        if (window.clipboardData) {
            window.clipboardData.setData("Text",text);
        }
        else {
            var flashcopier = 'flashcopier';
            if(!document.getElementById(flashcopier)) {
                var divholder = document.createElement('div');
                divholder.id = flashcopier;
                document.body.appendChild(divholder);
            }
            document.getElementById(flashcopier).innerHTML = '';
            var divinfo = '<embed src="_clipboard.swf" FlashVars="clipboard='+encodeURIComponent(text)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';
            document.getElementById(flashcopier).innerHTML = divinfo;
        }
    }

	</script>
