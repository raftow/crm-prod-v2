<?php

$file_dir_name = dirname(__FILE__);
if($objme and $objme->isCustomer())
{
        include("$file_dir_name/../crm/crm_customer.php");
        $customerObj = CrmCustomer::loadById($objme->getCustomerId());
        $customerObjId = $customerObj->getId();
        
}
$token_arr = array();

if($customerObj)
{
    $token_arr["[customer_type]"] = $customerObj->showAttribute("customer_type_id");
    $token_arr["[my_idn_type_id]"] = $customerObj->showAttribute("idn_type_id");
    $token_arr["[my_idn]"] = $customerObj->showAttribute("idn");
    $token_arr["[my_email]"] = $customerObj->showAttribute("email");
    $token_arr["[my_mobile]"] = $customerObj->showAttribute("mobile");
    $token_arr["[my_username]"] = $customerObj->showAttribute("mobile");
    $token_arr["[my_genre]"] = $customerObj->showAttribute("gender_id");
    $token_arr["[my_nomcomplet]"] = $customerObj->showAttribute("full_name");
    $token_arr["[edit_link]"] = "main.php?Main_Page=afw_mode_display.php&cl=CrmCustomer&currmod=crm&id=$customerObjId&popup=";
    
}
else
{
    $token_arr["[customer_type]"] = ""; 
}


 


include("$file_dir_name/../ums/my_account.php");
?>