<?php if($showlist=="contact"){   ?>
                <h4> Contact List </h4>
              <table width="100%" cellpadding="3" cellspacing="3">
                                        <thead style="text-align: left; border-bottom: #D3D3D3;"> <tr>
                                        <th width="45%" align="left">Email</th>
                                        <th width="25%" align="left">Company</th>
                                        <th width="15%" align="left">First Name</th>
                                        <th width="15%" align="left">Last Name</th>
                                        </tr></thead>
                                        <tbody>
                                        <?php
                                        if($contactdetails){ foreach($contactdetails as $contact) { ?>
                                        <tr>
                                        <td  align="left"> <?php echo $contact['Contact']['email'];?></td>
                                        <td  align="left"><?php echo $contact['Company']['companyname'];?></td>                          
                                        <td  align="left"><?php echo $contact['Contact']['firstname'];?></td>                          
                                        <td  align="left"><?php echo $contact['Contact']['lastname'];?></td>    
                                        </tr>
                                        <?php } 
                                        }else{?>
                                         <tr>
                                        <td  align="center" colspan="4" height="25px"> No Contsct(s) falls within selected parameters! </td> 
                                        <?php } ?>
                                        </tbody>
                                        
                                        </table>
<?php }else {?>
                              <h4> Member List </h4>  
<table width="100%" cellpadding="3" cellspacing="3">
                                        <thead style="text-align: left; border-bottom: #D3D3D3;"> <tr>
                                       
                                        <th width="55%" align="left">  Email</th>
                                        <th width="20%" align="left">First Name</th>
                                        <th width="20%" align="left">Last Name</th>
                                        </tr></thead>
                                        <tbody>
                                        <?php 
                                         if($userdetails){ 
                                        foreach($userdetails as $user) {   ?>
                                        <tr>
                                        <td align="left"> <?php echo $user['Holder']['email'];?></td>
                                        <td align="left"><?php echo $user['Holder']['firstname'];?></td>                          
                                        <td align="left"><?php echo $user['Holder']['lastname'];?></td>    
                                        </tr>
                                        <?php } 
                                        }else{?>
                                         <tr>
                                        <td  align="center" colspan="4" height="25px"> No Member(s) falls within selected parameters! </td> 
                                        <?php } ?>
                                        </tbody>
                                        
                                        </table>
  <?php  }?>
                                  