#!/bin/bash

bigFiles=(/Greg/www/media/*.mp4)

for file in ${bigFiles[*]}
do 
	filename="${file##*/}"
	if [ ! -f /Greg/www/media/smaller/$filename ]
	then 
		echo $filename
		/Greg/www/ffmpeg/ffmpeg -i /Greg/www/media/$filename -vf scale=-1:640 /Greg/www/media/smaller/$filename
	fi
done
