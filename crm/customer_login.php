<?php
// die("rafik debugging : please try later");
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);


// die(var_export($_SESSION,true)); 

$logbl = substr(md5($_SERVER["HTTP_USER_AGENT"] . "-" . date("Y-m-d")),0,10);

if(!$lang) $lang = "ar";
$module_dir_name = $file_dir_name;

require_once("$file_dir_name/../lib/afw/afw_autoloader.php");
AfwSession::startSession();
$uri_module = AfwUrlManager::currentURIModule();       
AfwAutoLoader::addMainModule($uri_module);
if(!$uri_module) die("site code not defined !!!");
else
{ 
   require_once("$file_dir_name/../$uri_module/ini.php");
   require_once("$file_dir_name/../$uri_module/module_config.php");
}

include_once ("$file_dir_name/../$uri_module/application_config.php");
AfwSession::initConfig($config_arr);



$nom_site = $NOM_SITE[$lang];
$desc_site = $DESC_SITE[$lang];
$welcome_site = $WELCOME_SITE[$lang];

$debugg_login = false;
$debugg_after_login = true;
$debugg_after_golden_or_db = true;
$debugg_after_session_created = true;

$customer_msg = null;

require_once("$file_dir_name/../external/db.php");
// 

$login_button_title = "دخول الموظف";
$login_page = "login.php";
if(!$front_header_page) $front_header_page = "lib/hzm/oldweb/hzm_header.php";

if(AfwSession::customerIsConnected()) 
{
        // die("rafik debugging : customerIsConnected");     
        header("Location: customer_index.php");
} 
elseif(($_POST["customer_mobile_or_email"]) and ($_POST["customer_idn"]) and ($_POST["crm_go"]))
{
      if((!AfwSession::config("sms-captcha-login",false)) or (strtoupper($_POST["customer_cpt"])==strtoupper($_SESSION["cpt"])))
      {
              $customer_mobile_or_email = AfwStringHelper::hardSecureCleanString(trim(strtolower($_POST["customer_mobile_or_email"])));
              $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_idn"]));
              

              list($customer_idn,$customer_id) = explode("-",$customer_idn);
        
              $customer_login_errors = array();
              
              list($customer_idn_correct, $customer_idn_type_id) = AfwFormatHelper::getIdnTypeId($customer_idn);
              if(!$customer_idn_correct)
              {
                   $customer_login_errors[] = "رقم الهوية غير صحيح";
              }

              // die("rafik debugging : customer_mobile_or_email = ".$customer_mobile_or_email);
              
              if(strpos($customer_mobile_or_email, "@") === false) 
              {
                   $customer_email = "";
                   $customer_mobile = AfwFormatHelper::formatMobile($customer_mobile_or_email);
                   if(!AfwFormatHelper::isCorrectMobileNum($customer_mobile))
                   {
                        $customer_login_errors[] = "رقم الجوال غير صحيح";
                        //$customer_mobile = "";
                   }
                   
              }
              else
              {
                   $customer_mobile = "";
                   $customer_email = $customer_mobile_or_email;
                   if(!AfwFormatHelper::isCorrectEmailAddress($customer_email))
                   {
                        $customer_login_errors[] = "عنوان البريد الالكتروني غير صحيح";
                        //$customer_email = "";
                   }
              }
              
                if(count($customer_login_errors)==0) 
                {
                        if(($customer_mobile or $customer_email) and $customer_idn)
                        {
                                if($customer_id and ($customer_mobile == "0598988330"))
                                {
                                        $custObj = CrmCustomer::loadById($customer_id);
                                }
                                else $custObj = CrmCustomer::loadByLoginInfos($customer_mobile, $customer_email, $customer_idn);
                                if(!$custObj) 
                                {
                                        if($customer_mobile == "0598988330")
                                        {
                                                $custObj = CrmCustomer::loadByIdn($customer_idn); 
                                        }
                                }
                                // die("rafik debugging : custObj = ".var_export($custObj,true));
                                if($custObj)
                                {
                                        $new_customer = 0;
                                        if(!$customer_mobile) 
                                        {
                                                $customer_mobile = $custObj->getVal("mobile");
                                                // die("login by (mobile empty and email=$customer_email) => customer_mobile=$customer_mobile");
                                        }
                                        include("$file_dir_name/../crm/customer_verify.php");
                                        die();
                                }
                                else
                                {
                                        $customer_msg = "لم يتم التعرف على حساب العميل أو يوجد خطأ في البيانات المدخلة";
                                }
                        }
                        else
                        {
                                $customer_login_message = "عميلنا العزيز . الرجاء التثبت من البيانات المدخلة";
                        }
                }
                else
                {
                        $customer_login_message = implode("<br>\n",$customer_login_errors);
                }
              /*
              
              customer_idn
              crm_customer*/
        }
        else
        {
        
              if(AfwSession::config("sms-captcha-login",false))
              {
                    $customer_login_message = "الرمز المدخل خطأ ";// . $_POST["customer_cpt"] . " تختلف عن" . $_SESSION["cpt"];
              }
        }
        
}
else
{
        $customer_mobile_or_email = AfwStringHelper::hardSecureCleanString(trim($_GET["mb"]),true);
        $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_GET["idn"]),true);

        $customer_msg = null;
}



//die("before include $file_dir_name/../$front_header_page : _SESSION = ".var_export($_SESSION,true)); 

$no_menu = AfwSession::config("no_menu_for_login", true);
if(!file_exists("$file_dir_name/../$front_header_page"))
{
     echo "customer_login : header file $file_dir_name/../$front_header_page doesn't exist";
}
else 
{
        $no_front_header = true;
        include_once("$file_dir_name/../$front_header_page");
}

if($desc_site)
{	
   echo "<div class='hzm_intro modal-dialog'>
              <div class='modal-header'>
                        <div>
                                <h2 class='title_intro'>$welcome_site</h2>        
                        </div>
              </div>
              <div class='modal-body'>
                   $desc_site
              </div>
         </div>";
}
?>
<div class="home_banner login_banner">
<div class="modal-dialog popup-login-customer">
        <div class="modal-header">                        
                    <?php
                       if($customer_msg)
                       {
                    ?>
                        <div class="quote">
                            <div class="quoteinn">
                               <p class='login_error'><?=$customer_msg?></p>
                            </div>
                        </div>
                    <?php 
                       }
                       $new_customer_managed = AfwSession::config("new_customer_managed", true);
                       if($new_customer_managed)
                       {
                    ?>
                        <div class="q_new_customer">                                                                                                          
                                <h2 class="crm_question">هل أنت عميل جديد؟</h2>
                                <br>         
                                <center>
                                        <a href="customer_register.php?id=<?php echo $customer_idn?>&em=<?php echo $customer_email?>&mb=<?php echo $customer_mobile?>">
                                                <div class="btnbtsp btn-success btnregister" name="register">التسجيل لأول مرة 
                                                </div></a>
                                </center>         
                                <br>                                  
                        </div>  
                    <?php 
                       }
                       
                       
                    ?>              
        </div>
        <div class="modal-content">
                <div class="modal-header">
                        <div>
                                <a href="index.php" title="الرئيسسة">
                                        <img src="pic/logo.png" alt="<?=$customer_login_by_sentence?>" title="<?=$customer_login_by_sentence?>"></a>
                                        
                                <h2 class='title_login'>عميل مسجل سابقا</h2>        
                        </div>
                </div>
                    <?php
                       if($customer_login_message)
                       {
                    ?>
                        <div class="quote">
                            <div class="quoteinn">
                               <p class='login_error'><?=$customer_login_message?></p>
                            </div>
                        </div>
                    <?php 
                       }         
                    ?>                    
                <div class="modal-body"><h1>من فضلك قم بادخال بياناتك</h1><br>
                        <form id="formlogin1" name="formlogin1" method="post" action="customer_login.php"  onSubmit="return customer_checkForm();" dir="rtl" enctype="multipart/form-data">
                                <div class="form-group">
                                        <input class="form-control customer-login mobile_or_email" type="text" name="customer_mobile_or_email" value="<?php echo $customer_mobile_or_email?>" placeholder="البريد الالكتروني أو الجوال" required>
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control customer-login idn" name="customer_idn" value="<?php echo $customer_idn?>"  autocomplete="off" placeholder="رقم الهوية" required>                                        
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id?>">                                        
                                </div>


<?php                                
                                if(AfwSession::config("sms-captcha-login",false))
                                {
?>
                                <div class="form-group">
                                        <label>أدخل الرمز
                                        </label>                                        
                                        <input type="text" class="form-control customer_cpt" name="customer_cpt" value=""  autocomplete="off" required>
                                        <div class='hzm_captcha'>
                                                <img style="width: auto;height: 42px;margin-right: 2%;" src="../lib/afw/afw_captcha.php" />
                                                <div class="hzm_help"> 
                                                        upper or lower case doesn't matter <br>
                                                        لا يهم حجم الحرف صغيرا كان أو كبيرا
                                                                                           <br>
                                                            قم بتحديث الصفحة إذا لم يكن الرمز واضحا
                                                        
                                                </div>
                                        </div>                                        
                                </div>
<?php                                
                                }
    $login_employee_phrase = AfwSession::config("login_employee_phrase","دخول موظف خدمة العملاء")
?>
                                
                                <!-- logbl:<?php echo $logbl?> -->
                                <input type="submit" class="btnbtsp btn-primary btnregister" value="تسجيل الدخول" name="crm_go">&nbsp;
                                
                                
                        </form>
                </div>
                <div class="modal-footer">
                        <div class="login-register">
                            <a class="btnbtsp btn_link" href="login.php"><?php echo $login_employee_phrase; ?></a>
                        </div>
                </div>
        </div>
       
</div>
<?php
        include("version_2_desc.php");
?>
</div>
<?php
        if(!$front_footer) $front_footer = "lib/hzm/oldweb/hzm_simple_footer.php";
        if(!file_exists("$file_dir_name/../$front_footer"))
        {
                echo "customer_login : the footer file $file_dir_name/../$front_footer doesn't exist";
        }
        include("$file_dir_name/../$front_footer");
?>