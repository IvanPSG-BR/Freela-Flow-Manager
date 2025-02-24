# Usando a imagem oficial do PHP com Apache
FROM php:8.0-apache

# Copia os arquivos da aplicação para o diretório do servidor web
COPY . /var/www/html/

# Exponha a porta que o Apache utilizará
EXPOSE 8080
