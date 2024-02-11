FROM hyperf/hyperf:8.2-alpine-v3.19-swoole-slim

COPY *.ini /etc/php/conf.d/

ENV TIMEZONE="America/Sao_Paulo"

RUN set -ex \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php* \
    { \
        echo "upload_max_filesize=128M"; \
        echo "post_max_size=128M"; \
        echo "memory_limit=1G"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime
RUN echo "${TIMEZONE}" > /etc/timezone
RUN rm -rf /var/cache/apk/* /tmp/* /usr/share/man

WORKDIR /opt/www

COPY . /opt/www

RUN composer install --no-dev -o && php bin/hyperf.php

EXPOSE 9501

ENTRYPOINT ["php", "/opt/www/bin/hyperf.php", "start"]