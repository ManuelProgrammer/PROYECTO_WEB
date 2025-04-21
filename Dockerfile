# Imagen base con Apache y PHP
FROM php:8.2-apache

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido del proyecto
COPY mi_proyecto/ .

# Habilitar mod_rewrite si usas .htaccess
RUN a2enmod rewrite

# Dar permisos si es necesario (opcional)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
