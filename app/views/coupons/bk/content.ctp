<?php 
$base_url= Configure::read('App.base_url');
$lgrt = $session->read('newsortingby');
$backUrl = $base_url.'offers/offerpages/'.$extra;
?>
<?php //print_r($contentid);?><div class="titlCont1"><div class="myclass">
<div align="center" class="slider" id="toppanel">
<?php 

if(empty($extra) && $returnurl=="")
{
    echo $this->renderElement('new_slider');  
	$head="Edit Web Page" ;
}
else
{
    if($extra=="merchant" || $returnurl=="merchant")
        $head="Merchant Web Page";
    else if($extra=="inquiry" || $returnurl=="inquiry")
        $head="Inquiry Web Page";
    else if($extra=="event" || $returnurl=="event")
        $head="Event Web Page";
    else
       $head="Offer Web Page" ;
}
?>
</div>
<?php echo $form->create("offers", array("action" => "editcontent/$contentid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent",'onsubmit' => 'return validatecontentpage();'));
echo $form->hidden("Content.id", array('id' => 'contentid'));
	
if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
    if($closeit=="yes"){   echo $form->hidden("offers.closeit", array('id' => 'closeit', 'value'=>$closeit)); }
    if(isset($extra) && !empty($extra)){
			echo $form->hidden("offers.extra", array('id' => 'extra', 'value'=>$extra)); 
		}
    if(isset($event_title) && !empty($event_title)){ echo $form->hidden("offers.event_title", array('id' => 'event_title', 'value'=>$event_title)); }
?>
 <?php  echo $this->renderElement('project_name');  ?>
<span class="titlTxt"> <?php echo $head; ?>
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"   <?php if($returnurl && $returnurl!="merchant" && $returnurl!="inquiry" && $returnurl!="event"){ echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')" <?php } ?> ><span> Cancel</span></button></li>
</ul>
</div>

</div></div>

<?php 
echo $javascript->link('ckeditor/ckeditor'); 
?>

<script type="text/javascript">
	function trim(s)
	{
		return rtrim(ltrim(s));
	}

	function ltrim(s)
	{
		var l=0;
		while(l < s.length && s[l] == ' ')
		{	l++; }
		return s.substring(l, s.length);
	}

	function rtrim(s)
	{
		var r=s.length -1;
		while(r > 0 && s[r] == ' ')
		{	r-=1;	}
		return s.substring(0, r+1);
	}
	function fillspacealias()
	{
	 var alias=trim(document.getElementById('title').value);
		alias=alias.replace(/\s+/g,"-");
		alias=alias.toLowerCase();
		document.getElementById('alias').value=alias;
	}
</script>

<!--inner-container starts here--><div class="rightpanel">

<div class="midPadd">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <?php 
    if(empty($extra) && empty($returnurl))
    {
?>

<div class="frmbox mgrt80">
			<table cellspacing="15" cellpadding="0" align="center" width="440px">
					<tbody>
					<?php if($session->check('Message.flash')){ ?>
					<tr>
					<td ><?php 
						$session->flash(); 
						
						echo $form->error('Content.title', array('class' => 'errormsg')); 
						echo $form->error('Content.metatitle', array('class' => 'errormsg')); 
						echo $form->error('Content.content', array('class' => 'errormsg')); 
						?></td>
					</tr>
					<?php } ?>
			<?php if($this->data['Content']['alias']=='home_page'){?>
					
					<tr>
					<td width="35%" align="right"><label class="boldlabel">Navigation <span style="color: red;">*</span></label></td>
						<td width="65%"><span class="intpSpannew"><?php echo $form->input("Content.title", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250","readonly"=>"readonly"));?></span></td>
					</tr>
				
			<?php } else{ ?>
					<tr>
					<td align="right"><label class="boldlabel">Navigation <span style="color: red;">*</span></label></td>
						<td><span class="intpSpannew"><?php echo $form->input("Content.title", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250",'onblur'=>"fillspacealias()"));?></span></td>
					</tr>
			<?php } ?>
					<tr>
					<td align="right"><label class="boldlabel">Alias<span style="color: red;">&nbsp;&nbsp;</span></label></td>
						<td><span class="intpSpannew"><?php echo $form->input("Content.alias", array('id' => 'alias', 'div' => false, 'label' => '','readonly' => 'readonly',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
					</tr><tr>
					<td align="right"><label class="boldlabel">Page Title <span style="color: red;">*</span></label></td>
						<td><span class="intpSpannew"><?php echo $form->input("Content.metatitle", array('id' => 'metatitle', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
					</tr>
					
					<tr>
			
						
			<td   align="right"><label class="boldlabel">Parent Menu</label>&nbsp;&nbsp;</td>
			
						<td><span class="newtxtArea_top"><span class="txtArea_bot">
			<?php 
						if(!isset($data['Content']['parent_id']) || empty($data['Content']['parent_id']))
						$data['Content']['parent_id'] = 0;
						echo $form->select("Content.parent_id",$submenu,$data['Content']['parent_id'], array('id' => 'submenu', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
			
			?>
			</span>   </span></td>
						</tr>
			<tr><td colspan="2" width="100%">
			<?php if($this->data['Content']['is_sytem']=='1'){ ?>
					<table cellspadding="0" cellspacing="15" width="100%">        
			
						  <tr>
                  <td width="35%" align="right" class="lbltxtarea">  <label class="boldlabel">Required Log-in</label> <!-- Viewable Only After Log-in -->  </td>
                  <td width="65%"> <?php echo $form->input('Content.is_global', array('type'=>'checkbox','div' => false,'label' => '')); ?></td>
                    </tr>
                    
                                   
					</table>  	
						<?php } ?>
					
			</td></tr>
            <tr>
                  <td width="35%"  align="right" class="lbltxtarea">  <label class="" style="padding-right: 16px;">Use Page Footer</label> <!-- Viewable Only After Log-in -->  </td>
                  <td width="65%"> <?php echo $form->input('Content.page_footer', array('type'=>'checkbox','div' => false,'label' => '')); ?></td>
                    </tr>
            <tr>
<td width="35%"  align="right" class="lbltxtarea"><label class="boldlabel">Header Image</label></td>
<td width="65%"><span class="intpSpannew"><?php echo $form->input("header_image", array('type'=>'file','id' => 'header_image', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
</tr>
					</tbody>
					</table>
</div>
<div class="frmbox ">
			<table cellspacing="15" cellpadding="0" align="center" width="460px">
					<tbody>
					<tr>
					<td align="right" class="lbltxtarea"><label class="boldlabel">Meta Description</label><br/>
                      <span style="font-size: 11px; padding-right: 22px;">(Recommended 100</span><br/><span style="font-size: 11px; padding-right: 22px;"> characters)</span>
                    </td>
						<td><span class="newtxtArea_top">
						<span class="newtxtArea_bot"><?php echo $form->input("Content.metadescription", array('id' => 'metadescription', 'div' => false,'style' =>"height:100px; width: 225px;",'label' => '',"class" => "noBg",'rows'=>"3",'cols' => "35","maxlength" => "250"));?></span></td>
					</tr>
			</tbody></table>
</div>
    <?php
    }
?> 

<div class="clear"></div>
			<table  cellpadding="0" align="center" width="100%">
					<tbody>
			<?php if($this->data['Content']['alias']!="logout" && $this->data['Content']['alias']!="dashboard" && $this->data['Content']['alias']!="event" && $this->data['Content']['alias']!="pastevents" && $this->data['Content']['alias']!="events" && $this->data['Content']['alias']!="blogs" && $this->data['Content']['alias']!="chat" && $this->data['Content']['alias']!="comments" && $this->data['Content']['alias']!="add-to-cart" && $this->data['Content']['alias']!="shopping-cart" && $this->data['Content']['alias']!="checkout") { ?>
					<tr>
						<td colspan=2>
							<?php  
									echo $form->textarea('Content.content', array('id'=>'content','class'=>'ckeditor',"rows"=>"100"));
									echo $form->input('id', array('type'=>'hidden'));                                               
						     ?>
						</td> 
					</tr>       
					<?php } ?>
					</tbody>
					</table>

<div class="">
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
                     <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/offers/editprojectdtl')"><span>In progress</span> </button>
                 </td>
                 </tr-->        
                </table>
                
                            
                <?php echo $form->end();?>
                                        
                                        <!-- ADD Sub Admin  FORM EOF -->
<div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>

                                
                        </div></div>
 
</div><!--inner-container ends here-->

  
<div class="clear"></div>

<script type="text/javascript">
    $(document).ready(function(){
        if($("#closeit")){
            isclose=$("#closeit").val();
            if(isclose=="yes"){
                // This function from `Parent window i.e formtype_add`
                window.opener.GetContentRefresh();
                window.close();
            }
        }
    });

    function closemywindow(){
        window.opener.GetContentRefresh();
        window.close();
    }
</script>