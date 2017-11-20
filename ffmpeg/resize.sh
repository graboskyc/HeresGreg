#!/bin/bash

bigFiles=(/mnt/media/*.mp4)

for file in ${bigFiles[*]}
do 
	filename="${file##*/}"
	if [ ! -f /mnt/media/smaller/$filename ]
	then 
		echo $filename
		/mnt/ffmpeg/ffmpeg -i /mnt/media/$filename -vf scale=-1:640 /mnt/media/smaller/$filename
		rm -f /mnt/media/$filename
	fi
done
