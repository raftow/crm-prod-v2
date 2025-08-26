<?php
$file_dir_name = dirname(__FILE__); 
/*
ptext_type :
+----+-----------------------+
| id | titre_short           |
+----+-----------------------+
|  9 | جملة                  |
|  8 | فقرة                 |
|  7 | موضوع                |
|  6 | محور                  |
|  5 | مستند               |
+----+-----------------------+

ptext_cat :

+--------------+----+-----------------------------+
| ptext_type_id | id | titre_short        |
+---------------+----+-----------------------------+
|             3 |  3 | جزء من فقرة                 |
|             3 |  4 | سؤال                        |
|             3 |  5 | عنوان                       |
|             4 |  6 | إجابة عن سؤال               |
|             4 |  7 | بيان مسألة                  |
|             5 |  8 | متطلبات النظام              |
|             6 |  9 | تعريف النظام                |
+---------------+----+----------------------------*/

                
// old include of afw.php


class Ptext extends AFWObject{

    public static $COMPTAGE_BEFORE_LOAD_MANY = true;

	public static $DATABASE		= ""; 
    public static $MODULE		    = "bau"; 
    public static $TABLE			= "ptext"; 
    
    public static $DB_STRUCTURE = null; 
    
    
    public function __construct($tablename="ptext"){
		parent::__construct($tablename,"id","bau");
                $this->DISPLAY_FIELD = "titre_short";
                $this->SubTypesField = "ptext_type_id";
                $this->editByStep = true;
                $this->editNbSteps = 6;
                $this->ORDER_BY_FIELDS = "parent_ptext_id, pnum";                
	}

        public function loadDetails($recur=true)
        {
                unset($this->details);
                
                $det = new Ptext();
                $det->select("module_id",$this->getVal("module_id"));
                $det->select("stakeholder_id",$this->getVal("stakeholder_id"));
                $det->select("pdocument_id",$this->getVal("pdocument_id"));
                $det->select("parent_ptext_id",$this->getVal("parent_ptext_id"));
                $det->select("related_ptext_id",$this->getId());
                
                $this->details =& $det->loadMany();
                
                if($recur)
                {
                       $keys_details = array_keys($this->details);
                       
                       foreach($keys_details as $ptxt_id) 
                       {
                              $this->details[$ptxt_id]->loadDetails(true);  
                       }
                }
        }
        
        public static function genereDoc($p_text_arr)
        {
             $html = "";
             $keys_details = array_keys($p_text_arr);
             
             foreach($keys_details as $key)
             {
                  $html .= $p_text_arr[$key]->genereParagraphHTML() ."<br>";
             }
             
             return $html;
        }          
        
        public function genereParagraphHTML()
        {
             $html = "";
             $p_text = $this->getVal("ntext");
             $p_titre = $this->getVal("titre_short");
             $p_cat = $this->getVal("ptext_cat_id");
             
             if(($p_cat==4) or ($p_cat==5))
             {
                $html .= "<p class='page_title'>$p_titre</p><br>";
                //$html .= "<p class='page_paragraph'>count = ".count($this->details)."</p><br>";;
             }
             if(($p_cat==3) or ($p_cat==6) or ($p_cat==7))
             {
                 $p_text_html = AfwFormatHelper::toHtml($p_text); 
                 $html .= "<p class='page_paragraph'>$p_text_html</p><br>";
                 
                 
             }
             $keys_details = array_keys($this->details);
             foreach($keys_details as $ptxt_id) 
             {
                 $html .= $this->details[$ptxt_id]->genereParagraphHTML();  
             }       
        
        
             return $html;   
        }        
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")
        {
           global $lang;
             $objme = AfwSession::getUserConnected();
             $me = $objme ? $objme->id : 0;
             $ptextType = $this->het("ptext_type_id");
             $displ = $this->getDisplay($lang);
             $otherLinksArray = array();   
             if($mode=="display")
             {
                
                
                if($this->getVal("ptext_cat_id")==4)
                {
                   $link = array();
                   $title_short = "إجابة ". $objme->valNomcomplet() ." على سؤال رقم "."§id§"; 
                   
                   $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Ptext&sel_titre_short=${title_short}&sel_stakeholder_id=§stakeholder_id§&sel_module_id=§module_id§&sel_pdocument_id=§pdocument_id§&sel_parent_ptext_id=§parent_ptext_id§&sel_related_ptext_id=§id§&sel_ptext_type_id=4&sel_ptext_cat_id=6&sel_author_id=$me";
                   $link["TITLE"] = "إجابة عن هذا السؤال";
                   $link["UGROUPS"] = array();
                   
                   $otherLinksArray[] = $link;
                }   
                
                $link_2 = array();   
                 
                // $link_2["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Ptext&sel_stakeholder_id=§stakeholder_id§&sel_module_id=§module_id§&sel_pdocument_id=§pdocument_id§&sel_parent_ptext_id=§parent_ptext_id§&sel_ptext_type_id=3&sel_ptext_cat_id=4&sel_author_id=$me";
                // $link_2["TITLE"] = "سؤال آخر في نفس السياق";
                // $link_2["UGROUPS"] = array();
                
                // $otherLinksArray[] = $link_2;

                $link_3 = array();
                
                $link_3["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Ptext&sel_stakeholder_id=§stakeholder_id§&sel_module_id=§module_id§&sel_pdocument_id=§pdocument_id§&sel_parent_ptext_id=§parent_ptext_id§&sel_ptext_type_id=§ptext_type_id§&sel_ptext_cat_id=§ptext_cat_id§&sel_author_id=$me";
                $link_3["TITLE"] = "تحرير في نفس السياق";
                $link_3["UGROUPS"] = array();

                
                $otherLinksArray[] = $link_3;
                
             }
             
                
             if($ptextType and $ptextType->getId()==5) $pdocument_id = $this->getId();
             else $pdocument_id = $this->getVal("pdocument_id");             
             
             if($mode=="mode_itemList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة الفقرات الفرعية ";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=Ptext&currmod=bau&id_origin=$my_id&class_origin=Ptext&module_origin=bau&newo=3&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=parent_ptext_id=$my_id,pdocument_id=$pdocument_id&sel_parent_ptext_id=$my_id&sel_pdocument_id=$pdocument_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             if($mode=="mode_relatedList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة الفقرات ذات الصلة ";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=Ptext&currmod=bau&id_origin=$my_id&class_origin=Ptext&module_origin=bau&newo=3&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=related_ptext_id=$my_id,pdocument_id=$pdocument_id&sel_related_ptext_id=$my_id&sel_pdocument_id=$pdocument_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             
             
             
             
             
             //echo var_export($otherLinksArray,true); 
             return $otherLinksArray;          
        }
        
        public function getDisplay($lang="ar") 
        {
                return $this->valTitre_Short();   

	}
        
        public function getOrderByFields($join = true)
	{
		return "stakeholder_id,module_id,pdocument_id,parent_ptext_id,pnum,id";
	}
        
        public function attributeIsApplicable($attribute)
        {
              if($attribute=="id_atable")
              {
                  return false; 
              }
              
              if($attribute=="id_atable")
              {
                  return false; 
              }
              
              if($attribute=="pdocument_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9,8,6))); 
              }
              
              if($attribute=="parent_ptext_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9,8,6)));
              }
              
              if($attribute=="pnum")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9,8,6)));
              }
              
              if($attribute=="related_ptext_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9)));
              }
              
              if($attribute=="stakeholder_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="orgunit_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="module_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="id_theme")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="author_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5,9)));
              }
              
              if($attribute=="authors_mfk")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="relatedList")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9)));
              }
              
              if($attribute=="itemList")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5,6,7,8)));
              }
              
              

              return true;
         }
         
         public function beforeMAJ($id, $fields_updated) 
         {
		return true;
	 }
         
         public function newChild($pnum)
         {
	        $child = null;
                $ptextChildType = null;
                
                
                $ptextType = $this->het("ptext_type_id");
                
                if($ptextType and $ptextType->getId()==5) 
                {
                      $pdocument_id = $this->getId();
                      $parent_ptext_id = 0;
                }        
                else
                {
                      $pdocument_id = $this->getVal("pdocument_id");
                      $parent_ptext_id = $this->getId();
                } 
                
                if($ptextType) $ptextChildType = $ptextType->het("default_child_type_id");
                if($ptextChildType)
                {
                        $child = new Ptext();
                        $child->set("ptext_type_id",$ptextChildType->getId());
                        $child->set("ptext_cat_id",$ptextChildType->getVal("default_child_cat_id"));
                        $child->set("pdocument_id",$pdocument_id);
                        $child->set("parent_ptext_id",$parent_ptext_id);
                        $child->set("titre_short","عنوان نص $pnum");
                        $child->set("ntext","نص $pnum");
                        $child->set("pnum",$pnum);
                        $child->set("ptext_status_id",1);
                        $child->insert();
                }
                        
                return $child;
	 }
         
         protected function afterSetAttribute($attribute)
         {
                $spcount = $this->valSpcount();
                $itemList =  $this->get("itemList");
                $i=0;
                foreach($itemList as $itemId => $itemObj)
                {
                     if($i<$spcount)
                     {
                         $itemObj->set("pnum",$i*10+10);
                         $itemObj->activate();
                     }
                     else
                     {
                         $itemObj->logicDelete();
                     }
                     $i++;
                }
                
                while($i<$spcount)
                {
                    $this->newChild($i*10+10);
                    $i++;
                }
         }
   
      
                
       
         
}
?>