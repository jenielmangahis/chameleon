<?php 
$lgrt = $session->read('newsortingby');
//$coinHolder = $this->params['pass'][0];
$base_url_admin = Configure::read('App.base_url_admin');

?>   
  
<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>


 <?php //$pagination->setPaging($paging); ?> 
<div class="container">    
    <div class="titlCont">
        <div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel" style="height: 20px;">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
           
		   <?php 
               // echo $form->create("Admins", array("action" => "memberpoints/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'memberpoints', 'id' => "memberpoints"));
            ?>


            <span class="titlTxt">InActive Links List </span>

            <div class="topTabs">
             <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>
                </ul>   
            </div>


                        <?php   
						$this->loginarea="admins";   
						$this->subtabsel="memberpoints";
                          
	
	if($this->loginarea){
	?>
           <div class="clear">

			<?php
			e($html->image('spacer.gif',array('width'=>'1','height'=>'12px')));
			?>
		</div>
            <div style="height: 30px; clear:both; float:left;">
                <div id="tab-container-1">
                     <ul id="tab-container-1-nav" class="topTabs2">
                        <li>
							<?php
								if($this->params['action'] == 'active_link') {
									e($html->link(
									$html->tag('span', 'Active'),
									array('controller'=>$this->loginarea,'action'=>'active_link',$recordid),
										array('class'=>'tabSelt','escape' => false )
									)
								);
								}else{
								e($html->link(
									$html->tag('span', 'Active'),
									array('controller'=>$this->loginarea,'action'=>'active_link',$recordid),
										array('escape' => false )
									)
								);
								
								}
							?>
						</li>
                       
                        <li>
							<?php
							if($this->params['action'] == 'inactive_link') {
									e($html->link(
									$html->tag('span', 'InActive'),
									array('controller'=>$this->loginarea,'action'=>'inactive_link',$recordid),
									array('class'=>'tabSelt','escape' => false )
									)
								);
								}
								else{
								
									e($html->link(
									$html->tag('span', 'InActive'),
									array('controller'=>$this->loginarea,'action'=>'inactive_link',$recordid),
									array('escape' => false )
									)
								);
								}
							?>		
						</li> 
                        
                        <li>
							<?php
							
							if($this->params['action'] == 'placement') {
								e($html->link(
									$html->tag('span', 'Placement'),
									array('controller'=>$this->loginarea,'action'=>'placement',$recordid),
									array('class'=>'tabSelt','escape' => false )
									));
								}else{
								
									e($html->link(
									$html->tag('span', 'Placement'),
									array('controller'=>$this->loginarea,'action'=>'placement',$recordid),
									array('escape' => false )
									));
								
								}
								
								
							?>	

						</li> 
						      
						    <li>
							<?php
							if($this->params['action'] == 'history') {
									e($html->link(
									$html->tag('span', 'History'),
									array('controller'=>$this->loginarea,'action'=>'history',$recordid),
									array('class'=>'tabSelt','escape' => false )
									)
								);
								}else{
								
									e($html->link(
									$html->tag('span', 'History'),
									array('controller'=>$this->loginarea,'action'=>'history',$recordid),
									array('escape' => false )
									)
								);
								
								}
							?>
						</li>
					
                   </ul>
                </div>
            </div>  
            <div class="clear"></div>
<?php }?>
					
                  

        </div>
    </div>


  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
    <div>
        <span class="topLft_curv"></span><span class="topRht_curv"></span>
        <div class="gryTop">
		<div class="new_filter">
             <span class="spnFilt">Filter:</span><span class="srchBg">
                    <?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span>
                    <span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => ''));   ?>  
            </span>
            <span class="srchBg2">
                <input type="button" value="Reset" label="" onclick="javascript:(window.location='<?php echo $base_url_admin ?>memberpoints/')" id="locaa">&nbsp;&nbsp;  

            </span>
            
		</div>
        </div>
        <div class="clear"></div></div>
    <div class="tblData">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="trBg">
                <th align="center" valign="middle" style="width:3%">#</th>
              <!--  <th align="center" valign="middle" style="width:10px"><input type="checkbox" value="" name="checkall" id="checkall" /></th>-->
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>End Date</th>
				
				
				
                <th align="center" valign="middle" style="width:25%"><span class="right"><?php echo $pagination->sortBy('Point_Name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Link Address</th>
				
				
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('is_level', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Link Name</th>
				
				
				
				
                <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('points', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Redirect</th>
				
				
				 <th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('point_level', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' '); ?></span>Link Visual Text</th>
				 
				
				
				
				<th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Recur Type</th>
				
				
				<th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Placement</th>
				
				
				<th align="center" valign="middle" style="width:15%"><span class="right"><?php echo $pagination->sortBy('created', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Status</th>
				
				
				
				
               
               
            </tr>
            <?php $i=1;?>
            <?php if($linkDate){
                    $created="";     $i=1;         
                    foreach($linkDate as $linkdata){
					
					
					   	$linkId = $linkdata['Link']['id'];
						 
                         if($i%2 == 0 ){
                                $cls="altrow";        
                            } else{
                                $cls=""; 
                            }       
                         
                    ?>
                     <tr class='<?php echo $cls; ?>'>    
                            <td align="center" class='newtblbrd'><span style='color:#4d4d4d;'><?php echo $i++;?></span></td>
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo $linkdata['Link']['end_date'] ; ?></span></td>
							
                            <td align="left" valign="middle" class='newtblbrd'><span><?php echo   $linkdata['Link']['links_address'] ; ?></span></td>
							
							  <td align="left" valign="middle" class='newtblbrd'><span><?php echo $linkdata['Link']['links_name'] ; ?></span></td>
							  
							    <td align="left" valign="middle" class='newtblbrd'><span><?php echo$linkdata['Link']['redirect'] ;  ?></span></td>
								
								  <td align="left" valign="middle" class='newtblbrd'><span><?php echo $linkdata['Link']['link_visule_text'] ; ?></span></td>
								   
									 <td align="left" valign="middle" class='newtblbrd'><span><?php echo $linkdata['Link']['recur_type'] ; ?></span></td>
									  <td align="left" valign="middle" class='newtblbrd'><span><?php echo $linkdata['Link']['placement'] ; ?></span></td>
									   <td align="left" valign="middle" class='newtblbrd'><span><?php echo "InActive" ; ?></span></td>
									  
                          </tr>
             <?php } ?>    
          <?php }else{ ?>
                     <tr><td colspan="6" align="center">No points found.</td></tr>
                <?php  } ?>

        </table>
    </div>
	
    <div>
    <span class="botLft_curv"></span>
	<span class="botRht_curv"></span>
	
    <div class="gryBot"><div id="pagination">
<!-- Items per page: -->
<table width="100%" border="0"><tbody><tr><td style="width:25%;border-left:0px;border-right:0px;border-bottom:0px;height:25px;">
&nbsp;&nbsp;

Display #
<select class="slct50" onchange="setURL('show', this.value)">
 
 <option selected="" value="20">20</option>

 
 <option value="50">50</option>

 
 <option value="100">100</option>

 
 <option value="500">500</option>

</select>
 </td>
<td style="text-align:right;width:25%; border-left:0px;border-right:0px;border-bottom:0px;"> <table width="100%" border="0"><tbody><tr><td style="border-left:0px;border-right:0px;border-bottom:0px;">&nbsp;</td><td align="right" style="border-left:0px;border-right:0px;border-bottom:0px;"><a href="/gocitiescms/admins/eventlist?sortBy=starttime">First | </a>Previous | Next </td></tr></tbody></table> </td>
</tr>
</tbody></table>

</div>        </div>
    <div class="clear"></div>

    </div>
<!--inner-container ends here-->
  </div>   


    <div class="clear"></div>
 </div>      