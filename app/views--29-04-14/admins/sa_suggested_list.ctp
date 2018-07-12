<?php //print_r($project);
	$base_url_admin = Configure::read('App.base_url_admin');
	$backUrl = $base_url_admin.'projectdashboard';
?>
<div class="titlCont"><div style="width:960px; margin:0 auto;">
        <div align="center" id="toppanel" >
            <?php  echo $this->renderElement('new_slider');  ?>
        </div>

        <?php  //echo $this->renderElement('project_name');  ?>   
        <span class="titlTxt">
            Suggested Comments
        </span>
        <?php echo $form->create("Admin", array("action" => "sa_suggested_list",'type' => 'file','enctype'=>'multipart/form-data','name' => 'sa_suggested_list', 'id' => "sa_suggested_list"))?>
        <div class="topTabs">
            <ul>
                <li><button id = "submit" type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button id = "apply" type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
            </ul>
        </div>
         <?php echo $form->hidden("selectedtab", array('id' => 'selectedtab')); ?>     
		 <div class="clear"></div>
          <?php    $this->loginarea="admins";    $this->subtabsel="sa_suggested_list";
             echo $this->renderElement('super_admin_types');  ?>   
    </div>
</div>   

<div class="midCont">
    <?php if($session->check('Message.flash')){ ?> 
        <div id="blck" style="padding-top: 0px;"> 
            <div class="msgBoxTopLft">
                <div class="msgBoxTopRht">
                    <div class="msgBoxTopBg"></div>
                </div>
            </div>
            <div class="msgBoxBg">
                <div class=""><?php
							e($html->link(
								$html->image('close.png',array('style'=>'margin-left: 945px;position: absolute;z-index: 11;')),
								'javascript:void(0)',
								array('escape' => false,'onclick'=>'hideDiv()')
								)
							);
							$session->flash();
							?>
                </div>
                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
            </div>
        </div> 
        <?php } ?>
    <div class="left" style="min-height:360px">
        <table width="700px" align="center" cellpadding="1" cellspacing="0">
            <tr>
                <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                        echo $form->error('ProjectType.project_type_name', array('class' => 'errormsg'));
                        echo $form->hidden("ProjectType.id", array('id' => 'typeid','value' => $project['Project']['project_type_id']));?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->hidden("ProjectType.project_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value' => $project_name));?>
                </td>
            </tr>
            <tr><td valign='top'><!--<label class="boldlabel">Note </label>--></td>
                <td><?php echo $form->hidden("ProjectType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?>
                </td>
            </tr>
            <tr>
                <td align="right" style="width:250px;"><label class="boldlabel">Suggested Comment Types<!--Maximum # of comments per Holder--></label></td>
                <?php //DebugBreak();
                    App::import("Model", "CommentType");
                    $this->CommentType =   & new CommentType();
                    $maxnumbercomment= $this->CommentType->find('count',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0' and CommentType.project_id =0", 'order' =>"id"));
					//print_r($maxnumbercomment);
                    $maxcomarr=array();
                    $k = 0;
					for($j=0;$j<$maxnumbercomment;$j++){
                        $k=$j+1;
                        $maxcomarr[$k]=$k;
                    }

                    if($maxnumber_comment==0){
                        $maxnumber_comment=$k;
                    }
					
                ?>
                <td>
                    <span class="txtArea_top45">
					<span class="txtArea_bot45"><?php
                        echo $form->select("ProjectType.maxnumbercomment",$maxcomarr,$maxnumber_comment,array('id' => 'maxnumbercomment','style'=>'width:40px','onchange'=>'hidetextboxes()'),array('0'=>0)); ?>
                </td>
            </tr>
            <tr><td></td>
                <td colspan="2">
                    <?php  
                        App::import("Model", "CommentType");
                        $this->CommentType =   & new CommentType();
                        $i=0;
                        $commenttypedata1 = $this->CommentType->find('all',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0' and CommentType.project_id =0 ", 'order' =>"id"));
                        $commenttypedropdown1 = Set::combine($commenttypedata1, '{n}.CommentType.id', '{n}.CommentType.comment_type_name');
                        
						$commenttypedropdown = array();
						foreach($commenttypedata1 as $eachrow){
                            $i++;
                            echo "</tr><tr><td></td><td>";
                            $commenttypedata = $this->CommentType->find('all',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0' and project_id = 0 ", 'order' =>"id"));
                            $commenttypedropdown = Set::combine($commenttypedata, '{n}.CommentType.id', '{n}.CommentType.comment_type_name');

                            App::import("Model", "ProjectCommentType");
                            $this->ProjectCommentType =   & new ProjectCommentType();

                            $comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$ProjectTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

                            echo $form->input("ProjectType.commenttype".$i, array('id' => 'commenttype'.$i, 'div' => false, 'label' => '',"class" => "contactInput","style"=>"width:40px","maxlength" => "3",'value'=>$i,'readonly'=>'readonly'));

                            echo "</td><td>";
                            echo $form->select("ProjectType.commenttypeoption".$i,$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'commenttypevalue'.$i, 'div' => false,"class" => "newcontactInput", 'label' => '','onchange'=>'check_selected_suggested(this.value,this.id)'),array('0'=>'--Select--'));
                            echo "<div class='clear'></div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td align="right"><label class="boldlabel">Additional Comments Allowed</label></td>
                <td ><?php echo $form->input('ProjectType.additional_comment', array('type'=>'checkbox', 'label' => '','div'=>false,'onclick'=>'show_value()'));?>
                </td>

                <td>
                    <?php     
                        App::import("Model", "CommentType");
                        $this->CommentType =   & new CommentType();

                        $comment_type_id = $this->CommentType->find('first',array("conditions"=>"CommentType.is_additional_allowed='1'  and  CommentType.project_id='$project_id'  and CommentType.active_status='1' and CommentType.delete_status='0'", 'fields' =>"id"));
                        $default_comment_type = !empty($comment_type_id['CommentType']['id']) ? $comment_type_id['CommentType']['id'] : 0;
						// print "COMMENTTYPE:".$comment_type_id.":PROJECTTYPEID:".$ProjectTypeId.":i:".$i;

                        echo $form->select("ProjectType.additionalcomment",$commenttypedropdown,$default_comment_type,array('id' => 'additionalcomment',"class" => "newcontactInput", 'div' => false, 'label' => '','onchange'=>'check_selected(this.value,this.id)'),array('0'=>'--Select--'));
                    ?></span></span>
                    <?php //echo $form->select("additionalcomment",array('0'=>'Misc.Additional Comment'),0,array('id' => 'additionalcomment'),false); ?>
                </td>
            </tr>
            <tr>
                <td><!--<label class="boldlabel">Default Delivery Days After Order Date</label>--></td>
                <td colspan="2"><?php echo $form->hidden("ProjectType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3",'value' => '10'));?></td>
            </tr>
            <!-- ADD FIELD EOF -->
            <!-- BUTTON SECTION BOF -->
            <tr><td colspan="3">&nbsp;</td></tr>
        </table>
    </div>
    <div class='clear'></div>
</div> 
<!-- main tab -->

<?php echo $form->end();?>    




<div class='clear'></div>
</div>


<script type="text/javascript">

    function check_selected(item_value,item_id)
    {
        var i=0;
        for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
        {
            if(document.getElementById("commenttypevalue"+i).disabled==false)
                {
                if(document.getElementById("commenttypevalue"+i).value==item_value && document.getElementById("commenttypevalue"+i).value!=0)
                    {
                    alert("This item is already selected");
                    document.getElementById(item_id).value=0;
                    break;
                }
            }
        }
    }

    function check_selected_suggested(item_value,item_id)
    {
        var i=0;
        for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
        {
            if(document.getElementById("commenttypevalue"+i).disabled==false)
                {
                if("commenttypevalue"+i!=item_id)
                    {
                    if(document.getElementById("commenttypevalue"+i).value==item_value && document.getElementById("commenttypevalue"+i).value!=0)
                        {
                        alert("This item is already selected");
                        document.getElementById(item_id).value=0;
                        break;
                    }
                }
            }
        }


        if("additionalcomment"!=item_id)
            {
                if(document.getElementById("additionalcomment").disabled==false)
                {        
                    if(document.getElementById("additionalcomment").value==item_value && document.getElementById("commenttypevalue"+i).value!=0)
                    {
                        alert("This item is already selected");
                        document.getElementById(item_id).value=0;

                    }
                }
        }

        

    }

    function hidetextboxes(){
        var i;
        var j=parseInt(document.getElementById("maxnumbercomment").options[document.getElementById("maxnumbercomment").selectedIndex].value)+1;
        for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
        {	
            document.getElementById("commenttype"+i).style.display="block";
            document.getElementById("commenttypevalue"+i).style.display="block";
            document.getElementById("commenttype"+i).disabled=false;
            document.getElementById("commenttypevalue"+i).disabled=false;
        }
        if(j==1){
            for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
            {
                document.getElementById("commenttype"+i).style.display="none";
                document.getElementById("commenttypevalue"+i).style.display="none";
                document.getElementById("commenttype"+i).disabled=true;
                document.getElementById("commenttypevalue"+i).disabled=true;

            }
        }else{
            for(i=j;i<=<?php echo $maxnumbercomment?>;i++)
            {
                document.getElementById("commenttype"+i).style.display="none";
                document.getElementById("commenttypevalue"+i).style.display="none";
                document.getElementById("commenttype"+i).disabled=true;
                document.getElementById("commenttypevalue"+i).disabled=true;

            }
        }
    }
    hidetextboxes();

    function checkboxfun(){
        if(document.getElementById("ProjectTypeIstransferable").checked==false)
            {document.getElementById("ProjectTypeSimpleCointransfer").checked=false;		}
    }
    function show_value()
    {
        var e = document.getElementById("additionalcomment");
        //document.getElementById("additionalcomment").value=0;
        if(document.getElementById("ProjectTypeAdditionalComment").checked==true)
            {
            if(document.getElementById("additionalcomment"))
                document.getElementById("additionalcomment").style.display="block";
            document.getElementById("additionalcomment").disabled=false;
            
        }
        else
            {
            //document.getElementById("additionalcomment").selectedIndex = 0;
            document.getElementById("additionalcomment").style.display="none";
            document.getElementById("additionalcomment").disabled=true;
        }
    }
    window.onload=show_value;
</script>

<div class="clear"></div>
<script type="text/javascript">
    /*  if(document.getElementById("flashMessage")==null)
    document.getElementById("ProjectType").style.paddingTop = '45px';
    else
    {
    document.getElementById("blck").style.paddingTop = '44px';
    }*/
</script>

<script type="text/javascript">
    $('document').ready(function(){
        var e = document.getElementById("additionalcomment");
        var getOption = e.options[e.selectedIndex].value;
        //  Trigure on save 
        $('#submit').click(function(){
            if(document.getElementById("ProjectTypeAdditionalComment").checked==true){
                if(getOption == 0){

                    alert('Please select additional comments allowed!');

                    return false;

                } else {

                    return true;
                }
            }
        });

        // Trigure on apply 
        $('#apply').click(function(){
            if(document.getElementById("ProjectTypeAdditionalComment").checked==true){
                if(getOption == 0){

                    alert('Please select additional comments allowed!');

                    return false;

                } else {

                    return true;
                }
            }
        });

        // trigure on change
        $('#additionalcomment').change(function(){
            var e = document.getElementById("additionalcomment");
            var getSelectedOption = e.options[e.selectedIndex].value;

            if(getSelectedOption == 0){
                getOption = 0;
                //alert("Please select additional comment!");
            } else {
                getOption = getSelectedOption;
            }

        });

    })
	</script>
  <!-- Body Panel ends --> 
