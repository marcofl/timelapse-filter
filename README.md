# timelapse-filter
php script hack for filtering jpeg fotos for timelapse videos 
hardly depends on how filenames are formated

## example
 php clean_images.php | ./read.sh | ffmpeg -f image2pipe -r 25 -vcodec mjpeg -probesize 10M -i - -r 25 -q:v 2 -pix_fmt yuv420p -s hd480 /var/www/html/test.mp4

## calendar
* get the csv from http://galupki.de/kalender/sunmoon.php

## todo
* read jpegs directly in the php script, so stdout can be used directly as ffmpeg image2pipe input
