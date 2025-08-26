<?php

$file_dir_name = dirname(__FILE__);

// 18/5/2022 : 
// alter table crm_customer change phone phone varchar(16) NULL;


// 25/5/2022 :
// alter table crm_customer add service_satisfied char(1) not null default 'Y';
// alter table crm_customer add pb_resolved char(1) not null default 'Y';
/*
create table tmp_rafik_satisf_cust as select customer_id, min(service_satisfied) as service_satisfied, min(pb_resolved) as pb_resolved from request where survey_sent = 'Y' group by customer_id;
create unique index uindx_customer_id on tmp_rafik_satisf_cust(customer_id);
update crm_customer cc set service_satisfied = (select service_satisfied from tmp_rafik_satisf_cust t where t.customer_id = cc.id) where cc.id in (select customer_id from tmp_rafik_satisf_cust);
update crm_customer cc set pb_resolved = (select pb_resolved from tmp_rafik_satisf_cust t where t.customer_id = cc.id) where cc.id in (select customer_id from tmp_rafik_satisf_cust);
drop table tmp_rafik_satisf_cust;

ALTER TABLE `crm_customer` CHANGE `ref_num` `ref_num` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL; 
*/



class CrmCustomer extends CrmObject implements AfwFrontEndUser
{

        public static $MY_ATABLE_ID = 3610;

        public static $MAX_ACTIVE_CUSTOMER_PERIOD = 354; // nb of days in hijri year

        public static $DATABASE                = "";
        public static $MODULE                    = "crm";
        public static $TABLE                        = "crm_customer";
        public static $DB_STRUCTURE = null;


        public function __construct()
        {
                parent::__construct("crm_customer", "id", "crm");
                CrmCrmCustomerAfwStructure::initInstance($this);
        }


        public static $STATS_CONFIG = array(
                /*
                "gs001" => array(
                        "STATS_WHERE" => "active = 'Y' and last_request_date between [date_start_stats] and [date_end_stats]", // 
                        "DISABLE-VH" => true,
                        "FOOTER_TITLES" => false,
                        "FOOTER_SUM" => true,
                        "GROUP_SEP" => ".",
                        "GROUP_COLS" => array(
                                0 => array("COLUMN" => "customer_type_id", "DISPLAY-FORMAT" => "decode", "FOOTER_SUM_TITLE" => "الإجمــالـي"),
                        ),
                        "DISPLAY_COLS" => array(
                                1 => array("COLUMN" => "this_month", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "this_month", "FOOTER_SUM" => true),
                                2 => array("COLUMN" => "previous_month", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "previous_month", "FOOTER_SUM" => true),
                                3 => array("COLUMN" => "older_customer", "COLUMN_IS_FORMULA" => true, "GROUP-FUNCTION" => "sum", "SHOW-NAME" => "older_customer", "FOOTER_SUM" => true),
                                4 => array("COLUMN" => "id", "GROUP-FUNCTION" => "count", "SHOW-NAME" => "count_cust", "FOOTER_SUM" => true),
                        ),






                        "OPTIONS" => array(
                                "simple" => array('count_cust' => true),
                        ),
                        // "SUPER_HEADER"=>array(0=>array("colspan"=>3, "title"=>""), 1=>array("colspan"=>2, "title"=>"year_36"), 2=>array("colspan"=>2, "title"=>"year_37"),
                        //                      3=>array("colspan"=>2, "title"=>"year_38"), 4=>array("colspan"=>2, "title"=>"year_39"), 5=>array("colspan"=>2, "title"=>"year_40"), ),

                ),*/




        );



        public static function loadById($id)
        {
                $obj = new CrmCustomer();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function loadByMobileAndFirstName($mobile, $first_name_ar)
        {
                $obj = new CrmCustomer();
                if (!$mobile) throw new AfwRuntimeException("loadByMobileAndFirstName : mobile is mandatory field");
                if (!$first_name_ar) throw new AfwRuntimeException("loadByMobileAndFirstName : first_name_ar is mandatory field");


                $obj->select("mobile", $mobile);
                $obj->select("first_name_ar", $first_name_ar);
                $obj->where("length(idn)=10");

                if ($obj->load()) {
                        return $obj;
                } else return null;
        }

        public static function loadByMobileAndEmail($mobile, $email)
        {
                $obj = new CrmCustomer();
                if (!$mobile) throw new AfwRuntimeException("loadByMobileAndFirstName : mobile is mandatory field");
                if (!$email) throw new AfwRuntimeException("loadByMobileAndFirstName : email is mandatory field");


                $obj->select("mobile", $mobile);
                $obj->select("email", $email);


                if ($obj->load()) {
                        return $obj;
                } else return null;
        }


        public static function loadByMobile($mobile, $the_incorect_idn)
        {
                $obj = new CrmCustomer();
                if (!$mobile) throw new AfwRuntimeException("loadByMobileAndFirstName : mobile is mandatory field");

                $obj->select("mobile", $mobile);
                $obj->where("length(idn)=10");
                if ($the_incorect_idn) $obj->where("idn != '$the_incorect_idn'");
                if ($obj->load()) {
                        return $obj;
                } else return null;
        }

        public static function loadByMainIndex($mobile, $idn_type_id, $idn, $create_obj_if_not_found = false)
        {
                $obj = new CrmCustomer();
                if (!$mobile) throw new AfwRuntimeException("loadByMainIndex : mobile is mandatory field");
                if (!$idn_type_id) throw new AfwRuntimeException("loadByMainIndex : idn_type_id is mandatory field");
                if (!$idn) throw new AfwRuntimeException("loadByMainIndex : idn is mandatory field");


                $obj->select("mobile", $mobile);
                $obj->select("idn", $idn);

                if ($obj->load()) {

                        if ($create_obj_if_not_found) {
                                $obj->set("idn_type_id", $idn_type_id);
                                $obj->set("customer_type_id", 1);

                                $obj->activate();
                        }
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("mobile", $mobile);
                        $obj->set("idn", $idn);
                        $obj->set("idn_type_id", $idn_type_id);
                        $obj->set("customer_type_id", 1);

                        $obj->insert();
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }


        public function getTaqibCandidate()
        {
                $req = new Request();
                $req->select("customer_id", $this->id);
                $req->select("active", "Y");
                $req->select("survey_sent", "Y");
                $req->select("pb_resolved", "N");
                $req->select("service_satisfied", "N");
                $req->where("survey_token is not null and survey_token != ''");

                $reqList = $req->loadMany(1, "id asc");

                // return first item (the list tself contain only 1 item max)
                foreach ($reqList as $reqItem) return $reqItem;

                // if empty return null

                return null;
        }

        public static function createOrUpdateCustomer($mobile, $idn, $first_name, $last_name, $customer_gender_id, $city_id, $customer_type_id = 1)
        {
                if (!$idn) throw new AfwRuntimeException("createOrUpdateCustomer : idn is mandatory");
                if (!$mobile) throw new AfwRuntimeException("createOrUpdateCustomer : mobile is mandatory");

                list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn, $authorize_other_sa_idns = true);
                if (!$idn_correct)  throw new AfwRuntimeException("createOrUpdateCustomer : idn number [$idn] is not correct");

                $customerObj = self::loadByMainIndex($mobile, $idn_type_id, $idn, $create_obj_if_not_found = true);
                if (!$customerObj->getVal("first_name_ar")) {
                        $customerObj->set("first_name_ar", $first_name);
                        $customerObj->set("last_name_ar", $last_name);
                }
                $customerObj->set("city_id", $city_id);
                $customerObj->set("gender_id", $customer_gender_id);
                $customerObj->set("customer_type_id", $customer_type_id);


                $customerObj->commit();

                return $customerObj;
        }

        public static function loadByLoginInfos($mobile, $email, $idn)
        {

                if (!$idn)  AfwRunHelper::simpleError("loadByLoginInfos : idn is mandatory");
                if ((!$mobile) and (!$email))  AfwRunHelper::simpleError("loadByMainIndex : mobile or email is mandatory");

                list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn, false, false);

                $obj = new CrmCustomer();
                $obj->where("idn='$idn' or (idn like 'NID-%' and mobile != '0598988330')");
                $obj->where("email='$email' or mobile='$mobile'");


                if ($obj->load()) {
                        if ($idn_correct) // rafik : 19/5/2022, this is to repaire customers who came from old ma3an nartaqi database without IDN 
                        // so we have put virtual IDN starting with NID-XXX (XXX is the node ID in old drupal database)
                        {
                                $obj->set("idn", $idn);
                                $obj->set("idn_type_id", $idn_type_id);
                                $obj->commit();
                        }
                        return $obj;
                } else return null;
        }

        public static function loadByIdn($idn)
        {

                if (!$idn)  AfwRunHelper::simpleError("loadByLoginInfos : idn is mandatory");

                list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn, false, false);

                $obj = new CrmCustomer();
                $obj->select("idn", $idn);
                $obj->select("idn_type_id", $idn_type_id);

                if ($obj->load()) {
                        return $obj;
                } else return null;
        }


        /*
        deprecated : never update mobile or idn of customer it is his identity for us 
        public static function loadByMainInfos($mobile, $email, $idn_type_id, $idn,$create_obj_if_not_found=false)
        {
           $obj = new CrmCustomer();
           
           if((!$mobile) and (!$email) and (!$idn))  throw new AfwRuntimeException("loadByMainIndex : mobile or email or idn is mandatory");

           if($email)
           {
                $obj->select("email",$email);
           }
           elseif($mobile)
           {
                $obj->select("mobile",$mobile);
           }
           else
           {
                $obj->select("idn",$idn);
           }
           

           if($obj->load())
           {
                if($mobile) $obj->set("mobile",$mobile);
                if($email) $obj->set("email",$email);
                if($idn) 
                {
                        $obj->set("idn_type_id",$idn_type_id);
                        $obj->set("idn",$idn);
                }
                $obj->commit();
                
                if($create_obj_if_not_found) 
                {
                        $obj->activate();
                }        
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("mobile",$mobile);
                $obj->set("email",$email);
                $obj->set("idn_type_id",$idn_type_id);
                $obj->set("idn",$idn);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }
        */

        public function getShortDisplay($lang = "ar")
        {

                $data = array();
                $link = array();

                if ($lang == "ar") {
                        list($data[0], $link[0]) = $this->displayAttribute("first_name_ar", false, $lang);
                        list($data[1], $link[1]) = $this->displayAttribute("father_name_ar", false, $lang);
                        list($data[2], $link[2]) = $this->displayAttribute("last_name_ar", false, $lang);
                } else {
                        list($data[0], $link[0]) = $this->displayAttribute("first_name_en", false, $lang);
                        list($data[1], $link[1]) = $this->displayAttribute("father_name_en", false, $lang);
                        list($data[2], $link[2]) = $this->displayAttribute("last_name_en", false, $lang);
                }

                $return = trim(implode(" ", $data));  // $this->getId().":".
                if (!$return) $return = "عميل جديد";

                return $return;
        }

        public function getDropDownDisplay($lang = "ar")
        {
                return $this->getDisplay($lang);
        }


        public function getDisplay($lang = "ar")
        {
                $displ = $this->getShortDisplay($lang);
                $idn = $this->getVal("idn");
                // if($idn) $displ .= " - رقم الهوية  : ".$idn;
                if ($idn) $displ .= " - " . $idn;
                $mobile = $this->getVal("mobile");
                //if($mobile) $displ .= " - رقم الجوال : ".$mobile;
                if ($mobile) $displ .= " / " . $mobile;
                //if(AfwStringHelper::stringContain($displ,"sara_4238_@hotmail.com")) throw new AfwRuntimeException("This is case of strange key display : $displ");
                return $displ;
        }


        /*
        public function list_of_customer_type_id() { 
            $list_of_items = array(); 
            $list_of_items[5] = "عميل";  //     code : CUSTOMER 
            $list_of_items[4] = "موظف";  //     code : EMPLOYEE 
            $list_of_items[1] = "صحفي";  //     code : JOURNALIST 
            $list_of_items[2] = "مواطن";  //     code : PERSON 
            $list_of_items[3] = "متدرب";  //     code : TRAINER 
           return  $list_of_items;
        }*/




        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
                global $me, $lang;
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $displ = $this->getDisplay($lang);


                if ($mode == "mode_requestList") {
                        unset($link);
                        $link = array();
                        $title = "إضافة تذكرة";
                        $title_detailed = $title . "لـ : " . $displ;
                        $link["URL"] = "i.php?cn=crm&mt=request&rt=2&cusid=$my_id";
                        $link["TITLE"] = $title;
                        $link["TARGET"] = "newTicket";
                        $link["PUBLIC"] = true;
                        $link["UGROUPS"] = array();
                        $link['ATTRIBUTE_WRITEABLE'] = 'requestList';
                        $otherLinksArray[] = $link;
                }


                return $otherLinksArray;
        }

        protected function getPublicMethods()
        {

                $pbms = array();
                /*should be dynamic @todo rafik
                if($this->getVal("customer_type_id") == 5) // travel company
                {
                        $color = "red";
                        $title_ar = "انشاء شركة/مكتب رحلات"; 
                        $methodName = "createBTBWorkBranch";
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "PUBLIC"=>true, "BF-ID"=>"", STEP => 1,
                                CONFIRMATION_NEEDED=>true,
                                'CONFIRMATION_QUESTION' =>  array('ar' => "سيتم انشاء حساب حقيقي لهذا العميل على أنه مكتب رحلات هل أنت متأكد", 
                                                                'en' => "You will create travel company. Sure ?"),
                                'CONFIRMATION_WARNING' => array('ar' => "من المفروض أن تكون تواصلت مع العميل وتأكدت من جديته بارسال البيانات الضروروية", 
                                                                'en' => "please check data is correct bedore and this company exists"),

                
                        );
                }*/


                return $pbms;
        }
        /*
        public function createBTBWorkBranch()
        {

        }
        */



        public function beforeDelete($id, $id_replace)
        {


                if (!$id) {
                        $id = $this->getId();
                        $simul = true;
                } else {
                        $simul = false;
                }

                if ($id) {
                        if ($id_replace == 0) {
                                $server_db_prefix = AfwSession::currentDBPrefix(); // FK part of me - not deletable 
                                // crm.request-صاحب الطلب	customer_id  أنا تفاصيل لها-OneToMany (required field)

                                $obj = new Request();
                                $obj->where("customer_id = '$id' and active='Y' ");
                                $nbRecords = $obj->count();
                                // check if there's no record that block the delete operation
                                if ($nbRecords > 0) {
                                        $this->deleteNotAllowedReason = "يوجد لدى هذا العميل طلبات حالية فيتعذر حذفه";
                                        return false;
                                }
                                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                                if (!$simul) $obj->deleteWhere("customer_id = '$id' and active='N'");



                                $server_db_prefix = AfwSession::currentDBPrefix(); // FK part of me - deletable 


                                // FK not part of me - replaceable 



                                // MFK

                        } else {
                                $server_db_prefix = AfwSession::currentDBPrefix(); // FK on me 


                                // crm.request-صاحب الطلب	customer_id  أنا تفاصيل لها-OneToMany (required field)
                                if (!$simul) {

                                        Request::updateWhere(array('customer_id' => $id_replace), "customer_id='$id'");
                                        // $this->execQuery("update ${server_db_prefix}crm.request set customer_id='$id_replace' where customer_id='$id' ");

                                }




                                // MFK


                        }
                        return true;
                }
        }

        public function list_of_idn_type_id()
        {
                $list_of_items = array();
                $list_of_items[1] = "بطاقة أحوال";  //     code : AHWAL 
                $list_of_items[2] = "إقامة";  //     code : IQAMA 
                $list_of_items[99] = "أخرى";  //     code : OTHER 
                return  $list_of_items;
        }


        public function list_of_gender_id()
        {
                $list_of_items = array();
                $list_of_items[1] = "ذكر";
                $list_of_items[2] = "أنثى";

                return  $list_of_items;
        }

        public function stepsAreOrdered()
        {
                return false;
        }

        public function calcFull_name()
        {
                $fn = "";
                $fn = trim($fn . " " . $this->valFirst_name_ar());
                $fn = trim($fn . " " . $this->valFather_name_ar());
                $fn = trim($fn . " " . $this->valLast_name_ar());

                return $fn;
        }

        public function calcFull_name_en()
        {
                $fn = "";
                $fn = trim($fn . " " . $this->valFirst_name_en());
                $fn = trim($fn . " " . $this->valFather_name_en());
                $fn = trim($fn . " " . $this->valLast_name_en());

                return $fn;
        }


        public function correctIdn()
        {
                $idn = $this->getVal("idn");
                list($idn_correct, $idn_type_id) = AfwFormatHelper::getIdnTypeId($idn);

                return $idn_correct;
        }


        /*
        public function isPublic()
        {
              return ($this->getVal("customer_type_id") == 1);
        }
        
        public function isTrainee()
        {
              return ($this->getVal("customer_type_id") == 2);
        }
        
        public function isEmployee()
        {
              return ($this->getVal("customer_type_id") == 3);
        }*/


        public function getAttributeLabel($attribute, $lang = "ar", $short = false)
        {
                if ($attribute == "customer_orgunit_id") {
                        $customerTypeObj = $this->hetType();
                        if (!$lang) $lang = "ar";
                        if ($customerTypeObj) return $customerTypeObj->getVal("org_$lang");
                        else return "unkown customer type";
                }

                if ($attribute == "ref_num") {
                        // $customerTypeObj = $this->hetType();
                        if (!$lang) $lang = "ar";
                        $custTypeLogic = AfwSession::config("cust_type_logic", []);    
                        // $customerTypeId = $customerTypeObj->id;            
                        $customerTypeId = $this->getVal("customer_type_id");
                        $return = $custTypeLogic[$customerTypeId]["ref_num"]["title_$lang"];
                        // $customerType is no more object
                        // if (!$return and $customerTypeObj) $return = $customerTypeObj->getVal("ref_$lang");
                        if (!$return) $return = "unkown ref_num label for customer type $customerTypeId for lang $lang";

                        return $return;
                }


                if ($attribute == "org_name") {
                        // $customerTypeObj = $this->hetType();
                        if (!$lang) $lang = "ar";
                        $custTypeLogic = AfwSession::config("cust_type_logic", []);                
                        // $customerTypeId = $customerTypeObj->id;
                        $customerTypeId = $this->getVal("customer_type_id");
                        $return = $custTypeLogic[$customerTypeId]["org_name"]["title_$lang"];
                        // $customerType is no more object
                        // if (!$return and $customerTypeObj) $return = $customerTypeObj->getVal("org_name_$lang");
                        if (!$return) $return = "unkown org_name label for customer type $customerTypeId for lang $lang";

                        return $return;
                }

                return AfwLanguageHelper::getAttributeTranslation($this, $attribute, $lang, $short);
        }

        public function attributeIsApplicable($attribute)
        {
                if (($attribute == "customer_orgunit_id") or ($attribute == "ref_num")) {
                        $customerTypeObj = $this->hetType();
                        if ($customerTypeObj) return ($customerTypeObj->estInternal());
                        else return false;
                }

                return true;
        }


        public function updateDateSystem($ds, $commit = true)
        {
                if ($ds == "hijri") $this->set("hijri", "Y");
                else $this->set("hijri", "N");

                if ($commit) $this->commit();
        }


        public function getDateSystem()
        {
                if ($this->sureIs("hijri")) return "hijri";
                else "greg";
        }


        public function getFormuleResult($attribute, $what = 'value')
        {
                global $me, $file_dir_name;

                $YYYY_mm = substr($this->getVal("created_at"), 0, 7);
                $this_month = date("Y-m");
                $pm = intval(date("m")) - 1;
                if ($pm >= 10) $pm = "" . $pm;
                else $pm = "0" . $pm;
                $previous_month = date("Y") . "-" . $pm;

                switch ($attribute) {
                        case "this_month":

                                if ($YYYY_mm == $this_month) return 1;
                                return 0;
                                break;

                        case "previous_month":

                                if ($YYYY_mm == $previous_month) return 1;
                                return 0;
                                break;


                        case "older_customer":
                                if (($YYYY_mm != $this_month) and ($YYYY_mm != $previous_month)) return 1;
                                return 0;
                                break;
                }

                return AfwFormulaHelper::calculateFormulaResult($this, $attribute);
        }


        public function calcDate_start_stats()
        {
                $start_period = self::$MAX_ACTIVE_CUSTOMER_PERIOD;
                return AfwDateHelper::shiftHijriDate("", -$start_period);
        }

        public function calcDate_end_stats()
        {
                return AfwDateHelper::currentHijriDate();
        }

        public function afterInsert($id, $fields_updated)
        {
                $this->set("last_request_date", AfwDateHelper::currentHijriDate());
                $this->commit();
        }


        public function beforeMaj($id, $fields_updated)
        {
                
                if ($this->getVal("customer_type_id") == CustomerType::$CUSTOMER_TYPE_ANONYMOUS) {
                        $employee_email_domain = AfwSession::config("employee_email_domain", "@company.com");
                        if (AfwStringHelper::stringEndsWith(strtolower($this->getVal("email")), $employee_email_domain)) 
                        {
                                $this->set("customer_type_id", CustomerType::$CUSTOMER_TYPE_EMPLOYEE);
                        }
                        $trainee_email_domain = AfwSession::config("trainee_email_domain", "@company.com.sa");
                        $trainee_email_starts_with = AfwSession::config("trainee_email_domain", "");
                        if (((!$trainee_email_starts_with) or AfwStringHelper::stringStartsWith(strtolower($this->getVal("email")), $trainee_email_starts_with))
                                and (AfwStringHelper::stringEndsWith(strtolower($this->getVal("email")), $trainee_email_domain)))
                        {
                                $this->set("customer_type_id", CustomerType::$CUSTOMER_TYPE_TRAINEE);
                        }
                }



                return true;
        }

        public function decideSMSTemplate($sms_template)
        {
                if ($this->getVal("service_satisfied") == "N") return "not_satisfied";
                return $sms_template;
        }


        public function makeMeTestCustomer()
        {
                $this->set("first_name_ar", "[اسم العميل]");
        }





        public function smsRetrieveAction($lang, $actionParamsArr, $only_get_description = false, $token_arr = array())
        {
                if (!$only_get_description) {
                        $id = $this->id;
                        $customer_mobile = $this->getVal("mobile");
                        if ($customer_mobile) $customer_mobile = AfwFormatHelper::formatMobile($customer_mobile);
                        $customer_mobile_correct = AfwFormatHelper::isCorrectMobileNum($customer_mobile);
                } else {
                        $this->makeMeTestCustomer();
                        $customer_mobile = true;
                        $customer_mobile_correct = true;
                }

                if ($customer_mobile and $customer_mobile_correct) {
                        $file_dir_name = dirname(__FILE__);
                        $sms_template = $actionParamsArr[0];
                        // the SMS template has an origin is the default value this is $sms_template
                        // and we take this default for description 
                        $exceptional_sms_template = $this->decideSMSTemplate($sms_template);
                        if ($exceptional_sms_template != $sms_template) {
                                // ...
                                include("$file_dir_name/../tpl/template_sms_$exceptional_sms_template.php");
                                if ($sms_body_arr[$lang]) {
                                        $exceptional_sms_body = $this->decodeTpl($sms_body_arr[$lang], array(), $lang, $token_arr);
                                } else {
                                        $exceptional_sms_body = "";
                                }

                                $exceptional_template_desc = " : " . $this->translate('action.sms.' . $exceptional_sms_template, $lang);
                        }
                        if (!$only_get_description) {
                                // but for case of real execute of action some esxceptional customer can need a different
                                // template so we decide the template via decideSMSTemplate method
                                $sms_template = $exceptional_sms_template;
                        }

                        include("$file_dir_name/../tpl/template_sms_$sms_template.php");

                        if ($sms_body_arr[$lang]) {
                                $sms_body = $this->decodeTpl($sms_body_arr[$lang], array(), $lang, $token_arr);
                        } else {
                                $sms_body = "";
                        }

                        if (!$only_get_description) {


                                if (!$sms_body) return array(false, $this->tm("can't find body of SMS for this template and langue") . " [$sms_template/$exceptional_sms_template, $lang]", $sms_body);


                                $simulate_sms_to_mobile = AfwSession::config("simulate_sms_to_mobile", null);

                                if ($simulate_sms_to_mobile) $sms_mobile = $simulate_sms_to_mobile;
                                else $sms_mobile = $customer_mobile;

                                // send SMS to customer       
                                list($sms_ok, $sms_info) = AfwSmsSender::sendSMS($sms_mobile, $sms_body);

                                return array($sms_ok, $sms_info, $sms_body);
                        } else {
                                if ($exceptional_sms_body) {
                                        $exceptional_sms_desc = "نص رسالة أخرى $exceptional_template_desc : <br><pre>$exceptional_sms_body</pre>";
                                } else {
                                        $exceptional_sms_desc = "";
                                }
                                return array(true, "نص الرسالة : <br><pre>$sms_body</pre>" . $exceptional_sms_desc, $sms_body);
                        }
                } else {
                        return array(false, $this->tm("this customer does not have correct mobile number") . " [$id]", "");
                }
        }

        public function getCustomerPicture()
        {
                $html = "";
                // @todo see in uploaded files of this user if there are picture

                // use initials like RB for Rafik BOUBAKER
                $en_name = $this->calcFull_name_en();
                if(!$en_name) $en_name = AfwStringHelper::arabic_to_latin_chars($this->calcFull_name());
                if(!$en_name) $en_name = "??";
                $initials = AfwStringHelper::initialsOfName($en_name);                
                $html = "<div class='user-account'>$initials</div>";
                return $html;
        }

        public static function loadByIdnAndRefnum($idn, $ref_num)
        {
                $obj = new CrmCustomer();
                if (!$idn) $obj->throwError("loadByIdnAndRefnum : idn is mandatory field");
                if (!$ref_num) $obj->throwError("loadByIdnAndRefnum : ref_num is mandatory field");

                $obj->select("idn", $idn);
                $obj->select("ref_num", $ref_num);

                if ($obj->load()) {
                        return $obj;
                } else return null;
        }

        public function getMyDepartmentName($lang)
        {
                list($return,) = $this->displayAttribute("customer_type_id", false, $lang);
                return $return;
        }

        public function getMyJob($lang)
        {
                return $this->tm("customer", $lang);
        }
        
        public function getUserPicture()
        {
                return $this->getCustomerPicture();
        }

        public function myShortNameToAttributeName($attribute)
        {
                if ($attribute == "type") return "customer_type_id";
                // if ($attribute == "type") return "customer_type_id";
                
                return $attribute;
        }


        public function generateCacheFile($lang="ar", $onlyIfNotDone=false, $throwError=false)
        {
                 
        }

        protected function supervisorCanEditMe()
        {
                return [true, ''];
        }

        public final function isSuperAdmin()
        {
                return false;
        }
        

        public final function isAdmin()
        {
                return false;
        }

        public final function isSupervisor()
        {
                return false;
        }
}
