<?php
/**
 * Contrôleur d'erreur qui gère les erreurs 404
 */

class ErreurController
{

  //méthode statique pour afficher les erreurs
  public static function introuvable($message = "La page que vous recherchez n'existe pas.")
  {
    http_response_code(404);
    // charger la vue d'erreur
    chargerVue("erreur", [
      "titre" => "Erreur 404",
      "statut" => "404",
      "message" => $message,
    ]);
  }

}
