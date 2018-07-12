<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<?php
$base_url = Configure::read('App.base_url');
$resetUrl = $base_url.'producttype';
?>
<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script> 
<div class="titlCont"><div style="width:960px;margin:0 auto">
        
         <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>      
<?php echo $form->create("setups", array("action" => "producttype",'name' => 'producttype', 'id' => "producttype"))?>
   <span class="titlTxt">Products </span>
        <div class="topTabs" style="margin-left: -40px;">
            <ul class="dropdown">
                <li class="">
				<?php
				e($html->link(
					$html->tag('span', 'New'),
					array('controller'=>'setups','action'=>'addproducttype'),
					array('escape' => false)
					)
				);
				?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>
                        <!--<li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>-->
                        <li class="botCurv"></li>
                    </ul></li>
                <li><a id="linkedit" onclick="editholder();" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <?php $this->producttype="tabSelt"; 
			//echo $this->renderElement('super_admin_config_types');
			 echo $this->renderElement('project_list_submenu');
		?>
    </div></div>
<div class="midCont">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div><span class="topLft_curv"></span>                
        <div class="gryTop">
            <?php echo $form->create("setups", array("action" => "index",'name' => 'adminhome', 'id' => "adminhome")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>       <div style="float:left">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'setups/producttype')" id="locaa"></span>
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
             <th align="left" valign="middle" style="width:10px">#</th>
            <th align="center" valign="middle" style="width:15px"><input type="checkbox" id="checkall" name="checkall" value=""></th>
                <th align="center" valign="middle" style="width: 170px;"><span class="right" ><?php echo $pagination->sortBy('product_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Products</th>
                <th align="center" valign="middle" style="width: 70px;"><span class="right"><?php echo $pagination->sortBy('shape', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Shape</th>
                <th align="center" valign="middle" width="100"><span class="right"><?php echo $pagination->sortBy('delivery_days', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Days</th>
                <th align="center" valign="middle" style="width: 300px;"><span class="right"><?php echo $pagination->sortBy('notes', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Note</th>
                <th align="center" valign="middle" style="width: 70px;"><span class="right"><?php echo $pagination->sortBy('status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>
            </tr>
            <?php if($producttypedata){ $i=1;
                    $alt=0;

                    foreach($producttypedata as $eachrow){
                        //alternate color rows
                        if($alt%2==0)
                            $class="style='background-color:#FFF;'";
                        else
                            $class="style='background-color:#f8f8f8;'";

                        $alt++;

                        $recid = $eachrow['ProductType']['id'];
                        $shape = $eachrow['ProductType']['shape'];
                        $days = $eachrow['ProductType']['delivery_days'];
                        $modelname = "ProductType";
                        $redirectionurl = "producttype";
                        $notetext = "";
                        if($eachrow['ProductType']['notes']){
                            $notetext = AppController::WordLimiter($eachrow['ProductType']['notes'],60);
                        }
                        if($notetext==" ")
                            $notetext= $eachrow['ProductType']['notes'];

                    ?>
                    <tr <?php echo $class;?>>    
                        <td align="center" valign="middle"><a><span><?php echo $i++ ?></span></a></td>
                        <td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
                        <td align="left" valign="middle"  width="18%">
						<?php
						e($html->link(
							$html->tag('span', $eachrow['ProductType']['product_type_name']),
							array('controller'=>'setups','action'=>'editproducttype',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e($html->link(
							$html->tag('span', $shape),
							array('controller'=>'setups','action'=>'editproducttype',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e($html->link(
							$html->tag('span', $days),
							array('controller'=>'setups','action'=>'editproducttype',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>
                        <td align="left" valign="middle">
						<?php
						e($html->link(
							$html->tag('span', $notetext?$notetext:"N/A"),
							array('controller'=>'setups','action'=>'editproducttype',$recid),
							array('escape' => false)
							)
						);
						?>
						</td>              
                        <td align="center" valign="middle">
						<?php 
							$modalname="ProductType";
							$redirctaction="producttype";
						if($eachrow['ProductType']['active_status']=='1'){
							e($html->link(
								$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['ProductType']['product_type_name'])),
								array('controller'=>'setups','action'=>'changestatus',$recid,'2',$modalname,$redirctaction),
								array('escape' => false)
								)
							);
						} else {
							e($html->link(
								$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['ProductType']['product_type_name'])),
								array('controller'=>'setups','action'=>'changestatus',$recid,'1',$modalname,$redirctaction),
								array('escape' => false)
								)
							);
						}			
						?>

                        </td>

                    </tr>
                    <?php } }else{ ?>
                <tr><td colspan="4" align="center">No Product Type Found.</td></tr>
                <?php } ?>
        </table>



    </div><!--inner-container ends here-->

    <div>
        <span class="botLft_curv"></span>

        <div class="gryBot">

            <?php if(isset($projecttypedata) && $projecttypedata) { echo $this->renderElement('newpagination'); } ?>
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
            document.getElementById("linkedit").href=baseUrl+"setups/editproducttype/"+id; 

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


                    window.location=baseUrl+"setups/changestatus/"+id+"/1/ProductType/producttype";
                }else{
                    window.location=baseUrl+"setups/changestatus/"+id+"/2/ProductType/producttype";
                }
            }
            if(op=="del"){
                if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrl+"setups/changestatus/"+id+"/1/ProductType/producttype";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>  

<!--container ends here-->