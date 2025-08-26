<?php
class CrmCrmChannelAfwStructure
{
        public static $DB_STRUCTURE = array(
                'id' => array('SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'QEDIT' => false, 'TYPE' => 'PK'),


                'lookup_code' => array("TYPE" => "TEXT", "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "SIZE" => 64, "QEDIT" => true, "SHORTNAME" => "code"),

                'social' => array(
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
                        'TYPE' => 'YN',
                        'READONLY' => false,
                        'CSS' => 'width_pct_50',
                ),


                'name_ar' => array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
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
                        'CSS' => 'width_pct_100',
                ),

                'desc_ar' => array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'AUDIT' => false,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'MANDATORY' => true,
                        'SIZE' => 'AREA',
                        'MAXLENGTH' => 32,
                        'MIN-SIZE' => 1,
                        'ROWS' => 7,
                        'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'READONLY' => false,
                        'CSS' => 'width_pct_100',
                ),



                'created_by'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'created_at'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'GDAT', 'FGROUP' => 'tech_fields'),
                'updated_by'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'updated_at'         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'GDAT', 'FGROUP' => 'tech_fields'),
                'validated_by'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'validated_at'       => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'GDAT', 'FGROUP' => 'tech_fields'),
                'active'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'version'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),
                'draft'             => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'update_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'delete_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'display_groups_mfk' => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'sci_id'            => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'tech_notes'               => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 'TOKEN_SEP' => "§", 'READONLY' => true, "NO-ERROR-CHECK" => true, 'FGROUP' => 'tech_fields'),

        );
}
