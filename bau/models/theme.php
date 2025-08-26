<?php
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Theme extends AFWObject{

	public static $DATABASE		= ""; 
	public static $MODULE		    = "bau"; 
	public static $TABLE			= "theme"; 
	public static $DB_STRUCTURE = null; 
	
	public function __construct($tablename="theme"){
		parent::__construct($tablename,"id","bau");
	}
}
?>