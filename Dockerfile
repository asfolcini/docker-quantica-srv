FROM linuxserver/nginx:latest

LABEL maintainer="Alberto Sfolcini <a.sfolcini@gmail.com>"

# Setting up proxy
ENV http_proxy ''
ENV https_proxy ''

## Install Java and cleanup after in the same layer
RUN apk update && apk add openjdk8 && rm -rf /var/lib/apt/lists/*


COPY root/ /
RUN dos2unix /etc/cont-init.d/* && dos2unix /bin/quantica && dos2unix /bin/qexec && dos2unix /quantica/quantica/config/quantica.properties && dos2unix /quantica/quantica/config/log4j.properties


VOLUME ["/config"]

## Expose http & https
EXPOSE 80 443 9000
