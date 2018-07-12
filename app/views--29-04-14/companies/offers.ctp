<script language="javascript" type="text/javascript">
	<!--
	function popitup(url) {
	    newwindow=window.open(url,'name','height=700,width=850,scrollbars=yes');
	    if (window.focus) {newwindow.focus()}
	    return false;
	}
	// -->
</script>
<?php $base_url = Configure::read('App.base_url'); ?>
<div class="boxBg1">
	
	<div style="float: left;">
		
			<?php echo $form->create("Companies", array("action" => "offers",'name' => 'offers', 'id' => "offers")); 
				  echo $form->hidden("Company.categoryid", array('id' => 'categoryid'));
			?>
			<h2 style="float: left;margin: 0 15px;">Pick A Category</h2>
			<span class="txtArea_top"  style="float: right;">
			<span class="newtxtArea_bot">
				<?php echo $form->select("Company.category_id",$categories, null ,array('id' => 'category_id','class'=>'multilist'),"---Select Category---"); ?>
			</span>
			</span>
			<?php echo $form->end();?>	
	</div>

	<div style="padding-left: 20px; float: right;">
		<?php if($username == "" /* && empty($offerdata)*/ ){ ?>
		<span class="flx_button_lft ">
	    	<?php echo $form->button('Become a Member', array('div'=>false,"class"=>"flx_flexible_btn",'style'=>'font-size:12px;','onclick'=>'javascript:window.location="'.$base_url.'companies/login"'));	?>
		</span>
		<?php } ?>
	</div>
<div class="boxBor1">
	<div class="boxPad">
		<table width="100%">
			<tr>
				<td width="100%" valign="top"><input type="hidden" id="current_domain" name="current_domain" value="&lt;?php echo $current_domain; ?&gt;" />
					<div style="float: left; margin: 0pt auto; width: 100%; height: auto !important; height: 200px; min-height: 200px;">
						<div id="blog" class="">
							<?php  if($offerdata){ ?>
								<div id="blog" class="">
							<?php 	foreach($offerdata as $offer) { ?>
  <div class="blogarticle margin4px">
    <div class="blogtitle margin4px">
		<a href="/companies/offers/0/<?php echo $offer['Offer']['id']; ?>" title="<?php echo $offer['Offer']['offer_title']; ?>" id="blogtitle" style="color: rgb(44, 219, 35); "> 
			<?php echo $offer['Offer']['offer_title']; ?>
		</a>
	</div>
    <div class="grayText margin4px" style="color: rgb(251, 117, 3); ">
	Good until <?php echo date("F d, Y", strtotime($offer['Offer']['starttime'])); ?>  |  Comments</div>

    <div class="margin4px">
    <span><?php  echo $offer['Offer']['offerdescription']; ?>  </span>
		<span style="float: right;">
			<a href="/companies/offers/0/<?php echo $offer['Offer']['id']; ?>" title="<?php echo $offer['Offer']['offer_title']; ?>" class="orangeText" style="font-size: 11px; color: rgb(44, 219, 35); "> Read More</a> 
		</span>
	</div>
    <br/>
    <hr/>
    </div>

    

						<?php } ?>
						</div>
						<?php } else {?>
							<div class="blogarticle margin8px" style="text-align: center;">
								No such offer data found!</div>
						<?php  } ?>
						</div>
					</div></td>
				</tr> 
			</table>
			<p>&nbsp;</p>
		</div>
	</div>
	
</div>

<script type="text/javascript">


$(document).ready(function()
{
    
        var a_color=$('#comment_click').css("color");
        
        $('span.sharethis').css("color",a_color);
        $('.st_sharethis').css("color",a_color);
    
        var current_domain=$("#current_domain").val();
        var offer_id=$("#offer_id").val();
        $.ajax({
                   url: 'http://'+current_domain+'/companies/offer_comments_by_ajax/'+offer_id,
                   cache: false,
                   success: function(html){
                        $('#offercommentlist').html(html);
                  }
        });
        
        $('#leavecomment').hide();
        
        $('#comment_click').click(function(){
        
            $('#leavecomment').show();    
        });
        
        
        $('#savecomment').click(function(){
            var current_domain=$("#current_domain").val();   
            if(trim($('#comment').val()) == '')
                {
                inlineMsg('comment','<strong>Please enter comment.</strong>',2);
                return false;
            }else{
                   $.ajax({
                    type:'post',
                    dataType:'json',
                    cache: false,
                    data:$("#offer_comment_add").serialize(),
                    url : 'http://'+current_domain + '/companies/offers_savecomment',
                    success : function(res){
                        if(res= 1)
                            {    $('#offercommentlist').hide();
                                 var offer_id= $("#offer_id").val();
                                  $.ajax({
                                           url: 'http://'+current_domain+'/companies/offer_comments_by_ajax/'+offer_id,
                                           cache: false,
                                           success: function(html){
                                                $('#offercommentlist').html(html);
                                                $('#comment').val('');
                                                $('#offercommentlist').slideDown(1000); 
                                                $('#leavecomment').hide(); 
                                          }
                                });
                        }
                        else
                            {     $('#comment').val('');  
                                  $("#errormsg").html("<strong>Oops! There seems to be some problem. Please try in some time.</strong>");
                        }
                    }
                });
            }

        });

});

$('#category_id').live('change', function(){
	$('#categoryid').val($(this).val());
	$('#offers').attr('action', $('#offers').attr('action')+'/'+$(this).val());
	$('#offers').submit();
});
</script>
