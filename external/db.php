<?php
$file_dir_name = dirname(__FILE__);

set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

include_once("$file_dir_name/../external/db_config.php") ;
$cache_management = true;
         
if(!isset($arr_AroleByCode)) $arr_AroleByCode = array();         
if(!isset($_sql_analysis)) $_sql_analysis = array();
//if(!isset($_cache_analysis)) $_SERVER["cache_analysis"] = array();
if(!isset($_page_cache_objects)) $_page_cache_objects = array();
if(!isset($_lmany_analysis)) $_lmany_analysis = array();
if(!isset($get_stats_analysis)) $get_stats_analysis = array();


// if query is called more than $_sql_analysis_seuil_calls times it craches to make analysis of reason
$_sql_analysis_seuil_calls = 700;
$_sql_analysis_total_seuil_calls = 5000;
$loadMany_max = 1000;
// change below the $errors_check_count_max var by adding 1 or removing 1 to see where it crashes in infinite loop (attribute error check)
$errors_check_count_max = 1201;
$errors_check_count = 0;
if(!$cacheSys) $cacheSys = AfwCacheSystem::getSingleton();
