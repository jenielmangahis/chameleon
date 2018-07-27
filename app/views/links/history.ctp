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
                document.getElementById("linkedit").href=baseUrl+"links/edit_address/"+id; 
                
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
                                        window.location="../links/history_delete/"+id ;
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
                <h2>History List</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Links", array("action" => "history",'name' => 'history', 'id' => "history")) ?>
						<script type='text/javascript'>
                                function setprojectid(projectid){
                                                document.getElementById('projectid').value= projectid;
                                                document.adminhome.submit();
                                        }
                        </script>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');"><?php e($html->image('action.png')); ?></a>			
                </div>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">
            </div>
            <span class="titlTxt"> History List </span>-->
            <div class="topTabs" style="height:25px;">
			<?php /*?><ul class="dropdown">
            <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
            <ul class="sub_menu">
                                             <!--li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                             <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li-->
                                             <!--li><a href="javascript:void(0)">Copy</a></li-->
                                             <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                                 <li class="botCurv"></li>
                                    </ul>
            </li>
            </ul><?php */?>
            </div>
        </div>
    
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="links";    $this->subtabsel="history";
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
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'links/history')" id="locaa"></span>
                
                        </div> </div>
                        <div class="clear"></div></div>

                        <?php $i=1; ?>  
                        <div class="tblData">
        <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
        <th align="center" style="width:2%;">#</th>
        <th align="center" style="width:3%;"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
		      
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Click Date</th>  
		    
		    <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('links_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Placement Link</th> 

			
			
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('links_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Link Name</th>
		
        <th align="center" valign="middle" style="width:13%;"><span class="right"><?php echo $pagination->sortBy('links_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Redirect</th>

      
		      
        <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('url', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Clicked Url</th>   
		
		    <th align="center" valign="middle" style="width:15%;"><span class="right"><?php echo $pagination->sortBy('ip', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>IP Address</th>
		
		

        </tr>
        <?php
                if($taskdata){
                        foreach($taskdata as $eachrow){
                        $recid = $eachrow['History']['id'];
                        $modelname = "LinkAddress";
                        $redirectionurl = "commtasklist";
                        $company_task_id = $eachrow['History']['id'];
                        $ip = $eachrow['History']['ip'];
						            $link_name = $eachrow['History']['links_name'];
                        $linkDetail = $common->getLinkInfoBySortCodeName($link_name);
                        $LinkAddressId = $linkDetail['Link']['link_address'];


                        $redirect = $linkDetail['Link']['redirect_link'];
                        if($redirect=='')
                        {
                          $redirect = $common->getLinkAddressName($LinkAddressId);
                        }  
                        $pol    =$common->getLinkPlacement($linkDetail['Link']['link_placement']);
						            $url = $eachrow['History']['url'];
                        $created = date('d-m-Y h:i A', strtotime($eachrow['History']['created']));
                ?>
				
	<?php if($i%2 == 0) { ?>

        <tr class='altrow'>    
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
				
                <td align="left" valign="middle" class='newtblbrd'>
				<?php echo $created; ?>
				</td>
				         
</td>   
          <td align="left" valign="middle" class='newtblbrd'>
          <?php echo $pol; ?>
        </td>  

		
                <td align="left" valign="middle" class='newtblbrd'>
					<?php echo $link_name; ?>
				</td>   
          <td align="left" valign="middle" class='newtblbrd'>
          <?php echo $redirect; ?>
                    
              
        <td align="left" valign="middle" class='newtblbrd'>
         <?php echo $url; ?>       
					
					
				</td> 
        <td align="left" valign="middle" class='newtblbrd'>
         <?php echo $ip; ?>       
          
          
        </td>  
        
                </tr>
	<?php } else { ?>

	<tr>    
                <td align="center"><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
                <td align="left" valign="middle">

					<?php echo $created; ?>
				
				</td>     
</td>   
          <td align="left" valign="middle" class='newtblbrd'>
          <?php echo $pol; ?>
        </td> 
		
                <td align="left" valign="middle" class='newtblbrd'>
					
			         <?php echo $link_name; ?>
				</td>              
            
			      <td align="left" valign="middle" class='newtblbrd'>
          <?php echo $redirect; ?>
           

			   <td align="left" valign="middle" align="middle" class='newtblbrd'>
				
                  <?php echo $url; ?> 
					</td>         
               
             <td align="left" valign="middle" align="middle" class='newtblbrd'>
        
                  <?php echo $ip; ?> 
          </td>      
        
                </tr>


	

	<?php } ?>	

        <?php } } else{ ?>
        <tr><td colspan="9" align="center">No history Found.</td></tr>
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