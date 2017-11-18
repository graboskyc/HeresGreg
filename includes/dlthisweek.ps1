$wc=new-object system.net.webclient
$wc.downloadfile("http://localhost:9999/includes/pushthisweek.php","c:\temp\thisweek.html")