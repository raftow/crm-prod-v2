<?php

class IdnToIdArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["idn_to_id"]["idntoid.new"] = "جديد(ة)";
		$trad["idn_to_id"]["idn_to_id"] = "تشفير الهويات";
		$trad["idn_to_id"]["idn"] = "رقم الهوية";
		$trad["idn_to_id"]["idn_type_id"] = "نوع الهوية";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new IdnToId();
	}
}