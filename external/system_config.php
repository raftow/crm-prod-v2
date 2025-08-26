
<?php
$system_config_arr = [ 
    'db_prefix' => 'c0',
    'theme' => 'modern',
    'employee_email_domain' => "@tvtc.gov.sa",
    'trainee_email_starts_with' => "",
    'trainee_email_domain' => "@tvtc.edu.gov.sa",
    'main_company_domain' => "tvtc.gov.sa",
    'main_company' => "tvtc",
    'amd_options' => [
            'tu_college' => 'one',
    ],
    'site_administrator' => 'Rafik BOUBAKER',
    'site_administrator_extension' => '0000',
    'site_administrator_email' => 'rboubaker@tvtc.gov.sa',
    
    
    
    'limesurveyhost' => "10.104.25.13",
    'limesurveyuser' => "filler",
    'limesurveypassword' => 'rafikP@$$2016',
    'limesurveydatabase' => "survey",
    'limesurvey_url' => 'http://survey.tvtc.gov.sa/surv/i.php',
    'limesurvey_sid' => 174363,

    'main_company_domain' => "tvtc.gov.sa",
    'lime_survey_domain' => "survey.tvtc.gov.sa",

    'host' => "10.108.54.41",
    'user' => "crm2",
    'password' => 'P@$$2022CRM',    


    'MODE_MEMORY_OPTIMIZE' => false,
    'MODE_DEVELOPMENT' => false,
    
    'required_modules' => ['workflow', 'crm', 'bau', 'pag'],
    // to generate log for developers in footer 
    'super-dev' => false,
    // below advanced-back-trace should be false to avoid low performance for developers (because it genere too much html)
    'advanced-back-trace' => false,
    
    //'main_module' => "award",
    //'main_module_home_page' => "../award/home.php?r=home2",
    //'main_module_banner' => "../award/pic/banner-top-2022.png",

    'main_module' => "crm",
    'main_domain_id' => 13, //  crm
    'main_module_home_page' => "../crm/index.php",
    'main_module_banner' => "../crm/pic/banner-top-2022.png",
    'customer_module_banner' => "../crm/pic/banner-to-customer.png",
    
    'request_form_warning_complement' => 'ومن ذلك اسم الوحدة التدريبية والرقم الأكاديمي اذا كنت متدربا',
    /* 'otp-show-in-page' => true, */    

    /* 'simulate_sms_to_mobile' => "0598988330",*/

    
    'copyright_infos' => false,
    'system-date-format' => 'greg',
    'crm_site_url' => 'https://crm.tvtc.gov.sa',
    'crm_rt_list' => [/*1,*/ 2,3,12,13],
    'support_mobile_number' => "0598988330",
    
    'check_employee_from_external_system' => true,

    'login_page_options' => [
        'register_as' => 'user',  
        'password_reminder' => false,
    ],
    
    'login_ums-header-template' => 'direct',
    'login_ums-menu-template' => 'direct',
    'login_ums-footer-template' => 'direct',

    // LDAP
    'ldap' => [
        'ldap_use' => true,
        'ldap_server' => "ldaps://TVTC-WSH-DC2.gnet.edu.sa",
        'ldaprdn_prefix' => "GNET\\",
        'ldap_username_var' => "sAMAccountName",
        'ldap_base_dn' => "dc=GNET,dc=EDU,dc=SA",
        'ldap_sort_filter' => "sn",
        
        // LDAP SEARCH
        //LDAP Bind paramters, need to be a normal AD User account.
        'ldap_search_use' => true,
        'ldap_search_server' => "ldaps://TVTC-WSH-DC2.gnet.edu.sa",

        //Your domains DN to query
        'ldap_search_base_dn' => 'DC=gnet,DC=edu,DC=sa',
        
        'ldap_search_username_var' => "sAMAccountName",
        'ldap_search_base_dn' => "dc=GNET,dc=EDU,dc=SA",
        'ldap_search_sort_filter' => "sn",
        
        'ldap_search_password' => 'Messaoud06155816it',
        'ldap_search_username' => 'CN=gitlabsvc,ou=Services Accounts,ou=Head Quarter,dc=gnet,dc=edu,dc=sa',

        'ldap_email_domains' => ["tvtc.gov.sa"=>true],
        
    ],

    'internal_email_domains' => ["tvtc.gov.sa"=>true],

    // files upload
    
    'uploads_http_path' => "../ums/uploads",    
    'uploads_root_path' => "/uploads/pag/",
    'php_generation_folder' => "/var/tmp/gen/php",

    'framework_id' => 2,

    'global_need_utf8' => false,

    'parent_project_path' => "/var/www/html/v3.1",
    'dir_sep' => "/",
    
    // CRM - Limesurvey
    // 'crm_survey_method' => "LS-JSON-RCP", // LimeSurvey (JSON)JavaScript Object Notation-(RPC)Remote Procedure Call, ex : LimeSurvey RemoteControl 2 see : https://www.limesurvey.org/manual/RemoteControl_2_API
    // 'rpcuser' => 'admin',
    // 'rpcuser-password' => 'Admin_1446',
    // 'rpcuser-url' => 'http://survey.tvtc.gov.sa/limesurvey/index.php/admin/remotecontrol',
    
    'crm_survey_method' => "EXTERNAL-API",
    'limesurvey_url' => 'https://survey.tvtc.gov.sa/surv/index.php',
    'limesurvey_api_external' => 'https://survey.tvtc.gov.sa/api-external/',
];
date_default_timezone_set ("Asia/Riyadh");