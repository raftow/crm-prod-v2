<?php

class CrmController extends AfwController
{
        public static function pushError($message_en, $lang="")
        {
                if (!$lang) $lang = AfwSession::getSessionVar("current_lang");
                if (!$lang) $lang = "ar";
                $support_mobile_number = AfwSession::config("support_mobile_number","0500000001");
                self::pushError(Response::translateCompanyMessage($message_en,"crm",$lang));
                self::pushError(Response::translateCompanyMessage("Please try again later or send a technical support request. You can send a screenshot and ask your questions on WhatsApp to the number","crm",$lang)." ".$support_mobile_number);
        }

        public function getMyModule()
        {
                return "crm";
        }

        public function getMyParentModule()
        {
                return AfwSession::config("main_module", "");
        }

        // This was old way now we use here below method myNewViewSettings
        /*        
        public function myViewSettings($methodName)
        {
                $front_header_template = AfwSession::config("front_header_template", "front");
                return array("", "crm/$front_header_template" . "_header.php", "lib/hzm/oldweb/hzm_simple_footer.php");
        }*/

        // now we use here below method myNewViewSettings 
        /*
        public function myNewViewSettings($methodName)
        {
                $module = "crm";
                $is_direct = false;
                $page = "";
                $page_path = "";
                $options = "";
                return array($module, $is_direct, $page, $page_path, $options);
        }*/

        public function prepareMenuTokens($lang, $role, $selected_menu, $options)
        {
                $login_template = AfwSession::config("customer-login-template", "right-left");
                $xmodule = AfwSession::getCurrentlyExecutedModule();
                $module = AfwUrlManager::currentURIModule();
                $login_out_css = "sign-in";
                $login_out_cl = "login $login_template";
                $login_page = "login-$login_template.php";

                $login_title = AfwLanguageHelper::translateKeyword("LOGIN", $lang);
                $logout_title = AfwLanguageHelper::translateKeyword("LOGOUT", $lang);

                $login_out_css = "sign-out";
                $login_out_cl = "logout $login_template";
                $logout_page = "logout.php";

                if (!$options["system_date_format"]) $options["system_date_format"] = AfwSession::currentSystemDateFormat();

                if (($options["system_date_format"] != "greg") and ($lang == "ar")) {
                        $hijri_date = AfwDateHelper::currentHijriDate("hdate_long", $DateSeparator = "/");
                        // die("hijri_date=$hijri_date");
                        $hijri_date_arr = explode($DateSeparator, $hijri_date);
                        $display_date_year = $hijri_date_arr[3];
                        $display_date_day = $hijri_date_arr[1];
                        $display_date_month = $hijri_date_arr[2];
                } else {
                        $display_date_day = date("d");
                        $display_date_month = date("m");
                        $display_date_year = date("Y");
                }
                $customerMe = AfwSession::getCustomerConnected();
                $welcome_user = "";
                if ($customerMe) {
                        // $me_id = $customerMe->id;

                        $user_full = $customerMe->getShortDisplay($lang);
                        $user_type_name = $customerMe->decode("customer_type_id");
                        $user_type_id = $customerMe->getVal("customer_type_id");

                        $welcome = $customerMe->translate("welcome", $lang);
                        $welcome_user = "<span> $welcome </span><br>$user_full<p>$user_type_name</p>";
                        $user_picture = $customerMe->getCustomerPicture();
                        $user_account_page = "customer_account.php";
                        $ord = $customerMe->id % 5;
                        $user_bg_class = "ubg" . $ord;
                } else {
                        $user_picture = '<i class="hzm-container-center hzm-vertical-align-middle hzm-icon-std hzm-user-account fa-user"></i></a>';
                        $user_account_page = "customer_login.php";
                        $user_bg_class = "ubg0";
                }

                $welcome_div = "";
                if ($customerMe) {
                        $welcome_div = "<div class=\"title_company_user\">$welcome_user</div>";
                }
                $module_languages = AfwSession::config("crm-front-languages", ["ar" => true, "en" => true]);
                $run_mode_var = AfwSession::config("run_mode_var", "run_mode");
                $run_mode = AfwSession::config($run_mode_var, "");
                if ($run_mode) $run_mode = "-" . $run_mode;
                
                $data_tokens = array();

                $enable_search_box = AfwSession::config("crm_enable_search_box", false);
                if($enable_search_box)
                {
                    $data_tokens["enable_search_box_s"] = "";
                    $data_tokens["enable_search_box_e"] = "";
                }
                else
                {
                    $data_tokens["enable_search_box_s"] = "<!-- ";
                    $data_tokens["enable_search_box_e"] = " -->";
                }

                if ($options["no_calendar"]) {
                        $data_tokens["calendar_item_s"] = "<!-- ";
                        $data_tokens["calendar_item_e"] = " -->";
                } else {
                        $data_tokens["calendar_item_s"] = "";
                        $data_tokens["calendar_item_e"] = "";
                }

                $data_tokens["user_picture"] = $user_picture;
                $data_tokens["user_bg_class"] = $user_bg_class;
                $data_tokens["user_account_page"] = $user_account_page;
                $data_tokens["search_here"] = AfwLanguageHelper::translateKeyword("Search here", $lang);;


                $data_tokens["run_mode"] = $run_mode;
                $data_tokens["welcome_div"] = $welcome_div;
                if (!$options["img-path"]) $options["img-path"] = "pic/";
                if (!$options["img-company-path"]) $options["img-company-path"] = "../external/pic";
                $data_tokens["img-path"] = $options["img-path"];
                $data_tokens["img-company-path"] = $options["img-company-path"];

                if ($xmodule) $data_tokens["xmodule"] = "-" . $xmodule;
                else $data_tokens["xmodule"] = "";

                $data_tokens["calendar_class"] = "calendar_bloc_g";
                $data_tokens["display_date_year"] = $display_date_year;
                $data_tokens["display_date_day"] = $display_date_day;
                $data_tokens["display_date_month"] = $display_date_month;
                if ($options["no_menu"]) {
                        $data_tokens["no_menu_s"] = "<!---";
                        $data_tokens["no_menu_e"] = "--->";
                } else {
                        $data_tokens["no_menu_s"] = "";
                        $data_tokens["no_menu_e"] = "";
                }
                $data_tokens["banner_height"] = $options["banner_height"];
                $data_tokens["title_app_height"] = $options["title_app_height"];
                $data_tokens["logo_app_height"] = $options["logo_app_height"];
                $data_tokens["title_comp_height"] = $options["title_comp_height"];
                $data_tokens["logo_comp_height"] = $options["logo_comp_height"];

                $HEADER_PIC_HEIGHT = 80;

                if (!$data_tokens["logo_app_height"]) $data_tokens["logo_app_height"] = AfwSession::config("LOGO_APP_HEIGHT", $HEADER_PIC_HEIGHT);
                if (!$data_tokens["logo_app_margin_top"]) $data_tokens["logo_app_margin_top"] = AfwSession::config("LOGO_APP_MARGIN_TOP", 5);

                if (!$data_tokens["title_app_height"]) $data_tokens["title_app_height"] = AfwSession::config("TITLE_APP_HEIGHT", $HEADER_PIC_HEIGHT);
                if (!$data_tokens["title_app_margin_top"]) $data_tokens["title_app_margin_top"] = AfwSession::config("TITLE_APP_MARGIN_TOP", 5);

                if (!$data_tokens["title_comp_height"]) $data_tokens["title_comp_height"] = AfwSession::config("TITLE_COMP_HEIGHT", $HEADER_PIC_HEIGHT);
                if (!$data_tokens["title_comp_margin_top"]) $data_tokens["title_comp_margin_top"] = AfwSession::config("TITLE_COMP_MARGIN_TOP", 5);
                if (!$data_tokens["logo_comp_height"]) $data_tokens["logo_comp_height"] = AfwSession::config("LOGO_COMP_HEIGHT", $HEADER_PIC_HEIGHT);
                if (!$data_tokens["logo_comp_margin_top"]) $data_tokens["logo_comp_margin_top"] = AfwSession::config("LOGO_COMP_MARGIN_TOP", 5);


                if (!$data_tokens["banner_height"]) $data_tokens["banner_height"] = 100;
                if (!$data_tokens["logo_app_height"]) $data_tokens["logo_app_height"] = 90;
                if (!$data_tokens["title_app_height"]) $data_tokens["title_app_height"] = 90;
                if (!$options["show-banner"]) {
                        $data_tokens["no_banner_s"] = "<!-- no banner for current module";
                        $data_tokens["no_banner_e"] = "-->";
                } else {
                        $data_tokens["no_banner_s"] = "<!-- banner active for current module -->";
                        $data_tokens["no_banner_e"] = "";
                }

                if (!$options["show-scroll-banner"]) {
                        $data_tokens["no_scroll_banner_s"] = "<!-- no scroll banner for current module";
                        $data_tokens["no_scroll_banner_e"] = "-->";
                } else {
                        $data_tokens["no_scroll_banner_s"] = "<!-- scroll banner active for current module -->";
                        $data_tokens["no_scroll_banner_e"] = "";
                }
                $no_menu = (AfwSession::config("disable-menu", false) and (!$options["no-menu"]));
                if ($no_menu) {
                        $data_tokens["main_menu_item_s"] = "<!--";
                        $data_tokens["main_menu_item_e"] = "-->";
                } else {
                        $data_tokens["main_menu_item_s"] = "";
                        $data_tokens["main_menu_item_e"] = "";
                }


                if ($selected_menu) $data_tokens["main_item_css_class"] = "class='home_page'";
                else $data_tokens["main_item_css_class"] = "class='home_page active'";

                $data_tokens["register_css_class"] = "class='registerme'";
                $data_tokens["register_file"] = AfwSession::config("register_file", "user_register");




                $data_tokens["login_out_cl"] = $login_out_cl;
                $data_tokens["login_page"] = $login_page;
                $data_tokens["logout_page"] = $logout_page;
                $data_tokens["login_out_css"] = $login_out_css;
                $data_tokens["login_title"] = $login_title;
                $data_tokens["logout_title"] = $logout_title;

                $menu_template = AfwSession::currentMenuTemplate();

                $data_tokens["hzm_front_menu"] = AfwMenuConstructHelper::genereControllerMenu($menu_template, $module, $this, $lang, $module_languages, $role);

                if ((!$customerMe) and (!$no_menu)) {
                        $data_tokens["me_connected_s"] = "<!--";
                        $data_tokens["me_connected_e"] = "-->";
                        $data_tokens["me_not_connected_s"] = "";
                        $data_tokens["me_not_connected_e"] = "";
                } elseif ((!$customerMe) and ($no_menu)) {
                        $data_tokens["me_connected_s"] = "";
                        $data_tokens["me_connected_e"] = "";
                        $data_tokens["me_not_connected_s"] = "";
                        $data_tokens["me_not_connected_e"] = "";
                } else {
                        $data_tokens["me_connected_s"] = "";
                        $data_tokens["me_connected_e"] = "";
                        $data_tokens["me_not_connected_s"] = "<!--";
                        $data_tokens["me_not_connected_e"] = "-->";
                }

                $data_tokens["dark_mode"] = AfwLanguageHelper::translateKeyword("dark mode", $lang);

                $data_tokens["site_name"] = AfwSession::getCurrentSiteName($lang);
                if (!$options["bg_height"]) $options["bg_height"] = 400;
                $data_tokens["bg_height"] = $options["bg_height"];
                if (!$options["out_index_page"]) $options["out_index_page"] = "#";
                $data_tokens["out_index_page"] = $options["out_index_page"];

                return $data_tokens;
        }


        public function defaultMethod($request)
        {
                if ($request["rid"]) return "view_request";
                return "newrequest";
        }

        /**
         * 
         * @return CrmCustomer
         */

        public function checkLoggedIn()
        {
                $theCustomer = AfwSession::getCustomerConnected();

                if (!$theCustomer) {
                        $login_module = AfwSession::config("login_module", "crm");
                        $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                        return;
                }

                return $theCustomer;
        }

        public function initiateStandardDisplay($request, $noTaqib=false)
        {
                $theCustomer = self::checkLoggedIn();
                if($noTaqib)
                {
                        $candRequestObj = null;
                }
                else
                {
                        $candRequestObj = $theCustomer->getTaqibCandidate();
                        if ($candRequestObj) {
                                $token = $candRequestObj->getVal("survey_token");
        
                                if ($token) {
                                        $limesurvey_url = AfwSession::config("limesurvey_url", "[limesurvey-url]");
                                        $limesurvey_sid = AfwSession::config("limesurvey_url", "[limesurvey_sid]");
                                        $fadhlan_fi_hal = "فضلا، في حال أنه تم حل مشكلتك نرجوا منك تعديل تقييم الخدمة من هنا";
                                        //$a_survey = "<a class='crm response thin-btn width_90' target='_lmsurv' href='http://survey.company/surv/i.php/174363?token=$token&lang=ar'>إعادة تقييم الخدمة</a>" . "<br>";
                                        $a_survey = "<a class='crm response thin-btn width_90' target='_lmsurv' href='$limesurvey_url/$limesurvey_sid?token=$token&lang=ar'>إعادة تقييم الخدمة</a>" . "<br>";
                                        $wafi_hal = "وفي حال أنه لم تتم حل مشكلتك";
                                } else {
                                        $fadhlan_fi_hal = "";
                                        $wafi_hal = "";
                                        $a_survey = "";
                                }
                                $taqib_message = "<div class=\"column btns-qsearch\">لقد أبديت عدم رضاك عن الخدمة بخصوص هذا الطلب  : " . $candRequestObj->getVal("request_title") . ". ";
                                $taqib_message .= "$fadhlan_fi_hal</div>" . "<br> $a_survey";
                                $taqib_message .= "<div class=\"column btns-qsearch\">$wafi_hal يمكنك في أقل من دقيقة تقديم تعقيب من هنا : </div>" . "<br>";
                                $taqib_message .= "<a class='crm question thin-btn width_90' href='i.php?cn=crm&mt=request&taqib=1&rt=3&oldrt=" . $candRequestObj->getVal("request_type_id") . "&pt=" . $candRequestObj->id . "'>تقديم طلب تعقيب ذو أولوية عالية</a>" . "<br>";
        
                                AfwSession::pushWarning($taqib_message);
                        }
                }
                

                return array($theCustomer, $candRequestObj);
        }

        /******************************** quicklogin action ********************************************** */

        public function prepareQuicklogin($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function quicklogin($request)
        {
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;
                // ex of request 
                // cidn=2343225005 & cref=di1365 & cqlc=5a5f68cb6a759e4c658a9f1a0e79ce1a


                $hh = date("YmdH");
                $hh_1 = $hh - 1;
                $hh_2 = $hh + 1;
                $customer_quicklogin_code = md5("customer-$cidn-ref-$cref-qlat-$hh");
                $customer_quicklogin_code1 = md5("customer-$cidn-ref-$cref-qlat-$hh_1");
                $customer_quicklogin_code2 = md5("customer-$cidn-ref-$cref-qlat-$hh_2");

                if (($cqlc != $customer_quicklogin_code2) and ($cqlc != $customer_quicklogin_code1) and ($cqlc != $customer_quicklogin_code)) {
                        $this->renderLogOutMessage("Session not correct !", "customer_login.php");
                }

                $objQuickLoggedIn = CrmCustomer::loadByIdnAndRefnum($cidn, $cref);
                if (!$objQuickLoggedIn) {
                        $this->renderLogOutMessage("Session not found !", "customer_login.php");
                }
                $data["customerObj"] = $objQuickLoggedIn;
                AfwSession::setCustomer($objQuickLoggedIn->id);

                // call the view 1
                $this->render("crm", "home", $data);
        }

        /******************************** home action ********************************************** */

        public function prepareOptions($methodName)
        {
                $options= [];
                $options["front-application"] = "crm";
                $options["user-is-customer"] = true;

                return $options;
        }

        public function prepareStandard($request)
        {
                if($request["all_error"])
                {
                        self::pushError($request["all_error"]);
                }
                $custom_scripts = array();
                $custom_scripts[] = array('type' => 'css', 'path' => "./css/content.css");
                $custom_scripts[] = array('type' => 'css', 'path' => "../lib/css/sweetalert2.min.css");
                $custom_scripts[] = array('type' => 'js',   'path' => "../lib/js/sweetalert2.min.js");
                $custom_scripts[] = array('type' => 'js',   'path' => "../lib/js/sweetalert.min.js");
                $custom_scripts[] = array('type' => 'js',   'path' => "./js/jquery.nicefileinput.js");
                $custom_scripts[] = array('type' => 'css',   'path' => "./css/jquery-nicefileinput-js.css");


                return $custom_scripts;
        }

        public function prepareHome($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function home($request)
        {
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;

                $data["customerObj"] = AfwSession::getCustomerConnected();
                // call the view 1
                $this->render("crm", "home", $data);
        }

        /******************************** cancel_request action ********************************************** */

        public function prepareCancel_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }

        public function initiateCancel_request($request)
        {
                $lang = AfwSession::getSessionVar("current_lang");
                if (!$lang) $lang = "ar";
                if ($lang == "ar") $lang_suffix = "";
                else $lang_suffix = "_" . $lang;


                $theCustomer = self::checkLoggedIn();

                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;

                $data["pbMethodCode"] = $pbMethodCode = "cc51aab";
                $pMethodItem = Request::$PUB_METHODS["cancelRequest"];
                // die("lang_suffix=$lang_suffix, pMethodItem=".var_export($pMethodItem,true));
                $data["ticketObj"] = null;
                if ($rid) $data["ticketObj"] = Request::loadById($rid);
                if ((!$data["ticketObj"]) or ($data["ticketObj"]->isEmpty())) {
                        $this->renderError("action aborted ! no request object to cancel");
                        return;
                }
                if ((!$request["pbmconfirm-$pbMethodCode"]) and (!$request["pbmcancel-$pbMethodCode"])) {
                        $pbm_confirmed = false;
                        $pbm_cancelled = false;

                        $data["confirmation_warning"] = $data["ticketObj"]->decodeTpl($pMethodItem["confirmation_warning" . $lang_suffix]);
                        $data["confirmation_question"] = $data["ticketObj"]->decodeTpl($pMethodItem["confirmation_question" . $lang_suffix]);
                        $data["controller"] = "crm";
                        $data["method"] = "cancel_request";
                        $data["hidden_list"] = array("rid");


                        $data["render_case"] = "confirm";
                } elseif ($request["pbmconfirm-$pbMethodCode"]) {
                        if ($theCustomer->id != $data["ticketObj"]->getVal("customer_id")) {
                                $this->renderError("action aborted ! this customer is not owner of this request");
                                return;
                        }
                        if (!$data["ticketObj"]->methodAllowed("cancelRequest")) {
                                AfwSession::pushWarning($theCustomer->tm("action aborted ! because of CRM policy, this request can't be canceled"));
                                return null;
                        }

                        $data["ticketObj"]->cancelRequest($lang);
                        // die("تم إلغاء الطلب بنجاح");
                        // AfwSession::pushSuccess("تم إلغاء الطلب بنجاح");
                } elseif ($request["pbmcancel-$pbMethodCode"]) {
                        // die("بحمد الله تم إلغاء الإجراء بكل أمان");
                        AfwSession::pushInformation("بحمد الله تم إلغاء الإجراء بكل أمان");
                } else {
                        // die("request = ".var_export($request,true));
                }

                return $data;
        }

        public function cancel_request($request)
        {
                $data = $request;
                if ($data["render_case"] == "confirm") {
                        // confirm before cancel
                        $this->renderConfirm($data);
                }
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                // call the view 1
                $this->render("crm", "view_request", $data);
        }

        /******************************** send_request action ********************************************** */

        public function prepareSend_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function initiateSend_request($request)
        {
                global $lang;

                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;


                $theCustomer = self::checkLoggedIn();

                if (!$theCustomer) {
                        $login_module = AfwSession::config("login_module", "crm");
                        $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                        return;
                }
                $data["ticketObj"] = null;

                if ($rid) $data["ticketObj"] = Request::loadById($rid);


                if ((!$data["ticketObj"]) or ($data["ticketObj"]->isEmpty())) {
                        $this->renderError("action aborted ! no request object to send");
                        return;
                }


                if ($theCustomer->id != $data["ticketObj"]->getVal("customer_id")) {
                        $this->renderError("action aborted ! this customer is not owner of this request");
                        return;
                }
                if (!$data["ticketObj"]->methodAllowed("sendRequest")) {
                        AfwSession::pushWarning($theCustomer->tm("action aborted ! because of CRM policy, this request can't be sent"));
                        return;
                }

                $data["ticketObj"]->sendRequest($lang);

                return $data;
        }

        public function send_request($request)
        {
                $data = $request;
                // call the view 1
                $this->render("crm", "view_request", $data);
        }

        /******************************** draft_request action ********************************************** */

        public function prepareDraft_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function initiateDraft_request($request)
        {
                global $lang;

                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;


                $theCustomer = self::checkLoggedIn();

                if (!$theCustomer) {
                        $login_module = AfwSession::config("login_module", "crm");
                        $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                        return;
                }
                $data["ticketObj"] = null;

                if ($rid) $data["ticketObj"] = Request::loadById($rid);


                if ((!$data["ticketObj"]) or ($data["ticketObj"]->isEmpty())) {
                        $this->renderError("action aborted ! no request object to draft");
                        return;
                }


                if ($theCustomer->id != $data["ticketObj"]->getVal("customer_id")) {
                        $this->renderError("action aborted ! this customer is not owner of this request");
                        return;
                }
                if (!$data["ticketObj"]->methodAllowed("resetRequestNew")) {
                        AfwSession::pushWarning($theCustomer->tm("action aborted ! because of CRM policy, this request can't be drafted"));
                        return;
                }

                $data["ticketObj"]->resetRequestNew($lang);

                return $data;
        }

        public function draft_request($request)
        {
                $data = $request;
                // call the view 1
                $this->render("crm", "view_request", $data);
        }


        /******************************** home action ********************************************** */

        public function prepareAboutus($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function aboutus($request)
        {
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;

                // call the view 1
                $this->render("crm", "aboutus", $data);
        }

        /******************************** contact action ********************************************** */

        public function prepareContact($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function contact($request)
        {
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;

                // call the view 1
                $this->render("crm", "contact", $data);
        }

        /******************************** qa action ********************************************** */

        public function prepareQa($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function qa($request)
        {
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;

                // call the view 1
                $this->render("crm", "qa", $data);
        }

        /******************************** view_request action ********************************************** */

        public function prepareView_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function view_request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;

                $theCustomer = self::checkLoggedIn();

                // if(!$rid) $rid = Request::myLastRequestId();

                if ($rid) $data["ticketObj"] = Request::loadById($rid);
                else $data["ticketObj"] = null;

                if ($data["ticketObj"]) {
                        $data["relatedTicketObj"] = $data["ticketObj"]->getRelatedTicket();
                }


                // call the view 1
                if ($data["ticketObj"] and (!$data["ticketObj"]->isEmpty())) {
                        if ($theCustomer->id != $data["ticketObj"]->getVal("customer_id"))
                                $this->renderError("request view not allowed");
                        else {
                                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                                $this->render("crm", "view_request", $data);
                        }
                } else {
                        $this->renderError("request not found : [rid=$rid]");
                }
        }

        /******************************** newrequest action ********************************************** */

        public function prepareNewrequest($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function newrequest($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;


                // call the view 1
                $this->render("crm", "new_request", $data);
        }

         
        public function initiateNewrequest($request)
        {
                // list($theCustomer, ) = $this->initiateStandardDisplay($request, true);
                $data = $request;
                $data = array();
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                $data["title"] = "طلب جديد";
                

                return $data;
        }

        /******************************** myrequests action ********************************************** */

        public function prepareMyrequests($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }



        public function initiateMyrequests($request)
        {
                list($theCustomer, $candRequestObj) = $this->initiateStandardDisplay($request);
                $data = $request;
                $data = array();
                if ($theCustomer) {
                        // die("theCustomer = ".var_export($theCustomer,true));
                        $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                        $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");

                        $data["requestList"] = $theCustomer->get("requestList");
                        $data["title"] = "طلباتي القائمة";
                } else {
                        //$login_module = AfwSession::config("login_module","crm"); $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                        $data = null;
                }

                return $data;
        }

        public function myrequests($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;

                // call the view to show
                if ($data) $this->render("crm", "my_requests", $data);
                else return;
        }

        /******************************** oldrequests action ********************************************** */

        
        public function initiateOldrequests($request)
        {
                list($theCustomer, $candRequestObj) = $this->initiateStandardDisplay($request);
                $data = $request;
                $data = array();
                if ($theCustomer) {
                        // die("theCustomer = ".var_export($theCustomer,true));
                        $data["requestList"] = $theCustomer->get("oldRequestList");
                        $data["title"] = "طلباتي المنتهية";
                } else {
                        //$login_module = AfwSession::config("login_module","crm"); $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                        $data = null;
                }

                return $data;
        }

        public function prepareOldrequests($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function oldrequests($request)
        {
                // foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                

                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");

                // call the view 1
                $this->render("crm", "my_requests", $data);
        }

        /******************************** request action ********************************************** */

        public function prepareRequest($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");

                if (!$data["request_type"] and $rt) $data["request_type"] = $rt;

                if ((!$data["customer_id"]) and $cusid) {
                        $theUser = AfwSession::getUserConnected();
                        if ($theUser and $theUser->iCanDoOperation("crm", "request", "edit")) {
                                $data["customer_id"] = $cusid;
                                $data["cse_user"] = $theUser;
                        }
                }



                $data["requestTypeList"] = RequestType::loadAll();
                $data["regionList"] = Region::loadAll();
                $roClassName = AfwSession::config("roClassName", "");
                if ($roClassName) $data["roList"] = $roClassName::loadAllMyObjects();



                if (!$data["customer_id"]) {
                        $theCustomer = AfwSession::getCustomerConnected();
                } else {
                        $theCustomer = CrmCustomer::loadById($data["customer_id"]);
                }

                if (!$theCustomer) {
                        $login_module = AfwSession::config("login_module", "crm");
                        $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                        return;
                } else {
                        $data["customer_id"] = $theCustomer->id;
                        if ($pt) {
                                $oldTicketObj = Request::loadById($pt);
                                if ($oldTicketObj and $oldTicketObj->getVal("customer_id") == $theCustomer->id) {
                                        $data["old_ticket"] = $oldTicketObj->getVal("request_code");
                                        $data["old_ticket_ro"] = "READONLY";
                                }

                                if (($rt == Request::$REQUEST_TYPE_COMPLAINT) and $oldrt and $taqib) {
                                        // die("test taqib ok");
                                        // حالة تعقيب
                                        $data["request_subject"] = "تعقيب على : " . $oldTicketObj->getVal("request_title");
                                        $data["request_subject_readonly"] = "READONLY";
                                        $data["request_body"] = "بعد التحية، \n\r حيث أني غير راض على الخدمة المقدمة لي أود التعقيب على طلبي السابق الذي نصه كالتالي  : \n\r " . $oldTicketObj->getVal("request_text");
                                        $data["request_prio_phrase"] = "تعقيب مع أولوية قصوى";
                                        $data["request_priority"] = 1;
                                        $data["request_type_readonly"] = true;
                                }
                                // else die("test taqib not ok $rt / $oldrt / $taqib");
                        }

                        $data["city_id"] = $theCustomer->getVal("city_id");
                        $data["your_full_name"] = $theCustomer->calc("full_name");
                        $data["customer_mobile"] = $theCustomer->getVal("mobile");
                        $data["customer_idn"] = $theCustomer->getVal("idn");
                }

                if (!$data["city_id"]) $data["city_id"] = 301; //RIYADH
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                // call the view 1
                $this->render("crm", "request_form", $data);
        }

        /******************************** edit_request action ********************************************** */

        public function prepareEdit_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function edit_request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = array();

                if ($rid) {
                        $theCustomer = AfwSession::getCustomerConnected();
                        if (!$theCustomer) {
                                $login_module = AfwSession::config("login_module", "crm");
                                $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                                return;
                        }

                        $data["id"] = $rid;
                        $data["obj"] = Request::loadById($data["id"]);
                        if (!$data["obj"]) {
                                $this->renderError("action aborted ! no request object to complete");
                                return;
                        }

                        if ($data["obj"]->getVal("customer_id") != $theCustomer->id) {
                                $this->renderError("action aborted ! This ticket is not yours");
                                return;
                        }

                        if ($data["obj"]->isClosedWithCustomer()) {
                                $this->renderError("can't edit action aborted ! This ticket is already closed");
                                return;
                        }



                        $data["request_type"] = $data["obj"]->getVal("request_type_id");
                        $data["request_status_id"] = $data["obj"]->getVal("status_id");
                        $data["request_status"] = $data["obj"]->decode("status_id");
                        list($data["request_instructions"], $data["files_list"]) = $data["obj"]->getLastInstructionDetailsOnRequest();

                        $data["request_code"] = $data["obj"]->getVal("request_code");
                        $data["request_subject"] = $data["obj"]->getVal("request_title");
                        $data["request_body"] = $data["obj"]->getVal("request_text");

                        $data["old_ticket"] = $data["obj"]->getVal("related_request_code");
                        $data["web_site"] = $data["obj"]->getVal("request_link");
                        list($crmtmp, $related_object_id) = explode("-", $data["obj"]->getVal("request_for"));
                        if ($related_object_id) $data["related_object_id"] = $related_object_id;
                        else $data["related_object_id"] = $data["obj"]->getVal("request_for");
                        $data["requestTypeList"] = RequestType::loadAll();
                        $roClassName = AfwSession::config("roClassName", "");
                        if ($roClassName) $data["roList"] = $roClassName::loadAllMyObjects();




                        $data["customer_id"] = $theCustomer->id;
                        if ($pt) {
                                $oldTicketObj = Request::loadById($pt);
                                if ($oldTicketObj and ($oldTicketObj->getVal("customer_id") == $theCustomer->id)) {
                                        $data["old_ticket"] = $oldTicketObj->getVal("request_code");
                                        $data["old_ticket_ro"] = "READONLY";
                                }
                        }

                        $data["city_id"] = $theCustomer->getVal("city_id");
                        $data["your_full_name"] = $theCustomer->calc("full_name");
                        $data["customer_mobile"] = $theCustomer->getVal("mobile");
                        $data["customer_idn"] = $theCustomer->getVal("idn");

                        if (!$data["city_id"]) $data["city_id"] = 301; //RIYADH
                        $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                        $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                        // call the view 1
                        $this->render("crm", "edit_request_form", $data);
                }
        }



        /******************************** comment_request action ********************************************** */

        public function prepareComment_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function comment_request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = array();

                if ($rid) {

                        $theCustomer = AfwSession::getCustomerConnected();
                        if (!$theCustomer) {
                                $login_module = AfwSession::config("login_module", "crm");
                                $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                                return;
                        }

                        $data["id"] = $rid;
                        $data["obj"] = Request::loadById($data["id"]);
                        if (!$data["obj"]) {
                                $this->renderError("action aborted ! no request object to complete");
                                return;
                        }

                        if ($data["obj"]->getVal("customer_id") != $theCustomer->id) {
                                $this->renderError("action aborted ! This ticket is not yours");
                                return;
                        }

                        $data["request_type"] = $data["obj"]->getVal("request_type_id");
                        $data["request_type_display"] = $data["obj"]->decode("request_type_id");
                        $data["request_status_id"] = $data["obj"]->getVal("status_id");
                        $data["request_status"] = $data["obj"]->decode("status_id");
                        $data["your_full_name"] = $theCustomer->calc("full_name");
                        $data["customer_mobile"] = $theCustomer->getVal("mobile");
                        $data["customer_idn"] = $theCustomer->getVal("idn");
                        $data["customer_type"] = $theCustomer->decode("customer_type_id");
                        $data["request_code"] = $data["obj"]->getVal("request_code");
                        $data["request_subject"] = $data["obj"]->getVal("request_title");
                        $data["request_body"] = $data["obj"]->getVal("request_text");
                        $data["old_ticket"] = $data["obj"]->getVal("related_request_code");
                        $data["web_site"] = $data["obj"]->getVal("request_link");
                        /*

                        list($crmtmp, $related_object_id) = explode("-", $data["obj"]->getVal("request_for"));
                        if($related_object_id) $data["related_object_id"] = $related_object_id;                                
                        else $data["related_object_id"] = $data["obj"]->getVal("request_for"); 

                        $data["requestTypeList"] = RequestType::loadAll();
                        $roClassName = AfwSession::config("roClassName","");
                        if($roClassName) $data["roList"] = $roClassName::loadAllMyObjects();

                        
                        


                        $data["customer_id"] = $theCustomer->id;
                        if($pt) 
                        {
                                $oldTicketObj = Request::loadById($pt);
                                if($oldTicketObj and $oldTicketObj->getVal("customer_id") == $theCustomer->id)
                                {
                                        $data["old_ticket"] = $oldTicketObj->getVal("request_code");  
                                        $data["old_ticket_ro"] = "READONLY";
                                }
                        }
                        
                        $data["city_id"] = $theCustomer->getVal("city_id");

                        if(!$data["city_id"]) $data["city_id"] = 301; //RIYADH
                        */
                        $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                        $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                        // call the view 1
                        $this->render("crm", "comment_request_form", $data);
                }
        }

        /******************************** submit_comment action ********************************************** */
        public function prepareSubmit_comment($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function initiateSubmit_comment($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                AfwAutoLoader::addMainModule("crm");
                $theCustomer = self::checkLoggedIn();

                if ($request_id) {

                        $reqObj = Request::loadById($request_id);
                        if (!$reqObj) {
                                $this->renderError("action aborted ! no request object to complete");
                                return;
                        }

                        if ($reqObj->getVal("customer_id") != $theCustomer->id) {
                                $this->renderError("action aborted ! This ticket is not yours");
                                return;
                        }

                        // be sure before commit that no investigator is working on it
                        if (!$reqObj->customerCanComment()) {
                                $error_saving = AfwLanguageHelper::tt("Can't add comments, The ticket status deny comments");
                                self::pushError($error_saving);
                                $data["all_error"] = $error_saving;
                        } else {
                                if (!$request["comment"]) {
                                        $error_saving = AfwLanguageHelper::tt("No comment written");
                                        self::pushError($error_saving);
                                        $data["all_error"] = $error_saving;
                                } else {
                                        $reqObj->addCustomerComment($request["comment"]);
                                }
                        }

                        if (!$reqObj->isOk(true)) {
                                $data["all_error"] = implode(",\n", $reqObj->getDataErrors());
                        }
                } else {
                        $error_saving = AfwLanguageHelper::tt("Can't apply changes, The ticket is unknown");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                }



                return $data;
        }

        public function submit_comment($request)
        {
                $data = $request;



                if (!$data["all_error"]) {
                        if (!$data["id"]) {
                                $theCustomer = AfwSession::getCustomerConnected();
                                if ($theCustomer) {
                                        $data["customer_connected"] = $theCustomer;
                                }
                                // call the view 1
                                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");

                                $this->render("crm", "request_form_done", $data);
                        } else {
                                $this->myrequests($data);
                        }
                } else {
                        if (!$data["id"]) {
                                $this->request($data);
                        } else {
                                $this->edit_request($data);
                        }
                }
        }

        /******************************** complete_request action ********************************************** */

        public function prepareComplete_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function complete_request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = array();

                if ($rid) {

                        $theCustomer = AfwSession::getCustomerConnected();
                        if (!$theCustomer) {
                                $login_module = AfwSession::config("login_module", "crm");
                                $this->renderLogOutMessage("Session ended !", "../$login_module/customer_login.php");
                                return;
                        }

                        $data["id"] = $rid;
                        $data["obj"] = Request::loadById($data["id"]);
                        if (!$data["obj"]) {
                                $this->renderError("action aborted ! no request object to complete");
                                return;
                        }

                        if ($data["obj"]->getVal("customer_id") != $theCustomer->id) {
                                $this->renderError("action aborted ! This ticket is not yours");
                                return;
                        }

                        if ($data["obj"]->isClosedWithCustomer()) {
                                self::pushError("This ticket is already closed");
                                // return;
                        }

                        if (!$data["obj"]->isToComplete()) {
                                self::pushError("This ticket is already completed status = " . $data["obj"]->getVal("status_id"));
                                // return;
                        }

                        $data["request_type"] = $data["obj"]->getVal("request_type_id");
                        $data["request_type_display"] = $data["obj"]->decode("request_type_id");
                        $data["request_status_id"] = $data["obj"]->getVal("status_id");
                        $data["request_status"] = $data["obj"]->decode("status_id");
                        list($data["request_instructions"], $data["files_list"]) = $data["obj"]->getLastInstructionDetailsOnRequest();
                        $data["your_full_name"] = $theCustomer->calc("full_name");
                        $data["customer_mobile"] = $theCustomer->getVal("mobile");
                        $data["customer_idn"] = $theCustomer->getVal("idn");
                        $data["customer_type"] = $theCustomer->decode("customer_type_id");
                        $data["request_code"] = $data["obj"]->getVal("request_code");
                        $data["request_subject"] = $data["obj"]->getVal("request_title");
                        $data["request_body"] = $data["obj"]->getVal("request_text");
                        $data["old_ticket"] = $data["obj"]->getVal("related_request_code");
                        $data["web_site"] = $data["obj"]->getVal("request_link");
                        /*

                        list($crmtmp, $related_object_id) = explode("-", $data["obj"]->getVal("request_for"));
                        if($related_object_id) $data["related_object_id"] = $related_object_id;                                
                        else $data["related_object_id"] = $data["obj"]->getVal("request_for"); 

                        $data["requestTypeList"] = RequestType::loadAll();
                        $roClassName = AfwSession::config("roClassName","");
                        if($roClassName) $data["roList"] = $roClassName::loadAllMyObjects();

                        
                        


                        $data["customer_id"] = $theCustomer->id;
                        if($pt) 
                        {
                                $oldTicketObj = Request::loadById($pt);
                                if($oldTicketObj and $oldTicketObj->getVal("customer_id") == $theCustomer->id)
                                {
                                        $data["old_ticket"] = $oldTicketObj->getVal("request_code");  
                                        $data["old_ticket_ro"] = "READONLY";
                                }
                        }
                        
                        $data["city_id"] = $theCustomer->getVal("city_id");

                        if(!$data["city_id"]) $data["city_id"] = 301; //RIYADH
                        */
                        $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                        $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                        // call the view 1
                        $this->render("crm", "complete_request_form", $data);
                }
        }

        /******************************** submit_complete action ********************************************** */
        public function prepareSubmit_complete($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function initiateSubmit_complete($request)
        {
                $lang = AfwSession::getSessionVar("current_lang");
                if(!$lang) $lang = "ar";
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                AfwAutoLoader::addMainModule("crm");
                $theCustomer = self::checkLoggedIn();

                if ($request_id) {

                        $reqObj = Request::loadById($request_id);
                        if (!$reqObj) {
                                $this->renderError("action aborted ! no request object to complete");
                                return;
                        }

                        if ($reqObj->getVal("customer_id") != $theCustomer->id) {
                                $this->renderError("action aborted ! This ticket is not yours");
                                return;
                        }

                        // be sure before commit that no investigator is working on it
                        if (($reqObj->isClosedWithCustomer()) or (!$reqObj->isToComplete())) {
                                $error_saving = AfwLanguageHelper::tt("Can't apply changes, The ticket is already completed");
                                self::pushError($error_saving);
                                $data["all_error"] = $error_saving;
                        } else {
                                if (!$request["comment"]) {
                                        if (isset($request["_REQUEST_FILES"]) and $request["_REQUEST_FILES"] and (count($request["_REQUEST_FILES"]) > 0)) {
                                                $request["comment"] = "شكرا لكم";
                                        } else {
                                                $error_saving = AfwLanguageHelper::tt("No file attached and no comment written");
                                                self::pushError($error_saving);
                                                $data["all_error"] = $error_saving;
                                        }
                                }

                                $continue_complete = true;

                                if (isset($request["_REQUEST_FILES"]) and $request["_REQUEST_FILES"] and (count($request["_REQUEST_FILES"]) > 0)) {
                                        $response_action_type = "تم استكمال المرفقات";
                                } else {
                                        $response_action_type = "تم استكمال البيانات كالتالي :";
                                }

                                $responseObj = Response::createNewResponse(
                                        $reqObj->getId(),
                                        AfwDateHelper::currentHijriDate(),
                                        date("H:i:s"),
                                        0,
                                        0,
                                        $reqObj->getVal("status_id"),
                                        Response::$RESPONSE_TYPE_COMPLETE,
                                        $response_action_type . " " . $request["comment"],
                                        $response_link = "",
                                        $internal = "N",
                                        $module_id = 0
                                );
                                $responseId = $responseObj->id;
                                $responseAge = $responseObj->is_new ? "جديد" : "سابق";

                                if($responseId)
                                {
                                        AfwSession::pushInformation("تم بحمد الله ارسال ردك ال$responseAge بالرقم التسلسلي $responseId إلى مكتب خدمة العملاء");
                                }
                                else
                                {
                                        self::pushError("Unfortunately, sending your response to the customer service office failed", $lang);
                                        
                                }

                                // die("_REQUEST_FILES => ".var_export($request["_REQUEST_FILES"],true));
                                $completed_action = "data";
                                if (isset($request["_REQUEST_FILES"]) and $request["_REQUEST_FILES"] and (count($request["_REQUEST_FILES"]) > 0)) {
                                        foreach ($request["_REQUEST_FILES"] as $file_code => $file_arr) {
                                                $completed_action = "files";
                                                if ($continue_complete) {
                                                        $file_title = ${"title_of_$file_code"};
                                                        $uploadResult = AfwFileUploader::completeUpload($file_title, $file_code, $file_arr, $responseObj);

                                                        $status = $uploadResult["status"];
                                                        $message = $uploadResult["message"];
                                                        $afObj = $uploadResult["afObj"];

                                                        if ($status == "success") {
                                                                AfwSession::pushInformation("تم بحمد الله تحميل الملف : " . $file_title);
                                                        } else {
                                                                $responseObj->hide();
                                                                $error_message = "فشلت عملية تحميل الملف : " . $file_title . ". السبب : " . $message;
                                                                self::pushError($error_message);
                                                                $data["all_error"] = $error_message;
                                                                $continue_complete = false;
                                                        }
                                                }
                                        }
                                }

                                if ($continue_complete) {
                                        if($completed_action == "files") 
                                        {
                                                $action_completed = "تم الانتهاء من رفع المرفقات واعادة الطلب الى مكتب خدمة العملاء";
                                                $action_enum = Request::status_action_by_code("filesUploaded");
                                        }        
                                        else 
                                        {
                                                $action_completed = "تم الانتهاء من استكمال البيانات واعادة الطلب الى مكتب خدمة العملاء";
                                                $action_enum = Request::status_action_by_code("dataCompleted");
                                        }
                                        list($responseObj2,) = $reqObj->changeStatus(Request::$REQUEST_STATUS_ONGOING, $action_completed, $action_enum);
                                }
                        }

                        if (!$reqObj->isOk(true)) {
                                $data["all_error"] = implode(",\n", $reqObj->getDataErrors());
                        }
                } else {
                        $error_saving = AfwLanguageHelper::tt("Can't apply changes, The ticket is unknown");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                }



                return $data;
        }

        public function submit_complete($request)
        {
                $data = $request;

                if (!$data["rid"]) $data["rid"] = $data["request_id"];

                if (!$data["all_error"]) {
                        if (!$data["rid"]) {
                                $theCustomer = AfwSession::getCustomerConnected();
                                if ($theCustomer) {
                                        $data["customer_connected"] = $theCustomer;
                                }
                                // call the view 1
                                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");

                                $this->render("crm", "request_complete_done", $data);
                        } else {
                                $this->myrequests($data);
                        }
                } else {
                        if (!$data["rid"]) {
                                $this->request($data);
                        } else {
                                $this->prepareComplete_request($data);                                
                                $this->complete_request($data);
                        }
                }
        }

        /******************************** submit_request action ********************************************** */

        public function prepareSubmit_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function initiateSubmit_request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                AfwAutoLoader::addMainModule("crm");

                $theCustomer = self::checkLoggedIn();

                if ((!$customer_idn) or (!$customer_mobile)) {
                        if ($theCustomer) {
                                $customer_mobile = $theCustomer->getVal("mobile");
                                $customer_idn = $theCustomer->getVal("idn");
                                $your_full_name = $theCustomer->getVal("full_name");
                        }

                        if (!$customer_idn) $customer_idn = "ANONYM" . rand(0, 10) . "-" . date("YmdHis");
                } else {
                        list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($customer_idn, $authorize_other_sa_idns = true);
                        $theCustomer = CrmCustomer::loadByMainIndex($customer_mobile, $idn_type_id, $customer_idn, $create_obj_if_not_found = true);
                }
                if ($request_id) {
                        $reqObj = Request::loadById($request_id);
                } else {
                        $reqObj = Request::loadByText($theCustomer->id, AfwDateHelper::currentHijriDate(), $request_subject, $request_body);
                        if (!$reqObj) $reqObj = new Request();
                }

                $oldReqObj = null;

                // be sure before commit that no investigator is working on it
                if ($reqObj->isAssigned()) {
                        $error_saving = AfwLanguageHelper::tt("Can't apply changes, The investigator started working on this request");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                } else {
                        $reqObj->set("customer_id", $theCustomer->id);
                        $reqObj->set("customer_type_id", $theCustomer->getVal("customer_type_id"));
                        $reqObj->set("related_request_code", $old_ticket);
                        if ($old_ticket) {
                                $oldReqObj = $reqObj->getRelatedTicket();
                                if ($oldReqObj and $oldReqObj->getVal("service_satisfied") == "N") {
                                        // if you do ta3qib so we remove your previous unsatisfaction and wait your new satisfaction survey regarding ta3qib request
                                        $oldReqObj->set("service_satisfied", "W");
                                }
                        }
                        $reqObj->set("request_link", $web_site);
                        if ($request_priority) $reqObj->set("request_priority", $request_priority);
                        $reqObj->set("request_for", "crm-" . $related_object_id);
                        $reqObj->set("request_text", $request_body);
                        $reqObj->set("request_title", $request_subject);
                        $reqObj->set("request_type_id", $request_type);
                        $reqObj->set("region_id", $region);
                        $reqObj->set("active", "Y");

                        if (!$reqObj->isOk(true)) {
                                $data["all_error"] = implode(",\n", $reqObj->getDataErrors());
                        } else {
                                $reqObj->commit();
                                if ($oldReqObj) $oldReqObj->commit();
                                // send the request 
                                $reqObj->sendRequest();
                                if (!$data["id"]) {
                                        $data["id"] = $reqObj->id;
                                        $data["is_new"] = true;
                                } else {
                                        $data["is_new"] = false;
                                }
                        }
                }



                return $data;
        }

        public function submit_request($request)
        {
                $data = $request;



                if (!$data["all_error"]) {
                        if ($data["is_new"]) {
                                $theCustomer = AfwSession::getCustomerConnected();
                                if ($theCustomer) {
                                        $data["customer_connected"] = $theCustomer;
                                }
                                // call the view 1
                                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");

                                $this->render("crm", "request_form_done", $data);
                        } else {
                                $this->myrequests($data);
                        }
                } else {
                        if (!$data["id"]) {
                                $this->request($data);
                        } else {
                                $this->edit_request($data);
                        }
                }
        }


        /******************************** register action ********************************************** */
        /*
        public function prepareRegister($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function register($request)
        {
                $data = $request;
                // echo("request = ".var_export($request,true)."<br><br>");
                foreach ($request as $key => $value) $$key = $value;
                $data["cityList"] = City::loadAll();

                $theCustomer = AfwSession::getCustomerConnected();

                if ($theCustomer) {
                        $data["city_id"] = $theCustomer->getVal("city_id");
                        $data["your_full_name"] = $theCustomer->getVal("full_name");
                        $data["customer_mobile"] = $theCustomer->getVal("mobile");
                        $data["customer_idn"] = $theCustomer->getVal("idn");
                }

                if (!$data["city_id"]) $data["city_id"] = 301; //RIYADH
                // call the view 1
                $this->render("crm", "register_company", $data);

                // call the view 2
                $this->render("crm", "best_offers", $data);
        }


        public function prepareSubmit_register($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function submit_register($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                AfwAutoLoader::addMainModule("crm");

                if ((!$customer_idn) or (!$customer_mobile)) {
                        $theCustomer = AfwSession::getCustomerConnected();
                        if ($theCustomer) {
                                $customer_mobile = $theCustomer->getVal("mobile");
                                $customer_idn = $theCustomer->getVal("idn");
                                $your_full_name = $theCustomer->getVal("full_name");
                        }

                        if (!$customer_idn) $customer_idn = "ANONYM-" . date("YmdHis");
                }
                if (!$trade_idn) $trade_idn = "NIN-" . $customer_idn . "-" . $customer_mobile;
                $mobile = trim($mobile);
                $crmObj = CrmCustomer::loadByMainIndex($mobile, 70, $customer_idn, $create_obj_if_not_found = true);
                if ($crmObj->getVal("customer_orgunit_id") > 0) {
                        $data["all_error"] = "هذا السجل التجاري تم تسجيله سابقا";
                } else {
                        list($first_name, $father_name, $last_name) = AfwStringHelper::arabic_full_name_explode($company_name);
                        if (!$father_name) $father_name = "للعمرة";
                        if (!$last_name) $last_name = "والزيارة";

                        $crmObj->set("first_name_ar", $first_name);
                        $crmObj->set("father_name_ar", $father_name);
                        $crmObj->set("last_name_ar", $last_name);

                        list($first_name_en, $father_name_en, $last_name_en) = AfwStringHelper::arabic_full_name_explode($your_full_name);
                        $crmObj->set("first_name_en", $first_name_en);
                        $crmObj->set("father_name_en", $father_name_en);
                        $crmObj->set("last_name_en", $last_name_en);

                        $crmObj->set("phone", $customer_mobile);
                        $crmObj->set("other_city", $web_site);

                        $crmObj->set("customer_type_id", 5);  // travel company
                        $crmObj->set("ref_num", trim($trade_idn));
                        $crmObj->set("city_id", $city_id);
                        $crmObj->set("email", trim($email));
                        $crmObj->set("gender_id", 1);
                        $crmObj->commit();

                        if (!$crmObj->isOk(true)) {
                                $data["all_error"] = implode(",\n", $crmObj->getDataErrors());
                        }
                }

                if (!$data["all_error"]) {
                        // call the view 1
                        $this->render("crm", "register_company_done", $data);

                        // call the view 2
                        $this->render("crm", "best_offers", $data);
                } else {
                        $data["cityList"] = City::loadAll();
                        // call the view 1
                        $this->render("crm", "register_company", $data);

                        // call the view 2
                        $this->render("crm", "best_offers", $data);
                }
        }
        */
}
