<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of �table� response_template : response_template - نماذج الأجوبة 
// ------------------------------------------------------------------------------------


class ResponseTemplate extends AFWObject{

        public static $MY_ATABLE_ID=13827; 
        private static $ResponseTemplateGroupCache = [];
  
        public static $DATABASE		= "";
        public static $MODULE		        = "crm";        
        public static $TABLE			= "response_template";

        public static $DB_STRUCTURE = null; 
        
        public function __construct(){
            parent::__construct("response_template","id","crm");
                    $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                    $this->DISPLAY_FIELD = "title_ar";
                    // $this->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                    $this->ORDER_BY_FIELDS = "title_en";
                    $this->IS_LOOKUP = true;
			        $this->IS_SMALL_LOOKUP = true;
                    $this->AUDIT_DATA = true;
                    
                    $this->UNIQUE_KEY = array('title_en');
                    
                    $this->showQeditErrors = true;
                    $this->showRetrieveErrors = true;
                    $this->general_check_errors = true;
                    // $this->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
        }
        
        public static function loadById($id)
        {
           $obj = new ResponseTemplate();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadAll($response_type=0, $user_type=null)
        {
            $key = "all";
            if($response_type) 
            {
                $key = "rt$response_type";
                if($user_type) $key .= ".ut$user_type";
            }
            if(!self::$ResponseTemplateGroupCache[$key])
            {
                $server_db_prefix = AfwSession::config("db_prefix", "default_db_");
                $obj = new ResponseTemplate();
                $obj->select("active",'Y');
    
                if($response_type) 
                {
                   if($user_type) $cond_user_type = "lookup_code like '%$user_type%' and ";
                   else $cond_user_type = "";
                   $obj->where("(new_status in (select id from ".$server_db_prefix."crm.request_status where $cond_user_type response_type_mfk like '%,$response_type,%')) or ((new_status is null or new_status = 0) and ($response_type != 7))");
                }
               
    
                self::$ResponseTemplateGroupCache[$key] = $obj->loadMany();
            }
            
           
            return self::$ResponseTemplateGroupCache[$key];
        }
        
        
        
        public static function loadByMainIndex($title_en,$create_obj_if_not_found=false)
        {
           if(!$title_en) throw new AfwRuntimeException("loadByMainIndex : title_en is mandatory field");


           $obj = new ResponseTemplate();
           $obj->select("title_en",$title_en);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("title_en",$title_en);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               
               $data = array();
               $link = array();
               

               list($data["en"],$link["en"]) = $this->displayAttribute("title_en",false, $lang);
               list($data["ar"],$link["ar"]) = $this->displayAttribute("title_ar",false, $lang);

               
               return $data[$lang];
        }
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step = 'all')      
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
        
        public function isTechField($attribute) {
            return (($attribute=="created_by") or ($attribute=="created_at") or ($attribute=="updated_by") or ($attribute=="updated_at") or ($attribute=="validated_by") or ($attribute=="validated_at") or ($attribute=="version"));  
        }
        
        
        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","default_db_");
            
            if(!$id)
            {
                $id = $this->getId();
                $simul = true;
            }
            else
            {
                $simul = false;
            }
            
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 

                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}

    public function getTitle($lang)
    {
        if($lang=="ar") return $this->getVal("title_ar");
        else return $this->getVal("title_en");
    }


    public function getBody($lang, $implode)
    {
        if($lang=="ar") $return = $this->getVal("body_ar");
        else $return = $this->getVal("body_en");

        if($implode)
        {
            $return_arr = explode("\n",$return);
            $return = implode("|",$return_arr);
            return $return;
        }
        else return $return;
    }
             
}
?>