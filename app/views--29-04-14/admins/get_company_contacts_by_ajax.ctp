<table width="100%" cellpadding="3" cellspacing="3">
                                        <thead style="text-align: left; border-bottom: #D3D3D3;"> <tr>
                                         <th width="5%" align="center"> <input type="checkbox" value="" name="checkall" id="checkall" /> </th>   
                                        <th width="40%" align="left">Email</th>
                                        <th width="25%" align="left">Company</th>
                                        <th width="15%" align="left">First Name</th>
                                        <th width="15%" align="left">Last Name</th>
                                        </tr></thead>
                                        <tbody>
                                        <?php 
                                         foreach($contactdetails as $contact) { ?>
                                        <tr>
                                        <td align="center">  <input type="checkbox" id="contact_<?php echo $contact['Contact']['id'];?>" value="<?php echo $contact['Contact']['email'];?>" name="emaillists[]"  class="checkid">  </td> 
                                        <td  align="left"> <?php echo $contact['Contact']['email'];?></td>
                                        <td  align="left"><?php echo $contact['Company']['companyname'];?></td>                          
                                        <td  align="left"><?php echo $contact['Contact']['firstname'];?></td>                          
                                        <td  align="left"><?php echo $contact['Contact']['lastname'];?></td>    
                                        </tr>
                                       
                                        <?php } ?>
                                        </tbody>
                                        
                                        </table>