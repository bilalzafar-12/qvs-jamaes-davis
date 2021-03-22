<?php

session_start();
$_SESSION = array();
setcookie( session_name(), "", time()-3600, "/" );
session_destroy();
session_write_close();
header('Location: login.php');
exit;

?>