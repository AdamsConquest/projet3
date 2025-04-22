<?php

/**
 * Charger les variables d'environnement à partir d'un fichier .env
 *
 * @param string $chemin Chemin vers le fichier .env
 * @return void
 */

 function charger_env($chemin)
 {
   if (!file_exists($chemin)) return;
 
   $lignes = file($chemin, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
   foreach ($lignes as $ligne) {
     $ligne = trim($ligne);
 
     if ($ligne === '' || substr($ligne, 0, 1) === '#') continue;
 
     if (strpos($ligne, '=') !== false) {
       list($cle, $valeur) = explode('=', $ligne, 2);
       putenv(trim($cle) . '=' . trim($valeur));
     }
   }
 }
 
