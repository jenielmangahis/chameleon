<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/playerslist/company';
$resetUrl = $base_url.'players/types/'.$option;
?>

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
		var params = $('#params').val();
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
            document.getElementById("linkedit").href=baseUrl+"players/addcategories/"+id; 

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
                    window.location=baseUrl+"players/changestatus/"+id+"/Category/0/types/delete/category";
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

            <?php echo $form->create("players", array("action" => "types/category",'name' => 'categorylist', 'id' => "categorylist")) ?>      
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script><?php
echo $this->renderElement('new_slider');

?>			
</div>
			<?php if($usertype==trim("admin")){?>
			
	            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span>
		 <?php } ?>		
		 <span style="padding-top:18px !important" class="titlTxt1">&nbsp;</span>
            <span class="titlTxt"><?php echo $page_title; ?></span>
            <div class="topTabs">
			<?php if(isset($usertype) &&  $usertype == 'admin') { ?>
			<ul class="dropdown" >
				<li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'players','action'=>'addcategories'),
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
				<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
			</ul>
			<?php } ?>
</div>
            <div class="clear"></div>
            
	         <?php    $this->loginarea="players";    $this->subtabsel= $option;
                            echo $this->renderElement('players/player_type_submenus');  ?>   
                            
        </div></div>
<div class="midCont" id="newcntlist">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
         <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
            <span class="topRht_curv"></span>
            <div class="gryTop">
				<div class="new_filter" >
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));

                    ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'players/types/category')" id="locaa"></span>
            </div>	
            </div>
            <div class="clear"></div></div>
         <?php $i=1; ?>			
        <div class="tblData">


            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
                <tr class="trBg">
                    <th align="center" valign="middle" style="width:1%">#</th>
                    <th align="center" valign="middle" style="width:2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('category_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Category</th>
                    <th align="center" valign="middle" style="width:20%"><span class="right"><?php echo $pagination->sortBy('category_name',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Related Offers</th>
                    <th align="center" valign="middle" style="width:27%"><span class="right"><?php echo $pagination->sortBy('category_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Related Merchant</th>
                    <th align="center" valign="middle" style="width:20%"><span class="right"><?php echo $pagination->sortBy('description', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'CategoryDetail',null,' ',' '); ?></span>Description</th>
                   </tr>
                <?php if($categorydata){
                        $i=1;
                        foreach($categorydata as $eachrow){
							//echo "<pre>";
							//print_r($eachrow); exit;
                            $recid = $eachrow['CategoryDetail']['id'];
                            $modelname = "Category";
                            $redirectionurl = "categorylist";
                            $category_name = $eachrow['Category']['category_name'];
                            if($category_name)	$category_name = AppController::WordLimiter($category_name,20);
                            $offers ='';
							$description = $eachrow['CategoryDetail']['description'];
                            if($description)	$description = AppController::WordLimiter($description,30);
                        ?>
                            <tr <?php echo ($i%2 == 0)? "class='altrow'" :""; ?> >	
                                <td align="center" class='newtblbrd'><span><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>

                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',$category_name ),
									array('controller'=>'players','action'=>'addcategories',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
								
								 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',$offers ),
									array('controller'=>'players','action'=>'addcategories',$recid),
									array('escape' => false)
									)
								);
							?>

                               <td align="left" valign="middle" class='newtblbrd'>
								
								<?php
									$checki = 1;
									if(!empty($eachrow['Company'])) {
								    $count_cname = count($eachrow['Company']);
								    foreach($eachrow['Company'] as $ctc){
									    e($html->link(
											$html->tag('span', $ctc['company_name']),
											array('controller'=>'players','action'=>'adddetail','merchant',$ctc['id']),
											array('escape' => false)
										)); 
									if($count_cname > $checki){
										echo ", ";
										$checki++;
									}
								}}
							?>
								</td>
								</td>
                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', $description),
									array('controller'=>'players','action'=>'addcategories',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                                         
                            </tr>

                        <?php } }else{ ?>
                    <tr><td colspan="6" align="center">No Categories Found.</td></tr>
                    <?php } ?>
            </table>


        </div>
        <div>
            <span class="botLft_curv"></span>
            <span class="botRht_curv"></span>
            <div class="gryBot"><?php //if($categorydata) { 
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