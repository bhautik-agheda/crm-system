<?php
require_once '../../config/bootstrap.php';
do_auth();

$page_title = 'Customers';

// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search and Sort
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

// Fetch customers with search, sort, and pagination
$customers = DB::query("SELECT * FROM customers WHERE name LIKE %s ORDER BY $sort $order LIMIT %i OFFSET %i", "%$search%", $limit, $offset);

// Get total records for pagination
$totalRecords = DB::queryFirstField("SELECT COUNT(*) FROM customers WHERE name LIKE %s", "%$search%");

$totalPages = ceil($totalRecords / $limit);

include BASE_PATH . 'templates/header.php';
?>
<div class="container">
    <form method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <a href="manage.php" class="btn btn-success mb-3">Add Customer</a>
    <a href="export.php?search=<?= urlencode($search) ?>" class="btn btn-info mb-3">Export CSV</a>
    <a href="<?php echo BASE_URL_PUBLIC; ?>download_report/pdf.php?search=<?= urlencode($search) ?>" class="btn btn-primary mb-3">Customer Report PDF</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><a href="?sort=id&order=<?= $order === 'ASC' ? 'desc' : 'asc' ?>">ID</a></th>
                    <th><a href="?sort=name&order=<?= $order === 'ASC' ? 'desc' : 'asc' ?>">Name</a></th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['id'] ?></td>
                        <td><?= htmlspecialchars($customer['name']) ?></td>
                        <td><?= htmlspecialchars($customer['email']) ?></td>
                        <td><?= htmlspecialchars($customer['phone']) ?></td>
                        <td><?= htmlspecialchars($customer['address']) ?></td>
                        <td><?= $customer['created_at'] ?></td>
                        <td>
                            <a href="manage.php?id=<?= $customer['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $customer['id'] ?>" onclick="return confirm('Are you sure you want to delete this customer?')" class ="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&sort=<?= urlencode($sort) ?>&order=<?= urlencode($order) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include BASE_PATH . 'templates/footer.php'; ?>