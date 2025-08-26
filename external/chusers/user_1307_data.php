<?php

	$user_info = array (
  'user_department' => 
  array (
    'ar' => 'مكتب علاقات العملاء',
    'en' => 'مكتب علاقات العملاء',
  ),
  'user_job' => 
  array (
    'ar' => 'مساعد إداري ممارس ثاني',
    'en' => 'مساعد إداري ممارس ثاني',
  ),
  'user_full_name' => 
  array (
    'ar' => 'منال خميس الحسن الغامدي',
    'en' => 'منال خميس الحسن الغامدي',
  ),
);
	$mau_info = array (
  'ums' => 
  array (
    'id' => '18',
    'r' => true,
  ),
  'm18' => 
  array (
    'code' => 'ums',
    'roles' => 
    array (
      0 => '',
    ),
  ),
  'hrm' => 
  array (
    'id' => '1072',
    'r' => true,
  ),
  'm1072' => 
  array (
    'code' => 'hrm',
    'roles' => 
    array (
      0 => '',
    ),
  ),
  'crm' => 
  array (
    'id' => '1073',
    'r323' => true,
    'r324' => true,
    'r327' => true,
    'r376' => true,
    'r317' => true,
    'bf103679' => 
    array (
      323 => true,
      327 => true,
    ),
    'bf103684' => 
    array (
      323 => true,
      327 => true,
    ),
    'bf104366' => 
    array (
      323 => true,
      324 => true,
      327 => true,
    ),
    'bf104502' => 
    array (
      323 => true,
      324 => true,
    ),
    'bf103916' => 
    array (
      324 => true,
      327 => true,
    ),
    'bf103923' => 
    array (
      324 => true,
    ),
    'bf103929' => 
    array (
      324 => true,
    ),
    'bf103942' => 
    array (
      324 => true,
      376 => true,
    ),
    'bf104364' => 
    array (
      324 => true,
      376 => true,
    ),
    'bf104496' => 
    array (
      324 => true,
      376 => true,
    ),
    'bf103911' => 
    array (
      327 => true,
    ),
    'bf103917' => 
    array (
      327 => true,
      317 => true,
    ),
    'bf104503' => 
    array (
      327 => true,
      317 => true,
    ),
    'bf104504' => 
    array (
      327 => true,
      317 => true,
    ),
    'bf104505' => 
    array (
      327 => true,
      317 => true,
    ),
    'bf103937' => 
    array (
      376 => true,
    ),
    'bf104359' => 
    array (
      376 => true,
    ),
    'bf104491' => 
    array (
      376 => true,
    ),
    'bf103685' => 
    array (
      317 => true,
    ),
  ),
  'm1073' => 
  array (
    'code' => 'crm',
    'roles' => 
    array (
      0 => '323',
      1 => '324',
      2 => '327',
      3 => '376',
      4 => '317',
    ),
  ),
  'bpractice' => 
  array (
    'id' => '1274',
    'r340' => true,
  ),
  'm1274' => 
  array (
    'code' => 'bpractice',
    'roles' => 
    array (
      0 => '340',
    ),
  ),
);
	$menu = array (
  'ums' => 
  array (
    'all' => 
    array (
      -1 => 
      array (
        'need_admin' => false,
        'id' => 'control',
        'menu_name_ar' => 'لوحة التحكم',
        'menu_name_en' => 'control panel',
        'page' => 'main.php?Main_Page=fm.php&r=control',
        'css' => 'info',
        'icon' => NULL,
        'items' => 
        array (
          1 => 'aaa',
        ),
        'sub-folders' => 
        array (
        ),
      ),
    ),
  ),
  'hrm' => 
  array (
    'all' => 
    array (
      -1 => 
      array (
        'need_admin' => false,
        'id' => 'control',
        'menu_name_ar' => 'لوحة التحكم',
        'menu_name_en' => 'control panel',
        'page' => 'main.php?Main_Page=fm.php&r=control',
        'css' => 'info',
        'icon' => NULL,
        'items' => 
        array (
          1 => 'aaa',
        ),
        'sub-folders' => 
        array (
        ),
      ),
    ),
  ),
  'crm' => 
  array (
    'all' => 
    array (
      323 => 
      array (
        'need_admin' => false,
        'id' => '323',
        'menu_name_ar' => 'التنسيق',
        'menu_name_en' => 'arole.323',
        'page' => 'main.php?Main_Page=fm.php&a=1073&r=323',
        'css' => 'info',
        'icon' => ' icon-323',
        'showme' => true,
        'items' => 
        array (
        ),
        'sub-folders' => 
        array (
        ),
      ),
      324 => 
      array (
        'need_admin' => false,
        'id' => '324',
        'menu_name_ar' => 'الإشراف',
        'menu_name_en' => 'arole.324',
        'page' => 'main.php?Main_Page=fm.php&a=1073&r=324',
        'css' => 'info',
        'icon' => ' icon-324',
        'showme' => true,
        'items' => 
        array (
        ),
        'sub-folders' => 
        array (
        ),
      ),
      327 => 
      array (
        'need_admin' => false,
        'id' => '327',
        'menu_name_ar' => 'طلبات العملاء',
        'menu_name_en' => 'arole.327',
        'page' => 'main.php?Main_Page=fm.php&a=1073&r=327',
        'css' => 'info',
        'icon' => ' icon-327',
        'showme' => true,
        'items' => 
        array (
        ),
        'sub-folders' => 
        array (
        ),
      ),
      376 => 
      array (
        'need_admin' => false,
        'id' => '376',
        'menu_name_ar' => 'الاشراف العام',
        'menu_name_en' => 'arole.376',
        'page' => 'main.php?Main_Page=fm.php&a=1073&r=376',
        'css' => 'info',
        'icon' => ' icon-376',
        'showme' => true,
        'items' => 
        array (
        ),
        'sub-folders' => 
        array (
        ),
      ),
      317 => 
      array (
        'need_admin' => false,
        'id' => '317',
        'menu_name_ar' => 'التقارير',
        'menu_name_en' => 'arole.317',
        'page' => 'main.php?Main_Page=fm.php&a=1073&r=317',
        'css' => 'info',
        'icon' => ' icon-317',
        'showme' => true,
        'items' => 
        array (
        ),
        'sub-folders' => 
        array (
        ),
      ),
      -1 => 
      array (
        'need_admin' => false,
        'id' => 'control',
        'menu_name_ar' => 'لوحة التحكم',
        'menu_name_en' => 'control panel',
        'page' => 'main.php?Main_Page=fm.php&r=control',
        'css' => 'info',
        'icon' => NULL,
        'items' => 
        array (
          1 => 'aaa',
        ),
        'sub-folders' => 
        array (
        ),
      ),
    ),
  ),
  'bpractice' => 
  array (
    'all' => 
    array (
      340 => 
      array (
        'need_admin' => false,
        'id' => '340',
        'menu_name_ar' => 'أفضل الممارسات',
        'menu_name_en' => 'arole.340',
        'page' => 'main.php?Main_Page=fm.php&a=1274&r=340',
        'css' => 'info',
        'icon' => ' icon-340',
        'showme' => true,
        'items' => 
        array (
        ),
        'sub-folders' => 
        array (
        ),
      ),
      -1 => 
      array (
        'need_admin' => false,
        'id' => 'control',
        'menu_name_ar' => 'لوحة التحكم',
        'menu_name_en' => 'control panel',
        'page' => 'main.php?Main_Page=fm.php&r=control',
        'css' => 'info',
        'icon' => NULL,
        'items' => 
        array (
          1 => 'aaa',
        ),
        'sub-folders' => 
        array (
        ),
      ),
    ),
  ),
);
	$quick_links_arr = array (
  'ar' => 
  array (
  ),
  'en' => 
  array (
  ),
);
 ?>