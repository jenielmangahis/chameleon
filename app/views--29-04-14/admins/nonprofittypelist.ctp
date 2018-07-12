<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script>  
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
            document.getElementById("linkedit").href=baseUrl+"admins/addnonprofittypes/"+id; 
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
                    window.location=baseUrl+"admins/changestatus/"+id+"/Nonprofittype/0/nonprofittypelist/delete";
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
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("admins", array("action" => "nonprofittypelist",'name' => 'nonprofittypelist', 'id' => "nonprofittypelist")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <span class="titlTxt">   Non Profit Types  </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                    <li>
						<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'admins','action'=>'addnonprofittypes'),
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
			<div class="clear"></div>
                  <?php    $this->loginarea="admins";    $this->subtabsel="nonprofittypelist"; $this->nonprofittypelist="tabSelt";
                            echo $this->renderElement('super_admin_types');  ?>   
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
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'admins/nonprofittypelist')" id="locaa"></span>
            </div>	<span class="topRht_curv"></span>
            <div class="clear"></div></div>
         <?php $i=1; ?>			
        <div class="tblData">


            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
                <tr class="trBg">
                    <th align="center" valign="middle" style="width:1%">#</th>
                    <th align="center" valign="middle" style="width:2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style="width:30%"><span class="right"><?php echo $pagination->sortBy('non_profit_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Non-Profit Type</th>
                    <th align="center" valign="middle" style="width:67%"><span class="right"><?php echo $pagination->sortBy('description',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Description</th>
                   </tr>
                <?php if($nonprofittypedata){
                        $i=1;
                        foreach($nonprofittypedata as $eachrow){
							//echo "<pre>";
							//print_r($eachrow); exit;
                            $recid = $eachrow['NonProfitType']['id'];
                            $modelname = "NonProfitType";
                            $redirectionurl = "nonprofittypelist";
                            $non_profit_type_name = $eachrow['NonProfitType']['non_profit_type_name'];
                            if($non_profit_type_name)	$non_profit_type_name = AppController::WordLimiter($non_profit_type_name,25);
                            
							$description = $eachrow['NonProfitType']['description'];
                            if($description)	$description = AppController::WordLimiter($description,50);
                        ?>

                        <?php if($i%2 == 0) { ?>

                            <tr class='altrow'>	
                                <td align="center" class='newtblbrd'><span><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>

                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',$non_profit_type_name  ),
									array('controller'=>'admins','action'=>'addnonprofittypes',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
								
								 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', $description ),
									array('controller'=>'admins','action'=>'addnonprofittypes',$recid),
									array('escape' => false)
									)
								);
							?>
								
								
                              
                                                         
                            </tr>

                            <?php } else { ?>

                            <tr>	
                                <td align="center"><span><?php echo $i++;?></span></td>
                                <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>

                                <td align="left" valign="middle">
									
									<?php
									e($html->link(
									$html->tag('span',$non_profit_type_name  ),
									array('controller'=>'admins','action'=>'addnonprofittypes',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                <td align="left" valign="middle">
									
								<?php
									e($html->link(
									$html->tag('span',$description ),
									array('controller'=>'admins','action'=>'addnonprofittypes',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                               
                                                            
                            </tr>
                            <?php } ?>	
                        <?php } }else{ ?>
                    <tr><td colspan="4" align="center">No Non-Profit Type(s) Found.</td></tr>
                    <?php } ?>
            </table>


        </div>
        <div>
            <span class="botLft_curv"></span>
            <div class="gryBot"><?php if($nonprofittypedata) { echo $this->renderElement('newpagination'); } ?>
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