<?php

class ContentEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["content"]["content.single"] = "content";
		$trad["content"]["content.new"] = "new";
		$trad["content"]["content"] = "contents";
		$trad["content"]["name_ar"] = "Arabic Content name";
		$trad["content"]["desc_ar"] = "Arabic Content description";
		$trad["content"]["name_en"] = "English Content name";
		$trad["content"]["desc_en"] = "English Content description";
		$trad["content"]["content_type_enum"] = "Content type enum";
		$trad["content"]["lookup_code"] = "Lookup code";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Content();
	}
}