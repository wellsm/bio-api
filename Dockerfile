FROM hyperf/hyperf:8.2-alpine-v3.19-swoole-slim

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

RUN composer install --no-dev -o
RUN composer dump-autoload
RUN php bin/hyperf.php

ENTRYPOINT ["php", "/var/www/app/bin/hyperf.php", "start"]