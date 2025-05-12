<?php

// charger les variables d'environnement à partir du fichier .env
require_once get_chemin_defaut('.env.php');
charger_env(get_chemin_defaut('.env')); 

return [
  "host" => getenv('DB_HOST'),
  "port" => getenv('DB_PORT'),
  "dbname" => getenv('DB_NAME'),
  "username" => getenv('DB_USER'),
  "password" => getenv('DB_PASSWORD'),
];
