> [Project](https://github.com/01-edu/public/tree/master/subjects/cybersecurity/local)

1. With nmap we scan for open hosts in 192.168.1.0, as this is the broadcast channel for our network:
```bash
nmap -sn 192.168.1.0/24
```
For me it reveals that there is an host up - 192.168.1.2

2. We scan the host with nmap for open ports
```bash
   nmap 192.168.1.2
```
We can see that the host has open ports for FTP, SSH, HTTP - 21, 22, 80 respectively

3. We open the host in browser and can confirm that this host is for our exercise, as it contains HTML markup, that says something like "HackMe Please!."
4. We connect to host through FTP:
```bash
   ftp 192.169.1.2
```
It asks for a user so we try anonymous login - 
- username: anonymous
- password is empty 
We get access.

5. We see what files the ftp server contains:
```bash
   ls
```
There  is life.c and template.html

6. We download both files and see that they contain nothing useful
   But we now know that the ftp server may be exploited to upload a reverse shell.

7. As we want to connect to the server via reverse shell, then we have to know, where the file is located on a http server.
We can use a Web Content Scannner like DIRB to launch a dictionary based attack against the http server.
```bash
   dirb http://192.168.1.2
```
We have this line in the output:
```bash
   ---- Entering directory: http://192.168.1.2/files/ ----
```
When we access this address in our browser, we can see that it contains all of the files, that are also in ftp server.

> Before this step, be sure that whatever port we use for our reverse shell (1234 in this instance) is allowed through our firewall.

8. Now it's time for our reverse shell.
We upload our reverse shell and shell.py through ftp.
Then we connect to 192.168.1.2/files through our browser client.
We should see that our uploaded reverse shell is listed there.
We click on it and browser should hang.

9. We connect to the port with netcat.
```bash
   nc -v 192.168.1.2 1234
```

10. We look around for a bit and see that /home folder contains file important.txt
```bash
   ls -l /home
```
When we cat important.txt, we can see that it wants us to run a script /.runme.sh
```bash
cat /home/important.txt
```

We don't want to run foreign scripts so we cat /.runme.sh
```bash
cat /.runme.sh
```

We see that this file contains an hash

11. When we decode the hash (you can use any free online MD5 decoder), we get the string **youaresmart**
    We assume that this is the password.

12. We try to login to virtual machine with:
    username: shrek
	password: youaresmart
	
	It works :)

13. We navigate to /var/www/html/files and run shell.py that we uploaded before:
    ```bash
    sudo python3.5 shell.py
```
That spawns a root shell for us.

14. Now we navigate to /root and cat root.txt
    This file contains the flag and the exercise is finished.

-------------------
EXPLOITS

Anonymous login on FTP server should'nt be allowed.
Users shouldn't have access to execute python etc., as it could very easily be used to access root.
