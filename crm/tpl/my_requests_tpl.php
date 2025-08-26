<div class="cms_bg_pic">
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div>        
<?php
// die("requestList=".var_export($requestList,true));
if(!$requestList) $requestList = [];
if(count($requestList)>0)
{
?>
<div class="content_big_title registration">قائمة <?php echo $title; ?></div>    
<?php
}
?>
<div class="cms_bg">
<?
foreach($requestList as $ticketObj)     
{
        $my_status = $ticketObj->getVal("status_id");
        $my_status_decoded = $ticketObj->getCustomerStatus("ar");
        $request_type_decoded = $ticketObj->decode("request_type_id");
        

        $full_request_date = ($ds == "hijri") ? $ticketObj->fullHijriDate("request_date") : AfwDateHelper::fullGregDate(AfwDateHelper::hijriToGreg($ticketObj->getVal("request_date")));
        $full_status_date = ($ds == "hijri") ? $ticketObj->fullHijriDate("status_date") : AfwDateHelper::fullGregDate(AfwDateHelper::hijriToGreg($ticketObj->getVal("status_date")));
                    
?>
<div class="request_container">
        <div class='hzm_attribute hzm_wd4 hzm_minibox_header0'>                
                
                <div class='front_bloc hzm_crm_bloc ticket status_<?php echo $my_status; ?>'>
                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_ticket title'>
                                <?php echo $request_type_decoded; ?> <div class='crm_ticket_num'><?php echo $ticketObj->getVal("request_code"); ?> </div>                                        
                                </div>
                                <div class='my_crm_ticket status fleft'>
                                       <div class='request_status status_<?php echo $my_status; ?>' ><?php echo $my_status_decoded; ?> </div>
                                </div>
                        </div>
                        <div class='front_bloc hzm_data_props my_cms'>
                                <div class='my_crm_ticket_data'>                        
                                        <div class="row crm_data">
                                                <span class="hzm_date"><?php echo $full_request_date; ?> س </span><span class="hzm_time"><?php echo $ticketObj->getVal("request_time"); ?> </span> 
                                                <label><?php echo $ticketObj->getVal("request_title"); ?></label>
                                                <div class='hzm_data_prop request_text'>
                                                <?php echo AfwStringHelper::truncateArabicJomla($ticketObj->getVal("request_text"), $maxlen=250, $etc="..."); ?> 
                                                </div>
                                        </div>
                                <?php 
                                        $ticket_status_comment = $ticketObj->getLastActionOnRequest($lang);
                                        
                                        if($ticket_status_comment)
                                        {
                                ?>
                                        <div class="row crm_data">
                                                <label>آخر حدث   </label>
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
                                                <label>لم يحدث أي اجراء بعد</label>
                                        </div>
                                <?php 
                                        }
                                        $parentTpl = "my_requests";
                                        include("ticket_btns.php");

                                        
                                ?>
                                
                                
                                
                                
                                </div>                                
                        </div>
                </div>

                
                
        </div>
</div>
<?
}

include("new_request_tpl.php");
?>

</div>
</div>
