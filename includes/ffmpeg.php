<?php

function CreateThumb($fn) {
    $cmd = "/var/www/ffmpeg/ffmpeg -i /var/www/media/".$fn." -ss 00:00:01.000 -vframes 1 /var/www/media/".$fn.".jpg";
    //echo $cmd;
    exec($cmd);
}

function ConvertVid($inf, $outf) {
    $cmd = "C:\\xampp\\htdocs\\ffmpeg\\bin\\ffmpeg -i C:\\xampp\\htdocs\\media\\".$inf." -vcodec copy -acodec copy C:\\xampp\\htdocs\\media\\".$outf;
    exec($cmd);
}

function ConvertGIF($inf, $outf) {
    $cmd = "/var/www/ffmpeg/ffmpeg -i /var/www/media/".$inf." -movflags faststart -pix_fmt yuv420p -vf \"scale=trunc(iw/2)*2:trunc(ih/2)*2\"  /var/www/media/".$outf;
    exec($cmd);

}

function ResizeVid($inf, $outf) {
    $cmd = "C:\\xampp\\htdocs\\ffmpeg\\bin\\ffmpeg -i C:\\xampp\\htdocs\\media\\".$inf." -vf scale=-1:640 C:\\xampp\\htdocs\\media\\".$outf;
    exec($cmd);
}
?>