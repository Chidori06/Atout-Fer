# Atout-Fer !
*Création d'un site administrateur et application client pour un pressing dans le cadre d'un cas d'entreprise pour la formation Développement Web et Web Mobile de Human Booster.*

## Contexte :
Les clients Bernard et Laetitia sont propriétaires d’un pressing depuis plusieurs années et suite à 
une explosion de la demande, ils souhaitent un logiciel de gestion leur permettant de gérer plus 
facilement les dépôts clients et l’assignation de tâches à leurs employés.  
J’ai pris la décision de réaliser un pressing avec une thématique écologique et avec comme spécialité les animaux et les jeux de mots à base de fer à repasser et de chats.  

## Objectif :
Une plateforme fonctionnelle en deux parties : l’application permettant aux clients de passer 
commande pour déposer leur linge et une administration de gestion (commande, employés, ...). Ils 
demandent que la partie administrateur soit en Symfony, la gestion des données avec une API et 
la partie client sera sur Angular.

### Back-End : 
#### Symfony
Le site de gestion se base sur plusieurs CRUD (Create Read Update Delete).  
L'administrateur peut donc :  
- Ajouter, modifier, supprimer des catégories de vêtements,
- Ajouter, modifier, supprimer des services et prestations du pressing,
- Ajouter des utilisateurs (des employés) et les gérer,
- Gestion des commandes avec un système de statut,
- Visualiser les avis des clients.

Un employé peut quant à lui :
- Créer de nouvelles combinaisons de services et catégories liés,
- Gérer le statut des commandes.


### Front-End :
#### Angular
Le site vitrine pour le pressing qui permet au client :
- S'inscrire et se connecter,
- Accéder à sa page de compte,
- Voir les services,
- Passer commande via le système de dépôt,
- Mettre un avis,
- Voir l'histoire du pressing.

## Eléments à revoir :
Malheureusement, il manque encore des élements qui ne sont pas encore véritablement fonctionnels.  

### Symfony
- Revoir le système de commande et son traitement en back-end.

### API
- Récupération de certaines informations d'utilisateurs comme l'adresse pour le passage des commandes et l'affichage sur le compte utilisateur.

### Angular
- Formulaire de contact ne fonctionne pas,
- Donner son avis avec une page et un formulaire spécial,
- Revoir le système de dépôt de commande,
- Revoir le panier ainsi que la partie de paiement.
