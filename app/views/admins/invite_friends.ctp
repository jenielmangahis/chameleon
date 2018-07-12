<style>
    .email_align{
        float: left; position: relative; width: 500px; margin-left: 100px; 
    }
</style>


<script type='text/javascript'>
    function toggleAll(element) 
    {
        var form = document.forms.invite, z = 0;
        for(z=0; z<form.length;z++)
            {
            if(form[z].type == 'checkbox')
                form[z].checked = element.checked;
        }
    }
    
    
    function check_toggle() 
    {
        
        var form = document.forms.invite, z = 0;
        var ch=0;
        for(z=0; z<form.length;z++)
            {
            //if(form[z].type == 'checkbox')
                if(form[z].checked ==false)
                    ch++;             
            }
            ch++;
              
            if(ch==form.length)
            {
                alert("Please choose atleast 1 contact to send invitation");
                return false;
            }
            return true;
    }
</script>

<script type="text/javascript"> 
    $(document).ready(function(){

        $("#login_content").hide();


        $("#gmail").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("gmail");

        });
        
        $("#yahoo").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("yahoo");

        });
        
        $("#linkedin").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("linkedln");

        });
        
        $("#aol").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("aol");

        });
        
        $("#msn").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("MSN");

        });
        
        $("#windowslive").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("Hotmail");

        });
        
        $("#twitter").click(function(){
            $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("twitter");

        });
        
        $("#facebook").click(function(){
          /*  $("#login_content").show();
            $("#email_list").hide();
            $("#contact_list").hide();
            //var $hiddenInput = $('<input/>',{type:'hidden',id:vals,value:gmail,name:add_email_provider});
            //$hiddenInput.appendTo('.email_align');
            $("#e_p").val("facebook");*/

        });

        $("#cancel").click(function(){
            $("#login_content").hide();
            $("#contact_list").hide();
            $("#email_list").show();
        });


    });
</script>
<!-- Body Panel starts -->
<?php 

    if(!empty($contacts))
    {
    ?>    

    <script type='text/javascript'> 
        $(document).ready(function(){
            $('#login_content').hide();
            $("#contact_list").show();
            $('#email_list').hide();

        });
    </script>
    <?php
    }

    if($_SESSION['User']['User']['usertype']=="holder"){ 



    ?>
    <div class="navigation">
        <div class="boxBg">
            <!--<p class="boxTop"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?> </p> -->

            <!--<div class="boxBor">
            <div class="boxPad">
            <?php //echo $this->element("leftmenubar");?>  

            <p>&nbsp;</p>
            </div>
            </div>  
            <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p> -->

        </div>
    </div>
    <div class="bdyCont">
        <div class="boxBg">
            <!--<p class="boxTop"><?php echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p> -->
            <div class="boxBor">
                <div class="boxPad">
                    <div style="height:auto !important;height:200px;min-height:200px;">
                        <h2 style="float:left;">Invite</h2>

                        <div style="float: left; position: relative;width: 650px;margin-left:198px; margin-top:-30px;">     
                            <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow">

                                <?php echo $this->element("leftmenubar");?>  
                            </div>

                        </div>


                        <div class="clear"></div>
                        <br /><br /><br /><br />

                        <div style="width: 100%; margin-top: 5px; margin-left: 122px;"><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span></div>



                        <div class="email_align" align="center"> 

                            <table border="0" align="center" style="width:400px;" id="email_list">

                                <tr>
                                    <td>
                                        <a id="gmail" href="javascript: void(0);"><img src="/images/gmail_thumb.png"></a>
                                    </td>
                                    <td>
                                        <a id="yahoo" href="javascript: void(0);"><img src="/images/yahoo_thumb.png"></a>
                                    </td>
                                    <!--<td>
                                        <a id="linkedin" href="javascript: void(0);"><img src="/images/linkedin_thumb.png"></a>
                                    </td>-->
                                    <td>
                                        <a id="msn" href="javascript: void(0);"><img src="/images/msn_thumb.png"></a>
                                    </td>
                                    <td>
                                        <a id="windowslive" href="javascript: void(0);"><img src="/images/windowslive_thumb.png"></a>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <!--<td>
                                        <a id="windowslive" href="javascript: void(0);"><img src="/images/windowslive_thumb.png"></a>
                                    </td>-->
                                    <td>
                                        <a id="aol" href="javascript: void(0);"><img src="/images/aol_thumb.png"></a>
                                    </td>
                                    <td>
                                        <a id="twitter" href="javascript: void(0);"><img src="/images/twitter_thumb.png"></a>
                                    </td>
                                    <?php if(!empty( $project['Project']['facebookappkey'])&& !empty($project['Project']['facebooksecretkey']))
                    {  ?>
                                    <td>
                                        <a id="facebook" href="invite_fbfriends"><img src="/images/facebook_thumb.png"></a>
                                    </td>
                    <?php } ?>
                                </tr>

                            </table>  

                            <?php 
                                if(empty($contacts))
                                {
                                    echo  $form->create('invite',array('action'=>'','id'=>'invite','url'=>$this->here ,'onsubmit' => '','name'=>'invite'));?>

                                <table border="0" align="center" style="width:400px;" id="login_content">


                                    <tr>
                                        <td>
                                            <label class="frmLbls frmLbl2">Email ID  </label>
                                        </td>
                                        <td><!--<input type="text" name="email_id">-->
                                            <span class="intpSpan"> 
                                                <?php echo $form->input('email_id',array('label'=>false,'div'=>false,'type'=>"text", 'id'=>"email_id",'size'=>'40', 'class'=>'inptBox' )) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="frmLbls frmLbl2">Password  </label> 
                                        </td>
                                        <td><!--<input type="text" name="password">-->
                                            <span class="intpSpan"> 
                                                <?php echo $form->input('email_password',array('label'=>false,'div'=>false,'type'=>"password", 'id'=>"email_password",'size'=>'40', 'class'=>'inptBox' )) ?>
                                            </span>
                                        </td>
                                    </tr>
                                   
                                           
                                                <?php echo $form->input('email_provider',array('label'=>false,'div'=>false,'type'=>"hidden", 'id'=>"e_p",'size'=>'40')) ?>

                                     
                                    <tr>
                                        <td>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" align="center"> <span class="">
                                                <span class="flx_button_lft ">
                                                    <?php echo $form->submit('Submit', array('div'=>false,"class"=>"flx_flexible_btn "));?> 
                                                </span>
                                            </span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="">
                                                <span class="flx_button_lft ">
                                                    <?php echo $form->button('Cancel', array('div'=>false,"class"=>"flx_flexible_btn",'id'=>'cancel'));?> 
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                               </table>     
                                    <?php echo $form->end(); }?> 

                                <?php
                                    if(!empty($contacts))
                                    {
                                        asort($contacts);
                                    ?>
                                    <table align="center" style="width:400px;" id="contact_list">
                                    <tr>
                                        <td colspan="2">
                                            <?php echo  $form->create('send_invite',array('action'=>'','url'=>'/companies/send_invites','id'=>'invite','name'=>'send_invite','onsubmit'=>'return check_toggle();'));?>
                                            <table border="0" width="450" cellspacing="5" align="center" style="border: 2px solid #DBDBDB; margin-left: 5px; margin-top: 50px;">

                                                <tr align="left">
                                                    <td><b>No.</b></td>
                                                    <td><input type='checkbox' onChange='toggleAll(this)' name='toggle_all' title='Select/Deselect all'></td>
                                                    <td><b>Name</b></td>
                                                    <td><b>Email</b></td>
                                                </tr>
                                            <?php
                                                    $cnt=1;
                                                    $alt=0;
                                                    foreach ($contacts as $email=>$name)
                                                    {
                                                        if($alt%2==0)
                                                            $class="style='background-color:#FFF;'";
                                                        else
                                                            $class="style='background-color:#e4e2e2;'";

                                                        $alt++;
                                                    ?>
                                                    <tr <?php echo $class;?> align="left">
                                                        <td><?php echo $cnt;?></td>
                <td><?php echo $form->checkbox($name, array('label'=>false,'div'=>false,'checked'=>'yes','value'=>$email,));?> </td>
                                                        <td><?php echo $name;?></td>
                                                        <td><?php echo $email;?></td>
                                                    </tr>
                                                    <?php
                                                        $cnt++;
                                                    }
                                                ?>
                                                <tr align="center">
                                                    <td colspan="4">
                                                        <span class="">
                                                            <span class="flx_button_lft ">
                                                                <?php echo $form->submit('Send Invites', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>

                                            </table>
                                            <?php echo $form->end();?>  
                                        </td>
                                    </tr>



                                    <?php
                                    }
                                ?>

                            </table>  
                        </div> 



                    </div>

                </div>
            </div>   


        </div>
    </div>
    <div></div>
    <div class="clear"></div>
    <!-- Body Panel ends --> 

    <?php } 








