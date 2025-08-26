<div class="cms_bg_pic contact">    
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div>  
<div class="content_big_title registration">بطاقة طلب</div>
<div class="cms_bg">
<?
        //if(!$ticketObj) die("this ticket is lost");
        $my_status = $ticketObj->getVal("status_id");
        $my_status_decoded = $ticketObj->getCustomerStatus("ar");
        
        // test of ->showAttribute(..) after ->set(..)
        // $ticketObj->set("status_id", Request::$REQUEST_STATUS_REDIRECT);
        // $my_status_show = $ticketObj->showAttribute("status_id");
        // die("my_status_show=$my_status_show");

        $request_type_decoded = $ticketObj->decode("request_type_id");
        $full_request_date = ($ds == "hijri") ? $ticketObj->fullHijriDate("request_date") : AfwDateHelper::fullGregDate(AfwDateHelper::hijriToGreg($ticketObj->getVal("request_date")));
        $full_status_date = ($ds == "hijri") ? $ticketObj->fullHijriDate("status_date") : AfwDateHelper::fullGregDate(AfwDateHelper::hijriToGreg($ticketObj->getVal("status_date")));
                    
?>
<div class="cms_container ticket_div">
        <div class='hzm_attribute hzm_wd4 hzm_minibox_header0'>                
                
                <div class='front_bloc hzm_crm_bloc ticket status_<?php echo $my_status; ?>'>
                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_ticket'>
                                <?php echo $request_type_decoded; ?> رقم <div class='crm_ticket_num'><?php echo $ticketObj->getVal("request_code"); ?> </div>
                                </div>
                                <div class='my_crm_ticket fleft'>
                                       <div class='request_status status_<?php echo $my_status; ?>' ><?php echo $my_status_decoded; ?> </div>
                                </div>
                        </div>
                        <div class='my_crm_dates'>
                                <div class='mb_med_title my_ticket'> 
                                        <div class='crm_calendar crm_data'>
                                        <label> <?php echo $ticketObj->getVal("request_title"); ?> </label>                                        
                                        <span class="hzm_date"><?php echo $full_request_date; ?> الساعة</span> <span class="hzm_time"><?php echo $ticketObj->getVal("request_time"); ?> </span> 
                                        </div>
                                </div>
                        </div>

                        <div class='front_bloc hzm_data_props my_cms'>
                                <div class='my_crm_ticket_data'>                        
                                        <div class="row crm_data">
                                                <label>نص الطلب</label>
                                                <div class='hzm_data_prop request_text'>
                                                <?php echo $ticketObj->getVal("request_text"); ?> 
                                                </div>
                                        </div>
                                        <div class="row crm_data">
                                                
                                                <?php 
                                                
                                                        if($ticketObj->getVal("related_request_code") and isset($relatedTicketObj) and $relatedTicketObj)
                                                        {
                                                ?> 
                                                                                <label>متعلق بطلب سابق : <?php echo $relatedTicketObj->request_title." <div class=\"crm_ticket_num bggray\">".$ticketObj->getVal("related_request_code")."</div>"; ?></label>
                                                                                <div class='hzm_data_prop related_request_code'>
                                                                                        <div class='hzm_data_prop'>                                                                                                
                                                                                                <a target='_related_request' href='i.php?cn=crm&mt=view_request&rid=<?php echo $relatedTicketObj->id ?>'>
                                                                                                        <div class='hzm_blue hzm_print'>مشاهدة تفاصيل الطلب الأصلي</div>
                                                                                                </a>
                                                                                        </div> 
                                                                                </div>     
                                                                        <?php
                                                        }
                                                
                                                ?> 
                                                
                                        </div>

                                        
                                <?php 
                                        $ticket_status_comment = $ticketObj->getLastActionOnRequest($lang);
                                ?>        
                                        <div class="row crm_data title_crm">
                                                <label>الاجراءات / الأحداث</label>
                                        </div>
                                <?php 
                                        if($ticket_status_comment)
                                        {
                                ?>
                                        <div class="row crm_data">       
                                                <div class='hzm_data_prop hzm_comment'>
                                                        <?php echo $ticket_status_comment; ?> 
                                                </div>
                                                <div class='hzm_small_calendar calendar_left'>
                                                تم في <span class="hzm_small_date"><?php echo $full_status_date; ?></span> س <span class="hzm_time hzm_small_time"><?php echo $ticketObj->getVal("status_time"); ?> </span> 
                                                </div>
                                        </div>
                                
                                <?php 
                                        }
                                        else
                                        { 
                                ?>
                                        <div class="row crm_data">
                                                <span>لم يحدث أي اجراء بعد</span>
                                        </div>
                                <?php 
                                        }
                                        $parentTpl = "view_request";
                                        include_once("ticket_btns.php");
                                ?>
                                        <div class="row crm_data title_crm">
                                                <label>الردود / التعليقات السابقة</label>                                                
                                        </div>
                                <?php 
                                        $responseList = $ticketObj->get("externalResponseList");
                                        $odd = "even ";
                                        if(count($responseList)>0)
                                        {
                                                /**
                                                 * @var Response $responseItem
                                                 */
                                                foreach($responseList as  $responseItem)
                                                {
                                                        $css_resp = strtolower($responseItem->calcResponse_aut("value", "en"))."-crm ";
                                                        $full_response_date = ($ds == "hijri") ? $responseItem->fullHijriDate("response_date") : AfwDateHelper::fullGregDate(AfwDateHelper::hijriToGreg($responseItem->getVal("response_date")));
                                ?>
                                        <div class="row <?php echo $odd.$css_resp?>crm_data crm_response type<?php echo $responseItem->getVal("response_type_id")?>">
                                                <div class='hzm_small_calendar calendar_left'>
                                                        <span class="hzm_small_date"><?php echo $full_response_date; ?> </span> 
                                                        <span class="hzm_small_time"><?php echo $responseItem->response_time; ?> </span> 
                                                        <label><?php echo $responseItem->getShortDisplay($lang);?> </label>
                                                </div>                                                
                                                <div class='hzm_data_prop hzm_comment'>
                                                        <?php echo $responseItem->showAttribute("response_text"); ?> 
                                                </div>
                                                
                                        </div>
                                
                                <?php 
                                                        if($odd=="even ") $odd = "odd ";
                                                        else $odd = "even ";
                                                }        
                                        }
                                        else
                                        { 
                                ?>
                                        <div class="row crm_data">
                                                <span>لا يوجد ردود أو تعليقات </span>
                                        </div>
                                <?php 
                                        }
                                        
                                
                                        if($ticketObj->is("survey_sent") and $ticketObj->getVal("survey_token"))
                                        {
                                                $survey_btn_title = "استبيان تقييم الخدمة";
                                                if($ticketObj->is("survey_opened") or true)
                                                {
                                        ?> 
                                        
                                        <div class="row crm_data title_crm">
                                                <label>استبيان رضا العميل</label>                                                
                                        </div>
                                        <div class="row crm_data survey">
                                                <label>سرعة التواصل</label>                                                
                                                <div class='hzm_data_prop survey easy_fast<?php echo $ticketObj->getVal("easy_fast"); ?>'>
                                                        <?php echo $ticketObj->showAttribute("easy_fast"); ?> 
                                                </div>
                                        </div>
                                        <div class="row crm_data survey">
                                                <label>رضا العميل</label>                                                
                                                <div class='hzm_data_prop survey service_satisfied<?php echo $ticketObj->getVal("service_satisfied"); ?> '>
                                                        <?php echo $ticketObj->showAttribute("service_satisfied"); ?> 
                                                </div>
                                        </div>
                                        <div class="row crm_data survey">
                                                <label>تم حل المشكل</label>                                                
                                                <div class='hzm_data_prop survey pb_resolved<?php echo $ticketObj->getVal("pb_resolved"); ?>'>
                                                        <?php echo $ticketObj->showAttribute("pb_resolved"); ?> 
                                                </div>
                                        </div>
                                        <?php 
                                                        if(($ticketObj->isNot("service_satisfied")) or ($ticketObj->isNot("pb_resolved")) or true)
                                                        {
                                                                $survey_btn_title = "إعادة تقييم الخدمة";
                                        ?>
                                                <div class="btn_container taqib">
                                                        <div class='content_body contact'>   
                                                                        <a class='crm question thin-btn' href='/crm/i.php?cn=crm&mt=request&taqib=1&rt=3&oldrt=<?php echo $ticketObj->getVal("request_type_id"); ?>&pt=<?php echo $ticketObj->id; ?>'>تقديم طلب تعقيب</a>                                                                
                                                        </div>
                                                </div>
                                        <?php 
                                                        }                                                        
                                                }

                                                if(true)
                                                {
                                                        $crm_survey_id = AfwSession::config('crm_survey_id', '174363');
                                                        $lime_survey_domain = AfwSession::config('lime_survey_domain', 'survey.company');
                                                        $limesurvey_url = AfwSession::config('limesurvey_url', "http://$lime_survey_domain/surv/i.php");
                                        ?>
                                        <div class="btn_container survey">
                                                <div class='content_body contact'>   
                                                   <a class='crm response thin-btn' target='_lmsurv' href='<?php echo $limesurvey_url?>/<?php echo $crm_survey_id?>?token=<?php echo $ticketObj->getVal("survey_token"); ?>&lang=ar'><?php echo $survey_btn_title ?> </a>
                                                </div>
                                        </div>
                                        <?php
                                                } 
                                        }
                                        ?>


                                
                                
                                
                                
                                </div>                                
                        </div>
                </div>
                   
                
        </div>
</div>
<?
$cr_prefix = "العودة إلى";
include("back_to_my_requests_tpl.php");
?>
</div>
</div>
