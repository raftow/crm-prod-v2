<?php
// ------------------------------------------------------------------------------------
// 7/6/2022 rafik :
// alter table ".$server_db_prefix."crm.request_file change description description varchar(196);

$file_dir_name = dirname(__FILE__);

// old include of afw.php

class RequestFile extends AFWObject
{

        public static $MY_ATABLE_ID = 13748;
        // إجراء إحصائيات حول مرفقات المشاريع البحثية / التجارب 
        public static $BF_STATS_PRACTICE_FILE = 104091;
        // إدارة مرفقات المشاريع البحثية / التجارب 
        public static $BF_QEDIT_PRACTICE_FILE = 104086;
        // إنشاء مرفق ممارسة/تجربة 
        public static $BF_EDIT_PRACTICE_FILE = 104085;
        // الاستعلام عن مرفق ممارسة/تجربة 
        public static $BF_QSEARCH_PRACTICE_FILE = 104090;
        // البحث في مرفقات المشاريع البحثية / التجارب 
        public static $BF_SEARCH_PRACTICE_FILE = 104089;
        // عرض تفاصيل مرفق ممارسة/تجربة 
        public static $BF_DISPLAY_PRACTICE_FILE = 104088;
        // مسح مرفق ممارسة/تجربة 
        public static $BF_DELETE_PRACTICE_FILE = 104087;


        public static $DATABASE                = "";
        public static $MODULE                    = "crm";
        public static $TABLE                        = "request_file";
        public static $DB_STRUCTURE = null;



        public function __construct()
        {
                parent::__construct("request_file", "id", "crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "id";
                $this->ORDER_BY_FIELDS = "request_id, afile_id";


                $this->UNIQUE_KEY = array('request_id', 'afile_id');

                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;

                $this->after_save_edit = array("class" => 'Request', "attribute" => 'request_id', "currmod" => 'crm', "currstep" => 4);
        }

        public static function loadById($id)
        {
                $obj = new RequestFile();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }



        public static function loadByMainIndex($request_id, $afile_id, $create_obj_if_not_found = false)
        {
                $obj = new RequestFile();
                if (!$request_id) $obj->_error("loadByMainIndex : request_id is mandatory field");
                if (!$afile_id) $obj->_error("loadByMainIndex : afile_id is mandatory field");


                $obj->select("request_id", $request_id);
                $obj->select("afile_id", $afile_id);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("request_id", $request_id);
                        $obj->set("afile_id", $afile_id);

                        $obj->insert();
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }


        public function getDisplay($lang = "ar")
        {
                $data = array();
                $link = array();

                $fle = $this->hetFile();
                if ($fle) return $fle->getShortDisplay($lang);

                list($data[0], $link[0]) = $this->displayAttribute("id", false, $lang);


                return implode(" - ", $data);
        }





        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
                global $lang;
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
                return (($attribute == "creation_user_id") or ($attribute == "creation_date") or ($attribute == "update_user_id") or ($attribute == "update_date") or ($attribute == "validation_user_id") or ($attribute == "validation_date") or ($attribute == "version"));
        }

        public function beforeMAJ($id, $fields_updated)
        {
                if (!$this->getVal("doc_type_id")) {
                        /*
                           $prObj = $this->hetRequest();
                           if($prObj)
                           {
                          
                           }
                           */
                }

                return true;
        }


        public function beforeDelete($id, $id_replace)
        {


                if ($id) {
                        if ($id_replace == 0) {
                                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - not deletable 


                                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - deletable 


                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK on me 


                                // MFK


                        }
                        return true;
                }
        }


        public function userCanDeleteMeSpecial($auser)
        {
                $log = "";

                $prc = $this->hetRequest();
                if (!$prc) return true;
                /*
                if($prc->_isSubmitted()) $log .= "_isSubmitted";
                else $log .= "is not Submitted";
                
                if($this->getId() == 17) die("log : $log");
                */
                return (!$prc->estSubmitted());
        }

        protected function attributeCanBeEditedBy($attribute, $user, $desc)
        {
                $prcObj = $this->hetRequest();
                if ($prcObj->estSubmitted() and (!$desc["JUSTPROP"])) return array(false, "The request is submitted and $attribute is not setted as JUSTPROP (no impact)"); //  ($attribute!="approve_order") and ($attribute!="vote_order")

                return [true, ''];
        }

        public function myShortNameToAttributeName($attribute)
        {
                if ($attribute == "file") return "afile_id";

                
                
                return $attribute;
        }

        
}
