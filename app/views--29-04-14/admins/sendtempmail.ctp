<?php 
	$base_url_admin = Configure::read('App.base_url_admin');
	$backUrl = $base_url_admin.'memberemails/'.$recordid;
    echo $javascript->link('ckeditor/ckeditor'); 
	$cancleurl='players/playerslist/company';
?>

<script language="javascript">

</script>

 <div class="container">  
<div class="titlCont"><div style="width:960px; margin:0 auto;">
            

<div align="right" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width: 485px !important;text-align:right">
                <?php  //echo $this->renderElement('new_slider');  ?>
	         <?php echo $form->create("Admins", array("url" => "sendtempmail/$recordid",'name' => 'sendtempmail', 'id' => "sendtempmail")); ?>			
				

	<button class="sendBut" type="submit" value="Submit" name="data[Action][redirectpage]">
		
		<?php e($html->image('send.png')) ?>
		</button>

<?php
$ids = $this->params['pass'][0]; 
e($html->link($html->image('back.png') . ' ' . __(''), $base_url_admin."editholder/".$ids,array('escape' => false)));?>
<?php /*?><button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $cancleurl ?>')"><?php //e($html->image('cancle.png')) ?></button><?php */?>
<?php e($html->link($html->image('cancle.png') . ' ' . __(''), array('controller'=>'players','action'=>'playerslist','company'),array('escape' => false))); 
 echo $this->renderElement('new_slider'); 

?>


<?php //e($html->link($html->image('cancle.png', array('width' => '42', 'height' => '41')) . ' ' . __(''), $base_url_admin."coming_soon/help",array('escape' => false)));

?>
		
		
		
            </div>
   
     
              <span class="titlTxt"> Send Mail </span>
            
            <div class="topTabs" style="height:25px;">
                <!--<ul class="dropdown">
                              
                              <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                    
                </ul>-->
            </div>
			<div class="clear"></div>
			
            <?php    $this->loginarea="admins";    $this->subtabsel="emails";

if($_GET['url'] === 'admins/sendtempmail/0'){
?><div style=""><?php
	echo $this->renderElement('players/advertiser_submenu'); 
	?></div><?php
}
else if($_GET['url'] === 'admins/sendtempmail/company'){
?><div style=""><?php
	echo $this->renderElement('players/playermerchant_submenus'); 	
?></div><?php
	}
elseif($_GET['url'] === 'admins/sendtempmail/sendmail'){
?><div><?php
	echo $this->renderElement('relationships_submenus'); 
	?></div><?php
}
else{
			echo $this->renderElement('member_submenus'); 
}
			 ?>  
        </div></div>



<div class="midPadd" id="sndmail">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } 
	
	
	?>          
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
		<td align="right">
			<label class="boldlabel">Email To <span style="color: red;">*</span></label>                              
		</td>
		<td>
			 <?php
					if(!empty($toid) && isset($toid)){	echo $toid;	}else{	echo "john@gosocialpartners.com"; }	?>
		</td>
	</tr>
								
 	<tr>
		<td width="140px" align="right">  <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
                                        
		<label class="boldlabel">Select Template </label>                                     
                                    </td>
                                    <td><span class="txtArea_top">
                                         <span class="txtArea_bot">
                                         <?php echo $form->select("EmailTemplate.id",isset($templatedropdown)?$templatedropdown:'',null,array('id' => 'templateid','class'=>'multilist','onchange'=>'showselecttemplate(this.value)'),"---Select---"); ?>
                                         <?php echo $form->error('EmailTemplate.id', array('class' => 'errormsg')); ?> 
                                         </span>     </span></td>
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
                                            <?php echo $form->input("EmailTemplate.fromid", array('id' => 'fromid', 'div' => false, 'label' => '','style' =>'width:231px;',"class" => "inpt_txt_fld",'value'=>$adminmail));?>
                                        </span>
                                    </td>
                                </tr>
                         



                            </tbody>
                        </table>  
                    </td>

                    <td width="50%" valign="top">
                        <table cellspacing="10" cellpadding="0" align="center" width="100%">
                            <tbody>
                               

                             
                               

                            </tbody>
                        </table>      
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

       

        $("#addrecipients").click(function(){
            addrecipients();  
        });
      
        function loadMemberEmails()
        {
        	
            var current_domain=$("#current_domain").val();
            var member_type = $("#member_type").val();

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
