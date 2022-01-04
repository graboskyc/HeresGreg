#!/bin/bash

bigFiles=(/app/wwwroot/media/*.mp4)

for file in ${bigFiles[*]}
do 
	filename="${file##*/}"
	if [ ! -f /app/wwwroot/media/smaller/$filename ]; then 
		echo $filename
		cp /app/wwwroot/media/$filename /app/wwwroot/media/bu/$filename
		/ffmpeg/ffmpeg -i /app/wwwroot/media/$filename -vf scale="640:trunc(ow/a/2)*2" -map 0:v? -map 0:a? -map 0:s? -c:v libx264 -movflags faststart /app/wwwroot/media/smaller/$filename
		lastCmd=$?
		echo $lastCmd
		if [ $lastCmd -eq 0 ]; then
			rm -f /app/wwwroot/media/$filename
		else
			rm -f /app/wwwroot/media/smaller/$filename
		fi
	fi
done