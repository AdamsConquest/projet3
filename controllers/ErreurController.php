<?php
/**
 * Contrôleur d'erreur qui gère les erreurs 404.
 */
class ErreurController
{
  /**
   * Méthode statique qui affiche une page d’erreur 404 personnalisée.
   *
   * @param string $message Message à afficher à l’utilisateur
   * @return void
   */
  public static function introuvable($message = "La page que vous recherchez n'existe pas.")
  {
    http_response_code(404);

    chargerVue("erreur", [
      "titre" => "Erreur 404",
      "statut" => "404",
      "message" => $message,
    ]);
  }
}
