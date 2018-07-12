<script type="text/javascript">
$(document).ready(function() {
$('#projMng').removeClass("butBg");
$('#projMng').addClass("butBgSelt");
}); 
</script>  
<?php
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'status_type_list';
?>
<!--container starts here-->

<div class="titlCont"><div class="myclass">
<?php 
// 'onsubmit' => 'return validateStatusType("add");'
echo $form->create("Admins", array("action" => "status_type",'name' => 'statustype', 'id' => "statustype",'onsubmit' => 'return validateStatusType("add");'))?>
       <div id="toppanel" >
               <?php  echo $this->renderElement('new_slider');  ?>

</div>

  <span class="titlTxt">Status Type List</span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><a href="<?php echo $backUrl ?>"><span>Cancel</span></a></li>
                </ul>
        </div>
		<div style="clear:both;"></div>
		<?php $this->status_type_list="tabSelt"; echo $this->renderElement('project_list_submenu'); ?>
</div>
</div>
<div class="midCont" id="indxpage">

 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


<div class="boxBor1">
    <br>
    <div class="boxPad">
           <div style="width: 960px; min-height:230px; margin: 0pt auto; align:left;">     

                <?php if($session->check('Message.flash')){ ?> 
                    <div id="blck"> 
                        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
                        <div class="msgBoxBg">
    <div class=""><a href="javascript:void(0);" onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;position: absolute;z-index: 11;" /></a>
                                <?php  $session->flash();    ?> 
                            </div>
                            <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
                        </div>
                    </div>
                    <?php } ?>

                <table width="100%" align="left" cellpadding="1" cellspacing="1">
                    <tr>
                        <td colspan='3'>
						<?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('StatusType.status_type', array('class' => 'errormsg'));
                        ?>
						</td>
                    </tr>
                    <tr>
                        <td align="right">
                        
                        <label class="boldlabel">Status Type<span class="red">*</span></label></td>
                        <td width="auto">
                            <span class="intpSpan">
                                <label for="title"></label> 
                                <?php 
								echo $form->input("StatusType.id");
								echo $form->input("StatusType.status_type", array('id' => 'status_type', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                            </span>
                        </td>
                    </tr>
					
                    <tr>
                        <td align="right">
                        <div class="updat">
                        <label class="boldlabel">Default</label></div></td>
                        <td width="auto">
                           
							 <?php echo $form->input('StatusType.default', array('id' => 'default','type'=>'checkbox','div' => false, 'label' => '')); ?>  
							
                        </td>
                    </tr>
					<tr>
                        <td align="right">
                        
                        <label class="boldlabel">Note</label></td>
                        <td width="auto">
                            <span class="txtArea_top">
                                <span class="newtxtArea_bot"><?php echo $form->textarea("StatusType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>

                                </span></span>    
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <!-- ADD FIELD EOF -->      
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2">"<span class="red">*</span>"  <b>Required field.</b> 
                        </td></tr>
                    <tr><td>&nbsp;</td></tr>

                </table>
                

                <?php echo $form->end();?>
                <!-- ADD Sub Admin  FORM EOF -->

            </div></div></div>


<!--inner-container ends here-->
<?php echo $form->end();?>
                    
					<div class="clear"></div>
                    </div>  
					
<script type="text/javascript">
$(document).ready(function()
{
                        $('#checkall').bind('change',function(){
                        var check = $(this).attr('checked')?1:0;
                        if(check ==1)
                        {
                                        $('.checkid').each(function()
                                        {
                                                        $(this).attr('checked',true);

                                        });


                        }else{

                                        $('.checkid').each(function()
                                        {
                                                        $(this).attr('checked',false);

                                        });
                        }               

        })

});
$(document).ready(function()
{   
        $('.checkid').bind('change',function()
        {   
                //event.stopPropagation();
                var i=0;
                var j=0;
                $('.checkid').each(function(){
                        i++;
                        var check = $(this).attr('checked')?1:0;
                        if(check ==1)
                        {                       
                                j++;
                        }


                });
                
                if(i==j)
                        $('#checkall').attr('checked',true);
                else
                        $('#checkall').attr('checked',false);
        });
});



        function editholder()
        {       
        var counter=0;
        var id="";
        $('.checkid').each(function(){          
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {                       
                                id=$(this).val();
                                counter=counter +1;
                }
        });     
        
        if(counter!=1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{  
                document.getElementById("linkedit").href=baseUrlAdmin+"editprojecttype/"+id; 
                
                }
        } 



function activatecontents(act,op)
{   
    var id="";
        var count=0;
    $('.checkid').each(function(){       
        var check = $(this).attr('checked')?1:0;
        if(check ==1)
        {           
            if(id==""){
                id=$(this).val();
               
                ++count;
                }
                else
                {
                id=id + "*" + $(this).val();
                ++count;
                }
        }
   });
        if(id !=""){
                        if(op=="change"){       
                                if(act=="active"){
                                        if(confirm("Are you sure you want to Activate project(s)?"))   {
                                             window.location=baseUrlAdmin+"changestatus/"+id+"/Project/1/projectlist/cngstatus";      
                                        } 
                                        
                                        }else{
                                            if(confirm("Are you sure you want to Deactivate project(s)?"))   { 
                                                window.location=baseUrlAdmin+"changestatus/"+id+"/Project/0/projectlist/cngstatus";
                                            }
                                        }
                        }
                        if(op=="del"){
            if(confirm("You have selected "+count +" items to delete ?"))
            if(confirm("Are You Sure to delete the item"))
                        window.location=baseUrlAdmin+"changestatus/"+id+"/Project/0/projectlist/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}
</script>  
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
    {        
    document.getElementById("indxpage").className = "newmidCont";
    }    
</script>