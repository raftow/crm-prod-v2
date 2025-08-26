<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table r_a_m_object_type : r_a_m_object_type - أنواع الكيانات 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class RAMObjectType extends AFWObject{

        public static $MY_ATABLE_ID=3510; 
        // إدارة أنواع الكيانات 
        public static $BF_QEDIT_R_A_M_OBJECT_TYPE = 103367; 
        // عرض تفاصيل نوع كيان 
        public static $BF_DISPLAY_R_A_M_OBJECT_TYPE = 103369; 
        // مسح نوع كيان 
        public static $BF_DELETE_R_A_M_OBJECT_TYPE = 103368; 


 // lookup Value List codes 

        
	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
                id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK),

		
		"lookup_code" => array("TYPE" => "TEXT", "SHOW" => true, "RETRIEVE"=>true, "EDIT" => true, "SIZE" => 64, "QEDIT" => true, SHORTNAME=>code),

		"object_category_enm" => array("SHORTNAME" => object, "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 32, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "MANDATORY" => true, "UTF8" => false, "TYPE" => "ENUM", "ANSWER" => "FUNCTION"),
		"object_type_name_ar" => array("SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 64, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "MANDATORY" => true, "UTF8" => true, "TYPE" => "TEXT"),
		"object_type_name_en" => array("SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 64, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "MANDATORY" => true, "UTF8" => false, "TYPE" => "TEXT"),
                avail => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => true, "QEDIT" => true, "DEFAULT" => 'Y', TYPE => YN),
                
                id_aut => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                date_aut => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                id_mod => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                date_mod => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                id_valid => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                date_valid => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                version => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => INT),
                update_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("r_a_m_object_type","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "object_type_name_ar";
                $this->ORDER_BY_FIELDS = "object_category_enm,lookup_code";
                $this->IS_LOOKUP = true; 
                $this->ignore_insert_doublon = true;
                $this->UNIQUE_KEY = array('lookup_code');
                
	}
        
        public static function loadById($id)
        {
           $obj = new RAMObjectType();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        public static function loadAll()
        {
           $obj = new RAMObjectType();
           $obj->select("active",'Y');

           $objList = $obj->loadMany();
           
           return $objList;
        }

        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           $obj = new RAMObjectType();
           if(!$lookup_code) $obj->_error("loadByMainIndex : lookup_code is mandatory field");


           $obj->select("lookup_code",$lookup_code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("lookup_code",$lookup_code);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               if($this->getVal("object_type_name_$lang")) return $this->getVal("object_type_name_$lang");
               $data = array();
               $link = array();
               

               list($data[0],$link[0]) = $this->displayAttribute("lookup_code",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        
        public function list_of_object_category_enm() { 
            $list_of_items = array(); 
            $list_of_items[8] = "حقل";  //     code : AFIELD 
            $list_of_items[10] = "مجموعة حقول";  //     code : AFIELD_GROUP 
            $list_of_items[5] = "صلاحية";  //     code : AROLE 
            $list_of_items[7] = "جدول";  //     code : ATABLE 
            $list_of_items[6] = "وظيفة";  //     code : BFUNCTION 
            $list_of_items[13] = "قطاع أعمال";  //     code : DOMAIN 
            $list_of_items[12] = "هدف وظيفي";  //     code : GOAL 
            $list_of_items[2] = "مسمى وظيفي";  //     code : JOBNAME 
            $list_of_items[3] = "دور وظيفي";  //     code : JOBROLE 
            $list_of_items[4] = "وحدة";  //     code : MODULE 
            $list_of_items[1] = "إدارة";  //     code : ORGUNIT 
            $list_of_items[9] = "علامة تبويبية";  //     code : SCENARIO_ITEM 
            $list_of_items[11] = "قصة مستخدم";  //     code : USER_STORY
            $list_of_items[14] = "اهتمام بهدف";  //     code : GOAL_CONCERN  
           return  $list_of_items;
        }  



        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
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
        
        
        public function beforeDelete($id,$id_replace) 
        {
         $server_db_prefix = AfwSession::config("db_prefix","default_db_");
            
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 
                       // bau.r_a_m_object-نوع الكيان	object_type_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}bau.r_a_m_object set object_type_id='$id_replace' where object_type_id='$id' ");

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 
                       // bau.r_a_m_object-نوع الكيان	object_type_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}bau.r_a_m_object set object_type_id='$id_replace' where object_type_id='$id' ");

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}
?>