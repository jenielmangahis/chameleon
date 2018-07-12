<?php $base_url = Configure::read('App.base_url');
	  $base_url_survey =$base_url.'surveys/'; 
?>
<script type="text/javascript">
$(document).ready(function() {
	$('#SurveyMnu').removeClass("butBg");
	$('#SurveyMnu').addClass("butBgSelt");

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



 	function editsurvey()
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
		document.getElementById("linkedit").href=baseUrl+"surveys/survey_action/"+id; 
		
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
                                        window.location=baseUrl+"surveys/changestatus/"+id+"/SurveyAction/1/surveyactionlist/cngstatus";
                                        }else{
                                        window.location=baseUrl+"surveys/changestatus/"+id+"/SurveyAction/0/surveyactionlist/cngstatus";
                                        }
                        }
                        if(op=="del"){
                        if(confirm("You have selected "+count +" items to delete ?"))

                         if(confirm("Are You Sure to delete the item"))
                            window.location=baseUrl+"surveys/changestatus/"+id+"/surveys/0/surveyactionlist/delete";
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
			<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
				
			<?php echo $form->create("Surveys", array("action" => "surveyactionlist",'name' => 'surveyactionlist', 'id' => "surveyactionlist")) ?>
			<?php e($html->link($html->image('new.png') . ' ',array('controller'=>'surveys','action'=>'survey_action'),array('escape' => false))); ?>
			<a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
			<a href="javascript:void(0)" onclick="editsurvey();" id="linkedit"><?php e($html->image('edit.png')); ?> </a>
			<?php  echo $this->renderElement('new_slider');  ?>
			</div>
			<span class="titlTxt"> Survey List</span>

			<div class="topTabs" style="height:25px;">
				<?php /*?><ul class="dropdown">
					<li><?php
					e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'surveys','action'=>'survey_action'),
					array('escape' => false)
					)
					);
					?>
					</li>
					<li><a href="javascript:void(0)" class="tab2"><span>Actions</span>
					</a>
						<ul class="sub_menu">

							<li><a href="javascript:void(0)"
								onclick="return activatecontents('active','change');">Publish</a>
							</li>
							<li><a href="javascript:void(0)"
								onclick="return activatecontents('deactive','change');">Unpublish</a>
							</li>
							<li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
							<li class="botCurv"></li>
						</ul>
					</li>
					<li><a href="javascript:void(0)" onclick="editsurvey();" id="linkedit"><span>Edit</span> </a></li>
				</ul><?php */?>
			</div>

			<?php    $this->loginarea="surveys";    $this->subtabsel="surveyactionlist";
             echo $this->renderElement('survey_submenus');  ?>
		</div>
	</div>
	<div class="midCont">
		<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
		<!-- top curv image starts -->
		<div>
			<span class="topLft_curv"></span> <span class="topRht_curv"></span>
			<div class="gryTop">
				<div class="new_filter">

					<span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?>
					</span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

					?> </span> <span class="srchBg2"><input type="button" value="Reset"
						label=""
						onclick="javascript:(window.location='<?php echo $base_url_survey ?>surveyactionlist')"
						id="locaa"> </span>
				</div>
			</div>
			<div class="clear"></div>
		</div>

		<?php $i=1; ?>

		<div class="tblData">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr class="trBg">
					<th align="center" valign="middle" width="1%">#</th>
					<th align="center" valign="middle" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
					<th align="center" valign="middle" width="85%">Survey Action<span
						class="right"><?php echo $pagination->sortBy('action_title', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span>
					</th>
					<th align="center" valign="middle" width="12%">Status<span
						class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
					</span>
					</th>

				</tr>
				<?php if($surveyactiondata){ 
					$alt=0;
					$i=1;
					foreach($surveyactiondata as $eachrow){
			
			$class = ($alt%2==0)? "style='background-color:#FFF;'" : "style='background-color:#f8f8f8;'";   
			
			$alt++;
			$recid = $eachrow['SurveyAction']['id'];
			$modelname = "SurveyAction";
			$redirectionurl = "surveyactionlist";
			$action_title = $eachrow['SurveyAction']['action_title'];
			if($action_title) $action_title = AppController::WordLimiter($action_title,25);
			?>
				<tr <?php echo $class;?>>

					<td align="center"><a><span><?php echo $i++;?> </span> </a></td>
					<td align="center"><a><span><input type="checkbox" class="checkid"
								name="checkid[]" value="<?php echo $recid; ?>" /> </span> </a></td>
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $action_title),
					array('controller'=>'surveys','action'=>'survey_action',$recid),
					array('escape' => false)
					)
					);
					?>
					</td>
					
					<td align="center" valign="middle">
				<?php if($eachrow['SurveyAction']['active_status']=='1'){

					e(
					$html->link(
					$html->image('active.gif',array('title'=>'Click here to deactivate '.$action_title)),
					array('controller'=>'surveys','action'=>'changestatus',$recid,$modelname,0,$redirectionurl,'cngstatus'),
					array('escape'=>false)
					)
					);
				}else {

					e(
					$html->link(
					$html->image('deactive.gif',array('title'=>'Click here to activate '.$action_title)),
					array('controller'=>'surveys','action'=>'changestatus',$recid,$modelname,1,$redirectionurl,'cngstatus'),
					array('escape'=>false)
					)
					);
				}
				?>
					</td>
				</tr>
				<?php } 
}else{ ?>
				<tr>
					<td colspan="6" align="center">No Surveys found.</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div>
			<span class="botLft_curv"></span> <span class="botRht_curv"></span>
			<div class="gryBot">
				<?php  echo $this->renderElement('newpagination');  ?>
			</div>
			<div class="clear"></div>
		</div>
		<!--inner-container ends here-->

		<?php echo $form->end();?>

	</div>

	<div class="clear"></div>