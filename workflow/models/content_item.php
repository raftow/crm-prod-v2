<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class ContentItem extends WorkflowObject
{

    public static $MY_ATABLE_ID = 13939;

    public static $DATABASE        = "pmu_workflow";
    public static $MODULE                = "workflow";
    public static $TABLE            = "content_item";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("content_item", "id", "workflow");
        WorkflowContentItemAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new ContentItem();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }



    public function getScenarioItemId($currstep)
    {

        return 0;
    }

    public function getTheItem()
    {
        $content_type_enum = $this->getVal("content_type_enum");
        switch($content_type_enum)
        {
            case self::$content_type_picture : return $this->het("workflow_file_id");
            case self::$content_type_banner : return $this->het("workflow_file_id");
            case self::$content_type_publication : return $this->het("publication_id");
            case self::$content_type_icontent : return $this->het("intelligent_content_id");
        }

        throw new AfwRuntimeException("Unknown content_type_enum=$content_type_enum in this content item Id : ".$this->id);
    }

    public static function loadByMainIndex($content_id, $content_type_enum, $publication_id, $workflow_file_id, $intelligent_content_id, $lookup_code, $create_obj_if_not_found = false)
    {
        if (!$content_id) throw new AfwRuntimeException("loadByMainIndex : content_id is mandatory field");
        if (!$content_type_enum) throw new AfwRuntimeException("loadByMainIndex : content_type_enum is mandatory field");


        $obj = new ContentItem();
        $obj->select("content_id", $content_id);
        $obj->select("content_type_enum", $content_type_enum);
        $obj->select("publication_id", $publication_id);
        $obj->select("workflow_file_id", $workflow_file_id);
        $obj->select("lookup_code", $lookup_code);

        if ($obj->load()) {
            if ($create_obj_if_not_found) $obj->activate();
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("content_id", $content_id);
            $obj->set("content_type_enum", $content_type_enum);
            $obj->set("publication_id", $publication_id);
            $obj->set("workflow_file_id", $workflow_file_id);
            $obj->set("intelligent_content_id", $intelligent_content_id);
            $obj->set("lookup_code", $lookup_code);

            $obj->insertNew();
            if (!$obj->id) return null; // means beforeInsert rejected insert operation
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

    protected function getPublicMethods()
    {

        $pbms = array();

        $color = "green";
        $title_ar = "xxxxxxxxxxxxxxxxxxxx";
        $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
        //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));



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



                // MFK

            } else {
                // FK on me 


                // MFK


            }
            return true;
        }
    }
}



// errors 
