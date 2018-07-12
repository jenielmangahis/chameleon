<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>     
<div class="titlCont"><div style="width:960px;margin:0 auto">
       
        <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>
 <?php echo $form->create("Admins", array("action" => "projecttype",'name' => 'projecttype', 'id' => "projecttype"))?> 
<span class="newtitlTxt">Project Types </span>
<div class="topTabs" style="margin-left: -40px;">
        <ul class="dropdown">
                <li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'admins','action'=>'addprojecttype'),
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
            <?php $this->projecttype="tabSelt";echo $this->renderElement('super_admin_types'); ?>

</div></div>     
<div class="midCont" id="newprttype">


	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
                <?php echo $form->create("Admins", array("action" => "index",'name' => 'adminhome', 'id' => "adminhome")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>       <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrlAdmin+'projecttype')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                      <?php $session->flash(); ?> <?php } 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div> 
               <div class="clear"></div>
         </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>

<div class="tblData">
                      <table width="540px" border="0" cellspacing="0" cellpadding="0">
                	<tr class="trBg"> 
			<th align="center" valign="middle" style="width:10px">#</th>
			<th align="center" valign="middle" style="width:10px">
				<input type="checkbox" id="checkall" name="checkall" value="">
			</th>
     			<th align="center" valign="middle" style="width:200px">
				<span class="right">
					<?php echo $pagination->sortBy('project_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
				</span>Project Type
			</th>
    			<th align="center" valign="middle" style="width:670px">
			<span class="right">
				<?php echo $pagination->sortBy('notes', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>Note
			</th>
     			<th align="center" valign="middle" style="width:70px">
			<span class="right">
			<?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
			</span>Status
			</th>
      </tr>
   	<?php if($projecttypedata){
			$i=1;
			// Start of Record no, custmization
   			$pagerL = Configure::read('Pagging.limit');	 
			if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
			$i= $i+($pagerL*($this->params['url']['page']-1));
			}
			// End
			
			foreach($projecttypedata as $eachrow){
   			$recid = $eachrow['SiteType']['id'];
   			$modelname = "SiteType";
   			$redirectionurl = "projecttype";
   			$notetext = "";
   			if($eachrow['SiteType']['notes']){
   				$notetext = AppController::WordLimiter($eachrow['SiteType']['notes'],60);
   			}
   	?>
	<?php 
	
	if($i%2 == 0) { ?>
   	<tr class='altrow'>	
		<td align="center" valign="middle" class='newtblbrd'>
		  <span style="color:#4d4d4d;"><?php echo $i++ ?></span></td>
		  <td align="center" valign="middle" class='newtblbrd'><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
          
		  <td align="left" valign="middle" class='newtblbrd' width="18%">
		  <?php
			e($html->link(
				$html->tag('span', $eachrow['SiteType']['project_type_name']),
				array('controller'=>'admins','action'=>'editprojecttype',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
		  <td align="left" valign="middle" class='newtblbrd'>
		  <?php
			e($html->link(
				$html->tag('span', $notetext?$notetext:"N/A"),
				array('controller'=>'admins','action'=>'editprojecttype',$recid),
				array('escape' => false)
				)
			);
		  ?>
		  </td>
		  <td align="center" valign="middle" class='newtblbrd'>
		  
		  <?php 
			if($eachrow['SiteType']['active_status']=='1'){
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
	<?php } else { ?>
	   	<tr> 	
		<td align="center" valign="middle"><span style="color:#4d4d4d;"><?php echo $i++ ?></span></td><td align="center" valign="middle" ><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
        <td align="left" valign="middle"  width="18%">
		<?php
			e($html->link(
				$html->tag('span', $eachrow['SiteType']['project_type_name']),
				array('controller'=>'admins','action'=>'editprojecttype',$recid),
				array('escape' => false)
				)
			);
		?>
		</td>
        <td align="left" valign="middle" >
		<?php
			e($html->link(
				$html->tag('span', $notetext?$notetext:"N/A"),
				array('controller'=>'admins','action'=>'editprojecttype',$recid),
				array('escape' => false)
				)
			);
		?>
		</td>
		<td align="center" valign="middle" >
		<?php 
			if($eachrow['SiteType']['active_status']=='1'){
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
	<?php } ?>	
	


	<?php } }else{ ?>
	<tr><td colspan="4" align="center">No Project Type Found.</td></tr>
	<?php } ?>
	</table>
	


</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($projecttypedata) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <span class="botRht_curv"></span>
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
                document.getElementById("linkedit").href=baseUrlAdmin+"editprojecttype/"+id; 
                
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
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/SiteType/1/projecttype/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/SiteType/0/projecttype/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are ou ure to delete the item ?"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/SiteType/0/projecttype/delete";
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
