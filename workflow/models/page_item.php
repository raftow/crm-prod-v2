<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class PageItem extends WorkflowObject
{

    public static $MY_ATABLE_ID = 13938;

    public static $DATABASE        = "pmu_workflow";
    public static $MODULE                = "workflow";
    public static $TABLE            = "page_item";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("page_item", "id", "workflow");
        WorkflowPageItemAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new PageItem();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }



    public function getScenarioItemId($currstep)
    {

        return 0;
    }


    public function getDisplay($lang = "ar")
    {
        return $this->getVal("name_$lang");
    }


    public function showMyHtml($lang, $module_code, $pageThemeObj)
    {
        $item_num = $this->getVal("item_num");
        $item_name_en = $this->getVal("name_en");
        $page_sectionObj = $this->het("page_section_id");
        if(!$page_sectionObj) return "<!-- page item : $item_num [$item_name_en] has no page section defined -->";
        /**
         * @var PageSection $page_sectionObj
         */
        return $page_sectionObj->showSectionHtml($lang, $module_code, $pageThemeObj);
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
