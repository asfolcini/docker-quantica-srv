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
root@646bcb881f68:/# quantica -ts quantica.SystemCheck

                ___
               /,_ \    _,
               |/ )/   / |            Q U A N T i C A
                 //  _/  |            a l g o r i t h m i c   t r a d i n g   p l a t f o r m   2.0
                / ( /   _)
               /   `   _/)            copyright © Alberto Sfolcini <a.sfolcini@gmail.com>
               \  ~=-   /,            MIT License,  http://getquantica.com
        ^~^~^~^~^~^~^~^~^~^~^~^~

QUANTiCA ENGiNe - BUILD Version 2.0ms02 fired up!
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
 [ ok ] Test today date    : 2020-01-15 16:17:54.997
------------------------------------------------------------------------------------------
 REPOSITORIES
------------------------------------------------------------------------------------------
 [ ok ] Trading Systems    : /config/quantica/repository/ [28 bytes]
 [ ok ] Resources          : /config/quantica/resources/ [637 KB]
 [ ok ] Reports            : /config/quantica/reports/ [14 bytes]
------------------------------------------------------------------------------------------
 NATS Message Broker
------------------------------------------------------------------------------------------
 [ ok ]  NATS Server 1     : nats://172.17.0.3:4222
 .  [ ok ]  Test connection to nats://172.17.0.3:4222: CONNECTED
 [Warn]  NATS Server 2     :
 [Warn]  NATS Server 3     :
 [Warn]  NATS Server 4     :
------------------------------------------------------------------------------------------
 PERSISTENCE LAYER ( MariaDB )
------------------------------------------------------------------------------------------
 [ ok ]  DB IP:Port        : 172.17.0.5:3306
 [ ok ]  DB Name/ID        : db-quantica-core
 [ ok ]  DB Username       : quantica_usr
 [ ok ]  DB Password       : ***********
 [ ok ]  Test connection   : CONNECTED
------------------------------------------------------------------------------------------
 REPORT DASHBOARDS
------------------------------------------------------------------------------------------
 [ ok ]  Metabase Url      : http://172.17.0.6:3000/public/dashboard/cef0c92a-5605-44ce-906f-1d455ce915a3
------------------------------------------------------------------------------------------
 TEST ENDED.
------------------------------------------------------------------------------------------
root@646bcb881f68:/#
</pre>
