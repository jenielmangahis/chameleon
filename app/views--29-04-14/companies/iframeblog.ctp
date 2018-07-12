  <style type="">
  /* Classes */
   
  </style>
<div class="boxBg1">
  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    &nbsp;&nbsp;&nbsp;<font size="+2" color="black"><?php echo ucfirst($project_name)."'s"; ?> Blogs</font><br />

            <table width="100%" >
                <tr>
                    <td width="100%" valign="top">    <input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain; ?>">  
                        <div style="float:left;margin: 0pt auto; width: 100%;height:auto !important;height:200px;min-height:200px;">
                           
                            <div id="blog" class="border_shadow">
                                <?php 
                                    if(isset($bloglist)){
                                        if(sizeof($bloglist) > 0){
                                            foreach ($bloglist as $eachrow) { ?>
                                            <div class="blogarticle margin4px">
                                                <div class="blogtitle margin4px"><a href="/companies/iframeblog/<?php echo $project_id."/".$project_name."/0/".$eachrow['Blog']['id']; ?>" title="<?php echo $eachrow['Blog']['title'] ?>" id="blogtitle">  
                                                    <?php echo  $eachrow['Blog']['title'] ?> </a> 
                                                </div>

                                                <div class="grayText margin4px">Posted on <?php echo date("F d, Y", strtotime($eachrow['Blog']['created'])); ?> | <?php echo $eachrow[0]['commentcount']; ?> Comments</div>
                                                <div class="margin4px">
                                                    <span><?php echo $eachrow['Blog']['introcontent']; ?> </span>
                                                    <span  style="float: right;"> 
                                                    <a href="/companies/iframeblog/<?php echo $project_id."/".$project_name."/0/".$eachrow['Blog']['id']; ?>" title="<?php echo $eachrow['Blog']['title']; ?>" class="orangeText" style="font-size: 11px;"> Read More</a>   </span>
                                                </div>
                                                <div class="line margin4px"><?php echo $html->image('/img/'.$project_name.'/spacer.gif');?> </div>
                                            </div>
                                            <?php }
                                            if(count($bloglist)>=$bloglimit)
                                            {
                                            $limit=$bloglimit+$blogoffset; 
                                        ?>
                                        <div style="float: right;"><a href="/companies/iframeblog/<?php echo $project_id."/".$project_name."/".$limit; ?>" id="morecomment" >See More</a> </div>
                                        <?php
                                            }
                                        }
                                        else{
                                        ?>
                                        <div class="blogarticle margin8px" style="text-align: center;">
                                            No blogs found!    
                                        </div>
                                        <?php
                                        }
                                    }
                                    else{    
                                        if($blogdata){   ?>
                                        <div class="blogarticle margin4px">
                                            <div class="blogtitle margin4px"><a href="/companies/iframeblog/<?php echo $project_id."/".$project_name."/0/".$blogdata['Blog']['id']; ?>" title="<?php echo $blogdata['Blog']['title']; ?>" id="blogtitle">  
                                                <?php echo  $blogdata['Blog']['title']; ?> </a> 
                                            </div>

                                            <div class="grayText margin4px">Posted on <?php echo date("F d, Y", strtotime($blogdata['Blog']['created'])); ?></div>
                                            <div class="margin4px">
                                                <?php echo $blogdata['Blog']['introcontent']; ?> 
                                            </div>

                                            <div class="margin4px">
                                                <?php echo $blogdata['Blog']['maincontent']; ?> 
                                            </div>

                                            <br/>
                                              <?php if($username){
                                                  
                                              ?>
                                              <div id="leavecomment">
                                                      <form action="/companies/blog_savecomment" method="post" id="blog_comment_add" name="blog_comment_add"> 
                                                    <div>
                                                        <label class="boldlabel">&nbsp;&nbsp;&nbsp;Leave a comment </label>
                                                        <input type="hidden" id="blog_id" name="blog_id" value="<?php echo  $blogdata['Blog']['id']; ?>"/>
                                                    </div>
                                                    <br />
                                                    &nbsp;&nbsp;
                                                       <span class="txtArea_top">
                                                            <span class="txtArea_bot"><?php echo $form->textarea("comment", array('id' => 'comment',  'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>
                                                             </span>
                                                       </span>
                                                    <div>&nbsp;&nbsp;&nbsp;<span class="flx_button_lft" id="savecomment">
                                                            <?php echo $form->button('Submit', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
                                                        </span>
                                                        <?php // echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
                                                    </div>
                                                     </form>  
                                                </div>
                                                <?php }else{
                                                    ?>
                                                    <input type="hidden" id="blog_id" name="blog_id" value="<?php echo  $blogdata['Blog']['id']; ?>"/>  
                                             <?php   }?>
                                                
                                                 <div class="margin8px" id="blogcommentlist">
                                                    <!-- Blog Comment listing here -->
                                                 </div>
                                        </div>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="blogarticle margin8px" style="text-align: center;">
                                            No such blog data found!    
                                        </div>
                                        <?php  
                                } } ?>
                            </div>
                        </div>
                    </td>

                </tr>
            </table>

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

<script type="text/javascript">


$(document).ready(function()
{
        var current_domain=$("#current_domain").val();
        var blog_id=$("#blog_id").val();
        $('#blogcommentlist').load('http://'+current_domain+'/companies/blog_comments_by_ajax/'+blog_id);
    
    
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
                    data:$("#blog_comment_add").serialize(),
                    url : 'http://'+current_domain + '/companies/blog_savecomment',
                    success : function(res){
                        if(res= 1)
                            {    //alert("Blog Comment submited!");
                            //var comment_start=0; 
                           // var commnet_offset= parseInt($("#comment_offset").val());
                           var blog_id= $("#blog_id").val();
                            $('#blogcommentlist').load('http://'+current_domain+'/companies/blog_comments_by_ajax/'+blog_id, function(){
                                $('#comment').val('');
                              //  $("#comment_start").val(0);
                                $('#blogcommentlist').slideDown(1000); 
                               // $("#errormsg").html("<strong>Thank you for adding comment.</strong>");
                               // commentactions();
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
</script>