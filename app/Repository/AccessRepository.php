<?php

namespace WebApp\PHP\MVC\Repository;

use WebApp\PHP\MVC\Domain\Access;

class AccessRepository
{
  private \PDO $connection;

  public function __construct(\PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAllAccess()
  {
    $statement = $this->connection->prepare('SELECT * from HakAkses');
    $statement->execute();
    try {
      if ($row = $statement->fetchAll()) {
        return $row;
      } else {
        return null;
      }
    } finally {
      $statement->closeCursor();
    }
  }
}