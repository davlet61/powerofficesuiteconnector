<?php
include(dirname(__FILE__)."/config.php");
include(dirname(__FILE__)."/functions.php");
$sessId =createsession();
$gettoekn=createaccesstoken();
$accesstoken=$gettoekn['access_token'];
$select="select * from  optionscount "	;
	$querydelete=mysqli_query($conn,$select);
	while($rowdelete=mysqli_fetch_array($querydelete))
	{	
		$countset=$rowdelete['suticontact'];
	}
 
 echo "countstart".$countset;
 echo "<Br>";
//$contactlist= singlecontactlist($accesstoken,12072256);

 
$get_module_fields_parameters = array(
			
				 //session id
				 'session' => $sessId,
			
				 //The name of the module from which to retrieve records
				 'module_name' => 'Contacts',
				 'query'=>"contacts.deleted='0'",
				 'order_by'=>"id",	
				 'offset'=>$countset,			
				 'select_fields'=>array()
				);
				
		/*		$get_module_fields_parameters = array(

					 //session id
					 'session' => $sessId,
				
					 //The name of the module from which to retrieve records
					 'module_name' => 'Contacts',
					 'query'=>"contacts.id ='79afcdfc-5115-b22e-d45e-60ed88931234'",
					 'select_fields'=>array()
					 
					 //Optional. Returns vardefs for the specified fields. An empty array will return all fields.
					
				);*/

			//print_r($get_module_fields_parameters);
			$get_module_fields_result = restRequest("get_entry_list", $get_module_fields_parameters);
			
				//print_r($get_module_fields_result);
				//die();
			$resultcount=$get_module_fields_result['result_count'];
			
			$entry_list=$get_module_fields_result['entry_list'];
			echo "<br>";
			echo $resultcount;
			echo "<br>";
			if(count($entry_list)>0)
			{
			$update="update optionscount set suticontact=suticontact+$resultcount";
			}
			else
			{
				$update="update optionscount set suticontact=0";	
			}
			mysqli_query($conn,$update);
			//print_r($get_module_fields_result);
			//die();
			foreach($entry_list as $value)
			{
				//print_r($value);
				echo $id=	$value['name_value_list']['id']['value'];
				$name=	$value['name_value_list']['name']['value'];
				echo "<bR>";
				
				$update="update contact set processed=1 where suitcontactid='$id'";
					mysqli_query($conn,$update);
					
					echo $select="select * from contact where suitcontactid='$id'";
					$query=mysqli_query($conn,$select);
					echo "<br>";
					if(mysqli_num_rows($query)>0)
					{
						continue;
					}
	
				
				$first_name=	$value['name_value_list']['first_name']['value'];
				if(!empty($value['name_value_list']['salutation']['value']))
				{
					$first_name=$value['name_value_list']['salutation']['value']." ".$first_name;	
				}
				$last_name=	$value['name_value_list']['last_name']['value'];
				$full_name=	$value['name_value_list']['full_name']['value'];
				
				$phone_home=	$value['name_value_list']['phone_home']['value'];
				$email=	$value['name_value_list']['email']['value'];
				$phonenumber=	$value['name_value_list']['phone_mobile']['value'];
			if(empty($phonenumber))
			{
				$phonenumber=	$value['name_value_list']['phone_work']['value'];
			}
			if(empty($phonenumber))
			{
				$phonenumber=	$value['name_value_list']['phone_other']['value'];
			}
				$phone_fax=	$value['name_value_list']['phone_fax']['value'];
				$email1=	$value['name_value_list']['email1']['value'];
				$email2=	$value['name_value_list']['email2']['value'];
				$primary_address_street=	$value['name_value_list']['primary_address_street']['value'];
				$primary_address_state=	$value['name_value_list']['primary_address_state']['value'];
				$primary_address_postalcode=	$value['name_value_list']['primary_address_postalcode']['value'];
				$primary_address_country=	$value['name_value_list']['primary_address_country']['value'];
				$primary_address_country=strtoupper($primary_address_country);
				
				$primary_address_countryuc=ucfirst(strtolower($primary_address_country));
				
				
				
				 $selectcount="select * from country where name='$primary_address_country' or iso='$primary_address_country' or iso3='$primary_address_country' or nicename='$primary_address_countryuc'";
				 
				 
					$querycount=mysqli_query($conn,$selectcount);
					while($rowcount=mysqli_fetch_array($querycount))
					{
						$primary_address_countrycode=$rowcount['iso'];	
						
					}
				
				
				
				
				$account_id  =	$value['name_value_list']['account_id']['value'];
				
				$get_module_fields_parameters = array(

					 //session id
					 'session' => $sessId,
				
					 //The name of the module from which to retrieve records
					 'module_name' => 'Accounts',
					 'query'=>"accounts.id ='".$account_id."'",
					 'select_fields'=>array()
					 
					 //Optional. Returns vardefs for the specified fields. An empty array will return all fields.
					
				);
			
			$contactdetails = restRequest("get_entry_list", $get_module_fields_parameters);
			
			$contactname=$contactdetails['entry_list'][0]['name_value_list']['name']['value'];
			$explodename=explode(" ",$contactname);
		   $getlastname=array();
		   for($i=1;$i<count($explodename);$i++)
		   {
			   array_push($getlastname,$explodename[$i]);
			   
		   }
		   $lastname=implode(",",$getlastname);
   
   
			$website=$contactdetails['entry_list'][0]['name_value_list']['website']['value'];
			$email1cotnact=$contactdetails['entry_list'][0]['name_value_list']['email1']['value'];
			
			$phonenumbercontact=	$contactdetails['entry_list'][0]['name_value_list']['phone_mobile']['value'];
			if(empty($phonenumbercontact))
			{
				$phonenumbercontact=	$contactdetails['entry_list'][0]['name_value_list']['phone_work']['value'];
			}
			if(empty($phonenumbercontact))
			{
				$phonenumbercontact=	$contactdetails['entry_list'][0]['name_value_list']['phone_other']['value'];
			}
				$billing_address_streetcontact=	$contactdetails['entry_list'][0]['name_value_list']['billing_address_street']['value'];
				
				$billing_address_citycont=	$contactdetails['entry_list'][0]['name_value_list']['billing_address_city']['value'];
				$billing_address_postalcodecont=	$contactdetails['entry_list'][0]['name_value_list']['billing_address_postalcode']['value'];
				$billing_address_countrycontset=	$contactdetails['entry_list'][0]['name_value_list']['billing_address_country']['value'];
				
				$billing_address_countrycontset=strtoupper($billing_address_countrycontset);
				$billing_address_countrycontsetuc=ucfirst(strtolower($billing_address_countrycontset));
				
				 $selectcount="select * from country where name='$billing_address_countrycontset' or iso='$billing_address_countrycontset' or iso3='$billing_address_countrycontset' or nicename='$billing_address_countrycontsetuc'";
					$querycount=mysqli_query($conn,$selectcount);
					while($rowcount=mysqli_fetch_array($querycount))
					{
						$billing_address_countrycontsetcode=$rowcount['iso'];	
						
					}
				
				
				
				
				
				$parameterquote['invoiceDeliveryType']=1;
				$parameterquote['invoiceEmailAddress']=$email1;
				$parameterquote['sendReminders']=1;
				
				$parameterquote['name']=$contactname;
				$parameterquote['legalName']=$contactname;
				//$parameterquote['contactPersonId']=1;
				$parameterquote['vatNumber']=$phone_fax;
				
					$parameterquote['websiteUrl']=$website;
					
				$parameterquote['mailAddress']['city']=$primary_address_city;
				$parameterquote['mailAddress']['zipCode']=$primary_address_postalcode;
				$parameterquote['mailAddress']['address1']=$primary_address_street;
				$parameterquote['mailAddress']['countryCode']=$primary_address_countrycode;
				
					$parameterquote['streetAddress']['city']=$primary_address_city;
				$parameterquote['streetAddress']['zipCode']=$primary_address_postalcode;
				$parameterquote['streetAddress']['address1']=$primary_address_street;
				$parameterquote['streetAddress']['countryCode']=$primary_address_countrycode;
				
				$parameterquote['emailAddress']=$email1;
				$parameterquote['phoneNumber']=$phonenumber;
			
				
				
				//echo "<br>";
				//echo $apiurl."Customer";
				//echo "<br>";
				//echo $accesstoken;
				global $apiurl;
						 $curl = curl_init();
				
						curl_setopt_array($curl, array(
						  CURLOPT_URL => $apiurl."Customer",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_POSTFIELDS => json_encode($parameterquote),
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_HTTPHEADER => array(
							"authorization: Bearer ".$accesstoken,
							 "Content-Type: application/json; charset=utf-8",
							"cache-control: no-cache",
							"postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
						  ),
						));
						
						 $response = curl_exec($curl);
						$err = curl_error($curl);
						
						curl_close($curl);
						$quoteresponse=json_decode($response,true);
						print_r($quoteresponse);
						echo "<br>";
						if($quoteresponse['success']!=1)
						{
							//print_r($contactdetails);
							//die();
							continue;
						}
						
						echo $customerid=$quoteresponse['data']['id'];
						echo "<br>";
						echo "<br>";
						
						$paramconatct['firstName']=$first_name;
						$paramconatct['lastName']=$last_name;
						$paramconatct['emailAddress']=$email1cotnact;
						$paramconatct['phoneNumber']=$phonenumbercontact;
						$paramconatct['isActive']=1;
						$paramconatct['address1']=$billing_address_streetcontact;						
						$paramconatct['city']=$billing_address_citycont;
						$paramconatct['zipCode']=$billing_address_postalcodecont;
						$paramconatct['residenceCountryCode']=$billing_address_countrycontsetcode;
						
						print_r($paramconatct);
						 $curl = curl_init();
				
						curl_setopt_array($curl, array(
						  CURLOPT_URL => $apiurl."Customer/".$customerid."/Contact",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_POSTFIELDS => json_encode($paramconatct),
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_HTTPHEADER => array(
							"authorization: Bearer ".$accesstoken,
							 "Content-Type: application/json; charset=utf-8",
							"cache-control: no-cache",
							"postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
						  ),
						));
						
						 $response = curl_exec($curl);
						$err = curl_error($curl);
						
						curl_close($curl);
						$quoteresponse=json_decode($response,true);
						
						
						
						 echo $insert="insert into contact set accountid='$customerid',suitcontactid='$id',suitaccountid='$account_id',updatetime='$dateget',processed=1";
    $query=mysqli_query($conn,$insert);
   echo "<hr>";  
								
				
				//die();
				
			}
			

