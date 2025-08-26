<?php

class ContentItemArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["content_item"]["contentitem.single"] = "عنصر محتوى";
		$trad["content_item"]["contentitem.new"] = "جديد(ة)";
		$trad["content_item"]["content_item"] = "عناصر المحتوى";
		$trad["content_item"]["name_ar"] = "مسمى  بالعربية";
		$trad["content_item"]["desc_ar"] = "وصف  بالعربية";
		$trad["content_item"]["name_en"] = "مسمى  بالانجليزية";
		$trad["content_item"]["desc_en"] = "وصف  بالانجليزية";
		$trad["content_item"]["content_id"] = "المحتوى";
		$trad["content_item"]["item_num"] = "رقم العنصر";
		$trad["content_item"]["lookup_code"] = "الرمز";
		$trad["content_item"]["content_type_enum"] = "نوع المحتوى";
		$trad["content_item"]["publication_id"] = "المنشور";
		$trad["content_item"]["workflow_file_id"] = "الملف";
		$trad["content_item"]["intelligent_content_id"] = "المحتوى الذكي";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new ContentItem();
	}
}