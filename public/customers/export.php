<?php

require_once '../../config/bootstrap.php';
do_auth();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$customers = DB::query("SELECT * FROM customers WHERE name LIKE %s", "%$search%");

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="customers.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Address', 'Created At']);

foreach ($customers as $customer) {
    fputcsv($output, $customer);
}
fclose($output);
exit;
