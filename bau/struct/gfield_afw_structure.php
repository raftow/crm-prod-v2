<?php 

     
        class BauGfieldAfwStructure
        {
        
                public static function initInstance(&$obj)
                {
                        if ($obj instanceof Gfield ) 
                        {
                                $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                                $obj->DISPLAY_FIELD = "titre";
                                // $title = GfieldTranslator::translateAttribute("gfield.single","ar");
                                // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                                $obj->ORDER_BY_FIELDS = "titre";
                                 
                                $obj->AUDIT_DATA = true;
                                $obj->showQeditErrors = true;
                                $obj->showRetrieveErrors = true;
                                $obj->general_check_errors = true;
                                // $obj->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
                        }
                }
                
                
                public static $DB_STRUCTURE =  
        array(
                'id' => array('SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'),

		
		'gfield_name' => array('SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 5,  'CHAR_TEMPLATE' => "ARABIC-CHARS,SPACE",  'MANDATORY' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'parent_module_id' => array('SHORTNAME' => 'module',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  "ANSWER" => "module", 'ANSMODULE' => 'ums',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'titre_short' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 40,  'MAXLENGTH' => 48,  'MIN-SIZE' => 5,  'CHAR_TEMPLATE' => "ARABIC-CHARS,SPACE",  'MANDATORY' => true,  'UTF8' => true,  'SHORTNAME' => "title",  
				'TYPE' => 'TEXT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'titre' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 255,  'MAXLENGTH' => 48,  'MIN-SIZE' => 5,  'CHAR_TEMPLATE' => "ARABIC-CHARS,SPACE",  'MANDATORY' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'id_atable' => array('SHORTNAME' => 'atable',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 40,  'MAXLENGTH' => 40,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  "ANSWER" => "atable", 'ANSMODULE' => 'pag', 
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'atable_mfk' => array('SHORTNAME' => 'atables',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'MFK',  'ANSWER' => 'atable',  'ANSMODULE' => 'pag',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'id_theme' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 40,  'MAXLENGTH' => 40,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  "ANSWER" => "theme", 'ANSMODULE' => 'bau',
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'gfield_type_id' => array('SHORTNAME' => 'type',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'gfield_type',  'ANSMODULE' => 'bau',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'gfield_cat_id' => array('SHORTNAME' => 'cat',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'gfield_cat',  'ANSMODULE' => 'bau',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'gfield_aprio_id' => array('SHORTNAME' => 'aprio',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  "ANSWER" => "aprio", 'ANSMODULE' => 'bau',
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'stakeholder1_id' => array('SHORTNAME' => 'stakeholder1',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => false,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'TYPE' => 'FK',  "ANSWER" => "orgunit", 'ANSMODULE' => 'hrm',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'stakeholder2_id' => array('SHORTNAME' => 'stakeholder2',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => false,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'TYPE' => 'FK',  "ANSWER" => "orgunit", 'ANSMODULE' => 'hrm',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'stakeholder_id' => array('SHORTNAME' => 'stakeholder',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'stakeholder',  'ANSMODULE' => 'pag',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'module_id' => array('SHORTNAME' => 'module',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'module',  'ANSMODULE' => 'ums',  
				'RELATION' => 'ManyToOne',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'owner_id' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => "auser", 'ANSMODULE' => 'ums', 
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'date_last_comm' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 10,  'MAXLENGTH' => 10,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'DATE',  'FORMAT' => 'HIJRI_UNIT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

			'termcount' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

			'validtermcount' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'INT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'other_smo' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

			'gf_status' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'TEXT',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

			'comm_list' => array('SHORTNAME' => 'list',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'comm',  'ANSMODULE' => 'bau',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

			'terms' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => false,  'FORMAT' => 'retrieve',  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => "gfield_term", 'ANSMODULE' => 'bau',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

		'sci_id' => array('SEARCH' => false,  'QSEARCH' => false,  'SHOW' => false,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => "scenario_item",  'ANSMODULE' => 'ums',  
				'RELATION' => 'unkn',  'READONLY' => false, 
				'CSS' => 'width_pct_50', ),

                
                'id_aut'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'date_aut'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'id_mod'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'date_mod'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'id_valid'       => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'date_valid'       => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'avail'             => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'version'            => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),
                'draft'             => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'update_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'delete_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'display_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'sci_id'            => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'tech_notes' 	      => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 'TOKEN_SEP'=>"§", 'READONLY' =>true, "NO-ERROR-CHECK"=>true, 'FGROUP' => 'tech_fields'),
	);  
    
}