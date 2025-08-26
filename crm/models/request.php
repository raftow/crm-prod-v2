<?php
// ALTER TABLE c0crm.request add status_action_enum smallint DEFAULT NULL AFTER status_id
// use PhpOffice\PhpSpreadsheet\Reader\Xls\ErrorCode;

class Request extends CrmObject
{
    public $itemsMethodExec = [];

    public function __construct(){
		parent::__construct("request","id","crm");
            CrmRequestAfwStructure::initInstance($this);    
	}
    

    public static $REQUEST_CODE_LENGTH = 7;

    public static $MY_ATABLE_ID = 3569;
    // إجراء إحصائيات حول الطلبات الالكترونية 
    public static $BF_STATS_REQUEST = 103685;
    // إدارة الطلبات الالكترونية 
    public static $BF_QEDIT_REQUEST = 103680;
    // إنشاء طلب الكتروني 
    public static $BF_EDIT_REQUEST = 103679;
    // الاستعلام عن طلب الكتروني 
    public static $BF_QSEARCH_REQUEST = 103684;
    // البحث في الطلبات الالكترونية 
    public static $BF_SEARCH_REQUEST = 103683;
    // عرض تفاصيل طلب الكتروني 
    public static $BF_DISPLAY_REQUEST = 103682;
    // مسح طلب الكتروني 
    public static $BF_DELETE_REQUEST = 103681;


    public static $JOB_ROLE_CRM_SUPERVISOR = 107;
    public static $JOB_ROLE_CRM_INVESTIGATOR = 117;

    public static $CRM_CENTER_ID = 70;


    // COMPLAINT - شكوى  
    public static $REQUEST_TYPE_COMPLAINT = 3;

    // ENQUIRY - استفسار  
    public static $REQUEST_TYPE_ENQUIRY = 2;

    // GRIEVANCE - تظلم  
    public static $REQUEST_TYPE_GRIEVANCE = 4;

    // HI - تصعيد  
    public static $REQUEST_TYPE_HI = 5;


    // SUGGESTION - اقتراح  
    public static $REQUEST_TYPE_SUGGESTION = 13;

    // SUPPORT - طلب دعم فني  
    public static $REQUEST_TYPE_SUPPORT = 12;

    // REQUEST - طلب  
    public static $REQUEST_TYPE_REQUEST = 1;


    // NEW -  مسودة طلب جديد  
    public static $REQUEST_STATUS_DRAFT = 1;

    // MISSED_INFO -  عودة للعميل لاستكمال البيانات
    public static $REQUEST_STATUS_MISSED_INFO = 101;

    // MISSED_FILES -  عودة للعميل لاستكمال المرفقات
    public static $REQUEST_STATUS_MISSED_FILES = 102;

    // SENT - طلب مرسل  للتحقيق
    public static $REQUEST_STATUS_SENT = 2;


    // ASSIGNED - تم اسناده للموظف المختص
    public static $REQUEST_STATUS_ASSIGNED = 201;

    // REDIRECT - طلب إعادة التحويل  
    public static $REQUEST_STATUS_REDIRECT = 3;

    // RESPONSE UNDER REVISION - تدقيق الاجابة
    public static $REQUEST_STATUS_RESPONSE_UNDER_REVISION = 301;

    // ONGOING - طلب تحت الإنجاز - جاري العمل
    public static $REQUEST_STATUS_ONGOING = 4;

    // DONE - تمت الإجابة  
    public static $REQUEST_STATUS_DONE = 5;

    // CANCELED - طلب ملغى  
    public static $REQUEST_STATUS_CANCELED = 6;

    // CLOSED - طلب مغلق  
    public static $REQUEST_STATUS_CLOSED = 7;

    // REJECTED - طلب مستبعد  
    public static $REQUEST_STATUS_REJECTED = 8;

    // IGNORED - طلب تم تجاهله  
    public static $REQUEST_STATUS_IGNORED = 9;

    public static $REQUEST_STATUSES_NO_NEED_ASSIGN = "1,5,6,7,8,9,101,102";

    public static $REQUEST_STATUSES_ONGOING_SUPERVISOR = "2,3,301";

    public static $REQUEST_STATUSES_ONGOING_INVESTIGATOR = "201,4";

    public static $REQUEST_STATUSES_WAITING_CUSTOMER = "101,102";

    public static $REQUEST_STATUSES_ONGOING_ALL = "101,102,2,201,3,301,4";

    public static $REQUEST_STATUSES_ASSIGNED_ONLY = "2,201";

    public static $REQUEST_STATUSES_FINISHED = "5,6,7,8,9";

    public static $REQUEST_STATUSES_DONE = "5,7";

    public static $REQUEST_STATUSES_INTERNAL = "3,301,9";

    public static $REQUEST_STATUSES_ABORTED = "6,8,9"; // canceled or rejected or ignored


    // APPROVE - رد معتمد  
    public static $RESPONSE_TYPE_APPROVE = 5;

    // COMMENT - تعليق  
    public static $RESPONSE_TYPE_COMMENT = 2;

    // DUPLICATED - إالغاء الطلب بسبب التكرار  
    public static $RESPONSE_TYPE_DUPLICATED = 6;

    // COMPLETE - استكمال البيانات
    public static $RESPONSE_TYPE_COMPLETE = 12;

    // EMPLOYEE_CHANGE - طلب تحويل إلى موظف آخر  
    public static $RESPONSE_TYPE_EMPLOYEE_CHANGE = 4;

    // RESPONSE - إجابة  
    public static $RESPONSE_TYPE_RESPONSE = 1;

    // STATUS_CHANGE - تغيير حالة التذكرة  
    public static $RESPONSE_TYPE_STATUS_CHANGE = 3;


    public static $MAX_DELAY_BEFORE_CONSIDER_LATE = 7;
    public static $STATS_PERF_PERIOD = 180;


    public static $PUB_METHODS = array(
        "resetRequestNew" => array(
            'title' => "إرجاع إلى حالة مسودة",
            'confirmation_needed' => true,
            'confirmation_warning' => "هذا الإجراء غير قابل للرجوع إلى الخلف",
            'confirmation_question' => "هل أنت متأكد أنك تريد إرجاع الطلب إلى حالة مسودة ؟",
            'color' => "yellow"
        ),


        "approveResponse" => array(
            'title' => "اعتماد الاجابة الأخيرة",
            'confirmation_needed' => true,
            'confirmation_warning' => "هذا الإجراء غير قابل للرجوع إلى الخلف",
            'confirmation_question' => "هل أنت متأكد أنك تريد اعتماد الاجابة الأخيرة للمنسق ؟",
            'color' => "green"
        ),

        "unCloseRequest" => array(
            'title' => "الغاء اغلاق الطلب",
            'confirmation_needed' => true,
            'confirmation_warning' => "---------------------",
            'confirmation_question' => "هل أنت متأكد أنك تريد إرجاع الطلب إلى حالة جاري العمل ؟",
            'color' => "red"
        ),

        "sendRequest" => array(
            'title' => "إرسال/إرجاع الطلب إلى خدمة العملاء",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'color' => "blue"
        ),

        "startRequest" => array(
            'title' => "بدء العمل على الطلب",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => ""
        ),

        "refreshRequest" => array(
            'title' => "تحديث بيانات الطلب",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'color' => "blue"
        ),

        "assignRequest" => array(
            'items' => 'getInvestigators',
            'title' => "إسناد الطلب إلى [item]",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => ""
        ),

        "redirectRequest" => array(
            'title' => "طلب إعادة توجيه لعدم الإختصاص",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'color' => "yellow"
        ),

        "returnRequestToInvestigator" => array(
            'title' => "إعادة الطلب إلى المنسق",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'color' => "green"
        ),

        "doneRequest"   => array(
            'title' => "تحويل إلى طلب منجز",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => ""
        ),

        "cancelRequest" => array(
            'title' => "إلغاء الطلب بناء على رغبة العميل",
            'confirmation_needed' => true,
            'confirmation_warning' => "",
            'confirmation_question' => "سيتم إلغاء هذا الطلب : <br><span>[request_title]</span>.<br> هل أنت متأكد؟",
            'tooltip' => 'انتبه : يستخدم فقط بطلب من العميل ويخضع لعمليات تتبع الأثر',
            'color' => "red"
        ),

        "closeRequest"  => array(
            'title' => "غلق الطلب",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'tooltip' => 'يترتب على غلق الطلب منع العميل من مزيد التعليق أو الاستفسار حول هذا الطلب ويتحول مباشرة الى اجراءات الاستبيان عن رضا العميل',
            'color' => "yellow"
        ),

        "rejectRequest" => array(
            'title' => "رفض الطلب",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'color' => "orange"
        ),

        "ignoreRequest" => array(
            'title' => "إهمال الطلب",
            'confirmation_needed' => false,
            'confirmation_warning' => "",
            'confirmation_question' => "",
            'color' => "red"
        ),

        "removeLastResponse" =>  array(
            'title' => "حذف آخر ردودي",
            'confirmation_needed' => true,
            'confirmation_warning' => "",
            'confirmation_question' => "سيتم حذف آخر رد . هل أنت متأكد ؟",
            'tooltip' => 'انتبه : يستخدم فقط للضرورة ويخضع لعمليات تتبع الأثر',
            'color' => "red"
        ),


    );

    public static $STATUS_MAP = array(
        0 => array(
            "submitRequest" => "iamTheCustomer",
            "refreshRequest" => "goOn",
            "approveResponse" => array(false, "needResponseApproval", "iamTheSupervisor"),
            "removeLastResponse" => "goOn",
        ),

        // NEW -  مسودة طلب جديد  $REQUEST_STATUS_DRAFT = 1; 
        1 => array(
            "resetRequestNew" => "neverDoThisNow",
            "sendRequest" => array(true, "iamTheCustomer", "iamTheInvestigator", "iamTheSupervisor"),
            "assignRequest" => "iamTheSupervisor",
            "startRequest" => "neverDoThisNow",
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => "iResponded",
            "cancelRequest" => array(true, "iamTheCustomer", "iamTheApprovedInvestigator", "iamTheSupervisor"),
            "closeRequest"  => array(false, "isDone", "iamTheSupervisor"),
            "rejectRequest" => "iamTheSupervisor",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
        ),


        // SENT - طلب مرسل  للتحقيق $REQUEST_STATUS_SENT = 2; 
        2 => array(
            "resetRequestNew" => array(true, "iamTheCustomer", "iamTheSupervisor"),
            "assignRequest" => "iamTheSupervisor",
            "startRequest" => array(true, "iamTheInvestigator", "iamTheSupervisor"),
            "redirectRequest" => "iamTheInvestigator",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => array(false, "iResponded", "iamTheInvestigator"),
            "cancelRequest" => array(true, "iamTheCustomer", "iamTheApprovedInvestigator", "iamTheSupervisor"),
            "closeRequest" => array(false, "isDone", "iamTheSupervisor"),
            "rejectRequest" => "iamTheSupervisor",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
            "removeLastResponse" => "iamLastResponderOrSuperAdmin",
        ),

        // REDIRECT - طلب إعادة التحويل  $REQUEST_STATUS_REDIRECT = 3; 
        3 => array(
            "resetRequestNew" => "neverDoThisNow",
            "assignRequest" => "iamTheSupervisor",
            "approveResponse" => array(false, "needResponseApproval", "iamTheSupervisor"),
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => "iResponded",
            "cancelRequest" => array(true, "iamTheCustomer", "iamTheApprovedInvestigator", "iamTheSupervisor"),
            "closeRequest" => array(false, "isDone", "iamTheSupervisor"),
            "rejectRequest" => "iamTheSupervisor",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
            "removeLastResponse" => "iamLastResponderOrSuperAdmin",
        ),


        // ONGOING - طلب تحت الإنجاز - جاري العمل $REQUEST_STATUS_ONGOING = 4;
        4 => array(
            "resetRequestNew" => "neverDoThisNow",
            "assignRequest" => "iamTheSupervisor", // array(false, "iamTheSupervisor", "iamTheInvestigator"),
            "redirectRequest" => "iamTheInvestigator",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => array(false, "iResponded", "iamTheInvestigator"),
            "cancelRequest" => array(true, "iamTheApprovedInvestigator", "iamTheSupervisor"),
            "closeRequest" => "neverDoThisNow",
            "rejectRequest" => "iamTheSupervisor",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
            "removeLastResponse" => "iamLastResponderOrSuperAdmin",
        ),

        // DONE - تمت الإجابة   $REQUEST_STATUS_DONE = 5;              
        5 => array(
            "resetRequestNew" => "iamTheSuperAdmin",
            "assignRequest" => "neverDoThisNow",
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => array(false, "isAssigned", "iamTheSupervisor"),
            "doneRequest" => "neverDoThisNow",
            "cancelRequest" => array(true, "iamTheCustomer", "iamTheApprovedInvestigator", "iamTheSupervisor"),
            "closeRequest" => array(false, "isDone", "iamTheSupervisor"),
            "rejectRequest" => "iamTheSupervisor",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
            "removeLastResponse" => "iamLastResponderOrSuperAdmin",
        ),

        // CANCELED - طلب ملغى   $REQUEST_STATUS_CANCELED = 6;               
        6 => array(
            "resetRequestNew" => "canResetAsNew",
            "assignRequest" => "neverDoThisNow",
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => array(false, "isAssigned", "iamTheSupervisor"),
            "doneRequest" => array(false, "iResponded", "iamTheInvestigator"),
            "cancelRequest" => "neverDoThisNow",
            "closeRequest" => array(false, "isDone", "iamTheSupervisor"),
            "rejectRequest" => "iamTheSupervisor",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
            "removeLastResponse" => "iamLastResponderOrSuperAdmin",
        ),





        // CLOSED - طلب مغلق   $REQUEST_STATUS_CLOSED = 7; 
        7 => array(
            "resetRequestNew" => "iamTheSuperAdmin",
            "assignRequest" => "neverDoThisNow",
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => "neverDoThisNow",
            "cancelRequest" => "neverDoThisNow",
            "closeRequest" => "neverDoThisNow",
            "unCloseRequest" => "iamTheSupervisor",
            "rejectRequest" => "neverDoThisNow",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
        ),


        // REJECTED - طلب مستبعد  $REQUEST_STATUS_REJECTED = 8; 
        8 => array(
            "resetRequestNew" => "iamTheSupervisor",
            "assignRequest" => "neverDoThisNow",
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => "neverDoThisNow",
            "cancelRequest" => "neverDoThisNow",
            "closeRequest" => "neverDoThisNow",
            "rejectRequest" => "neverDoThisNow",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
        ),


        // IGNORED - طلب تم تجاهله  $REQUEST_STATUS_IGNORED = 9;                                             
        9 => array(
            "resetRequestNew" => "iamTheSupervisor",
            "assignRequest" => "neverDoThisNow",
            "redirectRequest" => "neverDoThisNow",
            "returnRequestToInvestigator" => "neverDoThisNow",
            "doneRequest" => "neverDoThisNow",
            "cancelRequest" => "neverDoThisNow",
            "closeRequest" => "neverDoThisNow",
            "rejectRequest" => "neverDoThisNow",
            "ignoreRequest" => "neverDoThisNow",
            "refreshRequest" => "goOn",
        ),
    );

    public function neverDoThisNow()
    {
        return false;
    }

    public function goOn()
    {
        return true;
    }

    public function always()
    {
        return true;
    }



    public static $DATABASE        = "";
    public static $MODULE            = "crm";
    public static $TABLE            = "";
    public static $DB_STRUCTURE = null;


    public static $STATS_CONFIG = array(
        "gs001" => array(
            "STATS_WHERE" => "active = 'Y' and request_date between [date_start_perf] and [date_end_perf]", // 
            "DISABLE-VH" => true,
            "FOOTER_TITLES" => true,
            "FOOTER_SUM" => true,
            "GROUP_SEP" => ".",
            "GROUP_COLS" => array(
                0 => array("COLUMN" => "orgunit_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
            ),
            "DISPLAY_COLS" => array(
                1 => array("COLUMN" => "is_request", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_request", "FOOTER_SUM" => true),
                2 => array("COLUMN" => "is_enquiry", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_enquiry", "FOOTER_SUM" => true),
                3 => array("COLUMN" => "is_complaint", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_complaint", "FOOTER_SUM" => true),
                4 => array("COLUMN" => "is_suggestion", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_suggestion", "FOOTER_SUM" => true),
                5 => array("COLUMN" => "is_support", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_support", "FOOTER_SUM" => true),
                6 => array("COLUMN" => "id", "GROUP-FUNCTION" => "count", "SHOW-NAME" => "count_request", "FOOTER_SUM" => true),
                7 => array("COLUMN" => "request_done", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "request_done", "FOOTER_SUM" => true),
                8 => array("COLUMN" => "request_late", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "request_late", "FOOTER_SUM" => true),
                9 => array("COLUMN" => "request_ongoing", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "request_ongoing", "FOOTER_SUM" => true),
            ),

            "FORMULA_COLS" => array(
                0 => array("SHOW-NAME" => "perf", "METHOD" => "getPerf"),
            ),

            "OPTIONS" => array(
                "perf" => array('count_request' => true, 'request_done' => true, 'request_late' => true, 'request_ongoing' => true, 'perf' => true),
                "MAX_MEMORY_BY_REQUEST" => 400000000,
                "MODE_BATCH_LOURD" => true,
            ),
            // "SUPER_HEADER"=>array(0=>array("colspan"=>3, "title"=>""), 1=>array("colspan"=>2, "title"=>"year_36"), 2=>array("colspan"=>2, "title"=>"year_37"),
            //                      3=>array("colspan"=>2, "title"=>"year_38"), 4=>array("colspan"=>2, "title"=>"year_39"), 5=>array("colspan"=>2, "title"=>"year_40"), ),

        ),

        "gs002" => array(
            "STATS_WHERE" => "active = 'Y' and status_id in (2,201,3,301,4)", // 
            "DISABLE-VH" => true,
            "FOOTER_TITLES" => true,
            "FOOTER_SUM" => true,
            "GROUP_SEP" => ".",
            "GROUP_COLS" => array(
                0 => array("COLUMN" => "orgunit_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
            ),
            "DISPLAY_COLS" => array(
                1 => array("COLUMN" => "is_request", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_request", "FOOTER_SUM" => true),
                2 => array("COLUMN" => "is_enquiry", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_enquiry", "FOOTER_SUM" => true),
                3 => array("COLUMN" => "is_complaint", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_complaint", "FOOTER_SUM" => true),
                4 => array("COLUMN" => "is_suggestion", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_suggestion", "FOOTER_SUM" => true),
                5 => array("COLUMN" => "is_support", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_support", "FOOTER_SUM" => true),
                6 => array("COLUMN" => "id", "GROUP-FUNCTION" => "count", "SHOW-NAME" => "count_request", "FOOTER_SUM" => true),
                7 => array("COLUMN" => "request_done", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "request_done", "FOOTER_SUM" => true),
                8 => array("COLUMN" => "request_late", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "request_late", "FOOTER_SUM" => true),
                9 => array("COLUMN" => "request_ongoing", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "request_ongoing", "FOOTER_SUM" => true),
            ),
            /*
                               "FORMULA_COLS"=>array(
                                               0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
                               ),                   
*/
            "OPTIONS" => array(
                "perf" => array('count_request' => true, 'request_done' => true, 'request_late' => true, 'request_ongoing' => true, 'perf' => true),
            ),
            // "SUPER_HEADER"=>array(0=>array("colspan"=>3, "title"=>""), 1=>array("colspan"=>2, "title"=>"year_36"), 2=>array("colspan"=>2, "title"=>"year_37"),
            //                      3=>array("colspan"=>2, "title"=>"year_38"), 4=>array("colspan"=>2, "title"=>"year_39"), 5=>array("colspan"=>2, "title"=>"year_40"), ),

        ),

        "gs003" => array(
            "STATS_WHERE" => "active = 'Y' and request_date between [date_start_stats] and [date_end_stats]", // 
            "DISABLE-VH" => true,
            "FOOTER_TITLES" => true,
            "FOOTER_SUM" => true,
            "GROUP_SEP" => ".",
            "GROUP_COLS" => array(
                0 => array("COLUMN" => "orgunit_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
            ),
            "DISPLAY_COLS" => array(
                1 => array("COLUMN" => "is_request", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_request", "FOOTER_SUM" => true),
                2 => array("COLUMN" => "is_enquiry", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_enquiry", "FOOTER_SUM" => true),
                3 => array("COLUMN" => "is_complaint", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_complaint", "FOOTER_SUM" => true),
                4 => array("COLUMN" => "is_suggestion", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_suggestion", "FOOTER_SUM" => true),
                5 => array("COLUMN" => "is_support", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_support", "FOOTER_SUM" => true),
                6 => array("COLUMN" => "id", "GROUP-FUNCTION" => "count", "SHOW-NAME" => "count_request", "FOOTER_SUM" => true),
            ),

            "FORMULA_COLS" => array(
                //0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
            ),

            /*"OPTIONS" => array(
                                "perf"=> array('count_request' => true, 'request_done' => true, 'request_late' => true, 'request_ongoing' => true, 'perf'=>true),
                                      ),*/
            // "SUPER_HEADER"=>array(0=>array("colspan"=>3, "title"=>""), 1=>array("colspan"=>2, "title"=>"year_36"), 2=>array("colspan"=>2, "title"=>"year_37"),
            //                      3=>array("colspan"=>2, "title"=>"year_38"), 4=>array("colspan"=>2, "title"=>"year_39"), 5=>array("colspan"=>2, "title"=>"year_40"), ),

        ),

        "gs004" => array(
            "STATS_WHERE" => "active = 'Y' and request_date between [date_start_stats] and [date_end_stats]", // 
            "DISABLE-VH" => true,
            "FOOTER_TITLES" => true,
            "FOOTER_SUM" => true,
            "GROUP_SEP" => ".",
            "GROUP_COLS" => array(
                0 => array("COLUMN" => "orgunit_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
            ),
            "DISPLAY_COLS" => array(
                1 => array("COLUMN" => "chez_supervisor", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_supervisor", "FOOTER_SUM" => true),
                2 => array("COLUMN" => "chez_investigator", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_investigator", "FOOTER_SUM" => true),
                3 => array("COLUMN" => "chez_customer", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_customer", "FOOTER_SUM" => true),
                4 => array("COLUMN" => "chez_archive", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_archive", "FOOTER_SUM" => true),
            ),

            "FORMULA_COLS" => array(
                //0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
            ),





            /*
                             "OPTIONS" => array(
                               "perf"=> array('count_request' => true, 'request_done' => true, 'request_late' => true, 'request_ongoing' => true, 'perf'=>true),
                                     ),*/
            // "SUPER_HEADER"=>array(0=>array("colspan"=>3, "title"=>""), 1=>array("colspan"=>2, "title"=>"year_36"), 2=>array("colspan"=>2, "title"=>"year_37"),
            //                      3=>array("colspan"=>2, "title"=>"year_38"), 4=>array("colspan"=>2, "title"=>"year_39"), 5=>array("colspan"=>2, "title"=>"year_40"), ),

        ),
        "gs005" => array(
            "STATS_WHERE" => "active = 'Y' and status_id = 7 and status_date between [date_start_perf] and [date_end_perf]", // 
            "DISABLE-VH" => true,
            "FOOTER_TITLES" => true,
            "FOOTER_SUM" => true,
            "SHOW_PIE" => "FOOTER",
            "GROUP_SEP" => ".",
            "SQL_GROUP_BY" => true,
            "GROUP_COLS" => array(
                0 => array("COLUMN" => "orgunit_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
            ),
            "DISPLAY_COLS" => array(
                1 => array("COLUMN" => "satisfied",   "SQL_FORMULA" => "sum(IF(service_satisfied='Y',1,0))", "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_satisfied", "FOOTER_SUM" => true),
                2 => array("COLUMN" => "unsatisfied", "SQL_FORMULA" => "sum(IF(service_satisfied='N',1,0))", "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_not_satisfied", "FOOTER_SUM" => true),
                3 => array("COLUMN" => "indifferent", "SQL_FORMULA" => "sum(IF(service_satisfied='W',1,0))", "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "is_indifferent", "FOOTER_SUM" => true),
            ),

            "FORMULA_COLS" => array(
                //0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
            ),


        ),
        
        "gs006" => array(
            "STATS_WHERE" => "active = 'Y' and status_id not in (5,6,7,8,9) and status_date between [date_start_perf] and [date_end_perf]", // 
            "DISABLE-VH" => true,
            "FOOTER_TITLES" => true,
            "FOOTER_SUM" => true,
            "SHOW_PIE" => "FOOTER",
            "GROUP_SEP" => ".",
            "GROUP_COLS" => array(
                0 => array("COLUMN" => "orgunit_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
                0 => array("COLUMN" => "status_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
            ),
            "DISPLAY_COLS" => array(
                1 => array("COLUMN" => "chez_supervisor", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_supervisor", "FOOTER_SUM" => true),
                2 => array("COLUMN" => "chez_investigator", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_investigator", "FOOTER_SUM" => true),
                3 => array("COLUMN" => "chez_customer", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_customer", "FOOTER_SUM" => true),
                4 => array("COLUMN" => "chez_archive", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "chez_archive", "FOOTER_SUM" => true),
            ),

            "FORMULA_COLS" => array(
                //0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
            ),


        ),




    );

    

    public static function loadById($id)
    {
        $obj = new Request();
        //$obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }


    public static function getRecentClosedTicketsWithSurveyNotReady($period=120, $nb_req_limit = 1000)
    {
        $date_start = AfwDateHelper::shiftGregDate("", -$period);
        $obj = new Request();
        $obj->select("status_id", self::$REQUEST_STATUS_CLOSED);
        $obj->where("(survey_sent is null or survey_sent != 'Y') and (status_date >= '$date_start')");

        return $obj->loadMany($nb_req_limit, "request_date desc");
    }

    public static function getMyCurrentRequests($customer_id, $nb_req_limit = 10)
    {
        $obj = new Request();
        if ((!$customer_id) or ($customer_id < 0)) throw new AfwRuntimeException("getMyCurrentRequests : customer_id [$customer_id] is mandatory field");
        $obj->select("customer_id", $customer_id);
        $old_status_date = AfwDateHelper::shiftHijriDate("", -20);
        $obj->where("status_id not in (".self::$REQUEST_STATUSES_FINISHED.") or status_date >= '$old_status_date'");

        return $obj->loadMany($nb_req_limit, "request_date desc");
    }

    public static function getMyFinishedRequests($customer_id, $nb_req_limit = 10)
    {
        $obj = new Request();
        if ((!$customer_id) or ($customer_id < 0)) throw new AfwRuntimeException("getMyCurrentRequests : customer_id [$customer_id] is mandatory field");
        $obj->select("customer_id", $customer_id);
        $old_status_date = AfwDateHelper::shiftHijriDate("", -20);
        $obj->where("status_id in (".self::$REQUEST_STATUSES_FINISHED.") or status_date >= '$old_status_date'");

        return $obj->loadMany($nb_req_limit, "request_date desc");
    }

    public static function loadByText($customer_id, $request_date, $request_title, $request_text)
    {
        $obj = new Request();


        $obj->select("customer_id", $customer_id);
        $obj->select("request_date", $request_date);
        $obj->select("request_title", $request_title);
        $obj->select("request_text", $request_text);

        if ($obj->load()) {
            return $obj;
        } else return null;
    }


    public static function loadByCode($request_code)
    {
        $obj = new Request();
        $obj->select("request_code", $request_code);
        $obj->select("active", "Y");
        if ($obj->load()) {
            return $obj;
        } else return null;
    }


    public static function loadByMainIndex($request_code, $customer_id, $create_obj_if_not_found = false)
    {
        $obj = new Request();


        $obj->select("request_code", $request_code);
        $obj->select("customer_id", $customer_id);

        if ($obj->load()) {
            if ($create_obj_if_not_found) {
                $obj->activate();
            }
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("request_code", $request_code);
            $obj->set("customer_id", $customer_id);


            $obj->insert();
            $obj->is_new = true;
            return $obj;
        } else return null;
    }


    public function getRelatedToTicketsCount()
    {
        $req = new Request();
        $req->select("related_request_code", $this->getVal("request_code"));
        $req->select("active", "Y");
        return $req->count();
    }


    public function getRelatedTicket()
    {
        $r_request_code = $this->getVal("related_request_code");
        $customer_id = $this->getVal("customer_id");
        return self::loadByMainIndex($r_request_code, $customer_id, $create_obj_if_not_found = false);
    }


    public function getWideDisplay($lang = "ar")
    {

        $data = array();
        $link = array();


        list($data[0], $link[0]) = $this->displayAttribute("customer_id", false, $lang);
        list($data[1], $link[1]) = $this->displayAttribute("request_title", false, $lang);
        if (!$data[1]) $data[1] = "[بدون عنوان-" . $this->getId() . "]";
        list($data[2], $link[2]) = $this->displayAttribute("request_date", false, $lang);
        list($data[3], $link[3]) = $this->displayAttribute("request_time", false, $lang);


        return "[" . $this->getId() . "] - " . implode("-", $data);
    }

    public function getShortDisplay($lang = "ar")
    {
        $data = array();
        $link = array();


        list($data[0], $link[0]) = $this->displayAttribute("request_title", false, $lang);
        if (!$data[0]) $data[0] = "[بدون عنوان-" . $this->getId() . "]";
        $data[1] = $this->showAttribute("request_date"); // $this->decode("status_date", "HIJRI_ONLY");
        if ($this->iamTheSupervisor()) $data[2] = "&star;";
        else $data[2] = ">>>>";

        return implode("-", $data);
    }

    public function getDisplay($lang = "ar")
    {

        $data = array();
        $link = array();


        list($data[0], $link[0]) = $this->displayAttribute("request_title", false, $lang);
        if (!$data[0]) $data[0] = "[بدون عنوان-" . $this->getId() . "]";
        $data[1] = $this->showAttribute("request_date"); // $this->decode("status_date", "HIJRI_ONLY");
        list($data[2], $link[2]) = $this->displayAttribute("request_time", false, $lang);

        return implode("-", $data);
    }



    public function getStatusDisplay($lang = "ar")
    {

        $data = array();
        $link = array();
        list($status_comment, $link[0]) = $this->displayAttribute("status_comment", false, $lang);
        list($data_status, $link[1]) = $this->displayAttribute("status_id", false, $lang);
        $status_date = $this->showAttribute("request_date"); // $this->decode("status_date", "HIJRI_ONLY");
        list($status_time, $link[3]) = $this->displayAttribute("status_time", false, $lang);

        return "<span class='crm_status_comment'>$status_comment</span> <span class='crm_status'>$data_status</span> <br><span class='status_date'>$status_date</span>&nbsp;&nbsp;<span class='status_time'>$status_time</span>";
    }


    public function list_of_request_priority()
    {
        $list_of_items = array();
        $list_of_items[4] = "أولوية منخفضة";  //     code : LOW_PRIO 
        $list_of_items[3] = "أولوية عادية";  //     code : NORMAL_PRIO 
        $list_of_items[2] = "أولوية عالية";  //     code : HIGH_PRIO 
        $list_of_items[1] = "أولوية قصوى";  //     code : URGENT 
        return  $list_of_items;
    }




    protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
    {
        global $lang;
        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
        $my_id = $this->getId();
        $displ = $this->getDisplay($lang);

        if ($mode == "mode_responseList") {
            // throw new AfwRuntimeException("`$mode` == mode_responseList why here");
            if (!$this->isClosedWithCustomer()) {
                if(!$this->isStarted()) {
                    unset($link);
                    $link = array();
                    $title = "لم يبدأ العمل على هذا الطلب رجاء الضغط على زر 'بدأ العمل على الطلب' في أسفل الصفحه للتمكن من التعليق أو الاجابة عليه";
                    $link["URL"] = "@help";
                    $link["CODE"] = "stop.and.debugg";
                    $link["TITLE"] = $title;
                    $link["PUBLIC"] = true;
                    $otherLinksArray[] = $link;
                }
                // throw new AfwRuntimeException("not isClosedWithCustomer why here");
                if ($this->investigatorCanRespond() or $this->iamTheSupervisor()) {
                    unset($link);
                    $link = array();
                    $title = "تحرير إجابة";
                    $title_detailed = $title . "بخصوص : " . $displ;
                    $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Response&currmod=crm&sel_request_id=$my_id&sel_response_type_id=1";
                    $link["TITLE"] = $title;
                    $link["PUBLIC"] = true;
                    $link["UGROUPS"] = array();
                    $otherLinksArray[] = $link;
                }

                if ($this->investigatorCanAsk() or $this->iamTheSupervisor()) {
                    unset($link);
                    $link = array();
                    $title = "طرح سؤال";
                    $title_detailed = $title . "بخصوص : " . $displ;
                    $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Response&currmod=crm&sel_request_id=$my_id&sel_response_type_id=5";
                    $link["TITLE"] = $title;
                    $link["UGROUPS"] = array();
                    $link["PUBLIC"] = true;
                    $otherLinksArray[] = $link;
                }

                if ($this->investigatorCanComment() or $this->iamTheSupervisor()) {
                    unset($link);
                    $link = array();
                    $title = "إضافة تعليق";
                    $title_detailed = $title . "بخصوص : " . $displ;
                    $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Response&currmod=crm&sel_request_id=$my_id&sel_response_type_id=2";
                    $link["TITLE"] = $title;
                    $link["UGROUPS"] = array();
                    $link["PUBLIC"] = true;
                    $otherLinksArray[] = $link;
                }

                if ($this->investigatorCanShareInfo() or $this->iamTheSupervisor()) {
                    unset($link);
                    $link = array();
                    $title = "تحرير معلومات داخلية لغاية تدريب الزملاء";
                    $title_detailed = $title . "بخصوص : " . $displ;
                    $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Response&currmod=crm&sel_request_id=$my_id&sel_response_type_id=7";
                    $link["TITLE"] = $title;
                    $link["UGROUPS"] = array();
                    $link["PUBLIC"] = true;
                    $otherLinksArray[] = $link;
                }


                if ($this->isDone() or $this->iamTheSupervisor()) {
                    unset($link);
                    $link = array();
                    $title = "إعادة الطلب إلى المنسق";
                    $title_detailed = $title . "بخصوص : " . $displ;
                    $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Response&currmod=crm&sel_request_id=$my_id&sel_response_type_id=14";
                    $link["TITLE"] = $title;
                    $link["PUBLIC"] = true;
                    $link["UGROUPS"] = array();
                    $otherLinksArray[] = $link;
                }

                // throw new AfwRuntimeException("debuggggg otherLinksArray = ".var_export($otherLinksArray, true));
            }
        }



        return $otherLinksArray;
    }

    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "default_db_");

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable 


                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - deletable 
                // crm.response-الإستفسار 	request_id  أنا تفاصيل لها-OneToMany
                $this->execQuery("delete from ${server_db_prefix}crm.response where request_id = '$id' ");


                // FK not part of me - replaceable 



                // MFK

            } else {
                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK on me 
                // crm.response-الإستفسار 	request_id  أنا تفاصيل لها-OneToMany
                $this->execQuery("update ${server_db_prefix}crm.response set request_id='$id_replace' where request_id='$id' ");


                // MFK


            }
            return true;
        }
    }



    public function getFormuleResult($attribute, $what = 'value')
    {
        global $me, $file_dir_name;



        switch ($attribute) {
            case "is_support":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_SUPPORT) return 1;
                return 0;
                break;

            case "is_suggestion":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_SUGGESTION) return 1;
                return 0;
                break;


            case "is_request":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_REQUEST) return 1;
                return 0;
                break;

            case "is_enquiry":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_ENQUIRY) return 1;
                return 0;
                break;

            case "is_complaint":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_COMPLAINT) return 1;
                return 0;
                break;

            case "is_grievance":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_GRIEVANCE) return 1;
                return 0;
                break;

            case "is_HI":
                if ($this->getVal("request_type_id") == self::$REQUEST_TYPE_HI) return 1;
                return 0;
                break;

            case "is_satisfied":
                if ($this->getVal("service_satisfied") == "Y") return 1;
                return 0;
                break;

            case "is_indifferent":
                if (($this->getVal("service_satisfied") != "Y") and ($this->getVal("service_satisfied") != "N")) return 1;
                return 0;
                break;

            case "is_not_satisfied":
                if ($this->getVal("service_satisfied") == "N") return 1;
                return 0;
                break;
        }

        return AfwFormulaHelper::calculateFormulaResult($this, $attribute);
    }

    protected function initObject()
    {

        if (!$this->getVal("status_id")) {
            $this->setSlient("status_id", self::$REQUEST_STATUS_DRAFT);
            $this->setSlient("request_date", AfwDateHelper::currentHijriDate());
            $this->setSlient("request_time", date("H:i:s"));
            $this->setSlient("status_date", AfwDateHelper::currentHijriDate());
            $this->setSlient("status_time", date("H:i:s"));
            $this->setSlient("status_comment", "طلب جديد في طور الاعتماد");
        }

        if (!$this->getVal("customer_id")) {
            $theCustomer = AfwSession::getCustomerConnected($throwError = false);
            if ($theCustomer) $this->setSlient("customer_id", $theCustomer->id);
        }

        if (!$this->getVal("customer_type_id")) {
            $customerObjme = $this->hetCustomer();
            if ($customerObjme) $this->setSlient("customer_type_id", $customerObjme->getVal("customer_type_id"));
        }

        if (!$this->getVal("request_code")) {
            $request_code = substr(md5(date("Ymdhis") . $this->getVal("customer_type_id")), 1, self::$REQUEST_CODE_LENGTH);
            $this->setSlient("request_code", $request_code);

            // @todo : check if this code is used by me in previous request 
            // probability = 0.000001 but .....

        }

        $this->setSlient("orgunit_id", self::$CRM_CENTER_ID);







        return true;
    }

    public function afterLoad()
    {
        if (!$this->getVal("status_date")) {
            // throw new AfwRuntimeException("afterLoad : request_date will be setted to [AfwDateHelper::currentHijriDate()]");
            $this->setSlient("status_date", AfwDateHelper::currentHijriDate());
            $this->setSlient("status_time", date("H:i:s"));
        }
        //else throw new AfwRuntimeException("afterLoad : request_date already setted to [".$this->getVal("request_date")."]");   
        return true;
    }


    public function getMyCLStep()
    {
        return "wizardv1_li";   // return "wizard1";
    }


    public function getWizardStepsClass()
    {
        return "steps_wizardv1 clearfix";   // return "hzmSteps";
    }

    public function getStepLiContentHtml($step_num, $step_name)
    {
        return "<span class=\"number\">${step_num}.</span> ${step_name}";
    }

    public function getWizardClass()
    {
        return "wizardv1";
    }

    public function getFieldGroupInfos($fgroup)
    {
        if ($fgroup == "other_data") return array("name" => $fgroup, "css" => "pct_50");
        if ($fgroup == "tech_data") return array("name" => $fgroup, "css" => "pct_50");

        if ($fgroup == "assignment") return array("name" => $fgroup, "css" => "pct_50");
        if ($fgroup == "status") return array("name" => $fgroup, "css" => "pct_50");

        if ($fgroup == "body") return array("name" => $fgroup, "css" => "pct_50");
        if ($fgroup == "props") return array("name" => $fgroup, "css" => "pct_50");

        if ($fgroup == "responseList") return array("name" => $fgroup, "css" => "pct_100");
        if ($fgroup == "request_text") return array("name" => $fgroup, "css" => "pct_100");
        

        return array("name" => $fgroup, "css" => "none");
    }

    public function canResetAsNew()
    {
        return ((($this->iamTheCustomer()) or ($this->iamTheInvestigator()) or ($this->iamTheSupervisor())) and (!$this->isDraft()) and (!$this->isStarted()));
    }


    public function customerCanComment()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        if ($status_reel_id == self::$REQUEST_STATUS_DONE) return true;
        //if($status_reel_id == self::$REQUEST_STATUS_CANCELED) return true;
        if ($status_reel_id == self::$REQUEST_STATUS_REJECTED) return true;

        return false;
    }

    public function isSent()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return ($status_reel_id >= self::$REQUEST_STATUS_SENT);
    }

    public function isCanceled()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return ($status_reel_id == self::$REQUEST_STATUS_CANCELED);
    }

    public function isStarted()
    {
        $currStatus = intval($this->getVal("status_id"));

        // MISSED_INFO -  
        if (self::$REQUEST_STATUS_MISSED_INFO == $currStatus) return "عودة للعميل لاستكمال البيانات";

        // MISSED_FILES -  
        if (self::$REQUEST_STATUS_MISSED_FILES == $currStatus) return "عودة للعميل لاستكمال المرفقات";

        // REDIRECT - طلب إعادة التحويل  
        if (self::$REQUEST_STATUS_REDIRECT == $currStatus) return "طلب إعادة التحويل";

        // ONGOING - طلب تحت الإنجاز  
        if (self::$REQUEST_STATUS_ONGOING == $currStatus) return "طلب تحت الإنجاز ";

        // DONE - تمت الإجابة  
        if (self::$REQUEST_STATUS_DONE == $currStatus) return "تمت الإجابة";

        // تدقيق الإجابة - RESPONSE_UNDER_REVISION
        if (self::$REQUEST_STATUS_RESPONSE_UNDER_REVISION == $currStatus) return "تدقيق الإجابة";

        // CLOSED - طلب مغلق  
        if (self::$REQUEST_STATUS_CLOSED == $currStatus) return "طلب مغلق";

        // REJECTED - طلب مستبعد  
        if (self::$REQUEST_STATUS_REJECTED == $currStatus) return "طلب مستبعد";

        return false;
    }



    public function attributeIsApplicable($attribute)
    {
        $objme = AfwSession::getUserConnected();

        $request_employee_id = $this->getVal("employee_id");
        $connected_employee_id = ($objme) ? $objme->getEmployeeId() : 0;



        if (($attribute == "service_category_id") or
            ($attribute == "service_id") or
            ($attribute == "request_priority") or
            // ($attribute=="orgunit_id") or 
            // ($attribute=="employee_id") or 
            ($attribute == "assign_date") or
            ($attribute == "assign_time")
        ) {
            return ($this->isAssigned());
        }

        if ($attribute == "responseList") {
            return (!in_array($this->getVal("status_id"), [self::$REQUEST_STATUS_DRAFT]));
        }

        if ($attribute == "survey_sent") {
            return $this->isFinished();
        }

        if ($attribute == "survey_opened") {
            return $this->estSent();
        }

        if ($attribute == "request_for") {
            $val = trim($this->getVal($attribute));
            return ($val and ($val != "crm-"));
        }
        
        if ($attribute == "request_link") {
            $val = trim($this->getVal($attribute));
            return ($val != "");
        }

        if ($attribute == "related_request_code") {
            $val = trim($this->getVal($attribute));
            return ($val != "");
        }

        

        if (($attribute == "easy_fast") or ($attribute == "service_satisfied") or ($attribute == "pb_resolved") or ($attribute == "general_satisfaction")) {
            return $this->estOpened();
        }

        return parent::attributeIsApplicable($attribute);
    }

    /***************************************************************************************************
     ***************************************************************************************************
     *        
     *
     *                          STATUS MAP - START
     *                          
     *
     ***************************************************************************************************
     ***************************************************************************************************/
    public function  iResponded()
    {
        return false;
    }

    public function  isDone()
    {
        $status_id = intval($this->getVal("status_id"));
        $status_reel_id = self::statusFather($status_id);
        return (($status_reel_id >= self::$REQUEST_STATUS_DONE) or ($status_id == self::$REQUEST_STATUS_RESPONSE_UNDER_REVISION));
    }



    public function  isFinished()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return ($status_reel_id >= self::$REQUEST_STATUS_CANCELED);
    }


    public function  investigatorCanRespond()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        if ($status_reel_id == self::$REQUEST_STATUS_ONGOING) return true;
        return false;
    }

    public function  investigatorCanAsk()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        if ($status_reel_id == self::$REQUEST_STATUS_ONGOING) return true;
        return false;
    }

    public function  investigatorCanComment()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        if ($status_reel_id == self::$REQUEST_STATUS_ONGOING) return true;
        if ($status_reel_id == self::$REQUEST_STATUS_REDIRECT) return true;
        return false;
    }

    public function  investigatorCanShareInfo()
    {
        return true;
    }








    public function isClosedWithCustomer()
    {
        return $this->isFinished();
    }


    public function isClosed()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return ($status_reel_id == self::$REQUEST_STATUS_CLOSED);
    }

    


    public function isExecuted()
    {
        $currStatus = self::statusFather(intval($this->getVal("status_id")));

        // REDIRECT - طلب إعادة التحويل  
        if (self::$REQUEST_STATUS_REDIRECT == $currStatus) return true;

        // عند العميل 
        if (self::$REQUEST_STATUS_DRAFT == $currStatus) return true;

        // DONE - تمت الإجابة  
        if (self::$REQUEST_STATUS_DONE <= $currStatus) return true;

        return false;
    }

    public function isOngoing()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return ($status_reel_id >= self::$REQUEST_STATUS_REDIRECT);
    }

    public function isAssigned()
    {
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return (($status_reel_id >= self::$REQUEST_STATUS_SENT) and ($this->getVal("employee_id") > 0));
    }



    public function  iamTheCustomer()
    {
        $theCustomer = AfwSession::getCustomerConnected();

        if (!$theCustomer) return false;
        if ($theCustomer->id != $this->getVal("customer_id")) return false;

        return true;


        // obsolete (old method of considering customer user in session)
        // $objme = AfwSession::getUserConnected();
        // return ($objme and (($objme->getCustomerId()==$this->getVal("customer_id")) or ($objme->isSuperAdmin())));
    }

    public function  iamTheApprovedInvestigator()
    {
        $objme = AfwSession::getUserConnected();
        if (!$objme) return false;
        if ($objme->isSuperAdmin()) return true;
        $objme_employee_id = $objme->getEmployeeId();
        $is_approved_crm_empl = false;
        $orgunit_id = $this->getVal("orgunit_id");
        if (($objme_employee_id > 0) and ($objme_employee_id == $this->getVal("employee_id")) and ($orgunit_id > 0)) {

            $objCrmEmpl = CrmEmployee::loadByMainIndex($orgunit_id, $objme_employee_id);
            if ($objCrmEmpl) {
                $is_approved_crm_empl = (($objCrmEmpl->getVal("super_admin") == "Y") or ($objCrmEmpl->getVal("admin") == "Y") or ($objCrmEmpl->getVal("approved") == "Y"));
            }
        }


        return $is_approved_crm_empl;
    }

    public function  iamTheInvestigator()
    {
        $objme = AfwSession::getUserConnected();
        if (!$objme) return false;
        $objme_employee_id = $objme->getEmployeeId();
        return (($objme_employee_id > 0) and
            ($objme_employee_id != $this->getVal("supervisor_id")) and
            (($objme_employee_id == $this->getVal("employee_id")) or ($objme->isSuperAdmin()))
        );
    }

    public function  iamTheSupervisor()
    {
        $objme = AfwSession::getUserConnected();
        if (!$objme) return false;
        $objme_employee_id = $objme->getEmployeeId();
        return (($objme_employee_id > 0) and
            (
                ($objme_employee_id == $this->getVal("supervisor_id"))
                // or (($this->getVal("supervisor_id")==0) and (CrmEmployee::isAdmin($objme->id)))
                or ($objme->isSuperAdmin())

            )
        );
    }


    public function iamLastResponderOrSuperAdmin()
    {
        $objme = AfwSession::getUserConnected();
        if (!$objme) return false;
        if ($objme->isSuperAdmin()) return true;

        $respObj = $this->getLastResponse();

        if (!$respObj) return false;

        $objme_employee_id = $objme->getEmployeeId();

        return ($respObj->getVal("employee_id") == $objme_employee_id);
    }

    public function getLastResponse()
    {
        $resp = new Response();
        $resp->select("request_id", $this->id);
        $resp->select("active", "Y");
        $respActList = $resp->loadMany(1, "response_date desc, response_time desc");

        $lact = array();

        foreach ($respActList as $respActItem) {
            return $respActItem;
        }
        return null;
    }


    public function removeLastResponse($lang = "ar")
    {
        // @todo what to do if a notification by email or SMS is sent about this response
        //       i suggest to send to customer another SMS saying please ignore the last SMS sent to you
        //       or block this remove to happen
        //       or make the SMS sent after 2 hours and not immedialtely to give to employee chance to roll-back  
        if (!$this->iamLastResponderOrSuperAdmin()) return array("هذا الرد لم يأت من قبل لهذا الموظف", "");
        $respObj = $this->getLastResponse();

        if ($respObj) {
            $respObj->hide();
            $respObj2 = $this->getLastResponse();

            $this->set("status_id", $respObj2->getVal("new_status_id"));
            $this->set("status_action_enum", self::status_action_by_code("removeLastResponse"));
            $this->set("status_date", AfwDateHelper::currentHijriDate());
            $this->set("status_time", date("H:i:s"));
            $this->set("status_comment", "###");
            $this->commit();
            return array("", "تم حذف بيانات الرد الأخير من قبلكم");
        } else {
            array("لم يعد يوجد ردود على هذا الطلب", "");
        }
    }




    public function getLastResponseCanBeApproved()
    {
        $resp = new Response();
        $resp->select("request_id", $this->id);
        $resp->select("active", "Y");
        $resp->where("response_type_id in (" . ResponseType::$RESPONSE_TYPES_ARE_TO_APPROVE . ")");
        $respActList = $resp->loadMany(1, "response_date desc, response_time desc");

        $lact = array();

        foreach ($respActList as $respActItem) {
            return $respActItem;
        }
        return null;
    }


    public function getLastActionOnRequest($lang = "ar")
    {
        $resp = new Response();
        $resp->select("request_id", $this->id);
        $resp->select("active", "Y");
        $resp->where("(response_type_id in (" . ResponseType::$RESPONSE_TYPES_ARE_PURE_ACTIONS . ") or internal = 'N')");
        $resp->where("(new_status_id not in (" . self::$REQUEST_STATUSES_INTERNAL . "))");
        $respActList = $resp->loadMany(1, "response_date desc, response_time desc");

        $lact = array();

        foreach ($respActList as $respActItem) {
            $lact[] = $respActItem->getActionTitle($lang);
        }

        return implode("<br>\n", $lact);
    }


    public function getFinalDecisionOnRequest($lang = "ar")
    {
        $resp = new Response();
        $resp->select("request_id", $this->id);
        $resp->select("active", "Y");
        $resp->where("response_type_id in (1,5) and internal = 'N'"); // definition of final decision
        $respActList = $resp->loadMany(1, "response_date desc, response_time desc");

        $lact = array();

        foreach ($respActList as $respActItem) {
            $lact[] = $respActItem->getVal("response_text");
        }

        return implode("<br>\n", $lact);
    }



    public function getLastInstructionOnRequest($lang = "ar", $separator = "<br>\n", $limit = 1)
    {
        $resp = new Response();
        $resp->select("request_id", $this->id);
        $resp->select("active", "Y");
        $resp->where("response_type_id not in (3,6) and internal = 'N'"); // definition of last instruction
        $respActList = $resp->loadMany($limit, "response_date desc, response_time desc");

        $lact = array();

        foreach ($respActList as $respActItem) {
            $lact[] = $respActItem->getVal("response_text");
        }

        return implode($separator, $lact);
    }

    public function getLastInstructionDetailsOnRequest($lang = "ar")
    {
        $inst = self::getLastInstructionOnRequest($lang, "\n");
        $inst_arr = explode("\n", $inst);

        $file_titles_arr = array();

        $files_started = false;

        foreach ($inst_arr as $key => $inst_line) {
            if ($files_started) {
                $inst_line = trim($inst_line);
                if ($inst_line) {
                    $file_titles_arr[] = $inst_line;
                }
                unset($inst_arr[$key]);
            }

            if (AfwStringHelper::stringStartsWith($inst_line, "----")) {
                unset($inst_arr[$key]);
                $files_started = true;
            }
        }

        if ($this->hasMissedFiles() and (count($file_titles_arr) == 0)) {
            $file_titles_arr[] = "المرفق المطلوب";
        }

        return array(implode("\n", $inst_arr), $file_titles_arr);
    }


    public function addCustomerComment($comment, $lang)
    {
        // keep same status
        $new_status_id = $this->getVal("status_id");

        $resoObj = Response::createNewResponse(
            $this->getId(),
            AfwDateHelper::currentHijriDate(),
            date("H:i:s"),
            0,
            0,
            $new_status_id,
            self::$RESPONSE_TYPE_COMMENT,
            $comment,
            $response_link = "",
            $internal = "N",
            $module_id = 0
        );

        AfwSession::pushSuccess($this->tm("Thanks, Your comment is saved.", $lang));
    }

    public function sendSmsToCustomer($template, $lang, $token_arr)
    {
       
        $customer_id = $this->getVal("customer_id");
        $the_customer = $this->hetCustomer();
         /**
         * @var CrmCustomer $the_customer
         */
        if ($the_customer) {
            $actionParamsArr = [];
            $actionParamsArr[0] = $template;
            return $the_customer->smsRetrieveAction($lang, $actionParamsArr, $only_get_description = false, $token_arr);
        }

        return [false, "No customer id=$customer_id found for this request", ""];
    }


    public function changeStatus($new_status_id, $status_comment, $status_action_enum, $internal = "N", $silent = false, $question_id=0, $employee_id=null)
    {
        $lang = AfwSession::getSessionVar("current_lang");
        if (!$lang) $lang = "ar";
        $silent_force = false;
        $errors = "";
        $warnings = "";
        $infos = "";
        $technicals = "";
        $objme = AfwSession::getUserConnected();
        if(!$employee_id) $employee_id = ($objme) ? $objme->getEmployeeId() : 0;
        $old_status = $this->getVal("status_id");
        if (($new_status_id == Request::$REQUEST_STATUS_DRAFT) and (!$this->getVal("status_id"))) $silent_force = true;

        if ($new_status_id != $this->getVal("status_id")) {
            if ($this->requestIsToComplete() and ($new_status_id == Request::$REQUEST_STATUS_ONGOING)) {
                $response_type = self::$RESPONSE_TYPE_COMPLETE;
            } else {
                $response_type = self::$RESPONSE_TYPE_STATUS_CHANGE;
            }
            $resoObj = null;
            if ((!$silent) and (!$silent_force)) {
                
                /*
                            $orgunit_id = $this->xxxx
                            if(!$orgunit_id) 
                            */
                
                $orgunit_id = 0;
                if ($employee_id == $this->getVal("employee_id")) $orgunit_id = $this->getVal("orgunit_id");
                if (!$orgunit_id) $orgunit_id = ($objme) ? $objme->getMyDepartmentId() : 0;

                // AfwSession::pushInformation("rafik-debugg : creating new response"); 
                $resoObj = Response::createNewResponse(
                    $this->getId(),
                    AfwDateHelper::currentHijriDate(),
                    date("H:i:s"),
                    $orgunit_id,
                    $employee_id,
                    $new_status_id,
                    $response_type,
                    $status_comment, // ." <!-- QID$question_id -->",
                    $response_link = "",
                    $internal,
                    $module_id = 0
                );
                $technicals .= "<br> > response created $status_comment new_status_id=$new_status_id";
                // AfwSession::pushInformation("rafik-debugg : new response created");                                                     



                

                
            }
            // AfwSession::pushInformation("rafik-debugg : updating status of request to $new_status_id"); 

            

            $this->set("status_id", $new_status_id);
            $this->set("status_action_enum", $status_action_enum);
            $this->set("status_date", AfwDateHelper::currentHijriDate());
            $this->set("status_time", date("H:i:s"));
            $this->set("status_comment", $status_comment);
            $new_status_decoded = $this->decode("status_id");
            if($this->commit())
            {                
                $technicals .= "<br> > request-status changed to $new_status_id/$new_status_decoded <br> > with comments $status_comment";
                $technicals .= $this->statusChanged($old_status, $resoObj->id);
            }
            else
            {
                $errors = "فشلت عملية تحديث حالة الطلب يرجى المحاولة لاحقا";
                AfwSession::pushError($errors);
                
                $technicals .= "<br> > failed changing request-status to $new_status_id/$new_status_decoded / $status_comment";
            }
            /*
                    $rand = rand(1011,9000);
                    
                    if(!$once) 
                    {
                        throw new AfwRuntimeException("change Status entered first time");
                        $once = 1;
                    }
                    else throw new AfwRuntimeException("change Status entered second time");
                    */

            // ." ($rand)"


        }

        $customer_id = $this->getVal("customer_id");

        if($customer_id == 11772 and (($employee_id==1) or (!$employee_id))) // testing rafik customer
        {
            AfwSession::pushWarning($technicals);
        }


        // AfwSession::pushInformation("rafik-debugg : status of request updated to $new_status_id with comment : $status_comment"); 

        /*
                if($new_status_id != $this->getVal("status_id"))
                {
                    if($new_status_id == self::$REQUEST_STATUS_CLOSED)
                    {
                        $resoObj->other_infos["survey_url"] = CrmLimesurvey::survey ClosedTicket($this);                        
                    }
                }
                */

        return array($resoObj, $errors, $warnings, $infos, $technicals);
    }

    public function statusChanged($old_status, $responseId)
    {
        $technicals_log = "<br> > responseId=$responseId ";
        $new_status_id = $this->getVal("status_id");
        $lang = AfwSession::getSessionVar("current_lang");
        if (!$lang) $lang = "ar";
        $objme = AfwSession::getUserConnected();
        if ($new_status_id == self::$REQUEST_STATUS_CLOSED) {
            // AfwSession::pushInformation("rafik-debugg : creating survey token"); 
            $survey_url = CrmLimesurvey::surveyClosedTicket($this);
            $technicals_log .= "<br> > survey Closed Ticket done : $survey_url";
            if ((!$objme) or (!$objme->isSuperAdmin())) $survey_url = null;

            // AfwSession::pushInformation("rafik-debugg : survey token created"); 
        } else {
            $survey_url = null;
        }

        if ($objme) $status_decoded = $this->decode("status_id");
        else $status_decoded = $this->getCustomerStatus($lang);

        $success_message = "";
        if ($new_status_id == Request::$REQUEST_STATUS_CANCELED) $success_message = $this->tm("ticket canceled", $lang);
        elseif (($new_status_id != Request::$REQUEST_STATUS_SENT)    and 
            ($new_status_id != Request::$REQUEST_STATUS_ONGOING) and 
            ($new_status_id != Request::$REQUEST_STATUS_ASSIGNED)) 
        {
            $success_message = $this->tm("status changed to", $lang) . " \"$status_decoded\"";
        } 
        else
        {
            $success_message = $this->tm("request sent for investigation", $lang);
        }

        if ($survey_url) {
            $success_message .= "<br>رابط الاستبيان : " . $survey_url;
        }

        if ($responseId) {
            $success_message .= "<br>مسلسل الرد : " . $responseId;
        }

        if($success_message) AfwSession::pushSuccess($success_message);

        if (
            ($new_status_id != $old_status) and
            (($new_status_id == Request::$REQUEST_STATUS_MISSED_FILES) or
                ($new_status_id == Request::$REQUEST_STATUS_MISSED_INFO) or
                ($new_status_id == Request::$REQUEST_STATUS_DONE) or
                (($old_status == Request::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) and ($new_status_id == Request::$REQUEST_STATUS_CLOSED))
            )
        ) {
            $customerObj = $this->hetCustomer();
            // send SMS to warn customer
            $token_arr = array(
                        "[title]" => $this->getVal("request_title"),
                        "[first_name_ar]" => $customerObj->getVal("first_name_ar"),
                        "[crm_site_url]" => AfwSession::config("crm_site_url", "[crm-site]"),
                    );
            list($done, $reason, $sms_body) = $this->sendSmsToCustomer($template = "news", $lang, $token_arr);
            if($done)
            {
                AfwSession::pushSuccess("تم اعلام العميل بهذا التغيير على التذكرة عبر الرسالة التالية : ".$sms_body);
                $technicals_log .= "<br> > sendSmsToCustomer done with template=$template, lang=$lang, infos=$reason";
            }
            else
            {
                AfwSession::pushWarning("فشل اعلام العميل بهذا التغيير على التذكرة <!-- reason=$reason -->");
                $technicals_log .= "<br> > sendSmsToCustomer failed with template=$template, lang=$lang reason=$reason";
            }

            
        }

        return $technicals_log;
    }

    public function getCustomerStatus($lang = "ar")
    {
        $statusObj = $this->het("status_id");

        if ($lang != "en") $lang = "ar";

        if ($statusObj) {
            return $statusObj->getVal("customer_status_name_$lang");
        }

        return "???";
    }


    public function sendRequest($lang = "ar")
    {
        $old_status = $this->getVal("status_id");
        $old_supervisor_id = $this->getVal("supervisor_id");
        // send the request 
        $status_comment = "تم إرسال الطلب إلى مشرف خدمة العملاء من أجل توجيهه للجهة المختصة";
        $this->changeStatus(self::$REQUEST_STATUS_SENT, $status_comment, self::status_action_by_code("sendRequest")); 


        $development_mode = AfwSession::config("development_mode", false);

        // select notification type depending on settings 
        $notify_customer_arr = AfwSession::config("notify_customer", null);
        $notify_customer_new_request_settings = $notify_customer_arr["new_request"];

        $notify_supervisor_arr = AfwSession::config("notify_supervisor", null);
        $notify_supervisor_assign_settings = $notify_supervisor_arr["assign_request"];


        // notify the customer 
        $the_customer = $this->hetCustomer();
        if (($old_status < self::$REQUEST_STATUS_SENT) and (!$old_supervisor_id)) {
            if ($the_customer) {
                $receiver = array();
                $receiver["mobile"] = $the_customer->getVal("mobile");
                $receiver["email"] = $the_customer->getVal("email");
                $notification_sender_result_arr = AfwNotificationManager::sendNotification($notify_customer_new_request_settings, $receiver, "new_request", $this, $lang);
                foreach ($notification_sender_result_arr as $notification_type => $notification_sender_result_item) {
                    $notification_sender_result_ok = $notification_sender_result_item[0];
                    $notification_sender_result_message = $notification_sender_result_item[1];
                    $notification_message = $notification_sender_result_item[2];
                    if ((!$notification_sender_result_ok) and ($development_mode)) {
                        AfwSession::pushError($this->tr($notification_type) . " &larr; " . $notification_message . " &larr; " . $notification_sender_result_message);
                    }
                }
            } else AfwSession::pushWarning($this->tm("can't send notification to customer, the request is without customer defined"));
        }

        // assign to supervisor if not already done
        if (!$old_supervisor_id) {
            //$supervisorObj = $this->assignRandomSupervisor($commit=true);
            $supervisorObj = $this->assignBestAvailableSupervisor($lang, $pbm = false);

            // notify the supervisor
            if ($supervisorObj) {
                $receiver = array();
                $receiver["mobile"] = $supervisorObj->getVal("mobile");
                $receiver["email"] = $supervisorObj->getVal("email");
                $notification_sender_result_arr = AfwNotificationManager::sendNotification($notify_supervisor_assign_settings, $receiver, "assign_request", $this, $lang);
                foreach ($notification_sender_result_arr as $notification_type => $notification_sender_result_item) {
                    $notification_sender_result_ok = $notification_sender_result_item[0];
                    $notification_sender_result_message = $notification_sender_result_item[1];
                    $notification_message = $notification_sender_result_item[2];
                    if ((!$notification_sender_result_ok) and ($development_mode)) {
                        AfwSession::pushError($this->tr($notification_type) . " &larr; " . $notification_message . " &larr; " . $notification_sender_result_message);
                    }
                }
            } elseif ($development_mode) AfwSession::pushWarning($this->tm("can't assign a supervisor to the request"));
        }
    }


    public function resetRequestNew($lang = "ar")
    {
        $objme = AfwSession::getUserConnected();
        /*
            if($objme) 
               $status_comment = "تعديل حالة التذكرة بطلب من الموظف ".$objme->getDisplay($lang);
            else*/
        $status_comment = "يمكن للعميل اجراء التعديلات على طلبه الآن";

        $this->changeStatus(self::$REQUEST_STATUS_DRAFT, $status_comment, self::status_action_by_code("resetRequestNew"));
        return array("", $status_comment);
    }

    public function refreshRequest($lang = "ar")
    {
        return array("", "تم تحديث بيانات الطلب");
    }


    public function assignRequest($employeeId, $lang = "ar")
    {
        /*
        if ($this->getVal("employee_id") == $employeeId) {
            return array("الطلب مسند من قبل لهذا الموظف", "");
        }*/

        if ((!$employeeId) and $this->getVal("employee_id") > 0) die("strange attempt to unassign the request ID=" . $this->id);
        $this->set("employee_id", $employeeId);
        $this->set("assign_date", AfwDateHelper::currentHijriDate());
        $this->set("assign_time", date("H:i:s"));
        $this->commit();
        if ($employeeId > 0) {
            $status_comment = date("H:i:s") . ": تم اسناد الطلب [" . $this->id . "] للموظف(ة) $employeeId " . $this->showAttribute("employee_id");
            // if($employeeId == 1790) AfwRunHelper::unSafeDie("case of employeeId = $employeeId");
            $this->changeStatus(self::$REQUEST_STATUS_ASSIGNED, $status_comment, self::status_action_by_code("assignRequest"), $internal = "Y");
        } else {
            $status_comment = "الطلب في انتظار الاسناد ";
            $this->changeStatus(self::$REQUEST_STATUS_SENT, $status_comment, self::status_action_by_code("unAssignRequest"), $internal = "Y");
        }
        // AfwRunHelper::safeDie($status_comment, "employee_id = ". $employeeId);
        return array("", $status_comment);
    }

    public function redirectRequest($lang = "ar")
    {
        // die("rafik-debugg : start of redirectRequest");
        $status_comment = "تمت ملاحظة أن هذا الطلب ليس من تخصص هذه الإدارة واخطار مركز خدمة العملاء من أجل إعادة التحويل";
        $this->changeStatus(self::$REQUEST_STATUS_REDIRECT, $status_comment, self::status_action_by_code("redirectRequest"), $internal = "Y");
        return array("", $status_comment);
    }

    public function returnRequestToInvestigator($lang = "ar")
    {
        $status_comment = "المنسق المكرم الرجاء إعادة النظر في الرد على هذا الطلب وملاحظة تعليق مشرف خدمة العملاء ";
        $this->changeStatus(self::$REQUEST_STATUS_ASSIGNED, $status_comment, self::status_action_by_code("returnRequestToInvestigator"), $internal = "Y");
        return array("", "تمت الإعادة للمنسق مع رسالة : " . $status_comment . ". يفضل أيضا أن يضع مشرف خدمة العملاء تعليقا فيه توجيها لسبب إرجاع الطلب إليه");
    }




    public function startRequest($lang = "ar")
    {
        $status_comment = "لقد بدأ العمل على الطلب";

        // if level of investigator = starting => internal = W (all responses should be validated by supervisor before show to customer)
        $this->changeStatus(self::$REQUEST_STATUS_ONGOING, $status_comment, self::status_action_by_code("startRequest"));
        return array("", $status_comment);
    }

    public function doneRequest($lang = "ar")
    {
        $status_comment = "تم عمل المطلوب والرد على العميل";

        // if level of investigator = starting => internal = W (all responses should be validated by supervisor before show to customer)
        $this->changeStatus(self::$REQUEST_STATUS_DONE, $status_comment, self::status_action_by_code("doneRequest"));
        return array("", $status_comment);
    }

    public function cancelRequest($lang = "ar")
    {
        $status_comment = "تم إلغاء التذكرة بناء على طلب العميل";
        $this->changeStatus(self::$REQUEST_STATUS_CANCELED, $status_comment, self::status_action_by_code("cancelRequest"));
        return array("", $status_comment);
    }




    public function unCloseRequest($lang = "ar")
    {
        $status_comment = "تم الغاء غلق الطلب";
        $resoObj = $this->changeStatus(self::$REQUEST_STATUS_DONE, $status_comment, self::status_action_by_code("unCloseRequest"));


        return array("", $status_comment);
    }

    public function needResponseApproval()
    {
        /**
         * @var Response $respObj
         */
        // عند غلق أي طلب اذا كانت آخر اجابة هي تحت التدقيق يتم تحويلها الى اجابة معتمدة
        $respObj = $this->getLastResponseCanBeApproved();
        if ($respObj) return $respObj->needApproval();
        return false;
    }


    public function approveResponse($lang = "ar")
    {
        // عند غلق أي طلب اذا كانت آخر اجابة هي تحت التدقيق يتم تحويلها الى اجابة معتمدة
        $respObj = $this->getLastResponseCanBeApproved();
        if ($respObj) {
            $approved = $respObj->approveIfNotApproved();
        } else $approved = false;

        if ($approved) return array("", "تم اعتماد الاجابة");
        else return array("لا يوجد اجابة في انتظار الاعتماد", "");
    }

    public function closeRequest($lang = "ar")
    {
        // عند غلق أي طلب اذا كانت آخر اجابة هي تحت التدقيق يتم تحويلها الى اجابة معتمدة
        $respObj = $this->getLastResponseCanBeApproved();
        if ($respObj) $respObj->approveIfNotApproved();

        $status_comment = "تم غلق الطلب";
        $resoObj = $this->changeStatus(self::$REQUEST_STATUS_CLOSED, $status_comment, self::status_action_by_code("closeRequest"));


        return array("", $status_comment);
    }

    public function rejectRequest($lang = "ar")
    {
        $status_comment = "تم رفض الطلب";
        $this->changeStatus(self::$REQUEST_STATUS_REJECTED, $status_comment, self::status_action_by_code("rejectRequest"));
        return array("", $status_comment);
    }

    //@todo : is it necessary ?            
    // public function ignoreRequest($lang="ar")            
    // public static $REQUEST_STATUS_IGNORED = 9;            


    public function getMethodTitle($methodName, $lang = "ar")
    {
        if (($methodName == "cancelRequest") and $this->iamTheCustomer()) {
            return "أرغب في إلغاء هذا الطلب";
        }

        return self::$PUB_METHODS[$methodName]["title"];
    }

    public function getMethodTooltip($methodName, $lang = "ar")
    {
        /*
            if(($methodName=="cancelRequest") and $this->iamTheCustomer())
            {
                return "أرغب في إلغاء هذا الطلب";
            }*/

        return self::$PUB_METHODS[$methodName]["tooltip"];
    }



    public function methodAllowed($methodName)
    {
        $pbms = $this->getPublicMethods();
        // die("pbms=".var_export($pbms, true));
        foreach ($pbms as $pbm_code => $pbm_row) {
            if ($pbm_row["METHOD"] == $methodName) return true;
        }

        return false;
    }


    public static function satisfactionPct()
    {
        $satisfied = Request::aggreg("count(*)", "service_satisfied = 'Y'");
        $not_satisfied = Request::aggreg("count(*)", "service_satisfied = 'N'");
        $neutral = Request::aggreg("count(*)", "service_satisfied = 'W'");
        $total = $satisfied + $not_satisfied; //  + $neutral
        $pct = round($satisfied * 1000 / $total)/10;

        return $pct;
    }

    private static function statusFather($curr_status)
    {
        if ($curr_status < 100) $curr_status_parent = $curr_status;
        elseif ($curr_status == 301) $curr_status_parent = 0;
        else $curr_status_parent = intval($curr_status / 100);

        return $curr_status_parent;
    }


    private static function statusMother($curr_status)
    {
        if ($curr_status < 100) $curr_status_parent = $curr_status;
        else $curr_status_parent = intval($curr_status / 100);

        return $curr_status_parent;
    }


    public function executeItemsMethod($itemsMethod)
    {
        if ($itemsMethod) {
            if(!isset($this->itemsMethodExec[$itemsMethod])) 
            {
                $itemsList = $this->$itemsMethod();
                if (!$itemsList) {
                    $itemsList = array();
                }
                $this->itemsMethodExec[$itemsMethod] = $itemsList;                
            }            
                    
        } 
        else 
        {
            $itemsList = array();
            $itemsList["none"] = array('ar' => "none", 'en' => "none");
            $this->itemsMethodExec[$itemsMethod] = $itemsList;
        }
        
        
        return $this->itemsMethodExec[$itemsMethod];

    }

    protected function getPublicMethods()
    {
        global $lang;

        $objme = AfwSession::getUserConnected();

        $pbms = array();
        if ($objme) /* @todo */ {

            if ($objme->isSuperAdmin()) {
                /*
                $color = "red";
                $title_ar = "التحديث من منصة تواصل معنا القديمة";
                $pbms["xcc13B"] = array(
                    "METHOD" => "updateFromNartaqi",
                    "COLOR" => $color,
                    "LABEL_AR" => $title_ar,
                    "PUBLIC" => true,
                    "BF-ID" => "",
                    "HZM-SIZE" => 12,
                );*/
                if($this->isClosed())
                {
                    $color = "red";
                    $title_ar = "الربط مع منصة استبيان";
                    $pbms["xcc13A"] = array(
                        "METHOD" => "linkWithSurveyPlateform",
                        "COLOR" => $color,
                        "LABEL_AR" => $title_ar,
                        "PUBLIC" => true,
                        "BF-ID" => "",
                        "HZM-SIZE" => 12,
                );
            }

            }


            if ($objme->isAdmin()) {
                if ((!$this->getVal("supervisor_id")) or $objme->isSuperAdmin()) {
                    $color = "yellow";
                    if (!$this->getVal("supervisor_id")) $title_ar = "تعيين مشرف على هذا الطلب";
                    else $title_ar = "تغيير مشرف هذا الطلب";
                    $pbms["xc143A"] = array(
                        "METHOD" => "assignBestAvailableSupervisor",
                        "COLOR" => $color,
                        "LABEL_AR" => $title_ar,
                        "PUBLIC" => true,
                        "BF-ID" => "",
                        "HZM-SIZE" => 12,
                    );
                }
            }
        }

        $color = "green";
        //$title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
        //$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");

        $curr_status = intval($this->getVal("status_id"));

        if (self::$STATUS_MAP[$curr_status]) $curr_status_parent = $curr_status;
        else $curr_status_parent = self::statusMother(intval($this->getVal("status_id")));

        $curr_status_label = $this->decode("status_id");
        $log_arr = [];
        foreach (self::$STATUS_MAP[$curr_status_parent] as $methodName0 => $methodProps) {
            // if($methodName0 == "assignRequest") AfwRunHelper::safeDie("for $methodName0 after call to this->$itemsMethod() itemsList contain : ", "", true, $itemsList);
            $method_not_allowed_reason = array();
            $method_not_allowed_reason[] = "current_status : $curr_status_label($curr_status) => p$curr_status_parent ";

            list($method_allowed, $method_na_reason) = AfwDynamicPublicMethodHelper::checkMethodAllowed($methodProps, $methodName0, $this);                
            if(!$method_allowed) $method_not_allowed_reason[] = "$methodName0 is not allowed ".$method_na_reason;
            else $method_not_allowed_reason[] = "$methodName0 is allowed";

            $log = implode(" -> ", $method_not_allowed_reason);
            if ($method_allowed) 
            {                
                $pbms = AfwDynamicPublicMethodHelper::splitMethodToMethodItems($pbms, self::$PUB_METHODS[$methodName0], $methodName0, $this, $log);
            }
            else
            {
                
            }

            $log_arr[] = $log;
            
        }
        
        // die("We are upgrading the system for you ..., please wait.<br>\nSTATUS_MAP LOG".var_export($log_arr,true)." pbms=".var_export($pbms,true));
        
        return $pbms;
    }


    /***************************************************************************************************
     ***************************************************************************************************
     *        
     *
     *                          STATUS MAP - END
     *                          
     *
     ***************************************************************************************************
     ***************************************************************************************************/

    protected function attributeCanBeEditedBy($attribute, $user, $desc)
    {
        if ($this->attributeIsForSupervisor($attribute)) {
            $reason = false;
            if (!$this->iamTheSupervisor()) $reason = " i am not the Supervisor : supervisor_id=" . $this->getVal("supervisor_id");
            return array((!$reason), $reason);
        }

        if ($this->attributeIsForCustomer($attribute)) {
            $reason = false;
            if (!$this->requestCustomerFieldsEditable()) $reason = "request is not editable, status not = 1";
            if (!$this->iamTheCustomer()) $reason = " i am not the customer : cust_id=" . $this->getVal("customer_id");
            return array((!$reason), $reason);
        }

        if ($this->attributeIsForClassificationAndStats($attribute)) {
            $reason = false;
            if ($this->isDone()) $reason = "request is done, status >= 5";
            if ((!$this->iamTheCustomer()) and (!$this->iamTheInvestigator()) and (!$this->iamTheSupervisor())) $reason = " i am not the customer : cust_id=" . $this->getVal("customer_id") . " and i am not the investigator : empl_id=" . $this->getVal("employee_id") . " and i am not the supervisor:sup_id=" . $this->getVal("supervisor_id");

            return array((!$reason), $reason);
        }

        return [true, ''];
    }


    public function requestCustomerFieldsEditable()
    {
        return ($this->requestIsDraft() or $this->requestIsToComplete());
    }




    public function attributeIsForClassificationAndStats($attribute)
    {
        $custAttr = ["service_category_id", "service_id", "related_request_code"];
        return in_array($attribute, $custAttr);
    }


    public function attributeIsForCustomer($attribute)
    {
        $custAttr = ["customer_type_id", "request_type_id", "region_id", "city_id", "other_city", "request_title", "request_for", "request_link", "request_text"];
        return in_array($attribute, $custAttr);
    }

    public function attributeIsForSupervisor($attribute)
    {
        $custAttr = ["orgunit_id", "region_id", "city_id", "other_city"];
        return in_array($attribute, $custAttr);
    }

    public function linkWithSurveyPlateform($lang="ar")
    {
        $error = "";
        $return = "";
        try
        {
            $return = CrmLimesurvey::surveyClosedTicket($this, $lang);
        }
        catch(Exception $e)
        {
            $error = "Exception : ".$e->getFile()."::".$e->getLine()." : message : ".$e->getMessage()." Trace : ".$e->getTraceAsString();
        }
        catch(Error $e)
        {
            $error = "Error     : ".$e->getFile()."::".$e->getLine()." : message : ".$e->getMessage()." Trace : ".$e->getTraceAsString();
        }

        return [$error, $return, ""];
    }


    /* 
         public function updateFromNartaqi($lang="ar")
         {
            
            global $batch_log_errors_arr, $batch_log_warnings_arr, $batch_log_infos_arr, $db_config, $db_arr;
             $file_dir_name = dirname(__FILE__);
             


            AfwBatch::disableEcho();

            require_once("$file_dir_name/../lib/hzm/db/hzm_db.php"); 
              
            require_once("$file_dir_name/../../../php_batch/nartaqi/nartaqi_crm_functions.php");
            $forced_ticket_number = $this->getVal("request_code");
            $result = nartaqi_to_crm_migrate_customers_and_requests_and_responses("$file_dir_name/../lib", $force_update_customer=true, $force_update_request=true, $force_update_response=true, $echo_log=true, $force_update_employee=true, $forced_ticket_number, $this);
            
            $nb_errors = $result["nb_errors"];
            $nb_warnings = $result["nb_warnings"];
            $nb_records = $result["nb_records"];
            $nb_new_cust = $result["new_cust"];
            $nb_upd_cust = $result["upd_cust"];
            $req_new = $result["req_new"];
            $req_upd = $result["req_upd"];
            $resp_new = $result["resp_new"];
            $resp_upd = $result["resp_upd"];
            
            $link_o_e = $result["link_o_e"];
            $max_updd = $result["max_updd"];
            $migration_start_date_time = $result["mig_date"];
            $error_text = "";
            $info_text = "";
            
            if($nb_errors) $error_text = "$nb_errors error(s) : " . AfwBatch::getErrors("\n<br>");
            if($nb_warnings) $info_text .= "$nb_warnings warning(s) : " . AfwBatch::getWarnings("\n<br>")."<br>";
            $info_text .= AfwBatch::getInfos("\n<br>")."<br>";
            
            return array($error_text, $info_text);
             
         }
         */


    public function stepsAreOrdered()
    {
        return false;
    }


    public function select_visibilite_horizontale($dropdown = false)
    {
        $objme = AfwSession::getUserConnected();
        $custme = AfwSession::getCustomerConnected($throwError = false);
        // temporaire jusqu a ajout du filtre date dans QSEARCH mode
        /*
                $this->where("request_date >= '14410810'");
                */

        if ($objme and $objme->isAdmin()) {
            // $request_date_limit = AfwDateHelper::shiftHijriDate("",-90);
            // $this->where("request_date >= '$request_date_limit'");
        } else {
            $request_date_limit = AfwDateHelper::shiftHijriDate("", -500);
            $empl_id = $objme ? $objme->getEmployeeId() : 0;
            $cust_id = $custme ? $custme->getId() : 0;

            if ($empl_id) $iam_general_supervisor = CrmObject::userConnectedIsGeneralSupervisor();
            if ($empl_id) $iam_supervisor = CrmObject::userConnectedIsSupervisor();

            if (!$iam_general_supervisor) $iam_general_supervisor = 0;
            if (!$iam_supervisor) $iam_supervisor = 0;

            // if the user is an employee 
            // he is allowed to see request if :
            // 1. he is a general supervisor 
            // or
            // 2. he is a supervisor
            // or 
            // 3. he is the current investigator of this request   

            $employee_allowed_to_see_request_cond =
                "($iam_general_supervisor>0 or $iam_supervisor>0 or employee_id=$empl_id)";

            // if the user authenticated is a customer
            // he is allowed to see request if owner of this request (requester)    
            $customer_allowed_to_see_request_cond = "customer_id = $cust_id";
            $this->where("($empl_id>0 and $employee_allowed_to_see_request_cond) or ($cust_id > 0 and $customer_allowed_to_see_request_cond)");

            // rafik : users other than super admin 
            $this->where("request_date >= '$request_date_limit'");
        }

        $selects = array();
        $this->select_visibilite_horizontale_default($dropdown, $selects);
    }


    public function calcMan($what="value", $showOnlyCode=false)
    {
        $return = "man";
        $lang = AfwSession::getSessionVar("current_lang");
        if(!$lang) $lang = "ar";
        $status_id = $this->getVal("status_id");
        $return_arr = [];
        $req_employee_id = $this->getVal("employee_id");
        $return_arr["man"] = $this->translateOperator("archive",$lang);
        $return_arr["empl"] = $this->showAttribute("employee_id");
        $return_arr["sss"] = $this->showAttribute("supervisor_id");
        $return_arr["cust"] = $this->translate("customer_id",$lang);

        // NEW -  مسودة طلب جديد  
        if ($status_id == self::$REQUEST_STATUS_DRAFT) $return = "cust";

        // MISSED_INFO -  عودة للعميل لاستكمال البيانات
        if ($status_id == self::$REQUEST_STATUS_MISSED_INFO) $return = "cust";

        // MISSED_FILES -  عودة للعميل لاستكمال المرفقات
        if ($status_id == self::$REQUEST_STATUS_MISSED_FILES) $return = "cust";

        // SENT - طلب مرسل  للتحقيق
        if ($status_id == self::$REQUEST_STATUS_SENT) $return = $req_employee_id ? "empl" : "sss";


        // ASSIGNED - تم اسناده للموظف المختص
        if ($status_id == self::$REQUEST_STATUS_ASSIGNED) $return = "empl";

        // REDIRECT - طلب إعادة التحويل  
        if ($status_id == self::$REQUEST_STATUS_REDIRECT) $return = "sss";

        // RESPONSE UNDER REVISION - تدقيق الاجابة
        if ($status_id == self::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) $return = "sss";

        // ONGOING - طلب تحت الإنجاز - جاري العمل
        if ($status_id == self::$REQUEST_STATUS_ONGOING) $return = "empl";

        // DONE - تمت الإجابة  
        if ($status_id == self::$REQUEST_STATUS_DONE) $return = "cust";

        // CANCELED - طلب ملغى  
        if ($status_id == self::$REQUEST_STATUS_CANCELED) $return = "sss";

        // CLOSED - طلب مغلق  
        if ($status_id == self::$REQUEST_STATUS_CLOSED) $return = "sss";

        // REJECTED - طلب مستبعد  
        if ($status_id == self::$REQUEST_STATUS_REJECTED) $return = "sss";

        // IGNORED - طلب تم تجاهله  
        if ($status_id == self::$REQUEST_STATUS_IGNORED) $return = "sss";

        

        if($showOnlyCode) return $return;
        else return $return_arr[$return];
    }


    public function calcNotifications($what="value")
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        $html = "";
        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        if($this->isSent())
        {
            $request_date_h = AfwDateHelper::formatHijriDate($this->getVal("request_date"));
            $request_date = AfwDateHelper::hijriToGreg($this->getVal("request_date"));
            
            $request_time = $this->getVal("request_time");
            $title_new_request_sms = $this->tm("Request received approval notification", $lang);
            $new_request_sms = AfwNotificationManager::prepareNotificationBody($this, "new_request", "sms", $lang);        
            $html .= "<h1>$title_new_request_sms <div class='simple_datetime'>$request_date هـ $request_time </div><div class=\"sms-notif\">&nbsp;</div></h1><p class='sms notification'>$request_date_h : $new_request_sms</p>";
            
        }
        else $html .= "reuqest not yet sent : status_reel_id = $status_reel_id";

        
        if($this->isDone())
        {
            // $custObj = $this->het("crm_customer_id");
            if(true)
            {
                $token_arr = array(
                    "[title]" => $this->getVal("request_title"),
                    // "[first_name_ar]" => $custObj->getVal("first_name_ar"),
                    // "[crm_site_url]" => AfwSession::config("crm_site_url", "[crm-site]"),
                );
                $file_dir_name = dirname(__FILE__);
                include("$file_dir_name/../tpl/template_sms_news.php");
                if ($sms_body_arr[$lang]) 
                {
                    $respObj = $this->getLastResponse();
                    $response_id = $respObj->getVal("id");
                    $response_date_h = AfwDateHelper::formatHijriDate($respObj->getVal("response_date"));
                    $response_date = AfwDateHelper::hijriToGreg($respObj->getVal("response_date"));
                    $response_time = $respObj->getVal("response_time");
                        $sms_body = $this->decodeTpl($sms_body_arr[$lang], array(), $lang, $token_arr);
                        $title_new_response_sms = $this->tm("New response received notification", $lang);
                        $html .= "<h1>$title_new_response_sms <div class='simple_datetime'>$response_date هـ $response_time</div><div class=\"sms-notif\">&nbsp;</div></h1><p class='sms notification'>$response_date_h : $sms_body</p><br>";
                        
                } else {
                        
                }
            }
            
        }
        else $html .= "reuqest not yet done : status_reel_id = $status_reel_id";

        return $html;
        
    }

    public function calcResponse_all($what="value")
    {
        $responseList = $this->get("responseList");
        //if(count($responseList)>0) die(var_export($responseList,true));
        $res = "";

        foreach ($responseList as $responseItem) {
            $response_text = $responseItem->getVal("response_text");
            $employee = $responseItem->showAttribute("employee_id");
            $response_date = $responseItem->getVal("response_date");
            if ($response_text) {
                if ($res) $res .= "\n\r";
                $res .= "في " . $response_date . " رد $employee : " . $response_text;
            }
        }


        return $res;
    }

    public function calcPrio_icon()
    {
        if ($this->getVal("request_priority") <= 2) {
            return "<img lbl='no-ajax' src='../lib/images/urgent.png' width='24' heigth='24' data-toggle='tooltip' data-placement='bottom' title='هذا الطلب تم تصنيفه بأولوية عالية' data-original-title='هذا الطلب تم تصنيفه بأولوية عالية' class='red-tooltip'>";
        } else {
            return "";
        }
    }

    public function beforeMaj($id, $fields_updated)
    {

        if (!$this->getVal("request_date")) {
            $this->set("request_date", AfwDateHelper::currentHijriDate());
            $this->set("request_time", date("H:i:s"));
            $this->set("status_date", AfwDateHelper::currentHijriDate());
            $this->set("status_time", date("H:i:s"));
        }

        /* RB : not very clear not very logic
                if((!$fields_updated["orgunit_id"]) and (!$this->getVal("employee_id")))
                {
                    $this->assignAuthenticatedUserAsInvestigator();
                }*/

        return true;
    }


    public function isDraft()
    {
        return $this->requestIsDraft();
    }

    public function requestIsToComplete()
    {
        $status_reel_id = intval($this->getVal("status_id"));
        return (($status_reel_id == self::$REQUEST_STATUS_MISSED_FILES)
            or ($status_reel_id == self::$REQUEST_STATUS_MISSED_INFO));
    }

    public function requestIsDraft()
    {

        $status_reel_id = self::statusFather(intval($this->getVal("status_id")));
        return ($status_reel_id <= self::$REQUEST_STATUS_DRAFT);
    }



    public function isToComplete()
    {
        return $this->requestIsToComplete();
    }

    public function hasMissedFiles()
    {
        $status_reel_id = intval($this->getVal("status_id"));
        return ($status_reel_id == self::$REQUEST_STATUS_MISSED_FILES);
    }


    /*

        public function assignRandomSupervisor($commit=true) 
        {
            $supervisor_id = $this->getVal("supervisor_id");

            if(!$supervisor_id)
            {
                $allSupervisors_arr = $this->getAllSupervisors();

                $sup_rand = rand(0, count($allSupervisors_arr)-1);
                
                if($allSupervisors_arr[$sup_rand]) 
                {
                    $this->set("supervisor_id", $allSupervisors_arr[$sup_rand]->id);
                    if($commit) $this->commit();

                    return $this->het("supervisor_id");
                }
            }


            return null;

        }


        public function getAllSupervisors()
        {
           
            $general_company_id = AfwSession::config("general_company_id", 0);

            if(!$general_company_id) return array();

            return Employee::loadAllByJobrole($general_company_id, self::$JOB_ROLE_CRM_SUPERVISOR, $byId=false);
            
            
        }
*/

    public function calcDate_start_perf()
    {
        global $period;
        if (!$period) $period = self::$STATS_PERF_PERIOD;
        $start_period = self::$MAX_DELAY_BEFORE_CONSIDER_LATE + $period;
        return AfwDateHelper::shiftHijriDate("", -$start_period);
    }

    public function calcDate_end_perf()
    {
        $end_period = self::$MAX_DELAY_BEFORE_CONSIDER_LATE;
        return AfwDateHelper::shiftHijriDate("", -$end_period);
    }

    public function calcDate_end_stats()
    {
        global $end;
        if (!$end) $end = -1;
        return AfwDateHelper::shiftHijriDate("", -1);
    }

    public function calcDate_start_stats()
    {
        global $period;
        if (!$period) $period = 30;
        return AfwDateHelper::shiftHijriDate("", -$period);
    }

    public function calcRequest_done()
    {
        return $this->isExecuted() ? 1 : 0;
    }

    public function executionDelay($round = true)
    {
        if (
            $this->getVal("orgunit_id")
            and $this->getVal("employee_id")
            and ($this->getVal("orgunit_id") != self::$CRM_CENTER_ID)
            and $this->getVal("assign_date")
            and $this->getVal("assign_time")
        ) {
            return AfwDateHelper::hijriDateTimeDiff($hdate2 = "", $time2 = "", $this->getVal("assign_date"), $this->getVal("assign_time"), $round);
        } else {
            return AfwDateHelper::hijriDateTimeDiff($hdate2 = "", $time2 = "", $this->getVal("request_date"), $this->getVal("request_time"), $round);
        }
    }




    public function calcRequest_late()
    {
        if ($this->isExecuted()) return 0;

        return ($this->executionDelay() > self::$MAX_DELAY_BEFORE_CONSIDER_LATE) ? 1 : 0;
    }

    public function calcDays_delay()
    {
        return $this->executionDelay();
    }

    public function calcDays_investigator()
    {
        return "...";
    }


    public function calcRequest_ongoing()
    {
        if ($this->isExecuted()) return 0;

        return 1 - $this->calcRequest_late();
    }

    public function informCustomerBySMS($message, $lang)
    {


        $inform_customer_by_sms_about_status_change = AfwSession::config("inform_customer_by_sms", false);
        if ($inform_customer_by_sms_about_status_change and ($the_customer = $this->hetCustomer())) {
            $the_customer->getVal("mobile");
            $simulate_sms_to_mobile = AfwSession::config("simulate_sms_to_mobile", null);
            if ($simulate_sms_to_mobile) $sms_mobile = $simulate_sms_to_mobile;
            else $sms_mobile = $the_customer->getVal("mobile");


            $sms_mobile = AfwFormatHelper::formatMobile($sms_mobile);

            // send SMS to customer       
            if ($sms_mobile and AfwFormatHelper::isCorrectMobileNum($sms_mobile)) {
                list($sms_ok, $sms_info) = AfwSmsSender::sendSMS($sms_mobile, $message);
                if ($sms_ok) {
                    AfwSession::pushInformation(AfwLanguageHelper::tt("Customer has been informed by sms about this status change", $lang));
                } else {
                    AfwSession::pushWarning(AfwLanguageHelper::tt("Customer can't be informed, error : ", $lang) . $sms_info);
                }
            } else {
                AfwSession::pushWarning(AfwLanguageHelper::tt("Customer hasn't a valid mobile number", $lang) . " [$sms_mobile]");
            }
        }
    }





    public static function decodePerf($perf_level)
    {
        if ($perf_level == "very_poor") return "غير مرضي";
        if ($perf_level == "poor") return "ضعيف";
        if ($perf_level == "good") return "مقبول";
        if ($perf_level == "excellent") return "جيد";
        if ($perf_level == "perfect") return "ممتاز";
        return "????";
    }


    public static function getPerf($row, $formatted = false)
    {
        // ex of $row
        // array ( 'orgunit_id' => '70', 'count_request' => 99, 'is_request' => '0', 'is_enquiry' => '89', 'is_complaint' => '7', 'is_suggestion' => '1', 'is_support' => '2', 'request_done' => '3', 'request_late' => '43', 'request_ongoing' => '53', )
        // got frpm die("getPerf(row=".var_export($row,true).")");

        $count_request = $row["count_request"];
        $request_done = $row["request_done"];
        $request_late = $row["request_late"];



        $perf_perf = $request_done - 0.8 * $request_late;
        if ($perf_perf < 0) $perf_perf = 0;

        if (!$count_request) {
            $pct_level = 100;
            $pct_level_comment = "no request";
        } else {
            $pct_level = round(($perf_perf * 100 / $count_request) * 10) / 10;
            $pct_level_comment = "@doc : pef-rule 1 : calcul of pct : perf_perf = request_done - 0.8*request_late, ex: $request_done - 0.8*$request_late = $perf_perf , => pct_level = perf_perf*100/count_request => ex : $perf_perf*100/$count_request = $pct_level";
        }



        if (($request_late == 0) and (($request_done > 0) or ($count_request < 3))) {
            if ($pct_level < 50) {
                $pct_level = 50;
                $pct_level_comment = "@doc : perf-rule 2 : no late MIN pct = 50";
            }
        }


        if (($request_late > 0) or ($request_done == 0)) {
            $pct_level -= 0.5 * $request_late;
            if ($pct_level > 50) {
                $pct_level = 50;
                $pct_level_comment = "@doc : perf-rule 3 : nothing done or there's late MAX pct = 50";
            }
        }

        if (($request_late <= 1) and (($request_done > 0) or ($count_request < 5))) {
            if ($pct_level < 30) {
                $pct_level = 30;
                $pct_level_comment = "@doc : perf-rule 4 : no too much late MIN pct = 30";
            }
        }

        if ($pct_level < 0) $pct_level = 0;
        if ($pct_level > 100) $pct_level = 100;


        $perf_level = "very_poor";

        if ($pct_level >= 30) {
            $perf_level = "poor";
        }

        if ($pct_level >= 50) {
            $perf_level = "good";
        }

        if ($pct_level >= 75) {
            $perf_level = "excellent";
        }

        if ($pct_level >= 90) {
            $perf_level = "perfect";
        }


        if (!$formatted) return $perf_level;

        $perf_level_display = self::decodePerf($perf_level);

        return "<div data=\"$pct_level : $pct_level_comment\" class=\"stats_perf perf_$perf_level\">$perf_level_display</div>";
    }


    public function afterInsert($id, $fields_updated)
    {
        $customerObjme = $this->hetCustomer();
        if ($customerObjme) {
            $customerObjme->set("last_request_date", AfwDateHelper::currentHijriDate());
            $customerObjme->commit();
        }
    }


    protected function becomePrio($old_prio, $new_prio)
    {
        if ($old_prio == 1) return false;
        if ($old_prio == 2) return false;

        if ($new_prio == 1) return true;
        if ($new_prio == 2) return true;

        return false;
    }

    public function afterMaj($id, $fields_updated)
    {
        self::lookIfInfiniteLoop();
        $lang = AfwSession::getSessionVar("current_lang");
        $objme = AfwSession::getUserConnected();
        // send mail to investigator if is there
        $old_request_priority = 0; // no way to get here in after maj (seems working only in before Maj)
        if (($fields_updated["employee_id"] or $fields_updated["request_priority"]) and $this->becomePrio($old_request_priority, $this->getVal("request_priority"))) {
            $employeeInvestigObj = $this->het("employee_id");
            if ($employeeInvestigObj) {
                $employeeInvestigEmail = $employeeInvestigObj->getVal("email");
                if ($employeeInvestigEmail) {
                    try {
                        $to_email_arr = array();
                        $to_email_arr[] = $employeeInvestigEmail;

                        $request_id =  $this->id;
                        $title = $this->getVal("request_title");
                        $body = $this->getVal("request_text");
                        $subject = AfwLanguageHelper::tt("urgent : High priority ticket has been assigned to you, titled", $lang) . " [" . AfwStringHelper::truncateArabicJomla($title, 20) . "]";

                        $bodyHtml = "";
                        $bodyHtml .= "<h3>$subject</h3><br>";
                        $bodyHtml .= AfwLanguageHelper::tt("Ticket subject", $lang) . " : $title<br>";
                        $bodyHtml .= "<h4><b>" . AfwLanguageHelper::tt("Ticket body", $lang) . " : </b></h4><br>";
                        $bodyHtml .= "<p>" . $body . "</p>";

                        $res = AfwMailer::htmlSimpleMail("CRM-V2", "ticket-$request_id", $to_email_arr, $subject, $bodyHtml, $lang);
                    } catch (Exception $e) {
                        AfwSession::pushError(AfwLanguageHelper::tt("failed to inform investigator by email : ", $lang) . $e->getMessage());
                    }

                    // if very High priority, than SMS to investigator also 
                    if ($this->getVal("request_priority") == 1) {
                        $simulate_sms_to_mobile = AfwSession::config("simulate_sms_to_mobile", null);

                        if ($simulate_sms_to_mobile) $sms_mobile = $simulate_sms_to_mobile;
                        else $sms_mobile = $employeeInvestigObj->getVal("mobile");


                        $sms_mobile = AfwFormatHelper::formatMobile($sms_mobile);

                        // send SMS to customer       
                        if ($sms_mobile and AfwFormatHelper::isCorrectMobileNum($sms_mobile)) {
                            list($sms_ok, $sms_info) = AfwSmsSender::sendSMS($sms_mobile, $subject);
                            if ($sms_ok) {
                                AfwSession::pushInformation(AfwLanguageHelper::tt("Investigator has been informed by sms about this prio", $lang));
                            } else {
                                AfwSession::pushWarning(AfwLanguageHelper::tt("Investigator can't be informed, error : ", $lang) . $sms_info);
                            }
                        } else {
                            AfwSession::pushWarning(AfwLanguageHelper::tt("Investigator hasn't a valid mobile number", $lang) . " [$sms_mobile]");
                        }
                    }

                    if ($res["result"]) {
                        AfwSession::pushInformation(AfwLanguageHelper::tt("Investigator has been informed by email about this prio", $lang));
                    } else {
                        $error_text_to_push = AfwLanguageHelper::tt("Investigator can't be informed", $lang);
                        if (($objme and $objme->isSuperAdmin()) or (AfwSession::config("MODE_DEVELOPMENT", false))) {
                            $error_text_to_push .= " : " . $res["error"];
                            $error_text_to_push .= AfwLanguageHelper::tt("sending to customer via following email address", $lang) . " : " . $employeeInvestigEmail;
                        }


                        AfwSession::pushError($error_text_to_push);
                    }
                } else {
                    AfwSession::pushLog("employee assigned " . $employeeInvestigObj->getDisplay($lang) . " hasn't an email");
                }
            } else {
                AfwSession::pushLog("no  employee assigned to send him email");
            }
        } else {
            AfwSession::pushLog("employee changed = [" . $fields_updated["employee_id"] . "] prio changed = [" . $fields_updated["request_priority"] . "] new prio = " . $this->getVal("request_priority"));
        }

        if ($fields_updated["orgunit_id"]) {
            $crmEmplAlreadyExists = CrmEmployee::checkExistance($this->getVal("orgunit_id"), $this->getVal("employee_id"));
            if ((!$crmEmplAlreadyExists) or (!$crmEmplAlreadyExists->isActive())) {
                if ($this->getVal("orgunit_id") > 0) {

                    $invest = $this->assignBestAvailableInvestigator($lang, false);
                    if (!$invest) {
                        $orgObj = $this->het("orgunit_id");
                        $this->setForce("employee_id", 0);
                        $status_comment = "no available Investigator in this orgunitID=" . $orgObj->id;
                        $this->setForce("status_comment", $status_comment);
                        $this->commit();
                        if ($objme and ($orgObj->id != CrmOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID)) {
                            AfwSession::pushWarning(AfwLanguageHelper::tt("No investigator available for this organization", $lang) . " : " . $orgObj->getDisplay($lang));
                        }
                    } else {
                        //
                    }
                }
            }
        }

        if ($fields_updated["service_satisfied"]) {
            $customerObj = $this->hetCustomer();
            if ($customerObj) {
                $customerObj->set("service_satisfied", $this->getVal("service_satisfied"));
            }
        }

        if ($fields_updated["pb_resolved"]) {
            $customerObj = $this->hetCustomer();
            if ($customerObj) {
                $customerObj->set("pb_resolved", $this->getVal("pb_resolved"));
            }
        }
    }


    public static function resetAssignSupervisors($lang = "ar")
    {
        return self::assignSupervisorForNonAssigned($reset = true, $silent = true, $lang);
    }

    public static function silentAssignSupervisorForNonAssigned($lang = "ar", $limit = "200")
    {
        return self::assignSupervisorForNonAssigned($reset = false, $silent = true, $lang, $limit);
    }

    public static function silentCloseOldDoneRequests($lang = "ar", $limit = "200")
    {
        return self::closeOldDoneRequests($silent = true, $lang, $limit);
    }

    public static function silentRestoreLostRequests($lang = "ar", $limit = "100")
    {
        return self::restoreLostRequests($silent = true, $lang, $limit);
    }

    public static function silentBootstrapBlockedRequests($lang = "ar", $limit = "100")
    {
        return self::bootstrapBlockedRequests($silent = true, $lang, $limit);
    }



    public static function restoreLostRequests($silent = false, $lang = "ar", $limit = "100")
    {
        $obj = new Request();
        $obj->where("status_id in (" . self::$REQUEST_STATUSES_ONGOING_INVESTIGATOR . ")");
        $obj->select("employee_id", 0);

        $reqList = $obj->loadMany($limit);

        $errors_arr = array();
        $infos_arr = array();

        foreach ($reqList as $reqItem) {
            list($err, $info) = $reqItem->sendRequest($lang);

            if ($err) $errors_arr[] = $err;
            if ($info) $infos_arr[] = $info;
        }

        $nb_errs = count($errors_arr);

        $infos_arr[] = "restored " . count($reqList) . " request(s) with $nb_errs error(s)";

        if ((!$silent) and (count($errors_arr) > 0)) {
            AfwSession::pushError(implode("<br>", $errors_arr));
        }

        if ((!$silent) and (count($infos_arr) > 0)) {
            AfwSession::pushInformation(implode("<br>", $infos_arr));
        }

        return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
    }

    public static function bootstrapBlockedRequests($silent = false, $lang = "ar", $limit = "100")
    {
        $obj = new Request();
        $obj->where("employee_id > 0");
        $obj->select("status_id", self::$REQUEST_STATUS_SENT);

        $reqList = $obj->loadMany($limit);

        $errors_arr = array();
        $infos_arr = array();

        foreach ($reqList as $reqItem) {
            list($err, $info) = $reqItem->startRequest($lang);

            if ($err) $errors_arr[] = $err;
            if ($info) $infos_arr[] = $info;
        }

        $nb_errs = count($errors_arr);

        $infos_arr[] = "bootstrapped " . count($reqList) . " request(s) with $nb_errs error(s)";

        if ((!$silent) and (count($errors_arr) > 0)) {
            AfwSession::pushError(implode("<br>", $errors_arr));
        }

        if ((!$silent) and (count($infos_arr) > 0)) {
            AfwSession::pushInformation(implode("<br>", $infos_arr));
        }

        return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
    }


    public static function closeOldDoneRequests($silent = false, $lang = "ar", $limit = "200")
    {
        $obj = new Request();

        // we consider old 3 days after status become done 
        $old_status_date = AfwDateHelper::shiftHijriDate("", -3);

        $obj->select("status_id", self::$REQUEST_STATUS_DONE);
        $obj->where("status_date <= '$old_status_date'");

        $reqList = $obj->loadMany($limit);

        $errors_arr = array();
        $infos_arr = array();

        foreach ($reqList as $reqItem) {
            list($err, $info) = $reqItem->closeRequest($lang);

            if ($err) $errors_arr[] = $err;
            if ($info) $infos_arr[] = $info;
        }

        $nb_errs = count($errors_arr);

        $infos_arr[] = "closed " . count($reqList) . " request(s) with $nb_errs error(s)";

        if ((!$silent) and (count($errors_arr) > 0)) {
            AfwSession::pushError(implode("<br>", $errors_arr));
        }

        if ((!$silent) and (count($infos_arr) > 0)) {
            AfwSession::pushInformation(implode("<br>", $infos_arr));
        }

        return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
    }

    public static function silentAssignInvestigatorForNonAssigned($lang = "ar", $limit = "200")
    {
        return self::assignInvestigatorForNonAssigned($silent = true, $lang, $limit);
    }

    public static function assignInvestigatorForNonAssigned($silent = false, $lang = "ar", $limit = "200")
    {
        $server_db_prefix = AfwSession::config("db_prefix", "default_db_");
        $obj = new Request();

        $obj->setForce("employee_id", 0);
        $obj->setForce("status_comment", "assignInvestigatorForNonAssigned-doing-reset");
        $obj->where("me.orgunit_id > 0 and ((me.employee_id > 0 and me.employee_id not in (select employee_id from " . $server_db_prefix . "crm.crm_employee ce where ce.orgunit_id = me.orgunit_id and ce.active='Y')) or me.employee_id is null) and status_id not in (".self::$REQUEST_STATUSES_FINISHED.")");
        $obj->update(false);


        $obj->where("employee_id=0 and orgunit_id > 0 and status_id in (2,4,201)");

        $reqList = $obj->loadMany($limit);

        $errors_arr = array();
        $infos_arr = array();

        foreach ($reqList as $reqItem) {
            list($err, $info) = $reqItem->assignBestAvailableInvestigator($lang, $pbm = true);

            if ($err) $errors_arr[] = $err;
            if ($info) $infos_arr[] = $info;
        }

        $nb_errs = count($errors_arr);

        $infos_arr[] = "assign done for " . count($reqList) . " request(s) with $nb_errs error(s)";

        if ((!$silent) and (count($errors_arr) > 0)) {
            AfwSession::pushError(implode("<br>", $errors_arr));
        }

        if ((!$silent) and (count($infos_arr) > 0)) {
            AfwSession::pushInformation(implode("<br>", $infos_arr));
        }

        return AfwFormatHelper::pbm_result($errors_arr, $infos_arr);
    }


    public static function assignSupervisorForNonAssigned($reset = false, $silent = false, $lang = "ar", $limit = "200")
    {
        $errors_arr = array();
        $infos_arr = array();
        $tech_arr = array();
        $warn_arr = array();
        $nb_errs = 0;
        $nb_done = 0;

        $obj = new Request();

        if ($reset) {
            $obj->setForce("supervisor_id", 0);
            $obj->setForce("employee_id", 0);
            $obj->setForce("status_comment", "assignSupervisorForNonAssigned-with-reset");
            $obj->where("(employee_id = 0 and status_id not in (".self::$REQUEST_STATUSES_NO_NEED_ASSIGN.")) or (orgunit_id = " . self::$CRM_CENTER_ID . ")"); //  or (supervisor_id = 1917 and employee_id = 1791)
            $nb_rows_rest = $obj->update(false);
            $warn_arr[] = "$nb_rows_rest request(s) assignment has been reset";
        }

        $silent = false;

        $obj->select("supervisor_id", 0);
        $obj->where("status_id not in (".self::$REQUEST_STATUSES_NO_NEED_ASSIGN.")");

        $reqList = $obj->loadMany($limit);

        

        foreach ($reqList as $reqItem) {
            list($err, $info) = $reqItem->assignBestAvailableSupervisor($lang, $pbm = true, $commit = true, $re_distribution = false);

            if ($err) { $tech_arr[] = "Error : ".$err; $nb_errs++; }
            else $nb_done++; 
            if ($info) $tech_arr[] = $info;
        }

        

        $infos_arr[] = "done : $nb_done , errors : $nb_errs";

        if ((!$silent) and (count($errors_arr) > 0)) {
            AfwSession::pushError(implode("<br>", $errors_arr));
        }

        if ((!$silent) and (count($infos_arr) > 0)) {
            AfwSession::pushInformation(implode("<br>", $infos_arr));
        }

        return AfwFormatHelper::pbm_result($errors_arr, $infos_arr, $warn_arr, "<br>\n", $tech_arr);
    }

    public function assignBestAvailableSupervisor($lang = "ar", $pbm = true, $commit = true, $re_distribution = false)
    {

        // find the best available supervisor
        $this_supervisor_id = $this->getVal("supervisor_id");
        list($best_supervisor_id, $crmEmpl, $allList, $stats) = CrmEmployee::getBestAvailableSupervisor($this_supervisor_id, $re_distribution, CrmOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID);
        $crmRes = array("best" => $best_supervisor_id, "res" => $crmEmpl, 'all' => $allList);
        // AfwRunHelper::safeDie("CrmEmployee::get BestAvailableSupervisor() returned object : ", "", true, $crmRes);

        $crmEmplObj = $crmEmpl["obj"];

        // assign this Request to this supervisor
        $emplObj = null;
        if ($crmEmplObj) {
            $crmEmplObj->assignMeAsRequestSupervisor($this, $commit);
            $emplObj = $crmEmplObj->hetEmployee();
        }
        // else AfwRunHelper::safeDie("CrmEmployee::get BestAvailableSupervisor() returned object : ", "", true, $crmRes);

        if ($pbm) {
            if ($emplObj) return array("", $this->tm("request has beeen assigned to ") . $emplObj->getDisplay($lang) . " all=" . var_export($stats, true) . " => best best_supervisor_id=$best_supervisor_id ");
            else return array($this->tm("no more available supervisors in the system"), "");
        }

        return $emplObj;
    }


    public function assignBestAvailableInvestigator($lang = "ar", $pbm = true)
    {

        // find the best available supervisor
        $orgunit_id = $this->getVal("orgunit_id");
        list($best_investigator_id, $crmEmpl, $allList) = CrmEmployee::getBestAvailableInvestigator($orgunit_id, $except_inv_id = $this->getVal("employee_id"));
        $crmRes = array("best" => $best_investigator_id, "res" => $crmEmpl, 'all' => $allList);
        // die("<pre>CrmEmployee::assignBestAvailableInvestigator() returned object : ". var_export($crmRes, true)."</pre>");

        $crmEmplObj = $crmEmpl["obj"];

        // assign this Request to this supervisor
        $emplObj = null;
        if ($crmEmplObj) {
            $crmEmplObj->assignMeAsRequestInvestigator($this, $lang);
            $emplObj = $crmEmplObj->hetEmployee();
        }
        // else die("<pre>CrmEmployee::assignBestAvailableInvestigator() returned object : ". var_export($crmRes, true)."</pre>");

        if ($pbm) {
            if ($emplObj) return array("", $this->tm("request has beeen assigned to ") . $emplObj->getDisplay($lang));
            else return array($this->tm("no more available investigators in the system") . " ORG-ID = $orgunit_id", "");
        }

        return $emplObj;
    }


    public function assignAuthenticatedUserAsInvestigator($lang = "ar")
    {
        $objme = AfwSession::getUserConnected();

        $authenticated_employee_id = ($objme) ? $objme->getEmployeeId() : 0;

        $crmEmplObj = CrmEmployee::auserCrmEmployee($authenticated_employee_id);

        $emplObj = null;
        if ($crmEmplObj) {
            $crmEmplObj->assignMeAsRequestInvestigator($this, $lang);
            $emplObj = $crmEmplObj->hetEmployee();
        }
        // else die("<pre>CrmEmployee::assignBestAvailableInvestigator() returned object : ". var_export($crmRes, true)."</pre>");

        return $emplObj;
    }


    public function getInvestigators()
    {
        if (!$this->getVal("orgunit_id")) return array();
        return CrmEmployee::getInvestigatorList($this->getVal("orgunit_id"), 0); // $this->getVal("employee_id")
    }


    protected function afwCall($name, $arguments)
    {
        if (substr($name, 0, 13) == "assignRequest") {
            $employeeId = intval(substr($name, 13));
            return $this->assignRequest($employeeId, $arguments[0]);
        }

        return false;
        // the above return should be keeped if not treated
    }

    public function isEsayAttribute($attribute)
    {
        $my_attribs = ["xxx", "yyyy"];
        if (in_array($attribute,  $my_attribs)) return false;
        else  return true;
    }


    public static function inboxCountFor($employee_id)
    {
        $obj = new Request();
        $obj->where("(employee_id = $employee_id and status_id in (" . Request::$REQUEST_STATUSES_ONGOING_INVESTIGATOR . ")) 
                         or (supervisor_id = $employee_id and status_id in (" . Request::$REQUEST_STATUSES_ONGOING_SUPERVISOR . "))");
        return $obj->count();
    }

    public function isLourde()
    {
        return true;
    }



    public function iamTheSuperAdmin()
    {
        return CrmObject::userConnectedIsSuperAdmin();
    }



    public function calcUl_cl_files()
    {
        global $lang;

        $pfiles_arr = $this->getFiles();
        $html = "<ul class=\"smooth-dots\">";
        foreach ($pfiles_arr as $pfileObj) {
            if ($pfileObj) {
                $p_title = AfwStringHelper::truncateArabicJomla($pfileObj->getVal("description"), 30);
                $fileObj = $pfileObj->hetFile();
                if ($fileObj) {
                    $a_li = $fileObj->getFormuleResult("download_light");
                    $a_li = str_replace('[title]', $p_title, $a_li);
                    $html .= "<li class='smooth-active'>$a_li $p_title</li>";
                }
            }
        }

        $link2_title = $this->getVal("link2_title");
        $link2 = $this->getVal("link2");
        $link1_title = $this->getVal("link1_title");
        $link1 = $this->getVal("link1");

        if ($link1) $html .= "<li class='smooth-active'>" . str_replace('[title]', $link1_title, AfwHtmlHelper::getLightDownloadUrl($link1, "link")) . "</li>";
        if ($link2) $html .= "<li class='smooth-active'>" . str_replace('[title]', $link2_title, AfwHtmlHelper::getLightDownloadUrl($link2, "link")) . "</li>";

        $html .= "</ul>";
        return $html;
    }


    public static function inboxSqlCond($role, $employee_id, $prefix = "me.")
    {
        if ($role == "supervisor") return "${prefix}supervisor_id='$employee_id' and ${prefix}status_id in (2, 3, 301)";
        if ($role == "investigator") return "${prefix}employee_id='$employee_id' and ${prefix}status_id in (2, 201, 4) ";
    }

    public function maxRecordsUmsCheck()
    {
        return 0;
    }


    public function calcChez_supervisor()
    {
        $status_reel_id = intval($this->getVal("status_id"));
        if ($status_reel_id == self::$REQUEST_STATUS_SENT) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_REDIRECT) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) return 1;

        return 0;
    }

    public function calcChez_customer()
    {
        $status_reel_id = intval($this->getVal("status_id"));
        if ($status_reel_id == self::$REQUEST_STATUS_DRAFT) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_MISSED_INFO) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_MISSED_FILES) return 1;

        return 0;
    }

    public function calcChez_investigator()
    {
        $status_reel_id = intval($this->getVal("status_id"));
        if ($status_reel_id == self::$REQUEST_STATUS_ASSIGNED) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_ONGOING) return 1;

        return 0;
    }

    public function calcChez_archive()
    {
        $status_reel_id = intval($this->getVal("status_id"));
        if ($status_reel_id == self::$REQUEST_STATUS_DONE) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_CANCELED) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_CLOSED) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_REJECTED) return 1;
        if ($status_reel_id == self::$REQUEST_STATUS_IGNORED) return 1;

        return 0;
    }

    protected function beforeSetAttribute($attribute, $newvalue)
    {
        $oldvalue = $this->getVal($attribute);

        if ($attribute == "employee_id") {
            if ($oldvalue and (!$newvalue)) {
                echo "before set attribute $attribute from '$oldvalue' to '$newvalue'";
                return false;
            }
        }

        return true;
    }

    public static function styleBar($code, $value)
    {
        if ($value < 2)   return "color:#B5E61D; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 2.7) return "color:#22B14C; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 3.4) return "color:#008000; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 4)   return "color:#0000FF; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 5)   return "color:#B66B3A; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 6)   return "color:#B66B3A; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 7)   return "color:#FFA500; fill-opacity: 0.2;  stroke-width: 0";
        if ($value < 8)   return "color:#E85C00; fill-opacity: 0.2;  stroke-width: 0";
        return "color:red; fill-opacity: 0.2;  stroke-width: 0";
    }



    /*
        public function instanciated($numInstance)
        {
            //_back_ trace()
            if($numInstance>400)
            {
              AfwRunHelper::lightSafeDie("trop dinstances $numInstance", $this);
            }
            return true;
        }*/



    public function shouldBeCalculatedField($attribute)
    {
        if ($attribute == "mobile") return true;
        if ($attribute == "email") return true;
        return false;
    }

    public function myShortNameToAttributeName($attribute)
    {
        if ($attribute == "type") return "request_type_id";
        if ($attribute == "region") return "region_id";
        if ($attribute == "customer") return "customer_id";
        if ($attribute == "priority") return "request_priority";
        if ($attribute == "category") return "service_category_id";
        if ($attribute == "service") return "service_id";
        if ($attribute == "files") return "requestFileList";
        if ($attribute == "supervisor") return "supervisor_id";
        if ($attribute == "orgunit") return "orgunit_id";
        if ($attribute == "employee") return "man";
        if ($attribute == "status") return "status_id";
        if ($attribute == "sent") return "survey_sent";
        if ($attribute == "opened") return "survey_opened";
        if ($attribute == "responses") return "responseList";
        if ($attribute == "extresponses") return "doneResponseList";
        return $attribute;
    }


    public function myDisplayStatus()
    {
        return $this->calcMan("value", true);
    }

    public function list_of_status_action_enum()
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        return self::status_action()[$lang];
    }

    public static function status_action_by_code($code)
    {
        $codesArr = self::status_action()["code"];
        foreach($codesArr as $id => $codeItem)
        {
            if($codeItem==$code) return $id;
        }

        return 0;
    }
    
    public static function status_action()
    {
            $arr_list_of_status_action = array();
            

             
            
            

                    
            $arr_list_of_status_action["en"][1] = "remove last response";
            $arr_list_of_status_action["ar"][1] = "حذف آخر رد";
            $arr_list_of_status_action["code"][1] = "removeLastResponse";

            $arr_list_of_status_action["en"][2] = "Request send";
            $arr_list_of_status_action["ar"][2] = "إرسال الطلب";
            $arr_list_of_status_action["code"][2] = "sendRequest";

            $arr_list_of_status_action  ["en"][3] = "Request reset";
            $arr_list_of_status_action  ["ar"][3] = "تصفير الطلب";
            $arr_list_of_status_action["code"][3] = "resetRequestNew";

            $arr_list_of_status_action  ["en"][4] = "assign Request";
            $arr_list_of_status_action  ["ar"][4] = "اسناد الطلب";
            $arr_list_of_status_action["code"][4] = "assignRequest";

            $arr_list_of_status_action  ["en"][5] = "unAssign Request";
            $arr_list_of_status_action  ["ar"][5] = "الغاء اسناد الطلب";
            $arr_list_of_status_action["code"][5] = "unAssignRequest";

            $arr_list_of_status_action  ["en"][6] = "redirect Request";
            $arr_list_of_status_action  ["ar"][6] = "إعادة تحويل الطلب";
            $arr_list_of_status_action["code"][6] = "redirectRequest";

            $arr_list_of_status_action  ["en"][7] = "return Request To Investigator";
            $arr_list_of_status_action  ["ar"][7] = "إعادة الطلب للمنسق";
            $arr_list_of_status_action["code"][7] = "returnRequestToInvestigator";

            $arr_list_of_status_action  ["en"][8] = "start Request";
            $arr_list_of_status_action  ["ar"][8] = "بدأ العمل على الطلب";
            $arr_list_of_status_action["code"][8] = "startRequest";

            $arr_list_of_status_action  ["en"][9] = "done Request";
            $arr_list_of_status_action  ["ar"][9] = "تم الرد على العميل";
            $arr_list_of_status_action["code"][9] = "doneRequest";

            $arr_list_of_status_action  ["en"][10] = "cancel Request";
            $arr_list_of_status_action  ["ar"][10] = "العميل ألغى الطلب";
            $arr_list_of_status_action["code"][10] = "cancelRequest";

            $arr_list_of_status_action  ["en"][11] = "unClose Request";
            $arr_list_of_status_action  ["ar"][11] = "الغاء غلق الطلب";
            $arr_list_of_status_action["code"][11] = "unCloseRequest";

            $arr_list_of_status_action  ["en"][12] = "close Request";
            $arr_list_of_status_action  ["ar"][12] = "غلق الطلب";
            $arr_list_of_status_action["code"][12] = "closeRequest";

            $arr_list_of_status_action  ["en"][13] = "reject Request";
            $arr_list_of_status_action  ["ar"][13] = "رفض الطلب";
            $arr_list_of_status_action["code"][13] = "rejectRequest";

            $arr_list_of_status_action  ["en"][14] = "files Uploaded";
            $arr_list_of_status_action  ["ar"][14] = "تم رفع المرفقات";
            $arr_list_of_status_action["code"][14] = "filesUploaded";

            $arr_list_of_status_action  ["en"][15] = "data Completed";
            $arr_list_of_status_action  ["ar"][15] = "تم استكمال البيانات";
            $arr_list_of_status_action["code"][15] = "dataCompleted";

            $arr_list_of_status_action  ["en"][16] = "response Created Status Updated";
            $arr_list_of_status_action  ["ar"][16] = "تمت كتابة رد مع تغيير الحالة";
            $arr_list_of_status_action["code"][16] = "responseCreatedStatusUpdated";

            

            
            return $arr_list_of_status_action;
    } 
}
