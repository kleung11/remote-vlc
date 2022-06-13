# remote-vlc
Remote VLC Media controller

### Requirements

VLC (install via apt-get, not snap if using ubuntu)
Docker Engine

### TODO

- VLC should be able to run using 127.0.0.1 instead of having to figure out the computer's IP address and to start using it and eliminating editing configs.php

### Start

1. Edit configs.php to have your computer's IP address for `$vlc_site`
2. Start db and app 
```
cd docker
docker-compose up
```
3. Create an alias to start VLC with http enabled on port 8080 of your computer's IP address
```
vlc --extraintf http --http-host 192.168.86.64 --http-port 8080 --http-password ricky
```

4. You can now access and control VLC by browsing to the computer's IP
