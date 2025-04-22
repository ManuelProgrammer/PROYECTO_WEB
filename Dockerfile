# Imagen base con Apache y PHP 8.2
FROM php:8.2-apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# ✅ Instalar la extensión mysqli
RUN docker-php-ext-install mysqli

# ✅ Habilitar mod_rewrite para .htaccess
RUN a2enmod rewrite

# ✅ Copiar todos los archivos del backend
COPY . .

# ✅ Dar permisos (opcional, pero recomendado)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para el servidor
EXPOSE 80

# Comando por defecto al iniciar el contenedor
CMD ["apache2-foreground"]
