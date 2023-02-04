<?php

namespace WebApp\PHP\MVC\Controller;

use WebApp\PHP\MVC\App\View;
use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Exception\ValidationException;
use WebApp\PHP\MVC\Model\UserLoginRequest;
use WebApp\PHP\MVC\Repository\AccessRepository;
use WebApp\PHP\MVC\Repository\SessionRepository;
use WebApp\PHP\MVC\Repository\UserRepository;
use WebApp\PHP\MVC\Service\AccessService;
use WebApp\PHP\MVC\Service\SessionService;
use WebApp\PHP\MVC\Service\UserService;

class UserController
{
  private UserService $userService;
  private SessionService $sessionService;
  private AccessService $accessService;
  public function __construct()
  {
    $connection = Database::getConnection();
    $userRepository = new UserRepository($connection);
    $this->userService = new UserService($userRepository);
    $accessRepository = new AccessRepository($connection);
    $this->accessService = new AccessService($accessRepository);
    $sessionRepository = new SessionRepository($connection);
    $this->sessionService = new SessionService(
      $sessionRepository,
      $userRepository
    );
  }

  public function login()
  {
    $accessList = $this->accessService->getAccessList();

    View::render('User/login', [
      'title' => 'Login',
      'accessList' => $accessList->access,
    ]);
  }

  public function postLogin()
  {
    $request = new UserLoginRequest();
    $request->NamaPengguna = $_POST['NamaPengguna'];
    $request->Password = $_POST['Password'];
    // $request->IdAkses = $_POST['IdAkses'];
    $accessList = $this->accessService->getAccessList();
    try {
      $response = $this->userService->login($request);
      $this->sessionService->create($response->user->IdPengguna);
      View::redirect('/');
    } catch (ValidationException $exception) {
      View::render('User/login', [
        'title' => 'Login user',
        'error' => $exception->getMessage(),
        'accessList' => $accessList->access,
      ]);
    }
  }

  public function logout()
  {
    $this->sessionService->destroy();
    View::redirect('/');
  }

  public function usersList()
  {
    $user = $this->sessionService->current();
    $users = $this->userService->getAllUser();
    $accessList = $this->accessService->getAccessList();

    if ($user === null) {
      View::render('User/login', [
        'title' => 'Login',
        'accessList' => $accessList->access,
      ]);
    } else {
      View::render('User/user_list', [
        'title' => 'List User',
        'user' => [
          'name' => $user->NamaPengguna,
        ],
        'users' => $users->users,
        'access' => [
          'description' => $user->Keterangan,
          'accessId' => (int) $user->IdAkses,
        ],
      ]);
    }
  }
}