<?php 
        class BauUserStoryAfwStructure
        {
                public static $DB_STRUCTURE = array(

                        
			'id' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'PK',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'system_id' => array('IMPORTANT' => 'IN',  'SEARCH' => false,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'SIZE' => 40,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'module',  'ANSMODULE' => 'ums',  'MANDATORY' => true,  
				'WHERE' => "id_module_type in (4,7) and ('§CONTEXT_ID§'='' or id_system = '§CONTEXT_ID§')", 
				 'QEDIT' => false,  'SHORTNAME' => 'system',  'SEARCH-BY-ONE' => true,  'DEFAUT' => 0,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'module_id' => array('IMPORTANT' => 'IN',  'SEARCH' => false,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'SIZE' => 40,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'module',  'ANSMODULE' => 'ums',  'MANDATORY' => true,  
				'WHERE' => "id_module_type = 5 and id_system = §system_id§", 
				 'QEDIT' => false,  'SHORTNAME' => 'module',  'SEARCH-BY-ONE' => true,  
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'jobrole_id' => array('SHORTNAME' => 'jobrole',  'SEARCH' => false,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'jobrole',  'ANSMODULE' => 'pag',  'MANDATORY' => true,  'PILLAR' => true,  
				'WHERE' => "id_domain in (select id_pm from §DBPREFIX§ums.module where id=§module_id§) and avail='Y'", 
				 
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'bfunction_id' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'bfunction',  'ANSMODULE' => 'ums',  'MANDATORY' => true,  
				'WHERE' => "id_system = §system_id§ and bfunction_type_id in (select id from §DBPREFIX§ums.bfunction_type where avail = 'Y' and for_role = 'Y')", 
				 
				'AUTOCOMPLETE' => array (
  'CREATE' => 
  array (
    'titre_short' => 
    array (
      'INPUT' => true,
    ),
    'titre' => 
    array (
      'INPUT' => true,
    ),
    'id_system' => 
    array (
      'FIELD' => 'system_id',
    ),
    'curr_class_module_id' => 
    array (
      'FIELD' => 'module_id',
    ),
    'bfunction_code' => 
    array (
      'CONST' => 'US_',
      'FIELD' => 'id',
      'CONST2' => '_SCREEN',
    ),
  ),
  'UK' => 
  array (
    0 => 'curr_class_module_id',
    1 => 'bfunction_code',
  ),
),  
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'user_story_goal_id' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  'NO-COTE' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'goal',  'ANSMODULE' => 'bau',  'MANDATORY' => true,  
				'WHERE' => "jobrole_id = §jobrole_id§ and module_id = §module_id§", 
				 
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'arole_id' => array('IMPORTANT' => 'IN',  'SEARCH' => false,  'SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SIZE' => 40,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'arole',  'ANSMODULE' => 'ums',  'MANDATORY' => true,  
				'WHERE' => "id in (select arole_id from §DBPREFIX§ums.job_arole where jobrole_id = §jobrole_id§ and module_id = §module_id§ and avail='Y') and (role_code like 'manual%' or role_code = 'goal-§user_story_goal_id§')", 
				 'DEPENDENCY' => 'jobrole_id',  
				'DEPENDENCIES' => array (
  0 => 'module_id',
  1 => 'user_story_goal_id',
),  
				'RELATION' => 'OneToMany',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',  'ERROR-CHECK' => true, 
				),

			'user_story_name_ar' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE-AR' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 64,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'user_story_desc_ar' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE-AR' => true,  'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 'AREA',  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'user_story_name_en' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE-EN' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 64,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'TEXT',  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'user_story_desc_en' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE-EN' => true,  'EDIT' => true,  'QEDIT' => false,  
				'SIZE' => 'AREA',  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'TEXT',  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'my_goal_id' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => false,  'QEDIT' => false,  'SIZE' => 40,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'goal',  'ANSMODULE' => 'bau',  'DEFAUT' => 0,  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'source' => array('IMPORTANT' => 'IN',  'SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 32,  'UTF8' => false,  
				'TYPE' => 'TEXT',  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'comments' => array('SEARCH' => true,  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => true,  'SEARCH-ADMIN' => true,  'SHOW-ADMIN' => true,  'EDIT-ADMIN' => true,  'UTF8' => true,  
				'TYPE' => 'TEXT',  
				'SIZE' => 'AREA',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'is_ok' => array(
				'TYPE' => 'TEXT',  
				'CATEGORY' => 'FORMULA',  'SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => false,  'READONLY' => true,  'NO-ERROR-CHECK' => true,  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
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