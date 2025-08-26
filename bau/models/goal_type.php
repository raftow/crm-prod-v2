<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table goal_type : goal_type - أنواع الأهداف 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class GoalType extends AFWObject{

        public static $MY_ATABLE_ID=13695; 
        // إدارة أنواع الأهداف 
        public static $BF_QEDIT_GOAL_TYPE = 102381; 
        // عرض تفاصيل نوع هدف 
        public static $BF_DISPLAY_GOAL_TYPE = 102383; 
        // مسح نوع هدف 
        public static $BF_DELETE_GOAL_TYPE = 102382; 
 
 
        // ADMINISTRATIONGOAL - هدف إدارة  
        public static $GOAL_TYPE_ADMINISTRATION_GOAL = 1; 
 
        // COMMONADMINISTRATIONGOAL - هدف إدارة مشترك  
        public static $GOAL_TYPE_COMMON_ADMINISTRATION_GOAL = 2; 
 
        // JOBRESPONSIBILITYGOAL - هدف مسؤولية وظيفية  
        public static $GOAL_TYPE_JOB_RESPONSIBILITY_GOAL = 3;
                
	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(

                id => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK"),

		
		"lookup_code" => array("TYPE" => "TEXT", "SHOW" => true, "RETRIEVE"=>true, "EDIT" => true, "SIZE" => 64, "QEDIT" => true, SHORTNAME=>code),

		"goal_type_name_ar" => array("IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 128, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => true, "TYPE" => "TEXT"),
		"goal_type_name_en" => array("IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 128, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => false, "TYPE" => "TEXT"),

                avail => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => true, "DEFAULT" => "Y", "TYPE" => "YN"),
                
                id_aut => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_aut => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                id_mod => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_mod => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                id_valid => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_valid => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                version => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
                update_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                delete_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                display_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                sci_id => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "scenario_item", "ANSMODULE" => "pag"),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("goal_type","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "goal_type_name_ar";
                $this->ORDER_BY_FIELDS = "lookup_code";
                $this->IS_LOOKUP = true; 
                $this->ignore_insert_doublon = true;
                $this->UNIQUE_KEY = array('lookup_code');
                
	}
        
        public static function loadById($id)
        {
           $obj = new GoalType();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadAll()
        {
           $obj = new GoalType();
           $obj->select("active",'Y');

           $objList = $obj->loadMany();
           
           return $objList;
        }

        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           $obj = new GoalType();
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
               if($this->getVal("goal_type_name_$lang")) return $this->getVal("goal_type_name_$lang");
               $data = array();
               $link = array();
               

               list($data[0],$link[0]) = $this->displayAttribute("lookup_code",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = array();
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             return $otherLinksArray;
        }
             
}
?>