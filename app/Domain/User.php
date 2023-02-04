<?php

namespace WebApp\PHP\MVC\Domain;

class User
{
  public string $IdPengguna;
  public string $NamaPengguna;
  public string $Password;
  public string $NamaDepan;
  public string $NamaBelakang;
  public string $NoHp;
  public string $Alamat;
  public string $IdAkses;
  public ?string $NamaAkses = null;
  public ?string $Keterangan = null;
}