<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/playerslist/'.$option;
$resetUrl = $base_url.'players/types/'.$option;
?>

<style>

.topTabs2 {
    list-style: none outside none;
    padding-top: 2px;
}
</style>
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
            document.getElementById("linkedit").href=baseUrl+"players/editcompanytype/"+id; 

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
                    window.location=baseUrl+"players/changestatus/"+id+"/CompanyType/0/types/delete/company";
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
		  <div class="centerPage" style="padding-top: 2px;">
            
			<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align: right;">			

            <?php echo $form->create("players", array("action" => "types/company",'name' => 'companytype', 'id' => "companytype")) ?>      
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script><?php
e($html->link($html->image('back.png', array('alt' => 'back')) . ' ',array('controller'=>'players','action'=>'playerslist','company'),array('escape' => false)));
echo $this->renderElement('new_slider');
?>			
</div>
            <?php //if($usertype=='admin') {?><span class="titlTxt1"><?php //echo $project['Project']['project_name'];  ?> &nbsp;</span> <?php //} ?>
			<span class="titlTxt1">&nbsp;</span>
            <span class="titlTxt"><?php echo $page_title; ?></span>
            <div class="topTabs" style="padding-top:16px; height:25px;">
			
				<?php /*?><ul class="dropdown" >
					<li>
						<?php
						e($html->link(
									$html->tag('span', 'Back'),
									array('controller'=>'players','action'=>'playerslist','company'),
									array('escape' => false)
									)
						);
						?>
					  </li>	
						
						</ul><?php */?>
						
			</div>
            <div class="clear"></div>
	         <?php $this->loginarea="players";    $this->subtabsel= 'company';
                            echo $this->renderElement('players/player_type_submenus');  ?>   
                            
        </div></div>
<div class="midCont" id="newcmptab">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div>
       <span class="topLft_curv"></span>         		
       <span class="topRht_curv"></span>
        <div class="gryTop">
                <?php echo $form->create("players", array("action" => "types",'name' => 'companytype', 'id' => "companytype")) ?>
                <script type='text/javascript'>
                	function setprojectid(projectid){
                    		document.getElementById('projectid').value= projectid;
                            document.adminhome.submit();
                    }
                </script>
                <div class="new_filter" >
                 
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
                
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
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                

  		<tr class="trBg">
		<th align="center" valign="middle" style="width:2%">#</th>
		<th align="center" valign="middle" style="width:2%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
            <th align="center" valign="middle" style="width:35%"><span class="right"><?php echo $pagination->sortBy('company_type_category_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'CompanyTypeCategory',null,' ',' '); ?></span>Company Type</th>
	        <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('is_3rdparty', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Is 3rd party?</th>
			<th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('company_type_status_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),'CompanyTypeStatus',null,' ',' '); ?></span>Company Type Status</th>
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
   			$redirectionurl = "types";
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
					array('controller'=>'players','action'=>'addcompanytype', $recid),
					array('escape' => false)
					)
				);
			?>
		</td>
		<td align="center" valign="middle">
			<?php
				e($html->link(
					$html->tag('span', $is_3rdparty_val),
					array('controller'=>'players','action'=>'addcompanytype', $recid),
					array('escape' => false)
					)
				);
			?>
		</td> 
		<td align="center" valign="middle">
			
			<?php
				e($html->link(
					$html->tag('span', $companytypestatus),
					array('controller'=>'players','action'=>'addcompanytype', $recid),
					array('escape' => false)
					)
				);
			?>

		</td>  
		<td align="center" valign="middle" class='newtblbrd'>
		
		<?php 
		if($eachrow['CompanyType']['active_status']=='1'){
			e($html->link(
				$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$companytypecategoryname)),
				array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus', $option),
				array('escape' => false),
				'Are you sure you want to Deactivate Company Type ?',
                false
				)
			);
		} else {
			e($html->link(
				$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$companytypecategoryname)),
				array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus', $option),
				array('escape' => false),
				'Are you sure you want to Activate Company Type ?',
                false
				)
			);
		}			
		?>
		
		
		</td>
		</tr>
	<?php } }else{ ?>
	<tr><td colspan="6" align="center">No Company Type Found.</td></tr>
	<?php } ?>
	</table>
	


</div><!--inner-container ends here-->

     <div>
                    <span class="botLft_curv"></span>
     				 <span class="botRht_curv"></span>
                    <div class="gryBot">
                    
				  <?php if(isset($companytypedata) && !empty($companytypedata)) { echo $this->renderElement('newpagination'); } ?>
        </div>

                    
                    <div class="clear"></div>
                    </div>




<div class="clear"></div>


</div> 


        
 <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null){		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	

    <?php if($usertype=='user'){?>
    	$('#newcmptab').find('a').attr('href', '#');
    <?php } ?>
</script>