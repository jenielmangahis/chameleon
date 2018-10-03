<script type="text/javascript">
$(document).ready(function() {
$('#prosMnu').removeClass("butBg");
$('#prosMnu').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'prospects/prospectlist/'.$params;
?>

<script type="text/javascript" >
	var viewotherid =0;
	$('.otherlocationclass').live('click', function(){
			viewotherid = $(this).attr('id');
			$(this).parent().find('tr.otherlocationclass').css({'background':'#EBEBEB', 'color':'#000'});
			$(this).css({'background':'#3399FF', 'color':'#FFF'});
	});
	
var h=screen.height;
var w=screen.width;
 /**
         * Funtion addnew email template in pop-up
         */
		 var resWindow1 = null;var cid,pid;
function viewEmailTempforRSVP() {   
		 			 cid = $('#contact_id').val();	
					 pid = $('#projectid').val();
					$('#addmerchant').focus();
             resWindow1=  window.open (baseUrl+'players/addcontacts/'+cid+'/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
             resWindow1.focus();
           }
		   
		   //$(resWindow1).focus(function() {
		   $(resWindow1).live('unload', function() {

			//if(resWindow1!=null && resWindow1.closed){
				resWindow1=null; 
					$.ajax({
						type: "GET",
						url: baseUrl+'prospects/getlatestcontactbypros/'+pid,
						complete: function(response){
						$('#contact_id').html(response.responseText); 				
						}
				});
			//}
			
		 });
function addnewcontact(){
	 resWindow1=  window.open (baseUrl+'players/addcontacts/popup/event', 'AddTemp','location=1,status=1,scrollbars=1, width='+w+',height='+h);
}
</script>

   <!-- Body Panel starts -->
<div class="container">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
            	<?php  $titletext = ($usertype==trim("admin"))?$this->renderElement('project_name'):'';  
					echo $titletext;
				?> 
            	<h2>
                	<?php 
			
						if($this->data['Company']['id']){
							$act = 'edit';
							echo "Edit ". $params." Detail"; 
						}else{
			
							$act = 'add';
							echo "Add New ".$params;
						}	
					?>
                </h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("prospects", array("action" => "addprospect",'type' => 'file','enctype'=>'multipart/form-data','name' => 'addprospect', 'id' => "addprospect","onsubmit"=>"return validateaddventorcompany('$act');"));
					echo $form->hidden("Company.id", array('id' => 'companyid'));
					echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
					echo $form->hidden("projectid", array('id' => 'projectid','value'=>"$project_id"));
					echo $form->hidden("params", array('id' => 'params','value'=>"$params"));
					
					?>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><?php e($html->image('cancle.png')); ?></button>
					<?php  echo $this->renderElement('new_slider');  ?>
                </div>
            </div>
        </div>

	   
</div>
<div class="clearfix nav-submenu-container">
    <div class="midCont submenu-Cont">
    	<?php $this->loginarea="prospects";$this->subtabsel="projectvendorslist";
       echo $this->renderElement('prospect_vendor_submenu');  ?>
    </div>
</div>


 <?php echo $this->renderElement('commonhtml');  ?>
 </div>    


