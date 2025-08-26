<?php

class IdnToIdEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["idn_to_id"]["idntoid.single"] = "Idn to";
		$trad["idn_to_id"]["idntoid.new"] = "new";
		$trad["idn_to_id"]["idn_to_id"] = "identity coding";
		$trad["idn_to_id"]["idn"] = "identity number";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
		return new IdnToId();
	}
}