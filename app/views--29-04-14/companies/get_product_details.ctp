                            <table width="100%">
                            
                            <tr>
                            <th width="6%">Select</th>
                            <th width="47%">Product Type</th>
                            <th width="47%">Pricing Type Name</th>
                            </tr>
                            
                            <tr>
                            <td colspan="3"><hr style="background-color: black;"></td>
                            </tr>
                           
                            <?php 
                            for($i=0;$i<count($product_type_names);$i++)
                            {
                                if($selected_options[$i]==1)
                                                        $check="checked";
                                                    else
                                                        $check="";
                                ?>
                                    <tr align="center">
                                    <td width="6%"><?php echo $form->input("price_type_options.$i", array('id' => 'price_type_options'.$i, 'div' => false, 'label' => '','type'=>'checkbox','checked'=>$check));?></td>
                                    <td width="47%"><?php echo  $product_type_names[$i]; ?></td>
                                    <td width="47%"><?php echo  $pricing_type_names[$i]; ?></td>
                                    </tr>
                                <?php
                            }
                            
                            ?>
                            
                            </table>            