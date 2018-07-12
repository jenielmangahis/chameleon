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

class Content extends AppModel{

	var $name	= 'Content'; 
	var $useTable	= 'contents';// table name
	
	
	var $validate = array(
	  					
	  					'title' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Title.'
    										),
    					'metatitle' => array(
	        						'rule' => VALID_NOT_EMPTY,
	    							'message' => 'Please provide Meta Title.'
	    								),
	  					'content' => array(
        								'rule' => VALID_NOT_EMPTY,
	    								'message' => 'Please provide Content.'
    										)								
					   );
                       
                       
                       
    function save_content($p_id,$title,$meta_keyword,$alias,$content,$type, $c_id='0')
    {
    	$content_data['Content']['project_id']=$p_id;
        $content_data['Content']['title']=$title;
        $content_data['Content']['metatitle']=$title;
        $content_data['Content']['metakeyword']=$meta_keyword;
        $content_data['Content']['alias']=$alias;
        $content_data['Content']['internal_alias']=$alias;
        $content_data['Content']['content']=$content;
        $content_data['Content']['type']=$type;
        $content_data['Content']['meta_isindex']=1;
        $content_data['Content']['meta_isfollow']=1;
        $content_data['Content']['is_global']=1;
        $content_data['Content']['file_sequence']=0;
        $content_data['Content']['active_status']=1;
        $content_data['Content']['delete_status']=0;
        $content_data['Content']['is_sytem']=2;
        $content_data['Content']['parent_id']=0;
        $content_data['Content']['page_footer']=0;
        $content_data['Content']['company_id']=$c_id;
        
        $this->Save($content_data['Content']);
    }
    
    
    function create_duplicate_content($id,$title,$type)
    {
        
        $condition="Content.id='".$id."'";
        $content_data= $this->find('first',array("conditions"=>$condition));
        
        $alias=$title." ".$type ;  
        
        $content_data['Content']['title']=$title;     
        $content_data['Content']['alias']=$alias;
        $content_data['Content']['type']=$type;
        $content_data['Content']['id']="";
        
        $this->Save($content_data['Content']);
        
        $lastcontentid = $this->getLastInsertId();
        return $lastcontentid;
    }
 
}
?>