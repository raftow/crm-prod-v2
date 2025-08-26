<?php
$config_arr = array(
        'application_id' => 1283,

        'application_code' => 'msg',

        // roClassName => Booking,

        'x_module_means_company'=>false,


        'application_name' => ['ar' => 'ادارة أعمال القبول', 'en' => 'Admissions management',],
                                  
        'no_menu_for_login' => true,

        'enable_language_switch' => false,

        'student_title' => "المتقدم",

        /*
        'cust_type_list' => array(1 => "فرد من المجتمع",
                                  5 => "متعاون من خارج المؤسسة",
                                  3 => "متدرب", ),*/


        //  classes params
        /*TravelTemplate_showId =>true, */
        
        'default_controller_name' => "content",                                  

        

        'notify_customer' => array("new_request" => array("sms"=>true, "email" => false, "web" => false, "whatsup" => false),
        
                                ),

        'notify_manager' => array("new_request" => array("sms"=>true, "email" => false, "web" => true, "whatsup" => false),
        
                        ),

        'notify_employee' => array("new_request" => array("sms"=>true, "email" => false, "web" => true, "whatsup" => false),
        
                ),


        'general_company_id' => 1,

        'tasksClassName' => "Request",

        'consider_user_as_customer' =>true,

        'default_customer_type' =>2,

        'HEADER_LOGO_HEIGHT' => 66,

        'DISABLE_PROJECT_ITEMS_MENU' => true,

        'register_file' => "customer_register",

        
        // smtp email config can be found in external folder
        
        // APPLICATION SETTINGS
        'MODE_DEVELOPMENT' => true,

        // SIS settings
        'default_course_mfk' => ',1,',

        'date_system' => 'GREG',

        );

//$sql_capture_and_backtrace = "or (session_date =";
