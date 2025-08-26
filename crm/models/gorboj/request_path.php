<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table request_path : request_path - مسارات الطلبات الالكترونية 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class RequestPath extends CrmObject{

        public static $MY_ATABLE_ID=13459; 

        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; 
  
  
  public function __construct(){
		parent::__construct("request_path","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "orgunit_id, service_category_id, service_id, request_type_mfk, prio_min, prio_max, customer_type_mfk";
                 
                
                $this->UNIQUE_KEY = array('orgunit_id', 'service_category_id', 'service_id', 'request_type_mfk', 'prio_min', 'prio_max', 'customer_type_mfk');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
	}
        
        public static function loadById($id)
        {
           $obj = new RequestPath();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($prio_max,$create_obj_if_not_found=false)
        {
           $obj = new RequestPath();
           if(!$prio_max) $obj->_error("loadByMainIndex : prio_max is mandatory field");


           $obj->select("prio_max",$prio_max);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("prio_max",$prio_max);

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
               

               list($data[0],$link[0]) = $this->displayAttribute("program_id",false, $lang);
               list($data[1],$link[1]) = $this->displayAttribute("request_type_id",false, $lang);
               list($data[2],$link[2]) = $this->displayAttribute("prio_min",false, $lang);

               
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