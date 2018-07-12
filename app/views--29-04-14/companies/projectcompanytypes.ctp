<?php //print_r($project);?> 

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
    function editcompanytype()
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
            document.getElementById("linkedit").href=baseUrl+"companies/projectcompanytypes_add/"+id; 

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
                    window.location=baseUrl+"companies/changestatus/"+id+"/CompanyType/1/projectcompanytypes/cngstatus";
                }else{
                    window.location=baseUrl+"companies/changestatus/"+id+"/CompanyType/0/projectcompanytypes/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("You have selected "+count +" items to delete ?"))

                    if(confirm("Are You Sure to delete the item"))
                    window.location=baseUrl+"companies/changestatus/"+id+"/CompanyType/0/projectcompanytypes/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
</script>  

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container">
       <div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
        
            <?php echo $form->create("Company", array("action" => "projectcompanytypes",'name' => 'projectcompanytypes', 'id' => "projectcompanytypes")) ?>
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
                       <span class="titlTxt">   Company Types  </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                        <li>
							<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'companies','action'=>'projectcompanytypes_add'),
								array('escape' => false)
								)
							);
						?>
						</li>
                <li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
                    <ul class="sub_menu">
                        <li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                        <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li>
                        <!--li><a href="javascript:void(0)">Copy</a></li-->
                        <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)" onclick="editcompanytype();" id="linkedit"><span>Edit</span></a></li>
                </ul>
            </div>
      
                   <?php  $this->loginarea="companies";    
                    $this->subtabsel="projectcompanytypes";
                    echo $this->renderElement('contact_submenus');  ?>   
        </div></div>
<div class="midCont" id="newhldtab">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span>
        <div class="gryTop">
            
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script>
            <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));
      ?> 
              
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'companies/projectcompanytypes')" id="locaa">&nbsp;&nbsp;  
           </span>

        </div><span class="topRht_curv"></span>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                

          <tr class="trBg">
        <th align="center" valign="middle" style="width:10px">#</th>
        <th align="center" valign="middle" style="width:10px"><input type="checkbox" id="checkall" name="checkall" value=""></th>
            <th align="center" valign="middle" style="width:730px"><span class="right"><?php echo $pagination->sortBy('company_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Company Type</th>
             <th align="center" valign="middle" style="width:70px"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

      </tr>
       <?php if($companytypedata){ $i=1;
               foreach($companytypedata as $eachrow){
               $recid = $eachrow['CompanyType']['id'];
               $modelname = "CompanyType";
               $redirectionurl = "projectcompanytypes";
            $is_3rdparty =$eachrow['CompanyType']['is_3rdparty'];  
                if($is_3rdparty=='1'){
                 $is_3rdparty_val="Yes";
             }else{
                  $is_3rdparty_val="No";  
             }
               
           ?>
    
    <?php if($i%2 == 0) { ?>

        <tr class='altrow'><td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td><td align="center" class='newtblbrd'    
                 valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
        <td align="left" class='newtblbrd' valign="middle">
			
			<?php
					e($html->link(
					$html->tag('span',$eachrow['CompanyType']['company_type_name']),
					array('controller'=>'companies','action'=>'projectcompanytypes_add',$recid),
					array('escape' => false)
					)
				);
			?>
		</td>
           <td align="center" valign="middle" class='newtblbrd'>
		   
			<?php if($eachrow['CompanyType']['active_status']=='1'){ 
				e($html->link(
									$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['CompanyType']['company_type_name'])),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
									array('escape' => false)
									)
								);
							}
							else{
								e($html->link(
									$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['CompanyType']['company_type_name'])),
									array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
									array('escape' => false)
									)
								);
							}	
			?></td>
        
        </tr>
    <?php } else { ?>
     <tr>    <td align="center" valign="middle"><?php echo $i++ ?></td><td align="center" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
        <td align="left" valign="middle">
			<?php
					e($html->link(
					$html->tag('span',$eachrow['CompanyType']['company_type_name']),
					array('controller'=>'companies','action'=>'projectcompanytypes_add',$recid),
					array('escape' => false)
					)
				);
			?>

		</td>
        <td align="center" valign="middle"><?php if($eachrow['CompanyType']['active_status']=='1'){ 
			e($html->link(
							$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['CompanyType']['company_type_name'])),
							array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
							array('escape' => false)
							)
						);
							}
				else{
					e($html->link(
						$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['CompanyType']['company_type_name'])),
						array('controller'=>'companies','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl),
						array('escape' => false)
						)
					);
				}	
			
			?></td>
        
        </tr>
        
    <?php } ?>        

    <?php } }else{ ?>
    <tr><td colspan="3" align="center">No Company Type Found.</td></tr>
    <?php } ?>
    </table>



    </div>
    <div>
    <span class="botLft_curv"></span>
    <div class="gryBot"><?php if($companytypedata) { echo $this->renderElement('newpagination'); } ?>
    </div><span class="botRht_curv"></span>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->




      </div>    
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {		
        document.getElementById("newhldtab").className = "newmidCont";
    }	
</script>
