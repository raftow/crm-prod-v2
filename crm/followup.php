<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/crm_start.php");
$objme = AfwSession::getUserConnected();
$customerMe = AfwSession::getCustomerConnected();
if($objme)
{
        
        // اذا عند احدى هذه الصلاحيات يدخل كموظف 
        // التحقيق والرد على طلبات العملاء 
        // الإشراف على تشغيل نظام خدمة العملاء
        // إدخال الطلبات الالكترونية التي تصل عبر الهاتف

        $objme_has_crm_employee_role = 
        (($objme->hasRole("crm", CrmObject::$AROLE_OF_INVESTIGATOR)) or 
         ($objme->hasRole("crm", CrmObject::$AROLE_OF_REQUEST_ENTER)) or 
         ($objme->hasRole("crm", CrmObject::$AROLE_OF_SUPERVISOR))
        
        );


        if($objme->isSuperAdmin())
        {
                $Main_Page = "stats.php";
                $MODULE = $My_Module = "crm";
                $customerMe = null;
        
                require("$file_dir_name/../lib/afw/afw_main_page.php"); AfwMainPage::echoMainPage($MODULE, $Main_Page, $file_dir_name);
        }
        elseif($objme_has_crm_employee_role)
        {
                $Main_Page = "ongoingbox.php";
                $MODULE = $My_Module = "crm";
                $customerMe = null;
        
                AfwMainPage::echoMainPage($MODULE, $Main_Page, $file_dir_name);
        }
        
        
        /*
        $force_allow_access_to_customers = true; 
        $Direct_Page = "main_menu.php";
        
        include("$file_dir_name/../lib/afw/afw_direct_page.php");*/
}

if($customerMe)  // يدخل كعميل
{
        $controllerName = "Crm";
        $methodName = "stats";

        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/../crm/i.php");
}

if((!$objme) and (!$customerMe)) 
{
        include("$file_dir_name/../crm/login.php");
}



?>