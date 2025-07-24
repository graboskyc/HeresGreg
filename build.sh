#!/bin/bash

source .env
echo "Using conn string starting ${MDBCONNSTR:0:18}..."

datehash=`date | md5sum | cut -d" " -f1`
abbrvhash=${datehash: -8}

echo
echo "+======================"
echo "| START: Heres Greg"
echo "+======================"
echo

echo 
echo "Building container using tag ${abbrvhash}"
echo
docker build -t graboskyc/heresgregblazor:${abbrvhash} .

EXITCODE=$?

echo 
echo "GREG: Starting container"
echo

if [ $EXITCODE -eq 0 ]
    then

    docker stop heresgregblazor
    docker rm heresgregblazor
    docker run -t -i -d -p 9999:8080 --name heresgregblazor -e "MDBCONNSTR=${MDBCONNSTR}" -e "JWTKEY=${JWTKEY}" -e "DEPLOYMENTBASEURI=${DEPLOYMENTBASEURI}" --restart unless-stopped graboskyc/heresgregblazor:${abbrvhash}

    echo
    echo "+================================"
    echo "| END: Heres Greg"
    echo "+================================"
    echo

else
    echo
    echo "+================================"
    echo "| ERROR: Build failed"
    echo "+================================"
    echo
fi