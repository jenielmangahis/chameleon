<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
?>


<div class="titlCont1"><div class="centerPage">
        <?php echo $form->create("Admin", array("action" => "sa_formstatustype_add",'name' => 'blogadd','enctype'=>'multipart/form-data','onsubmit'=>'return validatestatustype();' ,'id' => "formstatustype_add")); 
        if($statustypeid){
            echo $form->input("FormSubmitStatustype.id", array('id' => 'title','value'=>$statustypeid, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));
        }
        
        ?>
        <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>   
        <span class="titlTxt"><?php echo $statustypepageaction;?> Form Status Type </span>



       <div class="topTabs">
            <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>sa_formstatustypelist')"><span> Cancel</span></button></li>
            </ul>
        </div>
    </div></div>
<div class="top-bar" style="border-left:0px;">
</div><br />

<div class="midPadd">
    <div>

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

        <!-- ADD Sub Admin FORM BOF -->

        <!-- ADD FIELD BOF -->

            <table cellspacing="10" cellpadding="0" align="center" width="100%" style="min-height: 250px;">
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
                                <?php echo $form->input("FormSubmitStatustype.statustype_name", array('id' => 'statustype_name','div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
                            </span>
                        </td>
						<td>
								<?php echo $form->error('FormSubmitStatustype.statustype_name', array('class' => 'errormsg'));?>
						</td>
                    </tr>

                    
                    <tr><td colspan="2">
                    <div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
                        <?php  echo $this->renderElement('bottom_message');  ?>
                    </div>
                    </td></tr>

                </tbody>
            </table>


 <?php echo $form->end();?>



        <!-- ADD Sub Admin  FORM EOF -->

    </div>
    <br>
</div><!--inner-container ends here-->


                            

<script type="text/javascript">

    function trim(s)
    {
        return rtrim(ltrim(s));
    }

    function ltrim(s)
    {
        var l=0;
        while(l < s.length && s[l] == ' ')
            {    l++; }
        return s.substring(l, s.length);
    }

    function rtrim(s)
    {
        var r=s.length -1;
        while(r > 0 && s[r] == ' ')
            {    r-=1;    }
        return s.substring(0, r+1);
    }
    function fillspacealias()
    {
        var alias=trim(document.getElementById('title').value);
        alias=alias.replace(/\s+/g,"-");
        document.getElementById('alias').value=alias;
    }               
	function validatestatustype(){

		if($('#statustype_name').val() == '') {
			 inlineMsg('statustype_name','<strong>Please enter status type</strong>',2);
			 return false;
		}
	}
</script>