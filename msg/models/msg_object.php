<?php

class MsgObject extends AFWObject
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

        /*
        public static function userConnectedIsSupervisor($objme = null)
        {
                if (!$objme) $objme = AfwSession::getUserConnected();
                if (!$objme) return 0;

                $employee_id = $objme->getEmployeeId();
                if (!$employee_id) return 0;

                return MsgEmployee::isAdmin($employee_id);
        }

        public static function userConnectedIsGeneralSupervisor($objme = null)
        {
                if (!$objme) $objme = AfwSession::getUserConnected();
                if (!$objme) return 0;

                $employee_id = $objme->getEmployeeId();
                if (!$employee_id) return 0;

                return MsgEmployee::isGeneralAdmin($employee_id);
        }*/

        public static function userConnectedIsSuperAdmin($objme = null)
        {
                if (!$objme) $objme = AfwSession::getUserConnected();
                if (!$objme) return false;
                return $objme->isSuperAdmin();
        }


        public function fld_CREATION_USER_ID()
        {
                return "creation_user_id";
        }

        public function fld_CREATION_DATE()
        {
                return "creation_date";
        }

        public function fld_UPDATE_USER_ID()
        {
                return "update_user_id";
        }

        public function fld_UPDATE_DATE()
        {
                return "update_date";
        }

        public function fld_VALIDATION_USER_ID()
        {
                return "validation_user_id";
        }

        public function fld_VALIDATION_DATE()
        {
                return "validation_date";
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
}
