<?php
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class PtextType extends AFWObject{

	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
		"id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK"),

		"titre_short" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "UTF8" => true, "SIZE" => 40, "TYPE" => "TEXT"),
		"titre" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "UTF8" => true, "SIZE" => 255, "TYPE" => "TEXT"),

                default_child_type_id => array("IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "UTF8" => false, "TYPE" => "FK", "ANSWER" => ptext_type, "ANSMODULE" => bau, "DEFAULT" => 0),
                default_child_cat_id => array("IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "UTF8" => false, "TYPE" => "FK", "ANSWER" => ptext_cat, "ANSMODULE" => bau, "DEFAULT" => 0),


		"id_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "auser", "ANSMODULE" => "ums", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0),
		"date_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"id_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "auser", "ANSMODULE" => "ums", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0),
		"date_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"id_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "auser", "ANSMODULE" => "ums", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0),
		"date_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"avail" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "DEFAULT" => "Y", "TYPE" => "YN"),
		"version" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
		"update_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
		"delete_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
		"display_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
		"sci_id" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "scenario_item", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0)
	);
	
	*/ public function __construct($tablename="ptext_type"){
		parent::__construct($tablename,"id","bau");
                $this->ORDER_BY_FIELDS = "id";
	}
        
        public function getDisplay($lang="ar")
        {
                $id = trim($this->getId());
                $fn = "$id - ".trim($this->getVal("titre_short"));
                
                return $fn;
        } 
}
?>