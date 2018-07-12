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
    function editDonationLevel()
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
            document.getElementById("linkedit").href=baseUrlAdmin+"memberlevels_add/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/MemberLevel/1/memberlevels/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/MemberLevel/0/memberlevels/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/MemberLevel/0/memberlevels/delete";
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
              
			  <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">		<?php echo $form->create("Admins", array("action" => "memberlevels",'name' => 'memberlevels', 'id' => "memberlevels")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>		
<?php
e($html->link($html->image('new.png') . ' ' . __(''), $base_url_admin."memberlevels",array('escape' => false))); ?>
<a href="javascript:void(0)" onclick="return activatecontents('asd','del');">
<?php e($html->image('action.png')); ?></a>
<a href="javascript:void(0)" onclick="editDonationLevel();" id="linkedit"><?php e($html->image('edit.png')); ?></a>
<?php echo $this->renderElement('new_slider'); 
?>			
</div>
      
          
            <span class="titlTxt">   Member Levels List  </span>            
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                <li>
					<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'memberlevels_add'),
					array('escape' => false)
					)
				);
				?>
				</li>  
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                       <!-- <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                        li><a href="javascript:void(0)">Copy</a></li-->
                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="editDonationLevel();" id="linkedit"><span>Edit</span></a></li>
                </ul><?php */?>
            </div>

       
            <?php    $this->loginarea="admins";    $this->subtabsel="levelsetup";
                    echo $this->renderElement('memberlist_submenus');  ?>   
        </div></div>
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
			<div  class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
      ?> 
              
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick = "javascript:(window.location=baseUrlAdmin+'memberlevels')" id="locaa">&nbsp;&nbsp;  
           </span>
</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                

      <tr class="trBg">
        <th align="center" valign="middle" style="width:1%">#</th>
        <th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
		<th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Level#</th>
        <th align="center" valign="middle" style="width:20%"><span class="right"><?php echo $pagination->sortBy('level_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Level Name</th>
        <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('level_lowerrange', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Spending From</th>
		<th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('level_upperrange', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Spending To</th>
        <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('level_note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Notes</th>
        <th align="center" valign="middle" style="width:7%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
      </tr>
       <?php if($memberlevellist){ $i=1;         
               foreach($memberlevellist as $eachrow){
                   
               $recid = $eachrow['MemberLevel']['id'];
               $modelname = "MemberLevel";
               $redirectionurl = "memberlevels";
               $level_name=   $eachrow['MemberLevel']['level_name']; 
               $level_lowerrange =$eachrow['MemberLevel']['level_lowerrange'];  
               $level_upperrange =$eachrow['MemberLevel']['level_upperrange'];  
              /* if($level_lowerrange!='' && $level_upperrange!='' ){
                    $donation_range="$".$level_lowerrange." - $".$level_upperrange;
               }else{
                   $donation_range="NA";
                }*/
                
                $note =$eachrow['MemberLevel']['level_note'];
                if($note) $note = AppController::WordLimiter($note,50);
                
                  if($i%2 == 0 ){
                       $cls="altrow";        
                     } else{
                        $cls=""; 
                     }
                        
           ?>
            <tr class='<?php echo $cls; ?>'>    
             <td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td>
             <td align="center" class='newtblbrd' valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
			 <td align="left" class='newtblbrd' valign="middle">
			 <?php
				e($html->link(
					$html->tag('span', $recid),
					array('controller'=>'admins','action'=>'memberlevels_add',$recid),
					array('escape' => false)
					)
				);
			?>

			</td>
             <td align="left" class='newtblbrd' valign="middle">
			 <?php
				e($html->link(
					$html->tag('span', $level_name),
					array('controller'=>'admins','action'=>'memberlevels_add',$recid),
					array('escape' => false)
					)
				);
			?>

			</td>
             <td align="center" class='newtblbrd' valign="middle">
			 
				
				 <?php
				e($html->link(
					$html->tag('span', '$ '.$level_lowerrange),
					array('controller'=>'admins','action'=>'memberlevels_add',$recid),
					array('escape' => false)
					)
				);
			?>
			</td>
			   <td align="center" class='newtblbrd' valign="middle">
			 
				
				 <?php
				e($html->link(
					$html->tag('span', '$ '.$level_upperrange),
					array('controller'=>'admins','action'=>'memberlevels_add',$recid),
					array('escape' => false)
					)
				);
			?>
			</td>
             <td align="left" class='newtblbrd' valign="middle">
				
					 <?php
				e($html->link(
					$html->tag('span', $note),
					array('controller'=>'admins','action'=>'memberlevels_add',$recid),
					array('escape' => false)
					)
				);
			?>
			</td>
             <td align="center" valign="middle" class='newtblbrd'>
				
				<?php if($eachrow['MemberLevel']['active_status']=='1'){ 
					if(isset($eachrow['MemberLevel']['member_type'])){
						$data=$eachrow['MemberLevel']['member_type'];
					}
						else{
							$data='';
						
					}
						e($html->link(
								$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$data)),
								array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
				}
				else{ 	
						e($html->link(
								$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$data)),
								array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
								array('escape' => false)
								)
							);
				}
				?>
				
			</td>
        
        </tr>
    <?php  }
       }else{ ?>
    <tr><td colspan="6" align="center">No Donation levels Found.</td></tr>
    <?php } ?>
    </table>



    </div>
    <div>
    <span class="botLft_curv"></span><span class="botRht_curv"></span>
    <div class="gryBot"><?php echo $this->renderElement('newpagination'); ?>
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
