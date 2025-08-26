<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_activity : crm_activity - نشاطات الجهات 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmActivity extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= "crm_activity"; 
        public static $DB_STRUCTURE = null; 
        
        public function __construct(){
		parent::__construct("crm_activity","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "crm_activity_name_ar";
                $this->ORDER_BY_FIELDS = "crm_activity_name_ar";
	}
}
?>