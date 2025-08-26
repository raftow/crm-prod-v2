<?php 
        class BauRAMObjectAfwStructure
        {
                public static $DB_STRUCTURE = array(

                        
			'id' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'PK',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'parent_object_pk' => array('SHORTNAME' => 'parent',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'r_a_m_object',  'ANSMODULE' => 'bau',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'object_category_enm' => array('SHORTNAME' => 'category',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 32,  'SEARCH-ADMIN' => true,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'ENUM',  'ANSWER' => 'FUNCTION',  'ANSMODULE' => 'bau',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'object_type_id' => array('SHORTNAME' => 'type',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'r_a_m_object_type',  'ANSMODULE' => 'bau',  
				'WHERE' => "object_category_enm=§object_category_enm§", 
				 'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'generated_object_id' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'INT',  'SEARCH-BY-ONE' => false,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'object_code' => array('SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 32,  'SEARCH-ADMIN' => true,  'MANDATORY' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'object_name_ar' => array('SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 48,  'SEARCH-ADMIN' => true,  'MANDATORY' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'object_name_en' => array('SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 48,  'SEARCH-ADMIN' => true,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'TEXT',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'object_specification' => array('SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 255,  'SEARCH-ADMIN' => true,  'MANDATORY' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'analysis_text_pk' => array('SHORTNAME' => 'analysis',  'SEARCH' => false,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 40,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext',  'ANSMODULE' => 'bau',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

		'childList' => array(
				'TYPE' => 'FK',  'ANSWER' => 'r_a_m_object',  'ANSMODULE' => 'bau',  
				'CATEGORY' => 'ITEMS',  'ITEM' => 'parent_object_pk',  
				'WHERE' => "", 
				 'SHOW' => true,  'FORMAT' => 'tree',  'LINK_COL' => 'parent_object_pk',  'ITEMS_COL' => 'childList',  'FEUILLE_COL' => 'childList',  'ALL_ITEMS' => true,  'FEUILLE_COND_METHOD' => 'hasNoChild',  'EDIT' => false,  'ICONS' => true,  'DELETE-ICON' => false,  'BUTTONS' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'avail' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => false,  'DEFAUT' => 'Y',  
				'TYPE' => 'YN',  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

                        'id_aut'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),

                        'date_aut'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'TYPE' => 'GDAT', 'FGROUP' => 'tech_fields'),

                        'id_mod'           => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),

                        'date_mod'              => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'TYPE' => 'GDAT', 'FGROUP' => 'tech_fields'),

                        'id_valid'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),

                        'date_valid'          => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 
                                                                'TYPE' => 'GDAT', 'FGROUP' => 'tech_fields'),

                        /* 'avail'                   => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
                                                                'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),*/

                        'version'                  => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),

                        // 'draft'                         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
                        //                                        'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),

                        'update_groups_mfk'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),

                        'delete_groups_mfk'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),

                        'display_groups_mfk'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 
                                                                'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),

                        'sci_id'                        => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 
                                                                'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),

                        'tech_notes' 	                => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 
                                                                'TOKEN_SEP'=>"§", 'READONLY'=>true, "NO-ERROR-CHECK"=>true, 'FGROUP' => 'tech_fields'),
                ); 
        } 
?>