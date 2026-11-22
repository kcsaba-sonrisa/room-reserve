FROM php:8.4-cli

# Rendszercsomagok és PHP kiterjesztések (pdo_sqlite alapból benne van az image-ben)
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libicu-dev libzip-dev \
    && docker-php-ext-install intl pdo_mysql zip opcache \
    && rm -rf /var/lib/apt/lists/*

# Composer a hivatalos image-ből
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Nem root userként futunk, ezért a Composer cache-nek írható hely kell
ENV COMPOSER_HOME=/tmp/composer

WORKDIR /app
