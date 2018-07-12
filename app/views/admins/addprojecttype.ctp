<!--<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script>  	 -->
<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'projecttype';
?>
<div class="container">

<div class="titlCont1"><div style="width:960px;margin:0 auto">
        <?php echo $form->create("Admins", array("action" => "addprojecttype",'name' => 'addprojecttype', 'id' => "addprojecttype",'onsubmit' => 'return validateprojecttype("add");'))?>
        <div align="center" id="toppanel" >
            <?php  //echo $this->renderElement('new_slider');  ?>
        </div>
		<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important;">			
<?php
e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));

?>			
</div>
        <span class="titlTxt">Add Project Types </span>
        <div class="topTabs">

            <ul>


                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
            </ul>
            </ul>
        </div>
    </div></div>
<div class="boxBor1">
    <div class="boxPad">
        <div class="" height="300">
             <div id="addprjtype" style="width: 960px; height:300px; margin: 0pt auto;" align="left">     
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
                <table width="600px" height="250px" align="left" cellpadding="1" cellspacing="1">
                    <tr>
                        <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('SiteType.project_type_name', array('class' => 'errormsg'));
                        ?></td>
                    </tr>
                    <tr><td align="right"><label class="boldlabel">Project Type <span class="red">*</span></label></td>
                        <td>
                            <span class="intpSpan"><label for="title"></label> 
                            <?php echo $form->input("SiteType.project_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                             </span>

                        </td>
                    </tr>

                    <tr><td valign='top' align="right"><label class="boldlabel">Note </label>&nbsp;</td>
                        <td>
                            <span class="txtArea_top">
                                <span class="newtxtArea_bot"><?php echo $form->textarea("SiteType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>

                                </span></span>           
                        </td>
                    </tr>

                 <!--   <tr><td align="right" width="50%"><label class="boldlabel">Default Delivery Days After Order Date <span class="red">*</span></label>&nbsp;&nbsp;</td>
                        <td>
                            <span class="intpSpan"><label for="title"></label> < ?php echo $form->input("SiteType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?>

                            </span>
                        </td>   -->
                    </tr><tr><td><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
                                <?php  echo $this->renderElement('bottom_message');  ?>
                            </div></td></tr>

                    <!-- ADD FIELD EOF -->  	
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2">
                        </td></tr>
                    <tr><td>&nbsp;</td></tr>



                </table>


                <!-- ADD Sub Admin  FORM EOF -->

            </div></div></div></div>

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
        if(document.getElementById("SiteTypeIstransferable").checked==false)
            {document.getElementById("SiteTypeSimpleCointransfer").checked=false;		}
    }
</script>			
<!--inner-container ends here-->
<div class="clear"></div>

<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("addprjtype").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	
</script>
<!--container ends here-->

