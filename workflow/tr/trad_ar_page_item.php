<?php

class PageItemArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page_item"]["pageitem.single"] = "عنصر صفحة";
		$trad["page_item"]["pageitem.new"] = "جديد(ة)";
		$trad["page_item"]["page_item"] = "عناصر الصفحات";
		$trad["page_item"]["name_ar"] = "مسمى  بالعربية";
		$trad["page_item"]["desc_ar"] = "وصف  بالعربية";
		$trad["page_item"]["name_en"] = "مسمى  بالانجليزية";
		$trad["page_item"]["desc_en"] = "وصف  بالانجليزية";
		$trad["page_item"]["page_id"] = "الصفحة";
		$trad["page_item"]["item_num"] = "رقم العنصر";
		$trad["page_item"]["page_section_id"] = "قسم الصفحة";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new PageItem();
	}
}