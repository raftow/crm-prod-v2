<?php

$file_dir_name = dirname(__FILE__);

require_once("$file_dir_name/../external/db.php");
require_once("$file_dir_name/../lib/afw/afw_displayer_factory.php");

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

if(CrmEmployee::isAdmin($myEmplId)) 
{
        $arr_sql_conds[] = "(me.supervisor_id='$myEmplId' or me.supervisor_id=0 or me.supervisor_id is null)";
        $arr_sql_conds[] = "((me.status_id not in (1, 3, 301, 5, 6, 7, 8, 9)) and (me.status_id not in (2, 4) or me.employee_id not in (0,$myEmplId)))"; 
        
        $employee_title = AfwLanguageHelper::tt('مشرف خدمة العملاء :')." ".$objme->getDisplay($lang);
}
else
{
        $arr_sql_conds[] = "me.employee_id='$myEmplId'";
        $arr_sql_conds[] = "me.status_id not in (1, 2, 201, 4, 5, 6, 7, 8, 9) "; // 4 = ongoing // طلب مرسل  للتحقيق SENT = 2; 
        $orgunit_name = CrmEmployee::orgOfEmployee($myEmplId, false, false);
        $employee_title = "<b>".$objme->getShortDisplay($lang)."</b>";
        
        if($orgunit_name) $employee_title .= " " . $orgunit_name;
        //else $employee_title .= " xx";
}


$my_class = new $cl();
$result_page_title = "صندوق الصادر لـ " . $employee_title;
$tit_qedit_ppp_fixm = "عرض التذكرة";
$actions_tpl_arr = array();

$actions_tpl_arr["view"] = true;
                          
if($datatable_on) {
	include "$file_dir_name/../lib/afw/modes/afw_handle_default_search.php";
        $collapse_in = "";
}
else $collapse_in = "in";

if($datatable_on) 
{
	if($data_count>0) $out_scr .= $search_result_html; // die("search_result_html=".$search_result_html); // 
        else $out_scr .= "<div class='crm-information hzm-info'>
        <i class=\"hzm-container-center hzm-vertical-align-middle hzm-icon-fm hzm-icon-inbox\"></i>
        لا يوجد طلبات في صندوق الصادر
        </div>";
}        

                             
?>