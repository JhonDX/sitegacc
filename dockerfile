FROM php:8.2-apache

# Instala dependências do LDAP
RUN apt-get update && apt-get install -y \
    libldap2-dev \
    && docker-php-ext-install ldap \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY sitegacc/ .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80