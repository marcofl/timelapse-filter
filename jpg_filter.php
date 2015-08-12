#!/usr/bin/php
<?php

$basedir=$argv[1];
$start_date=$argv[2];
$end_date=$argv[3];

$sunmoon_file='sunmoon.csv';

// functions
function read_sun_rise_set($file,$date) {
    $csv['Datum']=0;
    $csv['SAofficial']=6;
    $csv['SUofficial']=7;

    $f = fopen($file, "r");
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

$dirs = scandir($basedir);
foreach ($dirs as $dir) {
  // check for valid dirname
  if (preg_match('/^Img_/',$dir)) {
    
    $files = scandir($basedir."/".$dir);
        
    foreach ($files as $file) {
    
      // check for valid filename
      if (preg_match('/^Snap_[0-9]*-[0-0]*.+\.jpg/',$file)) {
      
        // extract date part from filename
        $file_date=explode("_",$file);
        
        $date=strtotime(explode("-",$file_date[1])[0]);
        $time=strtotime(explode("-",$file_date[1])[1]);
        
        if ($date >= strtotime($start_date) && $date <= strtotime($end_date)) {
            
            // get daylight hours
            if ($date != $last_date) {
              $daylight=read_sun_rise_set($sunmoon_file,date('j.n.Y', $date));
            }
            $last_date = $date;
            
            if ($time >= strtotime($daylight['rise']) && $time <= strtotime($daylight['set'])) {
              //echo $basedir."/".$dir."/".$file."\n";
              readfile($basedir."/".$dir."/".$file);
            }
        }
      }
    }
  }
}

?>
