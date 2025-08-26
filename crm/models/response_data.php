<?php


$file_dir_name = dirname(__FILE__);

// old include of afw.php

class ResponseData extends AFWObject
{

     public static $MY_ATABLE_ID = 3613;


     public static $DATABASE          = "";
     public static $MODULE              = "crm";
     public static $TABLE               = "response_data";
     public static $DB_STRUCTURE = null;

     public function __construct()
     {
          parent::__construct("response_data", "id", "crm");
          $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
          $this->DISPLAY_FIELD = "id";
          $this->ORDER_BY_FIELDS = "response_id, module_id, item_code";


          $this->UNIQUE_KEY = array('response_id', 'module_id', 'item_code');

          $this->showQeditErrors = true;
          $this->showRetrieveErrors = true;
     }

     public static function loadById($id)
     {
          $obj = new ResponseData();
          $obj->select_visibilite_horizontale();
          if ($obj->load($id)) {
               return $obj;
          } else return null;
     }



     public static function loadByMainIndex($response_id, $module_id, $item_code, $create_obj_if_not_found = false)
     {
          $obj = new ResponseData();
          if (!$response_id) $obj->_error("loadByMainIndex : response_id is mandatory field");
          if (!$module_id) $obj->_error("loadByMainIndex : module_id is mandatory field");
          if (!$item_code) $obj->_error("loadByMainIndex : item_code is mandatory field");


          $obj->select("response_id", $response_id);
          $obj->select("module_id", $module_id);
          $obj->select("item_code", $item_code);

          if ($obj->load()) {
               if ($create_obj_if_not_found) $obj->activate();
               return $obj;
          } elseif ($create_obj_if_not_found) {
               $obj->set("response_id", $response_id);
               $obj->set("module_id", $module_id);
               $obj->set("item_code", $item_code);

               $obj->insert();
               $obj->is_new = true;
               return $obj;
          } else return null;
     }


     public function getDisplay($lang = "ar")
     {
          if ($this->getVal("id")) return $this->getVal("id");
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
          $server_db_prefix = AfwSession::config("db_prefix", "default_db_");


          if ($id) {
               if ($id_replace == 0) {
                    // FK part of me - not deletable 


                    // FK part of me - deletable 


                    // FK not part of me - replaceable 



                    // MFK

               } else {
                    // FK on me 


                    // MFK


               }
               return true;
          }
     }
}
