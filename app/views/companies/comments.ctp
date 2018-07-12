<?php $domain = 'http://'. $_SERVER['HTTP_HOST']; ?>
<script src="http://maps.googleapis.com/maps/api/js?v=3.4&sensor=true" type="text/javascript"></script>
<link media="screen" rel="stylesheet" href="/css/colorbox.css" />
<script src="/js/jquery.colorbox.js"></script>

<style>
    .example7{
        display:none;
    }
</style>

<script language="javascript">
function loadcoindetails(p_id,coin_holder_id,coin_serial)
        {
            
            var fn_name="displaycomments"+coin_serial;
            
            window[fn_name]();
            
            var current_domain=$("#current_domain").val();
            //alert('http://'+current_domain+'/companies/get_coin_detail_by_ajax/'+p_id+'/'+coin_holder_id+'/'+coin_serial+'/');
            $.ajax({
                    url: 'http://'+current_domain+'/companies/get_coin_detail_by_ajax/'+p_id+'/'+coin_holder_id+'/'+coin_serial+'/',
                    cache: false,
                    success: function(html){
                            $('#coin_detail_div').html(html);
                            $('#no_coin_comments').css("display","none");
                            
                         
                    }
                    });

        }
        
function loadnextcoins()
        {
           
            var current_domain=$("#current_domain").val();
            var coin_start=$("#coin_start").val();
            var coin_limit=$("#coin_limit").val();
            
             $('#coins_list').fadeOut();         
            //alert('http://'+current_domain+'/companies/get_next_coins/'+coin_start+'/'+coin_limit);
            $.ajax({
                    url: 'http://'+current_domain+'/companies/get_next_coins/'+coin_start+'/'+coin_limit,
                    cache: false,
                    success: function(html){
                            $('#coins_list').fadeIn();
                            $('#coins_list').html(html);
                            
                         
                    }
                    });

        }               
        
</script>

<script>

    $(document).ready(function(){
        //Initialize the Google maps
        initialize();

        // The FB iFrame height adjustment 
        $(".srNo").click(function() {
            var t = setTimeout('fbiFrameHeight();', 4000);
        });

        //Examples of how to assign the ColorBox event to elements
        $("a[rel='example1']").colorbox();
        $("a[rel='example2']").colorbox({transition:"fade"});
        $("a[rel='example3']").colorbox({transition:"none", width:"75%", height:"75%"});
        $("a[rel='example4']").colorbox({slideshow:true});
        $(".example5").colorbox();
        $(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:244});
        $(".example7").colorbox({width:"80%", height:"80%", iframe:true});
        $(".example8").colorbox({width:"56%", inline:true, href:"#map_canvas"});
        $(".example9").colorbox({
            onOpen:function(){ alert('onOpen: colorbox is about to open'); },
            onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
            onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
            onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
            onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
        });

        //Example of preserving a JavaScript event for inline calls.
        $("#click").click(function(){
            $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });
    });

    // Facebook iFrame height
    function fbiFrameHeight() {
        $(".connect_widget").attr('style', 'height:30px;');
        //alert('test');
    }//fbiFrameHeight()

</script>
<script language='javascript'>
    function showlocations(address,ind,comment,zoomview) {
        if(geocoder) {
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    //alert("Geocode was not successful for the following reason: " + status);
                    infoWindow.close();
                }
            });
        }

    }

</script>    

<div >
<div class="boxBg">
    <!-- <p class="boxTop"> <?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
    <div class="boxBor">
        <!--<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="http://192.168.1.225:8219/testproject" font=""></fb:send>-->
        <div class="boxPad">
            <div style="width: 350px; float: left; clear: right;">
                <?php
                    /******FB******/

                    $site_logoutUrl='/companies/logout/';
                    include('facebook.php');// this  file is in webroot
                    // Create our Application instance (replace this with your appId and secret).
                    if(!empty( $project['Project']['facebookappkey'])&& !empty($project['Project']['facebooksecretkey']))
                    {
                        $facebook = new Facebook(array(
                        'appId' => $project['Project']['facebookappkey'],
                        'secret' => $project['Project']['facebooksecretkey'],
                        'cookie' => true,
                        ));

                    }
                    else {

                        if ($_SERVER['HTTP_HOST']=="192.168.1.225:8219"){
                            $facebook = new Facebook(array(
                            'appId' => '204621259574670',
                            'secret' => 'e9cef786f12e1d0bd14141bedef9383d',
                            'cookie' => true,
                            ));
                        }
                        else if($_SERVER['HTTP_HOST']=="75.125.190.162:9085"){
                                $facebook = new Facebook(array(
                                'appId' => '207213385987168',
                                'secret' => '788d922865a9f34c43d7b5012089b16d',
                                'cookie' => true,
                                ));
                            }else{
                                $facebook = new Facebook(array(
                                'appId' => '218874101473898',
                                'secret' => '6c50b162c383f2fdefc5fbed34464fdc',
                                'cookie' => true,
                                ));
                        }
                    }
                    // We may or may not have this data based on a $_GET or $_COOKIE based session.
                    //
                    // If we get a session here, it means we found a correctly signed session using
                    // the Application Secret only Facebook and the Application know. We dont know
                    // if it is still valid until we make an API call using the session. A session
                    // can become invalid if it has already expired (should not be getting the
                    // session back in this case) or if the user logged out of Facebook.
                    if (isset($_SESSION['facbooklogoutcheck'])) {
                        $logoutUrl = $facebook->getLogoutUrl();
                        unset($_SESSION['facbooklogoutcheck']);
                    ?>
                    <script type='text/javascript'> window.location='<?php echo $logoutUrl; ?>';</script>
                    <?php
                    }
                    $facebook_session = $facebook->getSession();

                    /*****FB******/
                    App::import("Model", "Comment");
                    $this->Comment =   & new Comment();

                    $alphaarr=array('A','B','C','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

                    $noofcomments = $this->Comment->find('count',array('conditions' => "Comment.project_id='".$project_id."' and Comment.offensive='0' and Comment.offensiveedit='0' and Comment.active_status='1' and Comment.delete_status='0'"));

                    $showcomments="no";

                    /*if($project['ProjectType']['coin_verification']=="1")    { 
                    if(!empty($_SESSION['User']['User']['id'])) $showcomments="yes";
                    }*/

                    if($project['ProjectType']['showcommentbutton']=="1")
                    {

                        if($project['ProjectType']['iscommentpublic']=="0"){

                            if(empty($_SESSION['User']['User']['id'])) 
                            {$msg="You Must Be Registered & Logged In to See Comments.";}
                            else{ $showcomments="yes"; }        
                        } 
                        else{ $showcomments="yes"; }        
                    }
                    else
                    {
                        if($project['ProjectType']['iscommentpublic']=="0"){
                            if(empty($_SESSION['User']['User']['id']))
                                $msg="You must be Registered to See Comments.";
                            else $showcomments="yes";         
                        } 
                        else { $showcomments="yes"; }        
                    }



                    $showreply="yes";
                    if(empty($_SESSION['User']['User']['id'])) $showreply="no";

                    if($showcomments=="yes"){
                    ?>
                    
                    <div id="coin_detail_div">
                    
                    <div >
                        <?php echo  $form->create('Company',array('action'=>'/comments','id'=>'search' ,'onsubmit' => 'return validateserial("add");'));?>
                        <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain;?>">
                        
                        
                        <div><label class='lbl'><b>Coin Serial #:</b></label> 
                            <span class="intpSpan"> <?php echo $form->input('coinset',array('label'=>'','id'=>'coinset','div'=>false,'type'=>"text", 'size'=>'10','maxlength'=>'10' , 'class'=>'inptBox')) ?></span>&nbsp;<br/><span class="flx_button_lft"><?php echo $form->submit('Search', array('div'=>false,"class"=>"flx_flexible_btn"));?></span>&nbsp;<?php if($noofcomments>0 && $searchresult=="yes" ){ ?>
                                <span class="flx_button_lft">
                                    <?php  echo $form->button('View All', array('type'=>'Button','div'=>false,"class"=>"flx_flexible_btn",'onclick'=>'window.location="/companies/comments"')); ?>
                                </span>
                            <?php  }
                            App::import("Model", "CoinsHolder");
                            $this->CoinsHolder =   & new CoinsHolder();
                            //find no of coins to check whether to show Next 10 coins button
                            $noofcoins = $this->CoinsHolder->find('count',array('conditions' => "CoinsHolder.project_id='".$project_id."' and CoinsHolder.delete_status='0'"));
                            if($noofcoins>10)
                            {
                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="flx_button_lft"><?php echo $form->button('Next 10 Coins', array('onclick'=>'loadnextcoins()','div'=>false,"class"=>"flx_flexible_btn"));?></span>
                            <?php
                            }
                            ?>
                            </div>
                        <?php echo $form->end();?>
                    </div>
                    <?php echo  $form->create('Company',array('action'=>'/signup','id'=>'searchresult' ));?>
                    <p>&nbsp;</p>  
                    <p>&nbsp;(Please click on coin serial for viewing comments.)</p> 
                    
<!----------------------------------------------------------------------------------new code------------------------------------------------------------------------->                     
                    <div id="coins_list">
                    
                    </div>
                    
                    </div>
                    
<!----------------------------------------------------------------------------------new code------------------------------------------------------------------------->                    
                    
                    <p class="clear">&nbsp;</p>
                    <?php
                        $arr_id="";
                        if($noofcomments==0){
                        ?>
                        <p class="clear">&nbsp;</p>
                        <div class="commtBox">
                            <p align="center"><b>No comment found.</b></p>
                        </div>
                        <?php    }else {
                            if($searchresult=="yes")
                            {
                            ?>
                            <?php if(sizeof($comments)==0){?>
                                <p class="clear">&nbsp;</p>
                                <div class="commtBox">
                                    <p align="center"><b>No comment found.</b></p>
                                </div>

                                <?}
                                else{
                                ?>
                                <p class="clear">&nbsp;</p>
                               
                                <p class="srNo"><a href="javascript:void(0);" onclick="displaycomments<?php echo $coinserial;?>()">Coin Serial :<?php echo $coinserial;?></a></p>
                                

                                <div id="<?php echo $coinserial;?>" class="allcoinserials"  style="display:none">
                                    <?php
                                        $i=0;
                                        $zoomview=5;
                                        $newaddress="";
                                        foreach($comments as $convalue){

                                            ##import holder model for processing
                                            App::import("Model", "Holder");
                                            $this->Holder =   & new Holder();
                                            $condition = "id = '".$convalue['Comment']['holder_id']."' and  project_id='".$project_id."' and active_status='1' and delete_status='0'";
                                            $holderdetails = $this->Holder->find('first', array('conditions' => $condition));
                                            $holder_details="";
                                            $statecountry="";    

                                            $holder_details.=$holderdetails['Holder']['screenname'].' ';

                                            //if($holderdetails['Holder']['shownamelast']=="1") $holder_details.= $holderdetails['Holder']['lastnameshow'];

                                            $holder_details.="(";

                                            if($holderdetails['Holder']['address1']!="" ){
                                                if($holderdetails['Holder']['showaddress1']=="1") $holder_details.= $holderdetails['Holder']['address1'].', ';
                                            }
                                            if($holderdetails['Holder']['address2']!="" ){
                                                if($holderdetails['Holder']['showaddress2']=="1") $holder_details.=$holderdetails['Holder']['address2'].', ';
                                            }
                                            if($holderdetails['Holder']['city']!="" ){
                                                if($holderdetails['Holder']['showcity']=="1") $holder_details.=$holderdetails['Holder']['city'].', ';
                                            }

                                            if($holderdetails['Holder']['state']!="" ){
                                                if($holderdetails['Holder']['state']!="0" ){
                                                    $holder_details.=AppController::getstatename($holderdetails['Holder']['state']).', ';
                                                }
                                            }

                                            $holder_details .= AppController::getcountryname($holderdetails['Holder']['country']);

                                            $holder_details.=" ".$holderdetails['Holder']['zipcode'];


                                            $holder_details.=")";

                                            if($zoomview==5){
                                                if($i==0) $firstcountryid=$holderdetails['Holder']['country'];
                                                if($firstcountryid != $holderdetails['Holder']['country']) 
                                                    $zoomview=1;                
                                            }


                                            if($newaddress=="")
                                            {
                                                $newaddress = $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country'])).'@ <strong>Coin #: </strong>'.$coinserial.'<br><strong>Holder: </strong>'.htmlentities(addslashes($holderdetails['Holder']['screenname'])).' <br> <strong>Comment:</strong> '.htmlentities(addslashes(trim($convalue['Comment']['comment'])));
                                            }
                                            else
                                            {
                                                $newaddress .= '|'.$holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country'])).'@ <strong>Coin #: </strong>'.$coinserial.'<br><strong>Holder: </strong>'.htmlentities(addslashes($holderdetails['Holder']['screenname'])).' <br> <strong>Comment:</strong> '.htmlentities(addslashes(trim($convalue['Comment']['comment'])));
                                            }

                                            ##import holder model for processing
                                            App::import("Model", "CoinsHolder");
                                            $this->CoinsHolder =   & new CoinsHolder();    

                                            $coinholder_details = $this->CoinsHolder->find('first', array('conditions' => "CoinsHolder.id  = '".$convalue['Comment']['coin_holder_id']."'"));

                                            if($arr_id=="") $arr_id="'".$coinserial."'";
                                            else   $arr_id.=",'".$coinserial."'";

                                            $comment_type_name="";
                                            if($project['ProjectType']['maxnumbercomment']>1) {
                                                if($convalue['Comment']['comment_type_id']==0)
                                                    $comment_type_name="Misc.Additional Comment";
                                                else
                                                    $comment_type_name=AppController::getcommenttypename($convalue['Comment']['comment_type_id']); 
                                            }


                                            $rsvp="I am not going to attend event";
                                            if($convalue['Comment']['rsvp']=="1") $rsvp="I am going to attend event";

                                        ?>
                                        <h3 class="commTitle">
                                            <span class="postedby">Posted by:</span> <?php echo  $holder_details;    ?><br />
                                            <span class="dateSpn"><?php echo AppController::usdateformat($convalue['Comment']['created'],1)  ; ?></span>
                                            <?php if($project['ProjectType']['maxnumbercomment']>1) { ?>
                                                <br/><span class="dateSpn"><?php echo $comment_type_name; ?></span>
                                                <?php } ?>
                                            <?php  if($project['ProjectType']['is_rsvp']=="1") {
                                                    if($comment_type_name !="Misc.Additional Comment"){ ?>
                                                    <br/><span class="dateSpn"><?php echo $rsvp; ?></span>
                                                    <?php } }
                                            ?>
                                            <br/><!--Location :-->
                                            <?php //echo $alphaarr[$i]; ?> 
                                            <a class='example8' style="cursor:pointer;" onclick="showAddress('<? echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo  preg_replace("/\r?\n/", "\\n", htmlentities(addslashes(trim( $convalue['Comment']['comment'])))); ?>','hidebubble')"><u>View Map</u></a>

                                        </h3>
                                        <div class="commtBox">
                                            <p><?php echo $convalue['Comment']['comment']; ?></p>
                                        </div>
                                        <?php
                                            $i++;
                                    }?>

                                    <script language='javascript'>
                                        // This function is called after search
                                        function displaycomments<?php echo $coinserial;?>()
                                        {
                                            displaycomments('<?php echo $coinserial;?>','<?php echo preg_replace("/\r?\n/", "\\n", $newaddress);?>','<?php echo $zoomview;?>');
                                            showAddress('<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo  preg_replace("/\r?\n/", "\\n", htmlentities(addslashes(trim( $convalue['Comment']['comment'])))); ?>','hidebubble');
                                        }
                                    </script>
                                    <?php
                                    }
                                ?>
                            </div>
                            <?php echo $form->end();
                            }
                            else{

                                App::import("Model", "CoinsHolder");
                                $this->CoinsHolder =   & new CoinsHolder();

                                $condition = "CoinsHolder.project_id='".$project_id."' and  CoinsHolder.delete_status='0'";
                                $coinholderdetails = $this->CoinsHolder->find('all', array('conditions' => $condition,'fields'=>array('DISTINCT CoinsHolder.serialnum,holder_id'),'order'=>'CoinsHolder.serialnum'));

                                //print_r($coinholderdetails);
                                
                                /*
                                 <div style="height: 300px; overflow: auto; width: auto; display: none;">
                                 
                                 <table width="100%">
                                 
                                 <?php

                                foreach($coinholderdetails as $coinholderdetail){
?>
<tr>
                                 <td><?php

                                    $coinholder_ids= $this->CoinsHolder->find('all', array('conditions' => "CoinsHolder.serialnum  ='".$coinholderdetail['CoinsHolder']['serialnum']."'",'fields'=>'id'));

                                    if(is_array($coinholder_ids) && !empty($coinholder_ids)) {
                                        $coinholder_ids1="";
                                        foreach ($coinholder_ids as $coinholder_id){
                                            if($coinholder_ids1=="")
                                                $coinholder_ids1=$coinholder_id['CoinsHolder']['id'];
                                            else
                                                $coinholder_ids1.=",".$coinholder_id['CoinsHolder']['id'];
                                        }            

                                        $condition1="Comment.project_id='".$project_id."' and Comment.coin_holder_id in (".$coinholder_ids1.")  and Comment.offensive='0' and Comment.active_status='1' and Comment.delete_status='0'";

                                        $order      = array('Comment.created DESC');
                                        $comments = $this->Comment->find('all',array('conditions' => $condition1,  'order' =>$order));

                                        if($arr_id=="") $arr_id="'".$coinholderdetail['CoinsHolder']['serialnum']."'";
                                        else   $arr_id.=",'".$coinholderdetail['CoinsHolder']['serialnum']."'";

                                        App::import("Model", "Holder");
                                        $this->Holder =   & new Holder();
                                        $condition = "id=".$coinholderdetail['CoinsHolder']['holder_id'];
                                        $holderdetails = $this->Holder->find('first', array('conditions' => $condition));
                                    ?>
                                    <p class="clear">&nbsp;</p>
                                    <p class="srNo"><a href="javascript:void(0);" onclick="displaycomments<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>()">Coin Serial :<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?></a></p>


                                    <!-- <p class="srNo"><a href="javascript:void(0);" onclick="displaycomments('<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>', '', '09')">Coin Serial :<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?></a></p>-->
                                    <div id="<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>" class="allcoinserials"  style="display:none">
                                        <p class="clear">&nbsp;</p>


                                        <p><span class='st_sharethis' displayText='ShareThis'></span></p>
                                        <?php if(sizeof($comments)==0){?>
                                            <p class="clear">&nbsp;</p>
                                            <div class="commtBox">
                                                <p align="center"><b>No comment found.</b></p>
                                            </div>

                                            <script language='javascript'>
                                                // This function is called for no comments
                                                function displaycomments<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>()
                                                {
                                                    displaycomments('<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','09');
                                                    showAddress('<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo $holderdetails['Holder']['zipcode'].",".addslashes(AppController::getcountryname($holderdetails['Holder']['country'])); ?>','hidebubble');
                                                    //google.maps.event.trigger(map, 'resize');
                                                }
                                            </script>
                                            <?php }
                                            else{
                                                $i=0;
                                                $zoomview=5;
                                                $newaddress="";
                                                foreach($comments as $convalue){

                                                    ##import holder model for processing
                                                    App::import("Model", "Holder");
                                                    $this->Holder =   & new Holder();
                                                    $condition = "Holder.id = '".$convalue['Comment']['holder_id']."' and  Holder.project_id='".$project_id."' and Holder.active_status='1' and Holder.delete_status='0'";
                                                    $holderdetails = $this->Holder->find('first', array('conditions' => $condition));
                                                    $holder_details="";
                                                    $statecountry="";    

                                                    $holder_details.=$holderdetails['Holder']['screenname'].' ';

                                                    //if($holderdetails['Holder']['shownamelast']=="1") $holder_details.= $holderdetails['Holder']['lastnameshow'];

                                                    $holder_details.="(";

                                                    if($holderdetails['Holder']['address1']!="" ){
                                                        if($holderdetails['Holder']['showaddress1']=="1") $holder_details.= $holderdetails['Holder']['address1'].', ';
                                                    }
                                                    if($holderdetails['Holder']['address2']!="" ){
                                                        if($holderdetails['Holder']['showaddress2']=="1") $holder_details.=$holderdetails['Holder']['address2'].', ';
                                                    }
                                                    if($holderdetails['Holder']['city']!="" ){
                                                        if($holderdetails['Holder']['showcity']=="1") $holder_details.=$holderdetails['Holder']['city'].', ';
                                                    }

                                                    if($holderdetails['Holder']['state']!="" ){
                                                        if($holderdetails['Holder']['state']!="0" ){
                                                            $holder_details.=AppController::getstatename($holderdetails['Holder']['state'])." ".$holderdetails['Holder']['zipcode'].', ';
                                                        }
                                                    }

                                                    $holder_details .= AppController::getcountryname($holderdetails['Holder']['country']);

                                                    //$holder_details.=" ".$holderdetails['Holder']['zipcode'];    

                                                    $holder_details.=")";

                                                    if($zoomview==5){
                                                        if($i==0) $firstcountryid=$holderdetails['Holder']['country'];
                                                        if($firstcountryid != $holderdetails['Holder']['country']) 
                                                            $zoomview=1;                
                                                    }


                                                    if($newaddress=="")
                                                    {
                                                        $newaddress = $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country'])).'@ <strong>Coin #: </strong>'.$coinholderdetail['CoinsHolder']['serialnum'].'<br><strong>Holder: </strong>'.htmlentities(addslashes($holderdetails['Holder']['screenname'])).' <br> <strong>Comment:</strong> '.htmlentities(addslashes(trim($convalue['Comment']['comment'])));
                                                    }
                                                    else
                                                    {
                                                        $newaddress .= '|'.$holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country'])).'@ <strong>Coin #: </strong>'.$coinholderdetail['CoinsHolder']['serialnum'].'<br><strong>Holder: </strong>'.htmlentities(addslashes($holderdetails['Holder']['screenname'])).' <br> <strong>Comment:</strong> '.htmlentities(addslashes(trim($convalue['Comment']['comment'])));
                                                    }

                                                    ##import holder model for processing
                                                    App::import("Model", "CoinsHolder");
                                                    $this->CoinsHolder =   & new CoinsHolder();    

                                                    $coinholder_details = $this->CoinsHolder->find('first', array('conditions' => "CoinsHolder.id  = '".$convalue['Comment']['coin_holder_id']."'"));

                                                    $comment_type_name="";        

                                                    if($project['ProjectType']['maxnumbercomment']>1) {
                                                        if($convalue['Comment']['comment_type_id']==0)
                                                            $comment_type_name="Misc.Additional Comment";
                                                        else
                                                            $comment_type_name=AppController::getcommenttypename($convalue['Comment']['comment_type_id']); 
                                                    }

                                                    $rsvp="I am not going to attend event";
                                                    if($convalue['Comment']['rsvp']=="1") $rsvp="I am going to attend event";
                                                ?>
                                                <h3 class="commTitle">
                                                    <span class="postedby">Posted by:</span> <?php echo  $holder_details;    ?><br />
                                                    <span class="dateSpn"><?php echo AppController::usdateformat($convalue['Comment']['created'],1)  ; ?></span>
                                                    <?php if($project['ProjectType']['maxnumbercomment']>1) { ?>
                                                        <br/><span class="dateSpn"><?php  echo $comment_type_name; ?></span>
                                                        <?php } ?>
                                                    <?php  if($project['ProjectType']['is_rsvp']=="1") {
                                                            if($comment_type_name !="Misc.Additional Comment"){ ?>
                                                            <br/><span class="dateSpn"><?php echo $rsvp; ?></span>
                                                            <?php } }
                                                    ?>
                                                    <br/><!--Location :--><?php //echo $alphaarr[$i]; ?> <a class='example8' style="cursor:pointer;" onclick="showAddress('<? echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo  preg_replace("/\r?\n/", "\\n", htmlentities(addslashes(trim( $convalue['Comment']['comment'])))); ?>','hidebubble')"><u>View Map</u></a>

                                                </h3>
                                                <div class="commtBox">
                                                    <?php $fbComLink = $domain .'/companies/view/'. $convalue['Comment']['id']; ?>
                                                    <p><?php echo $convalue['Comment']['comment']; ?></p>
                                                    <fb:like href="<?php echo $fbComLink;?>" send=true layout="button_count" width="320"></fb:like>
                                                    <fb:facepile href="<?php echo $fbComLink;?>" app_id="138773992873922" width="320" max_rows="4"></fb:facepile>
                                                    <!--<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=209747152411062&amp;xfbml=1"></script><fb:like href="" send="true" width="450" show_faces="true" font="arial"></fb:like>-->
                                                    <?php if($showreply=="yes") {?>
                                                        <p><span class="left" ><a href="javascript:void(0);" onclick="showcontentwindow('<?php echo $convalue['Comment']['id']; ?>','<?php echo $convalue['Comment']['coin_holder_id']; ?>')" style="cursor:pointer;font-size:11px;font-color:#3B5998;font-weight:normal;"><b>Reply</b></a></span></p>
                                                        <?php }?>
                                                </div>
                                                <?php 
                                                    ##import sucomment model for processing
                                                    App::import("Model", "Subcomment");
                                                    $this->Subcomment =   & new Subcomment();
                                                    $subcomments = $this->Subcomment->find('all', array('conditions' => "Subcomment.comment_id  = '".$convalue['Comment']['id']."' and Subcomment.active_status='1' and Subcomment.delete_status='0'"));

                                                    if(sizeof($subcomments)>0)
                                                    {
                                                        foreach($subcomments as $subcomment)
                                                        {
                                                            $condition1 = "Holder.id = '".$subcomment['Subcomment']['holder_id']."' and  Holder.project_id='".$project_id."' and Holder.active_status='1' and Holder.delete_status='0'";
                                                            $holderdetails1 = $this->Holder->find('first', array('conditions' => $condition1));
                                                            $holder_details1="";

                                                            $holder_details1="";

                                                            $statecountry="";    

                                                            $holder_details1.=$holderdetails1['Holder']['screenname'].' ';

                                                            $holder_details1.="(";

                                                            if($holderdetails1['Holder']['address1']!="" ){
                                                                if($holderdetails1['Holder']['showaddress1']=="1") $holder_details1.= $holderdetails1['Holder']['address1'].', ';
                                                            }
                                                            if($holderdetails1['Holder']['address2']!="" ){
                                                                if($holderdetails1['Holder']['showaddress2']=="1") $holder_details1.=$holderdetails1['Holder']['address2'].', ';
                                                            }
                                                            if($holderdetails1['Holder']['city']!="" ){
                                                                if($holderdetails1['Holder']['showcity']=="1") $holder_details1.=$holderdetails1['Holder']['city'].', ';
                                                            }

                                                            if($holderdetails1['Holder']['state']!="" ){
                                                                if($holderdetails1['Holder']['state']!="0" ){
                                                                    $holder_details1.=AppController::getstatename($holderdetails1['Holder']['state'])." ".$holderdetails1['Holder']['zipcode'].', ';
                                                                }
                                                            }

                                                            $holder_details1 .= AppController::getcountryname($holderdetails1['Holder']['country']);



                                                            $holder_details1.=")";
                                                        ?>
                                                        <div class="subcommtBox">
                                                            <?php $fbReplyLink = $domain .'/companies/view/'. $subcomment['Subcomment']['comment_id'] .'/'. $subcomment['Subcomment']['id']; ?>
                                                            <span class="postedby">Posted by: <?php echo  $holder_details1;?></span><br />
                                                            <?php echo $subcomment['Subcomment']['comment'];?>
                                                            <fb:like href="<?php echo $fbReplyLink;?>" send=true layout="button_count" width="280"></fb:like>
                                                            <fb:facepile href="<?php echo $fbReplyLink;?>" app_id="138773992873922" width="270" max_rows="4"></fb:facepile>
                                                        </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                                <?php $i++; }?>
                                            <script language='javascript'>
                                                // This function is called when comments are present
                                                function displaycomments<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>()
                                                {

                                                    displaycomments('<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<? echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $zoomview;?>');
                                                    showAddress('<? echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo $holderdetails['Holder']['zipcode'].",".addslashes(AppController::getcountryname($holderdetails['Holder']['country'])); ?>','hidebubble')
                                                    //google.maps.event.trigger(map, 'resize');
                                                }
                                            </script>
                                            <?php }?>
                                    </div>
                                    <?php echo $form->end();
                                    }
                                }
                                ?>
                                </td>
                                </tr>
                                </table>
                                </div>
                                <?php
                                */

                            } 
                    }} else{?>
                    <p align="center"><b><?php echo $msg;?>&nbsp;&nbsp;<a href="/companies/signup">Register Now !</a> </b></p>
                    <?php }?>



                <div style="float: left; clear: right;width: 350px;" id="no_coin_comments">
                    <br /><br />
                    <p ><b>Comments by Members Holding No Coin</b></p>
                    <?php

                        App::import("Model", "Comment");
                        $this->Comment =   & new Comment();

                        $condition = "Comment.project_id='".$project_id."' and  Comment.coinset_id='0' and Comment.delete_status='0'";
                        $commentdetails = $this->Comment->find('all', array('conditions' => $condition,'fields'=>array('Comment.comments,Comment.id'),'order'=>'Comment.id'));
                        $details = $this->Comment->query("select * from comments where project_id='".$project_id."' and coinset_id='0' and delete_status='0'");
                        ?>
                        <div style="height: 300px; overflow: auto; width: auto;">
                        <table width="100%">
                        <?php
                        foreach($details as $comment)
                        { 
                            ?>
                            <tr>
                            <td>
                            <?php

                            ##import holder model for processing
                            App::import("Model", "Holder");
                            $this->Holder =   & new Holder();
                            $condition = "id=".$comment['comments']['holder_id'];
                            $holderdetails = $this->Holder->find('first', array('conditions' => $condition));

                        ?>
                        <p class="srNo"><a href="javascript:void(0);" onclick="displaycomments<?php echo $holderdetails['Holder']['id'];?>()">
                                Comment:<?php echo  stripslashes($comment['comments']['comment']); ?></a><br />
                            Posted By:<?php echo $holderdetails['Holder']['screenname'];?>
                        </p><br />


                        <script language='javascript'>
                            // This function is called when comments are present
                            function displaycomments<?php echo $holderdetails['Holder']['id'];?>()
                            {

                                displaycomments('<?php echo $holderdetails['Holder']['id'];?>','<? echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $zoomview;?>');
                                showAddress('<? echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo $holderdetails['Holder']['zipcode'].",".addslashes(AppController::getcountryname($holderdetails['Holder']['country'])); ?>','hidebubble')
                                //google.maps.event.trigger(map, 'resize');
                            }
                        </script>
                        <div id="<?php echo $holderdetails['Holder']['id'];?>" class="allcoinserials"  style="display:none"></div>
                         </td>
                          </tr>
                        <?php
                        }
                    ?>
                   
                    </table>
                    </div>

                </div>

            </div>




            <div style="float: left; clear: right;width: 550px;">
                <!--<div id="map_canvas1" style="height: 500px;margin: 0 auto; position: relative;"><?php // echo $html->image('/img/'.$project_name.'/map.png', array('class'=>'', 'width' => '550px','height'=>'500px'));?></div>-->
                <div id="map_canvas" style="height: 500px ; width: 550px; margin: 0 auto; position: relative;"></div>
                <div class="clear">&nbsp;</div>
                <div style="float: left; clear: right;width: 550px; padding-top: 10px;font-size:11px;font-weight: bold;"><b>*</b>The location of the PIN on the map is NOT an exact address or location of the person commenting. The PIN is located centrally within the ZIP code or Province Code given by the Commenter.</div>
            </div>
            <div class="clear">&nbsp;</div>
        </div>
    </div>
    <!--<p class="boxBot">
    <?php echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
    </p>-->
</div>


<div id="fb-root"></div>
<script language='javascript'>

loadnextcoins();

    //if (GBrowserIsCompatible()) {
    /*
    var map = new GMap2(document.getElementById("map_canvas"));
    map.setMapType(G_SATELLITE_MAP);
    document.getElementById('map_canvas').style.visibility = 'hidden';
    document.getElementById('map_canvas1').style.visibility = 'visible';
    */
    var map;
    var geocoder;
    var latlng;
    var infoWindow;
    var mapDiv = document.getElementById("map_canvas");

    function initialize() {
        //alert("abc");
        geocoder = new google.maps.Geocoder();
        latlng = new google.maps.LatLng(37.4419, -122.1419);
        map = new google.maps.Map(mapDiv, {
            center: latlng,
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
            },
            navigationControl: true,
            navigationControlOptions: {
                style: google.maps.NavigationControlStyle.LARGE
            }
        });

        //jQuery('#map_canvas').hide();
        jQuery('#map_canvas').show();

        var lat=0; 
        var lng=0;
        var marker;

        <?php 

            App::import("Model", "CoinsHolder");
            $this->CoinsHolder =   & new CoinsHolder();

            $condition = "CoinsHolder.project_id='".$project_id."' and  CoinsHolder.delete_status='0'";
            $coinholderdetails = $this->CoinsHolder->find('all', array('conditions' => $condition,'fields'=>array('DISTINCT CoinsHolder.serialnum,holder_id'),'order'=>'CoinsHolder.serialnum'));

            foreach($coinholderdetails as $coinholderdetail){ 

                ##import holder model for processing
                App::import("Model", "Holder");
                $this->Holder =   & new Holder();
                $condition = "id=".$coinholderdetail['CoinsHolder']['holder_id'];
                $holderdetails = $this->Holder->find('first', array('conditions' => $condition));


            ?>


            geocoder.geocode({address: '<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>'},
            function(results_array, status) { 

                // Check status and do whatever you want with what you get back
                // in the results_array variable if it is OK.
                if(status == "OK"){
                lat = results_array[0].geometry.location.lat();
                lng = results_array[0].geometry.location.lng();

                marker = new google.maps.Marker({

                    position: new google.maps.LatLng(lat, lng),
                    map: map
                });

                var infowindow = new google.maps.InfoWindow();

                google.maps.event.addListener(marker, 'click', (function(marker) {
                    return function() {
                        map.setZoom(16);
                        var darwin = new google.maps.LatLng(lat, lng);
                        map.setCenter(darwin);
                        infowindow.setContent('<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>');
                        infowindow.open(map, marker);



                    }
                })(marker));
                
                }

            });


            <?php     
            }

            // No Coins..
            App::import("Model", "Comment");
            $this->Comment =   & new Comment();

            $condition = "Comment.project_id='".$project_id."' and  Comment.coinset_id='0' and Comment.delete_status='0'";
            $commentdetails = $this->Comment->find('all', array('conditions' => $condition,'fields'=>array('Comment.comments,Comment.id'),'order'=>'Comment.id'));
            $details = $this->Comment->query("select * from comments where project_id='".$project_id."' and coinset_id='0' and delete_status='0'");

            foreach($details as $comment)
            { 

                ##import holder model for processing
                App::import("Model", "Holder");
                $this->Holder =   & new Holder();
                $condition = "id=".$comment['comments']['holder_id'];
                $holderdetails = $this->Holder->find('first', array('conditions' => $condition));
            ?>

            geocoder.geocode({address: '<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>'},
            function(results_array, status) { 

                // Check status and do whatever you want with what you get back
                // in the results_array variable if it is OK.
                if(status == "OK"){
                    lat = results_array[0].geometry.location.lat();
                    lng = results_array[0].geometry.location.lng();

                    marker = new google.maps.Marker({

                        position: new google.maps.LatLng(lat, lng),
                        map: map
                    });

                    var infowindow = new google.maps.InfoWindow();

                    google.maps.event.addListener(marker, 'click', (function(marker) {
                        return function() {
                            map.setZoom(16);
                            var darwin = new google.maps.LatLng(lat, lng);
                            map.setCenter(darwin);
                            infowindow.setContent('<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>');
                            infowindow.open(map, marker);



                        }
                    })(marker));
                }

            });
            <?php
            }

        ?>

        /*  alert(lat);
        var locations  = [
        //['Bondi Beach', -33.890542, 151.274856, 4],
        //['Coogee Beach', -33.923036, 151.259052, 5],
        // ['Cronulla Beach', -34.028249, 151.157507, 3],
        //['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        ['Maroubra Beach', lat, lng, 1]
        ];
        */   


    }


    function showmap(addressstring,zoomview) {

        jQuery('#map_canvas').show();
        jQuery('#map_canvas1').hide();

        // Add markers to the map
        var bounds = map.getBounds();
        var listArray = addressstring.split("|");
        for (var i = 0; i < listArray.length; ++i) {
            newarrylist = listArray[i].split("@");
            showlocations(newarrylist[0],i,newarrylist[1],zoomview);
        }

        geocoder.geocode({'address': addressstring}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                //alert("Geocode was not successful for the following reason: " + status);
                if (infoWindow) {
                    infoWindow.close();
                }
            }
        });
        //google.maps.event.trigger(map, 'resize');
    }


    function showAddress(address,serial,holder,comment,hidebubble) {

        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });

                // Set the InfoWindow
                infoWindow = new google.maps.InfoWindow({
                    position: results[0].geometry.location,
                    content: comment
                });

                // Open the InfoWindow
                //infowindow.setContent(address);
                infoWindow.open(map, marker);

            } else {
                //alert("Geocoding was not successful for the following reason: " + status);
                if (infoWindow) {
                    infoWindow.close();
                }
            }


        });

        //google.maps.event.trigger(map, 'resize');

    }


</script>
<script language='javascript'>
    function displaycomments(keyid,address,zoomview){

        //google.maps.event.trigger(map, 'resize');
        if (infoWindow) {
            infoWindow.close();
        }
/*
        if (document.getElementById(keyid).style.display=="none") {
            hideallcomments();
            document.getElementById(keyid).style.display="block";
            showmap(address,zoomview);

        }
        else {
            if(document.getElementById(keyid).style.display=="block")
                {document.getElementById(keyid).style.display="none";}
        }
*/
        map.setZoom(16);

    }

    hideallcomments();

    function hideallcomments() {
        $(".allcoinserials").hide();
        /*var ids=new Array(<?php //echo $arr_id?>);

        for (var i=0;i<ids.length;i++){
        document.getElementById(ids[i]).style.display="none";
        }*/
    }

    function showcontentwindow(comment_id,coin_holder_id){
        var url = '/companies/subcomment/'+comment_id+'/'+coin_holder_id;            
        jQuery.facebox({ ajax: url });
    }
    function submitdata(){

        if(validatemessage())
            {
            $("#indicator1").show();
            var coin_holder_id = $("#coin_holder_id").val();
            var comment_id =  $("#comment_id").val(); 
            var comments = $("#comments").val();

            jQuery.ajax({
                type: "GET",
                url: '/companies/subcomment1/'+comment_id+'/'+coin_holder_id+'/'+comments,
                cache: false,
                success: function(rText){
                    jQuery(document).trigger('close.facebox');
                    // jQuery('#gridTable').html(rText);            
                }
            });
            $("#indicator1").hide();

        }

    }
    function validatemessage(){    

        if($('#comments').val() == '')
            {
            inlineMsg('comments','<strong>Comments required.</strong>',2);
            return false;
        }
        if(hasWhiteSpace($('#comments').val()) == true){
            inlineMsg('comments','<strong>Only alpha numeric character allowed.</strong>',2);
            return false; 
        }
        if(tagValidate($('#comments').val()) == true){
            inlineMsg('comments','<strong>Please dont use script tags.</strong>',2);
            return false; 
        }
        return true; 
    } 
</script>    

<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({
            appId : '<?php echo $facebook->getAppId(); ?>',
            session : <?php echo json_encode($facebook_session); ?>, // don't refetch the session when PHP already has it
            status : true, // check login status
            cookie : true, // enable cookies to allow the server to access the session
            xfbml : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function(response) {
            window.location.reload();
        });
        /*FB.Event.subscribe('edge.create', function(response) {
        window.location.reload();
        });*/
        FB.Event.subscribe('auth.logout', function() {
            window.location.reload();
        });
    };

    (function() {

        var e = document.createElement('script');

        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';

        e.async = true;

        document.getElementById('fb-root').appendChild(e);

    }());
</script>
