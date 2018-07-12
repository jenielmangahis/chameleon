<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'email_uploads_list';
//$csvUrl = $base_url_admin.'download_project_product_list';
?>
<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script> 
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div class="myclass">
<?php echo $form->create("Admins", array("action" => "email_uploads_list",'name' => 'email_uploads_list', 'id' => "email_uploads_list",'onsubmit' => 'return validateproject("add");'))?>
       <div id="toppanel" >
               <?php  echo $this->renderElement('new_slider');  ?>

</div>

  <span class="titlTxt">Email Upload List</span>
        <?php
			/*
			e(
				$html->link(
					$html->tag('span','New'),
					array('controller'=>'admins','action'=>'email_upload'),
					array('escape'=>false)
				)	
			);
			*/
			?>
		<div style="clear:both;"></div>
		<?php $this->email_uploads_list="tabSelt"; echo $this->renderElement('project_list_submenu'); ?>
</div>
</div>
<div class="midCont" id="indxpage">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("Admins", array("action" => "projectlist_by_product",'name' => 'projectlist_by_product', 'id' => "projectlist_by_product")) ?>
       <div style="float:left">
        <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("EmailUpload.searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
        <span class="srchBg2">
		<input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
       
        </div><div style="float:left">  <?php
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div>
               
     </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
	</div>
<div class="tblData">
        <table width="960" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
            <th align="center" valign="middle" width="1%">#</th>
            <th align="center" valign="middle" width="2%">
                <input type="checkbox" id="checkall" name="checkall" value="">
            </th>
            <th align="center" width="20%">
            <span style="float:right">
                <?php echo $pagination->sortBy('coinset_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Upload Date & Time
            </th>
			<th align="center" width="17%"><span style="float:right"><?php echo $pagination->sortBy('project_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
              </span>
                Project Name
            </th>
            <th align="center" width="14%">
            <span style="float:right">
                <?php echo $pagination->sortBy('price_type_options_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Login Name
            </th>
            <th align="center" width="12%">
            <span style="float:right">
                <?php echo $pagination->sortBy('total_per_unit', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
           Upload List
            </th>
			<th align="center" width="12%"><span style="float:right">
            <?php echo $pagination->sortBy('numunits', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            # of Records
            </th>
            </tr>
       
       <?php 
	   if($emailUpload_list){ 
        $i=1;
		$alt=0;
        $count=1;
               foreach($emailUpload_list as $eachrow){
                   
               if($alt%2==0)
                $class="style='background-color:#FFF;'";
				else
                $class="style='background-color:#f8f8f8;'";
                
                $alt++;
                
               $recid = $eachrow['EmailUpload']['id'];
               $project_id=$eachrow['EmailUpload']['project_id'];
               $modelname = "EmailUpload";
               $redirectionurl = "email_uploads_list";
               $notetext = "";
               
               $records=$eachrow['EmailUpload']['records'];
               //$up_date=date('m-d-Y',strtotime($eachrow['EmailUpload']['created']));
               $up_date=$eachrow['EmailUpload']['created'];
               
           ?>

			<tr <?php echo $class;?>>    
				<td align="left" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
				<td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                <td align="left" valign="middle"  width="18%">
				<?php
				e($html->link(
					$html->tag('span', $up_date),
					array('controller'=>'admins','action'=>'email_upload',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $eachrow['EmailUpload']['project_name']),
					'javascript:void(0)',
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', (isset($eachrow['User']['username']))?$eachrow['User']['username']:'N/A'),
					'javascript:void(0)',
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $eachrow['EmailUpload']['upload_filename']),
					array('controller'=>'admins','action'=>'email_upload',$recid),
					array('escape' => false,'onclick' => "return setprojectid($project_id)")
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $records),
					'javascript:void(0)',
					array('escape' => false,'onclick' => "return setprojectid($project_id)")
					)
				);
				?>
				</td>
                
        </tr>
		<?php } } else{ ?>
    <tr><td colspan="7" align="center">No Email Uploads found.</td></tr>
    <?php } ?>
    </table>
    

</div>



<!--inner-container ends here-->
<?php echo $form->end();?>
                     <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($emailUpload_list) { echo $this->renderElement('newpagination'); } ?>
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
                                        if(confirm("Are you sure you want to Activate project(s)?"))   {
                                             window.location=baseUrlAdmin+"changestatus/"+id+"/Project/1/projectlist/cngstatus";      
                                        } 
                                        
                                        }else{
                                            if(confirm("Are you sure you want to Deactivate project(s)?"))   { 
                                                window.location=baseUrlAdmin+"changestatus/"+id+"/Project/0/projectlist/cngstatus";
                                            }
                                        }
                        }
                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))
            if(confirm("Are You Sure to delete the item"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/Project/0/projectlist/delete";
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
    document.getElementById("indxpage").className = "newmidCont";
    }    
</script>