<?php
require_once '../../config/bootstrap.php';
do_auth();

$page_title = 'Add customer';

$id = $name = $email = $phone = $address = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $page_title = 'Edit customer';
    $id = $_GET['id'];
    $customer = DB::queryFirstRow("SELECT * FROM customers WHERE id = %s", $id);
    if (!empty($customer)) {
        $name = $customer['name'];
        $email = $customer['email'];
        $phone = $customer['phone'];
        $address = $customer['address'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (isset($id) && $id != '') {
        DB::update('customers', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
                ], 'id = %s', $id);
        _redirect(BASE_URL_PUBLIC . 'customers', 'Customer update successfully', 'success');
    } else {
        DB::insert('customers', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ]);

        _redirect(BASE_URL_PUBLIC . 'customers', 'Customer added successfully', 'success');
    }
}

include BASE_PATH . 'templates/header.php';
?>

<div class="body-section">
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="<?php echo $name; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include BASE_PATH . 'templates/footer.php'; ?>