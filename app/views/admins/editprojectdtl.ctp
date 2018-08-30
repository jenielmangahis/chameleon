<?php 
    //echo "<pre>";print_r($sponsor);
	$base_url_admin = Configure::read('App.base_url_admin');
	$backUrl = $base_url_admin.'editprojectdtl';
    $sp_name=$sponsor['Sponsor']['sponsor_name'];
    $datecre=$this->data['Project']['created'];
    $datecre = AppController::usdateformat($datecre,0);
	//pr($this->data);
?>

<div class="container clearfix">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
        	<div class="center-Page col-sm-6">
				<?php  //$prname =$this->data['Project']['project_name'];   ?>
                <h2>Edit Project Details</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Admin", array("action" => "editprojectdtl",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editprojectdtl', 'id' => "editprojectdtl",'onsubmit' => 'return validateproject("editdtl");'))?>
                     <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
                     <?php e($html->image('save.png')) ?>
                     </button>
                     <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
                     <?php e($html->image('apply.png')) ?>
                     </button>
                     <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>')">
                     <?php e($html->image('cancle.png')) ?>
                     </button>
                     <?php  echo $this->renderElement('new_slider');  ?>
                </div>
                
            </div>
            <div class="topTabs" style="height:25px;">
               <?php /*?> <ul>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl?>')"><span> Cancel</span></button></li>
                </ul><?php */?>
            </div>
        </div>
        
</div>
    
<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    
			$this->loginarea="admins";
			$this->subtabsel="editprojectdtl";
	   //     echo $this->renderElement('project_submenus');
		 echo $this->renderElement('setup_submenus');
		
		?>
    </div>
</div>     
    
<div class="midCont table-responsive id="Detail">   
    		<?php 
				echo $form->hidden("Project.id", array('id' => 'projectid'));
				echo $form->hidden("Sponsor.id", array('id' => 'sponsorid','value'=>$sponserid));
			?>
			
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    
        <div>	
            <div class="frmbox mgrt115">
                <table class="table table-borderless" cellpadding="0" align="center" width="435px" class='left' cellspacing="10" style="margin-top:-5px;">
                    <tbody>
			          <tr>  
                            <td width="36%" align="right" class="lbltxtarea"><label class="boldlabel">Project Name </label></td>
                            <td width="30%"><label for="detail_project_name"></label>
                                <span class="intp-Span"><?php echo $form->input("Project.detail_project_name", array('id' => 'detail_project_name','readonly' => true, 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td>

                        </tr>							

                        <tr style="display:none;"> 
                            <td  align="right" class="lbltxtarea"><label class="boldlabel">Serial # Prefix <span class="red">*</span></label></td>
                            <td><label for="serialprefix"></label>
                                <span class="intp-Span">
                                <?php echo $form->input("Project.serialprefix", array('id' => 'serialprefix', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "3"));?></span></td>

                        </tr>
                        <?php 
						$arraycoinset = array();
						if(!empty($coinsetsdisplay)){
						foreach($coinsetsdisplay as $key=>$value ) {


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
                                <div class="txtArea-top">
                                    <span class="newtxtArea-bot">
                                        <?php 
										
										echo $form->select('coinsetsdisplay',$arraycoinset, null,array('multiple'=>'multiple','id'=>'emaillists','size'=>'7','empty'=>false,'class'=>'multilist multi form-control'));?>
                                    </span>
                                </div>
                                <span class="btn-Lft"><input type="button" class="btn-Rht btn btn-sm btn-primary" value="View" name="view" id="view_coinset"/></span><span style="display:inline-block;width:8px"></span><span class="btn-Lft"><input type="button"  class="btn-Rht btn btn-sm btn-primary" value="Add" name="Add" ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>addcoinset')" /></span>
                            </td> 
                        </tr>


                       
                        <tr id="distributor_content">
                            <td align="right"> <label class="boldlabel">Distributor </label></td>
                            <td><br /><span class="intp-Span"><?php echo $form->input("Project.distributor", array('id' => 'distributor', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
                                </span>
                            </td>
                        </tr> 

                        <tr >
                        <td align="right"><label class="boldlabel">Shopping Cart Enabled </label></td>
                        <td> <?php echo $form->input("Project.is_shoppingcartenabled", array('id' => 'is_shoppingcartenabled','type'=>'checkbox' ,'div' => false, 'label' => ''));?></td>
                        </tr>

						<style>
							.rightAlignNumber {
							display:block;
							width: 50px;
							text-align: right;
							float: left;
						}
				</style>
                        <tr >
                        <td align="right"><label class="boldlabel">Include Non-Members</label></td>
                        <td> <?php echo $form->input("Project.include_NonMembers", array('id' => 'is_shoppingcartenabled','type'=>'checkbox' ,'div' => false, 'label' => ''));?></td>
                        </tr>
                    <?php if(isset($this->data['Project']['id'])){ ?>
<tr>
                    <td align="right" width="150px"> <label class="boldlabel"># of Coins <span class="red">*</span></label></td>
                    <td><span class="rightAlignNumber"><?php echo $totalnumunits; ?></span></td>
				</tr>
<?php } ?>
                        
  <?php if(isset($this->data['Project']['id'])){ ?>
					<tr>
                        <td  align="right"><label class="boldlabel"># of Members</label></td>
						 <td>
						 <span class="rightAlignNumber">
						 <?php 
						 echo $members_cnt;
						 //echo $form->input("projects.members_cnt", array('id' => 'billing_cnt', 'div' => false, 'label' => '','type'=>'text','value'=>$members_cnt));?>
						</span>				
						 </td>
				 </tr>
<?php } ?>
<?php if(isset($this->data['Project']['id'])){ ?>
	 <tr>
		<td align="right"><label class="boldlabel"># of Non-Members</label></td>
		<td align="left">
		<span class="rightAlignNumber"><?php echo $non_members_cnt; ?></span>
			&nbsp;&nbsp;&nbsp;&nbsp;
		<div style="float:left; width: 145px;padding-left: 17px;">
		<?php 
		echo $form->input("Project.inc_non_members_in_charge", array('id' => 'inc_pricing', 'div' => false, 'label' => '','type'=>'checkbox'));?>
		Include in Pricing
		</div>
		</td>
	</tr>
	<?php } ?>
                        
<?php if(isset($this->data['Project']['id'])){ ?>
<tr style="height: 22px;">
                        <td  align="right" style="padding-bottom: 10px; width: 165px;" ><label class="boldlabel">Total # for Billing</label></td>
						 <td><span class="rightAlignNumber"><?php  echo $total_billing_cnt; ?></span></td>
				
                </tr>
<?php } ?>
                        
                        <tr>
                        <td align="right"><label class="boldlabel">Current Monthly Charge</label></td>
                        <td style="padding-top: 0px;"><b>$</b>
                        <?php echo $form->input("Project.system_monthly_charge", array('id' => 'monthly_charge', 'div' => false, 'label' => '','style'=>'width:80px;font-weight:bold;'));?>
                        
                        </td>
                        </tr>

						<tr>
                        <td align="right"><label class="boldlabel">Current Billing Type</label></td>
                        <td style="padding-top: 0px;">
                        <span class="txtArea-top"><span class="txtArea-bot">
                                <?php 
								//pr($billingType_list);
								echo $form->select("Project.billing_type_id",$billingType_list,null,array('id' => 'billing_type_id',"class"=>"multilist form-control",'disabled'=>'disabled' ),"---Select---"); ?>
                        </span></span>
                        
                        </td>
                        </tr>
                       <tr>
                        <td align="right"><label class="boldlabel">Next Billing Date</label></td>
                        <td style="padding-top: 0px;">
                       <span class="intp-Span"><label for="title"></label>   <?php echo $form->input("Project.next_billing_date", array('id' => 'next_billing_date','readonly' => true,'value'=> isset($nextBdate)?$nextBdate:'', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200"));?>
                    </span>
                        
                        </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="frmbox">
                <table cellspacing="10" class='left' width="432px" style="margin-top:-5px;">
                    <tr>
                        <td align="right" class="lbltxtarea"><label class="boldlabel">Date Created </label></td>
                        <td ><span class="intp-Span"><?php echo $form->text("createddate", array('value'=>$datecre,'id' => 'created', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'readonly'=>'readonly'));?></span></td>
                    </tr>
                     <tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Legal Entity Name <span class="red">*</span> </label></td>
                        <td><span class="intp-Span"><?php echo $form->input("sponsorname", array('id' => 'sponsorname', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "200",'value'=>$sp_name,'readonly'=>'readonly'));?></span></td>
                    </tr>
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Notification Email<span class="red">*</span> </label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->input("Sponsor.email", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
						</span>
						</td>
                    </tr>
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Address 1<span class="red">*</span> </label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->input("Sponsor.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
						</span>
						</td>
                    </tr>
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Address 2</label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->input("Sponsor.address2", array('id' => 'email', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
						</span>
						</td>
                    </tr>
					
					<tr>
      <td align="right"><label class="boldlabel">Country <span class="red">*</span></label></td>
      <td><label for="project_name"></label>
       <span class="txtArea-top">
                                
								<span class="txtArea-bot">
                                    <span id="compdiv"> <?php echo $form->select("Sponsor.country",$countrydropdown,null,array('id' => 'country','class'=>'multilist form-control','onchange'=>'return getstateoptions(this.value,"Company")'),array('254'=>'United States')); ?></span></span></span></td>
     
    </tr>
	<tr>
      <td align="right"><label class="boldlabel">State <span class="red">*</span></label></td>
      <td><label for="project_name"></label>
        <span class="txtArea-top">
                                
								<span class="txtArea-bot">
                                   <span id="statediv">
                                    <?php echo $form->select("Sponsor.state",$statedropdown,null,array('id' => 'state',"class" => "multilist form-control"),"---Select---"); ?></span></span></span></td>
      
    </tr>
     <tr>
      <td align="right"><label class="boldlabel">Zip/Postal Code <span class="red">*</span></label></td>
      <td><label for="project_name"></label>
        <span class="intp-Span"><?php echo $form->input("Sponsor.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "10"));?></span></td>
      
    </tr>
    <tr>
      <td align="right"><label class="boldlabel">City <span class="red">*</span></label></td>
      <td ><label for="project_name"></label>
        <span class="intp-Span"><?php echo $form->input("Sponsor.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150")); ?></span></td>
     
    </tr>
	
					<tr>
						<td colspan="2" style="height:30px;">&nbsp;</td>
					</tr>
					<!------
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Login ID<span class="red">*</span> </label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->input("User.username", array('id' => 'username', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150",'value'=>$user_name,'readonly'=>true,'onchange' => 'ajaxuniquesponsorname(this.value)'));?>
						</span>
						</td>
                    </tr>
					
					
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Old Password<span class="red">*</span> </label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->password("User.old_password", array('id' => 'old_password', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span>
						</td>
                    </tr>
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">New Password<span class="red">*</span> </label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->password("User.new_password", array('id' => 'new_password', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span>
						</td>
                    </tr>
					
					<tr>
                        <td  align="right" class="lbltxtarea"><label class="boldlabel">Confirm Password<span class="red">*</span> </label></td>
                        <td>
						<span class="intp-Span"><?php echo $form->password("User.con_password", array('id' => 'con_password', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?></span>
						</td>
                    </tr>
					
					----->
			</table>

            </div>

        </div>
    </div>


    <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
    <?php echo $form->end();?>
</div>


<div class="clear"></div>

<script type="text/javascript">

$(document).ready(function()
{   
    var sys_pri_id=$("#system_pricing_id").val();
    var check=0;
    var shop=0;
    if($("#inc_pricing").is(':checked')==true)
        {
           check=1; 
        }
        else
            check=0;      
            
     if($("#is_shoppingcartenabled").is(':checked')==true)
        {
           shop=1; 
        }
        else
            shop=0;      
    
   // get_sys_pricing_info(sys_pri_id,check,shop);
    
    
    
    var monthly_charge=$("#monthly_charge").val();
    var num = new Number(monthly_charge);
    var monthly_charge = num.toFixed(2);
    $("#monthly_charge").val(monthly_charge);
    
    
       
    $("#system_pricing_id").change(function(){
        var shop=1;
        var check="";
       //get_sys_pricing_info(this.value,check,shop); 
        
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
        var path = baseUrlAdmin+"get_sys_pricing_charge";
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

<script type="text/javascript">
   if(document.getElementById("flashMessage")==null)
        document.getElementById("Detail").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	 
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



<script language="javascript">


    function get_all_information(rel_type){
        var type=1;
        var current_domain=$("#current_domain").val();
        if(rel_type=="Direct")
            type=1;
        else
            type=2;


        $('#contactemails').load('http://'+current_domain+'/admins/get_product_details/'+type, function(){
            //  $("#comment_start").val(commnet_offset);
            $('#contactemails').fadeIn(1000); 

        }); 
    }

    $("#view_contact").click(function(){   
        var current_domain=$("#current_domain").val();
        var contactid=$("#contacts").val();
        if(contactid==null || contactid==""){
            alert("Please select a contact");
            return false;
        }else{
            var url="http://"+current_domain+"/admins/addcontacts/"+contactid;
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
            var url="http://"+current_domain+"/admins/addcompany/"+companiesid;
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
            var url=baseUrlAdmin+"editcoinset/"+coinsetid;
            window.location=url;
        }


    });
/*
    $("#distributor").autocomplete("/admins/get_distributorcompanytype", {
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
    
 
</script>


<script type="text/javascript">
/*
function view_coinset_id()  
    {
        //alert("asda");
        var current_domain=$("#current_domain").val();
        var coinsetid=$("#emaillists").val();
       
        if(coinsetid==null || coinsetid==""){
            alert("Please select a coinset");
            return false;
        }else{
            var url="http://"+current_domain+"/admins/editcoinset/"+coinsetid;
            window.location=url;
        }
    }
    
    function view_contact_id()
    {
        var current_domain=$("#current_domain").val();
        var contactid=$("#contacts").val();
        if(contactid==null || contactid==""){
            alert("Please select a contact");
            return false;
        }else{
            var url="http://"+current_domain+"/admins/addcontacts/"+contactid;
            window.location=url;
        }
    }
    
    
    function view_company_id()
    {   
        var current_domain=$("#current_domain").val();
        var companiesid=$("#companies").val();
        if(companiesid==null || companiesid==""){
            alert("Please select a company");
            return false;
        }else{
            var url="http://"+current_domain+"/admins/addcompany/"+companiesid;
            window.location=url;
        }
    }

*/

</script>