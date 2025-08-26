<?php


$file_dir_name = dirname(__FILE__);

// old include of afw.php

class ResponseType extends CrmObject
{

     public static $MY_ATABLE_ID = 3572;


     // lookup Value List codes 

     // RESPONSE - إجابة  
     public static $RESPONSE_TYPE_RESPONSE = 1;

     // COMMENT - تعليق  
     public static $RESPONSE_TYPE_COMMENT = 2;

     // STATUS_CHANGE - طلب تغيير حالة التذكرة  
     public static $RESPONSE_TYPE_STATUS_CHANGE = 3;

     // EMPLOYEE_CHANGE - طلب تحويل إلى موظف آخر  
     public static $RESPONSE_TYPE_EMPLOYEE_CHANGE = 4;

     // QUESTION - طرح سؤال  
     public static $RESPONSE_TYPE_QUESTION = 5;

     // DUPLICATED - إلغاء الطلب بسبب التكرار  
     public static $RESPONSE_TYPE_DUPLICATED = 6;

     // INTERNAL_COMMENT - تحرير معلومات داخلية لغاية تدريب الزملاء
     public static $RESPONSE_TYPE_INTERNAL_COMMENT = 7;

     // COMPLETE - استكمال البيانات
     public static $RESPONSE_TYPE_COMPLETE = 12;

     public static $RESPONSE_TYPES_ARE_TO_APPROVE = "1,2";

     public static $RESPONSE_TYPES_ARE_PURE_ACTIONS = "3,6";







     public static $DATABASE          = "";
     public static $MODULE              = "crm";
     public static $TABLE               = "response_type";

     public static $DB_STRUCTURE = null;



     public function __construct()
     {
          parent::__construct("response_type", "id", "crm");
          $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
          $this->DISPLAY_FIELD = "name_ar";
          $this->ORDER_BY_FIELDS = "lookup_code";
          $this->IS_LOOKUP = true;
          $this->ignore_insert_doublon = true;
          $this->UNIQUE_KEY = array('lookup_code');

          $this->showQeditErrors = true;
          $this->showRetrieveErrors = true;
          $this->public_display = true;
     }

     public static function loadById($id)
     {
          $obj = new ResponseType();
          $obj->select_visibilite_horizontale();
          if ($obj->load($id)) {
               return $obj;
          } else return null;
     }



     public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
     {
          $obj = new ResponseType();
          if (!$lookup_code) $obj->_error("loadByMainIndex : lookup_code is mandatory field");


          $obj->select("lookup_code", $lookup_code);

          if ($obj->load()) {
               if ($create_obj_if_not_found) $obj->activate();
               return $obj;
          } elseif ($create_obj_if_not_found) {
               $obj->set("lookup_code", $lookup_code);

               $obj->insert();
               $obj->is_new = true;
               return $obj;
          } else return null;
     }


     public function getDisplay($lang = "ar")
     {
          if ($this->getVal("name_$lang")) return $this->getVal("name_$lang");
          $data = array();
          $link = array();




          return implode(" - ", $data);
     }





     protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
     {
          global $me, $objme, $lang;
          $otherLinksArray = array();
          $my_id = $this->getId();
          $displ = $this->getDisplay($lang);



          return $otherLinksArray;
     }

     protected function getPublicMethods()
     {

          $pbms = array();

          $color = "green";
          $title_ar = "xxxxxxxxxxxxxxxxxxxx";
          //$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");



          return $pbms;
     }


     public function beforeDelete($id, $id_replace)
     {


          if ($id) {
               if ($id_replace == 0) {
                    $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - not deletable 


                    $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - deletable 


                    // FK not part of me - replaceable 
                    // crm.response-نوع الرد	response_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.response set response_type_id='$id_replace' where response_type_id='$id' ");



                    // MFK

               } else {
                    $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK on me 
                    // crm.response-نوع الرد	response_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.response set response_type_id='$id_replace' where response_type_id='$id' ");


                    // MFK


               }
               return true;
          }
     }
}
