<?php

class CrmEmpRequestArTranslator{
    public static function initData()
    {
        $trad = [];	
        $trad["crm_emp_request"]["crmemprequest.single"] = "طلب اضافة منسق خدمة العملاء";
        $trad["crm_emp_request"]["crmemprequest.single.short"] = "طلب اضافة منسق";
        $trad["crm_emp_request"]["crmemprequest.new"] = "جديد";
        $trad["crm_emp_request"]["crm_emp_request"] = "طلبات اضافة المنسقين لدى خدمة العملاء";
        $trad["crm_emp_request"]["crm_emp_request.short"] = "طلبات اضافة المنسقين";
        $trad["crm_emp_request"]["orgunit_id"] = "الجهة المتابعة";
        $trad["crm_emp_request"]["crm_orgunit_id"] = "الجهة التابع لها";
        
        $trad["crm_emp_request"]["employee_id"] = "الموظف";


        $trad["crm_emp_request"]["active"] = "نشط";
        $trad["crm_emp_request"]["approved"] = "طلب مقبول'"; 
        $trad["crm_emp_request"]["reject_reason_ar"] = "سبب الرفض بالعربية";
        $trad["crm_emp_request"]["reject_reason_en"] = "سبب الرفض بالانجليزية";
        $trad["crm_emp_request"]["step1"] = "البيانات العامة";
        $trad["crm_emp_request"]["step2"] = "الطلبات المسندة";
        $trad["crm_emp_request"]["step3"] = "جهات المتابعة";
    
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmpRequest();
	}
}
    

    
	

	 
?>