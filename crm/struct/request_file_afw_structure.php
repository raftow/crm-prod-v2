<?php
class CrmRequestFileAfwStructure
{
	public static $DB_STRUCTURE = array(


		'id' => array(
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'TYPE' => 'PK',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'request_id' => array(
			'SHORTNAME' => 'request',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'REQUIRED' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'request',
			'ANSMODULE' => 'award',
			'RELATION' => 'OneToMany',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'response_id' => array(
			'SHORTNAME' => 'response',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'REQUIRED' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'response',
			'ANSMODULE' => 'award',
			'RELATION' => 'OneToMany',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'description' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 128,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => '',
			'REQUIRED' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'doc_type_id' => array(
			'SHORTNAME' => 'type',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => false,
			'RETRIEVE' => false,
			'MINIBOX' => false,
			'EDIT' => false,
			'QEDIT' => false,
			'SIZE' => 40,
			'MAXLENGTH' => 40,
			'REQUIRED' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'doc_type',
			'ANSMODULE' => 'ums',
			'WHERE' => "concat(',',valid_ext,',') like '%,§afile_ext§,%' and id in (§module_config_token_file_types§)",

			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => false,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'afile_ext' => array(
			'TYPE' => 'TEXT',
			'CATEGORY' => 'SHORTCUT',
			'SHORTCUT' => 'afile_id.afile_ext',
			'CAN-BE-SETTED' => false,
			'NO-COTE' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'afile_id' => array(
			'SHORTNAME' => 'file',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'INPUT_WIDE' => true,
			'QEDIT' => true,
			'SIZE' => 255,
			'REQUIRED' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'afile',
			'ANSMODULE' => 'ums',
			'AUTOCOMPLETE' => true,
			'WHERE' => "stakeholder_id=§MY_COMPANY§ and doc_type_id in (§module_config_token_file_types§)",

			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'active' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'DEFAUT' => 'Y',
			'TYPE' => 'YN',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'created_by'         => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'created_at'            => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		'updated_by'           => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'updated_at'              => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		'validated_by'       => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'validated_at'          => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		/* 'active'                   => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
								'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),*/

		'version'                  => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'INT',
			'FGROUP' => 'tech_fields'
		),

		// 'draft'                         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
		//                                        'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),

		'update_groups_mfk'             => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'ANSWER' => 'ugroup',
			'ANSMODULE' => 'ums',
			'TYPE' => 'MFK',
			'FGROUP' => 'tech_fields'
		),

		'delete_groups_mfk'             => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'ANSWER' => 'ugroup',
			'ANSMODULE' => 'ums',
			'TYPE' => 'MFK',
			'FGROUP' => 'tech_fields'
		),

		'display_groups_mfk'            => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'ANSWER' => 'ugroup',
			'ANSMODULE' => 'ums',
			'TYPE' => 'MFK',
			'FGROUP' => 'tech_fields'
		),

		'sci_id'                        => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'scenario_item',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'tech_notes' 	                => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'TYPE' => 'TEXT',
			'CATEGORY' => 'FORMULA',
			"SHOW-ADMIN" => true,
			'TOKEN_SEP' => "§",
			'READONLY' => true,
			"NO-ERROR-CHECK" => true,
			'FGROUP' => 'tech_fields'
		),
	);
}
