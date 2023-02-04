<?php

namespace WebApp\PHP\MVC\Controller;

use WebApp\PHP\MVC\App\View;
use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Exception\ValidationException;
use WebApp\PHP\MVC\Model\UserLoginRequest;
use WebApp\PHP\MVC\Model\UserPasswordUpdateRequest;
use WebApp\PHP\MVC\Model\UserProfileUpdateRequest;
use WebApp\PHP\MVC\Model\UserRegisterRequest;
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

  public function register()
  {
    View::render('User/register', [
      'title' => 'Register new User',
    ]);
  }

  public function postRegister()
  {
    $request = new UserRegisterRequest();
    $request->id = $_POST['id'];
    $request->name = $_POST['name'];
    $request->password = $_POST['password'];

    try {
      $this->userService->register($request);
      View::redirect('/users/login');
    } catch (ValidationException $exception) {
      View::render('User/register', [
        'title' => 'Register new User',
        'error' => $exception->getMessage(),
      ]);
    }
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

  public function updateProfile()
  {
    $user = $this->sessionService->current();

    View::render('User/profile', [
      'title' => 'Update user profile',
      'user' => [
        'id' => $user->IdPengguna,
        'name' => $user->NamaPengguna,
      ],
    ]);
  }

  public function postUpdateProfile()
  {
    $user = $this->sessionService->current();

    $request = new UserProfileUpdateRequest();
    $request->id = $user->IdPengguna;
    $request->name = $_POST['name'];

    try {
      $this->userService->updateProfile($request);
      View::redirect('/');
    } catch (ValidationException $exception) {
      View::render('User/profile', [
        'title' => 'Update user profile',
        'error' => $exception->getMessage(),
        'user' => [
          'id' => $user->IdPengguna,
          'name' => $_POST['name'],
        ],
      ]);
    }
  }

  public function updatePassword()
  {
    $user = $this->sessionService->current();
    View::render('User/password', [
      'title' => 'Update user password',
      'user' => [
        'id' => $user->IdPengguna,
      ],
    ]);
  }

  public function postUpdatePassword()
  {
    $user = $this->sessionService->current();
    $request = new UserPasswordUpdateRequest();
    $request->id = $user->IdPengguna;
    $request->oldPassword = $_POST['oldPassword'];
    $request->newPassword = $_POST['newPassword'];

    try {
      $this->userService->updatePassword($request);
      View::redirect('/');
    } catch (ValidationException $exception) {
      View::render('User/password', [
        'title' => 'Update user password',
        'error' => $exception->getMessage(),
        'user' => [
          'id' => $user->IdPengguna,
        ],
      ]);
    }
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