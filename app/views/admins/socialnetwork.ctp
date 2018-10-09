<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'socialnetwork';
?>
<style type="text/css">
		.chkcls{ margin-top: 2px; }
		.newscltab {
			margin: 0 auto;
			width: 960px;
			}
</style>
	
	<script type="text/javascript" src="/js/ZeroClipboard.js"></script>
	<script type="text/javascript">
		var clip = null;

		//function $(id) { return document.getElementById(id); }
		
		function init() {
			clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );
			clip.addEventListener('load', function (client) {
			debugstr("Flash movie loaded and ready.");
			});
			clip.addEventListener('mouseOver', function (client) {
			// update the text on mouse over
			clip.setText( $('codeval').value );
			});
			clip.addEventListener('complete', function (client, text) {
			debugstr("Copied text to clipboard: " + text );
			});
			clip.glue( 'd_clip_button', 'd_clip_container' );
			}
		function debugstr(msg) {
			var p = document.createElement('p');

			p.innerHTML = msg;
			$('d_debug').appendChild(p);
		}
	</script>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
        <div class="center-Page col-sm-6">            	
            <h2>Social Networks</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admins", array("action" => "socialnetwork",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent")); ?>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            
        </div>
    </div>    
</div>

	<!--inner-container starts here-->
	
	<!--inner-container starts here-->
    
    
<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    	$this->loginarea="admins";
				$this->subtabsel="socialnetwork";
				
		echo $this->renderElement('setting_submenus');  ?> 
    </div>
</div>    

<div class="newscltab midCont" id="newscltab">
    

  <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



    
		<!-- top curv image starts -->
        
	    <div class="tbl-Data1 table-responsive">
		<table class="table table-striped table-bordered table-hover" width="100%;" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
		<tr class="tr_Bg">
		<th class="" style='width:70px;' align="center" valign="middle">
		    <?php
			e(
				$html->image('/images/icon-include.png',array('title'=>'Add to iFrame Source','alt'=>'Add to iFrame Source'))
			);
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			e(
				$html->image('/images/icon-home.png',array('title'=>'Add on home page','alt'=>'Add on home page'))
			);
			
			?>
			
		</th>
		<th style='width:215px;'  align="middle" valign="middle">Social Network</th>
	  	<th style='width:300px;'  align="middle" valign="middle">Social Profile URL</th>
		<th class="social-rghtblue" style='width:300px;' align="middle" valign="middle">Custom Image</th>
     	        </tr>

<!--<tr><td colspan="5">&nbsp;</td></tr>-->
                <tr height="40px" style="padding-top:10px">
		      <?php //echo "<pre>"; print_r($graphiclist);print_r($this->data); ?>
		     
		      <?php
		      
			  
			  $chk = array();
			  $i=0;
		      foreach($graphiclist as $grlist)
		      {
			      if($graphiclist[$i]['ProjectGraphic']['iframe_icon']==1)
				      $chk[$i] = 1;
			      else
				      $chk[$i] = 0;
			  
			     if($graphiclist[$i]['ProjectGraphic']['home_icon']==1)
				      $chk1[$i] = 1;
			      else
				      $chk1[$i] = 0;
			      $i++;					
			}


		      ?>
		<td class='brdtab1' align="center" valign="middle"><?php 
				
		if(isset($chk[0]) && $chk[0]==1)
			echo $form->input("activestatus_link", array('type'=>'checkbox','id'=>'ch1' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link", array('type'=>'checkbox','id'=>'ch1' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

		if(isset($chk1[0]) && $chk1[0]==1)
			echo $form->input("activestatus_link1", array('type'=>'checkbox','id'=>'chl1' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link1", array('type'=>'checkbox','id'=>'chl1' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 
		?>

		</td>
		<td class='brd-tab'><span class="intp-Span1"><?php echo $form->input("title_link", array('id' => "title_link", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_link", array('id' => "address_link", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?>
		<?php echo $form->input('ProjectGraphic.image_link',array('type'=>'hidden')); ?></span>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_link",array('id'=> "imagenameold_link","class" => "newcontactInput","size"=>"41px"));?>
		</tr>
		<tr height="40px">
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[0]) && $chk[0]==1)
			echo $form->input("activestatus_face", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch2','label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_face", array('type'=>'checkbox','class'=>'chkcls','id'=>'ch2','label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";

		if(isset($chk1[1]) && $chk1[1]==1)
			echo $form->input("activestatus_link2", array('type'=>'checkbox','id'=>'chl2' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link2", array('type'=>'checkbox','id'=>'chl2' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 		


		?> 
			
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_face", array('id' => "title_face", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_face", array('id' => "address_face", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_face',array('type'=>'hidden')); ?>
		</td>
		<td class='brdtab2'><?php  echo $form->file("imagenameold_face",array('id'=> "imagenameold_face","class" => "newcontactInput","size"=>"41px"));?>
		</tr>
		<tr height="40px">
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[2]) && $chk[2]==1)
			echo $form->input("activestatus_twit", array('type'=>'checkbox','id'=>'ch3','class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_twit", array('type'=>'checkbox','id'=>'ch3', 'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";

	
		
		if(isset($chk1[2]) && $chk1[2]==1)	
			echo $form->input("activestatus_link3", array('type'=>'checkbox','id'=>'chl3' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link3", array('type'=>'checkbox','id'=>'chl3' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		?> 
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_twit", array('id' => "title_twit", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>

		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_twit", array('id' => "address_twit", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_twit',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_twit",array('id'=> "imagenameold_twit","class" => "newcontactInput","size"=>"41px"));?>
		</tr>
		<tr height="40px">
		</td>
		<td class='brdtab1' align="center"><?php 
		
		if(isset($chk[3]) && $chk[3]==1)
			echo $form->input("activestatus_don", array('type'=>'checkbox','id'=>'ch4','class'=>'chkcls', 'value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don", array('type'=>'checkbox','id'=>'ch4', 'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";


		if(isset($chk1[3]) && $chk1[3]==1)
			echo $form->input("activestatus_link4", array('type'=>'checkbox','id'=>'ch14' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link4", array('type'=>'checkbox','id'=>'ch14' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 	

		?> 
		
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don", array('id' => "title_don", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_don", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don",array('id'=> "imagenameold_don","class" => "newcontactInput","size"=>"41px"));?>
		</tr>       
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[4]) && $chk[4]==1)
			echo $form->input("activestatus_don1", array('type'=>'checkbox', 'class'=>'chkcls','value'=>1,'id'=>'ch5', 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don1", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch5', 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";


		if(isset($chk1[4]) && $chk1[4]==1)
			echo $form->input("activestatus_link5", array('type'=>'checkbox','id'=>'ch15' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link5", array('type'=>'checkbox','id'=>'ch15' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		?> 
			
		</td>
		
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don1", array('id' => "title_don1", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></div>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_don1", array('id' => "address_don1", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don1',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don1",array('id'=> "imagenameold_don1","class" => "newcontactInput","size"=>"41px"));?>
							
						
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[5]) && $chk[5]==1)
			echo $form->input("activestatus_don2", array('type'=>'checkbox', 'class'=>'chkcls','value'=>1,'id'=>'ch6', 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don2", array('type'=>'checkbox','id'=>'ch6', 'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";


		if(isset($chk1[5]) && $chk1[5]==1)
			echo $form->input("activestatus_link6", array('type'=>'checkbox','id'=>'ch16' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link6", array('type'=>'checkbox','id'=>'ch16' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 	
		?> 
		</td>	
		<td class='brdtab' align=""><span class="intp-Span1"><?php echo $form->input("title_don2", array('id' => "title_don2", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_don2", array('id' => "address_don2", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don2',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don2",array('id'=> "imagenameold_don2","class" => "newcontactInput","size"=>"41px"));?>
							
							
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[6]) && $chk[6]==1)
			echo $form->input("activestatus_don3", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch7', 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don3", array('type'=>'checkbox', 'class'=>'chkcls','value'=>1,'id'=>'ch7', 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";


		if(isset($chk1[6]) && $chk1[6]==1)
			echo $form->input("activestatus_link7", array('type'=>'checkbox','id'=>'ch17' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link7", array('type'=>'checkbox','id'=>'ch17' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 
		?> 
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don3", array('id' => "title_don3", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_don3", array('id' => "address_don3", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?>
		<?php echo $form->input('ProjectGraphic.image_don3',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don3",array('id'=> "imagenameold_don3","class" => "newcontactInput","size"=>"41px"));?>
							
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[7]) && $chk[7]==1)
			echo $form->input("activestatus_don4", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch8', 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don4", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch8', 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";


		if(isset($chk1[7]) && $chk1[7]==1)
			echo $form->input("activestatus_link8", array('type'=>'checkbox','id'=>'ch18' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link8", array('type'=>'checkbox','id'=>'ch18' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 		

		?> 
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don4", array('id' => "title_don4", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'><span class="intp-Span1"> <?php echo $form->text("address_don4", array('id' => "address_don4", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don4',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don4",array('id'=> "imagenameold_don4","class" => "newcontactInput","size"=>"41px"));?>
						
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[8]) && $chk[8]==1)
			echo $form->input("activestatus_don5", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch9', 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don5", array('type'=>'checkbox', 'class'=>'chkcls','value'=>1,'id'=>'ch9', 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";

		if(isset($chk1[8]) && $chk1[8]==1)
			echo $form->input("activestatus_link9", array('type'=>'checkbox','id'=>'ch19' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link9", array('type'=>'checkbox','id'=>'ch19' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 
		?> 
		
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don5", array('id' => "title_don5", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_don5", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don5',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'><?php  echo $form->file("imagenameold_don5",array('id'=> "imagenameold_don5","class" => "newcontactInput","size"=>"41px"));?>
						
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[9]) && $chk[9]==1)
			echo $form->input("activestatus_don6", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch10' ,'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don6", array('type'=>'checkbox', 'class'=>'chkcls','value'=>1,'id'=>'ch10' , 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	
			
		if(isset($chk1[9]) && $chk1[9]==1)
			echo $form->input("activestatus_link10", array('type'=>'checkbox','id'=>'ch20' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link10", array('type'=>'checkbox','id'=>'ch20' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		?> 
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don6", array('id' => "title_don6", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'> <span class="intp-Span1"><?php echo $form->text("address_don6", array('id' => "address_don6", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don6',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don6",array('id'=> "imagenameold_don6","class" => "newcontactInput","size"=>"41px"));?>
		
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[10]) && $chk[10]==1)
			echo $form->input("activestatus_don7", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch11' , 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don7", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch11', 'label' => '','div'=>false)); 

		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	

		if(isset($chk1[10]) && $chk1[10]==1)
			echo $form->input("activestatus_link11", array('type'=>'checkbox','id'=>'ch21' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link11", array('type'=>'checkbox','id'=>'ch21' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		?> 
		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don7", array('id' => "title_don7", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'><span class="intp-Span1"> <?php echo $form->text("address_don7", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don7',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don7",array('id'=> "imagenameold_don7","class" => "newcontactInput","size"=>"41px"));?>
						
						
		</tr>
		<tr height="40px">
		
		<td class='brdtab1' align="center"><?php 
		if(isset($chk[11]) && $chk[11]==1)
			echo $form->input("activestatus_don8", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch12', 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_don8", array('type'=>'checkbox','class'=>'chkcls', 'value'=>1,'id'=>'ch12', 'label' => '','div'=>false)); 
		
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";


		if(isset($chk1[11]) && $chk1[11]==1)
			echo $form->input("activestatus_link12", array('type'=>'checkbox','id'=>'ch22' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
		else
			echo $form->input("activestatus_link12", array('type'=>'checkbox','id'=>'ch22' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

		?> 

		</td>
		<td class='brdtab'><span class="intp-Span1"><?php echo $form->input("title_don8", array('id' => "title_don8", 'div' => false, 'label' => '',"class" => "inpt-newtxt-fld form-control","maxlength" => "250"));?></span>
		</td>
		
		<td class='brdtab3'><span class="intp-Span1"> <?php echo $form->text("address_don8", array('id' => "address_don8", 'div' => false, 'label' => '',"class" => "inpt-txt-flds form-control"));?></span>
		<?php echo $form->input('ProjectGraphic.image_don8',array('type'=>'hidden')) ?>
		</td>
		<td class='brdtab2'> <?php  echo $form->file("imagenameold_don8",array('id'=> "imagenameold_don8","class" => "newcontactInput","size"=>"41px"));?>
		</tr>    
               
                    <tr>
                                 <td colspan='4'>&nbsp;</td>
                     
                    </tr>
                
                </table>
                                        
                                        <!-- ADD Sub Admin  FORM EOF -->
    
<table class="table table-borderless" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
              <td width="66%">
            <div>
    <span class="social-txttop"><span class="social-Span"><textarea id="codeval" style="width:100%;" class="socialtxtArea1 form-control" cols="2000" rows="5"></textarea></span></span></div></td>
        <td width="36%"><div class="">
            <ul style="list-style:none;">
            <li><button type="button" value="Getsource" class="btn btn-primary" name="Getsource" onclick="getsource();init();"><span>Get iFrame Source</span></button></li>
		<li><span>&nbsp;</span></li>
            <li><button type="button" value="Copy" class="btn btn-success" name="copyb" onclick="this.form.codeval.focus();this.form.codeval.select();"><span>Copy</span></button></li>
            </ul>
            </div>
              </td>
        </tr>
        </tbody></table>
     
		</div>

                    <div>
                    <!--<span class="botLft_curv"></span>
      <span class="botRht_curv"></span>-->
                    <div class="gry-Bot">
                    </div>
                    <!--inner-container ends here-->
        

                    
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->


</div>

		<div class="clear"></div><!--container ends here-->
				<?php echo $form->end();?>
		
		<div class="clear"></div>


		<script type="text/javascript">
		function getsource()
		{

			//alert(document.getElementById( "ch1" ).checked);
			if((document.getElementById("ch1").checked==true && document.getElementById("title_link").value!="")||
			(document.getElementById("ch2").checked==true&&document.getElementById("title_face").value!="")||
			(document.getElementById("ch3").checked==true &&document.getElementById("title_twit").value!="")||
			(document.getElementById("ch4").checked==true && document.getElementById("title_don").value!="")||
			(document.getElementById("ch5").checked==true && document.getElementById("title_don1").value!="")||
			(document.getElementById("ch6").checked==true && document.getElementBychkclsId("title_don2").value!="")||
			(document.getElementById("ch7").checked==true && document.getElementById("title_don3").value!="")||
			(document.getElementById("ch8").checked==true && document.getElementById("title_don4").value!="")||
			(document.getElementById("ch9").checked==true && document.getElementById("title_don5").value!="")||
			(document.getElementById("ch10").checked==true && document.getElementById("title_don6").value!="")||
			(document.getElementById("ch11").checked==true && document.getElementById("title_don7").value!="")||
			(document.getElementById("ch12").checked==true	&& document.getElementById("title_don8").value!="")	
			)
			{       
            
                  // Set Dyanmic width to iframe depends on number of icon selected
                    var count = 0;
                    if(document.getElementById("ch1").checked==true){ count=count+1; }                    
                    if(document.getElementById("ch2").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch3").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch4").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch5").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch6").checked==true){ count=count+1; }                    
                    if(document.getElementById("ch7").checked==true){ count=count+1;}                    
                    if(document.getElementById("ch8").checked==true){ count=count+1; }                    
                    if(document.getElementById("ch9").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch10").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch11").checked==true){ count=count+1;  }                    
                    if(document.getElementById("ch12").checked==true){ count=count+1; }   
                    
                     var width= 250;
                     if(count > 0){
                        // var icons=count-1;
                         var firsticon=12;
                         // iframe width = margin + number of icons * each icon width 
                           width= parseInt( firsticon +  parseInt( count * 40) );
                     }
                    
			var code="<iframe id='socialiframe' scrolling='no' frameborder='0'  src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/socialicon/<?php echo $projectid;?>' style='border: none; width : "+width+"px;  height: 58px; background:none; '></iframe>";
			document.getElementById("codeval").value=code;
			}
			else
			{
			alert("Social Link are not checked OR Tittle not fills ");
			}
		
		}

		</script>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newscltab").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>

