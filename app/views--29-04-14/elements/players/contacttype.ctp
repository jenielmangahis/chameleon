<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/playerslist/'.$option;
$resetUrl = $base_url.'players/types/contact';
?>

<script type="text/javascript">
$(document).ready(function() {
$('#playMnu').removeClass("butBg");
$('#playMnu').addClass("butBgSelt");
}); 
</script>
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
            document.getElementById("linkedit").href=baseUrl+"players/addcontacttype/"+id; 

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
                    window.location=baseUrl+"players/changestatus/"+id+"/ContactType/0/types/delete/contact";
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
		  <div class="centerPage"  style="padding-top: 2px;">
		  
			<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:10px;width:545px !important; text-align:right;">			

            <?php echo $form->create("players", array("action" => "types/contact",'name' => 'contacttype', 'id' => "contacttype")) ?> 
                 
            <script type='text/javascript'>
                function setprojectid(projectid){
                    document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
                }
            </script><?php
//e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));
echo $this->renderElement('new_slider');
?>			
</div>
           <?php if($usertype==trim("admin")){?>
		    
			<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
			<?php } ?>
			
            <span class="titlTxt"><?php echo $page_title; ?></span>
             <div class="topTabs" style="padding-top:42px;">
			
			<?php if(isset($usertype) &&  $usertype == 'admin') { ?>
			<ul class="dropdown" >
			
				<li>
					<?php
							e($html->link(
								$html->tag('span', 'New'),
								array('controller'=>'players','action'=>'addcontacttype'),
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
<div class="midCont" id="newcnttab">	

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



    <div>
    <span class="topLft_curv"></span>
    <span class="topRht_curv"></span>                
        <div class="gryTop">
        		
                <?php echo $form->create("Admins", array("action" => "addcontacttype",'name' => 'addcontacttype', 'id' => "addcontacttype")) ?>
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
               <div class="clear"></div>
         </span>
        </div> 
        </div>
        <div class="clear"></div>
</div>

<div class="tblData">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg"> 
					<th align="center" valign="middle" style="width:1%">#</th>
					<th align="center" valign="middle" style="width:1%"><input type="checkbox" id="checkall" name="checkall" value=""></th>
					<th align="center" valign="middle" style="width:67%"><span class="right"><?php echo $pagination->sortBy('contact_type_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Contact Type</th>
					<?php /* ?>
					<th align="center" valign="middle" style="width:21%"><span class="right"><?php echo $pagination->sortBy('project_lead', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Project Administrator</th>
					<?php */ ?>
					<th align="center" valign="middle" style="width:10%"><span class="right"><?php echo $pagination->sortBy('active_status', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

				</tr>
		<?php if($contacttypedata){  
			$i=1;
			// Start of Record no, custmization
   			$pagerL = Configure::read('Pagging.limit');	 
			if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
			$i= $i+($pagerL*($this->params['url']['page']-1));
			}
			// End
			
   			foreach($contacttypedata as $eachrow){
   			$recid = $eachrow['ContactType']['id'];
   			$modelname = "ContactType";
   			$redirectionurl = "types";
			$rowClass = ($i%2 == 0)?'altrow':''; 
   		?>

	<tr class='<?php echo $rowClass ?>'>
	
		<td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td>
		<td align="center" class='newtblbrd' valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
		<td align="left" class='newtblbrd' valign="middle">
		<?php
		e($html->link(
			$html->tag('span', $eachrow['ContactType']['contact_type_name']),
			array('controller'=>'players','action'=>'addcontacttype',$recid),
			array('escape' => false)
			)
		);
		?>
		</td>
		
		<td align="center" valign="middle" class='newtblbrd'>
		<?php 
		if($eachrow['ContactType']['active_status']=='1'){
			e($html->link(
				$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$eachrow['ContactType']['contact_type_name'])),
				array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus','contact'),
				array('escape' => false),
				'Are you sure you want to Deactivate Contact Type ?',
                false
				)
			);
		} else {
			e($html->link(
				$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$eachrow['ContactType']['contact_type_name'])),
				array('controller'=>'players','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus','contact'),
				array('escape' => false),
				'Are you sure you want to Activate Contact Type ?',
                false
				)
			);
		}			
		?>
		</td>
		</tr>
	<?php } }else{ ?>
	<tr><td colspan="2" align="center">No Contact Type Found.</td></tr>
	<?php } ?>
	</table>
        
</div><!--inner-container ends here-->

   <div>
                    <span class="botLft_curv"></span>
                    <span class="botRht_curv"></span>
      
                    <div class="gryBot">
                    
                  <?php if($contacttypedata) { echo $this->renderElement('newpagination'); } ?>
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
</script>
