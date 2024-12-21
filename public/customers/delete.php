<?php

require_once '../../config/bootstrap.php';
do_auth();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $customerId = $_GET['id'];

    // Delete the customer record
    DB::delete('customers', "id = %i", $customerId);

    // Redirect back to the main page with a success message
    _redirect(BASE_URL_PUBLIC . 'customers', 'Customer deleted successfully', 'success');
} else {
    // Redirect to the main page with an error message if the ID is invalid
    _redirect(BASE_URL_PUBLIC . 'customers', 'Invalid customer ID');
    exit;
}
