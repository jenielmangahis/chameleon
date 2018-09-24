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
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
            	<h2>Enter Donations</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("admins", array("action" =>$actionRedirect,'name' => 'adddonations', 'id' => "adddonations", 'class' => 'adduser')); ?>
                    <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
                    <?php e($html->image('save.png', array('alt' => 'Save'))); ?>
                    </button>
                    <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')">
                    <?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?>
                    </button>
                    <?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
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
        </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont">
	   <?php    $this->loginarea="links";    $this->subtabsel="activelinklist";
            echo $this->renderElement('donation_submenus');  ?>
        <div class="clear"></div>
        <?php $this->mail_tasks="tabSelt"; ?>
    </div>
</div>


<div class="midCont clearfix" id="addcmp">
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<br />
<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
    <div class="frmbox">
        <table class="table table-borderless" cellspacing="0" cellpadding="0" width="100%">
            <tbody>
                <tr>
                    <td width="50%" valign="top">
                        <table cellspacing="10" cellpadding="0" align="left" width="100%">
                            <tbody>
                            
                            <tr>
                            <input type="hidden" id="current_domain" name="Donation.status" value="1">
                            <td align="right"><label class="boldlabel">Donation Source<span
                                        style="color: red;">*</span> </label></td>
                            <td><?php 
                            $options=array('Individual'=>'Individual','Company'=>'Company');
                            $attributes=array('legend'=>false,'class'=>'donationsource','readonly'=>'true');
                            echo $form->radio('Donation.donationsource',$options,$attributes);
                            ?>
                            <?php 	//echo $form->input("Donation.donationsource", array('id' => 'donationsource', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt-txt-fld form-control"));?>
                            </td>
                            </tr>
                            <tr>
                            <td align="right"><label class="boldlabel">Donator Name<span
                                        style="color: red;">*</span> </label></td>
                            <td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Donation.donationname", array('id' => 'donationname', 'div' => false, 'label' => '','style' =>'',"class" => "inpt-txt-fld form-control"));?> </span> </td>
                            </tr>
                            <tr>
                            <td width="37%" align="right"><label class="boldlabel"> Donator Company <span class="red">*</span></label></td>
                            <td width="30%"><label for="project_name"></label>
                            <span class="txtArea-top"><span class="txtArea-bot">
                            <?php 
                            
                            //	echo $form->select("Contact.company_id",$selectedcompany,$selectedcompany,array('id' => 'company_id','class'=>'multi-list form-control',"onchange"=>"getcompanyaddress(this.value);"),"---Select---"); 
                            
                            
                            
                            ?>
                            <select onchange="getcompanyaddress(this.value);" class="multi-list form-control" id="company_id" name="data[Donation][donatorcompany]">
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
                            
                            </tr>
                            <tr id="row_startdate">
                            <td width="37%" align="right"><label class="boldlabel"> Donator Date<span class="red">*</span></label></td>
                            <td><span class="intp-Span middle"><?php echo $form->text("Donation.created", array('id' => 'birthday', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly'));?> </span></td>
                            </tr>
                            <tr>
                            <td align="right"><label class="boldlabel">Donation Type<span
                                        style="color: red;">*</span> </label></td>
                            <td><span class="txtArea-top"><span class="txtArea-bot">
                            <select class="multi-list form-control" id="company_id" name="data[Donation][donationtype]">
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
                            <td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Donation.donationammount", array('id' => 'donationammount', 'div' => false, 'label' => '','style' =>'width:100%;',"class" => "inpt-txt-fld form-control"));?> </span> </td>
                            </tr>
                            <tr>
                            <td align="right"><label class="boldlabel">Related Event<span
                                        style="color: red;">*</span> </label></td>
                            <td><span class="intp-Span" style="vertical-align: top"> <?php echo $form->input("Donation.relatedevent", array('id' => 'relatedevent', 'div' => false, 'label' => '','style' =>'width:100%;',"class" => "inpt-txt-fld form-control"));?> </span> </td>
                            </tr>
                            </tbody>
                        </table>            
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
      <div class="clear"></div>
</div>
