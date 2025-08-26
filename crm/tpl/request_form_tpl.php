<div class="cms_bg_pic">
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div>    
<div class="content_form_bg">
<div class="content_big_title registration">تقديم طلب إلى <?php echo AfwSession::config("crm_responder", "مكتب خدمة العملاء"); ?></div>
<div id="container_div" class="table_div">
<div id="container_right_div" class="table_cell_div content_form">
<form id="crm_form" method="POST">
<?php
        $customer_mobile_readonly = "readonly";
        $customer_idn_readonly = "readonly";
        $customer_fullname_readonly = "readonly";
?>
<input type="hidden" name="cn" id="cn" value="crm">
<input type="hidden" name="mt" id="mt" value="submit_request">

<div class="in-group-customer_data cssgroup_pct_100">                                          
        <?php
                echo AfwInputHelper::inputErrorsInRequest("all", $data);
        ?>
        <div id="fg-warn" class="attrib-warn form-group width_pct_100 ">
        الرجاء ادخال بيانات مكتملة وصحيحة حتى يتم اعتماد طلبكم والرد عليكم. سيتم آليا اهمال أي طلب يحتوي على بيانات غير صحيحة
        </div>
        <div class="">
                <h5 class="greentitle"><i></i>بيانات صاحب الطلب </h5>
        </div>        
        <div id="group_customer_data" class="" aria-expanded="true" style="">
                <!-- fg-your_full_name -->
                <div id="fg-your_full_name" class="attrib-your_full_name form-group width_pct_100 ">
                        <label for="your_full_name" class="hzm_label hzm_data_your_full_name label_required">اسمك الكامل  
                        </label>        				
                        <input placeholder="" type="text" tabindex="0" class="form-control valid" name="your_full_name" id="your_full_name" dir="rtl" value="<?php echo $your_full_name ?>" size="24" maxlength="32" onchange="" required="true" aria-invalid="false" <?php echo $customer_fullname_readonly ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("your_full_name", $data); ?>
                </div>
                <!-- fg-your_full_name -->
                <!-- fg-customer_mobile -->
                <div id="fg-customer_mobile" class="attrib-customer_mobile form-group width_pct_100 ">
                        <label for="customer_mobile" class="hzm_label hzm_data_customer_mobile label_required">رقم جوالك 
                        </label>                    				
                        <input placeholder="" type="text" tabindex="0" class="form-control" name="customer_mobile" id="customer_mobile" dir="rtl" value="<?php echo $customer_mobile ?>" size="16" maxlength="16" required="true" aria-invalid="false" <?php echo $customer_mobile_readonly ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("customer_mobile", $data); ?>
                </div>
                <!-- fg-customer_mobile -->
                <!-- fg-customer_idn -->
                <div id="fg-customer_idn" class="attrib-customer_idn form-group width_pct_100 ">
                        <label for="customer_idn" class="hzm_label hzm_data_customer_idn label_required">رقم الهوية 
                        </label>                    				
                        <input placeholder="" type="text" tabindex="0" class="form-control" name="customer_idn" id="customer_idn" dir="rtl" value="<?php echo $customer_idn ?>" size="16" maxlength="16" required="true" aria-invalid="false" <?php echo $customer_idn_readonly ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("customer_idn", $data); ?>
                </div>
                <!-- fg-customer_idn -->
        </div> 
             
        <div class="">
                <h5 class="greentitle"><i></i>بيانات الطلب </h5>
        </div>        
        <div id="group_company_data" class="" aria-expanded="true" style="">
                <!-- fg-region -->
                <div id="fg-region" class="attrib-region form-group width_pct_100 ">
                        <label for="region" class="hzm_label hzm_data_region label_required">المنطقة</label>                  
                        <?php echo AfwInputHelper::picture_dropdown($regionList, "region", $selected=array($region), 
                                                                        "region",
                                                                        $data_images=false, // no drop dwon pictures
                                                                        $select_width=0, // means auto
                                                                        $select_css="form-control",
                                                                        $sort_order = "", 
                                                                        $empty_option = true, 
                                                                        $lang,
                                                                        null,null,["readonly"=>$region_readonly]
                                                                        ); ?>        
                </div>
                <!-- fg-region -->        
                
                <!-- fg-request_type -->
                <div id="fg-request_type" class="attrib-request_type form-group width_pct_100 ">
                        <label for="request_type" class="hzm_label hzm_data_request_type label_required">نوع الطلب</label>                  
                        <?php echo AfwInputHelper::picture_dropdown($requestTypeList, "request_type", $selected=array($request_type), 
                                                                        "request_type",
                                                                        $data_images=false, // no drop dwon pictures
                                                                        $select_width=0, // means auto
                                                                        $select_css="form-control",
                                                                        $sort_order = "", 
                                                                        $empty_option = false,   // no empty option (so required)
                                                                        $lang,
                                                                        null,null,["readonly"=>$request_type_readonly]
                                                                        ); ?>        
                </div>
                <!-- fg-request_type -->

                <!-- fg-request_subject -->
                <div id="fg-request_subject" class="attrib-request_subject form-group width_pct_100 ">
                        <label for="request_subject" class="hzm_label hzm_data_request_subject label_required">موضوع الطلب :  
                        </label>        				
                        <input placeholder="" type="text" tabindex="0" class="form-control valid" name="request_subject" id="request_subject" dir="rtl" value="<?php echo $request_subject ?>" size="24" maxlength="32" onchange="" required="true" aria-invalid="false" <?php echo $request_subject_readonly ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("request_subject", $data); ?>
                </div>
                <!-- fg-request_subject --> 
                <?php
                if($request_prio_phrase) 
                {
                ?>   
                <div id="fg-body" class="attrib-err form-group width_pct_100 ">
                        <?php echo $request_prio_phrase; ?>
                        <input type="hidden" name="request_priority" id="request_priority" value="<?php echo $request_priority?>">
                </div>                
                <?php
                }
                else
                {
                        $request_form_warning_complement = AfwSession::config("request_form_warning_complement","");
                ?>               
                <div id="fg-body" class="attrib-warn form-group width_pct_100 ">
                         تنبيه مهم : لخدمتكم بشكل أسرع فضلا التأكد من اكمال جميع البيانات اللازمة في نص الطلب <?php echo $request_form_warning_complement?>
                        <input type="hidden" name="request_priority" id="request_priority" value="3">
                </div>                
                <?php
                }
                
                ?>               
                <!-- fg-request_body -->
                <div id="fg-request_body" class="attrib-request_body form-group width_pct_100 ">
                        <label for="request_body" class="hzm_label hzm_data_request_body label_required">نص الطلب
                        </label>                    				
                        <textarea tabindex="0" class="form-control" name="request_body" id="request_body" dir="rtl" rows="8" cols="55" required="true" aria-invalid="false" <?php echo $request_body_readonly ?>><?php echo $request_body ?></textarea>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("request_body", $data); ?>
                </div>
                <!-- fg-request_body -->

                <!-- fg-related_object_id -->
                <?php
                        if($roList)
                        {
                ?>
                <div id="fg-related_object_id" class="attrib-related_object_id form-group width_pct_100 ">
                        <label for="related_object_id" class="hzm_label hzm_data_related_object_id"> <?php echo AfwLanguageHelper::tt("related_object_title",$lang,"crm")?> (إختياري)</label>                
                        <?php echo AfwInputHelper::picture_dropdown($roList, "related_object_id", $selected=array($related_object_id), 
                                                                        "related_object_id",
                                                                        $data_images=false, // no drop dwon pictures
                                                                        $select_width=0, // means auto
                                                                        $select_css="form-control",
                                                                        $sort_order = "", 
                                                                        $empty_option = true,  // no empty option (so required)
                                                                        $lang
                                                                        ); ?>        
                </div>
                <?php
                        }
                ?>
                <!-- fg-related_object_id -->
                
                <!-- fg-web_site -->
                <div id="fg-web_site" class="attrib-web_site form-group width_pct_100 ">
                        <label for="web_site" class="hzm_label hzm_data_web_site">رابط متعلق بالطلب (إختياري)
                        </label>                    				
                        <input placeholder="" type="text" tabindex="0" class="form-control" name="web_site" id="web_site" dir="rtl" value="<?php echo $web_site ?>" size="255" maxlength="255" aria-invalid="false" <?php echo $web_site_readonly ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("web_site", $data); ?>
                </div>
                <!-- fg-web_site --> 

                <!-- fg-old_ticket -->
                <div id="fg-old_ticket" class="attrib-old_ticket form-group width_pct_100 ">
                        <label for="old_ticket" class="hzm_label hzm_data_old_ticket"> متعلق برقم طلب سابق (إختياري)  
                        </label>        				
                        <input placeholder="" type="text" tabindex="0" class="form-control" name="old_ticket" id="old_ticket" dir="rtl" value="<?php echo $old_ticket ?>" size="255" maxlength="255" onchange="" <?php echo $old_ticket_ro ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("old_ticket", $data); ?>
                </div>
                <!-- fg-old_ticket -->

                

                
        </div>
        <input type="submit" name="save" id="save_form" class="bluebtn wizardbtn fright" value="&nbsp; <?php echo AfwLanguageHelper::tt("ارسال الطلب", $lang, "crm")?>&nbsp;"       style="margin-right: 5px;" >
</div>
</form>
</div>
<div id="container_channels_div" class="table_cell_div register_pic channels">
<?php
        $hide_desc_app = false;
        $file_dir_name = dirname(__FILE__);        
        include("$file_dir_name/../version_2_desc.php");
?>
</div>
<div id="container_left_div" class="table_cell_div register_pic">
</div> 
</div>

</div>
</div>
<?php 
        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/loader_front_tpl.php"); 
?>