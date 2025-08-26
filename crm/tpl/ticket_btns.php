
<div class="row crm_data crm_btns">
<?php 
if($parentTpl != "view_request")
{
?>
<div class='hzm_data_prop'>
        <a href='i.php?cn=crm&mt=view_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_blue hzm_print'>التفاصيل</div></a>
</div>

<?php
        if($ticketObj->isToComplete())
        {
?>                                        
        <div class='hzm_data_prop'>
                <a href='i.php?cn=crm&mt=complete_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_blue hzm_print missed'>استكمال البيانات أو المرفقات</div></a>
        </div>
<?php 
        }
} 
else
{

        //echo "parentTpl=$parentTpl";
        if($ticketObj->canResetAsNew())
        {
        ?>
                <div class='hzm_data_prop'>
                        <a href='i.php?cn=crm&mt=draft_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_green hzm_print'>إرجاع إلى حالة مسودة</div></a>
                </div>
        <?php 
        }

        if($ticketObj->isToComplete())
        {
        ?>                                        
        <div class='hzm_data_prop'>
                <a href='i.php?cn=crm&mt=complete_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_blue hzm_print missed'>استكمال البيانات / المرفقات</div></a>
        </div>
        <?php 
        }
        elseif($ticketObj->customerCanComment())
        {
        ?>                                        
        <div class='hzm_data_prop'>
                <a href='i.php?cn=crm&mt=comment_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_blue hzm_print'>تعليق</div></a>
        </div>
        <?php 
        }
        elseif($ticketObj->isDraft())
        {
        ?>                                        
        <div class='hzm_data_prop'>
                <a href='i.php?cn=crm&mt=edit_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_blue hzm_print'>تعديل</div></a>
        </div>

        <div class='hzm_data_prop'>
                <a href='i.php?cn=crm&mt=send_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_green hzm_print'>إرسال الطلب</div></a>
        </div>
        <?php 
        }

        if(!$ticketObj->isStarted() and (!$ticketObj->isCanceled()) and ($ticketObj->isSent()))
        {
        ?>                                        

        <div class='hzm_data_prop'>
                <a href='i.php?cn=crm&mt=cancel_request&rid=<?php echo $ticketObj->id ?>'><div class='hzm_red hzm_print hzm_cancel'>إلغاء الطلب</div></a>
        </div>                                       
        <?php 
        }
}

if(($parentTpl == "my_requests") and ($ticketObj->is("survey_sent")))
{
        if($ticketObj->getVal("service_satisfied")=="Y")
        {
        ?>
                <div class="hzm_data_prop icon_service_satisfied">&nbsp;</div>
        <?php 
        }
        elseif($ticketObj->getVal("service_satisfied")=="N")
        {
        ?>
                <div class="hzm_data_prop icon_service_not_satisfied">&nbsp;</div>
        <?php 
        }
            
}

?>




</div>