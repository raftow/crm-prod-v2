<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_action : crm_action - اجراءات خدمة العملاء (مثل ارسال اشعار أو نداء خدمة معينة، الخ) 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmAction extends AFWObject{

     public static $MY_ATABLE_ID=3580; 


     // lookup Value List codes 

        
	public static $DATABASE		= ""; 
     public static $MODULE		    = "crm"; 
     public static $TABLE			= ""; 
     public static $DB_STRUCTURE = null; 
     
     
          public function __construct(){
               parent::__construct("crm_action","id","crm");
                    $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                    $this->DISPLAY_FIELD = "crm_action_name_ar";
                    $this->ORDER_BY_FIELDS = "lookup_code";
                    $this->IS_LOOKUP = true; 
                    $this->ignore_insert_doublon = true;
                    $this->UNIQUE_KEY = array('lookup_code');
                    
                    $this->showQeditErrors = true;
                    $this->showRetrieveErrors = true;
          }
        
          public static function loadById($id)
          {
               $obj = new CrmAction();
               $obj->select_visibilite_horizontale();
               if($obj->load($id))
               {
                    return $obj;
               }
               else return null;
          }
        
        
        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           $obj = new CrmAction();
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
               if($this->getVal("crm_action_name_$lang")) return $this->getVal("crm_action_name_$lang");
               $data = array();
               $link = array();
               


               
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
            
            
            if($id)
            {   
               if($id_replace==0)
               {
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 
                       // crm.action_policy-اجراء خدمة العملاء	crm_action_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set crm_action_id='$id_replace' where crm_action_id='$id' ");

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 
                       // crm.action_policy-اجراء خدمة العملاء	crm_action_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set crm_action_id='$id_replace' where crm_action_id='$id' ");

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}
?>