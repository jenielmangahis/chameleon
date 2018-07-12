<?php
/*
Purpose: User model class
#
Model class names are singular.
#
Model class names are Capitalized for single-word models, and UpperCamelCased for multi-word models.
      Examples: Person, Monkey, GlassDoor, LineItem, ReallyNiftyThing
#
Model filenames use a lower-case underscored syntax.
      Examples: person.php, monkey.php, glass_door.php, line_item.php, really_nifty_thing.php
#

#     Model name: Set var $name in your model definition.


      Model-related database tables: Set var $useTable in your model definition.

*/

class Comment extends AppModel{

	var $name	= 'Comment'; 
	var $useTable	= 'comments';// table name
	
 	var $validate = array(
	  					
	  					'comment' => array(
        								'rule' => VALID_NOT_EMPTY
    										)						
					   );
                       
function getCommentsByHolderCondition($holderid, $project_id, $searchkey=""){
     if($holderid && $project_id){
            $condition=" Comment.holder_id='".$holderid."' and Comment.project_id='".$project_id."' and Comment.active_status='1' and Comment.delete_status='0' ";          
            if($searchkey!=""){
                $condition .= " AND ( Comment.comment like '%".$searchkey."%' OR CommentType.comment_type_name like '%".$searchkey."%'  ) ";             
            }
             return $condition;  
     }else{
         return "";
     }
    
 }
 
 function getCommentsByHolder($condition="", $order="", $limit="", $page=""){
    $resultArray=null;    
    $this->bindModel(array('belongsTo'=>array(
            'CommentType'=>array(
            'foreignKey'=>false,
            'conditions'=>'CommentType.id = Comment.comment_type_id'
            )       )));
     
      /** if($order=="" || $limit=="" || $page==""){
            $resultArray= $this->find('all',array("conditions"=>$condition));  
        }else{  *************/
             $resultArray = $this->find('all',array("conditions"=>$condition, 'order' =>$order, 'limit' => $limit, 'page' => $page)); 
      //  }
     
  
     return $resultArray;
 }     
 
 
  function getCommentAndRepliesByHolder($holderid, $project_id, $searchkey="", $order="", $limit="", $page=""){
    $resultArray=null;    

   $sqlQuery=" SELECT * FROM
                (
                SELECT null as reply_id, Comment.id id, Comment.project_id project_id, Comment.comment commentdata, 
                Comment.holder_id holder_id, Comment.coinset_id coinset_id,  Comment.coin_holder_id coin_holder_id, Comment.created comment_date,
                CommentType.id commenttype_id, CommentType.comment_type_name, CommentType.comment_type_purpose, CommentType.is_additional_allowed, CommentType.sequence_id 
                from comments Comment 
                Left Join comment_types CommentType on CommentType.id=Comment.comment_type_id
                where Comment.project_id='".$project_id."' and Comment.holder_id='".$holderid."' and  Comment.active_status='1' and Comment.delete_status='0' 
                and CommentType.project_id='".$project_id."' and  CommentType.active_status='1' and CommentType.delete_status='0' 
                UNION
                SELECT CommentReply.id reply_id, CommentReply.comment_id id, CommentReply.project_id project_id, CommentReply.reply commentdata, 
                CommentReply.holder_id holder_id, CommentReply.coinset_id coinset_id,  CommentReply.coin_holder_id coin_holder_id, CommentReply.created comment_date,
                CommentType.id commenttype_id, CommentType.comment_type_name, CommentType.comment_type_purpose, CommentType.is_additional_allowed, CommentType.sequence_id
                from comment_replies CommentReply 
                Left Join comment_types CommentType on CommentType.id=CommentReply.comment_type_id
                where CommentReply.project_id='".$project_id."' and CommentReply.holder_id='".$holderid."' and  CommentReply.active_status='1' and CommentReply.delete_status='0' 
                and CommentType.project_id='".$project_id."' and  CommentType.active_status='1' and CommentType.delete_status='0' 
                ) AS Comments   ";
                    
          if($searchkey){
                 $sqlQuery.=" Where Comments.commentdata like '%".$searchkey."%' OR Comments.comment_type_name like '%".$searchkey."%' ";
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