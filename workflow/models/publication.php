<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class Publication extends ContentElement
{

    public static $MY_ATABLE_ID = 13941;

    public static $DATABASE        = "pmu_workflow";
    public static $MODULE                = "workflow";
    public static $TABLE            = "publication";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("publication", "id", "workflow");
        WorkflowPublicationAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new Publication();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }



    public function getScenarioItemId($currstep)
    {

        return 0;
    }

    public static function loadByMainIndex($module_id, $name_ar, $create_obj_if_not_found = false)
    {
        if (!$module_id) throw new AfwRuntimeException("loadByMainIndex : module_id is mandatory field");
        if (!$name_ar) throw new AfwRuntimeException("loadByMainIndex : name_ar is mandatory field");


        $obj = new Publication();
        $obj->select("module_id", $module_id);
        $obj->select("name_ar", $name_ar);

        if ($obj->load()) {
            if ($create_obj_if_not_found) $obj->activate();
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("module_id", $module_id);
            $obj->set("name_ar", $name_ar);

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


        list($data[0], $link[0]) = $this->displayAttribute("title_ar", false, $lang);


        return implode(" - ", $data);
    }





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
                // workflow.content_item-�������	publication_id  ��� ����� ��
                if (!$simul) {
                    // require_once "../workflow/content_item.php";
                    ContentItem::removeWhere("publication_id='$id'");
                    // $this->execQuery("delete from ${server_db_prefix}workflow.content_item where publication_id = '$id' ");

                }




                // FK not part of me - replaceable 



                // MFK

            } else {
                // FK on me 
                // workflow.content_item-�������	publication_id  ��� ����� ��
                if (!$simul) {
                    // require_once "../workflow/content_item.php";
                    ContentItem::updateWhere(array('publication_id' => $id_replace), "publication_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}workflow.content_item set publication_id='$id_replace' where publication_id='$id' ");

                }



                // MFK


            }
            return true;
        }
    }

    public function getTokens($lang)
    {
        $tokens = [];
        $tokens["title"] = $this->getVal("title_$lang");
        $tokens["summary"] = $this->getVal("summary_$lang");
        $tokens["body"] = $this->getVal("desc_$lang");

        return $tokens;
    }

    public function proposeLookupCode()
    {
        return "publication-".$this->id;
    }

    public function AddMeAsContentItemIn($content_id, $lookup_code, $lang = "ar")
    {
        $obj = ContentItem::loadByMainIndex($content_id, self::$content_type_publication, $this->id, 0, 0, $lookup_code, true);
        return ["", "publication content item object created with id = " . $obj->id];
    }
}



// errors 
