<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
?>


<div class="titlCont"><div class="myclass">
    <div align="center" class="slider" id="toppanel" style="height: 20px; top:11px;right: -50px;width:545px !important; text-align:right;">  
			<?php echo $form->create("Admin", array("action" => "formstatustype_add",'name' => 'blogadd','enctype'=>'multipart/form-data','onsubmit'=>'return validatestatustype();' ,'id' => "formstatustype_add")); 
        if($statustypeid){
            echo $form->input("FormSubmitStatustype.id", array('id' => 'title','value'=>$statustypeid, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));
        }
        
        ?>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url_admin ?>formstatustypelist')"><?php e($html->image('cancle.png')); ?></button> 
				<?php  echo $this->renderElement('new_slider');  ?>
        </div>
        <span class="titlTxt"><?php echo $statustypepageaction;?> Form Status Type Add/Edit </span>
       <div class="topTabs">

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