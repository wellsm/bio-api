FROM hyperf/hyperf:8.3-alpine-v3.19-swoole-slim

RUN apk update \
  && apk upgrade \
  && apk add --no-cache \
    supervisor \
    php83-pecl-xdebug

COPY *.ini /etc/php/conf.d/

ENV TIMEZONE="America/Sao_Paulo"

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime
RUN echo "${TIMEZONE}" > /etc/timezone
