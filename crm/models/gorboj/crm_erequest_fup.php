<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_erequest_fup : crm_erequest_fup - متابعات الطلبات الالكترونية 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmErequestFup extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= ""; 
        
        public static $DB_STRUCTURE = null; 
        
        
        
        public function __construct(){
		parent::__construct("crm_erequest_fup","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "fup_changes";
                $this->ORDER_BY_FIELDS = "fup_changes";
	}
}
?>