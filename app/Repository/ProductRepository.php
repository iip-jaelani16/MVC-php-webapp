<?php

namespace WebApp\PHP\MVC\Repository;

class ProductRepository
{
  private \PDO $connection;

  public function __construct(\PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAllByUserId(int $IdPengguna, int $IdAccess)
  {
    if ($IdAccess == 1 || $IdAccess == 3) {
      $statement = $this->connection->prepare('SELECT * from Barang');
      $statement->execute();
    } else {
      $statement = $this->connection->prepare(
        'SELECT * from Barang WHERE IdPengguna = ?'
      );
      $statement->execute([$IdPengguna]);
    }

    try {
      if ($row = $statement->fetchAll()) {
        return $row;
      } else {
        return [];
      }
    } finally {
      $statement->closeCursor();
    }
  }
}