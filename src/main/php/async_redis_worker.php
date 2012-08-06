<?php
  $r = new Redis();
  $r->connect(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_HOST), parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PORT));
  if (!is_array(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS))) {
    $r->auth(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS));
  }
  
  while (true) {
      $asyncReqSerialized = $r->blpop("ASYNC_QUEUE", 30);

      $asyncReq = unserialize($asyncReqSerialized[1]);

      $_REQUEST = $asyncReq["_REQUEST"];

      session_id($asyncReq["SESSION_ID"]);
      session_start();

      print_r($_REQUEST);
      print_r($_SESSION);

      session_write_close();

      echo "ASYNC WORKER - END LOOP\n";
  }
?>
