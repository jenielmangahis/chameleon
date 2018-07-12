
<div class="titlCont">
<div align="center" class="slider">
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
<?php echo $form->create("Companies", array("action" => "editcontent",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent")); ?>
<span class="titlTxt">
Content Manager
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/contentlist')"><span> Cancel</span></button></li>
</ul>
</div>

</div>

<!--rightpanel ends here-->

<?php 
	echo $javascript->link('ckeditor/ckeditor'); 
?>

<!--inner-container starts here--><div class="rightpanel">



  <div class="midPadd">
	<div class="top-bar" style="border-left:0px;">
		
		</div><br />
		

		<div class="tblData">
		
		  <table cellspacing="10" cellpadding="0" align="center" width="815px">
		  <tbody>
		    <tr>
		      <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); }
							 echo $form->hidden("Content.id", array('id' => 'contentid'));
							 echo $form->error('Content.title', array('class' => 'errormsg')); 
							  echo $form->error('Content.metatitle', array('class' => 'errormsg')); 
		      				 echo $form->error('Content.content', array('class' => 'errormsg')); 
		      		?></td>
		    </tr>
<?php if($this->data['Content']['alias']=='home_page'){?>
		   
		<tr>
		     <td width="15%"><label class="boldlabel">Navigation <span style="color: red;">*</span></label></td>
                            <td width="85%"><span class="intpSpan"><?php echo $form->input("Content.title", array('id' => 'title', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250","readonly"=>"readonly"));?></span></td>
		    </tr>
	
<?php } else{ ?>
		<tr>
		     <td width="15%"><label class="boldlabel">Navigation <span style="color: red;">*</span></label></td>
                            <td width="85%"><span class="intpSpan"><?php echo $form->input("Content.title", array('id' => 'title', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
		    </tr>
<?php } ?>
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
<tr><td colspan="2">
<?php if($this->data['Content']['is_sytem']=='1'){ ?>
		<table cellspadding="0" cellspacing="0">	

			<tr>
		    		 <td ><label class="boldlabel">Viewable Only After Log-in ?:</label> </td>
		    		 <td><?php echo $form->input('Content.is_global', array('type'=>'checkbox', 'label' => '')); ?></td>
		    		 <td colspan='2'></td>
		   	 </tr>
			
			<?php } ?>
		</table>
</td></tr>
<?php if(strcmp($this->data['Content']['alias'],"login")!=0 && $this->data['Content']['alias']!="logout" && $this->data['Content']['alias']!="dashboard" && $this->data['Content']['alias']!="register" ) { ?>
		    <tr>
		  <?php if($this->data['Content']['alias']!="comments") { ?>
		      <td width="15%" valign='top'><label class="boldlabel">Content: <span style="color:red">*</span></label></td>	
		      <td width="85%">
			<?php //echo $form->textarea("Content.content", array('id' => 'content', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>

<?php	
						  


// 						echo $form->create('Content');
// 						echo $form->input('content', array('cols' => '50', 'rows' => '100','label'=>false,'div'=>false)); 
// 						echo $fck->load('Content/content','600','600'); 
						echo $form->textarea('Content.content', array('id'=>'content','class'=>'ckeditor'));
						echo $form->input('id', array('type'=>'hidden'));						
						
?>
			</td> <?php } ?>
		    </tr>	
    		<?php } ?>
		</tbody>
		</table>
		
		<table>
		
		<tr><td colspan="4">&nbsp;</td></tr>
		    
		    <?php if(isset($this->data['Content']['alias']) && ($this->data['Content']['alias']=='home_page' || $this->data['Content']['alias']=='home-page')){ ?>
			<tr>
			<!--<td colspan='4'>
			<p>Upload New Graphics</p>
			<p>&nbsp;</p>
			<div id="inputs">
				<p><label class="boldlabel">New Graphic Title: </lable><?php echo $form->input("ProjectGraphic.title", array('id' => 'title', 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "250"));?>
					<?php  echo $form->file('ProjectGraphic.imagenameold',array('id'=> 'imagenameold',"class" => "contactInput"));?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Address: <?php echo $form->text("ProjectGraphic.address", array('id' => 'address', 'div' => false, 'label' => '',"class" => "contactInput"));?>
				</p>
			</div>
			
			</td>--></tr>
			<tr>
		    		 <td colspan='4'>&nbsp;</td>
		     
		    </tr>
			<tr>
		    		 <td colspan='4'>&nbsp;</td>
		     
		    </tr>
			
			
			
			

<tr> 
<?php //echo "<pre>"; print_r($graphiclist); ?>
<td><label class="boldlabel"><?php echo "Facebook";//echo $graphiclist[0]['ProjectGraphic']['title'] ?></label>
</td> 
<?php
$i=0;
foreach($graphiclist as $grlist)
{
	if($graphiclist[$i]['ProjectGraphic']['active_status']==1)
		$chk[$i] = 1;
	else
		$chk[$i] = 0;
	$i++;
}


 ?>
<td><?php 
if($chk[0]==1)
	echo $form->input("activestatus_link", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
	echo $form->input("activestatus_link", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false)); 
?> 
</td>
<td><?php echo $form->input("title_link", array('id' => "title_link", 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "250",'value'=>$graphiclist[0]['ProjectGraphic']['title']));?>
</td>
<td><?php  echo $form->file("imagenameold_link",array('id'=> "imagenameold_link","class" => "contactInput"));?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Address: <?php echo $form->text("address_link", array('id' => "address_link", 'div' => false, 'label' => '',"class" => "contactInput",'value'=>$graphiclist[0]['ProjectGraphic']['address']));?>
<?php echo $form->input('ProjectGraphic.image_link',array('type'=>'hidden','value'=>$graphiclist[0]['ProjectGraphic']['imagename'])); ?>
</td>
</tr>
<tr>
<td><label class="boldlabel"><?php echo "Twitter";//echo $graphiclist[1]['ProjectGraphic']['title'] ?></label>
</td>
<td><?php 
if($chk[1]==1)
	echo $form->input("activestatus_face", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
	echo $form->input("activestatus_face", array('type'=>'checkbox', 'label' => '','div'=>false)); 
?> 
</td>
<td><?php echo $form->input("title_face", array('id' => "title_face", 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "250",'value'=>$graphiclist[1]['ProjectGraphic']['title']));?>
</td>
<td><?php  echo $form->file("imagenameold_face",array('id'=> "imagenameold_face","class" => "contactInput"));?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Address: <?php echo $form->text("address_face", array('id' => "address_face", 'div' => false, 'label' => '',"class" => "contactInput",'value'=>$graphiclist[1]['ProjectGraphic']['address']));?>
<?php echo $form->input('ProjectGraphic.image_face',array('type'=>'hidden','value'=>$graphiclist[1]['ProjectGraphic']['imagename'])); ?>
</td>
</tr>
<tr>
<td><label class="boldlabel"><?php echo "LinkedIn";//echo $graphiclist[2]['ProjectGraphic']['title'] ?></label>
</td>
<td><?php 
if($chk[2]==1)
	echo $form->input("activestatus_twit", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
	echo $form->input("activestatus_twit", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false)); 
?> 
</td>
<td><?php echo $form->input("title_twit", array('id' => "title_twit", 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "250",'value'=>$graphiclist[2]['ProjectGraphic']['title']));?>
</td>
<td><?php  echo $form->file("imagenameold_twit",array('id'=> "imagenameold_twit","class" => "contactInput"));?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Address: <?php echo $form->text("address_twit", array('id' => "address_twit", 'div' => false, 'label' => '',"class" => "contactInput",'value'=>$graphiclist[2]['ProjectGraphic']['address']));?>
<?php echo $form->input('ProjectGraphic.image_twit',array('type'=>'hidden','value'=>$graphiclist[2]['ProjectGraphic']['imagename'])) ?>
</td>
</tr>
<tr>
<td><label class="boldlabel"><?php echo "Donate";//echo $graphiclist[3]['ProjectGraphic']['title'] ?></label>
</td>
<td><?php 
if($chk[3]==1)
	echo $form->input("activestatus_don", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
	echo $form->input("activestatus_don", array('type'=>'checkbox', 'value'=>1, 'label' => '','div'=>false)); 
?> 
</td>
<td><?php echo $form->input("title_don", array('id' => "title_don", 'div' => false, 'label' => '',"class" => "contactInput","maxlength" => "250",'value'=>$graphiclist[3]['ProjectGraphic']['title']));?>
</td>
<td><?php  echo $form->file("imagenameold_don",array('id'=> "imagenameold_don","class" => "contactInput"));?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Address: <?php echo $form->text("address_don", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "contactInput",'value'=>$graphiclist[3]['ProjectGraphic']['address']));?>
<?php echo $form->input('ProjectGraphic.image_don',array('type'=>'hidden','value'=>$graphiclist[3]['ProjectGraphic']['imagename'])) ?>
</td>
</tr>
	<?php  } ?>		
		<tr>
		    		 <td colspan='4'>&nbsp;</td>
		     
		    </tr>
		    <tr>
		    		 <td colspan='4'>&nbsp;</td>
		     
		    </tr>
		
		<!--tr>
    		<td >&nbsp;</td>
    		<td >&nbsp;</td>
    		<td colspan='2'>
    		     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span>In progress</span> </button>
    		 </td>
    		 </tr-->	
		</table>
		
		<div class="top-bar" style="text-align: left; padding-top: 5px; ">
                            <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
                            </div>
	
		<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>
