<?php
include(dirname(__FILE__)."/config.php");
include(dirname(__FILE__)."/functions.php");

$gettoekn=createaccesstoken();
 $accesstoken=$gettoekn['access_token'];
echo "<br>";
$refresh_token=$gettoekn['refresh_token'];
$limit=10;
$select="select * from optionscount";
$querycount=mysqli_query($conn,$select);
while($rowcount=mysqli_fetch_array($querycount))
{
	$countset=	$rowcount['contactcount'];
	
}
if(!$countset)
{
	$countset=0;	
	
}


$getcontacts=getcontactlist($accesstoken,$limit,$countset);
$sessId =createsession();
if(count($getcontacts['data'])==0)
{
	$update="update  optionscount set contactcount=0";
	mysqli_query($conn,$update);
	
 	$select="select * from contact where processed=0"	;
	$querydelete=mysqli_query($conn,$select);
	while($rowdelete=mysqli_fetch_array($querydelete))
	{	
		//delete records from suitcrm
		 $suitcontactid=$rowdelete['suitcontactid'];
		$suitaccountid=$rowdelete['suitaccountid'];
			$parameters = array(
				'session' => $sessId, //Session ID
				'module' => 'Contacts',  //Module name
				'name_value_list' => array (
						array('name' => 'id', 'value' => $suitcontactid),
						array('name' => 'deleted', 'value' => '1')
					   
						 ),
				); 
			  $result=restRequest("set_entry", $parameters);
			  
			  print_r($result);
			  
			  $parameters = array(
				'session' => $sessId, //Session ID
				'module' => 'Accounts',  //Module name
				'name_value_list' => array (
						array('name' => 'id', 'value' => $suitaccountid),
						array('name' => 'deleted', 'value' => '1')
					   
						 ),
				); 
			  $result=restRequest("set_entry", $parameters);
			  
			    print_r($result);
				
				echo "<hr>";
			  	
	}
	//die();
	$delete="delete from contact where processed=0"	;
	mysqli_query($conn,$delete);
	
	$update="update  contact set processed=0";
	mysqli_query($conn,$update);
	
}
else
{
	$countset=$countset+$limit;
	$update="update  optionscount set contactcount='$countset'";
	mysqli_query($conn,$update);		
}

//($getcontacts);
  
foreach($getcontacts['data'] as $valuecontact)
{
   
     $legalName="";
	 $vatNumber="";
	 $websiteUrl="";
	 $city="";
	 $zipCode="";
	 $address1="";
	 $countryCode="";
	 $emailAddress="";
	 $phoneNumber="";
   
    echo $personid=$valuecontact['id'];
	echo "<br>";
	  echo $name=$valuecontact['name']; 
	  echo "<br>";
	
	$update="update contact set processed=1 where accountid='$personid'";
    mysqli_query($conn,$update);
	
	$select="select * from contact where accountid='$personid'";
    $query=mysqli_query($conn,$select);
    
    if(mysqli_num_rows($query)>0)
    {
        continue;
    }
	
    
   
    echo "<Br>";
     $contactPersonId=$valuecontact['contactPersonId'];
    
    $contactpersondetails=getsinglecontactperson($accesstoken,$personid,$contactPersonId);
    
    echo $contactpersonname=$contactpersondetails['data']['firstName']." ".$contactpersondetails['data']['lastName'];
    
    $contactfirstname=$contactpersondetails['data']['firstName'];
     $contactlastname=$contactpersondetails['data']['lastName'];
   
     echo "<Br>";
 
   $explodename=explode(" ",$name);
   $getlastname=array();
   for($i=1;$i<count($explodename);$i++)
   {
       array_push($getlastname,$explodename[$i]);
       
   }
   $lastname=implode(",",$getlastname);
      echo "<Br>";
    $legalName=$valuecontact['legalName'];
   
 echo  $vatNumber=$valuecontact['vatNumber']; 
     echo "<Br>";
  echo  $websiteUrl=$valuecontact['websiteUrl'];
     echo "<Br>";
   echo $city=$valuecontact['streetAddress']['city'];
     echo "<Br>";
   echo $zipCode=$valuecontact['streetAddress']['zipCode'];
     echo "<Br>";
  echo  $address1=$valuecontact['streetAddress']['address1'];
     echo "<Br>";
   echo $countryCode=$valuecontact['streetAddress']['countryCode'];
     echo "<Br>";
   echo $emailAddress=$valuecontact['emailAddress'];
      echo "<Br>";
    echo  $phoneNumber=$valuecontact['phoneNumber'];
       echo "<Br>";
       
       //accountcreate
       
        $parameters = array(
    'session' => $sessId, //Session ID
    'module' => 'Accounts',  //Module name
    'name_value_list' => array (
            array('name' => 'name', 'value' => $name),
           array('name' => 'account_type', 'value' =>"Customer"),
           array('name' => 'billing_address_street', 'value' => $address1),
         array('name' => 'billing_address_city', 'value' => $city),
         array('name' => 'billing_address_postalcode', 'value' => $zipCode),
          array('name' => 'billing_address_country', 'value' => $countryCode),
        array('name' => 'phone_office', 'value' => $phoneNumber),
           array('name' => 'website', 'value' => $websiteUrl),
            array('name' => 'email1', 'value' => $emailAddress),
           array('name' => 'phone_fax', 'value' => $vatNumber),
           //account_id
        ),
    ); 
    
      $result=restRequest("set_entry", $parameters);
  $accountid=$result['id'];
    
       $parameters = array(
    'session' => $sessId, //Session ID
    'module' => 'Contacts',  //Module name
    'name_value_list' => array (
            array('name' => 'name', 'value' => $contactpersonname),
            array('name' => 'first_name', 'value' => $contactfirstname),
           array('name' => 'last_name', 'value' => $contactlastname),
           array('name' => 'full_name', 'value' => $contactpersonname),
           array('name' => 'phone_home', 'value' => $phoneNumber),
           array('name' => 'email', 'value' => $emailAddress),
         array('name' => 'phone_mobile', 'value' => $phoneNumber),
         array('name' => 'phone_work', 'value' => $phoneNumber),
          array('name' => 'primary_address_street', 'value' => $address1),
        array('name' => 'email1', 'value' => $emailAddress),
           array('name' => 'primary_address_city', 'value' => $city),
            array('name' => 'primary_address_postalcode', 'value' => $zipCode),
           array('name' => 'primary_address_country', 'value' => $countryCode),
           array('name' => 'account_id', 'value' => $accountid),
           
             ),
    ); 
  $result=restRequest("set_entry", $parameters);
  $contactid=$result['id'];
  $dateget=date("Y-m-d h:i:s");
  echo $insert="insert into contact set accountid='$personid',suitcontactid='$contactid',suitaccountid='$accountid',updatetime='$dateget',processed=1";
    $query=mysqli_query($conn,$insert);
   echo "<hr>";  
   

    
}