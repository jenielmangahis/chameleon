<!-- Body Panel starts -->
<div class="navigation">
    <div class="boxBg">
    </div>
</div>
<?php echo  $form->create('Companies',array('action'=>'/optout', 'id'=>'optout','name'=>'optout'));
 echo $form->hidden('Holder.id',array('label'=>false,'div'=>false,'type'=>"text",'id'=>"id", 'value'=> $holderArray['Holder']['id'] )); ?>

<div class="bdyCont">
    <div class="boxBg1">
        <div class="boxBor1">
            <div class="boxPad">
            <?php if($pagetype=="thankyou") {  ?>
               <h2 > <img src="<?php echo $this->webroot."img/imagecoins/active.gif"; ?>">  Thank You </h2> 
                <div style="margin-left: 25px;">
                    <label class="boldlabel" style="margin-left: 50px;">
                    	<em>Your are successfully oped out. </em>
                    </label> 
                </div>
                  <br/><br/>                   
                <div class="clear"></div>            
           <?php  }else{?>
                <h2 style="float:left;">Do you want to Opt Out ?</h2>
                <br/>
                <br/>
                <div style="float:right;height: 30px;position:relative;background-color:#209f20; width: auto;" class="border_shadow" id="save_apply_bg">
                     <ul class="dash_menu_opp" style="margin-left: 5px; margin-right: 3px;"> 
                                <li style="border-right:2px solid white;"><a onclick="return setsubmittype('yes');"><span>Yes</span></a></li>
                                <li><a href="/companies/update_profile"><span>Cancel</span></a></li>    
                            </ul>  
                    </div>
                
                <div class="clear"></div>
                <div><label class='lbl'>&nbsp;<span style="color:red">&nbsp;</span></label>
                    <?php if($session->check('Message.flash')){ $session->flash(); } ?>
                </div>
                <div class="clear"></div>                
                <?php } ?>               
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
<!-- Body Panel ends --> 
        
<script language='javascript'>
    function hidemessage(){
        if(document.getElementById("flashMessage")!=null)
            document.getElementById("flashMessage").style.display="none";

    }

    function setsubmittype(){
		$('#optout').submit();
     }
</script>

