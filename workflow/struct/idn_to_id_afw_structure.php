<?php 

     
        class WorkflowIdnToIdAfwStructure
        {
                // token separator = §
                public static function initInstance(&$obj)
                {
                        if ($obj instanceof IdnToId ) 
                        {
                                $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                                // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                                $obj->UNIQUE_KEY = ["module_code", "country_id", "idn_type_id", "idn"];
                                 
                                
                                $obj->showQeditErrors = true;
                                $obj->showRetrieveErrors = true;
                                $obj->general_check_errors = true;
                                // $obj->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
                                $obj->after_save_edit = array("mode"=>"qsearch", "currmod"=>'adm', "class"=>'IdnToId',"submit"=>true);
                        }
                        else 
                        {
                                IdnToIdArTranslator::initData();
                                IdnToIdEnTranslator::initData();
                        }
                }
                
                
                public static $DB_STRUCTURE =  
     array(
                'id' => array('SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'),

		
                'module_code' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
                        'EDIT' => true,  'QEDIT' => true,  
                        'SIZE' => 16,  'MAXLENGTH' => 16,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC",
                        'TYPE' => 'TEXT', 'MANDATORY' => true, 'READONLY' => true, 
                        'CSS' => 'width_pct_50', ),

                'country_id' => array('SHOW' => true,  'RETRIEVE' => true,  
                        'TYPE' => 'FK',  'ANSWER' => 'country',  'ANSMODULE' => 'ums', 'RELATION' => 'ManyToOne', 
                        'MANDATORY' => true, 'READONLY'=>true,
                        'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
                        'CSS' => 'width_pct_50', ),

                'idn_type_id' => array('SHORTNAME' => 'type',  'SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false,  
                        'EDIT' => true,  'QEDIT' => true,  
                        'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'UTF8' => false,  
                        'TYPE' => 'FK',  'ANSWER' => 'identity_type',  'ANSMODULE' => 'adm',  
                        'RELATION' => 'unkn', 'MANDATORY' => true, 'READONLY' => true, 
                        'CSS' => 'width_pct_50', ),

                'idn' => array('SEARCH' => true,  'QSEARCH' => false,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => true,  
                        'EDIT' => true,  'QEDIT' => true,  
                        'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'UTF8' => true,  
                        'TYPE' => 'TEXT', 'MANDATORY' => true, 'READONLY' => true, 
                        'CSS' => 'width_pct_50', ),

                
                'created_by'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'created_at'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'updated_by'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'updated_at'         => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, "TECH_FIELDS-RETRIEVE" => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'validated_by'       => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'validated_at'       => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'),
                'active'             => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'version'            => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'),
                'draft'             => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),
                'update_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'delete_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'display_groups_mfk' => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'),
                'sci_id'            => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'),
                'tech_notes' 	      => array('STEP' =>99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', "SHOW-ADMIN" => true, 'TOKEN_SEP'=>"§", 'READONLY' =>true, "NO-ERROR-CHECK"=>true, 'FGROUP' => 'tech_fields'),
	);  
    
         }
    


