<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table gfiled_term : gfiled_term - المصطلحات المستعملة في مؤشر 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class GfieldTerm extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "bau"; 
        public static $TABLE			= ""; 
        public static $DB_STRUCTURE = null; 
        
        
        public function __construct(){
		parent::__construct("gfield_term","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "gfield_id,term_id";
	}
}
?>