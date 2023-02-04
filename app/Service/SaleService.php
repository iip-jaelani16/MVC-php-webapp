<?php

namespace WebApp\PHP\MVC\Service;

use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Domain\Access;
use WebApp\PHP\MVC\Domain\User;
use WebApp\PHP\MVC\Exception\ValidationException;
use WebApp\PHP\MVC\Model\AccessResponse;
use WebApp\PHP\MVC\Model\ProductListResponse;
use WebApp\PHP\MVC\Model\SaleListResponse;
use WebApp\PHP\MVC\Model\UserLoginRequest;
use WebApp\PHP\MVC\Model\UserLoginResponse;
use WebApp\PHP\MVC\Model\UserPasswordUpdateRequest;
use WebApp\PHP\MVC\Model\UserPasswordUpdateResponse;
use WebApp\PHP\MVC\Model\UserProfileUpdateRequest;
use WebApp\PHP\MVC\Model\UserProfileUpdateResponse;
use WebApp\PHP\MVC\Model\UserRegisterRequest;
use WebApp\PHP\MVC\Model\UserRegisterResponse;
use WebApp\PHP\MVC\Repository\AccessRepository;
use WebApp\PHP\MVC\Repository\ProductRepository;
use WebApp\PHP\MVC\Repository\SaleRepository;
use WebApp\PHP\MVC\Repository\UserRepository;

class SaleService
{
  private SaleRepository $saleRepository;

  public function __construct(SaleRepository $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function getProductList(int $IdPengguna, int $IdAccess)
  {
    try {
      Database::beginTransaction();
      $sale = $this->saleRepository->findAllByUserId($IdPengguna, $IdAccess);
      $response = new SaleListResponse();
      $response->sale = $sale;
      Database::commitTransaction();
      return $response;
    } catch (\Exception $exception) {
      Database::rollbackTransaction();
      throw $exception;
    }
  }
}