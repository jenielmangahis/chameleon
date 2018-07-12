<script type="text/javascript">
    $(document).ready(function()    {
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
            document.getElementById("linkedit").href=baseUrl+"contacts/addcontacts/"+id; 

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

            if(op=="del"){
                if(confirm("You have selected "+count+" items to delete ?"))

                    if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrl+"contacts/changestatus/"+id+"/Contact/0/contactlist/delete";
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
    <div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("contacts", array("action" => "contactlist",'name' => 'contactlist', 'id' => "contactlist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>

            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
            <span class="titlTxt">   Contacts  </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'contacts','action'=>'addcontacts'),
								array('escape' => false)
								)
							);
						?>
					</li>
                    <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                        <ul class="sub_menu">
                            <!--li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                            <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li-->
                            <!--li><a href="javascript:void(0)">Copy</a></li-->
                            <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                            <li class="botCurv"></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                </ul>
            </div>
                  <?php    $this->loginarea="contacts";    $this->subtabsel="contactlist";
                            echo $this->renderElement('contact_submenus');  ?>   
        </div></div>
    
    <div class="midCont" id="newcntlist">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
         <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
            <div class="gryTop">

                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                    ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'contacts/contactlist')" id="locaa"></span>
            </div>	<span class="topRht_curv"></span>
            <div class="clear"></div></div>
         <?php $i=1; ?>			
        <div class="tblData">


            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
                <tr class="trBg">
                    <th align="center" valign="middle" style="width:1%">#</th>
                    <th align="center" valign="middle" style="width:2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('firstname', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>First Name</th>
                    <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('lastname',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Last Name</th>
                    <th align="center" valign="middle" style="width:17%"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Name</th>
                    <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('contact_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Contact Type</th>
                    <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('email', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Email</th>
                    <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('mobile', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Mobile</th>
                   </tr>
                <?php if($contactdata){
                        //echo "<pre>"; 
                        //print_r($contactdata);
                        $i=1;
                        foreach($contactdata as $eachrow){
                            $recid = $eachrow['Contact']['id'];
                            $modelname = "Contact";
                            $redirectionurl = "contactlist";
                            $fname = $eachrow['Contact']['firstname'];
                            if($fname)	$fname = AppController::WordLimiter($fname,12);
                            $lname = $eachrow['Contact']['lastname'];
                            if($lname)	$lname = AppController::WordLimiter($lname,10);

                            $companyname = $eachrow['Company']['company_name'];
                            if($companyname) $companyname = AppController::WordLimiter($companyname,15);
                            $contacttype = $eachrow['ContactType']['contact_type_name'];

                            $email = $eachrow['Contact']['email'];
                            if($email)	$email = AppController::WordLimiter($email,35);
                            $mobile = $eachrow['Contact']['mobile'];

                        ?>

                        <?php if($i%2 == 0) { ?>

                            <tr class='altrow'>	
                                <td align="left" class='newtblbrd'><span><?php echo $i++;?></span></td>
                                <td align="left" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>

                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',$fname ),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
								<?php
									e($html->link(
									$html->tag('span',$lname ),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',$companyname ),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>

								</td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', ($contacttype)?$contacttype:'N/A'),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle" class='newtblbrd'>
								
							<?php
									e($html->link(
									$html->tag('span', ($email)?$email:'N/A'),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								
								</td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', ($mobile)?$mobile:'N/A'),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>

								</td>                               
                            </tr>

                            <?php } else { ?>

                            <tr>	
                                <td align="left"><span><?php echo $i++;?></span></td>
                                <td align="left"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>

                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span',$fname ),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle">
									
								<?php
									e($html->link(
									$html->tag('span',$lname ),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle">
								<?php
									e($html->link(
									$html->tag('span',$companyname ),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle">
									<?php
									e($html->link(
									$html->tag('span', ($contacttype)?$contacttype:'N/A'),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span', ($email)?$email:'N/A'),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span', ($mobile)?$mobile:'N/A'),
									array('controller'=>'contacts','action'=>'addcontacts',$recid),
									array('escape' => false)
									)
								);
							?>

								</td>                               
                            </tr>
                            <?php } ?>	
                        <?php } }else{ ?>
                    <tr><td colspan="7" align="center">No Contacts Found.</td></tr>
                    <?php } ?>
            </table>


        </div>
        <div>
            <span class="botLft_curv"></span>
            <div class="gryBot"><?php if($contactdata) { echo $this->renderElement('newpagination'); } ?>
            </div><span class="botRht_curv"></span>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->

        <?php echo $form->end();?>

    </div>

    <div class="clear"></div>
</div>     
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {		
        document.getElementById("newcntlist").className = "newmidCont";
    }	
</script>