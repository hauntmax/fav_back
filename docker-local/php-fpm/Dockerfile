FROM php:8.2-fpm
ARG USER
ARG USER_ID

RUN apt-get update \
    && apt-get install -y \
    openssh-client \
    ffmpeg \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    libcurl4 \
    libcurl4-gnutls-dev \
    libonig-dev \
    sudo \
    mc \
    --no-install-recommends \
    && apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo_mysql zip bcmath gd xml curl mbstring xml pcntl
RUN { \
  echo 'upload_max_filesize = 4G'; \
  echo 'post_max_size = 4G'; \
  echo 'memory_limit = 2G'; \
  echo 'max_execution_time = 360'; \
  echo 'default_socket_timeout = 360'; \
} > $PHP_INI_DIR/conf.d/post_size.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer && php -r "unlink('composer-setup.php');" || php -r "unlink('composer-setup.php');"

RUN useradd -m -u ${USER_ID} -G www-data,root -d /home/$USER $USER

WORKDIR /srv/app
USER $USER

CMD ["-F", "-y", "/usr/local/etc/php-fpm.conf"]
