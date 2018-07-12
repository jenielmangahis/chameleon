<?php $lgrt = $session->read('newsortingby');
$base_url_admin = Configure::read('App.base_url_admin');
	$resetUrl = $base_url_admin.'memberemails/'.$recordid;
     
?>   
  
<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>

 <?php $pagination->setPaging($paging); ?>    
<div class="container">    
    <div class="titlCont">
        <div style="width:960px; margin:0 auto;">
           <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
                
            <?php 
               echo $form->create("Admins", array("action" => "memberemails/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'memberemails', 'id' => "memberemails"));
            ?>
			<?php
							e($html->link(
										$html->image('new.png'),
										array('controller'=>'admins','action'=>'sendtempmail','sendemail'),array('escape' => false)
										)
							);
										//array('controller'=>'admins','action'=>'sendtempmail',$recordid),
										
						?>
		<a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
        <a href="javascript:void(0)" onclick="editholder();" id="linkedit"><?php e($html->image('edit.png')); ?></a>
<?php  echo $this->renderElement('new_slider');  ?>
            </div>
          
            <span class="titlTxt">Emails Releated To Member </span>

            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                        <li>
						<?php
							e($html->link(
										$html->tag('span', 'New'),
										array('controller'=>'admins','action'=>'sendtempmail',$recordid),
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
          
                        <?php    $this->loginarea="admins";    $this->subtabsel="emails";
                            echo $this->renderElement('member_submenus');  ?>   
                

        </div>
    </div>





  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span><span class="topRht_curv"></span>
		
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<div class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg">
                    <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));   ?>  
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa">&nbsp;&nbsp;  

            </span>
            
</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--   <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th> -->
                <th align="center" valign="middle" style="width:12%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date Sent</th>
                <th align="center" valign="middle" style="width:12%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Time</th>
                <th align="center" valign="middle" style="width:20%"><span class="right"><?php echo $pagination->sortBy('task_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'CommunicationTaskHistory',null,' ',' '); ?></span>Task Name</th>
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('email_template_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'EmailTemplate',null,' ',' ');?></span>Template Name</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('email_open', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Open(YorN)</th>
                <th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('email_link', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Link(YorN)</th>
            </tr>
            <?php $i=1;?>
            <?php if($holderemaillist){
                    $created="";  $i=1;
                    foreach($holderemaillist as $eachrow){
                        if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }
                        $recid= $eachrow['CommunicationTaskExecutionReport']['id'];
                        if($eachrow['CommunicationTaskExecutionReport']['created'] !='0000-00-00'){
                            $created =explode("," , AppController::usdateformat($eachrow['CommunicationTaskExecutionReport']['created'],1)); 
                            $datesent= $created[0]; 
                            $timesent=$created[1]; 
                        }
                        $taskname=$eachrow['CommunicationTaskHistory']['task_name'];
                        $templatename=$eachrow['EmailTemplate']['email_template_name'];
                        $emaiopen=$eachrow['CommunicationTaskExecutionReport']['email_open'];
                        $emaillink=$eachrow['CommunicationTaskExecutionReport']['email_link'];
              ?>
              <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <!--  <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="< ?php echo $recid; ?>" /></span></a></td>-->
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $datesent?$datesent:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span><?php echo $timesent?$timesent:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $taskname?$taskname:"N/A"; ?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $templatename?$templatename:"N/A"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $emaiopen=="1"?"Y":"N"; ?></span></td>
                            <td align="center" valign="middle" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $emaillink=="1"?"Y":"N"; ?></span></td>
              </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="8" align="center">No emails found.</td></tr>
                <?php  } ?>

        </table>




    </div>
    <div>
    <span class="botLft_curv"></span>
    <span class="botRht_curv"></span>
    <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
    </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
  </div>   
        <?php echo $form->end();?>  


    <div class="clear"></div>
 </div>      
