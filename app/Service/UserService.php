<?php

namespace WebApp\PHP\MVC\Service;

use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Domain\User;
use WebApp\PHP\MVC\Exception\ValidationException;
use WebApp\PHP\MVC\Model\UserLoginRequest;
use WebApp\PHP\MVC\Model\UserLoginResponse;
use WebApp\PHP\MVC\Model\UserPasswordUpdateRequest;
use WebApp\PHP\MVC\Model\UserPasswordUpdateResponse;
use WebApp\PHP\MVC\Model\UserProfileDetailResponse;
use WebApp\PHP\MVC\Model\UserProfileUpdateRequest;
use WebApp\PHP\MVC\Model\UserProfileUpdateResponse;
use WebApp\PHP\MVC\Model\UserRegisterRequest;
use WebApp\PHP\MVC\Model\UserRegisterResponse;
use WebApp\PHP\MVC\Model\UsersListResponse;
use WebApp\PHP\MVC\Repository\UserRepository;

class UserService
{
  private UserRepository $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function login(UserLoginRequest $request): UserLoginResponse
  {
    $this->validateUserLoginRequest($request);

    $user = $this->userRepository->findByUsername($request->NamaPengguna);

    if ($user == null) {
      throw new ValidationException(
        'Nama pengguna, password atau id akses tidak sesuia'
      );
    }
    if (
      $request->Password == $user->Password
      // && $request->IdAkses == $user->IdAkses
    ) {
      $response = new UserLoginResponse();
      $response->user = $user;
      return $response;
    } else {
      throw new ValidationException(
        'Nama pengguna, password atau id akses tidak sesuia'
      );
    }
  }

  private function validateUserLoginRequest(UserLoginRequest $request)
  {
    if (
      $request->NamaPengguna == null ||
      $request->Password == null ||
      trim($request->NamaPengguna) == '' ||
      trim($request->Password) == ''
      // $request->IdAkses == null ||
      // trim($request->IdAkses) == ''
    ) {
      throw new ValidationException('Id, Password can not blank');
    }
  }

  public function getAllUser()
  {
    try {
      Database::beginTransaction();

      $users = $this->userRepository->findAll();

      Database::commitTransaction();

      $response = new UsersListResponse();
      $response->users = $users;
      return $response;
    } catch (\Exception $exception) {
      Database::rollbackTransaction();
      throw $exception;
    }
  }
}