# REST et l'architecture MVC

Dans une architecture MVC RESTful, les routes dirigent la requête vers une méthode du contrôleur, selon :

- Le verbe HTTP (GET, POST, PUT, DELETE)
- L’URL appelée
- La ressource visée (ex. annonces)

## Correspondance REST et Méthodes de Contrôleur (MVC)

| Objectif                           | Méthode HTTP    | URL REST                | Méthode du contrôleur |
| ---------------------------------- | --------------- | ----------------------- | --------------------- |
| Voir toutes les annonces           | `GET`           | `/annonces`             | `index()`             |
| Voir une annonce précise           | `GET`           | `/annonces/42`          | `afficher($id)`       |
| Afficher le formulaire de création | `GET`           | `/annonces/ajouter`     | `ajouter()`           |
| Soumettre une nouvelle annonce     | `POST`          | `/annonces`             | `creer()`             |
| Afficher le formulaire de modif.   | `GET`           | `/annonces/42/modifier` | `modifier($id)`       |
| Soumettre les modifications        | `POST` ou `PUT` | `/annonces/42`          | `mettre_a_jour($id)`  |
| Supprimer une annonce              | `POST`        | `/annonces/42/supprimer`          | `supprimer($id)`      |
