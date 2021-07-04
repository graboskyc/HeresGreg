#!/bin/bash

bigFiles=(/app/wwwroot/media/*.mp4)

for file in ${bigFiles[*]}
do 
	filename="${file##*/}"
	if [ ! -f /app/wwwroot/media/smaller/$filename ]
	then 
		echo $filename
		/ffmpeg/ffmpeg -i /app/wwwroot/media/$filename -vf scale="640:trunc(ow/a/2)*2" -map 0:v? -map 0:a? -map 0:s? -c:v libx264 /app/wwwroot/media/smaller/$filename
		rm -f /app/wwwroot/media/$filename
	fi
done