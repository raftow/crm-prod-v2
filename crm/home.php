<?php
   $file_dir_name = dirname(__FILE__);
   include("$file_dir_name/crm_start.php");

   $customerMe = AfwSession::getCustomerConnected();
   $objme = AfwSession::getUserConnected();
   

   if($customerMe)
   {
      $controllerName = "Crm";
      $methodName = "myrequests";

      $file_dir_name = dirname(__FILE__);
      include("$file_dir_name/../crm/i.php");      
   }
   elseif($objme)
   {
      $customerMe = null;
      $file_dir_name = dirname(__FILE__);
      require("$file_dir_name/../lib/afw/afw_main_page.php"); 
      AfwMainPage::echoMainPage("crm","monitoring.php", $file_dir_name);
   }
   else
   {
      // $customer_id = AfwSession::getSessionVar("customer_id");
      // die("customer_id=$customer_id customerMe=$customerMe is con=".AfwSession::customerIsConnected());
      include("customer_login.php");
   }
    /*
  
  $file_dir_name = dirname(__FILE__);
  include("$file_dir_name/../aw ard/index.php");
   */
 
?>