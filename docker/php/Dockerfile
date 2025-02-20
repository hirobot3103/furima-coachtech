FROM php:8.3.0-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

  RUN apt-get update &&\
  apt-get install -y libpng-dev libjpeg62-turbo-dev &&\
  docker-php-ext-configure gd --with-jpeg &&\
  docker-php-ext-install -j$(nproc) gd

# Install PHP extensions:
  ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
  RUN chmod +x /usr/local/bin/install-php-extensions && \
      install-php-extensions zip

# Install Google Chrome:
RUN apt-get update && \
    apt-get install -y gnupg2 && \
    curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add && \
    echo "deb https://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list && \
    apt-get -y update && \
    apt-get -y install google-chrome-stable

# Install ChromeDriver:
RUN apt-get update && \
    apt-get install -y unzip && \
    curl -sS https://chromedriver.storage.googleapis.com/94.0.4606.61/chromedriver_linux64.zip -o chromedriver.zip && \
    unzip chromedriver.zip && \
    rm chromedriver.zip && \
    chmod +x chromedriver && \
    mv -f chromedriver /usr/local/bin/chromedriver

# Cleanup:
RUN apt-get -y autoremove && \
apt-get clean && \
rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* 

RUN useradd -m hirobot3103

WORKDIR /var/www

