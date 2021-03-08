# Projet d'une sonde météorologique

### Introduction
- Ce projet m'a été donné par mon centre de formation, le CESI.
- L'API est en PHP et JSON
- Le tout a été dévelopé sur MAMP donc l'API se trouve sur le même serveur que l'application pour le moment.

Tout ce qui se trouve actuellement sur cette page est la partie que j'ai développé par moi-même. [Le projet avance actuellement en groupe ici.](https://github.com/CESIDI20G2/projet)

### Présentation du projet

Dans ce projet, nous devons concevoir un système de collecte de données météorologique qui s'articulera autour d'une API Rest. Nous devons :

- Avoir une application web de visualisation des données
- Avoir un prototype fonctionnel d’une sonde
- Avoir un serveur de collecte des données

Nous allons aussi concevoir une sonde à l'aide de la liste de matériel suivante :

- ESP8266 (ESP-01 ou ESP-01S) : micro-contrôleur wifi avec 1Mo (ou 4Mo pour les versions les plus récentes) de mémoire flash
- GY-21 HTU21 : capteur de température
- Ecran type I2C SSD1306 : écran LCD (pourra être raccordé au serveur ou à la sonde afin d’afficher le(s) dernier(s) relevé(s)
- CP2102 ou CP2104 ou CH340 : convertisseur série USB pour programmer/flasher le micro-contrôleur ESP
- Raspberry Pi Zero WH (ou supérieur), sa carte SD et son alimentation : serveur équipé de Raspberry Pi OS Lite (sans GUI)
- Breadboard, alimentation du breadboard et cable dupont : matériel pour prototypage
- Salle équipée d'un réseau wifi "neutre" type domestique (idéalement sans portail captif) ou possibilité d’alternative via partage de connexion 4G/wifi

Cette sonde enverra des données (température, humidité, alimentation) à une base de donnée, elle sera programmée avec un langage de notre choix compatible avec un ESP, le capteur fera des relevés toutes les quelques secondes afin de réaliser une moyenne d’au moins 5 relevés.

- L’application doit disposer d’une interface web responsive consultable à travers un simple navigateur, inclure un graphique des données température/humidité, un pictogramme ou code couleur pour déduire à partir des données la météo actuelle.


Lorsque la sonde sera monté, on utilisera un serveur Raspberry qui :

- hébergera le serveur web
- hébergera le SGBDR correctement configuré
- sera administrable via SSH
- hébergera l’API
- disposera d’un écran afin d’afficher : son adresse IP, la date et heure, et fera défiler les derniers relevés des sondes
La base de données ne sera accessible qu’à travers l’API

