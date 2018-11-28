<!--container starts here-->
<?php Configure::read('App.base_url');?>
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
        <?php echo $form->create("Setups", array("action" => "help_list",'name' => 'help_list', 'id' => "help_list"))?>
                <div align="center" id="toppanel" >
                 <?php  echo $this->renderElement('new_slider');  ?>
        </div><span class="titlTxt">Site Help List </span>
        <div class="topTabs">
                <ul class="dropdown">
                    <li><a href="<?php echo Configure::read('App.base_url');?>/setups/addhelp"><span>Add</span></a></li>
                    <li><a id="linkedit" onclick="editholderhelplist();" href="javascript:void(0)"><span>Edit</span></a></li>
                </ul>
                </div>
                <div class="clear"></div>
                <?php $this->help_list="tabSelt"; echo $this->renderElement('super_admin_config_types'); ?>
        </div>
</div>
</div>

<div class="midCont" id="hlplisttab">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


    <div><span class="topLft_curv"></span> 
	<span class="topRht_curv"></span>               
        <div class="gryTop">
                <?php echo $form->create("setups", array("action" => "help_list",'name' => 'help_list', 'id' => "help_list")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
                     <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='help_list')" id="locaa"></span>
                </div>
  <div style="float:left">   <?php 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div> 
        <div class="clear"></div>
</div>

<div class="tblData">
                   
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="trBg">
     <th align="center" valign="middle" style="width:1%;">#</th>
     <th align="center" valign="middle" style="width:2%;"><input type="checkbox" id="checkall" name="checkall" value=""></th>
     <th align="center" valign="middle" style="width:28%"><span class="right"><?php echo $pagination->sortBy('name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Name </th>
     <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('content',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Content</th>
     <th align="center" valign="middle" style="width:28%"><span class="right"><?php echo $pagination->sortBy('section', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Section</th>
   


      </tr>
        <?php if($hlpdata1){  $i=1;
                        foreach($hlpdata1 as $eachrow){
                        $recid = $eachrow['HelpContent']['id'];
                        $modelname = "HelpContent";
                        $redirectionurl = "help_list";
                        $notetext = "";
                        if($eachrow['HelpContent']['content']){
                                $notetext = AppController::WordLimiter($eachrow['HelpContent']['content'],60);
                        }
                        
                ?>
	<?php if($i%2 == 0) { ?>
        <tr class='altrow'>    <td align="center" valign="middle" class='newtblbrd'><?php echo $i++ ?></td><td align="center" class='newtblbrd' valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                <td align="left" class='newtblbrd' valign="middle"><a href='edithelp/<?php echo $recid;?>'><span><?php echo $eachrow['HelpContent']['name']; ?><span></a></td>
   
                <td align="left" class='newtblbrd' valign="middle"><a href='edithelp/<?php echo $recid;?>'><span><?php echo $notetext?$notetext:"N/A"; ?></span></a></td>
                 <td align="left" valign="middle" class='newtblbrd'><a href='edithelp/<?php echo $recid;?>'><span><?php echo $eachrow['HelpContent']['section']; ?></span></a></td>
              
                </tr>

	<?php } else { ?>

	<tr>    <td align="center" valign="middle"><?php echo $i++ ?></td><td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                <td align="left" valign="middle">
					
			<?php
				e($html->link(
					$html->tag('span', $eachrow['HelpContent']['name']),
					array('controller'=>'setups','action'=>'edithelp',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
   
                <td align="left" valign="middle">

				<?php
					e($html->link(
					$html->tag('span', $notetext?$notetext:"N/A"),
					array('controller'=>'setups','action'=>'edithelp',$recid),
					array('escape' => false)
					)
				);
				?>	
				</td>
                 <td align="left" valign="middle">
				<?php
					e($html->link(
					$html->tag('span', $eachrow['HelpContent']['section']),
					array('controller'=>'setups','action'=>'edithelp',$recid),
					array('escape' => false)
					)
				);
				?>

				</td>
              
                </tr>


	<?php } ?>		


        <?php } }else{ ?>
        <tr><td colspan="5" align="center">No Help Content Found.</td></tr>
        <?php } ?>
</table>
        
</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      <span class="botRht_curv"></span>
                    <div class="gryBot">
                    
                 <?php //if($hlpdata1) { 
				 echo $this->renderElement('newpagination'); //} ?>
        </div>

                    
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>

<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("hlplisttab").className = "newmidCont";
	}	
</script>
