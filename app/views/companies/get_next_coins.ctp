<?php  echo $this->element("admin_css"); ?>
<table width="100%" cellspacing="5" cellpadding="5" align="center">
                    <tr>
                    <th>Coin Serial #</th>
                    <th>Passed</th>
                    <th>Comments</th>
                    </tr>
                    <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    </tr>
                    <input type="hidden" id="coin_start" name="coin_start" value="<?php echo $coin_start;?>">
                    <input type="hidden" id="coin_limit" name="coin_limit" value="<?php echo $coin_limit;?>">
                    
                    
                    
                    <?php 
                    
                    if(!empty($coinholderdetails))
                    {
                  
                    foreach($coinholderdetails as $coinholderdetail)
                    {
                        App::import("Model", "Comment");
                        $this->Comment =   & new Comment();
                        
                        $condition = "Comment.project_id='".$project_id."' and coin_holder_id='". $coinholderdetail['CoinsHolder']['id']."' and  Comment.delete_status='0'";
                        $comment_details = $this->Comment->find('all', array('conditions' => $condition));
                        
                        
                        App::import("Model", "Holder");
                        $this->Holder =   & new Holder();
                        $condition = "id=".$coinholderdetail['CoinsHolder']['holder_id'];
                        $holderdetails = $this->Holder->find('first', array('conditions' => $condition));
                                             
                        
                    ?>
                        
                    
                        <tr align="center"><b>
                        <td><a href="javascript:void(0);" onclick="loadcoindetails(<?php echo $project_id.",".$coinholderdetail['CoinsHolder']['id'].",'".$coinholderdetail['CoinsHolder']['serialnum']."'"; ?>)"><?php echo $coinholderdetail['CoinsHolder']['serialnum'];?></a><b></td>
                        
                        <script language='javascript'>
                        // This function is called for no comments
                        function displaycomments<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>()
                        {
                            displaycomments('<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','09');
                            showAddress('<?php echo $holderdetails['Holder']['zipcode'].', '.addslashes(AppController::getcountryname($holderdetails['Holder']['country']));?>','<?php echo $coinholderdetail['CoinsHolder']['serialnum'];?>','<?php echo htmlentities(addslashes($holderdetails['Holder']['screenname']))?>','<?php echo $holderdetails['Holder']['zipcode'].",".addslashes(AppController::getcountryname($holderdetails['Holder']['country'])); ?>','hidebubble');
                            //google.maps.event.trigger(map, 'resize');
                        }
                    </script>
                        <!---------------------------------coin passed code------------------------------->
                        <td><b>0</b>
                        <?php
                        
                         ?>
                        </td>
                        <!---------------------------------coin passed code------------------------------->
                        
                        
                        
                        <!---------------------------------coin has comment code------------------------------->
                        <td><b>
                        <?php 
                            
                            if(!empty($comment_details))
                                echo count($comment_details);
                            else
                                echo"0";
                        ?>
                        </b>
                        </td>
                        <!---------------------------------coin has comment code------------------------------->
                        
                        </tr>
                    <?php
                    }
                    }
                    else
                    {
                        ?>
                        
                        <tr align="center">
                        <td colpsan="3"><b>No Coins found</b></td>
                        
                        <?php
                    }
                    ?>
                    
                    </table>