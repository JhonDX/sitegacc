FROM php:8.2-apache

# Instala LDAP
RUN apt-get update && apt-get install -y \
    libldap2-dev \
    && docker-php-ext-install ldap \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

# Permissões corretas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p /var/www/html/dados \
    && mkdir -p /var/www/html/uploads \
    && chmod -R 777 /var/www/html/dados \
    && chmod -R 777 /var/www/html/uploads

EXPOSE 80