<script type="text/javascript">
	$(document).ready(function() {
		$('#playMnu').removeClass("butBg");
		$('#playMnu').addClass("butBgSelt");
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
            document.getElementById("linkedit").href=baseUrl+"setups/addlocation/"+id; 
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
                if(confirm("You have selected "+count +" items to delete ?"))
                    if(confirm("Are you sure to delete the item ?"))
                    	window.location=baseUrl+"setups/changestatus/"+id+"/0/Location/locationlist/delete";
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
         <div class="titlCont">
		  <div class="centerPage" >
        
			
			<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">	
            <?php echo $form->create("setups", array("action" => "locationlist",'name' => 'locationlist', 'id' => "locationlist")) ?> 
			 <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<?php
e($html->link($html->image('new.png', array('alt' => 'New')) . ' ',array('controller'=>'setups','action'=>'addlocation'),array('escape' => false)));

?>	
<a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>	
<a id="linkedit" onclick="editholder();" href="javascript:void(0)"><?php e($html->image('edit.png')); ?></a>
<?php  echo $this->renderElement('new_slider');  ?>	
			</div>    
           
            <span class="titlTxt"> Locations </span>
            <div class="topTabs" style="height:25px;">
			<?php /*?><ul class="dropdown">
                <li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'setups','action'=>'addlocation'),
						array('escape'=>false)
					)	
				);
				?>
				</li>
                <li class="">
					<a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
					<ul class="sub_menu" style="visibility: hidden;">
							<li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
							<li class="botCurv"></li>
					</ul>
				</li>
				<li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul><?php */?>
        </div>
          
             <div class="clear" ></div> 
	         <?php  $this->loginarea="setups"; $this->subtabsel='locationlist';  
	         	         	echo $this->renderElement('setup_submenus');

	         ?>   
                            
        </div></div>
<div class="midCont" >
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
            <span class="topRht_curv"></span>
            <div class="gryTop">
            <div class="new_filter">   
                <script type='text/javascript'>
                    function setprojectid(projectid){
                        document.getElementById('projectid').value= projectid;
                        document.adminhome.submit();
                    }
                </script>
                <span class="spnFilt">Filter:</span>
                <span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '')); ?>      </span>
                </div>	
                </div>
            <div class="clear"></div></div>
        <?php $i=1; ?>			
        <div class="tblData">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%;'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:20%;'><span class="right"><?php echo $pagination->sortBy('location_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Location Name</th>
                    <th align="center" valign="middle" style='width:20%;'><span class="right"><?php echo $pagination->sortBy('address1', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Address1</th>
					<th align="center" valign="middle" style='width:20%;'><span class="right"><?php echo $pagination->sortBy('address1',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Address2</th>					
                    <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>City</th>
                    <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>State</th>
                    <th align="center" valign="middle" style='width:7%;'><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
                </tr>
                <?php
                 if($locations){
                        $i=1;
                        foreach($locations as $eachrow){					
						    $recid = $eachrow['Location']['id'];
                            $redirectionurl = "locationlist";
                            $modelname ="Location";
                            $location_name = $eachrow['Location']['location_name'];
                            $address1 = $eachrow['Location']['address1'];
                            $address2 = $eachrow['Location']['address2'];
                            $city = $eachrow['Location']['city'];
                            $state = AppController::getstatename($eachrow['Location']['state']);
                 ?>

                        <tr <?php echo ($i%2 == 0)? 'class="altrow"':'';?> >
                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="center" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', $location_name),
									array('controller'=>'setups','action'=>'addlocation', $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>
									
							<?php
									e($html->link(
									$html->tag('span', $address1),
									array('controller'=>'setups','action'=>'addlocation', $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									
							<?php
									e($html->link(
									$html->tag('span', $address2),
									array('controller'=>'setups','action'=>'addlocation', $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
                             
                            <td align="left" valign="middle" class='newtblbrd'>

							<?php
									e($html->link(
									$html->tag('span',  $city),
									array('controller'=>'setups','action'=>'addlocation', $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>

							<?php
									e($html->link(
									$html->tag('span',  $state),
									array('controller'=>'setups','action'=>'addlocation', $recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                            
                            
                            <td align="left" valign="middle" class='newtblbrd'>
                            
                            <?php 
		if($eachrow['Location']['active_status']==1){
			e($html->link(
				$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['Location']['location_name'])),
				array('controller'=>'setups','action'=>'changestatus',$recid,'0',$modelname,$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Deactivate Location ?',
                false
				)
			);
		} else {
			e($html->link(
				$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['Location']['location_name'])),
				array('controller'=>'setups','action'=>'changestatus',$recid,'1',$modelname,$redirectionurl,'cngstatus'),
				array('escape' => false),
				'Are you sure you want to Activate Location ?',
                false
				)
			);
		}			
		?>
			</td>
			</tr>
                            
                        <?php } }else{ ?>
                    <tr><td colspan="7" align="center">No Locations Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <span class="botLft_curv"></span>
            <span class="botRht_curv"></span>
            <div class="gryBot"><?php echo $this->renderElement('newpagination');  ?>
            </div>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->
        <?php echo $form->end();?>
</div>  
 <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null){		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	
</script>