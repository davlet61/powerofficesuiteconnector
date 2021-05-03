<?php
include(dirname(__FILE__)."/config.php");
include(dirname(__FILE__)."/functions.php");
$sessId =createsession();
$limit=1;

$select="select * from optionscount";
$querycount=mysqli_query($conn,$select);
while($rowcount=mysqli_fetch_array($querycount))
{
	$countset=	$rowcount['invoicecount'];
	
}
if(!$countset)
{
	$countset=0;	
	
}

$get_module_fields_parameters = array(
     //session id
     'session' => $sessId,
     //The name of the module from which to retrieve records
     'module_name' => 'AOS_Invoices',
     'query'=>"aos_invoices.name !=''",
     'select_fields'=>array() ,
	 'max_results'=>'',
	 'offset'=>$countset,
	 "order_by"=>'id',
	 "deleted"=>0
);
$gettoekn=createaccesstoken();
$accesstoken=$gettoekn['access_token'];
			
////print_r($get_module_fields_parameters);
//print_r(getquotelist($accesstoken,"5beae82b-8d06-44fe-931b-cb3659561dc6"));
//die();
$getinvoice = restRequest("get_entry_list", $get_module_fields_parameters);
//print_r($getinvoice);
 $countset=$getinvoice['next_offset'];
if(count($getinvoice['entry_list']['name_value_list'])==0)
{
	$update="update  optionscount set invoicecount=0";
	$querycount=mysqli_query($conn,$update);	
}
else
{
	
	$update="update  optionscount set invoicecount='$countset'";
	$querycount=mysqli_query($conn,$update);		
}


foreach($getinvoice['entry_list'] as $valuelist)
{
	
	echo  $name=$valuelist['name_value_list']['name']['value'];
	
	echo "<bR>";
	//print_r($valuelist);
	//die();
	$id=$valuelist['id'];
	
	$select="select * from  invoice where suitinvoiceid='$id'";
    $query=mysqli_query($conn,$select);
    
    if(mysqli_num_rows($query)>0)
    {
        continue;
    }
	
	
	 $name=$valuelist['name_value_list']['name']['value'];
	
	$date_entered=$valuelist['name_value_list']['date_entered']['value'];
	$description=$valuelist['name_value_list']['description']['value'];
	$billing_address_street=$valuelist['name_value_list']['billing_address_street']['value'];
	$billing_address_city=$valuelist['name_value_list']['billing_address_city']['value'];
	$billing_address_state=$valuelist['name_value_list']['billing_address_state']['value'];
	$billing_address_postalcode=$valuelist['name_value_list']['billing_address_postalcode']['value'];
	$billing_address_country=$valuelist['name_value_list']['billing_address_country']['value'];
	
	$shipping_address_street=$valuelist['name_value_list']['shipping_address_street']['value'];
	$shipping_address_city=$valuelist['name_value_list']['shipping_address_city']['value'];
	$shipping_address_state=$valuelist['name_value_list']['shipping_address_state']['value'];
	$shipping_address_postalcode=$valuelist['name_value_list']['shipping_address_postalcode']['value'];
	$shipping_address_country=$valuelist['name_value_list']['shipping_address_country']['value'];
	
	$total_amt=$valuelist['name_value_list']['total_amt']['value'];
	$total_amt_usdollar=$valuelist['name_value_list']['total_amt_usdollar']['value'];
	$subtotal_amount=$valuelist['name_value_list']['subtotal_amount']['value'];
	$subtotal_amount_usdollar=$valuelist['name_value_list']['subtotal_amount_usdollar']['value'];
	
	$discount_amount=$valuelist['name_value_list']['discount_amount']['value'];
	$discount_amount_usdollar=$valuelist['name_value_list']['discount_amount_usdollar']['value'];
	$tax_amount=$valuelist['name_value_list']['tax_amount']['value'];
	$tax_amount_usdollar=$valuelist['name_value_list']['tax_amount_usdollar']['value'];
	
	$shipping_amount=$valuelist['name_value_list']['shipping_amount']['value'];
	$shipping_amount_usdollar=$valuelist['name_value_list']['shipping_amount_usdollar']['value'];
	$shipping_tax=$valuelist['name_value_list']['shipping_tax']['value'];
	$shipping_tax_amt=$valuelist['name_value_list']['shipping_tax_amt']['value'];
	$shipping_tax_amt_usdollar=$valuelist['name_value_list']['shipping_tax_amt_usdollar']['value'];
	
	$total_amount=$valuelist['name_value_list']['total_amount']['value'];
	$total_amount_usdollar=$valuelist['name_value_list']['total_amount_usdollar']['value'];
	$quote_number=$valuelist['name_value_list']['quote_number']['value'];
	$invoice_date=$valuelist['name_value_list']['invoice_date']['value'];
	$status=$valuelist['name_value_list']['status']['value'];
	$billing_contact_id=$valuelist['name_value_list']['billing_contact_id']['value'] ;
	
	$subtotal_tax_amount=$valuelist['subtotal_tax_amount'];
	$subtotal_tax_amount_usdollar=$valuelist['subtotal_tax_amount_usdollar'];
	
	
	
	
	$get_module_fields_parameters = array(
			 //session id
			 'session' => $sessId,
			 'module_name' => 'AOS_Products_Quotes',
			 'query'=>"aos_products_quotes.parent_id ='$id'",
			 'select_fields'=>array()
	 );
			
			$getproducts = restRequest("get_entry_list", $get_module_fields_parameters);
			$i=0;
			foreach($getproducts['entry_list'] as $productvalue)
			{
				//print_r($productvalue);
				//die();
				$lineitemid=	$productvalue['id'];
				$productname=	$productvalue['name_value_list']['name']['value'];
				$productpartnumber=	$productvalue['name_value_list']['part_number']['value'];
				$product_qty=	$productvalue['name_value_list']['product_qty']['value'];
				$product_cost_price=	$productvalue['name_value_list']['product_cost_price']['value'];
				$product_list_price=	$productvalue['name_value_list']['product_list_price']['value'];
				$product_discount=	$productvalue['name_value_list']['product_discount']['value'];
				$product_discount_amount=	$productvalue['name_value_list']['product_discount_amount']['value'];
				$product_unit_price=	$productvalue['name_value_list']['product_unit_price']['value'];
				$vat_amt=	$productvalue['name_value_list']['vat_amt']['value'];
				$vat=	$productvalue['name_value_list']['vat']['value'];
				$product_total_price=	$productvalue['name_value_list']['product_total_price']['value'];
				 $product_id=	$productvalue['name_value_list']['product_id']['value'];
				
				
				$select="select * from product where suitpid='$product_id'";
				$query=mysqli_query($conn,$select);
				while($row=mysqli_fetch_array($query))
				{
					 $row['accountpid'];
					 echo $product_list_price;
					echo "<br>";
					 echo $product_qty;
					echo "<br>";
					
					 echo $product_discount_amount;
					echo "<br>";
					
					$getdatalistpr=getsingleproduct($accesstoken,$row['accountpid']);
					 $codeset=	$getdatalistpr['data']['code'];
					echo "<br>";
					echo "<br>";
					
					$parameterquote['outgoingInvoiceLines'][$i][productCode]=$codeset;
					$parameterquote['outgoingInvoiceLines'][$i][quantity]=$product_qty;
					$parameterquote['outgoingInvoiceLines'][$i][netAmount]=(float)($product_list_price*$product_qty)+($product_discount_amount*$product_qty);
					$parameterquote['outgoingInvoiceLines'][$i][description]=$productname;
				
					$parameterquote['outgoingInvoiceLines'][$i][discountPercent]=(float)($product_discount/100);
				
					$parameterquote['outgoingInvoiceLines'][$i][totalAmount]=(float)($product_list_price*$product_qty);
					$parameterquote['outgoingInvoiceLines'][$i][unitPrice]=(float)($product_list_price);
					$parameterquote['outgoingInvoiceLines'][$i][vatRate]=(float)($vat/100);
					//$parameterquote['outgoingInvoiceLines'][$i][unitOfMeasure]="EA";
					//$parameterquote['outgoingInvoiceLines'][$i][unitOfMeasureCode]=5;
				  // $parameterquote['outgoingInvoiceLines'][$i][salesAccount]=3000;
					//$parameterquote['outgoingInvoiceLines'][$i][vatExemptSalesAccount]=3100;
					//$parameterquote['outgoingInvoiceLines'][$i][vatCode]=3;
						$i++;
					
				}
				
				
		
				
				
			}
			
			
			 $select="select * from contact where suitcontactid='$billing_contact_id'";
				$querycontact=mysqli_query($conn,$select);
				while($rowcontact=mysqli_fetch_array($querycontact))
				{
					 $softwarecontactid=	$rowcontact['accountid'];
					$getcustomerdetails=singlecontactlist($accesstoken,$softwarecontactid);
					$customercode=$getcustomerdetails['data']['code'];
					$invoiceEmailAddress=$getcustomerdetails['data']['invoiceEmailAddress'];
					$contactPersonId=$getcustomerdetails['data']['contactPersonId'];
					$addressid=$getcustomerdetails['data']['mailAddress']['id'];
					
					
				}
			
			
			//$parameterquote['quoteAcceptanceStatus']=0;
			$parameterquote['invoiceDeliveryType']=1;
			$parameterquote['orderDate']=$date_entered;
			$parameterquote['customerEmail']=$invoiceEmailAddress;
			$parameterquote['totalAmount']=(float)$total_amount;
			$parameterquote['netAmount']=(float)$subtotal_amount;
			$parameterquote['status']=0;
			$parameterquote['customerCode']=$customercode;
			$parameterquote['deliveryAddressId']=$customercode;
			
		//	print_r($parameterquote);
			
			
			global $apiurl;
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiurl."OutgoingInvoice",
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
		
		$softwareid=$quoteresponse['data']['id'];
		
			 $dateget=date("Y-m-d h:i:s");
  echo $insert="insert into invoice set suitinvoiceid='$id',softwareinvoiceid='$softwareid',updatetime='$dateget'";
    $query=mysqli_query($conn,$insert);
	
//die();
}


?>