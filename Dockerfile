FROM linuxserver/nginx:latest

LABEL maintainer="Alberto Sfolcini <a.sfolcini@gmail.com>"

# Setting up proxy
ENV http_proxy ''
ENV https_proxy ''

## Install Java and cleanup after in the same layer
RUN apk update && apk add --update-cache openjdk8 && rm -rf /var/lib/apt/lists/*

## Install Python
RUN apk add --update-cache python3 py3-pip

## Install python modules
RUN pip install mysql-connector
RUN pip install yfinance

COPY root/ /
RUN dos2unix /etc/cont-init.d/* && dos2unix /bin/quantica && dos2unix /bin/qexec && dos2unix /quantica/quantica/config/quantica.properties && dos2unix /quantica/quantica/config/log4j2.xml


VOLUME ["/config"]

## Expose http & https
EXPOSE 80 8081 443 9000

CMD ["/usr/bin/java","-cp","/app/QUANTiCA/quantica-core-api.jar:/config/quantica/config", "-Dloader.main=quantica.api.QuanticaAPI","org.springframework.boot.loader.PropertiesLauncher"]
