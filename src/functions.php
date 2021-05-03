<?php
function createaccesstoken()
{
	global $apiurl;
	global $clientkey;
	global $applicationkey;
	
//	echo $apiurl."/OAuth/Token";
//	echo "<br>";
//	echo $applicationkey."app";
	//	echo "<br>";
//	echo $clientkey."client";
			$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => $apiurl."/OAuth/Token",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
		
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
			  CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: Basic ".base64_encode("$applicationkey:$clientkey"),
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded",
				"postman-token: 2e2b4af2-8940-64cd-2f53-7b1ad988323b"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

		
			  return json_decode($response,true);
			
}
function getproductlist($accesstoken,$limit,$countset)
{
	//https://api-demo.poweroffice.net/customer/?$orderby=Code&$top=5&$skip=5
    	global $apiurl;
         $curl = curl_init();


        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl.'Product/?$orderby=Code&$top='.$limit.'&$skip='.$countset,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}
function getquotelist($accesstoken,$quoteid)
{
    	global $apiurl;
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."OutgoingInvoice/".$quoteid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}
function getsingleproduct($accesstoken,$productid)
{
    	global $apiurl;
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."Product/".$productid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}

function getcontactlist($accesstoken,$limit,$countset)
{
    	global $apiurl;
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."customer/".'?$orderby=Code&$top='.$limit.'&$skip='.$countset,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}
function singlecontactlist($accesstoken,$customerid)
{
    	global $apiurl;
         $curl = curl_init();
echo $apiurl."customer/".$customerid;
        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."customer/".$customerid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}

function deletecontact($accesstoken,$customerid)
{
    	global $apiurl;
         $curl = curl_init();
echo $apiurl."customer/".$customerid;
        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."customer/".$customerid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}

function getsinglecontactperson($accesstoken,$customerid,$personid)
{
    	global $apiurl;
    
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."Customer/$customerid/Contact/".$personid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
    $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}
function getsinglegroup($accesstoken,$groupid)
{
    	global $apiurl;
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."ProductGroup/".$groupid,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$accesstoken,
            "cache-control: no-cache",
            "postman-token: e38f438f-a6f6-834f-9bd5-27bdb6bf9bb5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
     
          return json_decode($response,true);
      

}
function restRequest($method, $arguments){
 global $urlsuitcrm;
 $curl = curl_init($urlsuitcrm);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $post = array(
         "method" => $method,
         "input_type" => "JSON",
         "response_type" => "JSON",
         "rest_data" => json_encode($arguments),
 );
 
// print_r($post);

 curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

 $result = curl_exec($curl);
 curl_close($curl);
 return json_decode($result,1);
}
function createsession()
{
    global $suitcrmusername;
     global $suitcrmpassword;
    $userAuth = array(
        'user_name' => $suitcrmusername,
        'password' => md5($suitcrmpassword),
);
$appName = 'My SuiteCRM REST Client';
$nameValueList = array();

$args = array(
            'user_auth' => $userAuth,
            'application_name' => $appName,
            'name_value_list' => $nameValueList);

$result = restRequest('login',$args);
return $result['id'];
}
function getcategoryid($categoryname,$sessionid)
{
    $search_by_module_parameters = array(
        //Session id
        "session" => $sessionid,

        //The string to search for.
        'search_string' => $categoryname,

        //The list of modules to query.
        'modules' => array(
        'AOS_Product_Categories',
        ),

        //The record offset from which to start.
        'offset' => 0,

        //The maximum number of records to return.
        'max_results' => 2,

        //Filters records by the assigned user ID.
        //Leave this empty if no filter should be applied.
        'id' => '',

        //An array of fields to return.
        //If empty the default return fields will be from the active listviewdefs.
        'select_fields' => array(
            'id',
            'name'
        ),

        //If the search is to only search modules participating in the unified search.
        //Unified search is the SugarCRM Global Search alternative to Full-Text Search.
        'unified_search_only' => false,

       
    );
        $result=restRequest("search_by_module", $search_by_module_parameters);
        if(count($result['entry_list'][0]['records'])>0)
        {
           // echo "case1";
           return $categoryid=$result['entry_list'][0]['records'][0]['id']['value'] ;
            
        }
        else
        {
           // echo "case2";
            $parameters = array(
                'session' => $sessionid, //Session ID
                'module' => 'AOS_Product_Categories',  //Module name
                'name_value_list' => array (
                        array('name' => 'name', 'value' =>$categoryname),
                      
                      
                       
                    ),
                ); 
              // print_r($parameters);
                
                $result=restRequest("set_entry", $parameters);
              //  print_r($result);
                return $result['id'];
                
        }
    
}