<?php ?>

<div class="container">
<div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
            	<?php  echo $this->renderElement('new_slider');  ?>
            </div>
            	<?php echo $form->create("Admin", array("action" => "projectbackup",'name' => 'projectbackup', 'id' => "projectbackup"));?>                                                                                                                   
            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
            <span class="titlTxt">   Backup Project     </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                            <!--<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/dashboard')"><span> Cancel</span></button></li>-->
                </ul>
            </div>

            <?php    $this->loginarea="admins";    $this->subtabsel="projectbackup";
                    echo $this->renderElement('project_submenus');  ?> 
        </div></div> 
        
        

<div class="midCont" id="newcoinsettab">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    
        <table>

            <tr>
                <td>
                    <p> The <strong> Backup Project</strong> allows you to backup your project and also backup your project database.</p>  <br/>
                    <p> Please first <strong> Generate Backup </strong> and then <strong> Download Backup</strong> file.</p>   <br/> <br/>
                </td>
            </tr>

            <tr>

                <td>
                    <?php if($filename==''){    

                            echo $form->hidden('generate',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'id'=>"generate",'value'=>'1'  ));
                        ?>
                        <button class="button" id="generatebackup" type="submit"><span> Generate Backup!</span> </button>   
                        <?php 
                            
                        }else{ 
                            echo $form->hidden('download',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'id'=>"generate",'value'=>'1'  ));   
                            echo $form->hidden('filename',array('label'=>'',"class" => "inpt_txt_fld",'div'=>false,'id'=>"generate",'value'=>$filename  ));   
                            ?> 
                            <button class="button" id="downloadbackup" type="submit"><span> Download Backup!</span> </button>   
                      <!--  <a href="/admins/get_project_backup_file/<?php //echo $filename;?>"><button class="button" id="downloadbackup" type="submit"><span> Download Backup!</span> </button></a> -->

                        <?php }?>

                    <?php 
                        //echo $form->submit('Submit', array('div'=>false,"class"=>"btn"));?> 
                </td></tr>

        </table>     
    </div>
       
     <?php                   echo $form->end();    ?>

    <div class="clear"></div>
</div>     
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {        
  //      document.getElementById("newcntlist").className = "newmidCont";
    }    
</script>




