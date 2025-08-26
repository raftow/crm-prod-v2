<div class="cms_bg_pic">
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div>    
<div class="content_form_bg">
<div class="content_big_title registration">تعريف موظف لدى <?php echo AfwSession::config("crm_responder", "مكتب خدمة العملاء"); ?></div>
<div id="container_div" class="table_div">
<div id="container_right_div" class="table_cell_div content_form">
<form id="crm_form" method="POST">
<input type="hidden" name="cn" id="cn" value="hrm">
<input type="hidden" name="mt" id="mt" value="submit_ldap_employee">

<div class="in-group-customer_data cssgroup_pct_100">                                          
        <?php
                echo AfwInputHelper::inputErrorsInRequest("all", $data);
        ?>
        <div class="">
                <h5 class="greentitle"><i></i>بيانات الموظف </h5>
        </div>        
                
        <div id="group_employee_data" class="" aria-expanded="true">        
                
                <!-- fg-employee_email -->
                <div id="fg-employee_email" class="attrib-employee_email form-group width_pct_100 ">
                        <label for="employee_email" class="hzm_label hzm_data_employee_email label_required">البريد الالكتروني  
                        </label>        				
                        <input placeholder="" type="text" tabindex="0" class="form-control valid" name="employee_email" id="employee_email" dir="ltr" value="<?php echo $employee_email ?>" size="24" maxlength="32" onchange="" required="true" aria-invalid="false" <?php echo $employee_email_readonly ?>>	
                        <?php echo AfwInputHelper::inputErrorsInRequest("employee_email", $data); ?>
                </div>
                <!-- fg- employee_email --> 
                

                

                
        </div>
        <input type="submit" name="save" id="save_form" class="bluebtn wizardbtn fright" value="&nbsp; <?php echo AfwLanguageHelper::tt("ارسال طلب التعريف", $lang)?>&nbsp;"       style="margin-right: 5px;" >
</div>
</form>
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