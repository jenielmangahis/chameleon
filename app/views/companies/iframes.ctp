

<div class="titlCont"><div class="myclass">
	<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?>


</div> <?php echo $form->create("Companies", array("action" => "iframes",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent")); ?>
<span class="titlTxt">
iFrames
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/contentlist')"><span> Cancel</span></button></li>
</ul>
</div>

<!-- <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both;">
<ul class="topTabs2">

<li><a href="/companies/settingthemes" ><span>Themes</span></a></li>
<li><a href="/companies/settings"><span>Settings</span></a></li>
<li><a href="/companies/loginterms"><span>Terms &amp; Privacy</span></a></li>
<li><a href="/companies/iframes" class="tabSelt"><span>iFrames</span></a></li>
<li><a href="/companies/projectcontrols"><span>Controls</span></a></li>
<li><a href="/companies/change_password" ><span>Change Password</span></a></li>  
</ul>
</div>
<div class="clear"></div>   -->
 <?php  $this->loginarea="companies";    
        $this->subtabsel="iframes";
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
                <div style="padding-left:0px;">
                    <span class="txtArea_top1">
                        <span class="txtArea_bot1">
                            <textarea  id="codeval1" class="multilist1" cols="2000" rows="5"></textarea>
                        </span>
                    </span>
                </div>
                &nbsp;&nbsp;&nbsp; 
            </td>
            <td><div class="">
                    <ol style="list-style: none;">
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource1" class="button" name="Getsource" onclick="getsource1();init();"><span>Get iFrame Source</span></button></li>
                        <li>&nbsp;&nbsp;<button type="button" id="d_clip_button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval1.focus();this.form.codeval1.select();"><span>Copy</span></button></li>
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
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource2" class="button" name="Getsource" onclick="getsource2();init1();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container1">&nbsp;&nbsp;<button type="button" id="d_clip_button1" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval2.focus();this.form.codeval2.select();"><span>Copy</span></button></li>
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
                        <li>&nbsp;&nbsp;<button type="button" value="Getsource3" class="button" name="Getsource" onclick="getsource3();init2();"><span>Get iFrame Source</span></button></li>
                        <li id="d_clip_container2">&nbsp;&nbsp;<button id="d_clip_button2" type="button" value="Copy" class="newblue" name="copyb" Onclick="this.form.codeval3.focus();this.form.codeval3.select();"><span>Copy</span></button></li>
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
	  /*  var code="<iframe src='http://< ?php echo $_SERVER['HTTP_HOST'];?>/companies/socialicon/< ?php echo $projectid;?>'></iframe>";
	    document.getElementById("codeval1").value=code; */
	  
	
      
    }


 function getsource2()
    {
	var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframelogin/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval2").value=code;
        
	   
	 /*   var code="<iframe src='http://< ?php echo $_SERVER['HTTP_HOST'];?>/companies/socialicon/< ?php echo $projectid;?>'></iframe>";
	    document.getElementById("codeval2").value=code;*
	*/
    }



 function getsource3()
    {
	  var code="<iframe width='960px' style='height: 100%;' src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/iframecomment/<?php echo $projectid;?>/<?php echo $projectname;?>'></iframe>";
        document.getElementById("codeval3").value=code;
        
	   /* var code="<iframe src='http://< ?php echo $_SERVER['HTTP_HOST'];?>/companies/socialicon/< ?php echo $projectid;?>'></iframe>";
	    document.getElementById("codeval3").value=code;*/
	
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












































