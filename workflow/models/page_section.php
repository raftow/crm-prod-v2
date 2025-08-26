<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class PageSection extends WorkflowObject{

        public static $MY_ATABLE_ID=13937; 
  
        public static $DATABASE		= "pmu_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "page_section";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("page_section","id","workflow");
            WorkflowPageSectionAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new PageSection();
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
        
        
        public function showSectionHtml($lang, $module_code, $pageThemeObj)
        {
            $templateObj = $this->het('section_template_id');
            /**
             * @var Content $contentObj
             */
            $contentObj = $this->het('content_id');
            return $contentObj->showContentHtml($lang, $module_code, $templateObj, $pageThemeObj);
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
                       // workflow.page_item-قسم الصفحة	page_section_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_item.php";
                            PageItem::removeWhere("page_section_id='$id'");
                            // $this->execQuery("delete from ${server_db_prefix}workflow.page_item where page_section_id = '$id' ");
                            
                        } 
                        
                        

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
                       // workflow.page_item-قسم الصفحة	page_section_id  حقل يفلتر به
                        if(!$simul)
                        {
                            // require_once "../workflow/page_item.php";
                            PageItem::updateWhere(array('page_section_id'=>$id_replace), "page_section_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page_item set page_section_id='$id_replace' where page_section_id='$id' ");
                            
                        }
                        

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

