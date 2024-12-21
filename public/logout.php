<?php
require_once '../config/bootstrap.php';

session_destroy();

_redirect(BASE_URL_PUBLIC . 'index.php', 'You have logout successfully', 'success');
?>
