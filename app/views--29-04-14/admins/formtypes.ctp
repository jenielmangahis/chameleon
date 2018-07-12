<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'formtypes';

?>
<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>     

<div class="titlCont"><div style="width:960px;margin:0 auto">
       
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Admins", array("action" => "formtypes",'name' => 'formtypes', 'id' => "formtypes"))?> 
<span class="newtitlTxt">Form Types </span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'formtypesadd'),
					array('escape' => false)
					)
				);
				?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                </ul></li>
                <li><a id="linkedit" onclick="editformtype();" href="javascript:void(0)"><span>Edit</span></a></li>
        </ul>
        </div>
            <div class="clear"></div>
            <?php $this->formtypes="tabSelt";echo $this->renderElement('super_admin_types'); ?>

</div></div>     
<div class="midCont" id="newprttype">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                
               <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl  ?>')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                      <?php $session->flash(); ?> <?php } 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                    //    echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>

<div class="tblData">
                      <table width="540px" border="0" cellspacing="0" cellpadding="0">
                	<tr class="trBg"> 
			<th align="center" valign="middle" style="width:10px">#</th>
			<th align="center" valign="middle" style="width:10px">
				<input type="checkbox" id="checkall" name="checkall" value="">
			</th>
     			<th align="center" valign="middle" style="width:200px">
				<span class="right">
					<?php echo $pagination->sortBy('formtype_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
				</span>Form Name
			</th>
				<th align="center" valign="middle" style="width:200px">
				<span class="right">
					<?php echo $pagination->sortBy('releation_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
				</span>Relationship Type
			</th>
    			<th align="center" valign="middle" style="width:670px">
			<span class="right">
				<?php echo $pagination->sortBy('form_description', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>Form Discription
			</th>
     			<th align="center" valign="middle" style="width:70px">
			<span class="right">
			<?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>Status
			</th>
      </tr>
   	<?php 
	$alt = 0;
	if($formtypedata){ $i=1;
            
            foreach($formtypedata as $eachrow){
                    //alternate color rows
                     if($alt%2==0)
                        $class="class='altrow'";
                     else
                        $class="";
                
                    $alt++;
                    $recid = $eachrow['FormType']['id'];
                    $modelname = "FormType";
                    $redirectionurl = "formtypes";           
                    $formtype_name = $eachrow['FormType']['formtype_name'];
                    if($formtype_name) $formtype_name = AppController::WordLimiter($formtype_name,25);             
					$releation_type = $eachrow['FormType']['releation_type'];
					if($releation_type > 0){
						$getrelationtype =  $common->getrelationshiptype($releation_type,'list');	
					}
					
                    $form_description = $eachrow['FormType']['form_description'];
                    if($form_description) $form_description = AppController::WordLimiter($form_description,100);
           ?>
           
        <tr <?php echo $class;?>>    
              <td align="center" valign="middle" class='newtblbrd'> <span style="color:#4d4d4d;"><?php echo $i++ ?></span></td>
              <td align="center" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
              <td align="left" valign="middle" class='newtblbrd' width="18%">
			  <?php
				e($html->link(
					$html->tag('span', $formtype_name),
					array('controller'=>'admins','action'=>'formtypesadd',$recid),
					array('escape' => false)
					)
				);
			  ?>
			  </td>
			     <td align="left" valign="middle" class='newtblbrd'>
			  <?php
				e($html->link(
					$html->tag('span', ($getrelationtype)?$getrelationtype:"N/A"),
					array('controller'=>'admins','action'=>'formtypesadd',$recid),
					array('escape' => false)
					)
				);
			  ?>
			  </td>
              <td align="left" valign="middle" class='newtblbrd'>
			  <?php
				e($html->link(
					$html->tag('span', $form_description?$form_description:"N/A"),
					array('controller'=>'admins','action'=>'formtypesadd',$recid),
					array('escape' => false)
					)
				);
			  ?>
			  </td>
              <td align="center" valign="middle" class='newtblbrd'>
			  <?php 
				if($eachrow['FormType']['active_status']=='1'){
					e($html->link(
						$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['FormType']['formtype_name'])),
						array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
						array('escape' => false)
						)
					);
				} else {
					e($html->link(
						$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['FormType']['formtype_name'])),
						array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
						array('escape' => false)
						)
					);
				}			
				?>
			  
			 </td>
        
        </tr>
	<?php } }else{ ?>
	<tr><td colspan="4" align="center">No Form Types Found.</td></tr>
	<?php } ?>
	</table>
	


</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($formtypedata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>
                    <script type="text/javascript">
          



$(document).ready(function()
{

                        $('#checkall').bind('change',function(){
                        var check = $(this).attr('checked')?1:0;
                        if(check ==1)
                        {
                                        $('.checkid').each(function()
                                        {
                                                        $(this).attr('checked',true);

                                        });


                        }else{

                                        $('.checkid').each(function()
                                        {
                                                        $(this).attr('checked',false);

                                        });
                        }               

        })

});
$(document).ready(function()
{   
        $('.checkid').bind('change',function()
        {   
                //event.stopPropagation();
                var i=0;
                var j=0;
                $('.checkid').each(function(){
                        i++;
                        var check = $(this).attr('checked')?1:0;
                        if(check ==1)
                        {                       
                                j++;
                        }


                });
                
                if(i==j)
                        $('#checkall').attr('checked',true);
                else
                        $('#checkall').attr('checked',false);
        });
});



        function editformtype()
        {       
        var counter=0;
        var id="";
        $('.checkid').each(function(){          
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {                       
                                id=$(this).val();
                                counter=counter +1;
                }
        });     
        
        if(counter!=1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{  
                document.getElementById("linkedit").href=baseUrlAdmin+"formtypesadd/"+id; 
                
                }
        } 


function activatecontents(act,op)
{       
        var id="";
        $('.checkid').each(function(){          
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {                       
                        if(id=="")
                                id=$(this).val();
                        else
                                id=id + "*" + $(this).val();
                }
   });
        if(id !=""){
                        if(op=="change"){       
                                if(act=="active"){
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/FormType/1/formtypes/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/FormType/0/formtypes/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are ou ure to delete the item ?"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/FormType/0/formtypes/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newprttype").className = "newmidCont";
	}	
</script>

<!--container ends here-->
