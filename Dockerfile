FROM ghcr.io/linuxserver/baseimage-alpine:3.14

LABEL maintainer="Alberto Sfolcini <a.sfolcini@gmail.com>"

## Install Java and cleanup after in the same layer
RUN apk update && apk add --update-cache openjdk8 && apk del nginx php && rm -rf /var/lib/apt/lists/*

## Install Python
RUN apk add --no-cache --update \
    python3 py3-pip python3-dev gcc \
    gfortran musl-dev g++ \
    libffi-dev openssl-dev \
    libxml2 libxml2-dev \
    libxslt libxslt-dev \
    libjpeg-turbo-dev zlib-dev
	

## Install python modules
RUN pip3 install --no-cache-dir --upgrade pip && \
    pip3 install --no-cache-dir mysql-connector && \
    pip3 install --no-cache-dir yfinance 

	
COPY root/ /
RUN dos2unix /etc/cont-init.d/* && dos2unix /bin/quantica && dos2unix /bin/qexec && dos2unix /quantica/quantica/config/quantica.properties && dos2unix /quantica/quantica/config/log4j2.xml

VOLUME ["/config"]

## Expose http & https
EXPOSE 8081 9000

CMD ["/usr/bin/java","-cp","/app/QUANTiCA/quantica-core-api.jar:/config/quantica/config", "-Dloader.main=quantica.api.QuanticaAPI","org.springframework.boot.loader.PropertiesLauncher"]
