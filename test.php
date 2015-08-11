<?php

function read_sun_rise_set($file,$date) {
    $csv['Datum']=0;
    $csv['SAofficial']=6;
    $csv['SUofficial']=7;

    $f = fopen("sunmoon.csv", "r");
    $result = false;
    while ($row = fgetcsv($f,0,";")) {
        if ($row[0] == "11.8.2015") {
            $values['date']=$row[$csv['Datum']];
            $values['rise']=$row[$csv['SAofficial']];
            $values['set']=$row[$csv['SUofficial']];
            return $values;
            break;
        }
    }
    fclose($f);
    
    
}
    echo date('d-m-Y H:i', strtotime("20150801-2059"));
