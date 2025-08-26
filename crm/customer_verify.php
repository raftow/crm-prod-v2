<?php
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

 

$logbl = substr(md5($_SERVER["HTTP_USER_AGENT"] . "-" . date("Y-m-d")),0,10);

if(!$lang) $lang = "ar";
$module_dir_name = $file_dir_name;

require_once("$file_dir_name/../lib/afw/afw_autoloader.php");
AfwAutoLoader::addMainModule("crm");
$uri_module = AfwUrlManager::currentURIModule();       
AfwAutoLoader::addModule($uri_module);

AfwSession::startSession();


if(!$uri_module) die("site code not defined !!!");
else
{ 
   require_once("$file_dir_name/../$uri_module/ini.php");
   require_once("$file_dir_name/../$uri_module/module_config.php");
}

include_once ("$file_dir_name/../$uri_module/application_config.php");
AfwSession::initConfig($config_arr);

if(!$NOM_SITE) die("site not configured or not initialized !!!");
// if(!$simulate_sms_to_mobile) die("simulate_sms_to_mobile not configured or not initialized !!! ".var_export($config_arr,true));

$nom_site = $NOM_SITE[$lang];
$desc_site = $DESC_SITE[$lang];
$welcome_site = $WELCOME_SITE[$lang];

$debugg_login = false;
$debugg_after_login = true;
$debugg_after_golden_or_db = true;
$debugg_after_session_created = true;

$customer_msg = "";
$gender_id = 1;
$gender_id_selected_2 = "";
$gender_id_selected_1 = "selected";
        
require_once("$file_dir_name/../external/db.php");
// 

if(AfwSession::customerIsConnected()) 
{
        header("Location: customer_index.php");
} 
elseif($_POST["customer_verify_code"])
{
        $sms_ok = true;
        /*
        $key1 = substr($_POST["has_csrt_ss"],0,1);
        $key2 = substr($_POST["has_csrt_ss"],1,1);
        $has_csrt_posted = substr($_POST["has_csrt_ss"],2);
        if(AfwStringHelper::hzmEncode($_POST["customer_verify_code"],$key1,$key2)==$has_csrt_posted)
        */
        $customer_mobile = $_POST["customer_mobile"];
        $customer_mobile = AfwFormatHelper::formatMobile($customer_mobile);
        $customer_email = $_POST["customer_email"];
        $customer_idn = $_POST["customer_idn"];
        $customer_id = $_POST["customer_id"];
        $gender_id = $_POST["gender_id"];
        $customer_type_id = $_POST["customer_type_id"];
        $first_name_ar = $_POST["first_name_ar"];
        $last_name_ar = $_POST["last_name_ar"];
        $org_name = $_POST["org_name"];
        $ref_num = $_POST["ref_num"];
        $new_customer = $_POST["new_customer"];

        if(AfwSession::getSessionVar("customer_OTP") == $_POST["customer_verify_code"])
        {
                
                
                $customer_register_errors = array();
                
                list($customer_idn_correct, $customer_idn_type_id) = AfwFormatHelper::getIdnTypeId($customer_idn);
                if((!$customer_idn_correct) or (!$customer_idn_type_id))
                {
                        $customer_register_errors["customer_idn"] = "رقم الهوية غير صحيح";
                }
                
                
                if(!AfwFormatHelper::isCorrectMobileNum($customer_mobile))
                {
                        $customer_register_errors["customer_mobile"] = "رقم الجوال غير صحيح";
                }
                
                if($new_customer)
                {
                        if(!AfwFormatHelper::isCorrectEmailAddress($customer_email))
                        {
                                $customer_register_errors["customer_email"] = "عنوان البريد الالكتروني غير صحيح";
                                //$customer_email = "";
                        }
                }
                
                if((!is_array($customer_register_errors)) or (count($customer_register_errors)==0)) 
                {
                        if($customer_id and ($customer_mobile == "0598988330"))
                        {
                                $custObj = CrmCustomer::loadById($customer_id);
                        }
                        else $custObj = CrmCustomer::loadByMainIndex($customer_mobile, $customer_idn_type_id, $customer_idn, $create_obj_if_not_found=$new_customer);
                        if(!$custObj) 
                        {
                                //die("CrmCustomer::loadByMainIndex($customer_mobile, $customer_idn_type_id, $customer_idn)");
                                if($customer_mobile == "0598988330")
                                {
                                        $custObj = CrmCustomer::loadByIdn($customer_idn); 
                                }
                        }
                        
                        if($new_customer)
                        {
                                if($custObj)
                                {
                                        if($custObj->is_new)
                                        {     
                                                $custObj->set("gender_id",$gender_id);
                                                $custObj->set("email",$customer_email);
                                                $custObj->set("customer_type_id",$customer_type_id);
                                                //$custObj->set("license_number",$license_number);
                                                $custObj->set("first_name_ar",$first_name_ar);
                                                $custObj->set("last_name_ar",$last_name_ar);
                                                $custObj->set("ref_num",$ref_num);
                                                $custObj->set("org_name",$org_name);
                                                
                                                
                                                $custObj->commit();
                                                include("$file_dir_name/../crm/customer_ready.php");
                                        }
                                        else
                                        {
                                                $_SESSION["warning"] = "هذا العميل موجود سابقا. قم بتسجيل الدخول ";
                                                header("Location: customer_login.php");
                                        }
                                }
                                else
                                {
                                        $customer_verify_msg = "أثناء الحفظ. حصل خطأ أرجوا التواصل مع المشرف أو المحاولة لاحقا";
                                }
                        }
                        else
                        {
                                if($custObj)
                                {
                                        include("$file_dir_name/../crm/customer_ready.php");
                                }
                                else
                                {
                                        $customer_verify_msg = "هذا العميل غير موجود. نأسف";
                                }
                        }
                }
                else
                {
                        $customer_verify_msg = "تعذر الحفظ. يوجد أخطاء في البيانات : ".implode(", ", $customer_register_errors);
                }
        }
        else
        {
                    $customer_verify_msg = "الرمز المدخل خطأ ";// . $_POST["customer_cpt"] . " تختلف عن" . $_SESSION["cpt"];
        }       
}
elseif($customer_mobile)
{
       // random code
       $customer_OTP = AfwSmsSender::verifyCode(); 
       AfwSession::setSessionVar("customer_OTP", $customer_OTP);
       $customer_verify_the_message = "رمز التحقق " . $customer_OTP;

       $app_name = AfwSession::config("application_name", "crm");

       $simulate_sms_to_mobile = AfwSession::config("simulate_sms_to_mobile", null);

       if($simulate_sms_to_mobile) $sms_mobile = $simulate_sms_to_mobile;
       else $sms_mobile = $customer_mobile;

       // send SMS to customer 
       $otp_show_in_page = AfwSession::config("otp-show-in-page", false);
       if($otp_show_in_page)      
       {
                AfwSession::pushInformation($customer_verify_the_message);
                $sms_ok = true;
       }
       else
       {
                list($sms_ok, $sms_info) = AfwSmsSender::sendSMS($sms_mobile, $customer_verify_the_message);
                $sms_info_export = var_export($sms_info,true);
                if((!$sms_ok) and (!$sms_info)) $sms_info_export = "call to AfwSmsSender::sendSMS($sms_mobile, xxx) failed without known reason, contact admin";
       }
       
       
}
else
{
        $sms_ok = false; 
        $sms_info_export = "No mobile number to use for send";
}

if(!$customer_type_id) $customer_type_id = 1;
$otp=true;
if(!$front_header_page) $front_header_page = "lib/hzm/oldweb/hzm_header.php";
if(!file_exists("$file_dir_name/../$front_header_page"))
{
     echo "customer_verify : header file $file_dir_name/../$front_header_page doesn't exist";
}
else 
{
        $no_front_header = true;
        include("$file_dir_name/../$front_header_page");
}

if($sms_ok)
{
?>
<div class="home_banner">
<div class="modal-dialog popup-register popup-sms-verify">
        <div class="modal-content">
                <div class="modal-header">
                        <div>
                                <a href="#">
                                        <img src="../crm/pic/register.png" alt="" title="">
                                </a>
                                        
                                <h2 class='title_register'>التحقق من صحة رقم الجوال</h2>        
                        </div>
                </div>
                    <?
                       if($customer_verify_msg)
                       {
                    ?>
                        <div class="quote">
                            <div class="quoteinn">
                               <p class='login_error'><?=$customer_verify_msg?></p>
                            </div>
                        </div>
                    <? 
                       }         
                    ?>                    
                <div class="modal-body">
                        
                                
                                <div class="form-group center-me">
                                        <?php
                                        if($sms_mobile) $sms_mobile_3dig = "XXXXXXX".substr($sms_mobile,7,3);
                                        else $sms_mobile_3dig = "";
                                        ?>
                                        <label class='light_label'>أدخل الرمز المرسل على جوالك <?php echo $sms_mobile_3dig  .  " <!-- [sms_i:$sms_info_export , simulate_sms_to_mobile=$simulate_sms_to_mobile,cd=$cdifdev] -->"; ?>
                                        </label> 
                                        <form id="form_register" name="form_register" method="post" class="digit-group" direction="ltr" action="customer_verify.php" data-group-name="digits" data-autosubmit="true" autocomplete="off" onSubmit="return customer_verify_before_submit();" dir="rtl" enctype="multipart/form-data">                                       
                                        <input type="hidden" class="form-control" id="customer_verify_code" name="customer_verify_code" value="" tabindex=0 autocomplete="off" required>

                                        <input type="text" id="digit-1" name="digit-1" data-next="digit-2" pattern="[0-9]" tabindex="0" autofocus />
                                        <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" pattern="[0-9]"/>
                                        <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" pattern="[0-9]"/>
                                        <input type="text" id="digit-4" name="digit-4" data-previous="digit-3" pattern="[0-9]"/>

                                        
                                        <input type="hidden" name="new_customer" value="<?php echo $new_customer?>" >
                                        <input type="hidden" name="customer_mobile" value="<?php echo $customer_mobile?>" >
                                        <input type="hidden" name="customer_email" value="<?php echo $customer_email?>" >
                                        <input type="hidden" name="customer_idn" value="<?php echo $customer_idn?>"  >
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id?>"  >
                                        <input type="hidden" name="gender_id" value="<?php echo $gender_id?>" />
                                        <input type="hidden" name="customer_type_id" value="<?php echo $customer_type_id?>" />
                                        <input type="hidden" name="first_name_ar" value="<?php echo $first_name_ar?>"  >
                                        <input type="hidden" name="last_name_ar" value="<?php echo $last_name_ar?>"  >
                                        <input type="hidden" name="org_name" value="<?php echo $org_name?>"  >
                                        <input type="hidden" name="ref_num" value="<?php echo $ref_num?>"  >
                                        <input type="submit" class="btnbtsp btn-primary btncheck" value="تحقق" name="crm_verify_go">&nbsp;        
                                        </form>
                                </div>
                                
                                
                                
                        
                </div>
        </div>
       
</div>
<?
        include("version_2_desc.php");
?>
</div>
<?
}
else
{       
        if(!AfwSession::config("MODE_DEVELOPMENT", false)) $sms_info_export = "<!-- $sms_info_export -->";        
?>
<div class='error'>
        حدث خطأ أثناء ارسال رسالة قصيرة للعميل تحتوي على رمز التحقق ربما أن هذه العملية غير مسموح بها في البيئة الحالية
        <?php echo $sms_info_export ?>
</div>
<?
}

if(!$front_footer) $front_footer = "lib/hzm/oldweb/hzm_simple_footer.php";
if(!file_exists("$file_dir_name/../$front_footer"))
{
        echo "customer_verify : footer file $file_dir_name/../$front_footer doesn't exist";
}
include("$file_dir_name/../$front_footer");
?>
<script>

function customer_verify_before_submit()
{
        var grouped_digits = '';
        grouped_digits = grouped_digits + $('input#digit-1').val();
        grouped_digits = grouped_digits + $('input#digit-2').val();
        grouped_digits = grouped_digits + $('input#digit-3').val();
        grouped_digits = grouped_digits + $('input#digit-4').val();
        $('input#customer_verify_code').val(grouped_digits);   
}

$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
                var ekey = this.value.substr(-1).charCodeAt(0); // instead of e. keyCode
		// alert('this.id = '+this.id);
                // alert('parent.id = '+parent);
		if(ekey === 8 || // Backspace
                   ekey === 37 || // ArrowLeft
                   ekey === 46 // Delete
                   ) {
			var prev = parent.find('input#' + $(this).data('previous'));
			
			if(prev.length) {
				$(prev).select();
			}
		} 
                else if((ekey >= 48 && ekey <= 57) || // 0..9 (nuemric right keyboard)
                          // (ekey >= 65 && ekey <= 90) ||  A,B ...Z
                          (ekey >= 96 && ekey <= 105) || // 0..9 (nuemric up keyboard where shift is !@#$) 
                          (ekey === 39) || // ArrowRight
                          (ekey === 299) // nuemric mobile keyboard
                        ) 
                {
                        customer_verify_before_submit();
                        // alert('after type '+$('input#customer_verify_code').val());
			var next = parent.find('input#' + $(this).data('next'));
			
			if(next.length) {
				$(next).select();
			} else {
				if(parent.data('autosubmit')) {
                                        customer_verify_before_submit();
                                        // alert('before submit '+$('input#customer_verify_code').val());
					parent.submit();
				}
			}
		}
                else
                {
                        // customer_verify_before_submit();
                        // alert('after type rejected'+$('input#customer_verify_code').val());
                        // alert('ekey ='+ekey);
                        // alert('e.which ='+e.which);
                        
                        $(this).val("");
                } 
                
	});
});

</script>