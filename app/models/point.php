<?php
    define("REGISTRATION",1);
    define("REGISTER_COIN",2);
    define("COMMENTS",3);
    define("MISC_COMMENTS",4);
    define("REPLY_TO_COMMNET",5);
    define("POINTS_PER_FRIEND_JOIN",6);
    
    define("FRIEND_JOIN_BONUS",7);
    define("FRIEND_JOIN_BONUS_1",8);
    define("FRIEND_JOIN_BONUS_2",9);
    define("FRIEND_JOIN_BONUS_3",32);
    define("FRIEND_JOIN_BONUS_4",33);
    
    define("DAILY_VISIT",10);
    define("DAY_SEQUENTIAL_BONUS",11);
    define("DAY_SEQUENTIAL_BONUS_1",12);
    define("BUY_A_COIN",13);
    define("BUY_X_COIN_BONUS",14);
    define("BUY_X_COIN_BONUS_1",15);
    define("BUY_X_COIN_BONUS_2",16);
    define("BUY_X_COIN_BONUS_3",17);
    define("DONATION",18);
    define("DONATION_1",19);
    define("DONATION_2",20);
    define("DONATION_3",21);
    define("DONATION_4",22);

    class Point extends AppModel {

        var $name    = 'Point'; 
        var $useTable    = 'points'; // table name 
        
        function triggerPoints($triggerKey = null,$projectId = null,$memberId = null,$levelValue = null)
        {
            
           // Step Get value from point tables
           //$conditions = array("Point.point_id = '". $triggerKey . "'" , "Point.project_id = '$projectId'","Point.memberId = '$memberId'","Point.level = '$levelValue'");
           
           $current_date=date('Y-m-d H:m:s');
           
           if($triggerKey=="Buy_Coin_Check")
           {
                $holder=$this->query("select id from holders where user_id=$memberId and project_id=$projectId");
                $holder=$holder[0]['holders'];
                
                $coin_cnt=$this->query("select count(id) as id from coins_holders where project_id=$projectId and holder_id=$holder[id]");
                $coin_cnt=$coin_cnt[0][0][id];
                
                $query="select * from points where project_id=$projectId and level_value=$coin_cnt and is_active=1 and (point_id=".BUY_X_COIN_BONUS." || point_id=".BUY_X_COIN_BONUS_1." || point_id=".BUY_X_COIN_BONUS_2." || point_id=".BUY_X_COIN_BONUS_3." )";
                
                $find_point_id=$this->query($query);
                
                $triggerKey=$find_point_id[0]['points']['point_id'];
           }
           
           
           if($triggerKey=="FRIEND_JOIN_BONUS_CHECK")
           {
                $invite_details=$this->query("select count(*) as no from invitations where user_id=$memberId and project_id=$projectId and accepted=1");
                $no_of_friends=$invite_details[0][0]['no'];
                
                
                $query="select * from points where project_id=$projectId and level_value=$no_of_friends and is_active=1 and (point_id=".FRIEND_JOIN_BONUS." || point_id=".FRIEND_JOIN_BONUS_1." || point_id=".FRIEND_JOIN_BONUS_2." || point_id=".FRIEND_JOIN_BONUS_3." || point_id=".FRIEND_JOIN_BONUS_4.")";
                
                $find_point_id=$this->query($query);
                
                $triggerKey=$find_point_id[0]['points']['point_id'];
           }
           $points=$this->query("select * from points where project_id=$projectId and point_id=$triggerKey");
           if(!empty($points)){
	           $points=$points['0']['points'];
		   }
           
           if(isset($points['is_active'])==1 || !empty($points['is_active']))      // if admin has checked this as a point award
           {
               //check data already inserted in point_archive_users
               $check_exists=$this->query("select * from point_archive_users where point_id=$triggerKey and member_id=$memberId and project_id=$projectId"); 
               
               if(empty($check_exists))
                    $empty=1;
               else
                    $empty=0;
               
               $check_level=$this->query("select * from master_points where point_id=$triggerKey"); 
               $check_level=$check_level[0]['master_points'];
               
               if($check_level['is_level']==1)  //if it has level value associated with it then check level is satisfied or not
               {
                    //before inserting the points check the level is satisfied or not i.e need to store the level record in db
                    
                    //if($empty==1)
                        $this->query("insert into point_archive_users values('',$triggerKey,$memberId,$projectId,$points[point],'$current_date')");
               }
               else
               {
                   //if($empty==1)
                         $this->query("insert into point_archive_users values('',$triggerKey,$memberId,$projectId,$points[point],'$current_date')");
               }
           }
           
        }
        
        
        
    }
?>
