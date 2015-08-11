<?php

// config
$basedir="/pool/images/camsev1";
$monthdir="Img_2015-08";
$sunmoon_file="sunmoon.csv";

// functions
function read_sun_rise_set($file,$date) {
    $csv['Datum']=0;
    $csv['SAofficial']=6;
    $csv['SUofficial']=7;

    $f = fopen("sunmoon.csv", "r");
    $result = false;
    while ($row = fgetcsv($f,0,";")) {
        if ($row[0] == $date) {
            $values['date']=$row[$csv['Datum']];
            $values['rise']=$row[$csv['SAofficial']];
            $values['set']=$row[$csv['SUofficial']];
            return $values;
            break;
        }
    }
    fclose($f);
}

$files = scandir($basedir."/".$monthdir);

//print_r($files);

foreach ($files as $file) {
  //echo $file;
  // extract date part from filename
  $file_date=explode("_",$file);
  $date=date('j.n.Y', strtotime(explode("-",$file_date[1])[0]));
  $time=date('H:i', strtotime(explode("-",$file_date[1])[1]));
  
  // get daylight hours
  if ($date != $last_date) {
    $daylight=read_sun_rise_set($sunmoon_file,$date);
  }
  $last_date = $date;
    
  //echo " Date: ".$date;    
  //echo " Sunrise: ".$daylight['rise']." Sunset: ".$daylight['set'];
  
  if (strtotime($time) >= strtotime($daylight['rise']) && strtotime($time) <= strtotime($daylight['set'])) {
    //echo " OK";
    echo $basedir."/".$monthdir."/".$file."\n";
    
  }
  //echo "\n";
}


?>