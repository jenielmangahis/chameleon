<?php $dt=$value[0]['GetStart']['getdata'];?>

<div class="container">
    <div class="titlCont"><div class="myclass">
            <div align="center" id="toppanel" >
                <?php 

                    # set help condition

                    App::import("Model", "HelpContent");

                    $this->HelpContent =  & new HelpContent();

                    $condition = "HelpContent.id = '37'";  

                    $hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

                    $this->set("hlpdata",$hlpdata);

                    # set help condition   

                    echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("Company", array("action" => "getstart",'name' => 'getstart', 'id' => "getstart")); ?>
            <span class="titlTxt">
                Get Started
            </span>
            <div class="topTabs" ><ul>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span> Cancel</span></button></li>
                </ul>
            </div>
            <!-- <div style="height: 30px; clear:both;">
            <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
            <li><a href="/companies/editprojectdtl"><span>Details</span></a></li>
            <li><a href="/companies/coinsetlist"><span>Coinsets</span></a></li>
            <li><a href="/companies/projectsponsor"><span>Sponsor</span></a></li>
            <li><a href="/companies/companylist"><span>Companies</span></a></li>
            <li><a href="/companies/contactlist"><span>Contacts</span></a></li>
            <li><a href="/companies/projectcompanytypes"><span>Company Type</span></a></li>
            <li><a href="/companies/projectcontacttypes"><span>Contact Type</span></a></li>
            <li><a href="/companies/projectbackup"><span>Project Backup</span></a></li>   
            <li><a href="/companies/getstart" class="tabSelt"><span>Get Started</span></a></li>
            </ul>

            </div>   </div>   -->
            <?php  $this->loginarea="companies";    
                $this->subtabsel="getstart";
                echo $this->renderElement('setup_submenus');  ?> 

        </div></div>

        <div class="midCont"  >	
        <table width="100%" align="center" cellpadding="1" cellspacing="1">
            <tr>
                <td width="100%" colspan=2 style="vertical-align:top" >
                    <?php echo $dt;?>
                </td>
            </tr>
            <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>	
        </table>
    </div>
</div>
   <?php       echo $form->end(); ?>

<div class='clear'></div>

