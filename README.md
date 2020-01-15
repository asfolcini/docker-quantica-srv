# docker-quantica
QUANTiCA docker image


### BUILD
<pre>
docker build -t asfolcini/quantica .
</pre>

### RUN
<pre>
docker run --name=quantica -e PUID=1000 -e PGID=1000 -e TZ=Europe/London -v c:/temp/tmp:/config -p 80:80 asfolcini/quantica
</pre>

### EXEC
<pre>
docker exec -it quantica /bin/bash
</pre>

### TEST
Enter inside the container and execute this command:
<pre>
quantica -ts quantica.SystemCheck  
</pre>
