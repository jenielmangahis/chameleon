<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'companytype';
?>
<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script>  
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
        <div class="center-Page col-sm-6">
            <h2>Company Types</h2>
        </div>
        
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admins", array("action" => "companytype",'name' => 'companytype', 'id' => "companytype"))?> 		
				<?php
                e($html->link($html->image('new.png', array('alt' => 'New')) . ' ',array('controller'=>'admins','action'=>'addcompanytype'),array('escape' => false))); ?>
                <ul class="sub_menu">
                                <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                                <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                                <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                                <li class="botCurv"></li>
                        </ul></li>
                <a id="linkedit" onclick="editholder();" href="javascript:void(0)"><?php e($html->image('edit.png', array('alt' => 'Edit'))); ?></a>
                </ul>
                <?php echo $this->renderElement('new_slider'); ?>
            </div>
             
        </div>

    </div>

</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php $this->companytype="tabSelt";echo $this->renderElement('super_admin_types'); ?>   
    </div>
</div>

<div class="midCont" id="newcmptab">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>         		
       <span class="topRht_curv"></span>
        <div class="gryTop">
        		<div class="new_filter" <
                <?php echo $form->create("Admins", array("action" => "companytype",'name' => 'companytype', 'id' => "companytype")) ?>
                <script type='text/javascript'>
                        function setprojectid(projectid){
                                        document.getElementById('projectid').value= projectid;
                                        document.adminhome.submit();
                                }
                </script>
                  <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
                </div>
  <div style="float:left">  <?php if($session->check('Message.flash')){ ?> 
        
                        <?php $session->flash(); ?> <?php } 
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div>
         </span>
        </div> 
        </div>
        <div class="clear"></div>
</div>

<div class="tblData">
               <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
                

  		<tr class="trBg">
		<th align="center" valign="middle" style="width:2%">#</th>
		<th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
            <th align="center" valign="middle" style="width:35%"><span class="right"><?php echo $pagination->sortBy('CompanyTypeCategories.company_type_category_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Type</th>
	        <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('is_3rdparty', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Is 3rd party?</th>
			<th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('CompanyTypeStatus.company_type_status_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Type Status</th>
     		<th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

      </tr>
   	<?php if($companytypedata){ 
			$i=1;
			// Start of Record no, custmization
   			$pagerL = Configure::read('Pagging.limit');	 
			if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
			$i= $i+($pagerL*($this->params['url']['page']-1));
			}
			// End
   			foreach($companytypedata as $eachrow){
   			$recid = $eachrow['CompanyType']['id'];
   			$modelname = "CompanyType";
   			$redirectionurl = "companytype";
            $is_3rdparty =$eachrow['CompanyType']['is_3rdparty'];  
   			 if($is_3rdparty=='1'){
                 $is_3rdparty_val="Yes";
             }else{
                  $is_3rdparty_val="No";  
             }
            
            $companytypecategoryname = $eachrow['CompanyTypeCategory']['company_type_category_name'];
			$companytypestatus = $eachrow['CompanyTypeStatus']['company_type_status_name'];
   			
   		?>
	
	<?php if($i%2 == 0) { ?>
   			<tr class='altrow'>
   	<?php }else { ?>
   			<tr>
   	<?php } ?>
   	
   	<td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td><td align="center" class='newtblbrd'   
                 valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" class='newtblbrd' valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $companytypecategoryname),
					array('controller'=>'admins','action'=>'getcompanylist',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="center" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $is_3rdparty_val),
					array('controller'=>'admins','action'=>'getcompanylist',$recid),
					array('escape' => false)
					)
				);
			?>
		</td> 
		<td align="center" valign="middle">
			
			<?php
				e($html->link(
					$html->tag('span', $companytypestatus),
					'#',
					array('escape' => false)
					)
				);
			?>

		</td>  
		<td align="center" valign="middle" class='newtblbrd'>
			<?php
				
			if($eachrow['CompanyType']['active_status']=='1'){ 
				e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['CompanyType']['company_type_name'])),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}
							else{

								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'dfdd','title'=>'Click here to activate '.$eachrow['CompanyType']['company_type_name'])),
									array('controller'=>'admins','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
									)
								);
							}				
			?></td>
		
		</tr>
	
	<?php } }else{ ?>
	<tr><td colspan="6" align="center">No Company Type Found.</td></tr>
	<?php } ?>
	</table>
	


</div><!--inner-container ends here-->

     <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
				  <?php if(isset($companytypedata) && !empty($companytypedata)) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>




<div class="clear"></div>


</div><!--container ends here-->
                    
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
                document.getElementById("linkedit").href=baseUrlAdmin+"editcompanytype/"+id; 
                
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
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CompanyType/1/companytype/cngstatus";
                                        }else{
                                        window.location=baseUrlAdmin+"changestatus/"+id+"/CompanyType/0/companytype/cngstatus";
                                        }
                        }
                        if(op=="del"){
						if(confirm("You have selected "+count +" items to delete ?"))

						if(confirm("Are you sure to delete the item ?"))

                        window.location=baseUrlAdmin+"changestatus/"+id+"/CompanyType/0/companytype/delete";
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
	document.getElementById("newcmptab").className = "newmidCont";
	}	
</script>
