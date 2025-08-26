<?php
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Gfield extends AFWObject{
        public static $COMPTAGE_BEFORE_LOAD_MANY = true;
        
	public static $DATABASE		= ""; 
        public static $MODULE		    = "bau"; 
        public static $TABLE			= "gfield"; 
        public static $DB_STRUCTURE = null; 
        
        public function __construct($tablename="gfield"){
		parent::__construct($tablename,"id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 10;
                $this->DISPLAY_FIELD = "titre";
	}
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")
        {
           global $me, $objme;
           
             
             $otherLinksArray = array();   
             if($mode=="display")
             {
                           $parent_gfield_id = $this->getId();
                           $link = array();
                           $title = "المصطلحات ";
                           $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=GfieldTerm&currmod=bau&id_origin=$parent_gfield_id&class_origin=Gfield&module_origin=bau&newo=3&limit=30&ids=all&fixmtit=$title&fixmdisable=1&fixm=gfield_id=$parent_gfield_id&sel_gfield_id=$parent_gfield_id";
                           $link["TITLE"] = $title;
                           $link["UGROUPS"] = array();
                           $otherLinksArray[] = $link;  
             }
             return $otherLinksArray;          
        }
        
        public function getTermCount($only_defined=true)
        {
               $file_dir_name = dirname(__FILE__); 
               require_once("$file_dir_name/gfield_term.php");
               
               $af = new GfieldTerm();
               
               $af->select("gfield_id", $this->getId());
               $af->select("avail", 'Y');
               if($only_defined) $af->select("term_definition_valid", 'Y');
               
               return $af->count();
               
        }
        
        public function getFormuleResult($attribute, $what='value') 
        {
	       switch($attribute) 
               {
                    case "validtermcount" :
                        $fn = $this->getTermCount(true);
                        
			return $fn;
		    break;
                    case "termcount" :
                        $fn = $this->getTermCount(false);
                        
			return $fn;
		    break;
        
                    case "gf_status" :
                        $gf_status_label = array();
                        $gf_status_label[5] = "تمت";
                        $gf_status_label[21] = "انتظار";
                        $gf_status_label[22] = "جاهزة";
                        $gf_status_label[58] = "يدويا";
                        if($this->getVal("module_id")<=0) return "";
                        $gf_status = "";
                        $id_module_parent = 58;//$this->get("module_id")->getVal("id_module_parent");
                        $gf_status = "<img src='../lib/images/gfp_$id_module_parent.png' style='width: 16px !important; height: 16px !important;'>".$gf_status_label[$id_module_parent];
                        
			return $gf_status;
		    break;


               }
        }
        
}
?>