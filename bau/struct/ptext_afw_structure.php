<?php 
        class BauPtextAfwStructure
        {
                public static $DB_STRUCTURE = array(

                        
			'id' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'PK',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'ptext_type_id' => array('SHOW' => true,  'RETRIEVE' => true,  'SEARCH' => true,  'QSEARCH' => true,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext_type',  'ANSMODULE' => 'bau',  'QEDIT' => false,  'SIZE' => 40,  'DEFAUT' => 0,  'READONLY' => true,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'ptext_cat_id' => array('SHOW' => true,  'RETRIEVE' => true,  'QSEARCH' => true,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext_cat',  'ANSMODULE' => 'bau',  'QEDIT' => false,  'SIZE' => 40,  'DEFAUT' => 0,  
				'WHERE' => "(ptext_type_id=§ptext_type_id§ or §ptext_type_id§=0)", 
				 'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'stakeholder_id' => array('SHOW' => true,  'SEARCH' => true,  'QSEARCH' => true,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'orgunit',  'ANSMODULE' => 'hrm',  
				'WHERE' => "", 
				 'SIZE' => 40,  'QEDIT' => false,  'DEFAUT' => 5,  'IMPORTANT' => 'CM',  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'orgunit_id' => array('SHOW' => true,  'SEARCH' => true,  'QSEARCH' => true,  'EDIT' => true,  'QEDIT' => false,  'SIZE' => 40,  'UTF8' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'orgunit',  'ANSMODULE' => 'hrm',  'DEFAUT' => 0,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'module_id' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'module',  'ANSMODULE' => 'ums',  'SIZE' => 40,  'DEFAUT' => 0,  'QEDIT' => false,  
				'WHERE' => "(id_main_sh=§orgunit_id§ or §orgunit_id§=0) and (§ptext_type_id§ != 5 or id_module_type in (5,7)) and id_module_status in (3,4,5,6)", 
				 'IMPORTANT' => 'CM',  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'id_theme' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'SEARCH' => false,  'QEDIT' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'theme',  'SIZE' => 40,  'DEFAUT' => 0,  'ANSMODULE' => 'bau',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  'STEP' => 1,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'author_id' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',  
				'WHERE' => "id in (select auser_id from §DBPREFIX§hrm.employee where id_sh_div = §stakeholder_id§)", 
				 'QEDIT' => false,  'SIZE' => 40,  'DEFAUT' => 0,  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'authors_mfk' => array('SHOW' => true,  'SEARCH' => false,  'RETRIEVE' => false,  'EDIT' => false,  'QEDIT' => false,  'EDIT-ADMIN' => true,  
				'TYPE' => 'MFK',  'ANSWER' => 'auser',  'ANSMODULE' => 'ums',  
				'WHERE' => "id != §author_id§ and id in (select auser_id from §DBPREFIX§hrm.employee where id_sh_div = §stakeholder_id§)", 
				 'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'id_atable' => array('SHOW' => true,  'SEARCH' => true,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'atable',  'ANSMODULE' => 'pag',  'SIZE' => 40,  'DEFAUT' => 0,  'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'pdocument_id' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext',  'ANSMODULE' => 'bau',  'SIZE' => 40,  'QEDIT' => true,  'DEFAUT' => 0,  
				'WHERE' => "ptext_type_id=5", 
				 'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'parent_ptext_id' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext',  'ANSMODULE' => 'bau',  'SIZE' => 40,  'QEDIT' => false,  'DEFAUT' => 0,  
				'WHERE' => "ptext_type_id=6 and id != '§id§'", 
				 'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'related_ptext_id' => array('SHOW' => true,  'RETRIEVE' => false,  'SEARCH' => false,  'EDIT' => true,  'QEDIT' => false,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext',  'ANSMODULE' => 'bau',  'SIZE' => 40,  'DEFAUT' => 0,  
				'WHERE' => "ptext_type_id = 3 and id != '§id§'", 
				 'STEP' => 2,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'titre_short' => array('SHOW' => true,  'RETRIEVE' => true,  'EDIT' => true,  'QEDIT' => true,  'SEARCH' => true,  'QSEARCH' => true,  'UTF8' => true,  'SIZE' => 80,  
				'TYPE' => 'TEXT',  'STEP' => 3,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'ntext' => array('SHOW' => true,  'RETRIEVE' => false,  'EDIT' => true,  'QEDIT' => true,  
				'TYPE' => 'TEXT',  'UTF8' => true,  'SEARCH' => true,  'QSEARCH' => true,  
				'SIZE' => 'AREA',  'ROWS' => 12,  'COLS' => 100,  'INPUT-STYLE' => 'height:220px !important;overflow:auto;',  'FORMAT' => 'PARAGRAPH-TOHTML',  'STEP' => 3,  'SEARCH-BY-ONE' => true,  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'pnum' => array('IMPORTANT' => 'IN',  'SHOW' => true,  'SEARCH' => false,  'QEDIT' => false,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'INT',  'STEP' => 3,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'spcount' => array('SHOW' => true,  'SEARCH' => false,  'QEDIT' => false,  'RETRIEVE' => true,  'EDIT' => true,  
				'TYPE' => 'INT',  'STEP' => 3,  'CAN-BE-SETTED' => true,  'DIRECT_ACCESS' => true,  
				'CATEGORY' => 'FORMULA',  'PHP_FORMULA' => 'count.itemList',  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'ptext_status_id' => array('SHOW' => true,  'RETRIEVE' => true,  'SEARCH' => true,  'EDIT' => false,  'QEDIT' => false,  'EDIT-STATUS' => true,  
				'TYPE' => 'FK',  'ANSWER' => 'ptext_status',  'ANSMODULE' => 'bau',  'SIZE' => 40,  'DEFAUT' => 1,  'STEP' => 4,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

			'ptext_status_comment' => array('SHOW' => true,  'RETRIEVE' => false,  'SEARCH' => true,  'EDIT' => false,  'QEDIT' => false,  'EDIT-STATUS' => true,  
				'TYPE' => 'TEXT',  'UTF8' => true,  
				'SIZE' => 'AREA',  'STEP' => 4,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'itemList' => array(
				'TYPE' => 'FK',  'ANSWER' => 'ptext',  'ANSMODULE' => 'bau',  
				'CATEGORY' => 'ITEMS',  'ITEM' => 'parent_ptext_id',  
				'WHERE' => "", 
				 'SHOW' => true,  'FORMAT' => 'retrieve',  'EDIT' => false,  'ICONS' => true,  'DELETE-ICON' => false,  'BUTTONS' => true,  'NO-LABEL' => true,  'STEP' => 5,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

		'relatedList' => array(
				'TYPE' => 'FK',  'ANSWER' => 'ptext',  'ANSMODULE' => 'bau',  
				'CATEGORY' => 'ITEMS',  'ITEM' => 'related_ptext_id',  
				'WHERE' => "", 
				 'SHOW' => true,  'FORMAT' => 'retrieve',  'EDIT' => false,  'ICONS' => true,  'DELETE-ICON' => false,  'BUTTONS' => true,  'NO-LABEL' => true,  'STEP' => 6,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
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