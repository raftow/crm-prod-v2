<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class IntelligentContent extends ContentElement
{

    public static $MY_ATABLE_ID = 13940;
    // إحصائيات المحتويات 
    public static $BF_STATS_INTELLIGENT_CONTENT = 104849;
    // إدارة المحتويات 
    public static $BF_QEDIT_INTELLIGENT_CONTENT = 104844;
    // إنشاء  الذكية 
    public static $BF_EDIT_INTELLIGENT_CONTENT = 104843;
    // البحث في المحتويات 
    public static $BF_SEARCH_INTELLIGENT_CONTENT = 104847;
    // المحتويات 
    public static $BF_QSEARCH_INTELLIGENT_CONTENT = 104848;
    // عرض تفاصيل  الذكية 
    public static $BF_DISPLAY_INTELLIGENT_CONTENT = 104846;
    // مسح  الذكية 
    public static $BF_DELETE_INTELLIGENT_CONTENT = 104845;

    public static $DATABASE        = "pmu_workflow";
    public static $MODULE                = "workflow";
    public static $TABLE            = "intelligent_content";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("intelligent_content", "id", "workflow");
        WorkflowIntelligentContentAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new IntelligentContent();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }



    public function getScenarioItemId($currstep)
    {

        return 0;
    }

    public static function loadByMainIndex($module_id, $lookup_code, $create_obj_if_not_found = false)
    {
        if (!$module_id) throw new AfwRuntimeException("loadByMainIndex : module_id is mandatory field");
        if (!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


        $obj = new IntelligentContent();
        $obj->select("module_id", $module_id);
        $obj->select("lookup_code", $lookup_code);

        if ($obj->load()) {
            if ($create_obj_if_not_found) $obj->activate();
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("module_id", $module_id);
            $obj->set("lookup_code", $lookup_code);

            $obj->insertNew();
            if (!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else return null;
    }


    public function getDisplay($lang = "ar")
    {
        return $this->getVal("name_$lang");
    }



    /*        public function list_of_content_type_enum() { 
            $list_of_items = array(); 
            $list_of_items[1] = "";  //     code : ... not defined ... 
           return  $list_of_items;
        } 


*/

    protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
    {
        global $lang;
        // $objme = AfwSession::getUserConnected();
        // $me = ($objme) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id = $this->getId();
        $displ = $this->getDisplay($lang);



        // check errors on all steps (by default no for optimization)
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
    }

    protected function getMyPublicMethods()
    {
        $pbms = array();

        $color = "green";
        $title_ar = "أضفني كمحتوى مستقل";
        $methodName = "AddMeAsContent";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));



        return $pbms;
    }




    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "pmu_");

        if (!$id) {
            $id = $this->getId();
            $simul = true;
        } else {
            $simul = false;
        }

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable 


                // FK part of me - deletable 


                // FK not part of me - replaceable 
                // workflow.content_item-محتوى الذكي	intelligent_content_id  حقل يفلتر به
                if (!$simul) {
                    // require_once "../workflow/content_item.php";
                    ContentItem::updateWhere(array('intelligent_content_id' => $id_replace), "intelligent_content_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}workflow.content_item set intelligent_content_id='$id_replace' where intelligent_content_id='$id' ");
                }



                // MFK

            } else {
                // FK on me 
                // workflow.content_item-محتوى الذكي	intelligent_content_id  حقل يفلتر به
                if (!$simul) {
                    // require_once "../workflow/content_item.php";
                    ContentItem::updateWhere(array('intelligent_content_id' => $id_replace), "intelligent_content_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}workflow.content_item set intelligent_content_id='$id_replace' where intelligent_content_id='$id' ");
                }


                // MFK


            }
            return true;
        }
    }

    public function AddMeAsContentItemIn($content_id, $lookup_code, $lang = "ar")
    {
        $obj = ContentItem::loadByMainIndex($content_id, self::$content_type_icontent, 0, 0, $this->id, $lookup_code, true);
        return ["", "publication content item object created with id = " . $obj->id];
    }

    public function proposeLookupCode()
    {
        return $this->getVal("lookup_code");
    }

    public function AddMeAsContent($lang = "ar")
    {
        $icontent_lookup_code = $this->getVal("lookup_code");
        $objContent = Content::loadByMainIndex($icontent_lookup_code, true);
        $objContent->set("name_en", $this->getVal("name_en"));
        $objContent->set("name_ar", $this->getVal("name_ar"));
        $objContent->commit();
        return $this->AddMeAsContentItemIn($objContent->id, $icontent_lookup_code, $lang);
    }

    public function getTokens($lang)
    {
        $icontent_module_code = UmsManager::decodeModuleCodeOrIdToModuleCode($this->getVal("module_id"));
        $icontent_lookup_code = $this->getVal("lookup_code");
        $file_dir_name = dirname(__FILE__); 
        $icontent_full_path_name = "$file_dir_name/../../$icontent_module_code/content/icontent_$icontent_lookup_code.php";
        if(!file_exists($icontent_full_path_name))
        {
            throw new AfwRuntimeException("intelligent content php file $icontent_full_path_name not found");
        }
        $tokens = include($icontent_full_path_name);
        if(count($tokens)==0)
        {
            throw new AfwRuntimeException("intelligent content php file $icontent_full_path_name returned empty tokens array");
        }
        $tokens['title'] = $this->getVal("name_$lang");
        // $tokens['description'] = $this->getVal("description"); it is technical no sens to show it in content
        // die("intelligent content php file $icontent_full_path_name returned tokens = ".var_export($tokens,true));
        return $tokens;
    }


    
}



// errors 
