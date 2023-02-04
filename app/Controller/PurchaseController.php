<?php

namespace WebApp\PHP\MVC\Controller;

use WebApp\PHP\MVC\App\View;
use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Repository\AccessRepository;
use WebApp\PHP\MVC\Repository\ProductRepository;
use WebApp\PHP\MVC\Repository\PurchaseRepository;
use WebApp\PHP\MVC\Repository\SaleRepository;
use WebApp\PHP\MVC\Repository\SessionRepository;
use WebApp\PHP\MVC\Repository\UserRepository;
use WebApp\PHP\MVC\Service\AccessService;
use WebApp\PHP\MVC\Service\ProductService;
use WebApp\PHP\MVC\Service\PurchaseService;
use WebApp\PHP\MVC\Service\SaleService;
use WebApp\PHP\MVC\Service\SessionService;
use WebApp\PHP\MVC\Service\UserService;

class PurchaseController
{
  private SessionService $sessionService;
  private AccessService $accessService;
  private UserService $userService;
  private ProductService $productService;
  private PurchaseService $purchaseService;

  public function __construct()
  {
    $connection = Database::getConnection();
    $sessionRepository = new SessionRepository($connection);
    $userRepository = new UserRepository($connection);
    $accessRepository = new AccessRepository($connection);
    $userRepository = new UserRepository($connection);
    $productRepository = new ProductRepository($connection);
    $purchaseRepository = new PurchaseRepository($connection);
    $this->accessService = new AccessService($accessRepository);
    $this->userService = new UserService($userRepository);

    $this->productService = new ProductService($productRepository);
    $this->purchaseService = new PurchaseService($purchaseRepository);

    $this->sessionService = new SessionService(
      $sessionRepository,
      $userRepository
    );
  }

  function index()
  {
    $user = $this->sessionService->current();
    $accessList = $this->accessService->getAccessList();
    $purchaseList = $this->purchaseService->getPurchaseList(
      (int) $user->IdPengguna,
      (int) $user->IdAkses
    );
    if ($user == null) {
      View::render('User/login', [
        'title' => 'Login',
        'accessList' => $accessList->access,
      ]);
    } else {
      View::render('Purchase/index', [
        'title' => 'Purchase list',
        'user' => [
          'name' => $user->NamaPengguna,
        ],
        'access' => [
          'description' => $user->Keterangan,
          'accessId' => (int) $user->IdAkses,
        ],
        'purchases' => $purchaseList->sale,
      ]);
    }
  }
}