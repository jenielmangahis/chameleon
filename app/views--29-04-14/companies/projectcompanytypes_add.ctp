<?php  $base_url = Configure::read('App.base_url');
		$lgrt = $base_url.$session->read('newsortingby');
?>
<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Company", array("action" => "projectcompanytypes_add",'name' => 'projectcompanytypes_add', 'id' => "projectcompanytypes_add",'onsubmit' => 'return validatecompanytype("add");'));
       echo $form->hidden("CompanyType.id", array('id' => 'companytypeid','value'=>"$companytypeid")); 
         if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
         if(isset($closeit)=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }                                                              
?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>
   
  <span class="titlTxt"><?php echo $pageactionname;?> Company Type </span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
          <li><button type="button" id="saveForm" class="button"  <?php if($returnurl){ echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')"  <?php } ?>><span> Cancel</span></button></li>
            </ul>
        </div>
</div></div>


    
	
<div class="midPadd" style="float:left;padding-left:195px;">
		<div id="addcmp" style="height:300px;">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->
                  
		<table width="" align="" cellpadding="1" cellspacing="1">
		
		<tr><td align="right"><label class="boldlabel">Company Type <span class="red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("CompanyType.company_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td><td>&nbsp;</td><td>&nbsp;</td>
	        </tr>
	      
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>     </td></tr>        
	
	    </table> 
<?php echo $form->end();?>

					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div>  </div>
            </div><div>
<!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->

<script type="text/javascript">

  $(document).ready(function(){
     
           if($("#closeit")){
               isclose=$("#closeit").val();
                     
               if(isclose=="yes"){
                // This function from `Parent window i.e formtype_add`
                    window.opener.GetCompanyTypeRefresh();
                    window.close();
               }
            }
     });
     
     function closemywindow(){
          window.opener.GetCompanyTypeRefresh();
          window.close();
     }
     
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>