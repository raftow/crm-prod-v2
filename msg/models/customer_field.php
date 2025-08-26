<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table customer_field : customer_field - بيانات العملاء 
// ------------------------------------------------------------------------------------


class CustomerField extends MsgObject{

        public static $MY_ATABLE_ID=3603; 

        
	public static $DATABASE		= ""; 
    public static $MODULE		    = ""; 
    public static $TABLE			= ""; 
    public static $DB_STRUCTURE = null;
	
	public function __construct(){
		parent::__construct("customer_field","id","msg");
        MsgCustomerFieldAfwStructure::initInstance($this);          
	}
        
        public static function loadById($id)
        {
           $obj = new CustomerField();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($customer_id, $c_system_id,$create_obj_if_not_found=false)
        {
           $obj = new CustomerField();
           if(!$customer_id) $obj->_error("loadByMainIndex : customer_id is mandatory field");
           if(!$c_system_id) $obj->_error("loadByMainIndex : c_system_id is mandatory field");


           $obj->select("customer_id",$customer_id);
           $obj->select("c_system_id",$c_system_id);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("customer_id",$customer_id);
                $obj->set("c_system_id",$c_system_id);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               if($this->getVal("id")) return $this->getVal("id");
               $data = array();
               $link = array();
               


               
               return implode(" - ",$data);
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
            global $server_db_prefix;
            
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
             
}
?>