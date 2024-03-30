FROM hyperf/hyperf:8.3-alpine-v3.19-swoole-slim

ENV TIMEZONE="America/Sao_Paulo"

RUN set -ex \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php* \
    && { \
        echo "upload_max_filesize=128M"; \
        echo "post_max_size=128M"; \
        echo "memory_limit=1G"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime
RUN echo "${TIMEZONE}" > /etc/timezone
RUN rm -rf /var/cache/apk/* /tmp/* /usr/share/man

WORKDIR /var/www/app

COPY . /var/www/app

RUN composer install

ENTRYPOINT ["/bin/sh", "-c" , "php bin/hyperf.php migrate && composer start"]