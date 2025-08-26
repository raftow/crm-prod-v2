<?php

class PageArTranslator{
    public static function initData()
    {
        $trad = [];
		$trad["page"]["step1"] = "البيانات العامة";
		$trad["page"]["step2"] = "عناصر الصفحة";
		$trad["page"]["page.single"] = "صفحة";
		$trad["page"]["page.new"] = "جديد(ة)";
		$trad["page"]["page"] = "الصفحات";
		$trad["page"]["lookup_code"] = "الرمز";

		
		$trad["page"]["module_id"] = "التطبيق";
		$trad["page"]["name_ar"] = "مسمى  بالعربية";
		$trad["page"]["desc_ar"] = "وصف  بالعربية";
		$trad["page"]["name_en"] = "مسمى  بالانجليزية";
		$trad["page"]["desc_en"] = "وصف  بالانجليزية";
		$trad["page"]["page_theme_id"] = "الثيم";
		$trad["page"]["pageItemList"] = "قائمة عناصر الصفحات";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Page();
	}
}