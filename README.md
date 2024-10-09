# Forum PHP

## Description
Ce projet est une application de forum en PHP permettant aux utilisateurs de créer, gérer et participer à des discussions sur différents sujets. L'application comporte des fonctionnalités de gestion des utilisateurs, de création de topics, et de gestion des posts.

## Fonctionnalités principales

- **Inscription / Connexion / Déconnexion :** Les utilisateurs peuvent s'inscrire, se connecter et se déconnecter.
- **Gestion des Topics :** Les utilisateurs peuvent créer de nouveaux topics, les verrouiller ou les déverrouiller s'ils en sont les auteurs ou si ce sont des administrateurs.
- **Gestion des Posts :** Possibilité d'ajouter, d'afficher et de lister les posts dans les topics.
- **Restriction d'accès :** Les actions telles que la création de topics et de posts sont réservées aux utilisateurs connectés.
- **Page de profil :** Les utilisateurs peuvent consulter leur profil et supprimer leur compte.
- **Anonymisation des données :** Lorsqu'un utilisateur supprime son compte, ses posts et topics restent visibles mais sont rendus anonymes.
- **Gestion par un administrateur :** Les administrateurs ont la possibilité de bannir ou de débannir des utilisateurs, et de gérer les topics et posts.

## Framework Privé - Elan

L'application repose sur un **framework privé** appelé **Elan**, qui est utilisé pour structurer le projet. Les fichiers situés dans le dossier `App` sont au cœur de ce framework et offrent des fonctionnalités telles que :

- **Autoloader :** Pour le chargement automatique des classes.
- **DAO (Data Access Object) :** Pour la communication avec la base de données.
- **AbstractController :** Gère la logique partagée entre les différents contrôleurs de l'application.
- **Manager :** Classe générique pour la gestion des entités et interactions avec la base de données.
- **Session :** Gère la session utilisateur et les autorisations.
