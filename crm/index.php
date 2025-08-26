<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/crm_start.php");
$objme = AfwSession::getUserConnected();
$customerMe = AfwSession::getCustomerConnected();
if($objme)
{
        
        // اذا عند احدى هذه الصلاحيات يدخل كموظف 
        // التحقيق والرد على طلبات العملاء 
        // مشرف تنسيق
        // إدخال الطلبات الالكترونية التي تصل عبر الهاتف

        $objme_has_crm_employee_role = 
        (($objme->hasRole("crm", CrmObject::$AROLE_OF_INVESTIGATOR)) or 
         ($objme->hasRole("crm", CrmObject::$AROLE_OF_REQUEST_ENTER)) or 
         ($objme->hasRole("crm", CrmObject::$AROLE_OF_SUPERVISOR))
        
        );


        if($objme->isSuperAdmin() or $objme->hasRole("crm", CrmObject::$AROLE_OF_GENERAL_SUPERVISOR))
        {
                $Main_Page = "monitoring.php";
                $MODULE = $My_Module = "crm";
                $options = [];
                $options["dashboard-stats"] = true;
                $options["chart-js"] = true;
                AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name, $options);
        }
        elseif($objme_has_crm_employee_role)
        {
                $file_dir_name = dirname(__FILE__);
                $Main_Page = "workbox.php";
                $MODULE = $My_Module = "crm";
                AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name);
        }
        else
        {
                die($objme->getVal("firstname")." : ".$objme->tm("Your are registered now, you can contact your administrator to give you privileges")."<br>". $objme->tm("You need also approval from your direct manager for this")." <br> user name : [".$objme->getVal("username")."]");
        }
        
        
        /*
        $force_allow_access_to_customers = true; 
        $Direct_Page = "main_menu.php";
        
        include("$file_dir_name/../lib/afw/afw_direct_page.php");*/
}
elseif($customerMe)  // يدخل كعميل
{
        $controllerName = "Crm";
        $methodName = "myrequests";

        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/../crm/i.php");
}
else
{
        include("$file_dir_name/../crm/customer_login.php");
}
