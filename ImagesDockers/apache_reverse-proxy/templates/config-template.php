<?php 
	$DYNAMIC_APP="DYNAMIC_APP";
    $STATIC_APP="STATIC_APP";
    $tab = shell_exec("printenv | grep APP");
    $tableau = explode("\n", $tab);
    foreach($tableau as $name){
            if(strlen($name)>1){
                    if(strpos($name, $STATIC_APP) !== false){
                            echo "static: " . "$name\n";
                            system('cat $name >> /etc/apache2/sites-available/001-reverse-proxy.conf');
                    }
                    else if(strpos($name, $DYNAMIC_APP) !== false){
                            echo "dynamic: " . "$name\n";
                            system('cat $name >> /etc/apache2/sites-available/001-reverse-proxy.conf');
                    }
            }
    }
?>

<VirtualHost *:80>
#Défini notre nom de domaine
	ServerName www.reverse-proxy.res.ch
<Proxy "balancer://static">
	BalanceMember "http://<"
# Partie dynamique => Kite
	# Permet de traiter quand on arrive
	ProxyPass '/api/kiteplace/' 'http://<?php print "$dynamic_app"?>/' 

	# Permet de traiter quand on repart (typiquement la réponse)
	ProxyPassReverse '/api/kiteplace/' 'http://<?php print "$dynamic_app"?>/'

# Permet de spécifier le cas par défaut
	ProxyPass '/' 'http://<?php print "$static_app"?>/'
	ProxyPassReverse '/' 'http://<?php print "$static_app"?>/'

</VirtualHost>