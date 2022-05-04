# docker-quantica-srv
QUANTiCA Server docker image


### BUILD
<pre>
docker build -t asfolcini/quantica-srv .
</pre>

### RUN
<pre>
docker run --name=quantica-srv -e PUID=1000 -e PGID=1000 -e TZ=Europe/London -v c:/temp/tmp:/config -p 8081:8081 asfolcini/quantica-srv
</pre>

### EXEC
<pre>
docker exec -it quantica-srv /bin/bash
</pre>

### TEST
Enter inside the container and execute this command:
<pre>
root@quantica-srv:/# quantica -ts quantica.SystemCheck
root@quantica-srv:/#
                ___
               /,_ \    _,
               |/ )/   / |            Q U A N T i C A
                 //  _/  |            a l g o r i t h m i c   t r a d i n g   p l a t f o r m   2.0
                / ( /   _)
               /   `   _/)            copyright © Alberto Sfolcini <a.sfolcini@gmail.com>
               \  ~=-   /,            MIT License,  http://getquantica.com
        ^~^~^~^~^~^~^~^~^~^~^~^~

QUANTiCA ENGiNe - BUILD Version 2.0ms05 fired up!
Settings loaded from ClassPath quantica.properties
Loading Trading System quantica.SystemCheck.. .

------------------------------------------------------------------------------------------
                      S Y S T E M    C H E C K
------------------------------------------------------------------------------------------
 Config file        : quantica.properties (classpath)
------------------------------------------------------------------------------------------
 LOCALE Settings
------------------------------------------------------------------------------------------
 [ ok ] Locale             : en_US
 [ ok ] Language           : ENG
 [ ok ] Timestamp format   : yyyy-MM-dd HH:mm:ss.SSS
 [ ok ] Test today date    : 2022-05-04 16:09:02.357
------------------------------------------------------------------------------------------
 REPOSITORIES
------------------------------------------------------------------------------------------
 [ ok ] Trading Systems    : /config/quantica/repository/ [28 bytes]
 [ ok ] Resources          : /config/quantica/resources/ [637 KB]
 [ ok ] Reports            : /config/quantica/reports/ [14 bytes]
------------------------------------------------------------------------------------------
 NATS Message Broker
------------------------------------------------------------------------------------------
 [ ok ]  NATS Server 1     : nats://nats-srv:4222
 .  [ ok ]  Test connection to nats://nats-srv:4222: CONNECTED
 [Warn]  NATS Server 2     :
 [Warn]  NATS Server 3     :
 [Warn]  NATS Server 4     :
------------------------------------------------------------------------------------------
 PERSISTENCE LAYER ( MariaDB )
------------------------------------------------------------------------------------------
 [ ok ]  DB IP:Port        : quantica-db:3306
 [ ok ]  DB Name/ID        : db-quantica-core
 [ ok ]  DB Username       : quantica_usr
 [ ok ]  DB Password       : ***********
 [ ok ]  Test connection   : CONNECTED
------------------------------------------------------------------------------------------
 API KEY
------------------------------------------------------------------------------------------
 [ ok ]  API KEY is setted.
------------------------------------------------------------------------------------------
 TEST ENDED.
------------------------------------------------------------------------------------------
root@quantica-srv:/# 
</pre>
