<?php
require_once '../../config/bootstrap.php';
do_auth();
$page_title = 'Email Logs';
include BASE_PATH . 'templates/header.php';

// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$logs = DB::query("SELECT * FROM email_logs ORDER BY sent_at DESC LIMIT %i OFFSET %i", $limit, $offset);

// Get total records for pagination
$totalRecords = DB::queryFirstField("SELECT COUNT(*) FROM email_logs");

$totalPages = ceil($totalRecords / $limit);
?>

<div class="body-section">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer ID</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Error Message</th>
                    <th>Sent At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= $log['id'] ?></td>
                        <td><?= $log['customer_id'] ?></td>
                        <td><?= htmlspecialchars($log['email']) ?></td>
                        <td><?= htmlspecialchars($log['subject']) ?></td>
                        <td><?= $log['status'] ?></td>
                        <td><?= $log['error_message'] ? : 'N/A' ?></td>
                        <td><?= $log['sent_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<?php include BASE_PATH . 'templates/footer.php'; ?>