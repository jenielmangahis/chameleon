
<script type="text/javascript">
$(document).ready(function() {
$('#LinkMnu').removeClass("butBg");
$('#LinkMnu').addClass("butBgSelt");
}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/userslist';
?>


<div class="container"> 
	<div class="titlCont">
		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">				
                <h2>Add User</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("admin", array("action" => "add_newuser",'name' => 'Admin', 'id' => "Admin", 'class' => 'adduser')); ?>	
                    <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"> <?php e($html->image('save.png')); ?>	</button>
                    <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?>
                    </button>	
                    <?php  echo $this->renderElement('new_slider');  ?>			
                </div>
            </div>
        </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php $this->mail_tasks="tabSelt"; ?> 
		<?php    $this->loginarea="setups";    $this->subtabsel="userslist";
        echo $this->renderElement('setup_submenus');  ?>   
    </div>
</div>


<div class="midCont clearfix" id="addcmp">

<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          

<br />

<div id="loading" style="display: none;"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></div>
<div id="addcomm">
<table cellspacing="0" cellpadding="0" align="left" width="90%">
	<tbody>
		<tr>
			<td width="50%" valign="top">
				<table cellspacing="10" cellpadding="0" align="left" width="100%">
					<tbody>
	

<tr> 
	<td align="right"><label class="boldlabel">User Type<span
									style="color: red;">*</span>
							</label></td>
							<td><span class="txtArea-top"> <span class="txtArea-bot"> <?php 
			echo $form->select("user_type",$formtypedata,$formtypedata,array('id' => 'user_type','class'=>'multi-list form-control'),array('0'=>'--Select--')); ?>
								</span>
							</span></td>
						</tr>

	<tr>
		<td align="right">
			<label class="boldlabel">First Name<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intp-Span">
					<?php echo $form->input("firstname", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
	<tr>
		<td align="right">
			<label class="boldlabel">Last Name<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intp-Span">
					<?php echo $form->input("lastname", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
	<tr>
		<td align="right">
			<label class="boldlabel">User Name<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intp-Span">
					<?php echo $form->input("username", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>


<tr>
		<td align="right">
			<label class="boldlabel">Email Address<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intp-Span">
					<?php echo $form->input("email", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
<tr>
		<td align="right">
			<label class="boldlabel">Password<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intp-Span">
					<?php echo $form->input("password", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	

<tr>
		<td align="right">
			<label class="boldlabel">Phone Number<span style="color: red;">*</span></label>
		</td>
		<td>
			<span class="intp-Span">
					<?php echo $form->input("phone", array('div' => false, 'label' => '','style' =>'width:100%;',"class"=>"inpt-txt-fld form-control","maxlength" => "250"));?>
			</span>
		</td>	
	</tr>
	
</tbody>
</table>
	</tbody>
</table>
<div class="clear"></div>
</div>
