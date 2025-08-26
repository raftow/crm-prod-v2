<?php

class PageThemeEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page_theme"]["pagetheme.single"] = "  ";
		$trad["page_theme"]["pagetheme.new"] = "new";
		$trad["page_theme"]["page_theme"] = "  ";
		$trad["page_theme"]["name_ar"] = "Arabic Page theme name";
		$trad["page_theme"]["desc_ar"] = "Arabic Page theme description";
		$trad["page_theme"]["name_en"] = "English Page theme name";
		$trad["page_theme"]["desc_en"] = "English Page theme description";
		$trad["page_theme"]["lookup_code"] = "Lookup code";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new PageTheme();
	}
}