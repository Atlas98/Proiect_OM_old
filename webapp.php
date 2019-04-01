<?php

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();

$address = '127.0.0.1';
$port = 5555;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

if(socket_connect($sock, $address, $port) == false) {
	echo "socket_connect() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}

$msg = 'start';
socket_write($sock, $msg, strlen($msg));

$msg_read = socket_read($sock, 1024, PHP_NORMAL_READ);

echo 'hello world';
echo $msg_read;

socket_close($sock);

?>