<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../pag/afw.php");

class SenderConfig extends MsgObject
{

    public static $MY_ATABLE_ID = 3599;

    public static $MAX_BLOC = 500;

    public static $DAYS_BEFORE_REMINDER = 5;

    public static $DAYS_BEFORE_SMS = 3;

    public static $DAYS_BECOME_OLD = 8;

    public static $DATABASE        = "";
    public static $MODULE            = "";
    public static $TABLE            = "";
    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("sender_config", "id", "msg");
        MsgSenderConfigAfwStructure::initInstance($this);  
    }

    public static function loadById($id)
    {
        $obj = new SenderConfig();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }



    public static function loadByMainIndex($sender_config_code, $create_obj_if_not_found = false)
    {
        $obj = new SenderConfig();
        if (!$sender_config_code) $obj->_error("loadByMainIndex : sender_config_code is mandatory field");


        $obj->select("sender_config_code", $sender_config_code);

        if ($obj->load()) {
            if ($create_obj_if_not_found) $obj->activate();
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("sender_config_code", $sender_config_code);

            $obj->insert();
            $obj->is_new = true;
            return $obj;
        } else return null;
    }


    public function getDisplay($lang = "ar")
    {
        if ($this->getVal("sender_config_name")) return $this->getVal("sender_config_name");
        $data = array();
        $link = array();




        return implode(" - ", $data);
    }



    public function list_of_frequency()
    {
        $list_of_items = array();
        $list_of_items[1] = "كل ساعة";  //     code : 1_HOUR
        $list_of_items[10] = "كل ربع ساعة";  //     code : 1/4_HOUR
        $list_of_items[2] = "كل 4 ساعات";  //     code : 4_HOUR
        $list_of_items[3] = "كل 8 ساعات";  //     code : 8_HOUR
        $list_of_items[4] = "كل 12 ساعة";  //     code : 12_HOUR 
        $list_of_items[5] = "يومي";  //     code : DAILY 
        $list_of_items[6] = "أسبوعي";  //     code : WEEKLY 
        $list_of_items[7] = "شهري";  //     code : MONTHLY 
        $list_of_items[8] = "سنوي";  //     code : YEARLY
        $list_of_items[9] = "متوقف";  //     code : STOPPED

        return  $list_of_items;
    }




    

    protected function getPublicMethods()
    {

        $pbms = array();


        $color = "red";
        $title_ar = "انشاء نسخة من هذه الخدمة";
        $pbms["25aba9"] = array("METHOD" => "createCopyOfMe", "COLOR" => $color, "LABEL_AR" => $title_ar, "ADMIN-ONLY" => true, "BF-ID" => "");


        $color = "green";
        $title_ar = "استيراد العملاء الجدد وإنشاء الرسائل وإرسال دفعة منها";
        $pbms["14xg7a"] = array("METHOD" => "loadNewCustomers", "COLOR" => $color, "LABEL_AR" => $title_ar, "ADMIN-ONLY" => true, "BF-ID" => "");

        $color = "yellow";
        $title_ar = "مراسلة عميل معين";
        $pbms["a5e5d8"] = array("METHOD" => "resendCustomer", "COLOR" => $color, "LABEL_AR" => $title_ar, "ADMIN-ONLY" => true, "BF-ID" => "");


        return $pbms;
    }


    public function loadNewCustomersDB($lang = "ar")
    {
        global $report_col, $mobile_col;

        $sender_config_code = $this->getVal("sender_config_code");
        $sender_config_id = $this->getId();

        $systemObj = $this->het("c_system_id");

        $system_code = $systemObj->valCode();

        $exec_params = $this->getVal("exec_params");

        $exec_param_arr = explode(",", $exec_params);

        foreach ($exec_param_arr as $exec_param_item) {
            list($exec_param, $exec_param_value) = explode("=", trim($exec_param_item));
            $exec_param = trim($exec_param);
            $exec_param_value = trim($exec_param_value);

            $$exec_param = $exec_param_value;
        }
        if(!$link_method) $link_method = "API";
        if (!$mobile_col) die("for [$sender_config_code/$sender_config_id] mobile_col not defined : params $exec_params : " . var_export($exec_param_arr, true));
        $methodinitCustomers = "initCustomers$system_code$link_method";
        list($res1, $res2, $res3) = $this->$methodinitCustomers($lang);

        $methodloadNewCustomers = "loadNewCustomers$system_code$link_method";
        list($error, $info, $dataCustomers) = $this->$methodloadNewCustomers($lang);

        list($error2, $info2, $results) = $this->prepareMessages($systemObj->getId(), $dataCustomers);

        $error_arr = array();
        $info_arr = array();

        if ($error) $error_arr[] = $error;
        if ($error2) $error_arr[] = $error2;

        if ($info) $info_arr[] = $info;
        if ($info2) $info_arr[] = $info2;


        return array(implode("<br>\n", $error_arr), implode("<br>\n", $info_arr), "", $results);
    }

    public function resendCustomer($lang = "ar")
    {
        global $report_col, $mobile_col, $resend_mobile, $resend_idn;

        $sender_config_code = $this->getVal("sender_config_code");

        $systemObj = $this->het("c_system_id");

        $system_code = $systemObj->valCode();

        $exec_params = $this->getVal("exec_params");

        $exec_param_arr = explode(",", $exec_params);

        foreach ($exec_param_arr as $exec_param_item) {
            list($exec_param, $exec_param_value) = explode("=", trim($exec_param_item));
            $exec_param = trim($exec_param);
            $exec_param_value = trim($exec_param_value);

            $$exec_param = $exec_param_value;
        }

        $dataCustomers = array();
        $dataCustomers[] = array("mobile" => $resend_mobile, "idn" => $resend_idn);

        list($error2, $info2, $results) = $this->prepareMessages($systemObj->getId(), $dataCustomers);

        $error_arr = array();
        $info_arr = array();

        if ($error) $error_arr[] = $error;
        if ($error2) $error_arr[] = $error2;

        if ($info) $info_arr[] = $info;
        if ($info2) $info_arr[] = $info2;


        return array(implode("<br>\n", $error_arr), implode("<br>\n", $info_arr), $results);
    }




    private function getSendingMode($sender_config_code)
    {
        if ($sender_config_code == "NARTAQI") return array('sms' => true, 'email' => false);

        return array('sms' => true, 'email' => false);
    }


    public function setMobileNumErronedLimeSurvey($customer_code)
    {
        global $db_arr, $report_col, $db_config;

        $module_code = $this->getVal("module_code");

        $file_dir_name = dirname(__FILE__);
        require_once("$file_dir_name/../pag/common_date.php");
        $now = date("Y-m-d H:i:s");

        $reason = "رقم الجوال خطأ";

        if ($report_col) $report_col_sentence = ", $report_col = '$reason'";
        else $report_col_sentence = "";

        $sql_MobileNumErroned = "update lime_tokens_$module_code  set blacklisted = 'Y' $report_col_sentence where tid ='$customer_code' and sent = 'N'";
        $res = AfwDB::execQuery("limesurvey", $sql_MobileNumErroned);



        return $res;
    }


    public function setSendFailedLimeSurvey($customer_code, $reason)
    {
        global $db_arr, $report_col, $db_config;

        
        $module_code = $this->getVal("module_code");

        $now = date("Y-m-d H:i:s");

        $reason = addslashes($reason);

        if ($report_col) $report_col_sentence = ", $report_col = '$reason'";
        else $report_col_sentence = "";

        $sql_MobileNumErroned = "update lime_tokens_$module_code  set blacklisted = 'W' $report_col_sentence where tid ='$customer_code' and sent = 'N'";
        $res = AfwDB::execQuery("limesurvey", $sql_MobileNumErroned);

        return $res;
    }

    public function setCustomerDoneLimeSurvey($customer_code)
    {
        global $db_arr, $db_config;

        $module_code = $this->getVal("module_code");

        $now = date("Y-m-d H:i:s");

        $sql_CustomerDone2 = "update lime_tokens_$module_code  set blacklisted = 'N', remindersent = '$now', remindercount = remindercount+1 where tid ='$customer_code' and sent != 'N'";
        $res2 = AfwDB::execQuery("limesurvey", $sql_CustomerDone2);

        $sql_CustomerDone = "update lime_tokens_$module_code  set blacklisted = 'N', sent = '$now' where tid ='$customer_code' and sent = 'N'";
        $res1 = AfwDB::execQuery("limesurvey", $sql_CustomerDone);

        return ($res1 or $res2);
    }


    public function initCustomersLimeSurveyAPI($lang = "ar")
    {
        // global $report_col, $mobile_col;
    }

    public function initCustomersLimeSurveyDB($lang = "ar")
    {
        global $db_arr, $report_col, $mobile_col, $db_config;
        $module_code = $this->getVal("module_code");
        
        $now = date("Y-m-d H:i:s");

        $reason = "توكن مفقودة";
        if ($report_col) $report_col_sentence = ", $report_col = '$reason'";
        else $report_col_sentence = "";
        $sql_case1 = "update lime_tokens_$module_code  set blacklisted = 'Y' $report_col_sentence where sent = 'N' and (token = '' or token is null)";
        $res1 = AfwDB::execQuery("limesurvey", $sql_case1);

        $reason = "تمت مراسلته بطريقة أخرى وأجاب";
        if ($report_col) $report_col_sentence = ", $report_col = '$reason'";
        else $report_col_sentence = "";
        $sql_case2 = "update lime_tokens_$module_code  set sent = '$now' $report_col_sentence where sent = 'N' and token != '' and completed != 'N'";
        $res2 = AfwDB::execQuery("limesurvey", $sql_case2);

        $reason = "رقم الجوال غير مكتمل";
        if ($report_col) $report_col_sentence = ", $report_col = '$reason'";
        else $report_col_sentence = "";
        $sql_case3 = "update lime_tokens_$module_code  set blacklisted = 'Y' $report_col_sentence where sent = 'N' and token != '' and completed = 'N' and length($mobile_col)<9";
        $res3 = AfwDB::execQuery("limesurvey", $sql_case3);


        return array($res1, $res2, $res3);
    }

    private function getCustomersCondition($sender_config_code)
    {
        global $mobile_col;

        $days_become_old = self::$DAYS_BECOME_OLD;
        $days_before_sms = self::$DAYS_BEFORE_SMS;
        $days_before_reminder = self::$DAYS_BEFORE_REMINDER;


        $matching_cols_arr = array();
        $where = "0 -- because sql cond of : " . $sender_config_code . "is not defined";

        // die("rafik test urgent 01");

        // (sent = 'N' or ())

        if (AfwStringHelper::stringStartsWith($sender_config_code, "SPRO")) {
            $where = "token != '' and sent = 'N' and completed = 'N' and length($mobile_col)>= 9 and blacklisted is null";

            $matching_cols_arr["'unknown'"] = "customer_type";
            $matching_cols_arr[$mobile_col] = "mobile";
        } elseif ($sender_config_code == "NARTAQI_REM") {
            $file_dir_name = dirname(__FILE__);
            require_once("$file_dir_name/../pag/common_date.php");
            $date_auj = date("Y-m-d");
            $date_reminder = add_n_days(false, -$days_before_reminder, $date_auj, "Y-m-d");
            //$date_old_ticket = add_n_days(false, -$days_become_old, $date_auj, "Y-m-d");

            $where = "token != '' and sent != 'N' and sent < '$date_reminder' and remindersent = 'N' and completed = 'N' and length(attribute_5)>= 9";

            $matching_cols_arr["attribute_2"] = "f0";
            $matching_cols_arr["'unknown'"] = "customer_type";
            $matching_cols_arr["attribute_5"] = "mobile";
            $matching_cols_arr["attribute_1"] = "f1";
        } elseif (AfwStringHelper::stringEndsWith($sender_config_code, "_REM")) {
            $file_dir_name = dirname(__FILE__);
            require_once("$file_dir_name/../pag/common_date.php");
            $date_auj = date("Y-m-d");
            $date_reminder = add_n_days(false, -$days_before_reminder, $date_auj, "Y-m-d");
            //$date_old_ticket = add_n_days(false, -$days_become_old, $date_auj, "Y-m-d");

            $where = "token != '' and sent != 'N' and sent < '$date_reminder' and remindersent = 'N' and completed = 'N' and length($mobile_col)>= 9";

            $matching_cols_arr["'unknown'"] = "customer_type";
            $matching_cols_arr[$mobile_col] = "mobile";
        } elseif ($sender_config_code == "NARTAQI") {
            $where = "token != '' and sent = 'N' and completed = 'N' and length(attribute_5)>= 9";

            $matching_cols_arr["attribute_2"] = "f0";
            $matching_cols_arr["'unknown'"] = "customer_type";
            $matching_cols_arr["attribute_5"] = "mobile";
            $matching_cols_arr["attribute_1"] = "f1";
        } else die("sender_config_code=$sender_config_code not managed");
        /*
            if(($sender_config_code=="MOTAATHER_MALE") or 
               ($sender_config_code=="MOTASARREB_MALE") or 
               ($sender_config_code=="MOTAATHER_FEMALE") or 
               ($sender_config_code=="MOTASAREB_FEMALE")) 
            {
                $file_dir_name = dirname(__FILE__);
                require_once("$file_dir_name/../pag/common_date.php");
                $date_auj = date("Y-m-d");
                $date_from = add_n_days(false, -$days_before_reminder, $date_auj, "Y-m-d");
                // @todo:rafik : no more reminder then create new sender-config
                $where = "token != '' and sent = 'N' and completed = 'N' and length(attribute_1)>= 9";
                
                
                $matching_cols_arr["'unknown'"] = "customer_type";
                $matching_cols_arr["attribute_1"] = "mobile";
                $matching_cols_arr["attribute_2"] = "gf1";
                $matching_cols_arr["attribute_3"] = "gf2";
                $matching_cols_arr["attribute_4"] = "gf3";
            }
            
            if(($sender_config_code=="RYADA")) 
            {
                $file_dir_name = dirname(__FILE__);
                require_once("$file_dir_name/../pag/common_date.php");
                $date_auj = date("Y-m-d");
                $date_from = add_n_days(false, -$days_before_reminder, $date_auj, "Y-m-d");
                
                $where = "token != '' and (sent = 'N') and completed = 'N' and length(attribute_1)>= 9";
                
                
                $matching_cols_arr["'student-ryada'"] = "customer_type";
                $matching_cols_arr["attribute_1"] = "mobile";
                $matching_cols_arr["attribute_2"] = "gf2";
                $matching_cols_arr["attribute_3"] = "gf3";
                $matching_cols_arr["attribute_4"] = "gf4";
                $matching_cols_arr["attribute_5"] = "gf5";
                $matching_cols_arr["attribute_6"] = "gf6";
                $matching_cols_arr["attribute_7"] = "gf7";
                $matching_cols_arr["attribute_8"] = "gf8";
                $matching_cols_arr["attribute_9"] = "gf9";
            }    
            */



        return array($where, $matching_cols_arr);
    }

    public function countNewCustomers()
    {
        global $max_bloc_simul, $max_bloc;

        $sender_config_code = $this->getVal("sender_config_code");

        $module_code = $this->getVal("module_code");
        $exec_params = $this->getVal("exec_params");

        $exec_param_arr = explode(",", $exec_params);

        foreach ($exec_param_arr as $exec_param_item) {
            list($exec_param, $exec_param_value) = explode("=", trim($exec_param_item));
            $exec_param = trim($exec_param);
            $exec_param_value = trim($exec_param_value);

            $$exec_param = $exec_param_value;
        }

        list($whereFilter, $matching_cols_arr) = $this->getCustomersCondition($sender_config_code);
        if ($max_bloc_simul) $max_bloc = $max_bloc_simul;

        $sql_NbCustomersLimeSurvey = "select count(*) as nb
                                          from lime_tokens_$module_code 
                                          where $whereFilter";

        $nbCustomers = AfwDB::getValueFromSQL("limesurvey", $sql_NbCustomersLimeSurvey, "nb");

        return $nbCustomers."<!-- $sql_NbCustomersLimeSurvey -->";
    }

    public function loadNewCustomersLimeSurvey($lang = "ar")
    {
        // global $db_arr, $max_bloc_simul, $db_config;

        $error = "";
        $info = "";



        $sender_config_code = $this->getVal("sender_config_code");

        $module_code = $this->getVal("module_code");

        $exec_params = $this->getVal("exec_params");

        $exec_param_arr = explode(",", $exec_params);

        foreach ($exec_param_arr as $exec_param_item) {
            list($exec_param, $exec_param_value) = explode("=", trim($exec_param_item));
            $exec_param = trim($exec_param);
            $exec_param_value = trim($exec_param_value);

            $$exec_param = $exec_param_value;
        }

        list($whereFilter, $matching_cols_arr) = $this->getCustomersCondition($sender_config_code);
        $max_bloc = 100;

        $cols_matched = "";
        foreach ($matching_cols_arr as $col_origin => $col_matched) {
            $cols_matched .= ", \n                                                ";
            $cols_matched .= "$col_origin as $col_matched";
        }



        if (!$max_bloc) $max_bloc = self::$MAX_BLOC;

        $sql_CustomersLimeSurvey = "select  tid as customer_code, 
                                                token as idn, 
                                                email, 
                                                firstname as first_name,
                                                lastname as last_name$cols_matched
                                                

                                          from lime_tokens_$module_code 
                                          where $whereFilter
                                          limit $max_bloc";

        $info .= $sql_CustomersLimeSurvey . "\n<br>";

        $dataCustomers = AfwDB::getDataFromSQL("limesurvey", $sql_CustomersLimeSurvey);

        $dataCustomers_rowsNb = count($dataCustomers);

        $info .= "result row count : $dataCustomers_rowsNb\n<br>";

        return array($error, $info, $dataCustomers);
    }


    private function prepareMessages($c_system_id, $dataCustomers, $create_update_customer = true)
    {
        global $nb_instances, $lang, $any_token, $report_col, $mobile_col, $max_bloc_simul;

        $this_id = $this->getId();
        $systemObj = $this->het("c_system_id");

        $system_code = $systemObj->valCode();

        $exec_params = $this->getVal("exec_params");

        $exec_param_arr = explode(",", $exec_params);

        foreach ($exec_param_arr as $exec_param_item) {
            list($exec_param, $exec_param_value) = explode("=", trim($exec_param_item));
            $exec_param = trim($exec_param);
            $exec_param_value = trim($exec_param_value);

            $$exec_param = $exec_param_value;
        }
        if ($max_bloc_simul) $max_bloc = $max_bloc_simul;
        if (!$max_bloc) $max_bloc = self::$MAX_BLOC;

        // update customers
        require_once("customer.php");
        $new_cust = 0;
        $upd_cust = 0;
        $all_cust = 0;
        $ddb_cust = 0;
        $custList = array();
        $duplicatedCustList = array();
        foreach ($dataCustomers as $rowCustomer) 
        {
            $rowCustomer["mobile"] = AfwFormatHelper::formatMobile($rowCustomer["mobile"]);

            $cust = Customer::loadByMainIndex($rowCustomer["mobile"], $rowCustomer["idn"], $create_update_customer);
            if (!$cust->getId()) die("cust : " . var_export($cust, true));
            if ($create_update_customer) {
                $cust->set("customer_code", $rowCustomer["customer_code"]);
                $cust->set("customer_type", $rowCustomer["customer_type"]);

                $cust->set("email", $rowCustomer["email"]);
                $cust->set("first_name", $rowCustomer["first_name"]);
                $cust->set("last_name", $rowCustomer["last_name"]);
                $cust->addRemoveInMfk("c_system_mfk", array($c_system_id), array());
                $done = $cust->commit();
            } else {
                $done = false;
            }
            //if($rowCustomer["customer_title"]) $cust->setField($c_system_id, 0, $rowCustomer["customer_title"]);


            for ($i = 0; $i <= 7; $i++) {
                if ($rowCustomer["f$i"]) $cust->setField($c_system_id, $i, $rowCustomer["f$i"]);
            }

            if ($done) {
                if ($cust->is_new) $new_cust++;
                else $upd_cust++;
            }

            $all_cust++;

            if ($custList[$cust->getId()]) {
                $duplicatedCustList[$cust->getId()] = true;
            } else $custList[$cust->getId()] = true;

            $nb_instances = 0;
        }
        unset($dataCustomers);
        $ddb_cust = count($custList);
        $duplicated_customers = $all_cust - $ddb_cust;
        // create needed messages
        require_once("c_message.php");
        $new_msg = 0;
        $exist_msg = 0;
        $already_sent_sms = 0;
        $already_sent_email = 0;
        $sent_msg = 0;
        $sent_msg_failed = 0;
        $sent_email = 0;
        $sent_email_failed = 0;
        $ignored_message = 0;
        $body_updated = 0;
        $log_fails = array();
        $log_alst = array();
        $log_infos = array();

        $subjectModel = $this->valSubject();
        $bodyModel = $this->valBody();

        $sender_config_code = $this->getVal("sender_config_code");

        $modeSendingArr = $this->getSendingMode($sender_config_code);

        CMessage::disableAllNotSent();

        foreach ($custList as $custId => $bool) {
            $custObj = Customer::loadById($custId);

            if(AfwFormatHelper::isCorrectMobileNum($custObj->getVal("mobile")))
            {

            
                $custObj->c_system_id = $c_system_id;

                $subject = $custObj->decodeText($subjectModel, "", false, $sepBefore = "{", $sepAfter = "}");
                $body = $custObj->decodeText($bodyModel, "", false, $sepBefore = "{", $sepAfter = "}");

                $messageObj = CMessage::loadByMainIndex($custId, $subject, $create_obj_if_not_found = true);
                $messageObj->set("sender_config_id", $this->getId());
                $messageObj->set("mobile", AfwFormatHelper::formatMobile($custObj->getVal("mobile")));


                if ($messageObj->is_new) {
                    $messageObj->set("body", $body);
                    if ($modeSendingArr["sms"]) $modeSendingSMS = "Y";
                    else $modeSendingSMS = "N";

                    if ($modeSendingArr["email"]) $modeSendingEMAIL = "Y";
                    else $modeSendingEMAIL = "N";

                    $messageObj->set("sms_tobe_sent", $modeSendingSMS);
                    $messageObj->set("email_tobe_sent", $modeSendingEMAIL);

                    $messageObj->set("sms_sent", "N");
                    $messageObj->set("email_sent", "N");

                    $new_msg++;
                } else {
                    if ((!$messageObj->is("sms_sent", false)) and (!$messageObj->is("email_sent", false))) {
                        $old_body = $messageObj->getVal("body");
                        if ($old_body != $body) {
                            $messageObj->set("body", $body);
                            $body_updated++;
                        }
                    }
                    $messageObj->set("version", $messageObj->getVal("version") + 1);
                    $exist_msg++;
                }
                $messageObj->commit();
                if ($messageObj->is("sms_tobe_sent", false)) {
                    if (!$messageObj->is("sms_sent", false)) {
                        if ($sent_msg < $max_bloc) {
                            list($error_send_sms, $info_send_sms, $mobile_num_erroned) = $messageObj->sendSMS($lang = "ar", $simul_send, $application_id = 40);

                            if (!$error_send_sms) {
                                $sent_msg++;
                                $methodsetCustomerDone = "setCustomerDone$system_code";
                                $msg_customer_code = $custObj->getVal("customer_code");
                                $this->$methodsetCustomerDone($msg_customer_code);
                                if ($info_send_sms) $log_infos[] = $info_send_sms;
                            } else {
                                if ($mobile_num_erroned) {
                                    $methodsetMobileNumErroned = "setMobileNumErroned$system_code";
                                    $msg_customer_code = $custObj->getVal("customer_code");
                                    $this->$methodsetMobileNumErroned($msg_customer_code);
                                } else {
                                    $methodsetSendFailed = "setSendFailed$system_code";
                                    $msg_customer_code = $custObj->getVal("customer_code");
                                    $this->$methodsetSendFailed($msg_customer_code, $error_send_sms);
                                }

                                $sent_msg_failed++;
                                $log_fails[] = $error_send_sms . " لـ : " . $messageObj->getDisplay($lang);
                            }
                        } else {
                            $sent_msg_failed++;
                            $log_fails[] = "تجاوز عد الرسائل المرسلة الحد الأقصى لدفة واحدة. بالتالي الغي الارسال لـ : " . $messageObj->getDisplay($lang);
                        }
                    } else {
                        $already_sent_sms++;
                        $log_alst[] = "تم سابقا ارسال هذه الرسالة  : " . $messageObj->getDisplay($lang) . " على الرقم " . $messageObj->getVal("mobile");
                        $methodsetCustomerDone = "setCustomerDone$system_code";
                        $msg_customer_code = $custObj->getVal("customer_code");
                        $this->$methodsetCustomerDone($msg_customer_code);
                    }
                } elseif ($messageObj->is("email_tobe_sent", false)) {
                    if (!$messageObj->is("email_sent", false)) {
                        //@todo to be implemented (rafik)

                        // email send failed because not yet implemented
                        $sent_email_failed++;
                        $log_fails[] = " فشل ارسال البريد الالكتروني ريثما يكتمل التطوير  " . $messageObj->getDisplay($lang);
                    } else $already_sent_email++;
                } else $ignored_message++;

                $nb_instances = 0;
                unset($messageObj);
                unset($custObj);
            }
        }

        if (count($duplicatedCustList)) {
            $log_duplicated_customers = "<div class=\"WarningTitle right expand collapsed\" data-toggle=\"collapse\" data-target=\"#duplicated_lst$this_id\" aria-expanded=\"false\">";
            $log_duplicated_customers .= "اضغط هنا لعرض العملاء المكررين";
            $log_duplicated_customers .= "</div>";
            $log_duplicated_customers .= "<div class=\"log_warning hzm_grid hzm_border collapse\" id=\"duplicated_lst$this_id\" aria-expanded=\"false\">";
            $log_duplicated_customers .= implode("<br>\n", $duplicatedCustList);
            $log_duplicated_customers .= "</div>";
        }

        if (count($log_fails)) {
            $log_fails_div = "<div class=\"WarningTitle right expand collapsed\" data-toggle=\"collapse\" data-target=\"#error_mess$this_id\" aria-expanded=\"false\">";
            $log_fails_div .= "اضغط هنا لعرض محاولات الارسال الغير ناجحة";
            $log_fails_div .= "</div>";
            $log_fails_div .= "<div class=\"log_warning hzm_grid hzm_border collapse\" id=\"error_mess$this_id\" aria-expanded=\"false\">";
            $log_fails_div .= implode("<br>\n", $log_fails);
            $log_fails_div .= "</div>";
        }

        if (count($log_infos)) {
            $log_infos_div = "<div class=\"WarningTitle right expand collapsed\" data-toggle=\"collapse\" data-target=\"#infos_mess$this_id\" aria-expanded=\"false\">";
            $log_infos_div .= "الملاحظات";
            $log_infos_div .= "</div>";
            $log_infos_div .= "<div class=\"log_warning hzm_grid hzm_border collapse\" id=\"infos_mess$this_id\" aria-expanded=\"false\">";
            $log_infos_div .= implode("<br>\n", $log_infos);
            $log_infos_div .= "</div>";
        }

        if (count($log_alst)) {
            $log_alst_div = "<div class=\"WarningTitle right expand collapsed\" data-toggle=\"collapse\" data-target=\"#duplicated_mess$this_id\" aria-expanded=\"false\">";
            $log_alst_div .= "اضغط هنا لعرض محاولات الارسال المكررة";
            $log_alst_div .= "</div>";
            $log_alst_div .= "<div class=\"log_warning hzm_grid hzm_border collapse\" id=\"duplicated_mess$this_id\" aria-expanded=\"false\">";
            $log_alst_div .= implode("<br>\n", $log_alst);
            $log_alst_div .= "</div>";
        }

        $results = array(
            "loaded_customers" => $all_cust,
            "duplicated_customers" => $duplicated_customers,
            "log_duplicated_customers" => $log_duplicated_customers,
            "new_customers" => $new_cust,
            "updated_customers" => $upd_cust,
            "new_messages" => $new_msg,
            "already_exists_messages" => $exist_msg,
            "message_body_updated" => $body_updated,
            "not_to_be_sent_messages" => $ignored_message,
            "already_sent_emails" => $already_sent_email,
            "successfull_emails_sent" => $sent_email,
            "failed_emails_sent" => $sent_email_failed,
            "already_sent_sms" => $already_sent_sms,
            "log_already_sent_sms" => $log_alst_div,
            "successfull_sms_sent" => $sent_msg,
            "log_infos" => $log_infos_div,
            "failed_sms_sent" => $sent_msg_failed,
            "log_fails" => $log_fails_div
        );

        $html_info = var_export($results, true);

        return array("", $html_info, $results);
    }


    public function getCustomerCount()
    {
        $c_system_id = $this->getVal("c_system_id");

        $file_dir_name = dirname(__FILE__);
        require_once("$file_dir_name/customer.php");

        $cust = new Customer();
        $cust->select("active", 'Y');
        $cust->where("c_system_mfk like '%,$c_system_id,%'");

        return $cust->count();
    }


    public function getMessageCount($sms_sent = false, $email_sent = false)
    {
        $file_dir_name = dirname(__FILE__);
        require_once("$file_dir_name/c_message.php");

        $cm = new CMessage();

        $cm->select("sender_config_id", $this->getId());
        $cm->select("active", 'Y');
        if ($sms_sent) $cm->select("sms_sent", 'Y');
        if ($email_sent) $cm->select("email_sent", 'Y');

        return $cm->count();
    }

    public function getLastMessageDate($sms_sent = false, $email_sent = false)
    {
        $file_dir_name = dirname(__FILE__);
        require_once("$file_dir_name/c_message.php");

        $cm = new CMessage();

        $cm->select("sender_config_id", $this->getId());
        $cm->select("active", 'Y');
        if ($sms_sent) $cm->select("sms_sent", 'Y');
        if ($email_sent) $cm->select("email_sent", 'Y');

        $return = $cm->func("max(sms_sent_date)");

        if (!$return) $return = "0000-00-00";

        return $return;
    }

    public function getWaitingSMSCount()
    {
        $file_dir_name = dirname(__FILE__);
        require_once("$file_dir_name/c_message.php");

        $cm = new CMessage();

        $cm->select("sender_config_id", $this->getId());
        $cm->select("active", 'Y');
        $cm->select("sms_sent", 'N');
        $cm->select("sms_tobe_sent", 'Y');

        return $cm->count();
    }

    public function getWaitingEmailCount()
    {
        $file_dir_name = dirname(__FILE__);
        require_once("$file_dir_name/c_message.php");

        $cm = new CMessage();

        $cm->select("sender_config_id", $this->getId());
        $cm->select("active", 'Y');
        $cm->select("email_sent", 'N');
        $cm->select("email_tobe_sent", 'Y');

        return $cm->count();
    }


    

    public function getFormuleResult($attribute, $what = "value")
    {
        global $server_db_prefix, $objme, $images;

        $file_dir_name = dirname(__FILE__);

        switch ($attribute) {
            case "customer_count":
                if (true)
                    $fn = $this->countNewCustomers();
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;

            case "all_message_count":
                if (true)
                    $fn = $this->getMessageCount();
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;



            case "sms_sent_count":
                if (true)
                    $fn = $this->getMessageCount(true, false);
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;

            case "last_sms_sent_date":
                if (true)
                    $fn = $this->getLastMessageDate(true, false);
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;

            case "sms_wait_count":
                if (true)
                    $fn = $this->getWaitingSMSCount();
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;

            case "email_wait_count":
                if (true)
                    $fn = $this->getWaitingEmailCount();
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;

            case "email_sent_count":
                if (true)
                    $fn = $this->getMessageCount(false, true);
                else
                    $fn = "<img src='../lib/images/fields.png' data-toggle='tooltip' data-placement='top' title='to see fields count please activate the compute stats option'  width='20' heigth='20'>";
                return $fn;
                break;

            default:    
            return AfwFormulaHelper::calculateFormulaResult($this, $attribute, $what);
        }
    }

    public function createCopyOfMe($lang = "ar")
    {
        $copyObj = new SenderConfig();
        $copyObj->copyDataFrom($this);

        if ($this->OBJECT_CODE) $copyObj->set($this->OBJECT_CODE, date("YmdHis") . $this->getMyCode());

        if ($this->DISPLAY_FIELD) $copyObj->set($this->DISPLAY_FIELD, $this->getDisplay() . "...copy");

        $copyObj->set("exec_params", $copyObj->getVal("exec_params") . ",simul_send=1,max_bloc=2");
        // specific
        // متوقف - stopped
        $copyObj->set("frequency", 9);
        $copyObj->commit();
        //die(var_export($copyObj,true));
        return array("", "$copyObj created");
    }
}
