#!/bin/bash
STATIC="STATIC"
DYNAMIC="DYNAMIC"
echo "<VirtualHost *:80>" > /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ServerName www.reverse-proxy.res.ch" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "<Proxy balancer://static_app>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

        php  /var/apache2/templates/set-balancer.php STATIC

echo "Require all granted" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ProxySet lbmethod=byrequests" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "</Proxy>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

echo "<Proxy balancer://dynamic_app>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

        php /var/apache2/templates/set-balancer.php DYNAMIC

echo "Require all granted" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ProxySet lbmethod=byrequests" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "</Proxy>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

#echo "<Location />" >> /etc/apache2/sites-available/001-reverse-proxy.conf
#echo  "ProxyPass balancer://static_app/" >> /etc/apache2/sites-available/001-reverse-proxy.conf
#echo "</Location>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

#echo "<Location /api/kiteplace/>" >> /etc/apache2/sites-available/001-reverse-proxy.conf
#echo "ProxyPass balancer://dynamic_app/api/kiteplace/" >> /etc/apache2/sites-available/001-reverse-proxy.conf
#echo "</Location>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

echo "<Location /balancer-manager>" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "SetHandler balancer-manager" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "</Location>" >> /etc/apache2/sites-available/001-reverse-proxy.conf

echo "ProxyPass /balancer-manager !" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ProxyPass '/' balancer://static_app/" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ProxyPass '/api/kiteplace/' balancer://dynamic_app/" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ProxyPassReverse '/' balancer://static_app/" >> /etc/apache2/sites-available/001-reverse-proxy.conf
echo "ProxyPassReverse '/api/kiteplace/' balancer://dynamic_app/" >> /etc/apache2/sites-available/001-reverse-proxy.conf

echo "</VirtualHost>" >> /etc/apache2/sites-available/001-reverse-proxy.conf