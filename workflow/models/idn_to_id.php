<?php
class IdnToId extends AFWObject
{

    public static $MY_ATABLE_ID = 13932;

    public static $DATABASE        = "tvtc_workflow";
    public static $MODULE                = "workflow";
    public static $TABLE            = "idn_to_id";

    private static $array_conversion            = [];

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("idn_to_id", "id", "workflow");
        WorkflowIdnToIdAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new IdnToId();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }

    public static function convertToID($module_code, $country_id, $idn_type_id, $idn)
    {
        $code_idn = $module_code . "-" . $country_id . "-" . $idn_type_id . "-" . $idn;
        if (!self::$array_conversion[$code_idn]) {
            $objI2I = self::loadByMainIndex($module_code, $country_id, $idn_type_id, $idn, true);
            self::$array_conversion[$code_idn] = $objI2I->id;
            unset($objI2I);
        }
        return self::$array_conversion[$code_idn];
    }

    public static function loadByMainIndex($module_code, $country_id, $idn_type_id, $idn,$create_obj_if_not_found=false)
    {
       if (!$module_code) throw new AfwRuntimeException("module_code is mandatory for IdnToId::loadByMainIndex");
       if(!$country_id) throw new AfwRuntimeException("country_id is mandatory for IdnToId::loadByMainIndex");
       if (!$idn_type_id) throw new AfwRuntimeException("idn_type_id is mandatory for IdnToId::loadByMainIndex");
       if (!$idn) throw new AfwRuntimeException("idn is mandatory for IdnToId::loadByMainIndex");

       $obj = new IdnToId();
       $obj->select("module_code",$module_code);
       $obj->select("country_id",$country_id);
       $obj->select("idn_type_id",$idn_type_id);
       $obj->select("idn",$idn);

       if($obj->load())
       {
            if($create_obj_if_not_found) $obj->activate();
            return $obj;
       }
       elseif($create_obj_if_not_found)
       {
            $obj->set("module_code",$module_code);
            $obj->set("country_id",$country_id);
            $obj->set("idn_type_id",$idn_type_id);
            $obj->set("idn",$idn);

            $obj->insertNew();
            if(!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
       }
       else return null;
       
    }


    


    public function getScenarioItemId($currstep)
    {

        return 0;
    }


    public function getDisplay($lang = "ar")
    {
        return $this->getVal("name_$lang");
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


    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "tvtc_");

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
            return false;
        }
    }
}
