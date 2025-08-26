<?php
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

require_once("$file_dir_name/../lib/afw/afw_autoloader.php");
AfwSession::startSession();
include("$file_dir_name/../crm/home.php");