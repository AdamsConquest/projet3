<?php

// charger les variables d'environnement à partir du fichier .env
require_once get_chemin_defaut('.env.php');
charger_env(get_chemin_defaut('.env'));

return [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'popbazar',
    'username' => 'root',
    'password' => ''
];

