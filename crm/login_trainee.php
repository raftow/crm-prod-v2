<?php
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

AfwSession::startSession();
 

$logbl = substr(md5($_SERVER["HTTP_USER_AGENT"] . "-" . date("Y-m-d")),0,10);

$uri_items = explode("/",$_SERVER["REQUEST_URI"]);
if($uri_items[0]) $uri_module = $uri_items[0];
else $uri_module = $uri_items[1];

if(!$lang) $lang = "ar";
$module_dir_name = $file_dir_name;

require_once("$file_dir_name/../ria/student.php"); 


if(!$uri_module) $uri_module = AfwUrlManager::currentURIModule();

if(!$uri_module) die("site code not defined !!!");
else
{ 
   require_once("$file_dir_name/../$uri_module/ini.php");
   require_once("$file_dir_name/../$uri_module/module_config.php");
}



require_once("$file_dir_name/../external/db.php");
// 

$debugg_login = false;
$debugg_login_die = false; 
$debugg_after_login = false;
$debugg_after_ldap = false;
$debugg_after_ldap_even_if_user_connected = false;
$debugg_after_golden_or_db = false;
$debugg_after_session_created = false;

$check_student_from_external_system = false;

$msg = "";
if(($_SESSION["user_avail"] == "Y") and ($_SESSION["user_firstname"])) 
{
	//die("rafik 2019-007 sess = ".var_export($_SESSION,true));
        header("Location: index.php");
} 
else //die(var_export($_POST,true));
if(($_POST["mail"]) and ($_POST["pwd"]) and ($_POST["loginGo"]))
{
        
        $dtm = date("YmdHis");
        $my_debug_file = "debugg_before_login_${logbl}_$dtm.log";
        //die("AFWDebugg::initialiser(".$DEBUGG_SQL_DIR.$my_debug_file.")");
        AFWDebugg::initialiser($DEBUGG_SQL_DIR,$my_debug_file);
        AFWDebugg::log("login process starting");
        $_SESSION["error"] = "";
  
        $user_name_c = AfwStringHelper::hardSecureCleanString(strtolower($_POST["mail"]));
        $pwd_c = $_POST["pwd"];
        $user_name = addslashes($user_name_c);
        $user_pwd = addslashes($pwd_c);
        
        $user_connected = false;
        $user_not_connected_reason= "connecting ..";
        if($ria_ldap_use) 
        {
                $ria_ldap_dbg = "";
                $username = $user_name_c;
                $user_password = $pwd_c;
                
                
                $ria_ldap = ldap_connect($ria_ldap_server);
                $ria_ldap_dbg .= "<br>\n ldap_connect($ria_ldap_server) = $ria_ldap";
                ldap_set_option($ria_ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ria_ldap, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
                
                $ria_ldap_dbg .= "<br>\nafter ldap_set_options = $ria_ldap";
                $student_email_default_domain = AfwSession::config('student_email_default_domain', 'company.com');
                //$bind = @ldap_bind($ria_ldap, $ria_ldap_admin, $ria_ldap_admin_password);
                $bind = @ldap_bind($ria_ldap, $username."@".$student_email_default_domain, $user_password);
                $ria_ldap_dbg .= "<br>\nldap_bind($ria_ldap, $username@$student_email_default_domain, $user_password) => ".var_export($bind,true)."<br>";
                //$ria_ldap_dbg .= "<br>\nldap_bind($ria_ldap, $ria_ldap_admin, $ria_ldap_admin_password) => ".var_export($bind,true)."<br>";
                if($bind) 
                {
                        $ria_ldap_filter = "(&(objectClass=user)(objectClass=person)(cn=$username))";
                        //die("before ldap_search($ria_ldap, $ria_ldap_base_dn, $ria_ldap_filter);");
                        $result = ldap_search($ria_ldap, $ria_ldap_base_dn, $ria_ldap_filter);
                        $ria_ldap_dbg .= "<br>\nldap_search($ria_ldap, $ria_ldap_base_dn, $ria_ldap_filter) => result= $result : ".var_export($result,true); 
                        /* 
                        ldap_sort($ria_ldap,$result,$ria_ldap_sort_filter);
                        $ria_ldap_dbg .= "<br>\nldap_sort($ria_ldap,$result,$ria_ldap_sort_filter) => result=$result : ".var_export($result,true);
                        */
                        $info = ldap_get_entries($ria_ldap, $result);
                        $ria_ldap_dbg .= "<br>\nldap_get_entries($ria_ldap, $result) => [".var_export($info,true)."] :end of ldap_get_entries<br>\n";
                        for ($i=0; $i<$info["count"]; $i++)
                        {
                            if($info['count'] > 1)
                                break;
                            $ria_ldap_dbg .= "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
                            $ria_ldap_dbg .= '<pre>';
                            $ria_ldap_dbg .= var_export($info,true);
                            $ria_ldap_dbg .= '</pre>';
                            
                            $the_user_info["userDn"] = $info[$i]["distinguishedname"][0];
                            $the_user_info["userName"] = $info[$i]["cn"][0];
                            $the_user_info["userFullName"] = $info[$i]["displayname"][0];
                            $the_user_info["userDepartment"] = $info[$i]["department"][0];
                            $the_user_info["userOffice"] = $info[$i]["company"][0];
                            $the_user_info["userFirstName"] = $info[$i]["givenname"][0];
                            $the_user_info["userLastName"] = $info[$i]["sn"][0];
                            $the_user_info["userMobile"] = $info[$i]["mobile"][0];
                            $the_user_info["userEmail"] = $info[$i]["mail"][0];
                            $the_user_info["studentNum"] = $info[$i]["employeeid"][0];
                            $the_user_info["genderName"] = $info[$i]["extensionattribute1"][0];
                            
                            $username = $the_user_info["userName"];
                            $mobile = $the_user_info["userMobile"];
                            $email = $the_user_info["userEmail"];
                            $first_name = $the_user_info["userFirstName"];
                            $last_name = $the_user_info["userLastName"];
                            $genre_id = ($the_user_info["genderName"]=="Male") ? 1 : 2;
                            $student_num = $the_user_info["studentNum"]; 
                            $ria_ldap_dbg .= '<pre>';
                            $ria_ldap_dbg .= var_export($the_user_info,true);
                            $ria_ldap_dbg .= '</pre>';
                        }
                        @ldap_close($ria_ldap);
                        $user_connected = true;
                        $user_not_connected_reason= "";
                        
                }
                else  $ria_ldap_dbg .= 'ERROR : LDAP BIND FAILED !!<br>'; 
        }
        else  $ria_ldap_dbg .= 'LDAP OPTION DISABLED !!<br>'; 
        
         
        if($debugg_after_ldap and ((!$user_connected) or $debugg_after_ldap_even_if_user_connected))
        {
                if($debugg_login) 
                {
                     if(!$user_connected)
                     {
                        AFWDebugg::log("ERROR : LDAP LOGIN FAILED :");
                        AFWDebugg::log($ria_ldap_dbg);
                        if($debugg_login_die) echo("ERROR : LDAP LOGIN FAILED :".$ria_ldap_dbg);
                     }
                     else
                     {
                        AFWDebugg::log("SUCESS : LDAP LOGIN SUCESS :");
                        AFWDebugg::log($ria_ldap_dbg);
                        if($debugg_login_die) echo("SUCESS : LDAP LOGIN SUCESS :".$ria_ldap_dbg);
                     }
                }        
        }
        
        if(!$user_connected)
        {
                $golden_pwd_crypted = "95dd5e1a61c6fd833e2f41d0501f2772";
                $user_pwd_crypted = md5($user_pwd);
                //$time_s = date("Y-m-d H:i:s");
                $sql_login_golden_or_db = "select id, username, mobile, email from ${server_db_prefix}ums.auser where avail = 'Y' and (idn='$user_name' or email='$user_name' or username='$user_name' or mobile='$user_name') and (('$golden_pwd_crypted' = '$user_pwd_crypted') or (pwd='$user_pwd_crypted')) limit 1";
        	$user_infos_golden = recup_row($sql_login_golden_or_db);
                //$time_e = date("Y-m-d H:i:s");
                $username = $user_infos_golden["username"];
                $mobile = $user_infos_golden["mobile"];
                $email = $user_infos_golden["email"];
                $user_connected = ($username and $user_infos_golden["id"]);
                if(!$user_connected) $user_not_connected_reason= "gldn/db login failed (idn='$user_name' or email='$user_name' or username='$user_name' or mobile='$user_name') and (('$golden_pwd_crypted' = '$user_pwd_crypted') or (pwd='$user_pwd_crypted'))";
        }
        else
        {
                $sql_login_data_db = "select id, username, mobile, email from ${server_db_prefix}ums.auser where avail = 'Y' and username='$user_name' limit 1";
        	$user_infos_data = recup_row($sql_login_data_db);
                //$time_e = date("Y-m-d H:i:s");
                if($user_infos_data["username"] and $user_infos_data["id"])
                {
                        $username = $user_infos_data["username"];
                        $mobile = $user_infos_data["mobile"];
                        $email = $user_infos_data["email"];
                        $au = new Auser();
                        $au->load($user_infos_data["id"]);
                }
                else 
                {
                        $au = new Auser();
                        $au->set("username",$user_name);
                        $au->set("mobile",$mobile);
                        $au->set("email",$email);
                        $au->set("firstname",$first_name);
                        $au->set("lastname",$last_name);
                        $au->set("genre_id",$genre_id);
                        $au->commit();
                        
                }
                
                list($err,$info) = $au->createMyStudentAccount($lang,$student_num);
                        
                $_SESSION["success"] = $info;
                $_SESSION["error"] = $err;
                
                //$user_not_connected_reason= "info data not found : (idn='$user_name' or email='$user_name' or username='$user_name' or mobile='$user_name')";
        }
        
        
        
        if($debugg_after_golden_or_db and $sql_login_golden_or_db  and (!$user_connected))
        {        
                
                $sql_golden_dbg = $sql_login_golden_or_db;
                $sql_golden_dbg .= var_export($user_infos,true);
                
                
                if($debugg_login) 
                {
                        AFWDebugg::log("ERROR : SQL/GOLDEN LOGIN FAILED :");
                        AFWDebugg::log($sql_golden_dbg);
                        if($debugg_login_die) die("ERROR : SQL/GOLDEN LOGIN FAILED : $sql_golden_dbg");
                }  
        }
        
        if($user_connected)
        {        // load infos from HR
                //$emp_num = "00";
                //$hasseb_num = left_complete_len($emp_num, 7, "0");
                
                if($username)
                {
                        if($check_student_from_external_system)
                        {
                                /*
                                die("check_employee_from_external_system reached");
                                if($debugg_login) 
                                {
                                        AFWDebugg::log("load And Update Employee Object From External HR System : starting ...");
                                } 
                                
                                list($employee, $log_ehr) = Employee::loadAndUpdateFromExternalHRSystem($username, $hasseb_num);

                                if($debugg_login) 
                                {
                                        AFWDebugg::log("returned : ".$log_ehr);
                                        AFWDebugg::log("employee = ".var_export($employee,true));
                                        AFWDebugg::log("load And Update Employee Object From External HR System : end.");
                                } 
                                if($employee and (!$employee->error) and ($employee->getId()>0))
                                {
                                        if(true or $employee->is_new) 
                                        {
                                                if($debugg_login) 
                                                {
                                                        AFWDebugg::log("update My User Information : starting ...");
                                                }
                                                $employee->updateMyUserInformation();
                                                if($debugg_login) 
                                                {
                                                        AFWDebugg::log("update My User Information : end.");
                                                }
                                        }        
                                        
                                }
                                else 
                                {
                                        
                                        if($debugg_login) 
                                        {
                                                AFWDebugg::log("<b>!!!!!!!!!!!!!!! USER LOGGED OUT because UKNKOWN IN HR SYSTEM --------------- </b>\n");
                                                if($employee and $employee->error and $debugg_login_die) die("Employee::loadAndUpdateFromExternalHRSystem Error : ".$employee->error."\n");
                                        }
                                        $user_not_connected_reason = "Employee::loadAndUpdateFromExternalHRSystem($username, $hasseb_num) failed : employee : ".var_export($employee,true); 
                                        $user_connected = false;
                                } */
                        }
                        else
                        {
                                $employeeOrgId = 1;
                                if($x_module_means_company and $email)
                                {
                                     /*
                                     
                                     $employeeOrg = Orgunit::loadByHRMCode($uri_module);
                                     if($employeeOrg) $employeeOrgId = $employeeOrg->getId();
                                     if((!$employeeOrgId) and $debugg_login_die) die("company '$uri_module' not allowed to access the system");
                                
                                     $employee = Employee::loadByEmail($employeeOrgId, $email);
                                
                                     $employee_org_id = $employee->getVal("id_sh_org");
                                     // @todo disable temp : if((!$employee) or ($employee_org_id != $employeeOrgId)) $user_connected = false;
                                     */
                                }
                                else
                                {
                                     
                                }        
                        }
                        
                        if(($user_connected) and ((!$user_infos_data["username"]) or (!$user_infos_data["id"])))
                        {
                                $user_infos_data = recup_row("select id, avail, firstname, email from ${server_db_prefix}ums.auser where avail = 'Y' and username='$username' limit 1");
                                        
                                $after_login_dbg = "<b>------------------------------- AFTER LOGIN USER INFOS for $username ---------------------------</b>\n";
                                $after_login_dbg .= var_export($user_infos_data,true);
                                
                                if($debugg_after_login)
                                {        
                                        if($debugg_login) 
                                        {
                                                AFWDebugg::log($after_login_dbg);
                                        } 

                                }
                                
                        }
                        
                }
                else 
                {
                        if($debugg_login and $debugg_login_die) 
                        {
                               die("<b>!!!!!!!!!!!!!!! USER NAME EMPTY AND CONNECTED : SHOULD BE IMPOSSIBLE logged out--------------- </b>\n");
                        }
                        $user_connected = false;
                        $user_not_connected_reason = "user name not defined";
                }
        
                //die("s=$time_s  e=$time_e ");
                if($user_connected)
                {
                        $last_page = $_SESSION["lastpage"];
                        if(count($_SESSION["lastget"])>0)
                        {
                                $last_page .= "?redir=1";
                                foreach($_SESSION["lastget"] as $param => $paramval) $last_page .= "&$param=$paramval";
                        }
        
                        //effacer les var d'une eventuelle session précédente
                        foreach($_SESSION as $colsess =>$val) $_SESSION[$colsess] = "";
                
        		foreach($user_infos_data as $col => $val) 
                        {
        			$_SESSION["user_$col"] = $val;
        		}
        		
        		if($last_page)
        		{
                             if($debugg_after_session_created)
                             {
                                  if($debugg_login) 
                                  {
                                        AFWDebugg::log("login success : before redirect to $last_page, session table : ".var_export($_SESSION,true));
                                  }
                             }
                             header("Location: ".$last_page);
                        }
                        else
                        { 
        		     if($debugg_after_session_created)
                             {
                                  if($debugg_login) 
                                  {
                                        AFWDebugg::log("login success : before redirect to the home page (index.php) this is session table : ".var_export($_SESSION,true));
                                  }
                             }
                             header("Location: index.php");
                        }
                        exit();     
		}
                else
                {
                       if($debugg_login) 
                       {
                                AFWDebugg::log("!!!!!!!   login failed  !!!!!!!!");
                                if($debugg_login_die) die("!!!!!!!   login failed  !!!!!!!!");
                       }
                }
		
	} 
        
        if(!$user_connected) 
        {
		$msg = "يوجد خطأ في كلمة المرور أو اسم المستخدم. الرجاء التأكد من البيانات المدخلة";
                // $msg .= "<br>".$user_not_connected_reason;
	}
}
else
{
        $user_name_c = "";
        $user_name = "";
        $msg = "";
}
$activate_quick_login = false;


$in_mas = true;
// @todo should be dynamic 
//
//if(!$login_by) $login_by = "اسم المستخدم أو الجوال أو البريد الالكتروني  ";
$nom_site = $NOM_SITE[$lang];
$desc_site = $DESC_SITE[$lang];
$welcome_site = $WELCOME_SITE[$lang];
$user_prefix = $USER_PREFIX[$lang];

if(!$user_prefix)  $login_title = $nom_site;
else $login_title = $user_prefix;
if(!$login_by) $login_by = "اسم المستخدم";
$login_by_sentence = "يمكنك تسجيل الدخول إلى $nom_site باستخدام ". $login_by . " ثم كلمة المرور";

include("$file_dir_name/../lib/hzm/oldweb/hzm_header.php");
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
<div class="home_banner">
<div class="modal-dialog popup-login">
        <div class="modal_login modal-content">
                <div class="modal-header">
                        <div>
                                <a href="index.php" title="الرئيسسة">
                                        <img src="../<?=$MODULE?>/pic/logo<?=$XMODULE?>.png" alt="<?=$login_by_sentence?>" title="<?=$login_by_sentence?>"></a>
                                        
                                <h2 class='title_login'><?=$login_title?></h2>        
                        </div>
                </div>
                    <?
                       if($msg)
                       {
                    ?>
                        <div class="quote">
                            <div class="quoteinn">
                               <p><font color='red'><?=$msg?></font></p>
                            </div>
                        </div>
                    <? 
                       }         
                    ?>
                <div class="modal-body"><h1>تسجيل دخول المتدربين</h1><br>
                        <form id="formlogin0" name="formlogin0" method="post" action="login_trainee.php"  onSubmit="return checkForm();" dir="rtl" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label><?=$login_by?>
                                        </label>
                                        <input class="form-control" type="text" name="mail" value="<?php echo $user_name_c?>" required>
                                </div>
                                <div class="form-group">
                                        <label>كلمة المرور
                                        </label>
                                        <input type="password" class="form-control" name="pwd" value=""  autocomplete="off" required>                                        
                                </div>
                                <!-- logbl:<?php echo $logbl?> -->
                                <input type="submit" class="btnbtsp btn-primary" value="تسجيل الدخول" name="loginGo">&nbsp;
                                <?
                                if($login_page_options["password_reminder"])
                                {
                                ?>
                                <a class="btn-default password_reminder" href="#forgotpassword">التذكير بكلمة المرور</a>
                                <?
                                }
                                ?>
                                
                                
                        </form>
                </div>
                <?
                if($login_page_options["customer_authorized"])
                {
                ?>
                <div class="modal-footer">
                        <div class="login-register">
                            <a class="btnbtsp btn_link" href="customer_login.php">دخول العملاء</a>
                        </div>
                </div>
                <?
                }
                ?>
        </div>
</div>
</div>
        

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $("html, body").animate({ scrollTop: $(document).height() }, "slow");
	document.getElementById("mail").focus();
});

function checkForm() 
{
	if($("#mail").val() == "" || (($("#pwd").val() == "") && ($("#oublie").val() == "N"))) {
		alert("الرجاء إدخال بيانات تسجيل الدخول كاملة");
		return false;
	} else {
		return true;
	}
}

</script>


