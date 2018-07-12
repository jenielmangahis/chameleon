<?php $base_url = Configure::read('App.base_url');
	  $base_url_survey =$base_url.'surveys/'; 
	  $backDownload = $base_url_survey.'download_survey_history';
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
			document.getElementById("linkedit").href=baseUrl+"surveys/add_survey/"+id; 
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
                                        window.location=baseUrl+"surveys/changestatus/"+id+"/SurveyHistory/1/survey_history/cngstatus";
                                        }else{
                                        window.location=baseUrl+"surveys/changestatus/"+id+"/SurveyHistory/0/survey_history/cngstatus";
                                        }
                        }
                        if(op=="del"){
                        if(confirm("You have selected "+count +" items to delete ?"))

                         if(confirm("Are You Sure to delete the item"))
                            window.location=baseUrl+"surveys/changestatus/"+id+"/surveys/0/survey_history/delete";
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
			<?php echo $form->create("Surveys", array("action" => "survey_history",'name' => 'survey_history', 'id' => "survey_history")) ?>
			<?php e($html->link($html->image('new.png') . ' ',array('controller'=>'surveys','action'=>'add_survey'),array('escape' => false))); ?>
			<a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
			<a href="javascript:void(0)" onclick="editsurvey();" id="linkedit"><?php e($html->image('edit.png')); ?> </a>
			<?php  echo $this->renderElement('new_slider');  ?>
			</div>
			<span class="titlTxt"> Survey List</span>

			<div class="topTabs" style="height:25px;">
				<?php /*?><ul class="dropdown">
					<!--  <li><?php
					e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'surveys','action'=>'survey_response'),
					array('escape' => false)
					)
					);
					?>
					</li>  -->
					<li><a href="javascript:void(0)" class="tab2"><span>Actions</span>
					</a>
						<ul class="sub_menu">

							<li><a href="javascript:void(0)"
								onclick="return activatecontents('active','change');">Publish</a>
							</li>
							<li><a href="javascript:void(0)"
								onclick="return activatecontents('deactive','change');">Unpublish</a>
							</li>
							<li><a href="javascript:void(0)"
								onclick="return activatecontents('asd','del');">Trash</a></li>
							<li class="botCurv"></li>
						</ul>
					</li>
					<li><a href="javascript:void(0)" onclick="editsurvey();"
						id="linkedit"><span>Edit</span> </a></li>
				</ul><?php */?>
			</div>

			<?php    $this->loginarea="surveys";    $this->subtabsel="survey_history";
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
					</span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));	?> </span> 
					<span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_survey ?>survey_history')"	id="locaa"> </span>
					<span class="srchBg2"><input type="button" value="Csv file download" label="" onclick="jjavascript:(window.location='<?php echo $backDownload ?>')" > </span>
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
					<th align="center" valign="middle" width="10%">	Date Sent <span class="right"> <?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>	</span>	</th>
					<th align="center" valign="middle" width="20%">Survey Name<span class="right"><?php echo $pagination->sortBy('survey_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?> </span> </th>
					<th align="center" valign="middle" width="10%">Survey Type<span	class="right"><?php echo $pagination->sortBy('survey_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>
					<th align="center" valign="middle" width="20%">	Email Template/Webpage<span	class="right"><?php echo $pagination->sortBy('template', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>
					<th align="center" valign="middle" width="10%">#Sent<span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>
					<th align="center" valign="middle" width="8%">#Rec'd<span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>
					<th align="center" valign="middle" width="8%">#Opt-Out<span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>
					<th align="center" valign="middle" width="8%">#Bounce<span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>
				</tr>
				
				<?php if($surveyhistorydata){ 
					$alt=0;
					$i=1;
 					foreach($surveyhistorydata as $eachrow){

			$class = ($alt%2==0)? "style='background-color:#FFF;'" : "style='background-color:#f8f8f8;'";   
			
			$surveytypearray = array('Both','Email','WebPage');
			$alt++;
			$recid = $eachrow['Survey']['id'];
			$modelname = "Survey";
			$redirectionurl = "survey_history";
			$datesent = date("m-d-Y", strtotime($eachrow['Survey']['created']));
			$survey_name = $eachrow['Survey']['survey_name'];
			$survey_type = $surveytypearray[$eachrow['Survey']['survey_type']];
			$template_webpage = '';
			 
			if($eachrow['Survey']['template']!="" &&  $eachrow['Survey']['webpage']!=""){
				$template_webpage = $eachrow['EmailTemplate']['email_template_name'].'/'.$eachrow['WpPost']['post_title'];
			}else{
				if($eachrow['Survey']['template']!="")				
					$template_webpage = $eachrow['EmailTemplate']['email_template_name'];
				else 
					$template_webpage = $eachrow['WpPost']['post_title'];
			}
				
			$sent = $eachrow['Survey']['sent'];
			$received =$eachrow['Survey']['received'];
			$opt_out =  $eachrow['Survey']['opt_out'];
			$bounce	 = $eachrow['Survey']['bounce'];
			
			?>
				<tr <?php echo $class;?>>

					<td align="center"><a><span><?php echo $i++;?> </span> </a></td>
					<td align="center">
						<a>
							<span>
								<input type="checkbox" class="checkid" name="checkid[]" value="<?php echo $recid; ?>" />
							</span>
						</a>
					</td>
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $datesent),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $survey_name),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $survey_type),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $template_webpage),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $sent),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $received),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $opt_out),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
					<td align="left" valign="middle"><?php
					e($html->link(
					$html->tag('span', $bounce),
					array('controller'=>'surveys','action'=>'survey_response',$recid),
					array('escape' => false)
					));
					?>
					</td>
			
				</tr>
				<?php } 
}else{ ?>
				<tr>
					<td colspan="10" align="center">No Surveys found.</td>
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