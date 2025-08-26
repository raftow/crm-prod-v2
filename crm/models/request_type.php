<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table request_type : request_type - أنواع الطلبات الالكترونية 
// ------------------------------------------------------------------------------------


$file_dir_name = dirname(__FILE__);

// old include of afw.php

class RequestType extends CrmObject
{

     public static $MY_ATABLE_ID = 13455;


     // lookup Value List codes 


     public static $DATABASE          = "";
     public static $MODULE              = "crm";
     public static $TABLE               = "request_type";
     public static $DB_STRUCTURE = null;

     public function __construct()
     {
          parent::__construct("request_type", "id", "crm");
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
          $obj = new RequestType();
          $obj->select_visibilite_horizontale();
          if ($obj->load($id)) {
               return $obj;
          } else return null;
     }

     public static function loadAll()
     {
          $obj = new RequestType();
          $obj->select("active", 'Y');

          $objList = $obj->loadMany();

          return $objList;
     }



     public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
     {
          $obj = new RequestType();
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

          $data = array();
          $link = array();


          if ($lang == "ar") list($data[0], $link[0]) = $this->displayAttribute("name_ar", false, $lang);
          if ($lang == "en") list($data[0], $link[0]) = $this->displayAttribute("name_en", false, $lang);


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
                    // crm.request-نوع  الطلب	request_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set request_type_id='$id_replace' where request_type_id='$id' ");
                    // crm.action_policy-نوع  الطلب	request_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.action_policy set request_type_id='$id_replace' where request_type_id='$id' ");
                    // crm.request_path-نوع الطلب الالكتروني	request_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request_path set request_type_id='$id_replace' where request_type_id='$id' ");



                    // MFK

               } else {
                    $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK on me 
                    // crm.request-نوع  الطلب	request_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set request_type_id='$id_replace' where request_type_id='$id' ");
                    // crm.action_policy-نوع  الطلب	request_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.action_policy set request_type_id='$id_replace' where request_type_id='$id' ");
                    // crm.request_path-نوع الطلب الالكتروني	request_type_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request_path set request_type_id='$id_replace' where request_type_id='$id' ");


                    // MFK


               }
               return true;
          }
     }
}
