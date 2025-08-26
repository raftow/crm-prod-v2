<?php
$tokens = [];
$tokens["customer_nb"] = CrmCustomer::aggreg("count(*)");
$tokens["customers_title"] = CrmCustomer::t('crm_customer', $lang);
$tokens["request_nb"] = Request::aggreg("count(*)");
$tokens["requests_title"] = Request::t('request', $lang);
$tokens["orgunit_nb"] = CrmOrgunit::aggreg("count(*)");
$tokens["orgunits_title"] = CrmOrgunit::t('', $lang);
$tokens["subject_nb"] = 139; //RequestSubject::aggreg("count(*)");
$tokens["subjects_title"] = Request::t('request_subject', $lang);
$tokens["satisfaction_pct"] = Request::satisfactionPct();
$tokens["satisfaction_title"] = Request::t('satisfaction', $lang);
$tokens["mytasks_nb"] = 7;
$tokens["mytasks_title"] = Request::t('tasks', $lang);

return $tokens;