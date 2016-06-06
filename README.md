# remote-vlc
Remote VLC Media controller

### Requirements

VLC
USB Web Server on Windows
Mysql Schema needs to be added. Currently missing.

### Setup

1. Copy the content within the root foler into the USB Web Server's root folder.
2. Create an alias to the L Drive using
```
C:\Windows\System32\subst.exe L: C:\kkodata
```
3. Create an alias to start VLC with http enabled on port 8080
```
"C:\Program Files (x86)\VideoLAN\VLC\vlc.exe" --http-password=ricky --http-port=8080 --extraintf=http:rc --fullscreen
```

### Start

1. Double click on the L drive shortcut to create the L Drive
2. Double click on the VLC shortcut to start VLC
3. Start USB webserver
4. You can now access and control VLC by browsing to the computer's IP
