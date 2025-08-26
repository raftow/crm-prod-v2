<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table service : service - الخدمات 
// ------------------------------------------------------------------------------------


$file_dir_name = dirname(__FILE__);

// old include of afw.php

class Service extends AFWObject
{

     public static $MY_ATABLE_ID = 3611;


     // lookup Value List codes 


     public static $DATABASE          = "";
     public static $MODULE              = "crm";
     public static $TABLE               = "service";

     public static $DB_STRUCTURE = null;

     public function __construct()
     {
          parent::__construct("service", "id", "crm");
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
          $obj = new Service();
          $obj->select_visibilite_horizontale();
          if ($obj->load($id)) {
               return $obj;
          } else return null;
     }



     public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
     {
          $obj = new Service();
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
          if (!$lang) $lang = "ar";

          $data = array();
          $link = array();

          list($data[0], $link[0]) = $this->displayAttribute("name_$lang", false, $lang);

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
                    // crm.request-الخدمة	service_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set service_id='$id_replace' where service_id='$id' ");



                    // MFK

               } else {
                    $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK on me 
                    // crm.request-الخدمة	service_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set service_id='$id_replace' where service_id='$id' ");


                    // MFK


               }
               return true;
          }
     }

     public function fld_CREATION_USER_ID()
     {
          return "created_by";
     }

     public function fld_CREATION_DATE()
     {
          return "created_at";
     }

     public function fld_UPDATE_USER_ID()
     {
          return "updated_by";
     }

     public function fld_UPDATE_DATE()
     {
          return "updated_at";
     }

     public function fld_VALIDATION_USER_ID()
     {
          return "validated_by";
     }

     public function fld_VALIDATION_DATE()
     {
          return "validated_at";
     }

     public function fld_VERSION()
     {
          return "version";
     }

     public function fld_ACTIVE()
     {
          return  "active";
     }

     public function isTechField($attribute)
     {
          return (($attribute == "created_by") or ($attribute == "created_at") or ($attribute == "updated_by") or ($attribute == "updated_at") or ($attribute == "validated_by") or ($attribute == "validated_at") or ($attribute == "version"));
     }
}
