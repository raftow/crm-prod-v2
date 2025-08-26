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
                <input type="hidden" name="mt" id="mt" value="submit_complete">
                <input type="hidden" name="files_count" id="files_count" value="<?php echo count($files_list) ?>">

                <div id="infos_left_div" class="table_cell_div content_form info_form">
                        <div id="fg-warn" class="attrib-warn form-group width_pct_100 ">
                        
                                <div id="fg-reqstatus" class="attrib-warn form-group width_pct_100 ">
                                حالة الطلب : <? echo $request_status;?>
                                </div>
                                <pre class='request_instructions'><? echo $request_instructions;?></pre>
                                <?php
                                        // echo var_export($files_list, true);
                                        foreach($files_list as $file_order => $file_title)
                                        {
                                                $file_input_name = "file_".$file_order;
                                ?>
                                <label class="hzm_label <?php echo "for_file $file_input_name" ?>"><?php echo $file_title ?></label>
                                <p class="for_file"><input name="<?php echo $file_input_name ?>" id="<?php echo $file_input_name ?>" type="file" class="nicefileinput nice" required/></p>
                                <input type='hidden' name='title_of_<?php echo $file_input_name ?>' id='title_of_<?php echo $file_input_name ?>' value='<?php echo $file_title; ?>'>
                                <?php
                                        }
                                ?>
                                <label class="hzm_label <?php echo "for_file comment s$request_status_id" ?>">بيانات أخرى أو ملاحظات</label>
                                <p class="for_file"><textarea name="comment" id="comment" class="form-control" cols="20" rows="5" required></textarea></p>
                                <input type="submit" name="save" id="save_form" class="bluebtn wizardbtn fright" value="&nbsp; <?php echo AfwLanguageHelper::tt("ارسال", $lang)?>&nbsp;"       style="margin-right: 5px;" >
                                <script type="text/javascript">
                                $(document).ready(function(){
                                <?php
                                        // echo var_export($files_list, true);
                                        foreach($files_list as $file_order => $file_title)
                                        {
                                                $file_input_name = "file_".$file_order;
                                ?>                                        
                                        $("#<?php echo $file_input_name ?>").nicefileinput({ label : 'إختيار الملف' });
                                <?php
                                        }
                                ?>
                                });
                                </script>

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