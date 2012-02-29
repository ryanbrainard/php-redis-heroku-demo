<?php
$redis_url = "tcp://" . parse_url($_ENV['REDISTOGO_URL'], PHP_URL_HOST) . ":" . parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PORT);
if (!is_array(parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS))) {
  $redis_url .= "?auth=" . parse_url($_ENV['REDISTOGO_URL'], PHP_URL_PASS);
}
ini_set("session.save_path", $redis_url);
ini_set("session.save_handler", "redis");
session_start();

print "<p>session opened</p>";
if (isset($_REQUEST['key'])) {
    $_SESSION['key'] = $_REQUEST['key'];
    print "<p>Wrote [" . $_REQUEST['key'] . "] to session</p>";
}
session_write_close();

print "<p>session closed</p>";

if (isset($_SESSION['key'])) {
    print "<p>Read [" . $_SESSION['key'] . "] from session</p>";
} else {
    print "<p>Key not found in session</p>";
}
print "<p>Send field name 'key' to store its value in the session</p>";
?>

