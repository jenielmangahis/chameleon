<?php
$base_url = Configure::read('App.base_url');
?>
<script type="text/javascript">
$(document).ready(function() {
$('#ConFigs').removeClass("butBg");
$('#ConFigs').addClass("butBgSelt");
}); 
</script>
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
            document.getElementById("linkedit").href=baseUrl+"setups/editcoinset/"+id; 
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
                    window.location=baseUrl+"setups/changestatus/"+id+"/1/Coinset/coinsetlist/cngstatus";
                }else{
                    window.location=baseUrl+"setups/changestatus/"+id+"/2/Coinset/coinsetlist/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"setups/changestatus/"+id+"/2/Coinset/coinsetlist/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container clearfix">
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
				<?php  //$prname =$this->data['Project']['project_name'];   ?>
                <h2>Coinset List</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Setup", array("action" => "coinsetlist",'name' => 'coinsetlist', 'id' => "coinsetlist")) ?>  
					<script type='text/javascript'>
                            function setprojectid(projectid){
                                document.getElementById('projectid').value= projectid;
                                document.adminhome.submit();
                            }
                    </script>	
                    <?php e($html->link($html->image('new.png', array('alt' => 'New')) . ' ',array('controller'=>'setups','action'=>'addcoinset'),array('escape' => false))); ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editholder();" id="linkedit"><?php e($html->image('edit.png')); ?></a>
                    <?php  echo $this->renderElement('new_slider');  ?>
                </div>
                
            </div>
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                        <li>
							
							<?php
								e($html->link(
									$html->tag('span', 'New'),
									array('controller'=>'setups','action'=>'addcoinset'),
									array('escape' => false)
									)
								);
							?>
						</li>
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                    <li class="botCurv_new"></li>
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
        </div>
       
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="setups";    $this->subtabsel="coinsetlist";
            echo $this->renderElement('setup_submenus');  ?> 
    </div>
</div>

<div class="midCont" id="newcoinsettab">


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
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
            <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));     ?> 
            </span>
            <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo  $base_url ?>setups/coinsetlist')" id="locaa"></span>

        </div>	
			</div>
        <div class="clear"></div>
        </div>

    <?php $i=1; ?>			

    <div class="tblData table-responsive">


        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 

            <tr class="trBg">
                <th align="center" style='width:1%' valign="middle">#</th>
                <th align="center" style='width:2%;' valign="middle"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('coinset_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Coinset Name</th>
                <th align="center" valign="middle" style='width:17%;'><span class="right" style='width:10px;'><?php echo $pagination->sortBy('verifycode', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Verification Code</th>
                <th align="center" valign="middle" style="width: 7%;"><span class="right" ><?php echo $pagination->sortBy('serialprefix', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Prefix</th>
                <th align="center" valign="middle" style='width:11%;'><span class="right"><?php echo $pagination->sortBy('numunits', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span># of Units</th>
                <th align="center" valign="middle" style='width:13%;'>
					<span class="right">
						<?php echo $pagination->sortBy('startserialnum',	$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
						?>
					</span>
						Start Serial #
				</th>
                <th align="center" valign="middle" style='width:13%;'><span class="right"><?php echo $pagination->sortBy('endserialnum', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				?></span>End Serial #</th>
                <th align="center" valign="middle" style="width: 13%;" >
					<span class="right">
						<?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
						?>
				</span>Date & Time</th>
                <th align="center" style='width:10%;' valign="middle"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');
				 ?></span>Status</th>
                <!--  <th align="left" valign="middle">Edit</th>
                <th align="left" valign="middle">Delete</th>-->
            </tr>
            <?php 

                if($coinsetdetail){
                    $i=1;
                    foreach($coinsetdetail as $eachrow){
                        $recid = $eachrow['Coinset']['id'];
                        $modelname = "Coinset";
						$othermodelname ="";
                        $redirectionurl = "coinsetlist";

                        $verifycode = $eachrow['Coinset']['verifycode'];

                        $coinsetname = $eachrow['Coinset']['coinset_name'];
                        if(preg_match('/[A-Z]{3}/', $coinsetname)==1){
                            $coinsname= preg_split('/[A-Z]{3}/', $coinsetname);
                            $coinsetname=$coinsname[1];
                        }

                        $numunits = $eachrow['Coinset']['numunits'];
                        $startser = $eachrow['Coinset']['startserialnum'];
                        $endser = $eachrow['Coinset']['endserialnum'];

                        $datesubmitchipco = $eachrow['Coinset']['datesubmitchipco'];
                        $dateestship = $eachrow['Coinset']['dateestship'];
                        $dateestdelivery = $eachrow['Coinset']['dateestdelivery'];
                        $serialprefix = $eachrow['Coinset']['serialprefix'];	
                        $cretd = $eachrow['Coinset']['created'];
                        $cretd = AppController::usdateformat($cretd,1);


                    ?>

                    <?php 
					$rClass = "";	
					if($i%2 == 0) 
					$rClass = "altrow";	
					?>

                        <tr class='<?php echo $rClass; ?>'>	
                            <td align="left"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                            <td align="left"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                            <td align="left" valign="middle">
							<?php
								e($html->link(
									$html->tag('span', ($coinsetname)?$coinsetname:'N/A'),
									array('controller'=>'setups','action'=>'editcoinset',$recid),
									array('escape' => false)
									)
								);
							?>

							</td>
                            <td align="left" valign="middle">
							<?php
								e($html->link(
									$html->tag('span', ($verifycode)?$verifycode:'N/A'),
									array('controller'=>'setups','action'=>'editcoinset',$recid),
									array('escape' => false)
									)
								);
							?>

							</td>
                            <td align="left" valign="middle">
							<?php
								e($html->link(
									$html->tag('span', ($serialprefix)?$serialprefix:'N/A'),
									array('controller'=>'setups','action'=>'editcoinset',$recid),
									array('escape' => false)
									)
								);
							?>

							</td>
                            <td align="left" valign="middle">
								
								<?php
								e($html->link(
									$html->tag('span', ($numunits)?$numunits:'N/A'),
									array('controller'=>'setups','action'=>'editcoinset',$recid),
									array('escape' => false)
									)
								);
							?>

							</td>
                            <td align="left" valign="middle">
							<?php
								e($html->link(
									$html->tag('span', ($startser)?$startser:'N/A'),
									array('controller'=>'setups','action'=>'editcoinset',$recid),
									array('escape' => false)
									)
								);
							?>

							</td>
                            <td align="left" valign="middle">
								
								<?php
								e($html->link(
									$html->tag('span', ($endser)?$endser:'N/A'),
									array('controller'=>'setups','action'=>'editcoinset',$recid),
									array('escape' => false)
									)
								);
							?>

							</td>
                            <td align="left" valign="middle">
								<!--<span style='color:#4d4d4d'><?php echo $cretd?$cretd:"N/A"; ?></span>-->
								<?php
									e(($cretd)?$cretd:'');
								?>
							</td>

						
						
						<td align="center" valign="middle" class='newtblbrd'>
							<?php 

							if($eachrow['Coinset']['active_status']==1){ 
								e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$coinsetname)),
									array('controller'=>'setups','action'=>'changestatus',$recid,'2',$modelname,$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}
							else{						
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$coinsetname)),
									array('controller'=>'setups','action'=>'changestatus',$recid,'1',$modelname,$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							
								
							}
							?></td>

                          

                        </tr>




                    <?php } }else{ ?>
                <tr><td colspan="9" align="center">No Coinsets Found.</td></tr>
                <?php  } ?>
        </table>    


    </div>
    <div>
        <!--<span class="botLft_curv"></span><span class="botRht_curv"></span>-->
        <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?></div>
        
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
        document.getElementById("newcoinsettab").className = "midCont";
    }	
</script>
