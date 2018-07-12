<script type="text/javascript">
	$(document).ready(function() {
		$('#prosMnu').removeClass("butBg");
		$('#prosMnu').addClass("butBgSelt");
	}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'prospects/projectmerchant'; 
    $emailval=$dt[0]['Project']['fromemail'];
    echo $javascript->link('ckeditor/ckeditor'); 
	//echo $cid;
?>

<script language="javascript">

</script>

 <div class="container">  
<div class="titlCont">

		<div class="centerPage">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php  echo $form->create("prospects", array("url" => "sendmail/$cid",'name' => 'sendmail', 'id' => "sendmail"));
            
			          
            echo $form->hidden("Company.id", array('id' => 'companyid', 'value'=>$current_company));  
			echo $form->hidden("addtype", array('id' => 'addtype','value'=>"$addtype"));
			echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$current_project_name"));
			echo $form->hidden("projectid", array('id' => 'projectid','value'=>"$project_id"));
			?>
            <?php  if($current_company_name){ echo '<span class="titlTxt1">'.$current_company_name.' :&nbsp</span>';}  ?>
            <span class="titlTxt"> Send Mail </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                             <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Send</span></button></li>
                              <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                    
                </ul>
            </div>
              <?php $this->loginarea="prospects";    $this->subtabsel='sendemail';   
			  echo $this->renderElement('prospect_inner_submenu');
	
			  ?>   
        </div></div>



<div class="midPadd" id="sndmail">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          
        <div class="top-bar" style="border-left:0px;">
        
        </div>		 
  
                
<div class="" style="border:none;">  
            <!-- START: New Design for send mail as per Requirement --> 
            <table cellspacing="5" cellpadding="0" align="left" width="100%">
            <tbody>
                <tr>
                    <td width="50%" valign="top">     
                        <table cellspacing="5" cellpadding="0" align="left" width="100%">
                            <tbody>
                                <tr>
                                    <td width="140px" align="right">  <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
                                        
                                            <label class="boldlabel">Select Template </label>

                                         
                                    </td>
                                    <td><span class="txtArea_top">
                                         <span class="txtArea_bot">
                                         <?php echo $form->select("EmailTemplate.id",isset($templatedropdown)?$templatedropdown:'',null,array('id' => 'templateid','class'=>'multilist','onchange'=>'showselecttemplate(this.value)'),"---Select---"); ?>
                                         <?php echo $form->error('EmailTemplate.id', array('class' => 'errormsg')); ?> 
                                         </span>     </span><br /><label style="font-size:11px;" >Select template or enter email content below </label></td>
                                </tr>

                                <tr>
                                    <td align="right">                                        
                                           <label class="boldlabel">Subject <span style="color: red;">*</span></label>
    
                                    </td>
                                    <td>
                                    <span class="intpSpan" style="vertical-align: top"> 
                                            <?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld","maxlength" => "250"));?>
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">
                                       
                                            <label class="boldlabel">Email from <span style="color: red;">*</span></label>

                                    </td>
                                    <td>
                                    <span class="intpSpan" style="vertical-align: top">
                                            <?php echo $form->input("EmailTemplate.fromid", array('id' => 'fromid', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld",'value'=>$emailval));?>
											<?php echo $form->input("Company.id", array('id' => 'id','value'=>"$cid")); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                       
                                            <label class="boldlabel">Email To <span style="color: red;">*</span></label>                              
                                        
                                    </td>
                                    <td>
                                    <span class="txtArea_top">
                                            <span class="newtxtArea_bot">
                                                <?php echo $form->input("EmailTemplate.toid", array('id' => 'toid', 'div' => false, 'label' => '','rows'=>'7','cols'=>'65','style' =>'width:230px;',"class" => "noBg",'value'=>$toid));?>
                                            </span>
                                        </span>
                                    </td>
                                </tr>



                            </tbody>
                        </table>  
                    </td>

                    <td width="50%" valign="top">
                             
                    </td>
                </tr>

                <tr>
                    <td valign="top" colspan="2"> <?php   echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));      ?> </td>
                </tr>       
                <tr>
                <td colspan="2"><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Send</span></button></td>
                </tr> 
                        
               <tr><td colspan="2"><div class="top-bar" style="text-align: left; padding-top: 5px; ">
                                        <?php  echo $this->renderElement('bottom_message');  ?>

                            </div></td></tr>
            </tbody>
        </table> 
           <!-- END : New Design for send mail as per Requirement -->  
                



    </div>
    <div class="clear"></div>


</div>
<?php echo $form->end();?>

 <div class="clear"></div>  

</div><!--inner-container ends here-->
                                          

<script type="text/javascript">

        
    if(document.getElementById("flashMessage")==null)
        document.getElementById("sndmail").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	


    $(document).ready(function() { 
        
        loadMemberEmails();  
        
         $("#member_type").change(function(){
            
            loadMemberEmails();  
        });

        $("#companytypeid").change(function(){
            
            loadContactEmails();  
        });

        $("#contactypeid").change(function(){
            loadContactEmails();  
        });

        $("#addrecipients").click(function(){
            addrecipients();  
        });
        
        function loadMemberEmails()
        {
        
            var current_domain=$("#current_domain").val();
            var member_type=$("#member_type").val();
            var companytypeid=$("#companytypeid").val();
            var contactypeid=$("#contactypeid").val();
            var iscompandcontact=$("#iscompandcontact").val();
              
            if(companytypeid=="" && contactypeid=="" && member_type==""){      
                  $("#member_type").removeAttr('disabled');    
                  $("#companytypeid").removeAttr('disabled');    
                  $("#contactypeid").removeAttr('disabled');    
                  
            }else if(member_type!="" ){
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled");
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled");
                
                var current_domain=$("#current_domain").val();
                  $.ajax({
                                url: baseUrlAdmin+'get_members_details_by_ajax/'+member_type,
                                cache: false,
                                success: function(html){ 
                                        $('#contactemails').hide();
                                        $('#contactemails').html(html);
                                        $('#contactemails').fadeIn(1000);   
                                        loadCheckFunction();
                                }
                   });
                 

            }else{
                if(iscompandcontact=="no"){
                   //   $("#member_type").val("all");   
                }else{
                    $("#companytypeid").val("");
                    $("#companytypeid").removeAttr('disabled');
                    $("#contactypeid").val("");
                    $("#contactypeid").removeAttr('disabled');
                    $("#member_type").val("");
                    $("#member_type").attr("disabled","disabled"); 
                }
               
            }
           
        
        }

        function loadContactEmails(){
            // var country_data = $(this).val();
            var current_domain=$("#current_domain").val();
            var member_type=$("#member_type").val();
            var companytypeid=$("#companytypeid").val();
            var contactypeid=$("#contactypeid").val();
            
            if(companytypeid=="" && contactypeid=="" && member_type==""){      
                  $("#member_type").removeAttr('disabled');    
                  $("#companytypeid").removeAttr('disabled');    
                  $("#contactypeid").removeAttr('disabled');    
                  
            }else if(companytypeid!="" || contactypeid!=""){
                $("#member_type").val("");
                $("#member_type").attr("disabled","disabled");
                var companytypeid=parseInt($("#companytypeid").val()); 
                if(isNaN(companytypeid)) { companytypeid=0;}    
                var contactypeid=parseInt($("#contactypeid").val()); 
                if(isNaN(contactypeid)) { contactypeid=0;}    

              //  alert(" P id"+" comp id "+companytypeid+" contact id "+contactypeid);
                //   var commnet_offset= parseInt($("#comment_offset").val());
                $('#contactemails').hide();
                  $.ajax({
                                url: baseUrlAdmin+'get_company_contacts_by_ajax/'+companytypeid+'/'+contactypeid,
                                cache: false,
                                success: function(html){
                                        $('#contactemails').html(html);
                                          $('#contactemails').fadeIn(1000);   
                                           loadCheckFunction();
                                }
                   });
                 
                
           }else{
                $("#companytypeid").val("");
                $("#companytypeid").attr("disabled","disabled"); 
                $("#contactypeid").val("");
                $("#contactypeid").attr("disabled","disabled"); 
                $("#member_type").val("");
                $("#member_type").removeAttr('disabled');
           }
           
        } 

        function loadCheckFunction(){  
            $("#checkall").click(function(){
                if( $('#checkall').is(':checked')==true){
                    $('.checkid').attr('checked','checked');
                }else{
                    $('.checkid').removeAttr('checked','checked');    
                }
            });
        }
        function addrecipients()
        {    
            var counter=0;
            var existlist = document.getElementById('toid').value;
            var existlistarr = existlist.split(",");
            var str ='';
            var chk = '';

            var id="";
            $('.checkid').each(function(){        
                var check = $(this).attr('checked')?1:0;

                if(check ==1)
                    {            
                    chk = ''; 
                    id=$(this).val(); 

                    for(j=0;j<existlistarr.length;j++){

                        if(existlistarr[j]==id){
                            chk ='set'; 
                            break;
                        }
                    }

                    if(chk==''){
                        str += id+',';    
                    }
                    counter=counter +1;
                }
            });    

            if(counter==0)
                {
                alert("Please select at least one recipient");
                return false;
            }else{    
                str = trim(str,",");
                document.getElementById('toid').value = trim(trim(document.getElementById('toid').value,',')+","+str,","); 

            }
        } 



    }); 
</script>
