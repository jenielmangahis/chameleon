<script type="text/javascript">
	$(document).ready(function() {
		$('#prosMnu').removeClass("butBg");
		$('#prosMnu').addClass("butBgSelt");
	}); 
 
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
    
    
    
    
</script>
<?php $pagination->setPaging($paging); ?> 
<!-- Body Panel starts -->
<div class="container">
         <div class="titlCont">
		  <div class="centerPage" >
         
			<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			

 
            <?php echo $form->create("prospects", array("url" => "historylist/$cid/$params",'name' => 'history', 'id' => "history")); ?>
 <?php  echo $this->renderElement('new_slider');  ?>		
</div>     

            <span class="titlTxt1"><?php //echo $current_company_name  ?>&nbsp;</span>
            <span class="titlTxt"> History List</span>
            <?php    $this->loginarea="prospects";    $this->subtabsel='historylist';
                             echo $this->renderElement('prospect_vendor_submenu');  ?>   
                            
        </div></div>
<div class="midCont" id="cmplisttab">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <!-- top curv image starts -->
        <div>
            <span class="topLft_curv"></span>
            <span class="topRht_curv"></span>
            <div class="gryTop">
            <div class="new_filter">   
                <span class="spnFilt">Filter:</span>
                <span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
				<?php echo $form->hidden("company_id", array('id' => 'company_id' , 'value' => "$cid"));?>
                <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '')); ?>      </span>
                </div>	
                </div>
            <div class="clear"></div>
			</div>
        <?php $i=1; ?>			
        <div class="tblData">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="trBg">
                    <th align="center" valign="middle" style='width:1%;'>#</th>
                    <th align="center" valign="middle" style='width:2%;'><input type="checkbox" value="" name="checkall" id="checkall" /></th>
                    <th align="center" valign="middle" style='width:10%;'><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Date</th>
                    <th align="center" valign="middle" style='width:10%;'><span class="right"><?php echo $pagination->sortBy('type', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Type</th>
					<th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('subject',$html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Name - Subject</th>					
                    <th align="center" valign="middle" style='width:15%;'><span class="right"><?php echo $pagination->sortBy('author', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Author</th>
                    <th align="center" valign="middle" style='width:47%;'><span class="right"><?php echo $pagination->sortBy('note', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Note</th>
                </tr>
               <?php
                 if($taskdata){
                        $i=1;
                        foreach($taskdata as $eachrow){					
						    $recid = $eachrow['CommunicationTaskHistory']['id'];
                            $redirectionurl = "historylist";
                            $subject = $eachrow['CommunicationTaskHistory']['subject'];
                            $author ='';
                           if($eachrow['CommunicationTaskHistory']['type'] =="notes" || empty($eachrow['CommunicationTaskHistory']['type'])  ){
								$type = 'Notes';
							}else {
								$type = 'Send Mail';
							}
                            $note = $eachrow['CommunicationTaskHistory']['note'];
                            if($note)	$note = AppController::WordLimiter($note,27);
                            $adddate = $eachrow['CommunicationTaskHistory']['date'];
                 ?>

                        <tr <?php echo ($i%2 == 0)? 'class="altrow"':'';?> >
                                <td align="center" class='newtblbrd'><span style="color:#4d4d4d;"><?php echo $i++;?></span></td>
                                <td align="center" class='newtblbrd'><a><span><input type="checkbox"  class="checkid" name="checkid[]" value="<?php echo $recid; ?>" /></span></a></td>
                                <td align="center" valign="middle" class='newtblbrd'>
									<?php
									e($html->tag('span', date('m-d-Y', strtotime($adddate)))
									);
							?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>
									
							<?php
									e($html->tag('span', $type));
							?>
							</td>
							
							 <td align="left" valign="middle" class='newtblbrd'>
									
							<?php
									e($html->tag('span', $subject) );
							?>
							</td>
                             
                            <td align="left" valign="middle" class='newtblbrd'>

							<?php
									e($html->tag('span',  $author));
							?>
							</td>
							
							<td align="left" valign="middle" class='newtblbrd'>

							<?php
									e($html->tag('span',  $note)
								);
							?>
								</td>
                            </tr>
                        <?php } }else{ ?>
                    <tr><td colspan="7" align="center">No Histories Found.</td></tr>
                    <?php } ?>
            </table> 
        </div>
        <div>
            <span class="botLft_curv"></span>
            <span class="botRht_curv"></span>
            <div class="gryBot"><?php //if($taskdata) { 
			echo $this->renderElement('newpagination'); //} ?>
            </div>
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->
        <?php echo $form->end();?>
</div>  
 <div class="clear"></div>    
</div> 