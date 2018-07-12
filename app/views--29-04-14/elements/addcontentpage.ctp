<?php ?><!--container starts here-->
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
<?php echo $form->create("Companies", array("action" => "addcontentpage",'name' => 'addcontentpage','onsubmit'=>'return validatecontentpage();' ,'id' => "addcontentpage")); ?>
<span class="titlTxt">
Add Content
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/contentlist')"><span> Cancel</span></button></li>
</ul>
</div>
<!--<div class="topTabs">
<ul>
<li><a href="/companies/addcontentpage"><span>New</span></a></li>
<li><a href="#." class="tab2"><span>Actions</span></a></li>
<li><a href="#."><span>Edit</span></a></li>
</ul>
</div>-->
</div>
<?php // echo $javascript->link('tiny_mce/tiny_mce.js'); ?>
<?php // echo $javascript->link('tiny_mce/tiny_mce_src.js'); 
echo $javascript->link('ckeditor/ckeditor'); 
?>

<!--inner-container starts here--><div class="rightpanel">

<div class="midPadd">
		<div class="">
		 

		<table cellspacing="10" cellpadding="0" align="center" width="815px">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
		      		echo $form->error('Content.title', array('class' => 'errormsg')); 
		      		echo $form->error('Content.metatitle', array('class' => 'errormsg')); 
		      		echo $form->error('Content.content', array('class' => 'errormsg')); 
		      	?></td>
		    </tr>
		    
		    <tr>
		     <td width="15%"><label class="boldlabel">Navigation <span style="color: red;">*</span></label></td>
                            <td width="85%"><span class="intpSpan"><?php echo $form->input("Content.title", array('id' => 'title', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		     <tr>
		     <td width="15%"><label class="boldlabel">Meta Title: <span style="color: red;">*</span></label></td>
                        <td width="85%"><span class="intpSpan"><?php echo $form->input("Content.metatitle", array('id' => 'metatitle', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <tr>
		     <td width="15%"><label class="boldlabel">Metakeyword: </label></td>
                        <td width="85%"><span class="intpSpan"><?php echo $form->input("Content.metakeyword", array('id' => 'metakeyword', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <tr>
		     <td width="15%"><label class="boldlabel">Metadescription: </label></td>
                        <td width="85%"><span class="intpSpan"><?php echo $form->input("Content.metadescription", array('id' => 'metadescription', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
		    <tr>


			<td width="15%"><label class="boldlabel">Parent Menu: </label></td>

                        <td width="85%"><span class="txtArea_top"><span class="txtArea_bot">
<?php 
                        echo $form->select("Content.parent_id",$submenu,$data['Content']['alias'], array('id' => 'submenu', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

?>
    </span>   </span></td>
		   	</tr>
<tr>
				<td width="24%"><label class="boldlabel">Viewable Only After Log-in ?:</label> </td>
				<td><?php echo $form->input('Content.is_global', array('type'=>'checkbox', 'label' => '')); ?></td>
			
			</tr>
<tr>
		      <td width="15%" valign='top'><label class="boldlabel">Content: <span style="color: red;">*</span></label></td>	
		      <td width="85%">
			<?php //echo $form->textarea("Content.content", array('id' => 'content', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?>
			<?php	
// 				echo $form->create('Content');  
// 				echo $form->input('content', array('cols' => '50', 'rows' => '100','label'=>false,'div'=>false)); 
// 				echo $fck->load('Content/content','600','600'); 
				echo $form->textarea('Content.content', array('id'=>'content','class'=>'ckeditor'));
				echo $form->input('id', array('type'=>'hidden'));				
			?>
			</td>
		    </tr>	
			
		
		    <tr><td colspan="2">&nbsp;</td></tr>
    		<!--tr>
    		<td >&nbsp;</td>
    		<td >
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"> <span>In Progress</span> </button>
    		 </td>
    		 </tr-->	
		</tbody>
		</table>
                            <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                            <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
                            </div>
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>

                            

