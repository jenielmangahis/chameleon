<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
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

function editcontent()
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
                document.getElementById("linkedit").href=baseUrl+"relationships/addcorrespondent/"+id; 
                
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
                                        window.location="../relationships/correspondent_delete/"+id ;
                                        }
                        }else{
                                alert('Please atleast one record should be select'); 
                                return false;
                        }
                }
</script>



<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container clearfix">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-3">
            	<h2>Correspondents List</h2>
            </div>
            <div class="slider-dashboard col-sm-9">
            	<div class="icon-big-container">
                	<?php echo $form->create("Relationship", array("action" => "correspondents",'name' => 'correspondents', 'id' => "correspondents")) ?>
					<script type='text/javascript'>
                            function setprojectid(projectid){
                                            document.getElementById('projectid').value= projectid;
                                            document.adminhome.submit();
                                    }
                    </script>
                    
                    <?php
                    $ids = $this->params['pass'][0]; 
                    e($html->link($html->image('call.png') . ' ' . __(''), array('controller'=>'admins','action'=>'call',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('email.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendtempmail',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('sms.png') . ' ' . __(''), array('controller'=>'admins','action'=>'sendsms','1'),array('escape' => false)));
                    
                    
                    e($html->link($html->image('message.png') . ' ' . __(''), array('controller'=>'admins','action'=>'messagenew',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('event.png') . ' ' . __(''), array('controller'=>'admins','action'=>'appointment',$ids),array('escape' => false)));
                    
                    e($html->link($html->image('note.png') . ' ' . __(''), "../players/notelist/2",array('escape' => false)));
                    
                    e($html->link($html->image('take.png') . ' ' . __(''), array('controller'=>'admins','action'=>'coming_soon','task'),array('escape' => false)));
                    e($html->link($html->image('new.png') . ' ',  array('controller'=>'relationships','action'=>'addcorrespondent'),array('escape' => false)));?>
                    <a href="javascript:void(0)" onclick="editcontent();" id="linkedit">
                    <?php e($html->image('edit.png')) ?></a>                    
                </div>
                <?php echo $this->renderElement('new_slider');?>
            </div>
            <!--<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			
            </div>
            <span class="titlTxt"> Correspondents List </span>-->
            <div class="topTabs" style="height:25px;">
<?php /*?><ul class="dropdown">
<li>
<?php
  e($html->link(
    $html->tag('span', 'New'),
    array('controller'=>'relationships','action'=>'addcorrespondent'),
    array('escape' => false)
    )
  );
?>

</li>
<!--
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
                        </ul>
</li>-->
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul><?php */?>
</div>
        </div>
    
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="relationships";    $this->subtabsel="correspondents";
             echo $this->renderElement('relationships_submenus');  ?>   
    </div>
</div>

<div class="midCont" id="newcmmtasktab">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
          <div class="msgBoxBg">
            <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
              <?php  $session->flash();    ?> 
            </div>
                  <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
    </div>
</div>
                                            <?php } ?>

                            <!-- top curv image starts -->
                            <div>
                            <!--<span class="topLft_curv"></span>
                            <span class="topRht_curv"></span>-->
                
                <div class="gryTop">
                <div class="new_filter" >
                <span class="spnFilt">Filter:</span><span class="srchBg"><?php echo $form->input("searchkey", array('id' => 'searchkey', 'div' => false, 'label' => '',"maxlength" => "200"));?></span><span class="srchBg2"><?php echo $form->submit("Go", array('id' => 'searchkeysubmit', 'div' => false, 'label' => '','class'=>'btn'));
                        ?> 
                </span>
                <span class="srchBg2"><input type="button" value="Reset" label="" onclick="javascript:(window.location=baseUrl+'relationships/correspondents')" id="locaa"></span>
                
                        </div> </div>
                        <div class="clear"></div></div>


<div class="tblData">
                      <table class="table table-bordered table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="trBg">
      <th style="width:1%" align="center" valign="middle">#</th>
      <th  style="width:2%" align="center" valign="middle"><input type="checkbox" id="checkall" name="checkall" value=""></th>
      
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Company Name</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('state', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>ST</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('city', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>City</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('address1', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Address1</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('address2', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>Address2</th>
      <th align="center" valign="middle"><span class="right"><?php echo $pagination->sortBy('company_name', $html->image('sorting_arow.png',array('width'=>'10','height'=>'13','alt'=>'')),null,null,' ',' ');?></span>#Agents</th>

      
      
      </tr>
    <?php if($companydata){ 
      $i=1;
      // Start of Record no, custmization
        $pagerL = Configure::read('Pagging.limit');  
      if(isset($this->params['url']['page']) && $this->params['url']['page'] > 1 ) {
      $i= $i+($pagerL*($this->params['url']['page']-1));
      }
      // End
      
        foreach($companydata as $eachrow){ //echo "<pre>";print_r( $eachrow);die(); 
      	$companyID=$eachrow['Company']['id'];
        $recid = $eachrow['Company']['id'];
        $modelname = "Contact";
        $redirectionurl = "sa_contactlist";
        $fname = $eachrow['Contact']['firstname'];
      if($fname) $fname = AppController::WordLimiter($fname,15);
        $lname = $eachrow['Contact']['lastname'];
      if($lname) $lname = AppController::WordLimiter($lname,15);
        
        $companyname = $eachrow['Company']['company_name'];
      if($companyname) $companyname = AppController::WordLimiter($companyname,33);  

      $companytype = $common->getCompanyTypeName($eachrow['Company']['company_type_id']);

      $companytypename = $companytype[0]['CompanyType']['company_type_name'];
      if($companytypename) $companytypename = AppController::WordLimiter($companytypename,33);  

      $contacttype = $eachrow['ContactType']['contact_type_name'];
        
        $email = $eachrow['Contact']['email'];
      if($email) $email = AppController::WordLimiter($email,33);        
      $mobile = $eachrow['Contact']['mobile'];
        $type = "Contact";
        if(isset($eachrow['CompanyType']))
        {
          $type = "Company";
        }

        $state = $eachrow['Company']['state'];
        $city = $eachrow['Company']['city'];
        $Address1 = $eachrow['Company']['address1'];
        $Address2 = $eachrow['Company']['address2'];
        $phone = $eachrow['Company']['phone'];
         $agents = 0;
		 if( $state!=''&&is_numeric( $state))
        {
           $state = $common->getStateName($state);
        } 
         if( $city!=''&&is_numeric($city))
        {
           $city = $common->getCityName($city);
        } 
      ?>

<?php if($i%2 == 0) { ?>  

<tr class='altrow'> <td align="center" class='newtblbrd' valign="middle"><?php echo $i++ ?></td><td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
     <td align="left" class='newtblbrd' valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $companyname==''?"N/A":$companyname),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>

     <td align="left" class='newtblbrd' valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $state==''?"N/A":$state),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>

     <td align="left" class='newtblbrd' valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $city==''?"N/A":$city),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
     <td align="left" class='newtblbrd' valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $Address1==''?"N/A":$Address1),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
     <td align="left" class='newtblbrd' valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $Address2==''?"N/A":$Address2),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
     <td align="left" class='newtblbrd' valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $agents),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
  
    </tr>
<?php } else { ?>

    <tr>
      <td align="center" valign="middle"><?php echo $i++ ?></td>
      <td align="left" valign="middle"><input type="checkbox" value="<?php echo $recid; ?>" name="checkid[]" class="checkid"></td>
    
     <td align="left" valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $companyname==''?"N/A":$companyname),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>

     <td align="left" valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $state==''?"N/A":$state),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>

     <td align="left" valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $city==''?"N/A":$city),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
     <td align="left" valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $Address1==''?"N/A":$Address1),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
     <td align="left" valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $Address2==''?"N/A":$Address2),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
     <td align="left" valign="middle">
      
      <?php
        e($html->link(
          $html->tag('span', $agents),
          array('controller'=>'relationships','action'=>'addcorrespondent',$recid,$companyID),
          array('escape' => false)
          )
        );
      ?>

    </td>
  
    </tr>
<?php } ?>  


  <?php } }else{ ?>
  <tr><td colspan="7" align="center">No Customer Found.</td></tr>
  <?php } ?>
  </table>
  </table>
        
</div><!--inner-container ends here-->

      <div>
      <!--<span class="botLft_curv"></span>
      <span class="botRht_curv"></span>-->
      <div class="gryBot"><?php  echo $this->renderElement('newpagination');  ?>
      </div>
      
      <div class="clear"></div>
      </div>
      <?php echo $form->end();?>




<div class="clear"></div>
    </div>
    
         <div class="clear"></div>
</div>      
    
<script type="text/javascript">
  if(document.getElementById("flashMessage")!=null)
  {   
  document.getElementById("newcmmtasktab").className = "newmidCont";
  } 
</script>