<?php ?>
<div class="titlCont"><div class="myclass">
        <div align="center" id="toppanel" >
	        <?php  

		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '39'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   

echo $this->renderElement('new_slider');  ?>
        </div>

        <span class="titlTxt">
        Controls
        </span>
	<?php echo $form->create("Company", array("action" => "projectcontrols",'type' => 'file','enctype'=>'multipart/form-data','name' => 'projectcontrols', 'id' => "projectcontrols"))?>
        <div class="topTabs">
        <ul>
        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span> Cancel</span></button></li>
        </ul>
        </div>
     <!--   <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        <div style="height: 30px; clear:both;">
        	
                <div id="tab-container-1">
                <ul id="tab-container-1-nav" class="topTabs2">
	
                  <li><a href="/companies/settingthemes" ><span>Themes</span></a></li>
                <li><a href="/companies/settings"><span>Settings</span></a></li>
                <li><a href="/companies/loginterms"><span>Terms &amp; Privacy</span></a></li>
                < ?php if($project['Project']['url']!="" || $project['Project']['url']!=null ) {?> <li><a href="/companies/iframes"><span>iFrames</span></a></li>  < ?php } ?>
                <li><a href="/companies/projectcontrols" class="tabSelt"><span>Controls</span></a></li>
		          <li><a href="/companies/change_password"><span>Change Password</span></a></li> 
                   </ul>
                </div>
        </div>      -->
         <?php   echo $form->hidden("selectedtab", array('id' => 'selectedtab')); 
         $this->loginarea="companies";    
        $this->subtabsel="projectcontrols";
        echo $this->renderElement('setup_submenus');  ?> 
</div></div>             

<div class='midPadd' id="ProjectType">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>





    <div class="left" style="min-height:300px">    
    <table width="800px" align="center" cellpadding="1" cellspacing="1">
							<tr>
								<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
													echo $form->error('ProjectType.project_type_name', array('class' => 'errormsg'));
												echo $form->hidden("ProjectType.id", array('id' => 'typeid'));
											?></td>
							</tr>
							<tr><td><!--<label class="boldlabel">Project Type <span style="color:red">*</span></label>--></td>
									<td><?php echo $form->hidden("ProjectType.project_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></td>
							</tr>

							<tr><td valign='top'><!--<label class="boldlabel">Note </label>--></td>
									<td><?php echo $form->hidden("ProjectType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?></td>
							</tr>
								<tr>
                                
										<td width="5%" align="center"><?php echo $form->input('ProjectType.coin_verification', array('type'=>'checkbox', 'label' => '')); ?></td>
                                        <td><label class="boldlabel">Registration with Coin # Required?</label></td>
							</tr>

							<tr>
								
								<td width="5%" align="center"><?php echo $form->input('Project.registration_confirmation', array('type'=>'checkbox', 'label' => '')); ?></td>
                                <td valign="top"><label class="boldlabel">Registration with Email Confirmation</label></td>
								</tr>  
							<!--<tr>
								<td valign="top"><label class="boldlabel">Verificationcode needed in Coin Registration </label></td>
								<td colspan="2"><?php //echo $form->input('Project.coins_verificationshow', array('type'=>'checkbox', 'label' => '')); ?></td>
								</tr> 
								-->
								<tr>
										<td width="5%" align="center"><?php echo $form->input('ProjectType.istransferable', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
                                        <td><label class="boldlabel">Coins Held By Multiple Holders ?</label></td>
							</tr>
								<tr>
										<td width="5%" align="center"><?php echo $form->input('ProjectType.simple_cointransfer', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
                                        <td><label class="boldlabel">Simple Coin Transfer</label></td>
							</tr>
								
								<tr>
										<td width="5%" align="center"><?php echo $form->input('ProjectType.registrationbox_verification', array('type'=>'checkbox', 'label' => '')); ?></td>
                                        <td><label class="boldlabel">RegistrationBox on Home page</label></td>
							</tr>
							
							<tr>
										<?php if($this->data['Project']['is_showcoins']==1){?>
										<td width="5%" align="center"><?php echo $form->input('Project.is_showcoins', array('type'=>'checkbox', 'label' => '','value'=>'1','checked'=>'checked')); ?>

										<?php }else{ ?>
										
										<td width="5%" align="center"><?php echo $form->input('Project.is_showcoins', array('type'=>'checkbox', 'label' => '','value'=>'1')); ?>
										<?php }?>
										</td>
                                        <td><label class="boldlabel">Show Coins Under Register Box</label></td>
								</tr>
								<tr>
                                <td width="5%" align="center"><?php echo $form->input('ProjectType.showcommentbutton', array('type'=>'checkbox', 'label' => '')); ?></td>
                                <td><label class="boldlabel">Show Comments Navigation Button</label></td>
										
							</tr>
								<tr>
                                <td width="5%" align="center"> <?php echo $form->input('ProjectType.iscommentpublic', array('type'=>'checkbox', 'label' => '')); ?></td>
                                <td><label class="boldlabel">Show Comments to Everyone</label></td>
										
							</tr>
                            <tr>
                            <td width="5%" align="center"><?php echo $form->input('ProjectType.showpoints', array('type'=>'checkbox', 'label' => '')); ?></td>
                            <td><label class="boldlabel">Points Awarded and Tracked</label></td>
                                        
                            </tr>
                            
                            </tr>
                            <tr>
                            <td width="5%" align="center"><?php echo $form->input('ProjectType.show_top10', array('type'=>'checkbox', 'label' => '')); ?></td>
                            <td><label class="boldlabel">Turn Off Top 10 Member Dashboard</label></td>
                                        
                            </tr>
							
						<!--	<tr><td><label class="boldlabel">RSVP Required</label></td>
										<td colspan="2"><?php //echo $form->input('ProjectType.is_rsvp', array('type'=>'checkbox', 'label' => '')); ?></td>
								</tr>     -->                

							<!--<tr><td><label class="boldlabel">Suggested Comment TypesMaximum # of comments per Holder</label></td>
										<td colspan="2" align="center">< ?php
										App::import("Model", "CommentType");
										$this->CommentType =   & new CommentType();


										$maxnumbercomment= $this->CommentType->find('count',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0'", 'order' =>"id"));
										$maxcomarr=array();
										for($j=1;$j<$maxnumbercomment;$j++)
										$maxcomarr[$j]=$j;
							?>
							</td></tr>
							<tr><td>&nbsp;</td><td>
													< ?php
										//echo $form->select("ProjectType.maxnumbercomment",$maxcomarr,$selectedend_after,array('id' => 'maxnumbercomment','style'=>'width:40px','onchange'=>'hidetextboxes()'),false); ?>
									</td></tr>
									<tr><td>&nbsp;</td>
										<td colspan="2">
										< ?php
										App::import("Model", "CommentType");
										$this->CommentType =   & new CommentType();

										$i=0;
										$commenttypedata = $this->CommentType->find('all',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0' ", 'order' =>"id"));
										$commenttypedropdown = Set::combine($commenttypedata, '{n}.CommentType.id', '{n}.CommentType.comment_type_name');
									
										foreach($commenttypedata as $eachrow){
										$i++;
											$commenttypedata = $this->CommentType->find('all',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0' and project_id=$project_id", 'order' =>"id"));
											$commenttypedropdown = Set::combine($commenttypedata, '{n}.CommentType.id', '{n}.CommentType.comment_type_name');
											App::import("Model", "ProjectCommentType");
											$this->ProjectCommentType =   & new ProjectCommentType();

											$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>" ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

											//echo $form->input("ProjectType.commenttype".$i, array('id' => 'commenttype'.$i, 'div' => false, 'label' => '',"class" => "contactInput","style"=>"width:20px","maxlength" => "3",'value'=>$i));
											
											//echo $form->select("ProjectType.commenttypeoption".$i,$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'commenttypevalue'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--'));
							//echo "<div class='clear'></div>";
										}
										?><br></td>
							</tr>
							<tr><td><label class="boldlabel">Additional Comments allowed:</label></td>
										<td width="70px">< ?php echo $form->input('ProjectType.additional_comment', array('type'=>'checkbox', 'label' => '','div'=>false,'onclick'=>'show_value()'));?>
											</td>
								<td>
								< ?php 
										
											App::import("Model", "ProjectCommentType");
											$this->ProjectCommentType =   & new ProjectCommentType();

											$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$ProjectTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

											//echo $form->select("additionalcomment",$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'additionalcomment'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--'));
								
										?>
								< ?php //echo $form->select("additionalcomment",array('0'=>'Misc.Additional Comment'),0,array('id' => 'additionalcomment'),false); ?></td>
							</tr>-->
								
							<tr><td><!--<label class="boldlabel">Default Delivery Days After Order Date</label>--></td>
										<td colspan="2"><?php echo $form->hidden("ProjectType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?></td>
							</tr>


<tr><td></td>
										
								<td>
								<?php 
										
											App::import("Model", "ProjectCommentType");
											$this->ProjectCommentType =   & new ProjectCommentType();

											$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$ProjectTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

											//echo $form->select("additionalcomment",$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'additionalcomment'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--'));
								
										?>
								<?php //echo $form->select("additionalcomment",array('0'=>'Misc.Additional Comment'),0,array('id' => 'additionalcomment'),false); ?></td>
							</tr>
								
							<tr><td><!--<label class="boldlabel">Default Delivery Days After Order Date</label>--></td>
										<td colspan="2"><?php echo $form->hidden("ProjectType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?></td>
							</tr>



								<!-- ADD FIELD EOF -->
								<!-- BUTTON SECTION BOF -->
							<tr><td colspan="3">&nbsp;</td></tr>

						
						</table>
					</div>
	</div>
	<div class='clear'></div>

    </div>
    
    
    
    <!-- main tab -->
    </div>
    
    <?php echo $form->end();?>
</div>

<div class='clear'></div>
</div></div>
<div class="midPadd">
	
		<div class="top-bar" style="border-left:0px;">

		</div>


</div>
<div class="clear"></div>
  <!-- Body Panel ends --> 
<script type="text/javascript">


		

		function hidetextboxes(){
		var i;
		var j=parseInt(document.getElementById("maxnumbercomment").options[document.getElementById("maxnumbercomment").selectedIndex].value)+1;
		for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
		{	
			document.getElementById("commenttype"+i).style.display="block";
			document.getElementById("commenttypevalue"+i).style.display="block";
		}
		if(j==1){
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
			{document.getElementById("ProjectTypeSimpleCointransfer").checked=false;		}
		}
		function show_value()
		{
		var e = document.getElementById("additionalcomment");
		if(document.getElementById("ProjectTypeAdditionalComment").checked==true)
			{
			if(document.getElementById("additionalcomment"))
			document.getElementById("additionalcomment").style.display="block";
		}
		else
		{
			//document.getElementById("additionalcomment").selectedIndex = 0;
			document.getElementById("additionalcomment").style.display="none";
		}
		}

window.onload=show_value;
	</script>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("ProjectType").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>


