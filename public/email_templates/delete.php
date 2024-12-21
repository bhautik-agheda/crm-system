<?php

require_once '../../config/bootstrap.php';
do_auth();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    DB::delete('email_templates', "id = %i", $_GET['id']);
    _redirect(BASE_URL_PUBLIC . 'email_templates', 'Template deleted successfully', 'success');
} else {
    _redirect(BASE_URL_PUBLIC . 'email_templates', 'Invalid template ID');
}
?>