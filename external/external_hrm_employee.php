<?php
   class ExternalHrmEmployee {
   
        public static function loadJsonFromExternalHRSystem($username, $employee_num)
        {
           global $objme;
                if(!$employee_num) $employee_num = "0";
                if(!$username) $username = "\"\"";
                $data[] = $username;
                $data[] = $employee_num;
                
                $api_url_list = [];
                $api_url_list[] = "https://commws.tvtc.gov.sa/RestService/GetEmployeeDetail";
                $api_url_list[] = "http://commwstst.tvtc.gov.sa/RestService/GetEmployeeDetail";
                $api_url_list[] = "http://commwsdev.tvtc.gov.sa/RestService/GetEmployeeDetail";

                $file_dir_name = dirname(__FILE__);

                $resEmployee = [];
                require_once("$file_dir_name/../lib/afw/afw_web_service_api.php");
                foreach($api_url_list as $api_url)
                {
                        $resEmployee = getDataFromAPIUrl($api_url, $data);
                        if($resEmployee['login']) break;
                }
                
                

                $resEmployee["api_url"] = $api_url;
                $resEmployee["api_data"] = implode("/",$data);
                $resEmployee_origin = $resEmployee;
                
                $log = "result of loadJsonFromExternalHRSystem($username, $employee_num) : ".var_export($resEmployee,true);
                AfwSession::logHzm("hrm", "Employee", $log);
                if(!$resEmployee['login']) {
                        if(AfwSession::config("MODE_DEVELOPMENT", false))
                        {
                                $error_msg = "no login found in HRE data getDataFromAPIUrl($api_url, ".var_export($data,true).") : ".var_export($resEmployee,true);
                        }
                        else
                        {
                                $error_msg = AfwLanguageHelper::tt("This employee account is disabled");
                                if(isset($resEmployee["term_desc"])) $error_msg .= " : ".$resEmployee["term_desc"];
                        }
                        return array(false, $error_msg, null);
                } 
                
                $resEmployee['email'] = $resEmployee['login'] . "@tvtc.gov.sa"; 
                //die("resEmployee = ".var_export($resEmployee,true));
                $resEmployee_correct = ($resEmployee["login"]==$username);
                if($resEmployee and $resEmployee_correct) 
                {
                        $reg_id = 0;
                        $city_id = 0;
                        if($resEmployee['region_code'] and $resEmployee['region_desc'])
                        {
                                // 
                                $regObj = Region::findRegion($resEmployee['region_code'], $resEmployee['region_desc']);
                                if($regObj) $reg_id = $regObj->getId();
                        }
                        
                        if($resEmployee['city_code'] and $resEmployee['city_desc'] and $reg_id)
                        {
                                //
                                $cityObj = City::findCity($resEmployee['city_code'], $resEmployee['city_desc'], $reg_id);
                                if($cityObj) $city_id = $cityObj->getId();
                        }
                        
                        if(!$resEmployee['DEPTTYPE_ID']) 
                        {
                                $resEmployee['department_type_id'] = 12;
                        }        
                        else
                        {
                                //
                                $ot = OrgunitType::loadByCode($resEmployee['DEPTTYPE_ID'], $resEmployee['dept_type_desc'], $create_obj_if_not_found=true);
                                $resEmployee['department_type_id'] = $ot->getId();
                                if(!$resEmployee['department_type_id']) $resEmployee['department_type_id'] = 12;
                        }
                        
                        
                        if($resEmployee['company']=='TVTC') $resEmployee['company_id'] = 1;
                        else 
                        {
                                // create orgunit of company
                                // @todo
                                $resEmployee['company_id'] = 1;
                        }
                        
                        
                        $resEmployee['departmentDesc'] = trim($resEmployee['departmentDesc']);
                        $resEmployee['department_id'] = 0;
                        
                        if($resEmployee['departmentDesc'] and $resEmployee['departmentID']) 
                        {
                                //
                                // create orgunit of department
                                $depObj = Orgunit::findOrgunit($resEmployee['department_type_id'], $resEmployee['company_id'], $resEmployee['departmentID'], $resEmployee['departmentDesc'], $resEmployee['departmentDesc'], 4, $create_obj_if_not_found=true, $update_obj_if_found = false);
                                $depObj->set("city_id",$city_id);
                                $depObj->commit();
                                
                                $resEmployee['department_id'] = $depObj->getId();
                                
                        }
                        else
                        {
                               die("api failed 001 : ".var_export($resEmployee_origin,true));
                        }
                        
                        if(!$resEmployee['department_id']) $resEmployee['department_id'] = 3;       
                        
                        $ok = true;
                        $error = "";
                }
                else
                {
                       if(!$resEmployee) $error = "api has failed <br>\n";
                       else $error = "data returned by api is incorrect <br>\n";
                       $ok = false;
                }
                
                return array($ok, $error, $resEmployee);
        }
   }
?>