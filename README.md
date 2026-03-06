# Space Tourism Dashboard

Bienvenue sur le tableau de bord de l'application **Space Tourism**. Ce projet permet de gérer une agence de voyage spatial, incluant la création de destinations et la gestion des réservations clients.
La racine de mon projet est le fichier initial, l'index.php est donc accessible à cet url : http://127.0.0.1:`[port]`/ .

## Fonctionnalités

Le tableau de bord permet aux administrateurs d'effectuer les actions suivantes via l'interface d'administration :

*   **Gestion des Produits (Voyages)** : Ajout de nouvelles destinations avec les détails suivants :
    *   Nom de la destination (ex: Moon, Titan)
    *   Illustration
    *   Date de départ
    *   Capacité maximale de passagers
    *   Prix
*   **Gestion des Réservations** : Association d'un utilisateur à un voyage spécifique.
*   **Utilisateurs** : Gestion des comptes (Admin et utilisateurs standards).

## Installation

1.  **Base de données** :
    *   Créez une base de données nommée `space`.
    *   Importez le fichier `base.sql` situé à la racine du projet. Ce fichier contient la structure des tables (`product`, `user`, `reservation`) ainsi que des données de démonstration (voyages vers la Lune, Titan, Jupiter, Mars).

## Structure du Projet

*   `/admin` : Contient la logique d'administration (ex: `function.php` pour le traitement des formulaires d'ajout).
*   `base.sql` : Script de création et d'initialisation de la base de données.
*   Les fichiers commençant par `handle`servent à la suppression et la modification des données.
*   `/classes`: Contient toutes les classes de mon code, ainsi que toutes les méthodes relatives du dashboard
*   Le reste des fichiers servent à l'affichage des pages, que ce soit celle d'accueil, celles pour les utilisateurs standards ou encore pour gérer la connexion. 
