<?php

class PageSectionArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page_section"]["pagesection.single"] = "قسم صفحة";
		$trad["page_section"]["pagesection.new"] = "جديد(ة)";
		$trad["page_section"]["page_section"] = "أقسام الصفحات";
		$trad["page_section"]["name_ar"] = "مسمى  بالعربية";
		$trad["page_section"]["desc_ar"] = "وصف  بالعربية";
		$trad["page_section"]["name_en"] = "مسمى  بالانجليزية";
		$trad["page_section"]["desc_en"] = "وصف  بالانجليزية";
		$trad["page_section"]["module_id"] = "التطبيق";
		$trad["page_section"]["section_template_id"] = "النموذج";
		$trad["page_section"]["content_id"] = "المحتوى";
		$trad["page_section"]["page_theme_id"] = "الثيم";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new PageSection();
	}
}