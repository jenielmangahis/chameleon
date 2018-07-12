<?php
		$base_url = Configure::read('App.base_url');
	$lgrt = $base_url.$session->read('newsortingby');
?>

<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Company", array("action" => "projectcontacttypes_add",'name' => 'projectcontacttypes_add', 'id' => "projectcontacttypes_add",'onsubmit' => 'return validatecontacttype("add");'));
       echo $form->hidden("ContactType.id", array('id' => 'contacttypeid','value'=>"$contacttypeid"));  
        if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
         if(isset($closeit)=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }                                                                                            
?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt"><?php echo $pageactionname;?> Contact Type </span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
              <li><button type="button" id="saveForm" class="button"  <?php if($returnurl){ echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')"  <?php } ?>><span> Cancel</span></button></li>
                </ul>
        </div>
</div></div>


	
<div class="midPadd">
		<div id="addcont" style="height:300px;">
        <div style="margin-top: 5px;">  
	    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
         <div class="clear" ></div>
         </div>
		<!-- ADD Sub Admin FORM BOF -->

		
		<table width="" align="" cellpadding="1" cellspacing="1" style="margin-top: 5px;">  
		
		<tr><td align="right"><label class="boldlabel">Contact Type <span class="red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("ContactType.contact_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	        </tr>
	   
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>     </td></tr>
		
	
	    </table>

<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->
				
			</div></div>
 
</div><!--inner-container ends here-->

<div class="clear"></div>


</div><!--container ends here-->
 <script type="text/javascript">

  $(document).ready(function(){
     
           if($("#closeit")){
               isclose=$("#closeit").val();
                     
               if(isclose=="yes"){
                     // This function from `Parent window i.e formtype_add`
                    window.opener.GetContactTypeRefresh();
                    window.close();
               }
            }
     });
     
     function closemywindow(){
          window.opener.GetContactTypeRefresh();
          window.close();
     }
     
     
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcont").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>