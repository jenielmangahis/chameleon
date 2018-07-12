<!--container starts here-->
<?php $base_url_admin = Configure::read('App.base_url_admin');
	  $base_url = Configure::read('App.base_url');
	  $base_url=$base_url.'legals/'
?>
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
        
         <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>      
<?php echo $form->create("legals", array("action" => "user_agreement_list",'name' => 'user_agreement_list', 'id' => "user_agreement_list"))?>
   <span class="titlTxt">User Agreement List </span>
        <div class="topTabs" style="margin-left: -40px;">
            <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'legals','action'=>'user_agreement','add'),
					array('escape' => false)
					)
				);
				?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                     <!-- <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>-->
                        <li class="botCurv"></li>
                    </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <?php // $this->user_agreement_list="tabSelt"; echo $this->renderElement('super_admin_config_types');?>
        <ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Agreements by Project'),
			array('controller'=>'legals','action'=>'user_agreement_list_by_project'),
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'User Agreement'),
			array('controller'=>'legals','action'=>'user_agreement_list'),
			array('escape' => false,'class'=>'tabSelt')
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Agree History'),
			array('controller'=>'legals','action'=>'user_agreehistory'),
			array('escape' => false,'class'=>'user_agreehistory')
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Spam Policy'),
			$spam_policy_url,
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Terms & Privacy'),
			$terms_url,
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
        </ul>
        
       

    </div></div>
<div class="midCont">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("legals", array("action" => "user_agreement_list",'name' => 'user_agreement_list', 'id' => "user_agreement_list")) ?>
           <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url ?>user_agreement_list')" id="locaa"></span>
            </div>
            <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 

                    <?php $session->flash(); ?> <?php } 
                   ?>
            </div> 
            <div class="clear"></div>
            </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
    </div>

    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
             <th align="left" valign="middle" style="width:1%">#</th>
            <th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
                <th align="center" valign="middle" style="width: 47%;"><span class="right" ><?php echo $pagination->sortBy('agreement_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>User Agreement Name</th>
                <th align="center" valign="middle" style="width: 15%;"><span class="right"><?php echo $pagination->sortBy('modified', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Edit Date</th>
                <th align="center" valign="middle" style="width: 15%;"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Current Default</th>
				<th align="center" valign="middle" style="width: 10%;"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
            </tr>
            <?php if($user_agr_data){ $i=1;
                    $alt=0;

                    foreach($user_agr_data as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;
                        
                        $recid = $eachrow['UserAgreement']['id'];
                        $agreement_name = $eachrow['UserAgreement']['agreement_name'];
                        $modified=$eachrow['UserAgreement']['modified'];
                        $modified=date('m-d-Y',strtotime($modified));
                        
                        $default=$eachrow['UserAgreement']['default_new_projects'];
                        $modelname = "UserAgreement";
                        $redirectionurl = "user_agreement_list";
                    ?>
                    <tr <?php echo $class;?>>    
                        <td align="center" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
                        <td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                        <td align="left" valign="middle"  width="18%">
						<?php
						e($html->link(
							$html->tag('span', $agreement_name),
							array('controller'=>'legals','action'=>'user_agreement','edit',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>
                        <td align="center" valign="middle">
						<?php
						e($html->link(
							$html->tag('span', ($modified)?$modified:'N/A'),
							array('controller'=>'legals','action'=>'user_agreement','edit',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>              
                        <td align="center" valign="middle">
                            <?php 
							if($eachrow['UserAgreement']['default_new_projects']=='1'){
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['UserAgreement']['agreement_name'])),
									array('controller'=>'legals','action'=>'setAsDefault',$recid),
									array('escape' => false)
									)
								);
							}else{
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['UserAgreement']['agreement_name'])),
									array('controller'=>'legals','action'=>'setAsDefault',$recid),
									array('escape' => false)
									)
								);
							}
							?>

                        </td>
						<td align="center" valign="middle">
                            <?php 
							if($eachrow['UserAgreement']['active_status']=='1'){
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['UserAgreement']['agreement_name'])),
									array('controller'=>'legals','action'=>'changestatus',$recid,'2'),
									array('escape' => false)
									)
								);
							}else{
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['UserAgreement']['agreement_name'])),
									array('controller'=>'legals','action'=>'changestatus',$recid,'1'),
									array('escape' => false)
									)
								);
							}
							?>

                        </td>

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="5" align="center">No User Agreement Found.</td></tr>
                <?php } ?>
        </table>



    </div><!--inner-container ends here-->

    <div>
        <span class="botLft_curv"></span>

        <div class="gryBot">

            <?php if($user_agr_data) { echo $this->renderElement('newpagination'); } ?>
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
            alert("please select only one row to edit");
            return false;
        }else{  
            document.getElementById("linkedit").href=baseUrl+"legals/user_agreement/edit/"+id; 

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
                    window.location=baseUrl+"legals/changestatus/"+id+"/1/UserAgreement/user_agreement_list";
                }else{
                    window.location=baseUrl+"legals/changestatus/"+id+"/0/UserAgreement/user_agreement_list";
                }
            }
            if(op=="del"){
                if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrl+"legals/changestatus/"+id+"/UserAgreement/0/user_agreement_list/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>  
<!--container ends here-->
