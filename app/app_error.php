<?php 
  class AppError extends ErrorHandler {
  
    function error404($params) {
	//echo "<pre>";print_r($params);exit;
    	if(isset($params['action']) && $params['action'] !=''){
    			if($params['className']=='AdminsController'){
    				$this->controller->redirect(array('controller'=>'admins', 'action'=>'pagenotavailable'));
    			}else{
    				//$this->controller->redirect(array('controller'=>'companies', 'action'=>'pagenotavailable'));
    			}
				
    	}else{
    			if(isset($params['className']) && $params['className']!=''){
    				//$this->controller->redirect(array('controller'=>'companies', 'action'=>'notavailable'));
    			}
    	}
      parent::error404($params);
    }
  }
?>