<?php

class PublicationArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["publication"]["publication.single"] = "مقال";
		$trad["publication"]["publication.new"] = "جديد(ة)";
		$trad["publication"]["publication"] = "المقالات";
		$trad["publication"]["module_id"] = "التطبيق";
		$trad["publication"]["name_ar"] = "مسمى  بالعربية";
		$trad["publication"]["name_en"] = "مسمى  بالانجليزية";
		$trad["publication"]["title_ar"] = "العنوان بالعربية";
		$trad["publication"]["title_en"] = "العنوان بالانجليزية";
		$trad["publication"]["summary_ar"] = "الملخص بالعربية";
		$trad["publication"]["summary_en"] = "الملخص بالانجليزية";
		$trad["publication"]["desc_ar"] = "النص الكامل بالعربية";
		$trad["publication"]["desc_en"] = "النص الكامل بالانجليزية";
		$trad["publication"]["published"] = "منشور";
		$trad["publication"]["publish_start_date"] = "تاريخ بداية النشر بالهجري";
		$trad["publication"]["publish_end_date"] = "تاريخ نهاية النشر  بالهجري";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Publication();
	}
}