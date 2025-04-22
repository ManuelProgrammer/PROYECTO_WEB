# Imagen base con Apache y PHP 8.2
FROM php:8.2-apache

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto (ajusta si tu raíz cambia)
COPY mi_proyecto/ .

# Evitar error de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Habilitar mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Establecer permisos apropiados
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto estándar de Apache
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
