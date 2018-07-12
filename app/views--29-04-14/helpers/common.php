<?php
/**
 * CSV helper for cakePHP. Compatible with version 1.1.x.x and higher.
 *
 * PHP versions 4 and 5
 *
 * Licensed under The MIT License
 *
 * @copyright		Adam Royle
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class CommonHelper extends Helper{
	function CommonHelper() {
        //$this->clear();
    }
    
    
    function showDate($d1){
        return $d1;
    }
	function dateDiffer($d1, $d2){   //$d1=date("Y-m-d h:i:s"); 
    //$d2="2011-08-10 15:53:45";
    $d1 = (is_string($d1) ? strtotime($d1) : $d1);
    $d2 = (is_string($d2) ? strtotime($d2) : $d2);

    $diff_secs = abs($d1 - $d2);
    $base_year = min(date("Y", $d1), date("Y", $d2));

    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
    if(date("Y", $diff) - $base_year > 0){
        $years=date("Y", $diff) - $base_year;
        $agotime= $years." years ago";
    }else if(date("n", $diff) - 1 > 0){
        $monts=date("n", $diff) - 1;
        $agotime= $monts." months ago";
    }else  if(date("j", $diff) - 1 > 0){
        $days=date("j", $diff) - 1;
        $agotime= $days." days ago";
    }else  if( date("G", $diff) > 0){
        $hrs= date("G", $diff);
        $agotime= $hrs." hours ago";
    }else  if((int) date("i", $diff) > 0){
        $mins= (int) date("i", $diff);
        $agotime= $mins." minutes ago";
    }else  if( (int) date("s", $diff)   > 0){
        $secs= (int) date("s", $diff);
        $agotime= $secs." seconds ago";
    }
    
  /* return array(
        "years" => date("Y", $diff) - $base_year,
        "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
        "months" => date("n", $diff) - 1,
        "days_total" => floor($diff_secs / (3600 * 24)),
        "days" => date("j", $diff) - 1,
        "hours_total" => floor($diff_secs / 3600),
        "hours" => date("G", $diff),
        "minutes_total" => floor($diff_secs / 60),
        "minutes" => (int) date("i", $diff),
        "seconds_total" => $diff_secs,
        "seconds" => (int) date("s", $diff)
    );   */
    return $agotime;
}


function getCompanyCategoryName($categoryId){

	 App::import("Model", "CompanyTypeCategory");
	 $this->CompanyTypeCategory =   & new CompanyTypeCategory();
	 $condition = 'id ='.$categoryId;
	 $companydtlarr = $this->CompanyTypeCategory->find('all',array("conditions"=>$condition));
	 return $companydtlarr;	
}

function getCompanyTypeName($typeId){

	 App::import("Model", "CompanyType");
	 $this->CompanyType =   & new CompanyType();
	 $condition = 'id ='.$typeId;
	 $companydtlarr = $this->CompanyType->find('all',array("conditions"=>$condition));
	 return $companydtlarr;	
}

function getrelationshiptype($rstID,$type){
		$relationship_type = array('1' => 'Advertiser','2' => 'Merchants','3' => 'Member','4' => 'Non-Profit','5' => 'Other','6' => 'Sales','7' => 'Vendors');			
		
		
		if($rstID > 0 && $type == 'list'){				
			return $relationship_type[$rstID];
		}else{
			return $relationship_type;
		}
				
	}
	
	function getStatusTypeDropdown(){
		$statustypedropdown = array('0' => 'New','1' => 'Open','2' => 'Merchant Added','3' => 'Non-Profit','4' => 'Vendor Added','5' => 'Sales Added','6' => 'Advertiser Added','7' => 'Other Added');			
	return $statustypedropdown;
		
				
	}
	
	function getRelationshipTypeForResponder($rstID,$type){
		$relationship_type = array('1' => 'Advertiser','2' => 'Merchants','4' => 'Non-Profit','5' => 'Other','6' => 'Sales','7' => 'Vendors');

		if($rstID > 0 && $type == 'list'){
			return $relationship_type[$rstID];
		}else{
			return $relationship_type;
		}
	
	}	

	function getALLRelationshipTypeForResponder($rstID,$type){
		$relationship_type = array('1' => 'Advertiser','2' => 'Merchants','3' => 'Member','4' => 'Non-Profit','5' => 'Other','6' => 'Sales','7' => 'Vendors','8' => 'Offer','9' => 'Event',);
	
		if($rstID > 0 && $type == 'list'){
			return $relationship_type[$rstID];
		}else{
			return $relationship_type;
		}
	
	}

	function getSubCategoryName($categoryId){

	 App::import("Model", "Category");
	 $this->Category =   & new Category();
	 $condition = 'parent_category ='.$categoryId;
	 $subCategoryData = $this->Category->find('all',array("conditions"=>$condition));
	 return $subCategoryData;	
}

function getSofferpagename($pageId){
	 App::import("Model", "Content");
	 $this->Content =   & new Content();
	 $condition = 'id ='.$pageId;
	 $offerpagename = $this->Content->find('all',array("conditions"=>$condition ,'fields'=>'title'));
	 return $offerpagename;	
	}
function getNonProfitName($MerchantId){
	 App::import("Model", "Company");
	 $this->Company =   & new Company();
	 $this->Company->bindModel(array('hasMany'=>array(
				'RelatedNonProfit'=>array(
				'foreignKey'=>'company_id'
      ))));
	 $condition = 'Company.id ='.$MerchantId;
	 $nonProfitName = $this->Company->find('all',array("conditions"=>$condition ));
	 $nonprofitarray = array(0);
	 foreach($nonProfitName[0]['RelatedNonProfit'] as $nonProfit){
		  $nonprofitarray[]  = $nonProfit['nonprofit_id'];
		 }
			$condition = 'Company.id IN ('.implode(',', $nonprofitarray).')'; 
			$companyName = $this->Company->find('all',array("conditions"=>$condition,'fields'=>'company_name'));		 
			$companyNamearray =array();
			
		    foreach($companyName as $company){
				$companyNamearray[] = $company['Company']['company_name'];
			}
			return implode(',', $companyNamearray );
	}
	function getTempName($tmpid){
		App::import("Model", "EmailTemplate");
		 $this->EmailTemplate =   & new EmailTemplate();
		 $condition = 'EmailTemplate.id ='.$tmpid;
		 $tmpname = $this->EmailTemplate->find('all',array("conditions"=>$condition,'fields'=>'email_template_name' ));
		return $tmpname['0']['EmailTemplate']['email_template_name'];
	}
	
	function getServeyFormName($surveyid){
		App::import("Model", "Survey");
		 $this->Survey =   & new Survey();
		 $condition = 'Survey.id ='.$surveyid;
		 $tmpname = $this->Survey->find('all',array("conditions"=>$condition,'fields'=>'survey_name' ));
		return $tmpname['0']['Survey']['survey_name'];
	}
	function getCustomSubMenu($menuid){
		App::import("Model", "Iteam");
		 $this->Iteam =   & new Iteam();
		 $condition = 'Iteam.pid ='.$menuid;
		 $tmpdata = $this->Iteam->find('list',array("conditions"=>$condition));
		return $tmpdata;
	}
	
	function getLinkAddressName($id){
		App::import("Model", "LinkAddress");
		 $this->LinkAddress =   & new LinkAddress();
		 $condition = 'LinkAddress.id ='.$id;
		 $tmpdata = $this->LinkAddress->find('first',array("conditions"=>$condition));
		return $tmpdata['LinkAddress']['link_address'];
	}

	function getLinkInfoBySortCodeName($name){ 
		App::import("Model", "Link");
		 $this->Link =   & new Link();
		 $tmpdata = $this->Link->find('first',array("conditions"=>array('Link.visual_text' => $name)));
		return $tmpdata;
	}
	function getLinkPlacement($pid){ 
		App::import("Model", "Placement");
		 $this->Placement =   & new Placement();
		 $tmpdata = $this->Placement->find('first',array("conditions"=>array('Placement.id' => $pid)));
		return $tmpdata['Placement']['place_name'];
	}

	function getCityName($cid){ 
		App::import("Model", "City");
		 $this->City =   & new City();
		 $tmpdata = $this->City->find('first',array("conditions"=>array('City.city_id' => $cid)));
		return $tmpdata['City']['city_name'];
	}

	function getStateName($sid){ 
		App::import("Model", "State");
		 $this->State =   & new State();
		 $tmpdata = $this->State->find('first',array("conditions"=>array('State.state_id' => $sid)));
		return $tmpdata['State']['state_name'];
	}

	function checkMenuPermission($checkMenu,$hideMenuPermission)
	{	
		$flagHideMenuPermission = false;
		if(isset($hideMenuPermission)&&!empty($hideMenuPermission))
		{
			foreach($hideMenuPermission as $arrayKey=>$arrayValue)
			{
				if(array_key_exists($checkMenu,$arrayValue))
				{
					$flagHideMenuPermission = true;
				}
			}
		}
/*		if($hideMenuPermission=="")
		{
			$flagHideMenuPermission = true;
		}*/
		return $flagHideMenuPermission;
	}
	
	function checkSubMenuPermission($checkSubMenu,$hideSubMenuPermission,$c_name,$f_name)
	{	
		$flagSubHideMenuPermission = false;
		/*if(isset($hideSubMenuPermission)&&!empty($hideSubMenuPermission))
		{
			foreach($hideSubMenuPermission as $arrayKey=>$arrayValue)
			{
				if(array_key_exists($checkSubMenu,$arrayValue))
				{
					
					foreach($arrayValue as $key=>$value)
					{	
						if($key == $checkSubMenu && $value['c_name']== $c_name)
						{
							$flagSubHideMenuPermission = true;
							break;
						}
					}
				}
			}
		}*/
		
		if(isset($hideSubMenuPermission)&&!empty($hideSubMenuPermission))
		{
			foreach($hideSubMenuPermission as $arrayKey=>$arrayValue)
			{
				if(array_key_exists($checkSubMenu,$arrayValue))
				{
					$flagSubHideMenuPermission = true;
				}
			}
		}
		
		if($hideSubMenuPermission=="")
		{
			$flagSubHideMenuPermission = true;
		}
		return $flagSubHideMenuPermission;
	}
	


	

}

?>