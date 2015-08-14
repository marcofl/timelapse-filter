#!/usr/bin/php
<?php

$basedir=$argv[1];

if(!isset($argv[2])) {
    echo "Usage: ".$argv[0]." <path> <week_number|start_date> [end_date] | ffmpeg...\n";
    exit(1);
}

// week number or start end date
if(intval($argv[2]) <= 53) {
    $week=intval($argv[2]);
} else {
    $start_date=$argv[2];
    $end_date=$argv[3];
}
$sunmoon_file='sunmoon.csv';

// functions
function read_cal($file,$date) {
    $f = fopen($file, "r");
    $result = false;
    while ($row = fgetcsv($f,0,";")) {
        if ($row[0] == $date) {
            $values['sunrise']=$row[6]; // SAofficial
            $values['sunset']=$row[7]; // SUofficial
            $values['week']=$row[2]; // week
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

        // get calendar values for this day
        if ($date != $last_date) {
          $cal=read_cal($sunmoon_file,date('j.n.Y', $date));
        }
        $last_date = $date;
        
        if (($date >= strtotime($start_date) && $date <= strtotime($end_date)) || $week == $cal['week']) {    
            if ($time >= strtotime($cal['sunrise']) && $time <= strtotime($cal['sunset'])) {
//              echo $basedir."/".$dir."/".$file."\n";
              readfile($basedir."/".$dir."/".$file);
            }
        }
      }
    }
  }
}

?>
