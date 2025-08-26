<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_emrelation : crm_emrelation - العلاقات العامة 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmEmrelation extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= "crm_emrelation"; 
        
        public static $DB_STRUCTURE = null; 
        
        public function __construct(){
		parent::__construct("crm_emrelation","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "crm_emrelation_name";
                $this->ORDER_BY_FIELDS = "crm_emrelation_name";
	}
}
?>