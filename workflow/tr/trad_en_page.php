<?php

class PageEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["page"]["page.single"] = "page";
		$trad["page"]["page.new"] = "new";
		$trad["page"]["page"] = "pages";
		$trad["page"]["module_id"] = "module";
		$trad["page"]["lookup_code"] = "Lookup code";

		$trad["page"]["name_ar"] = "Arabic Page name";
		$trad["page"]["desc_ar"] = "Arabic Page description";
		$trad["page"]["name_en"] = "English Page name";
		$trad["page"]["desc_en"] = "English Page description";
		$trad["page"]["pageItemList"] = "List of pages";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Page();
	}
}