<style type="text/css">
    .spnclass {display:inline-block; margin-right:10px;}

    fieldset {
        border: 1px solid #DCE1E1;
        display: block;
        margin-bottom: 1em;
        padding: 5px;
        width: 450px;

    }

    div#qrimg {
        /*border: 2px solid #DCE1E1;*/
        display: inline;
        float: left;
        padding: 10px 3em;
        text-align: center;
        width: 80%;
    }

    .qrcodeimgcls{
        border: 2px solid #DCE1E1;    
    }
</style>

<div class="titlCont"><div class="myclass">
        <div align="center" class="slider" id="toppanel">
               <?php  echo $this->renderElement('new_slider');  ?>   
        </div>
              
        <span class="titlTxt">
            QR- Code Generator
        </span>
        <div class="topTabs">
            <ul class="dropdown">
              <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/contentlist')"><span> Cancel</span></button></li>  
            </ul>
        </div>



       <?php    $this->loginarea="companies";    $this->subtabsel="qrcodegenerate";
             echo $this->renderElement('websites_submenus');  ?>  
</div></div>



<!--inner-container starts here-->

<!--inner-container starts here-->

<div class="midCont1">




<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


<!-- top curv image starts -->

<!-- ADD Sub Admin  FORM EOF -->
 <?php echo $form->create("companies", array("action" => "qrcodegenerate",'name' => 'qrcodegenerator', 'id' => "qrcodegenerator", 'onsubmit' => "javascript : return validateQRData(this.value);")); 
 
 ?> 
<div style="border: 1px solid #CFCFCF;  line-height: 25px;      ">
<table  style="border: 1px solid #CFCFCF;  line-height: 25px; " cellspacing="5"  width="100%" class="border_shadow">
            <tr>
                <td width="60%" style="border-right: 2px solid #CFCFCF;" valign="top">
                
                    <b>QR- Code Generator </b>

                    <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>">

                    <fieldset>
                        <legend style="font-weight: bold; padding: 0pt 5px;">Content type:</legend>
                        <p>
                            <input type="hidden" name="qr_cnt_frmt" id="qr_cnt_frmt" value="" />

                            <input  checked="checked"   type="radio" name="qr_cnt_type" id="qr_cnt_type_url" value="qr_cnt_type_url"  <?php if(isset($qr_cnt_type) &&  $qr_cnt_type=="qr_cnt_type_url") {?> checked="checked" <?php } ?>/>
                            <label style="display: inline-block; width: auto; text-align: left; margin-bottom: 3px; margin-right: 10px;" for="qr_cnt_type_url">URL</label>

                         <!--   <input  type="radio" name="qr_cnt_type" id="qr_cnt_type_text" value="qr_cnt_type_text"  />
                            <label style="display: inline-block; width: auto; text-align: left; margin-bottom: 3px; margin-right: 10px;" for="qr_cnt_type_text">Text</label>


                            <input  type="radio" name="qr_cnt_type" id="qr_cnt_type_tel" value="qr_cnt_type_tel" />
                            <label style="display: inline-block; width: auto; text-align: left; margin-bottom: 3px; margin-right: 10px;" for="qr_cnt_type_tel">Phone Number</label>

                            <input type="radio" name="qr_cnt_type" id="qr_cnt_type_sms" value="qr_cnt_type_sms" />
                            <label style="display: inline-block; width: auto; text-align: left; margin-bottom: 3px; margin-right: 10px;" for="qr_cnt_type_sms">SMS</label> -->
                        </p>

                    </fieldset>
                    <fieldset>
                        <legend style="font-weight: bold; padding: 0pt 5px;">Content:</legend>

                        <p>
                            <span id="fs">
                                <label style="display: inline-block; width: 150px; text-align: left; margin-right: 16px;  margin-bottom: 10px; vertical-align: top;" for="qr_cnt">URL</label>    
                                <span class="intpSpan"><input type="text" name="qr_cnt" id="qr_cnt" value="<?php if(isset($qr_cnt) &&  $qr_cnt!="") { echo $qr_cnt; }else{ echo "http://example.com";} ?>" class="inpt_txt_fld" style="vertical-align: baseline;"  /> </span>
                            </span>
                        </p>

                    </fieldset>
                    <p>&nbsp;</p> 
                    <p>
                        <label  style="display: inline-block; width: 150px; text-align: left; margin-right: 16px; font-weight: bold; margin-bottom: 10px; vertical-align: top;" for="qr_size">Size</label>
                        <?php if(!isset($qr_size) ||  $qr_size==""){$qr_size="L"; } ?>
                        <span class="txtArea_top">
                            <span class="txtArea_bot">
                                <select style="border: medium none; width: 235px; margin-top: -5px;" class="noBg"  name="qr_size" id="qr_size">

                                    <option   value="S"  <?php if(isset($qr_size) &&  $qr_size=="S") {?> selected="selected"  <?php } ?> >Small</option>

                                    <option   value="M" <?php if(isset($qr_size) &&  $qr_size=="M") {?> selected="selected"  <?php } ?> >Medium</option>

                                    <option   value="L" <?php if(isset($qr_size) &&  $qr_size=="L") {?> selected="selected"  <?php } ?> >Large</option>

                                    <option   value="XL" <?php if(isset($qr_size) &&  $qr_size=="XL") {?> selected="selected"  <?php } ?> >Extra Large</option>

                                </select>
                            </span>
                        </span>
                    </p>
                    <p>&nbsp;</p> 
                    <p>
                        <button name="getqrcode" id="getqrcode" class="button" value="getqrcode" type="submit" ><span>Generate QR Code</span></button>
                    </p>
                    
                     
                      
                </td> 

                <td width="40%" valign="top" style="padding-left: 10px;"> 
               
                    <b>QR- Code </b>
                    <br/>
                    <div id="qrimg" >  
                   <?php if($img_dest){
                        $options_array=array(
                              0=>   $qr_size ,
                              'size'=>$qr_size
                              );
                              
                              switch($qr_cnt_type){
                                  case  "qr_cnt_type_sms":
                                  echo $qrcode->sms($qr_cnt, $options_array,$img_dest); 
                                  break;
                                 case "qr_cnt_type_text":
                                     echo $qrcode->text($qr_cnt, $options_array, $img_dest); 
                                    break;
                                case "qr_cnt_type_tel":
                                     echo $qrcode->telephone($qr_cnt, $options_array, $img_dest); 
                                    break;
                                case "qr_cnt_type_url":
                                     echo $qrcode->url($qr_cnt, $options_array, $img_dest); 
                                    break;
                              }
                               ?>
 
        <?php // DebugBreak();
        
       // echo $qrcode->text('Hello World'); ?>
                 <br/>
        <div class="instructions">
        <p>&nbsp; <input type="hidden" id="current_domain" value="<?php echo $current_domain;?>"></p>   
              <p>
                  <button name="downloadqrcode" id="downloadqrcode" class="button" value="getqrcode" type="submit" onclick="javascript : setDownload();"><span>Download QR Code</span></button>  
                
             </p>
             <p> OR </p>     
            <p> (Right click the image and choose "Save As..." to download this file.)  </p>
            
        </div> 
             <?php      }else{ ?>
                 <div id="qrcodeimgdiv" style="border: 2px solid #DCE1E1; width: 276px; height: 276px; text-align: center; vertical-align: middle;">
                 <br/><br/><br/><br/>
                <strong> Please Generate <br/>QR-Code Image</strong>
                 </div>
            <?php }?>
                   </div>   
                </td>
            </tr>

        </table> </div> 
        <?php $form->close(); ?>      
</div>


<!--inner-container ends here-->

<div class="clear"></div><!--container ends here-->


<div class="clear"></div><!--inner-container ends here-->

<script type="text/javascript">

function setDownload(){
    $("#is_download").val('1');   
}
 function validateQRData(){ 
     
     var is_download= $("#is_download").val(); 
     
     if(is_download=='1'){
         return true;
     }
             var content_type =$('input:radio[name=qr_cnt_type]:checked').val();   
             var content = $("#qr_cnt").val();   
             
              if(trim(content) == '')
             {
                 inlineMsg('qr_cnt','<strong>Enter content for QR code generation.</strong>',2);
                 return false;
             }
             if(tagValidate(content) == true){
                 inlineMsg('qr_cnt','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
             var returnVal=true;
              switch(content_type) {
                    case 'qr_cnt_type_sms':
                          break;

                    case 'qr_cnt_type_text':  
                          break;

                    case 'qr_cnt_type_tel':
                          break;

                    case 'qr_cnt_type_url':
                            var regexp =/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/;   //  /^(ftp|https?):\/\/+(www\.)?[a-z0-9\-\.]{3,}\.[a-z]{3}$/; 
                            returnVal= regexp.test(content);
                          
                          break;

                    default:
                       var regexp = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/; 
                       returnVal= regexp.test(content);
                       break;

                }
                  if(returnVal==false){
                        inlineMsg('qr_cnt','<strong>Enter valid URL.</strong>',2);   
                 }
              return returnVal;
        }
      
         
        

        
    $(document).ready(function() {       

        var current_domain=$("#current_domain").val(); //"localhost:8080";
      //  getQrCode();
      //  qrcodeaction();    

        function qrcodeaction(){ 

            $('input[name=qr_cnt_type]:radio').click(function() { 
                var c=$('#qr_cnt');
                var container=$('#fs');
                var content_type = $(this).val();

                switch(content_type) {
                    case 'qr_cnt_type_sms':
                        // alert("sms");
                        var strHtml='<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;vertical-align: top;" for="qr_cnt">SMS:</label><span class="txtArea_top"> <span class="txtArea_bot"><textarea class="noBg" rows="3" cols="25" label="" div=""name="qr_cnt" id="qr_cnt"></textarea></span></span>';
                        break;

                    case 'qr_cnt_type_text':  
                        // alert("text");  
                        var strHtml='<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;vertical-align: top;" for="qr_cnt">Text:</label><span class="txtArea_top"> <span class="txtArea_bot"><textarea class="noBg" rows="3" cols="25" label="" div=""name="qr_cnt" id="qr_cnt"></textarea></span></span>';
                        break;

                    case 'qr_cnt_type_tel':
                        // alert("tel");  
                        var strHtml='<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;vertical-align: top;" for="qr_cnt">Phone Number:</label><span class="intpSpan"><input type="text" name="qr_cnt" id="qr_cnt" value="" class="inpt_txt_fld" style="vertical-align: baseline;"  /> </span>';
                        break;

                    case 'qr_cnt_type_url':
                        //  alert("url");  
                        var strHtml='<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;vertical-align: top;" for="qr_cnt">URL:</label><span class="intpSpan"><input type="text" name="qr_cnt" id="qr_cnt" value="http://example.com" class="inpt_txt_fld" style="vertical-align: baseline;"  /> </span>';
                        break;

                    default:
                        // alert("default url");  
                        var strHtml='<label style="display: inline-block; width: 150px; text-align: left; margin-bottom: 10px;vertical-align: top;" for="qr_cnt">URL:</label><span class="intpSpan"><input type="text" name="qr_cnt" id="qr_cnt" value="http://example.com" class="inpt_txt_fld" style="vertical-align: baseline;"  /> </span>';
                        break;

                }
                container.html(strHtml);
            });
            $("#getqrcode").unbind("click");
            $("#getqrcode").click(function(){
                getQrCode(); 
                qrcodeaction();    
            });
        }

        function getQrCode(){  
            var checkValidate=validateQRData();
            if(checkValidate==true) {
                    var current_domain=$("#current_domain").val(); 
                    var loadingimg='<div align="center" width="100%" height="150px" style="padding: 25px;"><img src="/img/ajax-loader.gif" alt="loading..."/><p>loading...</p></div>';
                    $('#qrimg').html(loadingimg);
                    $.ajax({
                        type:'post',
                        dataType:'html',
                        cache: false,
                        data:$("#qrcodegenerator").serialize(),
                        url : 'http://'+current_domain + '/companies/get_qrcode_by_ajax',
                        success: function(data) {
                            $('#qrimg').hide();
                            $('#qrimg').html(data);
                            $('#qrimg').slideDown();

                        }
                    });  
            }else{
                return false;
            }

        }
        
        
        
        
    });
</script>













































