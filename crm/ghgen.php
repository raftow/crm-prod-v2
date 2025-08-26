<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/crm_start.php");

if(AfwSession::userIsConnected())
{
        $Direct_Page = "ghgen_work.php";
        
        include("$file_dir_name/../lib/afw/afw_direct_page.php");
}
else echo "please connect first";