<?php

class WorkflowFileArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["workflow_file"]["workflowfile.single"] = "ملف";
		$trad["workflow_file"]["workflowfile.new"] = "جديد";
		$trad["workflow_file"]["workflow_file"] = "الملفات";
		$trad["workflow_file"]["doc_type_id"] = "نوع الملف";
		$trad["workflow_file"]["afile_date"] = "تاريخ  تحميل الملف";
		$trad["workflow_file"]["afile_time"] = "وقت تحميل الملف";
		$trad["workflow_file"]["afile_name"] = "مسمى الملف";
		$trad["workflow_file"]["is_ok"] = "التثبت الآلي من صحة البيانات";

		$trad["workflow_file"]["original_name"] = "الاسم الأصلي للملف";
		$trad["workflow_file"]["afile_ext"] = "امتداد الملف";
		$trad["workflow_file"]["afile_type"] = "نوع الملف";
		$trad["workflow_file"]["picture"] = "صورة ؟";
		$trad["workflow_file"]["afile_size"] = "حجم الملف";
		
		$trad["workflow_file"]["owner_id"] = "صاحب الملف";
		$trad["workflow_file"]["stakeholder_id"] = "الجهة المعنية";
		$trad["workflow_file"]["download"] = "تحميل الملف";
		$trad["workflow_file"]["preview"] = "معاينة الملف";
		
		$trad["workflow_file"]["avail"] = "التفعيل";
		$trad["workflow_file"]["avail-YES"] = "مفعل";
		$trad["workflow_file"]["avail-NO"] = "حذف";
		$trad["workflow_file"]["avail-EUH"] = "غير مفعل";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowFile();
	}
}