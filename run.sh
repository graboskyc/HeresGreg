#!/bin/bash

MDBCONNSTR="mongodb+srv://<un>:<pw>@host/greg?retryWrites=true&w=majority&appName=HeresKids"
DEPLOYMENTBASEURI="http://<DockerHostLoopback IP and port>"
JWTKEY="<256 char secret key>"
HOSTEDURI="https://<final hosted URI>/"
VER="e0cf6bf2"

echo "Using conn string starting ${MDBCONNSTR:0:18}..."

docker run -t -i -d -p 9999:8080 \
        --name heresgregblazormdb \
        -e "MDBCONNSTR=${MDBCONNSTR}" \
        -e "JWTKEY=${JWTKEY}" \
        -e "DEPLOYMENTBASEURI=${DEPLOYMENTBASEURI}" \
        -e "HOSTEDURI=${HOSTEDURI}" \
        -v /Greg/www/media:/app/wwwroot/media \
        -v /Greg/www/ffmpeg:/ffmpeg \
        --security-opt seccomp=unconfined \
        --restart unless-stopped graboskyc/heresgregblazor:${VER}