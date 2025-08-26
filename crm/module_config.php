<?php
                
                $TECH_FIELDS = array();
                $MODULE = "crm";
		
                $THIS_MODULE_ID = 1073;
                $MODULE_FRAMEWORK[$THIS_MODULE_ID] = 1;

        	$TECH_FIELDS[$MODULE]["CREATION_USER_ID_FIELD"]  ="created_by";
        	$TECH_FIELDS[$MODULE]["CREATION_DATE_FIELD"]     ="created_at";
        	$TECH_FIELDS[$MODULE]["UPDATE_USER_ID_FIELD"]    ="updated_by";
        	$TECH_FIELDS[$MODULE]["UPDATE_DATE_FIELD"]       ="updated_at";
        	$TECH_FIELDS[$MODULE]["VALIDATION_USER_ID_FIELD"]="validated_by";
        	$TECH_FIELDS[$MODULE]["VALIDATION_DATE_FIELD"]   ="validated_at";
        	$TECH_FIELDS[$MODULE]["VERSION_FIELD"]           ="version";
        	$TECH_FIELDS[$MODULE]["ACTIVE_FIELD"]            ="active";
                
                $TECH_FIELDS_TYPE = array("created_by"=>"FK", 
                                          "created_at"=>"DATE", 
                                          "updated_by"=>"FK", 
                                          "updated_at"=>"DATE", 
                                          "validated_by"=>"FK", 
                                          "validated_at"=>"DATE", 
                                          "version"=>"INT");
                
                $LANGS_MODULE = array("ar"=>true,"fr"=>false,"en"=>false);
                
                
                $MENU_ICONS[1] = "cogs";
                $MENU_ICONS[9] = "sitemap";
                $MENU_ICONS[3] = "building";
                $MENU_ICONS[5] = "pie-chart";
                $MENU_ICONS["BF-104366"] = "inbox";
                $MENU_ICONS["BF-104502"] = "outbox";
                
                $custom_header = false;
                /*
                $check_depending_user_type = "check_sempl";
                $my_account_page = "main.php?Main_Page=afw_mode_display.php&cl=Sempl&id=[SEMPL]&currmod=sdd&no_my_account_page_in_mod=[MODULE]";
                */
                $login_page_options = array();
                $login_page_options["customer_authorized"] = true;
                
                set_time_limit(8400);
                ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
                
                // $file_dir_name = dirname(__FILE__); 
                // 
                // $customer _default_mau[$THIS_MODULE_ID] = ModuleAuser::virtualModuleAuser($THIS_MODULE_ID, 0, ",327,");
                
                $front_header = true;
                $front_application = true;
                $config["img-path"] = "../external/pic/";
                $config["img-company-path"] = "../external/pic/";
                $config["sms-crm"] = true;
                $config["sms-captcha"] = true;
                // $config["default-logged-out-page"] = "customer_login.php";
                $pages_arr["login"][$MODULE] = $config["default-logged-out-page"] = "../crm/customer_login.php";
                
                $module_config_token["file_types"] = "1,2,3,4,5,6,14";
                
                
                $header_style = "header_thin";
                $my_theme = "simple";
                //$my_font = "kufi";
                $banner = false;
                $bg_height = 300;
                $MODE_DEVELOPMENT = true;                 
                $SMS_PROCESS_ID = 2;
                
                $display_in_edit_mode["*"] = true;

                // $front_header_page = "crm/front_header.php";
                

                $sql_capture_and_backtrace = "sql to check here"; // "WHERE 1 and me.arole_id = '324' and (me.menu='Y' and me.avail='Y') and me.avail = 'Y'"; // 
                
                
?>