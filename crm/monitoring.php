<?php

$file_dir_name = dirname(__FILE__);

require_once("$file_dir_name/../external/db.php");

$datatable_on=1;
$cl = "Request";
$currmod = "crm";
$currdb = $server_db_prefix."crm";
$limite = 0;
$genere_xls = 0;

$arr_sql_conds = array();
$arr_sql_conds[] = "me.active='Y'";
$objme = AfwSession::getUserConnected();
$myEmplId = $objme->getEmployeeId();

$crm_active_period = AfwSession::config("crm_active_period", 365);

$oldest_date = AfwDateHelper::shiftGregDate("", -$crm_active_period);
$newest_date = AfwDateHelper::shiftGregDate("", -2);

$supList = CrmEmployee::getSupervisorList(CrmOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID);

// genere too much queries, to be seen
// Request::assignSupervisorForNonAssigned(false,true);
$no_need_assign_statuses = Request::$REQUEST_STATUSES_NO_NEED_ASSIGN;
$where_old_still_not_assigned="active='Y' and status_id not in ($no_need_assign_statuses) and (orgunit_id=0 or employee_id=0) and created_at between '$oldest_date' and '$newest_date'";

$stats_arr = Request::aggreg($function="count(*)", 
                $where = $where_old_still_not_assigned, 
                $group_by = "supervisor_id",
                $throw_error=true, 
                $throw_analysis_crash=true);

if(!$lang) $lang = AfwSession::getSessionVar("current_lang");
if(!$lang) $lang = "ar";

$statsMatrix = array();
foreach($supList as $supItem)                
{
        $supObj = $supItem["obj"];
        $sup_employee_id = $supObj->getVal("employee_id");
        if($stats_arr[$sup_employee_id]>0)
        {
            $statsMatrix[$sup_employee_id] = array('name'=>$supObj->getDisplay($lang), 'missed'=>$stats_arr[$sup_employee_id]);
        }        
}
                          
$employee_title = $objme->getDisplay($lang);

$reqList = Request::loadRecords($where_old_still_not_assigned, $limit="5", $order_by="id asc");

$header_trad = array("missed"=>"عدد الطلبات", "name" => 'الادارة - المشرف');

$wb_prefix = AfwLanguageHelper::tt("مرحبا بالمشرف العام لمتابعة عمل مكتب العلاقات مع العملاء");

$out_scr .= "<div class='crm-title hzm-info'>$wb_prefix $employee_title</div>";

$out_scr .= Page::showPage("crm", "main-page", $lang);

$out_scr .= "<div id='page-content-wrapper' class='qsearch_page'><div class='row row-filter-request'>";

// customer number increasing (cni)
if(true)
{
    $out_scr .= "<div class='qfilter col-sm-10 col-md-10 pb10'><h1>احصائيات نمو عدد العملاء الخمس سنوات الأخيرة</h1></div>";
    $out_scr .= "<canvas id=\"cni\" style=\"width:100%;max-width:900px;margin:auto\"></canvas>";
    $out_scr .= AfwChartHelper::oniChartScript("CrmCustomer", "cni", "line", -60, 0, 1, 'm', 'month', 'never');
}

if(true)
{
    $out_scr .= "<div class='qfilter col-sm-10 col-md-10 pb10'><h1>احصائيات نمو عدد الطلبات الخمس سنوات الأخيرة</h1></div>";
    $out_scr .= "<canvas id=\"rni\" style=\"width:100%;max-width:900px;margin:auto\"></canvas>";
    $out_scr .= AfwChartHelper::oniChartScript("Request", "rni", "line", -60, 0, 1, 'm', 'month', 'never', ['min'=>50, 'max'=>150], 'request_date', 'hijri');
}

if(count($statsMatrix)>0)
{
    $out_scr .= "<div class='qfilter col-sm-10 col-md-10 pb10'><h1>احصائيات الطلبات المتأخر اسنادها</h1></div>";
    // $out_scr .= "<br>\n statsMatrix = \n<br><pre style='direction:ltr;text-align: left;'>".var_export($statsMatrix,true)."</pre>";
    // $out_scr .= "<br>\n stats_arr = \n<br><pre style='direction:ltr;text-align: left;'>".var_export($stats_arr,true)."</pre>";
    // $out_scr .= "<br>\stats_arr = \n<br>".var_export($stats_arr,true);
    $out_scr .= AfwHtmlHelper::tableToHtml($statsMatrix, $header_trad);    
}

if(count($reqList)>0)
{
    $out_scr .= "<div class='qfilter col-sm-10 col-md-10 pb10'><h1>أمثلة لطلبات تأخر اسنادها جدا</h1></div>";
    $header_trad = AfwUmsPagHelper::getRetrieveHeader(new Request());
    list($data,$isAvail) = AfwLoadHelper::getRetrieveDataFromObjectList($reqList,$header_trad, $lang, $newline="\n<br>");
    $out_scr .= AfwHtmlHelper::tableToHtml($data, $header_trad);
    $out_scr .= "</div>";
}


$out_scr .= "<div class='qfilter col-sm-10 col-md-10 pb10'>
   <a href='main.php?Main_Page=fm.php&a=1073&r=317' class='btn btn-primary'>التقارير الأخرى</a>
   <a href='main.php?Main_Page=workbox.php&r=323' class='btn btn-secondary'>صندوق الوارد</a>
   </div>";

$out_scr .= "</div>";

?>