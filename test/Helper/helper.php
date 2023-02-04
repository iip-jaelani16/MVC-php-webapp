<?php

namespace WebApp\PHP\MVC\App {
  function header(string $value)
  {
    echo $value;
  }
}

namespace WebApp\PHP\MVC\Service {
  function setcookie(string $name, string $value)
  {
    echo "$name: $value";
  }
}
