<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table user_story : user_story - قصص المستخدم 
// ------------------------------------------------------------------------------------
// ALTER TABLE `user_story` CHANGE `comments` `comments` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; 
// 8/7/21
// ALTER TABLE `user_story` CHANGE `user_story_name_ar` `user_story_name_ar` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; 
// ALTER TABLE `user_story` CHANGE `user_story_name_en` `user_story_name_en` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL; 
                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class UserStory extends AFWObject{

        public static $MY_ATABLE_ID=13700; 
        // إحصائيات حول قصص المستخدم 
        public static $BF_STATS_USER_STORY = 102407; 
        // إدارة قصص المستخدم 
        public static $BF_QEDIT_USER_STORY = 102402; 
        // إنشاء قصة مستخدم 
        public static $BF_EDIT_USER_STORY = 102401; 
        // الاستعلام عن قصة مستخدم 
        public static $BF_QSEARCH_USER_STORY = 102406; 
        // البحث في قصص المستخدم 
        public static $BF_SEARCH_USER_STORY = 102405; 
        // عرض تفاصيل قصة مستخدم 
        public static $BF_DISPLAY_USER_STORY = 102404; 
        // مسح قصة مستخدم 
        public static $BF_DELETE_USER_STORY = 102403; 

        
	public static $DATABASE		= ""; 
        public static $MODULE		    = "bau"; 
        public static $TABLE			= "user_story"; 
        public static $DB_STRUCTURE = null; 
        
        public function __construct(){
		parent::__construct("user_story","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "user_story_name_ar";
                
                $this->ORDER_BY_FIELDS = "system_id, module_id, jobrole_id, bfunction_id, user_story_name_ar";
                 
                
                $this->UNIQUE_KEY = array('system_id','module_id','jobrole_id','bfunction_id');
                $this->editByStep = true;
                $this->editNbSteps = 2;
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
                $this->deleteWithoutCheck = true;
                
                
	}
        
        public function getCode()
        {
             $system_id = $this->getVal('system_id');
             $module_id = $this->getVal('module_id');
             $jobrole_id = $this->getVal('jobrole_id');
             $bfunction_id = $this->getVal('bfunction_id');
             
             return "us-$system_id-$module_id-$jobrole_id-$bfunction_id";
        
        }
        
        public static function loadById($id)
        {
           $obj = new UserStory();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadByMainIndex($system_id, $module_id, $jobrole_id, $bfunction_id,$create_obj_if_not_found=false)
        {
           $obj = new UserStory();
           if(!$system_id) $obj->simpleError("loadByMainIndex : system_id is mandatory field");
           if(!$module_id) $obj->simpleError("loadByMainIndex : module_id is mandatory field");
           if(!$jobrole_id) $obj->simpleError("loadByMainIndex : jobrole_id is mandatory field");
           if(!$bfunction_id) $obj->simpleError("loadByMainIndex : bfunction_id is mandatory field");

           $obj->select("system_id",$system_id);
           $obj->select("module_id",$module_id);
           $obj->select("jobrole_id",$jobrole_id);
           $obj->select("bfunction_id",$bfunction_id);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("system_id",$system_id);
                $obj->set("module_id",$module_id);
                $obj->set("jobrole_id",$jobrole_id);
                $obj->set("bfunction_id",$bfunction_id);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }
        
        public static function loadAll($bfunction_id=0)
        {
                $obj = new UserStory();
                $obj->select("avail",'Y');
                if($bfunction_id) $obj->select("bfunction_id",$bfunction_id);

                $objList = $obj->loadMany();
                
                return $objList;
        }
        
        
        
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             return $otherLinksArray;
        }
        
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "yellow";
            $title_ar = "إنشاء نسخة مطابقة"; 
            $pbms["xc79Db"] = array("METHOD"=>"creerCopie","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true);
            
            
            $color = "red";
            $title_ar = "تصفير الهدف والصلاحية"; 
            $pbms["xa987b"] = array("METHOD"=>"resetGoalAndRole","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true);
            
            $color = "orange";
            $title_ar = "إعادة توليد المسميات والصلاحية"; 
            $pbms["Ad9h12"] = array("METHOD"=>"resetNamesAndRole","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true);
            
            $color = "green";
            $title_ar = "توليد الهدف والصلاحية"; 
            $pbms["xh127x"] = array("METHOD"=>"putGoalIfNeeded","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true);
            
            $color = "blue";
            $title_ar = "توليد القائمة اللازمة"; 
            $pbms["a9xcd0"] = array("METHOD"=>"genereMenusForMe","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true);
            
            
            
            return $pbms;
        }
        
        public function creerCopie($lang="ar")
        {
            $field_vals=array();
            $field_vals["jobrole_id"] = 0;
            return $this->createCopy($lang, $field_vals);
        }
        
        public function resetGoalAndRole($lang="ar")
        {
                $this->set("arole_id",0);
                $this->set("user_story_goal_id",0);
                $this->set("user_story_name_ar","--");
                $this->set("user_story_name_en","--");
                
                
                $this->update();
                
        }
        
        public function putGoalIfNeeded($lang="ar")
        {
             if(!$this->getVal("user_story_goal_id"))
             {
                $file_dir_name = dirname(__FILE__);
                        
                $jobrole = $this->het("jobrole_id");
		$module = $this->het("module_id");
		$bfunction = $this->het("bfunction_id");
		$goal = $this->het("user_story_goal_id");
                
                if($jobrole and $bfunction and $module) 
                {
                        $goal_id = 0;
                        $atable = $bfunction->hetTable();
                        $goal_decision = "";
                        // the concernd goal using this table
                        if((!$goal_id) and $atable)
                        {
                              $atable_id = $atable->getId();
                              $jobrole_id = $jobrole->getId();
                              require_once("$file_dir_name/../bau/goal_concern.php");
                              $goalList = GoalConcern::getJobRoleGoalListUsingTable($jobrole_id,$atable_id);
                              
                              if(count($goalList)>0)
                              {
                                   foreach($goalList as $goalItem)
                                   {
                                        $goal_id = $goalItem->getId();
                                        $goal = $goalItem;
                                        
                                        $goal_decision = "concerned goal : [$goal] for this job [$jobrole] and entity [$atable]";
                                   }
                              }
                              else
                              {
                                    $goal_decision .= " no concerned goals for this job [$jobrole] and entity [$atable]"; 
                              }
                        }
                        
                        // the concernd orgunit goal using this table
                        /*
                        if((!$goal_id) and $atable)
                        {
                              $atable_id = $atable->getId();
                              $orgUnitList = $module->get("orgUnitList");
                              require_once("$file_dir_name/../bau/goal_concern.php");
                              
                              foreach($orgUnitList as $orgUnitObj)
                              {
                                  if(!$goal_id)
                                  {    
                                      $goalList = GoalConcern::getOrgunitGoalListUsingTable($orgUnitObj->getId(),$atable_id);
                                      
                                      if(count($goalList)>0)
                                      {
                                           foreach($goalList as $goalItem)
                                           {
                                                $goal_id = $goalItem->getId();
                                                $goal = $goalItem;
                                                
                                                $goal_decision = "concerned job for this job and entity";
                                           }
                                      }
                                  }    
                              }
                        }
                        */
                        // if lookup  take lookup goal
                        if((!$goal_id) and $bfunction->isEnumOrLookup())
                        {
                              $goalLookup = $jobrole->het("lookupGoal");
                              if($goalLookup) 
                              {
                                  $goal_id = $goalLookup->getId();
                                  $goal_decision = "lookup goal for lookup BF";
                                  $goal = $goalLookup;
                              }
                              else $goal_decision .= " / lookup goal missed";
                              
                        }
                        
                        // if stats  take stats goal
                        if((!$goal_id) and $bfunction->isStats())
                        {
                              $goalStats = $jobrole->het("statsGoal");
                              if($goalStats) 
                              {
                                      $goal_id = $goalStats->getId();
                                      $goal_decision = "stats goal for stats BF";
                                      $goal = $goalStats;
                              }
                              else $goal_decision .= " / stats goal missed";
                        }
                        
                        // take the main goal for the jobrole or the BF
                        if(!$goal_id)
                        {
                                $mainGoalJob = $jobrole->getMainGoalByApplication($module->getId());
                                if($mainGoalJob) 
                                {
                                      $goal_id = $mainGoalJob->getId();
                                      // main goal of the job role
                                      // for module
                                      $goal_decision = "تم اعتماد الهدف الرئيسي للوظيفة $jobrole من التطبيق $module";
                                      $goal = $mainGoalJob;
                                }
                                else
                                {
                                      $goal_decision .= " / no main goal for jobrole [$jobrole] and module [$module]";
                                }
                        }
                        
                        if(!$goal_id)
                        {
                                
                                $goalBF = $bfunction->het("mainGoal");
                                if($goalBF) 
                                {
                                      if($goalBF->getVal("jobrole_id")==$this->getVal("jobrole_id"))
                                      {
                                              $goal_id = $goalBF->getId();
                                              $goal_decision = "main goal for the BF";
                                              $goal = $goalBF;
                                      }
                                      else
                                      {
                                              $goal_decision .= " / main goal for BF [$bfunction] is [$goalBF] is not associated to jobrole [$jobrole]";
                                      }
                                }
                                else
                                {
                                      $goal_decision .= " / no main goal for BF [$bfunction]";
                                }
                        }
                        
                        // take the only one goal if finished jobrole
                        if(!$goal_id)
                        {
                                $goals = $jobrole->getGoals();
                                if((count($goals)==1) and $jobrole->isFinished())
                                {
                                   foreach($goals as $goalItem)
                                   {
                                        $goal_id = $goalItem->getId();
                                        $goal = $goalItem;
                                        
                                        $goal_decision = "one goal and finished jobrole";
                                   }
                                }
                        }
                        
                        
                        
                        if($goal_id) $this->set("user_story_goal_id",$goal_id);
                        
                        
                        if($goal_id)
                        {
                                $this->goal_decision = $goal_decision;
                                // if($this->getId()==536)  $this->_error("this->goal_decision = ".$this->goal_decision);
                                $info = $goal_decision;
                                $err = "";
                        }
                        else
                        {
                                if(!$goal_decision) $goal_decision = "no goal found for the jobrole [$jobrole] and business function [$bfunction]";
                                $err = $goal_decision;
                                $info = "";
                                //throw new AfwRuntimeException("the '$this' user story can't find goal for this (jobrole=$jobrole, BF=$bfunction, module=$module) $goal_decision !");
                        }
                        $this->set("comments",$goal_decision);
                        
                        $this->commit();
                }
                else
                {
                         $err = "all of jobrole=[$jobrole] bfunction=[$bfunction] module=[$module] is required to search the convenient goal";
                         $info = "";
                }
                
            }
            else
            {
                 $err = "goal already exists";
                 $info = "";
            }
        
        
            return array($err,$info);
        }


        public function resetNamesAndRole($lang="ar")
        {
            $fields_updated_arr = array();
            $fields_updated_arr["jobrole_id"] = true;
            
            
            $this->beforeMAJ($this->getId(), $fields_updated_arr);
            $this->commit();
            if($this->maj_code) $errors = "errors : ".$this->maj_code;
            else $errors = "";
            
            return array($errors, "");
             
        }
        
        
        
        public function beforeMAJ($id, $fields_updated) 
        {
              global $lang, $MODE_BATCH_LOURD;
                $old_MODE_BATCH_LOURD = $MODE_BATCH_LOURD;
                $MODE_BATCH_LOURD = true;
                // throw new AfwRuntimeException("Fields Updated : ".var_export($fields_updated,true));
                if($this->isActive())
                {
                        
                        $file_dir_name = dirname(__FILE__);
                        
                        $jobrole = $this->het("jobrole_id");
        		$module = $this->het("module_id");
        		$bfunction = $this->het("bfunction_id");
        		$goal = $this->het("user_story_goal_id");
                        
                        if(($fields_updated["jobrole_id"]) or ($fields_updated["user_story_goal_id"]) or ($fields_updated["bfunction_id"]))
                        {
                             $name_to_regenere = true;
                        }
                        
                        
                        if($jobrole and $bfunction and $module)
                        {
                                $jobrole_ar = $jobrole->getShortDisplay("ar");
                                $jobrole_en = $jobrole->getShortDisplay("en");
                                if(!$jobrole_en) $jobrole_en = "---------------";
                                
                                $module_ar = $module->getShortDisplay("ar");
                                $module_en = $module->getShortDisplay("en");
                                if(!$module_en) $module_en = "---------------";
                                
                                $bfunction_ar = $bfunction->getShortDisplay("ar");
                                $bfunction_en = $bfunction->getShortDisplay("en");
                                if(!$bfunction_en) $bfunction_en = "---------------";
                                
                                
                                
                                
                                if($goal)
                                {
                                    $goal_ar = $goal->getWideDisplay("ar");
                                    $goal_en = $goal->getWideDisplay("en");
                                }
                                else
                                {
                                    $goal_ar = "-!! غاية غير معروفة !!-";
                                    $goal_en = "-!! UNKNOWN GOAL !!-";
                                }
                                
                                if(!$goal_en) $goal_en = "---------------";
                                
                                if($this->getVal("user_story_name_ar")=="--") $this->set("user_story_name_ar","");
                                if($this->getVal("user_story_name_en")=="--") $this->set("user_story_name_en",""); 
                
                                if((!trim($this->getVal("user_story_name_ar"))) or $name_to_regenere) {
                                           $this->set("user_story_name_ar","قيام $jobrole_ar بـ : $bfunction_ar");
                                           $this->set("user_story_desc_ar","بإعتباري $jobrole_ar أود $bfunction_ar لأجل  $goal_ar");
                                }
                                else $this->maj_code .= "<br>no_need_to_genere_arabic";
                
                                if((!trim($this->getVal("user_story_name_en"))) or $name_to_regenere) {
                                           $this->set("user_story_name_en","$jobrole_en do $bfunction_en");
                                           $this->set("user_story_desc_en","As $jobrole_en I want to $bfunction_en so that  $goal_en");
                                }
                                else $this->maj_code .= "<br>no_need_to_genere_english";
                                
                                $el_module = $bfunction->enumLookupModule();
                                
                                if($el_module)
                                {
                                        
                                        $module_id = $module->getId();
                                        $ar = Arole::getAssociatedRoleForSubModule($module_id, $el_module);
                                        if($ar) $this->set("arole_id",$ar->getId());
                                        else $this->maj_code .= "<br>Arole::getAssociatedRoleForSubModule($module_id, $el_module) returned empty result ";
                                }
                                else
                                {
                                        if((!$this->getVal("arole_id")) and $goal and ($goal->getId()>0)) 
                                        {
                                             $ar = $goal->getOrCreateAssociatedArole();
                                             if($ar) $this->set("arole_id",$ar->getId());
                                             else $this->maj_code .= "<br>$goal : goal->getOrCreateAssociatedArole() returned empty result ";
                                        }
                                        
                                        if(!$this->getVal("arole_id")) 
                                        {
                                                $aroles = $jobrole->getRoles();
                                                $count_aroles = count($aroles);
                                                
                                                if(($count_aroles==1) and $jobrole->isFinished())
                                                {
                                                   $arole_id = 0;
                                                   foreach($aroles as $job_arole)
                                                   {
                                                        $arole_id = $job_arole->getVal("arole_id");
                                                   }
                                                   
                                                   $this->set("arole_id",$arole_id);  
                                                }                                                                        
                                                else $this->maj_code .= "<br>$jobrole : jobrole->getRoles() count $count_aroles != 1 or jobrole not finished";
                                        }
                                }                        
                                
                        }
                        else $this->maj_code .= "<br> triplet jobrole:$jobrole and bfunction:$bfunction and module:$module is not ready";
                        
                        $this->genereMenusForMe($lang);
                }
                // $this->showQueryAndHalt = true;
                
                $MODE_BATCH_LOURD = $old_MODE_BATCH_LOURD;
		return true;
	}
        
        public function genereMenusForMe($lang="ar")
        {
                $err = "";
                $info = "";        
                
                
                $bfunction = $this->het("bfunction_id");
                $arole     = $this->het("arole_id");
                
                if(!$bfunction) $err = "no BF !";
                if(!$arole) $err = "no Arole !";        
                
                if($arole and $bfunction)
                {
                     list($warn,$err,$info) = $bfunction->updateMeInArole($arole,$menu=-1,$lang);
                     if($warn) $info .=  $warn;
                }
                
                return array($err,$info);
                
        }
        
        protected function beforeSetAttribute($attribute, $newvalue)
        {
              // if(($attribute=="user_story_goal_id") and ($newvalue>0) and ($this->getVal("bfunction_id")==103131) and ($newvalue!=46)) throw new AfwRuntimeException("user_story_goal_id setted to value $newvalue");
              
              $oldvalue = $this->getVal($attribute);
              
              if(($attribute=="user_story_goal_id") and ($newvalue>0))
              {
                   //throw new AfwRuntimeException("test rafik");
              }
              
              if(($attribute=="user_story_goal_id") and ($newvalue==0))
              {
                   $this->set("arole_id",0);
              }
              
              if(($attribute=="user_story_goal_id") and ($oldvalue != $newvalue) and ($newvalue>0) and ($oldvalue>0))
              {
                    if($this->getVal("source") == "auto-generated") $this->set("source","auto-generated-but-user-updated");
              }
              
              if(($attribute=="arole_id") and ($oldvalue != $newvalue) and ($newvalue>0) and ($oldvalue>0))
              {
                    if($this->getVal("source") == "auto-generated") $this->set("source","auto-generated-but-user-updated");
              }
              
              return true;
        }
        
        
        public function getRAMObjectData()
        {
                  $category_id = 11;

                  $type_id = 534;
                  
                  $code = $this->getCode();
                  
                  $jr = $this->hetJobrole();
                  if($jr)
                  {
                          $name_ar = $jr->getShortDisplay("ar");
                          $name_en = $jr->getShortDisplay("en");
                  }
                  else
                  {
                          $name_ar = $this->getVal("user_story_name_ar");
                          $name_en = $this->getVal("user_story_name_en");
                  }
                  $specification = $this->getVal("user_story_name_ar"); // ."\n------- comments : ---------\n".$this->getVal("comments")
                  
                  $childs = array();
                  
                  
                  return array($category_id, $type_id, $code, $name_ar, $name_en, $specification, $childs);
        
        }
        
        public function beforeDelete($id,$id_replace) 
        {
            
 
            if($id)
            {   
               if($id_replace==0)
               {
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - not deletable 
 
 
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - deletable 
 
 
                   // FK not part of me - replaceable 
 
 
 
                   // MFK
 
               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 
 
 
                        // MFK
 
 
               } 
               return true;
            }    
	}

        public function stepsAreOrdered()
        {
                return false;
        }
        
        
             
}
?>