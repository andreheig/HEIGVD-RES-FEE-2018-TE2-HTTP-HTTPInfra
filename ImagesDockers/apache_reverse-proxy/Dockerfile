# Chargement du module apache avec php
FROM php:7-apache

#Permet de mettre à jour et d'installer Nano
RUN apt-get update && apt-get install -y nano

#Permet de copier le script lancer avant de lancer apache 2
COPY apache2-foreground /usr/local/bin

#Permet de copier notre template afin de configurer dynamiquement les ip
COPY templates /var/apache2/templates

#Peremt de copier la configuration du reverse-proxy
COPY conf /etc/apache2

RUN a2enmod proxy proxy_http proxy_balancer lbmethod_byrequests
RUN a2ensite 000-* 001-*