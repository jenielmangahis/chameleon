<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backMemberList = $base_url_admin.'memberlist';
$backDownloadholder = $base_url_admin.'downloadholder';
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
        // var id="";
        var edit_link;
        $('.checkid').each(function(){		
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {			
                // id=$(this).val();
                edit_link = $(this).next('.edit_link').val();
                counter=counter +1;
            }
        });	

        if(counter!=1)
            {
            alert("please select only one row  to edit");
            return false;
        }else{	
            // document.getElementById("linkedit").href=baseUrlAdmin+"editholder/"+id; 
            document.getElementById("linkedit").href=baseUrlAdmin + edit_link;
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
<div class="container clearfix">
       <div class="titlCont">
	   	<div class="slider-centerpage clearfix">            
            <div class="center-Page col-sm-6">
            	<h2> License list for <?= $holder['Holder']['firstname']; ?>  </h2>
            </div>
            <div class="slider-dashboard col-sm-6"> <!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">-->                
                    <div class="icon-container">
						<?php
                                    e($html->link($html->image('new.png') . ' ','addlicense/' . $holder_id,array('escape' => false)));
                                    ?>
                                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');">
                                    <?php e($html->image('action.png')) ?>
                                    </a>
                                    <a href="javascript:void(0)" onclick="editholder();" id="linkedit">
                                    <?php e($html->image('edit.png')) ?>
                                    </a>			                                 
                        <?php
                        //e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));
                        echo $this->renderElement('new_slider');
                        ?>
                       	
                    </div>
                    
            </div>
            <?php echo $form->create("Admin", array("action" => "memberlist",'name' => 'memberlist', 'id' => "memberlist")) ?>
            <!--<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span>-->            
            
            <div class="topTabs" style="height:25px;">
			
               <?php /*?> <ul class="dropdown">
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
                       <!-- <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                        li><a href="javascript:void(0)">Copy</a></li-->
                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                </ul><?php */?>
            </div>						           

        </div>
        
       </div>
        
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont">
		<?php  
            $this->loginarea="admins";    $this->subtabsel="memberlist";
            if(isset($this->params['pass'][0])&&$this->params['pass'][0]=="secondlevel")
            {
                echo $this->renderElement('memberlistsecondlevel_submenus');  
            }  
            else
            {    
                echo $this->renderElement('memberlist_submenus');  
            }
        
        ?>
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
        </div>
        <div class="clear"></div></div>
        <div class="tblData table-responsive">
            <table class="table table-striped table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg">
                    <th align="center" valign="middle" style="width:1%">#</th>
                    <th align="center" valign="middle" style="width:2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle">License Number</th>
                    <th align="center" valign="middle">Status</th>
                </tr>
                <?php $i = 1; foreach($contactLicenses as $cl){ ?>
                <?php 
                    if($i%2 == 0 ){
                       $cls="altrow";        
                    }else{
                        $cls=""; 
                    }
                ?>
                <tr class='<?php echo $cls; ?>'>    
                    <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                    <td align="center" class='newtblbrd'>
                        <a><span>
                            <input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" />
                            <input type="hidden" class="edit_link" value="<?php echo $editmemnerpage ?>">
                        </span></a>
                    </td>
                    <td align="left" class='newtblbrd'><?= $cl['ContactLicense']['license_number']; ?></td>
                    <td align="left" class='newtblbrd'><?= $cl['ContactLicense']['status']; ?></td>
                </tr>
                <?php $i++; } ?>
            </table>
        </div>
    <div>
    <div class="gryBot">
        <?php  echo $this->renderElement('newpagination');  ?>
    </div>
    <div class="clear"></div>
</div>
<!--inner-container ends here-->
</div>    
