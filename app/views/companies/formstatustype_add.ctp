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

            function validatestatustype(){
                //alert("validateevent");
                if(trim($('#statustype_name').val()) == '')
                    {
                    inlineMsg('statustype_name','<strong>Status Type Name required.</strong>',2);
                    return false;
                }
                if(tagValidate($('#statustype_name').val()) == true){
                    inlineMsg('title','<strong>Please dont use script tags.</strong>',2);
                    return false; 
                } 

               


                return true;
            }

        </script>
        <?php echo $form->create("Companies", array("action" => "formstatustype_add",'name' => 'blogadd','enctype'=>'multipart/form-data','onsubmit'=>'return validatestatustype();' ,'id' => "formstatustype_add")); 
        if($statustypeid){
            echo $form->hidden("FormSubmitStatustype.id", array('id' => 'title','value'=>$statustypeid, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));
        }
        
        ?>
        <span class="titlTxt">
            <?php echo $statustypepageaction;?> Status Type
        </span>
        <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/companies/formstatustypelist')"><span> Cancel</span></button></li>
            </ul>
        </div>

    </div>
</div>



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
                                echo $form->error('FormSubmitStatustype.statustype_name', array('class' => 'msgTXt')); 
                                
                        ?></td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            <div class="updat">
                                <label class="boldlabel">Status Type <span style="color: red;">*</span></label>
                            </div>
                        </td>
                        <td width="80%">
                            <span class="intpSpan">
                                <?php echo $form->input("FormSubmitStatustype.statustype_name", array('id' => 'statustype_name','value'=>$data['FormSubmitStatustype']['statustype_name'], 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
                            </span>
                        </td>
                    </tr>

                    <tr><td colspan="2">&nbsp;</td></tr>

                </tbody>
            </table>

            <?php echo $form->end();?>

<div class="top-bar" style="margin-bottom: 10px; text-align: left; padding-top: 5px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>
            <!-- ADD Sub Admin  FORM EOF -->


        </div></div>

</div><!--inner-container ends here-->

  
<div class="clear"></div>

                            

