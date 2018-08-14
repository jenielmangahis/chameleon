
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
            document.getElementById("linkedit").href=baseUrl+"players/adddetail/<?php echo $option;?>/"+id; 
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
                    	window.location=baseUrl+"players/changestatus/"+id+"/Company/0/playerslist/delete/<?php echo $option;?>";
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
            	<h2><?php echo ucfirst($option);?> List</h2>
            </div>
            
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("players", array("action" => "playerslist",'name' => 'playerslist', 'id' => "playerslist")) ?>      
					<script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
                    <?php
                    e($html->link($html->image('new.png', array("alt" => "New")) . ' ',array('controller'=>'players','action'=>'adddetail',$option),array('escape' => false)));
                    ?>
                    <a href="javascript:void(0)" onclick="return activatecontents('asd','del');">
                    <?php e($html->image('action.png', array("alt" => "Delete"))); ?>
                    </a>
                    <a href="javascript:void(0)" onclick="editholder();" id="linkedit">
                    <?php e($html->image('edit.png', array("alt" => "Edit"))); ?></a>   
                    <?php echo $this->renderElement('new_slider'); ?>	                   
                </div>
                
            </div>
            
            <?php if($usertype==trim("admin")){?> <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span><?php } ?>
            <!--<span class="titlTxt"><?php echo ucfirst($option);?> List</span>-->
            
            <div class="topTabs" style="height:25px;">
                <?php /*?><ul class="dropdown">
                    <li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'players','action'=>'adddetail',$option),
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
					<?php if($_GET['url'] === 'players/playerslist/nonprofit' || $_GET['url'] === 'players/playerslist/merchant'){ ?>
						<li>
						<?php
						e($html->link(
									$html->tag('span', 'Back'),
									array('controller'=>'players','action'=>'playerslist','company'),
									array('escape' => false)
									)
						);
						?>
					  </li>	
					  <?php
					  }
					  ?>
					  
                 
                </ul><?php */?>
            </div>
            
            <!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">			
            		
            </div>-->
        </div>
    		  
        
     </div>
     
     
<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php    
                    $this->loginarea="players";    $this->subtabsel=$option.'list';
                    if(isset($this->params['pass'][0])&&($this->params['pass'][0]=="merchant"||$this->params['pass'][0]=="nonprofit" || $this->params['pass'][0]=="vendor" || $this->params['pass'][0]=="sale"))
                    {
                        echo $this->renderElement('players/playermerchant_submenus');  
                    }   
                    else if(isset($this->params['pass'][0])&&($this->params['pass'][0]=="types"))
                    {
                        echo $this->renderElement('players/playertypes_submenus');  
                    } 
                    else if(isset($this->params['pass'][0])&&($this->params['pass'][0]=="tasklist"))
                    {
                        echo $this->renderElement('players/playertasklist_submenus');  
                    } 
					else if($_GET['url'] === 'players/playerslist/advertiser/0' || $_GET['url'] === 'players/playerslist/other'){
					
					//echo $this->renderElement('players/advertiser_submenu'); 
					echo $this->renderElement('players/playermerchant_submenus'); 					
					}
                    else if($_GET['url'] === 'players/playerslist/company')
                    {
                        echo $this->renderElement('players/player_submenus');  
                    } 
            ?>    
    </div>
</div>     

<?php switch($companytypecategoryid){
				case 7:
						echo $this->renderElement('players/companylist');
						break;
				case 2:
						echo $this->renderElement('players/merchantlist');
					 	break;
				case 4:
						echo $this->renderElement('players/nonprofitlist');
					 	break;
				case 1:
						echo $this->renderElement('players/vendorlist');
					 	break;
				case 3:
						echo $this->renderElement('players/salelist');
						break;					 		
				case 5:
						echo $this->renderElement('players/advertiserlist');
			 			break;
				case 6:
						echo $this->renderElement('players/otherlist');
			 			break;				 		
}?>
 <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null){		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	
</script>