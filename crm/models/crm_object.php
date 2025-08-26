<?php

class CrmObject extends AFWObject
{

        // إدارة المنتج	إدارة البيانات العامة للنظام
        public static $AROLE_OF_DATA_SITE = 322;

        // التحقيق	التحقيق والرد على طلبات العملاء 
        public static $AROLE_OF_INVESTIGATOR = 323;

        // الإشراف على تشغيل نظام خدمة العملاء
        public static $AROLE_OF_SUPERVISOR = 324;

        // إدخال الطلبات الالكترونية التي تصل عبر الهاتف
        public static $AROLE_OF_REQUEST_ENTER = 327;

        // إدارة البيانات المرجعية للنظام
        public static $AROLE_OF_LOOKUPS = 347;

        // إدارة البيانات المرجعية للنظام
        public static $AROLE_OF_GENERAL_SUPERVISOR = 376;


        public static function userConnectedIsSupervisor($objme = null)
        {
                if (!$objme) $objme = AfwSession::getUserConnected();
                if (!$objme) return 0;

                $employee_id = $objme->getEmployeeId();
                if (!$employee_id) return 0;

                return CrmEmployee::isAdmin($employee_id);
        }

        public static function userConnectedIsGeneralSupervisor($objme = null)
        {
                if (!$objme) $objme = AfwSession::getUserConnected();
                if (!$objme) return 0;

                $employee_id = $objme->getEmployeeId();
                if (!$employee_id) return 0;

                return CrmEmployee::isGeneralAdmin($employee_id);
        }

        public static function userConnectedIsSuperAdmin($objme = null)
        {
                if (!$objme) $objme = AfwSession::getUserConnected();
                if (!$objme) return false;
                return $objme->isSuperAdmin();
        }


        public function fld_CREATION_USER_ID()
        {
                return "created_by";
        }

        public function fld_CREATION_DATE()
        {
                return "created_at";
        }

        public function fld_UPDATE_USER_ID()
        {
                return "updated_by";
        }

        public function fld_UPDATE_DATE()
        {
                return "updated_at";
        }

        public function fld_VALIDATION_USER_ID()
        {
                return "validated_by";
        }

        public function fld_VALIDATION_DATE()
        {
                return "validated_at";
        }

        public function fld_VERSION()
        {
                return "version";
        }

        public function fld_ACTIVE()
        {
                return  "active";
        }

        public function isTechField($attribute)
        {
                return (($attribute == "created_by") or ($attribute == "created_at") or ($attribute == "updated_by") or ($attribute == "updated_at") or ($attribute == "validated_by") or ($attribute == "validated_at") or ($attribute == "version"));
        }

        public static function code_of_customer_type_id($lkp_id=null)
        {
            $lang = AfwLanguageHelper::getGlobalLanguage();
            if($lkp_id) return self::customer_type()['code'][$lkp_id];
            else return self::customer_type()['code'];
        }

        public static function name_of_customer_type_id($customer_type_id, $lang="ar")
        {
            return self::customer_type()[$lang][$customer_type_id];            
        }
        
        public static function list_of_customer_type_id($lang = null)
        {
            if(!$lang) $lang = AfwLanguageHelper::getGlobalLanguage();
            return self::customer_type()[$lang];
        }
        
        public static function customer_type()
        {
                $arr_list_of_customer_type = array();
                
                $custTypeListDefault = array(1=>['ar'=>"عميل"]);
                $custTypeList = AfwSession::config("cust_type_list", $custTypeListDefault);
                        
                foreach($custTypeList as $idct => $custTypeRow)
                {
                        $arr_list_of_customer_type["code"][$idct] = "CT".$idct;
                        $arr_list_of_customer_type["ar"][$idct] = $custTypeRow['ar'];
                        $arr_list_of_customer_type["en"][$idct] = $custTypeRow['en'];
                }
                
                return $arr_list_of_customer_type;
        }
}
