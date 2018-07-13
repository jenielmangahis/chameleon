
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
            document.getElementById("linkedit").href=baseUrl+"players/addnote/<?php echo $option;?>/"+id; 
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
					
                    	window.location=baseUrl+"players/changestatus/"+id+"/Note/0/notelist/delete/<?php echo $option;?>";
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
            	<h2>Note List</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("players", array("action" => "notelist",'name' => 'notelist', 'id' => "notelist")) ?>			
					<?php
                    e($html->link($html->image('new.png') . ' ' . __(''), "addnote",array('escape' => false)));?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');">
                    <?php e($html->image('action.png')) ?></a>
                    <a href="javascript:void(0)" onclick="editholder();" id="linkedit">
                    <?php e($html->image('edit.png')) ?></a>                    
                </div>
                <?php echo $this->renderElement('new_slider'); ?>
            </div>
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
           <span class="titlTxt1"><?php  //echo $current_company_name; echo ($current_company_name !='')? ' : ' :'';  ?></span>&nbsp;
            <!--<span class="titlTxt"> <?php //echo ucfirst($option); ?> Note List</span>-->
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                    <li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'players','action'=>'addnote',$option),
								array('escape' => false)
								)
							);
						?>
					</li>
                    <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                        <ul class="sub_menu">
                            <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                            <li class="botCurv"></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="editholder();" id="linkedit"><span>Edit</span></a></li>
                    
                </ul><?php */?>
         	</div>
            
         </div>
         

           
			<!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
						
            </div>-->


	           

      </div>
        
<div class="clearfix nav-submenu-container">
	<div class="midCont">
		 <?php    $this->loginarea="players";    $this->subtabsel='notes'; 
					if($option == 'sale' || $option =='vendor' || $option =='advertiser' || $option =='other')
					echo $this->renderElement('players/playermerchant_submenus');  
	         			//echo $this->renderElement('players/advertiser_submenu'); 
					else if($_GET['url'] === 'players/notelist/2'){
             echo $this->renderElement('memberlistsecondlevel_submenus');
				}
				else		//echo $this->renderElement('players/player_inner_submenu');
						echo $this->renderElement('players/playermerchant_submenus');  
						  
			?> 
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
                    <th align="center" valign="middle" style='width:1%'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:10%;'><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>
					<th align="center" valign="middle" style='width:20%'><span class="right"><?php echo $pagination->sortBy('subject',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Subject</th>					
                    <th align="center" valign="middle" style='width:20%'><span class="right"><?php echo $pagination->sortBy('author', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Author</th>
                    <th align="center" valign="middle" style='width:47%'><span class="right"><?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Note</th>
                </tr>
				<?php //print_r($notedata); ?>
                <?php if($notedata){ 
                        $i=1;
                        foreach($notedata as $eachrow){
						    $recid = $eachrow['Note']['id'];
                            $modelname = "Note";
                            $redirectionurl = "notelist";
                            $subject = $eachrow['Note']['subject'];
                            $author = $eachrow['Note']['author'];
                            $note = $eachrow['Note']['note'];
                            if($note)	$note = AppController::WordLimiter($note,27);
                            $adddate = $eachrow['Note']['created'];
                 ?>

                        <tr <?php echo ($i%2 == 0)? 'class="altrow"':'';?> >
                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="center" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', date('m-d-Y', strtotime($adddate))),
									array('controller'=>'players','action'=>'addnote', $option, $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									
									e($html->link(
									$html->tag('span', $subject),
									array('controller'=>'players','action'=>'addnote', $option, $recid),
									array('escape' => false)
									)
								);
							?>
							</td>
                             
                            <td align="left" valign="middle" class='newtblbrd'>

									<?php
									e($html->link(
									$html->tag('span',  $author),
									array('controller'=>'players','action'=>'addnote', $option, $recid),
									array('escape' => false)
									)
								);
								?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>

									<?php
									e($html->link(
									$html->tag('span',  $note),
									array('controller'=>'players','action'=>'addnote', $option, $recid),
									array('escape' => false)
									)
								);
								?>
								</td>
                            </tr>
                        <?php } }else{ ?>
                    <tr><td colspan="6" align="center">No Notes Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <!--<span class="botLft_curv"></span>
            <span class="botRht_curv"></span>-->
            <div class="gryBot"><?php //if($notedata) { 
			echo $this->renderElement('newpagination'); //} ?>
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