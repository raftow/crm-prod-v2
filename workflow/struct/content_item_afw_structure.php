<?php


class WorkflowContentItemAfwStructure
{
	// token separator = §
	public static function initInstance(&$obj)
	{
		if ($obj instanceof ContentItem) {
			$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
			$obj->DISPLAY_FIELD = "name_ar";

			// $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
			$obj->ORDER_BY_FIELDS = "content_id";

			$obj->UNIQUE_KEY = array('content_id', 'content_type_enum', 'publication_id', 'workflow_file_id', 'intelligent_content_id');
			$obj->showQeditErrors = true;
			$obj->showRetrieveErrors = true;
			$obj->general_check_errors = true;
			
			$obj->OwnedBy = array('module' => "workflow", 'afw' => "Content");
			$obj->after_save_edit = array("class"=>'Content',"attribute"=>'content_id', "currmod"=>'workflow',"currstep"=>2);
			//$obj->after_save_edit = array("mode" => "qsearch", "currmod" => 'adm', "class" => 'ContentItem', "submit" => true);
		} else {
			ContentItemArTranslator::initData();
			ContentItemEnTranslator::initData();
		}
	}


	public static $DB_STRUCTURE =
	array(
		'id' => array('SHOW' => true, 'RETRIEVE' => true, 'EDIT' => true, 'CSS' => 'width_pct_50', 'TYPE' => 'PK'),

		'content_id' => array(
			'SHORTNAME' => 'content',
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'content',
			'ANSMODULE' => 'workflow',
			'RELATION' => 'OneToMany',
			'READONLY' => true,
			'CSS' => 'width_pct_50',
		),

		'item_num' => array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'AUDIT' => false,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 32,
                        'MAXLENGTH' => 32,
                        'MIN-SIZE' => 1,
						'DEFAULT' => 1,
                        'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
                        'REQUIRED' => true,
                        'UTF8' => false,
                        'TYPE' => 'INT',
                        'READONLY' => false,
                        'CSS' => 'width_pct_50',
					),

		'lookup_code' => array(
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'AUDIT' => false,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 16,
                        'MAXLENGTH' => 16,
                        'MIN-SIZE' => 1,
                        'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
                        'MANDATORY' => true,
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'READONLY' => false,
                        'CSS' => 'width_pct_50',
                ),
                
		'content_type_enum' => array(
			'SHORTNAME' => 'type',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => false,
			'TYPE' => 'ENUM',
			'ANSWER' => 'FUNCTION',
			'READONLY' => true,
			'MANDATORY' => true,
			'CSS' => 'width_pct_50',
		),

		'publication_id' => array(
			'SHORTNAME' => 'publication',
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => false,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 128,
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'publication',
			'ANSMODULE' => 'workflow',
			'RELATION' => 'OneToOneUnidirectional',
			'DISABLED' => true,
			'READONLY' => true,
			'CSS' => 'width_pct_50',
		),

		'workflow_file_id' => array(
			'SHORTNAME' => 'file',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'workflow_file',
			'ANSMODULE' => 'workflow',
			'RELATION' => 'ManyToOne',
			'DISABLED' => true,
			'READONLY' => true,
			'CSS' => 'width_pct_50',
		),

		'intelligent_content_id' => array(
			'SHORTNAME' => 'content',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'intelligent_content',
			'ANSMODULE' => 'workflow',
			'RELATION' => 'ManyToOne',
			'DISABLED' => true,
			'READONLY' => true,
			'CSS' => 'width_pct_50',
		),

		/*
		'name_ar' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 128,
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => "ARABIC-CHARS,SPACE",
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		

		'name_en' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 128,
			'MAXLENGTH' => 128,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),*/


		'created_by'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'created_at'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
		'updated_by'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'updated_at'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
		'validated_by'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'validated_at'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
		'active'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
		'version'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),
		'draft'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
		'update_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
		'delete_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
		'display_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
		'sci_id'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
		'tech_notes' 	      => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 'TOKEN_SEP' => "§", 'READONLY' => true, "NO-ERROR-CHECK" => true, 'FGROUP' => 'tech_fields'),
	);
}
    


// errors 
