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
	$countset=	$rowcount['productcount'];
	
}
if(!$countset)
{
	$countset=0;	
	
}

$getproduct=getproductlist($accesstoken,$limit,$countset);
if(count($getproduct['data'])==0)
{
	$update="update  optionscount set productcount=0";
	$querycount=mysqli_query($conn,$update);	
}
else
{
	$countset=$countset+$limit;
	$update="update  optionscount set productcount='$countset'";
	$querycount=mysqli_query($conn,$update);		
}

 $sessId =createsession();
foreach($getproduct['data'] as $value)
{
  
    echo $softwarepid=$value['id'];
	echo "<br>";
    
    $select="select * from product where accountpid='$softwarepid'";
    $query=mysqli_query($conn,$select);
    
    if(mysqli_num_rows($query)>0)
    {
        continue;
    }
    
    $name="";
  $description="";
    $salesPrice=0;
    $costPrice=0;
      $categroyidset='';
     $unit='';
      echo  $code=  $value['code'];  
        echo "<Br>";
    echo $name=$value['name'];
    echo "<Br>";
     echo $description=$value['description'];
    echo "<Br>";
    $productGroupId=$value['productGroupId'];
    
   $getgroupdetials=getsinglegroup($accesstoken,$productGroupId);
   echo $groupname=$getgroupdetials['data']['name'];
   echo "<Br>";
    $type=$value['type'];
    echo $unit=$value['unit'];
       echo "<Br>";
    $unitOfMeasureCode=$value['unitOfMeasureCode'];
    
      echo   $availableStock=$value['availableStock'];
      echo "<Br>";
  echo   $costPrice=$value['costPrice'];
  
   echo "<Br>";
    echo $salesPrice=$value['salesPrice'];
    echo "<Br>";
     echo "<Br>";
    

   // echo $categoryname;
    
    // echo $sessId;
if(!empty($groupname))
{
   echo $categroyidset=getcategoryid($groupname,$sessId);
}

     echo "<Br>";
       $parameters = array(
    'session' => $sessId, //Session ID
    'module' => 'AOS_Products',  //Module name
    'name_value_list' => array (
            array('name' => 'name', 'value' => $name),
            array('name' => 'description', 'value' => $description),
           array('name' => 'price', 'value' => $salesPrice),
           array('name' => 'cost', 'value' => $costPrice),
           array('name' => 'aos_product_category_id', 'value' => $categroyidset),
             array('name' => 'maincode', 'value' => $code),
           array('name' => 'part_number', 'value' => $unit),
           
           
            
        ),
    ); 
  $result=restRequest("set_entry", $parameters);
  $productid= $result['id'];
  $dateget=date("Y-m-d h:i:s");
  echo $insert="insert into product set accountpid='$softwarepid',suitpid='$productid',currdate='$dateget'";
    $query=mysqli_query($conn,$insert);
   echo "<hr>";  
   //die();
}