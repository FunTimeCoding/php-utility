FROM php:7.3-cli
MAINTAINER Alexander Reitzel
WORKDIR /usr/src
COPY src php-utility/src
COPY vendor php-utility/vendor
COPY bin php-utility/bin
WORKDIR /usr/src/php-utility
CMD ["bin/phut"]
