<script type="text/javascript">
	$(document).ready(function() {
		$('#playMnu').removeClass("butBg");
		$('#playMnu').addClass("butBgSelt");
	}); 
</script>
<?php 
$base_url = Configure::read('App.base_url');
if($_GET['url']==='players/addnote/new'){
$backUrl = $base_url.'players/notelist/2';
}
elseif($_GET['url']==='players/addnote'){
$backUrl = $base_url.'players/notelist/0';
}else{
$backUrl = $base_url.'players/notelist/'.$option;} ?>
<div class="container">
         <div class="titlCont"><div style="width:960px;margin:0 auto">
		    
		 <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;"> 
		 <?php 
	            echo $form->create("players", array("action" => "addnote/".$option, 'name' => 'addnote', 'id' => "addnote")); 
	            echo $form->hidden("option", array('id' => 'option','value'=>"$option"));
	            echo $form->hidden("company_id", array('id' => 'companyid', 'value'=>"$current_company"));
				echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
				echo $form->hidden("project_id", array('id' => 'projectid','value'=>"$project_id"));
				echo $form->hidden("Note.id", array('id' => 'id'));
	 	   ?>  <script type='text/javascript'>
           		function setprojectid(projectid){
                	document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
				}
           </script>
		 <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
		  <?php e($html->image('save.png')) ?></button>
					<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"> <?php e($html->image('apply.png')) ?></button>
					<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"> <?php e($html->image('cancle.png')) ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
		  
                       
                    
                       
            <span class="titlTxt1"><?php  //echo $current_company_name; echo ($current_company_name !='')? ' : ' :'';  ?></span>&nbsp;
             <span class="titlTxt"><?php //echo ucfirst($option); ?> Note</span>
           <div class="topTabs" style="height:25px;">
              <?php /*?> <ul>
					<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
					<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
					<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
				</ul><?php */?>
            </div> 
            <div class="clear" ></div>
	         <?php    $this->loginarea="players";    $this->subtabsel='notes';
                            //echo $this->renderElement('players/player_inner_submenu'); 
							echo $this->renderElement('players/playermerchant_submenus');   ?>   
                            
        </div></div>
<div id="addcmp"  class="midCont">	
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<table cellspacing="10" cellpadding="0">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash(); 
      				//echo $form->error('Company.company_name', array('class' => 'msgTXt'));
      				//echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
      				
      	?></td>
    </tr>
    <?php }?>  
  
   
	<tr>
		<td valign='top' align="right"><label class="boldlabel">Subject<span style="color:red">*</span></label></td>
		<td>
			<span class="intpSpan">
	        	<?php echo $form->input("Note.subject", array('id' => 'subject', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
	        </span>
		</td>		 
	</tr>
		       
	<tr>	 
		<td valign='top' align="right"><label class="boldlabel">Note<span style="color:red">*</span></label></td>
		<td>
			<div class="large">
			<span class="txtArea_top">
				<span class="newtxtArea_bot">
					<?php echo $form->textarea("Note.note", array('id' => 'note', 'div' => false, 'label' => '',
							'cols' => '35', 'rows' => '4',"class" => "multilist", 'style'=>'width:370px'));?>
				</span>
			</span>
			</div>
		</td>
	</tr>
		       
 	<tr>
 		<td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
 			<?php  echo $this->renderElement('bottom_message');  ?>
        </td>
    </tr>
 </table>
<!--inner-container ends here-->
<?php echo $form->end();?>
</div>

 <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null){		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	
</script>
<script type="text/javascript">
var correspondentRedirect = "<?php echo $correspondentRedirect;?>";
if(correspondentRedirect)
{
	window.opener.location.reload(true);
    window.close();
}
</script>