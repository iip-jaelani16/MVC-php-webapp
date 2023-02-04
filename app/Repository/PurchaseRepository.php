<?php

namespace WebApp\PHP\MVC\Repository;

class PurchaseRepository
{
  private \PDO $connection;

  public function __construct(\PDO $connection)
  {
    $this->connection = $connection;
  }

  public function findAllByUserId(int $IdPengguna, int $IdAccess)
  {
    if ($IdAccess == 1) {
      $statement = $this->connection->prepare('SELECT * from Pembelian');
      $statement->execute();
    } else {
      $statement = $this->connection->prepare(
        'SELECT * from Pembelian WHERE IdPengguna = ?'
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