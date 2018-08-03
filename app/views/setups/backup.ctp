<?php ?>

<div class="container clearfix">
	<div class="titlCont">
  		<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
				<?php  //$prname =$this->data['Project']['project_name'];   ?>
                <h2>Backup Project</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Setup", array("action" => "backup",'name' => 'backup', 'id' => "backup"));?>
                </div>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <div class="topTabs" style="height:25px;">
        <!-- <ul class="dropdown">
                            <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/Setups/dashboard')"><span> Cancel</span></button></li>
                </ul>-->
      </div>
        </div>
        
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="setups";    $this->subtabsel="backup";
            echo $this->renderElement('setup_submenus');  ?>
    </div>
</div>

<div class="midCont" id="newcoinsettab">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    <table>
      <tr>
        <td><p> The <strong> Backup Project</strong> allows you to backup your project and also backup your project database.</p>
          <br/>
          <p> Please first <strong> Generate Backup </strong> and then <strong> Download Backup</strong> file.</p>
          <br/>
          <br/>
        </td>
      </tr>
      <tr>
        <td><?php if($filename==''){    

                            echo $form->hidden('generate',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'id'=>"generate",'value'=>'1'  ));
                        ?>
          <button class="btn btn-sm btn-success" id="generatebackup" type="submit"><span> Generate Backup!</span> </button>
          <?php 
                        }else{ 
                            echo $form->hidden('download',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'id'=>"generate",'value'=>'1'  ));   
                            echo $form->hidden('filename',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'id'=>"generate",'value'=>$filename  ));   
                         ?>
          <button class="btn btn-sm btn-success" id="downloadbackup" type="submit"><span> Download Backup!</span> </button>
          <?php }?>
          <?php 
                        //echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?>
        </td>
      </tr>
    </table>
  </div>
  <?php echo $form->end(); ?>
  <div class="clear"></div>
</div>
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {        
  //      document.getElementById("newcntlist").className = "newmidCont";
    }    
</script>
