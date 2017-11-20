<?php
require_once('util.php');    

$sql = "select path, month(created) as m, day(created) as d, year(created) as y from media where year(created) <> year(now()) and week(created) = week(now()) order by rand() limit 1";
$conn = connectDB();
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$key = PUSHBULLETAPIKEY;
$url = 'https://api.pushbullet.com/v2/pushes';

foreach($result as $r)
{
    $body = APPNAME.' this week on: ' .$r["m"]."/".$r["d"]."/".$r["y"];

    $fields = array(
        'active' => true,
        'body' => $body,
        'title' => "This Week in Here's ".APPNAME,
        'type' => "file",
        'file_name' => "file",
        'file_type' => "image/jpeg",
        'file_url' => SITEURL."/media/".$r["path"].".jpg",
        'channel_tag' => "".PUSHBULLETCHAN,
        'url' => SITEURL."/media/smaller/".$r["path"]
    );
}



//url-ify the data for the $_POST
$data = json_encode($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, $key);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data)
));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//execute post
$response = curl_exec($ch);

//close connection
curl_close($ch);

?>
