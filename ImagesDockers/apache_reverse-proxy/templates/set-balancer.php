<?php

        if($argc > 1){
                echo "second arg: " . "$argv[1]";
        }
        $file = '/etc/apache2/sites-available/001-reverse-proxy.conf';
        echo "try to get env variables\n";
        $tab = shell_exec("printenv | grep APP");
        #echo "$tab";
        $tableau = explode("\n", $tab);
        foreach($tableau as $name){
                if(strlen($name)>1){
                        if(strpos($name, $argv[1]) !== false){
                                $file = '/etc/apache2/sites-available/001-reverse-proxy.conf';
                                $name = exec ("echo $name | cut -d '=' -f2");
                                /*if(strpos($argv[1], 'STATIC') !== false){
                                        file_put_contents($file, "ProxyPassReverse '/' http://" . $name . "/\n", FILE_APPEND);
                                }
                                else if(strpos($argv[1], 'DYNAMIC') !== false){
                                        file_put_contents($file, "ProxyPassReverse '/api/kiteplace/' http://" . $name . "/api/kiteplace/\n", FILE_APPEND);
                                }*/
                                $name = "BalancerMember http://" . $name . "\n";
                                #echo "[" . "$name" ."]\n";
                                file_put_contents($file, $name, FILE_APPEND | LOCK_EX);
                        }
                        else if(strpos($name, $DYNAMIC_APP) !== false){
                                echo "[" . "$name" . "]\n";
                                shell_exec("echo $name >> /etc/apache2/sites-available/001-reverse-proxy.conf");
                        }
                }
        }
?> 