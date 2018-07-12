<script type="text/javascript">
$(document).ready(function() {
$('#playMnu').removeClass("butBg");
$('#playMnu').addClass("butBgSelt");
}); 
</script>  
<!-- Body Panel starts -->
<div class="container">
    <div class="titlCont">
 <div class="centerPage" >
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <?php echo $form->create("admins", array("action" => "",'name' => '', 'id' => "")) ?>
              <span class="titlTxt1"><?php echo $current_company_name; ?>:&nbsp;</span>
            <span class="titlTxt">  Offers  </span>
            
            <div class="topTabs">
                
            </div>
			<div class="clear"></div>
                 <?php  $this->loginarea="players"; $this->subtabsel='offers';  echo $this->renderElement('players/player_inner_submenu');  ?>  
        </div></div>
    
    <div class="midCont" id="newcntlist">
        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
         <!-- top curv image starts -->
        <div>
           <?php echo $this->renderElement('coming_soon');  ?>  	
        <div class="tblData">


            


        </div>
        <div>
            <span class="botLft_curv"></span>
            <span class="botRht_curv"></span>
            
            <div class="clear"></div>
        </div>
        <!--inner-container ends here-->

        <?php echo $form->end();?>

    </div>

    <div class="clear"></div>
</div>     