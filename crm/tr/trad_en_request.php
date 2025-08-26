<?php

class RequestEnTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["request"]["request.single"] = "Media request";
		$trad["request"]["request.new"] = "new";
		$trad["request"]["request"] = "Media requests";
		$trad["request"]["request_title"] = "Media request name ar";
		$trad["request"]["lang_id"] = "Lang";
		$trad["request"]["request_for"] = "Request is related with";
		$trad["request"]["request_text"] = "Request description";
		$trad["request"]["request_code"] = "Request code";
		$trad["request"]["request_date"] = "Request date";
		$trad["request"]["request_time"] = "Request time";
		$trad["request"]["request_type_id"] = "Request type";
		$trad["request"]["related_request_code"] = "Related request code";
		$trad["request"]["request_link"] = "Request link";
		$trad["request"]["service_category_id"] = "Service category";
		$trad["request"]["service_id"] = "Service";
		$trad["request"]["request_priority"] = "Request priority";
		$trad["request"]["orgunit_id"] = "B m orgunit";
		$trad["request"]["employee_id"] = "Account";
		$trad["request"]["assign_date"] = "Assign date";
		$trad["request"]["status_id"] = "Request status";
		$trad["request"]["status_comment"] = "Status comment";
		$trad["request"]["status_date"] = "Status date";
		$trad["request"]["region_id"] = "Region";
		$trad["request"]["city_id"] = "City";
		$trad["request"]["other_city"] = "Other city";
		$trad["request"]["responseList"] = "List of Media responses";
		$trad["request"]["survey_sent"] = "Survey sent";
		$trad["request"]["survey_opened"] = "Survey opened";
		$trad["request"]["easy_fast"] = "Easy fast";
		$trad["request"]["service_satisfied"] = "Service satisfied";
		$trad["request"]["pb_resolved"] = "Pb resolved";
		$trad["request"]["general_satisfaction"] = "General satisfaction";
		$trad["request"]["customer_id"] = "Account";
		$trad["request"]["status_action_enum"] = "Last Status Action";
		$trad["request"]["step1"] = "customer owner";
		$trad["request"]["step2"] = "request basis";
		$trad["request"]["step3"] = "request details";
		$trad["request"]["step4"] = "answers and comments";
		$trad["request"]["step5"] = "customer satisfaction";

		return $trad;
	}

	public static function getInstance()
	{
		return new Request();
	}
}