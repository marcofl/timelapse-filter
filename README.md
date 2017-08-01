# timelapse-filter
* php script hack for filtering jpeg photos for timelapse videos
* currently filters for sunrise / sunset
* accepts start end date or week of year
* hardly depends on how photo files are named!

## example
````
 ./jpg_filter.php /pool/images/camsev1 $(date +%Y%m%d) $(date +%Y%m%d) | ffmpeg -f image2pipe -r 9 -vcodec mjpeg -probesize 10M -i - -r 9 -q:v 2 -pix_fmt yuv420p -s hd480 -y /var/www/html/video/daily-$(date +%Y%m%d).mp4
```

## calendar
* get the csv from http://galupki.de/kalender/sunmoon.php

## todo
* make it simpler and cleaner
* maybe integrate ffmpeg somehow

USE AT YOUR OWN RISK!
