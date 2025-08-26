<?php

class SectionTemplateEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["section_template"]["sectiontemplate.single"] = "template";
		$trad["section_template"]["sectiontemplate.new"] = "new";
		$trad["section_template"]["section_template"] = "templates";
		$trad["section_template"]["name_ar"] = "Arabic Section template name";
		$trad["section_template"]["desc_ar"] = "Arabic Section template description";
		$trad["section_template"]["name_en"] = "English Section template name";
		$trad["section_template"]["desc_en"] = "English Section template description";
		$trad["section_template"]["lookup_code"] = "Lookup code";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new SectionTemplate();
	}
}