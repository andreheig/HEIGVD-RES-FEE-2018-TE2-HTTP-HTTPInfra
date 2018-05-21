<?php 
	$static_app = getenv('STATIC_APP');
	$dynamic_app = getenv('DYNAMIC_APP');
?>

<VirtualHost *:80>
#Défini notre nom de domaine
	ServerName www.reverse-proxy.res.ch

# Partie dynamique => Kite
	# Permet de traiter quand on arrive
	ProxyPass '/api/kiteplace/' 'http://<?php print "$dynamic_app"?>/' 

	# Permet de traiter quand on repart (typiquement la réponse)
	ProxyPassReverse '/api/kiteplace/' 'http://<?php print "$dynamic_app"?>/'

# Permet de spécifier le cas par défaut
	ProxyPass '/' 'http://<?php print "$static_app"?>/'
	ProxyPassReverse '/' 'http://<?php print "$static_app"?>/'

</VirtualHost>