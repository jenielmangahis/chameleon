<?php //debugbreak();
$server_path=$_SERVER['REQUEST_URI'];
$server_para=explode('/',$server_path);

if(isset($this->params['pass'][0]))
$opr = $this->params['pass'][0];
else
$opr = 'add';

//$id=$server_para[4];
$id = $this->data['SystemPricing']['id'];
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'system_pricing_list';
?>

<script type="text/javascript">
            function checkThis(str,id){
                str = str.replace('$', '');
                var num = new Number(str);
                if(/^[0-9]{0,3}(\.[0-9]{0,2})?$/.test(str) && num >= 0){
                    return true;
                } else {
                   inlineMsg(id,'<strong>Invalid Data</strong>',2);
                   return false;
                }
            }
            
            
            function append_dollar(str,id)
            {
                if(str=="")
                    str="00.00";
                
                str = str.replace('$', '');
                
                var num = new Number(str);
                str = num.toFixed(2);
                
                str="$"+str;
                $("#"+id).val(str);
            }
            
</script>

<script type="text/javascript">

function validate(){
   
     if($('#system_version_id').val() == '')
     {
         inlineMsg('system_version_id','<strong>Please Select Version</strong>',2);
         return false;
     }
    
     if($('#pricing_type').val() == '')
     {
         inlineMsg('pricing_type','<strong>Please Provide Pricing Type</strong>',2);
         return false;
     }
     
     
     var i=0;
     
     for(i=0;i<8;i++)
     {
         var id="monthly_price"+i;
         //alert(id);
         var str=document.getElementById(id).value;
         var status=checkThis(str,id);
         
         if(status)
         {           
         }
         else
            return false
     }
     
     
     for(i=0;i<8;i++)
     {
         var id="no_of_members"+i;
         //alert(id);
         var str=document.getElementById(id).value;
         
         if(isNaN(str))
         {
             inlineMsg(id,'<strong>Please enter only numbers</strong>',2); 
             return false        
         }
         
     }
     
   
     return true;
}
</script>

<div class="container">

<div class="titlCont1"><div style="width:960px;margin:0 auto">
       <?php echo $form->create("Admins", array('controller' => 'admins','action' => 'system_pricing/'.$opr.'/'.$id,'name' => 'system_pricing', 'id' => "system_pricing",'onsubmit' => 'return validate();'))?>
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
                        <li id="toggle"><a id="open" class="open" href="#."><span>Open Help Page</span></a><a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>               
                        </li>
                </ul> 
        </div>
</div>
<span class="titlTxt"><?php if($opr=="add") echo"Add";else echo"Edit";?> Monthly System Pricing Option </span>
<div class="topTabs">
     
          <ul>
                

        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                </ul>
        </ul>
        </div>
</div></div>
      <div class="boxBor1">
<br>
  <div class="boxPad">
  <div class="">




<div style="width: 960px; margin: 0pt auto; align:left;">     
 
<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="javascript:void(0);" onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
                    <?php  $session->flash();    ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php } ?>


<br /><br />

        
        <table width="100%" align="center" cellpadding="1" cellspacing="12">
        <tr>
            <td colspan='5'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('SystemPricing.pricing_type', array('class' => 'errormsg'));
                        ?></td>
        </tr>
        
        <tr>
        <td width="120" align="right">
        <label class="boldlabel">Copy From&nbsp;</label>
        </td>
        <td style="padding-top: 5px;">
        <span class="txtArea_top" style="margin-left: 20px;"><span class="txtArea_bot"><span id="prod_pri">
        <?php echo $form->select("SystemPricing.id",$sys_pri_data,null,array('label'=>'','id' => 'copy_from','class'=>'multilist','style'=>"margin-left: 5px;"),'Select One'); ?></span></span></span>
        </td>
       
        </tr>
        
        
        <tr>
        <td width="120" align="right"><label class="boldlabel">Relation Type <span class="red">*</span></label></td>
        <td>
        <?php  echo $form->radio("SystemPricing.relation_type", array('Direct'=>'Direct','3rd Party'=>'3rd Party'), array('default'=>'Direct','id'=>'relation_type', 'legend'=>false,'style'=>'margin-right:10px;margin-left:20px;')); ?>      
        </td>
        
        </tr>
        
        
        <tr>
        <td width="120" align="right"><label class="boldlabel">Version <span class="red">*</span></label></td>
        <td style="padding-top: 5px;">
        <span class="txtArea_top" style="margin-left: 20px;"><span class="txtArea_bot"><span id="prod_pri">
        <?php echo $form->select("SystemPricing.system_version_id",$sys_ver_data,null,array('label'=>'','id' => 'system_version_id','class'=>'multilist','style'=>"margin-left: 5px;"),'Select One'); ?></span></span></span>
        </td>
       
        </tr>
        
        <tr>
        <td width="120" align="right"><label class="boldlabel">Price Type<span class="red">*</span></label></td>
        <td style="padding-left: 20px;padding-top: 5px;">
         <span class="intpSpan">
        <?php echo $form->input("SystemPricing.pricing_type", array('id' => 'pricing_type', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",));?>
        </span>
        </td>
       
        </tr>
        
        <tr>
        <td width="180" align="right"><label class="boldlabel">Include Non Members</label></td>
        <td style="padding-left: 20px;">
        <?php echo $form->input("SystemPricing.inc_non_members", array('id' => 'inc_non_members','type'=>'checkbox' ,'div' => false, 'label' => ''));?>
        </td>
       
        </tr>
        <tr>
        <td width="180" align="right"><label class="boldlabel">Shopping Cart Enabled</label></td>
        <td style="padding-left: 20px;">
        <?php echo $form->input("SystemPricing.shopping_cart", array('id' => 'shopping_cart','type'=>'checkbox' ,'div' => false, 'label' => ''));?>
        </td>
        </tr>
        <tr>
        <td width="180" align="right"><label class="boldlabel">Super Footer Enabled</label></td>
        <td style="padding-left: 20px;">
        <?php echo $form->input("SystemPricing.super_footer", array('id' => 'super_footer','type'=>'checkbox' ,'div' => false, 'label' => ''));?>
        </td>
        </tr>
       </table>
       
        <table width="100%" align="center" cellpadding="0" cellspacing="5">
        
        <tr style="height: 15px;">
        <td colspan="10">&nbsp;</td>
        <td align="right"><b>Setup Fee <span class="red">*</span></b></td>
        </tr>
        
        <tr>
        <td valign="top" width="170" align="right" style="padding-right: 38px;padding-top: 5px;"><b>Monthly Price </b></td>
       
        <?php
	for($i=0;$i<8;$i++)
    {
?>
        <td align="right">
        <span class="intpSpan">
	
        <?php 
			echo $form->input("SystemPricing.monthly_price.$i", array('id' => 'monthly_price'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;text-align:right;",'onblur'=>" return append_dollar(this.value,'monthly_price$i')"));?>
        </span>
        </td>
        
<?php
    }
?>
        <td width="50">&nbsp;</td>
        <td align="center"><!--<b>Setups</b>-->
        <span class="intpSpan">
        <?php 
        if($opr=="add")
        {
            $setup_fee="$0.00";
        } 
         echo $form->input("SystemPricing.setup_fee", array('id' => 'setup_fee', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;text-align:right;",'onblur'=>" return append_dollar(this.value,'setup_fee')"));?>
        </span>
        </td>
        </tr>
        
        <tr>
        <td colspan="11"><hr style=" background-color: black; height: 1px;"></td>
        </tr>
        
        <tr>
        <td valign="top" width="120" align="right" style="padding-right: 38px;padding-top: 5px;"><b># of Members</b></td>
    <?php
    for($i=0;$i<8;$i++)
    {
	?>
        <td align="right">
        <span class="intpSpan">
        <?php echo $form->input("SystemPricing.no_of_members.$i", array('id' => 'no_of_members'.$i, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style" => "width:60px;text-align:right;"));?>
        </span>
        </td>
	<?php
    }
	?>
        </tr>
        </table>
        <table width="100%" align="center" cellpadding="1" cellspacing="5">
        <tr>
       <td valign='top' width="180" align="right" style="padding-right: 33px;">
       <label class="boldlabel">Notes </td>
       <td>
       <span class="txtArea_top">
       <span class="txtArea_bot"><?php echo $form->textarea("SystemPricing.note", array('id' => 'note', 'div' => false, 'label' => '','cols' => '30', 'rows' => '4',"class" => "noBg","style"=>"width:232px;"));?>
        </span>
        </span>
        </td>
        </tr>
         <!--<tr><td colspan="4"><b>Any item with a</b>  "<span class="red">*</span>"  <b>requires an entry.</b> </td></tr>-->
        </table>
        
<?php echo $form->end();?>
<!-- ADD Sub Admin  FORM EOF -->

</div></div></div></div>



<div class="clear"></div>


<!--container ends here-->

<script language="javascript" type="text/javascript">


    $(document).ready(function(){
        
        $("#copy_from").change(function(){

            var $this = $(this);
            var syspricingid = $this.val();
         
             if(syspricingid!=""){
                get_all_information(syspricingid);
            }
        });
        
    });
    
    
     function get_all_information(syspricingid){
			//alert('sss '+syspricingid);
            if ( syspricingid != "" && syspricingid != "undefined"){           
                var path = baseUrlAdmin+"get_sys_pricing";
                var postdata = {id : syspricingid};
                $.ajax({
                    type:"POST",
                    url: path,
                    cache:false,
                    data:postdata,
                    dataType:'json',
                    success: function(output){
                        
                        var num = new Number(output.setup_fee[0].system_pricings.setup_fee);
                        var setup_fee = num.toFixed(2);
                        setup_fee="$"+setup_fee;
                        $("#setup_fee").val(setup_fee);
                        
                        var i=0;   
                         for(i=0;i<8;i++)
                         {
                               if(output.entries[+i])
                               {
                                  var mo=output.entries[ + i ].system_monthly_pricings.monthly_price;
                                  var num = new Number(mo);
                                  var monthly_charge = num.toFixed(2);
                                  monthly_charge="$"+monthly_charge;
                                  $("#monthly_price" + i).val(monthly_charge);
                                  $("#no_of_members" + i).val(output.entries[ + i ].system_monthly_pricings.no_of_members);
                               }
                               else
                               {
                                    $("#monthly_price" + i).val("$0.00");
                                    $("#no_of_members" + i).val();
                               }
                                           
                              
                         }
                         

                    }
                });
            } 
        }
    
    </script>
    
<?php
if($id!="")
{
    ?>
        <script type="text/javascript">
        get_all_information(<?php  echo $id;?>);
        </script>
    <?php
}

?>