<div class="cms_bg_pic">
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div>    
<div class="content_form_bg">
<div class="content_big_title registration">استكمال البيانات أو المرفقات</div>
<div id="container_div" class="table_div">
<div id="container_right_div" class="table_cell_div content_form">

<?php
        $customer_mobile_readonly = "readonly";
        $customer_idn_readonly = "readonly";
        $customer_fullname_readonly = "readonly";

?>

<div class="in-group-customer_data cssgroup_pct_100">                                          
        <div class="">
                <h5 class="greentitle"><i></i>بيانات صاحب الطلب</h5>
        </div>        
        <div id="group_customer_data" class="crm_front_form" aria-expanded="true">
                <!-- fg-your_full_name -->
                <div id="fg-your_full_name" class="attrib-your_full_name form-group width_pct_50 ">
                        <label for="your_full_name" class="hzm_label hzm_data_your_full_name ">الاسم الكامل  
                        </label>        				
                        <p><?php echo $your_full_name ?></p>	
                </div>
                <!-- fg-your_full_name -->

                <!-- fg-customer_type -->
                <div id="fg-customer_type" class="attrib-customer_type form-group width_pct_50 ">
                        <label for="customer_type" class="hzm_label hzm_data_customer_type ">نوع العميل  
                        </label>        				
                        <p><?php echo $customer_type ?></p>	
                </div>
                <!-- fg-customer_type -->

                <!-- fg-customer_mobile -->
                <div id="fg-customer_mobile" class="attrib-customer_mobile form-group width_pct_50 ">
                        <label for="customer_mobile" class="hzm_label hzm_data_customer_mobile ">رقم الجوال 
                        </label>                    				
                        <p><?php echo $customer_mobile ?></p>	
                </div>
                <!-- fg-customer_mobile -->

                <!-- fg-customer_idn -->
                <div id="fg-customer_idn" class="attrib-customer_idn form-group width_pct_50 ">
                        <label for="customer_idn" class="hzm_label hzm_data_customer_idn ">رقم الهوية 
                        </label>                    				
                        <p><?php echo $customer_idn ?></p>
                </div>
                <!-- fg-customer_idn -->
        </div> 
             
        <div class="">
                <h5 class="greentitle"><i></i>بيانات الطلب </h5>
        </div>        
        <div id="group_company_data" class="crm_front_form" aria-expanded="true">        
                
                <!-- fg-request_type -->
                <div id="fg-request_type" class="attrib-request_type form-group width_pct_50 ">
                        <label for="request_type" class="hzm_label hzm_data_request_type ">نوع الطلب</label>                  
                        <p><?php echo $request_type_display ?></p>
                </div>
                <!-- fg-request_type -->

                <!-- fg-request_code -->
                <div id="fg-request_code" class="attrib-request_code form-group width_pct_50 ">
                        <label for="request_code" class="hzm_label hzm_data_request_code ">رمز الطلب</label>                  
                        <p><?php echo $request_code ?></p>
                </div>
                <!-- fg-request_code -->

                <!-- fg-request_subject -->
                <div id="fg-request_subject" class="attrib-request_subject form-group width_pct_100 ">
                        <label for="request_subject" class="hzm_label hzm_data_request_subject ">موضوع الطلب :  
                        </label>
                        <p><?php echo $request_subject ?></p>        				                        
                </div>
                <!-- fg-request_subject --> 

                <!-- fg-request_body -->
                <div id="fg-request_body" class="attrib-request_body form-group width_pct_100 ">
                        <label for="request_body" class="hzm_label hzm_data_request_body ">نص الطلب
                        </label> 
                        <div id="fg-body" class="attrib-warn form-group width_pct_100 "><?php echo $request_body ?>
                        </div>       				                                           				                        
                </div>
                <!-- fg-request_body -->

                
                <!-- fg-web_site -->
                <div id="fg-web_site" class="attrib-web_site form-group width_pct_100 ">
                        <label for="web_site" class="hzm_label hzm_data_web_site">رابط متعلق بالطلب (إختياري)
                        </label>                    				
                        <p><a href='<?php echo $web_site ?>'><?php echo $web_site ?></a></p>                          
                </div>
                <!-- fg-web_site --> 

                <!-- fg-old_ticket -->
                <div id="fg-old_ticket" class="attrib-old_ticket form-group width_pct_100 ">
                        <label for="old_ticket" class="hzm_label hzm_data_old_ticket"> متعلق برقم طلب سابق (إختياري)  
                        </label> 
                        <p><?php echo $old_ticket ?></p>         				
                </div>
                <!-- fg-old_ticket -->

                

                
        </div>
        
</div>

</div>
        <form id="crm_form" method="POST"  enctype="multipart/form-data" action="i.php">
                <input type="hidden" name="request_id" id="request_id" value="<?php echo $id ?>">
                <input type="hidden" name="cn" id="cn" value="crm">
                <input type="hidden" name="mt" id="mt" value="submit_comment">

                <div id="infos_left_div" class="table_cell_div content_form info_form">
                        <div id="fg-warn" class="attrib-warn form-group width_pct_100 ">
                        
                                <div id="fg-reqstatus" class="attrib-warn form-group width_pct_100 ">
                                حالة الطلب : <? echo $request_status;?>
                                </div>



                                <div class='request_response'>
                                        <label class="hzm_label <?php echo "for_file comment" ?>">اكتب تعليقك هنا - ان وجد</label>
                                        <p class="for_file"><textarea name="comment" id="comment" class="form-control" cols="20" rows="5" required></textarea></p>
                                        <input type="submit" name="save" id="save_form" class="bluebtn wizardbtn fright" value="&nbsp; <?php echo AfwLanguageHelper::tt("ارسال", $lang)?>&nbsp;"       style="margin-right: 5px;" >

                                        <div class="row crm_data title_crm">
                                                <label>الردود والتعليقات السابقة</label>                                                
                                        </div>
                                        <?php 
                                                $responseList = $obj->get("doneResponseList");
                                                $odd = "";
                                                if(count($responseList)>0)
                                                {
                                                        foreach($responseList as  $responseItem)
                                                        {
                                                                $full_response_date = ($ds == "hijri") ? $responseItem->fullHijriDate("response_date") : AfwDateHelper::fullGregDate(AfwDateHelper::hijriToGreg($responseItem->getVal("response_date")));
                                        ?>
                                                <div class="row <?php echo $odd?>crm_data crm_response">
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
                                                                if(!$odd) $odd = "odd ";
                                                                else $odd = "";
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
                                        ?>        
                                </div>
                                
                        </div>
                        
                </div> 
        </form>
</div> 
</div>

</div>
</div>
<?php 
        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/loader_front_tpl.php"); 
?>