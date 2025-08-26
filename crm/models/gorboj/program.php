<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table program : program - برامج خدمات العملاء 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Program extends AFWObject{

        public static $MY_ATABLE_ID=13464; 

        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; 
    
    
    public function __construct(){
		parent::__construct("program","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "";
                 
                
                
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
	}
        
        public static function loadById($id)
        {
           $obj = new Program();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        
        public function getDisplay($lang="ar")
        {
               
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
                       // crm.action_policy-برنامج خدمة العملاء	program_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set program_id='$id_replace' where program_id='$id' ");
                       // crm.request_path-برنامج خدمة العملاء	program_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.request_path set program_id='$id_replace' where program_id='$id' ");

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 
                       // crm.action_policy-برنامج خدمة العملاء	program_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set program_id='$id_replace' where program_id='$id' ");
                       // crm.request_path-برنامج خدمة العملاء	program_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.request_path set program_id='$id_replace' where program_id='$id' ");

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}
?>