<?php
 if(!empty($_SESSION['User']['User']['id']) && !empty($_SESSION['projectwebsite_id']) &&  !empty($_SESSION['User']['User']['usertype']) && $_SESSION['User']['User']['usertype']=="holder"  ){   /*|| (!empty($_SESSION['Admin']['Admin']['id']) && !empty($_SESSION['sessionprojectid']))*/
      $project_name_default='default';
      echo $javascript->link('/js/'.$project_name_default.'/chat.js');
     $current_domainurl= $_SERVER['HTTP_HOST']; 
    ?> 
     <input type="hidden" id="current_domainurl" name="current_domainurl" value="<?php echo $current_domainurl;?>">
     <input type="hidden" id="chatmsg_offset" name="chatmsg_offset" value="0">
    <script language='javascript'>
         chatWith("Chat"); 
   
    </script>
<?php }?>