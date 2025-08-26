<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class Page extends WorkflowObject{

        public static $MY_ATABLE_ID=13934; 
  
        public static $DATABASE		= "pmu_workflow";
        public static $MODULE		        = "workflow";        
        public static $TABLE			= "page";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("page","id","workflow");
            WorkflowPageAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new Page();
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

        public static function showPage($module_code, $lookup_code, $lang)
        {
            $html = "";
            $module_id = UmsManager::decodeModuleCodeOrIdToModuleId($module_code);
            $pageObj = self::loadByMainIndex($module_id, $lookup_code);
            if(!$pageObj) return "page mcd=$module_code/id=$module_id/pcd=$lookup_code not found";
            $pageItemList = $pageObj->get("pageItemList");
            $pageThemeObj = $pageObj->het("page_theme_id");
            /**
             * @var PageItem $pageItem
             */
            foreach($pageItemList as $pageItem)
            {                
                $html .= $pageItem->showMyHtml($lang, $module_code, $pageThemeObj);
            }

            return $html;
        }
        
        public static function loadByMainIndex($module_id, $lookup_code,$create_obj_if_not_found=false)
        {
           if(!$module_id) throw new AfwRuntimeException("loadByMainIndex : module_id is mandatory field");
           if(!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


           $obj = new Page();
           $obj->select("module_id",$module_id);
           $obj->select("lookup_code",$lookup_code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("module_id",$module_id);
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
               if($this->getVal("name_$lang")) return $this->getVal("name_$lang");
               $data = array();
               $link = array();
               


               
               return implode(" - ",$data);
        }
        
        
        

        
        protected function getOtherLinksArray($mode,$genereLog=false,$step="all")      
        {
             global $lang;
             // $objme = AfwSession::getUserConnected();
             // $me = ($objme) ? $objme->id : 0;

             $otherLinksArray = $this->getOtherLinksArrayStandard($mode,$genereLog,$step);
             $my_id = $this->getId();
             // $displ = $this->getDisplay($lang);
             
             if($mode=="mode_pageItemList")
             {
                $objAS = new PageItem();
                $objAS->select("page_id", $my_id);
                $nextItemNum = AfwSqlHelper::aggregFunction($objAS, "max(item_num)")+1;

                   unset($link);
                   $link = array();
                   $title = "إضافة عنصر صفحة جديد";
                   // $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=PageItem&currmod=workflow&sel_page_id=$my_id&sel_item_num=$nextItemNum";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             
             
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
                       // workflow.page_item-الصفحة	page_id  أنا تفاصيل لها
                        if(!$simul)
                        {
                            // require_once "../workflow/page_item.php";
                            PageItem::removeWhere("page_id='$id'");
                            // $this->execQuery("delete from ${server_db_prefix}workflow.page_item where page_id = '$id' ");
                            
                        } 
                        
                        

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
                       // workflow.page_item-الصفحة	page_id  أنا تفاصيل لها
                        if(!$simul)
                        {
                            // require_once "../workflow/page_item.php";
                            PageItem::updateWhere(array('page_id'=>$id_replace), "page_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}workflow.page_item set page_id='$id_replace' where page_id='$id' ");
                            
                        }
                        

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

