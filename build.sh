#!/bin/bash

echo
echo "+======================"
echo "| START: Heres Greg"
echo "+======================"
echo

echo 
echo "GREG: Building webapp"
echo
cd HeresKids
dotnet clean
cd ..
echo 
echo "GREG: Building container"
echo
docker build -t graboskyc/heresgregblazor:latest .

echo 
echo "GREG: Starting container"
echo

docker stop heresgregblazor
docker rm heresgregblazor
docker run -t -i -d -p 9999:80 --name heresgregblazor --restart unless-stopped graboskyc/heresgregblazor:latest

echo
echo "+======================"
echo "| END: Heres Greg"
echo "+======================"
echo
