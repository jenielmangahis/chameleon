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
    function editMemberType()
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
            document.getElementById("linkedit").href=baseUrlAdmin+"addmembertype/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/MemberType/1/membertypes/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/MemberType/0/membertypes/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/MemberType/0/membertypes/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>  
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container clearfix">
       <div class="titlCont">
       
       <div class="slider-centerpage clearfix">
       		<div class="center-Page col-sm-6">
            	<h2>Company Types List</h2>
            </div>            
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container"> <!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">-->
                	<?php echo $form->create("Admins", array("action" => "membertypes",'name' => 'membertypes', 'id' => "membertypes")) ?>
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
                    
                    <?php
                    e($html->link($html->image('new.png') . ' ' . __(''), $base_url_admin."addmembertype",array('escape' => false)));
                    ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
                     <a href="javascript:void(0)" onclick="editMemberType();" id="linkedit">
                     <?php e($html->image('edit.png')); ?></a>    
                     <?php echo $this->renderElement('new_slider'); ?>            
                </div>
            </div>
       </div>
       

          <!--  <span class="titlTxt1"><?php //echo $current_project_name;  ?>:&nbsp;</span>-->
            <!--<span class="titlTxt">   Company Types List  </span>-->
            
            <div class="topTabs" style="height:25px;">
			<?php /*?><li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'admins','action'=>'addmembertype'),
						array('escape'=>false)
					)	
				);
				?>
				</li>
                <ul class="dropdown">
                    <!--    <li><a href="/admins/addmembertype"><span>New</span></a></li>  -->
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <!--<li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                        li><a href="javascript:void(0)">Copy</a></li-->
                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="editMemberType();" id="linkedit"><span>Edit</span></a></li>
                </ul><?php */?>
            </div>

       

        
		</div>
        


<div class="clearfix nav-submenu-container">
	<div class="midCont">
		 <?php    $this->loginarea="admins";    $this->subtabsel="membertypes";
                    echo $this->renderElement('memberlist_submenus');  ?>   
    </div>
</div>

<div class="midCont" id="newhldtab">

    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <!--<span class="topLft_curv"></span>
		<span class="topRht_curv"></span>-->
        <div class="gryTop">
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
		<div class="new_filter">
        <span class="spnFilt">Filter:</span>
        <span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
      ?> 
              
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'membertypes')" id="locaa">&nbsp;&nbsp;  
           </span>
</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData table-responsive">
        <table class="table table-striped table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
                

          <tr class="trBg">
        <th align="center" valign="middle" style="width:1%">#</th>
        <th align="center" valign="middle" style="width:3%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
            <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('member_type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
			 ?></span>Member Type</th>
       
			        <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('pincolor', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
			 ?></span>Google Pin Color</th>
            <th align="center" valign="middle" style="width:40%"><span class="right"><?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
			 ?></span>Note</th>
            <th align="center" valign="middle" style="width:8%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
			 ?></span>Status</th>

      </tr>
       <?php if($membertypelist){ $i=1;         
               foreach($membertypelist as $eachrow){
               $recid = $eachrow['MemberType']['id'];
               $modelname = "MemberType";
               $redirectionurl = "projectmembertypes";
               $member_type=   $eachrow['MemberType']['member_type']; 
               //$is_coinholder =$eachrow['MemberType']['is_coinholder']; 
			   $pincolor =$eachrow['MemberType']['pincolor'];  
               
                $note =$eachrow['MemberType']['note'];
                if($note) $note = AppController::WordLimiter($note,75);
                
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
						$html->tag('span', ($member_type)?$member_type:'N/A'),
						array('controller'=>'admins','action'=>'addmembertype',$recid),
						array('escape' => false)
						)
					);
				?>
			</td>
         
			
			<td align="left" class='newtblbrd' valign="middle">
				<?php
					e($html->link(
						$html->tag('span', ($pincolor)? '#'.$pincolor:'N/A'),
						array('controller'=>'admins','action'=>'addmembertype',$recid),
						array('escape' => false)
						)
					);
				?>

			</td>
             <td align="left" class='newtblbrd' valign="middle">
				<?php
					e($html->link(
						$html->tag('span', ($note)?$note:'N/A'),
						array('controller'=>'admins','action'=>'addmembertype',$recid),
						array('escape' => false)
						)
					);
				?>

			</td>
             <td align="center" valign="middle" class='newtblbrd'>
				<?php if($eachrow['MemberType']['active_status']=='1'){ 
				e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['MemberType']['member_type'])),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}
							else{
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['MemberType']['member_type'])),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
									)
								);
							}							
						?>
					</td>
               </tr>    
	<?php  } }else{ ?>
    <tr><td colspan="6" align="center">No Member Types Found.</td></tr>
    <?php } ?>
    </table>



    </div>
    <div>
    <!--<span class="botLft_curv"></span>
    <span class="botRht_curv"></span>-->
    <div class="gryBot"><?php echo $this->renderElement('newpagination');  ?>
    </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->




      </div>

      
</div>        
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {		
        document.getElementById("newhldtab").className = "newmidCont";
    }	
</script>
