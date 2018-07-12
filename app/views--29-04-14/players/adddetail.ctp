<script type="text/javascript">
	$(document).ready(function() {
		$('#playMnu').removeClass("butBg");
		$('#playMnu').addClass("butBgSelt");
	}); 
</script>
<?php 
$lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/playerslist/'.$option; ?>

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
	var resWindow1 = null;
	var cid,pid;
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
						url: baseUrl+'players/getlatestcontactbypros/'+pid,
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
 <div style="width:960px; margin:0 auto;">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">

	<?php 
	echo $form->create("players", array("action" => "adddetail".$isbranch.$editbranch,'type' => 'file','enctype'=>'multipart/form-data','name' => 'adddetail', 'id' => "adddetail","onsubmit"=>"return validatecompany('$act');"));
	 echo $form->hidden("option", array('id' => 'option','value'=>"$option"));
	 if($isbranch ==''){
	 	echo $form->hidden("Company.id", array('id' => 'companyid'));
	 }
	 echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
	 echo $form->hidden("projectid", array('id' => 'projectid','value'=>"$project_id"));
	?>
	<button type="submit" style="padding:0px;" value="Submit" class="sendBut" name="data[Action][redirectpage]">
	<?php e($html->image('save.png', array('alt' => 'Save'))); ?></button>
	<button type="submit" style="padding:0px;" value="Submit" class="sendBut" name="data[Action][noredirection]">
<?php e($html->image('apply.png', array('alt' => 'APPLY'))); ?></button>
<button type="button" style="padding:0px;" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')">
<?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?></button>
	<?php  echo $this->renderElement('new_slider');  ?>
</div>
<?php /*?><span class="titlTxt1"  style=" padding: 16px 0;"> <?php  echo $current_company_name; echo ($current_company_name !='')? ' : ' :'';  ?></span><?php */?>
	<span class="titlTxt">
			<?php 
				if($this->data['Company']['id']){
					$act = 'edit';
					echo ($isbranch =='')?ucfirst($option):' Branch';
					echo " Detail Add/Edit"; 
				}else{
					$act = 'add';
					echo ($isbranch =='')?ucfirst($option):' Branch';
					echo " Detail Add/Edit"; 
				}	
			?>
	</span>
	
	
	
	<div class="topTabs" style="height:25px;">
		<?php /*?><ul class="dropdown">   
		<li><button type="submit" style="padding:0px;" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" style="padding:0px;" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" style="padding:0px;" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
		</ul><?php */?>
	</div>
	<div class="clear"></div>

	<?php $this->loginarea="players";$this->subtabsel="details"; 
		if($option=='company'|| $option=='merchant'|| $option=='nonprofit')
			
			echo $this->renderElement('players/player_inner_submenu');
		else
			echo $this->renderElement('players/player_inner_submenu2');
	?>
</div>
</div>

<?php switch($companytypecategoryid){
				case 7:
						echo $this->renderElement('players/detail/addcompany');
						break;
				case 2:
						echo $this->renderElement('players/detail/addmerchant');
					 	break;
				case 4:
						echo $this->renderElement('players/detail/addnonprofit');
					 	break;
				case 1:
						echo $this->renderElement('players/detail/addvendor');
					 	break;
				case 3:
						echo $this->renderElement('players/detail/addsale');
						break;					 		
				case 5:
						echo $this->renderElement('players/detail/addadvertiser');
			 			break;
				case 6:
						echo $this->renderElement('players/detail/addother');
			 			break;				 		
}?>





<script language='javascript'>
<?php if(!($this->data['Company']['id'])) { ?>
	getstateoptions('254',"Company"); 
<?php } ?>
</script>

<div class="clear"></div>
  </div>    
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
        $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
            var contactid=$("#contacts").val();
            if(contactid==null || contactid==""){
                return false;
            }else{
                var url=baseUrl+"players/addcontacts/"+contactid;
                window.location=url;
        	} 
		});
		
	   $("#view_others").click(function(){   
        var current_domain=$("#current_domain").val();
            if(viewotherid==0){
                return false;
            }else{
                var url=baseUrl+"players/addmerchant/"+viewotherid;
                window.location=url;
        	} 
		});
		
		$("#view_nonprofit").click(function(){
		
		   $('input[id^="nonprofitcheck"]').each( function(){
		  			 if($(this).is(':checked')){
						 var url=baseUrl+"players/addnonprofit/"+$(this).val();
		                //window.location=url;	
					    window.open(url);
						return false;
					}
			});
		});

		$("#view_project").click(function(){ 
		 	$('input[id^="projectcheck"]').each( function(){
					if($(this).is(':checked')){
						var url=baseUrl+"admins/editproject/"+$(this).val();
		                //window.location=url;	
					    window.open(url);
						return false;
					}
			});
		});

		$('input[id="projectcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="projectcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="projectcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})
		
		$('input[id="nonprofitcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="nonprofitcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="nonprofitcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})
		
		$('input[id="targetprojectcheckall"]').live('change', function(){
			if($(this).is(':checked')){
				$('input[id^="targetprojectcheck"]').each( function(){
					$(this).attr('checked',true);
				});
			}else{
				$('input[id^="targetprojectcheck"]').each( function(){
					$(this).attr('checked',false);
				});
			}
		})

</script>