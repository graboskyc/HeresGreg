#!/bin/bash

echo
echo "+================================"
echo "| START: Heres Greg"
echo "+================================"
echo

source .env
#cd HeresKids

datehash=`date | md5sum | cut -d" " -f1`
abbrvhash=${datehash: -8}
echo "Using conn string ${MDBCONNSTR}"
echo "Using Auth0 domain string ${AUTH0DOMAIN}"

echo 
echo "Building container using tag ${abbrvhash}"
echo
docker build -t graboskyc/heresgregblazor:latest -t graboskyc/heresgregblazor:${abbrvhash} .

EXITCODE=$?

if [ $EXITCODE -eq 0 ]
    then

    echo 
    echo "Starting container"
    echo
    docker stop heresgregblazor
    docker rm heresgregblazor
    docker run -t -i -d -p 8000:8080 --name heresgregblazor -e "MDBCONNSTR=${MDBCONNSTR}" -e "AUTH0DOMAIN=${AUTH0DOMAIN}" -e "AUTH0CLIENTID=${AUTH0CLIENTID}" graboskyc/heresgregblazor:${abbrvhash}

    echo
    echo "+================================"
    echo "| END:  Heres Greg"
    echo "+================================"
    echo
else
    echo
    echo "+================================"
    echo "| ERROR: Build failed"
    echo "+================================"
    echo
fi