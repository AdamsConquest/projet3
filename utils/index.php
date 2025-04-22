<?php

/**
 * Fonctions utilitaires pour l' application
 */


/**
 * retourne le chemin d'accès absolu à un fichier
 *
 * @param string $fichier le nom du fichier
 *
 * @return string le chemin d'accès absolu au fichier 
 */
function get_chemin_defaut($fichier)
{
  return __DIR__ . "/../$fichier";
}

/**
 * charge une vue specifique si elle existem sinon affiche un message d'erreur
 * 
 * @param string $vue le nom de la vue à charger
 * @return void 
 */
function chargerVue($vue, $donnees = [])
{
  $cheminVue = get_chemin_defaut("views/{$vue}.view.php");

  // on extrait les données du tableau associatif pour les rendre accessibles dans la vue
  extract($donnees);
  if (file_exists($cheminVue)) {
    require_once $cheminVue;
  } else {
    echo ("La vue {$vue} n'existe pas.");
  }
}

/**
 * charge une vue partielle si elle existem sinon affiche un message d'erreur
 * 
 * @param string $vue le nom de la vue partielle à charger
 * @return void 
 */
function chargerVuePartielle($vue, $titre = '', $donnees = [])
{
  // on extrait les données du tableau associatif pour les rendre accessibles dans la vue
  extract($donnees);
  $titre = $titre ?: "Titre par défaut"; // Titre par défaut si non spécifié
  // chemin vers la vue partielle
  $cheminVue = get_chemin_defaut("views/partials/{$vue}.php");

  if (file_exists($cheminVue)) {
    require_once $cheminVue;
  } else {
    echo ("La vue partielle {$vue} n'existe pas.");
  }
}

/**
 * Faire un dump d'une variable formattée pour le debug
 * 
 * @param mixed $var la variable à afficher
 * @param bool $die si true, arrête l'exécution du script
 * @return void
 */
function inspecter($var, $message = '', $die = false)
{
  echo "<span style='color: red'>Inspecter {$message}:</span>";
  echo "<pre>";
  var_dump($var);
  echo "</pre>";
  if ($die) {
    die();
  }
}

/**
 * Obtenir un paramètre de la requête GET ou POST de manière sécurisée
 * 
 * @param string $identifiant le nom du paramètre à obtenir
 * @return mixed la valeur du paramètre ou null si le paramètre n'existe pas
 */

function obtenirParametre($identifiant)
{
  $parametre = filter_input(INPUT_GET, $identifiant, FILTER_SANITIZE_SPECIAL_CHARS);
  if ($parametre === null) {
    $parametre = filter_input(INPUT_POST, $identifiant, FILTER_SANITIZE_SPECIAL_CHARS);
  }

  return $parametre;
}

/**
 * Génère un tableau de paramètres pour une requête SQL
 * 
 * @param array $donnees Les données à inclure dans la requête
 * @return array Le tableau de paramètres
 */
function generer_params($donnees)
{
  $params = [];
  foreach ($donnees as $cle => $valeur) {
    $params[":$cle"] = $valeur;
  }
  return $params;
}

/**
 * Filtre et nettoie une chaîne de caractères
 * 
 * @param string $champs La chaîne à filtrer
 * @return string La chaîne filtrée et nettoyée
 */
function sanitize($champs)
{
  return filter_var(trim($champs), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Filtre et nettoie les données du formulaire
 * 
 * @param array $champs_autorises Les champs autorisés dans le formulaire
 * @return array Les données filtrées et nettoyées
 */
function filtrer_et_nettoyer_formulaire($champs_autorises)
{
  $donnees = array_intersect_key($_POST, array_flip($champs_autorises));
  return array_map(function ($valeur) {
    $valeur = sanitize($valeur);
    return $valeur === "" ? null : $valeur;
  }, $donnees);
}

/**
 * Convertit une date au format "il y a X" en une chaîne de caractères lisible
 * 
 * @param string $date La date à convertir
 * @return string La chaîne de caractères formatée
 */
function il_y_a($date)
{
  $maintenant = new DateTime();
  $date_cible = new DateTime($date);
  $diff = $maintenant->diff($date_cible);

  if ($diff->y > 0) return "il y a {$diff->y} an" . ($diff->y > 1 ? "s" : "");
  if ($diff->m > 0) return "il y a {$diff->m} mois";
  if ($diff->d > 0) return "il y a {$diff->d} jour" . ($diff->d > 1 ? "s" : "");
  if ($diff->h > 0) return "il y a {$diff->h} heure" . ($diff->h > 1 ? "s" : "");
  if ($diff->i > 0) return "il y a {$diff->i} minute" . ($diff->i > 1 ? "s" : "");

  return "il y a quelques secondes";
}

/**
 * Formate une date au format "Membre depuis mois année"
 * 
 * @param string $date La date à formater
 * @return string La chaîne de caractères formatée
 */
function membre_depuis(string $date): string
{
  $date_objet = new DateTime($date);

  // Définir le formateur avec locale française
  $formatter = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::LONG,
    IntlDateFormatter::NONE,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    'LLLL yyyy' // Exemple : janvier 2024
  );

  $mois_annee = $formatter->format($date_objet);

  return "Membre depuis $mois_annee";
}

/**
 * Obtenir le nom de la catégorie à partir de son ID
 * 
 * @param int $id_categorie L'ID de la catégorie
 * 
 * @return string Le nom de la catégorie
 * @throws Exception Si l'ID de la catégorie n'existe pas
 */

function obtenir_nom_categorie($id_categorie)
{
  $categories = [
    1 => "Jeux vidéo",
    2 => "Super-héros",
    3 => "Films cultes",
    4 => "Séries TV",
  ];

  if (!isset($categories[$id_categorie])) {
    return "Catégorie inconnue";
  }
  // Retourne le nom de la catégorie correspondante  
  return $categories[$id_categorie];
}

/**
 * Redirige vers une URL spécifiée
 * 
 * @param string $url L'URL vers laquelle rediriger
 * @return void
 */

function redirect($url)
{
  header("Location: $url");
  exit();
}