<?php

class Customer extends MsgObject{

        public static $MY_ATABLE_ID=3600; 

        
	public static $DATABASE		= ""; 
    public static $MODULE		    = ""; 
    public static $TABLE			= ""; 
    public static $DB_STRUCTURE = null;
	
	public function __construct(){
		parent::__construct("customer","id","msg");
        MsgCustomerAfwStructure::initInstance($this);        
	}
        
        public static function loadById($id)
        {
           $obj = new Customer();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($mobile, $idn,$create_obj_if_not_found=false)
        {
           $obj = new Customer();
           if(!$idn) $obj->_error("loadByMainIndex : idn field should be filled");
           if((!$mobile) and (!$idn)) $obj->_error("loadByMainIndex : idn or mobile field should be filled");
           


           $obj->select("mobile",$mobile);
           $obj->select("idn",$idn);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("mobile",$mobile);
                $obj->set("idn",$idn);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
 
               $data = array();
               $link = array();
 
 
               list($data[0],$link[0]) = $this->displayAttribute("first_name",false, $lang);
               list($data[1],$link[1]) = $this->displayAttribute("last_name",false, $lang);
 
 
               $return = trim(implode(" ",$data));
               if($return) return $return;
               else return "no-name-for-customer-".$this->getId();
        }
        
        
        

        /*
        protected function getOtherLinksArray($mode)      
        {
             global $me, $objme, $lang;
             $otherLinksArray = array();
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
 
             if($mode=="mode_customerFieldList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة بيانات العملاء ";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=CustomerField&currmod=sms&id_origin=$my_id&class_origin=Customer&module_origin=sms&newo=10&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=customer_id=$my_id&sel_customer_id=$my_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
 
 
 
             return $otherLinksArray;
        }*/
 
        protected function getPublicMethods()
        {
 
            $pbms = array();
 
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            //$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
 
 
 
            return $pbms;
        }
 
        
        public function beforeDelete($id,$id_replace) 
        {
            global $server_db_prefix;
 
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 
 
 
                   // FK part of me - deletable 
                       // sms.customer_field-العميل	customer_id  أنا تفاصيل لها-OneToMany
                        $this->execQuery("delete from ${server_db_prefix}sms.customer_field where customer_id = '$id' ");
 
 
                   // FK not part of me - replaceable 
 
 
 
                   // MFK
 
               }
               else
               {
                        // FK on me 
                       // sms.customer_field-العميل	customer_id  أنا تفاصيل لها-OneToMany
                        $this->execQuery("update ${server_db_prefix}sms.customer_field set customer_id='$id_replace' where customer_id='$id' ");
 
 
                        // MFK
 
 
               } 
               return true;
            }    
	}
        
        
        public function setField($c_system_id, $field_num, $value)
        {
            /*
             require_once("customer_field.php");
             if(!$this->getId()) $this->throwError("I am not ready as customer to setField");
             $cf = CustomerField::loadByMainIndex($this->getId(), $c_system_id, $create_obj_if_not_found=true);
             
             $cf->set("field${field_num}_value", $value);
             
             $cf->commit();*/
        }
        
        
        public function getMySpecialFields()
        {
             $arrMySpecialFields = array();
             
             $customerFieldList = $this->get("customerFieldList");
             
             $c_system_id = $this->c_system_id;
             
             foreach($customerFieldList as $customerFieldObj)
             {
                 if($c_system_id==$customerFieldObj->getVal("c_system_id")) 
                 {
                     for($fnum=0;$fnum<=7;$fnum++) $arrMySpecialFields["f".$fnum] = $customerFieldObj->getVal("field${fnum}_value");
                 }
             }
             
             return $arrMySpecialFields;
        }
        
        
        protected function importRecord($dataRecord,$orgunit_id,$overwrite_data,$options,$lang, $dont_check_error)
        {
          $errors = [];
          
          foreach($dataRecord as $key => $val) $$key = $val;
          if(!$customer_code)
          {
               $errors[] = $this->translateMessage("missed customer code value",$lang);
               return array(null,$errors,[],[]);
          }
          /*
          if((!$mobile) and (!$email))
          {
               $errors[] = $this->translateMessage("missed mobile and email value, how to contact customer ?",$lang);
               return array(null,$errors,[],[]);
          } */
          
          
          if(($mobile) and (!$email))
          {
              $email = "simul-$mobile"."@gmail.com"; 
          }
          
          if(!$idn)
          {
              $idn = "cust:".$customer_type."-".$customer_code; 
          }
          
          if(true)
          {
                 //lookup for the customer may be it exists
                 $customer = self::loadByMainIndex($mobile, $idn,$create_obj_if_not_found=true);
                 
                 // mise a jour de $student si new or $overwrite_data
                 if($overwrite_data or $customer->is_new)
                 {
                         
                         if($email) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("gender_id",$gender,$lang); else $val_ok = true;
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if($email) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("email",$email,$lang); else $val_ok = true;
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if($customer_type) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("customer_type",$customer_type,$lang); else $val_ok = true;
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if($firstname) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("first_name",$firstname,$lang); else $val_ok = true;
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if($lastname) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("last_name",$lastname,$lang); else $val_ok = true; 
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         
                         if($customer_code) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("customer_code",$customer_code,$lang); else $val_ok = true; 
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if($unit_code) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("unit_code",$unit_code,$lang); else $val_ok = true; 
                         if(!$val_ok) $errors[] = $val_parsed_or_error;

                         if($unit_type) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("unit_type",$unit_type,$lang); else $val_ok = true; 
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if($unit_name) list($val_ok, $val_parsed_or_error) = $customer->parseAttribute("unit_name",$unit_name,$lang); else $val_ok = true; 
                         if(!$val_ok) $errors[] = $val_parsed_or_error;
                         
                         if(count($errors)==0)
                         {
                             if(!$dont_check_error) $errors = $customer->getDataErrors($lang);
                             //$this->_error("student->getDataErrors = ".var_export($errors,true));
                         }                             
                         if(count($errors)==0)
                         {
                             $customer->commit();
                         } 
                         
                 }
                 else
                 {
                         $errors[] = $this->translateMessage("This unit_name already exists and overwrite is not allowed",$lang);
                 }
                 return array($customer,$errors,[],[]);
          }
          else
          {
                 $errors[] = $this->translateMessage("incorrect idn format",$lang) . " : " . $idn;
                 return array(null,$errors,[],[]);
          } 
          
          
          
      }
      
      protected function namingImportRecord($dataRecord, $lang)
      {
          return $dataRecord["firstname"]. " " . $dataRecord["lastname"]. " - " . $dataRecord["unit_name"];
      }
      
      protected function getRelatedClassesForImport($options=null)
      {
          $file_dir_name = dirname(__FILE__);     
          
          // include("$file_dir_name/module_tables_info.php");
          // include("$file_dir_name/../ums/module_tables_info.php");
               
          $importClassesList = [];
          
          
          return $importClassesList;
      }
      
      public function list_of_genre_id() 
      { 
            $list_of_items = array(); 
            $list_of_items[1] = "ذكر";
            $list_of_items[2] = "أنثى";
             
           return  $list_of_items;
      }
             
}
?>