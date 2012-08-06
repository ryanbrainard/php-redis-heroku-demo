<?php
  $r = new Redis();
  $r->connect(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_HOST), parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PORT));
  if (!is_array(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS))) {
    $r->auth(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS));
  }
  
  while (true) {
      echo "ASYNC WORKER - BEGIN BLPOP";
      echo $r->blpop("ASYNC_QUEUE", 10);
      echo "ASYNC WORKER - END BLPOP";
  }
?>
