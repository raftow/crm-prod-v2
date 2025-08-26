<?php
$date_start = AfwDateHelper::addDatetimeToGregDatetime('',-25);
$date_end = AfwDateHelper::addDatetimeToGregDatetime('',+15);

echo "to be calculated dates from $date_start to $date_end<br>";

// remove time
list($date_start,) = explode(" ",$date_start);
list($date_end,) = explode(" ",$date_end);

$MODE_BATCH_LOURD = true;

// genere matrixes
$hijri_to_greg_matrix = array();
$greg_to_hijri_matrix = array();

$count = 0;
$gdate = $date_start;
while($gdate <= $date_end)
{
    $hdate = AfwDateHelper::gregToHijri($gdate);
    list($hyear,) = AfwDateHelper::hdateDecompose($hdate);
    list($gyear,) = explode("-",$gdate);

    $hijri_to_greg_matrix[$hyear][$hdate] = $gdate;
    $greg_to_hijri_matrix[$gyear][$gdate] = $hdate;

    $gdate = AfwDateHelper::shiftGregDate($gdate,1);
    $count++;
}



echo "calculated : $count dates in matrix from $date_start to $date_end<br>";

// $phpdir = "C:\\gen\\dates\\";
// $dir_sep = "\\";
$phpdir = "/var/log/gen/dates/";
$dir_sep = "/";

foreach($hijri_to_greg_matrix as $hyear => $hijri_to_greg_arr)
{
    $php = "<?php return ".var_export($hijri_to_greg_arr,true).";";
    $dir_fileName = $phpdir . $dir_sep .  "hijri_${hyear}_to_greg.php"; 
    AfwFileSystem::write($dir_fileName, $php, false, true);    

    echo "generate : $dir_fileName <br>";
}

foreach($greg_to_hijri_matrix as $gyear => $greg_to_hijri_arr)
{
    $php = "<?php return ".var_export($greg_to_hijri_arr,true).";";
    $dir_fileName = $phpdir . $dir_sep .  "greg_${gyear}_to_hijri.php";
    AfwFileSystem::write($dir_fileName, $php, false, true);    

    echo "generate : $dir_fileName <br>";
}

