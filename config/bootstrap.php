<?php

if (!session_id()) {
    session_start();
}
include 'constant.php';
/*
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    default:
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
}

/*
 * --------------------------------------------------------------------
 * LOAD Vendor
 * --------------------------------------------------------------------
 */
include BASE_PATH . 'vendor/autoload.php';
/*
 * --------------------------------------------------------------------
 * Delight Auth
 * --------------------------------------------------------------------
 */
try {
    global $auth;
//    $auth   = new \Delight\Auth\Auth($db, null, null, false);

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    DB::$dsn = $dsn;
    DB::$user = DB_USER;
    DB::$password = DB_PASS;

    //$db = new MeekroDB($dsn, DB_USER, DB_PASS);    
} catch (PDOException $e) {
    //$e->getMessage();
}
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 */
include BASE_PATH . 'helper/functions.php';