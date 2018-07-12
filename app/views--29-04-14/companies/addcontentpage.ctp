<?php $lgrt = $session->read('newsortingby');?>
<?php ?><!--container starts here-->
<div class="titlCont1"><div class="myclass">
<div align="center" class="slider" id="toppanel">
<?php 
if($extra=="" && $returnurl=="")
{
    echo $this->renderElement('new_slider');  
}
else
{
    if($extra=="detail" || $returnurl=="detail")
        $head="Event Detail";
    else
    if($extra=="sponsor" || $returnurl=="sponsor")
        $head="Sponsor Detail";
    else
    if($extra=="inquiry" || $returnurl=="inquiry")
        $head="Inquiry Detail";
    else
       $head="Add New Web Page" ;
}
?>



</div>
<?php echo $form->create("Companies", array("action" => "addcontentpage",'name' => 'addcontentpage','onsubmit'=>'return validatecontentpage();' ,'id' => "addcontentpage"));
 if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
    if($closeit=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }
    if($extra){ echo $form->hidden("extra", array('id' => 'extra', 'value'=>$extra)); }
    if($event_title){ echo $form->hidden("event_title", array('id' => 'event_title', 'value'=>$event_title)); }
 ?>
<span class="titlTxt">
<?php echo $head;?>
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"   <?php if($returnurl && $returnurl!="detail" && $returnurl!="sponsor" && $returnurl!="inquiry"){ echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='/<?php echo $lgrt;?>')" <?php } ?>  ><span> Cancel</span></button></li>
</ul>
</div>

</div>
</div>

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

<!--inner-container starts here-->
<div>
<div class="midPadd" id="addcntpg">
<div class="">

		
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<?php
    if($extra=="" && $returnurl=="")
    {
?>		 
        <div class="frmbox mgrt80">
		        <table cellspacing="15" cellpadding="0" align="center" width="100%">
		          <tbody>
		         <!--   <tr>
		              <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
		      		        echo $form->error('Content.title', array('class' => 'errormsg')); 
		      		        echo $form->error('Content.metatitle', array('class' => 'errormsg')); 
		      		        echo $form->error('Content.content', array('class' => 'errormsg')); 
		      	        ?></td>
		            </tr>-->
		            
		            <tr>
		             <td width="35%" align="right"><label class="boldlabel">Navigation <span style="color: red;">*</span></label></td>
                                    <td width="65%"><span class="intpSpannew"><?php echo $form->input("Content.title", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250",'onblur'=>"fillspacealias()"));?></span></td>
		            </tr>
		             <tr>
                             <td align="right"><label class="boldlabel">Alias <span style="color: red;">*</span></label></td>
                                <td><span class="intpSpannew"><?php echo $form->input("Content.alias", array('id' => 'alias', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                            </tr><tr>
                             <td align="right"><label class="boldlabel">Page Title <span style="color: red;">*</span></label></td>
                                <td><span class="intpSpannew"><?php echo $form->input("Content.metatitle", array('id' => 'metatitle', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                            </tr>
		            <tr>
			        <td  align="right"><label class="boldlabel">Parent Menu </label></td>

                                <td><span class="txtArea_top"><span class="txtArea_bot">
        <?php 
                                echo $form->select("Content.parent_id",$submenu,$data['Content']['parent_id'], array('id' => 'submenu', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");

        ?>
            </span>   </span></td>
		   	        </tr>
                    <tr>
                          <td width="35%"  align="right" class="lbltxtarea">  <label class="boldlabel">Required Log-in</label> <!-- Viewable Only After Log-in -->  </td>
                          <td width="65%"><?php echo $form->input('Content.is_global', array('type'=>'checkbox',"div" => false ,'label' => '')); ?></td>
                     </tr>
                     <tr>
                          <td width="35%"  align="right" class="lbltxtarea">  <label class="" style="padding-right: 16px;">Use Page Footer</label> <!-- Viewable Only After Log-in -->  </td>
                          <td width="65%"><?php echo $form->input('Content.page_footer', array('type'=>'checkbox',"div" => false ,'label' => '')); ?></td>
                     </tr>
                     <tr>
                    <td width="35%"  align="right" class="lbltxtarea"><label class="boldlabel">Header Image</label></td>
                    <td width="65%"><span class="intpSpannew"><?php echo $form->input("header_image", array('type'=>'file','id' => 'header_image', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "250"));?></span><br />If left blank then Header image specified in themes section will be applied.</td>
                    </tr>

		        
		            <tr><td colspan="2">&nbsp;</td></tr>
    		        
		        </tbody>
		        </table>
        </div>
        <div class="frmbox">
		        <table cellspacing="15" cellpadding="0" align="center" width="120%">
		          <tbody>
		           <!--<tr>
		             <td align="right" class="lbltxtarea"><label class="boldlabel">Metakeyword </label>&nbsp;</td>
                                <td >
			        <span class="newtxtArea_top">
			        <span class="newtxtArea_bot">
			        <?php //echo $form->input("Content.metakeyword", array('id' => 'metakeyword', 'div' => false, 'label' => '',"class" =>  "noBg",'rows'=>"3",'cols' => "30","maxlength" => "250",'style' =>"height:53px;"));?></span></td>
		            </tr>-->
		            <tr>
		             <td align="right" class="lbltxtarea"> <label class="boldlabel">Metadescription</label><br/>  
                     <span style="font-size: 11px; padding-right: 16px;">(Recommended 100</span><br/><span style="font-size: 11px; padding-right: 16px;"> characters)</span></td>
                                <td>
			        <span class="newtxtArea_top">
			        <span class="newtxtArea_bot">
			        <?php echo $form->input("Content.metadescription", array('id' => 'metadescription', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>"3",'cols' => "35","maxlength" => "250",'style' =>"height:100px; width: 225px;"));?></span></span>
                    
                    </td>
		            </tr>

                    <!--    Critical Review doc 2-29-12 - item 240         <tr>
                          <td width="40%"  align="right" class="lbltxtarea">  <label class="boldlabel">SEO Index</label></td>
                          <td width="60%">    
                                        < ?php echo $form->input('Content.meta_isindex', array('type'=>'checkbox','div' => false,'label' => '')); ?></td>
                        </tr>

                    
                            <tr>
                          <td width="40%"  align="right" class="lbltxtarea">  <label class="boldlabel">SEO link follow</label></td>
                          <td width="60%">  
                                    < ?php echo $form->input('Content.meta_isfollow', array('type'=>'checkbox','div' => false, 'label' => '')); ?>
                                </td>
                           </tr>   -->

		          </tbody>	
		        </table>
        </div>
      <?php
    }
?> 

<div class="clear"></div>
  <?php
    
    if(isset($data['Content']['alias']) && ($data['Content']['alias']=="events" || $data['Content']['alias']=="blogs" || $data['Content']['alias']=="comments" ||  $data['Content']['alias']=="chat"  ))
    {
           //continue;
    }else{
?>        	
			<table cellpadding="0" align="center" width="100%">
			<tr>
		        <td colspan="2">
		
			<?php	
				echo $form->textarea('Content.content', array('id'=>'content','class'=>'ckeditor','value'=>HOME_PAGE));
				echo $form->input('id', array('type'=>'hidden'));				
			?>
			</td>
		    </tr>	
		</tbody>
		</table>  
   <?php } ?>                          
		<?php echo $form->end();?>

  <div style="margin-bottom: 10px; text-align: left; padding: 0px 0px 10px 10px; color:black" class="top-bar">
              <?php  echo $this->renderElement('bottom_message');  ?>

            </div>
					<br>
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div></div></div>
 
<!--inner-container ends here-->

  
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcntpg").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>

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

