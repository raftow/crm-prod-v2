<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table action_policy : action_policy - سياسات متابعات تغير حالات الطلبات 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class ActionPolicy extends AFWObject{

        public static $MY_ATABLE_ID=3579; 

        
	public static $DATABASE		= ""; 
    public static $MODULE		    = "crm"; 
    public static $TABLE			= ""; 
    
    public static $DB_STRUCTURE = null; 
    
    
    public function __construct(){
		parent::__construct("action_policy","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "program_id, request_type_id, old_status_id, new_status_id, prio_min, prio_max, account_type_mfk";
                 
                
                $this->UNIQUE_KEY = array('program_id','request_type_id','old_status_id','new_status_id','prio_min','prio_max','account_type_mfk');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
	}
        
        public static function loadById($id)
        {
           $obj = new ActionPolicy();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($program_id, $request_type_id, $old_status_id, $new_status_id, $prio_min, $prio_max, $account_type_mfk,$create_obj_if_not_found=false)
        {
           $obj = new ActionPolicy();
           if(!$program_id) $obj->_error("loadByMainIndex : program_id is mandatory field");
           if(!$request_type_id) $obj->_error("loadByMainIndex : request_type_id is mandatory field");
           if(!$old_status_id) $obj->_error("loadByMainIndex : old_status_id is mandatory field");
           if(!$new_status_id) $obj->_error("loadByMainIndex : new_status_id is mandatory field");
           if(!$prio_min) $obj->_error("loadByMainIndex : prio_min is mandatory field");
           if(!$prio_max) $obj->_error("loadByMainIndex : prio_max is mandatory field");
           if(!$account_type_mfk) $obj->_error("loadByMainIndex : account_type_mfk is mandatory field");


           $obj->select("program_id",$program_id);
           $obj->select("request_type_id",$request_type_id);
           $obj->select("old_status_id",$old_status_id);
           $obj->select("new_status_id",$new_status_id);
           $obj->select("prio_min",$prio_min);
           $obj->select("prio_max",$prio_max);
           $obj->select("account_type_mfk",$account_type_mfk);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("program_id",$program_id);
                $obj->set("request_type_id",$request_type_id);
                $obj->set("old_status_id",$old_status_id);
                $obj->set("new_status_id",$new_status_id);
                $obj->set("prio_min",$prio_min);
                $obj->set("prio_max",$prio_max);
                $obj->set("account_type_mfk",$account_type_mfk);

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
               

               list($data[0],$link[0]) = $this->displayAttribute("prio_min",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        
        public function list_of_prio_min() { 
            $list_of_items = array(); 
            $list_of_items[2] = "أولوية عالية";  //     code : HIGH_PRIO 
            $list_of_items[4] = "أولوية منخفضة";  //     code : LOW_PRIO 
            $list_of_items[3] = "أولوية عادية";  //     code : NORMAL_PRIO 
            $list_of_items[1] = "أولوية قصوى";  //     code : URGENT 
           return  $list_of_items;
        } 


        public function list_of_prio_max() { 
            $list_of_items = array(); 
            $list_of_items[2] = "أولوية عالية";  //     code : HIGH_PRIO 
            $list_of_items[4] = "أولوية منخفضة";  //     code : LOW_PRIO 
            $list_of_items[3] = "أولوية عادية";  //     code : NORMAL_PRIO 
            $list_of_items[1] = "أولوية قصوى";  //     code : URGENT 
           return  $list_of_items;
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