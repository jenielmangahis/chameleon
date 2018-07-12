<?php
   echo $javascript->link('datetimepicker/jquery-1.4.2.min.js');
   		echo $javascript->link('facebox.js');
	    echo $html->css('facebox.css','stylesheet');
?>

<script type="text/javascript">	

	 jQuery(document).ready(function($) {
			$('a[rel*=coina]').facebox();
		})
	 jQuery(document).ready(function($) {
			$('a[rel*=coinb]').facebox();
		})	

	 jQuery(document).ready(function($) {
			$('a[rel*=uploadedlogo]').facebox();
		})
	</script>
 
<div class="titlCont"><div class="myclass">

<div align="center" id="toppanel" >
	<div id="panel">
			<div class="content clearfix">
			<H1> Help</h1>
				<p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
	</div>
			
	</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li id="toggle">
            <a id="open" class="open" href="javascript:void(0)"><span>Click Here to Open Help Box</span></a>

				<a id="close" style="display: none;" class="close" href="javascript:void(0)"><span>Click Here to Close Help Box</span></a>		
			</li>
		</ul> 
	</div>



</div>

<span class="titlTxt">
Project Images
</span>
	<?php echo $form->create("Company", array("action" => "projectimages",'type' => 'file','enctype'=>'multipart/form-data','name' => 'projectimages', 'id' => "projectimages"))?>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span> Cancel</span></button></li>
</ul>
</div>


<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear:both;">

		
		
<div id="tab-container-1">
	<ul id="tab-container-1-nav" class="topTabs2">
        	<li><a href="/companies/editprojectdtl"><span>Details</span></a></li>
        	<li><a href="/companies/projectimages" class="tabSelt"><span>Images</span></a></li>
		<li><a href="/companies/projecttracking"><span>Tracking</span></a></li>
		<li><a href="/companies/projectcontrols"><span>Controls</span></a></li>
		<li><a href="/companies/projectsponsor"><span>Sponsor</span></a></li>
		<li><a href="/companies/coinsetlist"><span>Coinsets</span></a></li>
		<li><a href="/companies/companylist"><span>Companies</span></a></li>
		<li><a href="/companies/contactlist"><span>Contacts</span></a></li>
    </ul>
   
 <div class='newtab' id="Images" style="padding-top: 58px;">

 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>
    <div class="left">	
  <table cellspacing="5" cellpadding="0" align="center" width="800">
  <tbody>
   	 <?php if($session->check('Message.flash')){ ?> 
	<tr><td colspan="4" align="center">
			<?php $session->flash(); ?> 
	</td>
	</tr>
	<tr><td colspan="4" align="center">&nbsp;</td></tr>
	<?php } ?>
    <tr>
      <td width="10%"  valign='top'><label class="boldlabel">Side A Image:</label></td>
      <td width="50%">
	<?php  echo $form->file('Project.coinsidea',array('id'=> 'sidea',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 pixels</span><br>
		      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>
			 <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
      <br />&nbsp; <?php if($this->data['Project']['sidea'] !=''){  ?> <a href="#divimagecoina" rel='coinb' title='Click here to view Full view.'><img style="width:107px; height:109px;" src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sidea']; ?>"></a> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/sideA.png'><?php } ?>
       <span style='display: none;' id="divimagecoina">
	  		<div align='center'><img src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sidea']; ?>"></div>
	  		</span>
	</td>

      <td width="10%"  valign='top'> <label class="boldlabel">Side A Description:</label></td>
      <td width="30%" valign='top'><span class="txtArea_top">
<span class="txtArea_bot">
<?php echo $form->textarea("Project.sideadesc", array('id' => 'sideadesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg"));?></div></div></td>
      <tr>
      
    <tr>
      <td  valign='top'><label class="boldlabel">Side B Image:</label></td>
       <td><?php  echo $form->file('Project.coinsideb',array('id'=> 'sideb',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 250x250 pixels</span><br>
	<span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>

      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
       <br />&nbsp; <?php if($this->data['Project']['sideb'] !=''){  ?> <a href="#divimagecoinb" rel='coinb' title='Click here to view Full view.'><img style="width:107px; height:109px;" src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sideb']; ?>"></a> <?php }else { ?><img src='/img/<?php echo $project_name; ?>/sideB.png'><?php } ?>
 <span style='display: none;' id="divimagecoinb">
	  		<div align='center'><img src="/img/<?php echo $project_name.'/uploads/'.$this->data['Project']['sideb']; ?>"></div>
	  		</span>
</td>
 
      <td  valign='top'> <label class="boldlabel">Side B Description:</label></td>
      <td><span class="txtArea_top">
<span class="txtArea_bot"><?php echo $form->textarea("Project.sidebdesc", array('id' => 'sidebdesc', 'div' => false, 'label' => '','cols' => '24', 'rows' => '8',"class" => "noBg"));?></span></span></td>
       </tr>
    
    <tr>
      <td  valign='top'><label class="boldlabel">Edge Image:</label></td>
       <td valign='top'><?php  echo $form->file('Project.coinedge',array('id'=> 'coinedge',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 300x12.</span>
       <br />&nbsp; <?php if($this->data['Project']['edge'] !=''){  ?> <img src="/img/<?php echo $projectname.'/uploads/'.$this->data['Project']['edge']; ?>" style=" max-width: 270px"> <?php }else { ?><img src='/img/<?php echo $projectname; ?>/noimage.png' style=" max-width: 270px"><?php } ?></td>
 
      <td  valign='top'>
      <label class="boldlabel">Edge Description:</label></td>
      <td>  <span class="txtArea_top">
<span class="txtArea_bot">   <?php echo $form->textarea("Project.edgedesc", array('id' => 'edgedesc', 'div' => false, 'label' => '','cols' => '30', 'rows' => '8',"class" => "noBg"));?></span></span></td>
       </tr>
    <tr>
      <td valign="top"><label class="boldlabel">Serial on side</label></td>
      <td><span class="txtArea_top" style="width:0px;">
<span class="txtArea_bot"><?php echo $form->select("Project.serialdisplayside",array("A"=>"Side A","B"=>"Side B"),$serialdisplayside,array('label'=>'','id' => 'serialdisplayside','style'=>'width:200px; border:1px solid #BEDAE5;'),false); ?></span></span></td>
       <td></td>
 	<td></td>
    </tr>
    <tr>


<!-- working correctly -->
   <!--  <td  valign='top'><label class="boldlabel">Project Logo/Header:</label></td>
      <td><?php // echo $form->file('Project.coinlogo',array('id'=> 'logo',"class" => "inpt_txt_fld"));?><br>
      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Recommended file size 960x92.</span><br>
			      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Format:Transparent PNG or GIF.</span><br>

      <span style="color: LightSlateGray;font-size: 11px;font-style: italic;">Click over the image for Original view.</span>
       <br />&nbsp; <?php //if($this->data['Project']['logo'] !=''){  ?> <a href="#divimageview" rel='uploadedlogo' title='Click here to view Full view.'><img src="/img/<?php //echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>" style="max-height: 92px; max-width: 270px" ></a> <?php// }else { ?><img src='/img/<?php// echo $projectname; ?>/nologo.jpg'><?php } ?>
	<span style='display: none;' id="divimageview">
	  		<div align='center'><img src="/img/<?php// echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>"></div>
	  		</span>
</td>
      
			<span style='display: none;' id="divimageview">
	  		<div align='center'><img src="/img/<?php// echo $projectname.'/uploads/'.$this->data['Project']['logo']; ?>"></div>
	  		</span>
      
    
      <td></td>
      <td></td>-->
<!--coment closed here-->

    </tr>
    
    <tr><td colspan='4'>&nbsp;</td></tr>
    <!--tr><td colspan='4'>
  			 <span class="btnLft">
    			 <button type="submit" id="Submit" class="btnRht"> Save </button></span>&nbsp;
    		   <span class="btnLft"><button type="btnRht" id="saveForm" class="btnRht"  ONCLICK="javascript:(window.location='/companies/dashboard')"> Cancel </button></span>
    		
	</td></tr-->
  </tbody>
</table>
</div>
	</div>
	<div class='clear'></div>

    </div>
    
    
    
    <!-- main tab -->
    </div>
    
    <?php echo $form->end();?>
</div>

<div class='clear'></div>
</div></div>
<div class="midPadd">
	
		<div class="top-bar" style="border-left:0px;">

		</div><br />


</div>
<div class="clear"></div>
  <!-- Body Panel ends --> 