<?php
  $r = new Redis();
  $r->connect(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_HOST), parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PORT));
  if (!is_array(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS))) {
    $r->auth(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS));
  }
  
  while (true) {
      echo "ASYNC WORKER - BEGIN BLPOP\n";
      $requestSerialized = $r->blpop("ASYNC_QUEUE", 30);
      $_REQUEST = unserialize($requestSerialized[1]);

      session_id($_REQUEST[session_name()]);
      session_start();

      print_r($_REQUEST);
      print_r($_SESSION);

      session_write_close();

      echo "ASYNC WORKER - END BLPOP\n";
  }
?>
