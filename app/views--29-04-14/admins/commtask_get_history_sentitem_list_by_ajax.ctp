
<h4> Task Sent Item List </h4>
<table width="100%" cellpadding="3" cellspacing="3">
    <thead style="text-align: left; border-bottom: #D3D3D3;"> <tr>
            <th width="45%" align="left">Email</th>
           <!--  <th width="15%" align="left">Company</th>  -->
            <th width="22%" align="left">First Name</th>
            <th width="22%" align="left">Last Name</th>
            <th width="10%" align="left">Status</th>
        </tr></thead>
    <tbody>
        <?php if($taskExeSentItemData){   ?>  
            <?php
                foreach($taskExeSentItemData as $sentItem) { ?>
                <tr>
                    <td  align="left"> <?php echo $sentItem['CommunicationTaskExecutionReport']['sent_to_email'];?></td>
                    <!-- <td  align="left">< ?php echo $sentItem['CommunicationTaskExecutionReport']['sent_to_company'];?></td>  -->
                    <td  align="left"><?php echo $sentItem['CommunicationTaskExecutionReport']['sent_to_firstname'];?></td>                          
                    <td  align="left"><?php echo $sentItem['CommunicationTaskExecutionReport']['sent_to_lastname'];?></td>    
                    <td  align="left"><?php echo ucfirst($sentItem['CommunicationTaskExecutionReport']['email_status']);?></td>    
                </tr>
                <?php } 
            }else{?>
            <tr>
            <td  align="center" colspan="4" height="25px"> No task matching members or contacts was found to send task email!</td> 
            <?php } ?>
    </tbody>

</table>
