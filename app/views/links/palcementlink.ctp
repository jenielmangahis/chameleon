<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
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

function editcontent()
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
                document.getElementById("linkedit").href=baseUrl+"links/edit_placement/"+id; 
                
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
                                        window.location="../links/palcementlink_delete/"+id ;
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
                <h2>Placement List</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Links", array("action" => "addresslink",'name' => 'addresslink', 'id' => "addresslink")) ?>
					<script type='text/javascript'>
                            function setprojectid(projectid){
                                            document.getElementById('projectid').value= projectid;
                                            document.adminhome.submit();
                                    }
                    </script>
                    <?php
                    e($html->link($html->image('new.png', array('alt' => 'New')) . ' ',array('controller'=>'links','action'=>'add_placement'),array('escape' => false)));
                    ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');">
                    <?php e($html->image('action.png')); ?></a>
                    <a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><?php e($html->image('edit.png')); ?></a>        
                    <?php  echo $this->renderElement('new_slider');  ?>            			
                </div>
                
            </div>
            <!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			
            </div>
            <span class="titlTxt"> Placement List </span>-->
            <div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
<li>
<?php
	e($html->link(
		$html->tag('span', 'New'),
		array('controller'=>'links','action'=>'add_placement'),
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
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul><?php */?>
</div>
        </div>
    
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="links";    $this->subtabsel="palcementlink";
             echo $this->renderElement('links_submenus');  ?>   
    </div>
</div> 


<div class="midCont" id="newcmmtasktab">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>

                            <!-- top curv image starts -->
                            <div>
                            <!--<span class="topLft_curv"></span>
                            <span class="topRht_curv"></span>-->
                
                <div class="gryTop">
               	<div class="new_filter" >
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>''));
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'links/palcementlink')" id="locaa"></span>
                
                        </div> </div>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData table-responsive">
        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
		      
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('place_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Placement Name</th>  
		    
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('enddate', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>End Date</th>
		
		      
        <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>   
		
        </tr>
        <?php
                if($taskdata){
				
                        foreach($taskdata as $eachrow){
                        $recid = $eachrow['Placement']['id'];
                        $modelname = "Placement";
                        $redirectionurl = "commtasklist";
                        $company_task_id = $eachrow['Placement']['id'];
                        $placementtype = $eachrow['Placement']['place_name'];
						$enddate = $eachrow['Placement']['enddate'];
				?>
				
	<?php if($i%2 == 0) { ?>

        <tr class='altrow'>    
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
				
                <td align="left" valign="middle" class='newtblbrd'>
				<?php e($html->link($html->tag('span', $placementtype),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); ?>
				
				</td>
				              
                <td align="left" valign="middle" class='newtblbrd'>
					<?php e($html->link($html->tag('span', $enddate),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); ?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
				<?php if($eachrow['Placement']['status'] === 'a'){  e($html->link($html->tag('span', 'Active'),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); } else{  e($html->link($html->tag('span', 'In-Active'),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); }?>
				</td>              
                            

					

				</td>  
        
                </tr>
	<?php } else { ?>

	<tr>    
                <td align="center"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle">

				<?php e($html->link($html->tag('span', $placementtype),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); ?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
			<?php e($html->link($html->tag('span', $enddate),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); ?>
				</td>              
                <td align="left" valign="middle" class='newtblbrd'>
					
<?php if($eachrow['Placement']['status'] === 'a'){  e($html->link($html->tag('span', 'Active'),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); } else{  e($html->link($html->tag('span', 'In-Active'),array('controller'=>'links','action'=>'edit_placement',$recid),array('escape' => false))); }?>
					
				</td>              
             
				
		
                </tr>


	

	<?php } ?>	

        <?php } } else{ ?>
        <tr><td colspan="9" align="center">No Link Found.</td></tr>
        <?php } ?>
        </table>
        
    

  </div>

      <div>
      <!--<span class="botLft_curv"></span>
      <span class="botRht_curv"></span>-->
      <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
      </div>
      
      <div class="clear"></div>
      </div>
      <?php echo $form->end();?>




<div class="clear"></div>
    </div>
    
         <div class="clear"></div>
</div>      
    
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newcmmtasktab").className = "newmidCont";
	}	
</script>