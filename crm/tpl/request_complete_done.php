<div class="cms_bg_pic">    
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div> 
<div class="content_form_bg">

<div class="success_hzm">
      <div class="register_success_message">تم حفظ البيانات المستكملة على طلبكم بنجاح. <br><br>
<?php
      if($customer_connected)
      {
?>
              يمكنكم متابعة حالة طلباتكم من خلال القائمة <a href='i.php?cn=crm&mt=myrequests'> طلباتي</a>
<?php
      }
      else
      {
?>
            <a href='#' onclick="window.close()"> غلق النافذة</a>
<?php

      }
?>
      </div>

</div>


</div>
</div>