<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'bloglist';
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



 	function editblog()
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
		document.getElementById("linkedit").href=baseUrlAdmin+"blogadd/"+id; 
		
		}
	} 

     function invitetoevent()
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
        alert("please select only one event  to invite");
        return false;
        }else{    
        document.getElementById("linkinvite").href=baseUrlAdmin+"eventinvitation/"+id; 
        
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
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/Blog/1/bloglist/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/Blog/0/bloglist/cngstatus";
                                        }
                        }
                        if(op=="del"){
                        if(confirm("You have selected "+count +" items to delete ?"))

                         if(confirm("Are You Sure to delete the item"))
                            window.location=baseUrlAdmin+"changestatus/"+id+"/Blog/0/bloglist/delete";
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
    	<div class="slider-centerpage clearfix">
            <div class="center-Page col-sm-6">
            	<?php  //echo $this->renderElement('project_name');  ?> 
                <h2>Blogs</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
					<?php //echo $form->create("Admin", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
                    <script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
                    <?php e($html->link($html->image('new.png') . ' ',array('controller'=>'admins','action'=>'blogadd'),array('escape' => false))); ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');" ><?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editblog();" id="linkedit"><?php e($html->image('edit.png')); ?></a>    
                    <?php  echo $this->renderElement('new_slider');  ?>                
                </div>
                
            </div>
            <div class="topTabs">
                <?php /*?><ul class="dropdown">
                   <li>
					<?php
					e($html->link(
						$html->tag('span', 'New'),
						array('controller'=>'admins','action'=>'blogadd'),
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
                    <li><a href="javascript:void(0)" onclick="editblog();" id="linkedit"><span>Edit</span></a></li>
                </ul><?php */?>
            </div>
        </div>
   
</div>
  
   

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    
		$this->loginarea="admins";
		$this->subtabsel="bloglist";
		echo $this->renderElement('setting_submenus');
	  	?>  
    </div>
</div> 


<div class="midCont">
	
	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


    <!-- top curv image starts -->
    <div>
    <!--<span class="topLft_curv"></span>
	<span class="topRht_curv"></span>-->
    <div class="gryTop">
		<?php echo $form->create("Admin", array("action" => "bloglist",'name' => 'bloglist', 'id' => "bloglist")) ?>
		<script type='text/javascript'>
			function setprojectid(projectid){
					document.getElementById('projectid').value= projectid;
					document.adminhome.submit();
				}
		</script>
		<div class="new_filter">
					<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                                                        
                                                        ?> 
                                                            </span>
								<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
		
                    </div>	
					</div>
                    <div class="clear"></div></div>

<?php $i=1; ?>			
		
                    <div class="tblData table-responsive">

			<table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr class="trBg">
	<th align="left" valign="middle" width="15px">#</th>
	   <th align="left" valign="middle" width="10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
	  <th align="left" valign="middle" width="150px"> <span class="right"><?php echo $pagination->sortBy('title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Title</th>
      <th align="left" valign="middle"><span class="right"><?php echo $pagination->sortBy('introcontent', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Short Description</th>
     <th align="left" valign="middle" width="70px"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

      </tr>
   	<?php if($blogdata){ 
	$alt=0;
		$i=1;
   			foreach($blogdata as $eachrow){
					//alternate color rows
			if($alt%2==0)
				$class="style='background-color:#FFF;'";
			else
				$class="style='background-color:#f8f8f8;'";
				
				$alt++;
   			$recid = $eachrow['Blog']['id'];
   			$modelname = "Blog";
   			$redirectionurl = "bloglist";
   		//	$company_type_id = $eachrow['CompanyType']['company_type_name'];
   			$blog_title = $eachrow['Blog']['title'];
			if(isset($event_name)) $event_name = AppController::WordLimiter($event_name,15);
            
            $short_description = $eachrow['Blog']['introcontent'];
            if($short_description) $short_description = AppController::WordLimiter($short_description,100);
            
            
               
   			
   		?>
   	<tr <?php echo $class;?>>	
			
		<td align="center"><a><span><?php echo $i++;?></span></a></td>
		<td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
		<td align="left" valign="middle">
			<a><span><?php echo $blog_title; ?></a></span>
		</td>
        <td align="left" valign="middle">
			<a><span><?php echo $short_description; ?></a></span>
		</td>      
        <td align="center" valign="middle">
			<?php if($eachrow['Blog']['active_status']=='1'){
				e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$blog_title)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}
							else{

								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'dfdd','title'=>'Click here to activate '.$blog_title)),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
										)
									);
								}
						?>
				</td>
	
		</tr>
	<?php } }else{ ?>
	<tr><td colspan="6" align="center">No Blog Found.</td></tr>
	<?php } ?>
	</table> 
    
			
 </div>
                    <div>
                    <!--<span class="botLft_curv"></span>
					<span class="botRht_curv"></span>-->
<div class="gryBot"><?php //if($blogdata) { 
echo $this->renderElement('newpagination'); //} ?>
                    </div>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->

<?php echo $form->end();?>

                    </div>

<div class="clear"></div>
