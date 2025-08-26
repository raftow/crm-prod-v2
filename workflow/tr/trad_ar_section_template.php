<?php

class SectionTemplateArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["section_template"]["sectiontemplate.single"] = "نموذج";
		$trad["section_template"]["sectiontemplate.new"] = "جديد(ة)";
		$trad["section_template"]["section_template"] = "نماذج";
		$trad["section_template"]["name_ar"] = "مسمى  بالعربية";
		$trad["section_template"]["desc_ar"] = "وصف  بالعربية";
		$trad["section_template"]["name_en"] = "مسمى  بالانجليزية";
		$trad["section_template"]["desc_en"] = "وصف  بالانجليزية";
		$trad["section_template"]["lookup_code"] = "الرمز";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new SectionTemplate();
	}
}