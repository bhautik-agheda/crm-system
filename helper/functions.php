<?php

function auth_id() {
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        return $_SESSION['user_id'];
    }
    return 0;
}

function do_auth() {
    if (!auth_id()) {
        $page = ltrim($_SERVER['REQUEST_URI'], '/');
        if ($page != 'index.php' && $page != 'register.php' && $page != 'forgot-password.php') {
            _redirect(BASE_URL . 'index.php');
        }
    }
    return true;
}

function _redirect($uri, $message = '', $type = 'error') {
    if ($message && $type) {
        _set_flash_message($message, $type);
    }
    header("Location:{$uri}");
    exit();
}

function _set_flash_message($message, $type = 'error') {
    $_SESSION['flash_message'] = array(
        'type' => $type,
        'message' => $message,
    );
}

/**
 * _flash_message
 *
 * @return void
 */
function _flash_message() {
    if (isset($_SESSION['flash_message']['type']) && $_SESSION['flash_message']['type'] != '' && isset($_SESSION['flash_message']['message']) && $_SESSION['flash_message']['message'] != '') {
        $bg = 'bg-info-500';
        $icon = 'fa-info-circle';
        switch ($_SESSION['flash_message']['type']) {
            case 'success':
                $bg = 'alert-success';
                $icon = 'fa-check';
                break;
            case 'error':
                $bg = 'alert-danger';
                $icon = 'fa-times-circle';
                break;
        }
        echo '<div class="alert ' . $bg . ' alert-dismissible" role="alert">
                <div>' . $_SESSION['flash_message']['message'] . '</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['flash_message']);
    }
}

?>