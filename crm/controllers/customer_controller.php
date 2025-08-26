<?php

class CustomerController extends CrmController
{
        /******************************** account action ********************************************** */
        public function prepareAccount($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }

        public function initiateAccount($request)
        {
                global $lang;
                if (!$lang) $lang = "ar";
                if ($lang == "ar") $lang_suffix = "";
                else $lang_suffix = "_" . $lang;


                $theCustomer = self::checkLoggedIn();

                $data["theCustomer"] = $theCustomer;
                
                // $data = AfwPrevilegeHelper::prepareAfwTokens($theCustomer, "",$lang,[],$data,true,true);

                foreach ($request as $key => $value) $data[$key] = $value;

                return $data;
        }

        public function account($request)
        {
                $data = $request;                
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                // die("customer account data = ".var_export($data,true));
                // call the view 1
                $this->render("crm", "view_customer", $data);
        }    
}