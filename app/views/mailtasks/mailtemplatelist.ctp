<script type="text/javascript">
$(document).ready(function() {
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 
</script>
<?php 
echo $javascript->link('facebox');
echo $html->css('facebox.css');
$pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
 <?php
$base_url = Configure::read('App.base_url');
$resetUrl = $base_url.'mailtasks/mailtemplatelist';
?>
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
                                                        window.location=baseUrl+"mailtasks/changestatus/"+id+"/EmailTemplate/1/mailtemplatelist/cngstatus";
                                                        }else{
                                                        window.location=baseUrl+"mailtasks/changestatus/"+id+"/EmailTemplate/2/mailtemplatelist/cngstatus";
                                                        }
                                        }
                                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))

			if(confirm("Are you sure to delete the item ?"))
                                        window.location=baseUrl+"mailtasks/changestatus/"+id+"/EmailTemplate/0/mailtemplatelist/delete";
                                        }
                        }else{
                                alert('Please atleast one record should be select'); 
                                return false;
                        }
                }
</script>

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Mail Templates</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("mailtasks", array("action" => "mailtemplatelist",'name' => 'mailtemplatelist', 'id' => "mailtemplatelist"))?>
				<?php
                e($html->link($html->image('new.png', array('alt' => 'New')) . ' ',array('controller'=>'mailtasks','action'=>'addmailtemplate'),array('escape' => false)));
                ?>	
                <a onclick="return activatecontents('asd','del');" href="javascript:void(0)"><?php e($html->image('action.png')); ?></a>
                <a id="linkedit" onclick="editmailcontent();" href="javascript:void(0)"><?php e($html->image('edit.png')); ?></a>
                 <?php  echo $this->renderElement('new_slider');  ?>
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
            <?php /*?><ul class="dropdown">
                <li class="">
				<?php
				e(
					$html->link(
						$html->tag('span','New'),
						array('controller'=>'mailtasks','action'=>'addmailtemplate'),
						array('escape'=>false)
					)	
				);
				?>
				</li>
                <li><a class="tab2" href="javascript:void(0)"><span>Actions</span></a>
                    <ul class="sub_menu">
                       <!-- <li><a onclick="return activatecontents('active','change');" href="javascript:void(0)">Publish</a></li>
                        <li><a onclick="return activatecontents('deactive','change');" href="javascript:void(0)">Unpublish</a></li>-->
                        <li><a onclick="return activatecontents('asd','del');" href="javascript:void(0)">Trash</a></li>
                        <li class="botCurv"></li>
                    </ul></li>
                <li><a id="linkedit" onclick="editmailcontent();" href="javascript:void(0)"><span>Edit</span></a></li>
            </ul><?php */?>
        </div>
    </div>

</div>
    
<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		  <?php $this->subtabsel="mailtemplatelist";   echo $this->renderElement('emails_submenus');?>
    </div>
</div>     
    
<div class="midCont">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <div>
    <!--<span class="topLft_curv"></span>
    <span class="topRht_curv"></span>-->                
        <div class="gryTop">
        	
            <div class="new_filter">
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));?></span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $resetUrl ?>')" id="locaa"></span>
            
            <div style="float:left">  <?php if($session->check('Message.flash')){ $session->flash();  }?> 
                </div> 
            <div class="clear"></div>
            </span>
        </div>
        </div> 
        <div class="clear"></div>
    </div>

    <div class="tblData table-responsive">
      <?php $i=1; ?>   



    <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="trBg">
    <th align="center" width="1%">#</th>
    <th align="center" width="2%"><input type="checkbox" value="" name="checkall" id="checkall" /></th>
    <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('email_template_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Template Name</th>
    <th align="center" valign="middle" style="width:35%"><span class="right"><?php echo $pagination->sortBy('subject', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Subject</th>
    <th align="center" valign="middle" style="width:10%">Mail Content</th>
    <th align="center" valign="middle" style="width:7%"><span class="right"><?php echo $pagination->sortBy('is_sytem', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Status</th>

      </tr>
        <?php if($emailtemplates){
                           $i=1;
                           $alt=0;
                        foreach($emailtemplates as $eachrow){
                            if($alt%2==0)
                            $class="class='altrow'";
                        else
                            $class="class=''";

                        $alt++;
 
                        $recid = $eachrow['EmailTemplate']['id'];
                        $modelname = "EmailTemplate";
                        $redirectionurl = "mailtemplatelist";
                        $isdelflag = true;
                        $tempname = $eachrow['EmailTemplate']['email_template_name'];
                        if($tempname)   $tempname = AppController::WordLimiter($tempname,41);
                        $tempsubject = $eachrow['EmailTemplate']['subject'];
                        if($tempsubject)        $tempsubject = AppController::WordLimiter($tempsubject,41);
                        $cont1=   '<a href="javascript:void(0)"  title="Click here to view mail template." onclick="showcontentwindow('.$recid.');" ><span>Preview<span></a>';
                        
                        if($eachrow['EmailTemplate']['is_sytem']=='0'){
                                $isdelflag = false;
                        }       
                        
						$typearray = array(0=>'Member',1=>'Player',2=>'Prospects',3=>'Offers');
						$emailtemplatestype = $typearray[$eachrow['EmailTemplate']['email_template_type']] ;
						
                ?>

        <tr <?php echo $class; ?> >
                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></a></span></td>
				
                <td align="left" valign="middle" class='newtblbrd'>
				<?php
				e($html->link(
					$html->tag('span', $tempname?$tempname:"N/A"),
					array('controller'=>'mailtasks','action'=>'addmailtemplate',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="left" valign="middle" class='newtblbrd'>
				<?php
				e($html->link(
					$html->tag('span', $tempsubject?$tempsubject:"N/A"),
					array('controller'=>'mailtasks','action'=>'addmailtemplate',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
                <td align="center" valign="middle"  class='newtblbrd'>
				<?php
				e($html->link(
					$html->tag('span', $cont1),
					array('controller'=>'mailtasks','action'=>'addmailtemplate',$recid),
					array('escape' => false)
					)
				);
				?>
				</td>
              
                <td align="center" valign="middle" class='newtblbrd'>
				
				<?php if($eachrow['EmailTemplate']['active_status']=='1'){ 
					e($html->link(
						$html->image('active.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to deactivate '.$tempname)),
						array('controller'=>'mailtasks','action'=>'changestatus',$recid,$modelname,'0',$redirectionurl,'cngstatus'),
						array('escape' => false)						
					)
				);
			}else{					
				e($html->link(
						$html->image('deactive.gif',array('width'=>'10','height'=>'13','alt'=>'','title'=>'Click here to activate '.$tempname)),
						array('controller'=>'mailtasks','action'=>'changestatus',$recid,$modelname,'1',$redirectionurl,'cngstatus'),
						array('escape' => false)						
					)
				);
			}
		?>
	</td>			
    </tr>
	<?php } ?>	

         <?php }else{ ?>
        <tr><td colspan="7" align="center">No Mail Template Found.</td></tr>
        <?php  } ?>
        </table>
        
        
      </div><!--inner-container ends here-->

    <div>
        <!--<span class="botLft_curv"></span>
        <span class="botRht_curv"></span>-->
        <div class="gryBot">

            <?php echo $this->renderElement('newpagination');  ?>
        </div>

        
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

             
<?php echo $form->end();?>



  <!-- Body Panel ends --> 
<script language='javascript'>
        function showcontentwindow(id){
				var url = baseUrlAdmin+'showcontentwindow/'+id+'/EmailTemplate';          
                jQuery.facebox({ ajax: url });
        }
</script>
    </div>
    
        <div class="clear"></div>
</div>   
