<?php

class PageItemEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page_item"]["pageitem.single"] = "Page item";
		$trad["page_item"]["pageitem.new"] = "new";
		$trad["page_item"]["page_item"] = "Page items";
		$trad["page_item"]["name_ar"] = "Arabic Page item name";
		$trad["page_item"]["desc_ar"] = "Arabic Page item description";
		$trad["page_item"]["name_en"] = "English Page item name";
		$trad["page_item"]["desc_en"] = "English Page item description";
		$trad["page_item"]["page_id"] = "Page";
		$trad["page_item"]["item_num"] = "Item num";
		$trad["page_item"]["page_section_id"] = "page section";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new PageItem();
	}
}