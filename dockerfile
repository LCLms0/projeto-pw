# Usa uma imagem oficial do PHP com Apache de forma otimizada
FROM php:8.2-apache

# Ativa o módulo de reescrita de URL do Apache (caso use rotas amigáveis no futuro)
RUN a2enmod rewrite

# Instala as extensões necessárias para o PHP se conectar ao MySQL (PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Define o diretório de trabalho padrão dentro do container
WORKDIR /var/www/html/

# Dá as permissões corretas para a pasta do projeto (importante para uploads de fotos)
RUN chown -R www-data:www-data /var/www/html/