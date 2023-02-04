<?php

namespace WebApp\PHP\MVC\Middleware;

use WebApp\PHP\MVC\App\View;
use WebApp\PHP\MVC\Config\Database;
use WebApp\PHP\MVC\Repository\SessionRepository;
use WebApp\PHP\MVC\Repository\UserRepository;
use WebApp\PHP\MVC\Service\SessionService;

class MustNotLoginMiddleware implements Middleware
{
  private SessionService $sessionService;

  public function __construct()
  {
    $sessionRepository = new SessionRepository(Database::getConnection());
    $userRepository = new UserRepository(Database::getConnection());
    $this->sessionService = new SessionService(
      $sessionRepository,
      $userRepository
    );
  }

  function before(): void
  {
    $user = $this->sessionService->current();
    if ($user != null) {
      View::redirect('/');
    }
  }
}
