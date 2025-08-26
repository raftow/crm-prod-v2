<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table term : term - المصطلحات وتعريفها 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Term extends AFWObject{

	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
                "id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK"),

		"term_name" => array("IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 48, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => true, "TYPE" => "TEXT"),
		"definition_ptext_id" => array("IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "MANDATORY" => true, "AUTO-CREATE" => true,
                                               "AUTOCOMPLETE" => [
                                                                   "CREATE" => [
                                                                                "stakeholder_id" => array("CONST" => "3"),
                                                                		"module_id" => array("CONST" => "5"),
                                                                                "pdocument_id" => array("CONST" => "548"),
                                                                                "ptext_type_id" => array("CONST" => "3"),
                                                                		"ptext_cat_id" => array("CONST" => "10"),
                                                                		"author_id" => array("FIELD" => "author_id" ),     
                                                                		"titre_short" => array("INPUT" => true),
                                                                		"ntext" => array("FIELD" => "term_name", "CONST2" => "هو", "INPUT" => true),
                                                                		"ptext_status_id" => array("CONST" => "1"),
                                                                   ]
                                                                 ], 
                                               "UTF8" => false, "TYPE" => "FK", "ANSWER" => ptext, "DEFAULT" => 0, "WHERE" => "stakeholder_id=3 and module_id=5 and pdocument_id=548 and ptext_type_id=3 and ptext_cat_id=10"),
		"author_id" => array("IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => false, "TYPE" => "FK", "ANSWER" => auser, "DEFAULT" => 0),
                "id_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                "date_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
                "id_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                "date_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
                "id_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                "date_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
                "avail" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "DEFAULT" => "Y", "TYPE" => "YN"),
                "version" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
                "update_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "pag", "TYPE" => "MFK"),
                "delete_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "pag", "TYPE" => "MFK"),
                "display_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "pag", "TYPE" => "MFK"),
                "sci_id" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "scenario_item", "ANSMODULE" => "pag"),
	);
	
	*/ public function __construct(){
		parent::__construct("term","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "term_name";
                $this->ORDER_BY_FIELDS = "term_name";
	}
}
?>