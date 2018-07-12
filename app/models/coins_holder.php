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

    class CoinsHolder extends AppModel{

        var $name	= 'CoinsHolder'; 
        var $useTable	= 'coins_holders';// table name


        function getAllRegisteredCoinsOfProject($project_id, $holderid='', $searchkey='', $order='',  $limit='', $page=''){
            $resultArray=null;
            if($project_id){
                $coinsCondition=" CoinsHolder.project_id = '".$project_id."' AND CoinsHolder.delete_status='0' ";

                if($holderid!=''){
                    $coinsCondition.=" AND Holder.id = '".$holderid."' ";     
                }

                if($searchkey!=''){
                    $coinsCondition.=" AND ( CoinsHolder.serialnum like '%".$searchkey."%' OR Coinset.coinset_name  like '%".$searchkey."%' OR Holder.screenname like '%".$searchkey."%' ) "; 
                }

                $this->bindModel(array('belongsTo'=>array(

                'Holder'=>array(

                'foreignKey'=>false,

                'conditions'=>'Holder.id = CoinsHolder.holder_id'

                ),'Coinset'=>array(

                'foreignKey'=>false,

                'conditions'=>'Coinset.id = CoinsHolder.coinset_id'

                )

                )));
                
                $resultArray = $this->find('all',array("conditions"=>$coinsCondition, 'order' =>$order, 'limit' => $limit, 'page' => $page));    

            } 

            return $resultArray;     
        
        }
        
        
    }
?>