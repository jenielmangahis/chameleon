<?php ?><!--container starts here-->
<div class="titlCont1"><div class="myclass">
        <div align="center" class="slider" id="toppanel">
            <div id="panel">
                <div class="content clearfix">
                    <H1> Help</h1>
                    <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
                </div>

            </div> <!-- /login -->  

            <!-- The tab on top --> 
            <div class="tab">
                <ul class="login">
                    <li id="toggle">
                        <a id="open" class="open" href="#."><span>Open Help Box</span></a>

                        <a id="close" style="display: none;" class="close" href="#"><span>Close Help Box</span></a>               
                    </li>
                </ul> 
            </div>



        </div>
        <script type="text/javascript">

            function validateblog(){
                //alert("validateevent");
                if(trim($('#title').val()) == '')
                    {
                    inlineMsg('title','<strong>Blog title required.</strong>',2);
                    return false;
                }
                if(tagValidate($('#title').val()) == true){
                    inlineMsg('title','<strong>Please dont use script tags.</strong>',2);
                    return false; 
                } 

                if(trim($('#introcontent').val()) == '')
                    {
                    inlineMsg('introcontent','<strong>Evnet short description required.</strong>',2);
                    return false;
                }
                if(tagValidate($('#introcontent').val()) == true){
                    inlineMsg('introcontent','<strong>Please dont use script tags.</strong>',2);
                    return false; 
                } 

             /*   if(trim($('#maincontent').val()) == '')
                    {
                    inlineMsg('maincontent','<strong>Blog description required.</strong>',2);
                    return false;
                }
                if(tagValidate($('#maincontent').val()) == true){
                    inlineMsg('starttime','<strong>Please dont use script tags.</strong>',2);
                    return false; 
                }   */




                return true;
            }

        </script>
        <?php echo $form->create("Companies", array("action" => "blogadd",'name' => 'blogadd','enctype'=>'multipart/form-data','onsubmit'=>'return validateblog();' ,'id' => "blogadd")); ?>
        <span class="titlTxt">
            <?php echo $blogpageaction;?> Blog
        </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/bloglist')"><span> Cancel</span></button></li>
            </ul>
        </div>

    </div>
</div>

<?php 
    echo $javascript->link('ckeditor/ckeditor'); 
?>

<script type="text/javascript">

    function trim(s)
    {
        return rtrim(ltrim(s));
    }

    function ltrim(s)
    {
        var l=0;
        while(l < s.length && s[l] == ' ')
            {	l++; }
        return s.substring(l, s.length);
    }

    function rtrim(s)
    {
        var r=s.length -1;
        while(r > 0 && s[r] == ' ')
            {	r-=1;	}
        return s.substring(0, r+1);
    }
    function fillspacealias()
    {
        var alias=trim(document.getElementById('title').value);
        alias=alias.replace(/\s+/g,"-");
        document.getElementById('alias').value=alias;
    }				
</script>

<!--inner-container starts here--><div class="rightpanel">

    <div class="midPadd">
        <div class="">

            <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>



            <table cellspacing="10" cellpadding="0" align="center" width="100%">
                <tbody>
                    <tr>
                        <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
                                echo $form->error('Blog.title', array('class' => 'msgTXt')); 
                                echo $form->error('Blog.introcontent', array('class' => 'msgTXt')); 
                                echo $form->error('Blog.maincontent', array('class' => 'msgTXt')); 
                        ?></td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            <div class="updat">
                                <label class="boldlabel">Title <span style="color: red;">*</span></label>
                            </div>
                        </td>
                        <td width="80%">
                            <span class="intpSpan">
                                <?php echo $form->input("Blog.title", array('id' => 'title','value'=>$data['Blog']['title'], 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
                            </span>
                        </td>
                    </tr>



                    <tr>
                        <td style="text-align: right;">
                            <div class="updat">
                                <label class="boldlabel">Short Description <span style="color: red;">*</span></label>
                            </div>
                        </td>
                        <td>
                            <span class="txtArea_top">
                                <span class="txtArea_bot"><?php echo $form->textarea("Blog.introcontent", array('id' => 'introcontent', 'value'=>$data['Blog']['introcontent'], 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "noBg"));?>
                                </span>
                            </span>
                        </td>
                    </tr> 

                    <tr>
                        <td style="text-align: right;">
                            <div class="updat">
                                <label class="boldlabel">Metakeyword </label>
                            </div>
                        </td>
                        <td>
                            <span class="intpSpan">
                                <?php echo $form->input("Blog.metakeyword", array('id' => 'metakeyword','value'=>$data['Blog']['metakeyword'], 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            <div class="updat">
                                <label class="boldlabel">Metadescription </label>
                            </div>
                        </td>
                        <td>
                            <span class="intpSpan">
                                <?php echo $form->input("Blog.metadescription", array('id' => 'metadescription','value'=>$data['Blog']['metadescription'], 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
                            </span>
                        </td>
                    </tr>



                    <tr>
                        <td style="text-align: right;"> 
                            <div class="updat">
                                <label class="boldlabel">Blog Content <span style="color: red;">*</span> </label>
                            </div>
                        </td>
                        <td >&nbsp;</td>
                    </tr>

                    <tr style="height: 460px;">
                        <td valign='top' colspan=2 style="height: 460px;"> 

                            <?php   

                                echo $form->textarea('Blog.maincontent', array('id'=>'maincontent','class'=>'ckeditor','value'=>$data['Blog']['maincontent']));
                                echo $form->hidden("Blog.id", array('id' => 'blogid','value'=>"$blogid"));                                
                            ?>
                        </td>
                    </tr>       


                    <tr><td colspan="2">&nbsp;</td></tr>

                </tbody>
            </table>
            <div class="top-bar" style="text-align: left; padding-top: 5px; ">
                <b>Any item with a  "<span style="color: red;">*</span>"  requires an entry.</b>
            </div>
            <?php echo $form->end();?>

            <!-- ADD Sub Admin  FORM EOF -->


        </div></div>

</div><!--inner-container ends here-->

  
<div class="clear"></div>

                            

