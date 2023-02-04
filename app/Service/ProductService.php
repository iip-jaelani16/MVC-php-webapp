<?php

namespace WebApp\PHP\MVC\Service;

use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Domain\Access;
use WebApp\PHP\MVC\Domain\User;
use WebApp\PHP\MVC\Exception\ValidationException;
use WebApp\PHP\MVC\Model\AccessResponse;
use WebApp\PHP\MVC\Model\ProductListResponse;
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
use WebApp\PHP\MVC\Repository\UserRepository;

class ProductService
{
  private ProductRepository $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function getProductList(int $IdPengguna, int $idAccess)
  {
    try {
      Database::beginTransaction();
      $product = $this->productRepository->findAllByUserId(
        $IdPengguna,
        $idAccess
      );
      $response = new ProductListResponse();
      $response->product = $product;
      Database::commitTransaction();
      return $response;
    } catch (\Exception $exception) {
      Database::rollbackTransaction();
      throw $exception;
    }
  }
}