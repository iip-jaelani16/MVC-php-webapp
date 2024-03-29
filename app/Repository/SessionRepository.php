<?php

namespace WebApp\PHP\MVC\Repository;

use WebApp\PHP\MVC\Domain\Session;

class SessionRepository
{
  private \PDO $connection;

  public function __construct(\PDO $connection)
  {
    $this->connection = $connection;
  }

  public function save(Session $session): Session
  {
    $statement = $this->connection->prepare(
      'INSERT INTO sessions(id, IdPengguna) VALUES (?, ?)'
    );
    $statement->execute([$session->id, $session->userId]);
    return $session;
  }

  public function findById(string $id): ?Session
  {
    $statement = $this->connection->prepare(
      'SELECT id, IdPengguna from sessions WHERE id = ?'
    );
    $statement->execute([$id]);

    try {
      if ($row = $statement->fetch()) {
        $session = new Session();
        $session->id = $row['id'];
        $session->userId = $row['IdPengguna'];
        return $session;
      } else {
        return null;
      }
    } finally {
      $statement->closeCursor();
    }
  }

  public function deleteById(string $id): void
  {
    $statement = $this->connection->prepare(
      'DELETE FROM sessions WHERE id = ?'
    );
    $statement->execute([$id]);
  }

  public function deleteAll(): void
  {
    $this->connection->exec('DELETE FROM sessions');
  }
}