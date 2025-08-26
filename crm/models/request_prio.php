<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table request_prio : request_prio - العلاقات العامة 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class RequestPrio extends AFWObject{

        public static $MY_ATABLE_ID=13460; 
        // إدارة أولويات الطلبات 
        public static $BF_QEDIT_REQUEST_PRIO = 103246; 
        // عرض تفاصيل أولوية طلب 
        public static $BF_DISPLAY_REQUEST_PRIO = 103248; 
        // مسح أولوية طلب 
        public static $BF_DELETE_REQUEST_PRIO = 103247; 


 // lookup Value List codes 
        // HIGH_PRIO - أولوية عالية  
        public static $REQUEST_PRIO_HIGH_PRIO = 2; 

        // LOW_PRIO - أولوية منخفضة  
        public static $REQUEST_PRIO_LOW_PRIO = 4; 

        // NORMAL_PRIO - أولوية عادية  
        public static $REQUEST_PRIO_NORMAL_PRIO = 3; 

        // URGENT - أولوية قصوى  
        public static $REQUEST_PRIO_URGENT = 1; 


        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; 
   
   
   public function __construct(){
		parent::__construct("request_prio","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "request_prio_name_ar";
                $this->ORDER_BY_FIELDS = "lookup_code";
                $this->IS_LOOKUP = true; 
                $this->ignore_insert_doublon = true;
                $this->UNIQUE_KEY = array('lookup_code');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
                $this->public_display = true;
	}
        
        public static function loadById($id)
        {
           $obj = new RequestPrio();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadAll()
        {
           $obj = new RequestPrio();
           $obj->select("active",'Y');

           $objList = $obj->loadMany();
           
           return $objList;
        }

        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           $obj = new RequestPrio();
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
               if($this->getVal("request_prio_name_$lang")) return $this->getVal("request_prio_name_$lang");
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

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}
?>