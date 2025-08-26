<?php
$server_db_prefix = AfwSession::config("db_prefix", "default_db_");

AfwDatabase::db_query("CREATE database $server_db_prefix"."workflow");

AfwDatabase::db_query("DROP TABLE IF EXISTS $server_db_prefix"."workflow.idn_to_id");

AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS $server_db_prefix"."workflow.`idn_to_id` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `created_at`   datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `active` char(1) NOT NULL,
  `draft` char(1) NOT NULL default 'Y',
  `version` int(4) DEFAULT NULL,
  `update_groups_mfk` varchar(255) DEFAULT NULL,
  `delete_groups_mfk` varchar(255) DEFAULT NULL,
  `display_groups_mfk` varchar(255) DEFAULT NULL,
  `sci_id` int(11) DEFAULT NULL,
  
    
   module_code varchar(16)  DEFAULT NULL , 
   country_id int(11) NOT NULL , 
   idn_type_id int(11) DEFAULT NULL , 
   idn varchar(32)  DEFAULT NULL , 

  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");



// -- unique index : 
AfwDatabase::db_query("CREATE unique index uk_idn_to_id on $server_db_prefix"."workflow.idn_to_id(module_code,country_id,idn_type_id,idn);");

AfwDatabase::db_query("INSERT INTO $server_db_prefix"."workflow.`idn_to_id` (`id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `validated_by`, `validated_at`, `active`, `draft`, `version`, `update_groups_mfk`, `delete_groups_mfk`, `display_groups_mfk`, `sci_id`, `module_code`, `country_id`, `idn_type_id`, `idn`) VALUES ('3000000001', '1', '2024-11-23 19:59:23.000000', '1', '2024-11-23 19:59:23.000000', NULL, NULL, 'Y', 'Y', '0', NULL, NULL, NULL, NULL, NULL, '213', '4', 'I271498');");