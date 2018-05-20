# Chargement du module nodejs
FROM node:8.11.1

#Permet de mettre à jour et d'installer Nano
RUN apt-get update && apt-get install -y nano

# Permet de copier notre appli
COPY src /opt/app

# Permet de donner une commande à lancer quand le container est lancé
# ici on lance le script index.js à chaque fois
CMD ["node", "/opt/app/index.js"]