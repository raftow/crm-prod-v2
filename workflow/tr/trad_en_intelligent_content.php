<?php

class IntelligentContentEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["intelligent_content"]["intelligentcontent.single"] = "  ";
		$trad["intelligent_content"]["intelligentcontent.new"] = "new";
		$trad["intelligent_content"]["intelligent_content"] = "????? ???";
		$trad["intelligent_content"]["name_ar"] = "Arabic Intelligent content name";
		$trad["intelligent_content"]["desc_ar"] = "Arabic Intelligent content description";
		$trad["intelligent_content"]["name_en"] = "English Intelligent content name";
		$trad["intelligent_content"]["desc_en"] = "English Intelligent content description";
		$trad["intelligent_content"]["lookup_code"] = "Lookup code";
		$trad["intelligent_content"]["content_type_enum"] = "Content type enum";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new IntelligentContent();
	}
}