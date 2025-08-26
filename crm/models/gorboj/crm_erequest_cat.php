<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_erequest_cat : crm_erequest_cat - أصناف الطلبات الالكترونية 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmErequestCat extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= "crm_erequest_cat"; 
        
        public static $DB_STRUCTURE = null; 
        
        public function __construct(){
		parent::__construct("crm_erequest_cat","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "crm_erequest_cat_name_ar";
                $this->ORDER_BY_FIELDS = "crm_erequest_cat_name_ar";
	}
}
?>