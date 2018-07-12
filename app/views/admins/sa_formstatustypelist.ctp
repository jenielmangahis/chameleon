<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 
<?php
	$base_url_admin = Configure::read('App.base_url_admin');
?>
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



 	function editstatustype()
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
		document.getElementById("linkedit").href=baseUrlAdmin+"sa_formstatustype_add/"+id; 
		
		}
	} 
  

function activatecontents(act,op)
{   
    var id="";
        var count=0;
    $('.checkid').each(function(){       
        var check = $(this).attr('checked')?1:0;
        if(check ==1)
        {           
            if(id==""){
                id=$(this).val();
               
                ++count;
                }
                else
                {
                id=id + "*" + $(this).val();
                ++count;
                }
        }
   });
        if(id !=""){
                        if(op=="change"){       
                                if(act=="active"){
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/FormSubmitStatustype/1/sa_formstatustypelist/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/FormSubmitStatustype/0/sa_formstatustypelist/cngstatus";
                                        }
                        }
                        if(op=="del"){
                        if(confirm("You have selected "+count +" items to delete ?"))

                         if(confirm("Are You Sure to delete the item"))
                            window.location=baseUrlAdmin+"changestatus/"+id+"/sa_FormSubmitStatustype/0/formstatustypelist/delete";
                       }
}else{
                alert('Please atleast one record should be select'); 
                return false;
        }
} 

   </script>
<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
   <div class="container">
<div class="titlCont">

<div class="myclass">
<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?>
</div>
        <?php echo $form->create("Admin", array("action" => "sa_formstatustypelist",'name' => 'formstatustypelist', 'id' => "formstatustypelist")) ?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
        </script>

<span class="titlTxt">
Forms Status Types
</span>
<div class="topTabs">
<ul class="dropdown">
<li>

	<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'sa_formstatustype_add'),
					array('escape' => false)
					)
				);
?>
</li>   
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
                     
                     <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                     <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                      <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');" >Trash</a></li>
                     <li class="botCurv"></li>
                </ul>
</li>
<li><a href="javascript:void(0)" onclick="editstatustype();" id="linkedit"><span>Edit</span></a></li>   
</ul>
</div>
         <div class="clear"></div>
        <?php  $this->sa_formstatustypelist ="tabSelt";
             echo $this->renderElement('super_admin_types');  ?>    
             
</div></div>



    <div class="midCont">



	
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


    <!-- top curv image starts -->
    <div>
    <span class="topLft_curv"></span>
	<span class="topRht_curv"></span>
    <div class="gryTop">
	<div class="new_filter">

					<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                                                        
                                                        ?> 
                                                            </span>
								<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>sa_formstatustypelist')" id="locaa"></span>
		
                    </div>	
				</div>	
                    <div class="clear"></div></div>

<?php $i=1; ?>			
		
                    <div class="tblData">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr class="trBg">
	               <th align="center" valign="middle" width="2%">#</th>
	               <th align="center" valign="middle" width="2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
	               <th align="center" valign="middle" width="88%">Status Type <span class="right">
                   <?php echo $pagination->sortBy('statustype_name',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                   </span></th>
                   <th align="left" valign="middle" width="15%">Status<span class="right">
                   <?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
                   </span></th>

                   </tr>
   	<?php if($statustypedata){ 
	        $alt=0;
		    $i=1;
            $modelname = "FormSubmitStatustype";
            $redirectionurl = "sa_formstatustypelist";   
         
   			foreach($statustypedata as $eachrow){
            
			    //alternate color rows
			    if($alt%2==0)
				    $class="style='background-color:#FFF;'";
			    else
				    $class="style='background-color:#f8f8f8;'";
                $alt++;
   			$recid = $eachrow['FormSubmitStatustype']['id'];
            
   			$statustype_name = $eachrow['FormSubmitStatustype']['statustype_name'];
			if($statustype_name) $statustype_name = AppController::WordLimiter($statustype_name,15);
            
           
   			
   		?>
   	<tr <?php echo $class;?>>	
			
		<td align="center"><a href="/admins/sa_formstatustype_add/<?php echo $recid?>" ><span><?php echo $i++;?></span></a></td>
		<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
		<td align="left" valign="middle">
		<?php
				e($html->link(
					$html->tag('span', $statustype_name),
					array('controller'=>'admins','action'=>'sa_formstatustype_add',$recid),
					array('escape' => false)
					)
				);
		?>
		</td>
        <td align="center" valign="middle">
        <?php if($eachrow['FormSubmitStatustype']['active_status']=='1'){ 
			e(
								$html->link(
									$html->image('active.gif',array('title'=>'Click here to deactivate '.$statustype_name)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}else {

							e(
								$html->link(
									$html->image('deactive.gif',array('title'=>'Click here to activate '.$statustype_name)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
									array('escape'=>false)
								)
							);
						}	
		?>
      </td>
	
		</tr>
	<?php } }else{ ?>
	<tr><td colspan="4" align="center">No status type(s) Found.</td></tr>
	<?php } ?>
	</table> 
    
			
 </div>
                    <div>
                    <span class="botLft_curv"></span><span class="botRht_curv"></span>
<div class="gryBot"><?php if($statustypedata) { echo $this->renderElement('newpagination'); } ?>
                    </div>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->

<?php echo $form->end();?>

                    </div>

<div class="clear"></div>
