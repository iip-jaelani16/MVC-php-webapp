<?php

namespace WebApp\PHP\MVC\Middleware;

interface Middleware
{
  function before(): void;
}
