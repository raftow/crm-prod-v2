<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table data_action : data_action - التصرفات في المعلومات 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class DataAction extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "bau"; 
        public static $TABLE			= ""; 
        public static $DB_STRUCTURE = null; 
        
        public function __construct(){
		parent::__construct("data_action","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "data_action_name";
                $this->ORDER_BY_FIELDS = "data_action_name";
                 
                
                
                
	}
        
        public static function loadById($id)
        {
           $obj = new DataAction();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
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