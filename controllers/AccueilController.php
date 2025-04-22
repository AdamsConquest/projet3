<?php

/**
 * Controller de la page d'accueil
 * 
 */

class AccueilController
{


  public function index()
  {

    chargerVue("accueil", [
      "titre" => "Accueil",
    ]);
  }
}
