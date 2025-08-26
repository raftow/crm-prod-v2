<?php 
        class BauGoalConcernAfwStructure
        {
                public static $DB_STRUCTURE = array(

                        
			'id' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'PK',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

									'goal_atable_mfk' => array(
											'CATEGORY' => 'SHORTCUT',  'SHORTCUT' => 'goal.atable_mfk',  
											'TYPE' => 'MFK',  'ANSWER' => 'atable',  'ANSMODULE' => 'pag',  'NO-COTE' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
											'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
											),

									'goal_system_id' => array(
											'CATEGORY' => 'SHORTCUT',  'SHORTCUT' => 'goal.system_id',  
											'TYPE' => 'MFK',  'ANSWER' => 'module',  'ANSMODULE' => 'ums',  'NO-COTE' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
											'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
											),

									'goal_domain_id' => array(
											'CATEGORY' => 'SHORTCUT',  'SHORTCUT' => 'goal.domain_id',  
											'TYPE' => 'MFK',  'ANSWER' => 'domain',  'ANSMODULE' => 'pag',  'NO-COTE' => true,  'SEARCH-BY-ONE' => '',  'DISPLAY' => '',  'STEP' => 1,  
											'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
											),

			'goal_id' => array('SHORTNAME' => 'goal',  'SEARCH' => true,  'QSEARCH' => true,  
				'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 40,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'goal',  'ANSMODULE' => 'bau',  
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'application_id' => array('SHORTNAME' => 'application',  'SEARCH' => false,  'QSEARCH' => false,  
				'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  
				'SIZE' => 40,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'module',  'ANSMODULE' => 'ums',  
				'WHERE' => "id_module_type=5 and id_system = §goal_system_id§ and id_pm = §goal_domain_id§ ", 
				'DEPENDENT_OFME' => array (0 => 'atable_mfk',),  'DEFAUT' => 0,  'SEARCH-BY-ONE' => false,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'jobrole_id' => array('SHORTNAME' => 'jobrole',  'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'MANDATORY' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'jobrole',  'ANSMODULE' => 'pag',  
				'WHERE' => "id_domain in (1,§goal_domain_id§)", 
				 
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'atable_mfk' => array('SHORTNAME' => 'atables',  'SEARCH' => false,  'QSEARCH' => false,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 32,  'MANDATORY' => true,  'UTF8' => false,  
				'WHERE' => "id_module = §application_id§ and is_entity='Y' and id in (0§goal_atable_mfk§0)", 
				 'DEPENDENCY' => 'application_id',  
				'TYPE' => 'MFK',  'ANSWER' => 'atable',  'ANSMODULE' => 'pag',  'SEARCH-BY-ONE' => false,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 'CSS' => 'width_pct_100', 
				),

			'operation_men' => array('SHORTNAME' => 'operations',  'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 32,  'REQUIRED' => true,  'UTF8' => false,  
				'TYPE' => 'MENUM',  'ANSWER' => 'FUNCTION',  'READONLY' => false,  'DEFAUT' => ',1,2,3,',  'ANSMODULE' => 'bau',  'SEARCH-BY-ONE' => false,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'MANDATORY' => true,  'ERROR-CHECK' => true, 'CSS' => 'width_pct_100', 
				),

			'comment' => array('SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 128,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'avail' => array('SHOW-ADMIN' => true,  'RETRIEVE' => false,  'EDIT' => true,  'DEFAUT' => 'Y',  
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