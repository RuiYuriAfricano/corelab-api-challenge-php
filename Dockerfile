# Etapa 1: Construção do ambiente
FROM php:8.2.12-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2.2.24 /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar o arquivo composer.json e instalar dependências
COPY composer.json ./
COPY composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copiar o restante do código para o container
COPY . .

# Gerar autoload
RUN composer dump-autoload --optimize

# Definir permissões para o diretório storage
RUN chown -R www-data:www-data /var/www/storage

# Expor a porta 8000
EXPOSE 8000

# Comando para rodar o servidor Laravel e rodar as migrações
CMD sh -c "php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000"