<?php ?>
<?php echo  $form->create('User',array('action'=>'/companies/change_password','id'=>'','url'=>$this->here,'onsubmit' => "return validatesugbox();"));?>
<div class="container">
<div class="titlCont">
<div align="center" class="slider" id="toppanel">
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



</div>

<span class="titlTxt">
Configuration
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button"><span>Save</span></button></li>
<li><a href="#."><span>Apply</span></a></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/dashboard')"><span> Cancel</span></button></li>
</ul>
</div>

<div class="topTabs">
<ul>
<!--<li><a href="/companies/addcontentpage"><span>New</span></a></li>-->
<!--<li><a href="#." class="tab2"><span>Actions</span></a></li>-->
<!--<li><a href="#" onclick="editcontent();" id="link"><span>Edit</span></a></li>-->
</ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; padding-left: 40px;">
<ul class="topTabs2">
<li><a href="/companies/loginterms"><span>Edit Terms &amp; Privacy</span></a></li>
<li><a href="/companies/change_password"><span>Change Password</span></a></li>
<li><a href="/companies/settingthemes"><span>Themes</span></a></li>
</ul>
</div>
<div class="clear"></div>

</div>


 <!-- Body Panel starts -->
  <div class="navigation">
  <div class="boxBg">
  <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p>-->
  <div class="boxBor">
  <div class="boxPad">
  <?php //echo $this->element("leftmenubar");?>  


    <p>&nbsp;</p>
  </div>
  </div><!--<p class="boxBot1">
 <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  -->
  </div>
  </div>
  <div class="bdyCont">
  <div class="boxBg1">
  <!--<p class="boxTop1"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
  <div class="boxBor1">
  <div class="boxPad">
<br>
<div class="">
<div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">
    
   </div>

<div style="width: 960px; margin: 0pt auto; align:left;">  
      <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>
<div class="clear"></div>
<p>&nbsp;</p>  


<p>&nbsp;</p>  

<div>
	
<?php //echo $form->create("Company", array("action" => "suggestionbox",'name' => 'suggestionbox', 'id' => "suggestionbox","onsubmit"=>"return validatesugbox();")); ?>
<div class='left' style="width:700px;">		
		<table cellspacing="10" cellpadding="0" align="center" width="800px">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); }
								//echo $form->error('User.suggestion', array('class' => 'errormsg'));
						?></td>
		    </tr>





  		   <tr>


		     <td><label class="boldlabel">Username: <span style="color: red;">*</span></label></td>
		     <td ><span class="intpSpan"><?php echo $form->input("Suggestion.username", array('id' => 'username', 'div' => false, 'label' => '','style' =>'width:200px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    
			<tr>
		     <td   valign='top'><label class="boldlabel">Suggestion: <span style="color: red;">*</span></label></td>
		     <td ><span class="txtArea_bot">
				<?php echo $form->input("Suggestion.suggestion", array('id' => 'suggestion', 'div' => false, 'label' => '','rows'=>'7','cols'=>'65','style' =>'width:200px;',"class" => "noBg"));?></span></td>
		    </tr>


		    
			
			


 		   
 		   
		    <tr><td colspan='5' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
    <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
   </td></tr>
    		
    		
    		
    			
<div><lable style="width:150px; margin-right:5px;display:inline-block;">&nbsp;</lable> 
<!--<tr>
<td>&nbsp;</td>

<td><button type="submit" value="Submit" class="button"><span>Save</span></button>
&nbsp;<button type="button" value="Cancel" class="button" ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span>Cancel</span></button></td>
</tr> -->
</div>





		</tbody>
		</table>
</div>
<?php echo $form->end();?>
<div class="clear"></div>
  </div>
  </div>
  </div><!--<p class="boxBot"><?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
</p>  -->
  </div>
<div >
	
	</div>

  <div class="clear"></div>
  <!-- Body Panel ends --> 


