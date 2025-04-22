<?php

/**
 * Classe Session
 * classe utilitaire qui gère les sessions
 * 
 */


class Session

/**
 * Demarre la session si elle n'est pas déjà démarrée
 * 
 */
{
  public static function demarrer()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }

  /**
   * Ajoute une valeur à la session
   * 
   */
  public static function set($cle, $valeur)
  {
    $_SESSION[$cle] = $valeur;
  }

  /**
   * Supprime la session si elle existe
   * 
   */

  public static function detruire()
  {
    if (session_status() == PHP_SESSION_ACTIVE) {
      session_unset();
      session_destroy();
    }
  }

  /**
   * Vérifie si l'utilisateur est connecté  
   * @return bool true si l'utilisateur est connecté, sinon false
   */
  public static function est_connecte()
  {
    return isset($_SESSION['id_utilisateur']);
  }

  /**
   * Vérifie si l'utilisateur est connecté et le redirige vers la page de connexion s'il ne l'est pas
   * 
   * @return void
   */
  public static function est_autorise($role = "visiteur")
  {
    if ($role === "autorise" && !self::est_connecte()) {
      return redirect("/connexion");
    } 
  }

  /**
   * Vérifie si l'utilisateur est dejà connecté et le redirige vers la page d'accueil s'il l'est
   * 
   */
  public static function deja_connecte()
  {
    if (self::est_connecte()) {
      return redirect("/");
    }
  }


  /**
   * Recupère l'ID de l'utilisateur connecté
   * 
   * @return int|null l'ID de l'utilisateur ou null si non connecté
   */
  public static function obtenir_id_utilisateur()
  {
    return $_SESSION["id_utilisateur"]["id"] ?? null;
  }


  /**
   * Recupère le nom de l'utilisateur connecté
   * 
   * @return string|null le nom de l'utilisateur ou null si non connecté
   */
  public static function obtenir_nom_utilisateur()
  {
    return $_SESSION["id_utilisateur"]['nom_utilisateur'] ?? null;
  }

  /**
   * Recupère le email de l'utilisateur connecté
   * 
   * @return string|null le prénom de l'utilisateur ou null si non connecté   
   */
  public static function obtenir_email_utilisateur()
  {
    return $_SESSION["id_utilisateur"]['email'] ?? null;
  }

  /**
   * Recupère le nom de l'utilisateur connecté
   * 
   * @return string|null le nom de l'utilisateur ou null si non connecté
   */
  public static function obtenir_nom()
  {
    return $_SESSION["id_utilisateur"]['nom'] ?? null;
  }

  /**
   * Recupère le prénom de l'utilisateur connecté
   * 
   * @return string|null le prénom de l'utilisateur ou null si non connecté
   */
  public static function obtenir_prenom()
  {
    return $_SESSION["id_utilisateur"]['prenom'] ?? null;
  }

  /**
   * Recupère la valeur d'une clé de session
   * 
   * @return string|null la valeur de la clé ou null si la clé n'existe pas
   */
  public static function get($cle)
  {
    return $_SESSION[$cle] ?? null;
  }

  /**
   * Supprime une clé de session
   * 
   */
  public static function clear($cle)
  {
    if (isset($_SESSION[$cle])) {
      unset($_SESSION[$cle]);
    }
  }

  /**
   * Ajoute un message flash à la session
   * 
   * @return void
   */
  public static function set_flash($message, $type = 'success')
  {
    $_SESSION['flash'] = [
      'message' => $message,
      'type' => $type
    ];
  }
}
