FROM linuxserver/nginx:latest

LABEL maintainer="Alberto Sfolcini <a.sfolcini@gmail.com>"

# Setting up proxy
ENV http_proxy ''
ENV https_proxy ''

## Install Java and cleanup after in the same layer
RUN apk update && apk add --update-cache openjdk8 && rm -rf /var/lib/apt/lists/*

## Install Python
RUN apk add --no-cache --update \
    python3 py3-pip python3-dev gcc \
    gfortran musl-dev g++ \
    libffi-dev openssl-dev \
    libxml2 libxml2-dev \
    libxslt libxslt-dev \
    libjpeg-turbo-dev zlib-dev


## Install python modules
<<<<<<< HEAD
RUN pip install mysql-connector
RUN pip install yfinance
=======
RUN pip install --upgrade cython

RUN pip3 install --no-cache-dir --upgrade pip && \
    pip3 install --no-cache-dir mysql-connector && \
    pip3 install --no-cache-dir yfinance 

>>>>>>> cc8793bdb689bd86a11341e99ff2ce1ba0c62e1e

COPY root/ /
RUN dos2unix /etc/cont-init.d/* && dos2unix /bin/quantica && dos2unix /bin/qexec && dos2unix /quantica/quantica/config/quantica.properties && dos2unix /quantica/quantica/config/log4j2.xml


VOLUME ["/config"]

## Expose http & https
EXPOSE 80 8081 443 9000

<<<<<<< HEAD
#CMD ["/usr/bin/java","-cp","/app/QUANTiCA/quantica-core-api.jar:/config/quantica/config", #"-Dloader.main=quantica.api.QuanticaAPI","org.springframework.boot.loader.PropertiesLauncher"]

CMD ["/bin/quantica-api"]
=======
CMD ["/usr/bin/java","-cp","/app/QUANTiCA/quantica-core-api.jar:/config/quantica/config", "-Dloader.main=quantica.api.QuanticaAPI","org.springframework.boot.loader.PropertiesLauncher"]
>>>>>>> cc8793bdb689bd86a11341e99ff2ce1ba0c62e1e
