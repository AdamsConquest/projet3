<?php

require_once get_chemin_defaut("controllers/ErreurController.php");

/**
 * classe Routeur qui gère les routes de l'application
 * 
 */

class Routeur
{

  private $routes = [];

  /**
   * Ajoute une route à la liste des routes
   * 
   * @param string $method
   * @param string $uri
   * @param string $action
   * 
   * @return void
   */
  public function creerRoute($http_method, $uri, $action)
  {

    list($controller, $controller_method) = explode("@", $action);


    $this->routes[] = [
      "http_method" => $http_method,
      "uri" => $uri,
      "controller" => $controller,
      "controller_method" => $controller_method,
    ];
  }

  /** 
   * Ajoute une route GET
   * 
   * @param string $uri
   * @param string $controller
   * 
   * @return void
   */

  public function get($uri, $controller)
  {
    $this->creerRoute("GET", $uri, $controller);
  }

  /** 
   * Ajoute une route POST
   * 
   * @param string $uri
   * @param string $controller
   * 
   * @return void
   */

  public function post($uri, $controller)
  {
    $this->creerRoute("POST", $uri, $controller);
  }

  /** 
   * Ajoute une route PUT
   * 
   * @param string $uri
   * @param string $controller
   * 
   * @return void
   */

  public function put($uri, $controller)
  {
    $this->creerRoute("PUT", $uri, $controller);
  }

  /** 
   * Ajoute une route DELETE
   * 
   * @param string $uri
   * @param string $controller
   * 
   * @return void
   */

  public function delete($uri, $controller)
  {
    $this->creerRoute("DELETE", $uri, $controller);
  }


  /**
   * Traite la requête en fonction de la méthode et de l'URI
   * 
   * @param string $method
   * @param string $uri
   * 
   * @return void
   */
  public function route($uri)
  {
    $http_method = $_SERVER['REQUEST_METHOD'];

    // Extraction uniquement du chemin (retire les query strings)
    $uri_path = parse_url($uri, PHP_URL_PATH);
    $sections_uri = explode("/", trim($uri_path, "/"));

    $params = [];

    foreach ($this->routes as $route) {
      $sections_route = explode("/", trim($route["uri"], "/"));
      $match = true;

      if (
        count($sections_uri) === count($sections_route) &&
        strtoupper($route["http_method"]) === strtoupper($http_method)
      ) {

        foreach ($sections_uri as $index => $section) {
          if (
            $sections_route[$index] !== $section &&
            !preg_match('/\{(.+?)\}/', $sections_route[$index])
          ) {
            $match = false;
            break;
          }

          if (preg_match('/\{(.+?)\}/', $sections_route[$index], $matches)) {
            $params[$matches[1]] = $section;
          }
        }

        if ($match) {

          // Appeler le contrôleur correspondant sous le namespace App\Controllers
          // et la méthode du controleur correspondante


          $controller = $route["controller"];
          $controller_method = $route["controller_method"];

          // inspecter($controller_method, "controller_method", true);

          // instancier le contrôleur et appeler la méthode correspondante
          require_once get_chemin_defaut("controllers/{$controller}.php");
          $instance_controller = new $controller();
          $instance_controller->$controller_method($params);

          //   return;

          return;
        }
      }
    }

    // Si aucune route ne correspond
    ErreurController::introuvable();
  }
}
