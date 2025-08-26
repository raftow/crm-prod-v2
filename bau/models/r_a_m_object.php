<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table r_a_m_object : r_a_m_object - كيانات 
// ------------------------------------------------------------------------------------
 
 
$file_dir_name = dirname(__FILE__); 
 
// old include of afw.php
 
class RAMObject extends AFWObject{
 
        public static $MY_ATABLE_ID=13701; 
        // إجراء إحصائيات حول كيانات 
        public static $BF_STATS_R_A_M_OBJECT = 103366; 
        // إدارة كيانات 
        public static $BF_QEDIT_R_A_M_OBJECT = 103361; 
        // إنشاء كيان 
        public static $BF_EDIT_R_A_M_OBJECT = 103360; 
        // الاستعلام عن كيان 
        public static $BF_QSEARCH_R_A_M_OBJECT = 103365; 
        // البحث في كيانات 
        public static $BF_SEARCH_R_A_M_OBJECT = 103364; 
        // عرض تفاصيل كيان 
        public static $BF_DISPLAY_R_A_M_OBJECT = 103363; 
        // مسح كيان 
        public static $BF_DELETE_R_A_M_OBJECT = 103362; 



        // AFIELD - حقل  
        public static $R_A_M_OBJECT_CATEGORY_AFIELD = 8; 
 
        // AFIELD_GROUP - مجموعة حقول  
        public static $R_A_M_OBJECT_CATEGORY_AFIELD_GROUP = 10; 
 
        // AROLE - صلاحية  
        public static $R_A_M_OBJECT_CATEGORY_AROLE = 5; 
 
        // ATABLE - جدول  
        public static $R_A_M_OBJECT_CATEGORY_ATABLE = 7; 
 
        // BFUNCTION - وظيفة  
        public static $R_A_M_OBJECT_CATEGORY_BFUNCTION = 6; 
 
        // JOBNAME - مسمى وظيفي  
        public static $R_A_M_OBJECT_CATEGORY_JOBNAME = 2; 
 
        // JOBROLE - دور وظيفي  
        public static $R_A_M_OBJECT_CATEGORY_JOBROLE = 3; 
 
        // MODULE - وحدة  
        public static $R_A_M_OBJECT_CATEGORY_MODULE = 4; 
 
        // ORGUNIT - إدارة  
        public static $R_A_M_OBJECT_CATEGORY_ORGUNIT = 1; 
 
        // SCENARIO_ITEM - علامة تبويبية  
        public static $R_A_M_OBJECT_CATEGORY_SCENARIO_ITEM = 9; 
 
        // USER_STORY - قصة مستخدم  
        public static $R_A_M_OBJECT_CATEGORY_USER_STORY = 11;
        
        // DOMAIN - قطاع أعمال  
        public static $R_A_M_OBJECT_CATEGORY_DOMAIN = 13; 
 
        // GOAL - هدف وظيفي  
        public static $R_A_M_OBJECT_CATEGORY_GOAL = 12;
        
        
        // GOAL_CONCERN - اهتمام بهدف  
        public static $R_A_M_OBJECT_CATEGORY_GOAL_CONCERN = 14;           
        
        
        public static $OBJECT_STRUCT_INFO = array(
                                1=> array(
                                     "module" =>"hrm",
                                     "table" =>"orgunit",
                                     "class" =>"Orgunit",
                                ),
                                
                                2=> array(
                                     "module" =>"sdd",
                                     "table" =>"jobsdd",
                                     "class" =>"Jobsdd",
                                ),
                                
                                3=> array(
                                     "module" =>"pag",
                                     "table" =>"jobrole",
                                     "class" =>"Jobrole",
                                ),
                                
                                4=> array(
                                     "module" =>"ums",
                                     "table" =>"module",
                                     "class" =>"Module",
                                ),
                                
                                5=> array(
                                     "module" =>"ums",
                                     "table" =>"arole",
                                     "class" =>"Arole",
                                ),
                                
                                6=> array(
                                     "module" =>"ums",
                                     "table" =>"bfunction",
                                     "class" =>"Bfunction",
                                ),
                                
                                7=> array(
                                     "module" =>"pag",
                                     "table" =>"atable",
                                     "class" =>"Atable",
                                ),
                                
                                8=> array(
                                     "module" =>"pag",
                                     "table" =>"afield",
                                     "class" =>"Afield",
                                ),
                                
                                9=> array(
                                     "module" =>"pag",
                                     "table" =>"scenario_item",
                                     "class" =>"ScenarioItem",
                                ),
                                
                                10=> array(
                                     "module" =>"pag",
                                     "table" =>"afield_group",
                                     "class" =>"AfieldGroup",
                                ),
                                
                                11=> array(
                                     "module" =>"bau",
                                     "table" =>"user_story",
                                     "class" =>"UserStory",
                                ),
                                
                                12=> array(
                                     "module" =>"bau",
                                     "table" =>"goal",
                                     "class" =>"Goal",
                                ),
                                
                                13=> array(
                                     "module" =>"pag",
                                     "table" =>"domain",
                                     "class" =>"Domain",
                                ),
                                
                                14=> array(
                                     "module" =>"bau",
                                     "table" =>"goal_concern",
                                     "class" =>"GoalConcern",
                                ),
                                
                      );
         
 
	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
                id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK),
 
 
		"parent_object_pk" => array("SHORTNAME" => parent, "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "MANDATORY" => false, "UTF8" => false, "TYPE" => "FK", "ANSWER" => r_a_m_object, "ANSMODULE" => bau, "DEFAULT" => 0),
		"object_category_enm" => array("SHORTNAME" => category, "SEARCH" => true, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => true, 
                                               "SIZE" => 32, "SEARCH-ADMIN" => true, "MANDATORY" => true, "UTF8" => false, 
                                               "TYPE" => "ENUM", "ANSWER" => "FUNCTION"),
		"object_type_id" => array("SHORTNAME" => type, "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, 
                                                "SIZE" => 40, "SEARCH-ADMIN" => true, "MANDATORY" => true, "UTF8" => false, 
                                                "TYPE" => "FK", "ANSWER" => r_a_m_object_type, "ANSMODULE" => bau, WHERE=>"object_category_enm=§object_category_enm§",
                                                "DEFAULT" => 0),
		
                generated_object_id => array("SEARCH" => true, "QSEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => false, "SIZE" => 32, "MANDATORY" => true, "UTF8" => false, "TYPE" => "INT"),

                "object_code" => array("SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 32, "SEARCH-ADMIN" => true, "MANDATORY" => true, "UTF8" => true, "TYPE" => "TEXT"),
		"object_name_ar" => array("SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 48, "SEARCH-ADMIN" => true, "MANDATORY" => true, "UTF8" => true, "TYPE" => "TEXT"),
		"object_name_en" => array("SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => false, "SIZE" => 48, "SEARCH-ADMIN" => true, "MANDATORY" => true, "UTF8" => false, "TYPE" => "TEXT"),
		"object_specification" => array("SEARCH" => true, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => false, "SIZE" => 255, "SEARCH-ADMIN" => true, "MANDATORY" => true, "UTF8" => true, "TYPE" => "TEXT"),
		"analysis_text_pk" => array("SHORTNAME" => analysis, "SEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => false, "SIZE" => 40, "MANDATORY" => true, "UTF8" => false, "TYPE" => "FK", "ANSWER" => ptext, "ANSMODULE" => bau, "DEFAULT" => 0),

                childList => array(TYPE => FK, ANSWER => r_a_m_object, ANSMODULE => bau, CATEGORY => ITEMS, ITEM => 'parent_object_pk', WHERE=>'', 
                                            SHOW => true, 
                                            FORMAT=>tree, 
                                            LINK_COL=>parent_object_pk, 
                                            ITEMS_COL=>childList,
                                            FEUILLE_COL =>childList,
                                            ALL_ITEMS=>true,
                                            FEUILLE_COND_METHOD => hasNoChild,
                                            EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, 
                                            BUTTONS=>true, 
                                            ),
                
               
                id_aut => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                date_aut => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                id_mod => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                date_mod => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                id_valid => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                date_valid => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                avail => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, "DEFAULT" => 'Y', TYPE => YN),
                version => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => INT),
                update_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
 
	*/ public function __construct(){
		parent::__construct("r_a_m_object","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "object_code";
                $this->ORDER_BY_FIELDS = "parent_object_pk, object_category_enm, object_type_id, object_code";
 
 
                $this->UNIQUE_KEY = array('parent_object_pk','object_category_enm','object_type_id','object_code');
 
	}
        
        public static function loadById($id)
        {
           $obj = new RAMObject();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
 
 
 
        public static function loadByMainIndex($parent_object_pk, $object_category_enm, $object_type_id, $object_code,$create_obj_if_not_found=false)
        {
           $obj = new RAMObject();
           if(!$parent_object_pk) $obj->_error("loadByMainIndex : parent_object_pk is mandatory field");
           if(!$object_category_enm) $obj->_error("loadByMainIndex : object_category_enm is mandatory field");
           if(!$object_type_id) $obj->_error("loadByMainIndex : object_type_id is mandatory field");
           if(!$object_code) $obj->_error("loadByMainIndex : object_code is mandatory field");
 
 
           $obj->select("parent_object_pk",$parent_object_pk);
           $obj->select("object_category_enm",$object_category_enm);
           $obj->select("object_type_id",$object_type_id);
           $obj->select("object_code",$object_code);
 
           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("parent_object_pk",$parent_object_pk);
                $obj->set("object_category_enm",$object_category_enm);
                $obj->set("object_type_id",$object_type_id);
                $obj->set("object_code",$object_code);
 
                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
 
        }
        
        public function getNodeDisplay($lang="ar")
        {
	    /*
            $prefix = "";
            
            $obj_category_id = $this->getVal("category");
            if($obj_category_id==self::$R_A_M_OBJECT_CATEGORY_AFIELD)
            {
                $prefix = $this->translateOperator("FIELD",$lang)." ";
            }
            return $prefix.$this->getShortDisplay($lang);
            */
            
            return $this->getDisplay($lang);
        }
        
        
        public function getShortDisplay($lang="ar")
        {
                $lang = strtolower($lang);
                if($lang=="fr") $lang_suffix = "_en";
                else $lang_suffix = "_".$lang;
                
                $fn = trim($this->getVal("object_name$lang_suffix"));
                $fn .= "-".trim($this->getVal("object_code"));
                
                
                return $fn;
        }
        
                
        public function getDisplay($lang="ar")
        {
               
               
               $data = array();
               $link = array();
 
 
               //list($data[],$link[]) = $this->displayAttribute("object_category_enm",false, $lang);
               list($data[],$link[]) = $this->displayAttribute("object_type_id",false, $lang);
               
               
 
 
               return implode(" - ",$data)." - ".$this->getShortDisplay($lang);  //
        }
 
 
 
        public function list_of_object_category_enm() { 
            $list_of_items = array(); 
            $list_of_items[8] = "حقل";  //     code : AFIELD 
            $list_of_items[10] = "مجموعة حقول";  //     code : AFIELD_GROUP 
            $list_of_items[5] = "صلاحية";  //     code : AROLE 
            $list_of_items[7] = "جدول";  //     code : ATABLE 
            $list_of_items[6] = "وظيفة";  //     code : BFUNCTION 
            $list_of_items[2] = "مسمى وظيفي";  //     code : JOBNAME 
            $list_of_items[3] = "مسؤولية وظيفية";  //     code : JOBROLE 
            $list_of_items[4] = "وحدة";  //     code : MODULE 
            $list_of_items[1] = "إدارة";  //     code : ORGUNIT 
            $list_of_items[9] = "علامة تبويبية";  //     code : SCENARIO_ITEM 
            $list_of_items[11] = "قصة مستخدم";  //     code : USER_STORY
            $list_of_items[13] = "قطاع أعمال";  //     code : DOMAIN 
            $list_of_items[12] = "هدف وظيفي";  //     code : GOAL
            $list_of_items[14] = "اهتمام بهدف";  //     code : GOAL_CONCERN  
             
           return  $list_of_items;
        } 
 
 
 
 
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = array();
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
 
             if($mode=="mode_rAMObjectList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة كيانات ";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=RAMObject&currmod=bau&id_origin=$my_id&class_origin=RAMObject&module_origin=bau&newo=10&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=parent_object_pk=$my_id&sel_parent_object_pk=$my_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
 
 
 
             return $otherLinksArray;
        }
 
        protected function getPublicMethods()
        {
 
            $pbms = array();
 
            $color = "green";
            $title_ar = "تحديث عكسي للتحليل"; 
            $pbms["xc123B"] = array("METHOD"=>"reverseAnalysisFromInstance","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            $color = "red";
            $title_ar = "مسح الشجرة"; 
            $pbms["xab5cB"] = array("METHOD"=>"deleteChildsRecursive","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            

 
 
 
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
                       // bau.r_a_m_object-الكيان الأب	parent_object_pk  أنا تفاصيل لها-OneToMany
                        $this->execQuery("delete from ${server_db_prefix}bau.r_a_m_object where parent_object_pk = '$id' and avail='N'");
                        require_once "../bau/r_a_m_object.php";
                        $obj = new RAMObject();
                        $obj->where("parent_object_pk = '$id'");
                        $nbRecords = $obj->count();
                        if($nbRecords>0)
                        {
                            $this->deleteNotAllowedReason = "Used in some RAM objects(s) as parent";
                            return false;
                        }
 
 
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - deletable 
 
 
                   // FK not part of me - replaceable 
 
 
 
                   // MFK
 
               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 
                       // bau.r_a_m_object-الكيان الأب	parent_object_pk  أنا تفاصيل لها-OneToMany
                        $this->execQuery("update ${server_db_prefix}bau.r_a_m_object set parent_object_pk='$id_replace' where parent_object_pk='$id' ");
 
 
                        // MFK
 
 
               } 
               return true;
            }    
	}
        
        public function deleteChildsRecursive($lang="ar")
        {
               $childList = $this->get("childList");
               foreach($childList as $childItem)
               {
                    $childItem->deleteChildsRecursive($lang);
                    $childItem->delete(); 
               }
               
               return array("","");
        }
        
        public function reverseAnalysisFromInstance($lang="ar", $level=1, $max_level=4)
        {
                global $nb_instances, $heighest_level;
                
                if(!$heighest_level) $heighest_level = 1;
                
                if($heighest_level<$level) $heighest_level=$level;
                
                if(!$nb_instances) $nb_instances = 1;
                else $nb_instances++;
                
                
                
                $err_arr = array();
                $info_arr = array();
                
                $obj_category_id = $this->getVal("category");
                if(!$obj_category_id)
                {
                   return array("category not defined for this ram object","");
                }
                
                $gen_obj_id = $this->getVal("generated_object_id");
                if(!$gen_obj_id)
                {
                   return array("generated object not defined for this ram object","");
                }
                
                
                $file_dir_name = dirname(__FILE__);
                
                $gen_module = self::$OBJECT_STRUCT_INFO[$obj_category_id]["module"];
                $gen_table = self::$OBJECT_STRUCT_INFO[$obj_category_id]["table"];
                $gen_class = self::$OBJECT_STRUCT_INFO[$obj_category_id]["class"];
                
                if($nb_instances>700)
                {
                    return array("","");
                    //throw new AfwRuntimeException(" too much reverseAnalysis calls : $nb_instances ($gen_module,$gen_table,$gen_class) level=$level heighest_level=$heighest_level");
                }
                

                if((!$gen_class) or (!$gen_table) or (!$gen_module))
                {
                   return array("OBJECT_STRUCT_INFO[category=$obj_category_id] not defined ".var_export(self::$OBJECT_STRUCT_INFO,true),"");
                }
                
                if(!file_exists("$file_dir_name/../$gen_module/$gen_table.php"))
                {
                   return array("file $file_dir_name/../$gen_module/$gen_table.php not found","");     
                }
                
                require_once("$file_dir_name/../$gen_module/$gen_table.php");
                $gen_obj = new $gen_class();
                
                if(!$gen_obj->load($gen_obj_id))
                {
                  return array("object $obj_type ($gen_module,$gen_class) with id $gen_obj_id not found","");
                }

                list($obj_cat_id, $obj_type_id,$object_code,$object_name_ar,$object_name_en,$object_specification,$childs) = $gen_obj->getRAMObjectData();

                $this->set("object_type_id",$obj_type_id);
                $this->set("object_code",$object_code);
                $this->set("object_name_ar",$object_name_ar);
                $this->set("object_name_en",$object_name_en);
                $this->set("object_specification",$object_specification);
                $this->commit();
                $ram_obj_id = $this->getId();
                if(!$ram_obj_id)
                {
                   return array("parent ram object [$object_name_ar,$object_name_en] can't be null","");
                }
                if($level<=$max_level-1)
                {
                        foreach($childs as $child_cat => $childObjList)
                        {
                             foreach($childObjList as $childObj)
                             {
                                     list($child_item_category_id, $child_item_type_id,$child_item_code,$child_item_name_ar,
                                             $child_item_name_en,$child_item_specification,$child_item_childs) = $childObj->getRAMObjectData();
        
                                     if(!$child_item_category_id)  return array("child [$child_item_name_ar,$child_item_name_en] has no category","");
                                     if(!$child_item_type_id) return array("child [$child_item_name_ar,$child_item_name_en] has no type","");
                                     if(!$child_item_code) return array("child [$child_item_name_ar,$child_item_name_en] has no code","");
        
                
                                     if($child_cat==$child_item_category_id)
                                     {
                                             $ram_obj_child = self::loadByMainIndex($ram_obj_id, $child_item_category_id, $child_item_type_id, $child_item_code,$create_obj_if_not_found=true);
                                             $ram_obj_child->set("generated_object_id",$childObj->getId());
                                             $ram_obj_child->set("object_name_ar",$child_item_name_ar);
                                             $ram_obj_child->set("object_name_en",$child_item_name_en);
                                             $ram_obj_child->set("object_specification",$child_item_specification);
                                             $ram_obj_child->update();
                                             
                                             if($level>$max_level-1)
                                             { 
                                                     throw new AfwRuntimeException("big reverse analysis level : $level ($gen_module,$gen_table,$gen_class) going to categ ==> $child_item_category_id");
                                                     return array("","");
                                             }
                                             if($level<$max_level-1)
                                             {
                                                     list($err,$info) = $ram_obj_child->reverseAnalysisFromInstance($lang,$level+1,$max_level);
                                                     if($err) $err_arr[] = $err;
                                                     if($info) $info_arr[] = $info;
                                                     else $info_arr[] =  "$ram_obj_child -> reverseAnalysisFromInstance($lang,$level+1,$max_level)";
                                             }
                                     }
                                     else
                                     {
                                             $err_arr[] = "for object $childObj unexpected ram category $child_item_category_id expected is $child_cat";
                                     }
                             }
                             
                        }
                }
                return array(implode("<br>\n",$err_arr),implode("<br>\n",$info_arr));
        }
        
        public function getFullId()
        {
           $moduleName = $this->getMyModule();
           $className = $this->getMyClass();
           $myId = $this->getId();
           $obj_category_id = $this->getVal("category");
           $generated_object_id = $this->getVal("generated_object_id");
           
           $gen_module = self::$OBJECT_STRUCT_INFO[$obj_category_id]["module"];
           $gen_class = self::$OBJECT_STRUCT_INFO[$obj_category_id]["class"];
           
           return "$moduleName-$className-$myId:$gen_module-$gen_class-$generated_object_id";
        }        
        
        public function hasNoChild()
        {
            $countChilds = count($this->get("childList"));
            
            return ($countChilds==0);
        }
        
        public function getIconType()
        {
            $obj_category_id = $this->getVal("category");
            if(!$obj_category_id)
            {
                 return "unkown";
            }
            
            
            if($obj_category_id==self::$R_A_M_OBJECT_CATEGORY_MODULE)
            {
                 $object_type_id = $this->getVal("object_type_id");
                 
                 if(!$object_type_id)
                 {
                      $gen_table = self::$OBJECT_STRUCT_INFO[$obj_category_id]["table"];
                 }
                 else
                 {
                      $gen_table = $this->get("object_type_id")->getVal("lookup_code");
                 }
                   
            
            }
            else
            {
                 $gen_table = self::$OBJECT_STRUCT_INFO[$obj_category_id]["table"];            
            }
            return $gen_table;
        }        
 
}
?>