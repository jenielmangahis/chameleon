<script type="text/javascript">
$(document).ready(function() {
		$('#memBrs').removeClass("butBg");
		$('#memBrs').addClass("butBgSelt");
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



    function viewmessage()
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
            alert("please select only one row  to view");
            return false;
        }else{    
            document.getElementById("linkedit").href=baseUrlAdmin+"messagenew/"+id; 

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
                    window.location=baseUrlAdmin+"changestatus/"+id+"/Message/0/messagelist/delete";
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
            <h2> Messages List </h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container"> <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">-->
            	<?php echo $form->create("admins", array("action" => "messagelist",'enctype'=>'multipart/form-data','name' => 'messagelist', 'id' => "messagelist"))?> 		
				<?php
                //e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));
                
                ?>	
                
                <?php e($html->link($html->image('new.png',array('alt' => "NEW")) . ' ' . __(''), $base_url_admin."messagenew",array('escape' => false)));
                ?>
                <a href="javascript:void(0)" onclick="return activatecontents('asd','del');">
                <?php e($html->image('action.png',array('alt' => "Delete"))) ?></a>
                <a href="javascript:void(0)" onclick="viewmessage();" id="linkedit"><span><?php e($html->image('note.png',array('alt' => "View"))) ?></span></a>                
            </div>
            <?php  echo $this->renderElement('new_slider');  ?>	
        </div>
    </div>
    
         
        
                   
                    <script type='text/javascript'>
                        function setprojectid(projectid){
                            document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                        }
                    </script>
        
                
                   <!--<span class="titlTxt"> Messages List </span>-->
                    
                    <div class="topTabs" style="height:25px;">
                       <?php /*?> <ul class="dropdown">
                             <li>
                                
                                <?php
                                e($html->link(
                                    $html->tag('span', 'New'),
                                    array('controller'=>'admins','action'=>'messagenew'),
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
                             <li><a href="javascript:void(0)" onclick="viewmessage();" id="linkedit"><span>View</span></a></li> 
                        </ul><?php */?>
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
<div class="midCont">

    <?php if($session->check('Message.flash')){ ?> 
        <div id="blck"> 
            <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
                            position: absolute;
                            z-index: 11;" /></a>
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
           
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
			<div class="new_filter">
            <span class="spnFilt">Filter:</span><span class="srchBg">
            <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2">
                <?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
                    if(isset($this->data['Admins']['searchkey']) && $this->data['Admins']['searchkey'] !=""){
                        echo $form->submit("Reset", array('id' => 'searchkey', 'div' => false, 'label' => '','onclick'=>'document.getElementById("searchkey").value=""'));
                    }
                ?> 
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'messagelist')" id="locaa">
            </span>

            <span class="spnFilt">
                <?php if($session->check('Message.flash')){ ?> 

                    <?php $session->flash(); } ?>
            </span>
        </div>  </div>
        <div class="clear"></div></div>
    <!-- top curv image ends -->

		
		

<?php $i=1; ?>			
<div class="tblData">
<table class="table table-striped table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="trBg">
<th align="center" width="3%">#</th>
<th align="center" width="3%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
<th align="center" valign="middle" style="width:20%"><span class="right"><?php echo $pagination->sortBy('from_holdername', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Members</th>
<th align="center" valign="middle" style="width:40%"><span class="right"><?php echo $pagination->sortBy('msg_subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Message</th>
<th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>
 </tr>
            <?php if($msglist){                    
                    $dispflag = false;
                    foreach($msglist as $eachrow){

                        $recid = $eachrow['Message']['id'];
                        $modelname = "Message";
                        $redirectionurl = "messagelist";




                        $holdernames = ucfirst($eachrow['Message']['from_holdername'])."-".ucfirst($eachrow['Message']['to_holdername']);
                        $message = $eachrow['Message']['msg_subject'];
                        $msgdate= date("M d, Y", strtotime($eachrow['Message']['created']));

                        /*if($this->requestAction("/companies/hascomment/$recid")){
                        $dispflag = true;
                        } */

                    ?>
                    <tr>    
                        <td align="center"><a><span><?php echo $i++;?></a></span></td>
                        <td align="center"><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>        
                        <td align="left" valign="middle"><a><span><?php echo $holdernames?$holdernames:"N/A"; ?></td>
                        <td align="left" valign="middle"><a><span><?php echo $message?$message:"N/A"; ?></a></span></td>
                        <td align="left" valign="middle"><a><span><?php echo $msgdate?$msgdate:"N/A"; ?></a></span></td>

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="5" align="center">No Messages.</td></tr>
                <?php  } ?>
        </table>

    </div>
    <!-- bot curv image starts -->
    <div>
        <!--<span class="botLft_curv"></span><span class="botRht_curv"></span>-->
        <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
        </div>
        <div class="clear"></div>
    </div>
    <!-- bot curv image ends -->

    <!--inner-container ends here-->

    <?php echo $form->end();?>
</div>



    <div class="clear"></div>
</div>    