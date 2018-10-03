<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
<?php
   echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
   echo $html->css('/css/jquery_ui_datepicker');
   echo $html->css('timepicker_plug/css/style');
?>
<script type="text/javascript">
            /* <![CDATA[ */
            var dateobj = new Date();
            var currDate  = dateobj.getFullYear();
            $(function() {
                $('#birthday').datepicker({
                    showOn: "button",
                    buttonImage: baseUrl+"img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true,
                    yearRange: '1890:'+ currDate
                });
            });
            /* ]]> */
        </script>
<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/donationupload';
?>
<?php 
$actionRedirect ="adddonationsuploade";
if($redirect!='')
{
	$actionRedirect ="adddonationsuploade/".$redirect;
}

     ?>
<div class="container">
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
                <h2>Donation Upload Add</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("admins", array("action" =>$actionRedirect, 'id' => "adddonationsuploade", 'class' => 'adduser','enctype' => 'multipart/form-data'));
					?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
					<?php e($html->image('save.png', array('alt' => 'Save'))); ?>
					</button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')">
					<?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?>
					</button>
					<?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
        </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="links";    $this->subtabsel="activelinklist";
            echo $this->renderElement('donation_submenus');  ?>
            <div class="clear"></div>
            <?php $this->mail_tasks="tabSelt"; ?>  
    </div>
</div> 

<div class="midPadd clearfix" id="addcmp">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<br />
<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="100%">
<tbody>
  <tr>
    <td width="50%" valign="top"><table cellspacing="10" cellpadding="0" align="left" width="100%">
        <tbody>

          <?php echo $form->hidden("Donationupload.status", array('id' => 'status','value'=>"1")); ?>
          <tr>
            <td align="right"><label class="boldlabel">Donation Uploade Name<span
									style="color: red;">*</span> </label></td>
            <td><span class="intp-Span" style="vertical-align: top"> 
			
			<?php echo $form->input("Donationupload.name", array('id' => 'name', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));?> </span> </td>
          </tr>
          
          <tr>
            <td align="right"><label class="boldlabel">Donation File Name<span
									style="color: red;">*</span> </label></td>
            <td><span class="intp-Span" style="vertical-align: top"> 
			<?php //echo $form->file('filename'); ?>
			<?php echo $form->input("Donationupload.filename", array('id' => 'filename', 'type'=>'file', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));?> </span> </td>
          </tr>
          <tr>
            <td align="right"><label class="boldlabel">Related Event<span
									style="color: red;">*</span> </label></td>
            <td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Donationupload.relatedevent", array('id' => 'relatedevent', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));?> </span> </td>
          </tr>
        </tbody>
      </table>
      <div class="clear"></div>
</div>
