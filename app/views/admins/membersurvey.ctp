<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backMemberList = $base_url_admin.'membersurvey/'.$member_id;
$backDownloadholder = $base_url_admin.'downloadmembersurvey';
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



    function editholder()
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
            document.getElementById("linkedit").href=baseUrlAdmin+"editholder/"+id; 
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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Holder/1/memberlist/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Holder/0/memberlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Holder/0/memberlist/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script> 
<!--container starts here-->

<?php $pagination->setPaging($paging); ?>
<div class="container">
       <div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
               
			
			<div class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			
<?php
e($html->link($html->image('new.png') . ' ',array('controller'=>'admins','action'=>'addmember'),array('escape' => false)));

?>	 
<a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
<a href="javascript:void(0)" onclick="editholder();" id="linkedit"><?php e($html->image('edit.png')); ?></a>
<?php  echo $this->renderElement('new_slider');  ?>
            </div>		
</div>
        
            <?php echo $form->create("Admin", array("action" => "membersurvey/".$member_id,'name' => 'membersurvey', 'id' => "membersurvey")) ?>
            <!--<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>-->
            <span class="titlTxt"> Survey Releated To Member  </span>
            
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                        <li>
						<?php
							e($html->link(
										$html->tag('span', 'New'),
										array('controller'=>'admins','action'=>'addmember'),
										array('escape' => false)
										)
							);
						?>
						</li>
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                        <!--li><a href="javascript:void(0)">Copy</a></li-->
                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                </ul><?php */?>
            </div>

             <?php    $this->loginarea="admins";    $this->subtabsel="membersurveylist";
             echo $this->renderElement('member_submenus');  ?>   

        </div></div>
<div class="midCont" id="newhldtab">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
		<span class="topRht_curv"></span>
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<div class="new_filter">
            <span class="spnFilt">Filter:</span>
				<span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2">
					<?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                    if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey'] !=""){
                        echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
                    }
                ?> 
                
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $backMemberList ?>')" id="locaa">&nbsp;&nbsp;  

            </span><span class="srchBg2"><input type="button" value="Csv file download" label="" onclick="jjavascript:(window.location='<?php echo $backDownloadholder ?>')" > </span>
</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:1%">#</th>
                <th align="center" valign="middle" style="width:2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'SurveyResponse',null,' ',' ');
				 ?></span>Date</th>
				 <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('survey_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Survey',null,' ',' ');
				 ?></span>Survey/Form Name</th>
                <th align="center" valign="middle" style="width:11%"><span class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' ');
				 ?></span>First Name</th>
                <th align="center" valign="middle" style="width:11%"><span class="right"><?php echo $pagination->sortBy('lastnameshow', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' ');
				 ?></span>Last Name</th>
                <th align="center" valign="middle" style="width:11%"><span class="right"><?php echo $pagination->sortBy('phone', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' ');
				 ?></span>Phone</th>
                
          <th align="center" valign="middle" style="width:11%"><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' ');
				 ?></span>City</th>
                <th align="center" valign="middle" style="width:11%"><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'Holder',null,' ',' ');
				 ?></span>State</th>
                
            </tr>
            <?php $i=1;?>
            <?php if($surveyData){
                    $created="";              
                    foreach($surveyData as $eachrow){
                        $recid = $eachrow['Holder']['id'];
                        $userid = $eachrow['Holder']['user_id'];
						$editmemnerpage='';
                        $modelname = "Holder";
                        $othermodelname = "User";
                        $redirectionurl = "memberlist";
                        $firstname = $eachrow['Holder']['firstname'];
						$phone = $eachrow['Holder']['phone'];
						$city = $eachrow['Holder']['city'];
						$state = AppController::getstatename($eachrow['Holder']['state']);
                        if($firstname) $firstname = AppController::WordLimiter($firstname,25);
                        $lastnameshow = $eachrow['Holder']['lastnameshow'];
                        if($lastnameshow) $lastnameshow = AppController::WordLimiter($lastnameshow,25);
                        
					   //survey data
					   $surveyCreatedDate = $eachrow['SurveyResponse']['created'];
					   $survey_id = $eachrow['SurveyResponse']['survey_id'];
					   $survey_name = $eachrow['Survey']['survey_name'];
                      if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }

                    ?>
                    <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $surveyCreatedDate?$surveyCreatedDate:"N/A"; ?></span></td>      
                         
                            <td align="left" valign="middle" class='newtblbrd'>
								
								<?php
									e($html->link(
										$html->tag('span', ($survey_name)?$survey_name:"N/a"),
										array('controller'=>'admins','action'=>$editmemnerpage),
										array('escape' => false)
										)
									);			
								?>
							</td>
                            <td align="left" valign="middle" class='newtblbrd'>
								
								<?php
									e($html->link(
										$html->tag('span', ($firstname)?$firstname:"N/A"),
										array('controller'=>'admins','action'=>$editmemnerpage),
										array('escape' => false)
										)
									);			
								?>

							</td>
							
							
                            <td align="left" valign="middle" class='newtblbrd'>
								<?php
									e($html->link(
										$html->tag('span', ($lastnameshow)?$lastnameshow:"N/A"),
										array('controller'=>'admins','action'=>$editmemnerpage),
										array('escape' => false)
										)
									);			
								?>

							</td>
							
                           <td align="left" valign="middle" class='newtblbrd'>
								<?php
									e($html->link(
										$html->tag('span', ($phone)?$phone:"N/A"),
										array('controller'=>'admins','action'=>$editmemnerpage),
										array('escape' => false)
										)
									);			
								?>

							</td>
							
							     <td align="left" valign="middle" class='newtblbrd'>
								<?php
									e($html->link(
										$html->tag('span', ($city)?$city:"N/A"),
										array('controller'=>'admins','action'=>$editmemnerpage),
										array('escape' => false)
										)
									);			
								?>
							</td>
							 <td align="left" valign="middle" class='newtblbrd'>
								<?php
									e($html->link(
										$html->tag('span', ($state)?$state:"N/A"),
										array('controller'=>'admins','action'=>$editmemnerpage),
										array('escape' => false)
										)
									);			
								?>
							</td>
                           
                      </tr>
                    <?php } }else{ ?>
                <tr><td colspan="10" align="center">No Survey Found.</td></tr>
                <?php  } ?>

        </table>
    </div>
    <div>
    <span class="botLft_curv"></span>
	<span class="botRht_curv"></span>
	
    <div class="gryBot">
		<?php  echo $this->renderElement('newpagination');  ?>
    </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
      </div>    
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {		
        document.getElementById("newhldtab").className = "newmidCont";
    }	
</script>
