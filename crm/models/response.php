<?php
class Response extends CrmObject
{

        public static $MY_ATABLE_ID = 3571;

        // RESPONSE - إجابة  
        public static $RESPONSE_TYPE_RESPONSE = 1;

        // COMMENT - تعليق  
        public static $RESPONSE_TYPE_COMMENT = 2;

        // STATUS_CHANGE - طلب تغيير حالة التذكرة  
        public static $RESPONSE_TYPE_STATUS_CHANGE = 3;

        // EMPLOYEE_CHANGE - طلب تحويل إلى موظف آخر  
        public static $RESPONSE_TYPE_EMPLOYEE_CHANGE = 4;

        // QUESTION - طرح سؤال  
        public static $RESPONSE_TYPE_QUESTION = 5;

        // DUPLICATED - إلغاء الطلب بسبب التكرار  
        public static $RESPONSE_TYPE_DUPLICATED = 6;

        // INTERNAL_COMMENT - تحرير معلومات داخلية لغاية تدريب الزملاء
        public static $RESPONSE_TYPE_INTERNAL_COMMENT = 7;

        // complete - استكمال البيانات  
        public static $RESPONSE_TYPE_COMPLETE = 12;

        // returned - إعادة الطلب الى الموظف
        public static $RESPONSE_TYPE_RETURNED_TO_EMPLOYEE = 14;

        public static $DATABASE                = "";
        public static $MODULE                    = "crm";
        public static $TABLE                        = "response";

        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct("response", "id", "crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "request_id, response_date desc, response_time desc";


                $this->UNIQUE_KEY = array('request_id', 'response_date', 'response_time');

                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
                $this->public_display = true;
                $this->public_edit = true;

                $this->after_save_edit = array("class" => 'Request', "attribute" => 'request_id', "currmod" => 'crm', "currstep" => 4);
        }

        public static function loadById($id)
        {
                $obj = new Response();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function createNewResponse(
                $request_id,
                $response_date,
                $response_time,
                $orgunit_id,
                $employee_id,
                $new_status_id,
                $response_type_id,
                $response_text,
                $response_link = "",
                $internal = "N",
                $module_id = 0
        ) {
                $respObj = self::loadByText($request_id, $response_text, $employee_id, $new_status_id, $response_type_id, $response_date, $response_time, $create_obj_if_not_found = true);
                $respObj->set("orgunit_id", $orgunit_id);                
                $respObj->set("response_link", $response_link);
                $respObj->set("internal", $internal);
                //$respObj->set("module_id",$module_id);
                $respObj->commit();

                return $respObj;
        }

        public static function loadByText($request_id, $response_text, $employee_id, $new_status_id, $response_type_id, $response_date, $response_time, $create_obj_if_not_found = false)
        {
                global $print_debugg, $print_sql;

                $obj = new Response();
                if (!$request_id) throw new AfwRuntimeException("loadByMainIndex : request_id is mandatory field");
                if (!$response_text) throw new AfwRuntimeException("loadByMainIndex : response_text is mandatory field");

                if (!$employee_id) $employee_id = 0; // machine
                if (!$new_status_id) throw new AfwRuntimeException("loadByMainIndex : new_status_id is mandatory field");
                if (!$response_type_id) throw new AfwRuntimeException("loadByMainIndex : response_type_id is mandatory field");
                

                $obj->select("request_id", $request_id);
                $obj->select("response_text", $response_text);
                $obj->select("employee_id", $employee_id);
                $obj->select("new_status_id", $new_status_id);
                $obj->select("response_type_id", $response_type_id);
                
                if ($obj->load()) {
                        return $obj;
                } 
                else
                {
                        $obj2 = Response::loadByMainIndex($request_id, $response_date, $response_time, false);
                        if($obj2)
                        {
                                return $obj2;
                        }
                        elseif ($create_obj_if_not_found) {
                                if ($print_debugg and $print_sql) echo "\n <br> not found with [request_id=$request_id response_date=$response_date response_time=$response_time] \n <br>";
                                $obj->set("request_id", $request_id);
                                $obj->set("response_text", $response_text);
                                $obj->set("employee_id", $employee_id);
                                $obj->set("new_status_id", $new_status_id);
                                $obj->set("response_type_id", $response_type_id);
                                if(!$response_date)
                                {
                                        $response_date = AfwDateHelper::currentHijriDate();
                                        $response_time = date("H:i:s");
                                }
                                $obj->set("response_date", $response_date);
                                $obj->set("response_time", $response_time);
        
                                $obj->insert();
                                $obj->is_new = true;
        
                                return $obj;
                        } else return null;
                }
                
                
        }

        public static function loadByMainIndex($request_id, $response_date, $response_time, $response_text="", $create_obj_if_not_found = false)
        {
                global $print_debugg, $print_sql;

                $obj = new Response();
                if (!$request_id) throw new AfwRuntimeException("loadByMainIndex : request_id is mandatory field");
                if (!$response_date) throw new AfwRuntimeException("loadByMainIndex : response_date is mandatory field");
                if (!$response_time) throw new AfwRuntimeException("loadByMainIndex : response_time is mandatory field");
                
                if ($create_obj_if_not_found and (!$response_text)) throw new AfwRuntimeException("loadByMainIndex : response_text is mandatory field when create_obj_if_not_found=true");

                $obj->select("request_id", $request_id);
                $obj->select("response_date", $response_date);
                $obj->select("response_time", $response_time);
                if ($print_debugg and $print_sql) echo "\n <br> loading response [request_id=$request_id response_date=$response_date response_time=$response_time] \n <br>";
                if ($obj->load()) {
                        if ($create_obj_if_not_found) {
                                $obj->set("response_text", $response_text);
                                $obj->activate();
                        }
                        $obj->is_new = false;
                        if ($print_debugg and $print_sql) echo "loaded response ... : $obj";
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        if ($print_debugg and $print_sql) echo "\n <br> not found with [request_id=$request_id response_date=$response_date response_time=$response_time] \n <br>";
                        $obj->set("request_id", $request_id);
                        $obj->set("response_date", $response_date);
                        $obj->set("response_time", $response_time);
                        $obj->set("response_text", $response_text);

                        if ($print_debugg and $print_sql) echo "\n <br> inserting response ... : $obj \n <br>";
                        $obj->insert();
                        $obj->is_new = true;
                        if ($print_debugg and $print_sql) echo "\n <br> inserted response *** : $obj\n <br>";

                        return $obj;
                } else return null;
        }


        public function getActionTitle($lang = "ar", $long = true)
        {
                $data = array();
                $link = array();


                if ($this->getVal("employee_id") > 100) {
                        $data[0] = "موظف خدمة العملاء";
                } elseif ($this->getVal("employee_id") > 0) {
                        $data[0] = $this->showAttribute("employee_id", null, true, $lang);
                } else $data[0] = "العميل";



                $typeObj = $this->hetType();
                if (($lang != "ar") and ($lang != "en")) $lang = "ar";
                if ($typeObj) {
                        $data[1] = $typeObj->getVal("verb_$lang");
                        /*
                       if($lang == "ar")
                       {
                               $empl = $this->het("employee_id");
                               if($empl and ($empl->getVal("gender_id") == 2))
                               {
                                     $data[1] .= "ـت"     ;
                               }
                       }
                       */

                        if ($long and ($typeObj->id == self::$RESPONSE_TYPE_STATUS_CHANGE)) {
                                list($data[2], $link[2]) = $this->displayAttribute("new_status_id", false, $lang);
                                $data[2] = " إلى "    . $data[2];
                        }
                }
                return implode(" ", $data);
        }

        public function getNodeDisplay($lang = "ar")
        {
                $response_text = strip_tags($this->getVal("response_text"));
                return AfwStringHelper::arabicStartOfJomlaTrim($response_text, 98);
        }

        public function getDisplay($lang = "ar")
        {

                $data = array();
                $link = array();


                list($data[0], $link[0]) = $this->displayAttribute("employee_id", false, $lang);
                list($data[1], $link[1]) = $this->displayAttribute("response_date", false, $lang);
                list($rtime, $link[2]) = $this->displayAttribute("response_time", false, $lang);

                $rtime_arr = explode(":", $rtime);
                unset($rtime_arr[2]);
                $data[2] = implode(":", $rtime_arr);
                // if($this->getId() == 14134) echo("this->getVal(response_text) = ".$this->getVal("response_text")."<br>\n");
                $response_text = $this->getVal("response_text");
                $subject = AfwStringHelper::arabicStartOfJomlaTrim($response_text, 34);
                // if($this->getId() == 14134) die("$subject = arabicStartOfJomlaTrim($response_text)");
                return $subject . " : " . implode(" - ", $data);
        }

        public function getShortDisplay($lang = "ar")
        {

                $data = array();
                $link = array();

                $objme = AfwSession::getUserConnected();
                if ($objme)
                        list($data[0], $link[0]) = $this->displayAttribute("employee_id", false, $lang);
                elseif ($this->getVal("employee_id") > 100) {
                        $data[0] = "موظف خدمة العملاء";
                } elseif ($this->getVal("employee_id") > 0) {
                        $data[0] = $this->showAttribute("employee_id", null, true, $lang);
                }

                if (!$data[0]) $data[0] = "العميل";



                $typeObj = $this->hetType();
                if (($lang != "ar") and ($lang != "en")) $lang = "ar";
                if ($typeObj) {
                        $data[1] = $typeObj->getVal("verb_$lang");
                        /*
                        if($lang == "ar")
                        {
                               $empl = $this->het("employee_id");
                               if($empl and ($empl->getVal("gender_id") == 2))
                               {
                                     $data[1] .= "ـت"     ;
                               }
                        }
                        */
                        /*
                        if($typeObj->id == self::$RESPONSE_TYPE_STATUS_CHANGE)
                        {
                                list($data[2],$link[2]) = $this->displayAttribute("new_status_id",false, $lang);
                                $data[2] = " إلى "    . $data[2];
                        }*/
                }
                return implode(" ", $data);
        }







        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
                global $me, $lang;
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $displ = $this->getDisplay($lang);

                return $otherLinksArray;
        }

        protected function getPublicMethods()
        {

                $pbms = array();

                $color = "green";
                $title_ar = "xxxxxxxxxxxxxxxxxxxx";
                //$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");



                return $pbms;
        }




        protected function initObject()
        {
                $objme = AfwSession::getUserConnected();

                $this->set("response_date", AfwDateHelper::currentHijriDate());
                $this->set("response_time", date("H:i:s"));
                $reqObj = $this->hetRequest();
                if ($reqObj) $this->set("orgunit_id", $reqObj->getVal("orgunit_id"));
                if ($objme) {
                        $empl_id = $objme->getEmployeeId();
                        $org_id = CrmEmployee::orgOfEmployee($empl_id);
                        if (!$this->getVal("orgunit_id")) {
                                $this->set("orgunit_id", $org_id);
                        }
                        if ($this->getVal("orgunit_id") == $org_id) {
                                $this->set("employee_id", $empl_id);
                        }
                }

                return true;
        }

        public function beforeInsert($id, $fields_updated)
        {
                $this->set("response_date", AfwDateHelper::currentHijriDate());
                $this->set("response_time", date("H:i:s"));
                $reqObj = $this->hetRequest();
                if ($reqObj) $this->set("orgunit_id", $reqObj->getVal("orgunit_id"));

                return true;
        }

        /* 
        rafik : 8/4/2021 : danger
        it calls change Status so it is done twice and the notification also is sent/pushed twice
        and can make infinite loop as change status create a Response object also
        public function afterMaj($id, $fields_updated) 
        {
                if($fields_updated["new_status_id"])
                {
                       $this->throwException("")
                       
                        // @todo if auto-approve-response 
                       
                       $auto_approve_response = true;
                       if($auto_approve_response)
                       {
                            $request = $this->getRequest();   
                            if($request)
                            {
                                //die("request->change Status to ".$this->getVal("new_status_id")." with comment : ".$this->getVal("response_text"));
                                // important keep silent true to avoid infinite loop
                                $request->change Status($this->getVal("new_status_id"), $this->getVal("response_text"), $this->getVal("internal"), $silent=true);
                            }
                            
                       }
                }
        }
        */


        public function beforeMaj($id, $fields_updated)
        {
                if ($this->getVal("internal") == "W") {
                        $this->set("internal", "N");
                }

                return true;
        }

        public function afterMaj($id, $fields_updated)
        {
                $lang = AfwSession::getSessionVar("current_lang");
                if ($fields_updated["new_status_id"] and $this->getVal("new_status_id")) {
                        //$this->throwException("")

                        // @todo if auto-approve-response 

                        $auto_approve_response = true;
                        if ($auto_approve_response) {
                                /**
                                 * @var Request $request
                                 */
                                $request = $this->hetRequest();
                                if ($request and // cond 1
                                    ($this->getVal("new_status_id") > 0) and // cond 2
                                    ($this->getVal("new_status_id") != $request->getVal("status_id")) // cond 3
                                    )
                                // we do this cond-3 above to be sure that this response inserted is manually inserted not automatic
                                // to avoid twice or infinite loop because change status create new response                   
                                {
                                        $employee_id = null;
                                        $objme_name = "";
                                        $objme = AfwSession::getUserConnected();
                                        if ($objme) $objme_name = $objme->getDisplay($lang);
                                        else {
                                                $custme = AfwSession::getCustomerConnected();
                                                if ($custme) $objme_name = $custme->getDisplay($lang);
                                                if (!$objme_name) 
                                                {
                                                        $objme_name = "المهمة الآلية";
                                                        $employee_id = 2;
                                                }
                                        }
                                        //die("request->change Status to ".$this->getVal("new_status_id")." with comment : ".$this->getVal("response_text"));                                        
                                        $action_enum = Request::status_action_by_code("responseCreatedStatusUpdated");
                                        $silent = true; // important keep silent true to avoid infinite loop
                                        $status_comment = "تم الرد على الطلب من قبل : " . $objme_name;
                                        $question_id = 0;
                                        $request->changeStatus($this->getVal("new_status_id"), $status_comment, $action_enum, $this->getVal("internal"), $silent, $question_id, $employee_id);

                                        // inform customer by SMS if prio <= 3 (prio 4 = low)
                                        if ($request->getVal("request_priority") <= 3) {
                                                $title = $request->getVal("request_title");
                                                $title = trim(AfwStringHelper::truncateArabicJomla($title, 20), " ");
                                                $success_message = $this->tm("the status of request", $lang) . " \"$title\" " . $this->tm("has been changed to", $lang) . " \"" . $this->decode("new_status_id") . "\"";
                                                $request->informCustomerBySMS($success_message, $lang);
                                        }
                                }
                        }
                }
                //else die("afterMaj $id fields_updated = ".var_export($fields_updated,true));
        }



        public function beforeDelete($id, $id_replace)
        {


                if ($id) {
                        if ($id_replace == 0) {
                                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - not deletable 


                                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK part of me - deletable 
                                // crm.response_data-الرد	response_id  أنا تفاصيل لها-OneToMany
                                $this->execQuery("delete from ${server_db_prefix}crm.response_data where response_id = '$id' ");


                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                $server_db_prefix = AfwSession::config("db_prefix", "default_db_"); // FK on me 
                                // crm.response_data-الرد	response_id  أنا تفاصيل لها-OneToMany
                                $this->execQuery("update ${server_db_prefix}crm.response_data set response_id='$id_replace' where response_id='$id' ");


                                // MFK


                        }
                        return true;
                }
        }

        public function calcUser_type()
        {

                $objme = AfwSession::getUserConnected();


                if ($objme) {
                        if ($objme->hasRole("crm", CrmObject::$AROLE_OF_SUPERVISOR)) {
                                return "superv_";
                        }

                        if ($objme->hasRole("crm", CrmObject::$AROLE_OF_INVESTIGATOR)) {

                                $employeeObj = $this->het("employee_id");
                                $employee_id = $employeeObj ? $employeeObj->id : 0;
                                if ($employeeObj) {
                                        $orgunit_id = $employeeObj->getVal("id_sh_dep");
                                }

                                $crmEmplObj = CrmEmployee::auserCrmEmployee($employee_id, $orgunit_id);
                                if ($crmEmplObj) {
                                        if ($crmEmplObj->sureIs("approved")) return "qinv_";
                                }

                                // حالة منسق بالنيابة : في غير ادارته ?
                                $reqObj = $this->hetRequest();
                                if ($reqObj) {
                                        $orgunit_id_request = $reqObj->getVal("orgunit_id");
                                }
                                if ($orgunit_id_request != $orgunit_id) {
                                        $crmEmplObj = CrmEmployee::auserCrmEmployee($employee_id, $orgunit_id_request);
                                }

                                if ($crmEmplObj and $crmEmplObj->sureIs("approved")) return "qinv_";

                                return "invest_";
                        }
                }


                return "unknown";
        }

        public function calcResponse_aut($what="value", $lang="ar")
        {                
                if ($this->getVal("employee_id") > 0) {
                        if($lang=="ar") return "خ";
                        else return "S";
                } 
                else
                {
                        if($lang=="ar") return "ع";   
                        else return "C";
                } 
        }

        public function calcResponse_cls()
        {
                if ($this->getVal("employee_id") > 0) {
                        return "service";
                } else return "customer";
        }

        public function calcResponse_templates()
        {
                global $lang;
                // die("here rafik bara salli");
                if (!$lang) $lang = "ar";

                $AllRespTplList = ResponseTemplate::loadAll($this->getVal("response_type_id"), $this->calcUser_type());
                // die(var_export($AllRespTplList,true));
                $templates = array();

                foreach ($AllRespTplList as $id => $itemRespTpl) {
                        $internal = $itemRespTpl->getVal("internal");
                        $new_status = $itemRespTpl->getVal("new_status");
                        $tit = $itemRespTpl->getTitle($lang);
                        $templates[$id . "-" . $tit] = array(
                                'internal' => $internal,
                                'new_status' => $new_status,
                                'text' => $itemRespTpl->getBody($lang, true)
                        );
                }
                if(count($templates)==0)
                {
                        $templates["مقدمة"] = array('internal' => 'N', 'new_status' => 0, 'text' =>  "السلام عليكم|مرحبا بك أخي الكريم");
                        $templates["طلب مكرر"] = array('internal' => 'N', 'new_status' => 8, 'text' =>  "السلام عليكم|مرحبا بك أخي الكريم هذا الطلب مكرر وسبق الرد عليه");
                        $templates["عدم اختصاص"] = array('internal' => 'Y', 'new_status' => 3, 'text' =>  "أرجوا تحويل الطلب إلى الجهة المختصة");
                }
                
                

                $html = "<div class='jsbtns'>";
                $i = 0;
                foreach ($templates as $template_title => $template_item) {
                        $template_text = $template_item["text"];
                        $template_text = str_replace("\n","|", $template_text);
                        $template_text = str_replace("\r","|", $template_text);
                        $template_internal = $template_item["internal"];
                        $template_new_status = $template_item["new_status"];

                        $html .= "<div class='btnjs btn$i'><input type='button' class='respbtn resp$i' value='$template_title' onClick=\"setResponseTemplate('$template_text', $template_new_status, '$template_internal')\"/></div>";
                        $i++;
                }
                $html .= "</div>";
                return $html;
        }

        public function getFieldGroupInfos($fgroup)
        {
                if ($fgroup == "request") return array("name" => $fgroup, "css" => "pct_25");
                if ($fgroup == "response") return array("name" => $fgroup, "css" => "pct_75");


                return array("name" => $fgroup, "css" => "none");
        }


        protected function afterSetAttribute($attribute)
        {
                if ($attribute == "response_type_id") {
                        $rtObj = $this->het("response_type_id");
                        if ($rtObj) $this->set("internal", $rtObj->getVal("internal"));
                }

                if ($attribute == "new_status_id") {
                        if ($this->getVal("new_status_id") == Request::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) {
                                $this->set("internal", "Y");
                        }
                }
        }


        public function getAttributeLabel($attribute, $lang = "ar", $short = false)
        {
                if ($attribute == "response_text") {
                        $rtObj = $this->het("response_type_id");
                        if ($rtObj) {
                                return $rtObj->getDisplay($lang);
                        }
                }

                /*
                if(($attribute=="response_text") and ($this->getVal("response_type_id") == 7))
                {
                        return "اكتب هنا المعلومات :";
                }*/
                return AfwLanguageHelper::getAttributeTranslation($this, $attribute, $lang, $short);
        }


        public function attributeIsApplicable($attribute)
        {
                if ($this->getVal("response_type_id") == 7) {
                        if ($attribute == "response_templates")  return false;
                        if ($attribute == "new_status_id")  return false;
                }

                return parent::attributeIsApplicable($attribute);
        }

        public function uploadedSuccessfully($file_code, $doc_type_id, $af)
        {
                global $lang;
                $file_dir_name = dirname(__FILE__);


                $pfObj = RequestFile::loadByMainIndex($this->getVal("request_id"), $af->getId(), $create_obj_if_not_found = true);
                $pfObj->set("doc_type_id", $doc_type_id);
                $pfObj->set("response_id", $this->getId());
                $pfObj->set("description", $af->getVal("afile_name") . " (" . $pfObj->showAttribute("doc_type_id") . ")");
                $pfObj->commit();
        }

        public function approveIfNotApproved()
        {
                $changed = false;
                $status_changed_to_done = false;
                if ($this->getVal("internal") != "N") {
                        $this->set("internal", "N");
                        $changed = true;
                }

                if ($this->getVal("new_status_id") == Request::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) {
                        $this->set("new_status_id", Request::$REQUEST_STATUS_DONE);
                        $status_changed_to_done = true;
                        $changed = true;
                }

                if ($changed) {
                        $this->commit();
                        if ($status_changed_to_done) {
                                $reqObj = $this->hetRequest();
                                if ($reqObj->getVal("status_id") != Request::$REQUEST_STATUS_DONE) {
                                        $reqObj->changeStatus(Request::$REQUEST_STATUS_DONE, "تم اعتماد الاجابة", "N", $silent = true);
                                }
                        }
                }

                return $changed;
        }


        public function needApproval()
        {
                /* 
            rafik 21/8/2022 : not understood, seems wrong
            if($this->getVal("internal")!="N") 
            { 
                return true;
            }
            */

                if ($this->getVal("new_status_id") == Request::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) {
                        return true;
                }

                return false;
        }

        public function myShortNameToAttributeName($attribute)
        {
                if ($attribute == "request") return "request_id";
                if ($attribute == "type") return "response_type_id";
                if ($attribute == "employee") return "employee_id";
                if ($attribute == "orgunit") return "orgunit_id";
                if ($attribute == "status") return "new_status_id";
		 
                return $attribute;
        }


        public function shouldBeCalculatedField($attribute){
                if($attribute=="request_text") return true;
                return false;
        }
}
