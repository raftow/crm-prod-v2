<?php

class IntelligentContentArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["intelligent_content"]["intelligentcontent.single"] = "محتوى ذكي";
		$trad["intelligent_content"]["intelligentcontent.new"] = "جديد";
		$trad["intelligent_content"]["intelligent_content"] = "المحتويات الذكية";
		$trad["intelligent_content"]["name_ar"] = "مسمى  بالعربية";
		$trad["intelligent_content"]["description"] = "وصف  المحتوى";
		$trad["intelligent_content"]["name_en"] = "مسمى  بالانجليزية";
		$trad["intelligent_content"]["tokens"] = "المخرجات";
		$trad["intelligent_content"]["module_id"] = "التطبيق";
		$trad["intelligent_content"]["lookup_code"] = "الرمز";
		$trad["intelligent_content"]["content_category_enum"] = "صنف المحتوى";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new IntelligentContent();
	}
}