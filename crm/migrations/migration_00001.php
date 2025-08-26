<?php
    $aroleObj = Arole::loadByMainIndex(1073, 'goal-FOLLOWUP', true);
    $aroleObj->set('titre_short_en','reports');
    $aroleObj->set('titre_short','التقارير');
    $aroleObj->set('titre_en','reports to followup the center work');
    $aroleObj->set('titre','التقارير لأجل متابعة سير عمل المكتب');
    $newAtableObj = Atable::loadByMainIndex(1073, 'request');
    if($newAtableObj) $newAtableObj_id = $newAtableObj->id;
    else $newAtableObj_id = -2; // not found table in destination
    $objBF = Bfunction::loadByBusinessIndex(1, $newAtableObj_id, 3569, 'stats', 'stc=gs001', true);
    AroleBf::loadByMainIndex($aroleObj->id, $objBF->id, true);
    $newAtableObj = Atable::loadByMainIndex(1073, 'crm_customer');
    if($newAtableObj) $newAtableObj_id = $newAtableObj->id;
    else $newAtableObj_id = -2; // not found table in destination
    $objBF = Bfunction::loadByBusinessIndex(1, $newAtableObj_id, 3610, 'stats', 'none', true);
    AroleBf::loadByMainIndex($aroleObj->id, $objBF->id, true);
    $newAtableObj = Atable::loadByMainIndex(1073, 'request');
    if($newAtableObj) $newAtableObj_id = $newAtableObj->id;
    else $newAtableObj_id = -2; // not found table in destination
    $objBF = Bfunction::loadByBusinessIndex(1, $newAtableObj_id, 3569, 'stats', 'stc=gs003', true);
    AroleBf::loadByMainIndex($aroleObj->id, $objBF->id, true);
    $newAtableObj = Atable::loadByMainIndex(1073, 'request');
    if($newAtableObj) $newAtableObj_id = $newAtableObj->id;
    else $newAtableObj_id = -2; // not found table in destination
    $objBF = Bfunction::loadByBusinessIndex(1, $newAtableObj_id, 3569, 'stats', 'stc=gs005', true);
    AroleBf::loadByMainIndex($aroleObj->id, $objBF->id, true);
    $newAtableObj = Atable::loadByMainIndex(1073, 'request');
    if($newAtableObj) $newAtableObj_id = $newAtableObj->id;
    else $newAtableObj_id = -2; // not found table in destination
    $objBF = Bfunction::loadByBusinessIndex(1, $newAtableObj_id, 3569, 'stats', 'stc=gs006', true);
    AroleBf::loadByMainIndex($aroleObj->id, $objBF->id, true);