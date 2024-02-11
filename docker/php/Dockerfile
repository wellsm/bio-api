FROM hyperf/hyperf:8.2-alpine-v3.19-swoole-slim

COPY *.ini /etc/php/conf.d/

ENV TIMEZONE="America/Sao_Paulo"

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime
RUN echo "${TIMEZONE}" > /etc/timezone
RUN rm -rf /var/cache/apk/* /tmp/* /usr/share/man 
