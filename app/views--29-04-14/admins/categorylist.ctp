<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>     
<div class="titlCont">

<div class="centerPage">       
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Admins", array("action" => "categorylist",'name' => 'categorylist', 'id' => "categorylist"))?> 
<span class="newtitlTxt">Categories</span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'admins','action'=>'addcategories'),
						array('escape'=>false)
					)	
				);
				?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
        </ul>
        </div>
            <div class="clear"></div>
            <?php $this->categorylist="tabSelt";echo $this->renderElement('super_admin_types'); ?>

</div></div>     
<div class="midCont" id="newprttype">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div>
    	<span class="topLft_curv"></span>
    <span class="topRht_curv"></span>                
        <div class="gryTop">
        	<div class="new_filter" >
                <?php echo $form->create("categories", array("action" => "index",'name' => 'adminhome', 'id' => "adminhome")) ?>
                  
				<div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'categorylist')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                      <?php $session->flash(); ?> <?php }         ?></div> 
               <div class="clear"></div>
       
        </div> 
        </div>
        <div class="clear"></div>
</div>


     <?php $i=1; ?>			
        <div class="tblData">


            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
                <tr class="trBg">
                    <th align="center" valign="middle" style="width:1%">#</th>
                    <th align="center" valign="middle" style="width:2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('category_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Category</th>
                    <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('category_name',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Sub-Category</th>
                    <th align="center" valign="middle" style="width:47%"><span class="right"><?php echo $pagination->sortBy('description', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),CategoryDetail,null,' ',' '); ?></span>Description</th>
                   </tr>
                <?php if($categorydata){
                        $i=1;
                        foreach($categorydata as $eachrow){
							
                            $recid = $eachrow['CategoryDetail']['id'];
                            $modelname = "Category";
                            $redirectionurl = "categorylist";
                            $category_name = $eachrow['Category']['category_name'];
                            $sub_category = AppController::getSubCategoryDropdown($eachrow['Category']['id']);
							$description = $eachrow['CategoryDetail']['description'];
                            if($description) $description = AppController::WordLimiter($description,50);
                ?>

                        <?php echo ($i%2 == 0)? "<tr class='altrow'>" : "<tr>" ;?>	
                                <td align="center" class='newtblbrd'><span><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>

                                <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span',$category_name ),
									array('controller'=>'admins','action'=>'addcategories',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
								
								 <td align="left" valign="middle" class='newtblbrd'>
									
									<?php
									e($html->link(
									$html->tag('span', implode($sub_category, ', ')),
									array('controller'=>'admins','action'=>'addcategories',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
							
                                <td align="left" valign="middle" class='newtblbrd'>
									<?php
									e($html->link(
									$html->tag('span', $description),
									array('controller'=>'admins','action'=>'addcategories',$recid),
									array('escape' => false)
									)
								);
							?>
								</td>
                                                         
                            </tr>                            
                        <?php } }else{ ?>
                    <tr><td colspan="5" align="center">No Categories Found.</td></tr>
                    <?php } ?>
            </table>


        </div>

   <div>
                    <span class="botLft_curv"></span>
      				<span class="botRht_curv"></span>
                    <div class="gryBot">
                    
                  <?php if($categorydata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>
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
                document.getElementById("linkedit").href=baseUrlAdmin+"addcategories/"+id; 
                
                }
        } 


function activatecontents(act,op)
{       
        var id="";
        $('.checkid').each(function(){          
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {                       
                        if(id=="")
                                id=$(this).val();
                        else
                                id=id + "*" + $(this).val();
                }
   });
        if(id !=""){
                        if(op=="change"){       
                                if(act=="active"){
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/Category/1/categorylist/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/Category/0/categorylist/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are ou ure to delete the item ?"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/Category/0/categorylist/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<script type="text/javascript">
	if(document.getElementById("flashMessage")!=null)
	{		
	document.getElementById("newprttype").className = "newmidCont";
	}	
</script>

<!--container ends here-->
