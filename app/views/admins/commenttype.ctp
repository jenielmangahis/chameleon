<!--container starts here-->
<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 
<?php $pagination->setPaging($paging); ?>
<div class="titlCont">
<div class="centerPage">
        <?php echo $form->create("Admins", array("action" => "commenttype",'name' => 'commenttype', 'id' => "commenttype"))?>
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
<span class="titlTxt">Comment Types  </span>
<div class="topTabs">
        <ul class="dropdown">
        
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'admins','action'=>'addcommenttype'),
					array('escape' => false)
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
        </div>  <div class="clear"></div>
            <?php $this->commenttype="tabSelt";echo $this->renderElement('super_admin_types'); ?>
</div></div>
<div class="midCont">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <div>
	<span class="topLft_curv"></span>
	<span class="topRht_curv"></span>               
        <div class="gryTop">
		
                <?php echo $form->create("Admins", array("action" => "commenttype",'name' => 'commenttype', 'id' => "commenttype")) ?>
				<div class ="new_filter">
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script> <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'commenttype')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                      <?php $session->flash(); ?> <?php } 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div>
		</div>
        <div class="clear"></div>
</div>

<div class="tblData">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg"> 
					<th align="left" valign="middle" style="width:2%">#</th>
					<th align="left" valign="middle" style="width:3%">
					<input type="checkbox" id="checkall" name="checkall" value=""></th>
				    <th align="left" valign="middle" style="width:87%"> 
						<span class="right"><?php echo $pagination->sortBy('comment_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
						</span>Comment Type</th>
     
     <th align="left" valign="middle" style="width:8%">Status<span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span></th>

      </tr>
   	<?php if($commenttypedata){  $i=1;
   			foreach($commenttypedata as $eachrow){
   			$recid = $eachrow['CommentType']['id'];
   			$modelname = "CommentType";
   			$redirectionurl = "commenttype";
   		?>
   	<tr>	<td align="left" valign="middle"><?php echo $i++ ?></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" valign="middle"><a><span><?php echo $eachrow['CommentType']['comment_type_name']; ?></span></a></td>
		
		<td align="left" valign="middle">
		<?php 
			if($eachrow['CommentType']['active_status']=='1'){
				e($html->link(
					$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['SiteType']['project_type_name'])),
					array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
					array('escape' => false)
					)
				);
			} else {
				e($html->link(
					$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['SiteType']['project_type_name'])),
					array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
					array('escape' => false)
					)
				);
			}			
		?>
		</td>
	
		</tr>
	<?php } }else{ ?>
	<tr><td colspan="3" align="center">No Comment Type Found.</td></tr>
	<?php } ?>
	</table>
	
</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
       <span class="botRht_curv"></span>
                    <div class="gryBot">
                    
                  <?php if($commenttypedata) { echo $this->renderElement('newpagination'); } ?>
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
                document.getElementById("linkedit").href=baseUrlAdmin+"editcommenttype/"+id; 
                
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
                        if(op=="change"){       
                                if(act=="active"){
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommentType/1/commenttype/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommentType/0/commenttype/cngstatus";
                                        }
                        }
                        if(op=="del"){
	            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?")){
                        window.location=baseUrlAdmin+"changestatus/"+id+"/CommentType/0/commenttype/delete";}
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  


<!--container ends here-->