<!--container starts here-->
<script type="text/javascript">
$(document).ready(function() {
$('#conFiugure').removeClass("butBg");
$('#conFiugure').addClass("butBgSelt");
}); 
</script> 

<?php
$base_url = Configure::read('App.base_url');
$resetUrl = $base_url.'setups/border_footer_list';
?>
<?php $pagination->setPaging($paging); ?>
<div class="titlCont">

<div class="centerPage">
        
         <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>      
<?php echo $form->create("setups", array("action" => "border_footer_list",'name' => 'border_footer_list', 'id' => "border_footer_list"))?>
   <span class="titlTxt">Border Footer </span>
        <div class="topTabs" style="margin-left: -40px;">
            <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'setups','action'=>'border_footer'),
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
                <li><a id="linkedit" onclick="setEditRecord('setups/border_footer');" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <?php $this->border_footer_list="tabSelt"; echo $this->renderElement('super_admin_config_types');?>
        
       

    </div></div>
<div class="midCont">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("Admins", array("action" => "system_version_list",'name' => 'system_version_list', 'id' => "system_version_list")) ?>
           <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("BorderFooter.searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
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
				<th align="left" valign="middle" style="width:1%;">#</th>
				<th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
                <th align="center" valign="middle" style="width: 22%;"><span class="right" ><?php echo $pagination->sortBy('system_version_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Border Footer Name</th>
                <th align="center" valign="middle" style="width: 25%;"><span class="right"><?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Related Projects</th>
				<th align="center" valign="middle" style="width: 15%;"><span class="right" ><?php echo $pagination->sortBy('system_version_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Default</th>
				<th align="center" valign="middle" style="width: 20%;"><span class="right" ><?php echo $pagination->sortBy('system_version_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Last Edit Date</th>
                <th align="center" valign="middle" style="width: 10%;"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
            </tr>
            <?php 
			if($border_footer_list){ $i=1;
                    $alt=0;
                    foreach($border_footer_list as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;

                        $recid = $eachrow['BorderFooter']['id'];
                        $modelname = "BorderFooter";
                        $redirectionurl = "border_footer_list";
                        
                    ?>
                    <tr <?php echo $class;?>>    
                        <td align="center" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
                        <td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                        <td align="left" valign="middle"  width="18%">
						<?php
						e($html->link(
							$html->tag('span', $eachrow['BorderFooter']['border_footer_name']),
							array('controller'=>'setups','action'=>'border_footer',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e($html->link(
							$html->tag('span', "##"),
							'#',
							array('escape' => false)
							)
						);
						?>
						</td>   
						<td align="left" valign="middle">
						<?php 
							if($eachrow['BorderFooter']['is_default']=='1'){
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to remove as default '.$eachrow['BorderFooter']['border_footer_name'])),
									array('controller'=>'setups','action'=>'setAsDefault',$recid),
									array('escape' => false)
									)
								);
							} else {
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to make default '.$eachrow['BorderFooter']['border_footer_name'])),
									array('controller'=>'setups','action'=>'setAsDefault',$recid),
									array('escape' => false)
									)
								);
							}			
							?>
						</td>
						<td align="left" valign="middle">
						<?php
						e($eachrow['BorderFooter']['modified']);
						?>
						</td>
                        <td align="center" valign="middle">
							<?php
							$modalname="BorderFooter";
							$redirctaction="border_footer_list";
							if($eachrow['BorderFooter']['active_status']=='1'){
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['BorderFooter']['border_footer_name'])),
									array('controller'=>'setups','action'=>'changestatus',$recid,'2',$modalname,$redirctaction),
									array('escape' => false)
									)
								);
							} else {
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['BorderFooter']['border_footer_name'])),
									array('controller'=>'setups','action'=>'changestatus',$recid,'1',$modalname,$redirctaction),
									array('escape' => false)
									)
								);
							}			
							?>
                        </td>

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="7" align="center">No Border Footer Found.</td></tr>
                <?php } ?>
        </table>



    </div><!--inner-container ends here-->

    <div>
        <span class="botLft_curv"></span>

        <div class="gryBot">

            <?php if($border_footer_list) { echo $this->renderElement('newpagination'); } ?>
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

                    window.location=baseUrl+"setups/changestatus/"+id+"/1/BorderFooter/border_footer_list";
                }else{
                    window.location=baseUrl+"setups/changestatus/"+id+"/2/BorderFooter/border_footer_list";
                }
            }
            if(op=="del"){
                if(confirm("Are you sure to delete the item?"))
                    window.location=baseUrl+"setups/border_footer_delete/"+id;
            }
			
						
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>  
<!--container ends here-->