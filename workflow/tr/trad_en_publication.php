<?php

class PublicationEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["publication"]["publication.single"] = "  ";
		$trad["publication"]["publication.new"] = "new";
		$trad["publication"]["publication"] = "  ";
		$trad["publication"]["name_ar"] = "Arabic Publication name";
		$trad["publication"]["desc_ar"] = "Arabic Publication description";
		$trad["publication"]["name_en"] = "English Publication name";
		$trad["publication"]["desc_en"] = "English Publication description";
		$trad["publication"]["title_ar"] = "Arabic Response template name";
		$trad["publication"]["title_en"] = "Title en";
		$trad["publication"]["summary_ar"] = "Summary ar";
		$trad["publication"]["summary_en"] = "Summary en";
		$trad["publication"]["publish_start_date"] = "Publish start date";
		$trad["publication"]["publish_end_date"] = "Publish end date";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new Publication();
	}
}