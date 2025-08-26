<?php

class PageSectionEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page_section"]["pagesection.single"] = "page section";
		$trad["page_section"]["pagesection.new"] = "new";
		$trad["page_section"]["page_section"] = "page sections";
		$trad["page_section"]["name_ar"] = "Arabic Page section name";
		$trad["page_section"]["desc_ar"] = "Arabic Page section description";
		$trad["page_section"]["name_en"] = "English Page section name";
		$trad["page_section"]["desc_en"] = "English Page section description";
		$trad["page_section"]["module_id"] = "model";
		$trad["page_section"]["section_template_id"] = "template";
		$trad["page_section"]["content_id"] = "Content";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new PageSection();
	}
}