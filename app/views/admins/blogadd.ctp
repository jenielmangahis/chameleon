<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'bloglist';

?>
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
                    inlineMsg('introcontent','<strong>Blog short description required.</strong>',2);
                    return false;
                }
                if(tagValidate($('#introcontent').val()) == true){
                    inlineMsg('introcontent','<strong>Please dont use script tags.</strong>',2);
                    return false; 
                } 

             /*   if(trim($('#maincontent').val()) == '')
                    {
                    inlineMsg('maincontentdiv','<strong>Blog content required.</strong>',2);
                    return false;
                }
                if(tagValidate($('#maincontent').val()) == true){
                    inlineMsg('maincontentdiv','<strong>Please dont use script tags.</strong>',2);
                    return false; 
                } 
                   */



                return true;
            }

        </script>
		<!--container starts here-->
<div class="titlCont">
	<div class="slider-centerpage clearfix">
        <div class="center-Page col-sm-6">  
        	          	
            <h2><?php  //echo $this->renderElement('project_name');  ?> <?php echo $blogpageaction;?> Blog</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admins", array("action" => "blogadd",'name' => 'blogadd','enctype'=>'multipart/form-data','onsubmit'=>'return validateblog();' ,'id' => "blogadd")); ?>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
                <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
                <button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>            
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


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    
		$this->loginarea="admins";
		$this->subtabsel="bloglist";
		echo $this->renderElement('setting_submenus');
		?>
    </div>
</div> 

<!--inner-container starts here-->


<div class="right-panel">

    <div class="midCont clearfix">
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
                            <span class="intp-Span">
                                <?php echo $form->input("Blog.title", array('id' => 'title','div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
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
                            <span class="txtArea-top">
                                <span class="txtArea-bot"><?php echo $form->textarea("Blog.introcontent", array('id' => 'introcontent', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg form-control"));?>
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
                            <span class="intp-Span">
                                <?php echo $form->input("Blog.metakeyword", array('id' => 'metakeyword','div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
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
                            <span class="intp-Span">
                                <?php echo $form->input("Blog.metadescription", array('id' => 'metadescription', 'div' => false, 'label' => '',"class" => "inpt-txt-fld form-control","maxlength" => "150"));?>
                            </span>
                        </td>
                    </tr>



                    <tr>
                        <td style="text-align: right;"> 
                            <div class="updat">
                                <label class="boldlabel">Blog Content <span style="color: red;">*</span> </label>
                            </div>
                        </td>
                        <td ><span id="maincontentdiv">&nbsp;</span></td>
                    </tr>

                    <tr style="height: 460px;">
                        <td valign='top' colspan=2 style="height: 460px;"> 

                            <?php   

                                echo $form->textarea('Blog.maincontent', array('id'=>'maincontent','class'=>'ckeditor'));
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

                            

