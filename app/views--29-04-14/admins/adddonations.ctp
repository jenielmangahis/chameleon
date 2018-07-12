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
$backUrl = $base_url.'admins/donation';
?>
<?php 
$actionRedirect ="adddonations";
if($redirect!='')
{
	$actionRedirect ="adddonations/".$redirect;
}

     ?>
<div class="container">
<div class="titlCont">
  <div class="myclass">
    <div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;"> <?php echo $form->create("admins", array("action" =>$actionRedirect,'name' => 'adddonations', 'id' => "adddonations", 'class' => 'adduser'));
?>
      <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
      <?php e($html->image('save.png', array('alt' => 'Save'))); ?>
      </button>
      <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')">
      <?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?>
      </button>
      <?php  echo $this->renderElement('new_slider');  ?>
    </div>
    <span class="titlTxt">Enter Donations</span>
    <div class="topTabs" style="height:25px;">
      <?php /*?><ul class="dropdown">
<li>
<button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"> <span> Save </span>	</button>
</li>
<li>
<button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span>
</button>
</li>

</ul><?php */?>
    </div>
    <?php    $this->loginarea="links";    $this->subtabsel="activelinklist";
            echo $this->renderElement('donation_submenus');  ?>
    <div class="clear"></div>
    <?php $this->mail_tasks="tabSelt"; ?>
  </div>
</div>
<div class="midPadd" id="addcmp">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<br />
<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="100%">
<tbody>
  <tr>
    <td width="50%" valign="top"><table cellspacing="10" cellpadding="0" align="left" width="100%">
        <tbody>
          <?php /*?><tr>
	<td align="right">
		<input type="hidden" id="current_domain" name="current_domain" value="">
		<?php 
		 echo $form->input("Donation.project_id", array('id' => 'project_id','type'=>'hidden','value'=>'1',  'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));
		
		
		echo $form->input("Link.project_id", array('id' => 'project_id', 'type'=>'hidden', 'value'=>'1' ,'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
		
		<label class="boldlabel">Type 
		</label>
	</td>
	<td>
	<span class="intpSpan"><?php echo $form->input("DonationType.type", array('id' => 'type', 'div' => false, 'label' => '','style' =>'width:200px;',"class"=>"inpt_txt_fld","maxlength" => "250"));?>
	</span>
	</td>
</tr><?php */?>
          <tr>
            <input type="hidden" id="current_domain" name="Donation.status" value="1">
            <td align="right"><label class="boldlabel">Donation Source<span
									style="color: red;">*</span> </label></td>
            <td><?php 
						$options=array('Individual'=>'Individual','Company'=>'Company');
						$attributes=array('legend'=>false,'class'=>'donationsource','readonly'=>'true');
						echo $form->radio('Donation.donationsource',$options,$attributes);
						?>
              <?php 	//echo $form->input("Donation.donationsource", array('id' => 'donationsource', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?>
            </td>
          </tr>
          <tr>
            <td align="right"><label class="boldlabel">Donator Name<span
									style="color: red;">*</span> </label></td>
            <td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("Donation.donationname", array('id' => 'donationname', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?> </span> </td>
          </tr>
          <tr>
            <td width="37%" align="right"><label class="boldlabel"> Donator Company <span class="red">*</span></label></td>
            <td width="30%"><label for="project_name"></label>
              <span class="txtArea_top"><span class="txtArea_bot">
              <?php 
			
		//	echo $form->select("Contact.company_id",$selectedcompany,$selectedcompany,array('id' => 'company_id','class'=>'multilist',"onchange"=>"getcompanyaddress(this.value);"),"---Select---"); 
			
			
					 
			  ?>
              <select onchange="getcompanyaddress(this.value);" class="multilist" id="company_id" name="data[Donation][donatorcompany]">
                <option value="">---Select---</option>
                <?php

foreach($selectedcompany as $c_name){
?>
                <option value="<?php echo $c_name['Company']['company_name']; ?>"><?php echo $c_name['Company']['company_name']; ?></option>
                <?php
}
?>
              </select>
              </span></span> </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr id="row_startdate">
            <td width="37%" align="right"><label class="boldlabel"> Donator Date<span class="red">*</span></label></td>
            <td><span class="intpSpan middle"><?php echo $form->text("Donation.created", array('id' => 'birthday', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?> </span></td>
          </tr>
          <tr>
            <td align="right"><label class="boldlabel">Donation Type<span
									style="color: red;">*</span> </label></td>
            <td><span class="txtArea_top"><span class="txtArea_bot">
              <select class="multilist" id="company_id" name="data[Donation][donationtype]">
                <option value="">---Select---</option>
                <?php

foreach($selectedtype as $t_name){
?>
                <option value="<?php echo $t_name['DonationType']['type']; ?>"><?php echo $t_name['DonationType']['type']; ?></option>
                <?php
}
?>
              </select>
              </span> </span> </td>
          </tr>
          <tr>
            <td align="right"><label class="boldlabel">Donation Amount<span
									style="color: red;">*</span> </label></td>
            <td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("Donation.donationammount", array('id' => 'donationammount', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?> </span> </td>
          </tr>
          <tr>
            <td align="right"><label class="boldlabel">Related Event<span
									style="color: red;">*</span> </label></td>
            <td><span class="intpSpan" style="vertical-align: top"> <?php echo $form->input("Donation.relatedevent", array('id' => 'relatedevent', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld"));?> </span> </td>
          </tr>
        </tbody>
      </table>
      <div class="clear"></div>
</div>
