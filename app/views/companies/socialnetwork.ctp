<?php //print_r($graphiclist);?>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>

<script type="text/javascript"> jQuery.noConflict() </script>

<script type="text/javascript" src="/js/ZeroClipboard.js"></script>




<style type="text/css">
		.chkcls{ margin-top: 2px; }
		.newtabSCL {
   			margin: 0 auto;
    			width: 960px;
			}	
</style>
	
	
<div class="titlCont"><div class="myclass">
	<div align="center" class="slider" id="toppanel">
		  <?php 
		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '51'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   

 echo $this->renderElement('new_slider');  ?>


</div>
<?php echo $form->create("Companies", array("action" => "socialnetwork",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editcontent', 'id' => "editcontent")); ?>
<span class="titlTxt">
Social Networks
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/contentlist')"><span> Cancel</span></button></li>
</ul>
</div>


    <?php    $this->loginarea="companies";    $this->subtabsel="socialnetwork";
             echo $this->renderElement('websites_submenus');  ?>  
</div></div>



<!--inner-container starts here-->

<!--inner-container starts here-->

<div class="newtabSCL" id="newsclnt">


  <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>





    <!-- top curv image starts -->

  
  

                    
                    <div class="tblData1">

	<table width="960px;" border="0" cellspacing="0" cellpadding="0" class="admgrid"> 
		<tr class="trBg">
		<th class="social_leftblue" style='width:65px;' align="top" valign="middle">
		    <img src='/images/icon-include.png' title="Add to iFrame Source">&nbsp;&nbsp;
	            <img src='/images/icon-home.png' title="Add on home page">    
		</th>
		<th style='width:215px;'  align="middle" valign="middle"></span>Social Network</th>
	  	<th style='width:300px;'  align="middle" valign="middle">Social Profile URL</th>
		<th class="social_rghtblue" style='width:300px;' align="middle" valign="middle">Custom Image</th>
     	        </tr>

<tr><td colspan="5">&nbsp;</td></tr>

		
		  <tr height="40px">
		      <?php //echo "<pre>"; print_r($graphiclist);print_r($this->data); ?>
		     
		      <?php
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
<td class='brdtab1' align='center'><?php 
if($chk[0]==1)
        echo $form->input("activestatus_link", array('type'=>'checkbox', 'value'=>1,'id'=>'ch1', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_link", array('type'=>'checkbox', 'value'=>1,'id'=>'ch1', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[0]==1)
echo $form->input("activestatus_link1", array('type'=>'checkbox','id'=>'chl1' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link1", array('type'=>'checkbox','id'=>'chl1' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false));
?> 
 </td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_link", array('id' => "title_link", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[0]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_link", array('id' => "address_link", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[0]['ProjectGraphic']['address']));?>
<?php echo $form->input('ProjectGraphic.image_link',array('type'=>'hidden','value'=>$graphiclist[0]['ProjectGraphic']['imagename'])); ?></span>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_link",array('id'=> "imagenameold_link","class" => "newcontactInput","size"=>"41px"));?>
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[1]==1)
        echo $form->input("activestatus_face", array('type'=>'checkbox', 'value'=>1 ,'id'=>'ch2', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_face", array('type'=>'checkbox', 'label' => '','id'=>'ch2','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[1]==1)
echo $form->input("activestatus_link2", array('type'=>'checkbox','id'=>'chl2' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link2", array('type'=>'checkbox','id'=>'chl2' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false));
?> 
</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_face", array('id' => "title_face", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[1]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_face", array('id' => "address_face", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[1]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_face',array('type'=>'hidden','value'=>$graphiclist[1]['ProjectGraphic']['imagename'])); ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_face",array('id'=> "imagenameold_face","class" => "newcontactInput","size"=>"41px"));?>
                                       
                                        
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[2]==1)
        echo $form->input("activestatus_twit", array('type'=>'checkbox', 'value'=>1,'id'=>'ch3', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_twit", array('type'=>'checkbox', 'value'=>1,'id'=>'ch3', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[2]==1)
echo $form->input("activestatus_link3", array('type'=>'checkbox','id'=>'chl3' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link3", array('type'=>'checkbox','id'=>'chl3' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?> 
</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_twit", array('id' => "title_twit", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[2]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_twit", array('id' => "address_twit", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[2]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
	    <?php echo $form->input('ProjectGraphic.image_twit',array('type'=>'hidden','value'=>$graphiclist[2]['ProjectGraphic']['imagename'])) ?>
	    </td>
	    <td class='brdtab2'><?php  echo $form->file("imagenameold_twit",array('id'=> "imagenameold_twit","class" => "newcontactInput","size"=>"41px"));?>
						    
						    
</tr>
<tr height="40px">
</td>
<td class='brdtab1' align='center'><?php 
if($chk[3]==1)
        echo $form->input("activestatus_don", array('type'=>'checkbox', 'value'=>1,'id'=>'ch4', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don", array('type'=>'checkbox', 'value'=>1,'id'=>'ch4', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[3]==1)
echo $form->input("activestatus_link4", array('type'=>'checkbox','id'=>'ch14' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link4", array('type'=>'checkbox','id'=>'ch14' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 	
?> 

</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don", array('id' => "title_don", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[3]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_don", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[3]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don',array('type'=>'hidden','value'=>$graphiclist[3]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don",array('id'=> "imagenameold_don","class" => "newcontactInput","size"=>"41px"));?>
                                      
                                        
</tr>       
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[4]==1)
        echo $form->input("activestatus_don1", array('type'=>'checkbox', 'value'=>1,'id'=>'ch5', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don1", array('type'=>'checkbox', 'value'=>1,'id'=>'ch5', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[4]==1)
echo $form->input("activestatus_link5", array('type'=>'checkbox','id'=>'ch15' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link5", array('type'=>'checkbox','id'=>'ch15' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?> 

</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don1", array('id' => "title_don1", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[4]['ProjectGraphic']['title']));?></div>
</td>

 <td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_don1", array('id' => "address_don1", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[4]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don1',array('type'=>'hidden','value'=>$graphiclist[4]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don1",array('id'=> "imagenameold_don1","class" => "newcontactInput","size"=>"41px"));?>
                                        
                                       
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[5]==1)
        echo $form->input("activestatus_don2", array('type'=>'checkbox', 'value'=>1,'id'=>'ch6', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don2", array('type'=>'checkbox', 'value'=>1,'id'=>'ch6', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[5]==1)
echo $form->input("activestatus_link6", array('type'=>'checkbox','id'=>'ch16' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link6", array('type'=>'checkbox','id'=>'ch16' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 	

?> 
</td>	
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don2", array('id' => "title_don2", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[5]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_don2", array('id' => "address_don2", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[5]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don2',array('type'=>'hidden','value'=>$graphiclist[5]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don2",array('id'=> "imagenameold_don2","class" => "newcontactInput","size"=>"41px"));?>
                                        
                                        
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[6]==1)
        echo $form->input("activestatus_don3", array('type'=>'checkbox', 'value'=>1,'id'=>'ch7', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don3", array('type'=>'checkbox', 'value'=>1,'id'=>'ch7', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[6]==1)
echo $form->input("activestatus_link7", array('type'=>'checkbox','id'=>'ch17' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link7", array('type'=>'checkbox','id'=>'ch17' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?> 
</td>
<td class='brdtab' align=''><span class="intpSpan1"><?php echo $form->input("title_don3", array('id' => "title_don3", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[6]['ProjectGraphic']['title']));?>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_don3", array('id' => "address_don3", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[6]['ProjectGraphic']['address']));?>&nbsp;&nbsp;
<?php echo $form->input('ProjectGraphic.image_don3',array('type'=>'hidden','value'=>$graphiclist[6]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don3",array('id'=> "imagenameold_don3","class" => "newcontactInput","size"=>"41px"));?>
                                        
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[7]==1)
        echo $form->input("activestatus_don4", array('type'=>'checkbox', 'value'=>1,'id'=>'ch8', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don4", array('type'=>'checkbox', 'value'=>1,'id'=>'ch8', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[7]==1)
echo $form->input("activestatus_link8", array('type'=>'checkbox','id'=>'ch18' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link8", array('type'=>'checkbox','id'=>'ch18' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?> 
</td>
<td class='brdtab' align=''><span class="intpSpan1"><?php echo $form->input("title_don4", array('id' => "title_don4", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[7]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'><span class="intpSpan1"> <?php echo $form->text("address_don4", array('id' => "address_don4", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[7]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don4',array('type'=>'hidden','value'=>$graphiclist[7]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don4",array('id'=> "imagenameold_don4","class" => "newcontactInput","size"=>"41px"));?>
                                       
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[8]==1)
        echo $form->input("activestatus_don5", array('type'=>'checkbox', 'value'=>1,'id'=>'ch9', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don5", array('type'=>'checkbox', 'value'=>1,'id'=>'ch9', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[8]==1)
echo $form->input("activestatus_link9", array('type'=>'checkbox','id'=>'ch19' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link9", array('type'=>'checkbox','id'=>'ch19' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?> 
</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don5", array('id' => "title_don5", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[8]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'>  <span class="intpSpan1"><?php echo $form->text("address_don5", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[8]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don5',array('type'=>'hidden','value'=>$graphiclist[8]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don5",array('id'=> "imagenameold_don5","class" => "newcontactInput","size"=>"41px"));?>
                                       
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[9]==1)
        echo $form->input("activestatus_don6", array('type'=>'checkbox', 'value'=>1,'id'=>'ch10', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don6", array('type'=>'checkbox', 'value'=>1,'id'=>'ch10', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[9]==1)
echo $form->input("activestatus_link10", array('type'=>'checkbox','id'=>'ch20' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link10", array('type'=>'checkbox','id'=>'ch20' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 
?> 
</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don6", array('id' => "title_don6", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[9]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'> <span class="intpSpan1"><?php echo $form->text("address_don6", array('id' => "address_don6", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[9]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don6',array('type'=>'hidden','value'=>$graphiclist[9]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don6",array('id'=> "imagenameold_don6","class" => "newcontactInput","size"=>"41px"));?>

</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[10]==1)
        echo $form->input("activestatus_don7", array('type'=>'checkbox', 'value'=>1,'id'=>'ch11', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don7", array('type'=>'checkbox', 'value'=>1,'id'=>'ch11', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[10]==1)
echo $form->input("activestatus_link11", array('type'=>'checkbox','id'=>'ch21' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link11", array('type'=>'checkbox','id'=>'ch21' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?> 
</td>
<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don7", array('id' => "title_don7", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[10]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'><span class="intpSpan1"> <?php echo $form->text("address_don7", array('id' => "address_don", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[10]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don7',array('type'=>'hidden','value'=>$graphiclist[10]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don7",array('id'=> "imagenameold_don7","class" => "newcontactInput","size"=>"41px"));?>
                                       
                                       
</tr>
<tr height="40px">

<td class='brdtab1' align='center'><?php 
if($chk[11]==1)
        echo $form->input("activestatus_don8", array('type'=>'checkbox', 'value'=>1,'id'=>'ch12', 'label' => '','div'=>false, 'checked'=>true)); 
else
        echo $form->input("activestatus_don8", array('type'=>'checkbox', 'value'=>1,'id'=>'ch12', 'label' => '','div'=>false)); 

echo "&nbsp;&nbsp;&nbsp;&nbsp;";

if($chk1[11]==1)
echo $form->input("activestatus_link12", array('type'=>'checkbox','id'=>'ch22' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false, 'checked'=>true)); 
else
echo $form->input("activestatus_link12", array('type'=>'checkbox','id'=>'ch22' ,'class'=>'chkcls','value'=>1, 'label' => '','div'=>false)); 

?>

</td>

<td class='brdtab'><span class="intpSpan1"><?php echo $form->input("title_don8", array('id' => "title_don8", 'div' => false, 'label' => '',"class" => "inpt_newtxt_fld","maxlength" => "250",'value'=>$graphiclist[11]['ProjectGraphic']['title']));?></span>
</td>

<td class='brdtab3'><span class="intpSpan1"> <?php echo $form->text("address_don8", array('id' => "address_don8", 'div' => false, 'label' => '',"class" => "inpt_txt_flds",'value'=>$graphiclist[11]['ProjectGraphic']['address']));?>&nbsp;&nbsp;</span>
<?php echo $form->input('ProjectGraphic.image_don8',array('type'=>'hidden','value'=>$graphiclist[11]['ProjectGraphic']['imagename'])) ?>
</td>
<td class='brdtab2'><?php  echo $form->file("imagenameold_don8",array('id'=> "imagenameold_don8","class" => "newcontactInput","size"=>"41px"));?>
                                        
                                        
</tr>    
               
                    <tr>
                                 <td colspan='4'>&nbsp;</td>
                     
                    </tr>
                
                </table>
               
                                        
                                        <!-- ADD Sub Admin  FORM EOF -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
              <td width="66%">


 
            <div style="padding-left: 88px;">
    <span class="socialtxttop"><span class="socialSpan"><textarea id="codeval" style="background: none repeat scroll 0% 0% transparent; width: 500px;" class="socialtxtArea1" cols="2000" rows="5"></textarea></span></span></div>
    </td>
        <td width="36%"><div class="">
            <ul style="list-style:none;">
            <li><button type="button" value="Getsource" class="button" name="Getsource" onclick="getsource();init();"><span>Get iFrame Source</span></button></li>
		<li><span>&nbsp;</span></li>
            <li id="d_clip_container"><button type="button" id="d_clip_button" value="Copy" class="newblue" name="copyb" onclick="this.form.codeval.focus();this.form.codeval.select();"><span>Copy</span></button></li>
            </ul>
            </div>
              </td>
        </tr>
        </tbody></table>     


     
	

</div>

                    <div>
                    <span class="botLft_curv"></span>
      
                    <div class="gryBot">
                    </div>
                    <!--inner-container ends here-->
        

                    <span class="botRht_curv"></span>
                    <div class="clear"></div>
                    </div>
<!--inner-container ends here-->




<div class="clear"></div><!--container ends here-->
                   <?php echo $form->end();?>
 </div>
<div class="clear"></div><!--inner-container ends here-->

<script type="text/javascript" src="/js/ZeroClipboard.js"></script>



<script type="text/javascript">
  function getsource()
    {
	if((document.getElementById("ch1").checked==true && document.getElementById("title_link").value!="")||
	(document.getElementById("ch2").checked==true&&document.getElementById("title_face").value!="")||		
    (document.getElementById("ch3").checked==true &&document.getElementById("title_twit").value!="")||
	(document.getElementById("ch4").checked==true && document.getElementById("title_don").value!="")||
	(document.getElementById("ch5").checked==true && document.getElementById("title_don1").value!="")||
	(document.getElementById("ch6").checked==true && document.getElementById("title_don2").value!="")||
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
                var firsticon=12;
                         // iframe width = margin + number of icons * each icon width 
                           width= parseInt( firsticon +  parseInt( count * 40) );
             }
          
	      var code="<iframe id='socialiframe' scrolling='no' frameborder='0'  src='http://<?php echo $_SERVER['HTTP_HOST'];?>/companies/socialicon/<?php echo $projectid;?>' style='border: none; width : "+width+"px;  height: 58px; background:none; '></iframe>";
	    document.getElementById("codeval").value=code;
	  }
	else
	  {
	      alert("Social Link are not checked OR Tittle not fills");
	  }
      
    }
</script>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newsclnt").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
