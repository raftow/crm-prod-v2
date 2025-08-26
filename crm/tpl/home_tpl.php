<div class="cms_bg_pic contact">    
<div class="content_big_title registration">بطاقة عميل</div>
<div class="cms_bg">
<?
        //if(!$customerObj) die("this customer is lost");
        $my_type = $customerObj->getVal("customer_type_id");
        $my_type_decoded = $customerObj->decode("customer_type_id");
?>
<div class="cms_container customer_div">
        <div class='hzm_attribute hzm_wd4 hzm_minibox_header0'>                
                
                <div class='front_bloc hzm_crm_bloc customer type_<?php echo $my_type; ?>'>
                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_customer'>
                                 رقم العميل <div class='crm_customer_num'><?php echo $customerObj->id; ?> </div>
                                </div>
                                <div class='my_crm_customer fleft'>
                                       <div class='crm_customer_prop type_<?php echo $my_type; ?>' ><?php echo $my_type_decoded; ?> </div>
                                </div>
                        </div>

                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_customer'>
                                 رقم الهوية <div class='crm_customer_num'></div>
                                </div>
                                <div class='my_crm_customer fleft'>
                                       <div class='crm_customer_prop idn' ><?php echo $customerObj->getVal("idn"); ?>  </div>
                                </div>
                        </div>

                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_customer'>
                                 رقم الجوال <div class='crm_customer_num'></div>
                                </div>
                                <div class='my_crm_customer fleft'>
                                       <div class='crm_customer_prop mobile' ><?php echo $customerObj->getVal("mobile"); ?>  </div>
                                </div>
                        </div>

                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_customer'>
                                 البريد الالكتروني <div class='crm_customer_num'></div>
                                </div>
                                <div class='my_crm_customer fleft'>
                                       <div class='crm_customer_prop email' ><?php echo $customerObj->getVal("email"); ?>  </div>
                                </div>
                        </div>


                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_customer'>
                                 الاسم الأول<div class='crm_customer_num'></div>
                                </div>
                                <div class='my_crm_customer fleft'>
                                       <div class='crm_customer_prop first_name_ar' ><?php echo $customerObj->getVal("first_name_ar"); ?>  </div>
                                </div>
                        </div>

                        <div class='mb_long_title my_request'> 
                                <div class='my_crm_customer'>
                                 الاسم الأخير<div class='crm_customer_num'></div>
                                </div>
                                <div class='my_crm_customer fleft'>
                                       <div class='crm_customer_prop last_name_ar' ><?php echo $customerObj->getVal("last_name_ar"); ?>  </div>
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
