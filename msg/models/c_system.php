<?php

class CSystem extends MsgObject{

        public static $MY_ATABLE_ID=3602; 

        
	public static $DATABASE		= ""; 
     public static $MODULE		    = ""; 
     public static $TABLE			= ""; 
     public static $DB_STRUCTURE = null;
	
	public function __construct(){
		parent::__construct("c_system","id","msg");
          MsgCSystemAfwStructure::initInstance($this);      
	}
        
        public static function loadById($id)
        {
           $obj = new CSystem();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($code,$create_obj_if_not_found=false)
        {
           $obj = new CSystem();
           if(!$code) $obj->_error("loadByMainIndex : code is mandatory field");


           $obj->select("code",$code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("code",$code);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               $data = array($this->getVal("code"), $this->getVal("name"));
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
                       // sms.sender_config-النظام	c_system_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}sms.sender_config set c_system_id='$id_replace' where c_system_id='$id' ");

                        
                   
                   // MFK
                       // sms.customer-الأنظمة المستخدمة	c_system_mfk  
                        $this->execQuery("update ${server_db_prefix}sms.customer set c_system_mfk=REPLACE(c_system_mfk, ',$id,', ',') where c_system_mfk like '%,$id,%' ");

               }
               else
               {
                        // FK on me 
                       // sms.sender_config-النظام	c_system_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}sms.sender_config set c_system_id='$id_replace' where c_system_id='$id' ");

                        
                        // MFK
                       // sms.customer-الأنظمة المستخدمة	c_system_mfk  
                        $this->execQuery("update ${server_db_prefix}sms.customer set c_system_mfk=REPLACE(c_system_mfk, ',$id,', ',$id_replace,') where c_system_mfk like '%,$id,%' ");

                   
               } 
               return true;
            }    
	}
        
        
        public function attributeIsApplicable($attribute)
        {
              $fcount = $this->valfield_count();
              for($i=1;$i<=9;$i++)
              {
                      if(($attribute=="field${i}_name") or ($attribute=="field${i}_type"))
                      {
                            return ($fcount >= $i);
                      }
              }
              
              
             
             
              return true;
}       }
?>