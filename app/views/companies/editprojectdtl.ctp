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
            <table cellpadding="10" align="center" width="435px" class='left' cellspacing="10" style="margin-top:-5px;">
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
                            <td align="right"> <label class="boldlabel">Relation Type <span class="red">*</span></label></td>
                            <td><?php  echo $form->radio("Project.relation_type", array('Direct'=>'Direct','3rd Party'=>'3rd Party'), array('default'=>'Direct','id'=>'relation_type', 'legend'=>false,'style'=>'margin-right:5px;margin-left:5px;','class'=>'change_rel_type')); ?>     
                            </td>
                        </tr> 


                        <tr id="distributor_content">
                            <td align="right"> <label class="boldlabel">Distributor </label></td>
                            <td><br /><span class="intpSpan"><?php echo $form->input("Project.distributor", array('id' => 'distributor', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
                                </span>
                            </td>
                        </tr> 

                        <tr>
                            <td align="right" valign="top" style="padding-top: 10px;"> <label class="boldlabel">Coin Prices <span class="red">*</span></label></td>
                            <td><br />

                                <span class="txtArea_bot"><?php //echo $form->select("PricingType.pricing_types",$product_types,0,array('label'=>'','id' => 'pricing_types','class'=>'inpt_sel_fld','style'=>"margin-left: 20px;",'MULTIPLE'=>'Yes','size'=>'5'),'Select One'); ?>

                                    <div id="contactemails" style=" background: none repeat scroll 0 0 #EBEBEB;  border: 1px solid #D3D3D3; display: block; font-size: 13px; min-height: 125px; overflow: auto; width: 130%; margin-top: -8px;" > 
                                        <table width="100%">

                                            <tr>
                                                <th width="5%">Select</th>
                                                <th width="35%">Product Type</th>
                                                <th width="60%">Pricing Type Name</th>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><hr style="background-color: black;"></td>
                                            </tr>

                                            <?php 
                                                for($i=0;$i<count($product_type_names);$i++)
                                                {
                                                    if($selected_options[$i]==1)
                                                        $check="checked";
                                                    else
                                                        $check="";
                                                ?>
                                                <tr align="center">
                                                    <td><?php echo $form->input("price_type_options.$i", array('id' => 'price_type_options'.$i, 'div' => false, 'label' => '','type'=>'checkbox','checked'=>$check));?></td>
                                                    <td><?php echo  $product_type_names[$i]; ?></td>
                                                    <td><?php echo  $pricing_type_names[$i]; ?></td>
                                                </tr>
                                                <?php
                                                }

                                            ?>

                                        </table>            
                                    </div>


                                </span>

                            </td>
                        </tr> 

                        
                        <tr>
                        <td align="right"><label class="boldlabel">System Price</label></td>
                        <td style="padding-top: 10px;">
                        <span class="txtArea_top"><span class="txtArea_bot">
                        <?php echo $form->select("Project.system_pricing_id",$sys_pri_data,$data['Project']['system_pricing_id'],array('id' => 'system_pricing_id',"class"=>"multilist",'disabled'=>'disabled' ),"---Select---"); ?>
                        </span>
                        </span>
                        </td>
                        </tr>
                        
                        <tr >
                        <td align="right"><label class="boldlabel">Shopping Cart Enabled </label></td>
                        <td> <?php echo $form->input("Project.is_shoppingcartenabled", array('id' => 'is_shoppingcartenabled','type'=>'checkbox' ,'div' => false, 'label' => '','disabled'=>'disabled'));?></td>
                        </tr>
                        
                        <tr>
                        <td align="right"><label class="boldlabel"># of Coins</label></td>
                        <td>
                        <?php echo $totalnumunits; ?>
                        </td>
                        </tr>
                        
                        <tr>
                        <td align="right"><label class="boldlabel"># of Members</label></td>
                        <td>
                        <input type="text" value="<?php echo $members_cnt; ?>" id="members_cnt" style="border: none;">                        
                        </td>
                        </tr>
                        
                        <tr>
                        <td align="right"><label class="boldlabel"># of Non-Members</label>
                        
                        </td>
                        <td>
                        <input type="text" value="<?php echo $non_members_cnt; ?>" id="non_members_cnt" style="border: none; width: 50px;">                        
                        &nbsp;&nbsp;&nbsp;

                        <!--<input type="checkbox" name="data[Project][inc_non_members_in_charge]" id="inc_pricing" <?php // echo $checked;?>>-->
                        <?php echo $form->input("Project.inc_non_members_in_charge", array('id' => 'inc_pricing', 'div' => false, 'label' => '','type'=>'checkbox','disabled'=>'disabled'));?>
                        Include in Pricing ?
                        </td>
                        </tr>
                        
                        <tr>
                        <td align="right"><label class="boldlabel">Total # of Billing</label></td>
                        <td>
                        <!--<input type="text" name="data[Project][total_no_of_billing]" id="billing_cnt" style="border: none; width: 50px;"> -->
                        <?php echo $form->input("Project.total_no_of_billing", array('id' => 'billing_cnt', 'div' => false, 'label' => '','type'=>'text'));?>
                        </td>
                        </tr>
                        
                        <tr>
                        <td align="right"><label class="boldlabel">Current Monthly Charge</label></td>
                        <td style="padding-top: 0px;"><b>$</b>
                        <?php echo $form->input("Project.system_monthly_charge", array('id' => 'monthly_charge', 'div' => false, 'label' => '','style'=>'width:80px;font-weight:bold;'));?>
                        
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
                
                <tr> 
                            
                            <td align="right" width="45%" class="lbltxtarea" ><label class="boldlabel" style="padding-right: 15px;">User Agreement </label></td>
                            <td>
                                <span class="txtArea_top"><span class="txtArea_bot">
                                        <?php echo $form->select("Project.user_agreement_id",$agreementdropdown,$selectedagreement,array('id' => 'user_agreement_id',"class"=>"multilist" ),"---Select---"); ?>
                                    </span></span>
                            </td>
                        </tr>

                    <tr>
                
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
                
                <tr>
                        <td valign="top" align="right" class="lbltxtarea"><label class="boldlabel">Notes </label></td>
                        <td><span class="txtArea_top">
                                <span class="newtxtArea_bot">
                                    <?php echo $form->textarea("Project.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '27', 'rows' => '8',"class" => "noBg"));?>
                                </span></span>
                        </td>

                    </tr>

            </table>

        </div>
    </div>

    <!-- main tab -->


     <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
    <?php echo $form->end();?>

    <div class="clear"></div>

</div>




<div class="clear"></div>
<!-- Body Panel ends --> 


<script type="text/javascript">

$(document).ready(function()
{   
    var sys_pri_id=$("#system_pricing_id").val();
    //get_sys_pricing_info(sys_pri_id);
    
    var monthly_charge=$("#monthly_charge").val();
    var num = new Number(monthly_charge);
    var monthly_charge = num.toFixed(2);
    $("#monthly_charge").val(monthly_charge);
       
    $("#system_pricing_id").change(function(){
        var shop=1;
        var check="";
       get_sys_pricing_info(this.value,check,shop); 
        
    });
    
    $("#inc_pricing").change(function(){

       var sys_pri_id=$("#system_pricing_id").val();
       var check=0;
       var shop=1;
       if($("#inc_pricing").is(':checked')==true)
        {
           check=1; 
        }
        else
            check=0;      
       get_sys_pricing_info(sys_pri_id,check,shop);
    });
    
    function get_sys_pricing_info(sys_pri_id,check,shop)
    {
        var path = "http://<?php echo $current_domain; ?>/companies/get_sys_pricing_charge";
        var members=<?php echo $members_cnt;?>;
        var non_members=<?php echo $non_members_cnt;?>;
    
        var postdata = {id : sys_pri_id,mem:members,non_mem:non_members,check:check};
        $.ajax({
                    type:"POST",
                    url: path,
                    cache:false,
                    data:postdata,
                    dataType:'json',
                    success: function(output){
                        //console.log(output);
                        
                        var total_billing=output.total_billing;
                        
                        var monthly_charge=output.monthly_charge;
                        var num = new Number(monthly_charge);
                        var monthly_charge = num.toFixed(2);
                        
                                                
                        $("#monthly_charge").val(monthly_charge);
                        $("#billing_cnt").val(total_billing);
                        
                        if(output.sys_pri_info!="")
                        {
                            var inc_non_members=output.sys_pri_info;
                            
                            if(inc_non_members==1)
                            {
                                $("#inc_pricing").attr("checked","checked");
                            }
                            else
                            {
                                $("#inc_pricing").attr("checked","");
                            } 
                        }
                        
                        var shopping_cart=output.shopping_cart;
                        
                        if(shop==1 && shopping_cart==1)                       
                        {
                            $("#is_shoppingcartenabled").attr("checked","checked");
                        }
                        else
                            $("#is_shoppingcartenabled").attr("checked",""); 

                    }
                });
    }

});
</script>

<script>

    if(document.getElementById("distributor").value=="")
        {
        $("#distributor_content").hide();
    }
    else
        $("#distributor_content").show();

    $(".change_rel_type").change(function () {

        if($(this).val()=="3rd Party") 
            {

            $("#distributor_content").show();
            get_all_information($(this).val());
        }
        if($(this).val()=="Direct") 
            {
            $("#distributor_content").hide();
            get_all_information($(this).val());
        }
    });
</script>

<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("Detail").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	


    
    
    function get_all_information(rel_type){
        var type=1;
        var current_domain=$("#current_domain").val();
        if(rel_type=="Direct")
            type=1;
        else
            type=2;


        $('#contactemails').load('http://'+current_domain+'/companies/get_product_details/'+type, function(){
            //  $("#comment_start").val(commnet_offset);
            $('#contactemails').fadeIn(1000); 

        }); 
    }


/*
    $("#distributor").autocomplete("/companies/get_distributorcompanytype", {
        max: 4,
        scroll: true,
        width : 250,
        scrollHeight: 400,
        formatItem: function(data, i, n, value) { 
            // var imagepath = value.split(',')[0];
            if(value == "No Match Found")
                {
                return "No Match Found";
            }
            return value; 
        },
        formatResult: function(data, value) {
            if(value == "")
                {
                return;
            }
            return value; 
        }
    });    
    
*/
    $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
        var contactid=$("#contacts").val();
        if(contactid==null || contactid==""){
            alert("Please select a contact");
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
            alert("Please select a company");
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
            alert("Please select a coinset");
            return false;
        }else{
            var url="/companies/editcoinset/"+coinsetid;
            window.location=url;
        }


    });
</script>
