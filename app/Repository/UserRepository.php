<?php

namespace WebApp\PHP\MVC\Repository;

use WebApp\PHP\MVC\Domain\User;

class UserRepository
{
  private \PDO $connection;

  public function __construct(\PDO $connection)
  {
    $this->connection = $connection;
  }

  public function save(User $user): User
  {
    $statement = $this->connection->prepare(
      'INSERT INTO Pengguna(IdPengguna, NamaPengguna, Password, NamaDepan, NamaBelakang, NoHp, Alamat, IdAkses) VALUES (?,?,?,?,?,?,?,?)'
    );
    $statement->execute([
      $user->IdPengguna,
      $user->NamaPengguna,
      $user->Password,
      $user->NamaDepan,
      $user->NamaBelakang,
      $user->NoHp,
      $user->Alamat,
      $user->IdAkses,
    ]);
    return $user;
  }

  public function update(User $user): User
  {
    $statement = $this->connection->prepare(
      'UPDATE Pengguna SET NamaPengguna = ?, Password = ?, NamaDepan = ?, NamaBelakang = ?, NoHp = ?, Alamat = ?, IdAkses = ? WHERE IdPengguna = ?'
    );
    $statement->execute([
      $user->NamaPengguna,
      $user->Password,
      $user->NamaDepan,
      $user->NamaBelakang,
      $user->NoHp,
      $user->Alamat,
      $user->IdAkses,
      $user->IdPengguna,
    ]);
    return $user;
  }

  public function findById(string $IdPengguna): ?User
  {
    $statement = $this->connection->prepare(
      'SELECT * FROM Pengguna INNER JOIN HakAkses ON Pengguna.IdAkses = HakAkses.IdAkses WHERE Pengguna.IdPengguna = ?'
    );
    $statement->execute([$IdPengguna]);

    try {
      if ($row = $statement->fetch()) {
        $user = new User();
        $user->IdPengguna = $row['IdPengguna'];
        $user->NamaPengguna = $row['NamaPengguna'];
        $user->Password = $row['Password'];
        $user->NamaDepan = $row['NamaDepan'];
        $user->NamaBelakang = $row['NamaBelakang'];
        $user->NoHp = $row['NoHp'];
        $user->Alamat = $row['Alamat'];
        $user->IdAkses = $row['IdAkses'];
        $user->NamaAkses = $row['NamaAkses'];
        $user->Keterangan = $row['Keterangan'];
        return $user;
      } else {
        return null;
      }
    } finally {
      $statement->closeCursor();
    }
  }

  public function findByUsername(string $NamaPengguna): ?User
  {
    $statement = $this->connection->prepare(
      'SELECT * FROM Pengguna INNER JOIN HakAkses ON Pengguna.IdAkses = HakAkses.IdAkses WHERE Pengguna.NamaPengguna = ?'
    );
    $statement->execute([$NamaPengguna]);

    try {
      if ($row = $statement->fetch()) {
        $user = new User();
        $user->IdPengguna = $row['IdPengguna'];
        $user->NamaPengguna = $row['NamaPengguna'];
        $user->Password = $row['Password'];
        $user->NamaDepan = $row['NamaDepan'];
        $user->NamaBelakang = $row['NamaBelakang'];
        $user->NoHp = $row['NoHp'];
        $user->Alamat = $row['Alamat'];
        $user->IdAkses = $row['IdAkses'];
        $user->NamaAkses = $row['NamaAkses'];
        $user->Keterangan = $row['Keterangan'];
        return $user;
      } else {
        return null;
      }
    } finally {
      $statement->closeCursor();
    }
  }

  public function findAll()
  {
    $statement = $this->connection->prepare('SELECT * from Pengguna');
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
  public function deleteAll(): void
  {
    $this->connection->exec('DELETE from Pengguna');
  }
}