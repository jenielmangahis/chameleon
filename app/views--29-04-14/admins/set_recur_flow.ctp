<?php
    if($set=="Daily")
    {//debugbreak();
        if($daily_data['every_days']!="" || $daily_data['every_days']!=NULL)
            $check_every_days="checked";
        else
            $check_every_weekdays="checked"; 
?>

<input type="radio" value="every_#days" class="recur" name="data[DailyCronJob][select]" <?php echo $check_every_days;?>> Every <?php echo $form->input("DailyCronJob.every_days_value", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;','value'=>$daily_data['every_days']));?>&nbsp; day(s)<br /><br />
<input type="radio" value="every_weekdays" class="recur" name="data[DailyCronJob][select]" <?php echo $check_every_weekdays;?>> Every weekday
<?php
    }
?>

<?php
    if($set=="Weekly")
    {
?>
Recur On &nbsp;<?php echo $form->input("WeeklyCronJob.recur_#weeks", array('id' => 'recur_#weeks','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Week(s) on:
                  <br /><br />          
                    <input type="checkbox" value="Sunday" name="data[WeeklyCronJob][on_#days][]"> Sunday &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" value="Monday" name="data[WeeklyCronJob][on_#days][]"> Monday &nbsp;
                    <input type="checkbox" value="Tuesday" name="data[WeeklyCronJob][on_#days][]"> Tuesday &nbsp;
                    <br /><br />
                    <input type="checkbox" value="Wednesday" name="data[WeeklyCronJob][on_#days][]"> Wednesday &nbsp;
                    <input type="checkbox" value="Thursday" name="data[WeeklyCronJob][on_#days][]"> Thursday
                    <input type="checkbox" value="Friday" name="data[WeeklyCronJob][on_#days][]"> Friday &nbsp;
                    <br /><br />
                    <input type="checkbox" value="Saturday" name="data[WeeklyCronJob][on_#days][]"> Saturday &nbsp;
<?php
    }
?>


<?php
    if($set=="Monthly")
    {
?>
<input type="radio" value="Daily" id="recur" class="recur" name="data[Event][recur]" <?php echo $daily;?>> Day &nbsp; <?php echo $form->input("Event.recur_on", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;
of every &nbsp;<?php echo $form->input("Event.recur_on", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Month(s)<br /><br />
 
 <input type="radio" value="Daily" id="recur" class="recur" name="data[Event][recur]" <?php echo $daily;?>> The &nbsp;
 
 <select style="border: 1px solid black;">
 <option>first</option>
 <option>second</option>
 <option>third</option>
 <option>fourth</option>
 <option>last</option>
 </select>
 
 <select style="border: 1px solid black;">
 <option>Monday</option>
 <option>Tuesday</option>
 <option>Wednesday</option>
 <option>Thursday</option>
 <option>Friday</option>
 <option>Saturday</option>
 </select>
 <br /><br />
 &nbsp;&nbsp;&nbsp;&nbsp;of every &nbsp;<?php echo $form->input("Event.recur_on", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Month(s)
                  
<?php
    }
?>


<?php
    if($set=="Yearly")
    {
?>
<input type="radio" value="Daily" id="recur" class="recur" name="data[Event][recur]" <?php echo $daily;?>> Every &nbsp;
<select style="border: 1px solid black;">
 <option>January</option>
 <option>February</option>
 <option>March</option>
 <option>April</option>
 <option>May</option>
 </select>
&nbsp;<?php echo $form->input("Event.recur_on", array('id' => 'recur_on','div' => false, 'label' => '','style'=>'border: 1px solid black;width:30px;'));?>&nbsp;Month(s)<br /><br />
 
 <input type="radio" value="Daily" id="recur" class="recur" name="data[Event][recur]" <?php echo $daily;?>> The &nbsp;
 
 <select style="border: 1px solid black;">
 <option>first</option>
 <option>second</option>
 <option>third</option>
 <option>fourth</option>
 <option>last</option>
 </select>
 
 <select style="border: 1px solid black;">
 <option>Monday</option>
 <option>Tuesday</option>
 <option>Wednesday</option>
 <option>Thursday</option>
 <option>Friday</option>
 <option>Saturday</option>
 </select>
 <br /><br />
 &nbsp;&nbsp;&nbsp;&nbsp;of 
 <select style="border: 1px solid black;">
 <option>January</option>
 <option>February</option>
 <option>March</option>
 <option>April</option>
 <option>May</option>
 </select>
                  
<?php
    }
?>