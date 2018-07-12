<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script> 

<!--container starts here-->
<?php
$base_url = Configure::read('App.base_url');
$resetUrl = $base_url.'versions/system_version_list';
?>
<?php $pagination->setPaging($paging); ?>
<div class="titlCont">
  <div style="width:960px;margin:0 auto">
    <div align="center" id="toppanel" >
      <?php  echo $this->renderElement('new_slider');  ?>
    </div>
    <?php echo $form->create("versions", array("action" => "system_version_list",'name' => 'system_version_list', 'id' => "system_version_list"))?> <span class="titlTxt">Products </span>
    <div class="topTabs" style="margin-left: -40px;">
      <ul class="dropdown">
        <li class="">
          <?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'versions','action'=>'system_version','add'),
					array('escape' => false)
					)
				);
				?>
        </li>
		
        <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
          <ul class="sub_menu">
            <li><a onclick="return versionactivatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
            <li><a onclick="return versionactivatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
            <li><a onclick="return versionactivatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
            <li class="botCurv"></li>
          </ul>
        </li>
        <li><a id="linkedit" onclick='setEditRecord("versions/system_version/edit");' href="javascript:void(0)"><span>Edit</span></a></li>
      </ul>
    </div>
    <div class="clear"></div>
    <?php $this->system_version_list="tabSelt"; echo $this->renderElement('project_list_submenu');?>
  </div>
</div>
<div class="midCont">
  <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
  <div><span class="topLft_curv"></span>
    <div class="gryTop"> <?php echo $form->create("versions", array("action" => "system_version_list",'name' => 'system_version_list', 'id' => "system_version_list")) ?>
      <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
      <div style="float:left"> <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span> <span class="srchBg2">
        <input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa">
        </span> </div>
      <div style="float:left">
        <?php if($session->check('Message.flash')){ ?>
        <?php $session->flash(); ?>
        <?php } 
                   ?>
      </div>
      <div class="clear"></div>
      </span> </div>
    <span class="topRht_curv"></span>
    <div class="clear"></div>
  </div>
  <div class="tblData">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="trBg">
        <th align="left" valign="middle" style="width:1%">#</th>
        <th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
        <th align="center" valign="middle" style="width: 25%;"><span class="right" ><?php echo $pagination->sortBy('system_version_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Version</th>
        <th align="center" valign="middle" style="width: 50px;"><span class="right"><?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Note</th>
        <th align="center" valign="middle" style="width: 15%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
      </tr>
      <?php if($sys_ver_data){ $i=1;
                    $alt=0;

                    foreach($sys_ver_data as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;

                        $recid = $eachrow['SystemVersion']['id'];
                        $sys_ver_name = $eachrow['SystemVersion']['system_version_name'];
                        $modelname = "SystemVersion";
                        $redirectionurl = "system_version_list";
                        $notetext = "";
                        if($eachrow['SystemVersion']['note']){
                            $notetext = AppController::WordLimiter($eachrow['SystemVersion']['note'],60);
                        }
                        if($notetext==" ")
                            $notetext= $eachrow['SystemVersion']['note'];
                    ?>
      <tr <?php echo $class;?>>
        <td align="center" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
        <td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
        <td align="left" valign="middle"  width="18%"><?php
						e($html->link(
							$html->tag('span', $eachrow['SystemVersion']['system_version_name']),
							array('controller'=>'versions','action'=>'system_version','edit',$recid),
							array('escape' => false)
							)
						);
						?>
        </td>
        <td align="left" valign="middle"><?php
						e($html->link(
							$html->tag('span', $notetext?$notetext:"N/A"),
							array('controller'=>'versions','action'=>'system_version','edit',$recid),
							array('escape' => false)
							)
						);
						?>
        </td>
        <td align="center" valign="middle"><?php 
							if($eachrow['SystemVersion']['active_status']=='1'){
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['SystemVersion']['system_version_name'])),
									array('controller'=>'versions','action'=>'changestatus',$recid,'2'),
									array('escape' => false)
									)
								);
							} else {
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['SystemVersion']['system_version_name'])),
									array('controller'=>'versions','action'=>'changestatus',$recid,'1'),
									array('escape' => false)
									)
								);
							}			
							?>
        </td>
      </tr>
      <?php } }else{ ?>
      <tr>
        <td colspan="4" align="center">No Product Type Found.</td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <!--inner-container ends here-->
  <div> <span class="botLft_curv"></span>
    <div class="gryBot">
      <?php if($sys_ver_data) { echo $this->renderElement('newpagination'); } ?>
    </div>
    <span class="botRht_curv"></span>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<!--container ends here-->
