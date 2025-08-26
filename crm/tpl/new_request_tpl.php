<div class="cms_bg_pic contact">
<div class="cms_bg crm_new_request">
<div class="">
        <div class='content_title contact'>طلب جديد</div>         
        <div class='content_body contact'>
<?php
        if(in_array(3, AfwSession::config("crm_rt_list",array())))
        {
?>                   
                        <a class='crm complaint' href='/crm/i.php?cn=crm&mt=request&rt=3'>تقديم شكوى</a>
<?php
        }
        
        if(in_array(2, AfwSession::config("crm_rt_list",array())))
        {
?>                        
                        <a class='crm question' href='/crm/i.php?cn=crm&mt=request&rt=2'>تقديم إستفسار</a>
<?php
        }
        
        if(in_array(13, AfwSession::config("crm_rt_list",array())))
        {
?>                        
                        <a class='crm suggestion' href='/crm/i.php?cn=crm&mt=request&rt=13'>تقديم إقتراح</a>
<?php
        }
        
        if(in_array(12, AfwSession::config("crm_rt_list",array())))
        {
?>                        
                        <a class='crm support' href='/crm/i.php?cn=crm&mt=request&rt=12'> طلب دعم فني</a>
<?php
        }
        
        if(in_array(1, AfwSession::config("crm_rt_list",array())))
        {
?>                        
                        <a class='crm request' href='/crm/i.php?cn=crm&mt=request&rt=1'>تقديم طلب إداري</a>
<?php
        }
?>                        

        </div>
</div>
</div>
</div>
<div class="cms_center">
<?php
        $file_dir_name = dirname(__FILE__);
        
        include("$file_dir_name/../version_2_desc.php");
?>
</div>