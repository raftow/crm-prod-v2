<?
                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class PtextCat extends AFWObject{

	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
                id => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK"),

		
		"ptext_type_id" => array("IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "UTF8" => false, "TYPE" => "FK", "ANSWER" => ptext_type, "ANSMODULE" => bau, "DEFAULT" => 0),
		"titre_short" => array("IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "UTF8" => true, "SHORTNAME" => "title", "TYPE" => "TEXT"),
		"titre" => array("IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => false, "SIZE" => 255, "UTF8" => true, "TYPE" => "TEXT"),
                
                id_aut => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_aut => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                id_mod => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_mod => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                id_valid => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_valid => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                avail => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "DEFAULT" => "Y", "TYPE" => "YN"),
                version => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
                update_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                delete_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                display_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                sci_id => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "scenario_item", "ANSMODULE" => "pag"),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("ptext_cat","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "titre_short";
                $this->ORDER_BY_FIELDS = "ptext_type_id, titre_short";
                $this->IS_LOOKUP = true; 
                $this->ignore_insert_doublon = true;
	}
        
        public static function loadById($id)
        {
           $obj = new PtextCat();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadAll()
        {
           $obj = new PtextCat();
           $obj->select("active",'Y');

           $objList = $obj->loadMany();
           
           return $objList;
        }

        


        public function getDisplay($lang="ar")
        {
               return $this->getVal("titre_short");
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