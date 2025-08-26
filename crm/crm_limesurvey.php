<?php

class CrmLimesurvey
{

    public static function surveyCustomerSatisfactionAndBackToCrm2($send_limit = 100)
    {
        $crm_survey_id = AfwSession::config('crm_survey_id', '174363');

        $compain_start_date = add_n_days(false, -120, "", "Y-m-d");

        $date_start_migration_back = add_n_days(false, -30, "", "Y-m-d"); // 60

        $nb_survey_update_back = 0;
        $nb_bad_customer = 0;
        $nb_bad_request = 0;

        $sql_data_from_survey = "select s.token, mpid, completed, attribute_1 as ticket_num, attribute_5 as mobile, email, ipaddr, ${crm_survey_id}X1X1 as FAST, ${crm_survey_id}X1X2 as SATISFACTION, ${crm_survey_id}X1X3 as RESOLVED, ${crm_survey_id}X1X4 as mmServices 
                from lime_survey_${crm_survey_id} s 
                   inner join lime_tokens_${crm_survey_id} t on s.token=t.token
                where t.completed >= '$date_start_migration_back' and t.completed != 'N'  ";
        $data = getDataFromSQL("limesurvey", $sql_data_from_survey);
        $data_count = count($data);
        foreach ($data as $rowi => $row) {
            AfwBatch::print_info(" --** surveyCustomerSatisfactionAndBackToCrm2 row $rowi/$data_count **-- ");
            foreach ($row as $col => $val) ${$col . "_value"} = $val;

            if (!$FAST_value) $FAST_value = "Y";
            if (!$SATISFACTION_value) $SATISFACTION_value = "Y";
            if (!$RESOLVED_value) $RESOLVED_value = "Y";
            if (!$mmServices_value) $mmServices_value = "Y";
            if ($mobile_value and $email_value) {
                $customerObj = CrmCustomer::loadByMobileAndEmail($mobile_value, $email_value);
                if ($customerObj) {
                    $requestObj = Request::loadByMainIndex($ticket_num_value, $customerObj->id);
                    if ($requestObj) {
                        // customer has opened survey and voted not satisfied but he created taqib ticket
                        // so we put SATISFACTION value = W and we never change it back to N as he created taqib
                        if (($requestObj->getVal("survey_opened") == "Y") and
                            ($requestObj->getRelatedToTicketsCount() > 0) and
                            ($requestObj->getVal("service_satisfied") == "W") and
                            ($SATISFACTION_value == "N")
                        ) {
                            $SATISFACTION_value = "W";
                        }

                        $requestObj->set("easy_fast", $FAST_value);
                        $requestObj->set("service_satisfied", $SATISFACTION_value);
                        $requestObj->set("pb_resolved", $RESOLVED_value);
                        $requestObj->set("general_satisfaction", $mmServices_value);
                        $requestObj->set("survey_opened", "Y");
                        // to repair previous data but for new data it is already done when creating token
                        $requestObj->set("survey_token", $token_value);
                        $requestObj->set("survey_sent", "Y");
                        $requestObj->commit();
                        $nb_survey_update_back++;
                    } else $nb_bad_request++;
                } else $nb_bad_customer++;
            } else $nb_bad_customer++;
        }


        return array('nb_survey_update_back' => $nb_survey_update_back, 'nb_bad_customer' => $nb_bad_customer, 'nb_bad_request' => $nb_bad_request);
    }


    public static function surveyClosedTicket($ticketObj, $lang = "ar")
    {
        $crm_survey_id = AfwSession::config('crm_survey_id', '174363');
        $lime_survey_domain = AfwSession::config('lime_survey_domain', 'survey.company');
        $limesurvey_url = AfwSession::config('limesurvey_url', "http://$lime_survey_domain/surv/i.php");
        $customerObj = $ticketObj->hetCustomer();
        $firstname_value = $customerObj->getVal("first_name_ar");
        $lastname_value = $customerObj->getVal("last_name_ar");
        $email_value = $customerObj->getVal("email");
        $mpid_value = 100000 + $ticketObj->id;
        $language_value = "ar";
        $token = substr(md5(trim($firstname_value) . trim($lastname_value) . trim($email_value) . $mpid_value), 0, 15);

        // field_ticket_number_value as attribute_1,
        $request_code = $ticketObj->getVal("request_code");
        // title as attribute_2,
        $ticket_title = addslashes($ticketObj->getVal("request_title"));
        // body_value as attribute_3,
        $ticket_body = addslashes($ticketObj->getVal("request_text"));
        // field_mobile_number_value as attribute_5,
        $ticket_mobile = $customerObj->getVal("mobile");
        // if(!$ticket_mobile) 
        // die("no mobile number for this customer : $firstname_value $lastname_value ( $email_value ) => [$ticket_mobile] ".$customerObj->id);
        // field_final_decision_value as attribute_7,
        $final_decision = $ticketObj->getFinalDecisionOnRequest($language_value);
        // tdep.name as attribute_8,        
        $ticket_orgunit = $ticketObj->showAttribute("orgunit_id");

        $now_YmdHis = AfwDateHelper::shiftGregDate('', -1);

        $crm_survey_method = AfwSession::config('crm_survey_method', 'DB');

        if ($crm_survey_method == "DB") {
            $sql_migrate_to_survey_system = "insert into lime_tokens_$crm_survey_id(token,firstname,lastname,email,emailstatus,language,mpid,
                attribute_1, attribute_2, attribute_3, attribute_5, attribute_7, attribute_8, validfrom, usesleft)
            values('$token', _utf8'$firstname_value', _utf8'$lastname_value','$email_value','OK','$language_value', '$mpid_value',
                '$request_code', _utf8'$ticket_title', _utf8'$ticket_body', '$ticket_mobile', _utf8'$final_decision', _utf8'$ticket_orgunit', '$now_YmdHis',40)";



            $execRes = AfwDB::execQuery("limesurvey", $sql_migrate_to_survey_system);
            if ($execRes['affected_rows'] > 0) {
                //$sql_log = "";
                $sql_log = " SQL=" . $sql_migrate_to_survey_system;
                $ticketObj->set("survey_token", $token);
                $ticketObj->set("survey_sent", "Y");
                $ticketObj->commit();

                $return = "$limesurvey_url/$crm_survey_id?token=$token" . $sql_log;
            } else $return = "failed to create record in limesurvey";
        } 
        elseif ($crm_survey_method == "LS-JSON-RCP") // LimeSurvey (JSON)JavaScript Object Notation-(RPC)Remote Procedure Call, ex : LimeSurvey RemoteControl 2 see : https://www.limesurvey.org/manual/RemoteControl_2_API
        {
            
            /*
            $file_dir_name = dirname(__FILE__);
            require("$file_dir_name/../lib/api/jsonrpcphp-master/src/org/jsonrpcphp/JsonRPCClient.php");
            $rpcuser = AfwSession::config('rpcuser', 'rpcuser');
            $rpcuser_password = AfwSession::config('rpcuser-password', 'rpcuser-password');
            $rpcuser_url = AfwSession::config('rpcuser-url', 'https://localhost/limesurvey/admin/remotecontrol');
            $myJSONRPCClient = new org\jsonrpcphp\JsonRPCClient($rpcuser_url);
            // receive session key
            $sessionKey = $myJSONRPCClient->get_session_key($rpcuser, $rpcuser_password, 'Authdb');

            // receive surveys list current user can read
            $groups = $myJSONRPCClient->list_surveys($sessionKey);
            $err = "";
            $war = "";
            $tech = "";
            $inf = print_r($groups, true);

            // release the session key
            $myJSONRPCClient->release_session_key($sessionKey);

            // still testing because not working so I use in public method inside Request class
            $return = [$err, $inf, $war, $tech];*/
        }
        elseif ($crm_survey_method == "EXTERNAL-API") // more simple developped by Rafik if RPC not exactly the requirement or not work as needed
        { 
            $limesurvey_api_external_url = AfwSession::config('limesurvey_api_external', "http://$lime_survey_domain/api-external/");

            $project_name   = 'external-ls-apis';
            $gmtime = gmdate('U');
            $dynamic_token = md5($project_name.gmdate('Y-m-d H', $gmtime));
            $request["debugg"] = "mar2010iem";
            $request["method"] = "create_participant_token";
            $request["token"] = $dynamic_token;
            $request["crm_survey_id"] = $crm_survey_id;

            $request["first_name_ar"] = $firstname_value;
            $request["last_name_ar"] = $lastname_value;
            $request["email"] = $email_value;
            $request["language"] = $language_value;
            $request["mpid"] = $mpid_value;
            
            $request["mandatory_attributes"] = "1,2,3,5,7";
            $request["skip_attributes"] = "4,6";
            $request["nb_attributes"] = 8;

            $request["attribute_1"] = $request_code;
            $request["attribute_2"] = $ticket_title;
            $request["attribute_3"] = $ticket_body;
            // $request["attribute_4"] = "Not used";
            $request["attribute_5"] = $ticket_mobile;
            // $request["attribute_6"] = "Not used";
            $request["attribute_7"] = $final_decision;
            $request["attribute_8"] = $ticket_orgunit;

            $jsonExternalApi = AfwApi::getResponseFromApi($limesurvey_api_external_url, $request);            
            if (is_array($jsonExternalApi) and $jsonExternalApi["status"] == "done") {
                $token = $jsonExternalApi["token"];
                $case = $jsonExternalApi["case"];
                /* rmove after publish of limesurvey web site
                $ticketObj->set("survey_token", $token);
                $ticketObj->set("survey_sent", "Y");
                $ticketObj->commit();
                */
                $return = "$limesurvey_url/$crm_survey_id?token=$token done by api-external (case $case)";
            } else {
                $return = "ExternalApi failed to create record in limesurvey var=" . var_export($jsonExternalApi, true);
            }
        } else {
            throw new AfwRuntimeException("The method $crm_survey_method to link CRM with LimeSurvey is unknown");
            }



        return $return;
    }


    public static function surveyRecentClosedTickets($lang = "ar")
            {
        $nb_ok = 0;
        $nb_exception = 0;
        $nb_error = 0;
                
        $closedTicketList = Request::getRecentClosedTicketsWithSurveyNotReady();
        foreach($closedTicketList as $closedTicketItem)
        {
            try
            {
                $return = self::surveyClosedTicket($closedTicketItem, $lang);
                $nb_ok++;
                AfwBatch::print_info(" surveyClosedTicket success : $return ");
            } 
            catch(Exception $ex)
            {
                $file = $ex->getFile();
                $line = $ex->getLine();
                $traces = $ex->getTraceAsString();
                $message = $ex->getMessage();
                $nb_exception++;
                AfwBatch::print_error(" surveyClosedTicket fail : Exception : $message in file $file : line $line \n $traces");
        }
            catch(Error $e)
            {
                $file = $e->getFile();
                $line = $e->getLine();
                $traces = $e->getTraceAsString();
                $message = $e->getMessage();
                $nb_error++;
                AfwBatch::print_error(" surveyClosedTicket fail : Error : $message in file $file : line $line \n $traces");
        }

        }


        return array('nb_survey_update_back' => $nb_ok, 'nb_bad_customer' => $nb_exception, 'nb_bad_request' => $nb_error);
    }

    
}
