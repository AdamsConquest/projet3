<?php
class Validation
{


  /** 
   * Valider une chaines de caractères avec des règles spécifiques
   * 
   * @param string $champs La chaîne à valider
   * 
   * @return bool true si la chaîne est valide, sinon false
   */
  public static function valider_champs($nom_champs = "champs", $val_champs, $regles = [])
  {

    foreach ($regles as $regle => $valeur) {

      switch ($regle) {
        case 'requis':
          if ($valeur && empty($val_champs)) {
            return "Le {$nom_champs} est requis.";
          }
          break;
        case 'min':
          if (strlen($val_champs) < $valeur) {
            return "Le {$nom_champs} doit contenir au moins {$valeur} caractères.";
          }
          break;
        case 'max':
          if (strlen($val_champs) > $valeur) {
            return "Le {$nom_champs} ne doit pas dépasser {$valeur} caractères.";
          }
          break;
        case 'majuscule':
          if ($valeur && !preg_match('/[A-Z]/', $val_champs)) {
            return "Le {$nom_champs} doit contenir au moins une lettre majuscule.";
          }
          break;
        case 'chiffre':
          if ($valeur && !preg_match('/\d/', $val_champs)) {
            return "Le {$nom_champs} doit contenir au moins un chiffre.";
          }
          break;
        case 'special':
          if ($valeur && !preg_match('/[\W_]/', $val_champs)) {
            return "Le {$val_champs} doit contenir au moins un caractère spécial.";
          }
          break;
        default:
          return "Règle de validation inconnue : {$regle}.";
      }
    }
    return true;
  }

  /**
   * Valider le email
   *
   * @param string $email L'email à valider
   * @return bool true si l'email est valide, sinon false
   */


  public static function valider_email($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }


  /**
   * Test si deux chaines sont identiques
   * 
   * @param string $champs1 La première chaîne
   * @param string $champs2 La deuxième chaîne
   * 
   * @return bool true si les chaînes sont identiques, sinon false
   */
  public static function comparer_chaines($champs1, $champs2)
  {
    return $champs1 === $champs2;
  }
}
