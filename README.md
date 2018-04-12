# README

This is a custom alternative now that Microsoft is killing Skype qik so we can no longer share videos of our baby with their grandmothers. It is not very secure but instead meant as a basic way to stop people who randomly stumbled upon the site.

## How do I get set up?

* Get a linux box and install docker
* Create a directory in / to store data, here called Greg
* `mkdir /Greg; mkdir /Greg/www; mkdir /Greg/db`
* extract this repo in /Greg/www
* extract the latest static build of ffmpeg into /Greg/www/ffmpeg, from here: https://johnvansickle.com/ffmpeg/builds/ffmpeg-git-32bit-static.tar.xz
* Run `docker run -d -p 80:80 -v /Greg/www:/var/www -v /Greg/db:/var/lib/mysql --name heresgreg btobolaski/lamp`
* Attach to the instance and import the DB schema called DBStructure.sql 
* `docker exec -i -t containerid /bin/bash`
* `mysql -u app -p app < /var/www/DBStructure.sql` and password is `app_password`
* Default username and passcode is `admin`
* navigate to your site on port 80 and should be all set
* For advanced features, edit includes/config.php and set the APPNAME to your child's name and create a pushbullet channel and API key and fill that out for push notifications
* note that a PHP.ini file is included in case the default does not work due to bad upload settings (size, temp folders, etc)

## Configuation
Found in includes/config.php:

| Key | Purpose | Notes |
|----|---|-|
|PRODUCTVERSION | Current release of product | should be changed by developer, not users |
| APPNAME | Name of application in title bar, pages, etc | default is "Here's Greg" so value should be "Greg" |
| PUSHBULLETAPIKEY | API key for pushbullet.com service | enables push notifications when videos uploaded. leave blank if not using|
| PUSHBULLETCHAN | Channel to which to post the notification to | |
| DISQUSURL | Signing up for a Disqus.com service, this is the URL they give you | |
| SITEURL | FQDN to root of site | Include HTTP:// |
| THEMECOLOR | Hex code for theme color supported by most mobile browsers | 6 digit hex without the # |
| DBHOST | host of sql db | leave default if using docker method |
| DBNAME | name of sql db | leave default if using docker method |
| DBUSERNAME | username for database | leave default if using docker method |
| DBPASSWD | password for database | leave default if using docker method |
| AZURECOGVISREG | If using Azure cognitive vision API, the region to use | leave blank if not using. should be something like "westcentralus" |
| AZURECOGVISKEY | API key for azure cognitive vision API | leave blank if not using

## Features
* Push notifications via pushbullet for new videos uploaded and weekly summary (this week in) from past years
* media re-encoding in batch for better streaming
* responsive built on top of bootstrap for computers, tablets, and phones
* comments built on top of disqus
* filter overlays for places and holidays
* upload videos and animated gifs
* ability to favorite videos
* view videos by most recent (home page), by day/year, favorite, filter, etc

## Screenshots
![](SCREENSHOTSFORGITHUB/01.JPG)