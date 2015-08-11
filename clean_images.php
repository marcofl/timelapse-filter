<?php

$basedir="/pool/images/camsev1";
$monthdir="Img_2015-08";

$files = scandir($basedir."/".$monthdir);

//print_r($files);

foreach ($files as $file) {
  echo $file."\n";
}


?>