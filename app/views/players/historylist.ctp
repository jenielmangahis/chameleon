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
            document.getElementById("linkedit").href=baseUrl+"players/historylist/<?php echo $option;?>/"+id; 
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
                    	window.location=baseUrl+"players/changestatus/"+id+"/Note/0/historylist/delete/<?php echo $option;?>";
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
            	<h2><?php echo ucfirst($option); ?> List</h2>
            </div>
            
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	 <?php echo $form->create("players", array("action" => "historylist",'name' => 'historylist', 'id' => "historylist")) ?>      
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>				
                </div>
                <?php echo $this->renderElement('new_slider');?>
            </div>
            <!--<span class="titlTxt1" style="padding-top:17px !important">&nbsp;<?php  //echo $current_company_name; echo ($current_company_name !='')? ' : ' :'';  ?></span>&nbsp;
            <span class="titlTxt"> <?php echo ucfirst($option); ?> List</span>-->
            <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">			

			</div>-->
            
        </div>
        
	</div>
        
        
<div class="clearfix nav-submenu-container">
	<div class="midCont">
	  <?php  $this->loginarea="players"; $this->subtabsel='histories';  
	         if($option == 'sale' || $option =='vendor' || $option =='advertiser' || $option =='other' && $_GET['url'] !=  'players/historylist/advertiser/0'){
			 echo $this->renderElement('players/playermerchant_submenus');
	         	//echo $this->renderElement('players/advertiser_submenu');
	       } 
		   elseif($_GET['url'] === 'players/offerlist/company' || $_GET['url'] === 'players/historylist/company'){
		      echo $this->renderElement('players/playermerchant_submenus'); 		   
		   }
		   else{
	         	echo $this->renderElement('players/player_inner_submenu');
	        } ?>  
    </div>
</div>        
        
<div class="midCont" id="cmplisttab">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <!--<span class="topLft_curv"></span>
            <span class="topRht_curv"></span>-->
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
            <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%;'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:10%;'><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>
                    <th align="center" valign="middle" style='width:10%;'><span class="right"><?php echo $pagination->sortBy('type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Type</th>
					<th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('subject',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Name - Subject</th>					
                    <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('author', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Author</th>
                    <th align="center" valign="middle" style='width:47%;'><span class="right"><?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Note</th>
                </tr>
                <?php
                 if($taskdata){
                        $i=1;
                        foreach($taskdata as $eachrow){					
						    $recid = $eachrow['CommunicationTaskHistory']['id'];
                            $redirectionurl = "historylist";
                            $subject = $eachrow['CommunicationTaskHistory']['subject'];
                            $author ='';
                           
                            if($eachrow['CommunicationTaskHistory']['type'] =="notes" || empty($eachrow['CommunicationTaskHistory']['type'])  ){
                            	$type = 'Notes';
                            }else {
                            	$type = 'Send Mail';
                            }
                            
                             $note = $eachrow['CommunicationTaskHistory']['note'];
                            if($note)	$note = AppController::WordLimiter($note,27);
                            
                            $adddate = $eachrow['CommunicationTaskHistory']['date'];
                 ?>

                        <tr <?php echo ($i%2 == 0)? 'class="altrow"':'';?> >
                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="center" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', date('m-d-Y', strtotime($adddate))),
									array('controller'=>'players','action'=>'historylist', $option, $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>
									
							<?php
									e($html->link(
									$html->tag('span', $type),
									array('controller'=>'players','action'=>'historylist', $option, $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									
							<?php
									e($html->link(
									$html->tag('span', $subject),
									array('controller'=>'players','action'=>'historylist', $option, $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
                             
                            <td align="left" valign="middle" class='newtblbrd'>

							<?php
									e($html->link(
									$html->tag('span',  $author),
									array('controller'=>'players','action'=>'historylist', $option, $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>

							<?php
									e($html->link(
									$html->tag('span',  $note),
									array('controller'=>'players','action'=>'historylist', $option, $recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                            </tr>
                        <?php } }else{ ?>
                    <tr><td colspan="7" align="center">No Histories Found.</td></tr>
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
        <?php echo $form->end();?>
</div>  
 <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null){		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	
</script>