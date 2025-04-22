# Imagen base con Apache y PHP 8.2
FROM php:8.2-apache

# Instalar extensiones necesarias (como mysqli)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto (ajusta si tu raíz cambia)
COPY mi_proyecto/ .

# Evitar advertencia de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Habilitar mod_rewrite si usas .htaccess
RUN a2enmod rewrite

# Dar permisos si es necesario
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto estándar de Apache
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
