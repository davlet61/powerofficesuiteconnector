<?php

$url = "https://glasserviceoslo.no/service/v4_1/rest.php";

function restRequest($method, $arguments){
 global $url;
 $curl = curl_init($url);
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


$userAuth = array(
        'user_name' => 'admin',
        'password' => md5('Kerem2016!'),
);
$appName = 'My SuiteCRM REST Client';
$nameValueList = array();

$args = array(
            'user_auth' => $userAuth,
            'application_name' => $appName,
            'name_value_list' => $nameValueList);

$result = restRequest('login',$args);
//print_r($result );
echo $sessId = $result['id'];
$get_module_fields_parameters = array(

     //session id
     'session' => $sessId
);
$get_module_fields_result = restRequest("get_available_modules", $get_module_fields_parameters);

//print_r($get_module_fields_result);
//die();



$get_module_fields_parameters = array(

     //session id
     'session' => $sessId,

     //The name of the module from which to retrieve records
     'module_name' => 'AOS_Products_Quotes',
     'query'=>"aos_products_quotes.parent_id ='13b6efc7-55b2-720a-2889-60dc2a63036d'",
     'select_fields'=>array()
     
     //Optional. Returns vardefs for the specified fields. An empty array will return all fields.
    
);

$get_module_fields_result = restRequest("get_entry_list", $get_module_fields_parameters);
//print_r($get_module_fields_result);
//die();




$get_module_fields_parameters = array(

     //session id
     'session' => $sessId,

     //The name of the module from which to retrieve records
     'module_name' => 'AOS_Invoices',
     'query'=>"aos_invoices.name !=''",
     'select_fields'=>array()
     
     //Optional. Returns vardefs for the specified fields. An empty array will return all fields.
    
);

$get_module_fields_result = restRequest("get_entry_list", $get_module_fields_parameters);

//print_r($get_module_fields_result);
//die("sfsf");

$get_module_fields_parameters = array(

     //session id
     'session' => $sessId,

     //The name of the module from which to retrieve records
     'module_name' => 'Contacts',

     //Optional. Returns vardefs for the specified fields. An empty array will return all fields.
     'fields' => array(
     ),
);

$get_module_fields_result = restRequest("get_module_fields", $get_module_fields_parameters);
print_r($get_module_fields_result);
die();

$search_by_module_parameters = array(
        //Session id
        "session" => $sessId,

        //The string to search for.
        'search_string' => 'sdfsdfd',

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
print_r($result);
//die();
   
  $search_by_module_parameters = array(
        //Session id
        "session" => $sessId,

        //The string to search for.
        'module_name' => 'AOS_Products',

        'select_fields' => array(
        ),

      
       
    );
   
  // $result=restRequest("get_module_fields", $search_by_module_parameters
  
  $parameters = array(
    'session' => $sessId, //Session ID
    'module' => 'AOS_Product_Categories',  //Module name
    'name_value_list' => array (
            array('name' => 'name', 'value' => 'David'),
          
          
           
        ),
    ); 
  
  
      

   
  $result=restRequest("set_entry", $parameters);

print_r($result);
die("sfdsfdsf");
