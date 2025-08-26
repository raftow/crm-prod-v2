<?php
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class GfieldCat extends AFWObject{

	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; 
	public static $DB_STRUCTURE = null; /* array(
		"id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "TYPE" => "PK"),
		"titre_short" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "UTF8" => true, "TYPE" => "TEXT", "SIZE" => 40),
		"titre" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "UTF8" => true, "TYPE" => "TEXT", "SIZE" => "TEXT", "SIZE" => 255),
		"gfield_type_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "TYPE" => "FK", "ANSWER" => "gfield_type"),


		"id_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
		"date_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"id_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
		"date_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"id_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
		"date_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"avail" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "DEFAULT" => "Y", "TYPE" => "YN"),
		"version" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
		"update_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "TYPE" => "MFK", "ANSMODULE" => "ums"),
		"delete_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "TYPE" => "MFK", "ANSMODULE" => "ums"),
		"display_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "TYPE" => "MFK", "ANSMODULE" => "ums"),
		"sci_id" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "scenario_item"),
	);
	
	*/ public function __construct($tablename="gfield_cat"){
		parent::__construct($tablename,"id","bau");
	}
}
?>