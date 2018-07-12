<?php

class PaymentComponent extends Object {

	/*	
	 * 	function    : paymentprocessingwithAuthorizdotnet()
	 * 	params      : $posteddata
	 * 	Description : This function is used to payment process with Authorize Dot Net
	 *  Created On   : 08-07-10 (07:00pm)
 	 */

var $components = array('Session');
		
function paymentprocessingwithAuthorizdotnet($processingData,$totalamtproc){


							//$loginname="3wZ823dV23P"; //live credentials
							//$transactionkey="38db9C8A2d5mE482";
							
							
							$loginname="5Pz87sYLk8W";
							$transactionkey="7F7p49hfQS6n7C6D";
							$host = "apitest.authorize.net";
							//$host = "/xml/v1/request.api";
							
							$post_url = "https://test.authorize.net/gateway/transact.dll";
							 //$post_url =  "https://secure.authorize.net/gateway/transact.dll";
     						
     						App::import('Vendor', '/', array('file' => 'authnetfunction.php'));
                
							$exp_year = $processingData['yearproc'];
                           	$exp_month =$processingData['monthproc'];
                            $expiration_date =$exp_year."-".$exp_month;
                            $card_number = $processingData['cardnoproc'];
                            $cvv_number = $processingData['cvvnoproc'];
                            $firstname = $processingData['fnameproc'];
                            $lastname =$processingData['lnameproc'];
                            
                            $billaddress =$processingData['bill_street1'];
                            $billstate = $processingData['bill_state'];
                            if(is_numeric($billstate)){
                            	$statecode = AppController::getsatezone_code($billstate);	
                            }else{
                            	$statecode = ucfirst($billstate);
                            }
                            
                            $billzip =$processingData['bill_zipcode'];
                            
                            $totalamout = $totalamtproc;

                            $post_values = array(

                                // the API Login ID and Transaction Key must be replaced with valid values
                                "x_login"           => $loginname,
                                "x_tran_key"        => $transactionkey,

                                "x_version"         => "3.1",
                                "x_delim_data"      => "TRUE",
                                "x_delim_char"      => "|",
                                "x_relay_response"  => "FALSE",

                                "x_type"            => "AUTH_CAPTURE",
                                "x_method"          => "CC",
                                "x_card_num"        => "$card_number",
                                "x_exp_date"        => "$expiration_date",
								"x_card_code"        => "$cvv_number",
                                "x_amount"          => "$totalamout",
                                "x_description"     => "Adbook Online Transactions",

                                "x_first_name"      => "$firstname",
                                "x_last_name"       => "$lastname",
                                "x_address"         => "$billaddress",
                                "x_state"           => "$statecode",
                                "x_zip"             => "$billzip"
                                // Additional fields can be added here as outlined in the AIM integration
                                // guide at: http://developer.authorize.net
                            );

                            // This section takes the input fields and converts them to the proper format
                            // for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
                            $post_string = "";
                            foreach( $post_values as $key => $value )
                                { $post_string .= "$key=" . urlencode( $value ) . "&"; }
                            $post_string = rtrim( $post_string, "& " );

                            // This sample code uses the CURL library for php to establish a connection,
                            // submit the post, and record the response.
                            // If you receive an error, you may want to ensure that you have the curl
                            // library enabled in your php configuration
                            $request = curl_init($post_url); // initiate curl object
                                curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
                                curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
                                curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
                                curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
                                $post_response = curl_exec($request); // execute curl post and store results in $post_response
                                // additional options may be required depending upon your server configuration
                                // you can find documentation on curl options at http://www.php.net/curl_setopt
                            curl_close ($request); // close curl object

                            // This line takes the response and breaks it into an array using the specified delimiting character
                            $response_array = explode($post_values["x_delim_char"],$post_response);

                            // The results are output to the screen in the form of an html numbered list.
                            /* echo "<OL>\n";
                             foreach ($response_array as $value)
                              {
                                 echo "<LI>" . $value . "&nbsp;</LI>\n";

                            }
                 
							exit;*/
       						          

                            if($response_array[0] == 1){
                           
                                   ## transaction key $response_array[7]
                                  ##trim($response_array[5])=='Y'
                            		return $response_array[6];
                                   
                            }
                            else{
                            		
                            			$ermsg ="Please provide valid card number/cvv number";
                            		
									$this->Session->setFlash($ermsg,'default', array('class' => 'errormsg'));

                                   return '0';

                            }

}


/*	
	 * 	function    : paymentprocessingwithPaypal()
	 * 	params      : $monthproc,$yearproc,$cardnoproc,$cvvnoproc,$fnameproc,$lnameproc,$totalamtproc
	 * 	Description : This function is used to payment process with Paypal
	 *  Created On   : 09-07-10 (11:30am)
 	 */
		
function paymentprocessingwithPaypal($processingData,$totalamtproc){

		
        $currencyID 	   = urlencode('USD');
	    $paymentType       = urlencode( 'Authorization');
	      
	    $firstName         = urlencode($processingData['fnameproc']);
	    $lastName          = urlencode($processingData['lnameproc']);
	    $creditCardType    = urlencode($processingData['cardtype']);
	    $creditCardNumber  = urlencode($processingData['cardnoproc']);
	    
	    // Month must be padded with leading zero
	    $padDateMonth      = urlencode(str_pad($processingData['monthproc'], 2, '0', STR_PAD_LEFT));
	    $expDateYear       = urlencode($processingData['yearproc']);
	    $cvv2Number        = urlencode($processingData['cvvnoproc']);
	   
	    $street = $processingData['bill_street1'];
	    $city = $processingData['bill_city'];
	    $state = $processingData['bill_state'];
	    $zipcode = $processingData['bill_zipcode'];
	    $countryid= $processingData['bill_country'];
				    		App::import("Model", "Country");
				            $this->Country   = & new Country();
				            $conditions = array("Country.countries_id" => $countryid);
						    $countryname=$this->Country->find('all', array('conditions' => $conditions));
							$countrycode =$countryname[0]['Country']['countries_iso_code_2'];
			
				$ip = AppController::getipaddress();					

$payurl = "&PAYMENTACTION=$paymentType&IPADDRESS=$ip&AMT=$totalamtproc&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber"."&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName"."&STREET=$street&CITY=$city&STATE=$state&ZIP=$zipcode&COUNTRYCODE=$countrycode&CURRENCYCODE=$currencyID";

	//$totalamtproc = round($totalamtproc);
	//echo "<pre>";
	//echo $payurl;
	
	##code for check authantcation
	$paymentStatus = $this->PPHttpPost('DoDirectPayment',$payurl); 
	
	
	##code for payment
	if(isset($paymentStatus['TRANSACTIONID']) && $paymentStatus['TRANSACTIONID'] !=''){
		$txnid = $paymentStatus['TRANSACTIONID'];
		$cmp = "Complete";
		$payurl = "&AUTHORIZATIONID=$txnid&COMPLETETYPE=$cmp&PAYMENTACTION=$paymentType&IPADDRESS=$ip&AMT=$totalamtproc&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber"."&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName"."&STREET=$street&CITY=$city&STATE=$state&ZIP=$zipcode&COUNTRYCODE=$countrycode&CURRENCYCODE=$currencyID";
		$paymentStatusCapture = $this->PPHttpPost('DOCapture',$payurl); 
		
			if(isset($paymentStatusCapture['TRANSACTIONID']) && $paymentStatusCapture['TRANSACTIONID'] !=''){
								
					return $paymentStatusCapture['TRANSACTIONID'];
			}else{
					$ermsg = $paymentStatusCapture['L_LONGMESSAGE0'];
					
					$this->Session->setFlash($ermsg,'default', array('class' => 'errormsg'));
					 return '0';
			}
	}else{
					$ermsg = $paymentStatus['L_LONGMESSAGE0'];
					$this->Session->setFlash($ermsg,'default', array('class' => 'errormsg'));
	
			 return '0';
	}
	
	
	
	
	
}





/*	
	 * 	function    : PPHttpPost()
	 * 	params      : $methodName_ , $nvpStr_
	 * 	Description : This function is used to payment process with Paypal
	 *  Created On   : 08-07-10 (07:00pm)
 	 */

function PPHttpPost($methodName_, $nvpStr_)
{

$API_UserName  = urlencode('anisha_1272871107_biz_api1.smartdatainc.net');
$API_Password  = urlencode('1272871114');
$API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31AFLi0gvuxKWaoEpLeUk1WRZeLDjk');
$API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp';		//for Live: https://api-3t.paypal.com/nvp 

/*
$API_UserName  = urlencode('mohsinirfankhan_api1.yahoo.co.in');
$API_Password  = urlencode('AVNDCC4QJSZNG8EW');
$API_Signature = urlencode('ACUe-E7Hjxmeel8FjYAtjnx-yjHAAFpaYnhU4Ywm644SSBiIfc1m6jS7');
$API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp';		//for Live: https://api-3t.paypal.com/nvp 
*/

 $version = urlencode('61.0');
        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the API operation, version, and API signature in the request.
        $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";


        

        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

        // Get response from the server.
        $httpResponse = urldecode(curl_exec($ch));

        if(!$httpResponse) {
            exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
        }

        // Extract the response details.
        $httpResponseAr = explode("&", $httpResponse);

        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if(sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }

        if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            $httpParsedResponseAr['ACK'] = 'Failure';
            //exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
            return $httpParsedResponseAr;
        }

        return $httpParsedResponseAr;
        
        
        
        
        

}



	
}

?>