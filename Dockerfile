#FROM 7.3-fpm-buster
# TODO: See https://hub.docker.com/_/php

#FROM 7.3-apache-buster
#COPY src/ /var/www/html/
# TODO: Maybe web needs to be renamed to html, then . copied to /var/www?

FROM 7.3-cli-buster

#MAINTAINER Alexander Reitzel
#ADD script/docker/provision.sh /root/provision.sh
#RUN chmod +x /root/provision.sh
#RUN /root/provision.sh
#ADD . /php-utility
#ENTRYPOINT ["/php-utility/bin/pu"]

COPY . /usr/src/php-utility
WORKDIR /usr/src/php-utility
CMD ["bin/pu"]
