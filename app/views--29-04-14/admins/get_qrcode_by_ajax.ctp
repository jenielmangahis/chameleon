    
 
  <?php  
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
 

        <!-- <img alt="qrcode" src="http://qrcode.kaywa.com/img.php?s=8&amp;d=http%3A%2F%2F" id="qrcode"><a href="http://qrcode.kaywa.com/img.php?s=8&amp;d=http%3A%2F%2F">permalink</a> -->
        <?php // DebugBreak();
        
       // echo $qrcode->text('Hello World'); ?>
                 <br/>
        <div class="instructions">
        <p>&nbsp;</p>   
              <p>
                  <a href="/admins/get_qrcode_file">
                   <button name="getqrcode" id="getqrcode" class="button" value="getqrcode" type="button"><span>Download QR Code</span></button>  
                   </a>
             </p>
             <p> OR </p>     
            <p> (Right click the image and choose "Save As..." to download this file.)  </p>
            
        </div>
        <script type="text/javascript">
         /*      $(document).ready(function() {         alert("dom ajx");
           //    var qrsrc = $("img").attr("src");
               alert(qrsrc);
               
               });    */
        </script>