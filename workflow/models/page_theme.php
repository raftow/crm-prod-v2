<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class PageTheme extends WorkflowObject{

        public static $MY_ATABLE_ID=13943; 
  
        public static $DATABASE		= "pmu_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "page_theme";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("page_theme","id","workflow");
            WorkflowPageThemeAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new PageTheme();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        

        public function getScenarioItemId($currstep)
                {
                    
                    return 0;
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
                       // workflow.page-الثيم	page_theme_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page.php";
                            Page::removeWhere("page_theme_id='$id'");
                            // $this->execQuery("delete from ${server_db_prefix}workflow.page where page_theme_id = '$id' ");
                            
                        } 
                        
                        

                   
                   // FK not part of me - replaceable 
                       // workflow.page_section-الثيم	page_theme_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_section.php";
                            PageSection::updateWhere(array('page_theme_id'=>$id_replace), "page_theme_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page_section set page_theme_id='$id_replace' where page_theme_id='$id' ");
                        }

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
                       // workflow.page-الثيم	page_theme_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page.php";
                            Page::updateWhere(array('page_theme_id'=>$id_replace), "page_theme_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page set page_theme_id='$id_replace' where page_theme_id='$id' ");
                            
                        }
                        
                       // workflow.page_section-الثيم	page_theme_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_section.php";
                            PageSection::updateWhere(array('page_theme_id'=>$id_replace), "page_theme_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page_section set page_theme_id='$id_replace' where page_theme_id='$id' ");
                        }

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

