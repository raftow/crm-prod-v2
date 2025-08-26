<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class SectionTemplate extends WorkflowObject{

        public static $MY_ATABLE_ID=13935; 
  
        public static $DATABASE		= "pmu_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "section_template";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("section_template","id","workflow");
            WorkflowSectionTemplateAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new SectionTemplate();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }

        public function get_template_full_path($module_code="")
        {
            if(!$module_code) $module_code = AfwUrlManager::currentURIModule();
            $lookup_code = $this->getVal("lookup_code");
            $file_dir_name = dirname(__FILE__); 
            $template_full_path_name = "$file_dir_name/../../$module_code/tpl/template_$lookup_code.php";
            if(!file_exists($template_full_path_name))
            {
                throw new AfwRuntimeException("section template php file $template_full_path_name not found");
            }

            return $template_full_path_name;            
        }

        public function calcHtml_template_body($module_code="")
        { 
            $template_full_path_name = $this->get_template_full_path($module_code);   
            ob_start();
            include($template_full_path_name);
            $return = ob_get_clean();

            if(!$return) $return = "$template_full_path_name returned empty html";

            return $return;
        }

        public static function decodeTokens($template_full_path_name, $templateHtml, $token_arr)
        {
            $old_templateHtml = $templateHtml;
            foreach ($token_arr as $token => $val_token) {
                //if($token=="[travelStationList.no_icons]") die("for the token $token value is $val_token , token_arr = ".var_export($token_arr,true)." text_to_decode=$text_to_decode");
                $templateHtml = str_replace("[$token]", $val_token, $templateHtml);
            }
            
            if($old_templateHtml==$templateHtml)
            {
                throw new AfwRuntimeException("The html template $template_full_path_name given has't much any token from given tokens = ".var_export($token_arr,true));
            }
    
            return $templateHtml;
        }
        
        
        public function showTemplateHtml($lang, $module_code, $pageThemeObj, $tokens)
        {
            $template_full_path_name = $this->get_template_full_path($module_code); 
            $theme = $pageThemeObj->getVal("lookup_code");
            $html = "<link rel='stylesheet' href='../$module_code/css/theme_$theme"."_$lang.css'>\n";
            $tokens["curr_lang"] = $lang;
            $tokens["curr_theme"] = $theme;
            $tokens["curr_module"] = $module_code;
            $templateHtml = $this->calcHtml_template_body($module_code);
            $templateHtml = self::decodeTokens($template_full_path_name, $templateHtml, $tokens);
            $html .= $templateHtml;
            //$html = "lang=$lang ".$templateHtml . var_export($tokens,true);

            return $html;
        }


        public function getScenarioItemId($currstep)
        {
            return 0;
        }
        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           if(!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


           $obj = new SectionTemplate();
           $obj->select("lookup_code",$lookup_code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("lookup_code",$lookup_code);

                $obj->insertNew();
                if(!$obj->id) return null; // means beforeInsert rejected insert operation
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               return $this->getVal("name_$lang");
        }
        
        
        

        
        protected function getOtherLinksArray($mode,$genereLog=false,$step="all")      
        {
             global $lang;
             // $objme = AfwSession::getUserConnected();
             // $me = ($objme) ? $objme->id : 0;

             $otherLinksArray = $this->getOtherLinksArrayStandard($mode,$genereLog,$step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             // check errors on all steps (by default no for optimization)
             // rafik don't know why this : \//  = false;
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));
            
            
            
            return $pbms;
        }
        
        
        
        
        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","pmu_");
            
            if(!$id)
            {
                $id = $this->getId();
                $simul = true;
            }
            else
            {
                $simul = false;
            }
            
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 

                        
                   // FK part of me - deletable 
                       // workflow.page_section-النموذج	section_template_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_section.php";
                            PageSection::removeWhere("section_template_id='$id'");
                            // $this->execQuery("delete from ${server_db_prefix}workflow.page_section where section_template_id = '$id' ");
                            
                        } 
                        
                        

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
                       // workflow.page_section-النموذج	section_template_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_section.php";
                            PageSection::updateWhere(array('section_template_id'=>$id_replace), "section_template_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page_section set section_template_id='$id_replace' where section_template_id='$id' ");
                            
                        }
                        

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 


