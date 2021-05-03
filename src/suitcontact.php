<?php
include(dirname(__FILE__)."/config.php");
include(dirname(__FILE__)."/functions.php");
$sessId =createsession();
$gettoekn=createaccesstoken();
 $accesstoken=$gettoekn['access_token'];
$select="select * from contact where suitprocessed=0 limit 0,5";
$querycount=mysqli_query($conn,$select);
if(mysqli_num_rows($querycount)==0)
{
	$update="update contact set suitprocessed=0";
	mysqli_query($conn,$update);	
	
}
while($rowcount=mysqli_fetch_array($querycount))
{
	echo $suitcontactid=	$rowcount['suitcontactid'];
	$accountid=	$rowcount['accountid'];
	$id=	$rowcount['id'];
	$update="update contact set suitprocessed=1 where id='$id'";
	mysqli_query($conn,$update);	
	
	
			$get_module_fields_parameters = array(
			
				 //session id
				 'session' => $sessId,
			
				 //The name of the module from which to retrieve records
				 'module_name' => 'Contacts',
				 'query'=>"contacts.id ='".$suitcontactid."'",
				 'select_fields'=>array()
				 
				 //Optional. Returns vardefs for the specified fields. An empty array will return all fields.
				
			);
			//print_r($get_module_fields_parameters);
			$get_module_fields_result = restRequest("get_entry_list", $get_module_fields_parameters);
			print_r($get_module_fields_result['result_count']);
			if($get_module_fields_result['result_count']==0)
			{
				echo "delete";	
				//print_r(singlecontactlist($accesstoken,$accountid));
				echo "<br>";
				echo "<br>";
				$valuegetdeltet=deletecontact($accesstoken,$accountid);
				if($valuegetdeltet['success']==1)
				{
						echo $delete="delete from contact where id='$id'";
						mysqli_query($conn,$delete);	
				}
			}
			
			echo "<hr>";

	
}

