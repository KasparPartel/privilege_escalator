> [Project](https://github.com/01-edu/public/tree/master/subjects/cybersecurity/local)
> [Audit](https://github.com/01-edu/public/tree/master/subjects/cybersecurity/local/audit)


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

8. Now it's time for our reverse shell.

