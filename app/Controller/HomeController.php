<?php

namespace WebApp\PHP\MVC\Controller;

use WebApp\PHP\MVC\App\View;
use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Repository\AccessRepository;
use WebApp\PHP\MVC\Repository\SessionRepository;
use WebApp\PHP\MVC\Repository\UserRepository;
use WebApp\PHP\MVC\Service\AccessService;
use WebApp\PHP\MVC\Service\SessionService;
use WebApp\PHP\MVC\Service\UserService;

class HomeController
{
  private SessionService $sessionService;
  private AccessService $accessService;
  private UserService $userService;

  public function __construct()
  {
    $connection = Database::getConnection();
    $sessionRepository = new SessionRepository($connection);
    $userRepository = new UserRepository($connection);
    $accessRepository = new AccessRepository($connection);
    $userRepository = new UserRepository($connection);
    $this->accessService = new AccessService($accessRepository);
    $this->userService = new UserService($userRepository);

    $this->sessionService = new SessionService(
      $sessionRepository,
      $userRepository
    );
  }

  function index()
  {
    $user = $this->sessionService->current();
    $accessList = $this->accessService->getAccessList();
    if ($user == null) {
      View::render('User/login', [
        'title' => 'Login',
        'accessList' => $accessList->access,
      ]);
    } else {
      View::render('Home/dashboard', [
        'title' => 'Dashboard',
        'user' => [
          'name' => $user->NamaPengguna,
        ],
        'access' => [
          'description' => $user->Keterangan,
          'accessId' => (int) $user->IdAkses,
        ],
      ]);
    }
  }
}