<?php
   echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
     // echo $javascript->link('datetimepicker/i18n/ui.datepicker-de.js');
    echo $javascript->link('datetimepicker/timepicker_plug/withouttime.js');
	$base_url_admin = Configure::read('App.base_url_admin');
?>

    <link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
    <link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
<!--container starts here-->
<div class="container"> 
<div class="titlCont">
	<div style="width:960px; margin:0 auto;">
		<?php /*?><div align="center" id="toppanel">
			<div id="panel">
					<div class="content clearfix">
						<H1> Help</h1>
						<p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
					</div>
					
			</div> <!-- /login -->    

			<!-- The tab on top -->    
			<div class="tab">
				<ul class="login">
					<li id="toggle">
					<a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a>

						<a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>        
					</li>
				</ul> 
			</div>
		</div><?php */?>
		<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:0px;width:545px !important; text-align:right;">	<?php 
        //,"onsubmit"=>"return validateholder('add');"
        echo $form->create("Admin", array("action" => "addnonmember",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addholder','onsubmit'=>"return validateholder('add')", 'id' => "addholder"))?>			
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')) ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')) ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin.'nonmemberslist'; ?>')"><?php e($html->image('cancle.png')) ?></button>	
 <?php  echo $this->renderElement('new_slider');  ?>		
</div>

		<span class="titlTxt"> Non Member Registration </span>
		<div class="topTabs" style="height:25px;">
			<?php /*?><ul>
			<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
			<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
			<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin.'nonmemberslist'; ?>')"><span> Cancel</span></button></li>
			</ul><?php */?>
		</div>
		
		<?php    $this->loginarea="admins";    $this->subtabsel="nonmemberslist";
                echo $this->renderElement('memberlist_submenus');  ?> 
	</div>
	</div>
</div>
</div>
<!--rightpanel ends here-->

                            <!--inner-container starts here-->
<div class="rightpanel">

<script type="text/javascript">
    /* <![CDATA[ */
        $(function() {
                  $('#birthdayBP').datetime({
                                      userLang : 'en',
                                      americanMode: false, 
                                });    
                            
            });
    /* ]]> */
    </script>

<div class="midPadd">    

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
</div> <?php } ?>


<table cellspacing="10" cellpadding="0" align="center" >
  <tbody>
   <tr>
      <td colspan="5"><?php if($session->check('Message.flash')){ $session->flash(); } ?></td>
   </tr>
   <tr>
   <td width="20%">Upload CSV :</td>
   <td width="20%">
        <?php echo $form->input("Holder.csv", array('type'=>'file','id' => 'csv', 'div' => false, 'label' => '',"class" => "inpt_txt_fld"));?></td>
        <td width="20%"><?php echo $form->error('Holder.csv', array('class' => 'errormsg')); ?></td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
   </tr>
   
   </tbody> 
</table> 

</div>

</div>

 
<!--inner-container ends here-->

<?php echo $form->end();?>


<div class="clear"></div>

