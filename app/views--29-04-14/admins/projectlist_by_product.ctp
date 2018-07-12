<?php
$base_url_admin = Configure::read('App.base_url_admin');
$resetUrl = $base_url_admin.'projectlist_by_product';
$csvUrl = $base_url_admin.'download_project_product_list';
$this->projectlistbyproduct="tabSelt";
?>
<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="titlCont"><div style="width:960px; margin:0 auto;">
       <div align="center" id="toppanel" >
      <?php  echo $this->renderElement('new_slider');  ?>
</div>
        <span class="newtitlTxt">Projects</span>
        <div class="topTabs">
			<ul class="dropdown">
                <li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'admins','action'=>'addproject'),
						array('escape'=>false)
					)	
				);
				?>
				</li>
                <li class="">
				<a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
					<ul class="sub_menu" style="visibility: hidden;">
							<li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
							<li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
							<li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
							<li class="botCurv"></li>
					</ul>
				</li>
				<li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul>		
        </div>
        
        <div class="clear"></div>
            <?php  echo $this->renderElement('project_list_submenu');  ?>
</div></div>
<div class="midCont" id="indxpage">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("Admins", array("action" => "projectlist_by_product",'name' => 'projectlist_by_product', 'id' => "projectlist_by_product")) ?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                
                    document.getElementById('projectid').value= projectid;
                    document.projectlist_by_product.submit();
                }
        </script><div style="float:left">
        <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
        <span class="srchBg2">
		<input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
        <span class="srchBg2"><input type="button" value="CSV File Download" label="" onclick="javascript:(window.location='<?php echo $csvUrl ?>')" id="locaa"></span>
        </div><div style="float:left">  <?php
                        if(!isset($selectedprojectid)) $selectedprojectid="";

                        echo $form->hidden("Admins.projectid", array('id' => 'projectid','value'=>"$selectedprojectid"));
        ?></div>
        <!-- <div class="right"><strong> Go To : </strong>< ?php
        $droparr = array('ac'=>'Administrator Control','all'=>'Projects');
        echo $form->select("admincontrol",$droparr,'',array('id' => 'admincontrol',"onchange"=>"return setprojectid('');"),'---Select---'); ?>
        </div>  -->

        
     </span>
        </div> <span class="topRht_curv"></span>
        <div class="clear"></div>
</div>
<div class="tblData">
        <table width="960" border="0" cellspacing="0" cellpadding="0">
        <tr class="trBg">
             <th align="center" valign="middle" width="10px">#
            </th>
            <th align="center" valign="middle" width="10px">
                <input type="checkbox" id="checkall" name="checkall" value="">
            </th>
            <th align="center" width="100px"><span style="float:right"><?php echo $pagination->sortBy('project_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
              </span>
                Project
                 </th>
              <th align="center" width="100px">
            <span style="float:right">
                <?php echo $pagination->sortBy('coinset_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            
            Coinset #
            
            </th>
            <th align="center" width="140px">
            <span style="float:right">
                <?php echo $pagination->sortBy('price_type_options_id', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            
            Product Type
            
            </th>
            <th align="center" width="100px"><span style="float:right">
            <?php echo $pagination->sortBy('numunits', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            # Coins
            </th>
            <th align="center" width="100px">
            <span style="float:right">
                <?php echo $pagination->sortBy('total_per_unit', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            
            Unit $
            
            </th>
            <th align="center" width="100px">
            <span style="float:right">
                <?php echo $pagination->sortBy('grand_total', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            
            Total $
            
            </th>

               <th align="center"  width="100px"><span style="float:right">
            <?php echo $pagination->sortBy('datesubmitchipco', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Order Date
            
              </th>
                    <th align="center"  width="100px">
            <span style="float:right">
            <?php echo $pagination->sortBy('dateestship', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?>
            </span>
            Ship Date
            
              </th>
                  
                 
                </tr>
       

       <?php 
       if($coinset_orders){ 

        $i=1;
    $alt=0;
        $count=1;
               foreach($coinset_orders as $eachrow){
                   
               if($alt%2==0)
                $class="style='background-color:#FFF;'";
            else
                $class="style='background-color:#f8f8f8;'";
                
                $alt++;
                
               $recid = $eachrow['Coinset']['id'];
               $project_id=$eachrow['Coinset']['project_id'];
               $modelname = "Coinset";
               $redirectionurl = "projectlist_by_product";
               $notetext = "";
               
               $total_units=$eachrow['Coinset']['total_per_unit'];
               $grand_total=$eachrow['Coinset']['grand_total'];
               $product_type=$eachrow['ProductType']['product_type_name'];
               
               $order_date=date('m-d-Y',strtotime($eachrow['Coinset']['datesubmitchipco']));
               $ship_date=date('m-d-Y',strtotime($eachrow['Coinset']['dateestship']));
               
           ?>

<tr <?php echo $class;?>>    
				<td align="left" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
				<td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                <td align="left" valign="middle"  width="18%">
				<?php
				e($html->link(
					$html->tag('span', $eachrow['Project']['project_name']),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $eachrow['Coinset']['coinset_name']),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $product_type?$product_type:"N/A"),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $eachrow['Coinset']['numunits']),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $total_units?$total_units:"N/A"),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $grand_total?$grand_total:"N/A"),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $order_date),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle">
				<?php
				e($html->link(
					$html->tag('span', $ship_date),
					array('controller'=>'admins','action'=>'addproject',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
       
        
        </tr>
    <?php } }else{ ?>
    <tr><td colspan="4" align="center">No Projects found.</td></tr>
    <?php } ?>
    </table>
    

</div>



<!--inner-container ends here-->
<?php echo $form->end();?>
                     <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($coinset_orders) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<div class="clear"></div>
                    </div>  <script type="text/javascript">
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