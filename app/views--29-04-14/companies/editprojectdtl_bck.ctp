<?php 
    $datecre=$this->data['Project']['created'];
    $datecre = AppController::usdateformat($datecre,1);
?>
   <div class="container">
    <div class="titlCont"><div style="width:960px; margin:0 auto;">
        <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>
        <span class="titlTxt">     Edit Project Details   </span>
        <?php echo $form->create("Company", array("action" => "editprojectdtl",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editprojectdtl', 'id' => "editprojectdtl"))?>
        <div class="topTabs">
        <ul>
            <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
            <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
            <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/editprojectdtl')"><span> Cancel</span></button></li>
        </ul>
    </div>

     <!--   <div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
        <div style="height: 30px; clear:both;">
         <div id="tab-container-1">
            <ul id="tab-container-1-nav" class="topTabs2">
                <li><a href="/companies/editprojectdtl" class="tabSelt"><span>Details</span></a></li>
                <li><a href="/companies/coinsetlist"><span>Coinsets</span></a></li>
                 <li><a href="/companies/projectsponsor"><span>Sponsor</span></a></li>
                <li><a href="/companies/companylist"><span>Companies</span></a></li>
                <li><a href="/companies/contactlist"><span>Contacts</span></a></li>
                <li><a href="/companies/projectcompanytypes"><span>Company Type</span></a></li>
                <li><a href="/companies/projectcontacttypes"><span>Contact Type</span></a></li>
                <li><a href="/companies/projectbackup"><span>Project Backup</span></a></li>
                <li><a href="/companies/getstart"><span>Get Started</span></a></li>
            </ul>
        </div>
    </div>      -->

          <?php     $this->loginarea="companies";    
                    $this->subtabsel="editprojectdtl";
                    echo $this->renderElement('project_submenus');  ?>   

        </div>
    </div>

        <div class="midCont"  id="Detail">

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


        <div class="frmbox mgrt115">
            <table cellpadding="10" align="center" width="425px" class='left' cellspacing="10" style="margin-top:-5px;">
                <tbody>    
                    <tr>
                        <td width="32%" align="right" class="lbltxtarea"><label class="boldlabel">Project Name </label></td>
                        <td width="30%"><label for="detail_project_name"></label>
                            <span class="intpSpan"><?php echo $form->input("Project.detail_project_name", array('id' => 'detail_project_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>

                    </tr>                            

                    <tr>
                        <td align="right" width="45%" class="lbltxtarea" ><label class="boldlabel" style="padding-right: 15px;">System Project Name </label></td>
                        <td width="30%"><label for="project_name"></label>
                            <span class="intpSpan"><?php echo $form->input("Project.project_name", array('id' => 'project_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>

                    </tr>
                    <tr style="display:none;">
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Serial # Prefix <span class="red">*</span></label></td>
                        <td><label for="serialprefix"></label>
                            <span class="intpSpan">
                            <?php echo $form->input("Project.serialprefix", array('id' => 'serialprefix', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "3"));?></span></td>
                    </tr>
                    <!--tr>

                    <td><label class="boldlabel">Project Type:</label></td>
                    <td>
                    <span class="txtArea_top" style="width:0px">
                    <span class="txtArea_bot"><?php //echo $form->select("project_type_id",$projectypedropdown,$selectedprojecttype,array('id' => 'project_type_id','disabled'=>'disabled'),"---Select---"); ?></span></span></td>

                    </tr--> 



                    <?php if(!empty($coinsetsdisplay)){  foreach($coinsetsdisplay as $key=>$value ) {


                                $coinsetname = $value;
                                if(preg_match('/[A-Z]{3}/', $coinsetname)==1){
                                    $coinsname= preg_split('/[A-Z]{3}/', $coinsetname);
                                    $coinsetname=$coinsname[1];
                                }
                                $arraycoinset[$key]=$coinsetname;




                            }
                        }
                    ?>
                    <tr>
                        <td valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Project Coinsets </label></td>
                        <td>
                            <div class="txtArea_top">
                                <span class="newtxtArea_bot">
                                    <?php echo $form->select('coinsetsdisplay',$arraycoinset, null,array('multiple'=>'multiple','id'=>'emaillists','size'=>'7','empty'=>false,'class'=>'multilist multi'));?>
                                </span>
                            </div>

                            <span class="btnLft"><input type="button"  class="btnRht" value="View" name="view" id="view_coinset" /></span>
                            <span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" class="btnRht" value="Add" name="Add" ONCLICK="javascript:(window.location='/companies/addcoinset')" /></span>

                        </td> 
                    </tr>


                    <tr>
                        <td valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Notes </label></td>
                        <td><span class="txtArea_top">
                                <span class="newtxtArea_bot">
                                    <?php echo $form->textarea("Project.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '27', 'rows' => '8',"class" => "noBg"));?>
                                </span></span>
                        </td>

                    </tr>

                    <tr><td colspan='2'>&nbsp;</td></tr>

                </tbody>
            </table>

        </div>

        <div class="frmbox">
            <table cellpadding="10" class='left' width="425px" cellspacing="10" style="margin-top:-5px;">
                <tr>
                    <td  align="right" class="lbltxtarea"><label class="boldlabel">Date Entered </label></td>
                    <td ><span class="intpSpan"><?php echo $form->text("createddate", array('value'=>$datecre,'id' => 'created', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
                </tr>
                <tr style="height: 22px;">
                    <td  align="right" style="padding-bottom: 10px;"><label class="boldlabel"># of Units </label></td>
                    <td style="padding-bottom: 10px;"><?php echo $form->hidden('Project.numunits',array('value'=>$totalnumunits));echo $totalnumunits; ?></td>
                </tr>
                <tr>
                    <td  align="right" class="lbltxtarea"><label class="boldlabel">Sponsor </label></td>
                    <td><span class="intpSpan"><?php echo $form->input("sponsorname", array('id' => 'sponsorname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
                </tr>

                <tr>
                    <td valign="top"  align="right" class='lbltxtarea'><label class="boldlabel">Company </label></td>
                    <td>
                        <div>
                            <span class="txtArea_top" >
                                <span class="newtxtArea_bot">
                                    <?php echo $form->select('companies',$companies, null,array('multiple'=>'multiple','id'=>'companies','size'=>'7','empty'=>false,'class'=>'multilist multi'));?>
                                </span>
                            </span>
                        </div>
                    <span class="btnLft"><input type="button" value="View"  class="btnRht" name="view" id="view_company"  /><span><span style="display:inline-block;width:8px"></span><span class="btnLft"><input type="button" value="Add" class="btnRht" name="Add" ONCLICK="javascript:(window.location='/companies/addcompany')" /></span> </td>
                </tr>

                <tr>
                    <td valign="top"  align="right" class='lbltxtarea'><label class="boldlabel">Contacts </label></td>
                    <td>
                        <div >
                            <span class="txtArea_top">
                                <span class="newtxtArea_bot">
                                    <?php echo $form->select('contacts',$contacts, null,array('multiple'=>'multiple','id'=>'contacts','size'=>'10','empty'=>false,'class'=>'multilist multi'));?>
                                </span>
                            </span>
                        </div>
                        <span class="btnLft">
                            <input type="button"  class="btnRht" value="View" name="view" id="view_contact"   /></span>
                        <span style="display:inline-block;width:8px"></span><span class="btnLft">
                            <input type="button"  class="btnRht" value="Add" name="Add" ONCLICK="javascript:(window.location='/companies/addcontacts')" />
                        </span></td>
                </tr>

            </table>

        </div>
    </div>

    <!-- main tab -->


    <?php echo $form->end();?>

    <div class="clear"></div>

</div>




<div class="clear"></div>
<!-- Body Panel ends --> 
<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("Detail").style.paddingTop = '24px';
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
            var url="/companies/addcontacts/"+contactid;
            window.location=url;
        }


    });


    $("#view_company").click(function(){   
        var current_domain=$("#current_domain").val();
        var companiesid=$("#companies").val();
        if(companiesid==null || companiesid==""){
            return false;
        }else{
            var url="/companies/addcompany/"+companiesid;
            window.location=url;
        }


    });

    $("#view_coinset").click(function(){   
        var current_domain=$("#current_domain").val();
        var coinsetid=$("#emaillists").val();
        if(coinsetid==null || coinsetid==""){
            return false;
        }else{
            var url="/companies/editcoinset/"+coinsetid;
            window.location=url;
        }


    });
</script>
