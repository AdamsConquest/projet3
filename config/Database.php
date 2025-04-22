<?php

class Database
{
  public $connection;


  public function __construct($config)
  {

    // Créer la chaine de connexion à la base de données
    $chaine_connexion = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";


    // Sert à gérer les erreurs de PDO
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    // echo "Connexion à la base de données : {$config['host']}:{$config['port']}<br>";
    // echo "Nom de la base de données : {$config['dbname']}<br>";
    try {
      $this->connection = new PDO($chaine_connexion, $config["username"], $config["password"], $options);
    } catch (PDOException $e) {
      echo "Erreur de connexion à la base de données : " . $e->getMessage();
      exit;
    }
  }

  /** 
   * Exécute une requête SQL
   * 
   * Au lieu de passer les params dans execute(), on les passe dans bindValue() pour controler le type de chaque paramètre.
   * Ce qui est necessaire pour LIMIT et OFFSET (pagination)
   * 
   * @param string $sql
   * 
   * @return PDOStatement
   * @throws PDOException
   */
  public function requete($sql, $params = [])
  {
    try {
      $stmt = $this->connection->prepare($sql);

      foreach ($params as $cle => $valeur) {
        $type = is_int($valeur) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue($cle, $valeur, $type);
      }

      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
  }

  public function dernier_id_insere()
  {
    return $this->connection->lastInsertId();
  }
}
