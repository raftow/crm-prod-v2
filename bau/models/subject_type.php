<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table subject_type : subject_type - أنواع المفعول به 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class SubjectType extends AFWObject{

	public static $DATABASE		= ""; 
     public static $MODULE		    = "bau"; 
     public static $TABLE			= ""; 
     public static $DB_STRUCTURE = null; 
     
     public function __construct(){
		parent::__construct("subject_type","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "subject_type_name_ar";
                $this->ORDER_BY_FIELDS = "lookup_code";
                $this->IS_LOOKUP = true; 
                $this->ignore_insert_doublon = true;
                $this->UNIQUE_KEY = array('lookup_code');
                
	}
        
     public static function loadById($id)
     {
          $obj = new SubjectType();
          $obj->select_visibilite_horizontale();
          if($obj->load($id))
          {
               return $obj;
          }
          else return null;
     }
        
     public static function loadAll()
     {
           $obj = new SubjectType();
           $obj->select("active",'Y');

           $objList = $obj->loadMany();
           
           return $objList;
     }

        
     public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
     {
           $obj = new SubjectType();
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
          if($this->getVal("subject_type_name_$lang")) return $this->getVal("subject_type_name_$lang");
          $data = array();
          $link = array();
          

          list($data[0],$link[0]) = $this->displayAttribute("lookup_code",false, $lang);

          
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
             
}
?>