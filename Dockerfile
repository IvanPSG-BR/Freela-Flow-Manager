# Usando a imagem oficial do PHP com Apache
FROM php:8.0-apache

# Copia o código da aplicação
COPY . /var/www/html/

# Copia o arquivo de configuração customizado para o Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Exponha a porta que o Apache utilizará
EXPOSE 80
