<?php 	$lgrt = $session->read('newsortingby'); 
$base_url = Configure::read('App.base_url');
	$backUrl = $base_url.'contacts/memberlist';
		echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
		echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');		
		echo $html->css('/css/jquery_ui_datepicker');
		echo $html->css('timepicker_plug/css/style');
?>	
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	$('#memBrs').removeClass("butBg");
	$('#memBrs').addClass("butBgSelt");
</script>

<style type="text/css">
	.ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>
<!--container starts here-->


<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2><?php e($titlTxtHeading); ?></h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admin", array("action" => "addmember",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addholder','onsubmit'=>"return validateholders();", 'id' => "addholder")) ?>	
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
                <?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
                <?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')">
                <?php e($html->image('cancle.png')); ?></button>
                <?php echo $this->renderElement('new_slider');?>	
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
<?php /*?><ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')"><span> Cancel</span></button></li>
</ul><?php */?>
</div>
    </div>


</div><!--rightpanel ends here-->



<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php  
		$this->loginarea="admins";    $this->subtabsel="memberlist";
		if(isset($this->params['pass'][0])&&$this->params['pass'][0]=="secondlevel")
		{
			echo $this->renderElement('memberlistsecondlevel_submenus');  
		}  
		else
		{    
			echo $this->renderElement('memberlist_submenus');  
		}
	
	 ?>   
    </div>
</div>




<!--inner-container starts here-->
<div class="midCont">

<div class="">

<div class="">
	
		<div class="top-bar" style="border-left:0px;">
	
	
		</div>
		
		<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->
		
<script type="text/javascript">


	/* <![CDATA[ */
	var dateobj = new Date();
	var currDate  = dateobj.getFullYear();
	$(function() {
		$('#expiry_date').datepicker({
			//showOn: "button",
			//buttonImage: baseUrl+"img/calendar_new.png",
			dateFormat: 'mm-dd-yy',
			changeMonth: true,
			changeYear:true,
			yearRange: '1890:'+ currDate
		});

    $('#next_retest_date').datepicker({
      //showOn: "button",
      //buttonImage: baseUrl+"img/calendar_new.png",
      dateFormat: 'mm-dd-yy',
      changeMonth: true,
      changeYear:true,
      yearRange: '1890:'+ currDate
    });
	});
	/* ]]> */

	
		
	</script>
</div>
<div id="hld">	
	 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
		<table cellspacing="5" cellpadding="0" align="center" >
  <tbody>
 <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash();?></td>
    </tr>
	<?php }?>    
    <tr>
      <td width="25%" align="right"><label class="boldlabel">License Type <span style="color:red">*</span></label></td>
      <td width="20%">
        <span class="intp-Span">
          <?php echo $form->select("ContactLicense.license_type",$license_types,'',array('id' => 'license_type','class' => 'form-control', 'style'=>''),"---Select---"); ?>
        </span></td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>

    <tr>
      <td  align="right"><label class="boldlabel">License # </label></td>
      <td><span class="intp-Span">
          <?php echo $form->text("ContactLicense.license_number", array('id' => 'license_number', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control"));?> </span> </td>
      <td><!--<input type="button" class="calendarcls" id="birthdayBP"> --></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td width="25%" align="right"><label class="boldlabel">Status<span style="color:red">*</span></label></td>
      <td width="20%">
        <span class="intp-Span">
          <?php echo $form->select("ContactLicense.status",$license_status,'',array('id' => 'status','class' => 'form-control', 'style'=>''),"---Select---"); ?>
        </span></td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>

    <tr>
      <td  align="right"><label class="boldlabel">State </label></td>
          <td><span id="statediv"><span class="txtArea_top">
                                <span class="txtArea_bot">
                                    <span id="countrydiv">
          <?php echo $form->select("Holder.state",$statedropdown,$selectedstate,array('id' => 'state','style'=>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;'),"---Select---"); ?></span> </span></span></td>
       <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td  align="right"><label class="boldlabel">Expiry Date </label></td>
      <td><span class="intp-Span">
          <?php echo $form->text("ContactLicense.expiry_date", array('id' => 'expiry_date', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control",'readonly'=>'readonly'));?> </span> </td>
      <td><!--<input type="button" class="calendarcls" id="birthdayBP"> --></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td  align="right"><label class="boldlabel">Fee </label></td>
      <td><span class="intp-Span">
          <?php echo $form->text("ContactLicense.fee", array('id' => 'fee', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control"));?> </span> </td>
      <td><!--<input type="button" class="calendarcls" id="birthdayBP"> --></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td width="25%" align="right"><label class="boldlabel">Paid By <span style="color:red">*</span></label></td>
      <td width="20%">
        <span class="intp-Span">
          <?php echo $form->select("ContactLicense.paid_by",$paid_by,'',array('id' => 'paid_by','class' => 'form-control', 'style'=>''),"---Select---"); ?>
        </span></td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>

    <tr>
      <td width="25%" align="right"><label class="boldlabel">Retesting Type <span style="color:red">*</span></label></td>
      <td width="20%">
        <span class="intp-Span">
          <?php echo $form->select("ContactLicense.retesting_type",$testing_types,'',array('id' => 'retesting_type','class' => 'form-control', 'style'=>''),"---Select---"); ?>
        </span></td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>

    <tr>
      <td width="25%" align="right"><label class="boldlabel">Retest Years <span style="color:red">*</span></label></td>
      <td width="20%">
        <span class="intp-Span">
          <?php echo $form->text("ContactLicense.retest_years", array('id' => 'retest_years', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control"));?>
        </span></td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>

    <tr>
      <td  align="right"><label class="boldlabel">Next Retest Date </label></td>
      <td><span class="intp-Span">
          <?php echo $form->text("ContactLicense.next_retest_date", array('id' => 'next_retest_date', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control",'readonly'=>'readonly'));?> </span> </td>
      <td><!--<input type="button" class="calendarcls" id="birthdayBP"> --></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
			</div></div><div></div><div></div></div>


 
<!--inner-container ends here-->

<?php echo $form->end();?>

  
<div class="clear"></div>

<script language='javascript'>
//getstates('254',"Holder");
</script>
<script language='javascript'>
<?php if((!$this->data['eligible_for_gift']['id'])) { ?>
findgetstates('254',"Holder"); <?php } ?>
</script>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("hld").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
