<?php
    

    class PointArchiveUser extends AppModel {

        var $name    = 'PointArchiveUser'; 
        var $useTable    = 'point_archive_users'; // table name 
        
    
    
 function getPointsByHolderCondition($holderid, $project_id, $searchkey=""){

			App::import("Model", "Holder");
            $this->Holder   = & new Holder();
            $this->Holder->id=$holderid;
            $holderdata=$this->Holder->read();
            $member_id=$holderdata['Holder']['user_id'];
          
            
     if($member_id && $project_id){
            $condition=" PointArchiveUser.member_id='".$member_id."' and PointArchiveUser.project_id='".$project_id."'  ";          
            if($searchkey!=""){
               // $condition .= " AND ( Message.to_holdername like '%".$searchkey."%' OR Message.from_holdername like '%".$searchkey."%' OR  Message.msg_subject  like '%".$searchkey."%' ) ";             
            }
             return $condition;  
     }else{
         return "";
     }
    
 }
 
 function getPointsByHolder($holderid, $project_id, $searchkey="", $order="", $limit="", $page=""){
    $resultArray=null;    
      App::import("Model", "Holder");
            $this->Holder   = & new Holder();
            $this->Holder->id=$holderid;
            $holderdata=$this->Holder->read();
            $member_id=$holderdata['Holder']['user_id'];
            
 /*   $this->bindModel(array('belongsTo'=>array(
            'MasterPoint'=>array(
            'foreignKey'=>false,
            'conditions'=>'MasterPoint.point_id = PointArchiveUser.point_id'
            )       )));
     
      /** if($order=="" || $limit=="" || $page==""){
            $resultArray= $this->find('all',array("conditions"=>$condition));  
        }else{  *************/
           //  $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
      //  }    */
      
        $sqlQuery=" select PointArchiveUser.* ,MasterPoint.*, 
                            (select sum(up.points) from point_archive_users up where up.id <= PointArchiveUser.id and up.project_id=".$project_id." and up.member_id=".$member_id." ) as total_points,
                            (select level from points_awards 
                                          where project_id=".$project_id." 
                                          and points_required <= (select sum(up.points) from point_archive_users up where up.id <= PointArchiveUser.id and up.project_id=".$project_id." and up.member_id=".$member_id." ) 
                                          and points_required >0  and is_active=1 order by points_required desc limit 1) as point_level
                    from point_archive_users PointArchiveUser
                    Left join  master_points MasterPoint on  PointArchiveUser.point_id=MasterPoint.point_id
                    where PointArchiveUser.project_id=".$project_id." and PointArchiveUser.member_id=".$member_id."  ";
                    
          if($searchkey){
                 $sqlQuery.=" AND MasterPoint.Point_Name like '%".$searchkey."%' ";
          }
          
          if($order){
              $sqlQuery.=" ORDER BY ".$order;
          }
          
          if($limit && $page){
                $start=($limit * ($page - 1));
                $sqlQuery.=" Limit ".$start.", ".$limit; 
          }
  
    $resultArray= $this->query($sqlQuery);
     return $resultArray;
 }
        
    }
?>
