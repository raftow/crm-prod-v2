<?php

class PageThemeArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page_theme"]["pagetheme.single"] = "ثيم";
		$trad["page_theme"]["pagetheme.new"] = "جديد(ة)";
		$trad["page_theme"]["page_theme"] = "الثيمات";
		$trad["page_theme"]["name_ar"] = "مسمى  بالعربية";
		$trad["page_theme"]["desc_ar"] = "وصف  بالعربية";
		$trad["page_theme"]["name_en"] = "مسمى  بالانجليزية";
		$trad["page_theme"]["desc_en"] = "وصف  بالانجليزية";
		$trad["page_theme"]["lookup_code"] = "الرمز";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new PageTheme();
	}
}