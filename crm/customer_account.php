<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/crm_start.php");

$customerMe = AfwSession::getCustomerConnected();

if($customerMe) 
{
        $controllerName = "Customer";
        $methodName = "account";

        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/../crm/i.php");
}
else
{
        include("$file_dir_name/../crm/customer_login.php");
}