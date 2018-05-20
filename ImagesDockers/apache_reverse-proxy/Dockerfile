# Chargement du module apache avec php
FROM php:7-apache

#Permet de mettre à jour et d'installer Nano
RUN apt-get update && apt-get install -y nano

COPY conf/ /etc/apache2

RUN a2enmod proxy proxy_http
RUN a2ensite 000-* 001*