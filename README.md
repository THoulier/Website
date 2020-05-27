Projet IT103-Team LG(B)T
Membres: Gabriel Berger, Thomas Houlier, Leïla Bouidra

Processus d'installation:

Il faut se rendre à l'adresse install.php située à la racine du projet. Le fichier contient un script qui va créer la base de donnée avec toutes les tables nécessaires au bon fonctionnement du site.

Trois tables seront implémentées:
    -Utilisateur: contient les informations relatives aux utilisateurs du site.
    -Amis: contient les relations d'amitiés entre utilisateurs.
    -Transactions: contient les transactions entre utilisateurs.

Deux utilisateurs seront créés initialement:
    -ID:1 	Mail:gabriel.berger98@gmail.com 	MdP:Blabla 	Nom:Berger 	Prenom:Gabriel 	Date de naissance:1998-04-15 	Pseudo:Gaby
    -ID:2 	Mail:tester@gmail.com 	MdP:mdp 	NomTester 	Prenom:Gmail 	:Date de naissance:2000-01-01 	Pseudo:User

Quatre transactions seront créées par defaut:
    -ID:1 	Message explicatif:Vacances 	Utilisateur source:1 	Utilisateur cible:2 	Montant:123.5 	Date de création:2020-05-06 	Statut:ouverte
	-ID:2 	Message explicatif:BBQ 	Utilisateur source:2 	Utilisateur cible:1 	Montant:22.33 	Date de création:2020-04-12     Statut:ouverte
	-ID:3 	Message explicatif:Mcdo 	Utilisateur source:1 	Utilisateur cible:2 	Montant:9.1 	Date de création:2020-04-23 	Statut:ouverte
	-ID:4 	Message explicatif:Courses 	Utilisateur source:2 	Utilisateur cible:1 	Montant:85.3 	Date de création:2020-03-06     Statut:fermée	Date de fermeture:2020-05-06 	Message de fermeture:virement le 12

Pour se rendre à la page d'accueil du site, rendez-vous à l'adresse index.php

La documentation se trouve dans le dossier Autre
