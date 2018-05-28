# Chargement du module apache avec php
FROM php:7-apache

#Permet de mettre à jour et d'installer Nano
RUN apt-get update && apt-get install -y nano && apt-get install -y net-tools

#Permet de tester avec les pages static
COPY contenus/creative /var/www/html/

#Permet de copier le script lancer avant de lancer apache 2
COPY apache2-foreground /usr/local/bin

#Permet de copier notre template afin de configurer dynamiquement les ip
COPY contenus/templates /var/apache2/templates